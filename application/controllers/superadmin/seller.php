<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Seller extends CI_Controller {
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
	  Function   :  Manage Seller 
	  Developer  : Yogesh
	  Description: Admin can Manage Seller from here.    
	*/
	public function manageseller()
	{
	  $data['success']=$data['error']='';
	  $data['pagetitle']='Manage Seller';
	  $this->db->join('tbl_country_master','tbl_country_master.id=tbl_seller_details.countryid','left');
	  $this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_seller_details.loginid');
	  $this->db->order_by('tbl_seller_details.seller_id','DESC');
      $data['fetch_seller']=$this->master_model->getRecords('tbl_seller_details','','');
	  $data['middle_content']='manage-seller';
	  $this->load->view('admin/common-file',$data);
 	}
	/*
	  Function   :  Edit Seller Info 
	  Developer  : Yogesh
	  Description: Admin Edit Seller Info start from here.    
	*/
	public function updateseller($seller_id='')
	{
		$seller_id = base64_decode($seller_id);
		$data['success']=$data['error']='';
		$data['pagetitle']='Update Seller';
		$file_name="";
		if(isset($_POST['btn_update_seller']))
		{ 
			$this->form_validation->set_rules('username','','required|xss_clean');
			$this->form_validation->set_rules('firstname','','required|xss_clean');
			$this->form_validation->set_rules('lastname','','required|xss_clean');
			$this->form_validation->set_rules('gender','','required|xss_clean');
			$this->form_validation->set_rules('DOB','','required|xss_clean');
			$this->form_validation->set_rules('city','','required|xss_clean');
			$this->form_validation->set_rules('state','','required|xss_clean');
			$this->form_validation->set_rules('countryid','','required|xss_clean');
			$this->form_validation->set_rules('zipcode','','required|xss_clean');
			//$this->form_validation->set_rules('Website','','required|xss_clean');
			$this->form_validation->set_rules('briefbio','','required|xss_clean');
			$this->form_validation->set_rules('seller_email_id','','required|xss_clean');
			$this->form_validation->set_rules('password','','required|xss_clean');
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
				$email_id=$this->input->post('seller_email_id',true);
				$password=$this->input->post('password',true);
				$profilepicold=$this->input->post('profilepicold',true);
				$loginid=$this->input->post('loginid',true);
				
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
				 $update_login_array=array('email_id'=>$email_id,'password'=>$password); 	
				$this->master_model->updateRecord('tbl_login_master',$update_login_array,array('login_id'=>$loginid));
				if($this->master_model->updateRecord('tbl_seller_details',$update_seller_array,array('seller_id'=>$seller_id)))
				{
					$this->session->set_flashdata('success','Recored updates Successfully.');
					redirect(base_url().'superadmin/seller/manageseller/');
				}
			}
			else
			{
				$this->session->set_flashdata('error','Error while updating record');
				redirect(base_url().'superadmin/seller/updateseller/'.base64_encode($seller_id).'');
			}
		}
	    $this->db->join('tbl_country_master','tbl_country_master.id=tbl_seller_details.countryid','left');
	    $this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_seller_details.loginid');
	    $selinfo=$this->master_model->getRecords('tbl_seller_details',array('tbl_seller_details.seller_id'=>$seller_id));
		$fetchcountry=$this->master_model->getRecords('tbl_country_master');
	   	$data=array('pagetitle'=>'Update Seller','middle_content'=>'edit-seller','selinfo'=>$selinfo,'fetchcountry'=>$fetchcountry);
	    $this->load->view('admin/common-file',$data);
	}
	/*
	  Function   :  Seller Detail 
	  Developer  : Yogesh
	  Description: Admin Seller Detail start from here.    
	*/
	 public function detail($seller_id='')
	{
		$seller_id = base64_decode($seller_id);
		if($seller_id!='' && is_numeric($seller_id))
		{
			$this->db->join('tbl_country_master','tbl_country_master.id=tbl_seller_details.countryid','left');
	 		$this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_seller_details.loginid');
	     	$seldetail=$this->master_model->getRecords('tbl_seller_details',array('tbl_seller_details.seller_id'=>$seller_id));
			$data=array('pagetitle'=>'Seller Detail','middle_content'=>'detail-seller','seldetail'=>$seldetail);
			$this->load->view('admin/common-file',$data); 
		}
		else
		{
			$this->load->view('admin/404');
			//echo 'Oops something is wrong';
		}
	}
  /*
    Function   : Seller status
    Developer  : Yogesh
    Description: Admin can Change Single status of seller.    
  */
  public function sellerstatus($loginid,$status)
  {
      $data['success']=$data['error']='';
	   $loginid = base64_decode($loginid);
	  $input_array = array('user_status'=>$status);
	  if($this->master_model->updateRecord('tbl_login_master',$input_array,array('login_id'=>$loginid)))
	  {
		 $this->session->set_flashdata('success','Record status change successfully.');
		 redirect(base_url().'superadmin/seller/manageseller/');
	  }
	  else
	  {
		 $this->session->set_flashdata('error','Error while updating status.'); 
		 redirect(base_url().'superadmin/seller/manageseller/');
	  }
  }
    /*
    Function   : Seller Single Delete
    Developer  : Yogesh
    Description: Admin can Delete Single  seller.    
  	*/
	public function deleteseller($seller_id,$loginid)
	{
		$data['success']=$data['error']='';
	  	//$seller_id=$this->uri->segment(4);
		//$loginid=$this->uri->segment(5);
		$seller_id = base64_decode($seller_id);
		$loginid = base64_decode($loginid);
	    $seller_info=$this->master_model->getRecords('tbl_seller_details',array('seller_id'=>$seller_id));
		if(($this->master_model->deleteRecord('tbl_seller_details','seller_id',$seller_id)) && ($this->master_model->deleteRecord('tbl_login_master','login_id',$loginid))) 
	  	{
		  $this->master_model->deleteRecord('tbl_points_master','seller_login_id',$loginid);
		  $this->master_model->deleteRecord('tbl_coupon_master','login_id',$loginid);
		  @unlink('uploads/profile_image/'.$seller_info[0]['profilepic']);
		  @unlink('uploads/profile_image/thumb/'.$seller_info[0]['profilepic']);
		  $this->session->set_flashdata('success','Record deleted successfully.');
		  redirect(base_url().'superadmin/seller/manageseller/');
 	    }
	 	else
	  	{
		  $this->session->set_flashdata('error','Error while deleting Record.'); 
		  redirect(base_url().'superadmin/seller/manageseller/');
	    }
	}
   /*
    Function   : Deletemultiple,block,unblock  Seller 
    Developer  : Yogesh
    Description: Admin can Deletemultiple,block,unblock Seller.    
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
				 redirect(base_url().'superadmin/seller/manageseller/');
		   }
		  if(isset($_POST['status_chck']) && $_POST['status_chck']=='2')
		  {
				 $input_array = array('user_status'=>'1');
				 for($i=0;$i<$checkbox_count;$i++)
				 {
					 $this->master_model->updateRecord('tbl_login_master',$input_array,array('login_id'=>$_REQUEST['checkbox_del'][$i]));
				 }
				 $this->session->set_flashdata('success','Records status change successfully.');
				 redirect(base_url().'superadmin/seller/manageseller/');
			}
		  if(isset($_POST['status_chck']) && $_POST['status_chck']=='3')
		  {
			   for($i=0;$i<$checkbox_count;$i++)
			   {
				   $seller_info=$this->master_model->getRecords('tbl_seller_details',array('loginid'=>$_REQUEST['checkbox_del'][$i]));
				   $this->master_model->deleteRecord('tbl_seller_details','loginid',$_REQUEST['checkbox_del'][$i]);
				   $this->master_model->deleteRecord('tbl_login_master','login_id',$_REQUEST['checkbox_del'][$i]);
				   $this->master_model->deleteRecord('tbl_coupon_master','login_id',$_REQUEST['checkbox_del'][$i]);
				   $this->master_model->deleteRecord('tbl_points_master','seller_login_id',$_REQUEST['checkbox_del'][$i]);
				   @unlink('uploads/profile_image/'.$seller_info[0]['profilepic']);
		  		   @unlink('uploads/profile_image/thumb/'.$seller_info[0]['profilepic']);
			   }
			   $this->session->set_flashdata('success',"Records deleted successfully.");	
			   redirect(base_url().'superadmin/seller/manageseller/');
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
	  Function   :  Seller Points Detail 
	  Developer  : Yogesh
	  Description: Admin Seller Points Detail start from here.    
	*/
	public function sellerpoints()
	{
	  $data['success']=$data['error']='';
	  $data['pagetitle']='Seller Points';
	  $this->db->select('tbl_seller_details.username,tbl_seller_details.firstname,tbl_seller_details.lastname,tbl_userscored_point.login_id,tbl_login_master.login_id,tbl_login_master.email_id');
	  $this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_seller_details.loginid');
	  $this->db->join('tbl_userscored_point','tbl_userscored_point.login_id=tbl_seller_details.loginid');
	  $this->db->order_by('tbl_seller_details.seller_id','DESC');
	  $this->db->group_by('tbl_userscored_point.login_id');
      $data['seller_point']=$this->master_model->getRecords('tbl_seller_details','','');
	  $data['middle_content']='manage-seller-points';
	  $this->load->view('admin/common-file',$data);
 	}
	 /*
    Function   : Seller Point status
    Developer  : Yogesh
    Description: Admin can Change Single status of seller Point.    
  */
  public function pointstatus($points_id,$status,$loginid)
  {
      $data['success']=$data['error']='';
	  $status_array = array('ponts_status'=>$status);
	  if($this->master_model->updateRecord('tbl_points_master',$status_array,array('points_id'=>$points_id)))
	  {
		 $this->session->set_flashdata('success','Record status change successfully.');
		 redirect(base_url().'superadmin/seller/points/'.base64_encode($loginid));
	  }
	  else
	  {
		 $this->session->set_flashdata('error','Error while updating status.'); 
		 redirect(base_url().'superadmin/seller/points/'.base64_encode($loginid));
	  }
  }
  /*
    Function   : Seller Point Single Delete
    Developer  : Yogesh
    Description: Admin can Delete Single  seller Point.    
  	*/
	public function deletepoints($loginid,$points_id)
	{
		$data['success']=$data['error']='';
	  	$loginid=$this->uri->segment(4);
		$points_id=$this->uri->segment(5);
	    if($this->master_model->deleteRecord('tbl_points_master','points_id',$points_id)) 
	  	{
		  $this->session->set_flashdata('success','Record deleted successfully.');
		  redirect(base_url().'superadmin/seller/points/'.base64_encode($loginid));
 	    }
	 	else
	  	{
		  $this->session->set_flashdata('error','Error while deleting Record.'); 
		  redirect(base_url().'superadmin/seller/points/'.base64_encode($loginid));
	    }
	}
	/*
    Function   : Deletemultiple,block,unblock  Seller Points 
    Developer  : Yogesh
    Description: Admin can Deletemultiple,block,unblock Seller Points.    
   */
   public function multiactionchangepoints($loginid='')
   {
	  $data['success']=$data['error']='';
	  if(isset($_REQUEST['checkbox_del'])!="")
	  {
		  $checkbox_count = count($_POST['checkbox_del']);
		  if(isset($_POST['status_chck']) && $_POST['status_chck']=='1')
		  {
				 $input_array = array('ponts_status'=>'0');
				 for($i=0;$i<$checkbox_count;$i++)
				 {
					 $this->master_model->updateRecord('tbl_points_master',$input_array,array('points_id'=>$_REQUEST['checkbox_del'][$i]));
				 }
				 $this->session->set_flashdata('success','Records status change successfully.');
				 redirect(base_url().'superadmin/seller/points/'.base64_encode($loginid));
		   }
		  if(isset($_POST['status_chck']) && $_POST['status_chck']=='2')
		  {
				 $input_array = array('ponts_status'=>'1');
				 for($i=0;$i<$checkbox_count;$i++)
				 {
					 $this->master_model->updateRecord('tbl_points_master',$input_array,array('points_id'=>$_REQUEST['checkbox_del'][$i]));
				 }
				 $this->session->set_flashdata('success','Records status change successfully.');
				 redirect(base_url().'superadmin/seller/points/'.base64_encode($loginid));
			}
		  if(isset($_POST['status_chck']) && $_POST['status_chck']=='3')
		  {
			   for($i=0;$i<$checkbox_count;$i++)
			   {
				   $this->master_model->deleteRecord('tbl_points_master','points_id',$_REQUEST['checkbox_del'][$i]);
			   }
			   $this->session->set_flashdata('success',"Records deleted successfully.");	
			   redirect(base_url().'superadmin/seller/points/'.base64_encode($loginid));
		  }
	  }
   }
   /*
	  Function   :  Seller Points Detail 
	  Developer  : Yogesh
	  Description: Admin Seller Points Detail start from here.    
	*/
	 public function detailpoints($loginid,$points_id='')
	{
		$loginid = base64_decode($loginid);
		$points_id = base64_decode($points_id);
		if($points_id!='' && is_numeric($points_id))
		{
			$this->db->select('tbl_seller_details.firstname,tbl_seller_details.lastname,tbl_seller_details.loginid,tbl_points_master.*,tbl_login_master.email_id');	 
	 		$this->db->join('tbl_points_master','tbl_points_master.seller_login_id=tbl_seller_details.loginid');
	  		$this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_seller_details.loginid');
			$fetch_points_detail=$this->master_model->getRecords('tbl_seller_details',array('tbl_points_master.points_id'=>$points_id,'tbl_points_master.seller_login_id'=>$loginid));
			$data=array('pagetitle'=>'Seller Points Detail','middle_content'=>'detail-points','fetch_points_detail'=>$fetch_points_detail,'loginid'=>$loginid);
			$this->load->view('admin/common-file',$data); 
		}
		else
		{
			$this->load->view('admin/404');
			//echo 'Oops something is wrong';
		}

	}
	/*
	  Function   :  Seller Brands Detail 
	  Developer  : Yogesh
	  Description: Admin Seller Brands Detail start from here.    
	*/
	public function brand($loginid='')
	{
		$loginid = base64_decode($loginid);
		$data['success']=$data['error']='';
		if(isset($_POST['btn_update_brands']))
		{ 
				$brands_id=$this->input->post('brands_id');
				$cnt_brands=count($brands_id);
				$brands_id=implode(',',$brands_id);
				$update_brands_array=array('brands_id'=>$brands_id); 
				if($this->master_model->updateRecord('tbl_seller_details',$update_brands_array,array('loginid'=>$loginid)))
				{
					$this->session->set_flashdata('success','Recored updates Successfully.');
					redirect(base_url().'superadmin/seller/manageseller/');
				}
		}
		//$this->db->join('tbl_faq_categories','tbl_faq_categories.faqid=tbl_faq_master.faq_id');
	    $brandinfo=$this->master_model->getRecords('tbl_brand_master',array('tbl_brand_master.brand_status'=>'1'));
		$this->db->select('tbl_seller_details.brands_id,tbl_seller_details.loginid');
		$sellerinfo=$this->master_model->getRecords('tbl_seller_details',array('tbl_seller_details.loginid'=>$loginid));
		$data=array('pagetitle'=>'Update Brand','middle_content'=>'manage-edit-brand','sellerinfo'=>$sellerinfo,'brandinfo'=>$brandinfo);
	    $this->load->view('admin/common-file',$data);
	}
  //status change
  public function coupon($loginid,$status)
  {
	  $data['success']=$data['error']='';
	  $input_array = array('coupon_notification'=>$status);
	  if($this->master_model->updateRecord('tbl_seller_details',$input_array,array('loginid'=>$loginid)))
	  {
		 //$this->session->set_flashdata('success','Record status change successfully.');
		redirect(base_url().'superadmin/seller/manageseller/');
	 
	  }
	  else
	  {
		 $this->session->set_flashdata('error','Error while updating status.'); 
		 redirect(base_url().'superadmin/seller/manageseller/'.$loginid.'');
	  }
  }
  	//function : manage coupon
	//developer : shailesh
	public function managecoupon($loginid='')
	{
		//echo date('h-i-s');
		$loginid= base64_decode($loginid);
		$data['success']=$data['error']='';
		$data['pagetitle']='Manage Coupon';
		$data['fetch_manage_coupon']=$this->master_model->getRecords('tbl_coupon_master',array('login_id'=>$loginid),'',array('coupon_id'=>'DESC'));
		$data['middle_content']='manage-coupon';
		$this->load->view('admin/common-file',$data);
	}
	//function multiple delete and block unbloc
	//develpoer:shailesh
	public function deletemultiplecoupon()
	{
		$data['success']=$data['error']='';
		if(isset($_REQUEST['checkbox_del'])!="")
		{
		   $checkbox_del_count = count($_POST['checkbox_del']);
		   if(isset($_POST['status_chck']) && $_POST['status_chck']=='3')
		   {
			  	   for($i=0;$i<$checkbox_del_count;$i++)
				   {
						$unlik_image=$this->master_model->getRecords('tbl_coupon_master',array('tbl_coupon_master.coupon_id'=>$_REQUEST['checkbox_del'][$i]),'coupon_image');
						if($this->master_model->deleteRecord('tbl_coupon_master','coupon_id',$_REQUEST['checkbox_del'][$i]))
						{
						  //s@unlink('uploads/coupon/'.$unlik_image[0]['coupon_image']);
  						}
				   }
				   $this->session->set_flashdata('success',"Records deleted successfully.");	
				   redirect(base_url().'superadmin/seller/managecoupon/'.$this->uri->segment(4).'');
		   }
		   if(isset($_POST['status_chck']) && $_POST['status_chck']=='1')
		   {
			 	 $input_array = array('coupon_status'=>'1');
				 for($i=0;$i<$checkbox_del_count;$i++)
				 {
					 $this->master_model->updateRecord('tbl_coupon_master',$input_array,array('coupon_id'=>$_REQUEST['checkbox_del'][$i]));
				 }
				 $this->session->set_flashdata('success','Records status change successfully.');
				 redirect(base_url().'superadmin/seller/managecoupon/'.$this->uri->segment(4).'');
		   }
		   if(isset($_POST['status_chck']) && $_POST['status_chck']=='2')
		   {
				 $input_array = array('coupon_status'=>'0');
				 for($i=0;$i<$checkbox_del_count;$i++)
				 {
					 $this->master_model->updateRecord('tbl_coupon_master',$input_array,array('coupon_id'=>$_REQUEST['checkbox_del'][$i]));
				 }
				 $this->session->set_flashdata('success','Records status change successfully.');
				 redirect(base_url().'superadmin/seller/managecoupon/'.$this->uri->segment(4).'');
			}
		}
	}
	  //function :active and deactive deal
  //devloper : shailesh
  public function deal($login_id,$coupon_id,$deal)
  {
      $data['success']=$data['error']='';
	  $login_id = base64_decode($login_id);
	  $coupon_id = base64_decode($coupon_id);
	  $input_array = array('deal'=>$deal);
	  if($this->master_model->updateRecord('tbl_coupon_master',$input_array,array('coupon_id'=>$coupon_id)))
	  {
		 $this->session->set_flashdata('success','Deal status change successfully.');
		 redirect(base_url().'superadmin/seller/managecoupon/'.base64_encode($login_id));
	  }
	  else
	  {
		 $this->session->set_flashdata('error','Error while updating status.'); 
		 redirect(base_url().'superadmin/seller/managecoupon/');
	  }
  }
  	//function : block n unblock coupon
	//devloper : shailesh
	public function couponstatus($login_id='',$coupon_id,$status)
  {
      $login_id = base64_decode($login_id);
	   $coupon_id = base64_decode($coupon_id);
	  $data['success']=$data['error']='';
	  $input_array = array('coupon_status'=>$status);
	  if($this->master_model->updateRecord('tbl_coupon_master',$input_array,array('coupon_id'=>$coupon_id)))
	  {
		 $this->session->set_flashdata('success','Record status change successfully.');
		 redirect(base_url().'superadmin/seller/managecoupon/'.base64_encode($login_id).'');
	  }
	  else
	  {
		 $this->session->set_flashdata('error','Error while updating status.'); 
		 redirect(base_url().'superadmin/seller/managecoupon/'.base64_encode($login_id).'');
	  }
  }
  	//function delete coupon
	//developer :shailesh
	public function deletecoupon($login_id='',$coupon_id='',$coupon_image='')
	{
		$login_id= base64_decode($login_id);
		$coupon_id= base64_decode($coupon_id);
		$data['success']=$data['error']='';
		if($this->master_model->deleteRecord('tbl_coupon_master','coupon_id',$coupon_id))
		{
			//@unlink('uploads/coupon/'.$coupon_image);
			$this->session->set_flashdata('success','Record deleted successfully.');
		   	redirect(base_url().'superadmin/seller/managecoupon/'.base64_encode($login_id).'');
		}
		else
		{
			$this->session->set_flashdata('error','Error while deleting record.'); 
		   	redirect(base_url().'superadmin/seller/managecoupon/'.base64_encode($login_id).'');
		}
	}
   public function points($point_type='',$login_id='')
   {
	 $data['success']=$data['error']='';
	 $data['pagetitle']='Manage Points details';  
	 
	 $this->db->where('tbl_userscored_point.point_type',$point_type);
	 $this->db->where('tbl_login_master.login_id',$login_id);
	 $this->db->join('tbl_login_master','tbl_userscored_point.login_id=tbl_login_master.login_id');
	 $this->db->join('tbl_coupon_master','tbl_coupon_master.coupon_id=tbl_userscored_point.coupon_id');
	 $data['AllPoints']=$this->master_model->getRecords('tbl_userscored_point');
	 
	 $data['userData']=$this->master_model->getRecords('tbl_login_master',array('login_id'=>$login_id));
	 $data['middle_content']='manage-points-details';
	 $this->load->view('admin/common-file',$data);
   }
}