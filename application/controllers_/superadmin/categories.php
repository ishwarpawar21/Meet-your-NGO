<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Categories extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function category_exists($str,$parent_id)
	{
		$parent_id=explode('*',$parent_id);
		if(count($parent_id)>1 && $parent_id[1]!="")
		{
			$this->db->where('category_id !="'.$parent_id[0].'"',NULL,FALSE);
			$row=$this->master_model->getRecords('tbl_category_master',array('category_name'=>$str,'parent_id'=>$parent_id[1]));
		}
		else
		{
			$this->db->where('parent_id',$parent_id[0]);
			$row=$this->master_model->getRecords('tbl_category_master',array('category_name'=>$str));
		}
		if(count($row)>0)
		{
			$this->form_validation->set_message('category_exists','Category is already exists.');
			return false;
		}
		else
		{return true;}
	}
	/*function to manage categories*/
	public function manage()
	{
		$categories=$this->master_model->get_all_categories(0,FALSE);
		$data=array('pagetitle'=>'Categories','middle_content'=>'manage-categories','categories'=>$categories);
		$this->load->view('admin/common-file',$data);
	}
	
	public function add()
	{
		if(isset($_POST['add_category']))
		{
			$parent_cat=$this->input->post('parent_cat',true);
			$parent=explode(",",$parent_cat);
			$this->form_validation->set_rules('category_name','Category Name','required|xss_clean|callback_category_exists['.$parent[0].']');
			if($this->form_validation->run())
			{
				$category_key=md5(time());
				$category_name=$this->input->post('category_name',true);
				
				if($parent[1]==1){$cat_depth=2;}
				else if($parent[1]==2){$cat_depth=3;}
				else if($parent[1]==0) {$cat_depth=1;}
				$category_slug=$this->master_model->create_slug($category_name,'tbl_category_master','category_name');
				$insrt_arr=array('category_name'=>$category_name,'parent_id'=>$parent[0],'category_level'=>$cat_depth,
				'category_slug'=>$category_slug);
				if($this->master_model->insertRecord('tbl_category_master',$insrt_arr))
				{
					$this->session->set_flashdata('success','Category Added Successfully.');
					redirect(base_url().'superadmin/categories/add');
				}
				else
				{
					$this->session->set_flashdata('error','Error while adding category.');
					redirect(base_url().'superadmin/categories/add');
				}
			}
			else
			{
				$this->session->set_flashdata('error',$this->form_validation->error_string());
				redirect(base_url().'superadmin/categories/add');
			}
		}
		
		$parent=$categories=$this->master_model->get_all_categories(0,3);
		$data=array('pagetitle'=>'Add Category','middle_content'=>'add-category','parent'=>$parent);
		$this->load->view('admin/common-file',$data);
	}
	
	public function edit()
	{
		$category_id=base64_decode($this->uri->segment(4));
		if($this->checkCategoryKey($category_id)==0) 
		{
			redirect(base_url().'superadmin/categories/manage');	
		}
		if(isset($_POST['edit_category']))
		{
			$parent_cat=$this->input->post('parent_cat',true);
			$parent=explode(",",$parent_cat);
			
			$this->form_validation->set_rules('category_name','Category Name','required|xss_clean|callback_category_exists['.$category_id.'*'.$parent[0].']');
			if($this->form_validation->run())
			{
				$category_name=$this->input->post('category_name',true);
				/*$cat_description=$this->input->post('cat_description');
				
				if($parent[1]==1){$cat_depth=2;}
				else if($parent[1]==2){$cat_depth=3;}
				else if($parent[1]==0) {$cat_depth=1;}*/
				$b_array=array('category_name'=>stripslashes($category_name));
		        $this->db->where('category_id <>',$category_id); 
			    $num_row=$this->master_model->getRecords('tbl_category_master',$b_array);
				
				if(count($num_row)==0)
				{
				
				$update_arr=array('category_name'=>$category_name);
				$this->master_model->updateRecord('tbl_category_master',$update_arr,array('category_id'=>"'".$category_id."'"));
				if($this->master_model->updateRecord('tbl_category_master',$update_arr,array('category_id'=>"'".$category_id."'")))
				{
					$this->session->set_flashdata('success','Category Updated Successfully.');
					redirect(base_url().'superadmin/categories/edit/'.base64_encode($category_id).'');
				}
				}
				else
				{
					$this->session->set_flashdata('error','category allready exist.');
					redirect(base_url().'superadmin/categories/edit/'.base64_encode($category_id).'');
				}
			}
			else
			{
				$this->session->set_flashdata('error',$this->form_validation->error_string());
				redirect(base_url().'superadmin/categories/edit/'.base64_encode($category_id));
			}
		}
		
		$parent=$categories=$this->master_model->get_all_categories(0,3);
		$cat_info=$this->master_model->getRecords('tbl_category_master',array('category_id'=>$category_id));
		$data=array('pagetitle'=>'Edit Category','middle_content'=>'edit-category','cat_info'=>$cat_info,'parent'=>$parent);
		$this->load->view('admin/common-file',$data);
	}
	
	public function changestatus()
	{
		$category_id=base64_decode($this->uri->segment(4));
		$status=$this->uri->segment(5);
		//$update_qry='';
		$get_level=$this->master_model->getRecords('tbl_category_master',array('category_id'=>$category_id));
		if($get_level[0]['category_level']=='3')
		{
			$update_qry="UPDATE tbl_category_master SET category_status=".$status." WHERE category_id=".$category_id;
		}
		else if($get_level[0]['category_level']=='2')
		{
			 $update_qry="UPDATE tbl_category_master as cat1 
						 LEFT JOIN tbl_category_master as cat2 ON cat2.parent_id=cat1.category_id
						 SET cat1.category_status='".$status."',cat2.category_status='".$status."' 
						 WHERE cat1.category_id=".$category_id;	 
						
		}
		else if($get_level[0]['category_level']=='1')
		{
		$update_qry="UPDATE tbl_category_master as cat1 
						LEFT JOIN tbl_category_master as cat2 ON cat2.parent_id=cat1.category_id 
						LEFT JOIN tbl_category_master as cat3 ON cat3.parent_id=cat2.category_id
						SET cat1.category_status='".$status."',cat2.category_status='".$status."',cat3.category_status='".$status."' 
						WHERE cat1.category_id=".$category_id;	 
		}
		if($this->db->query($update_qry))
		{
			$this->session->set_flashdata('success','Status updated successfully');
			redirect(base_url().'superadmin/categories/manage');
		}
		else
		{
			$this->session->set_flashdata('error','Error while updating status');
			redirect(base_url().'superadmin/categories/manage');
		}
	}
	
	public function delete()
	{
		$category_id=base64_decode($this->uri->segment(4));
		$get_level=$this->master_model->getRecords('tbl_category_master',array('category_id'=>$category_id));
		if($get_level[0]['category_level']=='3')
		{
			$update_qry="DELETE FROM tbl_category_master WHERE category_id=".$category_id;
		}
		else if($get_level[0]['category_level']=='2')
		{
			$update_qry="DELETE cat1.*,cat2.* 
						 FROM tbl_category_master as cat1 
						 LEFT JOIN tbl_category_master as cat2 ON cat2.parent_id=cat1.category_id 
						 WHERE cat1.category_id=".$category_id;	 
		}
		else if($get_level[0]['category_level']=='1')
		{
			$update_qry="DELETE cat1.*,cat2.*,cat3.* 
						FROM tbl_category_master as cat1 
						LEFT JOIN tbl_category_master as cat2 ON cat2.parent_id=cat1.category_id 
						LEFT JOIN tbl_category_master as cat3 ON cat3.parent_id=cat2.category_id
						WHERE cat1.category_id=".$category_id;	 
		}
		
		/*delete record*/
		if($this->db->query($update_qry))
		{
			$this->session->set_flashdata('success','Record(s) Deleted Successfully');
			redirect(base_url().'superadmin/categories/manage');
		}
		else
		{
			$this->session->set_flashdata('error','Error while deleting record');
			redirect(base_url().'superadmin/categories/manage');
		}
	}
	
	public function multipleaction()
	{
		if(isset($_POST['multicat_del']))
		{
			if(isset($_POST['chkcat']) && count($_POST['chkcat'])>0)
			{
				$cnt=count($_POST['chkcat']);
				for($i=0;$i<$cnt;$i++)
				{
					$get_level=$this->master_model->getRecords('tbl_category_master',array('category_id'=>$_POST['chkcat'][$i]));
					if($get_level[0]['category_level']=='3')
					{
						$delete_qry="DELETE FROM tbl_category_master WHERE category_id=".$_POST['chkcat'][$i];
					}
					else if($get_level[0]['category_level']=='2')
					{
						$delete_qry="DELETE cat1.*,cat2.* 
									 FROM tbl_category_master as cat1 
									 LEFT JOIN tbl_category_master as cat2 ON cat2.parent_id=cat1.category_id 
									 WHERE cat1.category_id=".$_POST['chkcat'][$i];	 
					}
					else if($get_level[0]['category_level']=='1')
					{
						$delete_qry="DELETE cat1.*,cat2.*,cat3.* 
									FROM tbl_category_master as cat1 
									LEFT JOIN tbl_category_master as cat2 ON cat2.parent_id=cat1.category_id 
									LEFT JOIN tbl_category_master as cat3 ON cat3.parent_id=cat2.category_id
									WHERE cat1.category_id=".$_POST['chkcat'][$i];	 
					}
					/*delete record*/
					$this->db->query($delete_qry);
				}
				$this->session->set_flashdata('success','Record(s) Deleted Successfully');
				redirect(base_url().'superadmin/categories/manage');
			}
			else
			{
				$this->session->set_flashdata('error',' Please select record');
				redirect(base_url().'superadmin/categories/manage');
			}
		}
		if(isset($_POST['multicat_block']))
		{
			if(isset($_POST['chkcat']) && count($_POST['chkcat'])>0)
			{
				$count=count($_POST['chkcat']);
				for($i=0;$i<$count;$i++)
				{
					$status='0';
					$get_level=$this->master_model->getRecords('tbl_category_master',array('category_id'=>$_POST['chkcat'][$i]));
					if($get_level[0]['category_level']=='3')
					{
						$update_qry="UPDATE tbl_category_master SET category_status=".$status." WHERE category_id=".$_POST['chkcat'][$i];
					}
					else if($get_level[0]['category_level']=='2')
					{
						 $update_qry="UPDATE tbl_category_master as cat1 
									 LEFT JOIN tbl_category_master as cat2 ON cat2.parent_id=cat1.category_id
									 SET cat1.category_status='".$status."',cat2.category_status='".$status."' 
									 WHERE cat1.category_id=".$_POST['chkcat'][$i];	 
					}
					else if($get_level[0]['category_level']=='1')
					{
						$update_qry="UPDATE tbl_category_master as cat1 
									LEFT JOIN tbl_category_master as cat2 ON cat2.parent_id=cat1.category_id 
									LEFT JOIN tbl_category_master as cat3 ON cat3.parent_id=cat2.category_id
									SET cat1.category_status='".$status."',cat2.category_status='".$status."',cat3.category_status='".$status."' 
									WHERE cat1.category_id=".$_POST['chkcat'][$i];	 
					}
					/*delete record*/
					$this->db->query($update_qry);
				}
				$this->session->set_flashdata('success','Record(s) Updated Successfully');
			redirect(base_url().'superadmin/categories/manage');
			}
			else
			{
				$this->session->set_flashdata('error','Please select record ');
				redirect(base_url().'superadmin/categories/manage');
			}
		}
		if(isset($_POST['multicat_unblock']))
		{
			if(isset($_POST['chkcat']) && count($_POST['chkcat'])>0)
			{
				$count=count($_POST['chkcat']);
				for($i=0;$i<$count;$i++)
				{
					//
					$status='1';
					$get_level=$this->master_model->getRecords('tbl_category_master',array('category_id'=>$_POST['chkcat'][$i]));
					if($get_level[0]['category_level']=='3')
					{
						$update_qry="UPDATE tbl_category_master SET category_status=".$status." WHERE category_id=".$_POST['chkcat'][$i];
					}
					else if($get_level[0]['category_level']=='2')
					{
						 $update_qry="UPDATE tbl_category_master as cat1 
									 LEFT JOIN tbl_category_master as cat2 ON cat2.parent_id=cat1.category_id
									 SET cat1.category_status='".$status."',cat2.category_status='".$status."' 
									 WHERE cat1.category_id=".$_POST['chkcat'][$i];	 
									
					}
					else if($get_level[0]['category_level']=='1')
					{
						$update_qry="UPDATE tbl_category_master as cat1 
									LEFT JOIN tbl_category_master as cat2 ON cat2.parent_id=cat1.category_id 
									LEFT JOIN tbl_category_master as cat3 ON cat3.parent_id=cat2.category_id
									SET cat1.category_status='".$status."',cat2.category_status='".$status."',cat3.category_status='".$status."' 
									WHERE cat1.category_id=".$_POST['chkcat'][$i];	 
					}
					/*delete record*/
					$this->db->query($update_qry);
					//
				}
				$this->session->set_flashdata('success','Record(s) Updated Successfully');
			redirect(base_url().'superadmin/categories/manage');
			}
			else
			{
				$this->session->set_flashdata('error','Please select record ');
				redirect(base_url().'superadmin/categories/manage');
			}
		}
	}
	// Function to check category key
	public function checkCategoryKey($key)
	{
		$res=$this->master_model->getRecordCount('tbl_category_master',array('category_id'=>$key));	
		return $res;
	}
	public function menucategory()
	{
		$category_id=$this->input->post('category_id');
		$category_menu=$this->input->post('category_menu');
		$catcount=$this->master_model->getRecords('tbl_category_master',array('category_menu'=>'1'));
		if(count($catcount)<'5')
		{
			if($this->master_model->updateRecord('tbl_category_master',array('category_menu'=>$category_menu),array('category_id'=>$category_id)))
			{
			   echo 'true';
			}
		}
		else
		{
			if($category_menu=='0')
			{
			  $this->master_model->updateRecord('tbl_category_master',array('category_menu'=>$category_menu),array('category_id'=>$category_id));
			}
			else
			{
			   echo 'limit';
			}
		}
	}
}
?>