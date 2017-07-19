<?php
/*====================== Database Connection Code Start Here ======================= */

define ("DB_HOST", "localhost"); // set database host
define ("DB_USER", "root"); // set database user
define ("DB_PASS",""); // set database password
define ("DB_NAME","dealndine"); // set database name

$link 	= 	mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Couldn't make connection.");
$db		= 	mysql_select_db(DB_NAME, $link) or die("Couldn't select database");

/*====================== Database Connection Code End Here ========================== */

// Here, we will get user input data and trim it, if any space in that user input data
$user_input = trim($_REQUEST['term']);

// Define two array, one is to store output data and other is for display
$display_json = array();
$json_arr = array();
 

$user_input = preg_replace('/\s+/', ' ', $user_input);

$query = 'SELECT restaurant_name,restaurant_slug,logo FROM tbl_restaurant_owner_master WHERE restaurant_name LIKE "%'.$user_input.'%"';
 
$recSql = mysql_query($query);
if(mysql_num_rows($recSql)>0){
while($recResult = mysql_fetch_assoc($recSql)) {
	$recResult['logo'];
	if($recResult['logo']!='')
	{
		/*if(!file_exists('http://server-26/dealndine/uploads/restaurant_logo/thumb/'.$recResult['logo']))
		{$imagePath = 'http://server-26/dealndine/images/no_image.gif';}
		else
		{*/$imagePath = 'http://server-26/dealndine/uploads/restaurant_logo/thumb/'.$recResult['logo'];//}
	}
	else
	{$imagePath = 'http://server-26/dealndine/images/no_image.gif';}
  $json_arr["id"] = "http://www.discussdesk.com/".$recResult['restaurant_slug'].".htm";
  $json_arr["value"] = $recResult['restaurant_name'];
  $json_arr["label"] = '<img src="'.$imagePath.'" alt="'.$recResult['restaurant_name'].'" />'.$recResult['restaurant_name'];
  array_push($display_json, $json_arr);
}
} else {
  $json_arr["id"] = "#";
  $json_arr["value"] = "";
  $json_arr["label"] = "No Result Found !";
  array_push($display_json, $json_arr);
}
 
	
$jsonWrite = json_encode($display_json); //encode that search data
print $jsonWrite;
?>