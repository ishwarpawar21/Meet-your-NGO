<?php
 $_class 	=	 $this->router->fetch_class();
 $_method	=	 $this->router->fetch_method();
 $_combine	=	$_class.'|'.$_method;
 
$reg_date=$this->master_model->getRecords('tbl_login_master',array('login_id'=>$this->session->userdata('login_id')),'registraion_date');
$like_time=strtotime($reg_date[0]['registraion_date']);
$curr_time=strtotime(date('Y-m-d H:i:s'));
$diff=$curr_time - $like_time;
/*Seller Header Start */
if($this->session->userdata('user_type')=='seller')
{
  if($_combine!='community|member' && $_combine!='product|list')
  {
	if($this->uri->segment(1)!='community' && $this->uri->segment(1)!='product')
	{
		if($this->uri->segment(1)!=$this->session->userdata('user_type'))
		{	
		  redirect(base_url().'seller/profile/');
		} 
	}
  }
 	
if($this->session->userdata('email_id')=='' && $this->session->userdata('email_id')=='') 
{redirect(base_url());}
?>
<div class="profile-bag"> 
 <!--profile-left-->
 <?php  
 if($_combine == 'community|member'){  
 echo '<div class="profile-images">';
if($fromSeller == 'Yes')
 {
		 if(isset($selMemdetail[0]['profilepic']) && $selMemdetail[0]['profilepic']!='')
		 {  $imagePath = 'uploads/profile_image/thumb/'.$selMemdetail[0]['profilepic'];  }
		 else
		 {$imagePath = 'images/profile-img.jpg'; }
 }
 else
 {
		 if(isset($selMemdetail[0]['profile_picture']) && $selMemdetail[0]['profile_picture']!='')
		 {  $imagePath = 'uploads/profile_image/thumb/'.$selMemdetail[0]['profile_picture'];  }
		 else
		 {$imagePath = 'images/profile-img.jpg'; }
 }
 echo '<img src="'.base_url().$imagePath.'" width="155" height="158" alt="profile-img" /></div>';
 }
 else 
 { 
 echo '<div class="profile-images">';
   if(isset($seldetail[0]['profilepic']) && $seldetail[0]['profilepic']!=''){ 
   ?>
 <img src="<?php echo base_url(); ?>uploads/profile_image/<?php echo $seldetail[0]['profilepic'];?>" width="155" height="158" alt="profile-img" />
 <?php }
  else { ?>
 <img src="<?php echo base_url(); ?>images/profile-img.jpg" width="155" height="158" alt="profile-img"  />
 <?php }
echo '</div>';
  } 
  $like_time=strtotime($reg_date[0]['registraion_date']);
	$curr_time=strtotime(date('Y-m-d H:i:s'));
	$diff=$curr_time - $like_time;?>
  <!--profile-left-->  
  <!--profile-left-->
  <div class="profile-right">
  <?php  if($_combine == 'community|member') {  ?>
	 <div class="profile-title"><?php  if(isset($selMemdetail[0]['user_slug'])){ echo $selMemdetail[0]['user_slug']; }?></div>
     <div class="profile-desk"> <?php  if(isset($selMemdetail[0]['user_slug'])){ echo $selMemdetail[0]['user_slug']; }?> joined the community 
     <?php 
	 if($diff > 0)
	{
		if(intval( $diff / 86400 ) != '0')
				{
					if(intval( $diff / 86400 ) == '1')
					{
						echo sprintf("%02d day ", intval( $diff / 86400 ));
					}
					else
					{
						echo sprintf("%02d days ", intval( $diff / 86400 ));
					}
				}
				if(intval( ( $diff % 86400 ) / 3600) != '0')
				{
					if(intval( ( $diff % 86400 ) / 3600) == '1')
					{
						echo sprintf("%02d hour ", intval( ( $diff % 86400 ) / 3600));
					}
					else
					{
						echo sprintf("%02d hours ", intval( ( $diff % 86400 ) / 3600));
					}
				}
				if($diff>=3600)
				{
					echo ' ago';
				}
		}?>
             </div>
<?php } 
			  else  { ?>
    <div class="profile-title"><?php  echo $this->session->userdata('user_slug'); ?></div>
    <div class="profile-desk"> <?php  echo $this->session->userdata('user_slug');?> joined the community 
	<?php 
	if($diff > 0)
	{
		if(intval( $diff / 86400 ) != '0')
				{
					if(intval( $diff / 86400 ) == '1')
					{
						echo sprintf("%02d day ", intval( $diff / 86400 ));
					}
					else
					{
						echo sprintf("%02d days ", intval( $diff / 86400 ));
					}
				}
				if(intval( ( $diff % 86400 ) / 3600) != '0')
				{
					if(intval( ( $diff % 86400 ) / 3600) == '1')
					{
						echo sprintf("%02d hour ", intval( ( $diff % 86400 ) / 3600));
					}
					else
					{
						echo sprintf("%02d hours ", intval( ( $diff % 86400 ) / 3600));
					}
				}
				if($diff>=3600)
				{
					echo ' ago';
				}
		}?>
      </div>
    <?php } ?>
    
    <div class="profile-menu">
      <a href="<?php echo base_url().'seller/profile/';?>">
      <div class="profile-menu-in"><img src="<?php echo base_url(); ?>images/profile-icon.png" width="16" height="17" alt="profile-icon" /></div>
      <div class="profile-menu-out">My Profile</div>
      </a>
      <div class="clr"></div>
      <?php if($_method=='profile' || $_method=='edit'){?> <div class="profile-menu-act"></div><?php } ?>
    </div>
    <div class="profile-menu"><a href="<?php echo base_url().'seller/favourite_coupon/';?>">
      <div class="profile-menu-in"><img src="<?php echo base_url(); ?>images/fevorite.png" width="20" height="17" alt="fevorite" /></div>
      <div class="profile-menu-out">Favorite Coupon</div>
      </a>
      <div class="clr"></div>
     <?php if($_method=='favourite_coupon'){?> <div class="profile-menu-act"></div><?php } ?>
    </div>
    <div class="profile-menu"><a href="<?php echo base_url().'seller/accountpreferences/';?>">
      <div class="profile-menu-in"><img src="<?php echo base_url(); ?>images/message.png" width="14" height="17" alt="message" /></div>
      <div class="profile-menu-out">Account Preferences</div>
      </a>
      <div class="clr"></div>
      <?php if($_method=='accountpreferences'){?> <div class="profile-menu-act"></div><?php } ?>
    </div>
    <div class="profile-menu"><a href="<?php echo base_url().'community/';?>">
      <div class="profile-menu-in"><img src="<?php echo base_url(); ?>images/comunity.png" width="24" height="17" alt="comunity" /></div>
      <div class="profile-menu-out">Community</div>
      </a>
      <div class="clr"></div>
      <?php  if($_class.'|'.$_method=='community|index' || $_class.'|'.$_method=='community|faq'){?><div class="profile-menu-act"></div><?php } ?>
    </div>
    <div class="profile-menu" style="border:none;"><a href="<?php echo base_url().'product/';?>">
      <div class="profile-menu-in"><i class="fa fa-briefcase"></i></div>
      <div class="profile-menu-out">Product</div>
      </a>
      <div class="clr"></div>
      <?php if($_class.'|'.$_method=='product|index' || $_class.'|'.$_method=='product|myproduct'){?> <div class="profile-menu-act"></div><?php } ?>
    </div>
    <div class="clr"></div>
   </div>
  <!--profile-left-->
   <div class="clr"></div>
</div>
<?php 
  
 }
