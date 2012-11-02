<?

require_once('common.php');

// Set request-specific fields.
$paymentAmount = urlencode('15');
$currencyID = urlencode('USD');							// or other currency code ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
$paymentType = urlencode('Authorization');				// or 'Sale' or 'Order'

$returnURL = "http://stanford.edu/~holstein/cgi-bin/dev/cs147_app/requests/accept_request.php?redirect=confirm&id=".$_GET['request_id'];
$cancelURL = "http://stanford.edu/~holstein/cgi-bin/dev/cs147_app/requests/new.php";
 
$params['METHOD']='SetExpressCheckout';
$params['RETURNURL']= $returnURL;
$params['CANCELURL']= $cancelURL;
$params['PAYMENTREQUEST_0_PAYMENTACTION']='Sale';
$params['L_PAYMENTREQUEST_0_NAME0']='Your Share-A-Ride';
$params['L_PAYMENTREQUEST_0_DESC0']='With '.$_GET['first_name'];
$params['L_PAYMENTREQUEST_0_AMT0']=$_GET['pay'];
$params['L_PAYMENTREQUEST_0_QTY0']="1";
$params['PAYMENTREQUEST_0_AMT']= $_GET['pay'];
$params['PAYMENTREQUEST_0_CURRENCYCODE']="USD";

// Add request-specific fields to the request string.
$nvpStr = "&".http_build_query($params);

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