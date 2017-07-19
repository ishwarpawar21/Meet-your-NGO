<!-- BEGIN Sidebar -->
<div id="sidebar" class="navbar-collapse collapse">
    <!--BEGIN Navlist -->
    <ul class="nav nav-list">
       
        <li <?php if($this->router->fetch_method()=='dashboard'){?> class="active" <?php }?>>
            <a href="<?php echo base_url().'superadmin/admin/dashboard/'; ?>">
               <i class="fa fa-dashboard"></i>
               <span>Dashboard</span>
            </a>
        </li>

        <li <?php if(($this->router->fetch_class()=='admin' && $this->router->fetch_method()=="accountsetting") || ($this->router->fetch_class()=='admin' && $this->router->fetch_method()=="sociallink") || ($this->router->fetch_class()=='admin' && $this->router->fetch_method()=="points")){?> class="active" <?php }?>>
            <a href="#" class="dropdown-toggle" >
                <i class="fa fa-cogs"></i>
                <span>Account settings</span>
                 <b class="arrow fa <?php if($this->router->fetch_class()=='admin' ){echo 'fa-angle-down';}else{echo 'fa-angle-right';} ?>"></b>
            </a>
             <ul class="submenu">
            <li <?php if($this->uri->segment(3)=='accountsetting'){?> class="active" <?php }?>><a href="<?php echo base_url().'superadmin/admin/accountsetting'; ?>">Setting</a></li>
               <li <?php if($this->uri->segment(3)=='sociallink'){?> class="active" <?php }?>><a href="<?php echo base_url().'superadmin/admin/sociallink'; ?>">Social Links</a></li>
               
                    
               
            </ul>
        </li>
         <li <?php if(($this->router->fetch_class()=='admin' && $this->router->fetch_method()=="accountsetting") || ($this->router->fetch_class()=='admin' && $this->router->fetch_method()=="sociallink") || ($this->router->fetch_class()=='admin' && $this->router->fetch_method()=="points")){?> class="active" <?php }?>>
            <a href="#" class="dropdown-toggle" >
                <i class="fa fa-cogs"></i>
                <span>Home Page</span>
                 <b class="arrow fa <?php if($this->router->fetch_class()=='admin' ){echo 'fa-angle-down';}else{echo 'fa-angle-right';} ?>"></b>
            </a>
             <ul class="submenu">
            <li <?php if($this->uri->segment(3)=='accountsetting'){?> class="active" <?php }?>><a href="<?php echo base_url().'superadmin/admin/hp_slider'; ?>">Home page slider</a></li>
               <li <?php if($this->uri->segment(3)=='sociallink'){?> class="active" <?php }?>><a href="<?php echo base_url().'superadmin/admin/add_field_list?page=home-containt'; ?>">Home page containt</a></li>
               
                    
               
            </ul>
        </li>
        <li <?php if(($this->router->fetch_class()=='admin' && $this->router->fetch_method()=="accountsetting") || ($this->router->fetch_class()=='admin' && $this->router->fetch_method()=="sociallink") || ($this->router->fetch_class()=='admin' && $this->router->fetch_method()=="points")){?> class="active" <?php }?>>
            <a href="#" class="dropdown-toggle" >
                <i class="fa fa-cogs"></i>
                <span>Add fields</span>
                 <b class="arrow fa <?php if($this->router->fetch_class()=='admin' ){echo 'fa-angle-down';}else{echo 'fa-angle-right';} ?>"></b>
            </a>
             <ul class="submenu">
          
                <li <?php if($this->uri->segment(3)=='sociallink'){?> class="active" <?php }?>><a href="<?php echo base_url().'superadmin/admin/add_field_list?page=add-locality'; ?>">Locality</a></li>
                 <li <?php if($this->uri->segment(3)=='sociallink'){?> class="active" <?php }?>><a href="<?php echo base_url().'superadmin/admin/add_field_list?page=add-field_of_operation'; ?>">Fields of operations</a></li>
                  <li <?php if($this->uri->segment(3)=='sociallink'){?> class="active" <?php }?>><a href="<?php echo base_url().'superadmin/admin/add_field_list?page=add-language'; ?>">Language</a></li>
                   <li <?php if($this->uri->segment(3)=='sociallink'){?> class="active" <?php }?>><a href="<?php echo base_url().'superadmin/admin/add_field_list?page=add-day_of_week'; ?>">Days of week</a></li>
                    <li <?php if($this->uri->segment(3)=='sociallink'){?> class="active" <?php }?>><a href="<?php echo base_url().'superadmin/admin/add_field_list?page=add-time_slot'; ?>">Time slot</a></li> <li <?php if($this->uri->segment(3)=='sociallink'){?> class="active" <?php }?>><a href="<?php echo base_url().'superadmin/admin/add_field_list?page=add-state'; ?>">Add state</a></li>
                     <li <?php if($this->uri->segment(3)=='sociallink'){?> class="active" <?php }?>><a href="<?php echo base_url().'superadmin/admin/add_field_list?page=add-city'; ?>">Add city</a></li>
                    
               
            </ul>
        </li>
        
        <li ><a href="<?php echo base_url().'superadmin/admin/add_field_list?page=volenteer_exp'; ?>"><i class="fa fa-cog"></i>Manage Experience</a></li>
         <li ><a href="<?php echo base_url().'superadmin/admin/add_field_list?page=set-points'; ?>"><i class="fa fa-check-circle"></i>Set experience points</a></li>
                 
        <li <?php if($this->router->fetch_class()=='frontpages'){?> class="active" <?php }?>>
            <a href="#" class="dropdown-toggle" >
                <i class="fa fa-file-o"></i>
                <span>Manage Front Pages</span>
                 <b class="arrow fa <?php if($this->router->fetch_class()=='frontpages' ){echo 'fa-angle-down';}else{echo 'fa-angle-right';} ?>"></b>
            </a>
             <ul class="submenu">
             
              <li <?php if($this->uri->segment(3)=='managefrontpage' || $this->uri->segment(3)=='addfrontpage' || $this->uri->segment(3)=='frontupdate'){?> class="active" <?php }?> ><a href="<?php echo base_url().'superadmin/frontpages/managefrontpage/'; ?>">Manage Front Pages</a></li>
             </ul>
        </li>
        <!--<li <?php //if($this->router->fetch_class()=='blogs'){?> class="active" <?php //}?>>
            <a href="#" class="dropdown-toggle" >
                <i class="fa fa-pencil-square"></i> 
              
                <span>Blogs</span><b class="arrow fa fa-angle-right"></b>
            </a>
         <!--BEGIN Add Blogs-->
