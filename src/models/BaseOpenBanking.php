<?php

namespace sadi01\openbanking\models;

use Yii;

class BaseOpenBanking extends \yii\db\ActiveRecord
{
    public $platform;
    public $service;
    public $object;

    const PLATFORM_FARABOOM = 1;
    const PLATFORM_FINNOTECH = 2;
    const PLATFORM_SHAHIN = 3;
    const PLATFORM_SHAHKAR = 4;

    const FARABOOM_BASE_URL = 'https://api.faraboom.co/v1/';
    const FINNOTECH_BASE_URL = 'https://apibeta.finnotech.ir';

    const FARABOOM_GET_TOKEN = 1;
    const FARABOOM_DEPOSIT_TO_SHABA = 2;
    const FARABOOM_SHABA_TO_DEPOSIT = 3;
    const FARABOOM_MATCH_NATIONAL_CODE_ACCOUNT = 4;
    const FARABOOM_DEPOSIT_HOLDER = 5;
    const FARABOOM_PAYA = 6;
    const FARABOOM_SATNA = 7;
    const FARABOOM_CHECK_INQUIRY_RECEIVER = 8;
    const FARABOOM_SHABA_INQUIRY = 9;
    const FARABOOM_MATCH_NATIONAL_CODE_MOBILE = 10;
    const FARABOOM_CART_TO_SHABA = 11;
    const FARABOOM_BATCH_PAYA = 12;
    const FARABOOM_REPORT_PAYA_TRANSACTIONS = 13;
    const FARABOOM_REPORT_PAYA_TRANSFER = 14;
    const FARABOOM_CANCLE_PAYA = 15;
    const FARABOOM_REPORT_SATNA_TRANSFER = 16;
    const FARABOOM_BATCH_SATNA = 17;
    const FARABOOM_INTERNAL_TRANSFER = 18;
    const FARABOOM_BATCH_INTERNAL_TRANSFER = 19;
    const FARABOOM_DEPOSITS = 20;

    const FARABOOM_REFRESH_TOKEN = 21;
    const FINNOTECH_TRANSFER = 22;
    const FINNOTECH_PAYA_TRANSFER = 23;
    const FINNOTECH_INTERNAL_TRANSFER = 24;
    const FINNOTECH_SHABA_INQUIRY = 25;
    const FINNOTECH_DEPOSIT_TO_SHABA = 26;
    const FINNOTECH_CHECK_INQUIRY = 27;
    const FINNOTECH_GET_TOKEN = 28;
    const FINNOTECH_GO_TO_AUTHORIZE = 29;
    const FINNOTECH_GET_AUTHORIZE_TOKEN = 30;
    const FINNOTECH_BANKS_INFO = 31;


