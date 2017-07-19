<div class="container">
	<div class="main">
		<div class="content" style="text-align: left">
			<div class="col-md-12" style="margin: 10px">
				<div class="col-md-3">
					<div class="w_nav1">
						<ul>
						<?php
						$ckstatus=$this->db->query("select * from organisation where o_email = '".$this->session->userdata('username')."'")->row(); if($ckstatus->status == 0){			  
							?>
						<li><a style="color: red" href="<?=base_url()?>site/organisation_step1">Complete profile</a></li> <?php }else{?>
							
							<li><a href="<?=base_url()?>organisation_acc?ch=admin_profile">Edit Administrator Profile</a></li>
							<li><a href="<?=base_url()?>organisation_acc?ch=org_profile">Edit Organisation Profile</a></li>          
							<li><a href="<?=base_url()?>organisation_acc?ch=update_volunteering_opportunities">Edit Volunteering Opportunities</a></li>               
							<?php }?>
							<li><a href="<?=base_url()?>organisation_acc?ch=view_profile">View Organisation Profile</a></li>
							<li><a href="<?=base_url()?>organisation_acc?ch=change_pass">Change Password</a></li>
							<li><a href="<?=base_url()?>organisation_acc?ch=logout">Logout</a></li>
							
						</ul>	
					</div>
				</div>
				<div class="col-md-9">
				
