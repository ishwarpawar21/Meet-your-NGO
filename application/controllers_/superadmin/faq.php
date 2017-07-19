<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Faq extends CI_Controller {
    public function __construct()
    {
	   parent::__construct();
	   if( ! ini_get('date.timezone') )
		{
		   date_default_timezone_set('GMT');
		} 
	}
	/*
	  Function   :  Manage FAQ 
	  Developer  : Yogesh
	  Description: Admin can Manage FAQ from here.    
	*/
	public function manage()
	{
	  $data['success']=$data['error']='';
	  $data['pagetitle']='Manage FAQ';
	  //$this->db->join('tbl_faq_categories','tbl_faq_categories.faqid=tbl_faq_master.faq_id');
	  $this->db->order_by('tbl_faq_master.faq_id','DESC');
      $data['fetch_faq']=$this->master_model->getRecords('tbl_faq_master','','');
	  $data['middle_content']='manage-faq';
	  $this->load->view('admin/common-file',$data);
 	}
	/*
	  Function   :  Add FAQ Info 
	  Developer  : Yogesh
	  Description: Admin Add FAQ Info start from here.    
	*/
	public function add()
	{
		$data['success']=$data['error']='';
		$data['pagetitle']='Add FAQ';
		if(isset($_POST['btn_add_faq']))
		{ 
			$this->form_validation->set_rules('faq_ques','','required|xss_clean');
			$this->form_validation->set_rules('faq_ans');
			if($this->form_validation->run())
			{ 
				$faq_ques=$this->input->post('faq_ques',true);
				$faq_ans=$this->input->post('faq_ans');
				$faqcat_id=$this->input->post('faqcat_id');
				
				$input_data=array('faq_ques'=>addslashes($faq_ques),'faq_ans'=>$faq_ans,'faq_add_date'=>date('Y-m-d')); 
				if($this->master_model->insertRecord('tbl_faq_master',$input_data))
				{
					$insert_id=$this->db->insert_id();
					$cnt_faq=count($faqcat_id);
					for($i=0;$i<$cnt_faq;$i++)
					{
						if($faqcat_id[$i]=='1')
						{$faq_cat_name="Help";}
						if($faqcat_id[$i]=='2')
						{$faq_cat_name="Contact Us";}
						if($faqcat_id[$i]=='3')
						{$faq_cat_name="Community";}
						
						$inputdata=array('faqid'=>$insert_id,'faqcat_id'=>$faqcat_id[$i],'faq_cat_name'=>$faq_cat_name); 
						$this->master_model->insertRecord('tbl_faq_categories',$inputdata);
					}
					$this->session->set_flashdata('success','Recored Added Successfully.');
					redirect(base_url().'superadmin/faq/manage/');
				}
			}
			else
			{
				$this->session->set_flashdata('error','Error while Added record');
				redirect(base_url().'superadmin/faq/add/');
			}
		}
	   $data=array('pagetitle'=>'Add FAQ','middle_content'=>'add-faq');
	    $this->load->view('admin/common-file',$data);
	}
	/*
	  Function   :  Edit FAQ Info 
	  Developer  : Yogesh
	  Description: Admin Edit FAQ Info start from here.    
	*/
	public function edit($faq_id='')
	{
		$faq_id = base64_decode($faq_id);
		$data['success']=$data['error']='';
		$data['pagetitle']='Update FAQ';
		if(isset($_POST['btn_update_faq']))
		{ 
			$this->form_validation->set_rules('faq_ques','','required|xss_clean');
			$this->form_validation->set_rules('faq_ans');
			if($this->form_validation->run())
			{ 
				$faq_ques=$this->input->post('faq_ques',true);
				$faq_ans=$this->input->post('faq_ans');
				$faqcat_id=$this->input->post('faqcat_id');
				
				$update_faq_array=array('faq_ques'=>addslashes($faq_ques),'faq_ans'=>$faq_ans); 
				if($this->master_model->updateRecord('tbl_faq_master',$update_faq_array,array('faq_id'=>$faq_id)))
				{
					$this->master_model->deleteRecord('tbl_faq_categories','faqid',$faq_id);	
					$cnt_faq=count($faqcat_id);
					for($i=0;$i<$cnt_faq;$i++)
					{
						if($faqcat_id[$i]=='1')
						{$faq_cat_name="Help";}
						if($faqcat_id[$i]=='2')
						{$faq_cat_name="Contact Us";}
						if($faqcat_id[$i]=='3')
						{$faq_cat_name="Community";}
						
						$inputdata=array('faqid'=>$faq_id,'faqcat_id'=>$faqcat_id[$i],'faq_cat_name'=>$faq_cat_name); 
						$this->master_model->insertRecord('tbl_faq_categories',$inputdata);
					}
					$this->session->set_flashdata('success','Recored updates Successfully.');
					redirect(base_url().'superadmin/faq/manage/');
				}
			}
			else
			{
				$this->session->set_flashdata('error','Error while updating record');
				redirect(base_url().'superadmin/faq/updatefaq/'.base64_encode($faq_id).'');
			}
		}
		$this->db->join('tbl_faq_categories','tbl_faq_categories.faqid=tbl_faq_master.faq_id');
	    $faqinfo=$this->master_model->getRecords('tbl_faq_master',array('tbl_faq_master.faq_id'=>$faq_id));
		$data=array('pagetitle'=>'Update FAQ','middle_content'=>'edit-faq','faqinfo'=>$faqinfo);
	    $this->load->view('admin/common-file',$data);
	}
	/*
	  Function   :  FAQ Detail 
	  Developer  : Yogesh
	  Description: Admin FAQ Detail start from here.    
	*/
	 public function detail($faq_id='')
	{
		$faq_id = base64_decode($faq_id);
		if($faq_id!='' && is_numeric($faq_id))
		{
		 	$newsdetail=$this->master_model->getRecords('tbl_faq_master',array('faq_id'=>$faq_id));
			$data=array('pagetitle'=>'FAQ Detail','middle_content'=>'detail-newsletter','newsdetail'=>$newsdetail);
			$this->load->view('admin/common-file',$data); 
		}
		else
		{
			$this->load->view('admin/404');
			//echo 'Oops something is wrong';
		}

	}
  /*
    Function   : FAQ status
    Developer  : Yogesh
    Description: Admin can Change Single status of FAQ.    
  */
  public function status($faq_id,$status)
  {
      $data['success']=$data['error']='';
	  $faq_id = base64_decode($faq_id);
	  $input_array = array('faq_status'=>$status);
	  if($this->master_model->updateRecord('tbl_faq_master',$input_array,array('faq_id'=>$faq_id)))
	  {
		 $this->session->set_flashdata('success','Record status change successfully.');
		 redirect(base_url().'superadmin/faq/manage/');
	  }
	  else
	  {
		 $this->session->set_flashdata('error','Error while updating status.'); 
		 redirect(base_url().'superadmin/faq/manage/');
	  }
  }
   /*
    Function   : FAQ Single Delete
    Developer  : Yogesh
    Description: Admin can Delete Single  FAQ.    
  	*/
	public function delete($faq_id)
	{
		$data['success']=$data['error']='';
	  	//$faq_id=$this->uri->segment(4);
		$faq_id = base64_decode($faq_id);
		if($this->master_model->deleteRecord('tbl_faq_master','faq_id',$faq_id)) 
	  	{
		  $this->master_model->deleteRecord('tbl_faq_categories','faqid',$faq_id);	
		  $this->session->set_flashdata('success','Record deleted successfully.');
		  redirect(base_url().'superadmin/faq/manage/');
 	    }
	 	else
	  	{
		  $this->session->set_flashdata('error','Error while deleting Record.'); 
		  redirect(base_url().'superadmin/faq/manage/');
	    }
	}
   /*
    Function   : Deletemultiple,block,unblock  FAQ 
    Developer  : Yogesh
    Description: Admin can Deletemultiple,block,unblock FAQ.    
  */
   public function multiactionchange()
   {
	  $data['success']=$data['error']='';
	  if(isset($_REQUEST['checkbox_del'])!="")
	  {
		  $checkbox_count = count($_POST['checkbox_del']);
		  if(isset($_POST['status_chck']) && $_POST['status_chck']=='1')
		  {
			 	 $input_array = array('faq_status'=>'0');
				 for($i=0;$i<$checkbox_count;$i++)
				 {
					 $this->master_model->updateRecord('tbl_faq_master',$input_array,array('faq_id'=>$_REQUEST['checkbox_del'][$i]));
				 }
				 $this->session->set_flashdata('success','Records status change successfully.');
				 redirect(base_url().'superadmin/faq/manage/');
		   }
		  if(isset($_POST['status_chck']) && $_POST['status_chck']=='2')
		  {
				 $input_array = array('faq_status'=>'1');
				 for($i=0;$i<$checkbox_count;$i++)
				 {
					 $this->master_model->updateRecord('tbl_faq_master',$input_array,array('faq_id'=>$_REQUEST['checkbox_del'][$i]));
				 }
				 $this->session->set_flashdata('success','Records status change successfully.');
				 redirect(base_url().'superadmin/faq/manage/');
			}
		  if(isset($_POST['status_chck']) && $_POST['status_chck']=='3')
		  {
			   for($i=0;$i<$checkbox_count;$i++)
			   {
				   $this->master_model->deleteRecord('tbl_faq_master','faq_id',$_REQUEST['checkbox_del'][$i]);
				   $this->master_model->deleteRecord('tbl_faq_categories','faqid',$_REQUEST['checkbox_del'][$i]);
			   }
			   $this->session->set_flashdata('success',"Records deleted successfully.");	
			   redirect(base_url().'superadmin/faq/manage/');
		  }
	  }
   }
}