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
 $('#department_edit').submit(function() {
	 document.getElementById('department_submit').innerHTML = 'Updateing----';
	 document.getElementById('department_submit').disabled = 'disabled';
		$.post(
            "index.php/employee_submit/employee_dep_catg_edit",
            $("#department_edit").serialize(),
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
                        Employee Department Edit
                        
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
$data=$this->db->select("*")->from("emp_depart_catg")->where("edepid",$id)->get()->row();
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
				   <form  class="form-horizontal" role="form" action="employee_submit/employee_dep_catg_edit" method="post" enctype="multipart/form-data" id="department_edit">
						
						
						  <div class="form-group">
							<div class="col-md-6">
							   <label>Department</label>	
							   <input type="text" class="form-control" id="maximum_leave" name="manage_typ" required placeholder="Enter Department Name" value="<?php echo $data->manage_type; ?>" >
							</div>
							<div class="col-md-4">
								  <Input type="hidden" name="edepid" value="<?php echo $id; ?>"/>	
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
			
