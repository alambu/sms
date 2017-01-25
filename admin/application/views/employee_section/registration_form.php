<script>
function readURL(input) {
 if (input.files && input.files[0]) {//Check if input has files.
 var reader = new FileReader(); //Initialize FileReader.
 reader.onload = function (e) {
document.getElementById("img_div").style.display = "block";
 $('#img_id').attr('src', e.target.result);
 $("#img_id").resizable({ aspectRatio: true, maxHeight: 300 });
 };
 reader.readAsDataURL(input.files[0]);
 } 
 else {
 $('#img_id').attr('src', "#");
 }
}
</script>

<script>
$('#hidemessage').fadeIn('slow').delay(2000).fadeOut('slow');
</script>
<style>
#hidemessage {
    position: relative;
    display: none;
}
</style>

<script type="text/javascript">


$(document).ready(function () {                
$('#b_date').datepicker({format: "yyyy-mm-dd"});
$('#join_date').datepicker({format: "yyyy-mm-dd"});

 $("#registration_form").submit(function(e) {
	e.preventDefault();
	
	var formData = new FormData(this);

	$.ajax({  
		 type: "POST",  
		 url: "index.php/employee_submit/registration",  
		 data: formData,
		 async: false,
		 cache: false,
		 contentType: false,
		 processData: false,
		 beforeSend:function(){
			 document.getElementById('registration_submit').disabled = "disabled";	
			 document.getElementById('registration_submit').innerHTML = 'Saveing---';
           
		 },
		 success: function(data) {
			 if(data==1)
			 {
				 
				 alert('Data Save Successfully');
				 location.reload();
			 }
			 else { 
			 alert(data);
			 document.getElementById('registration_submit').innerHTML = 'Save';
             document.getElementById('registration_submit').disabled = false;
			 
			 }
		 }
	}); 
	//return false;
	});

});

function emptype_test(tid)
{
	if(tid==1)
	{
		document.getElementById("sub_id").style.display="block";
	}
	else 
	{
		document.getElementById("sub_id").style.display="none";
	}
}
</script>



<style>
@-moz-document url-prefix() {
    .input-file-sm {
        height: auto;
        padding-top: 2px;
        padding-bottom: 1px;
    }
}


