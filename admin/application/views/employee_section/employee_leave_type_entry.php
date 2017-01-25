<script>
$(document).ready(function(){
 $('#leave_type_form').submit(function() {
	 document.getElementById('leave_type_submit').innerHTML = 'Saveing----';
	 document.getElementById('leave_type_submit').disabled = 'disabled';
		$.post(
            "index.php/employee_submit/employee_leave_type_form",
            $("#leave_type_form").serialize(),
            function(data){
              if(data==1)
			  {
				 $('#confirmation').fadeIn('slow').delay(2000).fadeOut('slow');
					setTimeout(function(){					
					location.reload();
					},2000)
			  }	
			  else {
				alert(data);
				document.getElementById('leave_type_submit').disabled = false;
			  }
			  document.getElementById('leave_type_submit').innerHTML = 'Save';
		});
 return false;
 });
});

</script>
<div class="row" style="margin-top:40px;">
	<div class="col-md-12">
		 <form  class="form-horizontal" action="employee_submit/employee_leave_type_form" method="post" id="leave_type_form">
			  <div class="form-group">
				<label class="control-label col-sm-2" for="leave_type">Leave Type</label>
				<div class="col-sm-3">
				  <input type="text" class="form-control" id="leave_type" name="leave_type" required placeholder="Enter leave type" >
				</div>
				<label class="control-label col-sm-2" for="pwd">Maximum Leave</label>
					<div class="col-sm-3">
					   <input type="text" class="form-control" id="maximum_leave" name="max_leave" required placeholder="maximum leave number" onkeypress="return isNumber(this.event);">
					</div>
					<div class="col-sm-2"> 
					  <button type="submit" class="btn btn-primary" name="submit" id="leave_type_submit">Save</button>
					</div>
			  </div>
	 </form>	 		
	</div>	
	<!----///leave type form close here///--->
</div>		
	
	<br/>
		<table class="table">
			<tr class="active"><td>Employee Leave Type List</td></tr>
		</table>
	<br/>
	
	
	<!----///leave type report start here///--->
	<div class="row">
		 <div class="col-md-12">
				<table id="example4" class="table  table-bordered table-condensed table-striped">
					<thead>
						<tr>
						<th>Serial No</th>
						<th>Leave Type</th>
						<th>Maximum Leave</th>
						<th>Status</th>
						<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php $nr=1;
						foreach($leave_type as $value){
						if($value->status>0) {  $cls="success"; $txt="Active"; } else {  $cls="danger"; $txt="in-Active"; }	
						?>
						<tr>
						<td><?php echo $nr; ?></td>
						<td><?php echo $value->lev_type;?></td>
						<td><?php echo $value->	max_lev;?></td>
						<td><button type="button" class="btn btn-<?php echo $cls; ?> btn-sm" ><?php echo $txt; ?></button></td>
						<td>
						<a href="employee_section/employee_leave_type_edit?id=<?php echo $value->levid; ?>">
						<button class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-edit"></span></button> </a>
						</td>
						
						<?php $nr++; } ?>
						</tr>
					</tbody>
					
				</table>
			
		 </div>
		 
		<!----///leave type report close here////----> 
</div>