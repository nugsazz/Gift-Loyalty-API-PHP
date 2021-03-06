<?php

$store_id =$argv[1];
$api_token=$argv[2];

$order_id = $argv[3];
$ref_num = $argv[4];

$total_amount = '1.00';
$benefit_amount = '1.00';

include("../ernexClasses.php");

        $txnArray=array(
            type=>'ernex_loyalty_refund',
            order_id=>$order_id,
            txn_number=>$ref_num,
            total_amount=>$total_amount,
			benefit_amount=>$benefit_amount
           );

$ernexTxn = new ernexTransaction($txnArray);
$ernexRequest = new ernexRequest($ernexTxn);
$ernexHttpPost  = new ernexHttpsPost($store_id,$api_token,$ernexRequest);
$ernexResponse =$ernexHttpPost->getErnexResponse();

//-------------- Main Receipt Variables --------------------------------//

print("\nReceiptId = " . $ernexResponse->getReceiptId());
print("\nResponseCode = " . $ernexResponse->getResponseCode());
print("\nHostReferenceNum = " . $ernexResponse->getHostReferenceNum());
print("\nTransTime = " . $ernexResponse->getTransTime());
print("\nTransDate = " . $ernexResponse->getTransDate());
print("\nTransType = " . $ernexResponse->getTransType());
print("\nComplete = " . $ernexResponse->getComplete());
print("\nMessage = " . $ernexResponse->getMessage());
print("\nTransCardCode = " . $ernexResponse->getTransCardCode());
print("\nTransCardType = " . $ernexResponse->getTransCardType());
print("\nTxnNumber = " . $ernexResponse->getTxnNumber());
print("\nTimedOut = " . $ernexResponse->getTimedOut());
print("\nHostTotals = " . $ernexResponse->getHostTotals());
print("\nDisplayText = " . $ernexResponse->getDisplayText());
print("\nReceiptText = " . $ernexResponse->getReceiptText());
print("\nCardHolderName = " . $ernexResponse->getCardHolderName());
print("\nVoucherType = " . $ernexResponse->getVoucherType());
print("\nVoucherText = " . $ernexResponse->getVoucherText());
print("\nInitialAmount = " . $ernexResponse->getInitialAmount());
print("\nInitialBalance = " . $ernexResponse->getInitialBalance());
print("\nBatchNo = " . $ernexResponse->getBatchNo());
print("\nCurrentBalance = " . $ernexResponse->getCurrentBalance());
print("\nLifetimeBalance = " . $ernexResponse->getLifetimeBalance());
print("\nBenefit = " . $ernexResponse->getBenefit());
print("\nActivationCharge = " . $ernexResponse->getActivationCharge());
print("\nRemainingBalance = " . $ernexResponse->getRemainingBalance());
print("\nCardStatus = " . $ernexResponse->getCardStatus());
print("\nLanguage = " . $ernexResponse->getLanguage());
print("\nErrorCode = " . $ernexResponse->getErrorCode());
print("\nErrorMessage = " . $ernexResponse->getErrorMessage());

//-------------- Card Variables --------------------------------//

$CardCodes = $ernexResponse->getCardCodes();

for($i=0; $i < count($CardCodes); $i++)
{
	print "\n\nCardCode = $CardCodes[$i]\n";

	print "\nCardString = " . $ernexResponse->getCardString($CardCodes[$i]);
	print "\nCardType = " . $ernexResponse->getCardType($CardCodes[$i]);
	print "\nCheckMod10 = " . $ernexResponse->getCheckMod10($CardCodes[$i]);
	print "\nCheckLanguage = " . $ernexResponse->getCheckLanguage($CardCodes[$i]);
	print "\nAmountPrompt = " . $ernexResponse->getAmountPrompt($CardCodes[$i]);
	print "\nBenefitPrompt = " . $ernexResponse->getBenefitPrompt($CardCodes[$i]);
	print "\nCVCPrompt = " . $ernexResponse->getCVCPrompt($CardCodes[$i]);
	print "\nInfoPrompt = " . $ernexResponse->getInfoPrompt($CardCodes[$i]);
	print "\nInitialAmountPrompt = " . $ernexResponse->getInitialAmountPrompt($CardCodes[$i]);
	print "\nRefundAllowed = " . $ernexResponse->getRefundAllowed($CardCodes[$i]);
	print "\nCardLengthMinimum = " . $ernexResponse->getCardLengthMinimum($CardCodes[$i]);
	print "\nCardLengthMaximum = " . $ernexResponse->getCardLengthMaximum($CardCodes[$i]);
	print "\nLowBIN1 = " . $ernexResponse->getLowBIN1($CardCodes[$i]);
	print "\nHighBIN1 = " . $ernexResponse->getHighBIN1($CardCodes[$i]);
	print "\nLowBIN2 = " . $ernexResponse->getLowBIN2($CardCodes[$i]);
	print "\nHighBIN2 = " . $ernexResponse->getHighBIN2($CardCodes[$i]);
	print "\nLowBIN3 = " . $ernexResponse->getLowBIN3($CardCodes[$i]);
	print "\nHighBIN3 = " . $ernexResponse->getHighBIN3($CardCodes[$i]);
	print "\nLowBIN4 = " . $ernexResponse->getLowBIN4($CardCodes[$i]);
	print "\nHighBIN4 = " . $ernexResponse->getHighBIN4($CardCodes[$i]);

	$RecordTypes = $ernexResponse->getRecordTypes($CardCodes[$i]);

	for($j=0; $j < count($RecordTypes); $j++)
	{
		print "\n\nRecordType = $RecordTypes[$j]\n";

		print "\nCardDescription = " . $ernexResponse->getCardDescription($CardCodes[$i],$RecordTypes[$j]);
		print "\nBenefitDescription = " . $ernexResponse->getBenefitDescription($CardCodes[$i],$RecordTypes[$j]);
		print "\nBenefitPromptText = " . $ernexResponse->getBenefitPromptText($CardCodes[$i],$RecordTypes[$j]);
		print "\nAmountPromptText = " . $ernexResponse->getAmountPromptText($CardCodes[$i],$RecordTypes[$j]);
		print "\nInfoPromptText = " . $ernexResponse->getInfoPromptText($CardCodes[$i],$RecordTypes[$j]);
		print "\nTotalsDescription = " . $ernexResponse->getTotalsDescription($CardCodes[$i],$RecordTypes[$j]);
	}
}
?>
