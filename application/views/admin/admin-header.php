<?php
if($this->session->userdata('admin_id')=='')
{
  redirect(base_url().'superadmin/admin/login/');
}
$time=base64_decode($this->session->userdata('timer'));
$curr_date=date("H:i:s");
$diff = abs(strtotime($time) - strtotime($curr_date));
$years = floor($diff / (365*60*60*24)); 
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
$hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60));
$minuts = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
$seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60));
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>MeetYourNGO | <?php echo $pagetitle; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <!--base css styles-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>../assets/font-awesome/css/font-awesome.min.css">
        <!--page specific css styles-->
        <!--flaty css styles-->
        <link rel="stylesheet" href="<?php echo base_url(); ?>../css/flaty.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>../css/flaty-responsive.css">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>../img/favicon.png">
        <script src="<?php echo base_url(); ?>../js/jquery-1.8.2.js"></script>
        <script>var site_url='<?php echo base_url()."../"; ?>';</script>
        <?php $translator_sts=$this->master_model->getRecords('tbl_site_status',array('site_id'=>2),'*'); ?>
       
		<script src="<?php echo base_url(); ?>../js/admin-validation.js"></script>
        <script src="<?php echo base_url();?>../datepicker/javascript/zebra_datepicker.js"></script>
     
		<link href="<?php echo base_url();?>../datepicker/css/zebra_datepicker.css" type="text/css" rel="stylesheet"/>
        <script type="text/javascript">
			function test()
			{ window.open('child.html',"mywindow","status=1,toolbar=1,width=200,height=200,left=250,top=80") }
		</script>
     </head>
    <body>
    <?php 
	if($this->router->fetch_method()=='manage'){ 
	?>
     <link rel="stylesheet" href="<?php echo base_url(); ?>css/loading.css">
     <div id="Loading" style="display:none;">
        <div id="circularG">
            <div id="circularG_1" class="circularG">
            </div>
            <div id="circularG_2" class="circularG">
            </div>
            <div id="circularG_3" class="circularG">
            </div>
            <div id="circularG_4" class="circularG">
            </div>
            <div id="circularG_5" class="circularG">
            </div>
            <div id="circularG_6" class="circularG">
            </div>
            <div id="circularG_7" class="circularG">
            </div>
            <div id="circularG_8" class="circularG">
            </div>
          </div> 
      </div>
   <?php } ?>
   <!--BEGIN Theme Setting -->
        <div id="theme-setting">
            <a href="#"><i class="fa fa-gears fa fa-2x"></i></a>
            <ul>
                <li>
                    <span>Skin</span>
                    <ul class="colors" data-target="body" data-prefix="skin-">
                        <li class="active"><a class="blue" href="#"></a></li>
                        <li><a class="red" href="#"></a></li>
                        <li><a class="green" href="#"></a></li>
                        <li><a class="orange" href="#"></a></li>
                        <li><a class="yellow" href="#"></a></li>
                        <li><a class="pink" href="#"></a></li>
                        <li><a class="magenta" href="#"></a></li>
                        <li><a class="gray" href="#"></a></li>
                        <li><a class="black" href="#"></a></li>
                    </ul>
                </li>
                <li>
                    <span>Navbar</span>
                    <ul class="colors" data-target="#navbar" data-prefix="navbar-">
                        <li class="active"><a class="blue" href="#"></a></li>
                        <li><a class="red" href="#"></a></li>
                        <li><a class="green" href="#"></a></li>
                        <li><a class="orange" href="#"></a></li>
                        <li><a class="yellow" href="#"></a></li>
                        <li><a class="pink" href="#"></a></li>
                        <li><a class="magenta" href="#"></a></li>
                        <li><a class="gray" href="#"></a></li>
                        <li><a class="black" href="#"></a></li>
                    </ul>
                </li>
                <li>
                    <span>Sidebar</span>
                    <ul class="colors" data-target="#main-container" data-prefix="sidebar-">
                        <li class="active"><a class="blue" href="#"></a></li>
                        <li><a class="red" href="#"></a></li>
                        <li><a class="green" href="#"></a></li>
                        <li><a class="orange" href="#"></a></li>
                        <li><a class="yellow" href="#"></a></li>
                        <li><a class="pink" href="#"></a></li>
                        <li><a class="magenta" href="#"></a></li>
                        <li><a class="gray" href="#"></a></li>
                        <li><a class="black" href="#"></a></li>
                    </ul>
                </li>
                <li>
                    <span></span>
                    <a data-target="navbar" href="#"><i class="fa fa-square-o"></i> Fixed Navbar</a>
                    <a class="hidden-inline-xs" data-target="sidebar" href="#"><i class="fa fa-square-o"></i> Fixed Sidebar</a>
                </li>
            </ul>
        </div>
   <!-- END Theme Setting -->
   <!-- BEGIN Navbar -->
        <div id="navbar" class="navbar">
            <button type="button" class="navbar-toggle navbar-btn collapsed" data-toggle="collapse" data-target="#sidebar">
                <span class="fa fa-bars"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url('superadmin/admin/dashboard/'); ?>">
                <small>
                    <i class="fa fa-desktop"></i>
                     MeetYourNGO
                </small>
            </a>
           
            <!-- BEGIN Navbar Buttons -->
            <ul class="nav flaty-nav pull-right">
                
                <!-- BEGIN Button Notifications -->
                <!--<li class="hidden-xs">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="fa fa-bell"></i>
                        <span class="badge badge-important">564</span>
                    </a>
                    <ul class="dropdown-navbar dropdown-menu header_contact_inq" >
                        <li class="nav-header">
                            <i class="fa fa-warning"></i>
                           4 Notifications
                        </li>

                       
                        <li class="notify" >
                            <a href="<?php echo base_url() ; ?>superadmin/admin/managecontactinquiry/">
                                <i class="fa fa-comment orange"></i>
                                <p>New Contact Enquries</p>
                                <span class="badge badge-info">0</span>
                            </a>
                        </li>

                        <li class="notify">
                            <a href="<?php echo base_url() ;?>superadmin/seller/manageseller/">
                                <i class="fa fa-user blue"></i>
                                <p>New Registered User</p>
                                <span class="badge badge-info">0</span>
                            </a>
                        </li>
                    </ul>
                </li>-->
                <!-- END Button Notifications -->

                <!-- BEGIN Button Messages -->
                <!--<li class="hidden-xs" >
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="fa fa-envelope"></i>
                        <span class="badge badge-success">    0</span>
                    </a>
                    <ul class="dropdown-navbar dropdown-menu contact_new_ref" >
                     
                        <li class="nav-header">
                            <i class="fa fa-comments"></i>
                           0 Messages
                        </li>
                   </ul>
                </li>-->
                <!-- END Button Messages -->

                <!-- BEGIN Button User -->
                <li class="user-profile">
                    <a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">
                      <?php if($this->session->userdata('admin_img')==''){ ?>
                        <img class="nav-user-photo" src="<?php echo base_url(); ?>../img/demo/avatar/avatar1.jpg" alt="Penny's Photo" />
                       <?php }else{ ?>
                        <img class="nav-user-photo" src="<?php echo base_url(); ?>../uploads/admin/<?php echo $this->session->userdata('admin_img'); ?>" alt="Penny's Photo" />
                       <?php } ?>
                        <span class="hhh" id="user_info">
                           <?php echo $this->session->userdata('admin_username'); ?>
                        </span>
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <!-- BEGIN User Dropdown -->
                    <ul class="dropdown-menu dropdown-navbar" id="user_menu">
                        <li class="nav-header">
                            <i class="fa fa-clock-o"></i>
                            Logged From <span id="worked"><?php echo $minuts.':'.$seconds; ?></span>
                        </li>
