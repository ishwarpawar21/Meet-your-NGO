<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_sending extends CI_Model

{

	public function __construct()

	{

		parent::__construct();

		$this->load->library('email');

	}

	

	// SMTP email setting here

	public function setting_smtp()

	{

		$permission=TRUE;

		if($permission==TRUE)

		{

			$config['protocol']    	= 'smtp';

			$config['smtp_host']    = 'ssl://smtp.gmail.com';

			$config['smtp_port']    = '465';

			$config['smtp_timeout'] = '7';

			$config['smtp_user']    = 'webwing.test@gmail.com';

			$config['smtp_pass']    = 'webwingtechnologies@1234';

			$config['charset']    	= 'utf-8';

			$config['newline']    	= "\r\n";

			$config['mailtype'] 	= 'html'; // or html

			$config['validation'] 	= TRUE; // bool whether to validate email or not  

			$this->email->initialize($config);	

		}

	}

	

	public function sendmail($info_arr,$other_info)

	{	

		//$this->setting_smtp();

		$this->email->set_newline("\r\n");

		$this->email->from($info_arr['from'],"Coupon ");

		$this->email->to($info_arr['to']);

		$this->email->subject($info_arr['subject']);

		$this->email->set_mailtype("html");

		$data['base_url']=base_url();

		$this->email->message($this->load->view('email/'.$info_arr['view'],$other_info,true)); 

		if($this->email->send())

		{//echo 'done';

			return true;

		}

		//echo $this->email->print_debugger();

		//exit;

	}

}

?>