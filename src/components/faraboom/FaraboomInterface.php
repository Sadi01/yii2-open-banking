<?php

namespace sadi01\openbanking\components\faraboom;

interface FaraboomInterface
{
    public function depositToShaba($data);

    public function shabaToDeposit($iban);

    public function matchNationalCodeAccount($national_code,$account);

    public function depositHolder($deposit_number);

    public function paya($source_deposit_number,$iban_number,$owner_name,$amount,$transfer_description,$customer_number,$description,$factor_number,$additional_document_desc,$transaction_reason,$pay_id);

    public function satna($amount,$source_deposit_number,$receiver_name,$receiver_family,$destination_iban_number,$customer_number,$receiver_phone_number,$factor_number,$description,$tranaction_reason,$pay_id);

    public function checkinquiryReceiver($sayad_id,$customer_number);

    public function shabainquiry($shaba_number);

    public function matchNationalCodeMobile($national_code,$mobile);

    public function cartToShaba($pan);

    public function batchPaya($transfer_description,$customer_number,$source_deposit_number,$ignore_error,$transactions,$additional_document_desc,$transaction_reason);

    public function reportPayaTransactions($source_deposit_iban,$transfer_description,$customer_number,$offset,$length,$reference_id,$traco_no,$transaction_id,$from_register_date,$to_register_date,$from_issue_date,$To_issue_date,$from_transaction_amount,$to_transaction_amount,$iban_number,$iban_owner_name,$factor_number,$description,$include_transaction_status);

    public function reportPayaTransfer($source_deposit_iban,$transfer_description,$customer_number,$offset,$length,$from_transaction_amount,$to_transaction_amount,$reference_id,$trace_no,$destination_iban_number,$destination_owner_name,$from_register_date,$to_register_date,$from_issue_date,$to_issue_date,$description,$factor_number,$status_set,$transaction_status_set);

    public function cancelPaya($customer_number,$transfer_id,$comment);

    public function reportSatnaTransfer($customer_number,$status,$branch_code,$branch_name,$from_date,$length,$offset,$serial,$trace_no,$to_date);

    public function batchSatna($source_deposit_number,$description,$customer_number,$transaction_reason,$signers,$transactions);


}