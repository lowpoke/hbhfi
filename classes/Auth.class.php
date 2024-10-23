<?php

	class Auth
		{
			// Authentication vars
			var $auth_processed     = false;	
			var $user_authenticated = false;
			var $current_user       = NULL;				
			var $session_timeout    = 1200;  // in seconds (1200 = 20 minutes)
			
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
			
			function Auth()
				{
					$this->auth_processed     = SESSION('auth_processed',false);	
					$this->user_authenticated = SESSION('user_authenticated',false);
					$this->current_user       = SESSION('current_user',null);
					
					if(!isset($_SESSION['auth_processed']))
						{
							// Session vars don't yet exist...create them
						
							$_SESSION['auth_processed']     = false;								
							$_SESSION['user_authenticated'] = false;
							$_SESSION['current_user']       = null;
							$_SESSION['HTTP_USER_AGENT']    = '';
							$_SESSION['session_age']        = 0;	
						}
				}
		
####################################################################################
			
			function Process_Login($username,$password,$goto=null)
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
									$this->login_valid = true;
									$this->login_result = 'Logged in as '.$user_details['builder_email'];
									
									if($goto != null)
										{
											$this->Redirect($goto); // Re-direct user
										}
								}
							else
								{
									// Login failed
									$this->Reset_Session_Vars();
									$this->login_valid = false;
									$this->login_result = 'Incorrect username or password.';
								}
							
						}
					else
						{
							// Login failed
							$this->Reset_Session_Vars();
							$this->login_valid = false;
							$this->login_result = 'Incorrect username or password.';
						}
						
					return $this->login_valid;
				}
				
####################################################################################

			function Logout()
				{
					$this->ResetAuth();
					$this->Redirect(ROOT);
				}
				
####################################################################################
				
				
			function Check()
				{					
					$authentication_valid = false;
					$result = array();
					$fail_reason = '';
					
					$session_age = $_SESSION['session_age'];
					$current_time = date("U");
					
					if(isset($_SESSION['user_authenticated']))
						{
							$user_authenticated = $_SESSION['user_authenticated'];
							
							// Prove users identity with HTTP_USER_AGENT
							
							if(isset($_SESSION['HTTP_USER_AGENT']))
								{
									if($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT']))
										{
											$fail_reason = 'We could not authenticate your identity.';
											$this->ResetAuth();
											$authentication_valid = false;
										}
								}
							else
								{
									$authentication_valid = true;
								}
								
							// Check session timeout
							
							/*
if($session_age < ($current_time - $this->session_timeout))
								{
									$fail_reason = 'Your session has timed out.';
									$this->ResetAuth();
									$authentication_valid = false;
								}	
							else
								{
									$authentication_valid = true;
								}	
*/			
						}
					else
						{
							$fail_reason = 'You are not an authenticated user.';
							$this->ResetAuth();
							$authentication_valid = false;
						}
										
					$result['check_result'] = $authentication_valid;
					$result['fail_reason'] = $fail_reason;
										
					return $result;
				}
		
				
####################################################################################
			
			function User_Details($id)
				{
					$user_id = intval(mysql_real_escape_string($id));
					$user_details = array();
					
					$get_user_SQL = "SELECT * FROM `builders` WHERE `builder_id` = '".$user_id."' LIMIT 1";
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
					//session_regenerate_id(true);
					
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
					if(isset($_SESSION))
						{
							//session_destroy();
							//session_regenerate_id(true);
							$this->Reset_Session_Vars();
						}
				}
				
####################################################################################

			function Redirect($location)
				{
					header("Location: ".$location);
				}
				
####################################################################################

			function Auth_Processed()      { return $this->auth_processed; }
			function User_Authenticated()  { return $this->user_authenticated; }
			function Current_User()        { return $this->current_user; }

####################################################################################
		
		}

?>
