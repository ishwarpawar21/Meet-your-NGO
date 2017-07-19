<div class="container">
<div class="women_main">
	<!-- start content -->
			<div class="row single">
			
			
			
				<div class="col-md-12">
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
                         $result=$this->db->query("select front_page_description from tbl_front_page where front_page_name='Terms and Condition'")->row();
			               if($result)
		                   { ?>
					 
				 	    <div class="col-md-12"><h4 style="background: #ffcc33;color: #fff">Terms and Condition</h4></div>
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