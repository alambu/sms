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
		 url: "index.php/student_submit/student_edit",  
		 data: formData,
		 async: false,
		 cache: false,
		 contentType: false,
		 processData: false,
		 beforeSend:function(){
			 document.getElementById('registration_submit').disabled = "disabled";	
			 document.getElementById('registration_submit').innerHTML = 'Updateing---';
             document.getElementById('save_img').style.display = "block";
		 },
		 success: function(data) {
			 if(data==1)
			 {
				 document.getElementById('save_img').style.display = "none";
				 alert('Data Update Successfully');
				 var str=document.getElementById("redirect_str").value;
				 var d=str.split("/");
				 var len=d.length;
				 if(len>2) { student_search_section(str); } else { student_search_bysesion(str); }
			 }
			 else { 
			 alert(data);
			 document.getElementById('registration_submit').innerHTML = 'Update';
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
		extract($_GET);
		//print_r($sinfo);exit;
		$selected_class=$this->bsetting->class_info($sinfo->shiftid);
		?>		
	
		<!---confirmation msg start-->	
			<div id="confirmation" class="alert alert-success alert-dismissable" style="display:none;">
				<i class="fa fa-check"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<b>Data Save Successfully
			</div>
		<!---confirmation msg End-->
		<form  class="form-horizontal" action="student_submit/student_edit" method="post" enctype="multipart/form-data" id="registration_form">
			<img id="save_img" src="img/ajax-loader-large1.gif" style="position:absolute;margin-top:30%;margin-left:47%;z-index:99999;display:none;"/>
			<div class="row">
			    <div class="col-md-12">
					<div class="form-group" id="img_div" style="display:block;">
						<div class="col-sm-2">
						 
						</div>
						<div class="col-sm-4">
						 <img src="img/student_section/registration_form/<?php echo $sinfo->picture; ?>" class="img-responsive img-thumbnail" style="height:160px;width:160px;" id="img_id"/>
						</div>
						<div class="col-sm-2">
						 
						</div>
						<div class="col-sm-4">
						</div>
					</div>
					
					<div class="form-group">
					
						<label class="control-label col-sm-2" for="email">Guardian ID</label>
						<div class="col-sm-10">
						
							<input type="text" name="pid" onkeypress="return isNumber(event);" class="form-control" value="<?php echo $sinfo->parentid; ?>" placeholder="Enter Parent ID" onkeyup="chk_parrent_id(this.value);" required/>
							<input type="hidden" name="hid_stu" value="<?php echo $sinfo->stu_id; ?>"/>
							<input type="hidden" name="readid" value="<?php echo $sinfo->readid; ?>"/>
							<input type="hidden" id="redirect_str" name="redirect_str" value="<?php echo $str; ?>"/>
							<input type="hidden" id="hid_pic" name="hid_pic" value="<?php echo $sinfo->picture; ?>"/>
						</div>
						
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-2" for="email">Student's Name</label>
						<div class="col-sm-4">
						  <input type="text" name="sname" class="form-control" id="sname" value="<?php echo $sinfo->name; ?>" placeholder="Enter Student's Name" required >
						</div>
						
						<label class="control-label col-sm-2" for="email">Student's Name(বাংলায়)</label>
						<div class="col-sm-4">
							<input type="text" name="sname_ban" class="form-control" value="<?php echo $sinfo->name_ban; ?>" placeholder="বাংলায় লিখুন" required/>
						</div>
					</div>
				
					<div class="form-group">
					
						<label class="control-label col-sm-2" for="email">Father's Name</label>
						<div class="col-sm-4">
						  <input type="text" name="fname" class="form-control" id="fname" value="<?php echo $sinfo->fName; ?>" placeholder="Enter Father's Name" required />
						</div>
						
						<label class="control-label col-sm-2" for="email">Father's Ocopation</label>
						<div class="col-sm-4">
						  <input type="text" name="f_ocop" class="form-control" id="f_ocop" value="<?php echo $sinfo->foccupation; ?>" placeholder="Enter Father's Ocopation" required>
						</div>
						
					</div>
				  
					<div class="form-group">
					
						<label class="control-label col-sm-2" for="email">Mother 's Name</label>
						
						<div class="col-sm-4">
						  <input type="text" name="mname" class="form-control" id="mname" value="<?php echo $sinfo->mName; ?>" placeholder="Enter Mother's Name" required>
						</div>
						
						<label class="control-label col-sm-2" for="email">Mother 's Ocopation</label>
						<div class="col-sm-4">
						  <input type="text" name="mocop" class="form-control" id="mName" value="<?php echo $sinfo->moccupation; ?>" placeholder="Enter Mother's Ocopation" required>
						</div>
						
						
					</div>
					
					<div class="form-group">
					
						<label class="control-label col-sm-2" for="email">Father's Name(বাংলায়)</label>
						<div class="col-sm-4">
						  <input type="text" name="fname_ban" class="form-control" id="fname_ban" value="<?php echo $sinfo->fName_ban; ?>" placeholder="বাংলায় লিখুন" required />
						</div>
						
						<label class="control-label col-sm-2" for="email">Mother's Name(বাংলায়)</label>
						<div class="col-sm-4">
						  <input type="text" name="mname_ban" class="form-control" id="mname_ban" value="<?php echo $sinfo->mName_ban; ?>" placeholder="বাংলায় লিখুন" required>
						</div>
						
					</div>
					
					<div class="form-group">
					
						<label class="control-label col-sm-2" for="email">Shift</label>
						<div class="col-sm-4">
						<select name="shift" class="form-control" onchange="selected_class(this.value);" id="shift" required >
						    <?php 
								foreach($all_shift as $value){
							?>
							<option <?php if($value->shiftid==$sinfo->shiftid) { echo "selected"; } ?>  value="<?php echo $value->shiftid; ?>"><?php echo $value->shift_N; ?></option>
							<?php } ?>
						</select>	
						</div>
						
						<label class="control-label col-sm-2" for="pwd">Class Name</label>
						<div class="col-sm-4"> 
						  <select class="form-control" name="class_catg" id="class_catg" onchange="ajax_request_clsid(this.value);" required>
							<?php foreach($selected_class as $value) { ?>
							<option <?php if($value->classid==$sinfo->classid) { echo "selected"; } ?> value="<?php echo $value->classid; ?>"><?php echo $value->class_name; ?></option>
							<?php } ?>
						  </select>
						</div>
						
					</div>
					
					
					
					<div class="form-group">
						<?php $section=$this->bsetting->section_info($sinfo->classid); ?>
						<label class="control-label col-sm-2" for="email">Section</label>
						<div class="col-sm-4">
						  <select class="form-control" name="section" id="section" required onchange="group_detact_test(this.value);">
							<?php foreach($section as $value) { ?>
							<option <?php if($value->sectionid==$sinfo->section) { echo "selected"; } ?> value="<?php echo $value->sectionid; ?>"><?php echo $value->section_name; ?></option>
							<?php } ?>
						  </select>
						</div>
						
						<label class="control-label col-sm-2" for="email">Roll No:</label>
							
						<div class="col-sm-4">
							<span id="roll_valid" style="color:red;font-weight:bold;"></span>
							<input type="text" name="roll_no" data-toggle="tooltip" title="Write Unique Roll Number" class="form-control" value="<?php echo $sinfo->roll_no; ?>" id="roll_no" onkeypress="return checkaccnumber(this.value);" placeholder="Enter roll No" required onchange="roll_no_chk(this.value,shift.value,appctgid.value,section.value,ses_year.value,this.id);" />
						</div>
						
					</div>
					
					
					<?php if($sinfo->groupid>0) { $display="block"; } else  { $display="none"; } ?>
					<div class="form-group" id="group_div" style="display:<?php echo $display; ?>;">
					
						<label class="control-label col-sm-2" for="email">Group</label>
						<div class="col-sm-10">
						<select name="group" class="form-control" id="group">
							<option value="">Select Group</option>
						    <?php 
							foreach($all_group as $group) {
							?>
							<option <?php if($group->groupid==$sinfo->groupid) { echo "selected"; } ?> value="<?php echo $group->groupid; ?>"><?php echo $group->group_name; ?></option>
							<?php } ?>
						</select>	
						
						</div>
						
					</div>
					
					
					<div class="form-group">
					
						<label class="control-label col-sm-2" for="email">Gender</label>
						<div class="col-sm-4">
						  <select class="form-control" name="gender" id="gender" required>
							<option value="<?php echo $sinfo->gender; ?>"><?php echo $sinfo->gender; ?></option>
							<option>Male</option>
							<option>Female</option>
							<option>Comon</option>
						  </select>
						</div>
						
						<label class="control-label col-sm-2" for="email">Birth Day ID:</label>
						
						<div class="col-sm-4">
						 <input type="text" name="dob_id" class="form-control" id="dob_id" value="<?php echo $sinfo->dob_id; ?>" maxlength="20" onkeypress="return checkaccnumber(this.value);" placeholder="Enter Birth Day ID" required />
						</div>
						
					</div>
					
					<div class="form-group">
					
						<label class="control-label col-sm-2" for="email">Date Of Birth</label>
						<div class="col-sm-4">
						  <input type="text" class="form-control" name="dob" id="dob" value="<?php echo $sinfo->dob; ?>" placeholder="Date Of Birth" required />
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
						  <input type="text" class="form-control" name="pob" id="pob" value="<?php echo $sinfo->pob; ?>" placeholder="Place Of Birth"/>
						</div>
						
						<label class="control-label col-sm-2" for="email">Pevius School</label>
						<div class="col-sm-4">
						  <input type="text" class="form-control" name="pbs" id="pbs" value="<?php echo $sinfo->pbs; ?>" placeholder="Enter School"/>
						</div>
						
					</div>
					
					<div class="form-group">
					
						<label class="control-label col-sm-2" for="email">Local Guardian</label>
						<div class="col-sm-4">
						  <input type="text" class="form-control" name="loc_grd" id="loc_grd" value="<?php echo $sinfo->local_guardian; ?>" placeholder="Enter Name" required>
						</div>
						
						<label class="control-label col-sm-2" for="email">Mobile No</label>
						<div class="col-sm-4">
						  <input type="text" name="grd_phone" class="form-control" id="grd_phone" value="<?php echo $sinfo->Phone_n; ?>" onkeypress="return checkaccnumber(event);" maxlength="11" placeholder="Enter Phone Number" required>
						</div>
						
					</div>
					
					<div class="form-group">
					 
						<label class="control-label col-sm-2" for="email">Personal Mobile</label>
						<div class="col-sm-4">
						  <input type="text" name="par_phone" class="form-control" maxlength="11" value="<?php echo $sinfo->personal_phone; ?>" id="par_phone" onkeypress="return checkaccnumber(event);" placeholder="Enter Personal Phone Number">
						</div>
						
						<label class="control-label col-sm-2" for="email">Email</label>
						<div class="col-sm-4">
						  <input type="text" name="email" class="form-control" id="email" value="<?php echo $sinfo->email; ?>" placeholder="Enter Father's Name">
						</div>
						
					</div>
					
					<div class="form-group">
					
						<label class="control-label col-sm-2" for="religion">Religion</label>
						<div class="col-sm-4">
						  <select class="form-control" name ="religion" id="religion" required>
							<option value="<?php echo $sinfo->religion; ?>"><?php echo $sinfo->religion; ?></option>
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
							<option value="<?php echo $sinfo->blood_grou;?>"><?php echo $sinfo->blood_grou;?></option>
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
						 <textarea class="form-control" name="pre_address" id="pre_address" rows="5" style="resize:none;" required><?php echo $sinfo->pre_address; ?></textarea>
						</div>
						
						<label class="control-label col-sm-2" for="email">Parmanent address</label>
						<div class="col-sm-4">
						  
						  
						   <textarea class="form-control" name="par_address" id="par_address" rows="5" style="resize:none;" required><?php echo $sinfo->par_address; ?></textarea>
						</div>
						
					</div>
					
					<div class="form-group">
					
						
						<label class="control-label col-sm-2"  for="email">Picture</label>
						<div class="col-sm-4">	
						  <input type="file" name="picture" id="picture" class="form-control" accept="image/jpeg, image/jpg, image/png"  onchange="LoadFile(event);"/>
						</div>
						
						
						<label class="control-label col-sm-2" for="email">City</label>
						<div class="col-sm-4">
						  <select type="text" name="city" class="form-control" id="city" required >
							<option value="<?php echo $sinfo->city;?>"> <?php echo $sinfo->city;?></option>
							<?php $this->load->view('student_section/city'); ?>
						  </select>
						</div>
						
					</div>
					
					<div class="form-group">
					
						<label class="control-label col-sm-2" for="">GPA</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" name="gpa" id="gpa" value="<?php echo $sinfo->gpa; ?>" placeholder="Enter GPA"/>
						</div>
						
					</div>
					
					<div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-10">
						  <center><button type="submit" class="btn btn-primary" name="submit" id="registration_submit" >Update</button> &nbsp;&nbsp;&nbsp;
						  <button type="button" class="btn btn-warning" onclick="">Back</button></center>
						</div>
					</div>
					
				</div>
			</div>
		</form>	

