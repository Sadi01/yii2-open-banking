How To Use Faraboom Services
-------------
add to your code:

```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_TRANSFER['clientId' => your client id,'trackId' => your track id])
```
Available Faraboom Services:
-------------

depositToShaba(تبدیل شماره حساب به شماره شبا)
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <td>BaseOpenBanking::PLATFORM_FINNOTECH</td>
    <td>پلتفرم</td>
  </tr>
  <tr>
    <th>service</th>
    <td>BaseOpenBanking::FINNOTECH_TRANSFER</td>
    <td>سرویس انتقال وجه</td>
  </tr>
  <tr>
    <th rowspan="14">data</th>
  </tr>
  <tr>
    <td>*amount</td>
    <td>مبلغ انتقال وجه</td>
  </tr>
  <tr>
    <td>*description</td>
    <td>شرح انتقال وجه</td>
  </tr>
  <tr>
    <td>*destinationFirstname</td>
    <td>نام صاحب حساب مقصد</td>
  </tr>
 <tr>
    <td>*destinationLastname</td>
    <td>نام خانوادگی صاحب حساب مقصد</td>
  </tr>
 <tr>
    <td>*destinationNumber</td>
    <td>شماره حساب مقصد</td>
  </tr>
 <tr>
    <td>*paymentNumber</td>
    <td>شناسه پرداخت</td>
  </tr>
 <tr>
    <td>*reasonDescription</td>
    <td>بابت</td>
  </tr>
 <tr>
    <td>*deposit</td>
    <td>شماره حساب مبدا</td>
  </tr>
 <tr>
    <td>*sourceFirstName</td>
    <td>نام صاحب حساب مبدا</td>
  </tr>
 <tr>
    <td>*sourceLastName</td>
    <td>نام خانوادگی صاحب حساب مبدا</td>
  </tr>
 <tr>
    <td>*secondPassword</td>
    <td>رمز انتقال وجه</td>
  </tr>
 <tr>
    <td>*merchantName</td>
    <td>نام پذیرنده</td>
  </tr>
 <tr>
    <td>*merchantIban</td>
    <td>شماره شبا پذیرنده</td>
  </tr>
<tr>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_PAYA_TRANSAFER,['clientId' => your client id,'trackId' => your track id])
```

payaTransfer
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
 <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_PAYA_TRANSFER</th>
 <th>سرویس پرداخت واریز پایا</th>

  </tr>
  <tr>
    <td rowspan="9">data</td>
  </tr>
  <tr>
    <td>*destinationNumber</td>
    <td>شماره شبای بانک مقصد</td>
  </tr>
  <tr>
    <td>*amount</td>
    <td>مبلغ انتقال وجه</td>
  </tr>
  <tr>
    <td>*description</td>
    <td>شرح انتقال وجه</td>
  </tr>
 <tr>
    <td>*reasonDescription</td>
    <td>اطلاعات بیشتر</td>
  </tr>
 <tr>
    <td>*paymentNumber</td>
    <td>شناسه پرداخت</td>
  </tr>
 <tr>
    <td>*destinationFirstname</td>
    <td>نام صاحب حساب مقصد</td>
  </tr>
 <tr>
    <td>*destinationLastname</td>
    <td>نام خانوادگی صاحب حساب مقصد</td>
  </tr>
 <tr>
    <td>*customerRef</td>
    <td>شناسه ارجاع</td>
  </tr>
<tr>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_INTERNAL_TRANSFER,['clientId' => your client id,'trackId' => your track id])
```

internalTransfer
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
 <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_INTERNAL_TRANSFER</th>
 <th>دستور پرداخت واریز داخلی</th>
  </tr>
  <tr>
    <td rowspan="13">data</td>
  </tr>
