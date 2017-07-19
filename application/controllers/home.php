<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'libraries/facebook/facebook.php';
class Home extends CI_Controller {
    public function __construct()
    {
	   parent::__construct();
	   $this->load->library('upload'); 
	   $this->load->library('aws_signed_request');  
	   $this->load->model('email_sending');
	   $this->config->load('facebook'); 	  
	   $this->load->library('pagination');
	   date_default_timezone_set('Asia/Calcutta'); 
	}
	public function index($search='all',$searchdate='')
	{
		echo "Site Under Construction";
	}
	public function showcode()
	{
		$postid = $this->uri->segment(2);
		$data['page_title']='Coupon Code';
		if($this->session->userdata('isShared')=='yes' && $this->session->userdata('isPostId')==$postid)
		{
			$couponId=$_COOKIE['selectedCoupon'];
			$login_id=$this->session->userdata('login_id');
			$point_type='fb_share';
			$point_comment=$this->master_model->getRecords('tbl_points_master');
			$comment_point=$point_comment[0]['fb_share_point'];
			$check_array=array('coupon_id'=>$couponId,'login_id'=>$login_id,'point_type'=>$point_type);
			$userscored=$this->master_model->getRecords('tbl_userscored_point',$check_array); 
			if(count($userscored)==0)
			{
				$UserscorArray=array('point_type'=>$point_type,'login_id'=>$login_id,'coupon_id'=>$couponId,'share_point'=>$comment_point,'scored_date'=>date('Y-m-d H:i:s'),'post_id'=>$postid);
				$insert_id=$this->master_model->insertRecord('tbl_userscored_point',$UserscorArray,TRUE);
			}
			$this->db->select('tbl_coupon_master.*,tbl_brand_master.*');
			$this->db->join('tbl_brand_master','tbl_brand_master.brand_id=tbl_coupon_master.coupon_brand_id');
			$this->db->where('tbl_coupon_master.coupon_expirydate >=',date('Y-m-d'));
	        $this->db->order_by('tbl_coupon_master.coupon_expirydate');
			$data['product_coupon']=$this->master_model->getRecords('tbl_coupon_master',array('tbl_coupon_master.coupon_status'=>'1'));
			$data['productcoupon']=count($data['product_coupon']);
			$data['category']=$this->master_model->getRecords('tbl_category_master',array('category_status'=>'1'));
			$data['links']='';
			$data['middle_content']='home';
			$this->load->view('templete',$data);
	    }
		else
		{
			$this->session->unset_userdata('isShared');
			$this->session->unset_userdata('isPostId');
			setcookie('selectedCoupon','',time()-3600,'/');
			redirect(base_url());
		}
	}
	public function share_coupon($page_num=1)
	{
	  $data['page_title']='Share Coupon';
	  $couponId =base64_decode($this->uri->segment(2));
	  $this->db->select('tbl_coupon_master.*,tbl_brand_master.*');
	  $this->db->join('tbl_brand_master','tbl_brand_master.brand_id=tbl_coupon_master.coupon_brand_id');
	  $data['productCoupon']=$this->master_model->getRecords('tbl_coupon_master',array('tbl_coupon_master.coupon_id'=>$couponId));
	  $data['myPagination'] = $this->pagination_code($couponId);
	  $this->load->view('share_coupon',$data);
	}
	public function comment()
	{
	  $data['page_title']='Comment Coupon';
	  $couponId =base64_decode($this->uri->segment(2));
	  $this->db->select('tbl_coupon_master.*,tbl_brand_master.*');
	  $this->db->join('tbl_brand_master','tbl_brand_master.brand_id=tbl_coupon_master.coupon_brand_id');
	  $data['productCoupon']=$this->master_model->getRecords('tbl_coupon_master',array('tbl_coupon_master.coupon_id'=>$couponId));
	  $data['middle_content']='share_coupon';
	  $this->load->view('templete',$data);
	}
	public function showcoupon()
	{ 
	  $data['page_title']='Show Coupon';
	  $couponId=base64_decode($this->uri->segment(3));
	  $post_id=$this->uri->segment(4);
	  $login_id=$this->session->userdata('login_id');
	  $point_type='fb_share';
	  $point_comment=$this->master_model->getRecords('tbl_points_master');
	  $comment_point=$point_comment[0]['fb_share_point'];
	  $check_array=array('coupon_id'=>$couponId,'login_id'=>$login_id,'point_type'=>$point_type);
	  $userscored=$this->master_model->getRecords('tbl_userscored_point',$check_array); 
	  if(count($userscored)==0)
	  {
	    $UserscorArray=array('point_type'=>$point_type,'login_id'=>$login_id,'coupon_id'=>$couponId,'share_point'=>$comment_point,'scored_date'=>date('Y-m-d H:i:s'),'post_id'=>$post_id);
	    $insert_id=$this->master_model->insertRecord('tbl_userscored_point',$UserscorArray,TRUE);
	  }
	  $this->db->select('tbl_coupon_master.*,tbl_brand_master.*');
	  $this->db->where('tbl_coupon_master.coupon_expirydate >=',date('Y-m-d'));
	  $this->db->order_by('tbl_coupon_master.coupon_expirydate');
	  $this->db->join('tbl_brand_master','tbl_brand_master.brand_id=tbl_coupon_master.coupon_brand_id');
	  $data['productCoupon']=$this->master_model->getRecords('tbl_coupon_master',array('tbl_coupon_master.coupon_id'=>$couponId));
	  $data['myPagination'] = $this->pagination_code2($couponId);
	  
	  $this->load->view('show_coupon',$data);
	}
	public function sharefacebook()
	{
		if(isset($_GET['post_id']))
		{
			$_userData=array('isShared'=>'yes','isPostId'=>$_GET['post_id']);
			$this->session->set_userdata($_userData);
			redirect(base_url().'showcode/'.$_GET['post_id']);
		}
		if($this->session->userdata('login_id')=='' && $this->session->userdata('email_id')=='')
		{
		$facebook = new Facebook(array('appId'=>$this->config->item('appID'),'secret'=>$this->config->item('appSecret')));
		$user =$facebook->getUser(); // Get the facebook user id 
		if($user)
		{
		  $user = $facebook->api('/me');
		  $args=array();
		  $args['next']=base_url();
		  $args['access_token']=$facebook->getAccessToken();
		  if(isset($user['email']))
		  {
		     $database_user=$this->master_model->getRecords('tbl_login_master',array('email_id'=>$user['email']));
			 if(count($database_user)=='0')
			 {
				  if($user['first_name']!='')
				  {$user_slug=$user['first_name'];}else{$user_slug=$user['name'];}
					
				   $_slug 				= 	str_ireplace("'",'',$user['first_name']);
				   $_slugOut			=	preg_replace('/[^a-zA-Z0-9]/s',' ',$_slug);
				   $slugName			=	preg_replace('/\s+/','_',$_slugOut);
				   
				  $sqlSlug		 		=	 'SELECT user_slug FROM tbl_login_master WHERE user_slug = "'.$slugName.'" ';
				  $exceSlug		 	=	 mysql_query($sqlSlug);
				  $slugNor 			= 	 mysql_num_rows($exceSlug);
				  if($slugNor > 0)
				  {
					  if($slugNor	==  1)
					  {$slugCnt = 1;}
					  else
					  {$slugCnt = $slugNor+1;}
					  $slugName 	= $slugName.'_'.$slugCnt;
				  }
				  $user_array=array('email_id'=>$user['email'],'user_type'=>'user','user_status'=>'1','verified_status'=>'1','user_slug'=>strtolower($slugName));
				  $instid=$this->master_model->insertRecord('tbl_login_master',$user_array,TRUE);
				  $arrayuser=array('login_id'=>$instid,'username'=>$slugName,'first_name'=>$user['first_name'],'last_name'=>$user['last_name']);
				  $this->master_model->insertRecord('tbl_user_master',$arrayuser);
				  $userdata=array('email_id'=>$user['email'],'login_id'=>$instid,'user_slug'=>$user_slug,'user_type'=>'user');
				  $this->session->set_userdata($userdata);
				  redirect(base_url().'share/coupon/','refresh');
			 }
			 else
			 {
				$userdata=array('email_id'=>$user['email'],'login_id'=>$database_user[0]['login_id'],'user_slug'=>$database_user[0]['user_slug'],'user_type'=>$database_user[0]['user_type']);
			   $this->session->set_userdata($userdata);
			   redirect(base_url().'share/coupon/','refresh');
			 }
		  }
		}	
		}
		else
		{
		 redirect(base_url().'share/coupon/','refresh');		
		}
	}
	/*All Deal Display Start*/
	public function alldeal()
	{
	  /*pagingnation*/
	  $this->db->join('tbl_brand_master','tbl_brand_master.brand_id=tbl_coupon_master.coupon_brand_id');	  
	  $this->db->where('tbl_coupon_master.coupon_expirydate >=',date('Y-m-d'));
	  $this->db->order_by('tbl_coupon_master.coupon_expirydate'); 
	  $fetchalldeal=$this->master_model->getRecordCount('tbl_coupon_master',array('coupon_status'=>'1','deal'=>'deal'));
	  $config['base_url']=base_url().'deal/';
	  $config['total_rows']=$fetchalldeal;
	  $config['per_page'] =5;
	  $config['uri_segment']=2;
	  $page_link = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
	  $config['num_links'] = 5;
	  if(empty($page_link)) $page_link = 1;
	  $page = ($page_link-1) * $config['per_page'];
	  $page_url = $config['base_url'].'/'.$page;
	 
	  $config['use_page_numbers'] = TRUE; 
	  $config['full_tag_open'] = '<ul>';
	  $config['full_tag_close'] = '</ul>';
	  $config['prev_link'] = '&lt;';
	  $config['prev_tag_open'] = '<li>';
	  $config['prev_tag_close'] = '</li>';
	  $config['next_link'] = '&gt;';
	  $config['next_tag_open'] = '<li>';
	  $config['next_tag_close'] = '</li>';
	  $config['cur_tag_open'] = '<li><a  href="'.$page_url.'" class="active">';
	  $config['cur_tag_close'] = '</a></li>';
	  $config['num_tag_open'] = '<li>';
	  $config['num_tag_close'] = '</li>';
	  $config['first_tag_open'] = '<li>';
	  $config['first_tag_close'] = '</li>';
	  $config['last_tag_open'] = '<li>';
	  $config['last_tag_close'] = '</li>';
	  $config['first_link'] = '&lt;&lt;';
	  $config['last_link'] = '&gt;&gt;'; 
      $this->pagination->initialize($config); 
	  /*pagingnation*/ 
	  $this->db->join('tbl_brand_master','tbl_brand_master.brand_id=tbl_coupon_master.coupon_brand_id');	  
	  $this->db->where('tbl_coupon_master.coupon_expirydate >=',date('Y-m-d'));
	  $this->db->order_by('tbl_coupon_master.coupon_expirydate');
	  $data['fetch_all_deal']=$this->master_model->getRecords('tbl_coupon_master',array('coupon_status'=>'1','deal'=>'deal'),'','',$page,$config['per_page']);	
	 
	  $data['links']=$this->pagination->create_links();
	  $data['category']=$this->master_model->getRecords('tbl_category_master',array('category_status'=>'1'));
	  $data['page_title']='Deal Coupon';
	  $data['middle_content']='deal_coupon';
	  $this->load->view('templete',$data);
	}	
	/*All Deal Display End*/
   	public function page($page='')
	{
	  $data['pagedetail']=$this->master_model->getRecords('tbl_front_page',array('page_slug'=>$page));
	  if(count($data['pagedetail'])>0)
	  {
		 $data['page_title']='Page';
		 if($page=='what-is-this')
		 {
		 //$data['middle_content']='page';
		 $this->load->view('what_is_this',$data);
		 }
		 else
		 {
		 $data['middle_content']='page';
		 $this->load->view('templete',$data);
		 }
	  }
	  else
	  {
		  redirect(base_url());
	  }
	}
	public function contact_us()
	{
	     $this->db->join('tbl_faq_categories','tbl_faq_categories.faqid=tbl_faq_master.faq_id');
		 $data['faq_contactus']=$this->master_model->getRecords('tbl_faq_master',array('tbl_faq_categories.faqcat_id'=>'2','tbl_faq_master.faq_status'=>'1'));
		$data['admin_info']=$this->master_model->getRecords('admin_login');		 
		 if(isset($_POST['btn_contact_us']))
		   { 
			$this->form_validation->set_rules('con_first_name','Firstname','required|xss_clean');
			$this->form_validation->set_rules('cont_last_name','Lastname','required|xss_clean');
			$this->form_validation->set_rules('cont_email','Email Id','required|xss_clean');
			$this->form_validation->set_rules('cont_mobile','Contact number','required|xss_clean');
			$this->form_validation->set_rules('cont_message','Message','required|xss_clean');
			if($this->form_validation->run())
			{ 
				$con_first_name=$this->input->post('con_first_name',true);
				$cont_last_name=$this->input->post('cont_last_name',true);
				$cont_email=$this->input->post('cont_email',true);
				$cont_mobile=$this->input->post('cont_mobile',true);
				$cont_message=$this->input->post('cont_message',true);
				$insert_contactus_array=array('con_first_name'=>$con_first_name,'cont_last_name'=>$cont_last_name,'cont_mobile'=>$cont_mobile,'cont_email'=>$cont_email,'cont_message'=>$cont_message,'added_date'=>date('Y-m-d')); 
				if($this->master_model->insertRecord('tbl_contact_inqury',$insert_contactus_array))
				{
					/*email sending for contact enquiry to admin Start*/
					$info_mail=$this->master_model->getRecords('admin_login');
					$info_arr=array('from'=>$info_mail[0]['admin_email'],
									'to'=>$info_mail[0]['admin_email'],
									'subject'=>'New Contact Inquiry',
									'view'=>'admin-contact-email');
				   $other_info=array('first_name'=>$con_first_name,'last_name'=>$cont_last_name,'mobile_no'=>$cont_mobile,'email_id'=>$cont_email,'message_txt'=>$cont_message);
					$this->email_sending->sendmail($info_arr,$other_info);
					/*email sending for contact enquiry to admin End*/
					/*email sending for contact enquiry to User Start*/
					$info_arr_user=array('from'=>$info_mail[0]['admin_email'],
									'to'=>$cont_email,
									'subject'=>'Contact Inquiry',
									'view'=>'user-contact-email');
					$other_info_user=array('first_name'=>$con_first_name,'last_name'=>$cont_last_name,'phone'=>$info_mail[0]['phone'],'admin_email'=>$info_mail[0]['admin_email']);
					$this->email_sending->sendmail($info_arr_user,$other_info_user);
					/*email sending for contact enquiry to User End*/
					$this->session->set_flashdata('success','Contact inqury inserted & Send mail successfully.');
					redirect(base_url().'contact-us');
				}
			}
		  }
	     $data['page_title']='Contact Us';
		 $data['middle_content']='contact-us';
		 $this->load->view('templete',$data);
	}
	public function contact_faq($faq_id='')
	{
	     $faq_id = base64_decode($faq_id);
		 $this->db->join('tbl_faq_categories','tbl_faq_categories.faqid=tbl_faq_master.faq_id');
		 $data['faq_contactus']=$this->master_model->getRecords('tbl_faq_master',array('tbl_faq_categories.faqcat_id'=>'2','tbl_faq_master.faq_status'=>'1'));
		 $data['faq_contactus_info']=$this->master_model->getRecords('tbl_faq_master',array('faq_id'=>$faq_id,'faq_status'=>'1'));
		 if(count($data['faq_contactus_info'])>0)
		 {
			 $data['page_title']='Contact Us Question';
			 $data['middle_content']='contact-us-faq';
			 $this->load->view('templete',$data);
		 }
		 else{redirect(base_url('contact-us'));}
	}
	public function checkfacebook()
    {
		$facebook = new Facebook(array('appId'=>$this->config->item('appID'),'secret'=>$this->config->item('appSecret')));
        $user =$facebook->getUser(); // Get the facebook user id 
		if($user)
		{
		  $user = $facebook->api('/me');
		  $args=array();
		  $args['next']=base_url();
		  $args['access_token']=$facebook->getAccessToken();
		  $_SESSION['logoutUrl']=$facebook->getLogoutUrl($args);
		  if(isset($user['email']))
		  {
			 if(isset($_COOKIE['user_type']))
			 {$user_type=$_COOKIE['user_type'];}
			 else
			 {$user_type='user';}
			  
			 $database_user=$this->master_model->getRecords('tbl_login_master',array('email_id'=>$user['email']));
			 if(count($database_user)=='0')
			 {
                if($user['first_name']!='')
				{$user_slug=trim($user['first_name']);}else{$user_slug=$user['name'];}
				$userslug=$this->master_model->create_slug($user_slug,'tbl_login_master','user_slug');
				$user_array=array('email_id'=>$user['email'],'user_type'=>$user_type,'user_status'=>'1','verified_status'=>'1','user_slug'=>$userslug,'password'=>time());
				
			    $instid=$this->master_model->insertRecord('tbl_login_master',$user_array,TRUE);
			    if($user_type=='seller')
				{
				  /*this is the insert in seller table*/
				  $arrayseller=array('loginid'=>$instid,'username'=>$user_slug,'brandaccess'=>'1','addcoupon'=>'1','firstname'=>$user['first_name'],'lastname'=>$user['last_name']);
			      $this->master_model->insertRecord('tbl_seller_details',$arrayseller);
				  /*this is the insert in seller table*/
				}
				else
				{
				  /*this is the insert in User table*/	
				  $arrayuser=array('login_id'=>$instid,'username'=>$user_slug,'first_name'=>$user['first_name'],'last_name'=>$user['last_name']);
			      $this->master_model->insertRecord('tbl_user_master',$arrayuser);
				  /*this is the insert in User table*/	
				}
				/*this is the set session of the user*/
				$userdata=array('email_id'=>$user['email'],'login_id'=>$instid,'user_slug'=>$user_slug,'user_type'=>$user_type);
				$this->session->set_userdata($userdata);
				if($user_type=='seller')
				{
			      unset($_COOKIE['user_type']);		
				  redirect(base_url().'seller/profile');
				}
				else
				{
				   unset($_COOKIE['user_type']);		
				   redirect(base_url().'user/profile');	
				}
			 }
			 else
			 {
				$userdata=array('email_id'=>$user['email'],'login_id'=>$database_user[0]['login_id'],'user_slug'=>$database_user[0]['user_slug'],'user_type'=>$database_user[0]['user_type']);
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
		  }
		  else
		  {
			 redirect(base_url().'facebook/signup/');
		  }
		}
	  $data['middle_content']='home';
	  $this->load->view('templete',$data);
   }
   public function facebook()
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
				  $user_array=array('email_id'=>$email,'user_status'=>'1','verified_status'=>'1','user_slug'=>$userslug,'password'=>$password,'user_type'=>$user_type);
				  $instid=$this->master_model->insertRecord('tbl_login_master',$user_array,TRUE);
				  /*This is the insert in seller and user master table*/
				  if($user_type=='seller')
				  {
					 $array_seller=array('loginid'=>$instid,'username'=>$user_slug,'brandaccess'=>'1','addcoupon'=>'1');
					 $this->master_model->insertRecord('tbl_seller_details',$array_seller);
					 $userdata=array('email_id'=>$email,'login_id'=>$instid,'user_slug'=>$user_slug,'user_type'=>$user_type);
				     $this->session->set_userdata($userdata);
			         redirect(base_url().'seller/profile/');
				  }
				  else
				  {
					 $array_user=array('login_id'=>$instid,'username'=>$user_slug);
					 $this->master_model->insertRecord('tbl_user_master',$array_user); 
					 $userdata=array('email_id'=>$email,'login_id'=>$instid,'user_slug'=>$user_slug,'user_type'=>$user_type);
				     $this->session->set_userdata($userdata);
					 redirect(base_url().'user/profile/'); 
				  }
				}
			}
			$data['middle_content']='account_private';
			$this->load->view('templete',$data);
		}
		else
		{
			  redirect(base_url());
		}
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
					 $array_seller=array('loginid'=>$instid,'username'=>$user_slug,'brandaccess'=>'1','addcoupon'=>'1');
					 $this->master_model->insertRecord('tbl_seller_details',$array_seller);
					 $userdata=array('email_id'=>$email,'login_id'=>$instid,'user_slug'=>$user_slug,'user_type'=>$user_type);
				     $this->session->set_userdata($userdata);
			         redirect(base_url().'seller/profile/');
				  }
				  else
				  {
					 $array_user=array('login_id'=>$instid,'username'=>$user_slug);
					 $this->master_model->insertRecord('tbl_user_master',$array_user); 
					 $userdata=array('email_id'=>$email,'login_id'=>$instid,'user_slug'=>$user_slug,'user_type'=>$user_type);
				     $this->session->set_userdata($userdata);
					 redirect(base_url().'user/profile/'); 
				  }
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
   public function forgot_password()
   {
	 $data['page_title']='Forgot Password'; 
	 if(isset($_POST['btn_forgot_password']))
	 {
	   $this->form_validation->set_rules('email','email','required|valid_email');
	   if($this->form_validation->run())
	   {
		  $email=$this->input->post('email');
		  $database_user=$this->master_model->getRecords('tbl_login_master',array('email_id'=>$email));
		  if(count($database_user)=='1')
		  {
				/*email sending for Front Forgot Password Start*/	
				$info_mail=$this->master_model->getRecords('admin_login');
				$info_arr=array('from'=>$info_mail[0]['admin_email'],
									'to'=>$email,
									'subject'=>'Password Recovery',
									'view'=>'front-forgot-password');
			    $other_info=array('name'=>$database_user[0]['user_slug'],'email_id'=>base64_encode($database_user[0]['email_id']),'login_id'=>base64_encode($database_user[0]['login_id']));  
			    $this->email_sending->sendmail($info_arr,$other_info);
				 /*email sending for Front Forgot Password End*/
				 $update_pass_array=array('forgot_password_status'=>'0'); 	
				 $update_pass=$this->master_model->updateRecord('tbl_login_master',$update_pass_array,array('email_id'=>'"'.$email.'"'));
				 $this->session->set_flashdata('success','Forgot Password mail send successfully.');
				 redirect(base_url().'forgot-password');
		  }
		  else
		  {
			$this->session->set_flashdata('error','Email id is not available!');
		    redirect(base_url().'forgot-password');
		  }
	   }
	 }
	 $data['middle_content']='forgot_password';  
	 $this->load->view('templete',$data); 
   }
   public function change_password($loginid='')
   {
	 $loginid=base64_decode($loginid);
	 $data['page_title']='Change Password'; 
	 $data['already']='';
	 $chk_user=array('login_id'=>$loginid); 	
	 $chkuser=$this->master_model->getRecordCount('tbl_login_master',$chk_user);	
	 
	 if($chkuser>0)
	 {
			 $update_password=array('forgot_password_status'=>'1','login_id'=>$loginid); 	
			 $cntpass=$this->master_model->getRecordCount('tbl_login_master',$update_password);	
			 if($cntpass==0)
			 { 
					 if(isset($_POST['btn_change_password']))
					 {
					   $this->form_validation->set_rules('password','Password','required');
					   if($this->form_validation->run())
					   {
							$Password=$this->input->post('password');  
							$update_password_array=array('password'=>$Password,'forgot_password_status'=>'1'); 	
							$update_pass=$this->master_model->updateRecord('tbl_login_master',$update_password_array,array('login_id'=>'"'.$loginid.'"'));
							if($update_pass)
							{ 
								//$data['success']='Password Change successfully.';
								$this->session->set_flashdata('success','Your password has been changed please login to confirm.');
								redirect(base_url().'login');
							}
							else
							{
								$data['error']='Password already changed. Please cheack thru Login';
							}
					   }
					 }
				}
			 else
			 {
					$data['already']='Password already change.';
			  }	 
			 $data['middle_content']='change_password';  
			 $this->load->view('templete',$data); 
			 }
			 else
			 {
				redirect(base_url().'login'); 
			 }
   }
   function array_values_recursive($ary)  
   {
		$lst = array();
		foreach( array_keys($ary) as $k ) {
		$v = $ary[$k];
		if(is_scalar($v)) 
		{
		   $lst[] = $v;
		}elseif(is_array($v)) {
		  $lst = array_merge($lst,array_values_recursive($v));
		  }
		}
		return $lst;
	}
   public function faq()
   {
	  $data['page_title']='FAQ';
	  $data['middle_content']='faq';
	  $this->load->view('templete',$data);
	}
   public function termscondition()
   {
	  /*$data['page_title']='Terms-Condition';
	  $data['middle_content']='terms-condition';
	  $this->load->view('templete',$data);*/
	  $data['pagedetail']=$this->master_model->getRecords('tbl_front_page',array('page_slug'=>'term-and-condition'));
	  if(count($data['pagedetail'])>0)
	  {
		 $data['page_title']='Terms Condition';
	  	 $data['middle_content']='terms-condition';
	  	 $this->load->view('templete',$data);
	  }
	  else
	  {
		 redirect(base_url());
	  }
	}
   public function signout()
   {
	  $this->config->load('facebook');
      $facebook = new Facebook(array('appId'=>$this->config->item('appID'),'secret'=>$this->config->item('appSecret'),));
      $userdata=array('email_id'=>$this->session->userdata('email_id'),'login_id'=>$this->session->userdata('login_id'),'user_slug'=>$this->session->userdata('user_slug'));
      $this->session->unset_userdata($userdata);
	  if(isset($_SESSION['logoutUrl']))
	  {
		  $facebook->destroySession();
		  redirect($_SESSION['logoutUrl']);
	  }
	  session_destroy();
	  redirect(base_url());
   }
   
   ##########JQUERY PAGINATION##############
  public function pagination_code($coupon_id) 
  {
   	$page_number = $this->uri->segment(4);
    $page_url = $config['base_url'] = base_url().'home/other_comments/'.$coupon_id.'/';
    $config['uri_segment'] = 4;        
    $config['per_page'] = 5;
    $config['num_links'] = 2;
    if(empty($page_number)) $page_number = 1;
    $offset = ($page_number-1) * $config['per_page'];
    $config['use_page_numbers'] = TRUE;        
    $data["commentData"] = $this->master_model->jQuerypagination_countriesdata($coupon_id,$config['per_page'],$offset);  
    $config['total_rows'] = $this->master_model->getRecordCount('tbl_coupon_comments',array('couponid'=>$coupon_id));        
    $page_url = $page_url.'/'.$page_number;
    $config['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';
    $config['full_tag_close'] = '</ul>';
    $config['prev_link'] = '&lt;';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '&gt;';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="current"><a href="'.$page_url.'">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['first_link'] = '&lt;&lt;';
    $config['last_link'] = '&gt;&gt;';        
    $this->pagination->cur_page = $offset;
    $this->pagination->initialize($config);
    $data['page_links'] = $this->pagination->create_links();
    return $data;        }
  public function other_comments($page_num=1) 
  {            
    $data = $this->pagination_code($this->uri->segment(3));            
    $this->load->view('other_comments',$data);
  }
 
   public function jQueryPagination($page_num=1) 
   {            
    $data =$this->pagination_code();
    $this->load->view('share_coupon',$data);}
  ##########JQUERY PAGINATION##############
   public function post_new_comment()
   {
	   $senderid 		= $this->input->post('senderid');
	   $couponid		= $this->input->post('couponid');
	   $comments	 	= $this->input->post('comments');
	   $commentDiv      = $moreLoaderDiv = $status = $commentDiv790px = '';
	   $commentCnt      = 0;
	   if($senderid!='' && $couponid!='' && $comments!='')
	   {
		   /*check point limit of admin can set */
			$set_per_day_limit=$this->master_model->getRecords('tbl_points_master',array('points_id'=>'1'));
			$per_day_share=$this->master_model->getRecords('tbl_userscored_point',array('point_type'=>'fb_share','login_id'=>$this->session->userdata('login_id'),'SUBSTR(scored_date,1,10)'=>date('Y-m-d')),'SUM(share_point) as share_point');
			$per_day_like=$this->master_model->getRecords('tbl_userscored_point',array('point_type'=>'like','login_id'=>$this->session->userdata('login_id'),'SUBSTR(scored_date,1,10)'=>date('Y-m-d')),'SUM(like_point) as like_point');
			$per_day_comment=$this->master_model->getRecords('tbl_userscored_point',array('point_type'=>'comment','login_id'=>$this->session->userdata('login_id'),'SUBSTR(scored_date,1,10)'=>date('Y-m-d')),'SUM(comment_point) as comment_point');
			$total=$per_day_share[0]['share_point']+$per_day_like[0]['like_point']+$per_day_comment[0]['comment_point'];
			if($total<$set_per_day_limit[0]['per_day_point'])
			{
			   $dataArray=array('login_id'=>$senderid,'couponid'=>$couponid,'comments'=>$comments);
			   $instid=$this->master_model->insertRecord('tbl_coupon_comments',$dataArray,TRUE);
			   if($instid)
			   {
				 $login_id=$this->session->userdata('login_id');
				 $point_type='comment';
				 $coupon_id=$couponid;
				 $point_comment=$this->master_model->getRecords('tbl_points_master');
				 $comment_point=$point_comment[0]['coupon_commnet_point'];
				 $check_array=array('coupon_id'=>$coupon_id,'login_id'=>$login_id,'point_type'=>$point_type);
				 $userscored=$this->master_model->getRecords('tbl_userscored_point',$check_array); 
					if(count($userscored)==0)
					{
						   $UserscorArray=array('point_type'=>$point_type,'login_id'=>$login_id,'coupon_id'=>$coupon_id,'comment_point'=>$comment_point,'scored_date'=>date('Y-m-d H:i:s'));
						   $insert_id=$this->master_model->insertRecord('tbl_userscored_point',$UserscorArray,TRUE);
					}
					$this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_coupon_comments.login_id');
					$this->db->select('COUNT(cmnt_id) TOTAL_REC')->from('tbl_coupon_comments')->where('couponid',$couponid);    
					$_queryResult = $this->db->get();
					$_commentData = $_queryResult->result_array();
					
					$this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_coupon_comments.login_id');
					$this->db->select('*')->from('tbl_coupon_comments')->where('couponid',$couponid)->order_by('cmnt_id','DESC')->limit(5);    
					$queryResult = $this->db->get();
					$commentData = $queryResult->result_array();
					
					
					if(count($commentData) > 0) 
					{     
							foreach($commentData as $val) 
							{
									$id = $val['cmnt_id'];
									$couponid = $val['couponid'];
									if($val['user_type']=='seller')
									{
										$this->db->select('profilepic');
										$profileImg = $this->master_model->getRecords('tbl_seller_details',array('loginid'=>$val['login_id']));
										if(isset($profileImg[0]['profilepic']) && $profileImg[0]['profilepic']!='')
										{  $imagePath = 'uploads/profile_image/thumb/'.$profileImg[0]['profilepic'];  }
										else
										{$imagePath = 'images/profile-img.jpg'; }
									}
									else
									{
										$this->db->select('profile_picture');
										$profileImg = $this->master_model->getRecords('tbl_user_master',array('login_id'=>$val['login_id']));
										if(isset($profileImg[0]['profile_picture']) && $profileImg[0]['profile_picture']!='')
										{  $imagePath = 'uploads/profile_image/thumb/'.$profileImg[0]['profile_picture'];  }
										else
										{$imagePath = 'images/profile-img.jpg'; }
									}
							
									$commentDiv .= '<div class="comments-box"><div class="comments-box-left"><img src="'.base_url().$imagePath.'" width="36" height="36" alt="user"/></div><div class="comments-box-right" style="width:560px !important;"><div class="comments-arow"></div><div class="comments-outer"><div class="comments-desk">'.nl2br($val['comments']).'</div><div class="clr"></div><div class="comments-posted"><span><i class="fa fa-clock-o" style="font-size:14px;"></i> Posted on :</span>'.date('d-m-Y',strtotime($val['posted_date'])).'</div><div class="comments-title" style="float:right;"><span>by :</span> <a href="'.base_url().'community/member/'.$val['user_slug'].'/">'.$val['user_slug'].'</a></div></div></div><div class="clr"></div></div><div class="clr"></div>';
									
								 $commentDiv790px .= '<div class="comments-box"><div class="comments-box-left"><img src="'.base_url().$imagePath.'" width="36" height="36" alt="user"/></div><div class="comments-box-right"><div class="comments-arow"></div><div class="comments-outer"><div class="comments-desk">'.nl2br($val['comments']).'</div><div class="clr"></div><div class="comments-posted"><span><i class="fa fa-clock-o" style="font-size:14px;"></i> Posted on :</span>'.date('d-m-Y',strtotime($val['posted_date'])).'</div><div class="comments-title" style="float:right;"><span>by :</span> <a href="'.base_url().'community/member/'.$val['user_slug'].'/">'.$val['user_slug'].'</a></div></div></div><div class="clr"></div></div><div class="clr"></div>';
									
							}
							if($_commentData[0]['TOTAL_REC']>5)
							{
									$moreLoaderDiv =  '<div class="active-inner" style="text-align:center;"><div class="more_div"><a href="javascript:void(0);"><div id="load_more_'.$id.'" id="more_tab_'.$id.'"><div class="show_more_cmnt" id="'.$id.'|'.$couponid.'">Load More Content</div></div></a></div></div>';
							}
							$status='success';
							$commentCnt = $_commentData[0]['TOTAL_REC'];
					}
					else
					{ $status='Not found'; }
			   }
			   else
			   {$status='error';}
		   }
		    else
		    {$status='limit';}
	   }
	   else
	   {$status='error';}
	   
	   $jsonArray = array('status'=>$status,'commentDiv'=>$commentDiv,'moreLoaderDiv'=>$moreLoaderDiv,'commentCnt'=>$commentCnt,'commentDiv790px'=>$commentDiv790px);
	   echo json_encode($jsonArray);
   }
  public function post_comment()
   {
	   $senderid 		= $this->input->post('senderid');
	   $couponid		= $this->input->post('couponid');
	   $comments	 	= $this->input->post('comments');
	   $commentDiv = $moreLoaderDiv = $status = $commentDiv790px = '';
	   $commentCnt = 0;
	   if($senderid!='' && $couponid!='' && $comments!='')
	   {
		   /*check point limit of admin can set */
		    $set_per_day_limit=$this->master_model->getRecords('tbl_points_master',array('points_id'=>'1'));
	        $per_day_share=$this->master_model->getRecords('tbl_userscored_point',array('point_type'=>'fb_share','login_id'=>$this->session->userdata('login_id'),'SUBSTR(scored_date,1,10)'=>date('Y-m-d')),'SUM(share_point) as share_point');
	        $per_day_like=$this->master_model->getRecords('tbl_userscored_point',array('point_type'=>'like','login_id'=>$this->session->userdata('login_id'),'SUBSTR(scored_date,1,10)'=>date('Y-m-d')),'SUM(like_point) as like_point');
	        $per_day_comment=$this->master_model->getRecords('tbl_userscored_point',array('point_type'=>'comment','login_id'=>$this->session->userdata('login_id'),'SUBSTR(scored_date,1,10)'=>date('Y-m-d')),'SUM(comment_point) as comment_point');
	        $total=$per_day_share[0]['share_point']+$per_day_like[0]['like_point']+$per_day_comment[0]['comment_point'];
		    if($total<$set_per_day_limit[0]['per_day_point'])
			{
		   
				   $dataArray=array('login_id'=>$senderid,'couponid'=>$couponid,'comments'=>$comments);
				   $instid=$this->master_model->insertRecord('tbl_coupon_comments',$dataArray,TRUE);
				   if($instid)
				   {
					 $login_id=$this->session->userdata('login_id');
					 $point_type='comment';
					 $coupon_id=$couponid;
					 $point_comment=$this->master_model->getRecords('tbl_points_master');
					 $comment_point=$point_comment[0]['coupon_commnet_point'];
					 $check_array=array('coupon_id'=>$coupon_id,'login_id'=>$login_id,'point_type'=>$point_type);
					 $userscored=$this->master_model->getRecords('tbl_userscored_point',$check_array); 
					 if(count($userscored)==0)
					 {
					   $UserscorArray=array('point_type'=>$point_type,'login_id'=>$login_id,'coupon_id'=>$coupon_id,'comment_point'=>$comment_point,'scored_date'=>date('Y-m-d H:i:s'));
					   $insert_id=$this->master_model->insertRecord('tbl_userscored_point',$UserscorArray,TRUE);
					 }
						$this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_coupon_comments.login_id');
						$this->db->select('COUNT(cmnt_id) TOTAL_REC')->from('tbl_coupon_comments')->where('couponid',$couponid);    
						$_queryResult = $this->db->get();
						$_commentData = $_queryResult->result_array();
						
						$this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_coupon_comments.login_id');
						$this->db->select('*')->from('tbl_coupon_comments')->where('couponid',$couponid)->order_by('cmnt_id','DESC')->limit(5);    
						$queryResult = $this->db->get();
						$commentData = $queryResult->result_array();
						if(count($commentData) > 0) 
						{     
								foreach($commentData as $val) 
								{ 
										$id = $val['cmnt_id'];
										$couponid = $val['couponid'];
										if($val['user_type']=='seller')
										{
											$this->db->select('profilepic');
											$profileImg = $this->master_model->getRecords('tbl_seller_details',array('loginid'=>$val['login_id']));
											if(isset($profileImg[0]['profilepic']) && $profileImg[0]['profilepic']!='')
											{  $imagePath = 'uploads/profile_image/thumb/'.$profileImg[0]['profilepic'];  }
											else
											{$imagePath = 'images/profile-img.jpg'; }
										}
										else
										{
											$this->db->select('profile_picture');
											$profileImg = $this->master_model->getRecords('tbl_user_master',array('login_id'=>$val['login_id']));
											if(isset($profileImg[0]['profile_picture']) && $profileImg[0]['profile_picture']!='')
											{  $imagePath = 'uploads/profile_image/thumb/'.$profileImg[0]['profile_picture'];  }
											else
											{$imagePath = 'images/profile-img.jpg'; }
										}
								
										echo '<div class="comments-box">
										<div class="comments-box-left"><img src="'.base_url().$imagePath.'" width="36" height="36" alt="user"/></div>
										<div class="comments-box-right" style="width:560px !important;">
										<div class="comments-arow"></div>
										<div class="comments-outer">
										<div class="comments-desk">'.nl2br($val['comments']).'</div>
										<div class="clr"></div>
										<div class="comments-posted"><span><i class="fa fa-clock-o" style="font-size:14px;"></i> Posted on :</span>'.date('d-m-Y',strtotime($val['posted_date'])).'</div>
										<div class="comments-title" style="float:right;"><span>by :</span> <a href="'.base_url().'community/member/'.$val['user_slug'].'/">'.$val['user_slug'].'</a></div>
										</div>
										</div>
										<div class="clr"></div>
										</div>
										<div class="clr"></div>';
						}
							if($_commentData[0]['TOTAL_REC']>5)
							{
									echo '<div class="active-inner" style="text-align:center;"><div class="more_div">
									<a href="javascript:void(0);">
										<div id="load_more_'.$id.'" id="more_tab_'.$id.'">
												<div class="show_more_cmnt" id="'.$id.'|'.$couponid.'">Load More Content</div>
										</div>
									</a>
									</div></div>';
							}
						}
				   }
				   else
				   {echo 'error';}
			}
			else
			{
				echo 'limit';
			}
	   }
	   else
	   { echo 'error';}
   }
   public function more_content()
	{
		$getLastContentId=$_POST['getLastContentId'];
		$explid = explode('|',$getLastContentId);
		
		$this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_coupon_comments.login_id');
		$this->db->select('COUNT(cmnt_id) TOTAL_REC')->from('tbl_coupon_comments')->where('couponid',$explid[1]);    
		$_queryResult = $this->db->get();
		$_commentData = $_queryResult->result_array();
		
		$this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_coupon_comments.login_id');
		$this->db->select('*')->from('tbl_coupon_comments')->where('cmnt_id < "'.$explid[0].'" ',FALSE,FALSE)->order_by('cmnt_id','DESC')->where('couponid',$explid[1])->limit(5);    
		$queryResult = $this->db->get();
		$commentData = $queryResult->result_array();
	
		if(count($commentData) > 0) 
		{     
						foreach($commentData as $val) 
						{ 
								$id = $val['cmnt_id'];
								$couponid = $val['couponid'];
								if($val['user_type']=='seller')
								{
									$this->db->select('profilepic');
									$profileImg = $this->master_model->getRecords('tbl_seller_details',array('loginid'=>$val['login_id']));
									if(isset($profileImg[0]['profilepic']) && $profileImg[0]['profilepic']!='')
									{  $imagePath = 'uploads/profile_image/thumb/'.$profileImg[0]['profilepic'];  }
									else
									{$imagePath = 'images/profile-img.jpg'; }
								}
								else
								{
									$this->db->select('profile_picture');
									$profileImg = $this->master_model->getRecords('tbl_user_master',array('login_id'=>$val['login_id']));
									if(isset($profileImg[0]['profile_picture']) && $profileImg[0]['profile_picture']!='')
									{  $imagePath = 'uploads/profile_image/thumb/'.$profileImg[0]['profile_picture'];  }
									else
									{$imagePath = 'images/profile-img.jpg'; }
								}
						
								echo '<div class="comments-box">
								<div class="comments-box-left"><img src="'.base_url().$imagePath.'" width="36" height="36" alt="user"/></div>
								<div class="comments-box-right" style="width:560px !important;">
								<div class="comments-arow"></div>
								<div class="comments-outer">
								<div class="comments-desk">'.nl2br($val['comments']).'</div>
								<div class="clr"></div>
								<div class="comments-posted"><span><i class="fa fa-clock-o" style="font-size:14px;"></i> Posted on :</span>'.date('d-m-Y',strtotime($val['posted_date'])).'</div>
								<div class="comments-title" style="float:right;"><span>by :</span> <a href="'.base_url().'community/member/'.$val['user_slug'].'/">'.$val['user_slug'].'</a></div>
								</div>
								</div>
								<div class="clr"></div>
								</div>
								<div class="clr"></div>';
						}
						if($_commentData[0]['TOTAL_REC']>5)
						{
									echo '<div class="active-inner" style="text-align:center;"><div class="more_div">
									<a href="javascript:void(0);">
										<div id="load_more_'.$id.'" id="more_tab_'.$id.'">
												<div class="show_more_cmnt" id="'.$id.'|'.$couponid.'">Load More Content</div>
										</div>
									</a>
									</div></div>';
						}
				}
		else
		{
			echo '<div class="active-inner" style="text-align:center;"><div class="all_loaded">No More Content to Load</div></div>';
		}
		
		//echo $this->db->last_query();
		
	}
   ###COMMENT PAGINATION FOR SHOWCOUPON VIEW##
  public function pagination_code2($coupon_id) 
  {
   	$page_number = $this->uri->segment(6);
    $page_url = $config['base_url'] = base_url().'home/other_comments2/'.$coupon_id.'/';
    $config['uri_segment'] = 6;        
            
    $config['per_page'] = 5;
    $config['num_links'] = 2;
    if(empty($page_number)) $page_number = 1;
    $offset = ($page_number-1) * $config['per_page'];
    
    $config['use_page_numbers'] = TRUE; 
    $data["commentData"] = $this->master_model->jQuerypagination_countriesdata($coupon_id,$config['per_page'],$offset);  
    $config['total_rows'] = $this->master_model->getRecordCount('tbl_coupon_comments',array('couponid'=>$coupon_id));        
    
    $page_url = $page_url.'/'.$page_number;
    
    $config['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';
    $config['full_tag_close'] = '</ul>';
    $config['prev_link'] = '&lt;';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '&gt;';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="current"><a href="'.$page_url.'">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
 
    $config['first_link'] = '&lt;&lt;';
    $config['last_link'] = '&gt;&gt;';        
    
    $this->pagination->cur_page = $offset;
            
    $this->pagination->initialize($config);
    $data['page_links'] = $this->pagination->create_links();
    
    return $data;        } 
  public function other_comments2($page_num=1) 
  {            
    $data = $this->pagination_code($this->uri->segment(4));            
    $this->load->view('other_comments',$data);}
  ####COMMENT PAGINATION FOR SHOWCOUPON VIEW## 
  public function member()
  {
		$data['page_title']='Member Profile';
		$memberSlug		= 	$this->uri->segment(2);
		$searchType		= 	$this->uri->segment(3);
		##################################
		$this->db->join('tbl_seller_details','tbl_seller_details.loginid=tbl_login_master.login_id');
		$data['seldetail']=$this->master_model->getRecords('tbl_login_master',array('tbl_login_master.user_slug'=>$memberSlug));
		 if(!count($data['seldetail']))
		 {
			 $this->db->join('tbl_user_master','tbl_user_master.login_id=tbl_login_master.login_id');
			 $data['seldetail']=$this->master_model->getRecords('tbl_login_master',array('tbl_login_master.user_slug'=>$memberSlug));
		 }
		//$this->db->join('select');
		/*if($data['seldetail'][0]['user_type'] == 'seller')
		{}*/
		
			if($data['seldetail'][0]['user_type'] == 'seller' )
			{
				if($searchType	== '' || $searchType	=='submitted_coupon')
				{
					//echo '****'.$data['seldetail'][0]['user_type'];
					$data['myClass_a']='class="current"';
					$data['myClass_b']='';
					$data['myClass_c']='';
					$data['myClass_d']='';
					$data['subTitle'] = 'Coupon\'s added by- ';
					if($searchType	== '')
					{$onPage = $this->uri->segment(3);}
					else
					{$onPage = $this->uri->segment(4);}
					
					$numOfCoupon	=	$this->master_model->getRecordCount('tbl_coupon_master',array('tbl_coupon_master.login_id'=>$data['seldetail'][0]['login_id'],'tbl_coupon_master.coupon_status'=>'1'));
					 $page_url =  base_url().'member/'.$memberSlug.'/submitted_coupon/';
					 $_output = $this->commonPagiantion($onPage,$page_url,$numOfCoupon);
					 $data['page_links']=$_output['page_links'];
					 $this->db->order_by('tbl_coupon_master.coupon_id','DESC');
					 $data['fetchRecords']=$this->master_model->getRecords('tbl_coupon_master',array('tbl_coupon_master.login_id'=>$data['seldetail'][0]['login_id'],'tbl_coupon_master.coupon_status'=>'1'),'','',$_output['offset'],$_output['per_page']);
				}
			}
			else
			{
				if($searchType	==''  )
				{
					$data['myClass_a']='';
					$data['myClass_b']='class="current"';
					$data['myClass_c']='';
					$data['myClass_d']='';
					$data['subTitle'] = 'Coupon\'s shared by- ';
					$numOfShare=$this->master_model->getRecordCount('tbl_userscored_point',array('tbl_userscored_point.point_type'=>'fb_share','tbl_userscored_point.login_id'=>$data['seldetail'][0]['login_id']));
					$page_url =  base_url().'member/'.$memberSlug.'/shared_coupon/';
					$_output = $this->commonPagiantion($this->uri->segment(4),$page_url,$numOfShare);
					$data['page_links']=$_output['page_links'];
					$this->db->join('tbl_coupon_master','tbl_coupon_master.coupon_id=tbl_userscored_point.coupon_id','LEFT');
					$this->db->group_by('tbl_userscored_point.coupon_id');
					$data['fetchRecords']=$this->master_model->getRecords('tbl_userscored_point',array('tbl_userscored_point.point_type'=>'fb_share','tbl_userscored_point.login_id'=>$data['seldetail'][0]['login_id']),'','',$_output['offset'],$_output['per_page']);
				}
			}
		
		
		
		if($searchType	=='shared_coupon' )
		{
			$data['myClass_a']='';
			$data['myClass_b']='class="current"';
			$data['myClass_c']='';
			$data['myClass_d']='';
			$data['subTitle'] = 'Coupon\'s shared by- ';
			$numOfShare=$this->master_model->getRecordCount('tbl_userscored_point',array('tbl_userscored_point.point_type'=>'fb_share','tbl_userscored_point.login_id'=>$data['seldetail'][0]['login_id']));
	//echo		$this->db->last_query();
			$page_url =  base_url().'member/'.$memberSlug.'/shared_coupon/';
			$_output = $this->commonPagiantion($this->uri->segment(4),$page_url,$numOfShare);
			$data['page_links']=$_output['page_links'];
			$this->db->join('tbl_coupon_master','tbl_coupon_master.coupon_id=tbl_userscored_point.coupon_id','LEFT');
		    $this->db->group_by('tbl_userscored_point.coupon_id');
		    $data['fetchRecords']=$this->master_model->getRecords('tbl_userscored_point',array('tbl_userscored_point.point_type'=>'fb_share','tbl_userscored_point.login_id'=>$data['seldetail'][0]['login_id']),'','',$_output['offset'],$_output['per_page']);
			//echo '<br>'.$this->db->last_query();
			/*echo '<pre>';
			print_r($data['fetchRecords']);
			exit;*/
		}
		if($searchType	=='liked_coupon')
		{
			$data['myClass_a']='';
			$data['myClass_b']='';
			$data['myClass_c']='class="current"';
			$data['myClass_d']='';
			$data['subTitle'] = 'Coupon\'s liked by- ';
			$numOfLike=$this->master_model->getRecordCount('tbl_like_unlike_master',array('tbl_like_unlike_master.log_id'=>$data['seldetail'][0]['login_id'],'tbl_like_unlike_master.like_id'=>'1'));
			$page_url =  base_url().'member/'.$memberSlug.'/liked_coupon/';
			$_output = $this->commonPagiantion($this->uri->segment(4),$page_url,$numOfLike);
			$data['page_links']=$_output['page_links'];
			$this->db->join('tbl_coupon_master','tbl_coupon_master.coupon_id=tbl_like_unlike_master.coup_id');
			$this->db->group_by('tbl_like_unlike_master.coup_id');
			$data['fetchRecords']=$this->master_model->getRecords('tbl_like_unlike_master',array('tbl_like_unlike_master.like_id'=>1,'tbl_like_unlike_master.log_id'=>$data['seldetail'][0]['login_id']),'','',$_output['offset'],$_output['per_page']);
		}
		
		if($searchType	=='commented_coupon')
		{
			$data['myClass_a']='';
			$data['myClass_b']='';
			$data['myClass_c']='';
			$data['myClass_d']='class="current"';
			$data['subTitle'] = 'Coupon\'s commented by- ';
			$this->db->join('tbl_coupon_master','tbl_coupon_master.coupon_id=tbl_coupon_comments.couponid');
			$this->db->group_by('tbl_coupon_comments.couponid');
			$numOfCmnts=$this->master_model->getRecordCount('tbl_coupon_comments',array('tbl_coupon_comments.login_id'=>$data['seldetail'][0]['login_id']));
			$page_url =  base_url().'member/'.$memberSlug.'/commented_coupon/';
			$_output = $this->commonPagiantion($this->uri->segment(4),$page_url,$numOfCmnts);
			$data['page_links']=$_output['page_links'];
			$this->db->join('tbl_coupon_master','tbl_coupon_master.coupon_id=tbl_coupon_comments.couponid');
			$this->db->group_by('tbl_coupon_comments.couponid');
			$data['fetchRecords']=$this->master_model->getRecords('tbl_coupon_comments',array('tbl_coupon_comments.login_id'=>$data['seldetail'][0]['login_id']),'','',$_output['offset'],$_output['per_page']);
		}
		
		 
		 
		
		
		$data['category']=$this->master_model->getRecords('tbl_category_master',array('category_status'=>'1'));
		 
		 $data['middle_content']='public_profile';  
		 $this->load->view('templete',$data); }
  //Function   :offline functioonality
  public function offline()
  {
		$data=array('page_title'=>'Offline');
		$this->load->view('offline-view',$data);
	}		 
  public function global_search()
  {
	    $user_input = trim($_REQUEST['term']);
		$user_input = preg_replace('/\s+/', ' ', $user_input);
		$query = 'SELECT brand_title,brand_slug FROM tbl_brand_master WHERE default_status = "0" AND brand_status = "1" AND brand_title LIKE "%'.$user_input.'%" ORDER BY brand_title';
	    //$this->db->query($query);
		$_output = $this->db->query($query);
	   $dataRes = $_output->result_array();
	   
	 //  print_r($dataRes);
	   
	   $display_json = array();
		$json_arr = array();
		if(count($dataRes))
		{
			foreach($dataRes as $_ds)
			{
				$json_arr["id"] = base_url().'brand/'.$_ds['brand_slug']."/";
				$json_arr["value"] = $_ds['brand_title'];
				$json_arr["label"] = $_ds['brand_title'];
			}
		}
		else
		{
			$json_arr["id"] = "#";
		    $json_arr["value"] = "";
		    $json_arr["label"] = "No Result Found !";
		}
	  array_push($display_json, $json_arr);
	  $jsonWrite = json_encode($display_json); //encode that search data
		echo $jsonWrite;
   }
   /*All top Offer Display Start*/
   public function top_offer()
   {
		$data['page_title']='Top Offer';
	  /*pagingnation*/
	   $this->db->join('tbl_userscored_point','tbl_userscored_point.coupon_id=tbl_coupon_master.coupon_id');
	   $this->db->join('tbl_brand_master','tbl_brand_master.brand_id=tbl_coupon_master.coupon_brand_id');
	  $this->db->where('tbl_coupon_master.coupon_expirydate >=',date('Y-m-d'));
	  $this->db->order_by('tbl_userscored_point.scored_id','DESC');
	  $this->db->group_by('tbl_coupon_master.coupon_id');
	  $productcoupon=$this->master_model->getRecords('tbl_coupon_master',array('tbl_coupon_master.coupon_status'=>'1','tbl_userscored_point.point_type'=>'fb_share'));
	 //echo  $this->db->last_query();
	  $config['base_url']=base_url().'home/top_offer/';
	  $config['total_rows']=count($productcoupon);
	  $config['uri_segment']=3;
	  $page_link = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;  
	  $config['per_page'] = 10;
	  $config['num_links'] = 5;
	  if(empty($page_link)) $page_link = 1;
	  $page = ($page_link-1) * $config['per_page'];
	  $page_url = $config['base_url'].'/'.$page;
	  
	  $config['use_page_numbers'] = TRUE; 
	  $config['full_tag_open'] = '<ul>';
	  $config['full_tag_close'] = '</ul>';
	  $config['prev_link'] = '&lt;';
	  $config['prev_tag_open'] = '<li>';
	  $config['prev_tag_close'] = '</li>';
	  $config['next_link'] = '&gt;';
	  $config['next_tag_open'] = '<li>';
	  $config['next_tag_close'] = '</li>';
	  $config['cur_tag_open'] = '<li><a  href="'.$page_url.'" class="active">';
	  $config['cur_tag_close'] = '</a></li>';
	  $config['num_tag_open'] = '<li>';
	  $config['num_tag_close'] = '</li>';
	  $config['first_tag_open'] = '<li>';
	  $config['first_tag_close'] = '</li>';
	  $config['last_tag_open'] = '<li>';
	  $config['last_tag_close'] = '</li>';
	  $config['first_link'] = '&lt;&lt;';
	  $config['last_link'] = '&gt;&gt;'; 
	  $this->pagination->initialize($config); 
	  /*pagingnation*/
	  $this->db->join('tbl_userscored_point','tbl_userscored_point.coupon_id=tbl_coupon_master.coupon_id');
	  $this->db->join('tbl_brand_master','tbl_brand_master.brand_id=tbl_coupon_master.coupon_brand_id');
	  $this->db->where('tbl_coupon_master.coupon_expirydate >=',date('Y-m-d'));
	  $this->db->order_by('tbl_coupon_master.coupon_expirydate');
	  $this->db->group_by('tbl_coupon_master.coupon_id');
	  $data['product_coupon']=$this->master_model->getRecords('tbl_coupon_master',array('tbl_coupon_master.coupon_status'=>'1','tbl_userscored_point.point_type'=>'fb_share'),'','',$page,$config['per_page']);
	  $data['links']=$this->pagination->create_links();
	  $data['category']=$this->master_model->getRecords('tbl_category_master',array('category_status'=>'1'));
	  $data['middle_content']='top_offer';
	  $this->load->view('templete',$data);
	}
	/*All top Offer Display Start*/
	
	
	public function commonPagiantion($segmnetUri,$baseUrl,$totalRec)
	{
		$resp = array();
		$page_number = $segmnetUri;
		$page_url = $config['base_url'] = $baseUrl;
		$config['uri_segment'] = 4;        
				
		$config['per_page'] = 5;
		$resp['per_page'] = 5 ;
		$config['num_links'] = 3;
		if(empty($page_number)) $page_number = 1;
		$offset = ($page_number-1) * $config['per_page'];
		$resp['offset'] = $offset;
		 $config['use_page_numbers'] = TRUE; 
		$config['total_rows'] = $totalRec;        
		
		$page_url = $page_url.'/'.$page_number;
		
		$config['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';
		$config['full_tag_close'] = '</ul>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="current"><a href="'.$page_url.'">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
	 
		$config['first_link'] = '&lt;&lt;';
		$config['last_link'] = '&gt;&gt;';        
		
		$this->pagination->cur_page = $offset;
		
		$this->pagination->initialize($config);
		$config['page_links'] = $this->pagination->create_links();
		$resp['page_links'] 	= $config['page_links'] ;
		return $resp;
	}
}