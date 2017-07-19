<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Volunteer_acc extends CI_Controller {
    public function __construct()
    {
	   parent::__construct();
	   $this->load->library('session');
	   $this->check_login();
	}

	public function index()
	{
	  $data['page_title']='Welcome '.$this->session->userdata('name');
	  $data['middle_content']='volunteer_Account';
	  $this->load->view('templete',$data);
	}
	
	public function check_login()
	{
		if($this->session->userdata('is_logged_in')!='1')
		{
			if(!$this->session->userdata('username'))
			{
				if(!$this->session->userdata('name'))
				{
					$this->session->set_userdata('login_error','<span style="color:red">Session Expire</span>');
					redirect(base_url().'site/');
				}
			}
		}
		
	}
	
	
	public function logout()
	{
	  $this->session->unset_userdata('username');
	  $this->session->unset_userdata('is_logged_in');
	  $this->session->unset_userdata('account_type');
	  redirect(base_url().'site/');
	}
}
?>