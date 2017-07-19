<div class="contain"> 
  <!--inner-->
  <div class="innar-page"> 
    <!--profile-inner-->
    <div class="profile-top">
      <?php include('profile-header.php'); ?>
    </div>
    <div class="my-profile-outer"> 
      <!--profile-left-->
      <div class="my-profile-left">
        
        <div class="active-inner">
          <div class="about-heading">
            <div class="latest-sub-title">Comments For
              <?php if(isset($seldetail[0]['user_slug'])){ echo $seldetail[0]['user_slug'];}?>
              <span class="title-arow"><img src="<?php echo base_url(); ?>images/title-arow.png" width="20" height="21" alt="arow" /></span></div>
          </div>
        </div>
        <div class="active-inner">
          <div class="active-box">
            <div class="active-box-inner">
              <div class="active-box-left">
                <?php $getrecord=$this->master_model->getRecords('admin_login'); ?>
                <img src="<?php  echo base_url(); ?>uploads/admin/<?php echo $getrecord[0]['admin_img'];?>" width="80" height="80" alt="profile" /> </div>
              <div class="active-box-right">
                <?php $message=$this->master_model->getRecords('tbl_community_message'); ?>
                <div class="active-desk"><?php echo $message[0]['message_title']; ?>!</div>
                <div class="active-desk">"<?php echo $message[0]['message_desc'];?>."</div>
                <div class="active-desk"> If you have any questions about the Community or about RetailMeNot, please let me know.</div>
                <div class="active-desk">
                  <div class="active-desk-link"><a href="#"><?php echo $this->session->userdata('user_slug'); ?></a> <!--posted this 4 days ago--> </div>
                  <div class="active-desk-link1"><a href="#">delete</a> - <a href="#">reply on Admin</a> </div>
                  <div class="clr"></div>
                </div>
                <div class="clr"></div>
              </div>
              <div class="clr"></div>
            </div>
            <div class="clr"></div>
          </div>
        </div>
        <div class="active-inner">
          <div class="submit-heading">
            <div class="latest-sub-title">
              <?php if(isset($seldetail[0]['user_slug'])){ echo $seldetail[0]['user_slug'];}?>
              Activity <span class="title-arow"><img src="<?php echo base_url(); ?>images/title-arow-arb.png" width="20" height="21" alt="arow" /></span></div>
          </div>
        </div>
        <div class="clr"></div>
      </div>
      <!--profile-left--> 
      
      <!--profile-right-->
      <div class="my-profile-right">
        <div class="active-inner">
          <div class="about-heading">
            <div class="about-inner-title">Community Chat <span class="title-arow"><img src="<?php echo base_url(); ?>images/title-arow.png" width="20" height="21" alt="arow" /></span></div>
          </div>
        </div>
        <div class="active-inner"> 
          
          <!-- BEGIN CBOX - www.cbox.ws - v001 -->
          <div id="cboxdiv" style="text-align: center; line-height: 0">
            <div>
              <iframe frameborder="0" width="267" height="90" src="http://www2.cbox.ws/box/?boxid=2365518&amp;boxtag=e5evlc&amp;sec=form" marginheight="2" marginwidth="2" scrolling="no" allowtransparency="yes" name="cboxform2-2365518" style="border:#ababab 1px solid;border-bottom:0px" id="cboxform2-2365518"></iframe>
            </div>
            <div>
              <iframe frameborder="0" width="267" height="305" src="http://www2.cbox.ws/box/?boxid=2365518&amp;boxtag=e5evlc&amp;sec=main" marginheight="2" marginwidth="2" scrolling="auto" allowtransparency="yes" name="cboxmain2-2365518" style="border:#ababab 1px solid;" id="cboxmain2-2365518"></iframe>
            </div>
          </div>
          <!-- END CBOX -->
          
          <div class="clr"></div>
        </div>
        <div class="active-inner">
          <div class="about-heading">
            <div class="about-inner-title">Who's Online? <span class="title-arow"><img src="<?php echo base_url(); ?>images/title-arow.png" width="20" height="21" alt="arow" /></span></div>
          </div>
        </div>
        <div class="active-inner">
          <div class="points-menu">
              <div id="pointsmenu">
                <ul>
                <?php
				if(count($communityMembers)>0)
				{
					foreach($communityMembers as $_cM) 
					{
						echo ' <li><a style="color:#000;background:none;padding:5px 0 5px 0px;" href="'.base_url().'community/member/'.$_cM['user_slug'].'/">'.$_cM['user_slug'].'</a></li>';
					}
				}
				?>
                  </ul>
              </div>
            </div>
        </div>
        <div class="clr"></div>
      </div>
      <!--profile-right-->
      
      <div class="clr"></div>
    </div>
    <!--profile-inner-->
    
    <div class="clr"></div>
  </div>
  <!--inner--> 
</div>
