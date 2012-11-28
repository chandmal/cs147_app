<?php

$path = '/afs/ir.stanford.edu/users/h/o/holstein/cgi-bin/dev/cs147_app/lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('db.php');

$time = time();
$event = $_GET['event'];
$session_id = session_id();

mysql_query("INSERT INTO tracking (time, event, session_id) VALUES ($time, '$event', '$session_id')");
echo mysql_error();

?>