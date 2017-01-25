<?php error_reporting(0); ?>
<?php
if(isset($_POST['data_send'])){
	
	
$teacher_name=$_POST['teacher_name'];
$designation=$_POST['designation'];
$father_name=$_POST['father_name'];
$mother_name=$_POST['mother_name'];
$birth_date=$_POST['birth_date'];
$gender=$_POST['gender'];
$religion=$_POST['religion'];
$present_address=$_POST['present_address'];
$permanent_address=$_POST['permanent_address'];
$mobile=$_POST['mobile'];
$joining_date=$_POST['joining_date'];	
$blood_group=$_POST['blood_group'];	
$picture=$_POST['picture'];	

$update=mysql_query("update teachers_info set ( name='$teacher_name', designation='$designation', father_name='$father_name',mother_name='$mother_name', birth_date='$birth_date', gender='$gender', religion='$religion',present_address='$present_address', permanent_address='$permanent_address', mobile='$mobile',joining_date='$joining_date', blood_group='$blood_group',picture='$picture')");

if($update){
	echo "<script>alert('data update successfully');</script>";
}

else{
	echo "<script>alert('data not update ');</script>";
}
}



?>

<?php

if(isset($_GET['id'])){

echo 	$id=$_GET['id'];
	
	$edit=$this->db->select("*")
					->from("teachers_info")
					->where("teacher_id",$id)
					->get()
					->row();
					}
?>  



 <aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
				<script>
					function imge_upload(img_val){
						if(img_val==''){
							document.getElementById("img_div").style.display = "none";
						}
						else{
							document.getElementById("img_div").style.display = "block";
						$("#img_id").attr('src',URL.createObjectURL(event.target.files[0]));
						}
					}

				</script>
                <section class="content-header">
                    <h1>
                        Update Teacher
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="row">
                      <div class="col-md-10">
							
						<form  class="form-horizontal" role="form" action="index.php/admin/edit_teachers" method="post" enctype="multipart/form-data">

						<div class="form-group" id="img_div" style="display:none;">
							<div class="col-sm-8">
							 
							</div>
							<div class="col-sm-4">
							 
								<img src="" class="img-thumbnail" height="150" width="150"   id="img_id"/>
							</div>
							</div>
						
						
						  <div class="form-group">
							<label class="control-label col-sm-2" for="email">Teacher's Name</label>
							<div class="col-sm-4">
							  <input type="name" class="form-control" id="name" placeholder="Enter Student's Name">
							</div>
							<label class="control-label col-sm-2" for="email">Father's Name</label>
							<div class="col-sm-4">
							  <input type="text" name="fName" class="form-control" id="fName" placeholder="Enter Father's Name">
							</div>
						  </div>
						  
							<div class="form-group">
								<label class="control-label col-sm-2" for="email">Mother 's Name</label>
								<div class="col-sm-4">
								  <input type="text" name="mName" class="form-control" id="mName" placeholder="Enter Mother's Name">
								</div>
								
								
								<label class="control-label col-sm-2" for="pwd">Designation</label>
								<div class="col-sm-4"> 
								  <select class="form-control" name="appctgid" id="appctgid">
									<option>Designation</option>
									<option>One</option>
									<option>Two</option>
									<option>Three</option>
									<option>Four</option>
									<option>Five</option>
									<option>Six</option>
									<option>Seven</option>
									<option>Eight</option>
									<option>Nine</option>
									<option>Ten</option>
								  </select>
								</div>
								
							</div>
							
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="email">Birth Day</label>
								<div class="col-sm-4">
								  <input type="email" name="email" class="form-control" id="email" placeholder="Birth Day">
								</div>
								<label class="control-label col-sm-2" for="email">Gender</label>
								<div class="col-sm-4">
								  <select class="form-control" name="gender" id="gender">
									<option>Enter Gender</option>
									<option>Male</option>
									<option>Female</option>
								  </select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="religion">Relagion</label>
								<div class="col-sm-4">
								  <select class="form-control" name ="religion" id="religion">
									<option>Enter Relagion</option>
									<option>Muslim</option>
									<option>Hindu</option>
									<option>Kristan</option>
								  </select>
								</div>
								<label class="control-label col-sm-2" for="email">Blood Group</label>
								<div class="col-sm-4">
								  <select class="form-control" name="blood_grou" id="blood_grou" placeholder="Enter email">
									<option>Group</option>
									<option>O+</option>
									<option>O-</option>
									<option>A+</option>
									<option>A-</option>
								  </select>
								</div>
							</div>
							
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="email">Present address</label>
								<div class="col-sm-4">
								 <textarea class="form-control" name="pre_address" id="pre_address" rows="5" style="resize:none;"></textarea>
								</div>
								<label class="control-label col-sm-2" for="email">Parmanent address</label>
								<div class="col-sm-4">
								  
								  
								   <textarea class="form-control" name="par_address" id="par_address" rows="5" style="resize:none;"></textarea>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="email">Email</label>
								<div class="col-sm-4">
								  <input type="text" class="form-control" name="city" id="city" placeholder="Enter Email">
								</div>
								
								<label class="control-label col-sm-2" for="email">Phone</label>
								<div class="col-sm-4">
								  <input type="text" name="Phone_n" class="form-control" id="Phone_n" placeholder="Enter Phone Number" onkeypress="return isNumber(event);">
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="email">Joning Date</label>
								<div class="col-sm-4">
								  <input type="text" class="form-control" name="trans_id" id="trans_id" placeholder="Enter Date" onkeypress="return isNumber(event);">
								</div>
								
								<label class="control-label col-sm-2" for="email">Picture</label>
								<div class="col-sm-4">
								  <input type="file" class="form-control" name="trans_id" onchange="imge_upload(this.value);" id="trans_id">
								</div>
							
							</div>
							

						  <div class="form-group"> 
							<div class="col-sm-offset-2 col-sm-10">
							  <button type="submit" class="btn btn-primary" name="submit" id="submit"><span class="glyphicon glyphicon-send"></span> Submit</button> &nbsp;&nbsp;&nbsp;
							  <button type="reset" class="btn btn-warning"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
							</div>
						  </div>
						</form>

							
						
					  </div>
					  <div class="col-md-2">
					  
					  </div>
                    </div>


                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->