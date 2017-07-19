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

	{?>
<div class="col-md-12" style="margin: 10px 0; padding:0px;border: 1px solid #efefef">
<table class="table table-hover">
    <thead>
      <tr>
        <th style="padding:5px 10px; background: #ffcc33;color: #fff;text-transform: uppercase">Name of NGO</th>
        <th style="padding:5px 10px; background: #ffcc33;color: #fff;text-transform: uppercase">Area of Operation</th>
        <th style="padding:5px 10px; background: #ffcc33;color: #fff;text-transform: uppercase">Brief volenteer Requirement</th>
        <th style="padding:5px 10px; background: #ffcc33;color: #fff;text-transform: uppercase">Locality</th>
      </tr>
    </thead>
     <tbody>



<?php

		foreach($result->result() as $row)

		{
         //echo $row->id;
//$query_sub="select * from organisation_volunteer_opportunity WHERE status = '1' and o_email='".$row->o_email."'";





//$query_sub=$query_sub.$sub_query_sub;



			

			

			

			//$row1=$this->db->query($query_sub)->row();		

			//if($row1)

			//{

 ?>

<!-- ngo start -->
<tr>
					
                            <td>
							<a href="<?=base_url()?>site/org_details?email_id=<?=$row->o_email?>"><?=$row->o_name_of_org?></a>
                            </td>
                            <td>
                            <?=$row->oo_category?>
                            </td>
						    <td>
						    <?=$row->oo_desc?>
						    </td>
						     <td>
						    <?=$row->o_locality?>
						    </td>
                       
                        
</tr>                 
						
					<!-- ngo end -->

					

<?php		

		

		}
?></tbody></table><?php
	}

?>	</div>