<div class="container">
	<div class="main">
		<div class="content" style="text-align: left">
			<div class="col-md-12" style="margin: 10px">
				<div class="col-md-3">
					<div class="w_nav1">
						<ul>
							<!--<li><a href="<?=base_url()?>volunteer_acc?ch=admin_profile">Edit Administrator Profile</a></li>
							<li><a href="<?=base_url()?>volunteer_acc?ch=org_profile">Edit Organisation Profile</a></li> -->
							<li><a href="<?=base_url()?>volunteer_acc?ch=change_pass">Change Password</a></li>
							<li><a href="<?=base_url()?>volunteer_acc/logout">Logout</a></li>
							
						</ul>	
					</div>
				</div>
				<div class="col-md-9">
				
<?php
	if(isset($_GET['ch']))
	{
			//if($_GET['ch']=="admin_profile")
			//{
			//	$this->load->view('volunteer/update_administration_profile');
			//}else
			//if($_GET['ch']=="org_profile")
			//{
			//	$this->load->view('volunteer/update_organisation_profile');
			//}else
			if($_GET['ch']=="change_pass")
			{
				$this->load->view('volunteer/update_password');
			}
			//else
			//if($_GET['ch']=="logout")
			//{
			//	$this->session->unset_userdata('username');
	        //    $this->session->unset_userdata('is_logged_in');
	        //    $this->session->unset_userdata('account_type');
	        //    redirect(base_url().'site/');
				
			//}	
	}else
	{
?>				
					<h3> Welcome </h3>
					<strong>Email : </strong> <?=$this->session->userdata('username')?><br/>
					
					<!--<?php
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
?>-->					
			</div>
			</div>
		</div>
	</div>
</div>