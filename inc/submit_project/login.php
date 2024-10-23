<?php

	$smarty->assign('save_action','login');
	
	$login_email = POST('login_email','');
	$login_password = POST('login_password','');
	
	$login = $Auth->Process_Login($login_email,$login_password);
	
	if($login)
		{
			require('inc/submit_project/initiate_project.php');
			$new_project_id = initiate_project();
			
			$post_valid = true;
			
			$_SESSION['sub_in_progress'] = true;
			$_SESSION['current_step'] = 1;
			
			header("Location: ".ROOT."submit/details");
		}
	else
		{
			$post_valid = false;
			$validation_text = $Auth->login_result;
			$smarty->assign('post_valid',$post_valid);
			$smarty->assign('validation_text',$validation_text);
			$smarty->assign('process_login',true);
			$smarty->assign('login_result',$Auth->login_result);
			$smarty->assign('login_valid',$Auth->login_valid);
		}
						
?>