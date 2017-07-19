<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Organisation_acc extends CI_Controller {
    public function __construct()
    {
	   parent::__construct();
	   $this->load->library('session');
	   $this->check_login();
	   $this->load->model('site_model');
	   $this->load->library('upload');
	}

	public function index()
	{
	  $data['page_title']='Welcome '.$this->session->userdata('name');
	  $data['middle_content']='organisation_acc';
	  $this->load->view('templete',$data);
	}
	
	public function check_login()
	{
		if($this->session->userdata('is_logged_in')!='2')
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
	
	public function organisation_step2()
	{
		if(isset($_POST['org_reg_step2'])) 
		{
			$this->form_validation->set_rules('oo_title','o_email','required|xss_clean');
			$this->form_validation->set_rules('oo_desc','Description','required|xss_clean');
			$this->form_validation->set_rules('oo_category','Category','required');
			$this->form_validation->set_rules('oo_desired_skill','Desired Skill','required|xss_clean');
			$this->form_validation->set_rules('oo_language','Language','required');
			$this->form_validation->set_rules('oo_volunteer_time_slot','Time slot','required');
			$this->form_validation->set_rules('oo_num_vol','Number Of Volunteers','required|xss_clean');
			$this->form_validation->set_rules('oo_days_week','Days Of Week','required|xss_clean');
			$this->form_validation->set_rules('oo_volunteer_profile','Profile','required|xss_clean');
			
			if($this->form_validation->run())
			{
				 	$maxid=0;
					$maxid=$this->site_model->find_max_id('organisation_volunteer_opportunity');
					$maxid++;
					$data_array=array('id'=>$maxid,'o_email'=>$this->session->userdata('username'),'oo_title'=>$_POST['oo_title'],'oo_desc'=>$_POST['oo_desc'],'oo_category'=>$_POST['oo_category'],'oo_desired_skill'=>$_POST['oo_desired_skill'],'oo_language'=>$_POST['oo_language'],'oo_volunteer_time_slot'=>$_POST['oo_volunteer_time_slot'],'oo_num_vol'=>$_POST['oo_num_vol'],'oo_days_week'=>$_POST['oo_days_week'],'oo_volunteer_profile'=>$_POST['oo_volunteer_profile']);
					
					if($this->site_model->insertRecord('organisation_volunteer_opportunity',$data_array))
					{
						$config=array(
					     'upload_path' => 'site_assets/images/ngo',
					     'allowed_types' => 'jpg',
					     'file_name'=> $maxid.'.jpg',
					     'overwrite'=> True
						);
					        
					    $this->upload->initialize($config); // Important
						$this->upload->do_upload("userfile");
    
						$data_update=array('o_step2_stat'=>'1');
						$this->db->where('o_email',$this->session->userdata('username'));
						$this->db->update('organisation',$data_update);
						
						$this->session->set_userdata('is_logged_in','1');
						redirect(base_url().'organisation_acc');
					}
					else
					{
						$this->session->set_userdata('error_msg','Error occurred, Try again...');
						redirect(base_url().'organisation_acc/organisation_step2');
					}
					
			}
		}
		 
	  $data['page_title']='Organisation Register Step 2';
	  $data['middle_content']='organisation_2';
	  $this->load->view('templete',$data);
	}
	
}
?>