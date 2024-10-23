<?php

	// PROJECT COMMENTING
	
	if($action == 'post_comment')
		{
			$process_comment = true;
			$comment_posted = false;
			
			include('functions/strip_html_tags.php'); // Load strip tags function
			
			$comment = trim(mysql_real_escape_string(POST('comment','')));
			$capt_code = mysql_real_escape_string(POST('capt_code',''));
			$builder_id = mysql_real_escape_string(POST('builder_id',0));
			
			$comment = strip_html_tags($comment);
			
			// Censor profanity
			
			include('inc/profanity.php');
			
			foreach($profanity as $bad_word) :
			
				$comment = str_replace($bad_word,str_pad('*',strlen($bad_word),'*',STR_PAD_RIGHT),$comment);
			
			endforeach;
			
			$post_comment_error = true;
			$post_comment_errs = array();
			$error_fields = array();
			
			include('functions/securimage/securimage.php');
			$securimage = new Securimage();
			$capt_valid = $securimage->check($capt_code);
			
			if(strlen($comment) > 0 && $capt_valid)
				{
					$post_comment_error = false;
					$post_comment_SQL = "INSERT INTO `project_comments` (`comment_id`,`comment_posted`,`comment_builder`,`comment_project`,`comment_comment`) VALUES (NULL,'".date('c')."','".$builder_id."','".$project['project_id']."','".$comment."')";
					//echo $post_comment_SQL; exit;
					$post_comment = db_insert($post_comment_SQL);
					
					if($post_comment)
						{				
							$comment_posted = true;
							$process_comment = false;
							
							// Regenerate comments for current project page
							
							$get_comments = get_comments($project['project_id']);
							$project_comments = ($get_comments['num_comments']) ? $get_comments['data'] : array();
							$smarty->assign('project_comments',$project_comments);
							$smarty->assign('num_comments',$get_comments['num_comments']);
						}
					else
						{
							$post_comment_error = true;
							$post_comment_errs[] = 'Comment could not be posted.';
						}
				}
			
			if(strlen($comment) == 0)
				{
					$post_comment_error = true;
					$post_comment_errs[] = 'Please enter a comment.';
					$error_fields[] = 'comment';
				}
				
			if($capt_valid == false)
				{
					$post_comment_error = true;
					$post_comment_errs[] = 'Incorrect code entered.';
					$error_fields[] = 'capt_code';
				}
				
			$smarty->assign('post_comment_error',$post_comment_error);
			$smarty->assign('post_comment_errs',$post_comment_errs);			
			$smarty->assign('error_fields',$error_fields);
		}
	else
		{
			$comment_posted = false;
			$process_comment = false;
		}
	$smarty->assign('comment_posted',$comment_posted);
	$smarty->assign('process_comment',$process_comment);

?>