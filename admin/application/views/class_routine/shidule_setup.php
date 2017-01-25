<style>
.error
{
	border:1px solid red;
}
</style>

<script type="text/javascript">
$(document).ready(function(){
	  $('#subject_setup_form').submit(function() {
		    document.getElementById('subject_submit').innerHTML = 'Saveing----';
		    document.getElementById('subject_submit').disabled = 'disabled';
		  $.post(
				"index.php/routine_submit/shidule_setup",
				$("#subject_setup_form").serialize(),
				function(data){
				 //alert(data);	
				 if(data==1)
				 {
					 alert(data);
					 location.reload();
				 }
				 else 
				 {
					 alert(data);
					 document.getElementById('subject_submit').disabled = false;
				 }
				 document.getElementById('subject_submit').innerHTML = 'Save';
			 });
		 return false;
		 }); 
});
	

  function shidule_setup(did)
  {
		 document.getElementById('shidule_submit'+did).innerHTML = 'Saveing----';
		 document.getElementById('shidule_submit'+did).disabled = 'disabled';
		 var action=$("#shidule_setup_"+did).attr('action');
		// alert(action);return false;
	  	$.post(
            action,
            $("#shidule_setup_"+did).serialize(),
            function(data){
              if(data==1)
			  {   alert('Save Successfully');
				  window.location="class_routine/setting";
			  }	
			  else {
				alert(data);
				document.getElementById('shidule_submit'+did).disabled = false;
			  }
			  document.getElementById('shidule_submit'+did).innerHTML = 'Save';
		});
		return false;
  }
  
  function period_length_setup(did)
  {
	  document.getElementById('length_submit'+did).innerHTML = 'Saveing----';
		 document.getElementById('length_submit'+did).disabled = 'disabled';
	  	$.post(
            "index.php/routine_submit/period_length_setup",
            $("#period_length_form_"+did).serialize(),
            function(data){
              if(data==1)
			  {   alert('Save Successfully');
				  window.location="class_routine/setting";
			  }	
			  else {
				alert(data);
				document.getElementById('length_submit'+did).disabled = false;
			  }
			  document.getElementById('length_submit'+did).innerHTML = 'Save';
		});
		return false; 
  }
</script>

<h3>Maximum Period Setup</h3>
<div class="panel-group" id="accordion1">
			<?php $y=date("Y");$maxy=date("Y")+1; for($y;$y<=$maxy;$y++) { ?>
				<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
					  <a data-toggle="collapse" data-parent="#accordion1" href="#collapse<?php echo $y; ?>"><span class="glyphicon glyphicon-hand-right"></span> Session:-<?php echo $y; ?></a>
					</h4>
				</div>
				<div id="collapse<?php echo $y; ?>" class="panel-collapse collapse <?php if($y==date("Y")) { echo "in"; } ?>">
				<div class="panel-body">
				<table class="table table-hover table-condensed">	
					
					<tr class="success">
						<th>Shift</th>
						<th>Maximum Period</th>
						<th>Action</th>
					</tr>
					<?php foreach($all_shift as $value){ ?>
			<form class="form-horizontal" role="form" action="routine_submit/period_length_setup" method="post" id="period_length_form_<?php echo $value->shiftid.$y; ?>" onsubmit="return period_length_setup(<?php echo $value->shiftid.$y; ?>);">
					<?php 
					$where=array('year'=>$y,'shiftid'=>$value->shiftid);
					$period_info=$this->routine->maximum_period($where); 
					?>
					<tr>
						<td width="40%">
							<input type="hidden" name="year" value="<?php echo $y; ?>"/>
							<select name="shift" class="form-control" required>
								<option value="<?php echo $value->shiftid; ?>"><?php echo $value->shift_N; ?></option>
							</select>
						</td>
						<td width="40%">
							<input type="number" name="cls_length" value="<?php echo $period_info->max_period; ?>" class="form-control" min="0"/> 
						</td>
						<td width="20%">
							<button type="submit" name="submit" id="length_submit<?php echo $value->shiftid.$y; ?>" class="btn btn-primary">Save</button>
						</td>
					</tr>
			</form>		
					<?php } ?>
					</table>
					</div>
					</div>
					</div>
			<?php } ?>		
