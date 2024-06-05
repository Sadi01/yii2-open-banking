How To Use Faraboom Services
-------------
add to your code:

```php
Yii::$app->openBanking->call(platform,service,data[])
```
Available Faraboom Services:
-------------

depositToShaba(تبدیل شماره حساب به شماره شبا):
<table>
  <tr>
    <th>platform</th>
    <td>OpenBanking::FARABOOM</td>
  </tr>
  <tr>
    <th>service</th>
    <td>depositToShaba</td>
  </tr>
  <tr>
    <th rowspan="5">data</th>
  </tr>
  <tr>
    <td>deposit_id</td>
  </tr>
<tr>
</tr>
</table>

shabaToDeposit:
<table>
  <tr>
    <th>platform</th>
    <th>OpenBanking::FARABOOM</th>
  </tr>
  <tr>
    <th>service</th>
    <th>shabaToDeposit</th>
  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
  <tr>
    <td>iban</td>
  </tr>
<tr>
</tr>
</table>

matchNationalCodeAccount:
<table>
  <tr>
    <th>platform</th>
    <th>OpenBanking::FARABOOM</th>
  </tr>
  <tr>
    <th>service</th>
    <th>shabaToDeposit</th>
  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
  <tr>
    <td>national_code</td>
  </tr>
 <tr>
    <td>account</td>
  </tr>
<tr>
</tr>
</table>

depositHolder:
<table>
  <tr>
    <th>platform</th>
    <th>OpenBanking::FARABOOM</th>
  </tr>
  <tr>
    <th>service</th>
    <th>depositHolder</th>
  </tr>
  <tr>
    <td rowspan="5">data</td>
  </tr>
  <tr>
    <td>deposit_number</td>
  </tr>
<tr>
</tr>
</table>

paya:
<table>
  <tr>
    <th>platform</th>
    <th>OpenBanking::FARABOOM</th>
  </tr>
  <tr>
    <th>service</th>
    <th>paya</th>
  </tr>
  <tr>
    <td rowspan="12">data</td>
  </tr>
  <tr>
    <td>*source_deposit_number</td>
  </tr>
  <tr>
    <td>*iban_number</td>
  </tr>
  <tr>
    <td>*owner_name</td>
  </tr>
  <tr>
    <td>*amount</td>
  </tr>
  <tr>
    <td>transfer_description</td>
  </tr>
 <tr>
    <td>customer_number</td>
  </tr>
 <tr>
    <td>description</td>
  </tr>
 <tr>
    <td>factor_number</td>
  </tr>
 <tr>
    <td>additional_document_desc</td>
  </tr>
 <tr>
    <td>transaction_reason</td>
  </tr>
 <tr>
    <td>pay_id</td>
  </tr>
</table>

batchPaya:
<table>
  <tr>
    <th>platform</th>
    <th>OpenBanking::FARABOOM</th>
  </tr>
  <tr>
    <th>service</th>
    <th>batchPaya</th>
  </tr>
  <tr>
    <td rowspan="8">data</td>
  </tr>
  <tr>
    <td>transfer_description</td>
  </tr>
  <tr>
    <td>customer_number</td>
  </tr>
  <tr>
    <td>source_deposit_number</td>
  </tr>
  <tr>
    <td>ignore_error</td>
  </tr>
  <tr>
    <td>transactions</td>
  </tr>
 <tr>
    <td>additional_document_desc</td>
  </tr>
 <tr>
    <td>transaction_reason</td>
  </tr>
</table>

internalTransfer:
<table>
  <tr>
    <th>platform</th>
    <th>OpenBanking::FARABOOM</th>
  </tr>
  <tr>
    <th>service</th>
    <th>internalTransfer</th>
  </tr>
  <tr>
    <td rowspan="11">data</td>
  </tr>
  <tr>
    <td>*source_deposit</td>
  </tr>
<tr>
    <td>*destination_deposit</td>
  </tr>
<tr>
    <td>*amount</td>
  </tr>
