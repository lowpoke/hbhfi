<?php

$get_images_SQL = "SELECT image_filename FROM project_images WHERE image_id = {$image_id} AND image_project = {$project_id}";
$get_images = db_select($get_images_SQL);


if ($get_images['num_rows'] == 0)
{
	$error_text = '<li>Unable to delete image</li>';
	$post_valid = false;
	$smarty->assign('post_valid',$post_valid);
	$smarty->assign('error_text',$error_text);
	return;
}


$upload_directory = 'images/projects/'.$project_id.'/';

$to_delete = array();
$to_delete[] = $upload_directory.'originals/'.$get_images['result'][0]['image_filename'];
$to_delete[] = $upload_directory.$get_images['result'][0]['image_filename'];


$num_errors = 0;

$delete_image_SQL = "DELETE FROM `project_images` WHERE `image_id` = {$image_id} AND `image_project` = {$project_id}";
$delete_image = db_delete($delete_image_SQL);


foreach($to_delete as $file)
{
	@unlink($file);
}


if($delete_image)
	{
		header("Location: ".ROOT."update/{$project_id}/images");
		exit;
	}
else
	{
		$error_text = '<li>Unable to delete image</li>';
		$post_valid = false;
		$smarty->assign('post_valid',$post_valid);
		$smarty->assign('error_text',$error_text);
	}

