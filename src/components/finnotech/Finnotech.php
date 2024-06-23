<?php

namespace sadi01\openbanking\components\finnotech;

use sadi01\openbanking\components\OpenBanking;
use sadi01\openbanking\models\BaseOpenBanking;
use sadi01\openbanking\models\ObOauthAccessTokens;
use sadi01\openbanking\models\ObOauthClients;
use sadi01\openbanking\models\ObOauthRefreshTokens;
use yii\base\InvalidConfigException;
use yii\httpclient\Client;
use sadi01\openbanking\models\Finnotech as FinnotechBaseModel;
use Yii;

class Finnotech extends OpenBanking implements FinnotechInterface
{

    public $baseUrl = 'https://apibeta.finnotech.ir/';
    private $model;
    private $client;

    public function init()
    {
        parent::init();
        $this->model = new FinnotechBaseModel();

        $this->client = ObOauthClients::find()
            ->byClient(ObOauthClients::PLATFORM_FINNOTECH)
            ->one();

        if (!($this->client instanceof ObOauthClients)) {
            throw new InvalidConfigException(Yii::t('openBanking', 'The Service Provider is not set'));
        }
    }

    public function goToAuthorize($data)
    {
        $scopes = is_array($data['scopes']) ? implode(',', $data['scopes']) : $data['scopes'];
        $params = array(
            'client_id' => $this->client->app_key,
            'response_type' => 'code',
            'redirect_uri' => $data['redirect_uri'],
            'scope' => $scopes,
            'bank' => $data['bank'] ?? '062',
            'state' => $data['state'] ?? null,
        );

        if (preg_match('/\b' . FinnotechBaseModel::SCOPE_TRANSFER_TO . '\b/', $scopes)) {
            $params['limit'] = (int)$this->client->finno_limit;
            $params['count'] = (int)$this->client->finno_count;
        }

        return BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_GO_TO_AUTHORIZE, $params);
    }

    public function getAuthorizeToken($data)
    {
        $accessToken = ObOauthAccessTokens::find()->notExpire()->byClientId($this->client->client_id)->one();
        $refreshToken = ObOauthRefreshTokens::find()->notExpire()->byClientId($this->client->client_id)->one();

        if (!$accessToken instanceof ObOauthAccessTokens && !$refreshToken instanceof ObOauthRefreshTokens) {

            $body = [
                'grant_type' => 'authorization_code',
                'code' => $data['code'],
                'bank' => $data['bank'],
                'redirect_uri' => $data['redirect_uri'],
            ];

            $headers['Content-Type'] = Client::FORMAT_JSON;
            $headers['Authorization'] = 'Basic ' . base64_encode($this->client->app_key . ':' . $this->client->app_password);
            $response = Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_GET_TOKEN, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_GET_AUTHORIZE_TOKEN), $body, $headers);
            if ($response['status'] == 200) {
                $result = $response['data']->result;
                $scopes = null;
                foreach ($result->scopes as $scope) {
                    $scopes .= $scope . ' ';
                }
                $accessToken = new ObOauthAccessTokens([
                    'access_token' => $result->value,
                    'client_id' => (string)ObOauthClients::PLATFORM_FINNOTECH,
                    'user_id' => Yii::$app->user->id,
                    'expires' => date('Y-m-d H:i:s', time() + ($result->lifeTime / 1000)),
                    'scope' => $scopes,
                ]);
                if (!$accessToken->save()) {
                    print_r($accessToken->errors);
                    die;
                }
                $refreshToken = new ObOauthRefreshTokens([
                    'refresh_token' => $result->refreshToken,
                    'user_id' => Yii::$app->user->id,
                    'client_id' => (string)ObOauthClients::PLATFORM_FINNOTECH,
                    'expires' => date('Y-m-d H:i:s', time() + ($result->lifeTime / 1000)),
                    'scope' => $scopes,
                ]);
                /* $refreshToken->save();*/
                if (!$refreshToken->save()) {
                    print_r($refreshToken->errors);
                    die;
                }
                return $accessToken->access_token;
            }
        } else if ($accessToken instanceof ObOauthAccessTokens) {
            return $accessToken->access_token;
        } else if ($refreshToken instanceof ObOauthRefreshTokens) {
            return Authentication::refreshToken($refreshToken, $this->client);
        }
        return null;
    }

    /**
     * @param array $data The data array containing:
     *     - string 'amount' => مبلغ انتقال وجه
     *     - string 'description' => شرح انتقال وجه
     *     - string 'destinationFirstname' => نام صاحب حساب مقصد
     *     - string 'destinationLastname' => نام خانوادگی صاحب حساب مقصد
     *     - string 'destinationNumber' => شماره حساب مقصد
     *     - string 'paymentNumber' => شناسه پرداخت
     *     - string 'reasonDescription' => بابت
     *     - string 'deposit' => شماره حساب مبدا
     *     - string 'sourceFirstName' => نام صاحب حساب مبدا
     *     - string 'sourceLastName' => نام خانوادگی صاحب حساب مبدا
     *     - string 'secondPassword' => رمز انتقال وجه
     *     - ?string 'merchantName' => نام پذیرنده
     *     - ?string 'merchantIban' => شماره شبا پذیرنده
     * @return mixed The result of the processing.
     * */
    public function transfer($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_TRANSFER)) {
            return Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_TRANSFER, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_TRANSFER, ['clientId' => $data['client_id'], 'trackId' => $data['track_id']]), $data, $this->getHeaders());
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - string 'destinationNumber' => شماره شبای بانک مقصد
     *     - string 'amount' =>  مبلغ انتقال وجه
     *     - string 'description' => شرح انتقال وجه
     *     - string 'reasonDescription' => اطلاعات بیشتر
     *     - integer 'paymentNumber' => شناسه پرداخت
     *     - string 'destinationFirstname' =>  نام صاحب حساب مقصد
     *     - string 'destinationLastname' => نام خانوادگی صاحب حساب مقصد
     *     - integer 'customerRef' => شناسه ارجاع
     * @return mixed The result of the processing.
     * */
    public function payaTransfer($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_PAYA_TRANSFER)) {
            return Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_PAYA_TRANSFER, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_PAYA_TRANSFER, ['clientId' => $data['client_id'], 'trackId' => $data['track_id']]), $data, $this->getHeaders());
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - string 'amount' => مبلغ تراکنش
     *     - string 'description' =>   شرح تراکنش
     *     - string 'destinationNumber' =>شماره شبا مقصد
     *     - integer 'paymentNumber' =>  شناسه پرداخت
     *     - string 'customerRef' => شماره مرجع تراکنش که توسط کاربر وارد می شود
     *     - string 'sourceFirstName' => نام صاحب حساب مبدا
     *     - string 'sourceLastName' => نام خانوادگی صاحب حساب مبدا
     *     - string 'reasonDescription' => دلیل تراکنش
     *     - integer 'note' =>  شناسه پرداخت
     *     - ?string 'destinationFirstname' => نام صاحب حساب مقصد
     *     - ?string 'destinationLastname' => نام خانوادگی صاحب حساب مقصد
     *     - ?string 'deposit' => شماره حساب مبدا
     * @return mixed The result of the processing.
     * */
    public function internalTransfer($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_INTERNAL_TRANSFER)) {
            return Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_INTERNAL_TRANSFER, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_INTERNAL_TRANSFER, ['clientId' => $data['client_id'], 'trackId' => $data['track_id']]), $data, $this->getHeaders());
        } else return $this->setErrors($this->model->errors);
    }

    public function cardToDeposit($data)
    {

    }

    public function cardToShaba($data)
    {

    }

    public function nidVerification($data)
    {

    }

    public function matchMobileNid($data)
    {

    }

    public function cardInfo($data)
    {

    }

    public function deposits($data)
    {

    }

    /**
     * @param array $data The data array containing:
     *     - string 'iban' => شماره شبا
     * @return mixed The result of the processing.
     * */
    public function shabaInquiry($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_SHABA_INQUIRY)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_SHABA_INQUIRY, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_SHABA_INQUIRY, ['clientId' => $data['client_id'], 'trackId' => $data['track_id'], 'iban' => $data['iban']]), $data, $this->getHeaders());
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - string 'deposit' => شماره حسابی که قصد دریافت شماره شبا آن را دارید
     *     - string 'bankCode' => کد بانک صاحب حساب
     * @return mixed The result of the processing.
     * */
    public function depositToShaba($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_DEPOSIT_TO_SHABA)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_DEPOSIT_TO_SHABA, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_DEPOSIT_TO_SHABA, ['clientId' => $data['client_id'], 'trackId' => $data['track_id'], 'deposit' => $data['deposit'], 'bank_code' => $data['bank_code']]), $data, $this->getHeaders());
        } else return $this->setErrors($this->model->errors);
    }

    /**
     * @param array $data The data array containing:
     *     - string 'sayadId' => شناسه صیاد چک
     * @return mixed The result of the processing.
     * */
    public function checkInquiry($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_CHECK_INQUIRY)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_CHECK_INQUIRY, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_CHECK_INQUIRY, ['clientId' => $data['client_id'], 'trackId' => $data['track_id'], 'sayadId' => $data['sayad_id']]), null, $this->getHeaders());
        } else return $this->setErrors($this->model->errors);
    }


    public function banksInfo($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_BANKS_INFO)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_BANKS_INFO, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_BANKS_INFO, ['clientId' => $data['client_id'], 'trackId' => $data['track_id']]), null, $this->getHeaders());
        } else return $this->setErrors($this->model->errors);
    }


    public function load($data, $scenario)
    {
        $this->model->scenario = $scenario;
        if ($this->model->load($data, '') && $this->model->validate()) {
            return true;
        }
        $this->model->validate();
        return false;
    }

    public function getHeaders()
    {
        $token = Authentication::getToken($this->client);

        $headers = [];
        $headers['Accept-Language'] = 'fa';
        $headers['Authorization'] = 'Bearer ' . $token;
        $headers['Content-Type'] = Client::FORMAT_JSON;

        return $headers;
    }

}