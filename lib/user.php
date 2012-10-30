<?php

$id = $_SESSION['user'];
$user = mysql_query("SELECT * from users where id=$id");
if(!$user) {
	header('Location: ../login/app.php');
	exit;
}

$user = mysql_fetch_array($user);
if(!$user) {
	header('Location: ../login/app.php');
	exit;
}

?>