<?php

	$lib_root = '../../';
	
	require($lib_root.'../config.php');
	require($lib_root.'functions/db_functions.php');
	require($lib_root.'functions/main_functions.php');
	require($lib_root.'functions/smarty/Smarty.init.php');
	
	$mochaCMS = smarty_init($lib_root.'functions/smarty/','../templates');
	
	$exif = false;
	
	$image_data = array();
	
	$image = GET('image','');
	$image = '../../images/'.$image ;
	
	$img_size = image_size($image);
	$img_exif = @exif_read_data($image, 0, true);
	
	$image_data['path']      = str_replace('../../','',$image);
	$image_data['url']       = ROOT.$image_data['path'];
	$image_data['width']     = $img_size['width'];
	$image_data['height']    = $img_size['height'];
	$image_data['orientation'] = image_orientation($image);
	
	if($img_exif)
		{	
			$image_data['file_name'] = $img_exif['FILE']['FileName'];
			$image_data['file_size'] = $img_exif['FILE']['FileSize'];
			$image_data['file_date'] = returnDateFromUNIX('yyyy-mm-dd h:mmS',$img_exif['FILE']['FileDateTime']);
			$image_data['folder']    = str_replace('/'.$image_data['file_name'],'',$_GET['image']);
			
			
			if($image_data['file_size'] < 1000)
				{
					$image_data['file_size'] .= number_format($image_data['file_size'],2).' bytes';
				}
			elseif($image_data['file_size'] >= 1000 && $image_data['file_size'] < 1000000)
				{
					$image_data['file_size'] = number_format(($image_data['file_size'] / 1024),2).' KB';
				}
			elseif($image_data['file_size'] >= 1000000)
				{
					$image_data['file_size'] = number_format(($image_data['file_size'] / 1000000),2).' MB';
				}
				
			$exif = true;
		}
	

	
	$mochaCMS->assign('image',$image_data);
	$mochaCMS->assign('exif',$exif);
	
	$mochaCMS->assign('ROOT',ROOT);
	
	$mochaCMS->display('image_info.html');
	

?>