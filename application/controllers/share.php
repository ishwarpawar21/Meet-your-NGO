<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'libraries/facebook/facebook.php';
class Share extends CI_Controller {
    public function __construct()
    {
	   parent::__construct();
	   $this->config->load('facebook'); 	  
	   if(!ini_get('date.timezone') )
	   {date_default_timezone_set('GMT');} 
	}
	public function coupon()
	{
		if(isset($_COOKIE['selectedCoupon']))
		{ $couponId =$_COOKIE['selectedCoupon']; }
		else
		{$couponId = 0 ;}
		  $this->db->select('tbl_coupon_master.*,tbl_brand_master.*');
		  $this->db->join('tbl_brand_master','tbl_brand_master.brand_id=tbl_coupon_master.coupon_brand_id');
		  $data['productCoupon']=$this->master_model->getRecords('tbl_coupon_master',array('tbl_coupon_master.coupon_id'=>$couponId));
		  if(count($data['productCoupon'])>0)
		  {
			  $data['page_title']='Share Coupon';
			  $data['middle_content']='sharer';
		  }
		  else
		  {
			  $data['page_title']='Something went wrong.';
			  $data['middle_content']='admin/404';
		  }
		  $this->load->view('templete',$data);
		  
	}
	public function details()
	{
		  $couponId =$this->uri->segment(3);
		  $this->db->select('tbl_coupon_master.*,tbl_brand_master.*');
		  $this->db->join('tbl_brand_master','tbl_brand_master.brand_id=tbl_coupon_master.coupon_brand_id');
		  $data['productCoupon']=$this->master_model->getRecords('tbl_coupon_master',array('tbl_coupon_master.coupon_id'=>$couponId));
		  if(count($data['productCoupon'])>0)
		  {
			  $pos = strpos($data['productCoupon'][0]['coupon_discount'],'%');
			  if($pos == false)
			  { $_Prefix= '$'.number_format($data['productCoupon'][0]['coupon_discount'],2).' off'; }
			  else
			  { $_Prefix=$data['productCoupon'][0]['coupon_discount'].' off'; }
			  $pageTitle ='Get '.$_Prefix.' on '.$data['productCoupon'][0]['coupon_title'];
			  $data['page_title']=$pageTitle;//preg_replace('/[^a-zA-Z0-9]/s',' ',$pageTitle);
			  $data['imageUrl']=$data['productCoupon'][0]['coupon_image'];
			  $data['metaDescription']=preg_replace('/[^a-zA-Z0-9]/s',' ',$data['productCoupon'][0]['coupon_desc']);
			   $data['middle_content']='shared';
		  }
		  else
		  {
			  $data['page_title'] =$data['imageUrl']=$data['metaDescription']='Something went wrong';
			  $data['middle_content']='admin/404';
		  }
		  $this->load->view('templete',$data);
	}
	
}