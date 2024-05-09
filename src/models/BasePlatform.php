<?php
namespace sadi01\openbanking\models;

class BasePlatform extends \yii\db\ActiveRecord
{

    const PROVIDER_FINNOTECH = 1;
    const PROVIDER_FARABOOM = 2;
    const PROVIDER_SHAHIN = 3;
    const PROVIDER_SHAHKAR = 4;

    public $id;
    public $name;
    public $base_url;
    public $api_key;
    public $file;



    public function rules()
    {
        return [
            [['name', 'base_url','api_key','provider'], 'required'],
            [['name', 'base_url','api_key'], 'string'],
            [['provider'],'in', 'range' => array_keys(self::itemAlias('Provider'))],
            [['file'],'file'],

        ];


    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('main', 'ID'),
            'name' => Yii::t('main', 'Name'),
            'base_url' => Yii::t('main', 'Base Url'),
            'api_key' => Yii::t('main', 'Api Key'),
            'file' => Yii::t('main', 'File'),
            'provider' => Yii::t('main', 'Provider'),
        ];


    }


    public static function itemAlias($type, $code = NULL)
    {
        $_items = [
            'Provider' => [
                self::PROVIDER_FINNOTECH => Yii::t('main', 'Finnotech'),
                self::PROVIDER_FARABOOM=> Yii::t('main', 'Faraboom'),
                self::PROVIDER_SHAHIN=> Yii::t('main', 'Shahin'),
                self::PROVIDER_SHAHKAR=> Yii::t('main', 'Shahkar')
            ],
        ];

        if (isset($code))
            return $_items[$type][$code] ?? false;
        else
            return $_items[$type] ?? false;
    }

}
