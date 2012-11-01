<?php

$path = '/afs/ir.stanford.edu/users/h/o/holstein/cgi-bin/dev/cs147_app/lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('db.php');

$request_id = $_GET['id'];

$request = mysql_query("SELECT * FROM requests WHERE id=$request_id");
$request = mysql_fetch_array($request);

if($request['request_type'] == 'rider_to_driver') {
	$old_from_user = $request['from_user'];
	$old_to_user = $request['to_user'];
	mysql_query("UPDATE requests SET is_new=1, request_type='payment_driver_to_rider', from_user=$old_to_user, to_user=$old_from_user WHERE id = $request_id");
	echo mysql_error();
}

if($request['request_type'] == 'driver_to_rider') {
	mysql_query("UPDATE requests SET confirmed=1, paid=1, is_ new = 1 WHERE id = $request_id");
}

if($request['request_type'] == 'payment_driver_to_rider') {
	mysql_query("UPDATE requests SET confirmed=1, paid=1, is_new = 1 WHERE id = $request_id");
}



?>