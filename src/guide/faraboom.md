How To Use Faraboom Services
-------------
add to your code:

```php
Yii::$app->openBanking->call(BaseOpenBanking::PLATFORM_FARABOOM,BaseOpenBanking::FARABOOM_DEPOSIT_TO_SHABA,data[])
```
Available Faraboom Services:
-------------

depositToShaba(تبدیل شماره حساب به شماره شبا):
<table>
  <tr>
    <th>platform</th>
    <td>BaseOpenBanking::PLATFORM_FARABOOM</td>
<td>پلتفرم</td>
  </tr>
  <tr>
    <th>service</th>
    <td>BaseOpenBanking::FARABOOM_DEPOSIT_TO_SHABA</td>
<td>سرویس تبدیل شماره سپرده به شبا</td>
  </tr>
  <tr>
    <th rowspan="2">data</th>
  </tr>
  <tr>
    <td>deposit_id</td>
<td>شماره سپرده</td>
  </tr>
<tr>
</tr>
</table>

shabaToDeposit:
<table>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
 <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
  </tr>
  <tr>
    <th>service</th>
    <th>shabaToDeposit</th>
 <th>سرویس تبدیل شماره شبا به شماره سپرده</th>

  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
  <tr>
    <td>iban</td>
 <td>شماره شبا</td>
  </tr>
<tr>
</tr>
</table>

matchNationalCodeAccount:
<table>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
 <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
  </tr>
  <tr>
    <th>service</th>
    <th>matchNationalCodeAccount</th>
 <th>سرویس انطباق کدملی و حساب</th>
  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
  <tr>
    <td>national_code</td>
 <td>شماره ملی</td>
  </tr>
 <tr>
    <td>account</td>
 <td>شماره حساب</td>
  </tr>
<tr>
</tr>
</table>

depositHolder:
<table>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
<th>BaseOpenBanking::PLATFORM_FARABOOM</th>
  </tr>
  <tr>
    <th>service</th>
    <th>depositHolder</th>
 <th>سرویس دریافت نام صاحب سپرده</th>
  </tr>
  <tr>
    <td rowspan="2">data</td>
  </tr>
  <tr>
    <td>deposit_number</td>
    <td>شماره سپرده</td>
  </tr>
<tr>
</tr>
</table>

paya:
<table>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
  </tr>
  <tr>
    <th>service</th>
    <th>paya</th>
    <th>انتقال وجه بین بانکی پایا</th>
  </tr>
  <tr>
    <td rowspan="12">data</td>
  </tr>
  <tr>
    <td>*source_deposit_number</td>
    <td>شماره حساب مبدا</td>
  </tr>
  <tr>
    <td>*iban_number</td>
    <td>شماره شبا مقصد</td>
  </tr>
  <tr>
    <td>*owner_name</td>
    <td>نام صاحب سپرده</td>
  </tr>
  <tr>
    <td>*amount</td>
    <td>مبلغ انتقال وجه</td>
  </tr>
  <tr>
    <td>transfer_description</td>
    <td>شرح انتقال</td>
  </tr>
 <tr>
    <td>customer_number</td>
    <td>شماره مشتری</td>
  </tr>
 <tr>
    <td>description</td>
    <td>توضیحات</td>
  </tr>
 <tr>
    <td>factor_number</td>
    <td>شماره فاکتور</td>
  </tr>
 <tr>
    <td>additional_document_desc</td>
    <td>توضیحات اضافه</td>
  </tr>
 <tr>
    <td>transaction_reason</td>
    <td></td>
  </tr>
 <tr>
    <td>pay_id</td>
    <td>شناسه پرداخت</td>
  </tr>
</table>

batchPaya:
<table>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
  </tr>
  <tr>
    <th>service</th>
    <th>batchPaya</th>
    <th>انتقال وجه پایا گروهی</th>
  </tr>
  <tr>
    <td rowspan="8">data</td>
  </tr>
  <tr>
    <td>*transactions</td>
    <td>آرایه ای از مبالغ انتقال. حداقل باید شامل دو آیتم باشد:
    <table>
        <tr>
            <th>نام فیلد</th>
            <th>توضیحات</th>
        </tr>
        <tr>
            <td>*amount</td>
            <td>مبلغ (حداقل ۵۰۰۰۰۰۰۰۰) </td>
        </tr>
        <tr>
            <td>*receiver_name</td>
            <td>نام گیرنده</td>
        </tr>
        <tr>
            <td>*receiver_family</td>
            <td>نام خانوادگی</td>
        </tr>
        <tr>
            <td>*iban</td>
            <td>شماره شبا گیرنده</td>
        </tr>
        <tr>
            <td>receiver_phone_number</td>
            <td>شماره تلفن گیرنده</td>
        </tr>
        <tr>
            <td>factor_number</td>
            <td>شماره فاکتور </td>
        </tr>
    </table>
