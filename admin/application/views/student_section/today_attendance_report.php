<style>
.panel-heading a:after {
    font-family:'Glyphicons Halflings';
    content:"\e114";
    float: right;
    color: black;
}
.panel-heading a.collapsed:after {
    content:"\e080";
}
table tr:hover{
	background:lightblue;
}
table tr:hover {
	background:lightblue !important;
}
</style>
<center style="font-size:16px;"><b>Today :- </b> <?php echo date("d M , Y"); ?></center>
</br>
<div class="panel-group" id="accordion">
	<?php
		extract($_GET);
		foreach($class as $val) {
	?>
	<div class="panel panel-info">
	  <div class="panel-heading">
		<h4 class="panel-title">
		  <a data-toggle="collapse" style="display:block;" data-parent="#accordion" href="#collapse<?php echo $val->classid; ?>">  <span class="glyphicon glyphicon-hand-right"></span>  Class <?php echo $val->class_name; ?></a>
		</h4>
	  </div>
	  <div id="collapse<?php echo $val->classid; ?>" class="panel-collapse collapse">
		<div class="panel-body">
			<table class="table table-condensed table-hover">
					<tr class="active">
						<th>SL.NO</th>
						<th>Section</th>
						<th>Total Student</th>
						<th>Present</th>
						<th>Absent</th>
						<th>Parsentis</th>
						<th>Details</th>
					</tr>
				<?php 
					$ex=$this->bsetting->section_info($val->classid);
					$i=1;$d=date("Y-m-d");
					foreach($ex as $sec){
						$where=array('syear'=>date("Y"),'shiftid'=>$sid,'classid'=>$val->classid,'section'=>$sec->sectionid,'status'=>1);
						$total_student=$this->student->get_total_student($where);
						
						$atten=$this->student->daily_attendance_edit_sheet($sid,$val->classid,$sec->sectionid,$d);
						
						$row=count($atten);
						$pre_stu=$atten->stu_id;
						
						$ex_1=explode(",",$pre_stu);
						if($pre_stu!=''){
						$present=count($ex_1);
						} else {
						$present=0;	
						}
					// echo $total_student;
					
				?>
					<tr>
						<?php if($row>0){ ?>
						<td><?php echo $i++; ?></td>
						<td><span class='badge badge-success'><?php echo $this->bsetting->ge_section($sec->sectionid)->section_name; ?></span></td>
						<td><?php echo $total_student; ?></td>
						<td><?php echo $present; ?></td>
						<td><?php echo $absent=$total_student-$present; ?></td>
						<td>
						<?php 
						$per=round(($present/$total_student)*100); 
						if($per>=80){
							$c="success";
						}
						elseif(($per>50) && ($per<80)){
							$c="info";
						}
						elseif(($per>40) && ($per<50)){
							$c="warning";
						}
						else {
							$c="danger";
						}
						?>
						<div class="progress">
							<div class="progress-bar progress-bar-<?php echo $c; ?> progress-bar-striped" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $per; ?>%">
							  <?php echo $per; ?>% Complete
							</div>
						</div>
						<?php $today='today'; ?>
						</td>
						<td>
						<button class="btn btn-info btn-sm"onclick="details('student_section/attendance_details?sft=<?php echo  $sid; ?>&cls=<?php echo $val->classid; ?>&sec=<?php echo $sec->sectionid; ?>&d=<?php echo date("Y-m-d"); ?>&typ=<?php echo $today; ?>');"><span class="glyphicon glyphicon-list-alt"></span>  Details</button>
						</td>
						<?php } else { ?>
						<td><?php echo $i++; ?></td>
						<td><span class='badge badge-success'><?php echo $sec ?></span></td>
						<td colspan="5" style="font-size:15px;font-weight:bold;color:red;">Attendance Not Found</td>
						<?php } ?>
					</tr>
					
				
			<?php } ?>
			</table>
		</div>
	  </div>
	</div>
	<?php } ?>
</div>