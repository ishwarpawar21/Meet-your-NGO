<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax extends CI_Controller {
    public function __construct()
    {
	   parent::__construct();
	   $this->load->library('upload');  
	}
	public function addbrand()
	{
		 $brand_title=$this->input->post('brand_title');
		 $brand_desc=$this->input->post('brand_desc');
		 $config=array('upload_path'=>'uploads/brand/',
							   'allowed_types'=>'jpg|jpeg|gif|png',
							   'file_name'=>rand(1,9999),'max_size'=>0
							   );
		 $this->upload->initialize($config);
		 if($_FILES['brand_logo']['name']!='')
		 {
			$check_dublication=array('login_id'=>$this->session->userdata('login_id'),'brand_title'=>$brand_title);
			$getdublication=$this->master_model->getRecords('tbl_brand_master',$check_dublication);
			if(count($getdublication)==0)
			{ 
				if($this->upload->do_upload('brand_logo'))
				{
					 $dt=$this->upload->data();
					 $file=$dt['file_name'];
					 $this->master_model->createThumb($file,'uploads/brand/',161,87,TRUE);
					 $brand_slug=$this->master_model->create_slug($brand_title,'tbl_brand_master','brand_slug');
					 $insert_array=array('login_id'=>$this->session->userdata('login_id'),'brand_title'=>$brand_title,'brand_desc'=>$brand_desc,'brand_image'=>$file,'brand_slug'=>$brand_slug);
					 if($this->master_model->insertRecord('tbl_brand_master',$insert_array))
					 {
						 echo "Success";
					 } 
					 else
					 {
						 echo "Error";
					 }
				}
				else
				{
					echo 'Extension';
				}
			}
			else
			{
				echo 'Already';
			}
		 }
	 }
	 /*show all brand of the addedd this user*/
	 public function brandshow()
	 {
	  ?>
		 <select class="select-coupons" name="brand_id" id="brand_id">
          <option value="">Select</option>
		   <?php
		     $this->db->order_by('brand_title','ASC');
             $brand_res=$this->master_model->getRecords('tbl_brand_master',array('login_id'=>$this->session->userdata('login_id')));
             if(count($brand_res)>0)
             {
               foreach($brand_res as $rowbrand)
               {	 
             ?>
               <option value="<?php echo $rowbrand['brand_id'];?>" <?php if(set_value('brand_id')==$rowbrand['brand_id']){echo 'selected="selected"';}?>><?php echo $rowbrand['brand_title'];?></option>
            <?php 
               }
             }
            ?>
         </select>
       <?php
		 
     }
	 /*User Like Unlike Coupon Code Start*/
 	public function choice($choice='',$coup_id='')
	{ 
	  $choice=base64_decode($this->uri->segment(2));
	  //$coup_id=base64_decode($this->uri->segment(3));
	  $set_per_day_limit=$this->master_model->getRecords('tbl_points_master',array('points_id'=>'1'));
	  $per_day_share=$this->master_model->getRecords('tbl_userscored_point',array('point_type'=>'fb_share','login_id'=>$this->session->userdata('login_id'),'SUBSTR(scored_date,1,10)'=>date('Y-m-d')),'SUM(share_point) as share_point');
	  $per_day_like=$this->master_model->getRecords('tbl_userscored_point',array('point_type'=>'like','login_id'=>$this->session->userdata('login_id'),'SUBSTR(scored_date,1,10)'=>date('Y-m-d')),'SUM(like_point) as like_point');
	   $per_day_comment=$this->master_model->getRecords('tbl_userscored_point',array('point_type'=>'comment','login_id'=>$this->session->userdata('login_id'),'SUBSTR(scored_date,1,10)'=>date('Y-m-d')),'SUM(comment_point) as comment_point');
	   $total=$per_day_share[0]['share_point']+$per_day_like[0]['like_point']+$per_day_comment[0]['comment_point'];

	  $data['info']=$this->master_model->getRecords('tbl_like_unlike_master',array('log_id'=>$this->session->userdata('login_id'),'coup_id'=>$coup_id));
	  if(count($data['info'])>0)
	  {
				  if($choice=='1')
				  {
							 if($total<$set_per_day_limit[0]['per_day_point'])
							 {
								 if($data['info'][0]['like_id']=='0') 
								 {
								  $update_array=array('like_id'=>'1','unlike_id'=>'0');
								  $this->master_model->updateRecord('tbl_like_unlike_master',$update_array,array('log_id'=>$this->session->userdata('login_id'),'coup_id'=>$coup_id));
								  $like_count=$this->master_model->getRecordCount('tbl_like_unlike_master',array('coup_id'=>$coup_id,'like_id'=>'1'));	
								  $arra_count=array('like'=>'like','likecount'=>$like_count,'first'=>'last');  
								  echo json_encode($arra_count);
								  /*insert the points */
								  $couponId=$coup_id;
								  $login_id=$this->session->userdata('login_id');
								  $point_type='like';
								  $point_comment=$this->master_model->getRecords('tbl_points_master');
								  $comment_point=$point_comment[0]['like_point'];
								  $check_array=array('coupon_id'=>$couponId,'login_id'=>$login_id,'point_type'=>$point_type);
								  $userscored=$this->master_model->getRecords('tbl_userscored_point',$check_array); 
								  if(count($userscored)==0)
								  {
									$UserscorArray=array('point_type'=>$point_type,'login_id'=>$login_id,'coupon_id'=>$couponId,'like_point'=>$comment_point,'scored_date'=>date('Y-m-d H:i:s'));
									$insert_id=$this->master_model->insertRecord('tbl_userscored_point',$UserscorArray,TRUE);
								  }	
								  else
								  {
									$UserscorArray=array('point_type'=>$point_type,'login_id'=>$login_id,'coupon_id'=>$couponId,'like_point'=>$comment_point,'scored_date'=>date('Y-m-d H:i:s'));
									$insert_id=$this->master_model->updateRecord('tbl_userscored_point',$UserscorArray,array('coupon_id'=>$couponId,'point_type'=>"'like'",'login_id'=>$login_id));  
								  }
								  
								  
								  /*insert the points */
								}
								else
								{
									$arra_count=array('like'=>'','likecount'=>'','first'=>'last');
									echo json_encode($arra_count);
								}
							 }
	 						 else
							  {
	  	$arra_count=array('like'=>'Finished');
		echo json_encode($arra_count);
	  }
				  }
				  else
				  {
					if($data['info'][0]['unlike_id']=='0') 
					 {
						$update_array=array('like_id'=>'0','unlike_id'=>'1');
						$this->master_model->updateRecord('tbl_like_unlike_master',$update_array,array('log_id'=>$this->session->userdata('login_id'),'coup_id'=>$coup_id));	
						$unlike_count=$this->master_model->getRecordCount('tbl_like_unlike_master',array('coup_id'=>$coup_id,'unlike_id'=>'1'));	
						 $arra_count=array('like'=>'unlike','likecount'=>$unlike_count,'first'=>'last');
						 echo json_encode($arra_count);  
						 /*insert the points */
						  $couponId=$coup_id;
						  $login_id=$this->session->userdata('login_id');
						  $point_type="like";
						  $point_comment=$this->master_model->getRecords('tbl_points_master');
						  $comment_point=$point_comment[0]['like_point'];
						  $check_array=array('coupon_id'=>$couponId,'login_id'=>$login_id,'point_type'=>$point_type);
						  $userscored=$this->master_model->getRecords('tbl_userscored_point',$check_array); 
						  if(count($userscored)==1)
						  {
							$UserscorArray=array('point_type'=>$point_type,'login_id'=>$login_id,'coupon_id'=>$couponId,'like_point'=>'0','scored_date'=>date('Y-m-d H:i:s'));
							$insert_id=$this->master_model->updateRecord('tbl_userscored_point',$UserscorArray,array('coupon_id'=>$couponId,'point_type'=>"'like'",'login_id'=>$login_id));
						  }	
						 /*insert the points */
					 }
					 else
					 {
						 $arra_count=array('like'=>'','likecount'=>'','first'=>'last');
						 echo json_encode($arra_count);
					 }
				  }
		  }
		  else
		  {
						  if($choice=='1')
						  {
							  if($total<$set_per_day_limit[0]['per_day_point']) 
							  {
							  $insert_array=array('log_id'=>$this->session->userdata('login_id'),'coup_id'=>$coup_id,'like_id'=>'1','unlike_id'=>'0');
							  $this->master_model->insertRecord('tbl_like_unlike_master',$insert_array);
							  $like_count=$this->master_model->getRecordCount('tbl_like_unlike_master',array('coup_id'=>$coup_id,'like_id'=>'1'));
							 $arra_count=array('like'=>'like','likecount'=>$like_count,'first'=>'first');
							 echo json_encode($arra_count);
							 
							 /*insert the points */
							  $couponId=$coup_id;
							  $login_id=$this->session->userdata('login_id');
							  $point_type='like';
							  $point_comment=$this->master_model->getRecords('tbl_points_master');
							  $comment_point=$point_comment[0]['like_point'];
							  $check_array=array('coupon_id'=>$couponId,'login_id'=>$login_id,'point_type'=>$point_type);
							  $userscored=$this->master_model->getRecords('tbl_userscored_point',$check_array); 
							  if(count($userscored)==0)
							  {
								$UserscorArray=array('point_type'=>$point_type,'login_id'=>$login_id,'coupon_id'=>$couponId,'like_point'=>$comment_point,'scored_date'=>date('Y-m-d H:i:s'));
								$insert_id=$this->master_model->insertRecord('tbl_userscored_point',$UserscorArray,TRUE);
							  }	
							 /*insert the points */
							  }
							  else
							  {
								$arra_count=array('like'=>'Finished');
								echo json_encode($arra_count);
							  }
							  
						  }
						  else
						  {
							  $insert_array=array('log_id'=>$this->session->userdata('login_id'),'coup_id'=>$coup_id,'like_id'=>'0','unlike_id'=>'1');
							  $this->master_model->insertRecord('tbl_like_unlike_master',$insert_array);
							  $unlike_count=$this->master_model->getRecordCount('tbl_like_unlike_master',array('coup_id'=>$coup_id,'unlike_id'=>'1'));
							  $arra_count=array('like'=>'unlike','likecount'=>$unlike_count,'first'=>'first');
							  echo json_encode($arra_count);
						 }
		  }
	 
	 }
	 /*User Like Unlike Coupon Code End*/
	/*User Save Coupon Code Start*/
 	public function savecoupon()
	{
	  	 $coupon_id=base64_decode($this->uri->segment(2));
		  //$coup_id=base64_decode($this->uri->segment(3));
		  $data['info']=$this->master_model->getRecords('tbl_save_master',array('coupon_login_id'=>$this->session->userdata('login_id'),'couponid'=>$coupon_id));
		  if(count($data['info'])==0)
		  {
			 $insert_array=array('coupon_login_id'=>$this->session->userdata('login_id'),'couponid'=>$coupon_id,'coupon_save_date'=>date('Y-m-d'));
			if($this->master_model->insertRecord('tbl_save_master',$insert_array))
			{
				echo "INSERT";
			}
			else
			{
				echo "ERROR";
			}
		  }
		  else
	  	  {
			  echo "ALREADY";
		  }
	 }
	/*User Save Coupon Code End*/
	/*Seller  Coupon delete Code Start*/
 	public function deletecoupon()
	{
	  	 $coupon_id=$this->uri->segment(2);
		 if($coupon_id!='')
		  {
			if($this->master_model->deleteRecord('tbl_coupon_master','coupon_id',$coupon_id))
			{
				$this->master_model->deleteRecord('tbl_like_unlike_master','coup_id',$coupon_id);
				$this->master_model->deleteRecord('tbl_save_master','couponid',$coupon_id);
				$this->master_model->deleteRecord('tbl_coupon_comments','couponid',$coupon_id);
				$this->session->set_flashdata('success','Coupon deleted successfully.');
				echo "DELETE";
			}
			else
			{
				echo "ERROR";
			}
		  }
	 }
	/*Seller  Coupon delete Code End*/
	/*User Save newletter email id Code Start*/
 	public function newletter()
	{
	  	  $chk_email=$this->input->post('chk_email');
		  if($chk_email!='')
		  {
			$newletter_count=$this->master_model->getRecordCount('tbl_newsletter_subscriber',array('tbl_newsletter_subscriber.sub_email'=>$chk_email));
			if($newletter_count>0)
			{
				echo "ALREADY";
			}
			else
			{
				$insert_array=array('sub_email'=>$chk_email);
				if($this->master_model->insertRecord('tbl_newsletter_subscriber',$insert_array))
				{
					echo "INSERT";
				}
			}
		  }
	 }
	/*User Save newletter Email id Code End*/
}