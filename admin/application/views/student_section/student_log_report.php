<script>
	function valid_stuid(stu_id){
		if(stu_id==''){document.getElementById('valid').innerHTML='';}
		else{
		$.ajax({
			url: "index.php/student_submit/valid_stuid",
			type: 'POST',	
			data:{stu_id:stu_id},	
			success: function(data)
			{		
				document.getElementById('valid').innerHTML=data;
			}          
			});
	}
	}
	
	function ajax_request_clsid_log(cls_id)
	{
		
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
			document.getElementById("section_log").innerHTML='';
			document.getElementById("section_log").innerHTML="<option value=''>"+sec+"</option>";
			
			for(var i=0;i<d.length;i++){
				
				document.getElementById("section_log").innerHTML+="<option value='"+d1[i]+"'>"+d[i]+"</option>";
			}
			}
			else {
				document.getElementById("section_log").innerHTML='';
				document.getElementById("section_log").innerHTML="<option value=''>Section Select</option>";
			}
			
			}
			
			});
	}
	
function selected_class_log(sftid) {
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
		document.getElementById("class_name_log").innerHTML='';
		document.getElementById("class_name_log").innerHTML="<option value=''>"+sec+"</option>";
		
		for(var i=0;i<d.length;i++){
			
			document.getElementById("class_name_log").innerHTML+="<option value='"+d1[i]+"'>"+d[i]+"</option>";
		}
		
		}
		
		else {
			document.getElementById("class_name_log").innerHTML='';
			document.getElementById("class_name_log").innerHTML="<option value=''>Select Class</option>";
		}
	
	}
	
	});
}

function stu_log_search(frm,log)
{
	var sft,cls,sec,ses,stuid,rol_no;
	sft=frm.sft_log.value;
	cls=frm.cls_log.value;
	sec=frm.sec_log.value;
	rol_no=frm.rol_log.value;
	stuid=frm.stu_log.value;
	ses=frm.ses_year.value;
	var str=sft+"/"+cls+"/"+sec+"/"+rol_no+"/"+stuid+"/"+ses;
	url='student_section/student_log_search?str='+str+'&typ='+log;
	$("#log_show1").empty();
	$("#log_show1").empty().append('<p align="center" style="margin-top:5%"><img src="img/line.gif"></p>');
	$("#log_show1").load(url);
}
</script>

<?php $all_shift=$this->student->all_shift(); extract($_POST); ?>						
						<!---------------Start searching form------------------>
				<div class="row">
					<div class="col-md-12">
						 <form class="form-horizontal" role="form" action="student_section/registration_form" method="post">
  
							<table class="table table-hover">
								
									<tr>
										<td>
											
											
								<div class="form-group">
										
										  <div class="col-md-3">
										  <label  for="pwd">Shift </label>
											<select name="sft_log" id="shift" class="form-control" onchange="selected_class_log(this.value);">
												<option value="">Select</option>
												<?php 
													
													foreach($all_shift as $value){
												?>
												<option value="<?php echo $value->shiftid; ?>" <?php  if($sft_log==$value->shiftid){ echo "selected"; }  ?>><?php echo $value->shift_N; ?></option>
													<?php } ?>
											</select>
											
											</div>
											
											 <div class="col-md-3">
											 <label  for="pwd">Class</label>
											<select name="cls_log" id="class_name_log" class="form-control" onchange="ajax_request_clsid_log(this.value);" >
												<option value="">Select</option>
											</select>
										  </div>
										 
										  <div class="col-md-3">
											 <label  for="pwd">Section</label>
											<select name="sec_log" id="section_log"  class="form-control">
												<option value="">Select Section</option>
											</select>
										  </div>
										  <div class="col-md-3">
											<label>Roll No</label>
											<input type="number" name="rol_log" value="" class="form-control" min="0" placeholder="Enter Roll No"/>
										  </div>
								</div>
										<div class="form-group">
										  <div class="col-md-3">
											<label>Student ID &nbsp;<span id="valid"></span></label>
											<input type="text" name="stu_log" value="<?php echo $stu_log; ?>" class="form-control" onkeypress="return isNumber(this.value);" onkeyUp="valid_stuid(this.value);" placeholder="Enter Student ID"/>
										  </div>
										  <div class="col-md-3">
											<label>Session<span id="valid"></span></label>
											<select name="ses_year" id="" class="form-control" required>
												<option value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
												<option value="<?php echo date("Y")+1; ?>"><?php echo date("Y")+1; ?></option>
											 </select>
										  </div>
										  <div class="col-md-4">
											
											<label  for="pwd"></label>
											<button style="margin-top:24px;" type="button" onclick="stu_log_search(this.form,'f');" name="fine_log" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-fire"></span> Finance</button>
										
										  
											<label  for="pwd"></label>
											<button style="margin-top:24px;" type="button" onclick="stu_log_search(this.form,'a');" name="attn_log_stu" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-tasks"></span> Attendance</button>
										  </div>
										  
										</div>
										</td>
									</tr>	
								</table>
							</form>
						</div>
					</div>
						
						
						<!---------------End searching form-------------------->
						
						<!---------------Report start-------------------------->
							<div class="row">
								<div class="col-md-12" id="log_show1">	
								</div>
							</div>
						<!---------------Report End---------------------------->
						
						