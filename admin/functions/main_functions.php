<?php

	function POST($post_var,$null_return)
		{
			$post_var = (isset($_POST[$post_var])) ? $_POST[$post_var] : $null_return ;
			return $post_var;
		}
		
	function GET($get_var,$null_return)
		{
			$get_var = (isset($_GET[$get_var])) ? $_GET[$get_var] : $null_return ;
			return $get_var;
		}
		
	function SESSION($sess_var,$null_return)
		{
			$sess_var = (isset($_SESSION[$sess_var])) ? $_SESSION[$sess_var] : $null_return ;
			return $sess_var;
		}
		
		function valid_email($email) {
  	// First, we check that there's one @ symbol, and that the lengths are right
	  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email))
			{
	    	// Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
	    	return false;
 		 	}
  
		// Split it into sections to make life easier
		$email_array = explode("@", $email);
		$local_array = explode(".", $email_array[0]);
		
		for ($i = 0; $i < sizeof($local_array); $i++)
			{
				if (!ereg("^(([A-Za-z0-9!#$%&#038;'*+/=?^_`{|}~-][A-Za-z0-9!#$%&#038;'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) { return false; }
  		}  
  
		if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1]))
			{
				// Check if domain is IP. If not, it should be valid domain name
				$domain_array = explode(".", $email_array[1]);
				if (sizeof($domain_array) < 2)
					{
						return false; // Not enough parts to domain
					}
    		
				for ($i = 0; $i < sizeof($domain_array); $i++)
					{
						if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i]))
							{
								return false;
      				}
    			}
  		}
  	return true;
	}
	
	
	
	function returnDate($date_format)
		{
			switch($date_format)
				{
					case 'dd/mm/yyyy'       : $return_date = date('d/m/Y'); break;
					case 'd/m/yy'           : $return_date = date('j/n/y'); break;
					case 'yyyy-mm-dd h:mmS' : $return_date = date('Y-m-d g:iA'); break; 
					case 'yyyy-mm-dd-h:mm:sS' : $return_date = date('Y-m-d_g-i-sA'); break; 
					case 'yyyy-mm-dd'       : $return_date = date('Y-m-d'); break; 
					case 'D, M Ds Y'        : $return_date = date('l, F jS Y'); break; 
					case 'h:mmS'            : $return_date = date('g:iA');  break;
					case 'D, M Ds Y h:mmS'  : $return_date = date('l, F jS Y').' &nbsp; '.date('g:iA'); break;
					case 'yyyymmddhhmm'     : $return_date = date('YmdHi'); break; 
					case 'mysql'            : $return_date = date('Y-m-d H:i:s'); break; 
				}
			
			return $return_date ;
		}
		
	function returnDateFromUNIX($date_format,$U)
		{
			switch($date_format)
				{
					case 'dd/mm/yyyy'       : $return_date = date('d/m/Y',$U); break;
					case 'd/m/yy'           : $return_date = date('j/n/y',$U); break;
					case 'yyyy-mm-dd h:mmS' : $return_date = date('Y-m-d g:iA',$U); break; 
					case 'D, M Ds Y'        : $return_date = date('l, F jS Y',$U); break; 
					case 'M jS, Y'          : $return_date = date('M jS, Y',$U); break; 
					case 'h:mmS'            : $return_date = date('g:iA',$U);  break;
					case 'D, M Ds Y h:mmS'  : $return_date = date('l, F jS Y',$U).' &nbsp; '.date('g:iA',$U); break; 					
					case 'mysql'            : $return_date = date('Y-m-d H:i:s',$U); break; 
				}
			
			return $return_date ;
		}
		
		
	function parse_date($input,$output)
		{
			$date = array();
			$date['year']    = intval(substr($input,0,4));
			$date['month']   = intval(substr($input,4,2));
			$date['day']     = intval(substr($input,6,2));
			$date['hour']    = intval(substr($input,8,2));
			$date['minute']  = intval(substr($input,10,2));
			$date['second'] = intval(substr($input,12,2));
			
			$date['stamp'] = mktime($date['hour'],$date['minute'],$date['second'],$date['month'],$date['day'],$date['year']);
			$U = $date['stamp'];
			
			switch($output)
				{
					case 'dd/mm/yyyy'       : $return_date = date('d/m/Y',$U); break;
					case 'd/m/yy'           : $return_date = date('j/n/y',$U); break;
					case 'yyyy-mm-dd h:mmS' : $return_date = date('Y-m-d g:iA',$U); break; 
					case 'D, M Ds Y'        : $return_date = date('l, jS F Y',$U); break; 
					case 'M jS, Y'          : $return_date = date('M jS, Y',$U); break; 
					case 'h:mmS'            : $return_date = date('g:iA',$U);  break;
					case 'D, M Ds Y h:mmS'  : $return_date = date('l, jS F Y',$U).' '.date('g:iA',$U); break; 
					case 'year'             : $return_date = $date['year'];  break;
					case 'month_str'        : $return_date = date('F',$U); break;
					case 'month'            : $return_date = $date['month'];  break;
					case 'day_str'          : $return_date = date('l',$U); break;
					case 'day'              : $return_date = $date['day'];  break;
					case 'day_suffix'       : $return_date = date('jS',$U); break;
					case 'hour'             : $return_date = $date['hour'];  break;
					case 'minute'           : $return_date = $date['minute'];  break;
					case 'second'           : $return_date = $date['second'];  break;
					case 'mysql'            : $return_date = date('Y-m-d H:i:s',$U); break; 
				}
			
			return $return_date;
		}
		
	function parse_mysql_date($input,$output)
		{
			$U = strtotime($input);
			
			switch($output)
				{
					case 'dd/mm/yyyy'       : $return_date = date('d/m/Y',$U); break;
					case 'd/m/yy'           : $return_date = date('j/n/y',$U); break;
					case 'yyyy-mm-dd h:mmS' : $return_date = date('Y-m-d g:iA',$U); break; 
					case 'D, M Ds Y'        : $return_date = date('l, jS F Y',$U); break; 
					case 'M jS, Y'          : $return_date = date('M jS, Y',$U); break; 
					case 'h:mmS'            : $return_date = date('g:iA',$U);  break;
					case 'D, M Ds Y h:mmS'  : $return_date = date('l, jS F Y',$U).' '.date('g:iA',$U); break; 
					case 'year'             : $return_date = date('Y',$U);  break;
					case 'month_str'        : $return_date = date('F',$U); break;
					case 'month'            : $return_date = date('m',$U);  break;
					case 'day_str'          : $return_date = date('l',$U); break;
					case 'day'              : $return_date = date('d',$U);  break;
					case 'day_suffix'       : $return_date = date('jS',$U); break;
					case 'hour'             : $return_date = date('g',$U);  break;
					case 'minute'           : $return_date = date('i',$U);  break;
					case 'mysql'            : $return_date = date('Y-m-d H:i:s',$U); break; 
				}
			
			return $return_date;
		}
		
		
		
	function result($status,$message)
		{
			switch($status)
				{
					case 'success' :
														return '<div id="action_result" class="action_success">'.$message.'</div>';
														break;
														
					case 'fail' :
														return '<div id="action_result" class="action_fail">'.$message.'</div>';
														break;
														
					case 'warning' :
														return '<div id="action_result" class="action_warning">'.$message.'</div>';
														break;
				}
		}
		




	function setting($setting)
		{
			$get_setting = db_select("SELECT `Value` FROM `settings` WHERE `Setting` = '".$setting."'");
			return $get_setting['result_array'][0]['Value'];
		}
		
		
		
		
		
		
	function folder_list($startdir,$exclude = array())
	{
		$ignoredDirectory = $exclude;
		
		$ignoredDirectory[] = '.';
		$ignoredDirectory[] = '..';
		$ignoredDirectory[] = 'admin';
		
		$directorylist = array();
		$f_count = 0;

		if (is_dir($startdir))
			{
				if ($dh = opendir($startdir))
					{
						while (($folder = readdir($dh)) !== false)
							{
								if (!in_array($folder,$ignoredDirectory))
									{
										if (filetype($startdir . $folder) == "dir")
											{
												$directorylist[$f_count]['name'] = $folder;
												$directorylist[$f_count]['path'] = $startdir;
												$f_count++;
                  		}
              		}
          		}
          	closedir($dh);
      	}
  		}
			
		return($directorylist);
	}
	
