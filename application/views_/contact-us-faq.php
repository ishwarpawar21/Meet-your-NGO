  <!--contain-start-->
  <div class="contain"> 
    <!--inner-->
    <div class="innar-page">
    <div class="co-pages">
        <div class="new-heading">
          <div class="new-heading-inner">
            <div class="inner-page-heading">Contact Us Question</div>
            <div class="clr"></div>
          </div>
        </div>
        <div class="clr"></div>
      </div>
      <!--login-inner-->
      <div class="contacts-inner">
        <div class="">
          <div class="company-title"><?php echo  stripslashes($faq_contactus_info[0]['faq_ques']);?></div>
          <div class="company-address">
          <?php echo  stripslashes($faq_contactus_info[0]['faq_ans']);?>
          </div>
          <span style="margin-right:5px; float:right;">
          <a href="<?php echo base_url('contact-us');?>">
         <input id="back" name="back" class="submit-button" type="button" value="Back">
          </a>
          </span>
          <div class="clr"></div>
        </div>
        <div class="clr"></div>
      </div>
      <!--login-inner--> 
      
      <!--right-->
      <div class="contacts-right-site">
        <div class="contacts-right-inner">
          <div class="contacts-topqua">Top Questions:</div>
          <div class="contacts-topdesk">
            <div id="topqua">
              <?php  
			  if(count($faq_contactus)>0)
			  {?>
            	  <ul>
                	 <?php 
                       foreach($faq_contactus as $contactus)
					   { ?> 
		                <li >
                        <a href="<?php echo base_url();?>contact/<?php echo base64_encode($contactus['faq_id']);?>" <?php if($contactus['faq_id']==base64_decode($this->uri->segment(2))) { echo 'style="color: #333;" ';}?>>
						<?php echo stripslashes($contactus['faq_ques']);?>
                        </a>
                        </li>
                	 <?php } ?>
               		</ul>
              <?php  }else {?> 
			<div class="qua-err">Question's not available.</div>
			<?php }?> 
            </div>
          </div>
          <div class="clr"></div>
        </div>
      </div>
      <!--right-->
      
      <div class="clr"></div>
    </div>
    
    <!--inner--> 
  </div>
  <!--contain-end--> 
