<script>
$(document).ready(function(){
 $('#designation_form').submit(function() {
	 document.getElementById('designation_submit').innerHTML = 'Saveing----';
	 document.getElementById('designation_submit').disabled = 'disabled';
		$.post(
            "index.php/employee_submit/employee_designation_catg",
            $("#designation_form").serialize(),
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
				document.getElementById('designation_submit').disabled = false;
			  }
			  document.getElementById('designation_submit').innerHTML = 'Save';
		});
 return false;
 });
});

</script>
<div class="row" style="margin-top:40px;">
  <div class="table-responsive">
	<div class="col-md-12">
		  <form class="form-horizontal" action="employee_submit/employee_designation_catg" method="post" id="designation_form">
			<div class="form-group">
			  <div class="col-md-4">
				 <label>Designation:</label>
				<input type="text" name="desig" class="form-control" id="desig"  placeholder="Enter Designation Name" required />
			  </div>
			  
			  <div class="col-md-4"> 
				 <label>Total Post:</label>
				<input type="number"  name="need" min="0" class="form-control" id="desig"  placeholder="Enter Number" required/>
			  </div>
			  <div class="col-md-4"> 
				 <label>Academic Qualification:</label>
				<textarea class="form-control" name="quali" required>
				</textarea>
			  </div>
			</div>
			<div class="form-group">
			  <div class="col-md-4"> 
					<button type="submit" name="submit" id="designation_submit" class="btn btn-primary">Save</button>
			  </div>
			 
			</div>
			
		  </form>		
	</div>	
	</div>
</div>	
	<!---////designation form close here--->
<br/>
<table class="table">
	<tr class="active"><td>Employee Designation List</td></tr>
</table>
<br/>
	
	<!---///designation report start here///--->
	<div class="row">	
		<div class="col-md-12">
			<table id="example3" class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<th>Serial No</th>
							<th>Designation</th>
							<th>Total Post</th>
							<th>Academic Qualification</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php $nr=1;
						foreach($desig as $value){
						$test=$this->employee->emp_setting_delete_test("empee","deginition",$value->ecatgid);
						if($test>0) { $disabled="disabled"; } else { $disabled=""; }	
						?>
						<tr>
						<td><?php echo $nr; ?></td>
						<td><?php echo $value->emp_type;?></td>
						<td><?php echo $value->need_emp;?></td>
						<td><?php echo $value->qualification;?></td>
						<td>
						<a href="employee_section/employee_designation_catg_edit?id=<?php echo $value->ecatgid; ?>">
						<button class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-edit"></span></button>
						</a>	&nbsp; 
						<a href="employee_submit/employee_designation_catg_delete?id=<?php echo $value->ecatgid; ?>" onclick="delete_confirm();">
						<button <?php echo $disabled; ?> class="btn btn-danger btn-sm" ><span class="glyphicon glyphicon-remove"></span></button>
						</a>

						</td>
						
						<?php $nr++; } ?>
						</tr>
					</tbody>
					
				</table>
			</div>
		
		<!----///designation report close here---->
  </div>