error{
	
	border-color: red;
}
</style>
								<?php 
								//empid create start
									$r=rand(1000,9000);
									$sr=substr($r,0,4);
									$yemp=date("Y");
									$r_emp_id=$yemp.$sr;
								//empid create end	
								?>
								<div class="row" style="margin-top:40px;">
									<div class="col-md-12">
										
										<form action="employee_submit/registration" role="form" class="form-horizontal" enctype="multipart/form-data" id="registration_form">
										
												<div class="form-group" id="img_div" style="display:none;">
												
													<div class="col-sm-2">
													</div>
													
													<div class="col-sm-4">
													 <img src="" class="img-thumbnail" height="150" width="150"   id="img_id"/>
													</div>
													
													<div class="col-sm-2">
													</div>
													
													<div class="col-sm-4">
													</div>
													
												</div>
												<div class="form-group">
													<label class="control-label col-sm-2" for="id">Picture</label>
													<div class="col-sm-4">
													  <input type="file" class="form-control input-sm input-file-sm" id="pic" name="image" required onchange="readURL(this);">
													  
													</div>
													<label class="control-label col-sm-2" for="empid">Employee ID</label>
													<div class="col-sm-4">
														<input type="text" class="form-control" name="emp_id" readonly value="<?php echo trim($r_emp_id); ?>"/>
													</div>
												  </div>
												  <div class="form-group">
													<label class="control-label col-sm-2" for="">Full Name</label>
													<div class="col-sm-4">
													  <input type="text" class="form-control" id="emp_name"  name="emp_name" required value="" placeholder="Enter Employee Name">
													</div>
													
													<label class="control-label col-sm-2" for="">Nick Name</label>
														<div class="col-sm-4">   
														  <input type="text" class="form-control" id="nick_name" name="nick_name"  required value="" placeholder="Enter Your Nick Name" onchange="nick_name_chk(this.value,this.id);">
														</div>
												  </div>
												  
													<div class="form-group">
													
													<label class="control-label col-sm-2" for="">Father Name</label>
														<div class="col-sm-4">   
														  <input type="text" class="form-control" id="father_name"  name="father_name"  required value="" placeholder="Enter Father Name"> 
														  
														</div>
														
													<label class="control-label col-sm-2" for="pwd">Mother Name</label>
														<div class="col-sm-4"> 
														 <input type="text" class="form-control" id="mother_name"  name="mother_name" required value="" placeholder="Enter Mother Name"> 
														 
														</div>	
													</div>
													
													<div class="form-group">
														<label class="control-label col-sm-2" for="email">Department</label>
														<div class="col-sm-4">
														  <select  class="form-control" id="department"  name="department" required>
																 <option value="">Select Department</option>
																<?php 
																foreach($all_department as $value){
																	?>
																	<option <?php echo set_select('department',$value->edepid); ?> value="<?php echo $value->edepid; ?>"><?php echo $value->manage_type; ?></option>
																<?php	
																}
																?>  
																
														  </select>
														  
														</div>
														
														<label class="control-label col-sm-2" for="email">Designation</label>
														<div class="col-sm-4">
														 <select name="designation" class="form-control" required  id="designation" onchange="designation_limit_chk(this.value,this.id);">
															<option value="">Select Designation</option>
																<?php 
																foreach($all_designation as $value){
																	?>
																	<option value="<?php echo $value->ecatgid;?>"><?php echo $value->emp_type; ?></option>
																<?php	
																}
																?>  
														  </select>
														  
														</div>
														
													</div>
													
													<div class="form-group">
														<label class="control-label col-sm-2" for="picture">Employee Type</label>
														<div class="col-sm-4">
														<select  class="form-control"  id="emp_type" onchange="emptype_test(this.value);" required name="emp_types">
															<option value="">Select Type</option>
															<option value="1">Teacher</option>
															<option value="2">Stuff</option>
														</select>
														
														</div>
														<label class="control-label col-sm-2" for="email">Account No:</label>
														<div class="col-sm-4">
														<input type="text" name="acc_no" placeholder="account Number" required class="form-control"/>
														</div>
														
													</div>
													
													<div class="form-group" style="display:none;" id="sub_id">
														
														<label class="control-label col-sm-2" for="email">Subject</label>
														<div class="col-sm-10">
														 <select  class="form-control" id="subject"  name="subject">
																 <option  value="">Select Subject</option>
																 <?php 
																foreach($subject as $value){
																	?>
																	<option value="<?php echo $value->subsetid;?>"><?php echo $value->sub_name; ?></option>
																<?php	
																}
																?> 
														  </select>
														  
														</div>
														
													</div>
												  
													<div class="form-group">
														<label class="control-label col-sm-2" for="pwd">Date of Birth</label>
														<div class='col-sm-4'>
														<input type="text" name="birth_date" class="form-control" readonly required  id='b_date' value="" placeholder="Enter Birth Date">
													   </div>
													   
														<label class="control-label col-sm-2" for="email">Join Date</label>
														<div class="col-sm-4">
														  <input type="text" name="join_date" class="form-control" readonly required id="join_date" value=""  placeholder="Enter Join Date">
														  
														</div>
													</div>
													
													
													<div class="form-group">
														
														<label class="control-label col-sm-2" for="email">National Id</label>
														<div class="col-sm-4">
														   <input type="number" min="0" class="form-control" maxlength="17" required id="nid" name="nid" value="" placeholder="Enter National Id" onchange="national_id_chk(this.value,this.id);">
														</div>
														
														<label class="control-label col-sm-2" for="email">Religion</label>
														<div class="col-sm-4">
															<select  class="form-control" required name="religion" id="religion">
																<option value="">Please Select</option>
																<option value="Islam">Islam</option>
																<option value="Hindus">Hindus</option>
																<option value="Buddha">Buddha</option>
																<option value="Christian">Christian</option>
																
															</select>
														</div>
														
													</div>
													
													<div class="form-group">
														
														<label class="control-label col-sm-2" for="email">Blood Group</label>
														<div class="col-sm-4">
														  <select class="form-control" required name="blood_group" id="blood_group">
																<option value="">Please Select</option>
																<option value="A+">A+</option>
																<option value="A-">A-</option>
																<option value="O+">O+</option>
																<option value="O-">O-</option>
																<option value="AB+">AB+</option>
																<option value="AB-">AB-</option>
														  </select>
														  
														</div>
														
														<label class="control-label col-sm-2" for="email">Mobile Number</label>
														<div class="col-sm-4">
														 <input type="number" min="0" name="phone" class="form-control" maxlength="14" required value=""   placeholder="Mobile number" onkeypress="return isNumber(event);"/>
														</div>
														
													</div>
													
													
													<div class="form-group">
														<label class="control-label col-sm-2" for="email">Alternate Number</label>
														<div class="col-sm-4">
														 <input type="text" name="alt_phone" required  class="form-control" maxlength="14" placeholder="alternate Mobile number" value="" onkeypress="return isNumber(event);"/>
														</div>
														<label class="control-label col-sm-2" for="email">Gender</label>
														<div class="col-sm-4">
															<select  class="form-control"  name="gender" required>
																<option value="">Please Select</option>
																<option value="Male">Male</option>
																<option value="Female">Female</option>
																<option value="Common">Common</option>
																
															</select>
														</div>
														 
													</div>
													

													<div class="form-group">
														<label class="control-label col-sm-2" for="email">Educational Qualification</label>
														<div class="col-sm-4">
														  <textarea rows="4"  style="resize:none;" class="form-control" required id="edu_qualify"  name="edu_qualify" placeholder="Enter Qualification"></textarea>
														</div>
														
														<label class="control-label col-sm-2" for="email">Present Address</label>
														<div class="col-sm-4">
														  <textarea rows="4"  style="resize:none;" class="form-control" required id="present_address"  name="present_address" placeholder="Enter Present Address"></textarea>
														</div>
													</div>
													
													<div class="form-group">
													
														<label class="control-label col-sm-2" for="email">Permanent Address</label>
														
														<div class="col-sm-4">
														   <textarea rows="4"  style="resize:none;" class="form-control" required id="permanent_address" name="permanent_address" placeholder="Enter Permanent Address"></textarea>
														</div>
														
														<label class="control-label col-sm-2" for="email"></label>
														<div class="col-sm-4">
														 
														</div>
													</div>
													
													
													  <div class="form-group"> 
														<div class="col-sm-offset-2 col-sm-10">
														  <button type="submit" class="btn btn-primary" name="submit" id="registration_submit" >Save</button> &nbsp;&nbsp;&nbsp;
														  <button type="reset" name="reset" class="btn btn-warning">Reset</button>
														</div>
													  </div>
												  
												  
										</form> 	
												
									</div>
								 
								</div>	