<?php

	$page_template = 'project.htm';
	$page_type = 'file';
	
	$project_id = mysql_real_escape_string(GET('project_id',0));
	$project_exists = true;
	
	// Include project display functions
	
	include('inc/get_project.php');
	
	
	// Get project data
	
	$get_project = get_project($project_id);
	
	if($get_project['exists'])
		{
			$project_exists = true;
			$project = $get_project['data'];
			
			// Safen for HTML
			
			foreach ($project as $key => $val) {
				$project[$key] = strip_tags($val, '<br>');
			}
			
			// Get images for this project
			
			$get_images = get_images($project['project_id']);
			$project_images = ($get_images['num_images']) ? $get_images['data'] : array();
			$smarty->assign('project_images',$project_images);
			
			// Get comments for this project
			
			$get_comments = get_comments($project['project_id']);
			$project_comments = ($get_comments['num_comments']) ? $get_comments['data'] : array();
			$smarty->assign('project_comments',$project_comments);
			$smarty->assign('num_comments',$get_comments['num_comments']);
			
			$smarty->assign('project',$project);
			$smarty->assign('project_category',$project['category_slug']);
			
			// Update project views for popularity
			
			$update_views_SQL = "UPDATE `projects` SET `project_views` = `project_views` + 1 WHERE `project_id` = '".$project['project_id']."'";
			$update_views = db_update($update_views_SQL);
			
			// Is this project owned by the current user?
			
			if ($project['project_builder'] == $Auth->Current_User()) {
				$smarty->assign('owned_by_user', true);
			} else {
				$smarty->assign('owned_by_user', false);
			}
			
			// Is there a video?
			
			if ($project['project_youtube']) {
				$smarty->assign('video_embed', youtube_embed($project['project_youtube'], 605, 340));
			} else {
				$smarty->assign('video_embed', null);
			}
		}
	else
		{
			$project_exists = false;
		}
	
	$smarty->assign('project_exists',$project_exists);
	
	// PROJECT COMMENTING
	include('inc/projects/post_comment.php');
	
		
?>