<!--            <ul class="submenu">
               <li <?php //if($this->uri->segment(3)=='manageblogs'){?> class="active" <?php //}?>><a href="<?php //echo base_url().'superadmin/blogs/manageblogs/'; ?>">Manage Blogs</a></li>
               <li <?php //if($this->uri->segment(3)=='addblogs'){?> class="active" <?php //}?>><a href="<?php //echo base_url().'superadmin/blogs/addblogs/'; ?>">Add Blogs</a></li>
              
            </ul>-->
            <!--END Add Blogs
        </li>-->
        <!--Start Newsletter--> 
        <li <?php if($this->router->fetch_class()=='newsletter'){?> class="active" <?php }?>>
            <a href="#" class="dropdown-toggle" >
                <i class="fa fa-desktop"></i> 
                <span>Newsletter</span><b class="arrow fa fa-angle-right"></b>
            </a>
            <ul class="submenu">
              <li <?php if($this->uri->segment(3)=='add'){?> class="active" <?php }?>>
               <a href="<?php echo base_url().'superadmin/newsletter/add/'; ?>">Add</a>
               </li>
               <li <?php if($this->uri->segment(3)=='manage'){?> class="active" <?php }?>>
               <a href="<?php echo base_url().'superadmin/newsletter/manage/'; ?>">Manage</a>
               </li>
               <li <?php if($this->uri->segment(3)=='send'){?> class="active" <?php }?>>
               <a href="<?php echo base_url().'superadmin/newsletter/send/user/'; ?>">Send</a>
               </li>
            </ul>
        </li>
        <!--END  Newsletter-->
        <!--Start FAQ--> 
        <li <?php if($this->router->fetch_class()=='faq'){?> class="active" <?php }?>>
            <a href="#" class="dropdown-toggle" >
                <i class="fa fa-edit"></i> 
                <span>FAQ</span><b class="arrow fa fa-angle-right"></b>
            </a>
            <ul class="submenu">
              <li <?php if($this->uri->segment(3)=='add'){?> class="active" <?php }?>>
               <a href="<?php echo base_url().'superadmin/faq/add/'; ?>">Add</a>
               </li>
               <li <?php if($this->uri->segment(3)=='manage'){?> class="active" <?php }?>>
               <a href="<?php echo base_url().'superadmin/faq/manage/'; ?>">Manage</a>
               </li>
            </ul>
        </li>
        <!--END FAQ-->
       
       
       
    	<li <?php if($this->router->fetch_method()=='managecontactinquiry' && $this->router->fetch_class()=="admin"){?> class="active" <?php }?>>
            <a href="<?php echo base_url().'superadmin/admin/managecontactinquiry/'; ?>" class="dropdown-toggle" >
                <i class="fa fa-phone-square"></i>
                <span>Contact Enquiries</span>
            </a>
        </li>
    </ul>
    <!-- END Navlist -->
    <!-- BEGIN Sidebar Collapse Button -->
    <div id="sidebar-collapse" class="visible-lg">
        <i class="fa fa-angle-double-left"></i>
    </div>
    <!-- END Sidebar Collapse Button -->
</div>
<!-- END Sidebar -->