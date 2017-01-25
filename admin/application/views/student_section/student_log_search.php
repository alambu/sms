    <link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
	<!---student_report/registration_details?id=486774448&class_name=15&roll_no=1&section=A&session=2016--->
	<script>
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
	</script>
	<?php
	extract($_GET);
	//print_r($_GET);
	$month=array('01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');
	//foreach($month as $value){ echo $value; }
	if($typ=='f')
	{
	
	}
	elseif($typ=='a')
	{
		$ex=explode("/",$str);
		$stu=$ex[4];
		$sft=$ex[0];
		$cls=$ex[1];
		$sec=$ex[2];
		$rol_no=$ex[3];
		$ses=$ex[5];

		if(!empty($stu))
		{
			$stype="student";
		}
		else 
		{
			if((!empty($sft)) && (!empty($cls)) && (!empty($sec)) && (!empty($rol_no)))
			{
				$stype="rol_no";
			}
			elseif((!empty($sft)) && (!empty($cls)) && (!empty($sec)))
			{
				$stype="section";
			}
			
		}
	}
	?>
	
	<div class="row">
		<div class="col-sm-12">
		<?php //echo $stype; ?>
		<?php 
		if($stype=='section') { 
		$where_stu=array('shiftid'=>$sft,'classid'=>$cls,'section'=>$sec,'syear'=>$ses);
		?>
		<center><p><b>Session:<?php echo $ses; ?></b></p>
		<center><p><b>Shift: <?php echo $this->student->shift_info($sft)->shift_N; ?></b> </p>
		<center><p><b>Class:</b><?php echo $this->bsetting->edit_class_info($cls)->class_name; ?>/<b>Section:</b> <?php echo $this->bsetting->ge_section($sec)->section_name; ?></p>
		<center><p><b>Total Student:</b><?php echo $total_student=$this->student->get_total_student($where_stu); ?></p></center>
		
		<table id="example1" class="table table-condensed table-striped">
			<thead>
				<tr>
					<th>Month</th>
					<th>Total Class</th>
					<th>Absent</th>
					<th>Present</th>
					<th>Persentis</th>
					<th>Details</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$i=1;
			foreach($month as $key=>$value) {
			 $where=array('year(e_date)'=>$ses,'month(e_date)'=>$key,'shiftid'=>$sft,'classid'=>$cls,'section'=>$sec);
			 $month_data=$this->student->mounthly_attendance($where);
			 $total_days=count($month_data);
			 $presetn_student=0;$absent=0;
			 foreach($month_data as $mvalue)
			 {
				 if($mvalue->stu_id!='')
				 {
					$presetn_student+=count(explode(",",$mvalue->stu_id));
					$absent+=$total_student-count(explode(",",$mvalue->stu_id));
				 } 
			 }
			 
			?>
			<tr>
				<td><span class="badge badge-success"><?php echo $value; ?></span></td>
				<td><?php echo $total_days; ?></td>
				<td><?php echo $absent; ?></td>
				<td><?php echo $presetn_student; ?></td>
				<?php 
				$per=round(($presetn_student*100)/$total_days);  
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
				<td><?php //echo $per; ?>
					<div class="progress">
						<div class="progress-bar progress-bar-<?php echo $c; ?> progress-bar-striped" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $per; ?>%">
						 <span <?php if($per=="0"){?> style="color:red;font-weight:bold;" <?php } ?>> <?php echo $per; ?>% Completesdfgsdfg</span>
						</div>
					</div>
				</td>
				<td>
					<?php $month_sec='month_sec'; ?>
					<a href="javascript:void(0);" onclick="details('student_section/attendance_details?sft=<?php echo  $sft; ?>&cls=<?php echo $cls; ?>&sec=<?php echo $sec; ?>&d=<?php echo $ses; ?>&typ=<?php echo $month_sec; ?>&m=<?php echo $key; ?>');"><span class='badge badge-info'>Details</span></a>
				</td>
			</tr>
		<?php } ?>
			</tbody>
		</table>
		<?php } 
		elseif($stype=='rol_no') {  
		$stu_id=$this->db->query("select stu_id from re_admission where syear='$ses' and shiftid='$sft' and classid='$cls' and section='$sec' and roll_no='$rol_no'")->row()->stu_id;
		
		$sinfo=$this->student->student_info_by_session($stu_id,$ses);
		?>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<center><p><b>Session:</b><?php echo $ses; ?></p>
				<center><p><b>Shift:</b> <?php echo $this->student->shift_info($sft)->shift_N; ?></p>
				<center><p><b>Class:</b><?php echo $this->bsetting->edit_class_info($cls)->class_name; ?> / <b>Section:</b> <?php echo $this->bsetting->ge_section($sec)->section_name; ?> / <b>Roll No:</b> <?php echo $rol_no; ?></p>
				<p><b>Student Name:</b> <?php echo $sinfo->name; ?></p></center>
			</div>
			<div class="col-md-4">
				<img class="img-responsive img-thumbnail" src="img/student_section/registration_form/<?php echo $sinfo->picture; ?>" style="height:100px;width:100px;float:left;margin-bottom:5px;"/>
			</div>
		</div>
		<table id="example5" class="table table-condensed table-striped">
			<thead>
				<tr>
					<th>Month</th>
					<th>Total Class</th>
					<th>Absent Days</th>
					<th>Present Days</th>
					<th>Persentis</th>
					<th>Details</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			foreach($month as $key=>$value) {
			 $where=array('year(e_date)'=>$ses,'month(e_date)'=>$key,'shiftid'=>$sft,'classid'=>$cls,'section'=>$sec);
			 $month_data=$this->student->mounthly_attendance($where);
			 $total_days=count($month_data);
			 $present=0; $absend=0;
			 foreach($month_data as $mvalue)
			 {
				if($mvalue->stu_id!='')
				{
					$presetn_student=explode(",",$mvalue->stu_id);
					if(in_array($stu_id,$presetn_student)) { $present++; } else { $absend++; }
				} 
			 }
			?>
				<tr>
					<td><span class="badge badge-success"><?php echo $value; ?></span></td>
					<td><?php echo $total_days; ?></td>
					<td><?php echo $absend; ?></td>
					<td><?php echo $present; ?></td>
					<?php 
					$per=round(($present*100)/$total_days);  
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
					<?php $month_stu='month_stu'; ?>
					<td>
						<a href="javascript:void(0);" onclick="details('student_section/attendance_details?sft=<?php echo  $sft; ?>&cls=<?php echo $cls; ?>&sec=<?php echo $sec; ?>&d=<?php echo $ses; ?>&typ=<?php echo $month_stu; ?>&stu=<?php echo $stu_id; ?>&m=<?php echo $key; ?>');"><span class='badge badge-info'>Details</span></a>
					</td>
					
				</tr>
		<?php } ?>
			</tbody>
		</table>
		
		<?php } else { 
		$stu_id=$stu;
		$sinfo=$this->student->student_info_by_session($stu_id,$ses);
		?>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<center><p><b>Session:</b><?php echo $ses; ?></p>
				<center><p><b>Shift:</b> <?php echo $this->student->shift_info($sft)->shift_N; ?></p>
				<center><p><b>Class:</b><?php echo $this->bsetting->edit_class_info($cls)->class_name; ?> / <b>Section:</b> <?php echo $this->bsetting->ge_section($sec)->section_name; ?> / <b>Roll No:</b> <?php echo $rol_no; ?></p>
				<p><b>Student Name:</b> <?php echo $sinfo->name; ?></p></center>
			</div>
			<div class="col-md-4">
				<img class="img-responsive img-thumbnail" src="img/student_section/registration_form/<?php echo $sinfo->picture; ?>" style="height:100px;width:100px;float:left;margin-bottom:5px;"/>
			</div>
		</div>
		<table id="example4" class="table table-condensed table-striped">
			<thead>
				<tr>
					<th>Month</th>
					<th>Total Class</th>
					<th>Absent Days</th>
					<th>Present Days</th>
					<th>Persentis</th>
					<th>Details</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			foreach($month as $key=>$value) {
			 $where=array('year(e_date)'=>$ses,'month(e_date)'=>$key,'shiftid'=>$sft,'classid'=>$cls,'section'=>$sec);
			 $month_data=$this->student->mounthly_attendance($where);
			 $total_days=count($month_data);
			 $present=0; $absend=0;
			 foreach($month_data as $mvalue)
			 {
				 if($mvalue->stu_id!='')
				 {
					$presetn_student=explode(",",$mvalue->stu_id);
					if(in_array($stu_id,$presetn_student)) { $present++; } else { $absend++; }
				 } 
			 }
			?>
				<tr>
					<td><span class="badge badge-success"><?php echo $value; ?></span></td>
					<td><?php echo $total_days; ?></td>
					<td><?php echo $absend; ?></td>
					<td><?php echo $present; ?></td>
					<?php 
					$per=round(($present*100)/$total_days);  
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
					<?php $month_stu='month_stu'; ?>
					<td>
						<a href="javascript:void(0);" onclick="details('student_section/attendance_details?sft=<?php echo  $sft; ?>&cls=<?php echo $cls; ?>&sec=<?php echo $sec; ?>&d=<?php echo $ses; ?>&typ=<?php echo $month_stu; ?>&stu=<?php echo $stu_id; ?>&m=<?php echo $key; ?>');"><span class='badge badge-info'>Details</span></a>
					</td>
					
				</tr>
		<?php } ?>
			</tbody>
		</table>
		<?php } ?>
		</div>
	</div>
	
	<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(function() {
			$("#example1").dataTable();
			$("#example2").dataTable();
			$("#example3").dataTable();
			$("#example4").dataTable();
			$("#example5").dataTable();
		});
    </script>