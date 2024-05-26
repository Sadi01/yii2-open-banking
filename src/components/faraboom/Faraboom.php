<?php

namespace sadi01\openbanking\components\faraboom;

use Yii;
use yii\httpclient\Client;
use sadi01\openbanking\models\ObOauthClients;
use sadi01\openbanking\models\ObRequestLog;
use sadi01\openbanking\components\OpenBanking;
use sadi01\openbanking\models\Faraboom as FaraboomBaseModel;

class Faraboom extends OpenBanking implements FaraboomInterface
{
    public $baseUrl = 'https://api.faraboom.co/v1/';
    private $model;
    private $client;

    public function init()
    {
        parent::init();
        $this->model = new FaraboomBaseModel();

        $this->client = ObOauthClients::find()
            ->byClient(ObOauthClients::PLATFORM_FARABOOM)
            ->one();
    }

    /**
     * @param array $data The data array containing:
     *     - string 'deposit_id' => The Deposit number value.
     * @return mixed The result of the processing.
     * */
    public function depositToShaba($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_DEPOSIT_TO_SHABA)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FARABOOM, ObRequestLog::SERVICE_DEPOSIT_TO_SHABA, $this->client->base_url . '/v1/deposits' . '/' . $data['deposit_id'], $data, $this->getHeaders());
        } else die('eee');
    }

    /**
     * @param array $data The data array containing:
     *     - string 'iban' => The Shaba number value.
     * */
    public function shabaToDeposit($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_SHABA_TO_DEPOSIT)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FARABOOM, ObRequestLog::SERVICE_SHABA_TO_DEPOSIT, $this->baseUrl . 'ibans', $data, $this->getHeaders());
        } else return $this->model->errors;
    }

//    $national_code, $account
    public function matchNationalCodeAccount($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_MATCH_NATIONAL_CODE_ACCOUNT)) {
            return Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, ObRequestLog::SERVICE_MATCH_NATIONAL_CODE_ACCOUNT, $this->baseUrl . 'deposits/account', $data, $this->getHeaders());
        } else return $this->model->errors;
    }

// $deposit_number
    public function depositHolder($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_MATCH_NATIONAL_CODE_ACCOUNT)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FARABOOM, ObRequestLog::SERVICE_DEPOSIT_HOLDER, $this->baseUrl . 'deposits', $data, $this->getHeaders());
        } else return $this->model->errors;
    }

    //$source_deposit_number, $iban_number, $owner_name, $amount, $transfer_description, $customer_number, $description, $factor_number, $additional_document_desc, $transaction_reason, $pay_id
    public function paya($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_PAYA)) {
            return Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, ObRequestLog::SERVICE_PAYA, $this->baseUrl . 'ach/transfer/normal', $data, $this->getHeaders());
        } else return $this->model->errors;
    }

    //$source_deposit,$destination_deposit,$amount,$customer_number,$source_comment,$destination_comment,$pay_id,$reference_number,$additional_document_desc,$transaction_reason
    public function internalTransfer($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_INTERNAL_TRANSFER)) {
            return Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, ObRequestLog::SERVICE_INTERNAL_TRANSFER, $this->baseUrl . 'deposits/transfer/normal', $data, $this->getHeaders($token));
        } else return $this->model->errors;
    }

//$source_deposit_number,$destination_batch_transfers,$ignore_error,$customer_number,$source_description,$additional_document_desc,$signers,$transaction_reason
    public function batchInternalTransfer($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_BATCH_INTERNAL_TRANSFER)) {
            return Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, ObRequestLog::SERVICE_BATCH_INTERNAL_TRANSFER, $this->baseUrl . 'deposits/transfer/batch', $data, $this->getHeaders($token));
        } else return $this->model->errors;
    }

    public function deposits($data)
    {
        // if ($this->load($data, FaraboomBaseModel::SCENARIO_DEPOSITS)) {
        return Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, ObRequestLog::SERVICE_DEPOSITS, $this->baseUrl . 'deposits', $data, $this->getHeaders($token));
        //  } else return $this->model->errors;
    }

    //$amount, $source_deposit_number, $receiver_name, $receiver_family, $destination_iban_number, $customer_number, $receiver_phone_number, $factor_number, $description, $tranaction_reason, $pay_id
    public function satna($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_SATNA)) {
            return Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, ObRequestLog::SERVICE_SATNA, $this->baseUrl . 'rtgs/transfer ', $data, $this->getHeaders());
        } else return $this->model->errors;

    }

    //$sayad_id, $customer_number
    public function checkinquiryReceiver($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_SATNA)) {
            return Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, ObRequestLog::SERVICE_CHECK_INQUIRY_RECEIVER, $this->baseUrl . 'cheques/sayad/holder/inquiry', $data, $this->getHeaders());
        } else return $this->model->errors;

    }

