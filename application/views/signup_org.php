<div class="container">
<div class="women_main">
	<!-- start content -->
			<div class="row single">
			
			
			 <!-- Left SIDE BAAR -->
	       		 <div class="col-md-3">
	       		 	<h3>Subscribe to Newsletter</h3>
	       		 	<form>
	       		 	<div class="contact-form">
	       		 		<?php 
                         $result=$this->db->query("select front_page_description from tbl_front_page where front_page_name='News Letter'")->row();
			               if($result)
		                   { ?>
					 
				 	    <p>
				 	 	    <?php echo $result->front_page_description;?>
						</p>	  
							    
							    
							
							   
							   
							 
							    
							    
							  
							   <?php }?> 
	       		 		<span><label>Your Email Id</label></span>
						<span><input name="userName" class="textbox" type="text" placeholder="Enter Your Email Id" style="width:100%;"></span>
						<span><input class="" value="Subscribe" style="width:100%;" type="submit"></span>
	       		 	</div>
	       		 	</form>
	       		 </div>
   
   <!-- // END Left SIDE BAR -->
			<!-- Right SIDE BARR -->
				<div class="col-md-9">
					<div class="sky-form contact-form">
					<?php 
if($this->session->userdata('reg_error'))
{
?>					
<div class="col-md-12" style="background: #" >
	<div class="alert alert-danger alert-dismissable" style="padding: 10px;">
       <?=$this->session->userdata('reg_error')?>
     </div>
</div>
<?php
$this->session->unset_userdata('reg_error');
}
?>
					 <form method="post" >
					 
				 	  	 	 <div class="col-md-12"><h4 style="background: #ffcc33;color: #fff">Organization Sign up</h4></div>
				 	 	    
							    <div class="col-md-12">
							    
							    	<div class="col-md-6">
							    		<span><label>E-mail</label></span>
							    		<span><input name="o_email" class="textbox" type="email" placeholder="Email Address" value="<?=set_value('o_email')?>"></span>
							    		<?php echo '<span style="color:red">'.form_error('o_email').'</span>'; ?>
							    	</div>
								 
							    </div>
							    
							    <div class="col-md-12">
							    
							    	<div class="col-md-6">
							    		<span><label>Password</label></span>
							    		<span><input name="o_password" class="textbox" type="password" placeholder="Password"></span>
							    		<?php echo '<span style="color:red">'.form_error('o_password').'</span>'; ?>
							    	</div>
								    <div class="col-md-6">
							    		<span><label>Password</label></span>
							    		<span><input name="o_cpassword" class="textbox" type="password" placeholder="Confirm Password"></span>
							    		<?php echo '<span style="color:red">'.form_error('o_cpassword').'</span>'; ?>
							    	</div>
							    </div>
							        
							     <div class="col-md-12">
							    
							    	<div class="col-md-6">
							    		<span><label>Name Of Organisation</label></span>
							    		<span><input name="o_name_of_org" class="textbox" type="text" placeholder="Organisation Name" value="<?=set_value('o_name_of_org')?>"></span>
							    		<?php echo '<span style="color:red">'.form_error('o_name_of_org').'</span>'; ?>
							    	</div>
								   
							    </div>
							    
							    
							
							   
							   
							 
							    
							    
							  
							    
							    <div class="col-md-12" style="margin: 10px">
							    	<span><input type="checkbox" required="" checked=""/> I agree to meetyourNGO's terms and Condtions</span>
							    	 
							    </div>
							   <div>
							   		<span><input name="org_step1" value="Submit us" type="submit"></span>
							  </div>
						    </form>
					    </div>
				
				
				
				 </div>	
	       		 <!-- END right SIDE BARR -->
	       		
   
		   <div class="clearfix"></div>		
	  </div>
	<!-- end content -->
</div>
</div>