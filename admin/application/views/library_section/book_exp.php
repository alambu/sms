<script type="text/javascript">
	function data_pass(v,tp){
		
		$.ajax({
			
				url: "index.php/library_submit/data_passTo_modal",
				type: 'POST',	
				data:{e_id:v,typ:tp},	
				success: function(data)
				{		
					var d=data.split(",");
					document.getElementById('edit_id').value=d[0];
					document.getElementById('catg').value=d[1];
				}
				
		      });
	}
	
	function ajax_edit(Uid,Uvalue,tp) {
		if(Uvalue==''){
			$("#catg").addClass('error');
			//return false;
		}
		else {
			$("#catg").removeClass('error');
		$.ajax({
			
				url: "index.php/library_submit/ajax_edit",
				type: 'POST',	
				data:{u_id:Uid,u_v:Uvalue,typ:tp},	
				success: function(data)
				{		
					if(data==1){
						alert('success');
					}
					else if(data==0){
						alert('fail');
					}
				}
				
		     });
		}	 
	}
	function confirm_msg(){
		var con=confirm("Are You Sure Re Store?");
		if(con==true){
			return true;
		}
		else {
			return false;
		}
	}


function selected_class2(sftid) {
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
		document.getElementById("cls_exp").innerHTML='';
		document.getElementById("cls_exp").innerHTML="<option value=''>"+sec+"</option>";
		
		for(var i=0;i<d.length;i++){
			
			document.getElementById("cls_exp").innerHTML+="<option value='"+d1[i]+"'>"+d[i]+"</option>";
		}
		
		}
		
		else {
			document.getElementById("cls_exp").innerHTML='';
			document.getElementById("cls_exp").innerHTML="<option value=''>Select Class</option>";
		}
	
	}
	
	});
}

function ajax_request_clsid_exp(cls_id){
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
</script>
					<!------searching start------->
					
						<div class="row">
							<div class="col-md-12">
								<form class="form-horizontal" role="form" action="library_section/book_dist_return" method="post">
									
									<?php
										extract($_POST);	
									?>
									<div class="form-group">
										
										<div class="col-md-2">
										<label for="pwd">Session:</label>
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
										
										<div class="col-md-2">
										<label for="email">Shift:</label>
										<select name="sft" class="form-control" onchange="selected_class2(this.value);">
											<?php $shift=$this->db->query("select * from shift_catg")->result(); ?>
											<option value="">Shift</option>
											<?php
												foreach($shift as $shiftv){
											?>	
												<option <?php if($sft==$shiftv->shiftid){echo "selected";}?> value="<?php echo $shiftv->shiftid; ?>"><?php echo $shiftv->shift_N; ?></option>
											<?php 	
												}
											?>
										</select>
										</div>
										
										<div class="col-md-2">
											<label for="pwd">Class Name:</label>
											<select name="cls" class="form-control" id="cls_exp" onchange="ajax_request_clsid_exp(this.value);">
												<option value="">Class Name</option>
											</select>
										</div>
										
										<div class="col-md-2">
											<label for="pwd">Section</label>
											<select class="form-control" name="section" id="section_cer">
												<option value="">Select Section</option>
											</select>
										</div>
										
										<div class="col-md-2">
											<label for="email">Roll No:</label>
											<input name="roll_no" type="text" value="<?php echo $stu_id; ?>" class="form-control" Placeholder="Press Roll No" id="email">
										</div>
										
										<div class="col-md-2">
											<label for="pwd" style="opacity:0;">search:</label>
											<button type="submit" name="exp_search" class="btn btn-primary" style="margin-top:23px;float:left;"><span class="glyphicon glyphicon-search"></span> Filter</button>
										</div>
										
									</div>
												
												
								</form>	
							</div>	
						</div>
					</br>
					<!------searching end---------->
					
                    <div class="row">
						    <div class="col-md-12">
								
								<table id="example5" class="table table-hover table-bordered table-condensed">
									<thead>
										<tr>
											<th>Serial No</th>
											<th>Catagory Name</th>
											<th>Book Name</th>
											<th>Book Code</th>
											<th>Given Date</th>
											<th>Return Date</th>
											<th>Student Name</th>
											<th>Student ID</th>
											<th>Mobile</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if(isset($_POST['exp_search'])){
											extract($_POST);
										}
										
										$i=1;
										foreach($exp_info as $value){	
										?>
										<tr>
											<td><?php echo $i++; ?></td>
											<td><?php echo $value->catg_type; ?></td>
											<td><?php echo $value->bookN; ?></td>
											<td>
											<?php echo $value->book_id;?>
											</td>
											<td>
											<?php echo date("d-m-Y",strtotime($value->stdrdate));?>
											</td>
											<td>
											<?php echo date("d-m-Y",strtotime($value->stdreturn));?>
											</td>
											<td>
												<?php echo $value->name; ?>
											</td>
											<td>
												<?php echo $value->stu_id; ?>
											</td>
											<td>
												<?php echo $value->personal_phone; ?>
											</td>
											
										</tr>
										<?php } ?>
										
									</tbody>
									
								
								</table>
								
						    </div>
							
                    </div>
					
<!-----------------------Start Edit calagory----------------------->	
	<div class="modal fade" id="edit" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" data-dismiss="modal" onclick="location.reload();" class="close">&times;</button>
			  <h4 class="modal-title">Catagory Edit</h4>
			</div>
			<div class="modal-body">
				<form  role="form">
				
					<div class="form-group">
					  <label for="pwd">Catagory:</label>
					  <input type="text" class="form-control" id="catg" placeholder="Enter Catagory">
					</div>
					<div class="form-group">
					  <button type="button"  class="btn btn-primary" id="edit_id" value="" onclick="ajax_edit(this.value,catg.value,'catg');"><span class="glyphicon glyphicon-send"></span> Update</button>
					</div>
					
			    </form>
			</div>
			<div class="modal-footer">
			  <button type="button" data-dismiss="modal" onclick="location.reload();" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Close</button>
			</div>
		  </div>
		  
		</div>
  </div>
				
<!-----------------------End Edit calagory----------------------->					
	