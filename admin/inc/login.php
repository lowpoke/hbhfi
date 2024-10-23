<?php
	
	if($action == 'login')
		{
			$user = POST('user','');
			$pass = md5(POST('pass',''));
		
			$auth_SQL = "SELECT * FROM `user_accounts` WHERE `Username` = '".$user."' AND `Password` = '".$pass."' AND `Active` = 1 LIMIT 1";
			$auth = db_select($auth_SQL);
			
			if($auth['num_rows'] > 0)
				{
					$login_result = '';
					$current_user = $auth['result'][0]['Username'];
					define(USER,$current_user);
					$_SESSION['current_user'] = $current_user;
					$_SESSION['admin_logged_in'] = true;
					header("Location: home");
				}
			else
				{
					$login_result = 'Incorrect username or password';
				}
				
			$smarty->assign('login_result',$login_result);
			
		}	
	
?>