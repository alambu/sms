
<script type="text/javascript">	
function confirm_msg()
{
		var con=confirm("Are You Sure Re Store?");
		if(con==true){
			return true;
		}
		else {
			return false;
		}
}	
</script>

<!------------------Start Searching Form---------------------------->	
					<?php extract($_POST); ?>
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
											<option value="">Select</option>
											<option value="all_catg">All</option>
											<?php 
												$select=$this->db->select("*")->from("book_catg")->get()->result();
												foreach($select as $value){
												?>
												<option <?php if(isset($_POST['submit_all_lost'])){ if($catg_name==$value->bctg_id) { echo "selected"; } } ?> value="<?php echo $value->bctg_id; ?>"><?php echo $value->catg_type; ?></option>	
												<?php 	
												}
											?>
										</select>
										</div>
										<div class="col-md-2">
										<button type="submit" name="submit_all_lost" class="btn btn-primary">
											<span class="glyphicon glyphicon-search"></span> Search
										</button>
										</div>
									</div>
									
								</center>
							</form>	
						</div>
					</div>
					
<!------------------End Searching Form------------------------------>	
					
                    <div class="row">
						    <div class="col-md-12">
								
								<table id="example1" class="table table-striped table-bordered table-condensed">
									<thead>
										<tr>
											<td>Serial No</td>
											<td>Catagory Name</td>
											<td>Book Name</td>
											<td>Writter Name</td>
											<td>Book Code</td>
											<td>Lost By</td>
											<td>Comment</td>
											<td>Restore</td>
											
										</tr>
									</thead>
									<tbody>
										<?php
										if(isset($_POST['submit_all_lost'])){
										extract($_POST);
										}
										
										$i=1;$j="";
										foreach($all_lost as $value){
											//$value->empid;echo $value->stu_id;
											if($value->empid==0){
												$lost_by=$this->db->query("select name from regis_tbl where stu_id='$value->stu_id'")->row()->name;
												$j="Student";
											}
											else {
												$lost_by=$this->db->query("select fullname from user_reg where userid='$value->empid'")->row()->fullname;
												$j="Admin";
											}
										?>
										<tr>
											<td><?php echo $i++; ?></td>
											<td><?php echo $value->catg_type; ?></td>
											<td><?php echo $value->bookN; ?></td>
											<td>
											<?php echo $value->writterN;?>
											</td>
											<td>
											<?php echo $value->book_id;?>
											</td>
											<td>
											<a href="javascript:void(0);"><?php echo $lost_by;  ?> (<?php echo $j; ?>)</>
											</td>
											<td>
											<?php echo $value->comment; ?>
											</td>
											<td>
												<?php if($value->status>2) { ?>
												<button type="button" onclick="book_restore_all_book(<?php echo $value->book_id; ?>);"; class="btn btn-success btn-sm"><span class="glyphicon glyphicon-repeat"></span> Restore</button>
												<?php } ?>
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
	