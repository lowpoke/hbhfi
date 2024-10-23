<?php

	$lib_root = '../../';
	
	require($lib_root.'../config.php');
	require($lib_root.'functions/db_functions.php');
	require($lib_root.'functions/main_functions.php');
	require($lib_root.'functions/smarty/Smarty.init.php');
	
	$mochaCMS = smarty_init($lib_root.'functions/smarty/','../templates');
	
	
	$folders = folder_list('../../images/',array('multi','old','cache'));
	$folders_array = array();
	
	$cur_gallery = GET('gallery',1);
	
	for($f=0; $f<count($folders); $f++)
		{
			$images = image_list('../../images/'.$folders[$f]['name'],array());
						
			for($i=0; $i<count($images); $i++)
				{
					$folders_array[$folders[$f]['name']][$i]['test'] = 'ggg';
					$folders_array[$folders[$f]['name']][$i]['name'] = $images[$i]['name'];
					$folders_array[$folders[$f]['name']][$i]['path'] = $images[$i]['path'];
					$folders_array[$folders[$f]['name']][$i]['folder'] = $folders[$f]['name'];					
				}		
		}
	
	
	//echo var_dump($folders_array);
	
	
	$mochaCMS->assign('folders',$folders_array);
	$mochaCMS->assign('cur_gallery',$cur_gallery);
	$mochaCMS->assign('ROOT',ROOT);
	$mochaCMS->display('select_images.html');
	
?>