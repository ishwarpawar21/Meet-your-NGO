<!-- BEGIN Sidebar -->
<div id="sidebar" class="navbar-collapse collapse">
    <!--BEGIN Navlist -->
    <ul class="nav nav-list">
        <!-- BEGIN Search Form -->
        <li>
            <form target="#" method="GET" class="search-form">
                <span class="search-pan">
                    <button type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                    <input type="text" name="search" placeholder="Search ..." autocomplete="off" />
                </span>
            </form>
        </li>
        <!-- END Search Form -->
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
               <li <?php if($this->uri->segment(3)=='points'){?> class="active" <?php }?>>
               <a href="<?php echo base_url().'superadmin/admin/points'; ?>">Manage Points</a>
               </li>
            </ul>
        </li>
        <li <?php if($this->uri->segment(2)=='categories'){?> class="active" <?php }?>>
            <a href="#" class="dropdown-toggle" >
                <i class="fa fa-sitemap"></i>
                <span>Manage Categories</span>
                 <b class="arrow fa fa-angle-right"></b>
            </a>
             <ul class="submenu" <?php if($this->uri->segment(2)=='categories'){?> style="display:block;" <?php }?>>
             <li <?php if($this->uri->segment(3)=='add'){?> class="active" <?php }?> ><a href="<?php echo base_url().'superadmin/categories/add/'; ?>">Add Categories</a></li>
              <li <?php if($this->uri->segment(2)=='categories'|| $this->uri->segment(3)=='update'){?> class="active" <?php }?> ><a href="<?php echo base_url().'superadmin/categories/manage/'; ?>">Manage Categories</a></li>
             </ul>
        </li>
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
               <a href="<?php echo base_url().'superadmin/newsletter/send/'; ?>">Send</a>
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
        <!--start Banner-->
        <li <?php if($this->router->fetch_method()=='managebanner'){?> class="active" <?php }?>>
            <a href="#" class="dropdown-toggle" >
                <i class="fa fa-rss-square"></i> 
                <span>Banner</span><b class="arrow fa fa-angle-right"></b>
            </a>
            <ul class="submenu">
               <li <?php if($this->router->fetch_method()=='managebanner'){?> class="active" <?php }?>>
               <a href="<?php echo base_url().'superadmin/admin/managebanner/'; ?>">Manage Banner</a>
               </li>
            </ul>
        </li>
        <!--end Banner-->
        <!--community message -->
        <li <?php if($this->router->fetch_method()=='addmessage'){?> class="active" <?php }?>>
            <a href="#" class="dropdown-toggle" >
                <i class="fa fa-envelope-o"></i> 
                <span>Message</span><b class="arrow fa fa-angle-right"></b>
            </a>
            <ul class="submenu">
            <li <?php if($this->router->fetch_method()=='addmessage'){?> class="active" <?php }?>><a href="<?php echo base_url().'superadmin/admin/addmessage/'; ?>">Update Message</a></li>
            </ul>
        </li>
        <!--end community messgae-->
        <!--Seller Srart-->
        <li <?php if($this->router->fetch_class()=='seller'|| $this->router->fetch_method()=='managecoupon' || $this->router->fetch_method()=='sellerpoints'){?> class="active" <?php }?>>
            <a href="#" class="dropdown-toggle" >
                <i class="fa fa-user"></i> 
                <span>Seller's</span><b class="arrow fa fa-angle-right"></b>
            </a>
            <ul class="submenu">
               <li <?php if($this->uri->segment(3)=='manageseller'){?> class="active" <?php }?>>
               <a href="<?php echo base_url().'superadmin/seller/manageseller/'; ?>">Manage Seller</a>
               </li>
               <li <?php if($this->uri->segment(3)=='sellerpoints'){?> class="active" <?php }?>>
               <a href="<?php echo base_url().'superadmin/seller/sellerpoints/'; ?>">Seller Point</a>
               </li>
            </ul>
        </li>
        <!--Seller End-->
        <!--User Srart-->
        <li <?php if(($this->router->fetch_class()=='user' &&  $this->router->fetch_method()=='manageuser') || ($this->router->fetch_class()=='user' && $this->router->fetch_method()=='userpoints') || ($this->router->fetch_class()=='user' && $this->router->fetch_method()=='manageupgradeuser')){?> class="active" <?php }?>>
            <a href="#" class="dropdown-toggle" >
                <i class="fa fa-user"></i> 
                <span>User's</span><b class="arrow fa fa-angle-right"></b>
            </a>
            <ul class="submenu">
               <li <?php if($this->uri->segment(3)=='manageuser'){?> class="active" <?php }?>>
               <a href="<?php echo base_url().'superadmin/user/manageuser/'; ?>">Manage User</a>
               </li>
               <li <?php if($this->uri->segment(3)=='manageuser'){?> class="active" <?php }?>>
               <a href="<?php echo base_url().'superadmin/user/manageupgradeuser/'; ?>">Manage Upgrade User</a>
               </li>
               <li <?php if($this->uri->segment(3)=='userpoints'){?> class="active" <?php }?>>
               <a href="<?php echo base_url().'superadmin/user/userpoints/'; ?>">User Point</a>
               </li>
            </ul>
        </li>
        <!--User End-->
         <!--Start Product--> 
        <li <?php if($this->router->fetch_class()=='product'){?> class="active" <?php }?>>
            <a href="#" class="dropdown-toggle" >
                <i class="fa fa-bitbucket-square"></i> 
                <span>Product</span><b class="arrow fa fa-angle-right"></b>
            </a>
            <ul class="submenu">
              <li <?php if($this->uri->segment(3)=='add'){?> class="active" <?php }?>>
               <a href="<?php echo base_url().'superadmin/product/add/'; ?>">Add</a>
               </li>
               <li <?php if($this->uri->segment(3)=='manage'){?> class="active" <?php }?>>
               <a href="<?php echo base_url().'superadmin/product/manage/'; ?>">Manage</a>
               </li>
               <li <?php if($this->uri->segment(3)=='purchased'){?> class="active" <?php }?>>
               <a href="<?php echo base_url().'superadmin/product/purchased/'; ?>">Purchased Product</a>
               </li>
            </ul>
        </li>
        <!--END Product-->
        <!--end community messgae-->
        <li <?php if($this->router->fetch_method()=='managebrand' || $this->router->fetch_method()=='addbrand' || $this->router->fetch_method()=='updatebrand' ){?> class="active" <?php }?>>
            <a href="javascript:void(0)" class="dropdown-toggle" >
                <i class="fa fa-pencil-square"></i> 
              
                <span>Brand</span><b class="arrow fa fa-angle-right"></b>
            </a>
         <!--BEGIN Add Brand-->
            <ul class="submenu">
            <li <?php if($this->router->fetch_method()=='managebrand'){?> class="active" <?php }?>><a href="<?php echo base_url().'superadmin/admin/managebrand/'; ?>">Manage Brand</a></li>
            </ul>
            <!--END Add Brand-->
           
        </li>
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