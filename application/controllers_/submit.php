<?php if ( ! defined('BASEPATH'))exit('No direct script access allowed');
class Submit extends CI_Controller {
    public function __construct()
    {
	   parent::__construct();
	   $this->load->library('aws_signed_request');
	   $this->load->library('simple_html_dom');
	}
	public function index()
	{
	  $data['page_title']='Submit Coupon';
	  $data['error_message']='';
	  $data['items']='';
	  $public_key = 'AKIAIPYFE3GBXMU7JGBA';
	  $private_key = 'lGcwpuxIitSKHYHZmgi40u4EBHTiSLX2Ia3MLe7d';
	  $associate_tag = 'wwtamazon-20';
	  $data['reviews'] ='';
	  if(isset($_POST['btn_check']))
	  {
		  $this->form_validation->set_rules('store','ASIN','required');
		  if($this->form_validation->run())
		  {
			  $store=$this->input->post('store');
			  $ASIN = $store;//'B00LV7XXGY';	
			  $pxml = $this->aws_signed_request->aws_signed_request1("com", array("Operation"=>"ItemLookup","ItemId"=>"$ASIN","ResponseGroup"=>"ItemAttributes,Offers,Images,Reviews, PromotionSummary","IdType"=>"ASIN","MerchantId"=>"Amazon","AssociateTag"=>"wwtamazon-20"), $public_key, $private_key);
			  $result =$pxml;
			  $flat = call_user_func_array('array_merge', $result);
			  if(count(@$flat['Items']['Request']['Errors']['Error']['Message'])!='0')
			  {
				$data['error_message']=$flat['Items']['Request']['Errors']['Error']['Message'];
			  }
			  else
			  {
				 $data['items']  =$flat;
				 if($flat['Items']['Item']['CustomerReviews']['HasReviews']!='false')
				 {
					 $html           = file_get_html($flat['Items']['Item']['CustomerReviews']['IFrameURL']);
					 $data['reviews']= $html->find('div.crIFrameNumCustReviews', 0)->plaintext.':-'.$html->find('div.crIFrameNumCustReviews img', 0)->src;
				 }
			  }
		  }
     }
	 if(isset($_POST['btn_coupon']))
	 {
		$store=$this->input->post('store'); 
		$this->form_validation->set_rules('store','Asin No','required|is_unique[tbl_coupon_master.product_asin_no]'); 
		$this->form_validation->set_rules('coupon_code','coupon code','required|is_unique[tbl_coupon_master.coupon_code]');
		$this->form_validation->set_rules('coupon_discount','Coupon Discount','required');
		$this->form_validation->set_rules('cate_id','Category','required');
		$this->form_validation->set_rules('brand_id','brand id','required');
		$this->form_validation->set_rules('exp_date','expiry date','required');
		$ASIN = $store;//'B00LV7XXGY';	
		$pxml = $this->aws_signed_request->aws_signed_request1("com", array("Operation"=>"ItemLookup","ItemId"=>"$ASIN","ResponseGroup"=>"ItemAttributes,Offers,Images,Reviews, PromotionSummary","IdType"=>"ASIN","MerchantId"=>"Amazon","AssociateTag"=>"wwtamazon-20"), $public_key, $private_key);
		$result =$pxml;
		$flat = call_user_func_array('array_merge', $result);
		if(count(@$flat['Items']['Request']['Errors']['Error']['Message'])!='0')
		{
		  $data['error_message']=$flat['Items']['Request']['Errors']['Error']['Message'];
		}
		else
		{
		  if($this->form_validation->run())
		  {
			$data['items']  =$flat;
			if($flat['Items']['Item']['CustomerReviews']['HasReviews']!='false')
			{
				 $html                  = file_get_html($flat['Items']['Item']['CustomerReviews']['IFrameURL']);
				 $string                = $html->find('div.crIFrameNumCustReviews', 0)->plaintext;
				 $user                  = preg_replace("/[^0-9]/","",$string);
				 $product_reviews_digit = $user;
	        }
			else
			{
				 $product_reviews_digit='0';
			}
			$coupon_code    = $this->input->post('coupon_code');
			$coupon_discount_input= $this->input->post('coupon_discount');
			$cate_id        = $this->input->post('cate_id');
			$brand_id       = $this->input->post('brand_id');
			$exp_date       =$this->input->post('exp_date');
			$coupon_expirydate=date('Y-m-d',strtotime($exp_date));   
			$coupon_image   = $this->input->post('coupon_image');
			$coupon_title   = $this->input->post('coupon_title');
			$product_price  = $this->input->post('product_price');
			$product_manufacturer =$this->input->post('product_manufacturer');
			$product_group  = $this->input->post('product_group');
			$coupon_desc    = $this->input->post('coupon_desc');
			$amount_type    =$this->input->post('amount_type');
			$product_reviews =$this->input->post('product_reviews');
			$product_details_url =$this->input->post('product_details_url');
			$coupon_insertdate=date('Y-m-d');
			if($amount_type=='price')
			{
			  $coupon_discount =$coupon_discount_input;
			}
			else
			{
			  $coupon_discount = $coupon_discount_input.'%';
			}
			$order_by_price=preg_replace("/[^0-9.]/","",$product_price);
			/*insert array*/
		    $insertarray=array('login_id'=>$this->session->userdata('login_id'),'product_asin_no'=>$store,'product_price'=>$product_price,'order_by_price'=>$order_by_price,'product_manufacturer'=>$product_manufacturer,'coupon_cat_id'=>$cate_id,'coupon_brand_id'=>$brand_id,'coupon_title'=>$coupon_title,'coupon_image'=>$coupon_image,'coupon_desc'=>$coupon_desc,'coupon_code'=>$coupon_code,'coupon_expirydate'=>$coupon_expirydate,'coupon_insertdate'=>$coupon_insertdate,'coupon_discount'=>$coupon_discount,'coupon_status'=>'0','product_reviews'=>$product_reviews,'product_details_url'=>$product_details_url,'product_reviews_digit'=>$product_reviews_digit);	
		   if($this->master_model->insertRecord('tbl_coupon_master',$insertarray))
		   {
			 $this->session->set_flashdata('success','Coupon added successfull.');
			 redirect(base_url().'seller/submit/');
		   }
		   else
		   {
			 $this->session->set_flashdata('error','Error while adding coupon.');
			 redirect(base_url().'seller/submit/');  
		   }
		  }
		}
	 }
	 $data['middle_content']='submit_coupon';
	 $this->load->view('templete',$data);
	}
	
}

