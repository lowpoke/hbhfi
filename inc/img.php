<?php

	include('../functions/image_editor.php');
	
	$show_output = false;
	
	$dimension = $_GET['dimension'];
	
	if($dimension != 'original')
		{
			if(substr($dimension,0,1) == 'w')
				{
					$w = substr($dimension,1,10);
					$h = '-';
					$resize_type = 'width';
					$resize_dimension = $w;
				}
			elseif(substr($dimension,0,1) == 'h')
				{
					$h = substr($dimension,1,10);
					$w = '-';
					$resize_type = 'height';
					$resize_dimension = $h;
				}
			elseif(substr($dimension,0,1) == 'c')
				{
					$crop = substr($dimension,1,10);
					$resize_type = 'crop';
					$resize_dimension = $crop;
					$w = $crop;
					$h = $crop;
				}
			elseif(substr($dimension,0,1) == 's')
				{
					$WxH = substr($dimension,1,10);
					$resize_type = 'scale';
					
					$WxH = explode('x',$WxH);
					$w = $WxH[0];
					$h = $WxH[1];
					
					if($w > $h)
						{
							$new_orientation = 'landscape';
						}
					elseif($h > $w)
						{
							$new_orientation = 'portrait';
						}	
					
					$resize_dimension = $dimension;
				}
		}
	
	
	$image = $_GET['image'];
	$folder = (isset($_GET['folder'])) ? $_GET['folder'].'/' : '' ;
	
	$image_path = '../images/'.$folder;
	
	$full_path = $image_path.$image;
	
	$generate_thumb = new ImageEditor($image, $image_path);
	
	$image_size = getimagesize($full_path);
	$image_width = $image_size[0];
	$image_height = $image_size[1];
	
	// Get image orientation
	
	if($image_width > $image_height)
		{
			$original_orientation = 'landscape';
		}
	elseif($image_height > $image_width)
		{
			$original_orientation = 'portrait';
		}
	elseif($image_width == $image_height)
		{
			$original_orientation = 'square';
		}
		

if($show_output == true)
	{
		echo '<p>image path = '.$image_path.'</p>';
		echo '<p>filename = '.$image.'</p>';		
		echo '<p>folder = '.$folder.'</p>';
		echo '<p>full path = '.$full_path.'</p>';
		echo '<p>resize width = '.$w.'</p>';
		echo '<p>resize height = '.$h.'</p>';
		echo '<p>resize type = '.$resize_type.'</p>';
		echo '<p>orientation = '.$orientation.'</p>';
		echo '<p>new orientation = '.$new_orientation.'</p>';
		echo '<p>original width = '.$image_width.'px</p>';
		echo '<p>original height = '.$image_height.'px</p>';
	}
	
	
	if($resize_type == 'height')
		{	
			$image_ratio = $image_width / $image_height;					
			$new_height = $h;
			$new_width = intval($new_height * $image_ratio);
			$crop_x = 0;
			$crop_y = 0;
			$crop_w = $new_width;
			$crop_h = $new_height;
		}
	elseif($resize_type == 'width')
		{	
			$image_ratio = $image_height / $image_width;					
			$new_width = $w;
			$new_height = intval($new_width * $image_ratio);
			$crop_x = 0;
			$crop_y = intval(($new_height - 246) / 2);
			$crop_w = $new_width;
			$crop_h = 246;
		}
	elseif($resize_type == 'crop')
		{	
			if($original_orientation == 'landscape')
				{
					$image_ratio = $image_width / $image_height;
					$new_width = ceil($crop * $image_ratio);
					$new_height = $crop;
					$crop_h = $crop;
					$crop_w = $crop;
					$crop_y = 0;
					$crop_x = intval(($new_width - $crop) / 2);
				}
			elseif($original_orientation == 'portrait')
				{
					$image_ratio = $image_height / $image_width;
					$new_width = $crop;
					$new_height = ceil($crop * $image_ratio);
					$crop_h = $crop;
					$crop_w = $crop;
					$crop_y = intval(($new_height - $crop) / 2);
					$crop_x = 0;
				}
		}
	elseif($resize_type == 'scale')
		{	
			if($new_orientation == 'landscape')
				{
					if($original_orientation == 'landscape')
						{
							$image_ratio = $image_width / $image_height;
							$new_height = $h;
							$new_width = ceil($h * $image_ratio);
							$crop_w = $w;
							$crop_h = $h;
							$crop_y = 0;
							$crop_x = intval(($new_width - $w) / 2);
						}
					elseif($original_orientation == 'portrait')
						{
							$image_ratio = $image_height / $image_width;
							$new_height = ceil($w * $image_ratio);
							$new_width = $w;
							$crop_w = $w;
							$crop_h = $h;
							$crop_y = intval(($new_height - $h) / 2);
							$crop_x = 0;
						}
				}
			elseif($new_orientation == 'portrait')
				{
					if($original_orientation == 'portrait')
						{
							$image_ratio = $image_width / $image_height;
							$new_height = $h;
							$new_width = ceil($h * $image_ratio);
							$crop_w = $w;
							$crop_h = $h;
							$crop_y = 0;
							$crop_x = intval(($new_width - $w) / 2);
						}
					if($original_orientation == 'landscape')
						{
							$image_ratio = $image_width / $image_height;
							$new_height = $h;
							$new_width = ceil($h * $image_ratio);
							$crop_w = $w;
							$crop_h = $h;
							$crop_y = 0;
							$crop_x = intval(($new_width - $w) / 2);
						}
				}
		}

	


