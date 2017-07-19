<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Newsletter extends CI_Controller {
    public function __construct()
    {
	   parent::__construct();
	   $this->load->library('upload');  
	   //$this->load->library('email');  
	   $this->load->model('email_sending');	  
	   if( ! ini_get('date.timezone') )
		{
		   date_default_timezone_set('GMT');
		} 
	}
	/*
	  Function   :  Manage Newsletter 
	  Developer  : Yogesh
	  Description: Admin can Manage Newsletter from here.    
	*/
	public function manage()
	{
	  $data['success']=$data['error']='';
	  $data['pagetitle']='Manage Newsletter';
	  $this->db->order_by('tbl_newsletter_master.news_id','DESC');
      $data['fetch_newsletter']=$this->master_model->getRecords('tbl_newsletter_master','','');
	  $data['middle_content']='manage-newsletter';
	  $this->load->view('admin/common-file',$data);
 	}
	/*
	  Function   :  Add Newsletter Info 
	  Developer  : Yogesh
	  Description: Admin Add Newsletter Info start from here.    
	*/
	public function add()
	{
		$data['success']=$data['error']='';
		$data['pagetitle']='Add Newsletter';
		if(isset($_POST['btn_add_newsletter']))
		{ 
			$this->form_validation->set_rules('newsletter_subject','','required|xss_clean');
			$this->form_validation->set_rules('news_title','','required|xss_clean');
			$this->form_validation->set_rules('news_description');
			if($this->form_validation->run())
			{ 
				$newsletter_subject=$this->input->post('newsletter_subject',true);
				$news_title=$this->input->post('news_title',true);
				$news_description=$this->input->post('news_description');
				$input_data=array('news_title'=>addslashes($news_title),'news_description'=>$news_description,'newsletter_subject'=>addslashes($newsletter_subject)); 
				if($this->master_model->insertRecord('tbl_newsletter_master',$input_data))
				{
					$this->session->set_flashdata('success','Recored Added Successfully.');
					redirect(base_url().'superadmin/newsletter/manage/');
				}
			}
			else
			{
				$this->session->set_flashdata('error','Error while Added record');
				redirect(base_url().'superadmin/newsletter/add/');
			}
		}
	   $data=array('pagetitle'=>'Add Newsletter','middle_content'=>'add-newsletter');
	    $this->load->view('admin/common-file',$data);
	}
	/*
	  Function   :  Edit Newsletter Info 
	  Developer  : Yogesh
	  Description: Admin Edit Newsletter Info start from here.    
	*/
	public function edit($news_id='')
	{
		$news_id = base64_decode($news_id);
		$data['success']=$data['error']='';
		$data['pagetitle']='Update Newsletter';
		if(isset($_POST['btn_update_newsletter']))
		{ 
			$this->form_validation->set_rules('newsletter_subject','','required|xss_clean');
			$this->form_validation->set_rules('news_title','','required|xss_clean');
			$this->form_validation->set_rules('news_description');
			if($this->form_validation->run())
			{ 
				$newsletter_subject=$this->input->post('newsletter_subject',true);
				$news_title=$this->input->post('news_title',true);
				$news_description=$this->input->post('news_description');
				
				$update_news_array=array('news_title'=>addslashes($news_title),'news_description'=>$news_description,'newsletter_subject'=>addslashes($newsletter_subject)); 
				if($this->master_model->updateRecord('tbl_newsletter_master',$update_news_array,array('news_id'=>$news_id)))
				{
					$this->session->set_flashdata('success','Recored updates Successfully.');
					redirect(base_url().'superadmin/newsletter/manage/');
				}
			}
			else
			{
				$this->session->set_flashdata('error','Error while updating record');
				redirect(base_url().'superadmin/newsletter/edit/'.base64_encode($news_id).'');
			}
		}
	    $newsinfo=$this->master_model->getRecords('tbl_newsletter_master',array('news_id'=>$news_id));
		$data=array('pagetitle'=>'Update Newsletter','middle_content'=>'edit-newsletter','newsinfo'=>$newsinfo);
	    $this->load->view('admin/common-file',$data);
	}
	/*
	  Function   :  Newsletter Detail 
	  Developer  : Yogesh
	  Description: Admin Newsletter Detail start from here.    
	*/
	 public function detail($news_id='')
	{
		$news_id = base64_decode($news_id);
		if($news_id!='' && is_numeric($news_id))
		{
		 	$newsdetail=$this->master_model->getRecords('tbl_newsletter_master',array('news_id'=>$news_id));
			$data=array('pagetitle'=>'Newsletter Detail','middle_content'=>'detail-newsletter','newsdetail'=>$newsdetail);
			$this->load->view('admin/common-file',$data); 
		}
		else
		{
			$this->load->view('admin/404');
			//echo 'Oops something is wrong';
		}

	}
  /*
    Function   : Newsletter status
    Developer  : Yogesh
    Description: Admin can Change Single status of Newsletter.    
  */
  public function status($news_id,$status)
  {
      $data['success']=$data['error']='';
	  $news_id = base64_decode($news_id);
	  $input_array = array('news_status'=>$status);
	  if($this->master_model->updateRecord('tbl_newsletter_master',$input_array,array('news_id'=>$news_id)))
	  {
		 $this->session->set_flashdata('success','Record status change successfully.');
		 redirect(base_url().'superadmin/newsletter/manage/');
	  }
	  else
	  {
		 $this->session->set_flashdata('error','Error while updating status.'); 
		 redirect(base_url().'superadmin/newsletter/manage/');
	  }
  }
   /*
    Function   : Newsletter Single Delete
    Developer  : Yogesh
    Description: Admin can Delete Single  Newsletter.    
  	*/
	public function delete($news_id)
	{
		$data['success']=$data['error']='';
	  	$news_id = base64_decode($news_id);
		//$news_id=$this->uri->segment(4);
		if($this->master_model->deleteRecord('tbl_newsletter_master','news_id',$news_id)) 
	  	{
		  $this->session->set_flashdata('success','Record deleted successfully.');
		  redirect(base_url().'superadmin/newsletter/manage/');
 	    }
	 	else
	  	{
		  $this->session->set_flashdata('error','Error while deleting Record.'); 
		  redirect(base_url().'superadmin/newsletter/manage/');
	    }
	}
   /*
    Function   : Deletemultiple,block,unblock  Newsletter 
    Developer  : Yogesh
    Description: Admin can Deletemultiple,block,unblock Newsletter.    
  */
   public function multiactionchange()
   {
	  $data['success']=$data['error']='';
	  if(isset($_REQUEST['checkbox_del'])!="")
	  {
		  $checkbox_count = count($_POST['checkbox_del']);
		  if(isset($_POST['status_chck']) && $_POST['status_chck']=='1')
		  {
			 	 $input_array = array('news_status'=>'0');
				 for($i=0;$i<$checkbox_count;$i++)
				 {
					 $this->master_model->updateRecord('tbl_newsletter_master',$input_array,array('news_id'=>$_REQUEST['checkbox_del'][$i]));
				 }
				 $this->session->set_flashdata('success','Records status change successfully.');
				 redirect(base_url().'superadmin/newsletter/manage/');
		   }
		  if(isset($_POST['status_chck']) && $_POST['status_chck']=='2')
		  {
				 $input_array = array('news_status'=>'1');
				 for($i=0;$i<$checkbox_count;$i++)
				 {
					 $this->master_model->updateRecord('tbl_newsletter_master',$input_array,array('news_id'=>$_REQUEST['checkbox_del'][$i]));
				 }
				 $this->session->set_flashdata('success','Records status change successfully.');
				 redirect(base_url().'superadmin/newsletter/manage/');
			}
		  if(isset($_POST['status_chck']) && $_POST['status_chck']=='3')
		  {
			   for($i=0;$i<$checkbox_count;$i++)
			   {
				   $this->master_model->deleteRecord('tbl_newsletter_master','news_id',$_REQUEST['checkbox_del'][$i]);
			   }
			   $this->session->set_flashdata('success',"Records deleted successfully.");	
			   redirect(base_url().'superadmin/newsletter/manage/');
		  }
	  }
   }
   	/*
	  Function   :  Send Newsletter 
	  Developer  : Yogesh
	  Description: Admin can Send Newsletter from here.    
	*/
	public function send()
	{
	  $data['success']=$data['error']='';
	  $data['pagetitle']='Send Newsletter';
	 /*Send subscriber*/
	 if(isset($_POST['btn_send_newsletter']))
	 {  
			  $chk_nw=$this->input->post('check_email');
			  $news_id=$this->input->post('news_title','',true);
			  $get_id = array('news_id'=>$news_id);
			  $row = $this->master_model->getRecords('tbl_newsletter_master',$get_id);
			 $cnt_news=count($chk_nw);
			 $info_mail=$this->master_model->getRecords('admin_login');
			 for($i=0;$i<$cnt_news;$i++)
			 {	  
				  $emailid = array('sub_id'=>$chk_nw[$i]);
				  $rowemail = $this->master_model->getRecords('tbl_newsletter_subscriber',$emailid);
				  /*Send the mail to user*/
				  $info_arr = array('from'=>$info_mail[0]['admin_email'],
									'to'=>$rowemail[0]['sub_email'],
									'subject'=>$row[0]['newsletter_subject'],
									'view'=>'newsletter_to_user');
				  $other_info = array('news_title'=>$row[0]['news_title'],
									  'news_discription'=>$row[0]['news_description'],
									  'news_id'=>$row[0]['news_id'],'admin_email'=>$info_mail[0]['admin_email'],'sub_id'=>$chk_nw[$i]);
				 $this->email_sending->sendmail($info_arr,$other_info);
			 }
			 $this->session->set_flashdata('success','Newsletter send successfully');
			 redirect(base_url().'superadmin/newsletter/send/');
	 }
	 /* Delete subscriber */
	 //this value set of hidden and in javasscript value is set of one.
	 if(isset($_POST['news_del']) && $_POST['news_del']=='1')
	 {
			if(isset($_REQUEST['check_email'])!="")
			{
			   $check_email = count($_POST['check_email']);
			   for($i=0;$i<$check_email;$i++)
			   {
					$email_id=explode('/',$_REQUEST['check_email'][$i]);
					$this->master_model->deleteRecord('tbl_newsletter_subscriber','sub_id',$email_id[1]);
				}
			   $this->session->set_flashdata('success',"Record deleted successfully.");	
			   redirect(base_url().'amazoopmaster/admin/sendnewslestter');
			}
	 }
	  $this->db->order_by('tbl_newsletter_subscriber.sub_id','DESC');
      $data['fetch_subscriber']=$this->master_model->getRecords('tbl_newsletter_subscriber','','');
	  $this->db->order_by('tbl_newsletter_master.news_id','DESC');
      $data['fetch_newsletter']=$this->master_model->getRecords('tbl_newsletter_master',array('news_status'=>'1'));
	  $data['middle_content']='send-newsletter';
	  $this->load->view('admin/common-file',$data);
 	}
	/*
	  Function   :  Newsletter online display 
	  Developer  : Yogesh
	  Description: Admin can online display Newsletter from here.    
	*/
	public function onlineversion()
	{
		$subid=base64_decode($this->uri->segment(4));
		$newsid=base64_decode($this->uri->segment(5));
		$news_info=$this->master_model->getRecords('tbl_newsletter_master',array('news_id'=>$newsid));
		$subemail=$this->master_model->getRecords('tbl_newsletter_subscriber',array('sub_id'=>$subid));
		if(count($news_info)>0 && count($subemail)>0)
		{
		$infoemail=$this->master_model->getRecords('admin_login',array('id'=>1));
		$data=array('page_title'=>'Online Version','middle-content'=>'send-newslwtter-details','news_title'=>$news_info[0]['news_title'],'news_description'=>$news_info[0]['news_description'],'admin_email'=>$infoemail[0]['admin_email'],'sub_id'=>$subid,'news_id'=>$newsid);
		$this->load->view('send-newslwtter-details',$data);
		}
		else
		{
			redirect(base_url());
		}
	}
	/*
	  Function   :  Newsletter  unsubscribe
	  Developer  : Yogesh
	  Description: Admin can unsubscribe Newsletter from here.    
	*/
	public function unsubscribe()
	{
			$sub_id=base64_decode($this->uri->segment(4));
			$chk=array('sub_id'=>$sub_id); 	
		 	$chksts=$this->master_model->getRecordCount('tbl_newsletter_subscriber',$chk);	
			if($chksts>0)
			{
			$chk_status=array('sub_status'=>'1','sub_id'=>$sub_id); 	
		 	$chkstuts=$this->master_model->getRecordCount('tbl_newsletter_subscriber',$chk_status);	
				if($chkstuts>0)
				{ 
					if($this->master_model->updateRecord('tbl_newsletter_subscriber',array('sub_status'=>'0'),array('sub_id'=>$sub_id)))
					{
						//$this->session->set_flashdata('success','You have been unsubscribed successfully.');
						redirect(base_url()."superadmin/newsletter/thankyou/unsubscribe/");
					 }
				}
				else
				{
						//$this->session->set_flashdata('success','You have been already unsubscribed.');
						redirect(base_url()."superadmin/newsletter/thankyou/done/");
				}
			}
			else
			{
				redirect(base_url());
			}
	}
	/*
	  Function   :  Thank You Page Start
	  Developer  : Yogesh
	  Description: Thank You page start for Newsletter.    
	*/
	public function thankyou()
	{
		$msg=$this->uri->segment(4);
		$data=array('page_title'=>'Thank you','middle_content'=>'thank-you','msg'=>$msg);
		$this->load->view('templete',$data);
	}
}