function image_list($startdir,$exclude)
	{
		$ignoredDirectory = $exclude;
	
		$ignoredDirectory[] = '.';
		$ignoredDirectory[] = '..';
		$ignoredDirectory[] = 'admin';
		
		$files = array();
		$directorylist = array();
		$f_count = 0;

		if (is_dir($startdir))
			{
				if ($dh = opendir($startdir))
					{
						while (($folder = readdir($dh)) !== false)
							{
								if (!in_array($folder,$ignoredDirectory))
									{
										$ext = strtolower(substr($folder, strrpos($folder, '.')+1));
										if ($ext == "jpg" || $ext == "png" || $ext == "gif" && strlen(trim($folder)) > 0)
											{
												$files[] = $folder;
                  		}
              		}
          		}
          	closedir($dh);
      	}
  		}
			
		sort($files);
		
		foreach($files as $file)
			{
				$directorylist[$f_count]['name'] = $file;
				$directorylist[$f_count]['path'] = $startdir;
				$f_count++;
			}
						
		return($directorylist);
	}
	
function file_size($full_path)
	{
		$file_size = filesize($full_path);
		
		if($file_size > 1048576)
			{
				$size_str = number_format(($file_size / 1048576),1) . 'MB' ;
			}
		elseif($file_size > 1024)
			{
				$size_str = number_format(($file_size / 1024),1) . 'KB' ;
			}
		else
			{
				$size_str = number_format($file_size,0) . ' bytes' ;
			}
			
		return $size_str;
		
	}
	
