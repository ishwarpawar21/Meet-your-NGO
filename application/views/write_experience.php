<?php

	$ngo_id=base64_decode($_GET['ngo_id']);
?>

<!-- content -->
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
//$this->session->unset_userdata('error_msg');
}

	$row=$this->db->query("select * from organisation where id = '".$ngo_id."' ")->row();
	if($row)
	{
			$row1=$this->db->query("select * from organisation_volunteer_opportunity WHERE status = '1' and o_email='".$row->o_email."'")->row();		
			if($row1)
			{
				$img_id=$row1->id;
			}
 ?>
<!-- ngo start -->
					<div class="col-md-12" style="margin: 10px 0; padding:0px;border: 1px solid #efefef">
						<h4 style="padding:5px 10px; background: #ffcc33;color: #fff;text-transform: uppercase">
							<?=$row->o_name_of_org?>
						</h4>
						<div class="col-md-3" style="text-align: center">
							<img src="<?=base_url()?>../site_assets/images/ngo/<?=$img_id?>.jpg" width="150"  height="150" />
						</div>
						
						<div class="col-md-9" style="padding-left: 10px;padding-right: 10px;">
						
							<strong>Address : </strong><br/>
							<?=$row->o_address?>,<br/><?=$row->o_state?>,<br/> <?=$row->o_city?> - <?=$row->o_pin_code?><br/>
							<p><strong>Phone :</strong> <?=$row->o_org_phone?></p>
							<p><strong>Email :</strong> <?=$row->o_email?></p>
						</div>
						
						<div class="col-md-12" style="padding:0; margin: 10px 10px;">
							
							<h4>Write Your Experience Here</h4>
							<div class="contact-form">
								<form method="POST">
									<input type="hidden" value="<?=base64_encode($ngo_id)?>" name="ngo_id"/>
									<input type="hidden" value="<?=base64_encode($this->session->userdata('username'))?>" name="vol_id"/>
									
									<span><textarea name="your_exp"></textarea></span>
									<?php echo '<span style="color:red">'.form_error('your_exp').'</span>';?>
									
									<span><input type="submit" name="write_exp" value="Submit Your experience"></span>
								</form>
							</div>
							
							 
						</div>
					</div>
					<!-- ngo end -->
					
<?php		
		 }	
?>					
					
		 			
				</div>	
	       		 <!-- END right SIDE BARR -->
	 	   <div class="clearfix"></div>		
	  </div>
	<!-- end content -->
</div>
</div>