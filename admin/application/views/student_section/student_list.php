<!----------------------------Search Student Start------------------------>	
<script type="text/javascript">
var newwindow;
  function details(url)
  {
  newwindow=window.open(url,'name','height=600,width=800,left=300,scrollbars=yes,top=20');
  if (window.focus) {newwindow.focus()}
  }
  
  var stu_log;
  function details_log(url)
  {
  stu_log=window.open(url,'name','height=600,width=800,left=300,scrollbars=yes,top=20');
  if (window.focus) {stu_log.focus()}
  }

function search_option_show(sft)
{

	url='student_section/search_option_show?sid='+sft;
	$("#list_show").empty();
	$("#op_show").empty().append('<p align="center" style="margin-top:5%"><img src="img/line.gif"></p>');
	$("#op_show").load(url);

}  
</script> 


					
					
						<div class="row">
							<div class="col-md-12">
								<label>Select Shift</label>
								<select name="shift" class="form-control" onchange="search_option_show(this.value);">
									<option value=''>Select Shift</option>
									<?php foreach($all_shift as $value){ ?>
									<option  value="<?php echo $value->shiftid; ?>"><?php echo $value->shift_N; ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						
						</br>
						
						<!------Option list start---------->
						<div id="op_show">
							
						</div>
						<!------Option list End------------>
						
						</br>
						<!------list show start---------->
						<div id="list_show">
							
						</div>
						<!------list Show End------------>
						

					
			
<!----------------------------Search Student Start------------------------>	
