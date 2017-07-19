<div class="container">
<div class="women_main">
	<!-- start content -->
			<div class="row single">
			
			
			 <!-- Left SIDE BAAR -->
	       		 <div class="col-md-3">
	       		 	<h3>Subscribe to Newsletter</h3>
	       		 	<form method="post">
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
						<span><input name="email" class="textbox" type="email" placeholder="Enter Your Email Id" style="width:100%;"></span>
						<span><input class="" value="subscribe" name="subscribe" style="width:100%;" type="submit"></span>
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
					 <?php 
                         $result=$this->db->query("select front_page_description from tbl_front_page where front_page_name='About Us'")->row();
			               if($result)
		                   { ?>
					 
				 	    <div class="col-md-12"><h4 style="background: #ffcc33;color: #fff">About Us</h4></div>
				 	 	    <?php echo $result->front_page_description;?>
							  
							    
							    
							
							   
							   
							 
							    
							    
							  
							   <?php }?> 
							  
						  
					    </div>
				
				
				
				 </div>	
	       		 <!-- END right SIDE BARR -->
	       		
   
		   <div class="clearfix"></div>		
	  </div>
	<!-- end content -->
</div>
</div>