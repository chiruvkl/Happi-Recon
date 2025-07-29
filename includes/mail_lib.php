<?php

	class Mail_lib {
		
		private $email;
		
		public $mail_protocol = 'mail';//mail, sendmail, or smtp
		
		public $from_email;
		public $from_name;
		public $reply_to_email;
		public $reply_to_name;
		
		public $to_email;
		public $subject;
		public $message;

		public function __construct($params = array())
		{
			require_once('email.php');
			
			$this->email = new Email();
			
			$this->from_email = 'info@razogi.com';
			$this->from_name = 'razogi app';
			$this->reply_to_email = 'noreply@razogi.com';
			$this->reply_to_name = 'razogi app';
			
			if(!empty($params))
				$this->initialize($params);
			
			$this->mail_settings();
		}
		
		public function initialize($params = array())
		{
			if(!empty($params))
			{
				foreach($params as $field => $value)
				{
					if(is_string($field) && $value != '')
					{
						$this->$field = $value;
					}
				}
			}
		}
		
		private function mail_settings()
		{
			$config = array();
				
			$config['protocol'] = $this->mail_protocol;//mail, sendmail, or smtp
			$config['mailpath'] = '/usr/sbin/sendmail';//The server path to Sendmail.
			
			if($this->mail_protocol == 'smtp')
			{
				$config['smtp_host'] = 'ssl://smtp.googlemail.com';
				$config['smtp_user'] = 'narayana.serona@gmail.com';
				$config['smtp_pass'] = 'Avbdk9@1';
				$config['smtp_port'] = '465';//25
				$config['smtp_timeout'] = '5';//SMTP Timeout (in seconds).
			}

			$config['wordwrap'] = TRUE;//TRUE or FALSE
			$config['wrapchars'] = '76';
			$config['mailtype'] = 'html';//text or html
			$config['charset'] = 'iso-8859-1';//utf-8, iso-8859-1, etc
			$config['priority'] = '3';//1, 2, 3, 4, 5	Email Priority. 1 = highest. 5 = lowest. 3 = normal.
			$config['crlf'] = "\r\n";//"\r\n" or "\n" or "\r"
			$config['newline'] = "\r\n";//"\r\n" or "\n" or "\r"
			
			$this->email->initialize($config);
		}
		
		public function send_mail($to_email = '',$subject = '',$message = '')
		{
			if($to_email == '')
				$to_email = $this->to_email;
			
			if($subject == '')
				$subject = $this->subject;
			
			if($message == '')
				$message = $this->message;
			
			$this->email->from($this->from_email, $this->from_name);
			$this->email->reply_to($this->reply_to_email, $this->reply_to_name);
			
			$this->email->to($to_email);
			$this->email->subject(ucwords($subject));
			$this->email->message($message);
				
			$return = $this->email->send();
			$this->email->clear();
			
			return $return;
		}

	}

	/* End of file mail_lib.php */