<tr>
    <td>customer_number</td>
  </tr>
<tr>
    <td>source_comment</td>
  </tr>
<tr>
    <td>destination_comment</td>
  </tr>
<tr>
    <td>pay_id</td>
  </tr>
<tr>
    <td>reference_number</td>
  </tr>
<tr>
    <td>additional_document_desc</td>
  </tr>
<tr>
    <td>transaction_reason</td>
  </tr>
</table>

batchInternalTransfer:
<table>
  <tr>
    <th>platform</th>
    <th>OpenBanking::FARABOOM</th>
  </tr>
  <tr>
    <th>service</th>
    <th>batchInternalTransfer</th>
  </tr>
  <tr>
    <td rowspan="9">data</td>
  </tr>
  <tr>
    <td>*source_deposit_number</td>
  </tr>
<tr>
    <td>*destination_batch_transfers</td>
  </tr>
<tr>
    <td>*ignore_error</td>
  </tr>
<tr>
    <td>customer_number</td>
  </tr>
<tr>
    <td>source_description</td>
  </tr>
<tr>
    <td>additional_document_desc</td>
  </tr>
<tr>
    <td>signers</td>
  </tr>
<tr>
    <td>transaction_reason</td>
  </tr>
</table>

satna:
<table>
  <tr>
    <th>platform</th>
    <th>OpenBanking::FARABOOM</th>
  </tr>
  <tr>
    <th>service</th>
    <th>satna</th>
  </tr>
  <tr>
    <td rowspan="12">data</td>
  </tr>
  <tr>
    <td>*amount</td>
  </tr>
<tr>
    <td>*source_deposit_number</td>
  </tr>
<tr>
    <td>*receiver_name</td>
  </tr>
<tr>
    <td>*receiver_family</td>
  </tr>
<tr>
    <td>*destination_iban_number</td>
  </tr>
<tr>
    <td>customer_number</td>
  </tr>
<tr>
    <td>receiver_phone_number</td>
  </tr>
<tr>
    <td>factor_number</td>
  </tr>
<tr>
    <td>description</td>
  </tr>
<tr>
    <td>tranaction_reason</td>
  </tr>
<tr>
    <td>pay_id</td>
  </tr>
</table>

checkinquiryReceiver:
<table>
  <tr>
    <th>platform</th>
    <th>OpenBanking::FARABOOM</th>
  </tr>
  <tr>
    <th>service</th>
    <th>checkinquiryReceiver</th>
  </tr>
  <tr>
    <td rowspan="9">data</td>
  </tr>
  <tr>
    <td>*sayad_id</td>
  </tr>
<tr>
    <td>customer_number</td>
  </tr>
</table>

shabainquiry:
<table>
  <tr>
    <th>platform</th>
    <th>OpenBanking::FARABOOM</th>
  </tr>
  <tr>
    <th>service</th>
    <th>shabainquiry</th>
  </tr>
  <tr>
    <td rowspan="2">data</td>
  </tr>
  <tr>
    <td>*iban</td>
  </tr>
</table>

matchNationalCodeMobile:
<table>
  <tr>
    <th>platform</th>
    <th>OpenBanking::FARABOOM</th>
  </tr>
  <tr>
    <th>service</th>
    <th>matchNationalCodeMobile</th>
  </tr>
  <tr>
    <td rowspan="3">data</td>
  </tr>
  <tr>
    <td>*national_code</td>
  </tr>
  <tr>
    <td>*mobile</td>
  </tr>
</table>

reportPayaTransactions:
<table>
  <tr>
    <th>platform</th>
    <td>OpenBanking::FARABOOM</td>
    <td>OpenBanking::FARABOOM</td>
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
    <td>OpenBanking::FARABOOM</td>
    <td>OpenBanking::FARABOOM</td>
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




Advanced config
-------------

- [Installation Guide](./src/guide/installation.md)

- [Description Guide](./src/guide/description.md)

- [Usage Guide](./src/guide/usage.md)