</div>
</br>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-condensed table-striped">
					<tr class="active">
						<td><b style="text-align:left;font-size:18px;">Schedule Setup</b></td>
					</tr>
				
				</table>
			</div>
		</div>
		<br/>
		
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

		<div class="panel-group" id="accordion2">
		<?php  foreach($all_shift as $value) { ?>
			  	
			  <div class="panel panel-default">
				<div class="panel-heading">
				  <h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion2" href="#shift_<?php echo $value->shiftid; ?>">
					<span class="glyphicon glyphicon-hand-right"></span>  <?php echo $value->shift_N; ?> Shift</a>
				  </h4>
				</div>
				<div id="shift_<?php echo $value->shiftid; ?>" class="panel-collapse collapse">
					
					<div class="panel-body">
						<table class="table table-striped table-condensed">
						<?php
						$y=date("Y");$maxy=date("Y")+1; for($y;$y<=$maxy;$y++) {
						$where=array('year'=>$y,'shiftid'=>$value->shiftid);		
						$shidule_info=$this->routine->shift_shidule($where);
						//shidule action test start
						if(count($shidule_info)>0) { $fun='shidule_edit';  } else { $fun='shidule_setup'; }
						//shidule action test end
						?>
						
						
								<tr>
									<td colspan="5" style="text-align:center;font-size:18px;font-weight:bold;"><span class="label label-success">Session: <?php echo $y; ?></span></td>
								</tr>
								
								<tr class="success">
									<th style="text-align:center;font-size:16px;font-weight:bold;">Period</th>
									<th style="text-align:center;font-size:16px;font-weight:bold;">Title</th>
									<th style="text-align:center;font-size:16px;font-weight:bold;">Period Start</th>
									<th style="text-align:center;font-size:16px;font-weight:bold;">To</th>
									<th style="text-align:center;font-size:16px;font-weight:bold;">Period End</th>
								</tr>
								
						<form action="routine_submit/<?php echo $fun; ?>" method="post" id="shidule_setup_<?php echo $value->shiftid.$y; ?>" onsubmit="return shidule_setup(<?php echo $value->shiftid.$y; ?>);">
						<?php  
						$period_info=$this->routine->maximum_period($where);
						
						for($j=0;$j<$period_info->max_period;$j++) {
							
						?>
								<tr>
									<td style="font-weight:bold;text-align:center;">
									<?php $k=$j; echo $k+1; ?> th 
									<input type="hidden" name="year" value="<?php echo $y; ?>"/>
									<input type="hidden" name="shift" value="<?php echo $value->shiftid; ?>"/>
									<input type="hidden" name="shidule_id[]" value="<?php echo $shidule_info[$j]->shidule_id; ?>"/>
									</td>
									<td> 
										<select name="period_title[]" class="form-control">
											<?php if($shidule_info[$j]->shidule_id!=''){ ?>
											<option <?php if($shidule_info[$j]->period_title==1) { echo "selected"; } ?> value="1">Class Period</option>
											<option <?php if($shidule_info[$j]->period_title==0) { echo "selected"; } ?> value="0">Brack Period</option>
											<?php } else {  ?>
											<option value="1">Class Period</option>
											<option value="0">Brack Period</option>
											<?php } ?>
										</select>
									</td>
									<td>
										<input type="time" name="stime[]"  class="form-control" value="<?php echo $shidule_info[$j]->stime; ?>"/>
									</td>
									<td style="text-align:center;font-size:16px;font-weight:bold;">
										<center><span class="glyphicon glyphicon-arrow-right"></span></center>
									</td>
									<td>
										<input type="time" name="etime[]" class="form-control" value="<?php echo $shidule_info[$j]->etime; ?>"/>
									</td>
									
								</tr>
						<?php } ?>		
								<tr>
									<td colspan="5">
										<button type="submit" name="submit" id="shidule_submit<?php echo $value->shiftid.$y; ?>" class="btn btn-primary">Save</button>
									</td>
								</tr>
								
						</form> 
						<?php } ?>
						</table>
					</div>
					 
				</div>
			  </div>
			  </form>
		<?php $i++; } ?>	  
	</div>
	<?php  ?>