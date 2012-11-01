<?

require_once('common.php');

// Set request-specific fields.
$paymentAmount = urlencode('$15');
$currencyID = urlencode('USD');							// or other currency code ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
$paymentType = urlencode('Authorization');				// or 'Sale' or 'Order'
 
$returnURL = urlencode("http://stanford.edu/~holstein/cgi-bin/dev/cs147_app/lib/paypal/do_express_checkout.php");
$cancelURL = urlencode("http://stanford.edu/~holstein/cgi-bin/dev/cs147_app/lib/paypal/canel.php");
 
// Add request-specific fields to the request string.
$nvpStr = "&Amt=$paymentAmount&ReturnUrl=$returnURL&CANCELURL=$cancelURL&PAYMENTACTION=$paymentType&CURRENCYCODE=$currencyID";
 
// Execute the API operation; see the PPHttpPost function above.
$httpParsedResponseAr = PPHttpPost('SetExpressCheckout', $nvpStr);
 
if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
	// Redirect to paypal.com.
	$token = urldecode($httpParsedResponseAr["TOKEN"]);
	$payPalURL = "https://www.paypal.com/webscr&cmd=_express-checkout&token=$token";
	if("sandbox" === $environment || "beta-sandbox" === $environment) {
		$payPalURL = "https://www.$environment.paypal.com/webscr&cmd=_express-checkout&token=$token";
	}
	header("Location: $payPalURL");
	exit;
} else  {
	exit('SetExpressCheckout failed: ' . print_r($httpParsedResponseAr, true));
}
 
?>