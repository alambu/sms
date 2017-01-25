<script>
$(document).ready(function(){
 $('#emp_type_form').submit(function() {
	 document.getElementById('emp_type_submit').innerHTML = 'Saveing----';
	 document.getElementById('emp_type_submit').disabled = 'disabled';
		$.post(
            "index.php/employee_submit/employee_type_catg",
            $("#emp_type_form").serialize(),
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
				document.getElementById('emp_type_submit').disabled = false;
			  }
			  document.getElementById('emp_type_submit').innerHTML = 'Save';
		});
 return false;
 });
});

</script>
<div class="row" style="margin-top:40px;">
	<!---///emp_type form start here///--->
	<div class="col-md-12">
			 <form class="form-horizontal"  action="employee_submit/employee_type_catg" method="post" id="emp_type_form">
			 
				<div class="form-group" id="itemRows">
				  <label class="control-label col-sm-2" for="pwd">Employee Type:</label>
				  <div class="col-sm-6">          
					<input type="text" name="typ" required class="form-control" id="types" placeholder="Enter Employee Type"/>
				  </div>

					<div class="col-sm-4"> 
					  <button type="submit" name="submit" id="emp_type_submit"  class="btn btn-primary">Save</button>
					</div>
				</div>
			</form>			
				
	</div>
</div>	
	<!---/////emp type form close here////--->
	<br/>
	<table class="table">
		<tr class="active"><td>Employee Type List</td></tr>
	</table>
	<br/>
	
	<!---////emp type report start here////--->
	<div class="row">
		 <div class="col-md-12">
					
				<table id="example1" class="table  table-bordered table-striped table-condensed">
						<thead>
							<tr>
							<th>Serial No</th>
							<th>Emp Type</th>
							<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php $nr=1;
							foreach($info as $value) {
							$test=$this->employee->emp_setting_delete_test("empee","emptypeid",$value->emptypeid);
							if($test>0) { $disabled="disabled"; } else { $disabled=""; }	 
							?>
							<tr>
							<td><?php echo $nr; ?></td>
							<td><?php echo strtoupper($value->type); ?></td>
							<td>
							<a href="employee_section/employee_type_edit?id=<?php echo $value->emptypeid; ?>"
							 <button class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-edit"></span></button>
							</a>&nbsp;
							<a href="employee_submit/employee_type_delete?id=<?php echo $value->emptypeid; ?>">
							 <button <?php echo $disabled; ?> class="btn btn-danger btn-sm" onclick="return delete_confirm();"><span class="glyphicon glyphicon-remove"></span></button>
							</a>
							</td>
							
							<?php $nr++; } ?>
							</tr>
						</tbody>
						
				</table>
		 </div>
		 <!-----///emp type report close here///---->
</div>			  
									  