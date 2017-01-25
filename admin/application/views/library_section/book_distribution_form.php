			<script>
				$("document").ready(function(){
						$("#given_date").datepicker({format: 'dd-mm-yyyy'
					});
						$("#return_date").datepicker({format: 'dd-mm-yyyy'
					});
					
					});
				
				function find_student(s_id,tp) {
					var btn=document.getElementById("submit");
					var er=document.getElementById("error");
					$.ajax({	
						url: "index.php/library_submit/ajax_request",
						type: 'POST',	
						data:{st_id:s_id},	
						success: function(data)
						{	
							if(data==0){
								//alert('');
								//document.getElementById("student_id").value="";
								er.innerHTML="Student Id is Wrowng";
								btn.disabled=true;
							}
							else{
								btn.disabled=false;
								var d=data.split(",");
								document.getElementById('student_name').value=d[0];
								//document.getElementById('present_class').value=d[1];
								er.innerHTML="";
								//document.getElementById("log").style.display = "inline-block";
							}
						}
						
					 });
				}
				function distribute_log(v){
					
					$.ajax({	
						url: "index.php/library_submit/distribute_log",
						type: 'POST',
						data:{dis_log:v},
						beforeSend:function()
						{
							document.getElementById("pic").style.display="block";
						},
						success: function(data)
						{	
							//alert(data);
							document.getElementById("pic").style.display="none";
							if(data==0){
								document.getElementById("hisT").innerHTML="<center><h2>Distributed Book Not Found</h2></center>";
							}
							else{
							document.getElementById("hisT").innerHTML=data;
							}
							
						}
						
					 });
				}
				
				function find_book(b_code){
					var btn=document.getElementById("submit");
					var er=document.getElementById("error");
					$.ajax({	
						url: "index.php/library_submit/ajax_request",
						type: 'POST',	
						data:{bk_code:b_code},	
						success: function(data)
						{   
							//alert(data);
						    var d=data.split(",");
							//alert(d.length);
							if(d.length==2){
								//alert(d[1]);
								document.getElementById("bctg_id").value=d[1];
								btn.disabled=false;	
								er.innerHTML="";
							}
							else {
								btn.disabled=true;
								//document.getElementById("book_id").value="";
							if(data==1){
								//alert("");
								er.innerHTML="Already Distributed";
							}
							else if(data==2){
								//alert("This Book Damaged By Student");
								er.innerHTML="This Book Damaged By Student";
								
							}
							else if(data==3){
								//alert("This Book Damaged By Managment");
								er.innerHTML="This Book Damaged By Managment";
							}
							else {
								//alert("Book Id is Wrowng");
								er.innerHTML="Book Id is Wrowng";
								
							}
							
							}
						}
						
					 });
					 	
					
				}
		
				function search_by_roll(sft,cls,sec,r,rid,y){
					var d=sft+"/"+cls+"/"+sec+"/"+r+"/"+y;
					if(sft!='' || cls!='' || sec!='') {
					$.ajax({	
						url: "index.php/library_submit/distribute_log",
						type: 'POST',
						data:{dis_log_roll:d},
						beforeSend:function()
						{
							document.getElementById("pic").style.display="block";
						},
						success: function(data)
						{	
							//alert(data);
							document.getElementById("pic").style.display="none";
							if(data==0){
								document.getElementById("hisT").innerHTML="<center><h2>Distributed Book Not Found</h2></center>";
							}
							else{
							document.getElementById("hisT").innerHTML=data;
							}
							
						}
						
					 });
					}
					else {
						alert("Please Select Shift,Class,Section");
						document.getElementById(rid).value='';
					}
				}
				
			function find_student_by_roll(sft,cls,sec,r){
					var er,bt,d;
					d=sft+"/"+cls+"/"+sec+"/"+r;
					er=document.getElementById("error");
					bt=document.getElementById("submit");
					if(sft==''){ er.innerHTML="Shift is Empty";}
					else if(cls==''){ er.innerHTML="Class is Empty";}
					else if(sec==''){ er.innerHTML="Section is Empty";}
					else {
						$.ajax({
						url: "index.php/library_submit/ajax_request",
						type: 'POST',
						data:{st_roll:d},
						success: function(data)
						{
							//alert(data);
							if(data==0){
								er.innerHTML="Roll No is Wrowng";
								bt.disabled=true;
							}
							else {
								var sp=data.split("/");
								document.getElementById("student_id").value=sp[0];
								document.getElementById("student_name").value=sp[1];
								//document.getElementById("present_class").value=sp[2];
								er.innerHTML="";
								bt.disabled=false;
							}
						}
						
						});
					}
				}

				
			function date_valid(redate,stdate,ret_id){
					var bt=document.getElementById("submit");
					var er=document.getElementById("error");
					//alert(ret_id);
					var et=redate.split("-");
					var st=stdate.split("-");
					var sy,ey,sm,em,sd,ed;
					ey=parseInt(et[2]);
					em=parseInt(et[1]);
					ed=parseInt(et[0]);
					sy=parseInt(st[2]);
					sm=parseInt(st[1]);
					sd=parseInt(st[0]);	
					if(ey>=sy && em>sm){
						bt.disabled=false;
						er.innerHTML="";						
						return true;						
					}
					else{
						if((ey==sy) && (em==sm) && (ed==sd)){
							bt.disabled=false;
							er.innerHTML="";
							return true;
						}
						else if(ey<sy){
							alert("You Can Not Select Previus Day");
							document.getElementById(ret_id).value='';
							return false;
						}
						else if((ey==sy) &&(em<sm)){
							alert("You Can Not Select Previus Day");
							document.getElementById(ret_id).value='';
							return false;
						}
						else if((ey==sy) && (em==sm) && (ed <sd)){
							alert("You Can Not Select Previus Day");
							document.getElementById(ret_id).value='';
							return false;
						}												
						else{
							//alert("true");
							bt.disabled=false;
							er.innerHTML="";
							return true;
						}
					}	
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
		document.getElementById("cls_name_bdis").innerHTML='';
		document.getElementById("cls_name_bdis").innerHTML="<option value=''>"+sec+"</option>";
		
		for(var i=0;i<d.length;i++){
			
			document.getElementById("cls_name_bdis").innerHTML+="<option value='"+d1[i]+"'>"+d[i]+"</option>";
		}
		
		}
		
		else {
			document.getElementById("cls_name_bdis").innerHTML='';
			document.getElementById("cls_name_bdis").innerHTML="<option value=''>Select Class</option>";
		}
	
	}
	
	});
}
				