<tr>
    <td>*amount</td>
    <td>مبلغ تراکنش</td>
  </tr>
  <tr>
    <td>*description</td>
    <td>شرح تراکنش</td>
  </tr>
  <tr>
    <td>*destinationNumber</td>
 <td>شماره شبا مقصد</td>
  </tr>
 <tr>
    <td>*paymentNumber</td>
 <td>شناسه پرداخت</td>
  </tr>
 <tr>
    <td>*customerRef</td>
 <td>شماره مرجع تراکنش که توسط کاربر وارد می شود</td>
  </tr>
 <tr>
    <td>*sourceFirstName</td>
 <td>نام صاحب حساب مبدا</td>
  </tr>
 <tr>
    <td>*sourceLastName</td>
 <td>نام خانوادگی صاحب حساب مبدا</td>
  </tr>
 <tr>
    <td>*reasonDescription</td>
 <td>دلیل تراکنش</td>
  </tr>
 <tr>
    <td>*note</td>
 <td>شناسه پرداخت</td>
  </tr>
 <tr>
    <td>destinationFirstname</td>
 <td>نام صاحب حساب مقصد</td>
  </tr>
 <tr>
    <td>destinationLastname</td>
 <td>نام خانوادگی صاحب حساب مقصد</td>
  </tr>
 <tr>
    <td>deposit</td>
 <td>شماره حساب مبدا</td>
  </tr>
<tr>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_SHABA_INQUIRY,['clientId' => your client id,'trackId' => your track id])
```

shabaInquiry:
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
<th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_SHABA_INQUIRY</th>
 <th>اطلاعات شماره شبا</th>
  </tr>
  <tr>
    <td rowspan="3">data</td>
  </tr>
  <tr>
    <td>*iban</td>
    <td>شماره شبا</td>
  </tr>
<tr>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_DEPOSIT_TO_SHABA,['clientId' => your client id,'trackId' => your track id,'deposit' =>your deposit,'bank_code' => your bank code])
```

depositToShaba
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_DEPOSIT_TO_SHABA</th>
    <th>تبدیل شماره حساب به شبا</th>
  </tr>
  <tr>
    <td rowspan="6">data</td>
  </tr>
  <tr>
    <td>*deposit</td>
    <td>شماره حسابی که قصد دریافت شماره شبا آن را دارید</td>
  </tr>
  <tr>
    <td>*bankCode</td>
    <td>کد بانک صاحب حساب</td>
  </tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_CHECK_INQUIRY,[
'clientId' => your client id,'trackId' => your track id,'sayadId' =>your sayad id
])
```

checkInquiry
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FARABOOM_CHECK_INQUIRY</th>
    <th>استعلام شناسه چک صیادی</th>
  </tr>
  <tr>
    <td rowspan="12">data</td>
  </tr>
  <tr>
    <td>*sayadId</td>
    <td>شناسه صیاد چک</td>
  </tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_BANKS_INFO,[
'clientId' => your client id,'trackId' => your track id
])
```

banksInfo
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_BANKS_INFO</th>
    <th>سرویس اطلاعات بانک</th>
  </tr>
  <tr>
    <td rowspan="15">data</td>
  </tr>

</table>


Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_CARD_TO_DEPOSIT,[
'clientId' => your client id,'trackId' => your track id,'card' => your card
])
```

cardToDeposit
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_CARD_TO_DEPOSIT</th>
    <th>تبدیل شماره کارت به شماره حساب</th>
  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
  <tr>
    <td>*clientId</td>
    <td>شناسه کلاینت</td>
  </tr>
  <tr>
    <td>*trackId</td>
    <td>رشته ای اختیاری با طول حداکثر ۴۰ کاراکتر شامل حرف و عدد</td>
  </tr>
  <tr>
    <td>*card</td>
    <td>شماره کارت</td>
  </tr>

</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_CARD_TO_SHABA,[
'clientId' => your client id,'trackId' => your track id,'card' => your card,'version' => your version
])
```

