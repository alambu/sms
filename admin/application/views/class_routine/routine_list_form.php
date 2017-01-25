<script type="text/javascript">
function class_wise_routine(frm)
{
	
	url='class_routine/routine_list?sid='+frm.shift.value+"&year="+frm.year.value;
	$("#report_show").empty().append('<p align="center" style="margin-top:5%"><img src="img/line.gif"></p>');
	$("#report_show").load(url);

} 


  
</script>
<div class="row">
	<div class="col-md-12">
		<form class="form-horizontal" role="form" action="class_routine/routine_list" method="post">
					  
			<table class="table table-hover table-condensed">
				
					<tr>
						<td>
						<div class="form-group">
								<div class="col-md-5">
									<label>Year</label>
									<?php 
									$cy=date("Y");
									$y=date("Y")+1;
									$yc=2010;
									?>
									<select name="year" id="year" class="form-control">
									<?php 
									for($y;$y>=$yc;$y--){
									?>
									<option <?php if($y==$cy) { echo "selected"; } ?> value="<?php echo $y; ?>"><?php echo $y; ?></option>
									<?php 
									}
									?>
									
									</select>
								  </div>
						
								  <div class="col-md-5">
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
									
									<div class="col-md-2">
										<label  for="pwd"></label>
										<button style="margin-top:24px;" type="button" onclick="class_wise_routine(this.form);" name="by_cls" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
									 </div>
						</div>
						</td>
					</tr>
				</table>
			</form>
	</div>
</div>

<div id="report_show">

</div>