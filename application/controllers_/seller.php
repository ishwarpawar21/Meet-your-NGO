<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Seller extends CI_Controller {
    public function __construct()
    {
	   parent::__construct();
	   $this->load->library('upload');
	   $this->load->library('aws_signed_request');
	   $this->load->library('simple_html_dom'); 
	    $this->load->library('pagination'); 
	}
	public function profile()
	{
	    //$seller_id = base64_decode($seller_id);
	    $seller_id = $this->session->userdata('login_id');
		if($this->session->userdata('user_type')=='user'){redirect(base_url().'seller/edit/');}
	    if($seller_id!='' && is_numeric($seller_id))
	    {
			if(isset($_POST['btnDelete']))
			{
			  $commentid 		= $this->input->post('commentId');
			  $this->master_model->deleteRecord('tbl_community_comments','id',$commentid);
			}
	   $data['page_title']='Profile';
		 
		  ####################################
		$loginid = $this->session->userdata('login_id');
		
		$this->db->join('tbl_seller_details','tbl_seller_details.loginid=tbl_login_master.login_id');
		$this->db->join('tbl_country_master','tbl_country_master.id=tbl_seller_details.countryid','LEFT');
		$data['seldetail']=$this->master_model->getRecords('tbl_login_master',array('tbl_login_master.login_id'=>$loginid));
		//$this->db->join('select');
		$numOfCoupon=$this->master_model->getRecordCount('tbl_coupon_master',array('tbl_coupon_master.login_id'=>$loginid,'tbl_coupon_master.coupon_status'=>'1'));
		$_output = $this->commonPagiantion($this->uri->segment(3),base_url().'seller/profile/',$numOfCoupon);
		$data['page_links']=$_output['page_links'];
		$this->db->order_by('tbl_coupon_master.coupon_id','DESC');
		$data['fetchCoupon']=$this->master_model->getRecords('tbl_coupon_master',array('tbl_coupon_master.login_id'=>$loginid,'tbl_coupon_master.coupon_status'=>'1'),'','',$_output['offset'],$_output['per_page']);
		####################################
		$data['category']=$this->master_model->getRecords('tbl_category_master',array('category_status'=>'1'));
		$this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_community_comments.sender_id');
		$this->db->order_by('id','DESC');
		$this->db->limit(10);
		$data['dataComments']=$this->master_model->getRecords('tbl_community_comments',array('isreply'=>'no','receiver_id'=>$this->session->userdata('login_id')));
		$data['middle_content']='seller_profile';
	 	$this->load->view('templete',$data);
		}
		else
		{
	      $this->load->view('admin/404');
		}
	}
	public function edit()
	{
		$login_id = $this->session->userdata('login_id');
		$selcnt=$this->master_model->getRecordCount('tbl_seller_details',array('tbl_seller_details.loginid'=>$login_id)); 
		if($login_id!='' && is_numeric($login_id) && $selcnt>0)
	    {
			$file_name="";
			if(isset($_POST['btn_update_seller']))
			{ 
			$this->form_validation->set_rules('firstname','Firstname','required|xss_clean');
			$this->form_validation->set_rules('lastname','Lastname','required|xss_clean');
			$this->form_validation->set_rules('gender','Gender','required|xss_clean');
			$this->form_validation->set_rules('DOB','DOB','required|xss_clean');
			$this->form_validation->set_rules('city','City','required|xss_clean');
			$this->form_validation->set_rules('state','State','required|xss_clean');
			$this->form_validation->set_rules('countryid','country','required|xss_clean');
			$this->form_validation->set_rules('zipcode','Zipcode','required|xss_clean');
			//$this->form_validation->set_rules('Website','Website','required|xss_clean|valid_url');
			$this->form_validation->set_rules('briefbio','Brief biodata','required|xss_clean');
				if($this->form_validation->run())
				{ 
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
					{
					  $file_name=$profilepicold;
					}
					$update_seller_array=array('firstname'=>$firstname,'lastname'=>$lastname,'gender'=>$gender,'DOB'=>date('Y-m-d',strtotime($DOB)),'city'=>$city,'state'=>$state,'zipcode'=>$zipcode,'countryid'=>$countryid,'Website'=>$Website,'briefbio'=>$briefbio,'profilepic'=>$file_name); 
					if($this->master_model->updateRecord('tbl_seller_details',$update_seller_array,array('loginid'=>$login_id)))
					{
						$this->session->set_flashdata('success','Profile updates Successfully.');
						redirect(base_url().'seller/edit');
					}
				}
			}
			
			$data['page_title']='Edit Profile';
			$this->db->join('tbl_country_master','tbl_country_master.id=tbl_seller_details.countryid');
			$this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_seller_details.loginid');
			$data['seldetail']=$this->master_model->getRecords('tbl_seller_details',array('tbl_seller_details.loginid'=>$login_id)); 
			$data['fetchcountry']=$this->master_model->getRecords('tbl_country_master');
			$data['middle_content']='edit_seller_profile';
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
	public function accountpreferences()
	{
	  $login_id = $this->session->userdata('login_id');	
	  if($login_id!='' && is_numeric($login_id)) 
  	  {
		  $this->db->select('profilepic');
	  	  $data['seldetail']=$this->master_model->getRecords('tbl_seller_details',array('tbl_seller_details.loginid'=>$login_id));
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
							redirect(base_url().'seller/accountpreferences');
						}
						else
						{
							$input_array=array('password'=>$new_pass);
							$this->master_model->updateRecord('tbl_login_master',$input_array,array('login_id'=>$login_id));
							$this->session->set_flashdata('success','Password Updated Successfully.');
							redirect(base_url().'seller/accountpreferences');
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
   public function submit()
	{
	  $data['page_title']='Submit Coupon';
	  $data['error_message']='';
	  $data['items']='';
	  $public_key = 'AKIAIPYFE3GBXMU7JGBA';
	  $private_key = 'lGcwpuxIitSKHYHZmgi40u4EBHTiSLX2Ia3MLe7d';
	  $associate_tag = 'wwtamazon-20';
	  $data['reviews'] ='';
	  if(isset($_POST['btn_check']))
	  {
		  $this->form_validation->set_rules('store','ASIN','required');
		  if($this->form_validation->run())
		  {
			  $store=$this->input->post('store');
			  $ASIN = $store;//'B00LV7XXGY';	
			  $pxml = $this->aws_signed_request->aws_signed_request1("com", array("Operation"=>"ItemLookup","ItemId"=>"$ASIN","ResponseGroup"=>"ItemAttributes,Offers,Images,Reviews, PromotionSummary","IdType"=>"ASIN","MerchantId"=>"Amazon","AssociateTag"=>"wwtamazon-20"), $public_key, $private_key);
			  $result =$pxml;
			  $flat = call_user_func_array('array_merge', $result);
			  if(count(@$flat['Items']['Request']['Errors']['Error']['Message'])!='0')
			  {
				$data['error_message']=$flat['Items']['Request']['Errors']['Error']['Message'];
			  }
			  else
			  {
				 $data['items']  =$flat;
				 if($flat['Items']['Item']['CustomerReviews']['HasReviews']!='false')
				 {
					 $html           = file_get_html($flat['Items']['Item']['CustomerReviews']['IFrameURL']);
					 $data['reviews']= $html->find('div.crIFrameNumCustReviews', 0)->plaintext.':-'.$html->find('div.crIFrameNumCustReviews img', 0)->src;
				 }
			  }
		  }
     }
	 if(isset($_POST['btn_coupon']))
	 {
		$store=$this->input->post('store'); 
		$this->form_validation->set_rules('store','Asin No','required|is_unique[tbl_coupon_master.product_asin_no]'); 
		$this->form_validation->set_rules('coupon_code','coupon code','required|is_unique[tbl_coupon_master.coupon_code]');
		$this->form_validation->set_rules('coupon_discount','Coupon Discount','required');
		$this->form_validation->set_rules('cate_id','Category','required');
		$this->form_validation->set_rules('brand_id','brand id','required');
		$this->form_validation->set_rules('exp_date','expiry date','required');
		$ASIN = $store;//'B00LV7XXGY';	
		$pxml = $this->aws_signed_request->aws_signed_request1("com", array("Operation"=>"ItemLookup","ItemId"=>"$ASIN","ResponseGroup"=>"ItemAttributes,Offers,Images,Reviews, PromotionSummary","IdType"=>"ASIN","MerchantId"=>"Amazon","AssociateTag"=>"wwtamazon-20"), $public_key, $private_key);
		$result =$pxml;
		$flat = call_user_func_array('array_merge', $result);
		if(count(@$flat['Items']['Request']['Errors']['Error']['Message'])!='0')
		{
		  $data['error_message']=$flat['Items']['Request']['Errors']['Error']['Message'];
		}
		else
		{
		  if($this->form_validation->run())
		  {
			$data['items']  =$flat;
			if($flat['Items']['Item']['CustomerReviews']['HasReviews']!='false')
			{
				 $html                  = file_get_html($flat['Items']['Item']['CustomerReviews']['IFrameURL']);
				 $string                = $html->find('div.crIFrameNumCustReviews', 0)->plaintext;
				 $user                  = preg_replace("/[^0-9]/","",$string);
				 $product_reviews_digit = $user;
	        }
			else
			{
				 $product_reviews_digit='0';
			}
			$coupon_code    = $this->input->post('coupon_code');
			$coupon_discount_input= $this->input->post('coupon_discount');
			$cate_id        = $this->input->post('cate_id');
			$brand_id       = $this->input->post('brand_id');
			$exp_date       =$this->input->post('exp_date');
			$coupon_expirydate=date('Y-m-d',strtotime($exp_date));   
			$coupon_image   = $this->input->post('coupon_image');
			$coupon_title   = $this->input->post('coupon_title');
			$product_price  = $this->input->post('product_price');
			$product_manufacturer =$this->input->post('product_manufacturer');
			$product_group  = $this->input->post('product_group');
			$coupon_desc    = $this->input->post('coupon_desc');
			$amount_type    =$this->input->post('amount_type');
			$product_reviews =$this->input->post('product_reviews');
			$product_details_url =$this->input->post('product_details_url');
			$coupon_insertdate=date('Y-m-d');
			if($amount_type=='price')
			{
			  $coupon_discount =$coupon_discount_input;
			}
			else
			{
			  $coupon_discount = $coupon_discount_input.'%';
			}
			$order_by_price=preg_replace("/[^0-9.]/","",$product_price);
			/*insert array*/
		    $insertarray=array('login_id'=>$this->session->userdata('login_id'),'product_asin_no'=>$store,'product_price'=>$product_price,'order_by_price'=>$order_by_price,'product_manufacturer'=>$product_manufacturer,'coupon_cat_id'=>$cate_id,'coupon_brand_id'=>$brand_id,'coupon_title'=>$coupon_title,'coupon_image'=>$coupon_image,'coupon_desc'=>$coupon_desc,'coupon_code'=>$coupon_code,'coupon_expirydate'=>$coupon_expirydate,'coupon_insertdate'=>$coupon_insertdate,'coupon_discount'=>$coupon_discount,'coupon_status'=>'0','product_reviews'=>$product_reviews,'product_details_url'=>$product_details_url,'product_reviews_digit'=>$product_reviews_digit);	
		   if($this->master_model->insertRecord('tbl_coupon_master',$insertarray))
		   {
			 $this->session->set_flashdata('success','Coupon added successfull.');
			 redirect(base_url().'seller/submit/');
		   }
		   else
		   {
			 $this->session->set_flashdata('error','Error while adding coupon.');
			 redirect(base_url().'seller/submit/');  
		   }
		  }
		}
	 }
	 $data['middle_content']='submit_coupon';
	 $this->load->view('templete',$data);
	}
	public function sellerbrand()
	{
	   $data['page_title']='Brand';
	   $login_id=$this->session->userdata('login_id');
	   $data['category']=$this->master_model->getRecords('tbl_category_master',array('category_status'=>'1'));
	   $fetch_manage_brand=$this->master_model->getRecords('tbl_brand_master',array('login_id'=>$login_id));
	   $config['base_url']=base_url().'seller/sellerbrand/';
	   $config['total_rows']=count($fetch_manage_brand);
	   $config['per_page'] =20;
	   $config['uri_segment']=3;
	   $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	   $this->pagination->initialize($config); 
	   $this->db->order_by('tbl_brand_master.brand_id','DESC');
	   $data['fetch_manage_brand']=$this->master_model->getRecords('tbl_brand_master',array('login_id'=>$login_id),'','',$page, $config['per_page']);
	  // echo count($data['fetch_manage_brand']);
	   $data['links']=$this->pagination->create_links();
	   $data['middle_content']='seller-brand';
	   $this->load->view('templete',$data); 
	 }
	public function deletebrand($brand_id='',$brand_image='')
	{  
	$brand_id=base64_decode($brand_id);
	$brand_image=base64_decode($brand_image);
	  /*$this->db->join('tbl_coupon_master', 'tbl_coupon_master.coupon_brand_id = tbl_brand_master.tbl_brand_master','left');*/
	   $sql='Delete tbl_brand_master.*,tbl_coupon_master.* FROM (`tbl_brand_master`) LEFT JOIN `tbl_coupon_master` ON `tbl_coupon_master`.`coupon_brand_id` = `tbl_brand_master`.`brand_id` WHERE tbl_brand_master.brand_id="'.$brand_id.'"';
	   $data= $this->db->query($sql);
		if($data)
		{
			@unlink('uploads/brand/'.$brand_image);
			@unlink('uploads/brand/thumb/'.$brand_image);
			$this->session->set_flashdata('success','Record deleted successfully.');
		   	redirect(base_url().'seller/sellerbrand/');
		}
		else
		{
			$this->session->set_flashdata('error','Error while deleting record.'); 
		   	redirect(base_url().'seller/sellerbrand/');
		}
	}
	public function addbrand()
	{
	   //$brand_id_decode=base64_decode($brand_id);
	   $data['page_title']='Add Brand';
	   $data['error_brand']='';
	   if(isset($_POST['btn_add_brand']))
	   { 
		   $this->form_validation->set_rules('brand_title','Title','required');
		   $this->form_validation->set_rules('brand_desc','Description','required|xss_clean');
			if($this->form_validation->run())
			{
			 $brand_title=$this->input->post('brand_title',true);
			 $brand_desc=$this->input->post('brand_desc');
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
						$dt=$this->upload->data();
						$file=$dt['file_name'];
						$this->master_model->createThumb($file,'uploads/brand/',161,87,TRUE);
					  }
					 else
					 {
						   $this->upload->display_errors();
					   }
				   }
			  }
					  $b_array=array('brand_title'=>stripslashes($brand_title));
					  //$this->db->where('brand_id <>',base64_decode($brand_id)); 
					  $num_row=$this->master_model->getRecords('tbl_brand_master',$b_array);
									if(count($num_row)==0)
									{
									  $brand_slug=$this->master_model->create_slug($brand_title,'tbl_brand_master','brand_slug'); 
									  $brand_array=array('login_id'=>$this->session->userdata('login_id'),'brand_title'=>addslashes($brand_title),'brand_image'=>$file,'brand_slug'=>$brand_slug,'brand_desc'=>addslashes($brand_desc));
												   if($this->master_model->insertRecord('tbl_brand_master',$brand_array))
												   {
													 $this->session->set_flashdata('success',"Brand added successfully.");	
													 redirect(base_url().'seller/sellerbrand/');
												   }
									}
								else
								   {
									  $data['error_brand']='Brand name must contain unique.'; 
									  //redirect(base_url().'seller/addbrand/');
								   }
		}
		}
		$data['category']=$this->master_model->getRecords('tbl_category_master',array('category_status'=>'1'));
		$data['middle_content']='add-brand';
		$this->load->view('templete',$data); 
   }
	public function updatebrand($brand_id='')
	{
		$brand_id_decode=base64_decode($brand_id);
	   $data['page_title']='Update Brand';
	   $data['upload_error']='';
	   if($brand_id!='' && is_numeric($brand_id_decode))
	   {
		   if(isset($_POST['btn_update_brand']))
		{ 
		   $this->form_validation->set_rules('brand_title','Title','required');
		   $this->form_validation->set_rules('brand_desc','Description','required|xss_clean');
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
											 redirect(base_url().'seller/updatebrand/'.$brand_id.'');
										  }
										}
									 else
									   {
										  $this->session->set_flashdata('error','Brand name must contain unique.'); 
										  redirect(base_url().'seller/updatebrand/'.$brand_id.'');
									   }
					}
				else
				{
						   $data['upload_error']='The file type you are attempting to upload is not allowed.';
						}
		}
		}
			$data['fetch_brand']=$this->master_model->getRecords('tbl_brand_master',array('tbl_brand_master.brand_id'=>$brand_id_decode));
			$data['category']=$this->master_model->getRecords('tbl_category_master',array('category_status'=>'1'));
			$data['middle_content']='update-brand';
	        $this->load->view('templete',$data); 
		}                                
	else
	{
			$this->load->view('oops');
		}
   }
    public function updatecoupon($coupon_id='')
	{
	   $login_id = $this->session->userdata('login_id');
	  $coupon_id=base64_decode($coupon_id);
	   $data['page_title']='Update Coupon';
	   $data['upload_error']=$data['error']='';
	   $row=$this->master_model->getRecordCount('tbl_coupon_master',array('coupon_id'=>$coupon_id,'login_id'=>$login_id));
	   if($coupon_id!='' && is_numeric($coupon_id) && $login_id!='' && $row>0)
	   {
	   if(isset($_POST['btn_update_coupon']))
	   {
		$this->form_validation->set_rules('product_price','Product price','required'); 
		$this->form_validation->set_rules('coupon_title','Coupon Title','required'); 
		$this->form_validation->set_rules('coupon_desc','Coupon Description','required'); 
		$this->form_validation->set_rules('coupon_code','Coupon code','required');
		$this->form_validation->set_rules('amount_type','Coupon type','required');
		$this->form_validation->set_rules('coupon_discount','Coupon Discount','required');
		$this->form_validation->set_rules('cate_id','Category','required');
		$this->form_validation->set_rules('brand_id','brand id','required');
		$this->form_validation->set_rules('exp_date','expiry date','required');
		 if($this->form_validation->run())
		  {
			$product_price    = $this->input->post('product_price');
			$coupon_title    = $this->input->post('coupon_title');
			$coupon_desc    = $this->input->post('coupon_desc');
			$coupon_code    = $this->input->post('coupon_code');
			$amount_type    = $this->input->post('amount_type');
			$coupon_discount_input= $this->input->post('coupon_discount');
			$cate_id        = $this->input->post('cate_id');
			$brand_id       = $this->input->post('brand_id');
			$exp_date       =$this->input->post('exp_date');
			$coupon_expirydate=date('Y-m-d',strtotime($exp_date));   
			if($amount_type=='price')
			{
			  $coupon_discount =$coupon_discount_input;
			}
			else
			{
			  $coupon_discount = $coupon_discount_input.'%';
			 }
			 $chk=array('coupon_code'=>$coupon_code,'coupon_id !='=>$coupon_id);
			 $result=$this->db->get_where("tbl_coupon_master",$chk);
			 if($result->num_rows()>0)
			 {
				$data['error']="Coupon code already exits";
			 }
			else
			 {
			/*update array*/
		    $updatearray=array('product_price'=>$product_price,'coupon_title'=>addslashes($coupon_title),'coupon_desc'=>addslashes($coupon_desc),'coupon_code'=>$coupon_code,'coupon_discount'=>$coupon_discount,'coupon_cat_id'=>$cate_id,'coupon_brand_id'=>$brand_id,'coupon_expirydate'=>$coupon_expirydate);	
		   if($this->master_model->updateRecord('tbl_coupon_master',$updatearray,array('coupon_id'=>$coupon_id,'login_id'=>$login_id)))
		   {
			 $this->session->set_flashdata('success','Coupon Updated successfull.');
			 redirect(base_url().'seller/updatecoupon/'.base64_encode($coupon_id));
		   }
		   else
		   {
			 $this->session->set_flashdata('error','Error while Updating coupon.');
			 redirect(base_url().'seller/updatecoupon/'.base64_encode($coupon_id));  
		   }
			}
		  }
		}
		$data['fetch_coupon']=$this->master_model->getRecords('tbl_coupon_master',array('tbl_coupon_master.coupon_id'=>$coupon_id,'tbl_coupon_master.login_id'=>$login_id));
		$data['category']=$this->master_model->getRecords('tbl_category_master',array('category_status'=>'1'));
		$data['middle_content']='update_coupon';
		$this->load->view('templete',$data); 
		}                                
		else
		{
			$this->load->view('oops');
		}
   }
    //Manage favourite Coupon Of Seller Start
	public function favourite_coupon()
	{
	   $this->load->library('pagination');
	   $data['page_title']='Manage Favourite Coupon';
	   $login_id=$this->session->userdata('login_id');
	   if($login_id!='')
	   {
	  /*pagingnation*/
	  $this->db->select('profilepic');
	  $data['seldetail']=$this->master_model->getRecords('tbl_seller_details',array('tbl_seller_details.loginid'=>$login_id));
	  
	  $this->db->join('tbl_coupon_master','tbl_coupon_master.coupon_id=tbl_save_master.couponid');
	  $recCount=$this->master_model->getRecordCount('tbl_save_master',array('tbl_save_master.coupon_login_id'=>$login_id,'tbl_coupon_master.coupon_status'=>'1'));
	  
		$_output = $this->commonPagiantion($this->uri->segment(3),base_url().'seller/favourite_coupon/',$recCount);
		$data['links']=$_output['page_links'];

	  
	  $this->db->join('tbl_coupon_master','tbl_coupon_master.coupon_id=tbl_save_master.couponid');
	  $this->db->ORDER_BY('tbl_save_master.coupon_save_id','DESC');
	  $data['fetch_manage_coupon']=$this->master_model->getRecords('tbl_save_master',array('tbl_save_master.coupon_login_id'=>$login_id,'tbl_coupon_master.coupon_status'=>'1'),'','',$_output['offset'],$_output['per_page']);
	
	
	  $data['category']=$this->master_model->getRecords('tbl_category_master',array('category_status'=>'1'));
	  $data['middle_content']='manage-favourite-coupon';
	  $this->load->view('templete',$data); 
	  }
	  else
	  {
		  redirect(base_url());
	  }
	 }
	//Manage favourite Coupon Of Seller End
	//Manage favourite Coupon  Delete from Seller Start
	public function coupon_delete($page,$coupon_save_id='')
	{
		$coupon_save_id=base64_decode($coupon_save_id);
		if($this->master_model->deleteRecord('tbl_save_master','coupon_save_id',$coupon_save_id))
		{
			$this->session->set_flashdata('success','Coupon deleted successfully.');
		   	redirect(base_url().'seller/favourite_coupon/'.$page);
		}
		else
		{
			$this->session->set_flashdata('error','Error while deleting Coupon.'); 
		   	redirect(base_url().'seller/favourite_coupon/'.$page);
		}
	}
	//Manage favourite Coupon Delete from Seller End
	//Manage Save Coupon Of Seller Start
	public function save_coupon()
	{
	   $this->load->library('pagination');
	   $data['page_title']='Manage Save Coupon';
	   $login_id=$this->session->userdata('login_id');
	   if($login_id!='')
	   {
	  /*pagingnation*/
	  $data['fetch_count_save_coupon']=$this->master_model->getRecords('tbl_coupon_master',array('tbl_coupon_master.login_id'=>$login_id,'tbl_coupon_master.coupon_status'=>'1'));
	  $config['base_url']=base_url().'seller/save_coupon/';
	  $config['total_rows']=count($data['fetch_count_save_coupon']);
	  $config['per_page'] =10;
	  $config['uri_segment']=3;
	  $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
      $this->pagination->initialize($config); 
	  /*pagingnation*/ 
		   
	   $this->db->ORDER_BY('tbl_coupon_master.coupon_id','DESC');
	   $data['fetch_manage_save_coupon']=$this->master_model->getRecords('tbl_coupon_master',array('tbl_coupon_master.login_id'=>$login_id,'tbl_coupon_master.coupon_status'=>'1'),'','',$page,$config['per_page']);
	   $data['links']=$this->pagination->create_links();
	   $data['category']=$this->master_model->getRecords('tbl_category_master',array('category_status'=>'1'));
	   $data['middle_content']='manage-save-coupon';
	   $this->load->view('templete',$data); 
	   }
	   else
	   {
		   redirect(base_url());
		}
	 }
	//Manage Save Coupon Of Seller End
	//Manage Save Coupon  Delete from Seller Start
	public function savecoupon_delete($page,$coupon_id='')
	{
		$coupon_id=base64_decode($coupon_id);
		if($this->master_model->deleteRecord('tbl_coupon_master','coupon_id',$coupon_id))
		{
			$this->master_model->deleteRecord('tbl_like_unlike_master','coup_id',$coupon_id);
			$this->master_model->deleteRecord('tbl_save_master','couponid',$coupon_id);
			$this->master_model->deleteRecord('tbl_coupon_comments','couponid',$coupon_id);
			$this->session->set_flashdata('success','Coupon deleted successfully.');
		   	redirect(base_url().'seller/save_coupon/'.$page);
		}
		else
		{
			$this->session->set_flashdata('error','Error while deleting Coupon.'); 
		   	redirect(base_url().'seller/save_coupon/'.$page);
		}
	}
	//Manage Save Coupon Delete from Seller End
	public function commonPagiantion($segmnetUri,$baseUrl,$totalRec)
	{
		$resp = array();
		$page_number = $segmnetUri;
		$page_url = $config['base_url'] = $baseUrl;
		$config['uri_segment'] =  3;        
				
		$config['per_page'] = 5;
		$resp['per_page'] = 5;
		$config['num_links'] = 3;
		if(empty($page_number)) 
		$page_number = 1;
		$offset = ($page_number-1) * $config['per_page'];
		$resp['offset'] = $offset;
		 $config['use_page_numbers'] = TRUE; 
		$config['total_rows'] = $totalRec;        
		
		$page_url = $page_url.'/'.$page_number;
		
		$config['full_tag_open'] = '<ul class="_tsc_pagination tsc_paginationA tsc_paginationA01">';
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