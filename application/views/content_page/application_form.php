 <!-- Content Header (Page header) -->
<link href="all/assets/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
<script src="all/assets/js/bootstrap-datepicker.min.js"></script>
<script>
function imge_upload(img_val,img_id) {
	if(img_val==''){
		document.getElementById("img_div").style.display = "none";
		document.getElementById("pic_error").style.display = "none";
	}
	else{
		var image_size= parseInt((event.target.files[0].size)/1000);
		if(image_size>150) {
					document.getElementById(img_id).value = "";
					alert("imge size large maximum size 150 kb");
					 

		}
		else{
			document.getElementById("img_div").style.display = "block";
			$("#img_id").attr('src',URL.createObjectURL(event.target.files[0]));
	}
	}
}
					
$("document").ready(function(){
$("#dob").datepicker({format: 'yyyy-mm-dd'});
	
	$("#application_form").submit(function(e) {
	e.preventDefault();
	var formData = new FormData(this);

	$.ajax({  
		 type: "POST",  
		 url: "index.php/home/applicationAction",  
		 data: formData,
		 async: false,
		 cache: false,
		 contentType: false,
		 processData: false,
		 beforeSend:function(){
			 document.getElementById('submit').disabled = "disabled";	
			 document.getElementById('submit').innerHTML = 'Processing---';
		 },
		 success: function(data) {
			 if(isNaN(data)==false)
			 {	
				alert('Application Complete Successfully Your ID is '+data+' It is Important Your Next Identification');
				window.location="home/application_details?d="+data;
			 }
			 else { 
			 alert(data);
			 document.getElementById('submit').innerHTML = 'Send';
             document.getElementById('submit').disabled = false;
			 }
		 }
	}); 
	//return false;
	});
		
		
});
</script>
<div class="main_con"><!--Content Start-->
	<div class="row">
		<div class="col-md-9 left_con"><!-- left Content Start-->
			<div class="row">
				<div class="col-md-12"><!-- Welcome Massage Start-->
					<div class="panel panel-primary">
						<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;"> Application Form </div>
							<div class="panel-body" style="min-height:770px;">
							
								<div class="row">
                      <div class="col-md-12">
							
						<form  class="form-horizontal" role="form" action="index.php/home/applicationAction" method="post" enctype="multipart/form-data" id="application_form">
                         
							
						  <div class="form-group">
							<label class="control-label col-sm-2" for="email">Applicant's Name <span style="color:red;">*</span></label>
							<div class="col-sm-4">
							  <input type="text" class="form-control" required name="sname" id="sname" placeholder="Enter Applicant's Name" value="" >
							</div>
							<label class="control-label col-sm-2" for="email">Father's Name <span style="color:red;">*</span></label>
							<div class="col-sm-4">
							  <input type="text" name="fname" class="form-control" id="fname" placeholder="Enter Father's Name" value="<?php if(isset($_GET['d'])){echo $fname;} ?>" required>
							</div>
						  </div>
						  
							<div class="form-group">
								<label class="control-label col-sm-2" for="email">Mother 's Name <span style="color:red;">*</span></label>
								<div class="col-sm-4">
								  <input type="text" name="mname" class="form-control" id="mname" placeholder="Enter Mother's Name" value="<?php if(isset($_GET['d'])){echo $mname;} ?>" required>
								</div>
								
								
								<label class="control-label col-sm-2" for="pwd">Class <span style="color:red;">*</span></label>
								<div class="col-sm-4"> 
								    <select class="form-control" name="class_name" id="class_name" required>
									<option value="">--Select Class--</option>
									<?php 
									$class=$this->db->select("*")->from("class_catg")->get()->result();
									foreach($class as $catagory)
									{
									?>
									<option value="<?php echo $catagory->classid; ?>"><?php echo $catagory->class_name;?></option>
									<?php } ?>
									</select>
								</div>
								
							</div>
							
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="email">Email</label>
								<div class="col-sm-4">
								  <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="<?php if(isset($_GET['d'])){echo $email;} ?>">
								</div>
								<label class="control-label col-sm-2" for="email">Gender <span style="color:red;">*</span></label>
								<div class="col-sm-4">
								  <select class="form-control" name="gender" id="gender" required>
									<option value="">--Select Gender--</option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
									<option value="Comon">Common</option>
								  </select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="religion">Religion <span style="color:red;">*</span></label>
								<div class="col-sm-4">
								  <select class="form-control" name ="religion" id="religion" required>
									<option value="">--Select Religion--</option>
									<option value="Muslim">Muslim</option>
									<option value="Hindu">Hindu</option>
									<option value"Khristan">Khristan</option>
								  </select>
								</div>
								
								<label class="control-label col-sm-2" for="email">Blood Group</label>
								<div class="col-sm-4">
								  <select class="form-control" name="blood_grou" id="blood_grou" required>
									<option value="">--Select Group--</option>
									<option value="A+">A+</option>
									<option value="A-">A-</option>
									<option value="AB+">AB+</option>
									<option value="AB-">AB-</option>
									<option value="B+">B+</option>
									<option value="B-">B-</option>
									<option value="O+">O+</option>
									<option value="O-">O-</option>
								  </select>
								</div>
							</div>
							
							<div class="form-group">
							
								<label class="control-label col-sm-2" for="email" >Birth Date <span style="color:red;">*</span></label>
								<div class="col-sm-4">
								 <input type="text" name="dob" id="dob" required class="form-control"/>	
								</div>
								
								<label class="control-label col-sm-2" for="pob">Place Of Birth <span style="color:red;">*</span></label>
								<div class="col-sm-4">
								  <input type="text" name="pob" required class="form-control"/>	
								</div>
								
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-2">School Name</label>
								<div class="col-sm-4">
								  <input type="text" class="form-control" name="schoName"/>
								</div>
								
								<label class="control-label col-sm-2">GPA</label>
								<div class="col-sm-4">
								  <input type="text" class="form-control" name="gpaC" value=""/>
								</div>
							</div>
							
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="email">Present address <span style="color:red;">*</span></label>
								<div class="col-sm-4">
								 <textarea class="form-control" name="pre_address" id="pre_address" rows="5" style="resize:none;" required></textarea>
								</div>
								<label class="control-label col-sm-2" for="email">Permanent address <span style="color:red;">*</span></label>
								<div class="col-sm-4">
								   <textarea class="form-control" name="par_address" id="par_address" rows="5" style="resize:none;" required></textarea>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="email">City <span style="color:red;">*</span></label>
								<div class="col-sm-4">
								  <select type="text" class="form-control" name="city" id="city" placeholder="Enter city" required>
								  <?php if(isset($_GET['d'])){ ?>
									<option><?php echo $city; ?></option>
								  <?php  } ?>
								  <?php $this->load->view('content_page/city'); ?>
								  </select>
								</div>
								
								<label class="control-label col-sm-2" for="phone">Phone</label>
								<div class="col-sm-4">
								  <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone Number" onkeypress="return checkaccnumber(event);" value="<?php if(isset($_GET['d'])){echo $phone;} ?>" maxlength="11" required>
								</div>
							</div>
							 <div class="form-group" id="img_div" style="display:none;">
								<div class="col-sm-2">
								 
									
								</div>
								<div class="col-sm-4">
								 <img src="" class="img-responsive" style="height:160px;width:160px;"   id="img_id"/>
								</div>
								<div class="col-sm-2">
								
								</div>
								<div class="col-sm-2">
								 
								</div>
								<div class="col-sm-2">
								 
								</div>
							
							</div>
							
							<div class="form-group">
							
								<label class="control-label col-sm-2" for="email" >Picture</label>
								<div class="col-sm-4">
								  <input type="file" name="picture" id="picture" class="form-control" accept="image/jpeg, image/jpg, image/png"  onchange="imge_upload(this.value , this.id);" required/>
								</div>
								
								<label class="control-label col-sm-2" for="pob" style="opacity:0;">Place Of Birth <span style="color:red;">*</span></label>
								<div class="col-sm-4">
								  
								</div>
								
							</div>
							

						  <div class="form-group"> 
							<div class="col-sm-offset-2 col-sm-10">
							  <button type="submit" class="btn btn-primary" name="submit" id="submit">Send</button> &nbsp;&nbsp;&nbsp;
							  <button type="reset" onclick="return confirm_reset();" class="btn btn-warning">Reset</button>
							</div>
						  </div>
						</form>

							
						
					  </div>
					  <div class="col-md-2">
					  
					  </div>
                    </div>
							</div>
					</div>
				</div>
			</div>
		</div>