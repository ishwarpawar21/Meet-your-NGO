<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Twitter extends CI_Controller {
    public function __construct()
    {
	   parent::__construct();
	   $this->load->library('upload'); 
	   $this->load->library('aws_signed_request');  
	   $this->load->model('email_sending');	  
	   if( ! ini_get('date.timezone') )
	   { date_default_timezone_set('GMT');} 
	 /*$public_key = 'AKIAIPYFE3GBXMU7JGBA';
	   $private_key = 'lGcwpuxIitSKHYHZmgi40u4EBHTiSLX2Ia3MLe7d';
	   $associate_tag = 'wwtamazon-20';*/
	}
	public function index()
	{
		
		/*<a href="http://twitter.com/share" data-url="{{ $producturl }}" data-text="{{ $producttitle }}" class="twitter-share-button" data-count="horizontal" data-via="http://">Tweet</a>*/
	 echo '<a href="https://twitter.com/share" data-text="New Product" class="twitter-share-button" data-lang="en">Tweet</a>'
	?>
     <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
     <script>
        twttr.events.bind('tweet', function(event) { var tid = event.tweet_id; alert('twitter_id='+tid); });
     </script>
    <?php
	 }
}