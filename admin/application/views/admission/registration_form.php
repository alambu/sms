<style>
	@-moz-document url-prefix() {
		   .input-file-sm {
			height: auto;
			padding-top: 0px;
			padding-bottom: 0px;
		}
	}
	.error{
		border:1px solid red;
	}
</style>
<script>
$("document").ready(function(){
	
	$("#dob").datepicker({format: 'yyyy-mm-dd'
	});
	
	$("#registration_form").submit(function(e) {
	e.preventDefault();
	
	var formData = new FormData(this);

	$.ajax({  
		 type: "POST",  
		 url: "index.php/admission_submit/student_registration",  
		 data: formData,
		 async: false,
		 cache: false,
		 contentType: false,
		 processData: false,
		 beforeSend:function(){
			 document.getElementById('registration_submit').disabled = "disabled";	
			 document.getElementById('registration_submit').innerHTML = 'Saveing---';
             document.getElementById('save_img').style.display = "block";
		 },
		 success: function(data) {
			 if(data==1)
			 {
				 alert('Data Save Successfully');
				 window.location="admission_section/admission";
			 }
			 else { 
			 alert(data);
			 document.getElementById('registration_submit').innerHTML = 'Save';
             document.getElementById('registration_submit').disabled = false;
			 document.getElementById('save_img').style.display = "none";
			 }
		 }
	}); 
	//return false;
	});
		
		
});

// image show function start	

	var LoadFile=function(event){
	var output=document.getElementById("img_id");
	var image_size= parseInt((event.target.files[0].size)/1000);
		if(image_size>150) {
		document.getElementById("picture").value = "";
		document.getElementById("img_div").style.display = "none";
		alert("IMAGE SIZE LARGE MAXIMUM SIZE 150 KB");
		}
		else {
		document.getElementById("img_div").style.display = "block";	
		output.src=URL.createObjectURL(event.target.files[0]);
		}
	}
	
// image show function end	

	
function ajax_request_clsid(cls_id) {
	//alert(cls_id);
	$.ajax({
		url: "index.php/student_submit/ajax_request",
		type: 'POST',	
		data:{cls_id:cls_id},	
		success: function(data)
		{	
			if(data.length!=0){
			var data1=data.split("#");	
			var d=data1[0].split(",");
			var d1=data1[1].split(",");
			var sec="Select Section";
			document.getElementById("section").innerHTML='';
			document.getElementById("section").innerHTML="<option value=''>"+sec+"</option>";
			
			for(var i=0;i<d.length;i++){
				
				document.getElementById("section").innerHTML+="<option value='"+d1[i]+"'>"+d[i]+"</option>";
			}
			}
			else {
				document.getElementById("section").innerHTML='';
				document.getElementById("section").innerHTML="<option value=''>Section Select</option>";
			}
		}
		
		});
}
	
	
function selected_class(sftid) {
	$.ajax({
	url: "index.php/basic_setting/selected_class",
	type: 'POST',	
	data:{sft_id:sftid},	
	success: function(data)
	{
		if(data!='#') {
		var data1=data.split("#");	
		var d=data1[0].split(",");
		var d1=data1[1].split(",");
		var sec="Select Class";
		document.getElementById("class_catg").innerHTML='';
		document.getElementById("class_catg").innerHTML="<option value=''>"+sec+"</option>";
		
		for(var i=0;i<d.length;i++){
			
			document.getElementById("class_catg").innerHTML+="<option value='"+d1[i]+"'>"+d[i]+"</option>";
		}
		
		}
		
		else {
			document.getElementById("class_catg").innerHTML='';
			document.getElementById("class_catg").innerHTML="<option value=''>Select Class</option>";
		}
	
	}
	
	});
}