function image_orientation($full_path)
	{
		$image_size = getimagesize($full_path);
		$image_width = $image_size[0];
		$image_height = $image_size[1];
	
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
			
		return $original_orientation;
		
	}
	
function image_size($full_path)
	{
		$size = array();
		$image_size = getimagesize($full_path);
		$image_width = $image_size[0];
		$image_height = $image_size[1];
		$size['width'] = $image_width;
		$size['height'] = $image_height;
		return $size;
	}

function image_size_WxH($full_path)
	{
		$image_size = getimagesize($full_path);
		$image_width = $image_size[0];
		$image_height = $image_size[1];			
		return $image_width.'x'.$image_height;
	}
	




function files_list($startdir,$exclude=array(),$ignore_types=array())
	{
		$ignoredDirectory = $exclude;
	
		$ignoredDirectory[] = '.';
		$ignoredDirectory[] = '..';
		$ignoredDirectory[] = 'admin';
		
		$files = array();
		$directorylist = array();
		$f_count = 0;

		if (is_dir($startdir))
			{
				if ($dh = opendir($startdir))
					{
						while (($folder = readdir($dh)) !== false)
							{
								if (!in_array($folder,$ignoredDirectory))
									{
										$ext = strtolower(substr($folder, strrpos($folder, '.')+1));
										if (!in_array($ext,$ignore_types) && strlen(trim($folder)) > 0)
											{
												$files[] = $folder;
                  		}
              		}
          		}
          	closedir($dh);
      	}
  		}
			
		sort($files);
		
		foreach($files as $file)
			{
				$directorylist[$f_count]['name'] = $file;
				$directorylist[$f_count]['path'] = $startdir;
				$ext = strtolower(substr($directorylist[$f_count]['name'], strrpos($directorylist[$f_count]['name'], '.')+1));
				$directorylist[$f_count]['ext'] = $ext;
				$directorylist[$f_count]['icon'] = file_icon($ext);
				$directorylist[$f_count]['type'] = file_type_str($ext);
				

				
				$f_count++;
			}
						
		return($directorylist);
	}



