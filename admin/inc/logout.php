<?php
	
	$current_user = '';
	define(USER,$current_user);
	$_SESSION['current_user'] = $current_user;
	$_SESSION['admin_logged_in'] = false;
	
	header("Location: login");
	
?>