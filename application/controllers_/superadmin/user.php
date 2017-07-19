<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class User extends CI_Controller {
    public function __construct()
    {
	   parent::__construct();
	   $this->load->library('upload');  
	   $this->load->model('email_sending');	  
	   if( ! ini_get('date.timezone') )
		{
		   date_default_timezone_set('GMT');
		} 
	}
	/*
	  Function   :  Manage User 
	  Developer  : Yogesh
	  Description: Admin can Manage User from here.    
	*/
	public function manageuser()
	{
	  $data['success']=$data['error']='';
	  $data['pagetitle']='Manage User';
	  //$this->db->join('tbl_country_master','tbl_country_master.id=tbl_user_master.country_id','left');
	  $this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_user_master.login_id');
	  $this->db->order_by('tbl_user_master.user_id','DESC');
      $data['fetch_user']=$this->master_model->getRecords('tbl_user_master','','');
	  $data['middle_content']='manage-user';
	  $this->load->view('admin/common-file',$data);
 	}
	/*
	  Function   :  Edit User Info 
	  Developer  : Yogesh
	  Description: Admin Edit User Info start from here.    
	*/
	public function updateuser($user_id='')
	{
		$user_id = base64_decode($user_id);
		$data['success']=$data['error']=$success=$error='';
		$data['pagetitle']='Update User';
		$file_name="";
		if(isset($_POST['btn_update_user']))
		{ 
			
			$this->form_validation->set_rules('username','','required|xss_clean');
			$this->form_validation->set_rules('first_name','','required|xss_clean');
			$this->form_validation->set_rules('last_name','','required|xss_clean');
			$this->form_validation->set_rules('contact_no','','required|xss_clean');
			$this->form_validation->set_rules('address','','required|xss_clean');
			$this->form_validation->set_rules('city_id','','required|xss_clean');
			$this->form_validation->set_rules('state_id','','required|xss_clean');
			$this->form_validation->set_rules('country_id','','required|xss_clean');
			//$this->form_validation->set_rules('email_id','Email','required|valid_email|is_unique[tbl_login_master.email_id]');
			$this->form_validation->set_rules('seller_email_id','','required|xss_clean');
			$this->form_validation->set_rules('password','','required|xss_clean');
			if($this->form_validation->run())
			{ 
				$username=$this->input->post('username',true);
				$first_name=$this->input->post('first_name',true);
				$last_name=$this->input->post('last_name',true);
				$contact_no=$this->input->post('contact_no',true);
				$address=$this->input->post('address',true);
				$city_id=$this->input->post('city_id',true);
				$state_id=$this->input->post('state_id',true);
				$country_id=$this->input->post('country_id',true);
				$email_id=$this->input->post('seller_email_id',true);
				$password=$this->input->post('password',true);
				$profile_pictureold=$this->input->post('profile_pictureold',true);
				$loginid=$this->input->post('loginid',true);
				if($_FILES['profile_picture']['name']!="")
				{
					$logo_config=array('file_name'=>uniqid(),
									'allowed_types'=>'jpg|jpeg|gif|png',
									'upload_path'=>'uploads/profile_image/');
					$this->upload->initialize($logo_config);
					if($this->upload->do_upload('profile_picture'))
					{ 
						$upload_data=$this->upload->data();
						$file_name=$upload_data['file_name'];
						$this->master_model->createThumb($file_name,'uploads/profile_image/',100,100);
						if($profile_pictureold!="")
						{
							@unlink('uploads/profile_image/'.$profile_pictureold);
							@unlink('uploads/profile_image/thumb/'.$profile_pictureold);
						}
					}
				}
				else
				{$file_name=$profile_pictureold;}
				$update_user_array=array('username'=>$username,'first_name'=>$first_name,'last_name'=>$last_name,'address'=>$address,'contact_no'=>$contact_no,'city_id'=>$city_id,'state_id'=>$state_id,'country_id'=>$country_id,'profile_picture'=>$file_name); 
				 $update_login_array=array('email_id'=>$email_id,'password'=>$password); 	
				$this->master_model->updateRecord('tbl_login_master',$update_login_array,array('login_id'=>$loginid));
				if($this->master_model->updateRecord('tbl_user_master',$update_user_array,array('user_id'=>$user_id)))
				{
					$this->session->set_flashdata('success','Recored updates Successfully.');
					redirect(base_url().'superadmin/user/manageuser/');
				}
			}
			else
			{
				$data['error']=$this->form_validation->error_string();
			}
		}
	    $this->db->join('tbl_country_master','tbl_country_master.id=tbl_user_master.country_id','left');
	    $this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_user_master.login_id');
	    $userinfo=$this->master_model->getRecords('tbl_user_master',array('tbl_user_master.user_id'=>$user_id));
		$fetchcountry=$this->master_model->getRecords('tbl_country_master');
	   	$data=array('pagetitle'=>'Update User','middle_content'=>'edit-user','userinfo'=>$userinfo,'fetchcountry'=>$fetchcountry);
	    $this->load->view('admin/common-file',$data);
	}
	/*
	  Function   :  User Detail 
	  Developer  : Yogesh
	  Description: Admin User Detail start from here.    
	*/
	 public function detail($user_id='')
	{
		$user_id = base64_decode($user_id);
		if($user_id!='' && is_numeric($user_id))
		{
			$this->db->join('tbl_country_master','tbl_country_master.id=tbl_user_master.country_id','left');
	 		 $this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_user_master.login_id');
	     	$userdetail=$this->master_model->getRecords('tbl_user_master',array('tbl_user_master.user_id'=>$user_id));
			$data=array('pagetitle'=>'User Detail','middle_content'=>'detail-user','userdetail'=>$userdetail);
			$this->load->view('admin/common-file',$data); 
		}
		else
		{
			$this->load->view('admin/404');
			//echo 'Oops something is wrong';
		}
	}
  /*
    Function   : User status
    Developer  : Yogesh
    Description: Admin can Change Single status of seller.    
  */
  public function userstatus($login_id,$status)
  {
      $data['success']=$data['error']='';
	  $login_id = base64_decode($login_id);
	  $input_array = array('user_status'=>$status);
	  if($this->master_model->updateRecord('tbl_login_master',$input_array,array('login_id'=>$login_id)))
	  {
		 $this->session->set_flashdata('success','Record status change successfully.');
		 redirect(base_url().'superadmin/user/manageuser/');
	  }
	  else
	  {
		 $this->session->set_flashdata('error','Error while updating status.'); 
		 redirect(base_url().'superadmin/user/manageuser/');
	  }
  }
    /*
    Function   : User Single Delete
    Developer  : Yogesh
    Description: Admin can Delete Single  seller.    
  	*/
	public function deleteuser($user_id,$login_id)
	{
		$data['success']=$data['error']='';
	  	//$user_id=$this->uri->segment(4);
		//$login_id=$this->uri->segment(5);
		$user_id = base64_decode($user_id);
		$login_id = base64_decode($login_id);
		
	    $user_info=$this->master_model->getRecords('tbl_user_master',array('user_id'=>$user_id));
		if(($this->master_model->deleteRecord('tbl_user_master','user_id',$user_id)) && ($this->master_model->deleteRecord('tbl_login_master','login_id',$login_id))) 
	  	{
		  @unlink('uploads/profile_image/'.$user_info[0]['profile_picture']);
		  @unlink('uploads/profile_image/thumb/'.$user_info[0]['profile_picture']);
		  $this->session->set_flashdata('success','Record deleted successfully.');
		  redirect(base_url().'superadmin/user/manageuser/');
 	    }
	 	else
	  	{
		  $this->session->set_flashdata('error','Error while deleting record.'); 
		  redirect(base_url().'superadmin/user/manageuser/');
	    }
	}
   /*
    Function   : Deletemultiple,block,unblock  User 
    Developer  : Yogesh
    Description: Admin can Deletemultiple,block,unblock User.    
  */
   public function multiactionchange()
   {
	  $data['success']=$data['error']='';
	  if(isset($_REQUEST['checkbox_del'])!="")
	  {
		  $checkbox_count = count($_POST['checkbox_del']);
		  if(isset($_POST['status_chck']) && $_POST['status_chck']=='1')
		  {
			 	 $input_array = array('user_status'=>'0');
				 for($i=0;$i<$checkbox_count;$i++)
				 {
					 $this->master_model->updateRecord('tbl_login_master',$input_array,array('login_id'=>$_REQUEST['checkbox_del'][$i]));
				 }
				 $this->session->set_flashdata('success','Records status change successfully.');
				 redirect(base_url().'superadmin/user/manageuser/');
		   }
		  if(isset($_POST['status_chck']) && $_POST['status_chck']=='2')
		  {
				 $input_array = array('user_status'=>'1');
				 for($i=0;$i<$checkbox_count;$i++)
				 {
					 $this->master_model->updateRecord('tbl_login_master',$input_array,array('login_id'=>$_REQUEST['checkbox_del'][$i]));
				 }
				 $this->session->set_flashdata('success','Records status change successfully.');
				 redirect(base_url().'superadmin/user/manageuser/');
			}
		  if(isset($_POST['status_chck']) && $_POST['status_chck']=='3')
		  {
			   for($i=0;$i<$checkbox_count;$i++)
			   {
				   $user_info=$this->master_model->getRecords('tbl_user_master',array('login_id'=>$_REQUEST['checkbox_del'][$i]));
				   $this->master_model->deleteRecord('tbl_user_master','login_id',$_REQUEST['checkbox_del'][$i]);
				   $this->master_model->deleteRecord('tbl_login_master','login_id',$_REQUEST['checkbox_del'][$i]);
				   @unlink('uploads/profile_image/'.$user_info[0]['profile_picture']);
		  		   @unlink('uploads/profile_image/thumb/'.$user_info[0]['profile_picture']);
			   }
			   $this->session->set_flashdata('success',"Records deleted successfully.");	
			   redirect(base_url().'superadmin/user/manageuser/');
		  }
	  }
   }
   /*
    Function   : Email Id Dublication
    Developer  : Yogesh
    Description: Email Id dublication    
  */
   public function check_email()
    {
		$email=$this->input->post('email');
		$loginid=$this->input->post('loginid');
		$where=array('email_id'=>$email,'login_id !='=>$loginid);/*email='".$email."'*/
		$str='error';
		$chk_user=$this->master_model->getRecordCount('tbl_login_master',$where);
		if($chk_user==0)
        {
			$str='ok';
        }
		echo json_encode($str);
    }
	   	/*
	  Function   :  User Points Detail 
	  Developer  : Yogesh
	  Description: Admin User Points Detail start from here.    
	*/
	public function userpoints()
	{
	  $data['success']=$data['error']='';
	  $data['pagetitle']='User Points';
	  
	  $this->db->select('tbl_user_master.username,tbl_user_master.first_name,tbl_user_master.last_name,tbl_userscored_point.login_id,tbl_login_master.login_id,tbl_login_master.email_id');
	  
	  $this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_user_master.login_id');
	  $this->db->join('tbl_userscored_point','tbl_userscored_point.login_id=tbl_user_master.login_id');
	  $this->db->order_by('tbl_user_master.user_id','DESC');
	  $this->db->group_by('tbl_userscored_point.login_id');
      $data['user_point']=$this->master_model->getRecords('tbl_user_master','','');
	  $data['middle_content']='manage-user-points';
	  $this->load->view('admin/common-file',$data);
 	}
	/*
	  Function   :  Manage Upgrade User 
	  Developer  : Yogesh
	  Description: Admin can Manage Upgrade User from here.    
	*/
	public function manageupgradeuser()
	{
	  $data['success']=$data['error']='';
	  $data['pagetitle']='Manage Upgrade User';
	  $this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_upgrade_request.login_id');
	  $this->db->order_by('tbl_upgrade_request.request_id','DESC');
      $data['fetch_upgrade_user']=$this->master_model->getRecords('tbl_upgrade_request','','');
	  $data['middle_content']='manage-upgrade-user';
	  $this->load->view('admin/common-file',$data);
 	}
	 /*
    Function   : User Uupgrade
    Developer  : Yogesh
    Description: Admin can Change Upgrade  of User.    
  */
  public function upgrade($login_id)
  {
      $data['success']=$data['error']='';
	  $login_id = base64_decode($login_id);
	  $this->db->join('tbl_user_master','tbl_user_master.login_id=tbl_upgrade_request.login_id');
	  $this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_upgrade_request.login_id');
	  $fetch_upgrade_user=$this->master_model->getRecords('tbl_upgrade_request',array('tbl_upgrade_request.login_id'=>$login_id),'');
	  //echo $fetch_upgrade_user['0']['username'];
	 $input_array = array('loginid'=>$login_id,'username'=>$fetch_upgrade_user['0']['username'],'firstname'=>$fetch_upgrade_user['0']['first_name'],'lastname'=>$fetch_upgrade_user['0']['last_name'],'gender'=>$fetch_upgrade_user['0']['gender'],'city'=>$fetch_upgrade_user['0']['city_id'],'state'=>$fetch_upgrade_user['0']['state_id'],'countryid'=>$fetch_upgrade_user['0']['country_id'],'profilepic'=>$fetch_upgrade_user['0']['profile_picture'],'brandaccess'=>'1','addcoupon'=>'1');
	  
	  if($this->master_model->insertRecord('tbl_seller_details',$input_array))
	  {
		 $udate_array = array('user_type'=>'seller');
		 $this->master_model->updateRecord('tbl_login_master',$udate_array,array('login_id'=>$login_id));
		 $udate_upgradearray = array('status'=>'upgrade');
		 $this->master_model->updateRecord('tbl_upgrade_request',$udate_upgradearray,array('login_id'=>$login_id));
		 $this->master_model->deleteRecord('tbl_user_master','login_id',$login_id);
		 $this->session->set_flashdata('success','Record Update change successfully.');
		 redirect(base_url().'superadmin/user/manageupgradeuser/');
	  }
	  else
	  {
		 $this->session->set_flashdata('error','Error while updating record.'); 
		 redirect(base_url().'superadmin/user/manageupgradeuser/');
	  }
  }
  /*
    Function   : Upgrade User Single Delete
    Developer  : Yogesh
    Description: Admin can Delete Single Upgrade User.    
  	*/
	public function deleteupgradeuser($login_id)
	{
		$data['success']=$data['error']='';
	 	$login_id = base64_decode($login_id);
	   if($this->master_model->deleteRecord('tbl_upgrade_request','login_id',$login_id)) 
	  	{
		  $this->session->set_flashdata('success','Record deleted successfully.');
		  redirect(base_url().'superadmin/user/manageupgradeuser/');
 	    }
	 	else
	  	{
		  $this->session->set_flashdata('error','Error while deleting record.'); 
		  redirect(base_url().'superadmin/user/manageupgradeuser/');
	    }
	}
	  /*
    Function   : Deletemultiple,block,unblock  upgrade User 
    Developer  : Yogesh
    Description: Admin can Deletemultiple,block,unblock upgrade User.    
  */
   public function multiaction()
   {
	  $data['success']=$data['error']='';
	  if(isset($_REQUEST['checkbox_del'])!="")
	  {
		  $checkbox_count = count($_POST['checkbox_del']);
		  if(isset($_POST['status_chck']) && $_POST['status_chck']=='3')
		  {
			   for($i=0;$i<$checkbox_count;$i++)
			   {
				   $this->master_model->deleteRecord('tbl_upgrade_request','login_id',$_REQUEST['checkbox_del'][$i]);
			   }
			   $this->session->set_flashdata('success',"Records deleted successfully.");	
			   redirect(base_url().'superadmin/user/manageupgradeuser/');
		  }
	  }
   }
 }