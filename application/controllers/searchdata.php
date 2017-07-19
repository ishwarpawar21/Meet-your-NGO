<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Searchdata extends CI_Controller {
    public function __construct()
    {
	   parent::__construct();
	   $this->load->library('session');
	   $this->check_search();
	}

	//public function index()
	//{
	//  $data['page_title']='Welcome '.$this->session->userdata('name');
	//  $data['middle_content']='volunteer_Account';
	//  $this->load->view('templete',$data);
	//}
	
	public function check_search()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

         if (isset($_REQUEST['name'])) {

           # Append something onto the $name variable so that you can see that it passed through your PHP script.
           $name = $_REQUEST['name'] . ' - 123 ';

            # I'm sending back a json structure in case there are multiple pieces of information you'd like
              # to pass back.
             header('Content-Type: application/json');
             print json_encode('{"success" : "' . $name . '"}');

    }

}
   
		
	}
}
?>