<?php
	if(isset($_GET['ch']))
	{
			if($_GET['ch']=="admin_profile")
			{
				if(isset($_POST['update_org_admin']))
			    {
				
				
				$this->form_validation->set_rules('v_fname','first name','required|xss_clean');
				$this->form_validation->set_rules('v_lname','last name','required|xss_clean');
				
				$this->form_validation->set_rules('v_mob_no','mobile','required|xss_clean');
				 if($this->form_validation->run())
			  	  { 
				 
                   $data=array(
				    	'o_fname'=>$this->input->post('v_fname'),
                        'o_lname'=>$this->input->post('v_lname'),
                      
                        'o_mob'=>$this->input->post('v_mob_no'),
					);
                    $this->load->model('site_model');
					$result=$this->site_model->update('organisation',$data,$this->input->post('id'));
					if($result)
					{
					   $this->session->set_userdata('error_msg','Profile Updated Successfully');
                       $this->session->set_userdata('error_cls','success');
					   
					}
                    else
                    {
                        
					   $this->session->set_userdata('error_msg','Error occurred, Try again...');
                       $this->session->set_userdata('error_cls','danger');
                    }
                    redirect(base_url().'organisation_acc?ch=admin_profile');
					
				  }
			   }
                
                
                $this->load->view('organisation/update_administration_profile');
			}else
			if($_GET['ch']=="org_profile")
			{
			   	if(isset($_POST['update_org']))
			    {
				
				
				$this->form_validation->set_rules('o_name_of_org','Orgnization name','required|xss_clean');
				$this->form_validation->set_rules('o_org_email','email','required|xss_clean');
                $this->form_validation->set_rules('o_address','area','required|xss_clean');
				//$this->form_validation->set_rules('o_state','state','required|xss_clean');
			    //$this->form_validation->set_rules('o_city','city','required|xss_clean');
   	            $this->form_validation->set_rules('o_pin_code','pin code','required|xss_clean');
				$this->form_validation->set_rules('o_org_phone','phone','required|xss_clean');
			
				 if($this->form_validation->run())
			  	  { 
				 
					$data=array(
				    	'o_name_of_org'=>$this->input->post('o_name_of_org'),
                        'o_org_email'=>$this->input->post('o_org_email'),
                        'o_address'=>$this->input->post('o_address'),
                       	'o_state'=>$this->input->post('o_state'),
                        'o_city'=>$this->input->post('o_city'),
                        'o_pin_code'=>$this->input->post('o_pin_code'),
                       	'o_org_phone'=>$this->input->post('o_org_phone')
                        
					);
                    $this->load->model('site_model');
					$result=$this->site_model->update('organisation',$data,$this->input->post('id'));
					echo $result;
                    
                    if($result)
					{
					   $this->session->set_userdata('error_msg','Profile Updated Successfully');
                       $this->session->set_userdata('error_cls','success');
					   
					}
                    else
                    {
                        
					   $this->session->set_userdata('error_msg','Error occurred, Try again...');
                       $this->session->set_userdata('error_cls','danger');
                    }
                    redirect(base_url().'organisation_acc?ch=org_profile');
					
				  }
			   }
             
             
             
             
             
				$this->load->view('organisation/update_organisation_profile');
			}else
			if($_GET['ch']=="change_pass")
			{
				 if(isset($_POST['change_password']))
			     {
				
				
				   $this->form_validation->set_rules('current_password','current password','required|xss_clean');
				   $this->form_validation->set_rules('new_password','new password','required|xss_clean');
				   $this->form_validation->set_rules('rnew_password','re-enter password','matches[new_password]|required|xss_clean');
				
				  if($this->form_validation->run())
			  	   { 
				 
					
                    $this->load->model('site_model');
					$result=$this->site_model->change_password("o_email","o_password","organisation");
					
					 
				   }
			    }
                
                $this->load->view('organisation/update_password');
			}else if($_GET['ch']=="view_profile")
			{
				
                
                $this->load->view('organisation/view_profile');
			}else if($_GET['ch']=="update_volunteering_opportunities")
			{
				if(isset($_POST['org_vupdate'])) 
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
				 	$id="0";
					$resultss=$this->db->query("select id from organisation_volunteer_opportunity where o_email = '".$this->session->userdata('username')."'")->row();
					if($resultss)
					{
						$id=$resultss->id;		
					}
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
				//exit;
					$data_array=array(
						'oo_title'=>$_POST['oo_title'],
						'oo_desc'=>$_POST['oo_desc'],
						'oo_category'=>$_POST['oo_category'],
						'oo_desired_skill'=>$_POST['oo_desired_skill'],
						'oo_language'=>$_POST['oo_language'],
						'oo_volunteer_time_slot'=>$valts,
						'oo_num_vol'=>$_POST['oo_num_vol'],
						'oo_days_week'=>$valdofweek,
						'oo_volunteer_profile'=>$_POST['oo_volunteer_profile']
					);
					
					if($this->site_model->update('organisation_volunteer_opportunity',$data_array,$id))
					{
						 
					    
				
				
				$config=array('upload_path' => 'site_assets/images/ngo', 
				'allowed_types' => 'jpg', 
				'file_name'=> $id.'.jpg', 
				'overwrite'=> True
				);
				$this->upload->initialize($config); // Important
				$this->upload->do_upload("userfile");
			    $datas=($this->upload->data());
			        
					    
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
		 
	  		
	    
                
                $this->load->view('organisation/update_volunteering_opportunities');
			}
			else if($_GET['ch']=="logout")
			{
				$this->session->sess_destroy();//update_volunteering_opportunities
				redirect(base_url().'site/');
			}	
	}else
	{
?>				
					<h3> Welcome <span style="color:#e8ae17; text-transform: uppercase"><?=$this->session->userdata('name')?>,</span></h3>
					<strong>Email : </strong> <?=$this->session->userdata('username')?><br/>
					
					<?php
						$qq=$this->db->query("select * from organisation where o_email = '".$this->session->userdata('username')."'")->row();
						if($qq)
						{
?>
							<strong>Address : </strong><?=$qq->o_address?><br/>
							<strong>State : </strong><?=$qq->o_state?><br/>
							<strong>City : </strong><?=$qq->o_city?>-<?=$qq->o_pin_code?><br/>
							
<?php							
						}
	}
?>					
			</div>
			</div>
		</div>
	</div>
</div>