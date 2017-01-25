
<script type="text/javascript">
	function data_pass(v,tp) {
		
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
</script>
<style>
p{
	font-size:17px;
}
</style>
<!------------------Start Searching Form---------------------------->	
					<?php
					if(isset($_POST['submit_view_store']))
					{
					extract($_POST);
					}
					?>
					<div class="row" style="margin-bottom:20px;">
						<div class="col-md-12">
							<form class="form-horizontal" action="library_section/book_report" method="post">
								<center>
								<div class="form-group">
										<div class="col-md-2">
										<label for="email">Catagory Name:</label>
										</div>
										<div class="col-md-6">
										<select name="catg_name" class="form-control" required>
											<option value="all_catg">All Catagory</option>
											<?php 
											$select=$this->db->select("*")->from("book_catg")->get()->result();
											foreach($select as $value)
											{
											?>
											<option <?php  if($catg_name==$value->bctg_id) { echo "selected"; }  ?> value="<?php echo $value->bctg_id; ?>"><?php echo $value->catg_type; ?></option>	
											<?php 	
											}
											?>
										</select>
										</div>
										<div class="col-md-2">
										<button type="submit" name="submit_view_store" class="btn btn-primary">
											<span class="glyphicon glyphicon-shopping-cart"></span> Store Search
										</button>
										</div>
									</div>
									
								</center>
							</form>	
						</div>
					</div>
					
<!------------------End Searching Form------------------------------>
							<?php 
							foreach($storage as $value) 
							{
								$total_book+=$value->total_book;
							    $total_dis+=$this->lib_report->total_distribute($value->bctg_id);
							    $total_loss+=$this->lib_report->total_loss($value->bctg_id);
							} 
							$storage_now=$total_book-($total_dis+$total_loss);
							 ?>
						<div class="row">
						    <div class="col-md-4"></div>
							<div class="col-md-4">
								<table class="table table-striped table-bordered table-condensed">	
									<tr>
										<td style="font-weight:bold;">Total Book:</td>
										<td><span class="badge"><?php echo number_format($total_book); ?></span></td>
									</tr>
									<tr>
										<td style="font-weight:bold;">Distributed Now:</td>
										<td><span class="badge" style="background:green;"><?php echo number_format($total_dis); ?></span></td>
									</tr>
									<tr>
										<td style="font-weight:bold;">Storage:</td>
										<td><span class="badge"><?php echo number_format($storage_now);  ?></span></td>
									</tr>
									<tr>
										<td style="font-weight:bold;">Lost Book:</td>
										<td><span class="badge" style="background:red;"><?php echo number_format($total_loss); ?></span></td>
									</tr>
								</table>
							</div>
							<div class="col-md-3"></div>
						</div>
					
						</br>
						
						<div class="row">
						    <div class="col-md-12">
								
								<table id="example5" class="table table-hover table-bordered table-condensed">
									<thead>
										<tr>
											<th>Serial No</th>
											<th>Catagory Name</th>
											<th>Total Book</th>
											<th>Total Distributed</th>
											<th><span class="glyphicon glyphicon-shopping-cart"></span> Storage</th>
											
										</tr>
									</thead>
									<tbody>
										<?php
										if(isset($_POST['submit_view_store'])){
										extract($_POST);
										}
										
										$i=1;
										foreach($storage as $value) {
											$total_book=$value->total_book;
											$total_distribute=$this->lib_report->total_distribute($value->bctg_id);
											$total_loss=$this->lib_report->total_loss($value->bctg_id);
											$store_catg=$total_book-($total_distribute+$total_loss);
										?>
										<tr>
											<td><?php echo $i++; ?></td>
											<td><?php echo $value->catg_type; ?></td>
											<td><span class="badge"><?php echo $total_book; ?></span></td>
											<td>
											<span class="badge">
											<?php
												echo $total_distribute;
											?>
											</span>
											</td>
											<td>
											<span class="badge"><?php echo $store_catg; ?></span>
											</td>
										</tr>
										<?php } ?>
										<tfoot>
										
										</tfoot>
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
	