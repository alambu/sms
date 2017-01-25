		<?php $all_commitee=$this->db->get("manageing_commitee")->result(); ?>
		<script>
			function commitee_details(mid)
			{	//alert(mid);
				$.ajax({  
					 type: "POST",  
					 url: "index.php/userpanel/commitee_details",  
					 data: {mid:mid},
					 success: function(data) {
						// alert(data);
						document.getElementById("detail").innerHTML=data;
					 }
					});
			}
		</script>
		<div class="row">
			<div class="col-sm-12">
			<table id="example1" class="table table-bordered table-striped table-condensed">
				<thead>
					<tr>
						<th>Sl.No</th>
						<th>Name</th>
						<th>Designation</th>
						<th>Mobile No</th>
						<th>Email</th>
						<th>Picture</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $sfid=1;
					foreach($all_commitee as $value){
					?>
					<tr>
						<td><?php echo $sfid++; ?></td>
						<td><?php echo $value->name; ?></td>
						<td><?php echo $value->designation; ?></td>
						<td><?php echo $value->mobile; ?></td>
						<td><?php echo $value->email; ?></td>
						<td><img src="img/school_commitee/<?php echo $value->picture; ?>" height="50px" width="50px" class="img-thumbnil"/></td>
						<td>
							<button type="button" value="<?php echo $value->memberid; ?>" class="btn btn-success" data-toggle="modal" data-target="#edit_parent" onclick="commitee_details(this.value);">
							<span class="glyphicon glyphicon-th"></span>
							</button>
							&nbsp;
							<a href="userpanel/commitee_edit?id=<?php echo $value->memberid; ?>"><button type="button" class="btn btn-primary">
							<span class="glyphicon glyphicon-edit"></span>
							</button></a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			
			</table>
			</div>
		</div>

<div class="modal fade" id="edit_parent" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" data-dismiss="modal" class="close">&times;</button>
			  <h4 class="modal-title">Commitee Info</h4>
			</div>
			<div class="modal-body" id="detail">
				
			</div>
			<div class="modal-footer">
			  <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
			</div>
		  </div>
		  
		</div>
  </div>