<?php

namespace sadi01\openbanking\models;


class BaseOpenBanking extends \yii\db\ActiveRecord
{
    public $platform;
    public $service;
    public $object;


    const PLATFORM_FARABOOM = 1;
    const PLATFORM_FINNOTECH = 2;

    const FARABOOM_BASE_URL = 'https://api.faraboom.co/v1/';

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
    const FARABOOM_PAYA_TRANSFER = 14;
    const FARABOOM_CANCLE_PAYA = 15;
    const FARABOOM_REPORT_SATNA_TRANSFER = 16;
    const FARABOOM_BATCH_SATNA = 17;
    const FARABOOM_INTERNAL_TRANSFER = 18;
    const FARABOOM_BATCH_INTERNAL_TRANSFER = 19;
    const FARABOOM_DEPOSITS = 20;


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

    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'ServiceType' => [
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
                self::FARABOOM_PAYA_TRANSFER => Yii::t('openBanking', 'Paya Transfer'),
                self::FARABOOM_CANCLE_PAYA => Yii::t('openBanking', 'Cancel Paya'),
                self::FARABOOM_REPORT_SATNA_TRANSFER => Yii::t('openBanking', 'Report Satna Transfer'),
                self::FARABOOM_BATCH_SATNA => Yii::t('openBanking', 'Batch Satna'),
                self::FARABOOM_INTERNAL_TRANSFER => Yii::t('openBanking', ' Internal Transfer'),
                self::FARABOOM_BATCH_INTERNAL_TRANSFER => Yii::t('openBanking', 'Batch Internal Transfer'),
                self::FARABOOM_DEPOSITS => Yii::t('openBanking', 'Deposits'),
            ],
            'ServiceUrl' => [
                self::FARABOOM_GET_TOKEN => self::FARABOOM_BASE_URL . '',
                self::FARABOOM_DEPOSIT_TO_SHABA => self::FARABOOM_BASE_URL . 'deposits',
                self::FARABOOM_SHABA_TO_DEPOSIT => self::FARABOOM_BASE_URL . '',
                self::FARABOOM_MATCH_NATIONAL_CODE_ACCOUNT => self::FARABOOM_BASE_URL . '',
                self::FARABOOM_DEPOSIT_HOLDER => self::FARABOOM_BASE_URL . '',
                self::FARABOOM_PAYA => self::FARABOOM_BASE_URL . '',
                self::FARABOOM_SATNA => self::FARABOOM_BASE_URL . '',
                self::FARABOOM_CHECK_INQUIRY_RECEIVER => self::FARABOOM_BASE_URL . '',
                self::FARABOOM_SHABA_INQUIRY => self::FARABOOM_BASE_URL . '',
                self::FARABOOM_MATCH_NATIONAL_CODE_MOBILE => self::FARABOOM_BASE_URL . '',
                self::FARABOOM_CART_TO_SHABA => self::FARABOOM_BASE_URL . '',
                self::FARABOOM_BATCH_PAYA => self::FARABOOM_BASE_URL . '',
                self::FARABOOM_REPORT_PAYA_TRANSACTIONS => self::FARABOOM_BASE_URL . '',
                self::FARABOOM_PAYA_TRANSFER => self::FARABOOM_BASE_URL . '',
                self::FARABOOM_CANCLE_PAYA => self::FARABOOM_BASE_URL . '',
                self::FARABOOM_REPORT_SATNA_TRANSFER => self::FARABOOM_BASE_URL . '',
                self::FARABOOM_BATCH_SATNA => self::FARABOOM_BASE_URL . '',
                self::FARABOOM_INTERNAL_TRANSFER => self::FARABOOM_BASE_URL . '',
                self::FARABOOM_BATCH_INTERNAL_TRANSFER => self::FARABOOM_BASE_URL . '',
                self::FARABOOM_DEPOSITS => self::FARABOOM_BASE_URL . '',
            ],
        ];

        if (isset($code))
            return $_items[$type][$code] ?? false;
        else
            return $_items[$type] ?? false;
    }

    public static function getUrl($service)
    {
        return self::itemAlias('ServiceUrl', $service);
    }

}


