<?php

namespace sadi01\openbanking\models;

use common\models\User;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;


/**
 * This is the model class for table "{{%ob_request_log}}".
 *
 * @property int $id
 * @property int $client_id
 * @property int $service_type
 * @property int $status
 * @property string|null $message
 * @property string|null $transaction_id
 * @property string $data
 * @property string $url
 * @property string $response
 * @property string $method
 * @property string $headers
 * @property int $created_at
 * @property int $created_by
 *
 * @property User $createdBy
 * @mixin TimestampBehavior
 * @mixin BlameableBehavior;
 */
class ObRequestLog extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 0;

    const SERVICE_DEPOSIT_TO_SHABA = 1;
    const SERVICE_SHABA_TO_DEPOSIT = 2;
    const SERVICE_MATCH_NATIONAL_CODE_ACCOUNT = 3;
    const SERVICE_DEPOSIT_HOLDER = 4;
    const SERVICE_PAYA = 5;
    const SERVICE_SATNA = 6;
    const SERVICE_CHECK_INQUIRY_RECEIVER = 7;
    const SERVICE_SHABA_INQUIRY = 8;
    const SERVICE_MATCH_NATIONAL_CODE_MOBILE = 9;
    const SERVICE_CART_TO_SHABA = 10;
    const SERVICE_BATCH_PAYA = 11;
    const SERVICE_REPORT_PAYA_TRANSACTIONS = 12;
    const SERVICE_PAYA_TRANSFER = 13;
    const SERVICE_CANCLE_PAYA = 14;
    const SERVICE_REPORT_SATNA_TRANSFER = 15;
    const SERVICE_BATCH_SATNA = 16;
    const SERVICE_INTERNAL_TRANSFER = 17;
    const SERVICE_BATCH_INTERNAL_TRANSFER = 18;
    const SERVICE_DEPOSITS = 19;

    const SCENARIO_DELETE = 'delete';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ob_request_log}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'service_type', 'status', 'data', 'response', 'url','method','headers'], 'required'],
            [['client_id', 'service_type', 'status', 'created_at', 'created_by'], 'integer'],
            [['message'], 'string', 'max' => 100],
            [['data','headers'], 'string', 'max' => 1000],
            [['response'], 'string', 'max' => 3000],
            [['method'], 'string', 'max' => 5],
            [['url'], 'string', 'max' => 255],
            [['transaction_id'], 'string', 'max' => 30],
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
            'service_type' => Yii::t('openBanking', 'Service Type'),
            'status' => Yii::t('openBanking', 'Status'),
            'message' => Yii::t('openBanking', 'Message'),
            'transaction_id' => Yii::t('openBanking', 'Transaction ID'),
            'url' => Yii::t('openBanking', 'Url'),
            'data' => Yii::t('openBanking', 'Data'),
            'method' => Yii::t('openBanking', 'Method'),
            'headers' => Yii::t('openBanking', 'Headers'),
            'response' => Yii::t('openBanking', 'Response'),
            'created_at' => Yii::t('openBanking', 'Created At'),
            'created_by' => Yii::t('openBanking', 'Created By'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ObRequestLogQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new ObRequestLogQuery(get_called_class());
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
            'ServiceType' => [
                self::SERVICE_DEPOSIT_TO_SHABA => Yii::t('openBanking', 'Service Deposit To Shaba'),
                self::SERVICE_SHABA_TO_DEPOSIT => Yii::t('openBanking', 'Service Shaba To Deposit'),
                self::SERVICE_MATCH_NATIONAL_CODE_ACCOUNT => Yii::t('openBanking', 'Service Match National Code Account'),
                self::SERVICE_DEPOSIT_HOLDER => Yii::t('openBanking', 'Service Deposit Holder'),
                self::SERVICE_PAYA => Yii::t('openBanking', 'Service Paya'),
                self::SERVICE_SATNA => Yii::t('openBanking', 'Service Satna'),
                self::SERVICE_CHECK_INQUIRY_RECEIVER => Yii::t('openBanking', 'Service Check Inquery Receiver'),
                self::SERVICE_SHABA_INQUIRY => Yii::t('openBanking', 'Service Shaba Inquiry'),
                self::SERVICE_MATCH_NATIONAL_CODE_MOBILE => Yii::t('openBanking', 'Service Match National Code Mobile'),
                self::SERVICE_CART_TO_SHABA => Yii::t('openBanking', 'Service Cart To Shaba'),
                self::SERVICE_BATCH_PAYA => Yii::t('openBanking', 'Service Batch Paya'),
                self::SERVICE_REPORT_PAYA_TRANSACTIONS => Yii::t('openBanking', 'Service Report Paya Transactions'),
                self::SERVICE_PAYA_TRANSFER => Yii::t('openBanking', 'Service Paya Transfer'),
                self::SERVICE_CANCLE_PAYA => Yii::t('openBanking', 'Service Cancel Paya'),
                self::SERVICE_REPORT_SATNA_TRANSFER => Yii::t('openBanking', 'Service Report Satna Transfer'),
                self::SERVICE_BATCH_SATNA => Yii::t('openBanking', 'Service Batch Satna'),

            ],
        ];

        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);

    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'TimestampBehavior' => [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
                //'value' => new Expression('NOW()'),
            ],
            'BlameableBehavior' => [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => false
                //'value' => Yii::$app->user->id,
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