function group_detact_test(secid)
{	//alert(secid);
	if(secid!='')
	{
	
	$.ajax({  
	 type: "POST",  
	 url: "index.php/student_submit/group_detact",  
	 data:{secid:secid},
	 success: function(data) {
		// alert(data);
		 if(data==0)
		 {
			document.getElementById("group").innerHTML='<option value="">Select Group</option>';  
			document.getElementById("group_div").style.display='none'; 
			 
		 }
		 else 
		 {
			document.getElementById("group_div").style.display='block'; 
			document.getElementById("group").innerHTML=data; 
			
		 }
	 }
	}); 
	
	}
	else 
	{
		document.getElementById("group").innerHTML='<option value="">Select Group</option>';
		document.getElementById("group_div").style.display='none'; 
	}
}
</script>
<?php 
$get_shiftid=$this->admission->get_class_info($appinfo->classid)->shiftid;
$get_selectd_class=$this->admission->class_info($get_shiftid);
$get_selectd_section=$this->bsetting->section_info($appinfo->classid);
?>



				
	
		<!---confirmation msg start-->	
			<div id="confirmation" class="alert alert-success alert-dismissable" style="display:none;">
				<i class="fa fa-check"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<b>Data Save Successfully
			</div>
		<!---confirmation msg End-->
		<form  class="form-horizontal" action="student_submit/student_registration" method="post" enctype="multipart/form-data" id="registration_form">
			<img id="save_img" src="img/ajax-loader-large1.gif" style="position:absolute;margin-top:30%;margin-left:47%;z-index:99999;display:none;"/>
			<div class="row">
			    <div class="col-md-12">
				
					<div class="form-group" id="img_div">
					
						<div class="col-sm-2">
						 
						</div>
						<div class="col-sm-4">
							<img src="img/student_section/application_form/<?php echo $appinfo->image; ?>" class="img-responsive" style="height:160px;width:160px;"   id="img_id"/>
						</div>
						<div class="col-sm-2">
						 
						</div>
						
						<div class="col-sm-4">
						</div>
						
					</div>
					
					<div class="form-group">
					
						<label class="control-label col-sm-2" for="email">Guardian ID</label>
						<div class="col-sm-10">
						
							<input type="text" name="pid" onkeypress="return isNumber(event);" class="form-control" value="" placeholder="Enter Parent ID" onkeyup="chk_parrent_id(this.value);" required/>
						
						  <input type="hidden" value="<?php if($l<11){ echo $genarate_id; }?>" class="form-control" name="stu_id" id="stu_id" placeholder="Enter Student's ID" onkeypress="return checkaccnumber(event);" readonly >
						</div>
					</div>
					
					<div class="form-group">
						
						<label class="control-label col-sm-2" for="email">Student's Name</label>
						<div class="col-sm-4">
						  <input type="text" name="sname" class="form-control" id="sname" value="<?php echo $appinfo->name; ?>" placeholder="Enter Student's Name" required >
						</div>
						
						<label class="control-label col-sm-2" for="email">Student's Name(বাংলায়)</label>
						<div class="col-sm-4">
						
							<input type="text" name="sname_ban" class="form-control" value="" placeholder="বাংলায় লিখুন" required/>
						
						  <input type="hidden" value="<?php if($l<11){ echo $genarate_id; }?>" class="form-control" name="stu_id" id="stu_id" placeholder="Enter Student's ID" onkeypress="return checkaccnumber(event);" readonly >
						</div>
						
					</div>
				
					<div class="form-group">
					
						<label class="control-label col-sm-2" for="email">Father's Name</label>
						<div class="col-sm-4">
						  <input type="text" name="fname" class="form-control" id="fname" value="<?php echo $appinfo->fName; ?>" placeholder="Enter Father's Name" required />
						</div>
						
						<label class="control-label col-sm-2" for="email">Father's Ocopation</label>
						<div class="col-sm-4">
						  <input type="text" name="f_ocop" class="form-control" id="f_ocop" value="<?php echo set_value('f_ocop'); ?>" placeholder="Enter Father's Ocopation" required>
						</div>
						
					</div>
				  
					<div class="form-group">
					
						<label class="control-label col-sm-2" for="email">Mother 's Name</label>
						
						<div class="col-sm-4">
						  <input type="text" name="mname" class="form-control" id="mname" value="<?php echo $appinfo->mName; ?>" placeholder="Enter Mother's Name" required>
						  <input type="hidden" name="appid" value="<?php echo $appinfo->appid; ?>"/>
						</div>
						
						<label class="control-label col-sm-2" for="email">Mother 's Ocopation</label>
						<div class="col-sm-4">
						  <input type="text" name="mocop" class="form-control" id="mName" value="<?php echo set_value('mocop'); ?>" placeholder="Enter Mother's Ocopation" required>
						</div>
						
						
					</div>
					
					
					<div class="form-group">
					
						<label class="control-label col-sm-2" for="email">Father's Name(বাংলায়)</label>
						<div class="col-sm-4">
						  <input type="text" name="fname_ban" class="form-control" id="fname_ban" value="" placeholder="বাংলায় লিখুন" required />
						</div>
						
						<label class="control-label col-sm-2" for="email">Mother's Name(বাংলায়)</label>
						<div class="col-sm-4">
						  <input type="text" name="mname_ban" class="form-control" id="mname_ban" value="" placeholder="বাংলায় লিখুন" required>
						</div>
						
					</div>
					
					
					<div class="form-group">
					
						<label class="control-label col-sm-2" for="email">Shift</label>
						<div class="col-sm-4">
						<select name="shift" class="form-control" onchange="selected_class(this.value);" id="shift" required >
							<option value="">Select Shift</option>
						  <?php 
								foreach($shift_list as $catagory){
							?>
							
							<option <?php if($get_shiftid==$catagory->shiftid) { echo "selected"; } ?>  value="<?php echo $catagory->shiftid; ?>"><?php echo $catagory->shift_N; ?></option>
							<?php } ?>
						</select>	
						</div>
						
						<label class="control-label col-sm-2" for="pwd">Class Name</label>
						<div class="col-sm-4"> 
						  <select class="form-control" name="class_catg" id="class_catg" onchange="ajax_request_clsid(this.value);" required>
							<?php foreach($get_selectd_class as $value) { ?>
							<option <?php if($appinfo->classid==$value->classid) { echo "selected"; } ?> value="<?php echo $value->classid; ?>"><?php echo $value->class_name; ?></option>
							<?php } ?>
						  </select>
						</div>
						
					</div>
					
					
					<div class="form-group">
		
						<label class="control-label col-sm-2" for="email">Section</label>
						<div class="col-sm-4">
						  <select class="form-control" name="section" id="section" onchange="group_detact_test(this.value);" required>
							<option value="">Select Section</option>
							<?php foreach($get_selectd_section as $value) { ?>
							<option value="<?php echo $value->sectionid; ?>"><?php echo $value->section_name; ?></option>
							<?php } ?>
						  </select>
						</div>
						
						<label class="control-label col-sm-2" for="email">Roll No:</label>
							
						<div class="col-sm-4">
							<span id="roll_valid" style="color:red;font-weight:bold;"></span>
							<input type="text" name="roll_no" data-toggle="tooltip" title="Write Unique Roll Number" class="form-control" value="" id="roll_no" onkeypress="return checkaccnumber(this.value);" placeholder="Enter roll No" required onchange="roll_no_chk(this.value,shift.value,appctgid.value,section.value,ses_year.value,this.id);" />
						</div>
						
					</div>
					
					
					<div class="form-group" id="group_div" style="display:none;">
					
						<label class="control-label col-sm-2" for="email">Group</label>
						<div class="col-sm-10">
						<select name="group" class="form-control" id="group">
							<option value="">Select Group</option>
						    <?php 
							foreach($all_group as $group) {
							?>
							<option value="<?php echo $group->groupid; ?>"><?php echo $group->group_name; ?></option>
							<?php } ?>
						</select>	
						
						</div>
						
					</div>
					
					
					<div class="form-group">
					
						<label class="control-label col-sm-2" for="email">Gender</label>
						<div class="col-sm-4">
						  <select class="form-control" name="gender" id="gender" required>
							<option value="">Select Gender</option>
							<option <?php if($appinfo->gender=='Male') { echo "selected"; } ?>>Male</option>
							<option <?php if($appinfo->gender=='Female') { echo "selected"; } ?>>Female</option>
							<option <?php if($appinfo->gender=='Comon') { echo "selected"; } ?>>Comon</option>
						  </select>
						</div>
						
						<label class="control-label col-sm-2" for="email">Birth Day ID:</label>
						
						<div class="col-sm-4">
						 <input type="text" name="dob_id" class="form-control" id="dob_id" value="<?php echo set_value('dob_id'); ?>" maxlength="20" onkeypress="return checkaccnumber(this.value);" placeholder="Enter Birth Day ID" required />
						</div>
						
					</div>
					
					<div class="form-group">
					
						<label class="control-label col-sm-2" for="email">Date Of Birth</label>
						<div class="col-sm-4">
						  <input type="text" class="form-control" name="dob" id="dob" value="<?php echo $appinfo->dob; ?>" placeholder="Date Of Birth" required />
						</div>
						
						<label class="control-label col-sm-2" for="email">Session</label>
						<div class="col-sm-4">
						 <select name="ses_year" id="ses_year" class="form-control" required>
							<option value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
							<option value="<?php echo date("Y")+1; ?>"><?php echo date("Y")+1; ?></option>
						 </select>
						</div>
						
					</div>
					
					<div class="form-group">
					
						<label class="control-label col-sm-2" for="">Place Of Birth</label>
						<div class="col-sm-4">
						  <input type="text" class="form-control" name="pob" id="pob" value="<?php echo $appinfo->pob; ?>" placeholder="Place Of Birth"/>
						</div>
						
						<label class="control-label col-sm-2" for="">Previus School</label>
						<div class="col-sm-4">
						 <input type="text" class="form-control" name="pbs" id="pbi" value="<?php echo $appinfo->inst_name; ?>" placeholder="Previus School"/>
						</div>
						
					</div>
					
					<div class="form-group">
					
						<label class="control-label col-sm-2" for="email">Local Guardian</label>
						<div class="col-sm-4">
						  <input type="text" class="form-control" name="loc_grd" id="loc_grd" value="<?php echo set_value('loc_grd'); ?>" placeholder="Enter Name" required>
						</div>
						
						<label class="control-label col-sm-2" for="email">Mobile No</label>
						<div class="col-sm-4">
						  <input type="text" name="grd_phone" class="form-control" id="grd_phone" value="<?php echo set_value('phone_n'); ?>" onkeypress="return checkaccnumber(event);" maxlength="11" placeholder="Enter Phone Number" required>
						</div>
						
					</div>
					
					<div class="form-group">
					 
						<label class="control-label col-sm-2" for="email">Personal Mobile</label>
						<div class="col-sm-4">
						  <input type="text" name="par_phone" class="form-control" maxlength="11" value="<?php echo $appinfo->Phone_n; ?>" id="par_phone" onkeypress="return checkaccnumber(event);" placeholder="Enter Personal Phone Number">
						</div>
						
						<label class="control-label col-sm-2" for="email">Email</label>
						<div class="col-sm-4">
						  <input type="text" name="email" class="form-control" id="email" value="<?php echo $appinfo->email; ?>" placeholder="Enter Father's Name">
						</div>
						
					</div>
					
					<div class="form-group">
					
						<label class="control-label col-sm-2" for="religion">Religion</label>
						<div class="col-sm-4">
						  <select class="form-control" name ="religion" id="religion" required>
							<option><?php echo $appinfo->religion; ?></option>
							<option>BUDDHISM</option>
							<option>CHRISTIANITY</option>
							<option>HINDUISM</option>
							<option>ISLAM</option>
							<option>JAINISM</option>
							<option>OTHERS</option>
							<option>SIKHISM</option>
						  </select>
						</div>
						
						<label class="control-label col-sm-2" for="email">Blood Group</label>
						<div class="col-sm-4">
						  <select class="form-control" name="blood_grou" id="blood_grou" placeholder="Enter email">
							<option><?php echo $appinfo->blood_grou; ?></option>
							<option>A+</option>
							<option>A-</option>
							<option>B+</option>
							<option>B-</option>
							<option>AB+</option>
							<option>AB-</option>
							<option>O+</option>
							<option>O-</option>
						  </select>
						</div>
						
					</div>
					
					
					
					
					<div class="form-group">
					
						<label class="control-label col-sm-2" for="email">Present address</label>
						<div class="col-sm-4">
						 <textarea class="form-control" name="pre_address" id="pre_address" rows="5" style="resize:none;" required><?php echo $appinfo->pre_address; ?></textarea>
						</div>
						
						<label class="control-label col-sm-2" for="email">Parmanent address</label>
						<div class="col-sm-4">
						  
						  
						   <textarea class="form-control" name="par_address" id="par_address" rows="5" style="resize:none;" required><?php echo $appinfo->par_address; ?></textarea>
						</div>
						
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-2"  for="email">Picture</label>
						<div class="col-sm-4">
						  <input type="hidden" name="picture" id="hid_pic" value=""/>	
						  <input type="file" name="picture" id="picture" class="form-control" accept="image/jpeg, image/jpg, image/png"  onchange="LoadFile(event);"/>
						</div>
						
						
						<label class="control-label col-sm-2" for="email">City</label>
						<div class="col-sm-4">
						  <select type="text" name="city" class="form-control" id="city" required >
							<option value="<?php echo $appinfo->city; ?>"><?php echo $appinfo->city; ?></option>
							<?php $this->load->view('student_section/city'); ?>
						  </select>
						</div>
						
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-2" for="">GPA</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="gpa" id="gpa" value="<?php echo $appinfo->gpa; ?>" placeholder="GPA"/>
						</div>
					</div>
					
					<div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-10">
						  <center><button type="submit" class="btn btn-primary" name="submit" id="registration_submit" >Save</button> &nbsp;&nbsp;&nbsp;
						  <button type="button" onclick="window.history.back();" class="btn btn-warning">Back</button></center>
						</div>
					</div>
					
				</div>
			</div>
		</form>	

