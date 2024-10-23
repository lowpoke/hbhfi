<?php
	
	session_start();
	#session_destroy();
	
	include_once('../../config.php');
	include_once('functions/main_functions.php');
	include_once('functions/db_functions.php');
	include('fckeditor/fckeditor_php5.php');
	
	### Include and initiate Smarty class #############

	require('../functions/smarty/libs/Smarty.class.php');
	$smarty = new Smarty();
	
	$smarty->template_dir = 'templates/';
	$smarty->compile_dir  = '../cache/';
	$smarty->cache_dir    = '../functions/smarty/cache/';
	$smarty->config_dir   = '../functions/smarty/configs/';

	###################################################
	
	
	$page = GET('page','Home');
	$sub_page = GET('sub_page','');
	$page_title = ($page != 'Home') ? $page : '';
	$main_page_title = ($page != 'Home') ? ' [ '.$page_title.' ]' : '';
	
	$action = POST('action',GET('action',''));
	
	//if($page != 'Login') { include('functions/auth.php'); }
	
	
	### CURRENT USER ###
	
	
	$current_user = SESSION('current_user','nick');
	define("USER",$current_user);
	
	// Get current user details
	
	$get_cur_user_SQL = "SELECT * FROM `user_accounts` WHERE `Username` = '".USER."' LIMIT 1";
	$get_cur_user = db_select($get_cur_user_SQL);
	$cur_user = ($get_cur_user['num_rows'] > 0) ? $get_cur_user['result'][0] : array();
	

?>