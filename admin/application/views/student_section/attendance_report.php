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


$("document").ready(function(){
	$("#s_date_r").datepicker({format: 'dd-mm-yyyy'
	});
	$("#e_date_r").datepicker({format: 'dd-mm-yyyy'
	});
	
});
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
													 <form class="form-horizontal" role="form" action="student_section/attendance" method="post">
					  
														<table class="table table-hover">
															
																<tr>
																	<td>
																	<div class="form-group">
																			  <div class="col-md-3">
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
																				
																				<div class="col-md-3">
																					<label  for="pwd">Class</label>
																					<select name="acls_re" id="class_name" class="form-control" onchange="ajax_request_clsid_report(this.value);" required >
																						<option value="">Select</option>
																						<?php foreach($selected_class as $value) { ?>
																						<option <?php if($acls_re==$value->classid) { echo "selected"; } ?> value="<?php echo $value->classid; ?>"><?php echo $value->class_name; ?></option>
																						<?php } ?>
																					</select>
																				</div>
																			 
																			    <div class="col-md-3">
																				<label  for="pwd">Section</label>
																				<select name="asec_re" id="section_report" class="form-control" required >
																					<option value="">Select</option>
																					<?php foreach($selected_section as $value){ ?>
																					<option <?php if($asec_re==$value->sectionid) { echo "selected"; } ?> value="<?php echo $value->sectionid; ?>"><?php echo $value->section_name; ?></option>
																					<?php } ?>
																				</select>
																			    </div>
																			  <div class="col-md-3">
																				<label>Roll No</label>
																				<input type="number" name="rol_r" class="form-control" min="0" value="<?php echo $rol_r; ?>" Placeholder="Enter Roll No"/>
																			  </div>
																	</div>	
																
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
																			<label>From</label>
																			<input type="text" name="sdate" class="form-control" id="sdate" placeholder="From Date" value="<?php echo $sdate; ?>">
																	    </div>
																	
																		<div class="col-md-3">
																			<label>To</label>
																			<input type="text" name="edate" class="form-control" id="edate" placeholder="To Date" value="<?php echo $edate; ?>">
																	    </div>
																		 <div class="col-md-3">
																			<label  for="pwd"></label>
																			<button style="margin-top:24px;" type="submit" name="monthly_report" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
																		
																		 </div>
																	</div>
																	</td>
																</tr>	
															</table>
														</form>
													</div>
												</div>
										
										<!----form End------->
										
										
										<!----Report Start----->

