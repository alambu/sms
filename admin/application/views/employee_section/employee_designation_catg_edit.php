<script>
function only_chareter(v){
 if((event.keyCode==32) && (v=='')){
	return false;
 }
 else if ((event.keyCode > 64 && event.keyCode < 91) || (event.keyCode > 96 && event.keyCode < 123) || event.keyCode == 8 || event.keyCode==32)
 {
	return true;
 }	
else
   {
 
   return false;
}
}

$(document).ready(function(){
 $('#designation_edit').submit(function() {
	 document.getElementById('department_submit').innerHTML = 'Updateing----';
	 document.getElementById('department_submit').disabled = 'disabled';
		$.post(
            "index.php/employee_submit/employee_designation_catg_edit",
            $("#designation_edit").serialize(),
            function(data){
              if(data==1)
			  {
				 $('#confirmation').fadeIn('slow').delay(2000).fadeOut('slow');
					setTimeout(function(){					
					window.location="index.php/employee_section/setting";
					},2000)
			  }	
			  else {
				alert(data);
				document.getElementById('department_submit').disabled = false;
			  }
			  document.getElementById('department_submit').innerHTML = 'Update';
		});
 return false;
 });
});

</script>

				<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Employee Designation Edit
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Employee Leave Type Form</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
<?php 
extract($_GET);
$data=$this->db->select("*")->from("employee_catg")->where("ecatgid",$id)->get()->row();
?>				

<div class="container-fluid">
			<!---confirmation msg start-->	
			<div id="confirmation" class="alert alert-success alert-dismissable" style="display:none;">
				<i class="fa fa-check"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<b>Data Save Successfully
			</div>
			<!---confirmation msg End-->
			<div class="row">
				<div class="col-md-12">
					
				   <form  class="form-horizontal" role="form" action="employee_submit/employee_designation_catg" method="post" enctype="multipart/form-data" id="designation_edit">

						
						  <div class="form-group">
							<div class="col-md-4">
							   <label>Designation</label>	
							   <input type="text" class="form-control" id="desig" name="desig" required placeholder="Enter Designation Name" style="text-transform:uppercase;" value="<?php echo $data->emp_type; ?>" required>
							</div>
							<div class="col-md-2">
							   <label>Need Employee</label>	
							   <input type="number" class="form-control" id="need" name="need" required placeholder="maximum leave number" value="<?php echo $data->need_emp; ?>" required>
							</div>
							<div class="col-md-3">
							   <label>Qualification</label>	
							<textarea class="form-control" name="quali" required><?php echo $data->qualification; ?>
							   </textarea>
							</div>
							<div class="col-md-3">
								  <Input type="hidden" name="ecatgid" value="<?php echo $id; ?>"/>	
								  <button type="submit" class="btn btn-primary" name="submit_edit" id="department_submit" style="margin-top:24px;">Update</button> &nbsp;&nbsp;&nbsp;
							<a href="employee_section/setting"> 
							  <button type="button" class="btn btn-success" style="margin-top:24px;"><span class="glyphicon glyphicon-arrow-left"></span> Back</button></a>
							</div>
						  </div>

						
				 </form>
				
				</div>
			</div>			  
</div>

				


                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
			