cardToShaba
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_CARD_TO_SHABA</th>
    <th>تبدیل شماره کارت به شبا</th>
  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
 <tr>
    <td>*clientId</td>
    <td>شناسه کلاینت</td>
  </tr>
 <tr>
    <td>*trackId</td>
    <td> رشته ای اختیاری با طول حداکثر ۴۰ کاراکتر شامل حرف و عدد</td>
  </tr>
  <tr>
    <td>*card</td>
    <td>شماره کارت</td>
  </tr>
 <tr>
    <td>*version</td>
    <td>ورژن API که باید برابر عدد دو باشد</td>
</tr>
</table>



Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_NID_VERIFICATION,[
'clientId' => your client id,'trackId' => your track id,'birthDate' => your birthDate,'users' => your users,
'fullName' => your fullName,'firstName' => your firstName,'lastName' => your lastName,'fatherName' => your fatherName,
'gender' => your gender
])
```

nidVerification
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_NID_VERIFICATION</th>
    <th>احراز هویت با کد ملی</th>
  </tr>
  <tr>
    <td rowspan="8">data</td>
  </tr>
  <tr>
    <td>*users</td>
    <td>کد ملی که میخواهید صحت آن را بررسی کنید و اجباری است</td>
  </tr>
 <tr>
    <td>*birthDate</td>
    <td> تاریخ تولد صاحب این کد ملی </td>
</tr>
 <tr>
    <td>*fullName</td>
    <td> نام و نام خانوادگی که میخواهید صحت آن را بررسی کنید </td>
</tr>
 <tr>
    <td>*firstName</td>
    <td> نام کوچک صاحب کد ملی </td>
</tr>
 <tr>
    <td>*lastName</td>
    <td> نام خانوادگی صاحب کد ملی </td>
</tr>
 <tr>
    <td>*fatherName</td>
    <td> نام پدر صاحب کد ملی </td>
</tr>
 <tr>
    <td>*gender</td>
    <td> جنسیت صاحب کد ملی که یکی از دو مقدار زن یا مرد است </td>
</tr>

</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_MATCH_MOBILE_NID,[
'clientId' => your client id,'trackId' => your track id,'mobile' => your mobile,'nationalCode' => your nationalCode
])
```

matchMobileNid
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_MATCH_MOBILE_NID</th>
    <th>تطبیق کد ملی و شماره موبایل</th>
  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
 <tr>
    <td>*clientId</td>
    <td> شناسه کلاینت</td>
  </tr>
  <tr>
    <td>*trackId</td>
    <td> کد پیگیری</td>
  </tr>
  <tr>
    <td>*mobile</td>
    <td>شماره موبایل</td>
  </tr>
 <tr>
    <td>*nationalCode</td>
    <td>کدملی</td>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_CARD_INFO,[
'clientId' => your client id,'trackId' => your track id,'card' => your card
])
```

cardInfo
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_CARD_INFO</th>
    <th>استعلام کارت</th>
  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
  <tr>
    <td>*clientId</td>
    <td>شناسه کلاینت</td>
  </tr>
 <tr>
    <td>*trackId</td>
    <td>کد پیگیری</td>
</tr>
 <tr>
    <td>*card</td>
    <td>شماره کارت ۱۶ رقمی</td>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_DEPOSITS,[
'clientId' => your client id,'trackId' => your track id,'card' => your card
])
```

deposits
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_DEPOSITS</th>
    <th>اعلام شماره حساب با دریافت کد ملی</th>
  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
  <tr>
    <td>*clientId</td>
    <td>شناسه کلاینت</td>
  </tr>
 <tr>
    <td>*users</td>
    <td>کد ملی ۱۰ رقمی</td>
