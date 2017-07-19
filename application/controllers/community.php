<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Community extends CI_Controller {

public function __construct()

{

  parent::__construct();

}

	

public function index($page_num=1)

{

	    $data['page_title']='Community';

		$this->db->select('SUM(tbl_userscored_point.share_point)+SUM(tbl_userscored_point.like_point)+SUM(tbl_userscored_point.comment_point)+SUM(tbl_userscored_point.community_point) as total,tbl_login_master.*');
        $this->db->join('tbl_userscored_point','tbl_userscored_point.login_id=tbl_login_master.login_id');
        $this->db->group_by('tbl_login_master.login_id');
        $this->db->order_by('total','DESC');
$whereCondition=array('tbl_login_master.user_status'=>'1','MONTH(tbl_userscored_point.scored_date)'=>date('m'),'YEAR(tbl_userscored_point.scored_date)'=>date('Y'));
		$data['Userpoints']=$this->master_model->getRecords('tbl_login_master',$whereCondition,'','','',10,0);

		/*product perchase*/
		$this->db->select('SUM(tbl_purchase_point.purchase_point) as perchaseTotal,tbl_login_master.*,tbl_purchase_point.status');;
     	$this->db->where('tbl_purchase_point.status !=','Cancel');
		$this->db->order_by('perchaseTotal','DESC');
        $this->db->group_by('tbl_login_master.login_id');
        $this->db->join('tbl_purchase_point','tbl_login_master.login_id=tbl_purchase_point.purchase_login_id');
        $data['productperchase']=$this->master_model->getRecords('tbl_login_master','','','','',10,0);
        /*product perchase */

		 ####################################

		 $loginid = $this->session->userdata('login_id');

    	 $this->db->join('tbl_seller_details','tbl_seller_details.loginid=tbl_login_master.login_id');

		 $data['seldetail']=$this->master_model->getRecords('tbl_login_master',array('tbl_login_master.login_id'=>$loginid));

		 if(!count($data['seldetail']))

		 {

			 $this->db->join('tbl_user_master','tbl_user_master.login_id=tbl_login_master.login_id');

			 $data['seldetail']=$this->master_model->getRecords('tbl_login_master',array('tbl_login_master.login_id'=>$loginid));

		 }

		//$this->db->join('select');

		if($data['seldetail'][0]['user_type']=='seller')

		{

			$page_url = base_url().'member/'.$data['seldetail'][0]['user_slug'].'/submitted_coupon/';

			$numOfRec=$this->master_model->getRecordCount('tbl_coupon_master',array('tbl_coupon_master.login_id'=>$loginid,'tbl_coupon_master.coupon_status'=>'1'));

		}

		else

		{

			$page_url = base_url().'member/'.$data['seldetail'][0]['user_slug'].'/shared_coupon/';

			$numOfRec=$this->master_model->getRecordCount('tbl_userscored_point',array('tbl_userscored_point.point_type'=>'fb_share','tbl_userscored_point.login_id'=>$loginid));

		}

		if($data['seldetail'][0]['user_type']=='seller')

		{

		   $data['subTitle']='Coupon\'s added by- ';

		   $this->db->order_by('tbl_coupon_master.coupon_id','DESC');

		   $data['fetchCoupon']=$this->master_model->getRecords('tbl_coupon_master',array('tbl_coupon_master.login_id'=>$loginid,'tbl_coupon_master.coupon_status'=>'1'),'','',0,6);

		}

		 else

		 { 

		   $this->db->join('tbl_coupon_master','tbl_coupon_master.coupon_id=tbl_userscored_point.coupon_id','LEFT');

		   $this->db->group_by('tbl_userscored_point.coupon_id');

		   $data['fetchCoupon']=$this->master_model->getRecords('tbl_userscored_point',array('tbl_userscored_point.point_type'=>'fb_share','tbl_userscored_point.login_id'=>$loginid),'','',0,6);

		 }

		 $data['myPagination'] = $this->pagination_code();

		####################################

		$data['middle_content']='member_community';  

	    $this->load->view('templete',$data); 

   }

public function faq($page_num=1)

{

	    $data['page_title']='Community FAQ';

		$data['myPagination'] = $this->pagination_code();

		$this->db->join('tbl_userscored_point','tbl_userscored_point.login_id=tbl_login_master.login_id');

		$data['Userpoints']=$this->master_model->getRecords('tbl_login_master',array('user_status'=>'1'));

		/*product perchase */

		$this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_purchase_point.purchase_login_id');

		$data['productperchase']=$this->master_model->getRecords('tbl_purchase_point');

		/*product perchase */

		/*Manage FAQ start*/

		$this->db->join('tbl_faq_categories','tbl_faq_categories.faqid=tbl_faq_master.faq_id');

		$this->db->order_by('tbl_faq_master.faq_id','DESC');

		$data['fetch_faq']=$this->master_model->getRecords('tbl_faq_master',array('tbl_faq_master.faq_status'=>'1','tbl_faq_categories.faqcat_id'=>'3'));

		/*Manage FAQ  end*/ 

		

		 $loginid = $this->session->userdata('login_id');

    	 //$this->db->join('tbl_seller_details','tbl_seller_details.loginid=tbl_login_master.login_id');

		 $data['seldetail']=$this->master_model->getRecords('tbl_login_master',array('tbl_login_master.login_id'=>$loginid));

		 

		$data['middle_content']='member_community_faq';  

	    $this->load->view('templete',$data); 

   }

##########JQUERY PAGINATION##############

public function pagination_code() 

{

	$page_number = $this->uri->segment(3);

	$page_url = $config['base_url'] = base_url().'community/other_onlines/';

    $config['uri_segment'] = 3;        

    $config['per_page'] = 10;

    $config['num_links'] = 2;

    if(empty($page_number)) $page_number = 1;

    $offset = ($page_number-1) * $config['per_page'];

    $config['use_page_numbers'] = TRUE;        

    $data1["onlineUsers"] = $this->master_model->jQuerypagination_communitydata($config['per_page'],$offset);  

	$config['total_rows'] = $this->master_model->getRecordCount('tbl_login_master',array('user_status'=>'1'));        

    $page_url = $page_url.'/'.$page_number;

    $config['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';

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

    $data1['page_links'] = $this->pagination->create_links();

    return $data1;   

 }

 public function other_onlines($page_num=1) 

 {            

	$data = $this->pagination_code($this->uri->segment(3));            

	$this->load->view('community_pagination',$data);

 }

##########JQUERY PAGINATION##############

public function member($memberSlug)

{

	     $data['page_title']='Community Member';

		//echo '****'.$memberSlug ;//= $this->uri->segment(3);

	     ##################################

		 $this->db->join('tbl_seller_details','tbl_seller_details.loginid=tbl_login_master.login_id');

		 $data['selMemdetail']=$this->master_model->getRecords('tbl_login_master',array('tbl_login_master.user_slug'=>$memberSlug));

		 $data['fromSeller'] = 'Yes';

		 if(!count($data['selMemdetail']))

		 {

			 $this->db->join('tbl_user_master','tbl_user_master.login_id=tbl_login_master.login_id');

			 $data['selMemdetail']=$this->master_model->getRecords('tbl_login_master',array('tbl_login_master.user_slug'=>$memberSlug));

			 $data['fromSeller'] = 'No';

		 }

		 ##################################

		

		 

		 ##################################

		$this->db->join('tbl_seller_details','tbl_seller_details.loginid=tbl_login_master.login_id');

		$data['seldetail']=$this->master_model->getRecords('tbl_login_master',array('tbl_login_master.user_slug'=>$memberSlug));

		 if(!count($data['seldetail']))

		 {

			 $this->db->join('tbl_user_master','tbl_user_master.login_id=tbl_login_master.login_id');

			 $data['seldetail']=$this->master_model->getRecords('tbl_login_master',array('tbl_login_master.user_slug'=>$memberSlug));

		 }

		

		

		if($data['seldetail'][0]['user_type']=='seller')

		{

			$data['subTitle']='Coupon\'s added by- ';

			 $this->db->order_by('tbl_coupon_master.coupon_id','DESC');

			 $data['fetchCoupon']=$this->master_model->getRecords('tbl_coupon_master',array('tbl_coupon_master.login_id'=>$data['seldetail'][0]['login_id'],'tbl_coupon_master.coupon_status'=>'1'),'','',0,6);

		}

		else

		{

			$data['subTitle']='Coupon\'s shared by- ';

			$this->db->join('tbl_coupon_master','tbl_userscored_point.coupon_id=tbl_coupon_master.coupon_id','LEFT');

			$this->db->group_by('tbl_userscored_point.coupon_id');

			$data['fetchCoupon']=$this->master_model->getRecords('tbl_userscored_point',array('tbl_userscored_point.point_type'=>'fb_share','tbl_userscored_point.login_id'=>$data['seldetail'][0]['login_id']),'','',0,6);

		}

		 

		 $data['category']=$this->master_model->getRecords('tbl_category_master',array('category_status'=>'1'));

		 $data['middle_content']='community_seller_profile';  

	     $this->load->view('templete',$data); 

   }

public function post_comment()

{

	   $senderid 		= $this->input->post('senderid');

	   $receiverid	= $this->input->post('receiverid');

	   $comments	 	= $this->input->post('comments');

	   if($senderid!='' && $receiverid!='' && $comments!='')

	   {

		   $dataArray=array('sender_id'=>$senderid,'receiver_id'=>$receiverid,'comments'=>$comments);

		   $instid=$this->master_model->insertRecord('tbl_community_comments',$dataArray,TRUE);

		   if($instid)

		   {

			  $point_comment=$this->master_model->getRecords('tbl_points_master');

			  $community_point=$point_comment[0]['community_point'];

			  $CheckPoint=array('point_type'=>'community','login_id'=>$senderid);

			  $CheckDublicate=$this->master_model->getRecords('tbl_userscored_point',$CheckPoint);

			  if(count($CheckDublicate)=='0')

			  {

			    $PointArray=array('point_type'=>'community','community_point'=>$community_point,'login_id'=>$senderid,'scored_date'=>date('Y-m-d H:i:s'));

				$this->master_model->insertRecord('tbl_userscored_point',$PointArray);

			  }

			 echo 'done'; 

		   }

		   else

		   {echo 'error';}

	   }

	   else

	   { echo 'error';}

   }

  public function mostpoint()

  {

	$month=$this->input->post('month');  

	$limit=$this->input->post('limit');

	$page=0;

	$this->db->select('SUM(tbl_userscored_point.share_point)+SUM(tbl_userscored_point.like_point)+SUM(tbl_userscored_point.comment_point)+SUM(tbl_userscored_point.community_point) as total,tbl_login_master.*,tbl_userscored_point.scored_date');

    $this->db->join('tbl_userscored_point','tbl_userscored_point.login_id=tbl_login_master.login_id');

	$this->db->group_by('tbl_login_master.login_id');

	$this->db->order_by('total','DESC');

	if($month!='all')

	{

		$whereArray=array('tbl_login_master.user_status'=>'1','MONTH(tbl_userscored_point.scored_date)'=>$month,'YEAR(tbl_userscored_point.scored_date)'=>date('Y'));

	}

	else

	{

       $whereArray=array('tbl_login_master.user_status'=>'1'); 

	}

	$Userpoints=$this->master_model->getRecords('tbl_login_master',$whereArray,'','',$page,$limit);

	/*TOTAL COUNT OF THE USER*/

	$this->db->select('SUM(tbl_userscored_point.share_point)+SUM(tbl_userscored_point.like_point)+SUM(tbl_userscored_point.comment_point)+SUM(tbl_userscored_point.community_point) as total,tbl_login_master.*,tbl_userscored_point.scored_date');

    $this->db->join('tbl_userscored_point','tbl_userscored_point.login_id=tbl_login_master.login_id');

	$this->db->group_by('tbl_login_master.login_id');

	$this->db->order_by('total','DESC');

	if($month!='all')

	{

		$wherecount=array('tbl_login_master.user_status'=>'1','MONTH(tbl_userscored_point.scored_date)'=>$month,'YEAR(tbl_userscored_point.scored_date)'=>date('Y'));

	}

	else

	{

       $wherecount=array('tbl_login_master.user_status'=>'1'); 

	}

	$_TotalRecords=$this->master_model->getRecords('tbl_login_master',$wherecount,'','');

				  if(count($Userpoints)>0)

				  {

					  $i=1;

					  foreach($Userpoints as $rowpoint)

					  {

						 if($rowpoint['user_type'] == 'seller')

						 {

							 $this->db->select('profilepic');

							 $getImage=$this->master_model->getRecords('tbl_seller_details',array('tbl_seller_details.loginid'=>$rowpoint['login_id']));

							 if(isset($getImage[0]['profilepic']) && $getImage[0]['profilepic']!='')

							 {$imagePath ='uploads/profile_image/thumb/'.$getImage[0]['profilepic'];}

							 else

							 {$imagePath ='images/profile-img.jpg';}

						 }

						 else

						 {

							 $this->db->select('profile_picture');

							 $getUserPoint=$this->master_model->getRecords('tbl_user_master',array('tbl_user_master.login_id'=>$rowpoint['login_id']));

							 if(isset($getImage[0]['profile_picture']) && $getImage[0]['profile_picture']!='')

							 {$imagePath ='uploads/profile_image/thumb/'.$getImage[0]['profile_picture'];}

							 else

							 {$imagePath ='images/profile-img.jpg';}

						 }

						?>

                         <div class="com-list">

                            <div class="com-list1"><?php echo $i; ?></div>

                            <div class="com-list2"><img src="<?php echo base_url().$imagePath;?>" width="45" height="45" alt="img" /></div>

                            <div class="com-list3"><a href="javascript:void(0);"><?php echo $rowpoint['user_slug']; ?></a></div>

                            <div class="com-list4"><?php echo $rowpoint['total'];  ?>

                              <div class="clr"></div>

                              <span>points</span> </div>

                            <div class="clr"></div>

                         </div>

                      <?php

						$i++;

					  }

				 if(count($_TotalRecords)<$limit)

			     {

			    ?>

                 <div class="com-list-btn">

                        <button name="" class="com-list-next" value="" id="next_point" type="button" > More Contented <i class="fa fa-angle-right"></i></button>

                        <div id="loading_more" style="display:none;"><img src="<?php echo base_url().'images/myloader_20x20.gif'; ?>" style="padding:10px 0 0 100px;"/></div>

                 </div>

				  <?php

                   } 

                } 

				else

				{

				?>

                <div class="err-message">No Data Found .</div>

                <?php

				}

				?>

          <!--list-box-btn-->

          <!--list-box-btn-->

          <div class="clr"></div>

   <?php

  }

}