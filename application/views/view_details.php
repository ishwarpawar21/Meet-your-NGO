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
	
	//echo "hel";
	//echo $_GET['email_id'];
	//exit;
	$row = $this->db->query("select * from organisation where o_email='".$_GET['email_id']."'")->row();
	if($row)
	{
		$row1 = $this->db->query("select * from organisation_volunteer_opportunity where o_email='".$_GET['email_id']."'")->row();
	}
	
	?>
	
	
	<div class="col-md-12" style="margin: 10px 0; padding:0px;border: 1px solid #efefef">

						<h4 style="padding:5px 10px; background: #ffcc33;color: #fff;text-transform: uppercase">

							<?=$row->o_name_of_org?>

						</h4>
                       
                        
                 
						<div class="col-md-3" style="text-align: center">

							<img src="<?=base_url()?>../site_assets/images/ngo/<?=$row1->id?>.jpg" width="150"  height="150" alt="" />

						</div>
                       
						

						<div class="col-md-6" style="padding-left: 10px;padding-right: 10px;">

						

							<strong>Address : </strong><br/>

							<?=$row->o_address?>,<br/><?=$row->o_state?>,<br/> <?=$row->o_city?> - <?=$row->o_pin_code?><br/>

							<p><strong>Phone :</strong> <?=$row->o_org_phone?></p>

							<p><strong>Email :</strong> <?=$row->o_email?></p>

						</div>

						

						<div class="col-md-12" style="padding:0; margin: 10px 0;">

							<div class="col-md-6" style="padding:0; margin: 10px 0;">

								<h4 style="background: #efefef;color: #999;padding:5px; font-weight:bold;">

									Brief Summary

								</h4>

								<div style="padding: 0 20px;">

									<p><?=$row1->oo_desc?></p>

								</div>

							</div>

							 

							<div class="col-md-6" style="padding:0;margin: 10px 0;">

							  	<h4 style="background: #efefef;color: #999;padding:5px; font-weight:bold;">

							  		Volunteering Opportunities 

							  	</h4>

								<div style="padding:0 20px">

									<strong>Opportunity :</strong><?=$row1->oo_title?><br/>

									<strong>Number of Volunteers needed : </strong><?=$row1->oo_num_vol?><br/>

									<strong>Days Of Week : </strong> <?=$row1->oo_days_week?> <br/>

									<strong>Category : </strong> <?=$row1->oo_category?> <br/>

									<strong>Profile : </strong><br/> <?=$row1->oo_volunteer_profile?> 

									

								</div>

							</div>

						</div>

					</div>
	       		 <!-- END right SIDE BARR -->
	       		
   
		   	
	
							  
						  
					    </div>
				
				
				
				 </div>	
	       		 <!-- END right SIDE BARR -->
	       		
   
		   <div class="clearfix"></div>		
	  </div>
	<!-- end content -->
</div>
</div>
	
	
	
	
	
	
	