</tr>
 <tr>
    <td>trackId</td>
    <td>رشته ای با طول حداکثر ۴۰ کاراکتر شامل حرف و عدد</td>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_BACK_CHEQUES,[
'clientId' => your client id,'trackId' => your track id,'user' => your user
])
```

backCheques
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_BACK_CHEQUES</th>
    <th>استعلام پیامکی چک برگشتی</th>
  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
  <tr>
    <td>*clientId</td>
    <td>شناسه کلاینت</td>
  </tr>
 <tr>
    <td>trackId</td>
    <td> کد پیگیری</td>
</tr>
<tr>
    <td>*user</td>
    <td>کد ملی ۱۰ رقمی</td>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_SAYAD_ACCEPT_CHEQUE,[
'clientId' => your client id,'trackId' => your track id,'user' => your user
])
```

sayadAcceptCheque
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_SAYAD_ACCEPT_CHEQUE</th>
    <th>تایید چک صیاد توسط گیرنده</th>
  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
  <tr>
    <td>*clientId</td>
    <td>شناسه کلاینت</td>
  </tr>
 <tr>
    <td>*trackId</td>
    <td> کد پیگیری</td>
</tr>
<tr>
    <td>*user</td>
    <td>کد ملی ۱۰ رقمی</td>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_SAYAD_CANCEL_CHEQUE,[
'clientId' => your client id,'trackId' => your track id,'user' => your user
])
```

sayadCancelCheque
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_SAYAD_CANCEL_CHEQUE</th>
    <th>لغو چک صیاد</th>
  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
  <tr>
    <td>*clientId</td>
    <td>شناسه کلاینت</td>
  </tr>
 <tr>
    <td>*trackId</td>
    <td> کد پیگیری</td>
</tr>
<tr>
    <td>*user</td>
    <td>کد ملی ۱۰ رقمی</td>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_SAYAD_ISSUER_INQUIRY_CHEQUE,[
'clientId' => your client id,'trackId' => your track id,'user' => your user
])
```

sayadIssuerInquiryCheque
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_SAYAD_ISSUER_INQUIRY_CHEQUE</th>
    <th>استعلام چک صیاد توسط صادرکننده</th>
  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
  <tr>
    <td>*clientId</td>
    <td>شناسه کلاینت</td>
  </tr>
 <tr>
    <td>*trackId</td>
    <td> کد پیگیری</td>
</tr>
<tr>
    <td>*user</td>
    <td>کد ملی ۱۰ رقمی</td>
</tr>
</table>

Usage Example:
```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FINNOTECH,BaseOpenBanking::FINNOTECH_SAYAD_CHEQUE_INQUIRY,[
'clientId' => your client id,'trackId' => your track id,'user' => your user,
'idCode' => your id code,'shahabId' => your shahab id,'idType' => your id type,'sayadId' => your sayad id

])
```

sayadChequeInquiry
-------------
<table>
    <tr>
        <th>Arguments</th>
        <th>Values</th>
        <th>Description</th>
    </tr>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FINNOTECH</th>
    <th>پلتفرم</th>
  </tr>
  <tr>
    <th>service</th>
    <th>BaseOpenBanking::FINNOTECH_SAYAD_CHEQUEـINQUIRY</th>
    <th>استعلام چک صیاد</th>
  </tr>
  <tr>
    <td rowspan="8">data</td>
  </tr>
  <tr>
    <td>*clientId</td>
    <td>شناسه کلاینت</td>
  </tr>
 <tr>
    <td>*trackId</td>
    <td> کد پیگیری</td>
</tr>
<tr>
    <td>*user</td>
    <td>کد ملی ۱۰ رقمی</td>
</tr>
<tr>
    <td>idCode</td>
    <td>کد شناسایی</td>
</tr>
<tr>
    <td>shahabId</td>
    <td>کد شهاب</td>
</tr>
<tr>
    <td>*idType</td>
    <td>نوع کد شناسایی با ملاحظات: مشتری حقیقی ۱,مشتری حقوقی ۲</td>
</tr>
<tr>
    <td>*sayadId</td>
    <td>شناسه صیاد چک</td>
</tr>
</table>











Advanced config
-------------

- [Installation Guide](./src/guide/README.md)