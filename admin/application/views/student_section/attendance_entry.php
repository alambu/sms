<script type="text/javascript">
function ajax_request_clsid(cls_id) {
	//alert(cls_id);
	$.ajax({
		url: "index.php/student_submit/ajax_request",
		type: 'POST',	
		data:{cls_id:cls_id},	
		success: function(data)
		{	
			if(data.length!=0){
			var data1=data.split("#");	
			var d=data1[0].split(",");
			var d1=data1[1].split(",");
			var sec="Select Section";
			document.getElementById("section").innerHTML='';
			document.getElementById("section").innerHTML="<option value=''>"+sec+"</option>";
			
			for(var i=0;i<d.length;i++){
				
				document.getElementById("section").innerHTML+="<option value='"+d1[i]+"'>"+d[i]+"</option>";
			}
			}
			else {
				document.getElementById("section").innerHTML='';
				document.getElementById("section").innerHTML="<option value=''>Section Select</option>";
			}
		}
		
		});
}
	
	
function selected_class(sftid) {
	$.ajax({
	url: "index.php/basic_setting/selected_class",
	type: 'POST',	
	data:{sft_id:sftid},	
	success: function(data)
	{
		if(data!='#') {
		var data1=data.split("#");	
		var d=data1[0].split(",");
		var d1=data1[1].split(",");
		var sec="Select Class";
		document.getElementById("class_catg").innerHTML='';
		document.getElementById("class_catg").innerHTML="<option value=''>"+sec+"</option>";
		
		for(var i=0;i<d.length;i++){
			
			document.getElementById("class_catg").innerHTML+="<option value='"+d1[i]+"'>"+d[i]+"</option>";
		}
		
		}
		
		else {
			document.getElementById("class_catg").innerHTML='';
			document.getElementById("class_catg").innerHTML="<option value=''>Select Class</option>";
		}
	
	}
	
	});
}


$("document").ready(function(){
	
	$("#attendance_entry").submit(function(e) {
	e.preventDefault();
	
	var formData = new FormData(this);

	$.ajax({  
		 type: "POST",  
		 url: "index.php/student_submit/attendance",  
		 data: formData,
		 async: false,
		 cache: false,
		 contentType: false,
		 processData: false,
		 beforeSend:function(){
			 document.getElementById('attendance_submit').disabled = "disabled";	
			 document.getElementById('attendance_submit').innerHTML = 'Saveing---';
		 },
		 success: function(data) {
			 if(data==1)
			 {
				 alert('Data Save Successfully');
				 location.reload();
			 }
			 else { 
			 alert(data);
			 document.getElementById('attendance_submit').innerHTML = 'Save';
             document.getElementById('attendance_submit').disabled = false;
			 }
		 }
	}); 
	//return false;
	});
		
		
});
</script>
<?php  
extract($_POST); 

?>
<div class="row">
	<div class="col-md-12">
		 <form class="form-horizontal" role="form" action="student_section/attendance" method="post">

			<table class="table table-hover">
				
					<tr>
						<td>
							<div class="form-group">
								<div class="col-md-3">
									<label  for="pwd">Shift </label>
									<select name="shift" id="shift" class="form-control" onchange="selected_class(this.value);" required>
										<option value="">Select</option>
										<?php 
											foreach($shift_select as $value){
										?>
										<option <?php if($shift==$value->shiftid){ echo "selected"; } ?> value="<?php echo $value->shiftid; ?>"><?php echo $value->shift_N; ?></option>
											<?php } ?>
									</select>
								
								</div>
								
								<div class="col-md-3">
									<label  for="pwd">Class</label>
									<select name="class_catg" id="class_catg" class="form-control" onchange="ajax_request_clsid(this.value);" required >
										<option value="">Select</option>
										<?php
										foreach($selected_class as $value) {	
										?>
										<option <?php if($class_catg==$value->classid){ echo "selected"; } ?>  value="<?php echo $value->classid; ?>"><?php echo $value->class_name; ?></option>
										<?php
										 }
										?>
									</select>
								</div>
							 
								<div class="col-md-3">
									<label  for="pwd">Section</label>
									<select name="section" id="section" class="form-control" required >
									<option value="">Select</option>
									<?php foreach($selected_section as $value) { ?>
									<option <?php if($section==$value->sectionid) { echo "selected"; } ?> value="<?php echo $value->sectionid; ?>"><?php echo $value->section_name; ?></option>
									<?php } ?>
									</select>
								</div>
								
								<div class="col-md-3">
									<label  for="pwd"></label>
									<button style="margin-top:24px;" type="submit" name="entry" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span>  Entry</button>
								</div> 
								
							</div>
						</td>
					</tr>	
				</table>
			</form>
		</div>
	</div>
							