</td>
  </tr>
<tr>
    <td>*source_deposit_number</td>
    <td>شماره سپرده مبدا</td>
  </tr>
  <tr>
    <td>transfer_description</td>
    <td>توضیحات انتقال</td>
  </tr>
  <tr>
    <td>customer_number</td>
    <td>شماره مشتری</td>
  </tr>
  <tr>
    <td>ignore_error</td>
    <td></td>
  </tr>
 <tr>
    <td>additional_document_desc</td>
    <td>توضیحات اضافه</td>
  </tr>
 <tr>
    <td>transaction_reason</td>
    <td>[POSA, IOSP, HIPA, ISAP, FXAP, DRPA, RTAP, MPTP, IMPT, LMAP, CDAP, TCAP, GEAC, LRPA, CCPA, GPAC, CPAC, GPPC, SPAC]</td>
  </tr>
</table>

internalTransfer:
<table>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
  </tr>
  <tr>
    <th>service</th>
    <th>internalTransfer</th>
    <th>سرویس انتقال وجه داخلی</th>
  </tr>
  <tr>
    <td rowspan="11">data</td>
  </tr>
  <tr>
    <td>*source_deposit</td>
    <td>سپرده مبدا</td>
  </tr>
<tr>
    <td>*destination_deposit</td>
    <td>شماره سپرده مقصد</td>
  </tr>
<tr>
    <td>*amount</td>
    <td>مبلغ انتقال وجه</td>
  </tr>
<tr>
    <td>customer_number</td>
    <td>شماره مشتری</td>
  </tr>
<tr>
    <td>source_comment</td>
    <td>شرحی توسط انتقال دهنده وجه وارد می شود</td>
  </tr>
<tr>
    <td>destination_comment</td>
    <td>شرحی که پس از انتقال وجه ، توسط شخصی که دریافت کننده وجه است قابل رویت است</td>
  </tr>
<tr>
    <td>pay_id</td>
    <td>شناسه پرداخت</td>
  </tr>
<tr>
    <td>reference_number</td>
    <td>شماره پیگیری</td>
  </tr>
<tr>
    <td>additional_document_desc</td>
    <td>در سند خود قرار می دهند third party شرحی که کاربران</td>
  </tr>
<tr>
    <td>transaction_reason</td>
    <td>[POSA, IOSP, HIPA, ISAP, FXAP, DRPA, RTAP, MPTP, IMPT, LMAP, CDAP, TCAP, GEAC, LRPA, CCPA, GPAC, CPAC, GPPC, SPAC]</td>
  </tr>
</table>

batchInternalTransfer:
<table>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
  </tr>
  <tr>
    <th>service</th>
    <th>batchInternalTransfer</th>
    <th>انتقال وجه دسته ای</th>
  </tr>
  <tr>
    <td rowspan="9">data</td>
  </tr>
  <tr>
    <td>*source_deposit_number</td>
    <td>شماره سپرده مبدا</td>
  </tr>
<tr>
    <td>*destination_batch_transfers</td>
    <td>
        <table>
        <tr>
            <td>destination_deposit_number</td>
            <td>شماره حساب مقصد</td>
        </tr>
        <tr>
            <td>amount</td>
            <td>حداقل مقدار 1.00</td>
        </tr>
   <tr>
            <td>description</td>
            <td>توضیحات</td>
        </tr>
   <tr>
            <td>pay_id</td>
            <td>شناسه پرداخت</td>
        </tr>
        </table>
    </td>
  </tr>
<tr>
    <td>*ignore_error</td>
  </tr>
<tr>
    <td>customer_number</td>
    <td>شماره مشتری</td>
  </tr>
<tr>
    <td>source_description</td>
    <td>یادداشت مربوط به سپرده مبدا</td>
  </tr>
<tr>
    <td>additional_document_desc</td>
    <td>در سند قرار می گیرد third party شرحی که توسط کاربران</td>
  </tr>
<tr>
    <td>signers</td>
  </tr>
<tr>
    <td>transaction_reason</td>
    <td>[POSA, IOSP, HIPA, ISAP, FXAP, DRPA, RTAP, MPTP, IMPT, LMAP, CDAP, TCAP, GEAC, LRPA, CCPA, GPAC, CPAC, GPPC, SPAC]</td>
  </tr>
</table>

