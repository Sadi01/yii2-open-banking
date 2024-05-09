<?php

namespace sadi01\openbanking\models;


class BaseOpenBanking extends \yii\db\ActiveRecord
{

    public $platform;
    public $service;
    public $object;


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
            'platform' => Yii::t('message', 'Platform'),
            'service' => Yii::t('message', 'Servive'),
            'object' => Yii::t('message', 'Object'),
        ];


    }

}


