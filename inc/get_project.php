<?php

	function get_project($id)
		{
	
			$get_project_SQL = "
															SELECT
																projects.project_id,
																projects.project_category,
																projects.project_item,
																projects.project_type,
																projects.project_name,
																projects.project_description,
																projects.project_posted,
																projects.project_youtube,
																builders.builder_id as project_builder,
																builders.builder_short_name,
																builders.builder_first_name,
																builders.builder_last_name,
																builders.builder_country,
																project_categories.category_name,
																project_categories.category_slug,
																project_images.image_filename AS project_thumbnail,
																(SELECT COUNT(project_comments.comment_id) FROM project_comments WHERE project_comments.comment_project = projects.project_id) AS project_comments
															
															FROM
																projects
															
															LEFT JOIN
																builders on projects.project_builder = builders.builder_id
															
															LEFT JOIN
																project_categories on projects.project_category = project_categories.category_id
															
															LEFT JOIN
																project_images on projects.project_thumbnail = project_images.image_id
															
															LEFT JOIN
																project_comments on projects.project_id = project_comments.comment_project
																
															WHERE
																projects.project_id = ".$id."
															
															LIMIT 1
															
			";
									
			$get_project = db_select($get_project_SQL);
			
			$project = array();
			
			$project['exists'] = ($get_project['num_rows'] > 0) ? true : false ;
			$project['data'] = ($project['exists']) ? $get_project['result'][0] : array();
			
			foreach($project['data'] as $key=>$value)
				{
					$project['data'][$key] = stripslashes($value);
				}
				
			$project['data']['project_description'] = nl2br($project['data']['project_description']);
			
			
			return $project;
			
		}
		
	
	
	function get_comments($project_id,$order='',$limit='',$inc_project_details=false)
		{	
			// Get comments for builder or for project
			
			if(substr($project_id,0,8) == 'builder:')
				{
					$where = "project_comments.comment_builder = '".intval(str_replace('builder:','',$project_id))."'";
				}
			else
				{
					$where = "project_comments.comment_project = '".$project_id."'";
				}
				
			// Set order
				
			if(strlen($order) > 0)
				{
					$order = "ORDER BY ".$order ;
				}
				
			// Set limit
				
			if(strlen($limit) > 0)
				{
					$limit = "LIMIT ".$limit ;
				}
			
			
			// Build SQL query
			
			if($inc_project_details == false)
				{		
					$get_comments_SQL = "
															SELECT
																project_comments.comment_id,
																project_comments.comment_posted,
																project_comments.comment_builder,
																project_comments.comment_comment,
																builders.builder_id,
																builders.builder_short_name
																
															FROM
																project_comments
																
															LEFT JOIN
																builders on project_comments.comment_builder = builders.builder_id
															
															WHERE
																".$where."
																
															".$order."
															
															".$limit."																
															
					";
				}
			else
				{
					$get_comments_SQL = "
															SELECT
																project_comments.comment_id,
																project_comments.comment_posted,
																project_comments.comment_builder,
																project_comments.comment_comment,
																builders.builder_id,
																builders.builder_short_name,
																projects.project_id,
																projects.project_item,
																projects.project_name,
																projects.project_type
																
															FROM
																project_comments
																
															LEFT JOIN
																builders on project_comments.comment_builder = builders.builder_id
																
															LEFT JOIN
																projects on project_comments.comment_project = projects.project_id
															
															WHERE
																".$where."
																
															".$order."
															
															".$limit."																
															
					";
				}
						
			//echo $get_comments_SQL;
			
			$get_comments = db_select($get_comments_SQL);
			
			$comments = array();
			
			$comments['num_comments'] = $get_comments['num_rows'];
			$comments['data'] = ($comments['num_comments'] > 0) ? $get_comments['result'] : array();
			
			foreach($comments['data'] as $key1=>$value1)
				{
					foreach($comments['data'][$key1] as $key2=>$value2)
						{
							$comments['data'][$key1][$key2] = stripslashes($value2);
						}
					$comments['data'][$key1]['comment_comment'] = nl2br($comments['data'][$key1]['comment_comment']);
				}
				
			
			return $comments;			
		}
		
	
	
	function get_images($project_id,$image_type='all')
		{	
			$get_images_SQL = "
															SELECT
																project_images.image_id,
																project_images.image_type,
																project_images.image_filename,
																project_images.image_description																
															
															FROM
																project_images
															
															WHERE
																project_images.image_project = ".$project_id."
															
			";
			
			if($image_type != 'all')
				{
					$get_images_SQL .= "AND project_images.image_type = '".$image_type."'";
				}
			
			$get_images = db_select($get_images_SQL);
			
			$images = array();
			
			$images['num_images'] = $get_images['num_rows'];
			$images['data'] = ($images['num_images'] > 0) ? $get_images['result'] : array();
			
			return $images;			
		}


?>
