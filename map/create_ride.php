<?php

$path = '/afs/ir.stanford.edu/users/h/o/holstein/cgi-bin/dev/cs147_app/lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('db.php');

$user = $_SESSION['user'];
$type = $_SESSION['user_type'];
$latitude = mysql_real_escape_string($_POST['lat']);
$longitude = mysql_real_escape_string($_POST['long']);
$pay = mysql_real_escape_string($_POST['pay']);
$leave_time = mysql_real_escape_string($_POST['leave_time']);
$return_time = mysql_real_escape_string($_POST['return_time']);

$leave_time = strtotime($leave_time);
$return_time = strtotime($return_time);
if($leave_time < time()) {
	$leave_time += 86400;
	$return_time += 86400;
}

if($return_time < time()) $return_time += 86400;

mysql_query("INSERT INTO rides (user, type, latitude, longitude, pay, leave_time, return_time) VALUES ($user, '$type', '$latitude', '$longitude', '$pay', $leave_time, $return_time)");
echo mysql_error();
echo mysql_insert_id();

?>
