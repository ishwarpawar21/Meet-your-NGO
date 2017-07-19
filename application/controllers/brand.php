<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Brand extends CI_Controller {
    public function __construct()
    {
	   parent::__construct();
	   $this->load->library('upload');
	   $this->load->library('aws_signed_request');
	   $this->load->library('simple_html_dom');  
	   $this->load->library('pagination');
	}
	public function allbrand($slug='',$search='filter',$searchdate='')
	{
	  
	  $data['brandinfo']=$this->master_model->getRecords('tbl_brand_master',array('tbl_brand_master.brand_slug'=>$slug));
	  if(count($data['brandinfo'])>0)
	  {
	  /*pagingnation*/
	  if($search!='all')
	  {
		  if($search!='all' && $search=='higher-lower-price' && $search!='date')
		  {$this->db->order_by('tbl_coupon_master.order_by_price','DESC');}
		  else if($search!='all' && $search=='lower-higher-price' && $search!='date')
		  {$this->db->order_by('tbl_coupon_master.order_by_price','ASC');}
		  else if($search!='all' && $search=='higher-lower-review' && $search!='date')
		  {$this->db->order_by('tbl_coupon_master.product_reviews_digit','DESC');}
		  else if($search!='all' && $search=='lower-higher-review' && $search!='date')
		  {$this->db->order_by('tbl_coupon_master.product_reviews_digit','ASC');}
		  else if($search=='date')
		  {$this->db->where('tbl_coupon_master.coupon_expirydate',$searchdate);}
		  else if($search=='hot-coupon')
	      {$this->db->join('tbl_userscored_point','tbl_userscored_point.coupon_id=tbl_coupon_master.coupon_id');
	      $this->db->where('tbl_userscored_point.point_type','fb_share');}
		  else if($search=='latest')
		  {$this->db->where('tbl_coupon_master.coupon_insertdate >= DATE_SUB(CURDATE(),INTERVAL 3 DAY)');}
	  }
	  $this->db->join('tbl_brand_master','tbl_brand_master.brand_id=tbl_coupon_master.coupon_brand_id');	
	  $this->db->where('tbl_coupon_master.coupon_expirydate >=',date('Y-m-d'));  
	  $data['productcoupon']=$this->master_model->getRecords('tbl_coupon_master',array('coupon_status'=>'1','coupon_brand_id'=>$data['brandinfo'][0]['brand_id']));	
	  $config['total_rows']=count($data['productcoupon']);
	  $config['per_page'] =10;
	   if($search!='filter')
	   {
		 if($search=='date')
		 {
			 $config['uri_segment']=5;
			 $page_link = ($this->uri->segment(5)) ? $this->uri->segment(5) : 1;
			 if(empty($page_link)) $page_link = 1;
			 $page = ($page_link-1) * $config['per_page'];
		     $config['base_url']=base_url().'brand/'.$slug.'/'.$search.'/'.$searchdate.'/';
			 $page_url = $config['base_url']; 
		 }
		 else
		 {
			 $config['uri_segment']=4;
			 $page_link = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
			 if(empty($page_link)) $page_link = 1;
			 $page = ($page_link-1) * $config['per_page'];
			 $config['base_url']=base_url().'brand/'.$slug.'/'.$search.'/';
			 $page_url = $config['base_url'];
		 }
	  }
	  else
	  {
	    $config['uri_segment']=4;
		$page_link = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
		if(empty($page_link)) $page_link = 1;
	    $page = ($page_link-1) * $config['per_page'];
		$config['base_url']=base_url().'brand/'.$slug.'/'.$search.'/';
		$page_url = $config['base_url'];	  
	  }
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
	  if($search!='all')
	  {
		  if($search!='all' && $search=='higher-lower-price' && $search!='date')
		  {$this->db->order_by('tbl_coupon_master.order_by_price','DESC');}
		  else if($search!='all' && $search=='lower-higher-price' && $search!='date')
		  {$this->db->order_by('tbl_coupon_master.order_by_price','ASC');}
		  else if($search!='all' && $search=='higher-lower-review' && $search!='date')
		  {$this->db->order_by('tbl_coupon_master.product_reviews_digit','DESC');}
		  else if($search!='all' && $search=='lower-higher-review' && $search!='date')
		  {$this->db->order_by('tbl_coupon_master.product_reviews_digit','ASC');}
		  else if($search=='date')
	      {$this->db->where('tbl_coupon_master.coupon_expirydate',$searchdate);}
		  else if($search=='hot-coupon')
	      {$this->db->join('tbl_userscored_point','tbl_userscored_point.coupon_id=tbl_coupon_master.coupon_id');
	      $this->db->where('tbl_userscored_point.point_type','fb_share');}
		  else if($search=='latest')
		  {$this->db->where('tbl_coupon_master.coupon_insertdate >= DATE_SUB(CURDATE(),INTERVAL 3 DAY)');}
	  }
	  $this->db->join('tbl_brand_master','tbl_brand_master.brand_id=tbl_coupon_master.coupon_brand_id');	  
	  $this->db->where('tbl_coupon_master.coupon_expirydate >=',date('Y-m-d')); 
	  $data['product_coupon']=$this->master_model->getRecords('tbl_coupon_master',array('coupon_status'=>'1','coupon_brand_id'=>$data['brandinfo'][0]['brand_id']),'','',$page,$config['per_page']);	
	  $data['links']=$this->pagination->create_links();
	  $data['coupon_count']=$this->master_model->getRecordCount('tbl_coupon_master',array('coupon_status'=>'1'));	
	  $data['category']=$this->master_model->getRecords('tbl_category_master',array('category_status'=>'1'));
	  $data['page_title']='Brand';
	  $data['middle_content']='brand_coupon';
	  $this->load->view('templete',$data);
	  }
	  else
	  {
		 $this->load->view('admin/404');
	  }
	}
}