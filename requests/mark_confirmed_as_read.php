<?php

$path = '/afs/ir.stanford.edu/users/h/o/holstein/cgi-bin/dev/cs147_app/lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('db.php');
require_once('user.php');

$id = $_POST['id'];
if(!$id) exit;

$resource = mysql_query("SELECT * FROM requests WHERE id=$id");
$request = mysql_fetch_array($resource);
$ride = $request['ride_id'];
$ride = mysql_query("SELECT * FROM rides WHERE id=$ride");
$ride = mysql_fetch_array($ride);

$field_to_change = "";
if($ride['type'] == "driver") {
	$field_to_change = $_SESSION['user'] == $ride['user'] ? "is_new_for_driver" : "is_new_for_rider";
} else {
	$field_to_change = $_SESSION['user'] == $ride['user'] ? "is_new_for_rider" : "is_new_for_driver";
}

mysql_query("UPDATE requests SET $field_to_change = 0 WHERE id=$id");

?>