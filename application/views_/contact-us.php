  <!--contain-start-->
  <div class="contain"> 
    <!--inner-->
    <div class="innar-page">
    <div class="co-pages">
        <div class="new-heading">
          <div class="new-heading-inner">
            <div class="inner-page-heading">Contact Us </div>
            <div class="clr"></div>
          </div>
        </div>
        <div class="clr"></div>
      </div>
  <?php if($this->session->flashdata('success')){?><div class="right-message" ><?php echo $this->session->flashdata('success'); ?></div> <?php } ?>
  <?php if($this->session->flashdata('error')){?><div class="err-message" ><?php echo $this->session->flashdata('error'); ?></div> <?php } ?>
      <!--login-inner-->
      <div class="contacts-inner">
        <form  id="form_contact_us" name="form_contact_us" method="post" >
        <div class="contact-left">
          
          <div class="about-fildset">
            <div class="contact-fildset"> First Name <span>*</span></div>
            <div class="about-fild">
              <input type="text" name="con_first_name" id="con_first_name" placeholder="Enter First Name" class="select-about">
               <div class="errr" style= " <?php if(form_error('con_first_name')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_con_first_name"><?php echo form_error('con_first_name'); ?></div>
            </div>
            <div class="clr"></div>
          </div>
          <div class="about-fildset">
            <div class="contact-fildset">Last Name <span>*</span></div>
            <div class="about-fild">
              <input type="text" name="cont_last_name" id="cont_last_name" placeholder="Enter Last Name" class="select-about">
               <div class="errr" style= " <?php if(form_error('cont_last_name')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_cont_last_name"><?php echo form_error('cont_last_name'); ?></div>
            </div>
            <div class="clr"></div>
          </div>
          <div class="about-fildset">
            <div class="contact-fildset">Email Address <span>*</span></div>
            <div class="about-fild">
              <input type="text" name="cont_email" id="cont_email" placeholder="Enter Email Address" class="select-about">
               <div class="errr" style= " <?php if(form_error('cont_email')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_cont_email"><?php echo form_error('cont_email'); ?></div>
            </div>
            <div class="clr"></div>
          </div>
          <div class="about-fildset">
            <div class="contact-fildset">Contact Number<span>*</span></div>
            <div class="about-fild">
              <input type="text" name="cont_mobile" id="cont_mobile" placeholder="Enter Contact Number" class="select-about">
               <div class="errr" style= " <?php if(form_error('cont_mobile')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_cont_mobile"><?php echo form_error('cont_mobile'); ?></div>
            </div>
            <div class="clr"></div>
          </div>
          <div class="about-fildset">
            <div class="contact-fildset">Message  <span>*</span></div>
            <div class="about-fild">
              <textarea id="cont_message" name="cont_message" rows="" cols="" class="texarea-select" placeholder="Enter Message"></textarea>
               <div class="errr" style= " <?php if(form_error('cont_message')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_cont_message"><?php echo form_error('cont_message'); ?></div>
            </div>
            <div class="clr"></div>
          </div>
          <div class="about-fildset">
          <input type="submit" name="btn_contact_us" id="btn_contact_us" class="submit-button" value="Submit">
          </div>
          <div class="clr"></div>
        </div>
        </form>
        
        <div class="contact-right">
          <div class="company-title">Coupon</div>
          <div class="company-address">
<!--          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,-->
          <?php  echo $admin_info['0']['admin_address']; ?>
          </div>
          <div class="clr"></div>
          <div class="company-add-outer">
            <div class="company-adres-icon"> <i class="fa fa-envelope" style=" margin-top:4px; font-size:14px;"></i> </div>
            <div class="company-adres"> 
            <a href="mailto:<?php echo $admin_info['0']['admin_email']; ?>"><?php echo $admin_info['0']['admin_email']; ?></a>
            </div>
            <div class="clr"></div>
          </div>
          <div class="company-add-outer">
            <div class="company-adres-icon"> <i class="fa fa-phone" style=" margin-top:5px;"></i></div>
            <div class="company-adres-main">  <?php  echo $admin_info['0']['phone']; ?></div>
            <div class="clr"></div>
          </div>
          <div class="company-add-outer">
            <div class="company-adres-icon"><i class="fa fa-globe" style=" margin-top:4px;"></i></div>
            <div class="company-web">
             <a href="<?php echo base_url();?>" target="_blank">www.coupon.com</a>
             </div>
            <div class="clr"></div>
          </div>
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
              <?php  if(count($faq_contactus)>0)
			  {?>
            	  <ul>
                	 <?php 
                       foreach($faq_contactus as $contactus)
					   { ?> 
		                <li><a href="<?php echo base_url();?>contact/<?php echo base64_encode($contactus['faq_id']);?>"><?php echo stripslashes($contactus['faq_ques']);?></a></li>
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
