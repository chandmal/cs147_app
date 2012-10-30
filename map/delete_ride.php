<?php

$path = '/afs/ir.stanford.edu/users/h/o/holstein/cgi-bin/dev/cs147_app/lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('db.php');

$id = $_POST['id'];

if($id) {
	mysql_query("DELETE FROM rides WHERE id=$id");
}

?>