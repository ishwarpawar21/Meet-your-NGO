<!-- content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<div class="container">
<div class="women_main">

	<!-- start content -->
			<div class="row single">
			
			
			 <!-- Left SIDE BAAR -->
	       		 <div class="col-md-3">
	  <div class="w_sidebar">
		  
		<section  class="sky-form">
					<h4>Locality</h4>
						<div class="row1 scroll-pane">
							 
							<div class="col col-4">
							 <?php 
                $result_loc=$this->db->query("select * from locatity_table");
			    if($result_loc->result() > 0)
		        {
		         foreach($result_loc->result() as $row_loc)
		         {
		         	?>
                            <label class="checkbox"><input type="checkbox" name="checkbox"  value="<?=$row_loc->locatity_name;?>" onchange = "setlocality(this)" <?php if($this->session->userdata('locality_array')){foreach($this->session->userdata('locality_array') as $vall){if($vall==$row_loc->locatity_name){echo "checked";}}}?>><i></i><?=$row_loc->locatity_name;?></label>
                           
              
                <?php
                 }
                } ?>
                       							
			                  </div>
						</div>
		</section>
<script type="text/javascript">
		
 function setlocality(element){
    
	 $.ajax({url: "<?php echo base_url(); ?>" + "ajax_post_controller/searchopt/locality?valabc="+element.value,
             success: function(output) {
              
                $('#test').html(output);
            },
          error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " "+ thrownError);
          }});

	//alert($this->session->userdata('locality_data'));
  
}

</script>
		
		
		<section class="sky-form">
						<h4>Fields OF Operation</h4>
						<div class="row1 scroll-pane">
							<div class="col col-4">
							 <?php 
                $result_field=$this->db->query("select * from field_of_operation_table");
			    if($result_field->result() > 0)
		        {
		         foreach($result_field->result() as $row_field)
		         {
		         	?>
		         	 <label class="checkbox"><input type="checkbox" name="checkbox" value="<?=$row_field->field_of_operation;?>" onchange = "setoperation(this)" <?php if($this->session->userdata('operation_array')){foreach($this->session->userdata('operation_array') as $valo){if($valo==$row_field->field_of_operation){echo "checked";}}}?>><i></i><?=$row_field->field_of_operation;?></label>
                      
                           
              
                <?php
                 }
                } ?>
                       							
			                  </div>
						</div>						
		</section>
		<script type="text/javascript">
		
    function setoperation(element){
    
	 $.ajax({url: "<?php echo base_url(); ?>" + "ajax_post_controller/searchopt/setoperation?valoper="+element.value,
             success: function(output) {
              
                $('#test').html(output);
            },
          error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " "+ thrownError);
          }});

	//alert($this->session->userdata('locality_data'));
  
}

</script>
		
		<section class="sky-form">
						<h4>Language</h4>
						<div class="row1 scroll-pane">
							<div class="col col-4">
							 <?php 
                $result_lang=$this->db->query("select * from language_table");
			    if($result_lang->result() > 0)
		        {
		         foreach($result_lang->result() as $row_lang)
		         {
		         	?>
                             <label class="checkbox"><input type="checkbox" name="checkbox" value="<?=$row_lang->language;?>" onchange = "setlanguage(this)" <?php if($this->session->userdata('language_array')){ foreach($this->session->userdata('language_array') as $vallg){if($vallg==$row_lang->language){echo "checked";}}}?> ><i></i><?=$row_lang->language;?></label>
                            
                           
              
                <?php
                 }
                } ?>
                       							
			                  </div>
						</div>						
		</section>
		<script type="text/javascript">
		
    function setlanguage(element){
    
	 $.ajax({url: "<?php echo base_url(); ?>" + "ajax_post_controller/searchopt/setlanguage?vallang="+element.value,
             success: function(output) {
              
                $('#test').html(output);
            },
          error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " "+ thrownError);
          }});

        }

</script>
		
		<section class="sky-form">
						<h4>Days Of Weeks</h4>
						<div class="row1 scroll-pane">
							<div class="col col-4">
							 <?php 
                $result_weekdays=$this->db->query("select * from days_of_week_table");
			    if($result_weekdays->result() > 0)
		        {
		         foreach($result_weekdays->result() as $row_weekdays)
		         {
		         	?> <label class="checkbox"><input type="checkbox" name="checkbox" value="<?=$row_weekdays->days_of_week;?>" onchange = "setdays(this)" <?php if($this->session->userdata('days_array')){foreach($this->session->userdata('days_array') as $vald){if($vald==$row_weekdays->days_of_week){echo "checked";}}}?>><i></i><?=$row_weekdays->days_of_week;?></label>
                            
                           
              
                <?php
                 }
                } ?>
                       							
			                  </div>
						</div>						
		</section>
 <script type="text/javascript">
		
    function setdays(element){
    
	 $.ajax({url: "<?php echo base_url(); ?>" + "ajax_post_controller/searchopt/setdays?valdays="+element.value,
             success: function(output) {
              
                $('#test').html(output);
            },
          error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " "+ thrownError);
          }});
  
}

</script>	
		
		<section class="sky-form">
						<h4>Time Slot</h4>
						<div class="col col-4">
							 <?php 
                $result_ts=$this->db->query("select * from time_slot_table");
			    if($result_ts->result() > 0)
		        {
		         foreach($result_ts->result() as $row_ts)
		         {
		         	?>
		         	<label class="checkbox"><input type="checkbox" name="checkbox" value="<?=$row_ts->time_slot;?>" onchange = "settime(this)" <?php if($this->session->userdata('time_array')){ foreach($this->session->userdata('time_array') as $valt){if($valt==$row_ts->time_slot){echo "checked";}}}?>><i></i><?=$row_ts->time_slot;?></label>
                         
                           
              
                <?php
                 }
                } ?>
                       							
			                  </div>
 <script type="text/javascript">
		
    function settime(element){
    
	 $.ajax({url: "<?php echo base_url(); ?>" + "ajax_post_controller/searchopt/settime?valtime="+element.value,
             success: function(output) {
              
                $('#test').html(output);
            },
          error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " "+ thrownError);
          }});
  
}

</script>					
		</section>
	</div>
   </div>
   
   <!-- // END Left SIDE BAR -->
			<!-- Right SIDE BARR -->
				<div class="col-md-9" id="test"></div>	
	       		 <!-- END right SIDE BARR -->
	 	   <div class="clearfix"></div>		
	  </div>
	<!-- end content -->
</div>
</div>