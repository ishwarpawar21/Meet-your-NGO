<div class="container">
<div class="women_main">
	<!-- start content -->
			<div class="row single">
			 <!-- Left SIDE BAAR -->
	       		 <div class="col-md-3">
	       		 	<h3>Subscribe to Newsletter</h3>
	       		 	<form>
	       		 	<div class="contact-form">
	       		 		<p>This is description. This is description. This is description. This is description. This is description. This is description. </p>
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
					<h2>Volunteer Registration</h2>
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
 			
					 <form method="post">
					 
				 	  	 	 <div class="col-md-12"><h4 style="background: #ffcc33;color: #fff">Personal Details</h4></div>
				 	 	    	<div class="col-md-12">
							    	<div class="col-md-6">
								    	<span><label>First Name</label></span>
								    	<span><input name="v_fname" class="textbox" type="text" placeholder="First Name" value="<?=set_value('v_fname')?>"></span>
								  <?php echo '<span style="color:red">'.form_error('v_fname').'</span>'; ?>
								    </div>
								    <div class="col-md-6">
								    	<span><label>Last Name</label></span>
								    	<span><input name="v_lname" class="textbox" type="text"  placeholder="Last Name" value="<?=set_value('v_lname')?>"></span>
							    <?php echo '<span style="color:red">'.form_error('v_lname').'</span>'; ?>
								    </div>
							    </div>
							    <div class="col-md-12">
							    
							    	<div class="col-md-6">
							    		<span><label>E-mail</label></span>
							    		<span><input name="v_email" class="textbox" type="email" placeholder="Email Address" value="<?=set_value('v_email')?>" ></span>
							    	<?php echo '<span style="color:red">'.form_error('v_email').'</span>'; ?>
							    	</div>
								    <div class="col-md-6">
								     	<span><label>Mobile</label></span>
								    	<span><input name="v_mob_no" class="textbox" type="text" placeholder="Mobile Number" value="<?=set_value('v_mob_no')?>" ></span>
								    	<?php echo '<span style="color:red">'.form_error('v_mob_no').'</span>'; ?>
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
							    		<span><label>Date Of Birth</label></span>
							    		<span>
							    		<div class="col-md-4" style="padding: 0;margin:0">
							    		<select name="v_dd">
							    			<option value disabled="" selected="">DAY</option>
							    		<?php 
							    			for($i=1;$i<=31;$i++)
							    			{
										?>
												<option value="<?=$i?>" <?php if(set_value('v_dd')==$i){ echo 'selected=""';}?> ><?=$i?></option>
										<?php		
											}
							    		?>	
							    		</select>
							    		</div>
							    		<div class="col-md-4" style="padding: 0;margin:0">
							    		<select name="v_mm">
							    			<option value disabled="" selected="">MONTH</option>
							    		<?php 
							    			for($i=1;$i<=12;$i++)
							    			{
										?>
												<option value="<?=$i?>"  <?php if(set_value('v_mm')==$i){ echo 'selected=""';}?> ><?=$i?></option>
										<?php		
											}
							    		?>	
							    		</select>
							    		</div>
							    		<div class="col-md-4" style="padding: 0;margin:0">
							    		<select name="v_yy">
							    			<option value disabled="" selected="">YEAR</option>
							    		<?php 
							    			for($i=1970;$i<=2000;$i++)
							    			{
										?>
												<option value="<?=$i?>"  <?php if(set_value('v_yy')==$i){ echo 'selected=""';}?> ><?=$i?></option>
										<?php		
											}
							    		?>	
							    		
							    		</select>
							    		</div>
							    		</span>
							    		<?php echo '<span style="color:red">'.form_error('v_dd').'</span>'; ?>
							    		<?php echo '<span style="color:red">'.form_error('v_mm').'</span>'; ?>
							    		<?php echo '<span style="color:red">'.form_error('v_yy').'</span>'; ?>
							    	</div>
								    <div class="col-md-6">
							    		<span><label>Gender</label></span>
							    		<div class="col-md-6">
							    			<span>
							    				<input  name="v_gender" value="Male" class="textbox" type="radio" placeholder="Organisation  Email Address" <?php if(set_value('v_gender')=="Male"){ echo 'checked=""';}?>  > Male
							    				</div>
							    		<div class="col-md-6">
							    				<input name="v_gender" value="Female" class="textbox" type="radio" placeholder="Organisation  Email Address" <?php if(set_value('v_gender')=="Female"){ echo 'checked=""';}?> > Female
							    			</span>
							    		</div>
							    		
							    		<?php echo '<span style="color:red">'.form_error('v_gender').'</span>'; ?>
							    	</div>
							    </div>
							    
							    
							    <div class="col-md-12">
							    	 	<span><label>Address</label></span>
							    		<span><textarea name="v_address" placeholder="Organisation Address" style="width:98.3333%; height: 60px"><?=set_value('v_address')?></textarea></span>
							    		<?php echo '<span style="color:red">'.form_error('v_address').'</span>'; ?>
							    </div>	 
							   
							   
							   
							     <div class="col-md-12">
							    
							    	<div class="col-md-6">
							    		<span><label>State</label></span>
							    		<span>
							    			
							    			<select name="v_state">
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
							    		<?php echo '<span style="color:red">'.form_error('v_state').'</span>'; ?>
							    	</div>
								    <div class="col-md-6">
							    		<span><label>City</label></span>
							    		<span>
							    			<select name="v_city">
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
							    		<?php echo '<span style="color:red">'.form_error('v_city').'</span>'; ?>
							    	</div>
							    </div>
							    
							    
							    <div class="col-md-12">
							    
							    	<div class="col-md-6">
							    		<span><label>Pin Code</label></span>
							    		<span><input name="v_pincode" class="textbox" type="text" placeholder="Pin Code" value="<?=set_value('v_pincode')?>"></span>
							    		<?php echo '<span style="color:red">'.form_error('v_pincode').'</span>'; ?>
							    	</div>
								    
							    </div>
							    
							    <div class="col-md-12" style="margin: 10px">
							    	<span><input type="checkbox" required="" checked=""/> I agree to meetyourNGO's terms and Condtions</span>
							    </div>
							   <div>
							   		<span><input name="volinteer_reg" value="Submit us" type="submit"></span>
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