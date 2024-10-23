<?php

$project_youtube =     mysql_real_escape_string(trim(POST('project_youtube','')));


// Validate Fields

$validated = true;
$missing_fields = array();
$error_fields = array();

if ($project_youtube) {
	if (!preg_match('!^http!', $project_youtube)) {
		$validated = false; $missing_fields[] = '<em>&quot;YouTube URL&quot;</em> must be a valid URL'; $error_fields[] = 'project_youtube';
	}
}


// Save project

if($validated)
	{

		$save_project_SQL = "UPDATE
						 			`projects`
								 SET
								 
								 	`project_youtube` = '".$project_youtube."'
								 	
								 WHERE
								 
								 	`project_id` = ".$project_id."";
								 	
		$save_project = db_update($save_project_SQL);
		
		
		if($save_project)
			{
				header("Location: ".ROOT."update/".$project_id."/confirm");
				exit;
			}
		else
			{
				$post_valid = false;
				$validation_text = 'Project data could not be saved.  Please reload to try again.';
				$smarty->assign('post_valid',$post_valid);
				$smarty->assign('validation_text',$validation_text);
			}

		}
	else
		{
			$validation_text = '<strong>Please check the following:</strong><p>';
			
			foreach($missing_fields as $mfield)
				{
					$validation_text .= $mfield.'<br />';
				}
				
			$validation_text .= '</p>';
			
			$post_valid = false;
			$smarty->assign('post_valid',$post_valid);
			$smarty->assign('validation_text',$validation_text);
			$smarty->assign('error_fields',$error_fields);
		}

?>
