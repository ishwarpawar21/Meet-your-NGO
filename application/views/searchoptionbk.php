<?php



//print_r($this->session->userdata('locality_array'));

//print_r($this->session->userdata('language_array'));

//print_r($this->session->userdata('days_array'));

//print_r($this->session->userdata('time_array'));

//print_r($this->session->userdata('operation_array'));

//exit();

$query_nm="select * from organisation INNER JOIN organisation_volunteer_opportunity  ON organisation.o_email = organisation_volunteer_opportunity.o_email where organisation.status = '1'  ";

$sub_query1="";

//$loc_array=$this->session->userdata('locality_array');





if($this->session->userdata('locality_array'))

{

  $xx=1;

  foreach($this->session->userdata('locality_array') as $vals)

  {

	if($xx==1)

	{

		$sub_query1 = $sub_query1 . " and (organisation.o_locality like '%".$vals."%'";	

		$xx=2;

	}	

	else

	{

		$sub_query1 = $sub_query1 . " or organisation.o_locality like '%".$vals."%'";	

	}

	

  }
  $sub_query1 = $sub_query1 .")";
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

		$sub_query_sub = $sub_query_sub . " and (organisation_volunteer_opportunity.oo_language like '%".$vall."%'";	

		$xxl=2;

	}	

	else

	{

		$sub_query_sub = $sub_query_sub . " or organisation_volunteer_opportunity.oo_language like '%".$vall."%'";	

	}

	

 }
 $sub_query_sub = $sub_query_sub .")";
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

		$sub_query_sub = $sub_query_sub . " and (organisation_volunteer_opportunity.oo_volunteer_time_slot like '%".$valt."%'";	

		$xxt=2;

	}	

	else

	{

		$sub_query_sub = $sub_query_sub . " or organisation_volunteer_opportunity.oo_volunteer_time_slot like '%".$valt."%'";	

	}

	

 }
 $sub_query_sub = $sub_query_sub .")";
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

		$sub_query_sub = $sub_query_sub . " and (organisation_volunteer_opportunity.oo_days_week like '%".$vald."%'";	

		$xxd=2;

	}	

	else

	{

		$sub_query_sub = $sub_query_sub . " or organisation_volunteer_opportunity.oo_days_week like '%".$vald."%'";	

	}

	

 }
 $sub_query_sub = $sub_query_sub .")";
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

		$sub_query_sub = $sub_query_sub . " and (organisation_volunteer_opportunity.oo_category like '%".$valo."%'";	

		$xxo=2;

	}	

	else

	{

		$sub_query_sub = $sub_query_sub . " or organisation_volunteer_opportunity.oo_category like '%".$valo."%'";	

	}

	

 }

$sub_query_sub = $sub_query_sub .")";

}




























    $query_nm=$query_nm. $sub_query_sub;
    //echo "query". $query_nm;
    
    //echo "second query". $sub_query_sub;
	//exit();
	$result=$this->db->query($query_nm);

	if($result->result() > 0)

	{

		foreach($result->result() as $row)

		{
         echo $row->id;
//$query_sub="select * from organisation_volunteer_opportunity WHERE status = '1' and o_email='".$row->o_email."'";





//$query_sub=$query_sub.$sub_query_sub;



			

			

			

			//$row1=$this->db->query($query_sub)->row();		

			//if($row1)

			//{

 ?>

<!-- ngo start -->

					<div class="col-md-12" style="margin: 10px 0; padding:0px;border: 1px solid #efefef">

						<h4 style="padding:5px 10px; background: #ffcc33;color: #fff;text-transform: uppercase">

							<?=$row->o_name_of_org?>

						</h4>
                       
                        
                 
						<div class="col-md-3" style="text-align: center">

							<img src="<?=base_url()?>../site_assets/images/ngo/<?=$row->id?>.jpg" width="150"  height="150" alt="" />

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

							

								

								

								<a href="<?=base_url()?>site/volunteers_reg" style="text-decoration:none;cursor:pointer "><h4 style="margin:10px 0; text-align:center; width:100%; background:#ccc;color:#fff; padding:10px 0px;font-size: 12px">Sign in as volenter to post your experience</h4></a>

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

									<p><?=$row->oo_desc?></p>

								</div>

							</div>

							 

							<div class="col-md-6" style="padding:0;margin: 10px 0;">

							  	<h4 style="background: #efefef;color: #999;padding:5px; font-weight:bold;">

							  		Volunteering Opportunities 

							  	</h4>

								<div style="padding:0 20px">

									<strong>Opportunity :</strong><?=$row->oo_title?><br/>

									<strong>Number of Volunteers needed : </strong><?=$row->oo_num_vol?><br/>

									<strong>Days Of Week : </strong> <?=$row->oo_days_week?> <br/>

									<strong>Category : </strong> <?=$row->oo_category?> <br/>

									<strong>Profile : </strong><br/> <?=$row->oo_volunteer_profile?> 

									

								</div>

							</div>

						</div>

					</div> 

					<!-- ngo end -->

					

<?php		

			//}	

		}

	}

?>	