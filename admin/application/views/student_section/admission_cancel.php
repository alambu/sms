<aside class="right-side">
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
	
	

function ajax_request_clsid_report(cls_id) {
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


function selected_class_report(sftid) {
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
	<section class="content-header">
		<h1>
			Admission Cancel
			<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="box">
				<div class="box-body">
					<div class="table-responsive">
					
						<!----form start------->
					<?php
					extract($_POST);
					$selected_class=$this->bsetting->class_info($asft_re);
					$selected_section=$this->bsetting->section_info($acls_re);
					//print_r($selected_class);
					?>
					<div class="row">
						<div class="col-md-12">
							 <form class="form-horizontal" role="form" action="student_section/admission_cancel" method="post">

								<table class="table table-hover">
									
										<tr>
											<td>
											<div class="form-group">
												<div class="col-md-2">
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
											
											  <div class="col-md-2">
												<label  for="pwd">Shift </label>
												<select name="asft_re" id="shift" class="form-control" onchange="selected_class_report(this.value);" required >
													<option value="">Select</option>
													<?php 
													foreach($shift_select as $value){
													?>
													<option value="<?php echo $value->shiftid; ?>" <?php if($asft_re==$value->shiftid){ echo "selected"; }  ?>><?php echo $value->shift_N; ?></option>
													<?php } ?>
												</select>
												
												</div>
												
												<div class="col-md-2">
													<label  for="pwd">Class</label>
													<select name="acls_re" id="class_name" class="form-control" onchange="ajax_request_clsid_report(this.value);" required >
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
												<label>Roll No</label>
												<input type="number" name="rol_r" class="form-control" min="0" value="<?php echo $rol_r; ?>" Placeholder="Enter Roll No" required/>
											  </div>
											  
											  <div class="col-md-2">
												<label></label>
												<button style="margin-top:25px;" name="by_roll" class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span> Search</button>
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
							<table id="example5" class="table table-bordered table-hover table-condensed">
								<thead>
									<tr>
										<th>SL.No</th>
										<th>Student ID</th>
										<th>Admission Date</th>
										<th>Student Name</th>
										<th>Account Status</th>
										<th>Library Status</th>
										<th>Picture</th>
										<th>Action</th>
									</tr>
									
								</thead>
								<tbody>
									<?php $i=1; foreach($sinfo as $value) { 
									$details=$this->student->get_student_details($value->stu_id);
									
									?>
									<tr>
										<td><?php echo $i++; ?></td>
										<td><?php echo $value->stu_id; ?></td>
										<td><?php echo date("Y-m-d",strtotime($value->e_date)); ?></td>
										<td><?php echo $details->name; ?></td>
										<td><?php echo $this->student->student_account_status($value->stu_id)->balance; ?> Tk</td>
										<td>Distributed:<?php echo count($this->student->student_book_status($value->stu_id)); ?> </td>
										<td><img height="50" width="50" class="img-thumbnail" src="img/student_section/registration_form/<?php echo $details->picture; ?>"/></td>
										<td>
										<button type="button" onclick="details('student_section/registration_details?id=<?php echo $value->stu_id; ?>&class_name=<?php echo $acls_re; ?>&roll_no=<?php echo $rol_r; ?>&section=<?php echo $asec_re; ?>&session=<?php echo $year; ?>');" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-list-alt"></span></button> &nbsp;
										<button type="button" onclick="student_log('student_section/student_log_popup?id=<?php echo $value->stu_id;?>');" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-repeat"></span></button>
										
										<button type="button" onclick="return admission_cancel(<?php echo $value->stu_id; ?>);" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span></button>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>	
						</div>
					</div>
					
					</div>	
				</div>	
			</div>
		</div>	
	</section><!-- /.content -->
</aside><!-- /.right-side -->     <!---rightbar close here ---->
		