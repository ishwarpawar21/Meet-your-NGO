<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product extends CI_Controller {
    public function __construct()
    {
	   parent::__construct();
	}
   public function index()
   {
	    $login_id = $this->session->userdata('login_id');
	    $this->db->select('profilepic');
	    $data['seldetail']=$this->master_model->getRecords('tbl_seller_details',array('tbl_seller_details.loginid'=>$login_id));
	    $data['page_title']='Product';
		$this->db->order_by('user_slug');
		$data['communityMembers']=$this->master_model->getRecords('tbl_login_master');
		$productCnt=$this->master_model->getRecordCount('tbl_product',array('product_status'=>'1'));
		
	    $_output = $this->commonPagiantion($this->uri->segment(3),base_url().'product/page/',$productCnt,3);
	    $data['links']=$_output['page_links'];
		$data['productList']=$this->master_model->getRecords('tbl_product',array('product_status'=>'1'),'','',$_output['offset'],$_output['per_page']
);

		
		$data['middle_content']='product_list';  
	    $this->load->view('templete',$data); 
   }
    public function page()
   {
	    $login_id = $this->session->userdata('login_id');
	    $this->db->select('profilepic');
	    $data['seldetail']=$this->master_model->getRecords('tbl_seller_details',array('tbl_seller_details.loginid'=>$login_id));
		
		
	    $data['page_title']='Product';
		$this->db->order_by('user_slug');
		$data['communityMembers']=$this->master_model->getRecords('tbl_login_master');
		$productCnt=$this->master_model->getRecordCount('tbl_product',array('product_status'=>'1'));
		
	    $_output = $this->commonPagiantion($this->uri->segment(3),base_url().'product/page/',$productCnt);
	    $data['links']=$_output['page_links'];
		$data['productList']=$this->master_model->getRecords('tbl_product',array('product_status'=>'1'),'','',$_output['offset'],$_output['per_page']
);
		
		$data['middle_content']='product_list';  
	    $this->load->view('templete',$data); 
   }
   public function addpoint()
   {
	  $purchase_point    = $this->input->post('purchase_point');
	  $purchase_login_id = $this->session->userdata('login_id'); 
	  $product_id        = $this->input->post('product_id');
	  $num_of_record=$this->master_model->getRecordCount('tbl_purchase_point',array('purchase_login_id'=>$purchase_login_id,
	  'product_id'=>$product_id,'purchase_date'=>date('Y-m-d')));
	  if($num_of_record==0)
	  {
	 	 $ProductInsert=$this->master_model->insertRecord('tbl_purchase_point',array('purchase_point'=>$purchase_point,'purchase_login_id'=>$purchase_login_id,'product_id'=>$product_id,'purchase_date'=>date('Y-m-d')));
	  }
	  if($ProductInsert)
	  {
		 echo 'done';
	  }
	  else
	  {
		 echo 'error';
	  }
   }
   /*My product page start*/
   public function myproduct($type='')
   {
	    if($type=='')
	    {
		   $type='Approved';
	    }
	    $login_id=$this->session->userdata('login_id');
		$data['page_title']='My Product';
		$this->db->select('profilepic');
	  	$data['seldetail']=$this->master_model->getRecords('tbl_seller_details',array('tbl_seller_details.loginid'=>$login_id));
		$this->db->join('tbl_purchase_point','tbl_purchase_point.product_id=tbl_product.product_id');
		$this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_purchase_point.purchase_login_id');
		$productCnt=$this->master_model->getRecordCount('tbl_product',array('tbl_product.product_status'=>'1','tbl_purchase_point.purchase_login_id'=>$login_id,'tbl_purchase_point.status'=>$type));
		$_output = $this->commonPagiantion($this->uri->segment(4),base_url().'product/myproduct/'.$type.'/',$productCnt,4);
	    $data['links']=$_output['page_links'];
		$this->db->join('tbl_purchase_point','tbl_purchase_point.product_id=tbl_product.product_id');
		$this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_purchase_point.purchase_login_id');
		$data['productList']=$this->master_model->getRecords('tbl_product',array('tbl_product.product_status'=>'1','tbl_purchase_point.purchase_login_id'=>$login_id,'tbl_purchase_point.status'=>$type),'','',$_output['offset'],$_output['per_page']);
		$data['middle_content']='my_product_list';  
	    $this->load->view('templete',$data); 
   }
   public function commonPagiantion($segmnetUri,$baseUrl,$totalRec,$configuri)
	{
		$resp = array();
		$page_number = $segmnetUri;
		$page_url = $config['base_url'] = $baseUrl;
		$config['uri_segment'] = $configuri;        
				
		$config['per_page'] = 10;
		$resp['per_page'] = 10 ;
		$config['num_links'] = 3;
		if(empty($page_number)) $page_number = 1;
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
   
   
   /*My product page End*/
}