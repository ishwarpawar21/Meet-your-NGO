<!-- content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<div class="container">
<div class="women_main">

	<!-- start content -->
			<div class="row single">
			
			
			 <!-- Left SIDE BAAR -->
	       		 <div class="col-md-3">
	  <div class="w_sidebar">
		  
		<section  class="sky-form">
					<h4>Locality</h4>
						<div class="row1 scroll-pane">
							 
							<div class="col col-4">
							 <?php 
                $result_loc=$this->db->query("select * from locatity_table");
			    if($result_loc->result() > 0)
		        {
		         foreach($result_loc->result() as $row_loc)
		         {
		         	?>
                            <label class="checkbox"><input type="checkbox" name="checkbox" value="<?=$row_loc->locatity_name;?>" onchange = "searchdata(this)"><i></i><?=$row_loc->locatity_name;?></label>
                           
              
                <?php
                 }
                } ?>
                       							
			                  </div>
						</div>
		</section>
<script type="text/javascript">
		var locality_list = [];
 function searchdata(element){
    
	 $.ajax({url: "<?php echo base_url(); ?>" + "ajax_post_controller/searchopt/test?valabc="+element.value,
             success: function(output) {
                alert(output);
                //$('#'+list_target_id).html(output);
            },
          error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " "+ thrownError);
          }});

	//alert($this->session->userdata('locality_data'));
  
}

</script>
		
		
		<section class="sky-form">
						<h4>Fields OF Operation</h4>
						<div class="row1 scroll-pane">
							<div class="col col-4">
							 <?php 
                $result_field=$this->db->query("select * from field_of_operation_table");
			    if($result_field->result() > 0)
		        {
		         foreach($result_field->result() as $row_field)
		         {
		         	?>
                      <label class="checkbox"><input type="checkbox" name="checkbox"><i></i><?=$row_field->field_of_operation;?></label>
                           
              
                <?php
                 }
                } ?>
                       							
			                  </div>
						</div>						
		</section>
		
		<section class="sky-form">
						<h4>Language</h4>
						<div class="row1 scroll-pane">
							<div class="col col-4">
							 <?php 
                $result_lang=$this->db->query("select * from language_table");
			    if($result_lang->result() > 0)
		        {
		         foreach($result_lang->result() as $row_lang)
		         {
		         	?>
                            <label class="checkbox"><input type="checkbox" name="checkbox"><i></i><?=$row_lang->language;?></label>
                           
              
                <?php
                 }
                } ?>
                       							
			                  </div>
						</div>						
		</section>
		
		<section class="sky-form">
						<h4>Days Of Weeks</h4>
						<div class="row1 scroll-pane">
							<div class="col col-4">
							 <?php 
                $result_weekdays=$this->db->query("select * from days_of_week_table");
			    if($result_weekdays->result() > 0)
		        {
		         foreach($result_weekdays->result() as $row_weekdays)
		         {
		         	?>
                            <label class="checkbox"><input type="checkbox" name="checkbox"><i></i><?=$row_weekdays->days_of_week;?></label>
                           
              
                <?php
                 }
                } ?>
                       							
			                  </div>
						</div>						
		</section>
		
		<section class="sky-form">
						<h4>Time Slot</h4>
						<div class="col col-4">
							 <?php 
                $result_ts=$this->db->query("select * from time_slot_table");
			    if($result_ts->result() > 0)
		        {
		         foreach($result_ts->result() as $row_ts)
		         {
		         	?>
                            <label class="checkbox"><input type="checkbox" name="checkbox"><i></i><?=$row_ts->time_slot;?></label>
                           
              
                <?php
                 }
                } ?>
                       							
			                  </div>					
		</section>
	</div>
   </div>
   
   <!-- // END Left SIDE BAR -->
			<!-- Right SIDE BARR -->
				<div class="col-md-9">
<?php
	$result=$this->db->query("select * from organisation where status = '1' ");
	if($result->result() > 0)
	{
		foreach($result->result() as $row)
		{
			$row1=$this->db->query("select * from organisation_volunteer_opportunity WHERE status = '1' and o_email='".$row->o_email."'")->row();		
			if($row1)
			{
 ?>
<!-- ngo start -->
					<div class="col-md-12" style="margin: 10px 0; padding:0px;border: 1px solid #efefef">
						<h4 style="padding:5px 10px; background: #ffcc33;color: #fff;text-transform: uppercase">
							<?=$row->o_name_of_org?>
						</h4>
						<div class="col-md-3" style="text-align: center">
							<img src="<?=base_url()?>../site_assets/images/ngo/<?=$row1->id?>.jpg" width="150"  height="150" />
						</div>
						
						<div class="col-md-6" style="padding-left: 10px;padding-right: 10px;">
						
							<strong>Address : </strong><br/>
							<?=$row->o_address?>,<br/><?=$row->o_state?>,<br/> <?=$row->o_city?> - <?=$row->o_pin_code?><br/>
							<p><strong>Phone :</strong> <?=$row->o_org_phone?></p>
							<p><strong>Email :</strong> <?=$row->o_email?></p>
						</div>
						<div class="col-md-3" style="">
<?php
	if($this->session->userdata('is_logged_in')=='1' && $this->session->userdata('account_type')=='vol' )
	{
?>						
								<a href="<?=base_url()?>site/write_exp?ngo_id=<?=base64_encode($row->id)?>" style="text-decoration:none;cursor:pointer "><h4 style="margin:10px 0; text-align:center; width:100%; background:#29a6d6;color:#fff; padding: 10px;font-size: 14px">Write Your Experience</h4></a>							 							
<?php
}
else
{
?>
								<h4 style="margin:10px 0; text-align:center; width:100%; background:#ccc;color:#fff; padding:10px 0px;font-size: 12px">Sign in to post your experience</h4>
<?php	
}
?>								
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
					<!-- ngo end -->
					
<?php		
			}	
		}
	}
?>					
					
		 			
				</div>	
	       		 <!-- END right SIDE BARR -->
	 	   <div class="clearfix"></div>		
	  </div>
	<!-- end content -->
</div>
</div>