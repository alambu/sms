           <!-- Content Header (Page header) -->
<script type="text/javascript">
	function data_pass_catg(v,tp){
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
		if(Uvalue.trim()==''){
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
						alert('Update Successfully');
						location.reload();
					}
					else if(data==0){
						alert('Update fail');
					}
					else if(data==2){
						alert('Update Faile For Dublicate Catagory Type');
					}
				}
				
		     });
		}	 
	}	
</script>

					<div class="row">
						<div class="col-md-12">
							<table class="table table-condensed">
								<tr class="active">
									<td><b style="font-size:18px;line-height:20px;color:dark-gray ;">Catagory List</b></td>
								</tr>
							
							</table>
							
						</div>
					</div>
					</br>
                    <div class="row">
						    <div class="col-md-12">
											
											<table id="example1" class="table table-striped table-condensed table-bordered">
												<thead>
													<tr>
														<th>Serial No</th>
														<th>Catagory Name</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php 
														
														$info=$this->db->select("*")->from("book_catg")->get()->result();
														$i=1;
														foreach($info as $value)
														{
													?>
														
													<tr>
															<td><?php echo $i++; ?></td>
															<td><?php echo $value->catg_type; ?></td>
															
															<td>
																<form action="library_submit/category_form" method="post">
																	<button type="button" value="<?php echo $value->bctg_id; ?>" onclick="data_pass_catg(this.value,'catg');" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_catg">
																		<span class="glyphicon glyphicon-edit"></span>
																	</button>
																	<!--
																	<button type="submit" name="catg_delete" onclick="return confirm_reset();" value="<?php //echo $value->bctg_id; ?>" class="btn btn-danger">
																		<span class="glyphicon glyphicon-trash"></span>
																	</button>
																	------>
																
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
					
<!-----------------------Start Edit calagory----------------------->	
	<div class="modal fade" id="edit_catg" role="dialog">
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
	