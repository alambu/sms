<script>
function class_teacher_setup(did)
{
	    document.getElementById('teacher_setup_submit'+did).innerHTML = 'Saveing----';
		document.getElementById('teacher_setup_submit'+did).disabled = 'disabled';
	  	$.post(
            "index.php/routine_submit/class_teacher_setup",
            $("#teachertt_setup_form_"+did).serialize(),
            function(data){
              if(data==1)
			  {   alert('Save Successfully');
				  document.getElementById('teacher_setup_submit'+did).disabled = false;
			  }	
			  else {
				alert(data);
				document.getElementById('teacher_setup_submit'+did).disabled = false;
			  }
			  document.getElementById('teacher_setup_submit'+did).innerHTML = 'Save';
		});
		return false; 
}
</script>	
	
			<div class="panel-group" id="accordion4">
			<?php $teacher=$this->employee->all_teacher(); ?>
			<?php $y=date("Y"); foreach($all_shift as $value) { ?>
				<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
					  <a data-toggle="collapse" data-parent="#accordion4" href="#collapse_<?php echo $value->shiftid; ?>"><span class="glyphicon glyphicon-hand-right"></span> Shift:-<?php echo $value->shift_N; ?></a>
					</h4>
				</div>
				<div id="collapse_<?php echo $value->shiftid; ?>" class="panel-collapse collapse">
				<div class="panel-body">
				<table class="table table-hover table-condensed">	
					<?php $y=date("Y");$maxy=date("Y")+1; for($y;$y<=$maxy;$y++) { ?>
					<tr>
						<td colspan="3">
							<center><h4><span class="label label-success">Session:- <?php echo $y; ?></span></h4></center>
						</td>
					</tr>
					
					<?php
						$cls_info=$this->bsetting->class_info($value->shiftid);
						foreach($cls_info as $cls_value){
						$sec_info=$this->bsetting->section_info($cls_value->classid);
					?>
					<tr class="success">
						<th colspan="3">
							<center>Class :- <span class="label label-primary"><?php echo $cls_value->class_name; ?></span></center>
						</th>
					</tr>
					
					<tr>
						<th>
							Section
						</th>
						<th>
							Teacher
						</td>
						<th>
							Action
					</tr>
					<?php $k=1; foreach($sec_info as $sec_value) { ?>
					<form class="form-horizontal" role="form" action="routine_submit/class_teacher_setup" method="post" id="teachertt_setup_form_<?php echo $cls_value->classid.$value->shiftid.$y.$k; ?>" onsubmit="return class_teacher_setup(<?php echo $cls_value->classid.$value->shiftid.$y.$k; ?>);">
							<?php
							$where2=array('years'=>$y,'shiftid'=>$value->shiftid,'classid'=>$cls_value->classid,'section'=>$sec_value->sectionid); 
							$tinfo=$this->routine->class_teacher($where2);
							?>
							<tr>
								<td style="width:20%;">
									<input type="hidden" name="shift" value="<?php echo $value->shiftid; ?>"/>
									<input type="hidden" name="year" value="<?php echo $y; ?>"/>
									<input type="hidden" name="cls" value="<?php echo $cls_value->classid; ?>"/>
									<select name="section" class="form-control" required>
										<option value="<?php echo $sec_value->sectionid; ?>"><?php echo $sec_value->section_name; ?></option>
									</select>
								</td>
								<td style="width:60%;">
									<select name="teacher" class="form-control">
										<option value="">Select Teacher</option>
										<?php foreach($teacher as $tech_value) { ?>
										<option <?php if($tinfo->empid==$tech_value->empid) { echo "selected"; } ?> value="<?php echo $tech_value->empid; ?>"><?php echo $tech_value->name; ?></option>
										<?php } ?>
									</select> 
								</td>
								
								<td>
									<button type="submit" name="submit" id="teacher_setup_submit<?php echo $cls_value->classid.$value->shiftid.$y.$k; ?>" class="btn btn-primary">Save</button>
								</td>
							</tr>
						</form>		
					<?php $k++; } } } ?>
					</table>
					</div>
					</div>
					</div>
			<?php  } ?>		
					
		</div>
	