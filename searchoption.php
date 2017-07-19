<?php

//print_r($this->session->userdata('locality_array'));
//print_r($this->session->userdata('language_array'));
//print_r($this->session->userdata('days_array'));
//print_r($this->session->userdata('time_array'));
//print_r($this->session->userdata('operation_array'));
//exit();
$query_nm="select * from organisation where status = '1'  ";
$sub_query1="";
//$loc_array=$this->session->userdata('locality_array');


if($this->session->userdata('locality_array'))
{
  $xx=1;
  foreach($this->session->userdata('locality_array') as $vals)
  {
	if($xx==1)
	{
		$sub_query1 = $sub_query1 . " and o_locality like '%".$vals."%'";	
		$xx=2;
	}	
	else
	{
		$sub_query1 = $sub_query1 . " or o_locality like '%".$vals."%'";	
	}
	
  }
}

$query_nm=$query_nm.$sub_query1;
//echo $query_nm.$sub_query1; 
//exit; oo_language


/// for second loop

// for language
//$language_array=$this->session->userdata('language_array');

$sub_query_sub="";
if($this->session->userdata('language_array'))
{
	
$xxl=1;
 foreach($this->session->userdata('language_array') as $vall)
 {
	if($xxl==1)
	{
		$sub_query_sub = $sub_query_sub . " and oo_language like '%".$vall."%'";	
		$xxl=2;
	}	
	else
	{
		$sub_query_sub = $sub_query_sub . " or oo_language like '%".$vall."%'";	
	}
	
 }
}
//$query_sub=$query_sub.$sub_query_sub;


// time_slot

//$time_array=$this->session->userdata('time_array');


if($this->session->userdata('time_array'))
{
 $xxt=1;	
 foreach($this->session->userdata('time_array') as $valt)
 {
	if($xxt==1)
	{
		$sub_query_sub = $sub_query_sub . " and oo_volunteer_time_slot like '%".$valt."%'";	
		$xxt=2;
	}	
	else
	{
		$sub_query_sub = $sub_query_sub . " or oo_volunteer_time_slot like '%".$valt."%'";	
	}
	
 }
}
//$query_sub=$query_sub.$sub_query_sub;


// days_array

//$days_array=$this->session->userdata('days_array');

if($this->session->userdata('days_array')){
 $xxd=1;
 foreach($this->session->userdata('days_array') as $vald)
 {
	if($xxd==1)
	{
		$sub_query_sub = $sub_query_sub . " and oo_days_week like '%".$vald."%'";	
		$xxd=2;
	}	
	else
	{
		$sub_query_sub = $sub_query_sub . " or oo_days_week like '%".$vald."%'";	
	}
	
 }
}
//$query_sub=$query_sub.$sub_query_sub;

//oo_desired_skill
//$operation_array=$this->session->userdata('operation_array');
if($this->session->userdata('operation_array'))
{
 $xxo=1;
 foreach($this->session->userdata('operation_array') as $valo)
 {
	if($xxo==1)
	{
		$sub_query_sub = $sub_query_sub . " and oo_desired_skill like '%".$valo."%'";	
		$xxo=2;
	}	
	else
	{
		$sub_query_sub = $sub_query_sub . " or oo_desired_skill like '%".$valo."%'";	
	}
	
 }

}















	$result=$this->db->query($query_nm);
	if($result->result() > 0)
	{
		foreach($result->result() as $row)
		{
$query_sub="select * from organisation_volunteer_opportunity WHERE status = '1' and o_email='".$row->o_email."'";
//$sub_query_sub="";

$query_sub=$query_sub.$sub_query_sub;
//echo $query_sub;
//exit();
			
			
			
			$row1=$this->db->query($query_sub)->row();		
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