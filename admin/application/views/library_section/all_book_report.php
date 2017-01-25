          <!-- Content Header (Page header) -->
<script type="text/javascript">
	function data_pass_dam_admin(v){
		document.getElementById("e_id").value=v;
	}
function book_damage(v){
	var cmt=document.getElementById("cmnt").value;
	if(cmt==''){
		document.getElementById("cmnt").style.border="1px solid red";
	}
	else {
	$.ajax({
		url:"library_submit/ajax_request",
		type:"POST",
		data:{dam_v:v,cm:cmt},
		success:function(data){
			//alert(data);
			if(data==1){
				alert("Book Lost Successfully");
				location.reload();
			}
			else if(data==0){
				
			}
		}
		
	});
	}
	}

function find_book_name_search(b_id) {
	$.ajax({	
		url: "index.php/library_submit/ajax_request",
		type: 'POST',	
		data:{ctg_id:b_id},	
		success: function(data)
		{	
			document.getElementById('bk_name_search').style.width="250px";
			document.getElementById('bk_name_search').innerHTML=data;
		}
		
	 });
}

function book_restore_all_book(bid)
{
	var con=confirm("Are You Sure Restore?");
	if(con==true)
	{	
	$.ajax({	
		url: "index.php/library_submit/book_restore",
		type: 'POST',	
		data:{bid:bid},	
		success: function(data)
		{	
			if(data==1)
			{	
			alert("Successfully Storage");
			location.reload();
			}
			else 
			{
				alert('Not Restore');
			}	
		}
	 });
	} 
}	
</script>

<!------------------Start Searching Form---------------------------->	

					<div class="row" style="margin-bottom:20px;">
							<?php 
								extract($_POST);
							?>
							<form  role="form" role="form" action="library_section/book_report" method="post">
							<div class="col-md-3">
								<div class="form-group">
										<label for="email">Catagory Name:</label>
										&nbsp;
										<select name="catg_name" style="width:px;" class="form-control" onchange="find_book_name_search(this.value);">
											<?php if(!isset($_POST['catg_name'])) { ?>
											<option value="">Select</option>
											<?php 
												}
												$select=$this->db->select("*")->from("book_catg")->get()->result();
												foreach($select as $value){	
												?>
												<option <?php if($catg_name==$value->bctg_id) { echo "selected"; }  ?> value="<?php echo $value->bctg_id; ?>"><?php echo $value->catg_type; ?></option>	
												<?php 	
												}
											?>
										</select>
								</div>
							</div>
							<div class="col-md-3">
										
									<div class="form-group">
										<label for="email">Book Name:</label>
										<select name="list_no" style="width:250px;" name="bk_name" id="bk_name_search" class="form-control">
												    <?php 
														if(isset($_POST['submit_view_all'])){
														$ctg=$this->input->post('catg_name');
														$l=$_POST['list_no'];
														if(!(empty($_POST['list_no']))){	
														$sel=$this->db->query("select * from book_list where bctg_id='$ctg'")->result();
														foreach	($sel as $val){			
														?>
														<option <?php if($val->blist_id==$l){echo "selected";} ?> value="<?php echo $val->blist_id; ?>">
														<?php 
														echo $val->bookN;
														
														?>
														</option>
													<?php
													}
													}
													elseif(empty($_POST['list_no']) && (!(empty($ctg)))){
															$sel=$this->db->query("select * from book_list where bctg_id='$ctg'")->result();
													?>
													<option value="">Select</option>
													<?php 		
													foreach	($sel as $val){			
													?>
													<option <?php if($val->blist_id==$l){echo "selected";} ?> value="<?php echo $val->blist_id; ?>">
													<?php 
													echo $val->bookN;
													
													?>
													</option>
													<?php
													}
													}
													elseif(empty($_POST['list_no'])){
														?>
														<option value="">Select</option>
													<?php 	
													}
													}
													else {
													?>
													<option value="">Select</option>
													<?php 
													} 
													
													?>
												</select>
									</div>
							</div>		
							<div class="col-md-3">		
									<div class="form-group">
										<label for="email">Book Code:</label>
										<input type="text" class="form-control" name="bk_code" placeholder="Enter Book Code"  value="<?php  if(isset($_POST['bk_code'])){ echo $_POST['bk_code']; }?>" onkeypress="return checkaccnumber(event);"/>
									</div>
							</div>
							<div class="col-md-3">
									<div class="form-group">
									<label for="email"></label>
									<button type="submit" name="submit_view_all" style="margin-top:25px;" class="btn btn-primary">
										<span class="glyphicon glyphicon-search"></span> Filter
									</button>
									</div>
							</div>
							</form>
					</div>
					
