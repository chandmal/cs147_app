<?php

$path = '/afs/ir.stanford.edu/users/h/o/holstein/cgi-bin/dev/cs147_app/lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('db.php');

$user_id = $_SESSION['user'];

$time = time();
$result = mysql_query("SELECT * FROM requests, rides, users WHERE requests.ride_id = rides.id AND requests.from_user=$user_id AND requests.confirmed=0 AND rides.leave_time > $time AND users.id = requests.to_user ORDER BY requests.id DESC");
if(!$result) exit;

$requests = array();
while($row = mysql_fetch_array($result)) {
	$requests[] = $row;
}

echo json_encode($requests);

?>