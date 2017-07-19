<?php if( !defined('BASEPATH')) exit('No direct script access alloed');

class Master_model extends CI_Model
{
	
	/*
		# function getRecordCount($tbl_name,$condition=FALSE)
		# * indicates paramenter is must
		# Use : 
			1) return number of rows
		# Parameters : 
			$tbl_name* =name of table 
			$condition=array('column_name1'=>$column_val1,'column_name2'=>$column_val2);
		
		# How to call:
			$this->master_model->getRecordCount('tbl_name',$condition_array);
	*/
	public function getRecordSum($tbl_name,$condition=FALSE,$ColumnName)
	{
		$this->db->select_sum($ColumnName);
		if($condition!="" && count($condition)>0)
		{
			foreach($condition as $key=>$val)
			{
				$this->db->where($key,$val);
			}
		}
		$res=$this->db->get($tbl_name);
		$sum = $res->result_array();
		return $sum[0][$ColumnName];
	}
	public function getRecordCount($tbl_name,$condition=FALSE)
	{
		if($condition!="" && count($condition)>0)
		{
			foreach($condition as $key=>$val)
			{
				$this->db->where($key,$val);
			}
		}
		$num=$this->db->count_all_results($tbl_name);
		
		return $num;
	}
	
	/*
		# function getRecords($tbl_name,$condition=FALSE,$select=FALSE,$order_by=FALSE,$limit=FALSE,$start=FALSE)
		# * indicates paramenter is must
		# Use : 
			1) return array of records from table
		# Parameters : 
			1) $tbl_name* =name of table 
			2) $condition=array('column_name1'=>$column_val1,'column_name2'=>$column_val2);
			3) $select=('col1,col2,col3');
			4) $order_by=array('colname1'=>order,'colname2'=>order); Order='ASC OR DESC'
			5) $limit= limit for paging
			6) $start=start for paging
		
		# How to call:
			$this->master_model->getRecords('tbl_name',$condition_array,$select,...);
			
		# In case where we need joins, you can pass joins in controller also.
		Ex: 
			$this->db->join('tbl_nameB','tbl_nameA.col=tbl_nameB.col','left');
			$this->master_model->getRecords('tbl_name',$condition_array,$select,...);
			
		# Instruction 
			1) check number of counts in controller or where you are displying records
			
	*/
	
	public function getRecords($tbl_name,$condition=FALSE,$select=FALSE,$order_by=FALSE,$start=FALSE,$limit=FALSE)
	{
		if($select!="")
		{$this->db->select($select);}
		
		if(count($condition)>0 && $condition!="")
		{
			$condition=$condition;
		}
		else
		{$condition=array();}
		if(count($order_by)>0 && $order_by!="")
		{
			foreach($order_by as $key=>$val)
			{$this->db->order_by($key,$val);}
		}
		if($limit!="" || $start!="")
		{
			$this->db->limit($limit,$start);
		}
		
		$rst=$this->db->get_where($tbl_name,$condition);
		return $rst->result_array();
	}
	public function insertRecord($tbl_name,$data_array,$insert_id=FALSE)
	{
		if($this->db->insert($tbl_name,$data_array))
		{
			if($insert_id==true)
			{return $this->db->insert_id();}
			else
			{return true;}
		}
		else
		{return false;}
	}
	
	public function insertdata($tbl_name,$data_array)
	{
		if($this->db->insert($tbl_name,$data_array))
		{
			return true;
		}
		else
		{return false;}
	}
	
	public function getmaxid($tbl_name,$field_name)
	{
		$row = $this->db->query("SELECT MAX(".$field_name.") AS `maxid` FROM ".$tbl_name."")->row();
							if ($row) 
							{
								return $row->maxid; 
							}else{
								return 1;
								}
	}
	
