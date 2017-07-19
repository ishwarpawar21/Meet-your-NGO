<form method="post" name="form_subscribe" id="form_subscribe">
<div class="active-inner">
           <div class="right-message" style="display:none;" id="newsletteradd">Thank you for subscribing our newsletter.</div>
          <div class="news-inner">
            <div class="news-title">Subscribe to Newsletter</div>
            <div class="news-fild">
             <div class="news-left-fild">
             <input name="email_id" id="email_id" class="subscribe-search" placeholder="Enter your email" type="text" />
             </div>
             <div class="news-left-btn">
             <input name="subscribe_news" id="subscribe_news" class="subscribe-btn" value="Subscribe" type="submit" onClick="return subscribe_newsletter();"/>
             </div>
             <div class="clr"></div>
            </div>
            <div class="errr" style= " <?php if(form_error('email_id')!=''){ echo 'display:show'; } else{ echo 'display:none';}?>" id="error_email_id"></div>
          </div>
 </div>
 </form>