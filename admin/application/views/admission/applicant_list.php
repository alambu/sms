<script type="text/javascript">
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
		document.getElementById("cls_name").innerHTML='';
		document.getElementById("cls_name").innerHTML="<option value=''>"+sec+"</option>";
		
		for(var i=0;i<d.length;i++){
			
			document.getElementById("cls_name").innerHTML+="<option value='"+d1[i]+"'>"+d[i]+"</option>";
		}
		
		}
		
		else {
			document.getElementById("cls_name").innerHTML='';
			document.getElementById("cls_name").innerHTML="<option value=''>Select Class</option>";
		}
	
	}
	
	});
}


$("document").ready(function(){
	$("#sdate").datepicker({format: 'yyyy-mm-dd'
	});
	$("#edate").datepicker({format: 'yyyy-mm-dd'
	});
	
});

var newwindow;
  function details(url)
  {
  newwindow=window.open(url,'name','height=600,width=800,left=300,scrollbars=yes,top=20');
  if (window.focus) {newwindow.focus()}
  }
</script>
										<?php
										extract($_POST);
										$selected_class=$this->admission->class_info($shift);
										?>
											<div class="row">
												<div class="col-md-12">
													 <form class="form-horizontal" role="form" action="admission_section/admission" method="post">
					  
														<table class="table table-hover table-condensed">
															
																<tr>
																	<td>
																	<div class="form-group">
																			<div class="col-md-3">
																				<label>Year</label>
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
																				<select name="shift" id="shift" class="form-control" onchange="selected_class_report(this.value);" required>
																					<option value="">Select</option>
																					<?php 
																					foreach($all_shift as $value){
																					?>
																					<option value="<?php echo $value->shiftid; ?>" <?php if($shift==$value->shiftid){ echo "selected"; }  ?>><?php echo $value->shift_N; ?></option>
																					<?php } ?>
																				</select>
																				
																				</div>
																				
																				<div class="col-md-3">
																					<label  for="pwd">Class</label>
																					<select name="cls" id="cls_name" class="form-control" required >
																						<option value="">Select</option>
																						<?php foreach($selected_class as $value) { ?>
																						<option <?php if($cls==$value->classid) { echo "selected"; } ?> value="<?php echo $value->classid; ?>"><?php echo $value->class_name; ?></option>
																						<?php } ?>
																					</select>
																				</div>
																				
																				<div class="col-md-3">
																					<label  for="pwd"></label>
																					<button style="margin-top:24px;" type="submit" name="by_cls" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
																				 </div>
																	</div>
																	</td>
																</tr>
															</table>
														</form>
														
														
														
														<form class="form-horizontal" role="form" action="admission_section/admission" method="post">
															<table class="table table-hover table-condensed">
																<tr>
																	<td>
																		<tr>
																	<td>
																		<div class="form-group">
																	  <div class="col-md-3">
																		<label>Applicant ID</label>
																		<input type="number" name="appid" min="0" class="form-control" value="<?php echo $appid; ?>"/>
																	  </div>
																		<div class="col-md-3">
																			<label>From</label>
																			<input type="text" name="sdate" class="form-control" id="sdate" placeholder="From Date" value="<?php echo $sdate; ?>">
																	    </div>
																	
																		<div class="col-md-3">
																			<label>To</label>
																			<input type="text" name="edate" class="form-control" id="edate" placeholder="To Date" value="<?php echo $edate; ?>">
																	    </div>
																		 <div class="col-md-3">
																			<label  for="pwd"></label>
																			<button style="margin-top:24px;" type="submit" name="by_date" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
																		 </div>
																	</div>
																	</td>
																</tr>
																	</td>
																</tr>
															</table>
														</form>
														
														
													</div>
												</div>
										
										<!----form End------->
										
										<!------report header start------>
										<div class="row">
											<div class="col-md-12">
												<center>
												<?php
												extract($_POST);
												if(isset($_POST['by_date'])) {
													if(empty($appid) && empty($sdate) && empty($edate))
													{
													}
													elseif(empty($sdate) && empty($edate))
													{
														echo "Applicant ID: "."<span class='label label-primary'>$appid</span>";
													}
													elseif(empty($sdate))
													{
														echo "Date: "."<span class='label label-success'>$edate</span>";
													}
													elseif(empty($edate))
													{
														echo "Date: "."<span class='label label-success'>$sdate</span>";
													}
													else 
													{
														
														echo "Date: "."<span class='label label-success'>$sdate</span>"."  To  "."<span class='label label-success'>$edate</span>";;
													}
													
												}
												else 
												{
													echo "Session: <span class='label label-primary'>".$year."</span></br>";
													echo "Shift: <span class='label label-success'>".$this->admission->get_shift_info($shift)->shift_N."</span></br>";
													echo "Class Name : <span class='label label-info'>".$this->admission->get_class_info($cls)->class_name."</span></br>";
												}
												echo "</br> Total Applicant: ".number_format(count($apinfo));
												?>
												</center>
											</div>
										</div>
										<!------Report Header End-------->
										
										
										
										<?php $status=array("1"=>"<span class='label label-success'>Recived</span>","0"=>"<span class='label label-danger'>Not-Recived</span>"); ?>
										<!------Report Start-------->
											<div class="row">
												<div class="col-md-12">
													<table id="example3" class="table table-condensed table-striped table-bordered">
														<thead>
															<tr>
																<th>SL.No</th>
																<th>Applicant ID</th>
																<th>Name</th>
																<th>Father Name</th>
																<th>Class</th>
																<th>Picture</th>
																<th>Status</th>
																<th>Action</th>
															</tr>
														</thead>
														
														<tbody>
															<?php $i=1; foreach($apinfo as $value) { ?>
															<tr>
																<td><?php echo $i++; ?></td>
																<td><span class='label label-primary'><?php echo $value->appid; ?></span></td>
																<td><?php echo $value->name ?></td>
																<td><?php echo $value->fName ?></td>
																<td><?php echo $this->admission->get_class_info($value->classid)->class_name; ?></td>
																<td><img src="img/student_section/application_form/<?php echo $value->image ?>" class="img-thumbnail"style="height:50px;width:50px;"/></td>
																<td><?php echo $status[0]; ?></td>
																<td>
																<?php 
																if($value->app_status==0){
																?>
																<a href="admission_section/student_registration?appid=<?php echo $value->appid; ?>">
																<button type="button" class="btn btn-primary btn-sm">Admission</button>
																</a>
																<?php } else {  ?>
																<button type="button" class="btn btn-success btn-sm">Complete</button>
																<?php } ?>
																&nbsp;
																<button  onclick="details('admission_section/application_details?d=<?php echo $value->appid; ?>');" type="button" class="btn btn-info btn-sm">Details</button>
																
																
																</td>
															</tr>
															<?php } ?>
														</tbody>
													</table>
												</div>
											</div>
										
										<!------Report End---------->