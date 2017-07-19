<div class="contain"> 
  <!--inner-->
  <div class="innar-page"> 
    <!--profile-inner-->
    <div class="profile-top">
     <?php include('profile-header.php');?>
    </div>
      <!--my-profile-->
      <div class="my-profile-outer"> 
        <!--profile-left-->
        <div class="community-left">
          <div class="active-inner">
          <div class="new-heading-new">
            <div class="new-heading-new1">
              <div class="com-list-btn" style=" background:none; padding-bottom:11px;">
                <div class="com-list-all"> <a href="<?php echo base_url().'product/myproduct/approved/';?>" <?php if($this->uri->segment(3)=='approved' || $this->uri->segment(3)==''){echo 'class="current"';}?> >Approved</a></div>
                <div class="com-list-all">|</div>
                 <div class="com-list-all"> <a href="<?php echo base_url().'product/myproduct/pending/';?>" <?php if($this->uri->segment(3)=='pending'){echo 'class="current"';}?>>Pending </a></div>
                <div class="com-list-all">|</div>
                 <div class="com-list-all"> <a href="<?php echo base_url().'product/myproduct/cancel/';?>" <?php if($this->uri->segment(3)=='cancel'){echo 'class="current"';}?>>Cancel </a></div>
                <div class="clr"></div>
              </div>
            </div>
          </div>
        </div>
          <div class="active-inner">
          <?php 
		  if(count($productList)>0)
		  { 
		    foreach($productList as $rowproduct)
			{
				/*Total Sum OF userscored Master*/
				$this->db->select('SUM(tbl_userscored_point.share_point)+SUM(tbl_userscored_point.like_point)+SUM(tbl_userscored_point.comment_point)+SUM(tbl_userscored_point.community_point) as total');
				$getSumUSer=$this->master_model->getRecords('tbl_userscored_point',array('tbl_userscored_point.login_id'=>$this->session->userdata('login_id')));
				/*Total sum Of Product Master Point*/
				$this->db->select('SUM(purchase_point) as ProductTotal');
				$ProductTotal=$this->master_model->getRecords('tbl_purchase_point',array('tbl_purchase_point.purchase_login_id'=>$this->session->userdata('login_id')));
			?>
                <!--main-box-->
                <div class="latecom-outer">
                <div class="mainproduct-left"><img src="<?php echo base_url();?>uploads/product_image/<?php echo $rowproduct['product_image']; ?>" width="130" height="123" alt="Product Image" /></div>
                <div class="latecom-right">
                    <div class="latecom-titme"><a href="javascript:void(0);"><?php echo $rowproduct['product_title']; ?></a></div>
                    <div class="chatproduct-desk"><?php echo $rowproduct['product_desc']; ?></div>
                    <div class="product-desk">
                    <div class="product-code">
                      <div class="latecom-code-left">Product Point :</div>
                      <div class="product-code-left">
                        <div class="code-btn-inner">
                          <div class="latecom-code"><?php echo $rowproduct['product_point']; ?></div>
                          <div class="clr"></div>
                        </div>
                      </div>
                     
                      <div class="clr"></div>
                    </div>
                    </div>
                    <div class="comment-box">
                    <div class="clr"></div>
                  </div>
                <div class="clr"></div>    
                </div>
                <div class="clr"></div>
                </div>
               <!--main-box-->
               <div class="clr"></div>  
          <?php
			}
			?>
             <div class="job-pagging">  
		      <div class="paginate paginate-dark">
		       <?php echo $links; ?>
              </div>
             </div>
            <?php
		  }
		  else{ ?>           
           <tr>
           <td colspan="9"><div class="alert alert-danger" style="text-align:center;">No Product Found.</div></td>
           </tr>
           <?php }?>
		  
          </div>
          <div class="clr"></div>
        </div>
        <!--profile-left--> 
        <!--profile-right-->
        <div class="community-right">
          <?php include('right-panel.php'); ?>
        </div>
        <!--profile-right-->
        
        <div class="clr"></div>
      </div>
      <!--my-profile--> 
    <!--profile-inner-->
    
    <div class="clr"></div>
  </div>
  <!--inner--> 
</div>
<script language="javascript">
$(document).ready(function(){
    $('.productlimit').click(function(){
	  alert('you have no sufficient points.');
	  return false;
	});
	$('.addproduct').click(function(){
	   var purchase_point=$(this).attr('rel');
	   var product_id=$(this).attr('title');
	   var dataString = {purchase_point:purchase_point,product_id:product_id}
		   $.ajax({
					type: 'POST',
					url: site_url+'product/addpoint/',
					data:dataString,
					success:function(res)
					{
						if(res=='done')
						{
							alert("Product addedd successfully.");
							window.location.reload();
						}
						else
						{
						}
					}
			   });
	 
	 });
 });
</script>