satna:
<table>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
  </tr>
  <tr>
    <th>service</th>
    <th>satna</th>
    <th>انتقال وجه ساتنا</th>
  </tr>
  <tr>
    <td rowspan="12">data</td>
  </tr>
  <tr>
    <td>*amount</td>
    <td>حداقل مقدار =150000000.00</td>
  </tr>
<tr>
    <td>*source_deposit_number</td>
    <td>شماره سپرده مبدا</td>
  </tr>
<tr>
    <td>*receiver_name</td>
    <td>نام دریافت کننده</td>
  </tr>
<tr>
    <td>*receiver_family</td>
    <td>نام خانوداگی دریافت کننده</td>
  </tr>
<tr>
    <td>*destination_iban_number</td>
    <td>شبای مقصد</td>
  </tr>
<tr>
    <td>customer_number</td>
    <td>شماره مشتری</td>
  </tr>
<tr>
    <td>receiver_phone_number</td>
    <td>شماره تلفن دریافت کننده</td>
  </tr>
<tr>
    <td>factor_number</td>
    <td>شماره فاکتور</td>
  </tr>
<tr>
    <td>description</td>
    <td>توضیحات</td>
  </tr>
<tr>
    <td>tranaction_reason</td>
    <td>[POSA, IOSP, HIPA, ISAP, FXAP, DRPA, RTAP, MPTP, IMPT, LMAP, CDAP, TCAP, GEAC, LRPA, CCPA, GPAC, CPAC, GPPC, SPAC]</td>
  </tr>
<tr>
    <td>pay_id</td>
    <td>شناسه پرداخت</td>
  </tr>
</table>

checkinquiryReceiver:
<table>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
  </tr>
  <tr>
    <th>service</th>
    <th>checkinquiryReceiver</th>
    <th>استعلام چک توسط گیرنده</th>
  </tr>
  <tr>
    <td rowspan="9">data</td>
  </tr>
  <tr>
    <td>*sayad_id</td>
    <td>نام شخص
حداقل طول = 16
حداکثر طول = 2147483647
</td>
  </tr>
<tr>
    <td>customer_number</td>
    <td>شماره مشتری</td>
  </tr>
</table>

shabainquiry:
<table>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
  </tr>
  <tr>
    <th>service</th>
    <th>shabainquiry</th>
    <th>استعلام شماره شبا</th>
  </tr>
  <tr>
    <td rowspan="2">data</td>
  </tr>
  <tr>
    <td>*iban</td>
    <td>مقدار شماره شبا</td>
  </tr>
</table>

matchNationalCodeMobile:
<table>
  <tr>
    <th>platform</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
    <th>BaseOpenBanking::PLATFORM_FARABOOM</th>
  </tr>
  <tr>
    <th>service</th>
    <th>matchNationalCodeMobile</th>
    <th>تطبیق کد ملی و شماره موبایل</th>
  </tr>
  <tr>
    <td rowspan="3">data</td>
  </tr>
  <tr>
    <td>*national_code</td>
    <td>شماره ملی</td>
  </tr>
  <tr>
    <td>*mobile</td>
    <td>موبایل</td>
  </tr>
</table>

reportPayaTransactions:
<table>
  <tr>
    <th>platform</th>
    <td>BaseOpenBanking::PLATFORM_FARABOOM</td>
    <td>BaseOpenBanking::PLATFORM_FARABOOM</td>
  </tr>
  <tr>
    <th>service</th>
    <td>reportPayaTransactions</td>
    <td>سرویس گزارش لیست تراکنش های انتقال وجه پایا</td>
  </tr>
  <tr>
    <td rowspan="113">data</td>
  </tr>
  <tr>
    <td>source_deposit_iban</td>
    <td>شماره حساب مبدا</td>
  </tr>
  <tr>
    <td>transfer_description</td>
    <td>شرح انتقال</td>
  </tr>
 <tr>
    <td>customer_number</td>
    <td>شماره مشتری</td>
  </tr>
 <tr>
    <td>offset</td>
    <td>شماره اولین رکورد بازگشتی</td>
  </tr>
 <tr>
    <td>length</td>
    <td>تعداد رکورد بازگشتی</td>
  </tr>
 <tr>
    <td>reference_id</td>
    <td>شماره پیگیری انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>traco_no</td>
    <td>کد یکتا برای پیگیری</td>
  </tr>
 <tr>
    <td>transaction_id</td>
    <td>شماره پیگیری تراکنش</td>
  </tr>
 <tr>
    <td>from_register_date</td>
    <td>از تاریخ ثبت انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>to_register_date</td>
    <td>تا تاریخ ثبت انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>from_issue_date</td>
    <td>از تاریخ انجام انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>To_issue_date</td>
    <td>تا تاریخ انجام انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>from_transaction_amount</td>
    <td>حداقل مبلغ انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>to_transaction_amount</td>
    <td>حداکثر مبلغ انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>iban_number</td>
    <td>آی بن شماره سپرده مقصد</td>
  </tr>
 <tr>
    <td>iban_owner_name</td>
    <td>نام صاحب سپرده مقصد</td>
  </tr>
 <tr>
    <td>factor_number</td>
    <td>شماره فاکتور انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>description</td>
    <td>شرح انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>include_transaction_status</td>
    <td></td>
  </tr>
