
<!-- footer_top -->
<div class="footer_top">
 <div class="container">
	<div class="span_of_4">
		  
		<!-- start span_of_2 -->
		<div class="span_of_2">
		<div class="span1_of_2" style="float:right">
			<h5>need help? <a href="#">contact us <span></span> </a> </h5>
			<p>(or) Call us: +91-9595160095</p>
		</div>
		<div class="span1_of_2">
			<h5>follow us </h5>
			<?php 
                         $result=$this->db->query("select * from tbl_social where social_id=1")->row();
			               if($result)
		                   { ?>
			<div class="social-icons">
				     <ul>
				        <li><a href="<?php echo $result->facebook;?>" target="_blank"></a></li>
				        <li><a href="<?php echo $result->twitter;?>" target="_blank"></a></li>
				        <!--<li><a href="#" target="_blank"></a></li>
				        <li><a href="#" target="_blank"></a></li>
				        <li><a href="#" target="_blank"></a></li> -->
					</ul>
			</div>
			<?php } ?>
		</div>
		<div class="clearfix"></div>
		</div>
  </div>
</div>
</div>
<!-- footer -->
<div class="footer">
 <div class="container">
	<div class="copy">
	<p class="link"><a href="<?=base_url()?>site/tandc">Terms and Condition</a>|<a href="<?=base_url()?>site/policy">Privacy policy</a>|<a href="<?=base_url()?>site/jobs">Jobs</a></p>
	
		<p class="link">&copy; All rights reserved By MeetYourNGO | Design by&nbsp; <a href="http://www.creoweb.com/"> Creo WebTech</a></p>
	</div>
 </div>
</div>
</body>
</html>