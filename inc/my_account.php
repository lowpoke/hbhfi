<?php

	$page_template = 'my_account.htm';
	$page_type = 'file';
	
	include('inc/get_projects.php');
	include('inc/get_project.php');
		
	$projects = get_projects('builder:'.$user_details['builder_id'],'','','html_array');
	
	$num_projects = $projects['num_projects'];
	$html_array = $projects['html_array'];
	
	$projects_html = '';
	
	for($p=0; $p<$num_projects; $p++)
		{
			if(array_key_exists($p,$html_array))
				{
					$projects_html .= $html_array[$p];
				}			
		}
	
	$smarty->assign('num_projects',$num_projects);
	$smarty->assign('projects_html',$projects_html);
	
	// Get comments by this builder
			
	$get_comments = get_comments('builder:'.$user_details['builder_id'],'`comment_posted` DESC','4',true);
	$builder_comments = ($get_comments['num_comments']) ? $get_comments['data'] : array();
	$smarty->assign('builder_comments',$builder_comments);
	$num_comments = $get_comments['num_comments'];
	$smarty->assign('num_comments',$num_comments);
			
?>