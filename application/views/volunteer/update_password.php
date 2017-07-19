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
					 
				 	  	 	 <div class="col-md-12"><h4 style="background: #ffcc33;color: #fff">Change password</h4></div>
				 	 	    	<div class="col-md-12">
							    	<div class="col-md-6">
								    	<span><label>Enter current password</label></span>
								    	<span><input name="current_password" class="textbox" type="password" placeholder="current password"></span>
								    	<?php echo '<span style="color:red">'.form_error('current_password').'</span>'; ?>
								    </div>
								    
							    </div>
							    <div class="col-md-12">
							    
							    	<div class="col-md-6">
							    		<span><label>Enter new passord</label></span>
							    		<span><input name="new_password" class="textbox" type="password" placeholder="Enter new password" value="<?=set_value('o_email')?>"></span>
							    		<?php echo '<span style="color:red">'.form_error('new_password').'</span>'; ?>
							    	</div>
								    
							    </div>
							    
							    <div class="col-md-12">
							    
							    	<div class="col-md-6">
							    		<span><label>Re-enter password</label></span>
							    		<span><input name="rnew_password" class="textbox" type="password" placeholder="Re-enter new password"></span>
							    		<?php echo '<span style="color:red">'.form_error('rnew_password').'</span>'; ?>
							    	</div>
								    
							    </div>
							    
							    
							    
							   <div>
							   		<span><input name="change_password" value="Change" type="submit"></span>
							  </div>
						    </form>
					    </div>
				
				
				
				 </div>	
	       		 <!-- END right SIDE BARR -->
	       		
   
		   <div class="clearfix"></div>		
	  </div>