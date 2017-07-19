<!-- content -->
<div class="container">
<div class="main">
	<div class="row content_top">
		<div class="col-md-9 content_left">
	<!-- start slider -->
    <div id="fwslider">
        <div class="slider_container">
     <?php
		$q = $this->db->query("select * from hp_slider");
        
		        if($q->num_rows()>0)
		        {
		            foreach($q->result() as $row)
		            { ?>
            <div class="slide"> 
                <!-- Slide image -->
                    <img src="<?=base_url()?>../site_assets/images/<?=$row->hp_img_id?>.jpg" class="img-responsive" alt=""/>
                <!-- /Slide image -->
            </div>
            <!-- /Duplicate to create more slides -->
           <?php
          }
          }?>
          
        </div>
        <div class="timers"></div>
        <div class="slidePrev"><span></span></div>
        <div class="slideNext"><span></span></div>
    </div>

	<!-- end  slider -->
		</div>
		<div class="col-md-3 sidebar">
		
         <?php 
           $result=$this->db->query("select * from tbl_home_page_heading where status=1");
		   if($result->result() > 0)
		   {
		    foreach($result->result() as $row)
		     {
		         	       ?>
		<div class="grid_list">
			<a href="#"> 
				<div class="grid_text left">
					<h3><a href="<?=$row->link; ?>"><?=$row->heading; ?></a></h3>
					<p><?=$row->sub_heading; ?></p>
				</div>
				<div class="clearfix"></div>
			</a>	
		</div>	
		
		<?php }
		}?>					
		</div>
		<div class="clearfix"></div>
	</div>
	<?php 
           $resultn=$this->db->query("select * from tbl_homepage_news where id=2 and status=1")->row(); if($resultn){?>  
	<div class="col-md-12">
		
			
			    
			  <p align="left"><?=$resultn->contain?></p>
			
		
		</div>
		<div class="clearfix"></div>
		<?php }?>

	<div class="content">
	
 
		
		
		<div class="row grids">
		 <?php 
                          $resultm=$this->db->query("select * from tbl_homepage_middle where status=1");
			              if($resultm->result() > 0)
		                  {
		                    foreach($resultm->result() as $rowm)
		                     {
		         	       ?>
			<div class="col-md-4 grid1">
					<div class="col-md-12" style="padding: 0">
					  <img src="<?=base_url()?>../site_assets/images/pic<?=$rowm->id?>.jpg" class="" alt="" style="float: left;padding: 10%"/>  </td> <td> 
					  <h3><?=$rowm->heading; ?></h3>
					  <p><?=$rowm->subheading; ?> </p>
					</div>
					<div class="col-md-12">
						<p><?=$rowm->contain; ?> </p>
						<div class="create_btn" style="float: none;margin-top: 10px">
								<a href="<?=$rowm->link;?>">Read More</a>
						</div>
					</div>
			</div>
			<?php
		   }	
		}?>
			
			
			
			 
			 
		</div> 
		
	</div>
	<?php 
           $resultn=$this->db->query("select * from tbl_homepage_news where id=1 and status=1")->row(); if($resultn){?>  
	<div class="content" style="text-align: left">
		<div class="content_text">
			<h2 align="center"><a>Upcoming Events</a></h2>
			    
			  <p align="center"><?=$resultn->contain?></p>
			
		</div>
		<?php }?>
		<div class="row grids">
		 <?php 
                          $result=$this->db->query("select * from tbl_homepage_footer where status =1");
			              if($result->result() > 0)
		                  {
		                    foreach($result->result() as $row)
		                     {
		         	       ?>
			<div class="col-md-4 grid1">
					<div class="col-md-12" style="padding-left: 10%;padding-bottom: 10%;padding-right: 10%">
					  <img src="<?=base_url()?>../site_assets/images/icon4.png" class="" alt="" style="margin:0 10px; float: left"/>
					  <h3><?=$row->heading; ?></h3>
						<p><?=$row->contain; ?> </p>
					</div>
			</div>
			
			 <?php 

						   }

						 }?>
			
			
		</div>
		
		
	</div> <!-- end content -->
</div>
</div>