<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {
    public function __construct()
    {
	   parent::__construct();
	   date_default_timezone_set('Asia/Calcutta'); 
	   $this->load->library('form_validation');
	   $this->load->library('session');
	   $this->load->model('site_model');
	   $this->load->library('upload');
	   
	}
	
	public function index()
	{
	  $data['page_title']='Home';
	  $data['middle_content']='home';
	  $this->load->view('templete',$data);
	}
	
	
	public function org_details()
	{
	  $data['page_title']='View Details';
	  $data['middle_content']='view_details';
	  $this->load->view('templete',$data);
	}
	
	public function login()
	{
		if(isset($_POST['login']))
		{
			 
			if($_POST['account_type']=="for_org")
			{
				$result=$this->db->query("select * from organisation WHERE o_email = '".$_POST['email']."' and o_password='".md5($_POST['password'])."'")->row();
				if($result)
				{
					$this->session->set_userdata('username',$result->o_email);
					$this->session->set_userdata('name',$result->o_fname.' '.$result->o_lname);
					$this->session->set_userdata('is_logged_in','1');
					$this->session->set_userdata('account_type','org');
					redirect(base_url().'organisation_acc/');
				}
				else
				{
					$this->session->set_userdata('login_error','Invalid Username and Password');
					redirect(base_url().'site/');	
				}
			}
			
			if($_POST['account_type']=="for_vol")
			{
				
				
				$result=$this->db->query("select * from volunteer WHERE v_email = '".$_POST['email']."' and v_password='".md5($_POST['password'])."'")->row();
				if($result)
				{
					
					$this->session->set_userdata('username',$result->v_email);
					//$this->session->set_userdata('name',$result->v_fname.' '.$result->v_lname);
					$this->session->set_userdata('is_logged_in','1');
					$this->session->set_userdata('account_type','vol');
					redirect(base_url().'site/volunteers');
				}
				else
				{
					$this->session->set_userdata('login_error','Invalid Username and Password');
					redirect(base_url().'site/');
				}
			}
		}
		
		redirect(base_url().'site');
	}
	
	
	public function signup_org()
	{
		if(isset($_POST['org_step1']))
		{
			
			
			$this->form_validation->set_rules('o_email','Email','required|xss_clean|valid_email');
			
			$this->form_validation->set_rules('o_password','Password','required|xss_clean|min_length[4]|max_length[12]');
			$this->form_validation->set_rules('o_cpassword','Confirm Password','required|matches[o_password]required|xss_clean|min_length[4]|max_length[12]');
			
			$this->form_validation->set_rules('o_name_of_org','Name Of Organisation','required|xss_clean');
			
			if($this->form_validation->run())
			{
				$q=$this->db->query("select * from organisation where o_email = '".$_POST['o_email']."'")->row();	
				if($q)
				{
					$this->session->set_userdata('reg_error','<span>Email Already Exist, Please try with other email</span>');
					redirect(base_url().'site/signup_org');
				}
				else
				{					
					$maxid=0;
					$maxid=$this->site_model->find_max_id('organisation');
					$maxid++;
					
					$data_array=array(
						'id'=>$maxid,
						
						'o_email'=>$_POST['o_email'],
					
						'o_password'=>$_POST['o_password'],
						'o_name_of_org'=>$_POST['o_name_of_org'],
						'status'=>0	
					);
					
					if($this->site_model->insertRecord('organisation',$data_array))
					{
						$this->session->set_userdata('username',$_POST['o_email']);
						$this->session->set_userdata('org_id',$maxid);
						$this->session->set_userdata('is_logged_in','2');
						$this->session->set_userdata('account_type','org');
						$this->session->set_userdata('success_msg','Thank You for regestring with us, Please Fill following details to complete your registration');
						redirect(base_url().'site/organisation_step1');
					}
					else
					{
						redirect(base_url().'site/signup_org');
					}
				 }
			}
		}
		 
	  $data['page_title']='Organisation Register Step 1';
	  $data['middle_content']='signup_org';
	  $this->load->view('templete',$data);
	}
	public function organisation_step1()
	{
		if(isset($_POST['org_step1']))
		{
			
			 //print_r($val);
			 
		    $locality="";
			
				
					 
			$this->form_validation->set_rules('o_fname','First Name','trim|required|xss_clean');
			$this->form_validation->set_rules('o_lname','Last Name','trim|required|xss_clean');
			
			$this->form_validation->set_rules('o_mob','Mobile Number','required|xss_clean|regex_match[/^[0-9().-]+$/]');
			
		
			$this->form_validation->set_rules('o_org_email','Organisation Email','required|xss_clean');
			$this->form_validation->set_rules('o_address','Organisation Address','required|xss_clean');
			$this->form_validation->set_rules('o_locality','State','required|xss_clean');
			$this->form_validation->set_rules('o_state','State','required|xss_clean');
			$this->form_validation->set_rules('o_city','City','required|xss_clean');
			$this->form_validation->set_rules('o_pin_code','Pin Code','xss_clean|regex_match[/^[0-9().-]+$/]');
			$this->form_validation->set_rules('o_org_phone','Phone Code','xss_clean|regex_match[/^[0-9().-]+$/]');
			if($this->form_validation->run())
			{
					  $val=$_POST['o_locality'];
					  $locality="";
					  $start1=0;
			          foreach($val as  $lval)
			          {	
			            if($start1==0)
			            {
                          $locality=$locality.$lval;
                          $start1=1;
						}
						else{
							$locality=$locality.', '.$lval; 
						}
			            
			          }				
					 
					$data_array=array(
						//'id'=>$maxid,
						'o_fname'=>$_POST['o_fname'],
						'o_lname'=>$_POST['o_lname'],						
						'o_mob'=>$_POST['o_mob'],
						'o_name_of_org'=>$_POST['o_name_of_org'],
						'o_org_email'=>$_POST['o_org_email'],
						'o_address'=>$_POST['o_address'],
						'o_locality'=>$locality,
						'o_state'=>$_POST['o_state'],
						'o_city'=>$_POST['o_city'],
						'o_pin_code'=>$_POST['o_pin_code'],
						'o_org_phone'=>$_POST['o_org_phone'],
						'status'=>1
					);
					
					
					if($this->site_model->update('organisation',$data_array,$this->session->userdata('org_id')))
					{
				     
					  /*$locality="";
			          foreach($val as  $sssss)
			          {	
			            $maxid=0;
					    $maxid=$this->site_model->find_max_id('organisation_locality');
					    $maxid++;
			            $locality=$locality.' '.$sssss; 
			            $data_array=array(
						'id'=>$maxid,
	                    'org_id'=>$this->session->userdata('org_id'),
	                    'locality'=>$sssss
	                    );
					
					    $this->site_model->insertRecord('organisation_locality',$data_array);
					   
			            $locality="";
			          }*/
						
						//$this->session->set_userdata('username',$_POST['o_email']);
						$this->session->set_userdata('name',$_POST['o_fname'].' '.$_POST['o_lname']);
						$this->session->set_userdata('is_logged_in','2');
						$this->session->set_userdata('account_type','org');
						$this->session->set_userdata('success_msg','Thank You for regestring with us, Please Fill following details to complete your registration');
						
					//print_r($data_array);
					//exit;
						redirect(base_url().'site/organisation_step2');
					}
					else
					{
						redirect(base_url().'site/organisation_step1');
					}
				 
			}
		}
		 
	  $data['page_title']='Organisation Register Step 1';
	  $data['middle_content']='organisation_1';
	  $this->load->view('templete',$data);
	}
	
	public function organisation_step2()
	{
	 if(isset($_POST['org_reg_step2'])) 
		{
			$this->form_validation->set_rules('oo_title','o_email','required|xss_clean');
			$this->form_validation->set_rules('oo_desc','Description','required|xss_clean');
			$this->form_validation->set_rules('oo_category','Category','required');
			$this->form_validation->set_rules('oo_desired_skill','Desired Skill','required|xss_clean');
			$this->form_validation->set_rules('oo_language','Language','required');
			$this->form_validation->set_rules('oo_volunteer_time_slot','Time slot','required');
			$this->form_validation->set_rules('oo_num_vol','Number Of Volunteers','required|xss_clean');
			$this->form_validation->set_rules('oo_days_week','Days Of Week','required|xss_clean');
			$this->form_validation->set_rules('oo_volunteer_profile','Profile','required|xss_clean');
			
			if($this->form_validation->run())
			{
				 	$maxid=0;
					$maxid=$this->site_model->find_max_id('organisation_volunteer_opportunity');
					$maxid++;
					  $val=$_POST['oo_days_week'];
					  $valdofweek="";
					  $start=0;
			          foreach($val as  $dval)
			          {	
			            if($start==0)
			            {
                         $valdofweek=$valdofweek.$dval;
                         $start=1;
						}
						else{
							$valdofweek=$valdofweek.', '.$dval; 
						}
			            
			          }
			          $valt=$_POST['oo_volunteer_time_slot'];
					  $valts="";
					  $startt=0;
			          foreach($valt as  $tval)
			          {	
			            if($startt==0)
			            {
                         $valts=$valts.$tval;
                         $startt=1;
						}
						else{
							$valts=$valts.', '.$tval; 
						}
			            
			          }	
			          
			          	
					$data_array=array('id'=>$maxid,'o_email'=>$this->session->userdata('username'),'oo_title'=>$_POST['oo_title'],'oo_desc'=>$_POST['oo_desc'],'oo_category'=>$_POST['oo_category'],'oo_desired_skill'=>$_POST['oo_desired_skill'],'oo_language'=>$_POST['oo_language'],'oo_volunteer_time_slot'=>$valts,'oo_num_vol'=>$_POST['oo_num_vol'],'oo_days_week'=>$valdofweek,'oo_volunteer_profile'=>$_POST['oo_volunteer_profile']);
					
					if($this->site_model->insertRecord('organisation_volunteer_opportunity',$data_array))
					{
						$config=array(
					     'upload_path' => 'site_assets/images/ngo',
					     'allowed_types' => 'jpg',
					     'file_name'=> $maxid.'.jpg',
					     'overwrite'=> True
						);
					        
					    $this->upload->initialize($config); // Important
						$this->upload->do_upload("userfile");
    
						$data_update=array('o_step2_stat'=>'1');
						$this->db->where('o_email',$this->session->userdata('username'));
						$this->db->update('organisation',$data_update);
						
						$this->session->set_userdata('is_logged_in','1');
						redirect(base_url().'organisation_acc');
					}
					else
					{
						$this->session->set_userdata('error_msg','Error occurred, Try again...');
						redirect(base_url().'organisation_acc/organisation_step2');
					}
					
			}
		}
		 
	  $data['page_title']='Organisation Register Step 2';
	  $data['middle_content']='organisation_2';
	  $this->load->view('templete',$data);
		
	 
	}
	
	
	public function contact()
	{
		
		
	  $data['page_title']='Contact us';
	  $data['middle_content']='contact_us';
	  $this->load->view('templete',$data);
	}
	
	public function about_us()
	{
	  if(isset($_POST['subscribe']))
		{
		
		
		    $this->form_validation->set_rules('email','Email','required|xss_clean|valid_email');
			
	
			if($this->form_validation->run())
			{
				$q=$this->db->query("select * from tbl_newsletter_subscriber where sub_email = '".$_POST['email']."'")->row();	
				if($q)
				{
					$this->session->set_userdata('reg_error','<span>Email Already Exist, Please try with other email</span>');
					redirect(base_url().'site/about_us');
				}
				else
				{					
					$maxid=0;
					$maxid=$this->site_model->find_max_id('tbl_newsletter_subscriber');
					$maxid++;
					
					$data_array=array(
						'id'=>$maxid,
						
						'sub_email'=>$_POST['email'],		
						
					);
					
					if($this->site_model->insertRecord('tbl_newsletter_subscriber',$data_array))
					{
						
						$this->session->set_userdata('success_msg','Thank You for subscribing our newletter with us');
						redirect(base_url().'site/about_us');
					}
					else
					{
						redirect(base_url().'site/about_us');
					}
				 }
			}	 
			
				
	    }	
		
	  $data['page_title']='About us';
	  $data['middle_content']='about_us';
	  $this->load->view('templete',$data);
	}
	
	public function organisation()
	{
	  if(isset($_POST['subscribe']))
		{
		
		
		    $this->form_validation->set_rules('email','Email','required|xss_clean|valid_email');
			
	
			if($this->form_validation->run())
			{
				$q=$this->db->query("select * from tbl_newsletter_subscriber where sub_email = '".$_POST['email']."'")->row();	
				if($q)
				{
					$this->session->set_userdata('reg_error','<span>Email Already Exist, Please try with other email</span>');
					redirect(base_url().'site/organisation');
				}
				else
				{					
					$maxid=0;
					$maxid=$this->site_model->find_max_id('tbl_newsletter_subscriber');
					$maxid++;
					
					$data_array=array(
						'id'=>$maxid,
						
						'sub_email'=>$_POST['email'],		
						
					);
					
					if($this->site_model->insertRecord('tbl_newsletter_subscriber',$data_array))
					{
						
						$this->session->set_userdata('success_msg','Thank You for subscribing our newletter with us');
						redirect(base_url().'site/organisation');
					}
					else
					{
						redirect(base_url().'site/organisation');
					}
				 }
			}	 
			
				
	    }

			
	  $data['page_title']='Non-profit Organisation';
	  $data['middle_content']='non_profit_org';
	  $this->load->view('templete',$data);
	}
	
	public function jobs()
	{
			
	  $data['page_title']='Jobs';
	  $data['middle_content']='jobs';
	  $this->load->view('templete',$data);
	}
	public function tandc()
	{
			
	  $data['page_title']='Terms and conditions';
	  $data['middle_content']='tandc';
	  $this->load->view('templete',$data);
	}
	public function policy()
	{
			
	  $data['page_title']='Privacy policy';
	  $data['middle_content']='policy';
	  $this->load->view('templete',$data);
	}
	public function volunteers()
	{
		 
	  $data['page_title']='Volunteers';
	  $data['middle_content']='volunteers';
	
	  $this->load->view('templete',$data);
	}
	
	public function volunteers_acc()
	{
		 
	  $data['page_title']='Welcome';
	  $data['middle_content']='volunteer_Account';
	  $this->load->view('templete',$data);
	}
	
	
	public function volunteers_reg()
	{
		
		if(isset($_POST['volinteer_reg']))
		{
			//$this->form_validation->set_rules('v_fname','First Name','trim|required|xss_clean');
			//$this->form_validation->set_rules('v_lname','Last Name','trim|required|xss_clean');
			$this->form_validation->set_rules('v_email','Email','required|xss_clean|valid_email');
			//$this->form_validation->set_rules('v_mob_no','Mobile Number','required|xss_clean|regex_match[/^[0-9().-]+$/]');
			//$this->form_validation->set_rules('v_dd','Day','required|xss_clean');
			//$this->form_validation->set_rules('v_mm','Month','required|xss_clean');
			//$this->form_validation->set_rules('v_yy','Year','required|xss_clean');
			//$this->form_validation->set_rules('v_gender','Gender','required|xss_clean');
			//$this->form_validation->set_rules('v_address','Address','required|xss_clean');
			//$this->form_validation->set_rules('v_state','State','required|xss_clean');
			//$this->form_validation->set_rules('v_city','City','required|xss_clean');
			//$this->form_validation->set_rules('v_pincode','Pincode','xss_clean|regex_match[/^[0-9().-]+$/]');
			$this->form_validation->set_rules('o_password','Password','required|xss_clean|min_length[4]|max_length[12]');
			$this->form_validation->set_rules('o_cpassword','Confirm Password','required|matches[o_password]required|xss_clean|min_length[4]|max_length[12]');
			if($this->form_validation->run())
			{
				$q=$this->db->query("select * from volunteer where v_email = '".$_POST['v_email']."'")->row();	
				if($q)
				{
					$this->session->set_userdata('reg_error','<span>Email Already Exist, Please try with other email</span>');
					redirect(base_url().'site/volunteers_reg');
				}
				else
				{
					$maxid=0;
					$maxid=$this->site_model->find_max_id('volunteer');
					$maxid++;
					//$data_array=array('id'=>$maxid,'v_fname'=>$_POST['v_fname'],'v_lname'=>$_POST['v_lname'],'v_email'=>$_POST['v_email'],'v_password'=>md5($_POST['v_password']),'v_mob_no'=>$_POST['v_mob_no'],'v_dd'=>$_POST['v_dd'],'v_mm'=>$_POST['v_mm'],'v_yy'=>$_POST['v_yy'],'v_gender'=>$_POST['v_gender'],'v_address'=>$_POST['v_address'],'v_state'=>$_POST['v_state'],'v_state'=>$_POST['v_state'],'v_city'=>$_POST['v_city'],'v_pincode'=>$_POST['v_pincode']);
					$data_array=array('id'=>$maxid,'v_email'=>$_POST['v_email'],'v_password'=>md5($_POST['o_password']));
					if($this->site_model->insertRecord('volunteer',$data_array))
					{
						$this->session->set_userdata('username',$_POST['v_email']);
						//$this->session->set_userdata('name',$_POST['v_fname'].' '.$_POST['v_lname']);
						$this->session->set_userdata('is_logged_in','1');
						$this->session->set_userdata('account_type','vol');
						redirect(base_url().'site/volunteers_acc');
					}
					else
					{
						redirect(base_url().'site/volunteers_reg');
					}
				}
			}
		}	 
	  $data['page_title']='Volunteers';
	  $data['middle_content']='volunteer_reg';
	  $this->load->view('templete',$data);
	}
	
	
	public function write_exp()
	{
		if(isset($_POST['write_exp']))
		{
			$this->form_validation->set_rules('your_exp','Your Experience','required|xss_clean|min_length[50]|max_length[250]');
			if($this->form_validation->run())
			{
				$data_array=array('ngo_id'=>base64_decode($_POST['ngo_id']),'vol_id'=>base64_decode($_POST['vol_id']),'experience'=>$_POST['your_exp']);
				$result=$this->site_model->insertRecord('volunteer_exp',$data_array);
				if($result)
				{
					$this->session->set_userdata('error_msg','Thank You for posting your experience.Your Experience is send to our admin to verify it. After successfull Verification You will receive Karma Points');
					$this->session->set_userdata('error_cls','success');
				}
				else
				{
					$this->session->set_userdata('error_msg','Error occurred, Try again');
					$this->session->set_userdata('error_msg','2');
				}
				redirect(base_url().'site/write_exp?ngo_id='.$_POST['ngo_id']);
			}
		}
	  $data['page_title']='Write Experience';
	  $data['middle_content']='write_experience';
	  $this->load->view('templete',$data);
	}

}
?>