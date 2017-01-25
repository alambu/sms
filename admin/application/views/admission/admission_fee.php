<script>
function class_period_setup(did)
  {
	  document.getElementById('class_period_submit'+did).innerHTML = 'Saveing----';
		 document.getElementById('class_period_submit'+did).disabled = 'disabled';
	  	$.post(
            "index.php/admission_submit/admission_fee",
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
					
					<tr class="success">
						<th>Class Name</th>
						<th>Admission Fee</th>
						<th>Action</th>
					</tr>
					<?php
						$cls_info=$this->admission->class_info($value->shiftid);
						foreach($cls_info as $cls_value){ 
						$wh=array('shiftid'=>$value->shiftid,'classid'=>$cls_value->classid);
						$finfo=$this->admission->admission_fee_info($wh);
					?>
						<form class="form-horizontal" role="form" action="admission_submit/admission_fee" method="post" id="class_period_form_<?php echo $cls_value->classid.$value->shiftid; ?>" onsubmit="return class_period_setup(<?php echo $cls_value->classid.$value->shiftid; ?>);">
								<?php 
								$period_info=array(); 
								?>
								<tr>
									<td width="40%">
										<input type="hidden" name="shift" value="<?php echo $value->shiftid; ?>"/>
										<select name="cls" class="form-control" required>
											<option value="<?php echo $cls_value->classid; ?>"><?php echo $cls_value->class_name; ?></option>
										</select>
									</td>
									<td width="40%">
										<input type="number" name="fee" value="<?php echo $finfo->fee; ?>" required class="form-control" min="0"/> 
										<input type="hidden" name="hid_id" value="<?php echo $finfo->id; ?>"/>
									</td>
									
									<td width="20%">
										<button type="submit" name="submit" id="class_period_submit<?php echo $cls_value->classid.$value->shiftid; ?>" class="btn btn-primary">Save</button>
									</td>
								</tr>
						</form>		
						<?php }  ?>
					</table>
					</div>
					</div>
					</div>
			<?php  } ?>		
					
		</div>
	