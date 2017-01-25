				
<script>
	function ajax_request_clsid_report(cls_id) {
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
			document.getElementById("section_cer").innerHTML='';
			document.getElementById("section_cer").innerHTML="<option value=''>"+sec+"</option>";
			
			for(var i=0;i<d.length;i++){
				
				document.getElementById("section_cer").innerHTML+="<option value='"+d1[i]+"'>"+d[i]+"</option>";
			}
			}
			else {
				document.getElementById("section_cer").innerHTML='';
				document.getElementById("section_cer").innerHTML="<option value=''>Section Select</option>";
			}
		}
		
		});
}
		
		
function selected_class_report(sftid) {
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
		document.getElementById("class_name_tc").innerHTML='';
		document.getElementById("class_name_tc").innerHTML="<option value=''>"+sec+"</option>";
		
		for(var i=0;i<d.length;i++){
			
			document.getElementById("class_name_tc").innerHTML+="<option value='"+d1[i]+"'>"+d[i]+"</option>";
		}
		
		}
		
		else {
			document.getElementById("class_name_tc").innerHTML='';
			document.getElementById("class_name_tc").innerHTML="<option value=''>Select Class</option>";
		}
	
	}
	
	});
}
</script>
						<div class="row">
							<div class="col-md-12">
								 <form class="form-horizontal" role="form" action="student_section/certificate_print" method="post">
		  
									<table class="table table-hover">
										
											<tr>
												<td>
													
													
										<div class="form-group">
												
												  <div class="col-md-3">
												  <label  for="pwd">Shift </label>
													<select name="sft_cer" id="shift_tc" class="form-control" onchange="selected_class_report(this.value);">
														<option value="">Select</option>
														<?php 
															foreach($all_shift as $value) {
														?>
														<option value="<?php echo $value->shiftid; ?>" <?php  if($sft_log==$value->shiftid){ echo "selected"; }  ?>><?php echo $value->shift_N; ?></option>
															<?php } ?>
													</select>
													
													</div>
													
													 <div class="col-md-3">
													 <label  for="pwd">Class</label>
													<select name="cls_cer" id="class_name_tc" class="form-control" onchange="ajax_request_clsid_report(this.value);" >
														<option value="">Select</option>
														<?php 
															foreach($class as $value){
														?>
														<option value="<?php echo $value->classid; ?>" <?php if($cls_log==$value->classid){ echo "selected"; }  ?>><?php echo $value->class_name; ?></option>
															<?php } ?>
													</select>
												  </div>
												 
												  <div class="col-md-3">
													 <label  for="pwd">Section</label>
													<select name="sec_cer" id="section_cer"  class="form-control">
														<?php
														if((isset($sec_log) && ($sec_log!=''))){
														$sec=$this->db->select("section")->from("class_catg")->where("classid",$cls_log)->get()->row()->section;
														$ex=explode(",",$sec);
														foreach($ex as $val){
														?>
														<option <?php if($sec_log==$val){ echo "selected"; } ?> value="<?php echo $val ?>"><?php echo $val; ?></option>
														
														<?php }} else {
														?>
														<option value="">Select Section</option>
														<?php 
														} ?>
														
													</select>
												  </div>
												  <div class="col-md-3">
													<label>Roll No</label>
													<input type="number" name="rol_cer" value="<?php if($stu_log==''){ echo $rol_log; } ?>" class="form-control" min="0" placeholder="Enter Roll No"/>
												  </div>
										</div>
												<div class="form-group">
												  <div class="col-md-3">
													<label>Student ID &nbsp;<span id="valid"></span></label>
													<input type="text" name="stu_cer" value="<?php echo $stu_log; ?>" class="form-control" onkeypress="return isNumber(this.value);" onkeyUp="valid_stuid(this.value);" placeholder="Enter Student ID"/>
												  </div>
												  <div class="col-md-3">
													<label  for="pwd">Certificate Type</label>
													<select name="type_cer" class="form-control" required>
														<option value="">Select</option>
														<option value="tc">TC</option>
														<option value="testimonial">Testimonial</option>
													</select>
												  </div>
												 <div class="col-md-3">
													<label  for="pwd"></label>
													<button style="margin-top:24px;" type="submit" name="cer_ban" class="btn btn-info"><span class=""></span> বাংলা</button>
												
												  
													<label  for="pwd"></label>
													<button style="margin-top:24px;" type="submit" name="cer_eng" class="btn btn-success"><span class=""></span> English</button>
												  </div>
												  
												</div>
												</td>
											</tr>	
										</table>
									</form>
								</div>
							</div>
					