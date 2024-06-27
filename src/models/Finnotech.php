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
    public $destination_firstname;
    public $destination_lastname;
    public $destination_number;
    public $payment_number;
    public $reason_description;
    public $deposit;
    public $source_firstname;
    public $source_lastname;
    public $second_password;
    public $customer_ref;
    public $note;
    public $iban;
    public $sayad_id;
    public $bank_code;
    public $merchant_name;
    public $merchant_iban;

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
    const SCOPE_FACILITY_SHAHKAR = 'facility:shahkar:get'; //استعلام پیامکی تسهیلات


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
            [['amount','description','destination_firstname','destination_lastname','destination_number'
                ,'payment_number','reason_description','deposit','source_firstname','source_lastname','second_password'], 'required', 'on' => [self::SCENARIO_TRANSFER]],
            [['destination_number','amount','description','reason_description','payment_number'
                ,'destination_firstname','destination_lastname','customer_ref'], 'required', 'on' => [self::SCENARIO_PAYA_TRANSFER]],
            [['amount','description','destination_firstname','destination_lastname','destination_number'
                ,'payment_number','customer_ref','deposit','source_firstname','source_lastname','reason_description','note'], 'required', 'on' => [self::SCENARIO_INTERNAL_TRANSFER]],
            [['iban'], 'required', 'on' => [self::SCENARIO_SHABA_INQUIRY]],
            [['card','version'], 'required', 'on' => [self::SCENARIO_CARD_TO_SHABA]],
            [['card'], 'required', 'on' => [self::SCENARIO_CARD_TO_DEPOSIT]],
            [['card'], 'required', 'on' => [self::SCENARIO_CARD_INFO]],
            [['sayad_id'], 'required', 'on' => [self::SCENARIO_CHECK_INQUIRY]],
            [['mobile','national_code'], 'required', 'on' => [self::SCENARIO_MATCH_MOBILE_NID]],
            [['users','birth_date','full_name','first_name','last_name','father_name','gender'], 'required', 'on' => [self::SCENARIO_NID_VERIFICATION]],
            [['deposit','bank_code'], 'required', 'on' => [self::SCENARIO_DEPOSIT_TO_SHABA]],
            [['merchant_name','merchant_iban'],'string'],
            [['merchant_iban'], 'match', 'pattern' => '/^(?:IR)(?=.{24}$)[0-9]*$/'],


        ];
    }


    public function attributeLabels()
    {
        return [
            'track_id' => Yii::t('openBanking', 'شماره پیگیری'),
            'amount' => Yii::t('openBanking', 'Amount'),
            'description' => Yii::t('openBanking', 'Description'),
            'destination_firstname' => Yii::t('openBanking', 'Destination First Name'),
            'destination_number' => Yii::t('openBanking', 'Destination Number'),
            'destination_lastname' => Yii::t('openBanking', 'Destination Last Name'),
            'payment_number' => Yii::t('openBanking', 'Payment Number'),
            'reason_description' => Yii::t('openBanking', 'Reason Description'),
            'deposit' => Yii::t('openBanking', 'Deposit'),
            'source_firstname' => Yii::t('openBanking', 'Source First Name'),
            'source_lastname' => Yii::t('openBanking', 'Source Last Name'),
            'second_password' => Yii::t('openBanking', 'Second Password'),
            'merchant_name' => Yii::t('openBanking', 'Merchant Name'),
            'merchant_iban' => Yii::t('openBanking', 'Merchant Iban'),
            'customer_ref' => Yii::t('openBanking', 'Customer Ref'),
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
            'national_code' => Yii::t('openBanking', 'National Code'),
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();

        $scenarios[self::SCENARIO_TRANSFER] = ['slave_id', 'track_id', 'amount','description','destination_firstname','destination_lastname',
            'destination_number','payment_number','deposit','source_firstname','source_lastname','second_password','reason_description','merchant_name','merchant_iban','client_id'];
        $scenarios[self::SCENARIO_PAYA_TRANSFER] = ['slave_id', 'track_id', 'destination_number','amount','description','reason_description',
            'payment_number','destination_firstname','destination_lastname','customer_ref','client_id'];
        $scenarios[self::SCENARIO_INTERNAL_TRANSFER] = ['slave_id', 'track_id', 'amount','description','destination_firstname','destination_lastname',
            'destination_number','payment_number','customer_ref','deposit','source_firstname','source_lastname','reason_description','note','client_id'];
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
