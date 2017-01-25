<script>
function class_period_setup(did)
  {
	  document.getElementById('class_period_submit'+did).innerHTML = 'Saveing----';
		 document.getElementById('class_period_submit'+did).disabled = 'disabled';
	  	$.post(
            "index.php/routine_submit/class_period_setup",
            $("#class_period_form_"+did).serialize(),
            function(data){
              if(data==1)
			  {   alert('Save Successfully');
				  document.getElementById('class_period_submit'+did).disabled = false;
			  }	
			  else {
				alert(data);
				document.getElementById('class_period_submit'+did).disabled = false;
			  }
			  document.getElementById('class_period_submit'+did).innerHTML = 'Save';
		});
		return false; 
  }
</script>	
	
			<div class="panel-group" id="accordion3">
			<?php $y=date("Y"); foreach($all_shift as $value) { ?>
				<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
					  <a data-toggle="collapse" data-parent="#accordion3" href="#collapse<?php echo $value->shiftid; ?>"><span class="glyphicon glyphicon-hand-right"></span> Shift:-<?php echo $value->shift_N; ?></a>
					</h4>
				</div>
				<div id="collapse<?php echo $value->shiftid; ?>" class="panel-collapse collapse">
				<div class="panel-body">
				<table class="table table-hover table-condensed">	
					<?php $y=date("Y");$maxy=date("Y")+1; for($y;$y<=$maxy;$y++) { ?>
					<tr>
						<td colspan="4">
							<center><h4><span class="label label-success">Session:- <?php echo $y; ?></h4></span></center>
						</td>
					</tr>
					
					<tr class="success">
						<th>Class</th>
						<th>Total Period</th>
						<th>Class Start Time</th>
						<th>Action</th>
					</tr>
					<?php
						$cls_info=$this->bsetting->class_info($value->shiftid);
						foreach($cls_info as $cls_value){ 
					?>
						<form class="form-horizontal" role="form" action="routine_submit/class_period_setup" method="post" id="class_period_form_<?php echo $cls_value->classid.$value->shiftid.$y; ?>" onsubmit="return class_period_setup(<?php echo $cls_value->classid.$value->shiftid.$y; ?>);">
								<?php 
								$where1=array('year'=>$y,'shiftid'=>$value->shiftid,'period_title'=>1);
								$where2=array('year'=>$y,'shiftid'=>$value->shiftid,'classid'=>$cls_value->classid);
								$shidule_info=$this->routine->shift_shidule($where1); 
								$period_info=$this->routine->class_period($where2);
								//print_r($period_info); 
								?>
								<tr>
									<td width="25%">
										<input type="hidden" name="shift" value="<?php echo $value->shiftid; ?>"/>
										<input type="hidden" name="year" value="<?php echo $y; ?>"/>
										<select name="cls" class="form-control" required>
											<option value="<?php echo $cls_value->classid; ?>"><?php echo $cls_value->class_name; ?></option>
										</select>
									</td>
									<td width="25%">
										<input type="number" name="total_period" value="<?php echo $period_info->maxclass; ?>" required class="form-control" min="0"/> 
									</td>
									
									<td width="25%">
										<select name="stime" class="form-control" required>
											<option value="">Select Time</option>
											<?php foreach($shidule_info as $sinfo){ ?>
											<option <?php if($period_info->shidule_id==$sinfo->shidule_id) { echo "selected"; } ?> value="<?php echo $sinfo->shidule_id; ?>"><?php echo date("h:i:a",strtotime($sinfo->stime)); ?></option>
											<?php } ?>
										</select>
									</td>
									
									<td width="25%">
										<button type="submit" name="submit" id="class_period_submit<?php echo $cls_value->classid.$value->shiftid.$y; ?>" class="btn btn-primary">Save</button>
									</td>
								</tr>
						</form>		
						<?php } } ?>
					</table>
					</div>
					</div>
					</div>
			<?php  } ?>		
					
		</div>
	