<?

$path = '/afs/ir.stanford.edu/users/h/o/holstein/cgi-bin/dev/cs147_app/lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('db.php');

$first_name = mysql_real_escape_string($_POST['first_name']);
$last_name = mysql_real_escape_string($_POST['last_name']);
$username = mysql_real_escape_string($_POST['username']);
$password = mysql_real_escape_string($_POST['password']);
$school_email = mysql_real_escape_string($_POST['school_email']);
$phone = mysql_real_escape_string($_POST['phone']);
$paypal_email = mysql_real_escape_string($_POST['paypal_email']);

$others_with_username = mysql_query("SELECT COUNT(*) from users WHERE username='$username'");
$others_with_username = mysql_fetch_array($others_with_username);
$others_with_username = $others_with_username[0];

if($others_with_username > 0) {
	send_response(0, "That username is taken. Try another one.");
}

mysql_query("INSERT INTO users(first_name, last_name, username, password, school_email, phone, paypal_email) VALUES ('$first_name', '$last_name', '$username', '$password', '$school_email', '$phone', '$paypal_email')");

$_SESSION['user'] = mysql_insert_id();

send_response(1);

function send_response($status, $message="") {
	$response = array();
	$response[0] = $status;
	$response[1] = $message;
	echo json_encode($response);
	exit;
}


?>