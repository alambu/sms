<script>
$(document).ready(function(){
 $('#department_form').submit(function() {
	 document.getElementById('department_submit').innerHTML = 'Saveing----';
	 document.getElementById('department_submit').disabled = 'disabled';
		$.post(
            "index.php/employee_submit/employee_dep_catg",
            $("#department_form").serialize(),
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
				document.getElementById('department_submit').disabled = false;
			  }
			  document.getElementById('department_submit').innerHTML = 'Save';
		});
 return false;
 });
});

</script>
	<div class="row" style="margin-top:25px;">
		 <div class="col-md-12">
			 <form class="form-horizontal"action="employee_submit/employee_dep_catg" method="post" id="department_form">
				<div class="form-group">
				  <label class="control-label col-md-2" for="pwd">Department:</label>
				  <div class="col-md-6">          
					<input type="text" name="dept"  class="form-control" placeholder="Enter  Employee  Department" required/>
				  </div>
				  <div class="col-md-2">          
					<button type="submit" name="submit" id="department_submit" class="btn btn-primary">Save</button>
				  </div>
				</div>
			  </form>			
			
		  </div>
		  
	</div>

<!----///Employee Department form start here////---->

<br/>
<table class="table">
	<tr class="active"><td>Employee Department List</td></tr>
</table>
<br/>

<!----///Employee Department Report Start hear////---->
	<div class="row">
		<div class="col-md-12">
			<table id="example5" class="table table-bordered table-condensed table-striped">
				<thead>
					<tr>
						<td>SL.No</td>
						<td>Department Name</td>
						<td>Action</td>
					</tr>
				</thead>
				<tbody>
					<?php 
						
						$d=1;
						foreach($dept as $value){
						$delete_test=$this->employee->emp_setting_delete_test("empee","department",$value->edepid);	
						if($delete_test>0) { $disabled="disabled"; } else { $disabled=""; }
					?>
					<tr>
						<td><?php echo $d++; ?></td>
						<td><?php echo $value->manage_type; ?></td>
						<td>
						<a href="employee_edit/employee_dep_catg?id=<?php echo $value->edepid; ?>">
						<button class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-edit"></span></button>
						</a>
						&nbsp;
						<a  href="employee_submit/employee_dep_catg_delete?id=<?php echo $value->edepid; ?>" onclick="return delete_confirm();">
						<button class="btn btn-danger btn-sm" <?php echo $disabled; ?>><span class="glyphicon glyphicon-remove"></span></button>
						</a>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
<!----///Employee Department Report Start hear////---->