<?php

namespace sadi01\openbanking\components\faraboom;

use Yii;
use sadi01\openbanking\components\OpenBanking;
use sadi01\openbanking\models\Faraboom as FaraboomBaseModel;
use yii\httpclient\Client;

class Faraboom extends OpenBanking implements FaraboomInterface
{
    public $baseUrl = 'https://api.sandbox.faraboom.co/v1/';
    private $model;

    public function init()
    {
        parent::init();
        $this->model = new FaraboomBaseModel();
    }

    /*CLIENT-IP-ADDRESS
    BANK-ID
    TOKEN-ID
    CLIENT-USER-ID
    APP-KEY*/

    public function depositToShaba($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_DEPOSIT_TO_SHABA)) {
            return Yii::$app->apiClient->get($this->baseUrl . 'deposits', $data, null);
        } else return $this->model->errors;
    }

    //$iban
    public function shabaToDeposit($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_SHABA_TO_DEPOSIT)) {
        return Yii::$app->apiClient->get($this->baseUrl . 'ibans', $data, null);
        } else return $this->model->errors;
    }

//    $national_code, $account
    public function matchNationalCodeAccount($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_MATCH_NATIONAL_CODE_ACCOUNT)) {
        return Yii::$app->apiClient->post($this->baseUrl . 'deposits/account', $data, null);
        } else return $this->model->errors;
    }

// $deposit_number
    public function depositHolder($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_MATCH_NATIONAL_CODE_ACCOUNT)) {
        return Yii::$app->apiClient->get($this->baseUrl . 'deposits', $data, null);
        } else return $this->model->errors;
    }

    //$source_deposit_number, $iban_number, $owner_name, $amount, $transfer_description, $customer_number, $description, $factor_number, $additional_document_desc, $transaction_reason, $pay_id
    public function paya($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_PAYA)) {
        return Yii::$app->apiClient->post($this->baseUrl . 'ach/transfer/normal ', $data, null);
        } else return $this->model->errors;
    }

    //$amount, $source_deposit_number, $receiver_name, $receiver_family, $destination_iban_number, $customer_number, $receiver_phone_number, $factor_number, $description, $tranaction_reason, $pay_id
    public function satna($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_SATNA)) {
        return Yii::$app->apiClient->post($this->baseUrl . 'rtgs/transfer ', $data, null);
        } else return $this->model->errors;

    }

    //$sayad_id, $customer_number
    public function checkinquiryReceiver($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_SATNA)) {
        return Yii::$app->apiClient->post($this->baseUrl . 'cheques/sayad/holder/inquiry ', $data, null);
        } else return $this->model->errors;

    }

//$shaba_number
    public function shabainquiry($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_SHABA_INQUIRY)) {
        return Yii::$app->apiClient->get($this->baseUrl . 'ach/iban/{iban}/info', $data, null);
        } else return $this->model->errors;

    }

    //$national_code, $mobile
    public function matchNationalCodeMobile($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_MATCH_NATIONAL_CODE_MOBILE)) {
        return Yii::$app->apiClient->post($this->baseUrl . 'mobile/national-code ', $data, null);
        } else return $this->model->errors;

    }

    //$pan
    public function cartToShaba($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_CART_TO_SHABA)) {
        return Yii::$app->apiClient->get($this->baseUrl . 'cards/{pan}/iban', $data, null);
        } else return $this->model->errors;

    }


   //$transfer_description, $customer_number, $source_deposit_number, $ignore_error, $transactions, $additional_document_desc, $transaction_reason
    public function batchPaya($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_BATCH_PAYA)) {
        return Yii::$app->apiClient->post($this->baseUrl . 'ach/transfer/batch', $data, null);
        } else return $this->model->errors;

    }

    //$source_deposit_iban, $transfer_description, $customer_number, $offset, $length, $reference_id, $traco_no, $transaction_id, $from_register_date, $to_register_date, $from_issue_date, $To_issue_date, $from_transaction_amount, $to_transaction_amount, $iban_number, $iban_owner_name, $factor_number, $description, $include_transaction_status
    public function reportPayaTransactions($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_REPORT_PAYA_TRANSACTIONS)) {
        return Yii::$app->apiClient->post($this->baseUrl . 'ach/reports/transaction', $data, null);
        } else return $this->model->errors;

    }

    //$source_deposit_iban, $transfer_description, $customer_number, $offset, $length, $from_transaction_amount, $to_transaction_amount, $reference_id, $trace_no, $destination_iban_number, $destination_owner_name, $from_register_date, $to_register_date, $from_issue_date, $to_issue_date, $description, $factor_number, $status_set, $transaction_status_set
    public function reportPayaTransfer($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_REPORT_PAYA_TRANSFER)) {
        return Yii::$app->apiClient->post($this->baseUrl . 'ach/reports/transfer', $data, null);
        } else return $this->model->errors;

    }

    //$customer_number, $transfer_id, $comment
    public function cancelPaya($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_CANCLE_PAYA)) {
        return Yii::$app->apiClient->post($this->baseUrl . 'ach/cancel/transfer', $data, null);
        } else return $this->model->errors;

    }

//$customer_number, $status, $branch_code, $branch_name, $from_date, $length, $offset, $serial, $trace_no, $to_date
    public function reportSatnaTransfer($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_REPORT_SATNA_TRANSFER)) {
        return Yii::$app->apiClient->post($this->baseUrl . 'rtgs/transfer/report', $data, null);
        } else return $this->model->errors;

    }

    //$source_deposit_number, $description, $customer_number,$transaction_reason,$signers, $transactions
    public function batchSatna($data)
    {
        if ($this->load($data, FaraboomBaseModel::SCENARIO_REPORT_SATNA_TRANSFER)) {
        return Yii::$app->apiClient->post($this->baseUrl . 'rtgs/transfer/batch', $data, null);
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


}