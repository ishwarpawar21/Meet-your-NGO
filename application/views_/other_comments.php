<div class="product-outre"  >
    <?php      
      if(count($commentData) > 0) {     
	    echo ' <div id="divID"><div id="dynamicCmnt">';
		foreach($commentData as $val) { 
		
	if(	$val['user_type']=='seller')
	{
		$this->db->select('profilepic');
		$profileImg = $this->master_model->getRecords('tbl_seller_details',array('loginid'=>$val['login_id']));
		if(isset($profileImg[0]['profilepic']) && $profileImg[0]['profilepic']!='')
		 {  $imagePath = 'uploads/profile_image/thumb/'.$profileImg[0]['profilepic'];  }
		 else
		 {$imagePath = 'images/profile-img.jpg'; }
	}
	else
	{
		$this->db->select('profile_picture');
		$profileImg = $this->master_model->getRecords('tbl_user_master',array('login_id'=>$val['login_id']));
		if(isset($profileImg[0]['profile_picture']) && $profileImg[0]['profile_picture']!='')
		 {  $imagePath = 'uploads/profile_image/thumb/'.$profileImg[0]['profile_picture'];  }
		 else
		 {$imagePath = 'images/profile-img.jpg'; }
	}
		
		/* */
	   ?>
    <!--comments-->
    <div class="comments-box">
      <div class="comments-box-left"><img src="<?php echo base_url().$imagePath;?>" width="36" height="36" alt="user"/></div>
      <div class="comments-box-right">
        <div class="comments-arow"></div>
        <div class="comments-outer">
          <div class="comments-desk"><?php echo nl2br($val['comments']); ?></div>
          <div class="clr"></div>
          <div class="comments-posted"><span><i class="fa fa-clock-o" style="font-size:14px;"></i> Posted on :</span> <?php echo  date('d-m-Y',strtotime($val['posted_date']));?></div>
          <div class="comments-title" style="float:right;"><span>by :</span> <a href="<?php echo base_url().'community/member/'.$val['user_slug'].'/'; ?>"><?php echo  $val['user_slug']; ?></a></div>
        </div>
      </div>
      <div class="clr"></div>
    </div>
    <!--comments-->
    
    <div class="clr"></div>
    <?php 
			}
			echo $page_links;
			echo '</div></div>';
	  }
	  else
	  {
			echo '  <div class="product-right" style="width:100%!important;float:none!important;">
					<div class="product-right-innet-left">
					  <div class="product-titme" style="color:#000;">No comment posted yet.</div>
					   <div class="product-code">
						<div class="clr"></div>
					  </div>
					  <div class="clr"></div>
					</div></div>';
	  }?>
</div>