<script type="text/javascript">
$(document).ready(function (e) {
    var $worked = $("#worked");

    function update() {
        var myTime = $worked.html();//alert(myTime);
        var ss = myTime.split(":");
        var dt = new Date();
        dt.setHours(0);
        dt.setMinutes(ss[0]);
        dt.setSeconds(ss[1]);
        
        var dt2 = new Date(dt.valueOf() + 1000);
        var temp = dt2.toTimeString().split(" ");
        var ts = temp[0].split(":");
        
        $worked.html(ts[1]+":"+ts[2]);
        setTimeout(update, 1000);
    }

    setTimeout(update, 1000);
});
</script>
                        <li>
                            <a href="<?php echo base_url().'superadmin/admin/accountsetting/';?>">
                                <i class="fa fa-cog"></i>
                                Account Settings
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url();?>" target="_new">
                              <i class="fa fa-desktop"></i>
                                view site
                            </a>
                        </li>

                        <!--<li>
                            <a href="<?php echo base_url().'superadmin/admin/accountsetting/';?>">
                                <i class="fa fa-user"></i>
                                Edit Profile
                            </a>
                        </li>-->

                        <!--<li>
                            <a href="#">
                                <i class="fa fa-question"></i>
                                Help
                            </a>
                        </li>-->

                        <li class="divider visible-xs"></li>

                        <li class="visible-xs">
                            <a href="#">
                                <i class="fa fa-tasks"></i>
                                Tasks
                                <span class="badge badge-warning">4</span>
                            </a>
                        </li>
                        <li class="visible-xs">
                            <a href="#">
                                <i class="fa fa-bell"></i>
                                Notifications
                                <span class="badge badge-important">8</span>
                            </a>
                        </li>
                        <li class="visible-xs">
                            <a href="#">
                                <i class="fa fa-envelope"></i>
                                Messages
                                <span class="badge badge-success">5</span>
                            </a>
                        </li>
                        <li class="divider"></li>

                        <li>
                            <a href="<?php echo base_url().'superadmin/admin/logout/'; ?>">
                                <i class="fa fa-off"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                    <!-- BEGIN User Dropdown -->
                </li>
                <!-- END Button User -->
            </ul>
            <!-- END Navbar Buttons -->
        </div>
   <!-- END Navbar -->
    <!-- BEGIN Container -->
    <div class="container" id="main-container">
          <!-- Admin Sidebar -->
          <?php $this->load->view('admin/admin-sidebar');?>
          <!-- Admin Sidebar -->
            <!-- BEGIN Content -->
            <div id="main-content"> 