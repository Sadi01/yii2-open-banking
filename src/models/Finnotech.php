<?php
namespace sadi01\openbanking\models;
use Yii;
use yii\base\Model;

class Finnotech extends Model
{
    public $track_id;
    public $slave_id;
    public $client_id;
    public $amount;
    public $description;
    public $destinationFirstname;
    public $destinationLastname;
    public $destinationNumber;
    public $paymentNumber;
    public $reasonDescription;
    public $deposit;
    public $sourceFirstName;
    public $sourceLastName;
    public $secondPassword;
    public $customerRef;
    public $note;
    public $iban;
    public $sayad_id;
    public $bank_code;
    public $merchantName;
    public $merchantIban;


    const SCENARIO_TRANSFER = 'transfer';
    const SCENARIO_PAYA_TRANSFER = 'paya-transfer';
    const SCENARIO_INTERNAL_TRANSFER = 'internal-transfer';
    const SCENARIO_SHABA_INQUIRY = 'shaba-inquiry';
    const SCENARIO_CHECK_INQUIRY = 'check-inquiry';
    const SCENARIO_DEPOSIT_TO_SHABA = 'deposit_to_shaba';

    public  function rules()
    {
        return [
            [['slave_id', 'track_id','client_id'], 'required'],
            [['amount','description','destinationFirstname','destinationLastname','destinationNumber'
                ,'paymentNumber','reasonDescription','deposit','sourceFirstName','sourceLastName','secondPassword'], 'required', 'on' => [self::SCENARIO_TRANSFER]],
            [['destinationNumber','amount','description','reasonDescription','paymentNumber'
                ,'destinationFirstname','destinationLastname','customerRef'], 'required', 'on' => [self::SCENARIO_PAYA_TRANSFER]],
            [['amount','description','destinationFirstname','destinationLastname','destinationNumber'
                ,'paymentNumber','customerRef','deposit','sourceFirstName','sourceLastName','reasonDescription','note'], 'required', 'on' => [self::SCENARIO_INTERNAL_TRANSFER]],
            [['iban'], 'required', 'on' => [self::SCENARIO_SHABA_INQUIRY]],
            [['sayad_id'], 'required', 'on' => [self::SCENARIO_CHECK_INQUIRY]],
            [['deposit','bank_code'], 'required', 'on' => [self::SCENARIO_DEPOSIT_TO_SHABA]],
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
            'customerRef' => Yii::t('openBanking', 'Customer Ref'),
            'note' => Yii::t('openBanking', 'Note'),
            'iban' => Yii::t('openBanking', 'Iban'),
            'bankCode' => Yii::t('openBanking', 'Bank Code'),
            'merchantIban' => Yii::t('openBanking', 'Merchant Iban'),
            'merchantIban' => Yii::t('openBanking', 'Merchant Iban'),
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_TRANSFER] = ['slave_id', 'track_id', 'amount','description','destinationFirstname','destinationLastname',
            'destinationNumber','paymentNumber','reasonDescription','deposit','sourceFirstName','sourceLastName','secondPassword','reasonDescription','merchantName','merchantIban','client_id'];
        $scenarios[self::SCENARIO_PAYA_TRANSFER] = ['slave_id', 'track_id', 'destinationNumber','amount','description','reasonDescription',
            'paymentNumber','destinationFirstname','destinationLastname','customerRef','client_id'];
        $scenarios[self::SCENARIO_INTERNAL_TRANSFER] = ['slave_id', 'track_id', 'amount','description','destinationFirstname','destinationLastname',
            'destinationNumber','paymentNumber','customerRef','deposit','sourceFirstName','sourceLastName','reasonDescription','note','client_id'];
        $scenarios[self::SCENARIO_SHABA_INQUIRY] = ['slave_id', 'track_id','client_id','iban'];
        $scenarios[self::SCENARIO_DEPOSIT_TO_SHABA] = ['slave_id', 'track_id','client_id','deposit','bank_code'];
        $scenarios[self::SCENARIO_CHECK_INQUIRY] = ['sayad_id'];


        return $scenarios;
    }


}
