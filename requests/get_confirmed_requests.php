<?php

$path = '/afs/ir.stanford.edu/users/h/o/holstein/cgi-bin/dev/cs147_app/lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('db.php');

$user_id = $_SESSION['user'];

$time = time();

$result = mysql_query("SELECT DISTINCT requests.* FROM requests requests, rides rides WHERE (requests.to_user = $user_id OR requests.from_user = $user_id) AND requests.confirmed=1 AND (rides.return_time  + 3600 > $time) AND rides.id = requests.ride_id ORDER BY requests.id DESC");

if(!$result) exit;

$requests = array();
while($row = mysql_fetch_array($result)) {
	$tmp['request'] = $row;
	$other_user = $user_id == $row['to_user'] ? $row['from_user'] : $row['to_user'];
	$other_user = mysql_query("SELECT * FROM users WHERE id=$other_user");
	$other_user = mysql_fetch_array($other_user);
	$tmp['other_user'] = $other_user;
	$ride = $row['ride_id'];
	$ride = mysql_query("SELECT * FROM rides WHERE id=$ride");
	$ride = mysql_fetch_array($ride);
	$ride['leave_time'] = timestamp_to_time($ride['leave_time']);
	$ride['return_time'] = timestamp_to_time($ride['return_time']);
	$tmp['ride'] = $ride;
	$requests[] = $tmp;
}

echo json_encode($requests);

?>