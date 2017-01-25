
						
		<script type="text/javascript">
		function ajax_request(stu_id){			
		$.ajax({
			url: "index.php/student_submit/ajax_request",
			type: 'POST',	
			data:{readm_id:stu_id},	
			success: function(data)
			{	
				//alert(data);
				if(data=='1'){
					document.getElementById("stu_error").innerHTML="Sorry ! Student ID Not Match";
				}
				else {
					
				var d=data.split("+");
				var clid=d[0].split(",");
				var clnm=d[1].split(",");
				var clids=d[2];
				var sec=d[3];
				var sid=d[4];
				var sname=d[5];
				var exist_sft=d[6];
				var tt=d[7];
				var all_sec=tt.split(",");
				//alert(all_sec.length);
				var sid_splid=sid.split(",");
				var s_name=sname.split(",");
				
				document.getElementById('shift').innerHTML='';
				//document.getElementById('shift').innerHTML='<option value="">Select</option>';
				for(var k=0;k<sid_splid.length-1;k++){
					
					if(sid_splid[k]==exist_sft){ var st="selected";}
					else{ var st='';}
					
					document.getElementById('shift').innerHTML+="<option value='"+ sid_splid[k]+"'"+ st +" >"+s_name[k]+"</option>";
					
				}
				
				
				document.getElementById("stu_error").innerHTML="";
				//document.getElementById("session").value=syear;
				document.getElementById("section_read").innerHTML='';
				
				
				for(var j=0;j<all_sec.length;j++){
					if(all_sec[j]==sec){
						var sec_s="selected";
					}
					else{ var sec_s='';}
					
					document.getElementById("section_read").innerHTML+="<option value='"+all_sec[j]+"'"+sec_s+">"+all_sec[j]+"</option>";
					
				}
				
				
				
				document.getElementById("catagoryid_readm").innerHTML='';
				document.getElementById("catagoryid_readm").innerHTML='<option>Select</option>';
				for(var i=0;i<clid.length-1;i++){
					if(clids==clid[i]){
						var ss="selected";
					}else{
						var ss='';
					}
					
					document.getElementById("catagoryid_readm").innerHTML+="<option value='"+clid[i]+"'"+ss+">"+clnm[i]+"</option>";
				}
				
					
				}
			}          
			});
		}
		
		function ajax_request_clsid_readm(cls_id){
			var a=document.getElementById("section_read").value;
			//alert(a);
			$.ajax({
				url: "student_submit/ajax_request",
				type: 'POST',	
				data:{cls_id:cls_id},	
				success: function(data)
				{		
					var d=data.split(",");
					var sec="Select";
					document.getElementById("section_read").innerHTML='';
					document.getElementById("section_read").innerHTML="<option value=''>"+sec+"</option>";
					
					for(var i=0;i<d.length;i++){
						
						document.getElementById("section_read").innerHTML+="<option value='"+d[i]+"'>"+d[i]+"</option>";
					}
				}          
				});
		}
	</script>
						
							<div class="row">
								   <div class="col-md-10">
										
									<form  class="form-horizontal" role="form" action="student_submit/re_admission" method="post" enctype="multipart/form-data">
										
										  <div class="form-group">
											
											<label class="control-label col-md-2" for="email">Student ID</label>
											<div class="col-md-4">
											  <span id="stu_error" style="color:red;"></span>	
											  <input type="text" name="stu_id" class="form-control" onchange="ajax_request(this.value);" placeholder="Enter Student ID" value="<?php echo $stu_id; ?>" onkeypress="return isNumber(event);" required>
											</div>
											<label class="control-label col-md-2" for="pwd">Class Name</label>
												<div class="col-md-4"> 
												  <select class="form-control" name="catagoryid" id="catagoryid_readm" onchange="ajax_request_clsid_readm(this.value);" required>
													<option value="">Select Class</option>
													<?php 
														$select=$this->db->query("select * from class_catg")->result();
														foreach($select as $v){
													?>
														<option <?php if($catagoryid==$v->classid) {echo "selected"; } ?> value="<?php echo $v->classid; ?>"><?php echo $v->class_name; ?></option>
														
														<?php } ?>
												  </select>
												</div>
										  </div>
									  
										<div class="form-group">
											<label class="control-label col-md-2" for="pwd">Section</label>
											<div class="col-md-4"> 
											  <select class="form-control" name="section" id="section_read" required>
												<?php 
													if(isset($_GET['rd'])){
														
														$query=$this->db->select("*")->from("class_catg")->get()->result();
														foreach($query as $value){
															if($value->classid==$catagoryid){
																$ex=explode(",",$value->section);
																foreach($ex as $s){
																	?>
																	<option value="<?php echo $s; ?>"> <?php echo $s; ?> </option>
																<?php 	
																}
															}
															
														}
													}
													else {
													?>
													<option value="">Select Section</option>
													<?php 
													}
												?>
												
											  </select>
											</div>
											
											
											<label class="control-label col-md-2" for="pwd">Roll No</label>
											<div class="col-md-4"> 
											  <input type="text" name="roll_no" class="form-control" value="<?php echo $roll_no; ?>" id="mName" placeholder="Enter Roll No"  required>
											</div>
											
										</div>
										
										
										<div class="form-group">
											<label class="control-label col-md-2" for="email">Session</label>
											<div class="col-md-4">
											  <select name="session" class="form-control" id="session_readm" required >
												<option <?php if($session==date("Y")){ echo "selected"; } ?> <?php echo date("Y"); ?>><?php echo date("Y"); ?></option>
												<option <?php if($session==date("Y")+1){ echo "selected"; } ?> <?php echo date("Y")+1; ?>><?php echo date("Y")+1; ?></option>
											  </select>
											</div>
											
											<label class="control-label col-md-2">Shift</label>
											<div class="col-md-4"> 
											  <select class="form-control" name="shift" id="shift" required >
												<?php 
												 if(isset($_GET['rd'])){
													 $query=$this->db->select("*")->from("shift_catg")->get()->result();
													 foreach($query as $value){
													?>
													 <option <?php if($value->shiftid==$shift){ echo "selected"; } ?> value="<?php echo $value->shiftid; ?>"><?php echo $this->db->select("shift_N")->from("shift_catg")->where("shiftid",$value->shiftid)->get()->row()->shift_N; ?></option>
													<?php										
													 }
													}
												 else {
												?>
												<option value="">Select Shift</option>
												 <?php } ?>
												 
											  </select>
											</div>
											
										</div>
										
										
									  <div class="form-group"> 
										<div class="col-sm-offset-2 col-md-10">
										  <button type="submit" class="btn btn-primary" name="submit" id="submit"><span class="glyphicon glyphicon-send"></span> Submit</button> &nbsp;&nbsp;&nbsp;
										  <button type="reset" onclick="return confirm_reset();" class="btn btn-warning"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
										</div>
									  </div>
									</form>

										
									
								  </div>
								  
					</div>