/*Seller Header End*/
/*User Header Start*/
else 
{
	$type=$this->master_model->getRecords('tbl_login_master',array('tbl_login_master.login_id'=>$this->session->userdata('login_id')),'user_type');
	if($type[0]['user_type']=='user')
	{
		if($this->session->userdata('email_id')=='' && $this->session->userdata('login_id')=='' ) 
		{redirect(base_url());}
		$this->db->select('tbl_login_master.login_id,tbl_login_master.user_slug,tbl_login_master.registraion_date,tbl_user_master.profile_picture');
		//$this->db->join('tbl_country_master','tbl_country_master.id=tbl_seller_details.countryid');
		$this->db->join('tbl_login_master','tbl_login_master.login_id=tbl_user_master.login_id');
		$userdetail=$this->master_model->getRecords('tbl_user_master',array('tbl_user_master.login_id'=>$this->session->userdata('login_id')));
		?>
		<div class="profile-bag"> 
		 <!--profile-left-->
		 <?php  
		 if($_combine == 'community|member') 
		 {  
				echo '<div class="profile-images">';
				if($fromSeller == 'Yes')
				 {
						 if(isset($selMemdetail[0]['profilepic']) && $selMemdetail[0]['profilepic']!='')
						 {
						 $imagePath = 'uploads/profile_image/thumb/'.$selMemdetail[0]['profilepic'];
						 }
						 else
						 {
							 $imagePath = 'images/profile-img.jpg'; 
						 }
				 }
				 else
				 {
						 if(isset($selMemdetail[0]['profile_picture']) && $selMemdetail[0]['profile_picture']!='')
						 { $imagePath = 'uploads/profile_image/thumb/'.$selMemdetail[0]['profile_picture'];  }
						 else
						 {$imagePath = 'images/profile-img.jpg'; }
				 }
				echo '<img src="'.base_url().$imagePath.'" width="155" height="158" alt="profile-img" /></div>';
		 }
		 else 
		 { 
		  echo '<div class="profile-images">';
			  if(isset($userdetail[0]['profile_picture']) && $userdetail[0]['profile_picture']!='')
			  {
			   echo  '<img src="'.base_url().'uploads/profile_image/'.$userdetail[0]['profile_picture'].'" width="155" height="158" alt="'.$userdetail[0]['profile_picture'].'" />'; } 
			 else 
			 {
			  echo '<img src="'.base_url().'images/profile-img.jpg" width="155" height="158" alt="profile-img" />';  }
		 
		 echo '</div>';
		 }?>
		  <!--profile-left-->  
		  <!--profile-left-->
		  <div class="profile-right">
		  <?php  if($_combine == 'community|member') {?>
			 <div class="profile-title"><?php if(isset($selMemdetail[0]['user_slug'])){ echo $selMemdetail[0]['user_slug']; }?></div>
			<div class="profile-desk"> <?php  if(isset($selMemdetail[0]['user_slug'])){ echo $selMemdetail[0]['user_slug']; }?> joined the community 
			<?php 
			if($diff > 0)
			{
				if(intval( $diff / 86400 ) != '0')
						{
							if(intval( $diff / 86400 ) == '1')
							{
								echo sprintf("%02d day ", intval( $diff / 86400 ));
							}
							else
							{
								echo sprintf("%02d days ", intval( $diff / 86400 ));
							}
						}
						if(intval( ( $diff % 86400 ) / 3600) != '0')
						{
							if(intval( ( $diff % 86400 ) / 3600) == '1')
							{
								echo sprintf("%02d hour ", intval( ( $diff % 86400 ) / 3600));
							}
							else
							{
								echo sprintf("%02d hours ", intval( ( $diff % 86400 ) / 3600));
							}
						}
						if($diff>=3600)
						{
							echo ' ago';
						}
				}
					?>  </div>
		<?php } else  { ?>
			<div class="profile-title"><?php  if(isset($userdetail[0]['user_slug'])){ echo $userdetail[0]['user_slug']; }?></div>
			<div class="profile-desk"> <?php  if(isset($userdetail[0]['user_slug'])){ echo $userdetail[0]['user_slug']; }?> joined the community 
			<?php
			if($diff > 0)
			{
				if(intval( $diff / 86400 ) != '0')
						{
							if(intval( $diff / 86400 ) == '1')
							{
								echo sprintf("%02d day ", intval( $diff / 86400 ));
							}
							else
							{
								echo sprintf("%02d days ", intval( $diff / 86400 ));
							}
						}
						if(intval( ( $diff % 86400 ) / 3600) != '0')
						{
							if(intval( ( $diff % 86400 ) / 3600) == '1')
							{
								echo sprintf("%02d hour ", intval( ( $diff % 86400 ) / 3600));
							}
							else
							{
								echo sprintf("%02d hours ", intval( ( $diff % 86400 ) / 3600));
							}
						}
						if($diff>=3600)
						{
							echo ' ago';
						}
				}?>  </div>
			<?php } ?>
			<div class="profile-menu">
			  <a href="<?php echo base_url().'user/profile/';?>">
			  <div class="profile-menu-in"><img src="<?php echo base_url(); ?>images/profile-icon.png" width="16" height="17" alt="profile-icon" /></div>
			  <div class="profile-menu-out">My Profile </div>
			  </a>
			  <div class="clr"></div>
			   <?php if($_class.'|'.$_method=='user|profile' || $_class.'|'.$_method=='user|edit'){?> <div class="profile-menu-act"></div><?php } ?>
			</div>
			<div class="profile-menu"><a href="<?php echo base_url().'user/favourite_coupon/';?>">
			  <div class="profile-menu-in"><img src="<?php echo base_url(); ?>images/fevorite.png" width="20" height="17" alt="fevorite" /></div>
			  <div class="profile-menu-out">Favorite Coupon</div>
			  </a>
			  <div class="clr"></div>
			  <?php if($_class.'|'.$_method=='user|favourite_coupon'){?> <div class="profile-menu-act"></div><?php } ?>
			</div>
			<div class="profile-menu"><a href="<?php echo base_url().'user/accountpreferences/';?>">
			  <div class="profile-menu-in"><img src="<?php echo base_url(); ?>images/message.png" width="14" height="17" alt="message" /></div>
			  <div class="profile-menu-out">Account Preferences</div>
			  </a>
			  <div class="clr"></div>
			  <?php if($_class.'|'.$_method=='user|accountpreferences'){?> <div class="profile-menu-act"></div><?php } ?>
			</div>
			<div class="profile-menu"><a href="<?php echo base_url().'community/';?>">
			  <div class="profile-menu-in"><img src="<?php echo base_url(); ?>images/comunity.png" width="24" height="17" alt="comunity" /></div>
			  <div class="profile-menu-out">Community</div>
			  </a>
			  <div class="clr"></div>
			   <?php if($_class.'|'.$_method=='community|index' || $_class.'|'.$_method=='community|faq'){?> <div class="profile-menu-act"></div><?php } ?>
			</div>
			<div class="profile-menu" style="border:none;"><a href="<?php echo base_url().'product/';?>">
			  <div class="profile-menu-in"><i class="fa fa-briefcase"></i></div>
			  <div class="profile-menu-out">Product</div>
			  </a>
			  <div class="clr"></div>
			<?php if($_class.'|'.$_method=='product|index' || $_class.'|'.$_method=='product|myproduct'){?> <div class="profile-menu-act"></div><?php } ?>
			</div>
			<div class="clr"></div>
		  </div>
		  <!--profile-left-->
		  <div class="clr"></div>
		</div>
		<?php 
		if($_combine!='community|member' && $_combine!='product|list')
		{
			if($this->uri->segment(1)!='community' && $this->uri->segment(1)!='product')
			{
				if($this->uri->segment(1)!=$this->session->userdata('user_type'))
				{
				  redirect(base_url().'user/profile/');
				} 
			}
		}
	}
	else
	{
		redirect(base_url().'home/signout');
	}
}
/*User Header End*/
?>