/*function files_list($startdir)
	{
		$ignoredDirectory[] = '.';
		$ignoredDirectory[] = '..';

		if (is_dir($startdir))
			{
				if ($dh = opendir($startdir))
					{
						while (($folder = readdir($dh)) !== false)
							{
								if (!(array_search($folder,$ignoredDirectory) > -1))
									{
										$ext = strtolower(substr($folder, strrpos($folder, '.')+1));
										$directorylist[$startdir . $folder]['name'] = $folder;
										$directorylist[$startdir . $folder]['path'] = $startdir;
              		}
          		}
          	closedir($dh);
      	}
  		}
		return($directorylist);
	}*/
	
	function deleteDirectory($dirname,$only_empty=false)
		{
			if (!is_dir($dirname)) return false;
			$dscan = array(realpath($dirname));
			$darr = array();
			while (!empty($dscan))
				{
					$dcur = array_pop($dscan);
					$darr[] = $dcur;
					if ($d=opendir($dcur))
						{
							while ($f=readdir($d))
								{
									if ($f=='.' || $f=='..') continue;
									$f=$dcur.'/'.$f;
									if (is_dir($f)) $dscan[] = $f;
									else unlink($f);
								}
							closedir($d);
						}
				}
			$i_until = ($only_empty)? 1 : 0;
			for ($i=count($darr)-1; $i>=$i_until; $i--)
				{
					if (rmdir($darr[$i]))
						{}//echo result('success', '<b>'.$darr[$i].'</b> deleted.');
					else
						{}//echo result('success', '<b>'.$darr[$i].'</b> delete failed.');
				}
		return (($only_empty)? (count(scandir)<=2) : (!is_dir($dirname)));
	}
	
	
	function file_icon($ext)
		{
		
		$types = array (
				'png','jpeg','bmp','jpg','gif','zip','rar','exe','txt','htm','html','fla','swf','xls','xlsx','doc','docx','ppt','pptx','pdf','psd','rm','mpg','mpeg','mov','avi','flv','ai','eps','gz','asc','php','mp3','aac','m4a'
			);
		
		$filetypes = array (
				'png' => 'photo.png',
				'jpeg' => 'photo.png',
				'bmp' => 'photo.png',
				'jpg' => 'photo.png', 
				'gif' => 'photo.png',
				'zip' => 'zip.png',
				'rar' => 'zip.png',
				'exe' => 'exe.png',
				'setup' => 'exe.png',
				'txt' => 'txt.png',
				'htm' => 'htm.png',
				'html' => 'htm.png',
				'fla' => 'fla.png',
				'swf' => 'swf.png',
				'xls' => 'xls.png',
				'xlsx' => 'xls.png',
				'doc' => 'doc.png',
				'docx' => 'doc.png',
				'ppt' => 'ppt.png',
				'pptx' => 'ppt.png',
				'pdf' => 'pdf.png',
				'psd' => 'psd.png',
				'rm' => 'video.png',
				'mpg' => 'video.png',
				'mpeg' => 'video.png',
				'mov' => 'video.png',
				'avi' => 'video.png',
				'flv' => 'video.png',
				'eps' => 'ai.png',
				'ai' => 'ai.png',
				'gz' => 'zip.png',
				'php' => 'php.png',
				'mp3' => 'audio.png',
				'aac' => 'audio.png',
				'm4a' => 'audio.png'
			);
			
			
		if(in_array($ext,$types))
			{
				$icon = $filetypes[$ext];
			}
		else
			{
				$icon = 'default.png';
			}
			
		return $icon;
	}
	
	function file_type_str($ext)
		{
		
		$types = array (
				'png','jpeg','bmp','jpg','gif','zip','rar','exe','txt','htm','html','fla','swf','xls','xlsx','doc','docx','ppt','pptx','pdf','psd','rm','mpg','mpeg','mov','avi','flv','ai','eps','gz','asc','php','mp3','aac','m4a'
			);
		
		$filetypes = array (
				'png' => 'PNG Image',
				'jpeg' => 'JPG Image',
				'bmp' => 'Bitmap Image',
				'jpg' => 'JPG Image', 
				'gif' => 'GIF Image',
				'zip' => 'ZIP Archive',
				'rar' => 'RAR Archive',
				'exe' => 'Executable',
				'setup' => 'Installer',
				'txt' => 'Text File',
				'htm' => 'HTML File',
				'html' => 'HTML File',
				'fla' => 'Flash Document',
				'swf' => 'Flash Document',
				'xls' => 'MS Excel Document',
				'xlsx' => 'MS Excel Document',
				'doc' => 'MS Word Document',
				'docx' => 'MS Word Document',
				'ppt' => 'MS PowerPoint Document',
				'pptx' => 'MS PowerPoint Document',
				'sig' => 'Signature',
				'pdf' => 'PDF Document',
				'psd' => 'Adobe Photoshop',
				'rm' => 'Real Media',
				'mpg' => 'Video',
				'mpeg' => 'Video',
				'mov' => 'Video',
				'avi' => 'Video',		
				'flv' => 'Video',				
				'ai' => 'Adobe Illustrator',
				'eps' => 'EPS Graphic',
				'gz' => 'GZ Archive',
				'asc' => 'ASC File',
				'php' => 'PHP Script',
				'mp3' => 'MP3 Audio',
				'aac' => 'AAC Audio',
				'm4a' => 'M4A Audio'
			);
			
			
		if(in_array($ext,$types))
			{
				$type_str = $filetypes[$ext];
			}
		else
			{
				$type_str = 'File';
			}	
			
		return $type_str;
	}
	
	
	
	
	function get_category_name($cat)
		{
			$get_cat_name = db_select("SELECT * FROM `categories` WHERE `ID` = '".$cat."'");
			return $get_cat_name['result'][0]['Name'];
		}
		
	function get_category_id($cat)
		{
			$get_cat_name = db_select("SELECT * FROM `categories` WHERE `Name` = '".$cat."'");
			return $get_cat_name['result'][0]['ID'];
		}
		
	function get_product_name($product)
		{
			$get_product_name = db_select("SELECT * FROM `products` WHERE `ID` = '".$product."'");
			return $get_product_name['result'][0]['Name'];
		}
		
	function get_news_headline($article)
		{
			$get_news_headline = db_select("SELECT * FROM `news` WHERE `ID` = '".$article."'");
			return $get_news_headline['result'][0]['Headline'];
		}
		
	function get_cat_level($cat)
		{
			$get_cat_name = db_select("SELECT * FROM `categories` WHERE `ID` = '".$cat."'");
			return $get_cat_name['result'][0]['Level'];
		}
		
	function plural($num)
		{
			if($num == 1 || $num < 0)
				{
					$plural = '';
				}
			elseif($num > 1 || $num == 0)
				{
					$plural = 's';
				}
			return $plural;			
		}
		
	function clear_currency($value)
		{
			$value = str_replace('$','',$value);
			$value = str_replace(' ','',$value);
			$value = str_replace(',','',$value);
			
			return trim($value);
		}
		
	
	function is_populated($value)
		{
			if(strlen(trim($value)) > 0)
				{
					return true;
				}
			else
				{
					return false;
				}
		}
		
		
		
		function pagination($num_pages,$current_page,$structure,$current_structure)
			{
				$pagination == '';
				
				for($pgs = 0; $pgs < $num_pages; $pgs++)
					{
						if($current_page == ($pgs + 1))
							{			
								$pagination .= str_replace('[PAGE]',($pgs + 1),$current_structure)."\n";
							}
						else
							{
								$pagination .= str_replace('[PAGE]',($pgs + 1),$structure)."\n";
							}
					}
					
				return $pagination;
			}
			
			
			
	function get_menu($menu_ID,$menu_item_structure,$current_page,$current_structure,$end_of_line)
		{		
			$all_menu_items = '';
			
			$get_menu_SQL = "SELECT * FROM `menus` WHERE `ID` = '".$menu_ID."'";
			$get_menu = db_select($get_menu_SQL);
			
			if($get_menu['num_rows'] > 0)
				{
					$menu = $get_menu['result'][0];
					
					// Get items
					
					$get_items_SQL = "SELECT * FROM `menu_items` WHERE `Menu` = '".$menu['ID']."' AND `Level` = '1' ORDER BY `Order` ASC";
					$get_items = db_select($get_items_SQL);
		
					for($items=0; $items < $get_items['num_rows']; $items++)
						{
							$menu_item = $get_items['result'][$items];
							
							$destination = ($menu_item['Link Type'] == 'Internal') ? str_replace('/','',$menu_item['Destination']) : $menu_item['Destination'] ;
							
							$get_sub_items_SQL = "SELECT * FROM `menu_items` WHERE `Menu` = '".$menu['ID']."' AND `Parent` = '".$menu_item['ID']."' ORDER BY `Order` ASC";
							$get_sub_items = db_select($get_sub_items_SQL);
							
							$current = ($destination == $current_page) ? $current_structure : '' ;
							$link_URL = ($menu_item['Link Type'] == 'External') ? 'http://'.$destination : $destination ;
							
							$EOL = ($items != ($get_items['num_rows'] - 1)) ? $end_of_line : '' ;
							
							$menu_items = $menu_item_structure;
							$menu_items = str_replace('[CURRENT]',$current,$menu_items);
							$menu_items = str_replace('[URL]',$link_URL,$menu_items);
							$menu_items = str_replace('[NAME]',$menu_item['Name'],$menu_items);
		
							$all_menu_items .= $menu_items.$EOL."\n";
						}
				
				}
				
				return $all_menu_items;
		}
		
		
	function get_section_id($section_name)
		{
			$get_section = db_select("SELECT `ID` FROM `menu_items` WHERE `Level` = '1' AND `Name` = '".$section_name."'");
			#echo "SELECT `ID` FROM `menu_items` WHERE `Level` = '1' AND `Name` = '".$section_name."'".'<br />';
			$section_ID = ($get_section['num_rows'] > 0) ? $get_section['result'][0]['ID'] : 0 ;
			return $section_ID;
		}


	function max_menu_order()
		{
			$get_item = db_select("SELECT MAX(`Order`) FROM `menu_items` WHERE `Level` = '1'");
			#echo "SELECT MAX(`Order`) FROM `menu_items` WHERE `Level` = '1'".'<br />';
			$item_order = $get_item['result'][0]['MAX(`Order`)'];
			return $item_order;
		}
	
	function max_item_order($parent)
		{
			$get_item = db_select("SELECT MAX(`Order`) FROM `menu_items` WHERE `Parent` = '".$parent."'");
			#echo "SELECT MAX(`Order`) FROM `menu_items` WHERE `Parent` = '".$parent."'".'<br />';
			$item_order = $get_item['result'][0]['MAX(`Order`)'];
			return $item_order;
		}
		
		
		
	function clean_url($url)
		{
			$url = str_replace(' ','_',$url);
			$url = urlencode($url);
			
			return $url;
		}
		
	function unclean_url($url)
		{
			$url = str_replace('_',' ',$url);
			$url = urldecode($url);
			
			return $url;
		}
		
		
		
	function get_modules()
		{
			$get_modules_SQL = "SELECT * FROM `modules`";
			$get_modules = db_select($get_modules_SQL);
			
			return $get_modules['result'];
		}
		
		
		
		
	function get_page($page_id)
		{
			$get_page = db_select("SELECT * FROM `pages` WHERE `ID` = ".$page_id." LIMIT 1");
			$page = array();
			if($get_page['num_rows'] > 0)
				{
					$page['result'] = true;
					$page['data'] = $get_page['result'][0];
				}
			else
				{
					$page['result'] = false;
				}
			return $page;
		}
		
	function get_pages($order = 'Order',$order_ad = 'ASC')
		{
			$get_pages = db_select("SELECT * FROM `pages` ORDER BY `".$order."` ".$order_ad."");
			return $get_pages;
		}
		
	function link_url($link_type,$link_destination)
		{
			if($link_type == "Internal")
				{
					$page = get_page($link_destination);
					$link_url = ($page['result']) ? substr($page['data']['URL'],1) : '#' ;
				}
			else
				{
					$link_url = $link_destination;
				}
			return $link_url;
		}
	
	
	function output_menu($menu_id,$first_li='',$last_li='')
		{
			$menu_html = '';
			$menu_html .= '<ul>'."\n";
			
			$get_menu_items = db_select("SELECT * FROM `menu_items` WHERE `Menu` = ".$menu_id." AND `Level` = 1 ORDER BY `Order` ASC");
			
			if($get_menu_items['num_rows'] > 0)
				{
					$menu_items = $get_menu_items['result'];
					
					for($m=0; $m<count($menu_items); $m++)
						{
							if($m == 0 && strlen($first_li) > 0)
								{							
									$menu_html .= '	<li class="'.$first_li.'">'."\n";
								}
							else
								{
									$menu_html .= '	<li>'."\n";
								}
								
							$menu_item = $menu_items[$m];
							
							$link_url = link_url($menu_item['Link Type'],$menu_item['Destination']);
							$link_class = 'class="';
							$link_class .= ($menu_item['Link Target'] == '2') ? 'external ' : '' ;
							$link_class .= (($m + 1) == count($menu_items)) ? 'last ' : '' ;
							$link_class .= '"';
							$menu_html .= '		<a href="'.$link_url.'" '.$link_class.'>'.$menu_item['Name'].'</a>'."\n";
							
							$get_sub_items = db_select("SELECT * FROM `menu_items` WHERE `Menu` = ".$menu_id." AND `Level` = 2 AND `Parent` = ".$menu_item['ID']." ORDER BY `Order` ASC");
							
							//echo "SELECT * FROM `menu_items` WHERE `Menu` = ".$menu_id." AND `Level` = 2 AND `Parent` = ".$menu_item['ID']." ORDER BY `Order` ASC".'<br />';
							
							if($get_sub_items['num_rows'] > 0)
								{
									$sub_items = $get_sub_items['result'];
									$menu_html .= '		<ul>'."\n";
									
									for($s=0; $s<count($sub_items); $s++)
										{
											$menu_html .= '			<li>'."\n";
											$sub_item = $sub_items[$s];

											$sub_link_url = link_url($sub_item['Link Type'],$sub_item['Destination']);							
											$sub_link_class = ($sub_item['Link Target'] == '2') ? 'class="external"' : '' ;							
											$menu_html .= '				<a href="'.$sub_link_url.'" '.$sub_link_class.'>'.$sub_item['Name'].'</a>'."\n";
											
											$menu_html .= '			</li>'."\n";
										}
									$menu_html .= '		</ul>'."\n";								
								}
						
							$menu_html .= '	</li>'."\n";
						}
				}
			
			$menu_html .= '</ul>'."\n";
			
			return $menu_html;
		}

	function menu_item($item_ID)
		{
			$get_item_SQL = "SELECT * FROM `menu_items` WHERE `ID` = ".$item_ID." LIMIT 1";
			$get_item = db_select($get_item_SQL);			
			$item = $get_item['result'][0];			
			return $item ;
		}
		
	function menu_items($menu,$order = 'Order',$order_ad = 'ASC')
		{
			$get_items = db_select("SELECT * FROM `menu_items` WHERE `Menu` = ".$menu." AND `Level` = 1 ORDER BY `".$order."` ".$order_ad."");
			return $get_items;
		}
		
		
	function build_gallery($page_content)
		{
			
			$pattern = array("/\[PHOTO_GALLERY:(.*)?\]/i");
			$replace = array("$1");
					
			if (preg_match($pattern[0], $page_content,$match))
				{							
					$photo_gal = $match[1];
					$photo_gal_html = '';
					
					$get_gallery_SQL = "SELECT `ID` FROM `photo_galleries` WHERE `Name` = '".$photo_gal."' LIMIT 1";
					$get_gallery = db_select($get_gallery_SQL);
					
					if($get_gallery['num_rows'] > 0)
						{									
							$photo_gal_id = $get_gallery['result'][0]['ID'];
							
							$get_images_SQL = "SELECT * FROM `photo_gallery_images` WHERE `Photo_Gallery` = ".$photo_gal_id." ORDER BY `Order` ASC";
							$get_images = db_select($get_images_SQL);
							
							if($get_images['num_rows'] > 0)
								{									
									$photo_gal_html .= '<div class="photo_gallery">'."\n";
									
									for($i=0; $i<$get_images['num_rows']; $i++)
										{
											$image = $get_images['result'][$i];
											$photo_gal_html .= '<a href="images/'.$image['Folder'].'/'.$image['Image'].'" rel="lightbox:'.$photo_gal_id.'" title="'.$image['Caption'].'"><img src="inc/img.php?dimension=c80&amp;folder='.$image['Folder'].'&amp;image='.$image['Image'].'" alt="'.$image['Image'].'" /></a>'."\n";
										}									
										
									$photo_gal_html .= '</div>'."\n";
								}
						}
			
					$page_content = preg_replace($pattern, $photo_gal_html, $page_content);							
				}
				
				return $page_content;
		
		}


?>