	public function updatedata($tbl_name,$data_array,$where_id)
	{
		$this->db->where("id",$where_id);
		if($this->db->update($tbl_name,$data_array))
		{return true;}
		else
		{return false;}
	}
	public function deletedata($tbl_name,$pri_col,$id)
	{
		$this->db->where($pri_col,$id);
		if($this->db->delete($tbl_name))
		{return true;}
		else
		{return false;}
	}
	 
	
	/*
		# function updateRecord($tbl_name,$data_array,$pri_col,$id)
		# * indicates paramenter is must
		# Use : 
			1) updates record, on successful updates return true.
		# Parameters : 
			1) $tbl_name* = name of table 
			2) $data_array* = array('column_name1'=>$column_val1,'column_name2'=>$column_val2);
			3) $pri_col* = primary key or column name depending on which update query need to fire.
			4) $id* = primary column or condition column value.

		# How to call:
			$this->master_model->updateRecord('tbl_name',$data_array,$pri_col,$id)
	*/
	public function updateRecord($tbl_name,$data_array,$where_arr)
	{
		$this->db->where($where_arr,NULL,FALSE);
		if($this->db->update($tbl_name,$data_array))
		{return true;}
		else
		{return false;}
	}
	
	
	/*
		# function deleteRecord($tbl_name,$pri_col,$id)
		# * indicates paramenter is must
		# Use : 
			1) delete record from table, on successful deletion returns true.
		# Parameters : 
			1) $tbl_name* = name of table 
			2) $pri_col* = primary key or column name depending on which update query need to fire.
			3) $id* = primary column or condition column value.

		# How to call:
			$this->master_model->deleteRecord('tbl_name','pri_col',$id)
		# It will useful while deleting record from  single table. delete join will not work here.
	*/
	public function deleteRecord($tbl_name,$pri_col,$id)
	{
		$this->db->where($pri_col,$id);
		if($this->db->delete($tbl_name))
		{return true;}
		else
		{return false;}
	}
	
	/* 
		# function createThumb($file_name,$path,$width,$height,$maintain_ratio=FALSE)
		# * indicates paramenter is must
		# Use : 
			1) create thumb of uploaded image.
		# Parameters : 
			1) $file_name* = name of uploaded file 
			2) $path* = path of directory
			3) $width* = width of thumb
			4) $height* = height of thumb
			5) $maintain_ratio = if need to maintain ration of original image then pass true, in this case thumb may vary in
								height and width provided. default it is FALSE.

		# How to call:
			$this->master_model->createThumb($file_name,$path,$width,$height,$maintain_ratio=FALSE)
			
		# !!Important : thumb foler  name must be 'thumb'
	*/
	public function createThumb($file_name,$path,$width,$height,$maintain_ratio=FALSE)
	{
		$config_1['image_library']='gd2';
		$config_1['source_image']=$path.$file_name;		
		$config_1['create_thumb']=TRUE;
		$config_1['maintain_ratio']=$maintain_ratio;
		$config_1['thumb_marker']='';
		$config_1['new_image']=$path."thumb/".$file_name;
		$config_1['width']=$width;
		$config_1['height']=$height;
		$this->load->library('image_lib',$config_1);	
		$this->image_lib->initialize($config_1);
		$this->image_lib->resize();
		
		if(!$this->image_lib->resize())
		echo $this->image_lib->display_errors();
		
	}
	
	/* create slug */
	function create_slug($phrase,$tbl_name,$title_col,$pri_col='',$id='',$maxLength=100000000000000)
	{
		$result = strtolower($phrase);
		$result = preg_replace("/[^A-Za-z0-9\s-._\/]/", "", $result);
		$result = trim(preg_replace("/[\s-]+/", " ", $result));
		$result = trim(substr($result, 0, $maxLength));
		$result = preg_replace("/\s/", "-", $result);
		$slug=$result;
		if($id!="")
		{
			$this->db->where($pri_col.' !=' ,$id);
		}
		$rst=$this->db->get_where($tbl_name,array($title_col=>$slug));
		
		if($rst->num_rows() > 0)
		{
			$count=$rst->num_rows()+1;
			return $slug=$slug.$count;
		}
		else
		{return $slug;}
	}
	
