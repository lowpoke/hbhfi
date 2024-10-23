<?php
$thumbnail_file = POST('thumbnail_file','');

if(strlen(trim($thumbnail_file)) > 0)
{
	$project_path = 'images/projects/'.$project_id.'/';
	$thumbnail_path = $project_path.$thumbnail_file;
	
	if(file_exists($thumbnail_path))
		{									
			// Check if thumbnail is already in DB, delete if it does
			
			$check_thumb_SQL = "SELECT `image_id`,`image_filename` FROM `project_images` WHERE `image_type` = 'thumbnail' AND `image_project` = '".$project_id."' LIMIT 1";
			$check_thumb = db_select($check_thumb_SQL);
			
			if($check_thumb['num_rows'] > 0)
				{
					// Delete exisitng thumb
					
					$delete_thumb_SQL = "DELETE FROM `project_images` WHERE `image_type` = 'thumbnail' AND `image_project` = '".$project_id."'";
					$delete_thumb = db_delete($delete_thumb_SQL);
				}
			
			$insert_image_SQL = "INSERT INTO `project_images` (`image_id`,`image_type`,`image_filename`,`image_project`,`image_builder`) VALUES (NULL,'thumbnail','".$thumbnail_file."',".$project_id.",23)";
			$insert_image = db_insert($insert_image_SQL);
			
			// Update project with new thumbnail
			
			$save_project_SQL = "UPDATE
									`projects`
								 SET
									`project_thumbnail` = ".$insert_image['insert_ID']."
								WHERE
									`project_id` = ".$project_id;
			$save_project = db_update($save_project_SQL);
			
			header("Location: ".ROOT."update/".$project_id."/confirm");
			exit;
		}
}
