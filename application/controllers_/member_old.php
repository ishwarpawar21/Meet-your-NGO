<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Member extends CI_Controller {
    public function __construct()
    {
	   parent::__construct();
	    $this->load->library('upload');  
	}
	public function profile()
	{
	    //$seller_id = base64_decode($seller_id);
	    $seller_id = $this->session->userdata('login_id');
	    if($seller_id!='' && is_numeric($seller_id))
	    {
		  $data['page_title']='Profile';
		  //$this->db->join('tbl_points_master','tbl_points_master.seller_login_id=tbl_seller_details.loginid');
		  $this->db->join('tbl_country_master','tbl_country_master.id=tbl_seller_details.countryid');
	 	  $this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_seller_details.loginid');
	      //$this->db->GROUP_BY('tbl_points_master.seller_login_id');
		  $data['seldetail']=$this->master_model->getRecords('tbl_seller_details',array('tbl_seller_details.seller_id'=>$this->session->userdata('login_id')));
		  $data['middle_content']='member_profile';
	 	  $this->load->view('templete',$data);
		}
		else
		{
	      $this->load->view('admin/404');
		}
	}
	public function edit()
	{
	    $seller_id = $this->session->userdata('login_id');
	    if($seller_id!='' && is_numeric($seller_id))
	    {
			$file_name="";
			if(isset($_POST['btn_update_seller']))
			{ 
			$this->form_validation->set_rules('username','Username','required|xss_clean');
			$this->form_validation->set_rules('firstname','Firstname','required|xss_clean');
			$this->form_validation->set_rules('lastname','Lastname','required|xss_clean');
			$this->form_validation->set_rules('gender','Gender','required|xss_clean');
			$this->form_validation->set_rules('DOB','DOB','required|xss_clean');
			$this->form_validation->set_rules('city','City','required|xss_clean');
			$this->form_validation->set_rules('state','State','required|xss_clean');
			$this->form_validation->set_rules('countryid','country','required|xss_clean');
			$this->form_validation->set_rules('zipcode','Zipcode','required|xss_clean');
			$this->form_validation->set_rules('Website','Website','required|xss_clean|valid_url');
			$this->form_validation->set_rules('briefbio','Brief biodata','required|xss_clean');
			if($this->form_validation->run())
			{ 
				$username=$this->input->post('username',true);
				$firstname=$this->input->post('firstname',true);
				$lastname=$this->input->post('lastname',true);
				$gender=$this->input->post('gender',true);
				$DOB=$this->input->post('DOB',true);
				$city=$this->input->post('city',true);
				$state=$this->input->post('state',true);
				$countryid=$this->input->post('countryid',true);
				$zipcode=$this->input->post('zipcode',true);
				$Website=$this->input->post('Website',true);
				$briefbio=$this->input->post('briefbio',true);
				$profilepicold=$this->input->post('profilepicold',true);
				//$loginid=$this->input->post('loginid',true);
				if($this->input->post('profilepicold')!='')
				{
				$privateprofile=$this->input->post('privateprofile',true);
				}
				else
				{
				$privateprofile='0';
				}
				if($_FILES['profilepic']['name']!="")
				{
					$logo_config=array('file_name'=>uniqid(),
									'allowed_types'=>'jpg|jpeg|gif|png',
									'upload_path'=>'uploads/profile_image/');
					$this->upload->initialize($logo_config);
					if($this->upload->do_upload('profilepic'))
					{ 
						$upload_data=$this->upload->data();
						$file_name=$upload_data['file_name'];
						$this->master_model->createThumb($file_name,'uploads/profile_image/',100,100);
						
						if($profilepicold!="")
						{
							@unlink('uploads/profile_image/'.$profilepicold);
							@unlink('uploads/profile_image/thumb/'.$profilepicold);
						}
					}
				}
				else
				{$file_name=$profilepicold;}
				$update_seller_array=array('username'=>$username,'firstname'=>$firstname,'lastname'=>$lastname,'gender'=>$gender,'DOB'=>date('Y-m-d',strtotime($DOB)),'city'=>$city,'state'=>$state,'zipcode'=>$zipcode,'countryid'=>$countryid,'Website'=>$Website,'briefbio'=>$briefbio,'profilepic'=>$file_name); 
				// $update_login_array=array('email_id'=>$email_id,'password'=>$password); 	
				//$this->master_model->updateRecord('tbl_login_master',$update_login_array,array('login_id'=>$loginid));
				if($this->master_model->updateRecord('tbl_seller_details',$update_seller_array,array('seller_id'=>$seller_id)))
				{
					$this->session->set_flashdata('success','Profile updates Successfully.');
					redirect(base_url().'edit');
				}
			}
		}
			$data['page_title']='Edit Profile';
			$this->db->join('tbl_country_master','tbl_country_master.id=tbl_seller_details.countryid');
			$this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_seller_details.loginid');
			$data['selinfo']=$this->master_model->getRecords('tbl_seller_details',array('tbl_seller_details.seller_id'=>$seller_id)); 
			$data['fetchcountry']=$this->master_model->getRecords('tbl_country_master');
			$data['middle_content']='edit_member_profile';
			$this->load->view('templete',$data);
		}
		else
		{
			$this->load->view('admin/404');
			//echo 'Oops something is wrong';
		}
	}
	public function delete()
	{
	    $seller_id = $this->session->userdata('login_id');
		if($seller_id!='' && is_numeric($seller_id))
	    {
			$data['page_title']='Delete';
			$update_loginstatus_array=array('account_status'=>"Delete"); 	
			if($this->master_model->updateRecord('tbl_login_master',$update_loginstatus_array,array('login_id'=>$seller_id)))
			{
				$this->session->set_flashdata('success','Recored updates Successfully.');
				$userdata=array('email_id'=>$email,'login_id'=>$instid,'user_slug'=>$user_slug);
	  			$this->session->unset_userdata($userdata);
				redirect(base_url());
			}
		}
		else
		{
			$this->load->view('admin/404');
			//echo 'Oops something is wrong';
		}
	}
	public function account_preferences()
	{
	  $data['page_title']='Edit Profile';
	  $data['middle_content']='account_pref';
	  $this->load->view('templete',$data);
	}
}