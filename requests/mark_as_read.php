<?php

$path = '/afs/ir.stanford.edu/users/h/o/holstein/cgi-bin/dev/cs147_app/lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('db.php');

$id = $_POST['id'];
if(!$id) exit;

mysql_query("UPDATE requests SET is_new = 0 WHERE id=$id");
echo mysql_error();

?>