<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blogs extends CI_Controller {
    public function __construct()
    {
	   parent::__construct();
	   $this->load->library('upload');  
	}
	//----------Manage Blogs
	public function manageblogs()
	{
	  $data['pagetitle']='Manage Blogs';
	  if(isset($_POST['multiple_delete']))
	  {
			if(isset($_POST['checkbox_del']))
			{
				if(count($_POST['checkbox_del'])!= 0)
				{
					$cnt_checkbox_del=count($_POST['checkbox_del']); 
					for($i=0;$i<$cnt_checkbox_del;$i++)
					{
						$blog_info=$this->master_model->getRecords('tbl_blog_master',array('blog_id'=>$_POST['checkbox_del'][$i]));
						$this->master_model->deleteRecord('tbl_blog_master','blog_id',$_POST['checkbox_del'][$i]);
						
						@unlink('uploads/blog_image/'.$blog_info[0]['blog_image']);
						@unlink('uploads/blog_image/thumb/'.$blog_info[0]['blog_image']);
					}
					$this->session->set_flashdata('success','Record(s) delete Successfully.');
					redirect(base_url().'superadmin/blogs/manageblogs/');
				}
				else
				{
					$this->session->set_flashdata('error','Select Record(s) to delete.');
					redirect(base_url().'superadmin/blogs/manageblogs/');
				}
			}
			else
			{
				$this->session->set_flashdata('error','Select Record(s) to delete.');
				redirect(base_url().'superadmin/blogs/manageblogs/');
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
						$this->master_model->updateRecord('tbl_blog_master',array('blog_status'=>$stat),array('blog_id'=>$_POST['checkbox_del'][$i]));
					}
					$this->session->set_flashdata('success','Record(s) status updated successfully.');
					redirect(base_url().'superadmin/blogs/manageblogs/');
				}
				else
				{
					$this->session->set_flashdata('error','Select record(s) to block.');
					redirect(base_url().'superadmin/blogs/manageblogs/');
				}
			}
			else
			{
				$this->session->set_flashdata('error','Select record(s) to block.');
				redirect(base_url().'superadmin/blogs/manageblogs/');
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
						$this->master_model->updateRecord('tbl_blog_master',array('blog_status'=>$stat),array('blog_id'=>$_POST['checkbox_del'][$i]));
					}
					$this->session->set_flashdata('success','Record(s) status updated successfully.');
					redirect(base_url().'superadmin/blogs/manageblogs/');
				}
				else
				{
					$this->session->set_flashdata('error','Select record(s) to unblock.');
					redirect(base_url().'superadmin/blogs/manageblogs/');
				}
			}
			else
			{
				$this->session->set_flashdata('error','Select record(s) to unblock.');
				redirect(base_url().'superadmin/blogs/manageblogs/');
			}
		}
	  
	  $data['blogs']=$this->master_model->getRecords('tbl_blog_master');
	  $data['middle_content']='manage-blogs';
	  $this->load->view('admin/common-file',$data);
	}
	//-----------------add blog
	public function addblogs()
	{
		$data['success']=$data['error']='';
		$data['pagetitle']='Add Blogs';
		$file_name="";
		if(isset($_POST['btn_add_blogs']))
		{ 
			$this->form_validation->set_rules('blog_name','Blog Title','required|xss_clean');
			$this->form_validation->set_rules('blog_desc','Blog Description','required|xss_clean');
			if($this->form_validation->run())
			{ 
				$blog_name=$this->input->post('blog_name',true);
				$blog_desc=$this->input->post('blog_desc',true);
				
					if($_FILES['blog_logo']['name']!="" && $_FILES['blog_logo']['error']==0)
					{
						$logo_config=array('file_name'=>uniqid(),
										'allowed_types'=>'jpg|jpeg|gif|png',
										'upload_path'=>'uploads/blog_image/');
						$this->upload->initialize($logo_config);
						if($this->upload->do_upload('blog_logo'))
						{ 
							$upload_data=$this->upload->data();
							$file_name=$upload_data['file_name'];
							$this->master_model->createThumb($file_name,'uploads/blog_image/',120,120);
						}
					}
					
					$input_data=array('blog_title'=>$blog_name,
				'blog_desc'=>$blog_desc,'blog_image'=>$file_name,
				'blog_date'=>date('Y-m-d'));
					
					if($this->master_model->insertRecord('tbl_blog_master',$input_data))
					{
						$this->session->set_flashdata('success','Recored added Successfully.');
						redirect(base_url().'superadmin/blogs/manageblogs/');
					}
			}
			else
			{
				$this->session->set_flashdata('error','Error while adding Blog');
				redirect(base_url().'superadmin/blogs/manageblogs/');
			}
		}
		  $data['middle_content']='add-blogs';
		  $this->load->view('admin/common-file',$data);
	}
	//----------------update blog
	public function updateblog()
	{
		$blog_id=$this->uri->segment(4);
		$data['success']=$data['error']='';
		$data['pagetitle']='Update Blogs';
		$file_name="";
		if(isset($_POST['btn_update_blogs']))
		{ 
			$this->form_validation->set_rules('blog_name','Blog Title English','required|xss_clean');
			$this->form_validation->set_rules('blog_desc','Blog Description English','required|xss_clean');
			if($this->form_validation->run())
			{ 
				$blog_name=$this->input->post('blog_name',true);
				$blog_desc=$this->input->post('blog_desc',true);
				$old_logo=$this->input->post('old_logo',true);
				
				if($_FILES['blog_logo']['name']!="" && $_FILES['blog_logo']['error']==0)
				{
					$logo_config=array('file_name'=>uniqid(),
									'allowed_types'=>'jpg|jpeg|gif|png',
									'upload_path'=>'uploads/blog_image/');
					$this->upload->initialize($logo_config);
					if($this->upload->do_upload('blog_logo'))
					{ 
						$upload_data=$this->upload->data();
						$file_name=$upload_data['file_name'];
						$this->master_model->createThumb($file_name,'uploads/blog_image/',120,120);
						if($old_logo!="")
						{
							@unlink('uploads/blog_logo/'.$old_logo);
							@unlink('uploads/blog_logo/thumb/'.$old_logo);
						}
					}
				}
				else
				{$file_name=$old_logo;}
				
				$update_arr=array('blog_title'=>$blog_name,
				'blog_desc'=>$blog_desc,'blog_image'=>$file_name,
				'blog_date'=>date('Y-m-d'));
					
				if($this->master_model->updateRecord('tbl_blog_master',$update_arr,array('blog_id'=>$blog_id)))
				{
					$this->session->set_flashdata('success','Recored updates Successfully.');
					redirect(base_url().'superadmin/blogs/manageblogs/');
				}
			}
			else
			{
				$this->session->set_flashdata('error','Error while updating Blog');
				redirect(base_url().'superadmin/blogs/manageblogs/');
			}
		}
		  
	  $data['blogs']=$this->master_model->getRecords('tbl_blog_master',array('blog_id'=>$blog_id));
	  $data['middle_content']='update-blogs';
	  $this->load->view('admin/common-file',$data);
	}
	//---------------------change status
	public function chantgestatusblogs()
	{
		$data['success']=$data['error']='';
		$sts=$this->uri->segment(4);
		$blog_id=$this->uri->segment(5);
		
		$input_array = array('blog_status'=>$sts);
		if($this->master_model->updateRecord('tbl_blog_master',$input_array,array('blog_id'=>$blog_id)))
		{
	       $this->session->set_flashdata('success','Record status updated successfully.');
		   redirect(base_url().'superadmin/blogs/manageblogs/');
		}
		else
		{
		   $this->session->set_flashdata('error','Error while updating status.'); 
		   redirect(base_url().'superadmin/blogs/manageblogs/');
		}
	}
	//---------------------delete status
	public function deleteblogs($category_id)
	{
		$data['success']=$data['error']='';
	  	$blog_id=$this->uri->segment(4);
	  	$blog_info=$this->master_model->getRecords('tbl_blog_master',array('blog_id'=>$blog_id));
		if($this->master_model->deleteRecord('tbl_blog_master','blog_id',$blog_id)) 
	  	{
		  @unlink('uploads/blog_image/'.$blog_info[0]['blog_image']);
		  @unlink('uploads/blog_image/thumb/'.$blog_info[0]['blog_image']);
		  $this->session->set_flashdata('success','Record deleted successfully.');
		  redirect(base_url().'superadmin/blogs/manageblogs/');
 	    }
	 	else
	  	{
		  $this->session->set_flashdata('error','Error while deleting Record.'); 
		  redirect(base_url().'superadmin/blogs/manageblogs/');
	    }
	}
	
}