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
$this->session->unset_userdata('reg_error');
}
      
	$q = $this->db->query("select * from organisation where o_email='".$this->session->userdata('username')."'")->row();
   
?>
 
					 <form method="post" >
					   <input name="id" type="hidden" value="<?=$q->id?>">
				 	  	 	 
				 	 	    	<div class="col-md-12">
						
							    
							    
							    <div class="col-md-12"><h4 style="background: #ffcc33;color: #fff">Organizational Details</h4></div>
							    
							     <div class="col-md-12">
							    
							    	<div class="col-md-6">
							    		<span><label>Name Of Organisation</label></span>
							    		<span><input name="o_name_of_org" class="textbox" type="text" placeholder="Organisation Name" value="<?=$q->o_name_of_org?>"></span>
							    		<?php echo '<span style="color:red">'.form_error('o_name_of_org').'</span>'; ?>
							    	</div>
								    <div class="col-md-6">
							    		<span><label>E-mail</label></span>
							    		<span><input name="o_org_email" class="textbox" type="email" placeholder="Organisation  Email Address" value="<?=$q->o_org_email?>" required=""></span>
							    		<?php echo '<span style="color:red">'.form_error('o_org_email').'</span>'; ?>
							    	</div>
							    </div>
							    
							    
							    <div class="col-md-12">
							    	 	<span><label>Address</label></span>
							    		<span><textarea name="o_address" placeholder="Organisation Address" style="width:98.3333%; height: 60px"><?=$q->o_address?></textarea></span>
							    		<?php echo '<span style="color:red">'.form_error('o_address').'</span>'; ?>
							    </div>	 
							   
							   
							   
							      <div class="col-md-12">
							    
							    	<div class="col-md-6">
							    		<span><label>State</label></span>
							    		<span>
							    			
							    			
							    			<select class="form-control" name="o_state" id="o_state">
                                              <?php 
                                              $result=$this->db->query("select * from state_table");
			                                  if($result->result() > 0)
		                                      {
		                                       foreach($result->result() as $row)
		                                       {
		         	                         ?>
                                                 <option><?=$row->state_name;?></option>
              
                                           <?php
                                              }
                                              }else{ ?>
                                               <option>No state inserted</option>
                                            <?php } ?>
                                            </select>
							    		</span>
							    		<?php echo '<span style="color:red">'.form_error('o_state').'</span>'; ?>
							    	</div>
								    <div class="col-md-6">
							    		<span><label>City</label></span>
							    		<span>
							    		
							    			<select class="form-control" name="o_city" id="o_city">
                                              <?php 
                                              $result=$this->db->query("select * from city_table");
			                                  if($result->result() > 0)
		                                      {
		                                       foreach($result->result() as $row)
		                                       {
		         	                         ?>
                                                 <option><?=$row->city_name;?></option>
              
                                              <?php
                                              }
                                              }else{ ?>
                                               <option>No state inserted</option>
                                            <?php } ?>
                                            </select>
							    			
							    		</span>
							    		<?php echo '<span style="color:red">'.form_error('o_city').'</span>'; ?>
							    	</div>
							    </div>
							    
							    
							    <div class="col-md-12">
							    
							    	<div class="col-md-6">
							    		<span><label>Pin Code</label></span>
							    		<span><input name="o_pin_code" class="textbox" type="text" placeholder="Pin Code" value="<?=$q->o_pin_code?>"></span>
							    		<?php echo '<span style="color:red">'.form_error('o_pin_code').'</span>'; ?>
							    	</div>
								    <div class="col-md-6">
							    		<span><label>Organisation Phone Number</label></span>
							    		<span><input name="o_org_phone" class="textbox" type="text" placeholder="Phone Number" value="<?=$q->o_org_phone?>"></span>
							    		<?php echo '<span style="color:red">'.form_error('o_org_phone').'</span>'; ?>
							    	</div>
							    </div>
							    
							    
							   <div>
							   		<span><input name="update_org" value="Submit us" type="submit"></span>
							  </div>
						    </form>
					    </div>
				
				
				
				 </div>	