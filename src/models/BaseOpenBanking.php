<?php

namespace sadi01\openbanking\models;


class BaseOpenBanking extends \yii\db\ActiveRecord
{
    public $platform;
    public $service;
    public $object;


    const PLATFORM_FARABOOM = 1;
    const PLATFORM_FINNOTECH = 2;

    const FARABOOM_DEPOSIT_TO_SHABA = 1;
    const FARABOOM_SHABA_TO_DEPOSIT = 2;
    const FARABOOM_MATCH_NATIONAL_CODE_ACCOUNT = 3;
    const FARABOOM_DEPOSIT_HOLDER = 4;
    const FARABOOM_PAYA = 5;
    const FARABOOM_SATNA = 6;
    const FARABOOM_CHECK_INQUIRY_RECEIVER = 7;
    const FARABOOM_SHABA_INQUIRY = 8;
    const FARABOOM_MATCH_NATIONAL_CODE_MOBILE = 9;
    const FARABOOM_CART_TO_SHABA = 10;
    const FARABOOM_BATCH_PAYA = 11;
    const FARABOOM_REPORT_PAYA_TRANSACTIONS = 12;
    const FARABOOM_PAYA_TRANSFER = 13;
    const FARABOOM_CANCLE_PAYA = 14;
    const FARABOOM_REPORT_SATNA_TRANSFER = 15;
    const FARABOOM_BATCH_SATNA = 16;
    const FARABOOM_INTERNAL_TRANSFER = 17;
    const FARABOOM_BATCH_INTERNAL_TRANSFER = 18;
    const FARABOOM_DEPOSITS = 19;



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
                self::FARABOOM_DEPOSIT_TO_SHABA => Yii::t('openBanking', 'Service Deposit To Shaba'),
                self::FARABOOM_SHABA_TO_DEPOSIT => Yii::t('openBanking', 'Service Shaba To Deposit'),
                self::FARABOOM_MATCH_NATIONAL_CODE_ACCOUNT => Yii::t('openBanking', 'Service Match National Code Account'),
                self::FARABOOM_DEPOSIT_HOLDER => Yii::t('openBanking', 'Service Deposit Holder'),
                self::FARABOOM_PAYA => Yii::t('openBanking', 'Service Paya'),
                self::FARABOOM_SATNA => Yii::t('openBanking', 'Service Satna'),
                self::FARABOOM_CHECK_INQUIRY_RECEIVER => Yii::t('openBanking', 'Service Check Inquery Receiver'),
                self::FARABOOM_SHABA_INQUIRY => Yii::t('openBanking', 'Service Shaba Inquiry'),
                self::FARABOOM_MATCH_NATIONAL_CODE_MOBILE => Yii::t('openBanking', 'Service Match National Code Mobile'),
                self::FARABOOM_CART_TO_SHABA => Yii::t('openBanking', 'Service Cart To Shaba'),
                self::FARABOOM_BATCH_PAYA => Yii::t('openBanking', 'Service Batch Paya'),
                self::FARABOOM_REPORT_PAYA_TRANSACTIONS => Yii::t('openBanking', 'Service Report Paya Transactions'),
                self::FARABOOM_PAYA_TRANSFER => Yii::t('openBanking', 'Service Paya Transfer'),
                self::FARABOOM_CANCLE_PAYA => Yii::t('openBanking', 'Service Cancel Paya'),
                self::FARABOOM_REPORT_SATNA_TRANSFER => Yii::t('openBanking', 'Service Report Satna Transfer'),
                self::FARABOOM_BATCH_SATNA => Yii::t('openBanking', 'Service Batch Satna'),
                self::FARABOOM_INTERNAL_TRANSFER => Yii::t('openBanking', ' Internal Transfer'),
                self::FARABOOM_BATCH_INTERNAL_TRANSFER => Yii::t('openBanking', 'Batch Internal Transfer'),
                self::FARABOOM_DEPOSITS => Yii::t('openBanking', 'Deposits'),
            ],
        ];

        if (isset($code))
            return $_items[$type][$code] ?? false;
        else
            return $_items[$type] ?? false;
    }

}


