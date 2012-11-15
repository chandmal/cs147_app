<?php

$path = '/afs/ir.stanford.edu/users/h/o/holstein/cgi-bin/dev/cs147_app/lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('db.php');

$username = mysql_real_escape_string($_POST['username']);
$password = mysql_real_escape_string($_POST['password']);

$user = mysql_query("SELECT * from users WHERE username='$username' AND password='$password'");

if(mysql_num_rows($user) == 0) {
	send_response(0, "Invalid username and password.");
}

$user = mysql_fetch_array($user);
$_SESSION['user'] = $user['id'];

send_response(1);

function send_response($status, $message="") {
	$response = array();
	$response[0] = $status;
	$response[1] = $message;
	echo json_encode($response);
	exit;
}

?>