<?php

	class Email
		{

			var $to = '' ;
			var $cc = '' ;
			var $bcc = '' ;
			var $from = '' ;
			var $reply_to = '' ;
			var $return_path = '' ;  // Duplicates reply-to. Required for older email clients
			var $subject = '' ;
			var $body = '' ;
			
			var $content_type = 'text/html' ;  // Default text/html
			var $headers = '' ;
			var $temp_headers = '' ;
			var $nl = "\r\n" ;  // New line characters
			
			function Email()
				{				
				}
		
			function addHeader($header,$value)
				{
					$this->headers .= $header . ': ' . $value . $this->nl ;				
				}
				
			function Send()
				{
					$this->addHeader('From',$this->from);
					$this->addHeader('Reply-To',$this->reply_to);
					$this->addHeader('Return-Path',$this->reply_to);
					$this->addHeader('Content-Type',$this->content_type);
					
					$send = mail($this->to,$this->subject,$this->body,$this->headers);
					
					if($send)
						{
							return true ;
						}
					else
						{
							return false ;
						}							
				}
				
			function email_content($content)
				{
					$lines = explode("\n", $content);
					$subject = trim(array_shift($lines));
					$subject = str_replace('Subject: ','',str_replace('"','',$subject));
					$body = join("\n", $lines);
					
					$content = array();
					$content['body'] = $body;
					$content['subject'] = $subject;
					
					return $content;
				}
		
		}

?>