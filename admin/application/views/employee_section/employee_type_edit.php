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
 $('#emp_type_edit').submit(function() {
	 document.getElementById('emp_type_submit').innerHTML = 'Updateing----';
	 document.getElementById('emp_type_submit').disabled = 'disabled';
		$.post(
            "index.php/employee_submit/employee_type_catg_edit",
            $("#emp_type_edit").serialize(),
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
				document.getElementById('emp_type_submit').disabled = false;
			  }
			  document.getElementById('emp_type_submit').innerHTML = 'Update';
		});
 return false;
 });
});

</script>


				<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Employee Type Edit
                        
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
$data=$this->db->select("*")->from("emp_type")->where("emptypeid",$id)->get()->row();
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
	
				   <form  class="form-horizontal" role="form" action="employee_submit/employee_type_catg" method="post" enctype="multipart/form-data" id="emp_type_edit">

						
						  <div class="form-group">
						   
							<div class="col-md-6">
							   <label>Employee Type</label>	
							   <input type="text" class="form-control" id="maximum_leave" name="type" required placeholder="Enter Employee Type" value="<?php echo strtoupper($data->type); ?>" required>
							</div>
							<div class="col-md-4">
								  <Input type="hidden" name="emptypeid" value="<?php echo $id; ?>"/>	
								  <button type="submit" class="btn btn-primary" name="submit_edit" id="emp_type_submit" style="margin-top:24px;">Update</button> &nbsp;&nbsp;&nbsp;
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
			
