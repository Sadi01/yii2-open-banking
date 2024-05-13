<?php

namespace sadi01\openbanking\models;

use Yii;
    use common\behaviors\Jsonable;

/**
* This is the model class for table "{{%ob_oauth_access_tokens}}".
*
    * @property int $id
    * @property string $access_token
    * @property string $client_id
    * @property string $expires
    * @property string|null $scope
    * @property string|null $ad_on
    *
        * @mixin Jsonable;
*/
class ObOauthAccessTokens extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;

    const SCENARIO_DELETE = 'delete';

/**
* {@inheritdoc}
*/
public static function tableName()
{
return '{{%ob_oauth_access_tokens}}';
}

/**
* {@inheritdoc}
*/
public function rules()
{
return [
            [['access_token', 'client_id'], 'required'],
            [['expires', 'ad_on'], 'safe'],
            [['access_token'], 'string', 'max' => 2048],
            [['client_id'], 'string', 'max' => 32],
            [['scope'], 'string', 'max' => 2000],
        ];
}

    public function scenarios()
    {
    $scenarios = parent::scenarios();
    $scenarios[self::SCENARIO_DELETE] = ['!status'];

    return $scenarios;
    }

/**
* {@inheritdoc}
*/
public function attributeLabels()
{
return [
    'id' => Yii::t('openBanking', 'ID'),
    'access_token' => Yii::t('openBanking', 'Access Token'),
    'client_id' => Yii::t('openBanking', 'Client ID'),
    'expires' => Yii::t('openBanking', 'Expires'),
    'scope' => Yii::t('openBanking', 'Scope'),
    'ad_on' => Yii::t('openBanking', 'Ad On'),
];
}
    
    /**
    * {@inheritdoc}
    * @return ObOauthAccessTokensQuery the active query used by this AR class.
    */
    public static function find()
    {
            $query = new ObOauthAccessTokensQuery(get_called_class());
        return $query->active();
        }

    public static function itemAlias($type, $code = NULL)
    {
    $_items = [
    'Status' => [
    self::STATUS_ACTIVE => Yii::t('openBanking', 'Active'),
    self::STATUS_DELETED => Yii::t('openBanking', 'Deleted')
    ],
    'StatusClass' => [
    self::STATUS_ACTIVE => 'success',
    self::STATUS_DELETED => 'danger'
    ],
    'StatusColor' => [
    self::STATUS_ACTIVE => '#23a665',
    self::STATUS_DELETED => '#ff5050',
    ],
    ];

    if (isset($code))
    return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
    else
    return isset($_items[$type]) ? $_items[$type] : false;
    }

    public function behaviors()
    {
    return array_merge(parent::behaviors(), [
                    'Jsonable' => [
        'class' => Jsonable::class,
        'jsonAttributes' => [
        'add_on' => [
        // Your json attributes
        ],
        ],
        ],
                ]);
    }

    /**
    * @return string[]
    */
    public function fields(): array
    {
    $fields = [
    'id',
    ];

    return $fields;
    }

    /**
    * @return string[]
    */
    public function extraFields(): array
    {
    $extraFields = [

    ];

    return $extraFields;
    }
}