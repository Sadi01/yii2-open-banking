<?php

namespace sadi01\openbanking\components\finnotech;

use sadi01\openbanking\components\OpenBanking;
use sadi01\openbanking\models\BaseOpenBanking;
use sadi01\openbanking\models\ObOauthClients;
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
            return Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_TRANSFER, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_TRANSFER, ['clientId' => $data['clientId'],'trackId' => $data['trackId']]), $data, $this->getHeaders());
        } else return $this->setErrors($this->model);
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
            return Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_PAYA_TRANSFER, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_PAYA_TRANSFER, ['clientId' => $data['clientId'],'trackId' => $data['trackId']]), $data, $this->getHeaders());
        } else return $this->setErrors($this->model);
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
            return Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_INTERNAL_TRANSFER, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_INTERNAL_TRANSFER, ['clientId' => $data['clientId'],'trackId' => $data['trackId']]), $data, $this->getHeaders());
        } else return $this->setErrors($this->model);
    }

    /**
     * @param array $data The data array containing:
     *     - string 'iban' => شماره شبا
     * @return mixed The result of the processing.
     * */
    public function shabaInquiry($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_SHABA_INQUIRY)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_SHABA_INQUIRY, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_SHABA_INQUIRY, ['clientId' => $data['client_id'],'trackId' => $data['track_id'],'iban' => $data['iban']]), null, $this->getHeaders());
        } else return $this->setErrors($this->model);
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
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_DEPOSIT_TO_SHABA, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_DEPOSIT_TO_SHABA, ['clientId' => $data['clientId'],'trackId' => $data['trackId'],'deposit' => $data['deposit'],'bankCode' => $data['bankCode']]), null, $this->getHeaders());
        } else return $this->setErrors($this->model);
    }

    /**
     * @param array $data The data array containing:
     *     - string 'sayadId' => شناسه صیاد چک
     * @return mixed The result of the processing.
     * */
    public function checkInquiry($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_CHECK_INQUIRY)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_CHECK_INQUIRY, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_CHECK_INQUIRY, ['clientId' => $data['clientId'],'trackId' => $data['trackId'],'sayadId' => $data['sayadId']]), null, $this->getHeaders());
        } else return $this->setErrors($this->model);
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