</script>

					
					 <div class="row">
                       <div class="col-md-12">
							
						<form  class="form-horizontal" role="form" action="library_submit/book_distribution_form" method="post" enctype="multipart/form-data">

						  <div class="form-group">
							<label class="control-label col-md-2" for="email">Student Id:</label>
							<div class="col-md-10">
							 <input type="hidden" name="bctg_id" id="bctg_id" value=""/>
							 <input type="text" class="form-control" name="student_id" id="student_id" placeholder="Enter Student Id" onchange="find_student(this.value),distribute_log(this.value);" onkeyup="find_student(this.value)" onkeypress="return checkaccnumber(event);" required />
							</div>
							
							</div>
						 
						  <div class="form-group">
							<label class="control-label col-md-2" for="email">Session:</label>
							<div class="col-md-4">
							<select name="y" id="ses" class="form-control">
								<?php 
								for($i=date("Y");$i>=2010; $i--){
								?>
								<option <?php if($year==$i){echo "selected";} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
								<?php
								}
								?>
							</select> 
							</div>
							<label class="control-label col-md-2" for="pwd">Shift Name:</label>
								<div class="col-md-4"> 
									<select type="text" class="form-control" name="sft_dis" id="sft_dis" onchange="selected_class(this.value);">
										<option value="">Select Shift</option>
										
										<?php 
										$sft=$this->db->get("shift_catg")->result();
										foreach($sft as $value){
										?>
										<option value="<?php echo $value->shiftid; ?>"><?php echo $value->shift_N; ?></option>
										<?php 
										} ?>
									</select>
								</div>
						  </div>
						  
						  <div class="form-group">
							<label class="control-label col-md-2" for="pwd">Class Name:</label>
								<div class="col-md-4"> 
								 <select type="text" class="form-control" name="cls_name" id="cls_name_bdis" onchange="ajax_request_clsid(this.value,'_d');">
									<option value="">Select Class</option>
								 </select>
								</div>
							<label class="control-label col-md-2" for="email">Section:</label>
							<div class="col-md-4">
							 <select class="form-control" id="section_d">
								<option value="">Select Section</option>
							 </select>
							</div>
							
						  </div>
						  
						  <div class="form-group">
							<label class="control-label col-md-2" for="pwd">Roll No:</label>
								<div class="col-md-4"> 
								 <input type="text" class="form-control" name="roll_no" id="roll_no_dis" placeholder="Enter Roll No" onchange="search_by_roll(sft_dis.value,cls_name_bdis.value,section_d.value,this.value,this.id,ses.value);" onkeyup="find_student_by_roll(sft_dis.value,cls_name_bdis.value,section_d.value,this.value);" />
								</div>
							<label class="control-label col-md-2" for="pwd">Distribute To:</label>
								<div class="col-md-4"> 
								 <input type="text" class="form-control" readonly name="student_name" placeholder="Student Name" id="student_name" required>
								</div>
							
						  </div>
						  
							<div class="form-group">	
								<label class="control-label col-md-2" for="pwd">Distribute Book ID:</label>
								<div class="col-md-4"> 
								 <input type="text" class="form-control" name="book_id" id="book_id" placeholder="Enter Book Id" onkeyup="find_book(this.value);" onkeypress="return checkaccnumber(event),block_space(this.value);" required/> 
								</div>
								<label class="control-label col-md-2" for="pwd">Distribute Date:</label>
								<div class="col-md-4"> 
								  <input type="hidden" class="form-control" name="given_date" id="given_date"  value="<?php echo date("d-m-Y"); ?>" placeholder="Enter Given Date" required />
								  
								  <input type="text" class="form-control" name="" value="<?php echo date("d-m-Y"); ?>" disabled />
								  
								</div>
							</div>
							
							
							<div class="form-group">
								<label class="control-label col-md-2" for="pwd">Return Date:</label>
								<span id="d_msg"></span>
								<div class="col-md-4"> 
								
								<input type="text" class="form-control" name="return_date" id="return_date" onchange="date_valid(this.value,given_date.value,this.id)" onkeypress="return block_space(this.value);" placeholder="Enter Return Date"required>
								</div>
								
							</div>
							
							
							
						  <div class="form-group">
							<div class="col-md-2">
							</div>
							<div class="col-md-4">
							  <button type="submit"  class="btn btn-primary" name="submit" id="submit"><span class="glyphicon glyphicon-send"></span> Distribute</button> &nbsp;&nbsp;&nbsp; 
							  <button type="reset" class="btn btn-warning"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
							  &nbsp;&nbsp;&nbsp;  
							  
							</div>
							<div class="col-md-4">
								<h4 id="error" style="color:red;"> </h4>
							</div>
						  </div>
						</form>

							
						
					  </div>
					
                    </div>
					<div class="row">
						<center>
						<img id="pic" style="display:none;" src="img/ajax-loader.gif"/>
						</center>
                       <div class="col-md-12" id="hisT">
						
					   </div>
					   
					</div>   
