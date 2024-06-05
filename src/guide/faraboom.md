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




Advanced config
-------------

- [Installation Guide](./src/guide/installation.md)

- [Description Guide](./src/guide/description.md)

- [Usage Guide](./src/guide/usage.md)