</table>

reportPayaTransactions:
<table>
  <tr>
    <th>platform</th>
    <td>BaseOpenBanking::PLATFORM_FARABOOM</td>
    <td>BaseOpenBanking::PLATFORM_FARABOOM</td>
  </tr>
  <tr>
    <th>service</th>
    <td>reportPayaTransactions</td>
    <td>سرویس گزارش لیست تراکنش های انتقال وجه پایا</td>
  </tr>
  <tr>
    <td rowspan="113">data</td>
  </tr>
  <tr>
    <td>source_deposit_iban</td>
    <td>شماره حساب مبدا</td>
  </tr>
  <tr>
    <td>transfer_description</td>
    <td>شرح انتقال</td>
  </tr>
 <tr>
    <td>customer_number</td>
    <td>شماره مشتری</td>
  </tr>
 <tr>
    <td>offset</td>
    <td>شماره اولین رکورد بازگشتی</td>
  </tr>
 <tr>
    <td>length</td>
    <td>تعداد رکورد بازگشتی</td>
  </tr>
 <tr>
    <td>reference_id</td>
    <td>شماره پیگیری انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>traco_no</td>
    <td>کد یکتا برای پیگیری</td>
  </tr>
 <tr>
    <td>transaction_id</td>
    <td>شماره پیگیری تراکنش</td>
  </tr>
 <tr>
    <td>from_register_date</td>
    <td>از تاریخ ثبت انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>to_register_date</td>
    <td>تا تاریخ ثبت انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>from_issue_date</td>
    <td>از تاریخ انجام انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>To_issue_date</td>
    <td>تا تاریخ انجام انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>from_transaction_amount</td>
    <td>حداقل مبلغ انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>to_transaction_amount</td>
    <td>حداکثر مبلغ انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>iban_number</td>
    <td>آی بن شماره سپرده مقصد</td>
  </tr>
 <tr>
    <td>iban_owner_name</td>
    <td>نام صاحب سپرده مقصد</td>
  </tr>
 <tr>
    <td>factor_number</td>
    <td>شماره فاکتور انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>description</td>
    <td>شرح انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>include_transaction_status</td>
    <td>[READY_FOR_PROCESS, SUSPENDED, CANCELED, PROCESS_FAIL, READY_TO_TRANSFER, TRANSFERRED, SETTLED, NOT_SETTLED, REJECTED, UNKNOWN]</td>
  </tr>
</table>

reportPayaTransfer:
<table>
  <tr>
    <th>platform</th>
    <td>BaseOpenBanking::PLATFORM_FARABOOM</td>
    <td>BaseOpenBanking::PLATFORM_FARABOOM</td>
  </tr>
  <tr>
    <th>service</th>
    <td>reportPayaTransfer</td>
    <td>سرویس گزارش لیست انتقال وجه های پایا</td>
  </tr>
  <tr>
    <td rowspan="113">data</td>
  </tr>
  <tr>
    <td>source_deposit_iban</td>
    <td>شماره شبای سپرده مبدأ</td>
  </tr>
  <tr>
    <td>transfer_description</td>
    <td>شرح انتقال</td>
  </tr>
 <tr>
    <td>customer_number</td>
    <td>شماره مشتری</td>
  </tr>
 <tr>
    <td>offset</td>
    <td>شماره اولین رکورد بازگشتی</td>
  </tr>
 <tr>
    <td>length</td>
    <td>تعداد رکورد بازگشتی</td>
  </tr>
 <tr>
    <td>from_transaction_amount</td>
    <td>حداقل مبلغ انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>to_transaction_amount</td>
    <td>حداکثر مبلغ انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>reference_id</td>
    <td>شماره پیگیری انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>trace_no</td>
    <td> شماره پیگیری تراکنش</td>
  </tr>
 <tr>
    <td>destination_iban_number</td>
    <td>شماره آی بن مقصد را برمی گرداند</td>
  </tr>
 <tr>
    <td>destination_owner_name</td>
    <td>نام صاحب سپرده مقصد را برمی گرداند</td>
  </tr>
 <tr>
    <td>from_register_date</td>
    <td>از تاریخ ثبت انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>to_register_date</td>
    <td>تا تاریخ ثبت انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>from_issue_date</td>
    <td>از تاریخ انجام انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>to_issue_date</td>
    <td>تا تاریخ انجام انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>description</td>
    <td>شرح انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>factor_number</td>
    <td>شماره فاکتور انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>status_set</td>
    <td>لیستی از وضعیت هایی انتقال وجه پایا</td>
  </tr>
 <tr>
    <td>transaction_status_set</td>
    <td>لیستی از وضعیت تراکنش های انتقال وجه پایا</td>
  </tr>
