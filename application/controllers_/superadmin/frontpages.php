<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Frontpages extends CI_Controller {
    public function __construct()
    {
	   parent::__construct();  
	}
	
	public function managefrontpage()
	{
		$data['success']=$data['error']='';
	  	$data['pagetitle']='Manage Frontpage';
		if(isset($_POST['multiple_delete']))
		{
			if(isset($_POST['checkbox_del']))
			{
				if(count($_POST['checkbox_del'])!= 0)
				{
					$cnt_checkbox_del=count($_POST['checkbox_del']); 
					for($i=0;$i<$cnt_checkbox_del;$i++)
					{
						$this->master_model->deleteRecord('tbl_front_page','front_id',$_POST['checkbox_del'][$i]);
					}
					$this->session->set_flashdata('success','Record(s) delete Successfully.');
					redirect(base_url().'superadmin/frontpages/managefrontpage');
				}
				else
				{
					$this->session->set_flashdata('error','Select Record(s) to delete.');
					redirect(base_url().'superadmin/frontpages/managefrontpage');
				}
			}
			else
			{
				$this->session->set_flashdata('error','Select Record(s) to delete.');
				redirect(base_url().'superadmin/frontpages/managefrontpage');
			}
		}
	  if(isset($_POST['blockmultiple']))
		{
			if(isset($_POST['checkbox_del']))
			{
				if(count($_POST['checkbox_del'])!= 0)
				{
					$cnt_checkbox_del=count($_POST['checkbox_del']); 
					$stat='0';
					for($i=0;$i<$cnt_checkbox_del;$i++)
					{
						$this->master_model->updateRecord('tbl_front_page',array('front_status'=>$stat),array('front_id'=>$_POST['checkbox_del'][$i]));
					}
					$this->session->set_flashdata('success','Record(s) status updated successfully.');
					redirect(base_url().'superadmin/frontpages/managefrontpage');
				}
				else
				{
					$this->session->set_flashdata('error','Select record(s) to block.');
					redirect(base_url().'superadmin/frontpages/managefrontpage');
				}
			}
			else
			{
				$this->session->set_flashdata('error','Select record(s) to block.');
				redirect(base_url().'superadmin/frontpages/managefrontpage');
			}
			
		}
		if(isset($_POST['unblockmultiple']))
		{
			if(isset($_POST['checkbox_del']))
			{
				if(count($_POST['checkbox_del'])!= 0)
				{
					$cnt_checkbox_del=count($_POST['checkbox_del']); 
					$stat='1';
					for($i=0;$i<$cnt_checkbox_del;$i++)
					{
						$this->master_model->updateRecord('tbl_front_page',array('front_status'=>$stat),array('front_id'=>$_POST['checkbox_del'][$i]));
					}
					$this->session->set_flashdata('success','Record(s) status updated successfully.');
					redirect(base_url().'superadmin/frontpages/managefrontpage');
				}
				else
				{
					$this->session->set_flashdata('error','Select record(s) to unblock.');
					redirect(base_url().'superadmin/frontpages/managefrontpage');
				}
			}
			else
			{
				$this->session->set_flashdata('error','Select record(s) to unblock.');
				redirect(base_url().'superadmin/frontpages/managefrontpage');
			}
		}
		$data['fetch_manage_frontpage']=$this->master_model->getRecords('tbl_front_page');
		$data['middle_content']='manage-frontpage';
		$this->load->view('admin/common-file',$data);
	}
	
	public function addfrontpage()
	{
		$data['success']=$data['error']='';
	  	$data['pagetitle']='Add Frontpage';
			if(isset($_POST['brm_frontpage']))
			{
				  $this->form_validation->set_rules('page_name','Page Name','required|xss_clean|is_unique[tbl_front_page.front_page_name]');
				  $this->form_validation->set_rules('page_title','Page Title','required|xss_clean|is_unique[tbl_front_page.front_page_title]');
				  $this->form_validation->set_rules('meta_title','Meta Title','required|xss_clean');
				  $this->form_validation->set_rules('meta_keyword','Meta Keywords','required|xss_clean');
				  $this->form_validation->set_rules('meta_desc','Meta Description','required|xss_clean');
				  $this->form_validation->set_rules('page_description','Page Description','required');
				  
			
				  
				  	if($this->form_validation->run())
			  		{
						  $page_name=$this->input->post('page_name',true);
						  $page_title=$this->input->post('page_title',true);
						  $meta_title=$this->input->post('meta_title',true);
						  $meta_keyword=$this->input->post('meta_keyword',true);
						  $meta_desc=$this->input->post('meta_desc',true);
						  $page_description=$this->input->post('page_description');
						  
						 
						  $slug=$this->master_model->create_slug($page_name,'tbl_front_page','page_slug');
						  
							$input_array=array('front_page_name'=>$page_name,'front_page_title'=>$page_title,'front_page_description'=>$page_description,'meta_title'=>$meta_title,'meta_keywords'=>$meta_keyword,'meta_desc'=>$meta_desc,'page_slug'=>$slug);
							
							if($this->master_model->insertRecord('tbl_front_page',$input_array))
							{ 
								$this->session->set_flashdata('success','Pages Added Successfully.');
								redirect(base_url().'superadmin/frontpages/addfrontpage');
							}
							else
							{
								$data['error']='Error while adding Page.';
							}
					}
					else
					{
						$data['error']=$this->form_validation->error_string();
					}
			}
		$data['middle_content']='add-frontpage';
		$this->load->view('admin/common-file',$data);
	}
	
	public function frontstatus($id,$status)
	{
		$input_array = array('front_status'=>$status);
		if($this->master_model->updateRecord('tbl_front_page',$input_array,array('front_id'=>$id)))
		{
	       $this->session->set_flashdata('success','Record(s) status updated successfully.');
		   redirect(base_url().'superadmin/frontpages/managefrontpage/');
		}
		else
		{
		   $this->session->set_flashdata('error','Error while updating status.'); 
		   redirect(base_url().'superadmin/frontpages/managefrontpage');
		}
	}
	
	public function deletefront($front_id)
	{
		if($this->master_model->deleteRecord('tbl_front_page','front_id',$front_id)) 
		{
			$this->session->set_flashdata('success','Record deleted successfully.');
		   	redirect(base_url().'superadmin/frontpages/managefrontpage/');
		}
		else
		{
			$this->session->set_flashdata('error','Error while deleting record.'); 
		   	redirect(base_url().'superadmin/frontpages/managefrontpage');
		}
	}
	
	public function frontupdate($front_id='')
	{
		$data['success']=$data['error']='';
	  	$data['pagetitle']='Update Frontpage';
		
		 //$front_id=$this->uri->segment('4');
		 $front_id = base64_decode($front_id);
		 $data['frontcontent']=$this->master_model->getRecords('tbl_front_page',array('front_id'=>$front_id));
		
			if(isset($_POST['brm_frontpage']))
			{
				  $this->form_validation->set_rules('page_name','Page Name','required|xss_clean|is_unique[tbl_front_page.front_page_name.front_id.'.$front_id.']');
				  $this->form_validation->set_rules('page_title','Page Title','required|xss_clean|is_unique[tbl_front_page.front_page_title.front_id.'.$front_id.']');
				  $this->form_validation->set_rules('meta_title','Meta Title','required|xss_clean');
				  $this->form_validation->set_rules('meta_keyword','Meta Keywords','required|xss_clean');
				  $this->form_validation->set_rules('meta_desc','Meta Description','required|xss_clean');
				  $this->form_validation->set_rules('page_description','Page Description','required');
				  
				  	if($this->form_validation->run())
			  		{
						  $page_name=$this->input->post('page_name',true);
						  $page_title=$this->input->post('page_title',true);
						  $meta_title=$this->input->post('meta_title',true);
						  $meta_keyword=$this->input->post('meta_keyword',true);
						  $meta_desc=$this->input->post('meta_desc',true);
						  $page_description=$this->input->post('page_description');
						  
						  $slug=$this->master_model->create_slug($page_name,'tbl_front_page','page_slug','front_id',$front_id);
						  
							$input_array=array('front_page_name'=>$page_name,'front_page_title'=>$page_title,'front_page_description'=>$page_description,'meta_title'=>$meta_title,'meta_keywords'=>$meta_keyword,'meta_desc'=>$meta_desc,'page_slug'=>$slug);
							
							if($this->master_model->updateRecord('tbl_front_page',$input_array,array('front_id'=>$front_id)))
							{ 
								$this->session->set_flashdata('success','Pages Added Successfully.');
								redirect(base_url().'superadmin/frontpages/frontupdate/'.base64_encode($front_id));
							}
							else
							{
								$data['error']='Error while adding Page.';
							}
					}
					else
					{
						$data['error']=$this->form_validation->error_string();
					}
			}
			
		$data['middle_content']='edit-frontpage';
		$this->load->view('admin/common-file',$data);
	}
}