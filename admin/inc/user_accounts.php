<?php

	
	###  PAGE ACTIONS  ###
	
	switch($action)
		{
														
			case 'new_user' :
					// Define POST variables
					
					$username     = POST('username','');
					$first_name   = addslashes(POST('first_name',''));
					$last_name    = addslashes(POST('last_name',''));
					$password     = md5(POST('password',''));
					$user_active  = POST('user_active',1);
					
					$create_user_SQL = "INSERT INTO `user_accounts` (`ID`,`Username`,`First_Name`,`Last_Name`,`Password`,`Active`,`Created`,`Created_By`)
															VALUES (NULL,'".$username."','".$first_name."','".$last_name."','".$password."','".$user_active."','".returnDate('yyyymmddhhmm')."','".USER."')";
					
					#echo $create_user_SQL;
					
					$create_user = db_insert($create_user_SQL);
					
					if($create_user['result'] == true)
						{
							$result = result('success',"<strong>'".$username."'</strong> created successfully.");
						}
					else
						{
							$result = result('fail',"<strong>'".$username."'</strong> could not be created. <em>".mysql_error()."</em>");
						}
					
					break;
														
			case 'edit_user' :
					// Define POST variables
					
					$user_ID   = POST('user_ID',0);
					
					$username     = POST('username','');
					$first_name   = addslashes(POST('first_name',''));
					$last_name    = addslashes(POST('last_name',''));
					$reset_pass   = POST('reset_password','');
					$password     = md5(POST('password',''));
					$user_active  = POST('user_active',1);
					
					if($reset_pass == 'yes')
						{					
							$edit_user_SQL = "UPDATE `user_accounts` SET
																								`Username` = '".$username."',
																								`First_Name` = '".$first_name."',
																								`Last_Name` = '".$last_name."',
																								`Active` = '".$user_active."',
																								`Password` = '".$password."'
																						
																						WHERE `ID` = '".$user_ID."'";
						}
					else
						{																						
							$edit_user_SQL = "UPDATE `user_accounts` SET
																								`Username` = '".$username."',
																								`First_Name` = '".$first_name."',
																								`Last_Name` = '".$last_name."',
																								`Active` = '".$user_active."'
																						
																						WHERE `ID` = '".$user_ID."'";
						}
																						
					#echo $edit_user_SQL;
					
					$edit_user = db_update($edit_user_SQL);
					
					if($edit_user == true)
						{
							$result = result('success',"Changes to <strong>'".POST('username','')."'</strong> saved successfully.");
						}
					else
						{
							$result = result('warning',"NO changes to <strong>'".POST('username','')."'</strong> have been saved.");
						}
					
					break;
					
					
					case 'delete_user' :
					// Define POST variables
					
					$user_ID       = GET('ID',NULL);
					
					$get_user_SQL = "SELECT `Username` FROM `user_accounts` WHERE `ID` = ".$user_ID ;
					$get_user = db_select($get_user_SQL);
					
					$username = $get_user['result'][0]['Username'];
					
					
					$delete_user_SQL = "DELETE FROM `user_accounts` WHERE `ID` = ".$user_ID ;
																						
					#echo $delete_user_SQL;
					
					$delete_user = db_update($delete_user_SQL);
					
					if($delete_user == true)
						{
							$result = result('success',"<strong>'".$username."'</strong> deleted successfully.");
						}
					else
						{
							$result = result('warning',"<strong>'".$username."'</strong> could not be deleted.");
						}
					
					break;
														
		}
	
	$get_users_SQL = "SELECT * FROM `user_accounts` ORDER BY `Username` ASC";
	$get_users = db_select($get_users_SQL);
	
	$users = $get_users['result'];
	
	for($i=0; $i<count($users); $i++)
		{
			$users[$i]['Created'] = parse_date($users[$i]['Created'],'yyyy-mm-dd h:mmS');
		}
	
	$num_users = count($users);
	$num_users .= ' user'.plural($num_users);
	
	$smarty->assign('users',$users);		
	$smarty->assign('num_users',$num_users);
	
	if(isset($result)) { $smarty->assign('result',$result); }

	$page_template = 'user_accounts.html' ;

?>