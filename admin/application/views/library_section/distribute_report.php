            <!-- Content Header (Page header) -->
<script type="text/javascript">
	$("document").ready(function(){
		$("#s_date").datepicker({format: 'yyyy-mm-dd'
	});
		$("#e_date").datepicker({format: 'yyyy-mm-dd'
	});
	
	});

	function find_book_name(b_id){
	$.ajax({	
		url: "index.php/library_submit/ajax_request",
		type: 'POST',	
		data:{ctg_id:b_id},	
		success: function(data)
		{	
			document.getElementById('bk_name').style.width="200px";
			document.getElementById('bk_name').innerHTML=data;
		}
		
	 });
	}
	
	function ajax_request_clsid_cer(cls_id){
		//alert(cls_id);
		$.ajax({
			url: "index.php/student_submit/ajax_request",
			type: 'POST',	
			data:{cls_id:cls_id},	
			success: function(data)
			{	
				if(data.length!=0){
				var d=data.split(",");
				var sec="Select Section";
				document.getElementById("section_cer").innerHTML='';
				document.getElementById("section_cer").innerHTML="<option value=''>"+sec+"</option>";
				
				for(var i=0;i<d.length;i++){
					
					document.getElementById("section_cer").innerHTML+="<option value='"+d[i]+"'>"+d[i]+"</option>";
				}
			}
			else{
				document.getElementById("section_cer").innerHTML='';
				document.getElementById("section_cer").innerHTML="<option value=''>Section Select</option>";
			}
			}
			
			});
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
		document.getElementById("cls_select").innerHTML='';
		document.getElementById("cls_select").innerHTML="<option value=''>"+sec+"</option>";
		
		for(var i=0;i<d.length;i++){
			
			document.getElementById("cls_select").innerHTML+="<option value='"+d1[i]+"'>"+d[i]+"</option>";
		}
		
		}
		
		else {
			document.getElementById("cls_select").innerHTML='';
			document.getElementById("cls_select").innerHTML="<option value=''>Select Class</option>";
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
<!------------------Start Searching Form---------------------------->
						<div class="row">
							<div class="col-md-12">
								<form class="form-horizontal" role="form" action="library_section/book_report" method="post">
									
									<?php
										extract($_POST);
										if(isset($_POST['by_book']) && isset($_POST['catg']))
										{
											$selected_list=$this->lib_report->selected_book_list($catg);
										}	
									?>
												<div class="form-group">
													
													<div class="col-md-4">
													 <label for="email">Book Catagory:</label>
													 <select name="catg" class="form-control" onchange="find_book_name(this.value);">
															<option value="">Book Catagory</option>
															<?php
																$sereach_info=$this->db->query("select catg_type,bctg_id from book_catg")->result();
																foreach($sereach_info as $value){
																	?>
																<option <?php if($catg==$value->bctg_id){ echo "selected";} ?> value="<?php echo $value->bctg_id;  ?>"><?php echo $value->catg_type; ?></option>
																<?php 	
																}
															?>
													 </select>
													</div>	
													<?php ?>
													<div class="col-md-4">
													 <label for="pwd">Book Name:</label>
													<select  name="bk_name" id="bk_name" class="form-control">
														<option value="">Book Name</option>
														<?php 
														if(!empty($catg)){
														  foreach($selected_list as $v){
															  ?>
															  <option <?php if($bk_name==$v->blist_id) { echo "selected"; } ?>  value="<?php echo $v->blist_id; ?>"><?php echo $v->bookN; ?></option>
														  <?php	  
														  }
														}
														else 
														{
															echo "<option value=''>Select Book</option>";
														}
														
														?>
													</select>
													</div>
											
												<div class="col-md-2">
													<label for="pwd">Book Code:</label>
													<input type="number" name="bk_code" id="bk_code" min="0" class="form-control" placeholder="Enter Book Code" value="<?php echo $bk_code; ?>"/>
												</div>
												
												<div class="col-md-2">
													<label for="pwd" style="opacity:0;">search:</label>
													<button type="submit" name="by_book" class="btn btn-primary" style="margin-top:0px;float:right;"><span class="glyphicon glyphicon-search"></span> Search By Catagory</button>
												</div>
												
											    </div>
												
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
														<select name="cls" id="cls_select" class="form-control" onchange="ajax_request_clsid_exp(this.value);">
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
														<button type="submit" name="by_student" class="btn btn-primary" style="margin-top:0px;float:right;"><span class="glyphicon glyphicon-search"></span> Search By Student</button>
													</div>
													
												</div>
												
												
											</form>	
										</div>	
									</div>
<!------------------End Searching Form------------------------------>	
					</br>
                    <div class="row">
						<div class="col-md-12">		
							<table id="example6" class="table table-striped table-condensed table-bordered">
								<thead>
									<tr>
										<th>Serial No</th>
										<th>Catagory</th>
										<th>Book Name</th>
										<th>Book Code</th>
										<th>Distribute From</th>
										<th>Distribute To</th>
										<th>Distribute Date</th>
										<th>Return Date</th>
									</tr>
								</thead>
								<tbody>
									
									<?php $i=1; foreach($info as $value){
									$sdate=date("d-m-Y",strtotime($value->stdrdate));
									$edate=date("d-m-Y",strtotime($value->stdreturn));
									$d=date("d-m-Y");
									?>
									<tr class="<?php if($d>$edate){ echo "danger"; } elseif($d==$edate){ echo "warning"; } else{ echo ""; }  ?>">
										<td><?php echo $i++; ?></td>
										<td><?php echo $value->catg_type;  ?></td>
										<td><?php echo $value->bookN; ?></td>
										<td><?php echo $value->book_id; ?></td>
										<td><?php echo $this->lib_report->entry_user_info($value->bdis_id)->fullname; ?></td>
										<td><a href="javascript:void(0);"><?php echo $value->name. "(".$value->stu_id.")"; ?></a></td>
										<td><?php echo $sdate;  ?></td>
										<td><?php echo $edate;  ?></td>
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
		