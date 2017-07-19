<div class="online-outer">
  <?php
			   $class=1;
				if(count($onlineUsers)>0)
				{
					 echo ' <div id="divID">';
					foreach($onlineUsers  as $_cM) 
					{
						$this->db->select('tbl_login_master.login_id,tbl_login_master.user_type');						
						$userinfo=$this->master_model->getRecords('tbl_login_master',array('user_slug'=>$_cM['user_slug']));
						if($userinfo[0]['user_type']=='seller')
						{
							$this->db->select('tbl_seller_details.profilepic,tbl_seller_details.seller_id');						
							$userinfo=$this->master_model->getRecords('tbl_seller_details',array('loginid'=>$userinfo[0]['login_id']));
							if($userinfo[0]['profilepic']=='')
							{$img='images/profile-img.jpg';}
							else{ $img='uploads/profile_image/thumb/'.$userinfo[0]['profilepic']; }
						}
						else
						{
							$this->db->select('tbl_user_master.profile_picture,tbl_user_master.user_id');						
							$userinfo=$this->master_model->getRecords('tbl_user_master',array('login_id'=>$userinfo[0]['login_id']));
							if($userinfo[0]['profile_picture']=='')
							{$img='images/profile-img.jpg';}
							else{$img='uploads/profile_image/thumb/'.$userinfo[0]['profile_picture'];}
						}
						?>
  
  <div  <?php if($class % 2){echo 'class="online-list"';}else{echo 'class="online-list-last"';}?>>
    <div class="online-list2"> <img src=" <?php echo base_url().$img; ?>" width="35" height="35" alt="img" /> </div>
    <div class="online-inner-right">
      <div class="online-list3"> <a href="<?php echo base_url();?>community/member/<?php echo $_cM['user_slug'];?>/"> <?php echo $_cM['user_slug'];?></a> </div>
      <div class="clr"></div>
    </div>
    <div class="clr"></div>
  </div>
  <?php $class++;}
					echo $page_links;
					echo '</div>';
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
  
  <!--online-list-->
  <div class="clr"></div>
</div>
