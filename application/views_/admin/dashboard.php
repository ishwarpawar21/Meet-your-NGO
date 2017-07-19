<!-- BEGIN Page Title -->

<div class="page-title">
  <div>
    <h1><i class="fa fa-file-o"></i> Dashboard</h1>
    <h4>Overview, stats, chat and more</h4>
  </div>
</div>
<!-- END Page Title --> 

<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
  <ul class="breadcrumb">
    <li class="active"><i class="fa fa-home"></i> Home</li>
  </ul>
</div>
<!-- END Breadcrumb --> 

<!-- BEGIN Tiles -->
<div class="row">
  <div class="col-md-12">
    <div class="row">
    <div class="col-md-3 tile-active"> 
            <a class="tile tile-light-blue" data-stop="3000" href="<?php echo base_url() ;?>superadmin/admin/accountsetting">
              <div class="img img-center"> <i class="fa fa-cogs" style="font-size:45px; !important"></i> </div>
              <p class="title text-center">Account settings</p>
              </a>  
              </div>
    <div class="col-md-3 tile-active"> 
            <a class="tile tile-light-blue" data-stop="3000" href="<?php echo base_url() ;?>superadmin/categories/manage/">
              <div class="img img-center"> <i class="fa fa-sitemap" style="font-size:45px; !important"></i> </div>
              <p class="title text-center">Manage Categories</p>
              </a>  
              </div>
    <div class="col-md-3 tile-active"> 
            <a class="tile tile-light-blue" data-stop="3000" href="<?php echo base_url() ;?>superadmin/frontpages/managefrontpage/">
              <div class="img img-center"> <i class="fa fa-file-o" style="font-size:45px; !important"></i> </div>
              <p class="title text-center">Manage Front Pages</p>
              </a>  
              </div>
    <div class="col-md-3 tile-active"> 
            <a class="tile tile-light-blue" data-stop="3000" href="<?php echo base_url() ;?>superadmin/newsletter/manage/">
              <div class="img img-center"> <i class="fa fa-desktop" style="font-size:45px; !important"></i> </div>
              <p class="title text-center">Manage Newsletter</p>
              </a>  
              </div>
    <div class="col-md-3 tile-active"> 
            <a class="tile tile-light-blue" data-stop="3000" href="<?php echo base_url() ;?>superadmin/faq/manage/">
              <div class="img img-center"> <i class="fa fa-edit" style="font-size:45px; !important"></i> </div>
              <p class="title text-center">Manage FAQ</p>
              </a>  
              </div>
    <div class="col-md-3 tile-active"> 
            <a class="tile tile-light-blue" data-stop="3000" href="<?php echo base_url() ;?>superadmin/admin/managebanner/">
              <div class="img img-center"> <i class="fa fa-rss-square" style="font-size:45px; !important"></i> </div>
              <p class="title text-center">Manage Banner</p>
              </a>  
              </div>
    <div class="col-md-3 tile-active"> 
            <a class="tile tile-light-blue" data-stop="3000" href="<?php echo base_url() ;?>superadmin/admin/addmessage/">
              <div class="img img-center"> <i class="fa fa-envelope-o" style="font-size:45px; !important"></i> </div>
              <p class="title text-center">Manage Message</p>
              </a>  
              </div>
    <div class="col-md-3 tile-active"> 
            <a class="tile tile-light-blue" data-stop="3000" href="<?php echo base_url() ;?>superadmin/seller/manageseller/">
              <div class="img img-center"> <i class="fa fa-user" style="font-size:45px; !important"></i> </div>
              <p class="title text-center">Manage Seller</p>
              </a>  
              </div>                                      
    <div class="col-md-3 tile-active"> 
            <a class="tile tile-light-blue" data-stop="3000" href="<?php echo base_url() ;?>superadmin/user/manageuser/">
              <div class="img img-center"> <i class="fa fa-user" style="font-size:45px; !important"></i> </div>
              <p class="title text-center">Manage User</p>
              </a>  
              </div>
    <div class="col-md-3 tile-active"> 
            <a class="tile tile-light-blue" data-stop="3000" href="<?php echo base_url() ;?>superadmin/product/manage/">
              <div class="img img-center"> <i class="fa fa-bitbucket-square" style="font-size:45px; !important"></i> </div>
              <p class="title text-center">Manage Product</p>
              </a>  
              </div>
    <div class="col-md-3 tile-active"> 
            <a class="tile tile-light-blue" data-stop="3000" href="<?php echo base_url() ;?>superadmin/admin/managebrand/">
              <div class="img img-center"> <i class="fa fa-pencil-square" style="font-size:45px; !important"></i> </div>
              <p class="title text-center">Manage Brand</p>
              </a>  
              </div>
    <div class="col-md-3 tile-active"> 
            <a class="tile tile-light-blue" data-stop="3000" href="<?php echo base_url() ;?>superadmin/admin/managecontactinquiry/">
              <div class="img img-center"> <i class="fa fa-phone-square" style="font-size:45px; !important"></i> </div>
              <p class="title text-center">Manage Contact Enquiries</p>
              </a>  
              </div>          
    </div>
  </div>
  
