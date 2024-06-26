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

    public $card;
    public $version;
    public $users;
    public $birth_date;
    public $full_name;
    public $first_name;
    public $last_name;
    public $father_name;
    public $gender;
    public $mobile;
    public $national_code;


    const AYANDEH_BANK_CODE = '062';
    const SCOPE_TRANSFER_TO = 'oak:transfer-to:execute';
    const SCOPE_IBAN_INQUIRY_GET = 'oak:iban-inquiry:get'; //استعلام شماره شبا
    const SCOPE_SAYAD_CHEQUE_INQUIRY = 'credit:sms-sayady-cheque-inquiry:get'; //استعلام چک صیادی
    const SCOPE_FACILITY_NID_VERIFICATION = 'facility:sms-nid-verification:get'; //احراز هویت
    const SCOPE_SAYAD_ACCEPT_CHEQUE = 'credit:sms-sayad-accept-cheque:post'; //تایید چک صیاد توسط گیرنده
    const SCOPE_SMS_BACK_CHEQUES = 'credit:sms-back-cheques:get'; //استعلام پیامکی چک برگشتی
    const SCOPE_SMS_DEBTS = 'credit:sms-facility-inquiry:get'; //استعلام پیامکی تسهیلات


    const SCENARIO_TRANSFER = 'transfer';
    const SCENARIO_PAYA_TRANSFER = 'paya-transfer';
    const SCENARIO_INTERNAL_TRANSFER = 'internal-transfer';
    const SCENARIO_SHABA_INQUIRY = 'shaba-inquiry';
    const SCENARIO_CHECK_INQUIRY = 'check-inquiry';
    const SCENARIO_DEPOSIT_TO_SHABA = 'deposit_to_shaba';
    const SCENARIO_BANKS_INFO = 'banks_info';
    const SCENARIO_CARD_TO_DEPOSIT = 'card-to-deposit';
    const SCENARIO_CARD_TO_SHABA = 'card-to-shaba';
    const SCENARIO_NID_VERIFICATION = 'nid-verification';
    const SCENARIO_MATCH_MOBILE_NID = 'match_mobile_nid';
    const SCENARIO_CARD_INFO = 'card_info';

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
            [['card','version'], 'required', 'on' => [self::SCENARIO_CARD_TO_SHABA]],
            [['card'], 'required', 'on' => [self::SCENARIO_CARD_TO_DEPOSIT]],
            [['card'], 'required', 'on' => [self::SCENARIO_CARD_INFO]],
            [['sayad_id'], 'required', 'on' => [self::SCENARIO_CHECK_INQUIRY]],
            [['mobile','national_code'], 'required', 'on' => [self::SCENARIO_MATCH_MOBILE_NID]],
            [['users','birth_date','full_name','first_name','last_name','father_name','gender'], 'required', 'on' => [self::SCENARIO_NID_VERIFICATION]],
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
            'card' => Yii::t('openBanking', 'Card'),
            'version' => Yii::t('openBanking', 'Version'),
            'birthDate' => Yii::t('openBanking', 'Birth Date'),
            'fullName' => Yii::t('openBanking', 'Full Name'),
            'firstName' => Yii::t('openBanking', 'First Name'),
            'lastName' => Yii::t('openBanking', 'Last Name'),
            'fatherName' => Yii::t('openBanking', 'Father Name'),
            'gender' => Yii::t('openBanking', 'Gender'),
            'mobile' => Yii::t('openBanking', 'Mobile'),
            'nationalCode' => Yii::t('openBanking', 'National Code'),
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_TRANSFER] = ['slave_id', 'track_id', 'amount','description','destinationFirstname','destinationLastname',
            'destinationNumber','paymentNumber','deposit','sourceFirstName','sourceLastName','secondPassword','reasonDescription','merchantName','merchantIban','client_id'];
        $scenarios[self::SCENARIO_PAYA_TRANSFER] = ['slave_id', 'track_id', 'destinationNumber','amount','description','reasonDescription',
            'paymentNumber','destinationFirstname','destinationLastname','customerRef','client_id'];
        $scenarios[self::SCENARIO_INTERNAL_TRANSFER] = ['slave_id', 'track_id', 'amount','description','destinationFirstname','destinationLastname',
            'destinationNumber','paymentNumber','customerRef','deposit','sourceFirstName','sourceLastName','reasonDescription','note','client_id'];
        $scenarios[self::SCENARIO_SHABA_INQUIRY] = ['slave_id', 'track_id','client_id','iban'];
        $scenarios[self::SCENARIO_DEPOSIT_TO_SHABA] = ['slave_id', 'track_id','client_id','deposit','bank_code'];
        $scenarios[self::SCENARIO_CHECK_INQUIRY] = ['sayad_id'];
        $scenarios[self::SCENARIO_BANKS_INFO] = ['client_id','track_id'];
        $scenarios[self::SCENARIO_CARD_TO_DEPOSIT] = ['client_id','track_id','card'];
        $scenarios[self::SCENARIO_CARD_TO_SHABA] = ['client_id','track_id','card','version'];
        $scenarios[self::SCENARIO_NID_VERIFICATION] = ['client_id','track_id','users','birth_date','full_name','last_name','first_name','father_name','gender'];
        $scenarios[self::SCENARIO_MATCH_MOBILE_NID] = ['client_id','track_id','mobile','national_code'];
        $scenarios[self::SCENARIO_CARD_INFO] = ['client_id','track_id','card'];


        return $scenarios;
    }


}
