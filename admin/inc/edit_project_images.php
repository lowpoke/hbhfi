<?php

	$get_project_SQL = "SELECT * FROM `projects` WHERE `project_id` = '".GET('ID',NULL)."'";
	$get_project = db_select($get_project_SQL);
	
	$project = array();
	
	if($get_project['num_rows'] > 0)
		{
			$project = $get_project['result'][0];
		}

	$smarty->assign('project',$project);
	

	$thumbnail = array();
	$get_thumbnail_SQL = "SELECT * FROM `project_images` WHERE `image_type` = 'thumbnail' AND `image_project` = '".GET('ID',NULL)."'";
	$get_thumbnail = db_select($get_thumbnail_SQL);
	
	if($get_thumbnail['num_rows'] > 0)
		{
			$thumbnail = $get_thumbnail['result'][0];
		}
	
	$get_fullimages_SQL = "SELECT * FROM `project_images` WHERE `image_type` = 'full' AND `image_project` = '".GET('ID',NULL)."'";
	$get_fullimages = db_select($get_fullimages_SQL);
	
	$full_images = array();
	
	if($get_fullimages['num_rows'] > 0)
		{
			for($i=0; $i<$get_fullimages['num_rows']; $i++)
				{
					$full_images[$i] = $get_fullimages['result'][$i];
					$full_images[$i]['original_path'] = '../images/projects/'.$project['project_id'].'/originals/'.$full_images[$i]['image_filename'] ;
										
					if(file_exists($full_images[$i]['original_path']))
						{
							$full_images[$i]['original_link'] = '<a href="'.$full_images[$i]['original_path'].'" target="_blank">View Original</a>';
						}
					else
						{
							$full_images[$i]['original_link'] = '<em>Original not available.</em>';
						}
				}
			
		}

	$smarty->assign('full_images',$full_images);
	$smarty->assign('thumbnail',$thumbnail);
	
	
			
	$page_template = 'edit_project_images.html' ;
	
?>