if($show_output == true)
	{
		echo '<p>image ratio = '.$image_ratio.'</p>';
		echo '<p>crop width = '.$crop_w.'</p>';		
		echo '<p>crop height = '.$crop_h.'</p>';		
		echo '<p>crop x = '.$crop_x.'</p>';		
		echo '<p>crop y = '.$crop_y.'</p>';
	}
	
	
	
	
	
	$use_cache = false;
	
	
	// Check CACHE
	
	$is_cached = false;
	
	if($use_cache == true)
		{
	
			$cache_filename = strtoupper(md5($image.$resize_type.$resize_dimension)).'.jpg';
			
			if(file_exists('../images/cache/'.$cache_filename))
				{
					$is_cached = true;
				}
			else
				{
					$is_cached = false;
				}
				
		}
		
	
	
if($show_output == true)
	{
		echo '<p>is cached = ';
		echo ($is_cached == true) ? 'yes' : 'no' ;
		echo '</p>';
		echo '<p>cache filename = '.$cache_filename.'</p>';	
		
		exit;
	}
	
	
	
	
	######  MAKE ALTERATIONS TO IMAGE  ######
	
	if($resize_type == 'width' || $resize_type == 'height')
		{
			if($dimension != 'original' || $image_width != $new_width || $image_height != $new_height)
				{
					$generate_thumb->resize($new_width, $new_height);
				}
		}
	elseif($resize_type == 'crop')
		{
			$generate_thumb->resize($new_width, $new_height);
			$generate_thumb->crop($crop_x,$crop_y,$crop_w,$crop_h);
		}
	elseif($resize_type == 'scale')
		{
			$generate_thumb->resize($new_width, $new_height);
			$generate_thumb->crop($crop_x,$crop_y,$crop_w,$crop_h);
		}
		
	
	######  OUTPUT IMAGE  ######
		
	
	if($is_cached == false && $use_cache == true)
		{
			$generate_thumb->outputFile($cache_filename, "../images/cache/");  // Cache the image
			$generate_thumb->outputImage();  // Output resized image to browser
		}
	elseif($use_cache == false)
		{
			$generate_thumb->outputImage();  // Output resized image to browser
		}
	elseif($is_cached == true && $use_cache == true)
		{	
			#send_image_header($image_ext);
			header('Content-Type: image/jpeg'); 
			$file_p = '../images/cache/'.$cache_filename;
			$handle = fopen($file_p, "rb");
			$contents = fread($handle, filesize($file_p));
			echo $contents;  // Output cached image to browser
		}
		
	#$generate_thumb->outputImage();  // Output resized image to browser

?>