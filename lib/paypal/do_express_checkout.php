<?

require_once('common.php');

/**
 * This example assumes that a token was obtained from the SetExpressCheckout API call.
 * This example also assumes that a payerID was obtained from the SetExpressCheckout API call
 * or from the GetExpressCheckoutDetails API call.
 */
// Set request-specific fields.
$payerID = $_GET["PayerID"];
$token = $_GET["token"];
 
$paymentType = urlencode("Authorization");			// or 'Sale' or 'Order'
$paymentAmount = urlencode("50");
$currencyID = urlencode("USD");						// or other currency code ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
 
// Add request-specific fields to the request string.
$nvpStr = "&TOKEN=$token&PAYERID=$payerID&PAYMENTACTION=$paymentType&AMT=$paymentAmount&CURRENCYCODE=$currencyID";
 
// Execute the API operation; see the PPHttpPost function above.
$httpParsedResponseAr = PPHttpPost('DoExpressCheckoutPayment', $nvpStr);
 
if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
	exit('Express Checkout Payment Completed Successfully: '.print_r($httpParsedResponseAr, true));
} else  {
	exit('DoExpressCheckoutPayment failed: ' . print_r($httpParsedResponseAr, true));
}
 
?>