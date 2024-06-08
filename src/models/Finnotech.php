<?php
namespace sadi01\openbanking\models;
use Yii;
use yii\base\Model;

class Finnotech extends Model
{
    public $track_id;
    public $slave_id;

    const SCENARIO_TRANSFER = 'transfer';

    public  function rules()
    {
        return [
            [['slave_id', 'track_id'], 'required'],
            [['amount','description','destinationFirstname','destinationLastname','destinationNumber'
                ,'paymentNumber','reasonDescription','deposit','sourceFirstName','sourceLastName','secondPassword'], 'required', 'on' => [self::SCENARIO_TRANSFER]],
            [['merchantName','merchantIban'],'string'],
            [['merchantIban'], 'match', 'pattern' => '/^(?:IR)(?=.{24}$)[0-9]*$/'],


        ];
    }


    public function attributeLabels()
    {
        return [
            'track_id' => Yii::t('openBanking', 'شماره پیگیری'),
            'amount' => Yii::t('openBanking', 'Amount'),
            'description' => Yii::t('openBanking', 'Description'),
            'destinationFirstname' => Yii::t('openBanking', 'Destination First Name'),
            'destinationNumber' => Yii::t('openBanking', 'Destination Number'),
            'destinationLastname' => Yii::t('openBanking', 'Destination Last Name'),
            'paymentNumber' => Yii::t('openBanking', 'Payment Number'),
            'reasonDescription' => Yii::t('openBanking', 'Reason Description'),
            'deposit' => Yii::t('openBanking', 'Deposit'),
            'sourceFirstName' => Yii::t('openBanking', 'Source First Name'),
            'sourceLastName' => Yii::t('openBanking', 'Source Last Name'),
            'secondPassword' => Yii::t('openBanking', 'Second Password'),
            'merchantName' => Yii::t('openBanking', 'Merchant Name'),
            'merchantIban' => Yii::t('openBanking', 'Merchant Iban'),
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_TRANSFER] = ['slave_id', 'track_id', 'amount','description','destinationFirstname','destinationLastname',
            'destinationNumber','paymentNumber','reasonDescription','deposit','sourceFirstName','sourceLastName','secondPassword','reasonDescription','merchantName','merchantIban'];


        return $scenarios;
    }


}
