<style>
.test_center
{
	text-align:center;
}
</style>
<h3>Subject List</h3>
<script>
function subject_list(sft)
{
	url='basic_setting/subject_show?sid='+sft;
	//$("#subShow").css("height","600px");
	$("#subShow").empty().append('<p align="center" style="margin-top:5%"><img src="img/line.gif"></p>');
	$("#subShow").load(url);
}
</script>
<div class="row">
	<div class="col-md-12">
		<form class="form-horizontal" role="form" action="student_submit/subject_setting" method="post" id="subject_dis_form">
			<table  class="table table-hover">
				<tr>
					<th>
						<div class="form-group">
							<label class="control-label col-sm-2" for="pwd">Shift Name:</label>
							<div class="col-sm-8">          
								<select name="sft_name"  class="form-control" onchange="subject_list(this.value);"  id="sft_name_sub" required>
									<option value="">SELECT Shift</option>
								<?php 
									foreach ($sft as $value) {
								?>
										<option value="<?php echo $value->shiftid; ?>"><?php echo $value->shift_N; ?></option>
									<?php 	
									}
								?>
								</select>
							</div>
						</div>
					</th>
				</tr>
				
			</table>
			
		</form>
	</div> 
</div>
<div id="subShow">

</div>
