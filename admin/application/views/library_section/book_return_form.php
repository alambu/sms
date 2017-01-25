				<script type="text/javascript">
					function return_book(s_id){
					$.ajax({	
						url: "index.php/library_submit/ajax_request",
						type: 'POST',	
						data:{ret_book:s_id},	
						success: function(data)
						{	
							if(data==0){
								alert('Student Id is Wrowng');
							}
							else{
								var d=data.split(",");
								document.getElementById('student_name').value=d[0];
								document.getElementById('present_class').value=d[1];
							}
						}
						
					 });
				}
				function book_recived(bk_id,row_id,stu,dis_id) {
					var con=confirm('Are You Sure Received?');
					if(con==true){
						
					$.ajax({	
						url: "index.php/library_submit/ajax_request",
						type: 'POST',	
						data:{reciv_book:bk_id,st:stu,dis_id:dis_id},
						beforeSend:function(){
							document.getElementById("pic"+row_id).style.opacity ="1";
							document.getElementById("reciv_btn"+row_id).innerHTML="Receiveing---";
						},
						success: function(data)
						{	
							if(data==1){
								//alert('success');
								$("#row_"+row_id).hide();
							}
							else if(data==0) {
								alert('falile');
							}
						}
						
					 });
					}
				}
				
	function ajax_delete(bid,stid,cmnt,did,tp) {
		if(cmnt==''){
			$("#coment").addClass('error');
			//return false;
		}
		
		else {
			$("#coment").removeClass('error');
		$.ajax({
			
				url: "index.php/library_submit/ajax_delete",
				type: 'POST',	
				data:{bkid:bid,stid:stid,typ:tp,msg:cmnt,dist_id:did},	
				success: function(data)
				{		
					if(data==1){
						alert('Book Loss Successfully');
						location.reload();
					}
					else {
						alert('fail');
					}
				}
				
		     });
		}	 
	}
	
	
	function data_pass_toloss(bid,sid,disid) {
		
		
		$.ajax({
			
			url: "index.php/library_submit/book_info_pass",
			type: 'POST',	
			data:{bkid:bid,stid:sid},	
			success: function(data)
			{		
				var d=data.split(",");
				document.getElementById('edit_id').value=bid;
				document.getElementById('stu_id').value=sid;
				document.getElementById('dis_id').value=disid;
				document.getElementById('lost_by').value=d[0];
				document.getElementById('bk_name').value=d[1];
				document.getElementById('bk_code').value=d[2];
				document.getElementById('bk_price').value=d[3];
				document.getElementById('fine').value=d[4];
				var fine_price=d[4]/100; 
				document.getElementById('total_fine').value=fine_price*d[3];
				
			}
			
		 });
	}
	
function selected_class1(sftid) {
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
		document.getElementById("cls_name_bdis1").innerHTML='';
		document.getElementById("cls_name_bdis1").innerHTML="<option value=''>"+sec+"</option>";
		
		for(var i=0;i<d.length;i++){
			
			document.getElementById("cls_name_bdis1").innerHTML+="<option value='"+d1[i]+"'>"+d[i]+"</option>";
		}
		
		}
		
		else {
			document.getElementById("cls_name_bdis1").innerHTML='';
			document.getElementById("cls_name_bdis1").innerHTML="<option value=''>Select Class</option>";
		}
	
	}
	
	});
}	
</script>


					 <div class="row">
                       <div class="col-md-12">
<!--------------------------Start Searching Form----------------------------->							
						<?php extract($_POST); ?>
						<form  class="form-horizontal" role="form" action="library_section/book_dist_return" method="post" enctype="multipart/form-data">

						    <div class="form-group">
							<label class="control-label col-sm-2" for="email">Student ID:</label>
							<div class="col-sm-10">
							 <input type="text" class="form-control" name="student_id" id="student_id" placeholder="Enter Student Id" value="<?php echo $student_id; ?>" onchange="return_book(this.value);" onkeypress="return checkaccnumber(event);">
							</div>
							
						    </div>
						    
							
							<div class="form-group">
							<label class="control-label col-md-2" for="email">Session:</label>
							<div class="col-md-4">
							<select name="y" id="ses" class="form-control">
								<?php 
								for($i=date("Y");$i>=2010; $i--){
								?>
								<option <?php if($y==$i){echo "selected";} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
								<?php
								}
								?>
							</select> 
							</div>
								<label class="control-label col-md-2" for="pwd">Shift Name:</label>
								<div class="col-md-4"> 
								 <select type="text" class="form-control" name="sft_ret" id="sft_ret" onchange="selected_class1(this.value);">
									<option value="">Select Shift</option>
									
									<?php 
									$sft=$this->db->get("shift_catg")->result();
									foreach($sft as $value){
									?>
									<option <?php if($sft_ret==$value->shiftid) { echo "selected"; } ?> value="<?php echo $value->shiftid; ?>"><?php echo $value->shift_N; ?></option>
									<?php 
									} ?>
								 </select>
								</div>
						    </div>
							
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="pwd"> Class Name:</label>
								<div class="col-sm-4"> 
								  <select type="text" class="form-control" name="cls_name" id="cls_name_bdis1" onchange="ajax_request_clsid(this.value,'_r');">
									<option value="">Select Class</option>
								 </select>
								</div>
								<label class="control-label col-sm-2" for="pwd">Section:</label>
								<div class="col-sm-4"> 
								 <select  class="form-control" name="section" id="section_r">
									<?php if(isset($_POST['submit_return'])) { extract($_POST); $svalue=$section; ?> 
									<option value="<?php echo $svalue;?>"><?php echo $svalue;?></option>
									<?php } 
									else { ?>
									<option value="">Select Session</option>
									<?php } ?>
								 </select>
								</div>
								
								
								
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="pwd">Roll No:</label>
								<div class="col-sm-4"> 
								  <input type="text" name="roll_no_ret" id="roll_no_ret" value="<?php echo $roll_no_ret; ?>" Placeholder="Enter Roll No" class="form-control"/>
								</div>
								
								
								<label class="control-label col-sm-2" for="pwd"></label>
								<div class="col-sm-4"> 
								  <button type="submit" name="submit_return" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> View</button>
								</div>
								
							</div>
						</form>	
