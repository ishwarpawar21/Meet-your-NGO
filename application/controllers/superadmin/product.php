<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product extends CI_Controller {
    public function __construct()
    {
	   parent::__construct();
	   $this->load->library('upload');  
	   if( ! ini_get('date.timezone') )
		{
		   date_default_timezone_set('GMT');
		} 

	}
	// functio :Manage Product
     // developer : yogesh
	public function manage()
	{
		$data['success']=$data['error']='';
		$data['pagetitle']='Manage Product';
		$this->db->order_by('product_id','DESC');
		$data['fetch_manage_product']=$this->master_model->getRecords('tbl_product','','');
		$data['middle_content']='manage-product';
		$this->load->view('admin/common-file',$data);
	}
	//function :Block single Product
	//developer : yogesh
	public function status($product_id,$status)
	{
      $product_id= base64_decode($product_id);
	  $data['success']=$data['error']='';
	  $input_array = array('product_status'=>$status);
	  if($this->master_model->updateRecord('tbl_product',$input_array,array('product_id'=>$product_id)))
	  {
		 $this->session->set_flashdata('success','Record status change successfully.');
		 redirect(base_url().'superadmin/product/manage/');
	  }
	  else
	  {
		 $this->session->set_flashdata('error','Error while updating status.'); 
		 redirect(base_url().'superadmin/product/manage/');
	  }
  }
	// function :Delete Single Product
	// developer :Yogesh
	public function delete($product_id='',$product_image='')
	{
		$data['success']=$data['error']='';
		$product_id= base64_decode($product_id);
		$product_image= base64_decode($product_image);
		if($this->master_model->deleteRecord('tbl_product','product_id',$product_id))
		{
			@unlink('uploads/product_image/'.$product_image);
			@unlink('uploads/product_image/thumb/'.$product_image);
			$this->session->set_flashdata('success','Record deleted successfully.');
		   	redirect(base_url().'superadmin/product/manage/');
		}
		else
		{
			$this->session->set_flashdata('error','Error while deleting record.'); 
		   	redirect(base_url().'superadmin/product/manage/');
		}
	}
	//function :multiple delete block unblock
	//developer: Yogesh
	public function multipleaction()
	{
		$data['success']=$data['error']='';
		if(isset($_REQUEST['checkbox_del'])!="")
		{
		   $checkbox_del_count = count($_POST['checkbox_del']);
		   if(isset($_POST['status_chck']) && $_POST['status_chck']=='3')
		   {
			  	   for($i=0;$i<$checkbox_del_count;$i++)
				   {
						$unlik_image=$this->master_model->getRecords('tbl_product',array('tbl_product.product_id'=>$_REQUEST['checkbox_del'][$i]),'product_image');
						if($this->master_model->deleteRecord('tbl_product','product_id',$_REQUEST['checkbox_del'][$i]))
						{
						  @unlink('uploads/product_image/'.$unlik_image[0]['product_image']);
						  @unlink('uploads/product_image/thumb/'.$unlik_image[0]['product_image']);
						}
				   }
				   $this->session->set_flashdata('success',"Records deleted successfully.");	
				   redirect(base_url().'superadmin/product/manage/');
		   }
		   if(isset($_POST['status_chck']) && $_POST['status_chck']=='1')
		   {
			 	 $input_array = array('product_status '=>'1');
				 for($i=0;$i<$checkbox_del_count;$i++)
				 {
					 $this->master_model->updateRecord('tbl_product',$input_array,array('product_id'=>$_REQUEST['checkbox_del'][$i]));
				 }
				 $this->session->set_flashdata('success','Records status change successfully.');
				 redirect(base_url().'superadmin/product/manage/');
		   }
		   if(isset($_POST['status_chck']) && $_POST['status_chck']=='2')
		   {
				 $input_array = array('product_status '=>'0');
				 for($i=0;$i<$checkbox_del_count;$i++)
				 {
					 $this->master_model->updateRecord('tbl_product',$input_array,array('product_id'=>$_REQUEST['checkbox_del'][$i]));
				 }
				 $this->session->set_flashdata('success','Records status change successfully.');
				 redirect(base_url().'superadmin/product/manage/');
			}
		}
	}
   //function :Update Product
   //developer: Yogesh
	public function add()
	{
	$data['error']=$data['success']=$data['upload_error']='';
	$data['pagetitle']='Add Product';
	if(isset($_POST['btn_add_product']))
	{ 
	   $this->form_validation->set_rules('product_title','Title','required');
	   $this->form_validation->set_rules('product_desc','Description','required');
	   $this->form_validation->set_rules('product_point','Point','required|xss_clean');
	   
		if($this->form_validation->run())
		{
		 $product_title=$this->input->post('product_title',true);
		 $product_desc=$this->input->post('product_desc');
		 $product_point=$this->input->post('product_point');
		 //$old_image=$this->input->post('old_image');
		 $config=array('upload_path'=>'uploads/product_image/',
					   'allowed_types'=>'jpg|jpeg|gif|png',
					   'file_name'=>rand(1,9999),'max_size'=>0
					   );
		 $this->upload->initialize($config);
		   if(count($_FILES)>0)
		   {     
			   if($_FILES['product_image']['name']!='')
			   {
				 if($this->upload->do_upload('product_image'))
				 {		 
					//@unlink('uploads/product_image/'.$old_image);
					//@unlink('uploads/product_image/thumb/'.$old_image);
					$dt=$this->upload->data();
					$file=$dt['file_name'];
					$this->master_model->createThumb($file,'uploads/product_image/',161,87,TRUE);
				  }
				   else
				   {
					   $this->upload->display_errors();
					   $file='';
				   }
				}
		  }
		 if($file!='')
		 { 
				   $product_array=array('product_title'=>addslashes($product_title),'product_desc'=>$product_desc,'product_point'=>$product_point,'product_image'=>$file,'product_add_date'=>date('Y-m-d'));
				   if($this->master_model->insertRecord('tbl_product',$product_array))
				   {
						 $this->session->set_flashdata('success',"Record updated successfully.");	
						 redirect(base_url().'superadmin/product/manage/');
				   }
		}
		else
		{
				   $data['upload_error']='The file type you are attempting to upload is not allowed.';
		}
	}
	}
	$data['middle_content']='add-product';
	$this->load->view('admin/common-file',$data);
		                                
   }	
   //function :Update Product
   //developer: Yogesh
	public function update($product_id='')
	{
	$product_id= base64_decode($product_id);
	$data['error']=$data['success']=$data['upload_error']='';
	//$data['wrong_startdate']=$data['wrong_enddate']='';
	$data['pagetitle']='Update Product';
	if($product_id!='' && is_numeric($product_id))
	{
			if(isset($_POST['btn_update_product']))
			{ 
			   $this->form_validation->set_rules('product_title','Title','required');
			   $this->form_validation->set_rules('product_desc','Description','required');
			   $this->form_validation->set_rules('product_point','Point','required|xss_clean');
			   
				if($this->form_validation->run())
				{
				 $product_title=$this->input->post('product_title',true);
				 $product_desc=$this->input->post('product_desc');
				 $product_point=$this->input->post('product_point');
				 $old_image=$this->input->post('old_image');
				 $config=array('upload_path'=>'uploads/product_image/',
							   'allowed_types'=>'jpg|jpeg|gif|png',
							   'file_name'=>rand(1,9999),'max_size'=>0
							   );
				 $this->upload->initialize($config);
				   if(count($_FILES)>0)
				   {     
					   if($_FILES['product_image']['name']!='')
					   {
						 if($this->upload->do_upload('product_image'))
						 {		 
							@unlink('uploads/product_image/'.$old_image);
							@unlink('uploads/product_image/thumb/'.$old_image);
							$dt=$this->upload->data();
							$file=$dt['file_name'];
							$this->master_model->createThumb($file,'uploads/product_image/',161,87,TRUE);
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
					       $product_array=array('product_title'=>addslashes($product_title),'product_desc'=>$product_desc,'product_point'=>$product_point,'product_image'=>$file);
						   if($this->master_model->updateRecord('tbl_product',$product_array,array('product_id'=>$product_id)))
						   {
								 $this->session->set_flashdata('success',"Record updated successfully.");	
								 redirect(base_url().'superadmin/product/update/'.base64_encode($product_id).'');
						   }
						}
					else
					{
							   $data['upload_error']='The file type you are attempting to upload is not allowed.';
					}
			}
			}
			$data['fetch_product']=$this->master_model->getRecords('tbl_product',array('tbl_product.product_id'=>$product_id));
			$data['middle_content']='update-product';
			$this->load->view('admin/common-file',$data);
		}                                
	else
	{
			$this->load->view('oops');
	}
   }
   public function purchased()
   {
		$data['success']=$data['error']='';
		$data['pagetitle']='Manage Purchased Product';
		$this->db->order_by('purchase_id','DESC');
		$this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_purchase_point.purchase_login_id');
		$data['fetch_purchased_product']=$this->master_model->getRecords('tbl_purchase_point','',
		'purchase_id,purchase_point,purchase_date,status,email_id,user_slug');
		$data['middle_content']='purchased_product';
		$this->load->view('admin/common-file',$data);	   
   }
   public function change_status()
   {
	   $status=$this->input->post('status');
	   $purchased_id=$this->input->post('purchased_id');
	   if($status=='Cancel')
	   {
		   $up_array=array('status'=>$status);
	   }
	   else
	   {
		    $up_array=array('status'=>$status);
	   }
	   $statusUpdate=$this->master_model->updateRecord('tbl_purchase_point',$up_array,array('purchase_id'=>$purchased_id));
	   if($statusUpdate)
	   {
		 echo 'done';
	   }
	   else
	   {
	 	 echo 'error';
	   }
   }
}