<!------------------End Searching Form------------------------------>	


					
                    <div class="row">
						    <div class="col-md-12">
								
												<table id="example4" class="table table-hover table-bordered table-condensed">
													<thead>
														<tr>
															<th>Serial No</th>
															<th>Catagory Name</th>
															<th>Book Name</th>
															<th>Book Code</th>
															<th>Book Position</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<?php
														
														$i=1;
														foreach($all_book as $value){
														 $s=$value->status;
														 if($s==2) { $loss_by="Student"; } if($s==3) { $loss_by="Admin"; }
														?>
														<tr class="<?php if($s==0){echo '';}elseif($s==1){echo 'warning';}elseif($s>1){echo 'danger';} ?>">
															<td><?php echo $i++; ?></td>
															<td><?php echo $value->catg_type; ?></td>
															<td><?php echo $value->bookN; ?></td>
															<td><?php echo $value->book_id; ?></td>
															<td style="font-weight:bold;"><?php if($s==0){echo "Storage";}elseif($s==1){ echo "Distributed"; } elseif($s>1) {  echo "Lost By ". "(".$loss_by.")"; } ?></td>
															
															<td>
															
															<?php
															
															if($s==0){
															?>
																
																<button type="button"  data-toggle="modal" data-target="#dam" onclick="data_pass_dam_admin(this.value);" value="<?php  echo $value->book_id; ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span> Lost</button>
																
															 <?php 
															 }
															elseif($s==1){
																?>
																<!--<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Damage</button>
																&nbsp;&nbsp;
																<button type="button"  class="btn btn-success" onclick="book_recived_book_2(<?php // echo  $value->book_id; ?>,<?php //echo  $value->stu_id; ?>);"><span class="glyphicon glyphicon-shopping-cart" ></span> Recieved</button>--->
																<?php 
																}
															elseif($s>2) {
																?>
																<button type="button" onclick="book_restore_all_book(<?php echo $value->book_id; ?>);"; class="btn btn-success btn-sm"><span class="glyphicon glyphicon-repeat"></span> Restore</button>
																
																<?php 
																}

															?>
															
															</td>
														</tr>
														<?php
														} 
														
														?>
													</tbody>
													
												
												</table>
						    </div>
							
                    </div>
					
					
<!-----------------------Start Damage book----------------------->	
	<div class="modal fade" id="dam" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" data-dismiss="modal" onclick="location.reload();" class="close">&times;</button>
			  <h4 class="modal-title">Book Damage</h4>
			</div>
			<div class="modal-body">
				<div class="row">
				<div class="col-md-12">
				<form action="library_section/book_report" class="form-horizontal">
				  <div class="form-group">
						<label for="email">Comment</label>
						<textarea class="form-control" name="cmnt" id="cmnt" required></textarea>
				  </div>
				  <div class="form-group">
				  <button type="button" onclick="book_damage(this.value);" id="e_id" value=""  class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> Lost</button>
				  </div>
				</form>
				</div>
				</div>
			</div>
			<div class="modal-footer">
			  <button type="button" data-dismiss="modal" onclick="location.reload();"  class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Close</button>
			</div>
		  </div>
		  
		</div>
  </div>
				
<!-----------------------End Damage book----------------------->
						
		