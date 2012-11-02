<?php

$path = '/afs/ir.stanford.edu/users/h/o/holstein/cgi-bin/dev/cs147_app/lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('db.php');

$user_id = $_SESSION['user'];
$type = mysql_real_escape_string($_SESSION['user_type'] == "driver" ? "rider" : "driver");
$leave_time = mysql_real_escape_string($_GET['leave_time']);
$return_time = mysql_real_escape_string($_GET['return_time']);

$leave_time = strtotime($leave_time);
$return_time = strtotime($return_time);

$time = time();

$result = mysql_query("SELECT * FROM rides WHERE (type='$type' OR user=$user_id) AND leave_time > $time AND is_show=1");

$rides = array();
while($row = mysql_fetch_array($result)) {
	$row['leave_time'] = timestamp_to_time($row['leave_time']);
	$row['return_time'] = timestamp_to_time($row['return_time']);
	$rides[] = $row;
}

echo json_encode($rides);

?>