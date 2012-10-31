<?php

$path = '/afs/ir.stanford.edu/users/h/o/holstein/cgi-bin/dev/cs147_app/lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('db.php');
require_once('user.php');

$to_user = mysql_real_escape_string($_POST['to_user']);
$from_user = $_SESSION['user'];
$ride_id = mysql_real_escape_string($_POST['ride_id']);
$confirmed = 0;

$identical_request = mysql_query("SELECT * FROM requests WHERE to_user=$to_user AND from_user=$from_user AND ride_id=$ride_id");
if(mysql_num_rows($identical_request) > 0) exit;

mysql_query("INSERT INTO requests (to_user, from_user, ride_id, confirmed) VALUES ($to_user, $from_user, $ride_id, $confirmed)");
echo mysql_error();

?>