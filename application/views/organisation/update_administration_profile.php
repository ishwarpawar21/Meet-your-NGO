		<div class="col-md-9">
					<div class="sky-form contact-form">
				
<?php 
if($this->session->userdata('error_msg'))
{
?>					
<div class="col-md-12" style="background: #" >
	<div class="alert alert-<?=$this->session->userdata('error_cls')?> alert-dismissable" style="padding: 10px;">
       <?=$this->session->userdata('error_msg')?>
     </div>
</div>
<?php
$this->session->unset_userdata('error_msg');
}
      
     
	$q = $this->db->query("select * from organisation where o_email='".$this->session->userdata('username')."'")->row();
    if($q){
    
?>
 			          
					 <form method="post">
					  <input name="id" type="hidden" value="<?=$q->id?>">
				 	  	 	 <div class="col-md-12"><h4 style="background: #ffcc33;color: #fff">Personal Details</h4></div>
				 	 	    	<div class="col-md-12">
							    	<div class="col-md-6">
								    	<span><label>First Name</label></span>
								    	<span><input name="v_fname" class="textbox" type="text" placeholder="First Name" value="<?=$q->o_fname?>"></span>
								  <?php echo '<span style="color:red">'.form_error('v_fname').'</span>'; ?>
								    </div>
								    <div class="col-md-6">
								    	<span><label>Last Name</label></span>
								    	<span><input name="v_lname" class="textbox" type="text"  placeholder="Last Name" value="<?=$q->o_lname?>"></span>
							    <?php echo '<span style="color:red">'.form_error('v_lname').'</span>'; ?>
								    </div>
							    </div>
							    <div class="col-md-12">
							    
							     
								    <div class="col-md-6">
								     	<span><label>Mobile</label></span>
								    	<span><input name="v_mob_no" class="textbox" type="text" placeholder="Mobile Number" value="<?=$q->o_mob?>" ></span>
								    	<?php echo '<span style="color:red">'.form_error('v_mob_no').'</span>'; ?>
								    </div>
							    </div>
							    
							    
							    
							 
							   <div>
							   		<span><input name="update_org_admin" value="Update" type="submit"></span>
							  </div>
						    </form>
<?php
}
?>                            
					    </div>
				
				
				
				 </div>	