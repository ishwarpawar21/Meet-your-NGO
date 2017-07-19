<div class="container">
<div class="women_main">
	<!-- start content -->
			<div class="row single">
			
	<script type="text/javascript">
        $(document).ready(function () {
            window.asd = $('.SlectBox').SumoSelect({ csvDispCount: 3 });
            window.test = $('.testsel').SumoSelect({okCancelInMulti:true });
            window.testSelAll = $('.testSelAll').SumoSelect({okCancelInMulti:true, selectAll:true });
            window.testSelAll2 = $('.testSelAll2').SumoSelect({selectAll:true });
        });
    </script>
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
					<h2>Organisation Registration Step I</h2>
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
					 
				 	  	 	 <div class="col-md-12"><h4 style="background: #ffcc33;color: #fff">Personal Details</h4></div>
				 	 	    	<div class="col-md-12">
							    	<div class="col-md-6">
								    	<span><label>First Name</label></span>
								    	<span><input name="o_fname" class="textbox" type="text" placeholder="First Name" value="<?=set_value('o_fname')?>"></span>
								    	<?php echo '<span style="color:red">'.form_error('o_fname').'</span>'; ?>
								    </div>
								    <div class="col-md-6">
								    	<span><label>Last Name</label></span>
								    	<span><input name="o_lname" class="textbox" type="text"  placeholder="Last Name" value="<?=set_value('o_lname')?>"></span>
								    	<?php echo '<span style="color:red">'.form_error('o_lname').'</span>'; ?>
								    </div>
							    </div>
							    <div class="col-md-12">
							    
							    	<!--<div class="col-md-6">
							    		<span><label>E-mail</label></span>
							    		<span><input name="o_email" class="textbox" type="email" placeholder="Email Address" value="<?=set_value('o_email')?>"></span>
							    		<?php echo '<span style="color:red">'.form_error('o_email').'</span>'; ?>
							    	</div> -->
								    <div class="col-md-6">
								    
								     	<span><label>Mobile</label></span>
								    	<span><input name="o_mob" class="textbox" type="text" placeholder="Mobile Number" value="<?=set_value('o_mob')?>"></span>
								    	<?php echo '<span style="color:red">'.form_error('o_mob').'</span>'; ?>
								    </div>
							    </div>
							    
							    
							    
							    
							    <div class="col-md-12"><h4 style="background: #ffcc33;color: #fff">Organizational Details</h4></div>
							    
							     <div class="col-md-12">
							    
							    	<div class="col-md-6">
							    		<span><label>Name Of Organisation</label></span>
							    		<span><input name="o_name_of_org" class="textbox" type="text" placeholder="Organisation Name" value="<?=set_value('o_name_of_org')?>"></span>
							    		<?php echo '<span style="color:red">'.form_error('o_name_of_org').'</span>'; ?>
							    	</div>
								    <div class="col-md-6">
							    		<span><label>E-mail</label></span>
							    		<span><input name="o_org_email" class="textbox" type="email" placeholder="Organisation  Email Address" value="<?=set_value('o_org_email')?>" required=""></span>
							    		<?php echo '<span style="color:red">'.form_error('o_org_email').'</span>'; ?>
							    	</div>
							    </div>
							    
							    
							    <div class="col-md-12">
							    	 	<span><label>Address</label></span>
							    		<span><textarea name="o_address" placeholder="Organisation Address" style="width:98.3333%; height: 60px"><?=set_value('o_address')?></textarea></span>
							    		<?php echo '<span style="color:red">'.form_error('o_address').'</span>'; ?>
							    </div>	 
							   <div class="col-md-12">
							    	 	<div class="col-md-6">
							    		<span><label>Locality</label></span>
							    		<span>
							    			
							    			
							    			<select  multiple="multiple"  class="SlectBox" name="o_locality[]" id="o_locality">
                                              <?php 
                                              $result=$this->db->query("select * from locatity_table");
			                                  if($result->result() > 0)
		                                      {
		                                       foreach($result->result() as $row)
		                                       {
		         	                         ?>
                                                 <option ><?=$row->locatity_name;?></option>
                                          
                                           <?php
                                              }
                                              }else{ ?>
                                               <option>No locality inserted</option>
                                            <?php } ?>
                                            </select>
							    		</span>
							    		<?php echo '<span style="color:red">'.form_error('o_locality').'</span>'; ?>

							    	</div>
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
							    		<span><input name="o_pin_code" class="textbox" type="text" placeholder="Pin Code" value="<?=set_value('o_pin_code')?>"></span>
							    		<?php echo '<span style="color:red">'.form_error('o_pin_code').'</span>'; ?>
							    	</div>
								    <div class="col-md-6">
							    		<span><label>Organisation Phone Number</label></span>
							    		<span><input name="o_org_phone" class="textbox" type="text" placeholder="Phone Number" value="<?=set_value('o_org_phone')?>"></span>
							    		<?php echo '<span style="color:red">'.form_error('o_org_phone').'</span>'; ?>
							    	</div>
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