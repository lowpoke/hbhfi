<?php

	class Projects
		{
			// Authentication vars
			var $auth_processed     = SESSION('auth_processed',false);	
			var $user_authenticated = SESSION('user_authenticated',false);
			var $current_user       = SESSION('current_user',null);				
					
			
			// Processing vars
			var $auth_initiated  = false;
			var $login_valid     = false;  // Boolean indicating login result
			var $login_result    = '';     // String representation of login result
						
			// User DB table details			
			var $usr_table      = 'builders';
			var $usr_id_field   = 'builder_id';
			var $usr_name_field = 'builder_email';
			var $usr_pass_field = 'builder_password';
			
####################################################################################
			
			function Auth() {}
		
####################################################################################
			
			function Process_Login($username,$password,$goto)
				{
					// Clean incoming username and password data
					$username = mysql_real_escape_string($username);
					$password = $this->Encrypt_Password($password);
					
					// Check if user exists
					$check_user_SQL = "SELECT `".$this->usr_id_field."` FROM `".$this->usr_table."` WHERE `".$this->usr_name_field."` = '".$username."' AND `".$this->usr_pass_field."` = '".$password."' LIMIT 1";
					$check_user = db_select($check_user_SQL);
					
					if($check_user['num_rows'] == 1)
						{
							// Matching record found
														
							$check_ID = $check_user['result'][0]['builder_id'];
							
							// Get user details
							$user_details = $this->User_Details($check_ID);
							
							// Confirm user details with credentials supplied
							if($check_ID == $user_details['builder_id'] && $username == $user_details['builder_email'])
								{
									// Login Successfull. Set logged in user id
									$this->Set_Session_Vars(true,$user_details['builder_id']);
									$this->Redirect($goto); // Re-direct user
								}
							else
								{
									// Login failed
									$this->Reset_Session_Vars();
								}
							
						}
					else
						{
							// Login failed
							$this->Reset_Session_Vars();
						}
				}
				
####################################################################################

			function Logout()
				{
					$this->ResetAuth();
					$this->Redirect('home');
				}
				
####################################################################################
			
			function User_Details($id)
				{
					$user_id = intval(mysql_real_escape_string($id));
					$user_details = array();
					
					$get_user_SQL = "SELECT `builder_id`,`builder_short_name`,`builder_email` FROM `builders` WHERE `builder_id` = '".$user_id."' LIMIT 1";
					$get_user = db_select($get_user_SQL);
					
					if($get_user['num_rows'] > 0)
						{
							$user_details = $get_user['result'][0];
						}
					
					return $user_details;				
				}
				
####################################################################################
			
			function Encrypt_Password($password)
				{
					return md5(md5($password));
				}
				
####################################################################################				

			function Set_Session_Vars($login_result, $user)
				{
					session_regenerate_id(true);
					
					if($login_result == true)
						{
							$_SESSION['auth_processed']     = true;								
							$_SESSION['user_authenticated'] = $login_result;
							$_SESSION['current_user']       = $user;
							$_SESSION['HTTP_USER_AGENT']    = md5($_SERVER['HTTP_USER_AGENT']);
							$_SESSION['session_age']        = date("U");
						}
				}
				
####################################################################################
				
			function Reset_Session_Vars()
				{
					$_SESSION['auth_processed']     = false;								
					$_SESSION['user_authenticated'] = false;
					$_SESSION['current_user']       = null;
					$_SESSION['HTTP_USER_AGENT']    = '';
					$_SESSION['session_age']        = 0;	
				}
				
####################################################################################

			function ResetAuth()
				{
					session_destroy();
					session_regenerate_id(true);
					$this->Reset_Session_Vars();
				}
				
####################################################################################

			function Redirect($location)
				{
					header("Location: ".$location);
				}
				
####################################################################################

			function Auth_Processed()      { return $this->auth_processed; }
			function User_Authenticated () { return $this->user_authenticated; }
			function Current_User()        { return $this->current_user; }

####################################################################################
		
		}

?>
