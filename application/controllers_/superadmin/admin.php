<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {
    public function __construct()
    {
	   parent::__construct();
	   $this->load->library('upload');  
	   $this->load->model('email_sending');	  
	   date_default_timezone_set('Asia/Kolkata');
	}

	public function login()
	{ 
	     $data['pagetitle']='Login';
		 if(isset($_POST['btn_login']))
		 {
			$this->form_validation->set_rules('username','','required|xss_clean');
			$this->form_validation->set_rules('password','','required|xss_clean');
			if($this->form_validation->run())
			{
				$username=$this->input->post('username',true);
				$password=$this->input->post('password',true);
				$input_array=array('admin_username'=>$username,'admin_password'=>$password);
				$user_info=$this->master_model->getRecords('admin_login',$input_array);
				if(count($user_info)>0)
				{ 
				
					$mysqltime=date("H:i:s");
					$user_data=array('admin_username'=>$user_info[0]['admin_username'],
									 'admin_id'=>$user_info[0]['id'],
									 'admin_img'=>$user_info[0]['admin_img'],
									 'timer'=>base64_encode($mysqltime));
					$this->session->set_userdata($user_data);
					redirect(base_url().'superadmin/admin/dashboard/');			
				}
				else
				{
					 $data['error']='Invalid username or password !';
				}
			}
		  }
	      $this->load->view('admin/login',$data);
	}
	
	public function forgotpassword()
	{
	  $data['pagetitle']='Forgotpassword';
	  $data['error']=$data['success']='';	
	  if(isset($_POST['btn_recovery']))
	  {
	    $this->form_validation->set_rules('email','','required|valid_email');
		if($this->form_validation->run())
		{
		  $admin_email=$this->input->post('email',true);
		  $result=$this->master_model->getRecords('admin_login',array('admin_login.admin_email'=>$admin_email),'admin_login.*');
		  if(count($result)>0)
		  {
			 $whr=array('id'=>'1');
			 $info_mail=$this->master_model->getRecords('admin_login',$whr,'*');
			 $info_arr=array('from'=>$info_mail[0]['admin_email'],'to'=>$admin_email,'subject'=>'Password Recovery','view'=>'admin-forgot-password');
			 $other_info=array('name'=>$result[0]['admin_username'],'email_id'=>base64_encode($info_mail[0]['id']));  
			 if($this->email_sending->sendmail($info_arr,$other_info))
			 {
				$change_password=array('password_status'=>'0');	
				$this->master_model->updateRecord('admin_login',$change_password,array('id'=>'1'));	 
				$this->session->set_flashdata('success','Mail send successfully.');
				redirect(base_url().'superadmin/admin/forgotpassword/');	
			 }
			 else
			 {
				$this->session->set_flashdata('error','While error for sending mail');
				redirect(base_url().'superadmin/admin/forgotpassword/');	
			 }
		  }
		  else
		  {
			 $this->session->set_flashdata('error','Your email was not found.');
			 redirect(base_url().'superadmin/admin/forgotpassword/'); 
		  }
		}
	  }
	  $this->load->view('admin/login',$data);
	}
	/*
	  Function   :changepassword
	  Developer  :shailesh
	  Routes File:'academymaster/changepassword' used by 'academymaster/admin/changepassword'
	  Description:Admin can change the password by forgot password.    
	*/
	public function changepassword()
	{
	  $data['pagetitle']='Changepassword';
	  $data['error']=$data['success']=$data['error_alreay']='';
	  $result=$this->master_model->getRecords('admin_login',array('admin_login.id'=>1,'admin_login.password_status'=>'0'),'admin_login.*'); 
	  if(count($result)>0)
	  {
		  if(isset($_POST['btn_password']))
		  {
			 $this->form_validation->set_rules('password','','required');
			 $this->form_validation->set_rules('confirm_password','','required');
			 if($this->form_validation->run())
			 {
				$password=$this->input->post('password',true);
				$confirm_password=$this->input->post('confirm_password',true);
				$update_password=array('admin_password'=>$confirm_password);
				if($this->master_model->updateRecord('admin_login',$update_password,array('id'=>'1')))
				{
					$change_password=array('password_status'=>'1');	
				    $this->master_model->updateRecord('admin_login',$change_password,array('id'=>'1'));	
				    $data['success']='Password Change successfully'; 
				}
			 }
		  }
	  }
	  else
	  {
		$data['error_alreay']='Looks like you have already changed your password!';   
	  }
	  $this->load->view('admin/login',$data);
	}
	/*
	  Function   : logout
	  Developer  : shailesh
	  Description: Admin can logout session unset by admin.    
	*/
	public function logout()
	{
	  $this->session->unset_userdata('admin_id');
	  $this->session->unset_userdata('admin_username');
	   $this->session->unset_userdata('timer');
	  redirect(base_url().'superadmin/admin/login/');
	}
	/*
	  Function   : dashboard
	  Developer  : shailesh
	  Routes File: 'academymaster/dashboard' used by 'academymaster/admin/dashboard'
	  Description: Admin can login and come to Dashboard.    
	*/
	public function dashboard()
	{
	  $data['success']=$data['error']='';	
	  $data['pagetitle']='Dashboard';
	  $data['middle_content']='dashboard';
	  $this->load->view('admin/common-file',$data);
	}
	/*
	  Function   : accountsetting
	  Developer  : shailesh
	  Routes File: 'academymaster/accountsetting' used by 'academymaster/admin/accountsetting'
	  Description: Admin can change email and site on off functionality.    
	*/
	public function accountsetting()
	{
	  $data['success']=$data['error']=$data['success1']=$data['error1']=$data['success2']=$data['error2']=$data['success3']=$data['error3']=$data['success4']=$data['error4']='';
	  $data['pagetitle']='Account Setting';	
	  if(isset($_POST['btn_account']))
	  {
		  $this->form_validation->set_rules('username','','required|xss_clean');
		  $this->form_validation->set_rules('email','','required|xss_clean|valid_email');
		   $this->form_validation->set_rules('phone','','required|xss_clean');
		  if($this->form_validation->run())
		  {
			 	$username=$this->input->post('username',true);
				$email=$this->input->post('email',true);
				$phone=$this->input->post('phone',true);
				$fax=$this->input->post('fax',true);
				$address=$this->input->post('address',true);
				$old_image=$this->input->post('old_image',true);
				
				
				$config=array('upload_path'=>'uploads/admin/',
					          'allowed_types'=>'jpg|jpeg|gif|png',
					          'file_name'=>rand(1,9999));
							  
			    
				$this->upload->initialize($config); //if missing this file error occured "cannot find valid upload path"
				   $flag=0;
			   if(count($_FILES)>0)
			   {
					if($_FILES['file_upload']['name']!='')
					{
						if($this->upload->do_upload('file_upload'))
						{
						  @unlink('uploads/admin/'.$old_image);
						  $dt=$this->upload->data();
						  $file=$dt['file_name'];
						  
						}
						else
						{
							$flag=1;
							$file=$old_image;
							$data['error']=$this->upload->display_errors();
						}
					}
			   
					else
					{   $flag=0;
						$file=$old_image;
					}
			   }
			   else
					{
						$file=$old_image;
					}
					if($flag==0)
					{
					$input_array=array('admin_username'=>$username,'admin_email'=>$email,'admin_img'=>$file,'phone'=>$phone,'fax'=>$fax,'admin_address'=>$address);
					$this->master_model->updateRecord('admin_login',$input_array,array('id'=>'1'));
					$user_data=array('admin_img'=>$file);
					$this->session->set_userdata($user_data);
					$data['success']='Record Updated Successfully.';
		            }
		  }
		  else
		  {
			$data['error']=$this->form_validation->error_string();
		  }
	  }
	  if(isset($_POST['btn_password']))
	  { 
	    	$current_pass=$this->input->post('current_pass',true);
	     	$this->form_validation->set_rules('current_pass','','required|xss_clean');
		  	$this->form_validation->set_rules('new_pass','New Password','required|xss_clean');
			$this->form_validation->set_rules('confirm_pass','Confirm Password','required|xss_clean');
			  if($this->form_validation->run())
			  {
				  	$current_pass=$this->input->post('current_pass',true);
					$new_pass=$this->input->post('new_pass',true);
					$row=$this->master_model->getRecordCount('admin_login',array('admin_password'=>$current_pass));
					if($row==0)
					{
						$data['error1']="Current Password is Wrong.";
					}
					else
					{
						$input_array=array('admin_password'=>$new_pass);
						$this->master_model->updateRecord('admin_login',$input_array,array('id'=>'1'));
						$data['success1']='Password Updated Successfully.'; 
					}
			  }
			  else
			  {
				  $data['error1']=$this->form_validation->error_string();
			  }
	  }
	    if(isset($_POST['btn_info_mail']))
	  {
		   	$this->form_validation->set_rules('contact_email','','required|xss_clean|valid_url');
		  	$this->form_validation->set_rules('info_email','','required|xss_clean|valid_url');
			$this->form_validation->set_rules('support_email','','required|xss_clean|valid_url');
			  if($this->form_validation->run())
			  {
				  	$contact_email=$this->input->post('contact_email',true);
					$info_email=$this->input->post('info_email',true);
					$support_email=$this->input->post('support_email',true);
					
					
						$input_array=array('contact_email'=>$contact_email,'info_email'=>$info_email,'support_email'=>$support_email);
						$this->master_model->updateRecord('email_id_master',$input_array,array('id'=>'1'));
						$data['success3']='Email Updated Successfully.';
			  }
			  else
			  {
				  $data['error3']=$this->form_validation->error_string();
			  }
	  }
	  if(isset($_POST['btn_status']))
	  {
		$site_status=$this->input->post('site_status',true);
		$input_array1=array('site_status'=>$site_status);
		$this->master_model->updateRecord('tbl_site_status',$input_array1,array('site_id'=>'1'));
	    $data['success2']='Site Status Changed Successfully.'; 
	  }
	    if(isset($_POST['btn_translator']))
	  {
		$translator_status=$this->input->post('translator_status',true);
		$input_array1=array('site_status'=>$translator_status);
		$this->master_model->updateRecord('tbl_site_status',$input_array1,array('site_id'=>'2'));
	    $data['success4']='Translator Status Changed Successfully.'; 
	  }
	  $data['result']=$this->master_model->getRecords('admin_login',array('admin_login.id'=>1),'admin_login.*');
	  $data['status']=$this->master_model->getRecords('tbl_site_status',array('site_id'=>1),'*');
	  $data['translator']=$this->master_model->getRecords('tbl_site_status',array('site_id'=>2),'*');
	  $data['emails']=$this->master_model->getRecords('email_id_master',array('id'=>1));
	  $data['middle_content']='accountsetting';
	  $this->load->view('admin/common-file',$data);
	}
	/*
	  Function   : sociallink
	  Developer  : Dhananjay
	  Routes File: 'academymaster/sociallink' used by 'academymaster/admin/sociallink'
	  Description: Admin can update social link.    
	*/
	public function sociallink()
	{
	  $data['success']=$data['error']='';
	  $data['pagetitle']='Sociallink';	
	  $data['social_link']=$this->master_model->getRecords('tbl_social',array('tbl_social.social_id'=>1),'tbl_social.*');
	  if(isset($_POST['btn_social']))
	  {
		 $this->form_validation->set_rules('facebook_link','','required|xss_clean|valid_url');
		 $this->form_validation->set_rules('twitter_link','','required|xss_clean|valid_url'); 
		 $this->form_validation->set_rules('linkedin_link','','required|xss_clean|valid_url');
		 $this->form_validation->set_rules('googleplus','','required|xss_clean|valid_url');
		 if($this->form_validation->run())
		 {
			 $facebook_link=$this->input->post('facebook_link',true);
			 $twitter_link=$this->input->post('twitter_link',true);
			 $linkedin_link=$this->input->post('linkedin_link',true);
			 $googleplus=$this->input->post('googleplus');
			 $update_link=array('facebook'=>$facebook_link,'linkedin'=>$linkedin_link,'twitter'=>$twitter_link,'googleplus'=>$googleplus);
		     if($this->master_model->updateRecord('tbl_social',$update_link,array('social_id'=>'1')))
			 {
				$this->session->set_flashdata('success','Social links updated successfully.'); 
				redirect(base_url().'superadmin/admin/sociallink/');
			 }
			 else
			 {
				$this->session->set_flashdata('error','Error while updating social link.'); 
				redirect(base_url().'superadmin/admin/sociallink/'); 
			 }
		}
	  }
	  $data['middle_content']='sociallink';
	  $this->load->view('admin/common-file',$data);
	}
	/*
	  Function   : Manage Points
	  Developer  : Yogesh
	  Description: Admin can update Points.    
	*/
	public function points()
	{
	  $data['success']=$data['error']='';
	  $data['pagetitle']='Manage Points';	
	  $data['manage_points']=$this->master_model->getRecords('tbl_points_master',array('tbl_points_master.points_id'=>1));
	  if(isset($_POST['btn_update_point']))
	  {
		 $this->form_validation->set_rules('fb_share_point','','required|xss_clean');
		 $this->form_validation->set_rules('like_point','','required|xss_clean'); 
		 $this->form_validation->set_rules('coupon_commnet_point','','required|xss_clean');
		 $this->form_validation->set_rules('community_point','','required|xss_clean');
		 if($this->form_validation->run())
		 {
			 $fb_share_point=$this->input->post('fb_share_point',true);
			 $like_point=$this->input->post('like_point',true);
			 $coupon_commnet_point=$this->input->post('coupon_commnet_point',true);
			 $community_point=$this->input->post('community_point');
			 $update_points=array('fb_share_point'=>$fb_share_point,'like_point'=>$like_point,'coupon_commnet_point'=>$coupon_commnet_point,'community_point'=>$community_point);
		     if($this->master_model->updateRecord('tbl_points_master',$update_points,array('points_id'=>'1')))
			 {
				$this->session->set_flashdata('success','Points updated successfully.'); 
				redirect(base_url().'superadmin/admin/points/');
			 }
			 else
			 {
				$this->session->set_flashdata('error','Error while updating Points.'); 
				redirect(base_url().'superadmin/admin/points/'); 
			 }
		}
	  }
	  if(isset($_POST['btn_update_perday_point']))
	  {
		 $this->form_validation->set_rules('per_day','','required|xss_clean');
		 if($this->form_validation->run())
		 {
			 $per_day=$this->input->post('per_day',true);
			 $update_per_day=array('per_day_point'=>$per_day);
		     if($this->master_model->updateRecord('tbl_points_master',$update_per_day,array('points_id'=>'1')))
			 {
				$this->session->set_flashdata('success1','Per day points updated successfully.'); 
				redirect(base_url().'superadmin/admin/points/');
			 }
			 else
			 {
				$this->session->set_flashdata('error1','Error while updating Points.'); 
				redirect(base_url().'superadmin/admin/points/'); 
			 }
		}
	  }
	  $data['middle_content']='manage-points';
	  $this->load->view('admin/common-file',$data);
	}
	//function :manage contact inquiry
	public function managecontactinquiry()
	{
		$data['success']=$data['error']='';
		$data['pagetitle']='Contact Inquiry';
		$data['fetch_manage_contactinquiry']=$this->master_model->getRecords('tbl_contact_inqury');
		$data['middle_content']='manage-contactinquiry';
		$this->load->view('admin/common-file',$data);
	}
	
	//multiple delete contact
	public function deletemultiplecontactinq()
	{
		if(isset($_REQUEST['checkbox_del'])!="")
		{
		   $checkbox_del_count = count($_POST['checkbox_del']);
		   for($i=0;$i<$checkbox_del_count;$i++)
		   {
			 $this->master_model->deleteRecord('tbl_contact_inqury','con_id',$_REQUEST['checkbox_del'][$i]);
		   }
		   $this->session->set_flashdata('success',"Records deleted successfully.");	
		   redirect(base_url().'superadmin/admin/managecontactinquiry/');
		}
	}
	
	//admin can delete contact enquiry
	public function deletecontactinquiry($contact_id)
	{
		 $contact_id = base64_decode($contact_id);
		if($this->master_model->deleteRecord('tbl_contact_inqury','con_id',$contact_id)) 
		{
			$this->session->set_flashdata('success','Record deleted successfully.');
		   	redirect(base_url().'superadmin/admin/managecontactinquiry/');
		}
		else
		{
			$this->session->set_flashdata('error','Error while deleting record.'); 
		   	redirect(base_url().'superadmin/admin/managecontactinquiry');
		}
	}
	public function contactenquirydetails($inq_id='')
	{
		//$inq_id = $this->uri->segment(4);
		$inq_id = base64_decode($inq_id);
		$data['success']=$data['error']='';
		$data['pagetitle']='Contact Enquiry';
		$data['contact_details']=$this->master_model->getRecords('tbl_contact_inqury',array('con_id'=>$inq_id));
		$data['middle_content']='view-more-contact-enq';
		$this->load->view('admin/common-file',$data);
	}
	// functio :manage brand
     // developer : shailesh
	public function managebrand()
	{
		$data['success']=$data['error']='';
		$data['pagetitle']='Manage Brand';
		$this->db->select('tbl_brand_master.*,tbl_login_master.user_slug,tbl_seller_details.username');
		$this->db->join('tbl_seller_details','tbl_seller_details.loginid=tbl_brand_master.login_id');
		$this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_brand_master.login_id');
		$data['fetch_manage_brand']=$this->master_model->getRecords('tbl_brand_master','','');
		$data['middle_content']='manage-brand';
		$this->load->view('admin/common-file',$data);
	}
	// function :delete brand
	// developer :shaiesh
	public function deletebrand($brand_id='',$brand_image='')
	{
		$data['success']=$data['error']='';
		 $brand_id = base64_decode($brand_id);
		  $brand_image = base64_decode($brand_image);
		if($this->master_model->deleteRecord('tbl_brand_master','brand_id',$brand_id))
		{
			@unlink('uploads/brand/'.$brand_image);
			@unlink('uploads/brand/thumb/'.$brand_image);
			$this->session->set_flashdata('success','Record deleted successfully.');
		   	redirect(base_url().'superadmin/admin/managebrand/');
		}
		else
		{
			$this->session->set_flashdata('error','Error while deleting record.'); 
		   	redirect(base_url().'superadmin/admin/managebrand');
		}
	}
	//function :block brand
	//developer : shailesh
	public function brandstatus($brand_id,$status)
  {
       $data['success']=$data['error']='';
	   $brand_id = base64_decode($brand_id);
	   $input_array = array('brand_status'=>$status);
	  if($this->master_model->updateRecord('tbl_brand_master',$input_array,array('brand_id'=>$brand_id)))
	  {
		 $this->session->set_flashdata('success','Record status change successfully.');
		 redirect(base_url().'superadmin/admin/managebrand/');
	  }
	  else
	  {
		 $this->session->set_flashdata('error','Error while updating status.'); 
		 redirect(base_url().'superadmin/admin/managebrand/');
	  }
  }
  //function :multiple delete block unblock
	//developer: shailesh
	public function deletemultiplebrand()
	{
		$data['success']=$data['error']='';
		if(isset($_REQUEST['checkbox_del'])!="")
		{
		   $checkbox_del_count = count($_POST['checkbox_del']);
		   if(isset($_POST['status_chck']) && $_POST['status_chck']=='3')
		   {
			  	   for($i=0;$i<$checkbox_del_count;$i++)
				   {
						$unlik_image=$this->master_model->getRecords('tbl_brand_master',array('tbl_brand_master.brand_id'=>$_REQUEST['checkbox_del'][$i]),'brand_image');
						if($this->master_model->deleteRecord('tbl_brand_master','brand_id',$_REQUEST['checkbox_del'][$i]))
						{
						  @unlink('uploads/brand/'.$unlik_image[0]['brand_image']);
						  @unlink('uploads/brand/thumb/'.$unlik_image[0]['brand_image']);
						  
  						}
				   }
				   $this->session->set_flashdata('success',"Records deleted successfully.");	
				   redirect(base_url().'superadmin/admin/managebrand/');
		   }
		   if(isset($_POST['status_chck']) && $_POST['status_chck']=='1')
		   {
			 	 $input_array = array('brand_status '=>'1');
				 for($i=0;$i<$checkbox_del_count;$i++)
				 {
					 $this->master_model->updateRecord('tbl_brand_master',$input_array,array('brand_id'=>$_REQUEST['checkbox_del'][$i]));
				 }
				 $this->session->set_flashdata('success','Records status change successfully.');
				 redirect(base_url().'superadmin/admin/managebrand/');
		   }
		   if(isset($_POST['status_chck']) && $_POST['status_chck']=='2')
		   {
				 $input_array = array('brand_status '=>'0');
				 for($i=0;$i<$checkbox_del_count;$i++)
				 {
					 $this->master_model->updateRecord('tbl_brand_master',$input_array,array('brand_id'=>$_REQUEST['checkbox_del'][$i]));
				 }
				 $this->session->set_flashdata('success','Records status change successfully.');
				 redirect(base_url().'superadmin/admin/managebrand/');
			}
		}
	}

  //function :update brand
  //developer: shailesh
	public function updatebrand($brand_id='')
	{
	$brand_id_decode = base64_decode($brand_id);
	$data['error']=$data['success']=$data['upload_error']='';
	//$data['wrong_startdate']=$data['wrong_enddate']='';
	$data['pagetitle']='Update Brand';
	if($brand_id!='' && is_numeric($brand_id_decode))
	{
		if(isset($_POST['btn_update_brand']))
		{ 
		   $this->form_validation->set_rules('brand_title','','required');
		   $this->form_validation->set_rules('brand_desc','','required|xss_clean');
			if($this->form_validation->run())
			{
			 $brand_title=$this->input->post('brand_title',true);
			 $brand_desc=$this->input->post('brand_desc');
			 $old_image=$this->input->post('old_image');
			 $config=array('upload_path'=>'uploads/brand/',
						   'allowed_types'=>'jpg|jpeg|gif|png',
						   'file_name'=>rand(1,9999),'max_size'=>0
						   );
			 $this->upload->initialize($config);
			   if(count($_FILES)>0)
			   {     
				   if($_FILES['brand_image']['name']!='')
				   {
					 if($this->upload->do_upload('brand_image'))
					 {		 
						@unlink('uploads/brand/'.$old_image);
						@unlink('uploads/brand/thumb/'.$old_image);
						$dt=$this->upload->data();
						$file=$dt['file_name'];
						$this->master_model->createThumb($file,'uploads/brand/',161,87,TRUE);
					  }
					   else
					   {
						   $this->upload->display_errors();
						   $file='';
					   }
					}
					   else
					   {
						 $file=$old_image;
					   }
				  }
				   else
				   {
					  $file=$old_image; 
				   }
				 if($file!='')
				 { 
					  $b_array=array('brand_title'=>stripslashes($brand_title));
					  $this->db->where('brand_id <>',base64_decode($brand_id)); 
					  $num_row=$this->master_model->getRecords('tbl_brand_master',$b_array);
										if(count($num_row)==0)
										{
									 $brand_slug=$this->master_model->create_slug($brand_title,'tbl_brand_master','brand_slug'); 
 									  $brand_array=array('brand_title'=>addslashes($brand_title),'brand_image'=>$file,'brand_slug'=>$brand_slug,'brand_desc'=>addslashes($brand_desc));
												   if($this->master_model->updateRecord('tbl_brand_master',$brand_array,array('brand_id'=>$brand_id_decode)))
												   {
													 $this->session->set_flashdata('success',"Record updated successfully.");	
													 redirect(base_url().'superadmin/admin/updatebrand/'.$brand_id.'');
												   }
										}
								   else
								   {
									  $this->session->set_flashdata('error','brand name must unique.'); 
									  redirect(base_url().'superadmin/admin/updatebrand/'.$brand_id.'');
								   }
					}
				else
				{
						   $data['upload_error']='The file type you are attempting to upload is not allowed.';
				}
		}
		}
			$data['fetch_brand']=$this->master_model->getRecords('tbl_brand_master',array('tbl_brand_master.brand_id'=>$brand_id_decode));
			$data['middle_content']='update-brand';
			$this->load->view('admin/common-file',$data);
		}                                
	else
	{
			$this->load->view('oops');
		}
   }	
  
  //news letter 
  public function newsletter()
  {  
    if(isset($_POST['btn_user_registration']))
	{
    $user_email=$this->input->post('user_email');
	$insert_array=array('sub_email'=>$user_email);
	if($this->master_model->insertRecord('tbl_newsletter_subscriber',$insert_array))
			    {
				  echo "record insert";
				}
	}
	 $this->load->view('newsletter');
  }
  
  //delete newsletter
 /* public function deletenews($sub_id='')
  {
	  $data['success']=$data['error']='';
		if($this->master_model->deleteRecord('tbl_newsletter_subscriber','sub_id',$sub_id))
		{
			$this->session->set_flashdata('success','Record deleted successfully.');
		   	redirect(base_url().'superadmin/newsletter/send/');
		}
		else
		{
			$this->session->set_flashdata('error','Error while deleting record.'); 
		   	redirect(base_url().'superadmin/newsletter/send/');
		}
  }*/
  
  
  
 public function checkemail()
	{
		$str=$this->input->post('email');
		$chk=array('sub_email'=> $str);
		$mail_chk=$this->master_model->getRecordCount('tbl_newsletter_subscriber',$chk);
		if($mail_chk =='1')
		{
			echo 'exist';
		}
		else
		{
	      $insert_array=array('sub_email'=>$str);
	
		if($this->master_model->insertRecord('tbl_newsletter_subscriber',$insert_array))
		{
		  echo "record insert";
		}
		echo $this->db->last_query();		
		}
	}
	
	//add brandcoupon in manageseller
	public function addcoupon($loginid='')
	{ 
		
		$check_sel_id=$this->input->post('check_sel_id');
		$str=$this->input->post('coupon');
	    
		if($str=='0')
		{
		   $insert_array=array('brandaccess'=>'1');
		}
		else
		{
		  $insert_array=array('brandaccess'=>$str);
		}
		$this->master_model->updateRecord('tbl_seller_details',$insert_array,array('seller_id'=>$check_sel_id));	
	}
	
	//add copuon in managesellere
	public function coupon($loginid='')
	{
	    $check_sel_id=$this->input->post('check_sel_id');
		$str=$this->input->post('coupon');
	    if($str=='0')
		{
		    $insert_array=array('addcoupon'=>'1');	
		}
		else
		{
			$insert_array=array('addcoupon'=>$str);
		}
		$this->master_model->updateRecord('tbl_seller_details',$insert_array,array('seller_id'=>$check_sel_id));
		
		
	}
	
	//cancel coupon
	public function cancelcoupon()
	{
		$brandaccess=$this->master_model->getRecords('tbl_seller_details');
		echo $brandaccess['brandaccess'];die();
	}
	
	
	//function :manage banner
	//devloper : shailesh
   public function managebanner($banner_id='')
   {
	 $data['success']=$data['error']= $data['ban']='';
	 $data['pagetitle']='Manage Banner';
	  if(isset($_POST['btn_banner']))
	  {
	         $link=$this->input->post('link');
			 $image_count = count($_FILES['banner_image']['name']);
			 if($image_count>0)
		     { 
					$config1=array('upload_path'=>'uploads/banners/',
							'allowed_types'=>'jpg|jpeg|gif|png',
							'file_name'=>rand(1,9999),'max_size'=>0);
					$this->load->library('upload',$config1);
					$this->upload->initialize($config1);
					$files = $_FILES;
					for($j=0; $j<$image_count;$j++)
					{
				list($width, $height) = getimagesize($_FILES['banner_image']['tmp_name'][$j]);
              	if($width!=1170 && $height!=354)
					{
						 $this->session->set_flashdata('error','Size of image should be 1170X354.'); 
						 redirect(base_url()."superadmin/admin/managebanner/"); 
					 }
						$_FILES['banner_image']['name']     = $files['banner_image']['name'][$j]; 
						$_FILES['banner_image']['type']     = $files['banner_image']['type'][$j];
						$_FILES['banner_image']['tmp_name'] = $files['banner_image']['tmp_name'][$j];
						$_FILES['banner_image']['error']    = $files['banner_image']['error'][$j];
						$_FILES['banner_image']['size']     = $files['banner_image']['size'][$j];
						if($this->upload->do_upload('banner_image'))
						{
							$dt=$this->upload->data();
							$banner_image=$dt['file_name'];
							$data_array=array('banner_image'=>$banner_image,'link'=>$link);
							$this->master_model->insertRecord('tbl_banner_master',$data_array);
						}
						else
						{
							$data['error']=$this->upload->display_errors(); 
						}
					}
					$this->session->set_flashdata('success','Banner added successfully');
					redirect(base_url().'superadmin/admin/managebanner/');
			  }
	   }
	   if($banner_id!='' && is_numeric(base64_decode($banner_id)))
	   {
		   $data['ban']=$this->master_model->getRecords('tbl_banner_master',array('banner_id'=>base64_decode($banner_id)));
		   $flag='';
		   if(isset($_POST['btn_update']))
	       { 
			   
				  $link=$this->input->post('link');
				   $config=array('upload_path'=>'uploads/banners/',
							     'allowed_types'=>'jpg|jpeg|gif|png',
							     'file_name'=>rand(1,9999)
								 );
					   $this->upload->initialize($config);
					   if($_FILES['newimg']['name']!='')
					   {
						 if($this->upload->do_upload('newimg'))
						 {
							list($width, $height) = getimagesize($_FILES['newimg']['name']);
              				if($width!=1170 && $height!=354)
					 		{
						 		$this->session->set_flashdata('error','Size of image should be 1170X354.'); 
						 		redirect(base_url()."superadmin/admin/managebanner/".$banner_id); 
					  		}
							@unlink('uploads/banners/'.$data['ban'][0]['banner_image']);  
							$dt=$this->upload->data();
							$file=$dt['file_name'];
						 }
						 else
						 {
							 $data['error']=$this->upload->display_errors();
							 $flag=1;
						 }
					  }
					  else
					  {
						 $file=$data['ban'][0]['banner_image'];
					  }
					  if($flag==0)
					  {
						  $link_array=array('banner_image'=>$file,'link'=>$link); 
						  if($this->master_model->updateRecord('tbl_banner_master',$link_array,array('banner_id'=>base64_decode($banner_id))))
						  {    
							$this->session->set_flashdata('success','Record Update successfully.');
							redirect(base_url().'superadmin/admin/managebanner/');
						  }
					  }
		  }	  
	   }
	   $data['fetch_banner']=$this->master_model->getRecords('tbl_banner_master');
	   $data['middle_content']='managebanner';
	   $this->load->view('admin/common-file',$data);
	}
	
	//delete banner
	public function deletebanner($banner_id,$unlik_image)
	{
		$data['success']=$data['error']='';
		$num=$this->master_model->getRecordCount('tbl_banner_master');
		if($num!=1)
		{
			if($this->master_model->deleteRecord('tbl_banner_master','banner_id',$banner_id)) 
			{
				@unlink('uploads/banners/'.$unlik_image);
				$this->session->set_flashdata('success','Banner deleted successfully.');
				redirect(base_url().'superadmin/admin/managebanner/');
			}
			else
			{
				$this->session->set_flashdata('error','Error while deleting record.'); 
				redirect(base_url().'superadmin/admin/managebanner');
			}
		}
		else
		{
		 $this->session->set_flashdata('error','This is last banner image, not deleted.');
		redirect(base_url().'superadmin/admin/managebanner/');
		}
	}
	
	
	//manage message
	public function addmessage()
	{
		$data['success']=$data['error']='';
		$data['pagetitle']='Add Message ';
		if(isset($_POST['btn_update_message']))
	  { 
	    $this->form_validation->set_rules('message_title','','required|xss_clean');
		$this->form_validation->set_rules('message_desc','','required|xss_clean');
		if($this->form_validation->run())
		{
			$message_title=$this->input->post('message_title',true);
			$message_desc=$this->input->post('message_desc',true);
			$input_array=array('message_title'=>$message_title,'message_desc'=>$message_desc);
			if($this->master_model->updateRecord('tbl_community_message',$input_array,array('message_id'=>'1')))
			{
			$this->session->set_flashdata('success','Record Update successfully.');
			redirect(base_url().'superadmin/admin/addmessage/');
			}
	  }
	  else
		  {
			$data['error']=$this->form_validation->error_string();
		  }
	  }
	    $data['message']=$this->master_model->getRecords('tbl_community_message');
		$data['middle_content']='addmessage';
		$this->load->view('admin/common-file',$data);
		
	}
}