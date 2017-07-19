<?php

class Searchopt extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('session');
		
	}

function searchpage()
{
	$this->load->view('searchoption');
}
	
function locality()
{
	$locality_array=array();
	if($this->session->userdata('locality_array'))
	{
		
		$locality_array=$this->session->userdata('locality_array');
	//if($this->session->set_userdata('locality_array'))
	//	$locality_array=$this->session->set_userdata('locality_array');
		if (in_array($_GET['valabc'],$locality_array)) {
   			if (($key = array_search($_GET['valabc'], $locality_array)) !== false) {
    		unset($locality_array[$key]);
				}
		}
		else
		{
			array_push($locality_array,$_GET['valabc']);
		}
	
		$this->session->set_userdata('locality_array',$locality_array);
	//	print_r($locality_array)	;
	}
	else
	{
		
		array_push($locality_array,$_GET['valabc']);
		$this->session->set_userdata('locality_array',$locality_array);
		
	//	print_r($locality_array)	;
	}
	
	$this->load->view('searchoption');
	
	
	
}

function setlanguage()
{
	$language_array=array();
	if($this->session->userdata('language_array'))
	{
		
		$language_array=$this->session->userdata('language_array');
	;
		if (in_array($_GET['vallang'],$language_array)) {
   			if (($key = array_search($_GET['vallang'], $language_array)) !== false) {
    		unset($language_array[$key]);
				}
		}
		else
		{
			array_push($language_array,$_GET['vallang']);
		}
	
		$this->session->set_userdata('language_array',$language_array);

	}
	else
	{
		
		array_push($language_array,$_GET['vallang']);
		$this->session->set_userdata('language_array',$language_array);
		
	
	}
	
	$this->load->view('searchoption');
	
	
	
}


function setdays()
{
	$days_array=array();
	if($this->session->userdata('days_array'))
	{
		
		$days_array=$this->session->userdata('days_array');
	;
		if (in_array($_GET['valdays'],$days_array)) {
   			if (($key = array_search($_GET['valdays'], $days_array)) !== false) {
    		unset($days_array[$key]);
				}
		}
		else
		{
			array_push($days_array,$_GET['valdays']);
		}
	
		$this->session->set_userdata('days_array',$days_array);

	}
	else
	{
		
		array_push($days_array,$_GET['valdays']);
		$this->session->set_userdata('days_array',$days_array);
		
	
	}
	
	$this->load->view('searchoption');
	
	
	
}

function settime()
{
	$time_array=array();
	if($this->session->userdata('time_array'))
	{
		
		$time_array=$this->session->userdata('time_array');
	;
		if (in_array($_GET['valtime'],$time_array)) {
   			if (($key = array_search($_GET['valtime'], $time_array)) !== false) {
    		unset($time_array[$key]);
				}
		}
		else
		{
			array_push($time_array,$_GET['valtime']);
		}
	
		$this->session->set_userdata('time_array',$time_array);

	}
	else
	{
		
		array_push($time_array,$_GET['valtime']);
		$this->session->set_userdata('time_array',$time_array);
		
	
	}
	
	$this->load->view('searchoption');
	
	
	
}




function setoperation()
{
	$operation_array=array();
	if($this->session->userdata('operation_array'))
	{
		
		$operation_array=$this->session->userdata('operation_array');
	
		if (in_array($_GET['valoper'],$operation_array)) {
   			if (($key = array_search($_GET['valoper'], $operation_array)) !== false) {
    		unset($operation_array[$key]);
				}
		}
		else
		{
			array_push($operation_array,$_GET['valoper']);
		}
	
		$this->session->set_userdata('operation_array',$operation_array);
	
	}
	else
	{
		
		array_push($operation_array,$_GET['valoper']);
		$this->session->set_userdata('operation_array',$operation_array);
		
	
	}
	
	$this->load->view('searchoption');
	
	
	
}

function set_heading()
{
	
	if($this->session->userdata('select_heading)'))
	{
		$this->session->set_userdata('select_heading',$_POST['select_heading']);
		
	//	print_r($locality_array)	;
	}
	
}
}


?>