</div>

<!-- END Tiles --> 
<div class="row">
  <div class="col-md-12">
    <div class="box box-black">
      <div class="box-title">
        <h3><i class="fa fa-retweet"></i> Thing To Do</h3>
        <div class="box-tool"> <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a> <a data-action="close" href="#"><i class="fa fa-times"></i></a> </div>
      </div>
      <?php
      $this->db->join('tbl_seller_details','tbl_seller_details.loginid=tbl_login_master.login_id');
	  $reg_seller_count=$this->master_model->getRecordCount('tbl_login_master',array('user_type'=>'seller'));
	  $this->db->join('tbl_user_master','tbl_user_master.login_id=tbl_login_master.login_id');	
	  $reg_user_count=$this->master_model->getRecordCount('tbl_login_master',array('user_type'=>'user'));
	  $contact_count=$this->master_model->getRecordCount('tbl_contact_inqury');	
	  ?>
      <div class="box-content">
        <ul class="things-to-do">
          <li>
            <p> <i class="fa fa-user"></i> <span class="value"><?php echo $reg_seller_count; ?></span> Seller Registration <a class="btn btn-success" href="<?php echo base_url() ;?>superadmin/seller/manageseller/">Go</a> </p>
          </li>
          <li>
            <p> <i class="fa fa-user"></i> <span class="value"><?php echo $reg_user_count; ?></span> User Registration <a class="btn btn-success" href="<?php echo base_url() ;?>superadmin/user/manageuser/">Go</a> </p>
          </li>
          <li>
            <p> <i class="fa fa-user"></i> <span class="value"><?php echo $contact_count; ?></span> Contact Enquiry  <a class="btn btn-success" href="<?php echo base_url() ;?>superadmin/admin/managecontactinquiry/">Go</a> </p>
          </li>
        </ul>
      </div>
    </div>
  </div>
  
</div>
<!-- BEGIN Main Content -->
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-title">
        <h3><i class="fa fa-bar-chart-o"></i> Visitors Chart</h3>
        <div class="box-tool"> <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a> <a data-action="close" href="#"><i class="fa fa-times"></i></a> </div>
      </div>
      <div class="box-content">
        <div id="visitors-chart" style="margin-top:20px; position:relative; height: 290px;"></div>
      </div>
    </div>
  </div>
  <!--<div class="col-md-5">
    <div class="box">
      <div class="box-title">
        <h3><i class="fa fa-bar-chart-o"></i> Weekly Visitors Stat</h3>
        <div class="box-tool"> <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a> <a data-action="close" href="#"><i class="fa fa-times"></i></a> </div>
      </div>
      <div class="box-content">
        <ul class="weekly-stats">
          <li> <span class="inline-sparkline">134,178,264,196,307,259,287</span> Visits: <span class="value">376</span> </li>
          <li> <span class="inline-sparkline">89,124,197,138,235,169,186</span> Unique Visitors: <span class="value">238</span> </li>
          <li> <span class="inline-sparkline">625,517,586,638,669,698,763</span> Page Views: <span class="value">514</span> </li>
          <li> <span class="inline-sparkline">1.34,2.98,0.76,1.29,1.86,1.68,1.92</span> Pages / Visit: <span class="value">1.43</span> </li>
          <li> <span class="inline-sparkline">2.34,2.67,1.47,1.97,2.25,2.47,1.27</span> Avg. Visit Time: <span class="value">00:02:34</span> </li>
          <li> <span class="inline-sparkline">70.34,67.41,59.45,65.43,78.42,75.92,74.29</span> Bounce Rate: <span class="value">73.56%</span> </li>
          <li> <span class="inline-sparkline">78.12,74.52,81.25,89.23,86.15,91.82,85.18</span> % New Visits: <span class="value">82.65%</span> </li>
        </ul>
      </div>
    </div>
  </div>-->
</div>
<?php $this->load->view('admin/graph'); ?>
