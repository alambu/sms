
 <style type="text/css">
	input{
		text-transform:;
	}
	#myTab{
		margin-bottom:15px;
		font-size:18px;
	}
	.error{
		border:1px solid red;
	}
	.badge.badge-success {
		background-color: #00a651;
		color: #ffffff;
	}
	
	.badge.badge-info {
		background-color: #31B0D5;
		color: #ffffff;
	}
	
	.badge.badge-danger {
		background-color: #800000;
		color: #ffffff;
	}
	
 </style>
<script>
$("document").ready(function(){
		$("#sdate,#edate").datepicker({format: 'dd-mm-yyyy'
	});
	});
	
	

function ajax_request_clsid_report_card(cls_id) {
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
			document.getElementById("section_report").innerHTML='';
			document.getElementById("section_report").innerHTML="<option value=''>"+sec+"</option>";
			
			for(var i=0;i<d.length;i++){
				
				document.getElementById("section_report").innerHTML+="<option value='"+d1[i]+"'>"+d[i]+"</option>";
			}
			}
			else {
				document.getElementById("section_report").innerHTML='';
				document.getElementById("section_report").innerHTML="<option value=''>Section Select</option>";
			}
		}
		
		});
}


function selected_class_report_card(sftid) {
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
		document.getElementById("class_name").innerHTML='';
		document.getElementById("class_name").innerHTML="<option value=''>"+sec+"</option>";
		
		for(var i=0;i<d.length;i++){
			
			document.getElementById("class_name").innerHTML+="<option value='"+d1[i]+"'>"+d[i]+"</option>";
		}
		
		}
		
		else {
			document.getElementById("class_name").innerHTML='';
			document.getElementById("class_name").innerHTML="<option value=''>Select Class</option>";
		}
	
	}
	
	});
}	

var newwindow;
function details(url)
{
newwindow=window.open(url,'name','height=600,width=800,left=300,scrollbars=yes,top=20');
if (window.focus) {newwindow.focus()}
}

function student_log(url)
{
newwindow=window.open(url,'name','height=600,width=800,left=300,scrollbars=yes,top=20');
if (window.focus) {newwindow.focus()}	
}

function admission_cancel(sid)
{
	var con=confirm('Are You Sure Cancel?');
	if(con==true) {
		$.ajax({
		url: "index.php/student_submit/admission_cancel",
		type: 'POST',	
		data:{sid:sid},	
		success: function(data)
		{	
			if(data==1)
			{
				alert('Cancel Successfully');
				location.reload();
			}
			else 
			{
				alert(data);
			}
		}
		
		});
	}
	else {
		return false;
	}
}
</script>

						<!----form start------->
					<?php
					extract($_POST);
					$selected_class=$this->bsetting->class_info($asft_re);
					$selected_section=$this->bsetting->section_info($acls_re);
					//print_r($selected_class);
					?>
					<div class="row">
						<div class="col-md-12">
							 <form class="form-horizontal" role="form" action="student_section/certificate" method="post">

								<table class="table table-hover">
									
										<tr>
											<td>
											<div class="form-group">
												<div class="col-md-3">
												<label  for="pwd">Year</label>
												<?php 
												$y=date("Y");
												$yc=2010;
												?>
												<select name="year" id="year" class="form-control">
												<?php 
												for($y;$y>=$yc;$y--){
												?>
												<option <?php if(isset($_POST['monthly_report'])){ if($year==$y){ echo "selected"; } } ?> value="<?php echo $y; ?>"><?php echo $y; ?></option>
												<?php 
												}
												?>
												</select>
												</div>
											
											  <div class="col-md-3">
												<label  for="pwd">Shift </label>
												<select name="asft_re" id="shift" class="form-control" onchange="selected_class_report_card(this.value);" required >
													<option value="">Select</option>
													<?php 
													foreach($all_shift as $value){
													?>
													<option value="<?php echo $value->shiftid; ?>" <?php if($asft_re==$value->shiftid){ echo "selected"; }  ?>><?php echo $value->shift_N; ?></option>
													<?php } ?>
												</select>
												
												</div>
												
												<div class="col-md-2">
													<label  for="pwd">Class</label>
													<select name="acls_re" id="class_name" class="form-control" onchange="ajax_request_clsid_report_card(this.value);" required >
														<option value="">Select</option>
														<?php foreach($selected_class as $value) { ?>
														<option <?php if($acls_re==$value->classid) { echo "selected"; } ?> value="<?php echo $value->classid; ?>"><?php echo $value->class_name; ?></option>
														<?php } ?>
													</select>
												</div>
											 
												<div class="col-md-2">
												<label  for="pwd">Section</label>
												<select name="asec_re" id="section_report" class="form-control" required >
													<option value="">Select</option>
													<?php foreach($selected_section as $value){ ?>
													<option <?php if($asec_re==$value->sectionid) { echo "selected"; } ?> value="<?php echo $value->sectionid; ?>"><?php echo $value->section_name; ?></option>
													<?php } ?>
												</select>
												</div>
											  
											  
											  <div class="col-md-2">
												<label></label>
												<button style="margin-top:25px;" name="card" class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span> Search</button>
											  </div>
											  
											</div>	
										
											</td>
										</tr>	
									</table>
								</form>
							</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
						<center>
							<table width="100%">
								<?php 
								$sprofile=$this->db->query("select * from sprofile")->row();
								$ts=count($sinfo)-1;
								$i=0;
								for($j=0;$j<count($sinfo);$j++) {
								$details=$this->student->get_student_details($sinfo[$i]->stu_id);
								?>
								<tr>
									
									<td>
										<center>
										<table border="1" cellpadding="5" nowrap="0" style="margin-bottom:15px;">
											<tr>
												<td><center><img class="img-rounded" src="img/document/school_logo/<?php echo $sprofile->logo; ?>" style="height:50px;width:50px;"/></center></td>
												<td style="padding-top:-5px;text-align:left;">
												<p style="font-size:20px;line-height:20px;"><?php echo $sprofile->schoolN; ?></p>
												<p style="line-height:12px;"><?php echo $sprofile->address; ?></p>
												</td>
											</tr>
											<tr>
												<td colspan="2" style="background-color:lightgray;">
													<center style="font-size:13px;font-weight:bold;font-family:tahoma;"><b>Student ID Card</b>
													</center>
												</td></tr>
											<tr>
												<td>
													<img height="60" width="60" class="img-rounded" src="img/student_section/registration_form/<?php echo $details->picture; ?>"/></td>
													
												<td>
													<p style="line-height:8px;"><b>Student ID: </b><?php echo $sinfo[$i]->stu_id; ?></p>
													<p style="line-height:8px;"><b>Name: </b><?php echo $details->name; ?></p>
													<p style="line-height:8px;"><b>Father Name: </b><?php echo $details->fName; ?></p>
													<p style="line-height:8px;"><b>Class: </b><?php echo $this->student->get_class_details($sinfo[$i]->classid)->class_name; ?></p>
													<p style="line-height:8px;"><b>Section: </b><?php echo $this->student->get_section_details($sinfo[$i]->section)->section_name; ?></p>
													<p style="line-height:8px;"><b>Roll No: </b><?php echo $sinfo[$i]->roll_no; ?></p>
												</td>
											</tr>
											<tr>
												<td colspan="2" style="line-height:15px;"> </br> Principal sign </td>
											</tr>
										</table>
										</center>
									</td>
									
								</tr>
								
								<?php  $i++; } ?>
							</table>
							</center>
						</div>
					</div>
					
	
		