 <!--contain-start-->
  <div class="contain"> 
  <!--inner-->
  <div class="new-coupon-inner"> 
    <!--contain-left-->
    <div class="">
      <div class="co-pages">
        <div class="new-heading">
          <div class="new-heading-inner">
            <div class="inner-page-heading">FAQ's </div>
            <div class="clr"></div>
          </div>
        </div>
        <div class="clr"></div>
      </div>
      <div class="co-pages"> 
        <!--main-box-->
        <div class="faq-title">Using a Coupon</div>
        <?php   
		//$this->db->join('tbl_faq_categories','tbl_faq_categories.faqid=tbl_faq_master.faq_id');
		//$fetch_faq=$this->master_model->getRecords('tbl_faq_master',array('tbl_faq_master.faq_status'=>'1','tbl_faq_categories.faqcat_id'=>'3'));
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
        <!--main-box--> 
        <div class="clr"></div>
      </div>
      <div class="clr"></div>
    </div>
    <!--contain-left--> 
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