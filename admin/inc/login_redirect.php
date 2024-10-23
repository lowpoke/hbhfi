<?php


	//echo md5('noahs').'<br />';
	//echo md5('nedlyt43');


	if($action == 'login')
		{
			$user = (isset($_POST['user'])) ? $_POST['user'] : '';
			$pass = (isset($_POST['pass'])) ? $_POST['pass'] : '';
			
			// Encrypt username and password.
			
			$user = md5($user);
			$pass = md5($pass);			
			
			$valid_login = false;
					
			if($user == 'feacf6dd8684711fb0ad778fa08c5511' && $pass == '8f92ce445fa102ee1ec84afe6425f543')
				{ 
					$valid_login = true;
					$_SESSION['admin_logged_in'] = true;
					#echo "Valid! &nbsp; "."Location: ".ROOT.'admin';
					$redir = ROOT."admin/Home";
					#echo $redir.'<br />';
					header("Location: ".$redir);
					#echo ($_SESSION['admin_logged_in'] == true) ? 'TRUE' : 'FALSE' ;
					#exit;
				}
			else
				{
					$valid_login = false;
					#echo "Invalid! &nbsp; "."Location: ".ROOT.'admin'; exit;
				}


		}
	elseif($action == 'logout')
		{
			$_SESSION['admin_logged_in'] = false;
			header("Location: ".ROOT."admin");
		}
		
?>