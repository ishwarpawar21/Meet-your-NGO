	<?php
	$row = $this->db->query("select * from organisation where o_email='".$this->session->userdata('username')."'")->row();
	if($row)
	{
		$row1 = $this->db->query("select * from organisation_volunteer_opportunity where o_email='".$this->session->userdata('username')."'")->row();
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
	       		
   
		   <div class="clearfix"></div>		
	