<!---------------End Searching Form--------------------------------------->	

<!------------------------Start Submit Form------------------------------->	
<style>
.text_center{
	text-align:center;
}
.error{
	border:1px solid red;
}
</style>			
					<?php 
					if(isset($_POST['submit_return']))
					{
						extract($_POST);
					}
						?>
						</br>
						<div class="row">
							<div class="col-md-12">
								<table class="table table-condensed">
									<tr class="active"><td>Distributed Book List</td></tr>
								</table>
							</div>
						</div>
						</br>
						<form  class="form-horizontal" role="form" action="index.php/admin/book_return_form" method="post" enctype="multipart/form-data">
						
							    
										<table id="example1" class="table table-hover table-condensed">
										
										<thead>
										  <tr>
											<th style="text-align:center;">Sl.No</th>
											<th style="text-align:center;">Category</th>
											<th style="text-align:center;">Book Name</th>
											<th style="text-align:center;">Book Code</th>
											<th style="text-align:center;">Writer Name</th>
											<th style="text-align:center;">Student Name</th>
											<th style="text-align:center;">Given Date</th>
											<th style="text-align:center;">Return Date</th>
											<th>Action</th>
										  </tr>
										</thead>
										
										
										
										<tbody>
										  <?php		
											$i=0;
											foreach($ret_book as $value){
											$i++;
												
										  ?>
										  <tr id="row_<?php echo $i; ?>">
											<td class="text_center"><?php echo $i; ?></td>
											<td class="text_center"><?php echo $value->catg_type; ?></td>
											<td class="text_center"><?php echo $value->bookN; ?></td>
											<td class="text_center"><?php echo $value->book_id; ?></td>
											<td class="text_center"><?php echo $value->writterN; ?></td>
											<td class="text_center"><?php echo $value->name; ?></td>
											<td class="text_center"><?php echo date("d-m-Y",strtotime($value->stdrdate)); ?></td>
											<td class="text_center"><?php echo date("d-m-Y",strtotime($value->stdreturn)); ?></td>
											<td>
											<img id="pic<?php echo $i; ?>" style="opacity:0;" src="img/book_recive.gif"/>
											<button type="button" onclick="book_recived(<?php echo $value->book_id; ?>,<?php echo $i; ?>,<?php echo $value->stu_id; ?>,<?php echo $value->bdis_id; ?>);" class="btn btn-success btn-sm" id="reciv_btn<?php echo $i; ?>"><span class="glyphicon glyphicon-shopping-cart"></span> Received</button>
											
											<button type="button" onclick="data_pass_toloss(<?php echo $value->book_id; ?>,<?php echo $value->stu_id; ?>,<?php echo $value->bdis_id; ?>);" data-toggle="modal" data-target="#damge" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Loss</button>
											</td>
											
										  </tr>
											<?php } ?>
										</tbody>
										</table>
								
							
						</form>
					  </div>
				  
<!------------------------------End Submit Form------------------------------->		
			  
                    </div>
					</div>
<!-----------------------Start Book Damage Fomr----------------------->	
	<div class="modal fade" id="damge" role="dialog">
		<div class="modal-dialog">
		  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
				  <button type="button" data-dismiss="modal" onclick="location.reload();" class="close">&times;</button>
				  <h4 class="modal-title">Delete From Inventory</h4>
				</div>
				<div class="modal-body">
					<form  role="form">
						<input type="hidden" id="stu_id" value=""/>
						<div class="form-group">
						  <label for="pwd">Lost By:</label>
						  <input type="text" class="form-control" readonly name="lost_by" id="lost_by" value=""/>
						</div>
						<div class="form-group">
						  <label for="pwd">Book Name:</label>
						  <input type="text" class="form-control" readonly name="bk_name" id="bk_name" value=""/>
						</div>
						<div class="form-group">
						  <label for="pwd">Book Code:</label>
						  <input type="text" class="form-control" readonly name="bk_code" id="bk_code" value=""/>
						</div>
						<div class="form-group">
						  <label for="pwd">Book Price:</label>
						  <input type="text" class="form-control" readonly name="bk_price" id="bk_price" value=""/>
						</div>
						<div class="form-group">
						  <label for="pwd">Fine:</label>
						  <div class="input-group">
						  <input type="text" class="form-control" readonly name="fine" id="fine" value=""/>
						  <span class="input-group-addon" id="basic-addon3">%</span>
						  </div>
						</div>
						<div class="form-group">
						  <label for="pwd">Fine Price:</label>
						  <input type="text" class="form-control" readonly name="total_fine" id="total_fine" value=""/>
						</div>
						<div class="form-group">
						  <label for="pwd">Comments:</label>
						  <textarea class="form-control" id="coment"></textarea>
						  <input type="hidden" name="dis_id" id="dis_id" value=""/>
						</div>
						<div class="form-group">
						  <button type="button"  class="btn btn-primary" id="edit_id" value="" onclick="ajax_delete(this.value,stu_id.value,coment.value,dis_id.value,'book');"><span class="glyphicon glyphicon-send"></span> Loss</button>
						</div>
						
					</form>
				</div>
				<div class="modal-footer">
				  <button type="button" data-dismiss="modal" onclick="location.reload();" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Close</button>
				</div>
			  </div>
		</div>
      