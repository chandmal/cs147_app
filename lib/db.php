<?php

$link = mysql_connect('mysql-user-master.stanford.edu', 'ccs147holstein', 'thohzair');
mysql_select_db('c_cs147_holstein');

session_start();

function timestamp_to_time($time) {
	return date('D g:ia', $time);
}

?>