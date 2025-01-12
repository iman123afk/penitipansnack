<?php 
	session_start();
	$_SESSION = [];
	session_unset();
	session_destroy();

	setcookie('id', '', time() - 500);
	setcookie('key', '', time() - 500);

	header("Location: login.php")

?>