<!------------------monthly report start------------------------->
											<?php 
											if(isset($_POST['monthly_report'])) {
												extract($_POST);
												if(empty($rol_r)) {
												?>
												<!----heading start---->
												<div class="row">
													<div class="col-md-4">
														
													</div>
													<div class="col-md-4">
														<center>
															
															<p><b>Session:</b>
															
															<?php
															if(($sdate!='') || ($edate!='')) {
															   if($sdate==''){	
															   echo date("Y",strtotime($edate));
															   }
															   elseif($edate==''){
																	echo date("Y",strtotime($sdate));
															   }
															   else{
																   $e=date("Y",strtotime($edate));
																   $s=date("Y",strtotime($sdate));
																   if($e!=$s){
																  echo $s." To ".$e; 
																  }
																  else {
																	  echo $s;
																  }
															   }
															}
															else {
																echo $year;
															}
															?>
															
															</p>
															<p><b>SHIFT:</b><?php foreach($shift_select as $sft_show){ if($sft_show->shiftid==$asft_re) { echo $sft_show->shift_N; } }; ?></p>
															<p style="line-height:10px;"><b>Class:&nbsp;</b><?php foreach($select_cls as $cls_show){ if($cls_show->classid==$acls_re) { echo $cls_show->class_name; } }; ?>  /&nbsp;<b>Section:</b> <?php echo $this->bsetting->ge_section($asec_re)->section_name; ?></p>
															
															<?php
															if(($sdate!='') || ($edate!='')) {
																if(($sdate!='') && ($edate!='')){
																echo "<span class='badge badge-success'>".$sdate."</span>"."To"."<span class='badge badge-success'>".$edate."</span>";
																//echo "duitai";
																}
																elseif($sdate=='') {
																echo "<span class='badge badge-success'>".$edate."</span>";	
																//echo "edate";
																}
																else {
																echo "<span class='badge badge-success'>".$sdate."</span>";	
																//echo "sdate";
																}
															} 
															?>
															
														</center>
													</div>
													<div class="col-md-4">
														
													</div>
												</div>
												<!-----heading end------>
										<?php if($sdate=='' && $edate==''){ ?>		
										<table id="example5" class="table table-bordered table-hover table-condensed">
											<thead>
												<tr>
													<th>SL.No</th>
													<th>Month</th>
													<th>Total Student</th>
													<th>Attendance Days</th>
													<th>Attendance Parsentis</th>
													<th>Details</th>
												</tr>
												
											</thead>
											<tbody>
												<?php 
													$month=array('January'=>'01','February'=>'02','March'=>'03','April'=>'04','May'=>'05','June'=>'06','July'=>'07','August'=>'08','September'=>'09','October'=>'10','November'=>'11','December'=>'12');
												//echo $asft_re;
												
													$shiftn=$this->db->query("select shift_N from shift_catg where shiftid='$asft_re'")->row()->shift_N;
												
													$clsn=$this->db->query("select class_name from class_catg where classid='$acls_re'")->row()->class_name;
												
													$total_student=$this->db->query("select count(readid)  as total_student from re_admission where syear='$year' and shiftid='$asft_re' and classid='$acls_re' and section='$asec_re'")->row()->total_student;
												
													$i=1;
													foreach($month as $key=>$m){
													$month_data=$this->db->query("select * from attendance where year(e_date)='$year' && month(e_date)='$m' and shiftid='$asft_re' and classid='$acls_re' and section='$asec_re'")->result();
													  $total_class=$this->db->affected_rows();
													  $p=0;
													foreach($month_data as $value)
													{
													$ex=explode(",",$value->stu_id);
													$p+=count($ex);
													}
													 // echo $p;
													?>
													
													<tr>
														<td><?php echo $i++; ?></td>
														<td><span class='badge badge-success'><?php echo $key; ?></span></td>
														<td><?php echo $total_student; ?></td>
														<td><?php echo $total_class; $a=$total_student*$total_class; ?></td>
														
														<?php 
															$per=round(($p/$a)*100);
															if(($per>=80)){
																$c="success";
															}
															elseif(($per>50) || ($per<80)){
																$c="info";
															}
															elseif(($per>40) || ($per<50)){
																$c="warning";
															}
															else {
																$c="danger";
															}
														?>
														
														<td>
															
															<div class="progress">
																<div class="progress-bar progress-bar-<?php echo $c; ?> progress-bar-striped" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $per; ?>%">
																 <span <?php if($per==0){ ?> style="color:red;font-weight:bold;" <?php } ?>> <?php echo $per; ?>% Complete</span>
																</div>
															</div>
															
														</td>
														<?php $month_sec='month_sec'; ?>
														<td><a href="javascript:void(0);" onclick="details('student_section/attendance_details?sft=<?php echo  $asft_re; ?>&cls=<?php echo $acls_re; ?>&sec=<?php echo $asec_re; ?>&d=<?php echo $year; ?>&typ=<?php echo $month_sec; ?>&m=<?php echo $m; ?>');"><span class='badge badge-info'>Details</span></a></td>
													</tr>
													
													<?php
													}
													?>
											</tbody>
											</table>
												<?php 
												}
												else 
												{
													$sd=date("Y-m-d",strtotime($sdate));
													$ed=date("Y-m-d",strtotime($edate));
													//echo "ekhane date waise search hobe for section waise";
													
													
													if($sdate!='' && $edate!='') {
														$att_info=$this->db->query("select * from attendance where shiftid='$asft_re' and classid='$acls_re' and section='$asec_re' and date between '$sd' and '$ed'")->result();
														//echo "donota";
													}
													elseif($sdate==''){
														$att_info=$this->db->query("select * from attendance where shiftid='$asft_re' and classid='$acls_re' and section='$asec_re' and date='$ed'")->result();
														//echo "sdate";
													}
													elseif($edate==''){
														$att_info=$this->db->query("select * from attendance where shiftid='$asft_re' and classid='$acls_re' and section='$asec_re' and date='$sd'")->result();
														//echo "edate";
													}
													//print_r($att_info);
												?>
												<table id="example1" class="table table-bordered table-condensed">
													<thead>
														<tr>
															<th>SL.NO</th>
															<th>Total Student</th>
															<th>Date</th>
															<th>Day</th>
															<th>Present</th>
															<th>Absent</th>
															<th>Persentis</th>
															<th>Details</th>
														</tr>
													</thead>
													<tbody>
														<?php $i=1; foreach($att_info as $value){
														?>
														<tr>   
														   <td><?php echo $i++; ?></td>
															<td>
															
															<?php 
															$sy=date("Y",strtotime($value->date));
															echo $total_student=$this->db->query("select count(readid) as total from re_admission where syear='$sy' and shiftid='$asft_re' and classid='$acls_re' and section='$asec_re'")->row()->total;
															?>
															</td>
															<td><span class="badge badge-success"><?php echo date("d-m-Y",strtotime($value->date)); ?></span></td>
															<td><?php echo date("D",strtotime($value->date)); ?></td>
															<?php if($value->stu_id==''){ $p=0; } else {  $ex=explode(",",$value->stu_id); $p=count($ex); } ?>
															
															<td><?php echo $p; ?></td>
															<td><?php echo $a=$total_student-$p; ?></td>
															
															<?php
															 $per=round(($p*100)/$total_student); 
															 if(($per>=80)){
																$c="success";
															}
															elseif(($per>50) || ($per<80)){
																$c="info";
															}
															elseif(($per>40) || ($per<50)){
																$c="warning";
															}
															else {
																$c="danger";
															}
															?>
															<td>
															<div class="progress">
																<div class="progress-bar progress-bar-<?php echo $c; ?> progress-bar-striped" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $per; ?>%">
																 <span <?php if($per=="0"){?> style="color:red;font-weight:bold;" <?php } ?>> <?php echo $per; ?>% Complete</span>
																</div>
															</div>
															</td>
															
															<?php $month_stu='today'; ?>
															<td><a href="javascript:void(0);" onclick="details('student_section/attendance_details?sft=<?php echo  $asft_re; ?>&cls=<?php echo $acls_re; ?>&sec=<?php echo $asec_re; ?>&d=<?php echo $value->date; ?>&typ=<?php echo $month_stu; ?>');"><span class='badge badge-info'>Details</span></a></td>
														</tr>	
														<?php 														
														}
														?>
													</tbody>
												</table>
												<?php 
												}
												
												}
												 
												else {
												
												$chk=$this->db->query("select a.name,a.picture,b.shift_N,c.class_name,d.* from regis_tbl a,shift_catg b,class_catg c ,re_admission d where d.syear='$year' and d.shiftid='$asft_re' and d.classid='$acls_re' and d.section='$asec_re' and d.roll_no='$rol_r' and  a.stu_id=d.stu_id and d.shiftid=b.shiftid and c.classid=d.classid");
												 $row=$chk->num_rows();
												 $stu_info=$chk->row();
											     $stu_re=$stu_info->stu_id;
												
												?>
												<!----heading start---->
												<div class="row">
													<div class="col-md-4">	
													</div>
													<div class="col-md-4">
														<center>
															<p><b>Session:</b><?php echo $year; ?></p>
															<p><b>SHIFT:</b><?php foreach($shift_select as $sft_show){ if($sft_show->shiftid==$asft_re) { echo $sft_show->shift_N; } }; ?></p>
															<p><b>Class:&nbsp;</b><?php foreach($select_cls as $cls_show){ if($cls_show->classid==$acls_re) { echo $cls_show->class_name; } }; ?>  /&nbsp;<b>Section:</b> <?php echo $this->bsetting->ge_section($asec_re)->section_name; ?> &nbsp;/  <b>Roll No:</b> <?php echo $rol_r; ?></p>
															<p><b>Name:</b>  &nbsp;<?php echo $stu_info->name; ?></p>
															
															<?php
															
															if(($sdate!='') || ($edate!='')){
																if(($sdate!='') && ($edate!='')){
																echo "<span class='badge badge-success'>".$sdate."</span>"."To"."<span class='badge badge-success'>".$edate."</span>";
																//echo "duitai";
																}
																elseif($sdate==''){
																echo "<span class='badge badge-success'>".$edate."</span>";	
																//echo "edate";
																}
																else {
																echo "<span class='badge badge-success'>".$sdate."</span>";	
																//echo "sdate";
																}
															} 
															
															?>
														</center>
													</div>
													<div class="col-md-4">
														<img class="img-responsive img-thumbnail" src="img/student_section/registration_form/<?php echo $stu_info->picture; ?>" style="height:100px;width:100px;float:left;margin-bottom:5px;"/>
													</div>
												</div>
												<!-----heading end------>
													<?php if($sdate=='' && $edate==''){ ?>			
												<table id="example5" class="table table-bordered table-hover table-condensed">
														<thead>
															<tr>
																<th>SL.NO</th>
																<th>Month</th>
																<th>Total Class</th>
																<th>Present Days</th>
																<th>Absent Days</th>
																<th>Parsentis</th>
																<th>Details</th>
															</tr>
															
														</thead>
														<tbody>
															<?php
															  if($row>0){
															  $month=array('January'=>'01','February'=>'02','March'=>'03','April'=>'04','May'=>'05','June'=>'06','July'=>'07','August'=>'08','September'=>'09','October'=>'10','November'=>'11','December'=>'12');
																}
															  $i=1;
															  foreach($month as $key=>$m){
																  //echo 1;
																  $month_data=$this->db->query("select * from attendance where year(e_date)='$year' && month(e_date)='$m' && shiftid='$asft_re' && classid='$acls_re' && section='$asec_re'")->result();
																  $total_class=$this->db->affected_rows();
																  $p=0;
																  foreach($month_data as $value){
																	  $ex=explode(",",$value->stu_id);
																	  if(in_array($stu_re,$ex)){
																		  $p++;
																	  }
																  }
																?>	
																
														
																	
																<tr>
																	<td><?php echo $i++; ?></td>
																	<td><a href="#"><span class='badge badge-success'><?php echo $key; ?></span></a></td>
																	<td><?php echo $total_class; ?></td>
																	<td><?php echo $p; ?></td>
																	<td><?php echo $a=$total_class-$p; ?></td>
																	<?php 
																		$per=round(($p*100)/$total_class); 
																		if(($per>=80)){
																			$c="success";
																		}
																		elseif(($per>50) || ($per<80)){
																			$c="info";
																		}
																		elseif(($per>40) || ($per<50)){
																			$c="warning";
																		}
																		else {
																			$c="danger";
																		}
																		?>
																		
																	
																	<?php $month_stu='month_stu'; ?>
																	<td>
																		<div class="progress">
																			<div class="progress-bar progress-bar-<?php echo $c; ?> progress-bar-striped" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $per; ?>%">
																			 <span <?php if($per=="0"){?> style="color:red;font-weight:bold;" <?php } ?>> <?php echo $per; ?>% Complete</span>
																			</div>
																		</div>
																	
																	</td>
																	<td><a href="javascript:void(0);" onclick="details('student_section/attendance_details?sft=<?php echo  $asft_re; ?>&cls=<?php echo $acls_re; ?>&sec=<?php echo $asec_re; ?>&d=<?php echo $year; ?>&typ=<?php echo $month_stu; ?>&stu=<?php echo $stu_re; ?>&m=<?php echo $m; ?>');"><span class='badge badge-info'>Details</span></a></td>
																</tr>
																	
																<?php 
																}
																?>
														</tbody>
													</table>
														<?php 
														}
														else {
														$sd=date("Y-m-d",strtotime($sdate));
														$ed=date("Y-m-d",strtotime($edate));
														
														if($sdate!='' && $edate!=''){
														$att_info=$this->db->query("select * from attendance where shiftid='$asft_re' and classid='$acls_re' and section='$asec_re' and date between '$sd' and '$ed'")->result();
														}
														elseif($sdate=='') {
														$att_info=$this->db->query("select * from attendance where shiftid='$asft_re' and classid='$acls_re' and section='$asec_re' and date='$ed'")->result();	
														}
														elseif($edate=='') {
														$att_info=$this->db->query("select * from attendance where shiftid='$asft_re' and classid='$acls_re' and section='$asec_re' and date='$sd'")->result();		
														}
														
														?>	
											
													<table id="example5" class="table table-bordered table-condensed">
														<thead>
															<tr>
																<th>SL.No</th>
																<th>Date</th>
																<th>Day</th>
																<th>Attendance</th>
															</tr>
														</thead>
														<tbody>
															<?php $i=1; foreach($att_info as $value){ ?>
															<tr>
																<td><?php echo $i++; ?></td>
																<td><span class="badge badge-success"><?php echo date("d-m-Y",strtotime($value->date)); ?></span></td>
																<td><?php echo date("D",strtotime($value->date)); ?></td>
																<?php $ex=explode(",",$value->roll_no); ?>
																<td><?php if(in_array($rol_r,$ex)){ echo "<span class='badge badge-success'>Present</span>"; } else { echo "<span class='badge badge-danger'>Absent</span>"; } ?></td>
															</tr>
															<?php } ?>
														</tbody>
													</table>
													<?php 	
													}
													}
													}
													?>
<!------------------monthly report End------------------------->