<!--------------------------Start Attendance Sheet------------------------------>

						<?php
						if(isset($_POST['entry'])){
						if($chk_row_atten==0){
						if($chk_student>0){
						?>
						<form action="student_submit/attendance" method="post" id="attendance_entry">
							<div class="row">
								<div class="col-md-12">	
									<table id="" class="table table-bordered table-condensed table-striped">
										<thead>
											<tr>
												<th>
												<input type="hidden" name="cls_name" value="<?php echo trim($class_catg); ?>"/>
												<input type="hidden" name="section" value="<?php echo trim($section); ?>"/>
												<input type="hidden" name="shift" value="<?php echo trim($shift); ?>"/>
												
												Student ID
												
												</th>
												<th>Name</th>
												<th>Roll</th>
												<th>Date</th>
												<th>Picture</th>
												<th>Attendance</th>	
											</tr>
										</thead>
										<tbody>
											
											<?php
												foreach($attendance_sheet as $value){
											?>
											<tr>
												<td>
												<input type="hidden" value="<?php echo trim($value->stu_id)."/".trim($value->roll_no); ?>" name="stu_id[]" class="form-control"/>
												<?php echo $value->stu_id; ?>
												</td>
												<td> <?php echo $value->name; ?> </td>
												<td><?php echo $value->roll_no; ?></td>
												<td><?php echo date("d-m-Y"); ?></td>
												<td><img src="img/student_section/registration_form/<?php echo $value->picture; ?>" class="img-thumbnail" style="height:50px;width:50px;"/></td>
												<td>
												<input type="checkbox" name="chk_box[]" style="opacity:1 !important;" value="<?php echo trim($value->stu_id)."/".trim($value->roll_no); ?>" checked />
												
												</td>
												
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
						
							
							</div>
						
							<div class="row" style="margin-top:10px;">
								<div class="col-md-12">
									<center>
											<button type="submit" id="attendance_submit" name="submit" onclick="return confirm_reset();" class="btn btn-primary">Save</button>
									</center>
									
								</div>
								
							</div>
					</form>
				<?php
				}
				else
				{
				?>
					
					<div class="row">
						<div class="col-md-12">
									<button type="button" name="not_found" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-warning-sign"></span>  Sorry Student Not Found</button>
						</div>
					</div>
					
				<?php 		
				}
				
				
				}
				elseif($chk_row_atten>0) {

				?>
						<form action="index.php/student_section/attendance_edit" method="post">
						<div class="row">
							<div class="col-md-12">
								<span><input type="hidden" name="class_name" value="<?php echo $class_catg; ?>"/><input type="hidden" name="shift" value="<?php echo $shift;?>"/><input type="hidden" name="section" value="<?php echo $section; ?>"/></span>
								<button type="submit" name="submit" class="btn btn-block btn btn-warning"><span class="glyphicon glyphicon-warning-sign"></span>  Attendance Already Save Successfully <?php echo $date; ?>   You Can Edit Now  <span class="glyphicon glyphicon-edit"></span></button>
							</div>
							
						</div>
						</form>	
					
			<?php } } ?>