//$shaba_number
    public function shabainquiry($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_SHABA_INQUIRY)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FARABOOM, ObRequestLog::SERVICE_SHABA_INQUIRY, $this->baseUrl . 'ach/iban/{iban}/info', $data, $this->getHeaders());
        } else return $this->model->errors;

    }

    //$national_code, $mobile
    public function matchNationalCodeMobile($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_MATCH_NATIONAL_CODE_MOBILE)) {
            return Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, ObRequestLog::SERVICE_MATCH_NATIONAL_CODE_MOBILE, $this->baseUrl . 'mobile/national-code', $data, $this->getHeaders());
        } else return $this->model->errors;

    }

    //$pan
    public function cartToShaba($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_CART_TO_SHABA)) {
            return Yii::$app->apiClient->get(ObOauthClients::PLATFORM_FARABOOM, ObRequestLog::SERVICE_CART_TO_SHABA, $this->baseUrl . 'cards/{pan}/iban', $data, $this->getHeaders());
        } else return $this->model->errors;

    }


    //$transfer_description, $customer_number, $source_deposit_number, $ignore_error, $transactions, $additional_document_desc, $transaction_reason
    public function batchPaya($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_BATCH_PAYA)) {
            return Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, ObRequestLog::SERVICE_BATCH_PAYA, $this->baseUrl . 'ach/transfer/batch', $data, $this->getHeaders());
        } else return $this->model->errors;

    }

    //$source_deposit_iban, $transfer_description, $customer_number, $offset, $length, $reference_id, $traco_no, $transaction_id, $from_register_date, $to_register_date, $from_issue_date, $To_issue_date, $from_transaction_amount, $to_transaction_amount, $iban_number, $iban_owner_name, $factor_number, $description, $include_transaction_status
    public function reportPayaTransactions($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_REPORT_PAYA_TRANSACTIONS)) {
            return Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, ObRequestLog::SERVICE_REPORT_PAYA_TRANSACTIONS, $this->baseUrl . 'ach/reports/transaction', $data, $this->getHeaders());
        } else return $this->model->errors;

    }

    //$source_deposit_iban, $transfer_description, $customer_number, $offset, $length, $from_transaction_amount, $to_transaction_amount, $reference_id, $trace_no, $destination_iban_number, $destination_owner_name, $from_register_date, $to_register_date, $from_issue_date, $to_issue_date, $description, $factor_number, $status_set, $transaction_status_set
    public function reportPayaTransfer($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_REPORT_PAYA_TRANSFER)) {
            return Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, ObRequestLog::SERVICE_PAYA_TRANSFER, $this->baseUrl . 'ach/reports/transfer', $data, $this->getHeaders());
        } else return $this->model->errors;

    }

    //$customer_number, $transfer_id, $comment
    public function cancelPaya($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_CANCLE_PAYA)) {
            return Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, ObRequestLog::SERVICE_CANCLE_PAYA, $this->baseUrl . 'ach/cancel/transfer', $data, $this->getHeaders());
        } else return $this->model->errors;

    }

//$customer_number, $status, $branch_code, $branch_name, $from_date, $length, $offset, $serial, $trace_no, $to_date
    public function reportSatnaTransfer($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_REPORT_SATNA_TRANSFER)) {
            return Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, ObRequestLog::SERVICE_REPORT_SATNA_TRANSFER, $this->baseUrl . 'rtgs/transfer/report', $data, $this->getHeaders());
        } else return $this->model->errors;

    }

    //$source_deposit_number, $description, $customer_number,$transaction_reason,$signers, $transactions
    public function batchSatna($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_REPORT_SATNA_TRANSFER)) {
            return Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FARABOOM, ObRequestLog::SERVICE_BATCH_SATNA, $this->baseUrl . 'rtgs/transfer/batch', $data, $this->getHeaders());
        } else return $this->model->errors;

    }

    public function load($data, $scenario)
    {
        $this->model->scenario = $scenario;
        if ($this->model->load($data, '') && $this->model->validate()) {
            return true;
        }
        return false;
    }

    public function getHeaders()
    {
        $token = Authentication::getToken($this->client);

        $headers = [];
        $headers['Accept-Language'] = 'fa';
        $headers['App-Key'] = $this->client->app_key;
        //$headers['Session'] = $this->client->authorization;
        // $headers['session-id'] = 'Bearer ' . $token;
        $headers['Authorization'] = 'Bearer ' . $token;
        $headers['bank-id'] = $this->client->bank_id;
        $headers['CLIENT-DEVICE-ID'] = $this->client->client_device_id;
        $headers['CLIENT-IP-ADDRESS'] = $this->client->client_ip_address;
        $headers['CLIENT-PLATFORM-TYPE'] = 'WEB';
        $headers['CLIENT-USER-AGENT'] = $this->client->client_user_agent;
        $headers['CLIENT-USER-ID'] = $this->client->client_user_id;
        $headers['Content-Type'] = Client::FORMAT_JSON;
        $headers['Device-Id'] = $this->client->device_id;
        $headers['Token-Id'] = $this->client->token_id;

        return $headers;
    }


}