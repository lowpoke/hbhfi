<?php
	
	$logged_in = (isset($_SESSION['admin_logged_in'])) ? $_SESSION['admin_logged_in'] : false ;
	
	$smarty->assign('logged_in',$logged_in);

?>