    public function rules()
    {
        return [
            [['platform', 'service', 'object'], 'required'],
            [['platform', 'service'], 'string'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'platform' => Yii::t('openBanking', 'Platform'),
            'service' => Yii::t('openBanking', 'Servive'),
            'object' => Yii::t('openBanking', 'Object'),
        ];
    }

    public static function itemAlias($type, $code = NULL, $params = null)
    {
        $_items = [
            'PlatformMap' => [
                self::PLATFORM_FINNOTECH => 'finnotech',
                self::PLATFORM_FARABOOM => 'faraboom',
                self::PLATFORM_SHAHIN => 'Shahin',
                self::PLATFORM_SHAHKAR => 'Shahkar'
            ],
            'Platform' => [
                self::PLATFORM_FINNOTECH => Yii::t('openBanking', 'Finnotech'),
                self::PLATFORM_FARABOOM => Yii::t('openBanking', 'Faraboom'),
                self::PLATFORM_SHAHIN => Yii::t('openBanking', 'Shahin'),
                self::PLATFORM_SHAHKAR => Yii::t('openBanking', 'Shahkar')
            ],
            'ServiceType' => [
                self::FARABOOM_GET_TOKEN => Yii::t('openBanking', 'Get faraboom token'),
                self::FARABOOM_REFRESH_TOKEN => Yii::t('openBanking', 'refresh faraboom token'),
                self::FARABOOM_DEPOSIT_TO_SHABA => Yii::t('openBanking', 'Deposit To Shaba'),
                self::FARABOOM_SHABA_TO_DEPOSIT => Yii::t('openBanking', 'Shaba To Deposit'),
                self::FARABOOM_MATCH_NATIONAL_CODE_ACCOUNT => Yii::t('openBanking', 'Match National Code Account'),
                self::FARABOOM_DEPOSIT_HOLDER => Yii::t('openBanking', 'Deposit Holder'),
                self::FARABOOM_PAYA => Yii::t('openBanking', 'Paya'),
                self::FARABOOM_SATNA => Yii::t('openBanking', 'Satna'),
                self::FARABOOM_CHECK_INQUIRY_RECEIVER => Yii::t('openBanking', 'Check Inquery Receiver'),
                self::FARABOOM_SHABA_INQUIRY => Yii::t('openBanking', 'Shaba Inquiry'),
                self::FARABOOM_MATCH_NATIONAL_CODE_MOBILE => Yii::t('openBanking', 'Match National Code Mobile'),
                self::FARABOOM_CART_TO_SHABA => Yii::t('openBanking', 'Cart To Shaba'),
                self::FARABOOM_BATCH_PAYA => Yii::t('openBanking', 'Batch Paya'),
                self::FARABOOM_REPORT_PAYA_TRANSACTIONS => Yii::t('openBanking', 'Report Paya Transactions'),
                self::FARABOOM_REPORT_PAYA_TRANSFER => Yii::t('openBanking', 'Paya Transfer'),
                self::FARABOOM_CANCLE_PAYA => Yii::t('openBanking', 'Cancel Paya'),
                self::FARABOOM_REPORT_SATNA_TRANSFER => Yii::t('openBanking', 'Report Satna Transfer'),
                self::FARABOOM_BATCH_SATNA => Yii::t('openBanking', 'Batch Satna'),
                self::FARABOOM_INTERNAL_TRANSFER => Yii::t('openBanking', ' Internal Transfer'),
                self::FARABOOM_BATCH_INTERNAL_TRANSFER => Yii::t('openBanking', 'Batch Internal Transfer'),
                self::FARABOOM_DEPOSITS => Yii::t('openBanking', 'Deposits'),
                self::FINNOTECH_GO_TO_AUTHORIZE => Yii::t('openBanking', 'goToAuthorize'),
                self::FINNOTECH_GET_AUTHORIZE_TOKEN => Yii::t('openBanking', 'Get Finnot Auth Token'),
                self::FINNOTECH_TRANSFER => Yii::t('openBanking', 'Transfer'),
                self::FINNOTECH_PAYA_TRANSFER => Yii::t('openBanking', 'Paya Transfer'),
                self::FINNOTECH_INTERNAL_TRANSFER => Yii::t('openBanking', 'Internal Transfer'),
                self::FINNOTECH_SHABA_INQUIRY => Yii::t('openBanking', 'Shaba Inquiry'),
                self::FINNOTECH_DEPOSIT_TO_SHABA => Yii::t('openBanking', 'Deposit To Shaba'),
                self::FINNOTECH_CHECK_INQUIRY => Yii::t('openBanking', 'Check Inquiry'),
                self::FINNOTECH_GET_TOKEN => Yii::t('openBanking', 'Get finnotech token'),
                self::FINNOTECH_BANKS_INFO => Yii::t('openBanking', 'Banks Info'),
            ],
            'ServiceTypeMap' => [
                self::FARABOOM_GET_TOKEN => 'token',
                self::FARABOOM_REFRESH_TOKEN => 'token',
                self::FINNOTECH_GET_TOKEN => 'token',
                self::FARABOOM_DEPOSIT_TO_SHABA => 'depositToShaba',
                self::FARABOOM_SHABA_TO_DEPOSIT => 'shabaToDeposit',
                self::FARABOOM_MATCH_NATIONAL_CODE_ACCOUNT => 'matchNationalCodeAccount',
                self::FARABOOM_DEPOSIT_HOLDER => 'depositHolder',
                self::FARABOOM_PAYA => 'paya',
                self::FARABOOM_SATNA => 'satna',
                self::FARABOOM_CHECK_INQUIRY_RECEIVER => 'checkinquiryReceiver',
                self::FARABOOM_SHABA_INQUIRY => 'shabainquiry',
                self::FARABOOM_MATCH_NATIONAL_CODE_MOBILE => 'matchNationalCodeMobile',
                self::FARABOOM_CART_TO_SHABA => 'cartToShaba',
                self::FARABOOM_BATCH_PAYA => 'batchPaya',
                self::FARABOOM_REPORT_PAYA_TRANSACTIONS => 'reportPayaTransactions',
                self::FARABOOM_REPORT_PAYA_TRANSFER => 'reportPayaTransfer',
                self::FARABOOM_CANCLE_PAYA => 'cancelPaya',
                self::FARABOOM_REPORT_SATNA_TRANSFER => 'reportSatnaTransfer',
                self::FARABOOM_BATCH_SATNA => 'batchSatna',
                self::FARABOOM_INTERNAL_TRANSFER => 'internalTransfer',
                self::FARABOOM_BATCH_INTERNAL_TRANSFER => 'batchInternalTransfer',
                self::FARABOOM_DEPOSITS => 'deposits',
                self::FINNOTECH_GO_TO_AUTHORIZE => 'goToAuthorize',
                self::FINNOTECH_GET_AUTHORIZE_TOKEN => 'getAuthorizeToken',
                self::FINNOTECH_TRANSFER => 'transfer',
                self::FINNOTECH_PAYA_TRANSFER => 'payaTransfer',
                self::FINNOTECH_INTERNAL_TRANSFER => 'InternalTransfer',
                self::FINNOTECH_SHABA_INQUIRY => 'ShabaInquiry',
                self::FINNOTECH_DEPOSIT_TO_SHABA => 'DepositToShaba',
                self::FINNOTECH_CHECK_INQUIRY => 'CheckInquiry',
                self::FINNOTECH_BANKS_INFO => 'BanksInfo',
            ],
            'ServiceUrl' => [
                self::FARABOOM_GET_TOKEN => self::FARABOOM_BASE_URL,
                self::FARABOOM_REFRESH_TOKEN => self::FARABOOM_BASE_URL,
                self::FINNOTECH_GET_TOKEN => self::FINNOTECH_BASE_URL,
                self::FARABOOM_DEPOSIT_TO_SHABA => self::FARABOOM_BASE_URL . 'deposits/' . (is_array($params) ? null : $params),
                self::FARABOOM_SHABA_TO_DEPOSIT => self::FARABOOM_BASE_URL . 'ibans/' . (is_array($params) ? null : $params),
                self::FARABOOM_MATCH_NATIONAL_CODE_ACCOUNT => self::FARABOOM_BASE_URL . 'deposits/account/national-code',
                self::FARABOOM_DEPOSIT_HOLDER => self::FARABOOM_BASE_URL . 'deposits/' . (is_array($params) ? null : $params) . '/holder',
                self::FARABOOM_PAYA => self::FARABOOM_BASE_URL . 'ach/transfer/normal',
                self::FARABOOM_SATNA => self::FARABOOM_BASE_URL . 'rtgs/transfer',
                self::FARABOOM_CHECK_INQUIRY_RECEIVER => self::FARABOOM_BASE_URL . 'cheques/sayad/holder/inquiry',
                self::FARABOOM_SHABA_INQUIRY => self::FARABOOM_BASE_URL . 'ach/iban/' . (is_array($params) ? null : $params) . '/info',
                self::FARABOOM_MATCH_NATIONAL_CODE_MOBILE => self::FARABOOM_BASE_URL . 'mobile/national-code',
                self::FARABOOM_CART_TO_SHABA => self::FARABOOM_BASE_URL . 'cards/' . (is_array($params) ? null : $params) . '/iban',
                self::FARABOOM_BATCH_PAYA => self::FARABOOM_BASE_URL . 'ach/transfer/batch',
                self::FARABOOM_REPORT_PAYA_TRANSACTIONS => self::FARABOOM_BASE_URL . 'ach/reports/transaction',
                self::FARABOOM_REPORT_PAYA_TRANSFER => self::FARABOOM_BASE_URL . 'ach/reports/transfer',
                self::FARABOOM_CANCLE_PAYA => self::FARABOOM_BASE_URL . 'ach/cancel/transfer/' . (is_array($params) ? null : $params),
                self::FARABOOM_REPORT_SATNA_TRANSFER => self::FARABOOM_BASE_URL . 'rtgs/transfer/report',
                self::FARABOOM_BATCH_SATNA => self::FARABOOM_BASE_URL . 'rtgs/transfer/batch',
                self::FARABOOM_INTERNAL_TRANSFER => self::FARABOOM_BASE_URL . 'deposits/transfer/normal',
                self::FARABOOM_BATCH_INTERNAL_TRANSFER => self::FARABOOM_BASE_URL . 'deposits/transfer/batch',
                self::FARABOOM_DEPOSITS => self::FARABOOM_BASE_URL . 'deposits',
                self::FINNOTECH_GO_TO_AUTHORIZE => self::FINNOTECH_BASE_URL . '/dev/v2/oauth2/authorize?' . (is_array($params) ? http_build_query($params) : ''),
                self::FINNOTECH_GET_AUTHORIZE_TOKEN => self::FINNOTECH_BASE_URL . '/dev/v2/oauth2/token',
                self::FINNOTECH_DEPOSIT_TO_SHABA => [self::FINNOTECH_BASE_URL . '/facility/v2/clients/' . ($params['clientId'] ?? '') . '/depositToIban', 'trackId' => $params['track_id'] ?? '', 'bankCode' => $params['bank_code'] ?? '', 'deposit' => $params['deposit'] ?? ''],
                self::FINNOTECH_TRANSFER => [self::FINNOTECH_BASE_URL . '/oak/v2/clients/' . ($params['clientId'] ?? '') . '/cc/transferTo', 'trackId' => $params['trackId'] ?? ''],
                self::FINNOTECH_PAYA_TRANSFER => [self::FINNOTECH_BASE_URL . '/oak/v2/clients/' . ($params['clientId'] ?? '') . '/payaTransferRequest', 'trackId' => $params['track_id'] ?? ''],
                self::FINNOTECH_INTERNAL_TRANSFER => [self::FINNOTECH_BASE_URL . '/oak/v2/clients/' . ($params['clientId'] ?? '') . '/internalTransferRequest', 'trackId' => $params['track_id'] ?? ''],
                self::FINNOTECH_SHABA_INQUIRY => [self::FINNOTECH_BASE_URL . '/oak/v2/clients/' . ($params['clientId'] ?? '') . '/ibanInquiry', 'trackId' => $params['track_id'] ?? '', 'iban' => $params['iban'] ?? ''],
                self::FINNOTECH_CHECK_INQUIRY => [self::FINNOTECH_BASE_URL . '/credit/v2/clients/' . ($params['clientId'] ?? '') . '/sayadSerialInquiry', 'trackId' => $params['track_id'] ?? '', 'sayadId' => $params['sayad_id'] ?? ''],
                self::FINNOTECH_BANKS_INFO => [self::FINNOTECH_BASE_URL . '/facility/v2/clients/' . ($params['clientId'] ?? '') . '/banksInfo', 'trackId' => $params['track_id'] ?? ''],
            ],
        ];

        if (isset($code))
            return $_items[$type][$code] ?? false;
        else
            return $_items[$type] ?? false;
    }

    public static function getUrl($service, $params = null)
    {
        return self::itemAlias('ServiceUrl', $service, $params);
    }

}