</table>

cancelPaya:
<table>
  <tr>
    <th>platform</th>
    <td>BaseOpenBanking::PLATFORM_FARABOOM</td>
    <td>BaseOpenBanking::PLATFORM_FARABOOM</td>
  </tr>
  <tr>
    <th>service</th>
    <td>cancelPaya</td>
    <td>لغو انتقال وجه پایا</td>
  </tr>
  <tr>
    <td rowspan="113">data</td>
  </tr>
  <tr>
    <td>customer_number</td>
    <td>شماره مشتری</td>
  </tr>
  <tr>
    <td>transfer_id</td>
    <td>شماره پیگیری که در پاسخ سرویس انتقال وجه پایا برگردانده شد</td>
  </tr>
 <tr>
    <td>comment</td>
    <td>یادداشت</td>
  </tr>
</table>

reportSatnaTransfer:
<table>
  <tr>
    <th>platform</th>
    <td>BaseOpenBanking::PLATFORM_FARABOOM</td>
    <td>BaseOpenBanking::PLATFORM_FARABOOM</td>
  </tr>
  <tr>
    <th>service</th>
    <td>reportSatnaTransfer</td>
    <td>گزارش انتقال وجه ساتنا</td>
  </tr>
  <tr>
    <td rowspan="113">data</td>
  </tr>
  <tr>
    <td>customer_number</td>
    <td>شماره مشتری</td>
  </tr>
  <tr>
    <td>status</td>
    <td>وضعیت انتقال وجه</td>
  </tr>
 <tr>
    <td>branch_code</td>
    <td>کد شعبه</td>
  </tr>
 <tr>
    <td>branch_name</td>
    <td>نام شعبه</td>
  </tr>
 <tr>
    <td>from_date</td>
    <td>از تاریخ</td>
  </tr>
 <tr>
    <td>length</td>
    <td>long تعداد رکورد بازگشتی از نوع</td>
  </tr>
 <tr>
    <td>offset</td>
    <td>long اولین رکورد بازگشتی از نوع</td>
  </tr>
 <tr>
    <td>serial</td>
    <td>شماره سریال</td>
  </tr>
 <tr>
    <td>trace_no</td>
    <td>شماره پیگیری ارسال شده از برنامه</td>
  </tr>
 <tr>
    <td>to_date</td>
    <td>تا تاریخ</td>
  </tr>
</table>

batchSatna:
<table>
  <tr>
    <th>platform</th>
    <td>BaseOpenBanking::PLATFORM_FARABOOM</td>
    <td>BaseOpenBanking::PLATFORM_FARABOOM</td>
  </tr>
  <tr>
    <th>service</th>
    <td>batchSatna</td>
    <td>انتقال وجه ساتنا گروهی</td>
  </tr>
  <tr>
    <td rowspan="113">data</td>
  </tr>
  <tr>
    <td>*source_deposit_number</td>
    <td>شماره حساب مبدا</td>
  </tr>
  <tr>
    <td>*description</td>
    <td>توضیحات</td>
  </tr>
 <tr>
    <td>customer_number</td>
    <td>شماره مشتری</td>
  </tr>
 <tr>
    <td>transaction_reason</td>
    <td>[POSA, IOSP, HIPA, ISAP, FXAP, DRPA, RTAP, MPTP, IMPT, LMAP, CDAP, TCAP, GEAC, LRPA, CCPA, GPAC, CPAC, GPPC, SPAC]</td>
  </tr>
 <tr>
    <td>signers</td>
    <td></td>
  </tr>
 <tr>
    <td>transactions</td>
    <td></td>
  </tr>
</table>




Advanced config
-------------

- [Installation Guide](./src/guide/README.md)