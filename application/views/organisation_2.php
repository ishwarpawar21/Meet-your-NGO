<!-- content -->
	<script type="text/javascript">
        $(document).ready(function () {
            window.asd = $('.SlectBox').SumoSelect({ csvDispCount: 3 });
            window.test = $('.testsel').SumoSelect({okCancelInMulti:true });
            window.testSelAll = $('.testSelAll').SumoSelect({okCancelInMulti:true, selectAll:true });
            window.testSelAll2 = $('.testSelAll2').SumoSelect({selectAll:true });
        });
    </script>
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
					<h2>Organisation Registration Step II</h2>
<?php 
if($this->session->userdata('success_msg'))
{
?>					
<div class="col-md-12" style="background: #" >
	<div class="alert alert-success alert-dismissable" style="padding: 10px;">
       <?=$this->session->userdata('success_msg')?>
     </div>
</div>
<?php
$this->session->unset_userdata('success_msg');
}
?>	    

<?php 
if($this->session->userdata('error_msg'))
{
?>					
<div class="col-md-12" style="background: #" >
	<div class="alert alert-success alert-dismissable" style="padding: 10px;">
       <?=$this->session->userdata('error_msg')?>
     </div>
</div>
<?php
$this->session->unset_userdata('error_msg');
}
?>	     					
					 <form method="post" enctype="multipart/form-data" >
					 <!-- Locality -->
				 	  	 	 <div class="col-md-12"><h4 style="background: #ffcc33;color: #fff">Volunteering Opportunities</h4></div>
				 	 	    	<div class="col-md-12">
							    	<div class="col-md-6" style="padding-left: 50px">
								    	<label>Title of the Opportunity*</label>
								    	<input type="text" name="oo_title" value="<?=set_value('oo_title')?>" required=""/>
								    	<?php echo '<span style="color:red">'.form_error('oo_title').'</span>'; ?>
								    </div>
								    
								    <div class="col-md-6" style="padding-left: 50px">
								    	<label>Organisation Logo* (Jpg Only)</label>
								    	<input name="userfile" type="file" class="form-control" style="width: 96.333%"/>
								    	<?php echo '<span style="color:red">'.form_error('userfile').'</span>'; ?>
								    </div>
								    
								</div>
								
								<div class="col-md-12">
							    	<div class="col-md-12"  style="padding-left: 50px">
								    	<label>Opportunity Description*</label>
								    	<textarea name="oo_desc"><?=set_value('oo_desc')?></textarea>
								    	<?php echo '<span style="color:red">'.form_error('oo_desc').'</span>'; ?>
								    </div>
								    
								</div>
								
								<div class="col-md-12">
							    	<div class="col-md-4"  style="padding-left: 50px">
								    	<label>Category*</label>
								    	<select name="oo_category">
								    		<option value>Select Category</option>
								    		<?php 
                                               $result=$this->db->query("select * from field_of_operation_table");
			                                   if($result->result() > 0)
		                                        {
		                                          foreach($result->result() as $row)
		                                           {
		         	                                  ?>
                                                      <option><?=$row->field_of_operation;?></option>
              
                                             <?php
                                                    }
                                                    } ?>
								    	</select>
								    	<?php echo '<span style="color:red">'.form_error('oo_category').'</span>'; ?>
								    </div>
								    
								    <div class="col-md-4"  style="padding-left: 50px">
								    	<label>Desired Skills*</label>
								    	<input type="text" name="oo_desired_skill" value="<?=set_value('oo_desired_skill')?>" />
								    	<?php echo '<span style="color:red">'.form_error('oo_desired_skill').'</span>'; ?>
								    </div>
								    
								    <div class="col-md-4"  style="padding-left: 50px">
								    	<label>Language*</label>
								    	<select name="oo_language">
											<option value>Select Language</option>
								    		<?php 
                                               $result=$this->db->query("select * from language_table");
			                                   if($result->result() > 0)
		                                        {
		                                          foreach($result->result() as $row)
		                                           {
		         	                                  ?>
                                                      <option><?=$row->language;?></option>
              
                                             <?php
                                                    }
                                                    } ?>
                        
								    	</select>
								    	<?php echo '<span style="color:red">'.form_error('oo_language').'</span>'; ?>
								    </div>
								</div>
								
								<div class="col-md-12" style="padding-left: 50px">
							        <label>Volunteer Time Slot*</label>
							        <div class="col-md-12">
							        <select  multiple="multiple"  class="SlectBox" name="oo_volunteer_time_slot[]" id="oo_volunteer_time_slot">
                                              <?php 
                                              $result=$this->db->query("select * from time_slot_table");
			                          if($result->result() > 0)
		                               {
		                                foreach($result->result() as $row)
		                                {
		         	                         ?>
                                                 <option ><?=$row->time_slot;?></option>
                                          
                                           <?php
                                              }
                                              }else{ ?>
                                               <option>No time slot inserted</option>
                                            <?php } ?>
                                            </select>
							        
							        
							        
							        
							        
							        
								    	
								</div>
									
								</div>
								
								<div class="col-md-12" style="padding-left: 50px">
							        <div class="col-md-6">
							        	<label>Number of Volunteers needed *</label>	
							        	<input type="text" name="oo_num_vol"  value="<?=set_value('oo_num_vol')?>" />
							        	<?php echo '<span style="color:red">'.form_error('oo_num_vol').'</span>'; ?>
							        </div>
							        
							        <div class="col-md-6">
							        	<label>Days Of Week*</label>	
							        	
							        	<select  multiple="multiple"  class="SlectBox" name="oo_days_week[]" id="oo_days_week">
                                              <?php 
                                              $result=$this->db->query("select * from days_of_week_table");
			                                  if($result->result() > 0)
		                                      {
		                                       foreach($result->result() as $row)
		                                       {
		         	                         ?>
                                                 <option ><?=$row->days_of_week;?></option>
                                          
                                           <?php
                                              }
                                              }else{ ?>
                                               <option>No locality inserted</option>
                                            <?php } ?>
                                            </select>
							        	<?php echo '<span style="color:red">'.form_error('oo_days_week').'</span>'; ?>
							        </div>
							   </div>
							   
							   <div class="col-md-12">
							    	<div class="col-md-12"  style="padding-left: 50px">
								    	<label>Required Volunteer Profile</label>
								    	<textarea name="oo_volunteer_profile"><?=set_value('oo_volunteer_profile')?></textarea>
								    	<?php echo '<span style="color:red">'.form_error('oo_volunteer_profile').'</span>'; ?>
								    </div>
								</div>
	 				 	       
							   <div style="text-align:right">
							   		<span><input name="org_reg_step2" value="Continue" type="submit"></span>
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