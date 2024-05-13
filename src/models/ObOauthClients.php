<?php

namespace sadi01\openbanking\models;

use Yii;
use common\behaviors\Jsonable;

/**
 * This is the model class for table "{{%ob_oauth_clients}}".
 *
 * @property int $id
 * @property string $client_id
 * @property string $base_url
 * @property string|null $client_secret
 * @property string $grant_types
 * @property string|null $scope
 * @property string $provider
 * @property string|null $username
 * @property string|null $password
 * @property string|null $add_on
 *
 * @mixin Jsonable;
 */
class ObOauthClients extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;

    const SCENARIO_DELETE = 'delete';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ob_oauth_clients}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'base_url', 'grant_types', 'provider'], 'required'],
            [['add_on'], 'safe'],
            [['client_id', 'client_secret', 'provider'], 'string', 'max' => 32],
            [['base_url'], 'string', 'max' => 255],
            [['grant_types', 'username'], 'string', 'max' => 100],
            [['scope', 'password'], 'string', 'max' => 2000],
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
            'client_id' => Yii::t('openBanking', 'Client ID'),
            'base_url' => Yii::t('openBanking', 'Base Url'),
            'client_secret' => Yii::t('openBanking', 'Client Secret'),
            'grant_types' => Yii::t('openBanking', 'Grant Types'),
            'scope' => Yii::t('openBanking', 'Scope'),
            'provider' => Yii::t('openBanking', 'Provider'),
            'username' => Yii::t('openBanking', 'Username'),
            'password' => Yii::t('openBanking', 'Password'),
            'add_on' => Yii::t('openBanking', 'Add On'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ObOauthClientsQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new ObOauthClientsQuery(get_called_class());
        return $query;
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