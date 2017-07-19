<script type="text/javascript">
$(document).ready(function(){
	var endDate = "<?php echo date('Y/m/d',strtotime($rowcoupon['coupon_expirydate']));?>";
	// var date = new Date(new Date().valueOf() + 15 * 24 * 60 * 60 * 1000);
  //dateFormat is YYYY/MM/DD
  $('.showTimer_<?php echo $rowcoupon['coupon_id'] ?>').countdown(endDate, function(event) {
	if(event.strftime('%D')=='00')
	{
		$(this).html(event.strftime('Expire Today'));
	}  
	else
	{
		$(this).html(event.strftime('Expires in %D days'));
	}
  });
});
</script>