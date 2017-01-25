<style>
.error
{
	border:1px solid red;
}
</style>
<script type="text/javascript">
	function data_pass_book(v,tp){
		
		$.ajax({
			
				url: "index.php/library_submit/data_passTo_modal",
				type: 'POST',	
				data:{e_id:v,typ:tp},	
				success: function(data)
				{	
					var d=data.split(",");
					document.getElementById('e_id').value=d[0];
					document.getElementById('bk_n').value=d[1];
					document.getElementById('wt').value=d[2];
					document.getElementById('qt').value=d[3];
					document.getElementById('pri').value=d[4];
					document.getElementById('fpri').value=d[5];
				}
				
		      });
	}

	
	function ajax_edit_book(Uid,tp) {
		var bk,wt,qt,pri,fpri,msg,d;
		bk=document.getElementById('bk_n');
		wt=document.getElementById('wt');
		qt=document.getElementById('qt');
		pri=document.getElementById('pri');
		fpri=document.getElementById('fpri');
		msg="";
		if(bk.value.trim()==''){
			$("#bk_n").addClass('error');
			msg+='error';
		}
		else {
			$("#bk_n").removeClass('error');
			msg+='';
		}
		if(wt.value.trim()==''){
			$("#wt").addClass('error');
			msg+='error';
		}
		else {
			$("#wt").removeClass('error');
			msg+='';
		}
		if(qt.value.trim()==''){
			$("#qt").addClass('error');
			msg+='error';
		}
		else {
			$("#qt").removeClass('error');
			msg+='';
		}
		if(pri.value.trim()==''){
			$("#pri").addClass('error');
			msg+='error';
		}
		else {
			$("#pri").removeClass('error');
			msg+='';
		}
		if(fpri.value.trim()==''){
			$("#fpri").addClass('error');
			msg+='error';
		}
		else {
			if(fpri.value>100){
				msg+='error';
				alert('Fine Price is Large');
			}
			else {
			$("#fpri").removeClass('error');
			msg+='';
			}
		}
		if(msg==''){
			d=Uid+","+bk.value+","+wt.value+","+qt.value+","+pri.value+","+fpri.value;
			$.ajax({
			
				url: "index.php/library_submit/ajax_edit",
				type: 'POST',	
				data:{d:d,typ:tp},	
				success: function(data)
				{		
					if(data==1){
						alert('Update successfully');
						location.reload();
					}
					else {
						alert('wrong');
					}
				}
				
		     });
		}
		else {
			if(fpri.value>100){
				alert('Sorry ! Fine price Maximum 100');
			}
		}
		
		}	 
		
</script>
	<?php extract($_POST); ?>			
<!------------------Start Searching Form---------------------------->	

					<div class="row" style="margin-bottom:20px;">
						<div class="col-md-10">
							<form class="form-inline" role="form" action="library_section/book_edit" method="post">
								<center>
								<div class="form-group">
										<label for="email">Search By Catagory:</label>
										&nbsp;
										<select name="catg_name" style="width:300px;" class="form-control" required>
											<option value="">Select Catagory</option>
											<option <?php if(isset($_POST['submit_list'])){ if($catg_name=='all_catg') { echo "selected"; } } ?> value="all_catg">All</option>
											<?php 
												foreach($all_catg as $value) {
												?>
												<option <?php if(isset($_POST['submit_list'])){ if($catg_name==$value->bctg_id) { echo "selected"; } } ?> value="<?php echo $value->bctg_id; ?>"><?php echo $value->catg_type; ?></option>	
												<?php 	
												}
											?>
										</select>					
									</div>
									&nbsp;
									<button type="submit" name="submit_list" class="btn btn-primary">
										<span class="glyphicon glyphicon-search"></span> Search
									</button>
								</center>
							</form>	
						</div>
						
						<div class="col-md-2">
						
						</div>
					</div>
					
<!------------------End Searching Form------------------------------>					
					
                    <div class="row">
						    <div class="col-md-12">
								
											<table id="example4" class="table table-striped table-bordered table-condensed">
												<thead>
													<tr>
														<th>Serial No</th>
														<th>Catagory Name</th>
														<th>Book Name</th>
														<th>Writer Name</th>
														<th>Total Book</th>
														<th>Price</th>
														<th>Fine</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php
														$t=0;
														$i=1;
														foreach($info as $value){
															?>
														
													<tr>
															<td><?php echo $i++; ?></td>
															<td>
															<?php 
															echo $value->catg_type;
															?>
															</td>
															<td>
																<?php echo  $value->bookN; ?>
															</td>
															<td>
																<?php echo  $value->writterN; ?>
															</td>
															
															<td>
																<?php echo  $value->total; ?>
															</td>
															<td>
																<?php echo  $value->price; ?>
															</td>
															<td>
																<?php echo  $value->fineprice; ?> %
															</td>
															
															<td>
																<form action="index.php/library_submit/category_form" method="post">
																	<button type="button" value="<?php echo $value->blist_id; ?>" onclick="data_pass_book(this.value,'book_list');" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit_book">
																		<span class="glyphicon glyphicon-edit"></span>
																	</button>
																</form>
															</td>
													</tr>
														<?php
														}
														?>
													
												
												</tbody>
											</table>
								
						    </div>
                    </div>
					
<!-----------------------Start Edit catagory----------------------->	
	<div class="modal fade" id="edit_book" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" data-dismiss="modal" onclick="location.reload();" class="close">&times;</button>
			  <h4 class="modal-title">Book List Edit</h4>
			</div>
			<div class="modal-body">
				<form role="form">
				  <div class="form-group">
						<label for="email">Book Name:</label>
						<input type="text" class="form-control" id="bk_n">
				  </div>
				  <div class="form-group">
						<label for="pwd">Writer</label>
						<input type="text" class="form-control" id="wt">
				  </div>
				  <div class="form-group">
						<label for="pwd">Quantity</label>
						<input type="text" class="form-control" readonly onkeypress="return checkaccnumber(event);" id="qt">
				  </div>
				  <div class="form-group">
						<label for="pwd">Price</label>
						<input type="text" onkeypress="return isNumber(event);" class="form-control" id="pri">
				  </div>
				  <div class="form-group">
						<label for="pwd">Fine Price</label>
						<input type="text" onkeypress="return checkaccnumber(event);" class="form-control" id="fpri">
				  </div>
				  <button type="button" id="e_id" value="" onclick="ajax_edit_book(this.value,'book_list');"  class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> Update</button>
				</form>
			</div>
			<div class="modal-footer">
			  <button type="button" data-dismiss="modal" onclick="location.reload();"  class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Close</button>
			</div>
		  </div>
		  
		</div>
  </div>
				
<!-----------------------End Edit calagory----------------------->					
			