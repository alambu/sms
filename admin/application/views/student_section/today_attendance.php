<script>
function shift_wise_report(sft)
{
	
	url='student_section/today_attendance_report?sid='+sft;
	$("#report_show").empty().append('<p align="center" style="margin-top:5%"><img src="img/line.gif"></p>');
	$("#report_show").load(url);

} 


var newwindow;
  function details(url)
  {
  newwindow=window.open(url,'name','height=600,width=800,left=300,scrollbars=yes,top=20');
  if (window.focus) {newwindow.focus()}
  } 
$("document").ready(function(){
	$("#sdate,#edate").datepicker({format: 'dd-mm-yyyy'
	});
});  

</script>

<div class="row">
	<div class="col-md-12">
		<label>Select Shift</label>
		<select name="shift" class="form-control" onchange="shift_wise_report(this.value);">
			<option value=''>Select Shift</option>
			<?php foreach($shift_select as $value){ ?>
			<option  value="<?php echo $value->shiftid; ?>"><?php echo $value->shift_N; ?></option>
			<?php } ?>
		</select>
	</div>
</div>

</br>

<div id="report_show">

</div>