	public function video_image($url)
	{
		$image_url = parse_url($url);
		if($image_url['host'] == 'www.youtube.com' || $image_url['host'] == 'youtube.com'){
		$array = explode("&", $image_url['query']);
		return "http://img.youtube.com/vi/".substr($array[0], 2)."/0.jpg";
		} else if($image_url['host'] == 'www.vimeo.com' || $image_url['host'] == 'vimeo.com'){
		$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".substr($image_url['path'], 1).".php"));
		return $hash[0]["thumbnail_large"];
		}
	}
	
	public function image_upload($file_name,$deal_id,$type,$config)
	{ 
		$this->load->library('upload');
		$this->upload->initialize($config);
	
		if($this->upload->do_upload('product_image'))
		{ 
			$dt=$this->upload->data();
			$config_1['image_library']='gd2';
			$config_1['source_image']="uploads/deal/".$dt['file_name'];
			$config_1['new_image']="uploads/deal/thumb/".$dt['file_name'];
			$config_1['thumb_marker']='';
			$config_1['create_thumb'] = TRUE;
			$config_1['maintain_ratio'] = FALSE;
			$config_1['width'] = 680;
			$config_1['height'] = 368;
			$this->load->library('image_lib', $config_1);
			$this->image_lib->initialize($config_1);
			$this->image_lib->resize();	
			
			$qry=array('deal_id'=>$deal_id,'image_name'=>$dt['file_name']);
			if($this->db->insert('tbl_deal_images',$qry))
			{ return true;}
			else
			{return false;
			}
		}
		else
		{
			print_r($this->upload->display_errors());	exit;
		}
	}
	public function get_all_categories($parent,$level=FALSE)
	{
		global $master_category;
		if($level!="")
		{$this->db->where('category_level != '.$level.'',NULL,FALSE);}
		$this->db->where('parent_id',$parent);
		$this->db->order_by('category_name');
		$rst=$this->db->get('tbl_category_master');
		if($rst->num_rows() >0)
		{
			$row=$rst->result();
			foreach($row as $row)
			{
				$master_category[$row->category_id]=$row;
				$this->get_all_categories($row->category_id,$level);
			}
		}
		return $master_category;
	}
	public function jQuerypagination_countriesdata($id,$per_page,$offset) {    
			$sdata = array();
			 $this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_coupon_comments.login_id');
			$this->db->select('*')->from('tbl_coupon_comments')->where('couponid',$id)->order_by('posted_date','DESC');        
			$this->db->limit($per_page,$offset);
			$query_result = $this->db->get();
			//echo $this->db->last_query(); // shows last executed query
			
			if($query_result->num_rows() > 0) {
				foreach ($query_result->result_array() as $row)
				{
					$sdata[] = array('login_id' => $row['login_id'],'user_slug' => $row['user_slug'],'user_type' => $row['user_type'],'comments' => $row['comments'],'posted_date' => $row['posted_date']);
				}            
			}
			return $sdata;
		}
	
	/*Pagination code for Community start*/	
	public function jQuerypagination_communitydata($per_page,$offset) {    
			$sdata = array();
			$this->db->select('*')->from('tbl_login_master')->where('user_status','1')->order_by('user_slug');        
			$this->db->limit($per_page,$offset);
			$query_result = $this->db->get();
			//echo $this->db->last_query(); // shows last executed query
			if($query_result->num_rows() > 0) 
			{
				foreach ($query_result->result_array() as $row)
				{
					$sdata[] = array('login_id' => $row['login_id'],'user_slug' => $row['user_slug'],'user_type' => $row['user_type']);
				}            
			}
			return $sdata;
		}	
	/*Pagination code for Community End*/	
}
?>