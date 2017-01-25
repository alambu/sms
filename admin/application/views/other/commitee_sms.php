<script>
$(document).ready(function(){
 $('#sms_form').submit(function() {
	 document.getElementById('class_submit').innerHTML = 'Sending----';
	 document.getElementById('class_submit').disabled = 'disabled';
		$.post(
            "index.php/userpanel/commitee_sms",
            $("#sms_form").serialize(),
            function(data){	
              if(data==1)
			  {
				alert('Send Successfully');
				window.location="userpanel/school_commitee";
			  }	
			  else 
			  {  
				  alert(data);
				  document.getElementById('class_submit').disabled = false;
			  }
			  document.getElementById('class_submit').innerHTML = 'Send';
		});
 return false;
 });
});	
</script>
						<?php $all_commitee=$this->db->select("*")->from("manageing_commitee")->get()->result(); ?>
						<div class="row">
							<div class="col-md-12">
								<form class="form-horizontal" role="form" action="userpanel/commitee_sms" method="post" id="sms_form">
									
									<div class="form-group">
									  <label class="control-label col-sm-2">Commitee:</label>
									   <div class="col-sm-6" > 
									  <select class="form-control" name="type" style="width:100%;" required>
										<option value="">--Select--</option>
										<option value="all">All Members</option>
										<?php foreach($all_commitee as $value) { ?>
										<option value="<?php echo $value->mobile; ?>"><?php echo $value->name."( ".$value->designation." )"; ?></option>
										<?php } ?>
									  </select>
									  </div>
									</div>
									<div class="form-group">
									  <label class="control-label col-sm-2">Message:</label>
									  <div class="col-sm-6" >  								
										<textarea class="form-control custom-control" rows="3" name="messages" style="resize:none;height:150px;" onkeyup="messagetexttec(this.value)" required></textarea>
									  </div>						  
									</div>
									
									<div class="form-group">        
									  <div class="col-sm-offset-2 col-sm-10">
										<button type="submit" name="submit" id="class_submit" class="btn btn-primary">Send</button>
									  </div>
									</div>
									
									<div class="form-group">        
									  <div class="col-sm-offset-2 col-sm-10">
										
									  </div>
									</div>
								  </form>
							  </div>
						  </div>