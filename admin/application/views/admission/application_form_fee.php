<script>
$(document).ready(function(){
 $('#app_fee').submit(function() {
	 document.getElementById('fee_submit').innerHTML = 'Saveing----';
	 document.getElementById('fee_submit').disabled = 'disabled';
		$.post(
            "index.php/admission_submit/application_form_fee",
            $("#app_fee").serialize(),
            function(data){
              if(data==1)
			  {
				 alert('Save Successfully');
				 location.reload();
			  }	
			  else 
			  {
				alert(data);
				document.getElementById('fee_submit').disabled = false;
			  }
			  document.getElementById('fee_submit').innerHTML = 'Save';
		});
 return false;
 });
});

</script>

<form class="form-horizontal" role="form" action="admission_submit/application_form_fee" method="post" id="app_fee">
	<div class="form-group">
		<div class="col-md-1">
			<b style="float:right;padding-top:5px;">Form Fee</b>
		</div>
		<div class="col-md-8">	
			<input type="number" name="fee" class="form-control" min="0" value="<?php echo $fee_info->fee; ?>" placeholder="Enter Amount" required/>
			<input type="hidden" name='hid_id' value="<?php echo $fee_info->id; ?>"/>
		</div>
					
		<div class="col-md-1">
			<button type="submit" name="submit" id="fee_submit" class="btn btn-primary" data-toggle="tooltip" title="Save"> Save</button>
		</div>
	</div>
</form>