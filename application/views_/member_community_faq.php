<div class="contain"> 
  <!--inner-->
  <div class="innar-page"> 
    <!--profile-inner-->
    <div class="profile-top">
      <?php include('profile-header.php'); ?>
    </div>
      <!--my-profile-->
      <div class="my-profile-outer"> 
        <!--profile-left-->
        <div class="community-left">
          <div class="active-inner"><div class="about-heading">
                <div class="latest-sub-title">Community FAQ<span class="title-arow"><img src="<?php echo base_url(); ?>images/title-arow.png" width="20" height="21" alt="arow" /></span></div>
              </div></div>
              
              <div class="active-inner">
              <div class="new-heading-new">
              <div class="new-heading-new1">
              	<div class="com-list-btn" style=" background:none; padding-bottom:11px;">
                	<div class="com-list-all"> <a href="<?php echo base_url().'community/';?>">	Dashboard </a></div>
                    <div class="com-list-all">|</div>
                    <div class="com-list-all"> <a href="javascript:void(0);" class="current"> FAQ's </a></div>
                     <div class="com-list-all">|</div>
                 <div class="com-list-all"> <a href="<?php echo base_url().'member/'.$seldetail[0]['user_slug'].'/shared_coupon/';?>" >Shared Coupon </a></div>
                <div class="com-list-all">|</div>
                 <div class="com-list-all"> <a href="<?php echo base_url().'member/'.$seldetail[0]['user_slug'].'/liked_coupon/';?>" >Liked Coupon </a></div>
                <div class="com-list-all">|</div>
                 <div class="com-list-all"> <a href="<?php echo base_url().'member/'.$seldetail[0]['user_slug'].'/commented_coupon/';?>">Commented Coupon </a></div>
                    <div class="clr"></div>
                </div>
                </div>
                </div>
              </div>
           <div class="active-inner">
           <?php   
			if(count($fetch_faq)>0)
			{
			foreach($fetch_faq as $faq)
			{
			 ?>
				
				<div class="sidebarmenu">
				
					<a class="menuitem submenuheader" href=""><?php echo $faq['faq_ques'];?></a>
					
					<div class="submenu">
						<ul>
						<li><a href=""><?php echo $faq['faq_ans'];?>. </a></li>
						</ul>
					</div>
					<div class="clr"></div>
					</div>
				<?php }
			}
			else
			{
               echo '<div class="err-message">No data found !</div>';
			}
     	   ?>
            <div class="clr"></div>
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/ddaccordion.js"></script>
 <script type="text/javascript">
ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["suffix", "<img src='<?php echo base_url(); ?>images/p.png' class='statusicon' />", "<img src='<?php echo base_url(); ?>images/m.png' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
</script>
<script type="text/javascript">
$(document).ready(function(){
	function bindClicks() {
        $("ul.tsc_pagination a").click(paginationClick);        
    }
    function paginationClick() {
        var href = $(this).attr('href');
        $("#rounded-corner").css("opacity","0.4");
        
    
        $.ajax({
            type: "GET",
            url: href,            
            data: {},
            success: function(response)
            {                
                //alert(response);
                $("#rounded-corner").css("opacity","1");
                $("#divID").html(response);
                bindClicks();
            }
        });
 
        return false;
    }
    bindClicks();
})
</script>

