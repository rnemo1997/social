<?php 
	include 'includes/salt.php';
	$username = 'test';
	$password = 'test';
	$email = 'test';
	$date = date("YMD HiS");
	salt($username, $password, $email, $date);
?>