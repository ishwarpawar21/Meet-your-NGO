<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller {
    public function __construct()
    {
	   parent::__construct();
	    $this->load->library('upload');  
	}
	public function profile()
	{
		//$seller_id = base64_decode($seller_id);
	    $login_id = $this->session->userdata('login_id');
	    if($login_id!='' && is_numeric($login_id))
	    {
		  $data['page_title']='Profile';
		  //$this->db->join('tbl_country_master','tbl_country_master.id=tbl_user_master.country_id');
	 	  $this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_user_master.login_id');
		  $data['userdetail']=$this->master_model->getRecords('tbl_user_master',array('tbl_user_master.login_id'=>$login_id));
		  $data['category']=$this->master_model->getRecords('tbl_category_master',array('category_status'=>'1'));
		  
		  $this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_community_comments.sender_id');
		  $this->db->order_by('id','DESC');
		  $this->db->limit(10);
		  $data['dataComments']=$this->master_model->getRecords('tbl_community_comments',array('isreply'=>'no','receiver_id'=>$this->session->userdata('login_id')));
		  
		  $this->db->join('tbl_seller_details','tbl_seller_details.loginid=tbl_login_master.login_id');
		  $data['seldetail']=$this->master_model->getRecords('tbl_login_master',array('tbl_login_master.login_id'=>$login_id));
		  if(!count($data['seldetail']))
		  {
			$this->db->join('tbl_user_master','tbl_user_master.login_id=tbl_login_master.login_id');
			$data['seldetail']=$this->master_model->getRecords('tbl_login_master',array('tbl_login_master.login_id'=>$login_id));
		  }
		//$this->db->join('select');
		$numOfShare=$this->master_model->getRecordCount('tbl_userscored_point',array('tbl_userscored_point.point_type'=>'fb_share','tbl_userscored_point.login_id'=>$login_id));
	
		
		 $this->db->join('tbl_coupon_master','tbl_coupon_master.coupon_id=tbl_userscored_point.coupon_id','LEFT');
		 $this->db->group_by('tbl_userscored_point.coupon_id');
		 $data['fetchSharedCoupon']=$this->master_model->getRecords('tbl_userscored_point',array('tbl_userscored_point.point_type'=>'fb_share','tbl_userscored_point.login_id'=>$login_id),'','',0,6);

		  $data['middle_content']='user_profile';
	 	  $this->load->view('templete',$data);
		}
		else
		{$this->load->view('admin/404');}
	}
	public function edit()
	{
	    $login_id = $this->session->userdata('login_id');
		$usercnt=$this->master_model->getRecordCount('tbl_user_master',array('tbl_user_master.login_id'=>$login_id)); 
		if($login_id!='' && is_numeric($login_id)  && $usercnt>0)
	    {
			$file_name="";
			if(isset($_POST['btn_update_user']))
			{ 
			$this->form_validation->set_rules('first_name','Firstname','required|xss_clean');
			$this->form_validation->set_rules('last_name','Lastname','required|xss_clean');
			$this->form_validation->set_rules('contact_no','Contact Number','required|xss_clean');
			$this->form_validation->set_rules('address','Address','required|xss_clean');
			$this->form_validation->set_rules('city_id','City','required|xss_clean');
			$this->form_validation->set_rules('state_id','State','required|xss_clean');
			$this->form_validation->set_rules('country_id','country','required|xss_clean');
			if($this->form_validation->run())
			{ 
				$first_name=$this->input->post('first_name',true);
				$last_name=$this->input->post('last_name',true);
				$contact_no=$this->input->post('contact_no',true);
				$address=$this->input->post('address',true);
				$city_id=$this->input->post('city_id',true);
				$state_id=$this->input->post('state_id',true);
				$country_id=$this->input->post('country_id',true);
				$profile_pictureold=$this->input->post('profile_pictureold',true);
				//$loginid=$this->input->post('loginid',true);
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
				$update_user_array=array('first_name'=>$first_name,'last_name'=>$last_name,'address'=>$address,'contact_no'=>$contact_no,'city_id'=>$city_id,'state_id'=>$state_id,'country_id'=>$country_id,'profile_picture'=>$file_name); 
				if($this->master_model->updateRecord('tbl_user_master',$update_user_array,array('login_id'=>$login_id)))
				{
					$this->session->set_flashdata('success','Profile updates Successfully.');
					redirect(base_url().'user/edit');
				}
			}
		}
		$data['page_title']='Edit Profile';
		$this->db->join('tbl_country_master','tbl_country_master.id=tbl_user_master.country_id');
		$this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_user_master.login_id');
		$data['userinfo']=$this->master_model->getRecords('tbl_user_master',array('tbl_user_master.login_id'=>$login_id)); 
		$data['fetchcountry']=$this->master_model->getRecords('tbl_country_master');
		$data['middle_content']='edit_user_profile';
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
	    $login_id = $this->session->userdata('login_id');
		if($login_id!='' && is_numeric($login_id))
	    {
			$data['page_title']='Delete';
			$update_loginstatus_array=array('account_status'=>"Delete"); 	
			if($this->master_model->updateRecord('tbl_login_master',$update_loginstatus_array,array('login_id'=>$login_id)))
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
	public function accountpreferences()
	{
	  $login_id = $this->session->userdata('login_id');	
	  if($login_id!='' && is_numeric($login_id)) 
  	  {
		  if(isset($_POST['btn_change_password']))
		  { 
				$this->form_validation->set_rules('current_pass','Old Password','required|xss_clean');
				$this->form_validation->set_rules('new_pass','New Password','required|xss_clean');
				if($this->form_validation->run())
				{
						$current_pass=$this->input->post('current_pass',true);
						$new_pass=$this->input->post('new_pass',true);
						$row=$this->master_model->getRecordCount('tbl_login_master',array('password'=>$current_pass,'login_id'=>$login_id));
						if($row==0)
						{
							$this->session->set_flashdata('error','Old Password is Wrong.');
							redirect(base_url().'user/accountpreferences');
						}
						else
						{
							$input_array=array('password'=>$new_pass);
							$this->master_model->updateRecord('tbl_login_master',$input_array,array('login_id'=>$login_id));
							$this->session->set_flashdata('success','Password Updated Successfully.');
							redirect(base_url().'user/accountpreferences');
						}
				  }
		  }	
		  $data['page_title']='Account Preferences';
		  $data['middle_content']='account_pref';
		  $this->load->view('templete',$data);
	  }
	  else
	  {
		  redirect(base_url());
	  }
	}
	//Manage favourite Coupon Of User Start
	public function favourite_coupon()
	{
	   $this->load->library('pagination');
	   $data['page_title']='Manage Favourite Coupon';
	   $login_id=$this->session->userdata('login_id');
	   if($login_id!='')
	   {
			/*pagingnation*/
			$this->db->join('tbl_coupon_master','tbl_coupon_master.coupon_id=tbl_save_master.couponid');
			$data['fetch_manage_coupon']=$this->master_model->getRecords('tbl_save_master',array('tbl_save_master.coupon_login_id'=>$login_id,'tbl_coupon_master.coupon_status'=>'1'));
			$config['base_url']=base_url().'user/favourite_coupon/';
			$config['total_rows']=count($data['fetch_manage_coupon']);
			$config['per_page'] =20;
			$config['uri_segment']=3;
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$this->pagination->initialize($config); 
			/*pagingnation*/ 
		   
		   $this->db->join('tbl_coupon_master','tbl_coupon_master.coupon_id=tbl_save_master.couponid');
		   $this->db->ORDER_BY('tbl_save_master.coupon_save_id','DESC');
		   $data['fetch_manage_coupon']=$this->master_model->getRecords('tbl_save_master',array('tbl_save_master.coupon_login_id'=>$login_id,'tbl_coupon_master.coupon_status'=>'1'),'','',$page,$config['per_page']);
		   $data['links']=$this->pagination->create_links();
		   $data['category']=$this->master_model->getRecords('tbl_category_master',array('category_status'=>'1'));
		   $data['middle_content']='manage-favourite-coupon';
		   $this->load->view('templete',$data); 
	   }
	   else
	   {
		   redirect(base_url());
		}
	 }
	//Manage favourite Coupon Of User End
	//Manage favourite Coupon  Delete from User Start
	public function coupon_delete($page,$coupon_save_id='')
	{
		$coupon_save_id=base64_decode($coupon_save_id);
		if($this->master_model->deleteRecord('tbl_save_master','coupon_save_id',$coupon_save_id))
		{
			$this->session->set_flashdata('success','Coupon deleted successfully.');
		   	redirect(base_url().'user/favourite_coupon/'.$page);
		}
		else
		{
			$this->session->set_flashdata('error','Error while deleting Coupon.'); 
		   	redirect(base_url().'user/favourite_coupon/'.$page);
		}
	}
	 //Manage favourite Coupon Delete from User End
	public function signout()
	{
      $userdata=array('email_id'=>$this->session->userdata('email_id'),'login_id'=>$this->session->userdata('login_id'),'user_slug'=>$this->session->userdata('user_slug'));
	  session_destroy();
	  $this->session->unset_userdata($userdata);
	  redirect(base_url());
	}
	public function checkfacebook()
    {
        $facebook = new Facebook(array('appId'=>$this->config->item('appID'),'secret'=>$this->config->item('appSecret'),));
        $user =$facebook->getUser(); // Get the facebook user id 
		if(!$user)
		{
		  //redirect(base_url().'home/checkfacebook/');
		}
		else
		{
		  $user = $facebook->api('/me');
		  if(isset($user['email']))
		  {
		     $database_user=$this->master_model->getRecords('tbl_login_master',array('email_id'=>$user['email']));
			 if(count($database_user)=='0')
			 {
                if($user['name']!='')
				{$user_slug=$user['name'];}else{$user_slug='';}
				
				$user_array=array('email_id'=>$user['email'],'user_type'=>'seller','user_status'=>'1','verified_status'=>'1','user_slug'=>$user_slug);
			    $instid=$this->master_model->insertRecord('tbl_login_master',$user_array,TRUE);
				/*this is the insert in seller table*/
				$array_seller=array('loginid'=>$instid,'username'=>$user_slug);
			    $this->master_model->insertRecord('tbl_seller_details',$array_seller);
				/*this is the insert in seller table*/
				/*this is the set session of the user*/
				$userdata=array('email_id'=>$user['email'],'login_id'=>$instid,'user_slug'=>$user_slug,'user_type');
				$this->session->set_userdata($userdata);
				redirect(base_url());
			 }
			 else
			 {
				$userdata=array('email_id'=>$user['email'],'login_id'=>$database_user[0]['login_id'],'user_slug'=>$database_user[0]['user_slug']);
                $this->session->set_userdata($userdata);
				redirect(base_url().'profile');
			 }
		  }
		  else
		  {
			 redirect(base_url().'home/signup/');
		  }
		}
	  $data['middle_content']='home';
	  $this->load->view('templete',$data);
   }
    public function signup()
    {
	 	if($this->session->userdata('login_id')=='')
		{
			$data['page_title']='Sign up';
			if(isset($_POST['btn_save']))
			{
				$this->form_validation->set_rules('email','email','required|valid_email|is_unique[tbl_login_master.email_id]');
				$this->form_validation->set_rules('user_slug','Name','required');
				$this->form_validation->set_rules('password','Password','required');
				if($this->form_validation->run())
				{
				  $email=$this->input->post('email');
				  $user_slug=$this->input->post('user_slug');
				  $password=$this->input->post('password');
				  $user_type=$this->input->post('user_type');
				  $userslug=$this->master_model->create_slug($user_slug,'tbl_login_master','user_slug');
				  $user_array=array('email_id'=>$email,'user_type'=>'seller','user_status'=>'1','verified_status'=>'1','user_slug'=>$userslug,'password'=>$password,'user_type'=>$user_type);
				  $instid=$this->master_model->insertRecord('tbl_login_master',$user_array,TRUE);
				  /*This is the insert in seller and user master table*/
				  if($user_type=='seller')
				  {
					 $array_seller=array('loginid'=>$instid,'username'=>$user_slug);
					 $this->master_model->insertRecord('tbl_seller_details',$array_seller);
				  }
				  else
				  {
					 $array_user=array('login_id'=>$instid,'username'=>$user_slug);
					 $this->master_model->insertRecord('tbl_user_master',$array_user);  
				  }
				  /*this is the insert in seller table*/
				  /*this is the set session of the user*/
				  $userdata=array('email_id'=>$email,'login_id'=>$instid,'user_slug'=>$user_slug,'user_type'=>$user_type);
				  $this->session->set_userdata($userdata);
				  redirect(base_url().'profile');
			   }
			}
			$data['middle_content']='account_private';
			$this->load->view('templete',$data);
		}
		else
		{
			  redirect(base_url('profile'));
		}
   }
    public function login()
    {
	if($this->session->userdata('login_id')=='')
	{ 
	 $data['page_title']='Login'; 
	 if(isset($_POST['btn_login']))
	 {
	   $this->form_validation->set_rules('email','email','required|valid_email');
	   $this->form_validation->set_rules('password','Password','required');
	   if($this->form_validation->run())
	   {
		  $email=$this->input->post('email');
		  $Password=$this->input->post('password');  
		  $database_user=$this->master_model->getRecords('tbl_login_master',array('email_id'=>$email,'password'=>$Password));
		  if(count($database_user)=='1')
		  {
			$update_loginstatus_array=array('account_status'=>'Active'); 	
			$this->master_model->updateRecord('tbl_login_master',$update_loginstatus_array,array('email_id'=>'"'.$email.'"')); 
			$userdata=array('email_id'=>$email,'login_id'=>$database_user[0]['login_id'],'user_slug'=>$database_user[0]['user_slug'],'user_type'=>$database_user[0]['user_type']);
			$this->session->set_userdata($userdata);
			if($database_user[0]['user_type']=='seller')
			{
			  redirect(base_url().'seller/profile');
			}
			else
			{
			   redirect(base_url().'user/profile');	
			}
		  }
		  else
		  {
		    $this->session->set_flashdata('error','Invalid email or password !');
		    redirect(base_url().'login');
		  }
	   }
	 }
	 $data['middle_content']='account_login';  
	 $this->load->view('templete',$data); 
	 }
	else
	{
	  redirect(base_url('profile'));
	}
   }
   public function upgrade()
   {
	  $data['page_title']='Upgrade User';
	  $array_data=array('login_id'=>$this->session->userdata('login_id'));
	  $data['checkInsert']=$this->master_model->getRecords('tbl_upgrade_request',$array_data);
	  if(isset($_POST['btn_upgrade']))
	  {
		 $this->form_validation->set_rules('business_name','Business Name','required');  
		 $this->form_validation->set_rules('business_type','Business Type','required');
		 $this->form_validation->set_rules('business_desc','Business Description','required');
		 $this->form_validation->set_rules('contact_no','Contact Number','required');
	     if($this->form_validation->run())
		 {
			 $business_name=$this->input->post('business_name',true);
			 $business_type=$this->input->post('business_type',true);
			 $business_desc=$this->input->post('business_desc',true);
			 $contact_no=$this->input->post('contact_no',true);
			 $array_insert=array('business_name'=>$business_name,'business_type'=>$business_type,'business_desc'=>$business_desc,'contact_no'=>$contact_no,'login_id'=>$this->session->userdata('login_id'));
			 if($this->master_model->insertRecord('tbl_upgrade_request',$array_insert))
			 {
			  $this->session->set_flashdata('success','Request send successfully.');	 
			   redirect(base_url().'user/upgrade/');
			 }
			 
		 }
	  }
	  $data['middle_content']='upgrade_request';  
	  $this->load->view('templete',$data); 
   }
   public function more_content()
	{
		$getLastContentId=$_POST['getLastContentId'];
		
		$this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_community_comments.sender_id');
		$this->db->where('tbl_community_comments.id < "'.$getLastContentId.'"',FALSE,FALSE);
		$this->db->where('isreply','no')->where('receiver_id',$this->session->userdata('login_id'));
		$this->db->order_by('id','DESC');
		$this->db->limit(10);
		$dataComments=$this->master_model->getRecords('tbl_community_comments');
		if(count($dataComments))
		{
			foreach($dataComments as $userCmnt)
			{
				$id=$userCmnt['id'];
					  if($userCmnt['user_type']=='seller')
						  {
							   $getImage=$this->master_model->getRecords('tbl_seller_details',array('loginid'=>$userCmnt['login_id'])); 
							   $imageName = $getImage[0]['profilepic'];
							   $imagePath = 'uploads/profile_image/thumb/'.$imageName;
							   if(!file_exists($imagePath) || $imageName =='')
							   {$imagePath = 'images/profile-icon.png';}
						  }
						  else
						  {
							  $getImage=$this->master_model->getRecords('tbl_user_master',array('login_id'=>$userCmnt['login_id']));
							  $imageName = $getImage[0]['profile_picture'];
							  $imagePath = 'uploads/profile_image/thumb/'.$imageName;
							  if(!file_exists($imagePath) || $imageName =='')
							   {$imagePath = 'images/profile-icon.png';}
						   }
							
						echo ' <div class="active-box-inner">
							<div class="comments-box">
							  <div class="comments-box-left"><img src="'.base_url().$imagePath.'" width="36" height="36" alt="user"/></div>
							  <div class="comments-box-right" style="width:755px !important;">
								<div class="comments-arow"></div>
								<div class="comments-outer">
								  <div class="comments-desk">'.nl2br($userCmnt['comments']).'</div>
								  <div class="clr"></div>
								  <div class="comments-posted"><span><a href="'.base_url().'community/member/'.$userCmnt['user_slug'].'/">'.$userCmnt['user_slug'].'</a></span></div>
								  <div class="comments-title" style="float:right;"><span>&nbsp;
									<form name="frmCmnt_'.$userCmnt['id'].'" method="post" style="width:auto !important;">
									  <input type="hidden" name="commentId" value="'.$userCmnt['id'].'" />
									  <button type="submit" class="com-refresh" name="btnDelete" >delete</button>
									</form>
									</span></div>
								  <div class="comments-title" style="float:right;"><span> <a href="'.base_url().'community/member/'.$userCmnt['user_slug'].'/">reply on '.$userCmnt['user_slug'].'\'s profile </a> </span></div>
								</div>
							  </div>
							  <div class="clr"></div>
							</div>
						  </div>
						  <div class="clr"></div>
						  <div class="active-inner" style="text-align:center;"><a href="#">
						<div id="load_more_'.$id.'" class="more_tab">
							<div id="'.$id.'" class="more_button">Load More Content</div>
						</div>
					</a></div>';
			}
		}
		else
		{
			echo '<div class="active-inner" style="text-align:center;"><div class="all_loaded">No More Content to Load</div></div>';
		}
		
		//echo $this->db->last_query();
		
	}
   
}