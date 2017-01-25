<!------------------parrent form start----------------------->
	
	<?php extract($_GET); ?>
	<form class="form-horizontal" action="admission_section/student_registration" method="GET">
		<div class="row">
			<div class="col-md-12">
			<p><b style="color:green;">Before Student Registration You Must Be Create Guardian ID</b></p>
				<div class="form-group">
					
					<label class="control-label col-sm-2" for="email">Guardian Name</label>
					<div class="col-sm-4">
					  <input type="text" name="pname" class="form-control" id="pname" value="<?php echo $pname; ?>" placeholder="Enter Parrents Name" required>
					  <input type="hidden" name="appid" value="<?php echo $appid; ?>"/>
					</div>
					<label class="control-label col-sm-2" for="email">Phone</label>
					<div class="col-sm-4">
					  <input type="text" name="pphone" class="form-control" id="pphone" placeholder="Enter Phone No" value="<?php echo $pphone; ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="email">Email</label>
					<div class="col-sm-4">
					  <input type="text" value="<?php echo $pemail; ?>" class="form-control" name="pemail" id="pemail" placeholder="Enter Email" required>
					</div>
					<label class="control-label col-sm-2" for="email" style="opacity:0;">Parrent ID</label>
					<div class="col-sm-4">
					  <button type="submit" name="creat_pid" class="btn btn-success">Get Parrent ID</button>
					</div>
				</div>
			</div>
		</div>
	</form>
		<?php
		if(isset($_GET['creat_pid'])) {
			extract($_GET);
			$chk=$this->db->query("select * from father_login where email='$pemail' or phonen='$pphone'");
			$row=$this->db->affected_rows();
			if($row>0){
				echo "<span class='glyphicon glyphicon-ban-circle'style='color:red;'></span> <b style='font-size:15px;'> ! Sorry Parrent ID Already Created ID No:</b>"."<span style='color:blue;font-weight:bold;'>".$chk->row()->parentid."</span>";
			}
			else {
			$r=rand(1000,9000);
			$sparent=substr($r,0,4);
			$yparent=date("Y");
			$mparent=date("m");
			$parrentid=$yparent.$mparent.$sparent;
			$chk_id=$this->db->query("select * from father_login where parentid='$parrentid'");
			$chk_row=$this->db->affected_rows();
			if($chk_row==0){
				$e_date=date("Y-m-d h:i:a");
				$e_user=$this->session->userdata("userid");
				$data=array(
				'parentid'=>$parrentid,
				'pass'=>$parrentid,
				'name'=>$pname,
				'email'=>$pemail,
				'phonen'=>$pphone,
				'e_date'=>$e_date,
				'e_user'=>$e_user
				);
			$this->db->insert("father_login",$data);
			$in_chk=$this->db->affected_rows();
			if($in_chk>0){
			 echo "<p style=\"color:green;font-size:17px;\"><span class=\"glyphicon glyphicon-ok\"></span>Parrent ID is &nbsp;<span style='color:blue;'>".$parrentid."</span>&nbsp;</p>";
			}
			else {
				echo "Insert Faile";
			}
			}
			else {
				echo "<span class='glyphicon glyphicon-ban-circle'style='color:red;'></span> <b style='font-size:15px;'> ! Please Try Again </b>";
			}
			}	
		}
		?>
	
<!------------------parrent form End------------------------->


<!------------------Parrent List Start-------------------->
		</br>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-condensed table-striped">
					<tr class="active">
						<td><b style="text-align:left;font-size:16px;">Guardian List</b></td>
					</tr>
				
				</table>
			</div>
		</div>
		</br>
		<div class="row">
			<div class="col-sm-12">
			<table id="example1" class="table table-bordered table-striped table-condensed">
				<thead>
					<tr>
						<th>Sl.No</th>
						<th>Guardian ID</th>
						<th>Guardian Name</th>
						<th>Email</th>
						<th>Mobile No</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $sfid=1;
					foreach($all_parrent as $value){
					?>
					<tr>
						<td><?php echo $sfid++; ?></td>
						<td><span class="label label-primary"><?php echo $value->parentid; ?></span></td>
						<td><?php echo $value->name; ?></td>
						<td><?php echo $value->email; ?></td>
						<td><?php echo $value->phonen; ?></td>
						<td>
							<button type="button" class="btn btn-primary" onclick="upid.value=<?php echo $value->parentid; ?>;ugname.value='<?php echo $value->name; ?>';uemail.value='<?php echo $value->email; ?>';umobile.value='<?php echo $value->phonen; ?>'" data-toggle="modal" data-target="#edit_parent">
							<span class="glyphicon glyphicon-edit"></span>
							</button>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			
			</table>
			</div>
		</div>
<!------------------Parent List End------------------------>


<!-----------------------Start Edit calagory----------------------->	

<script>
$(document).ready(function(){
 $('#gurdian_form').submit(function() {
	 document.getElementById('edit_id').innerHTML = 'Updateing----';
	 document.getElementById('edit_id').disabled = 'disabled';
		$.post(
            "index.php/student_submit/guardian_edit",
            $("#gurdian_form").serialize(),
            function(data){
              if(data==1)
			  {
				 alert('Update Successfully');
				 document.getElementById('edit_id').disabled = false;
			  }	
			  else {
				alert(data);
				document.getElementById('edit_id').disabled = false;
			  }
			  document.getElementById('edit_id').innerHTML = 'Update';
		});
 return false;
 });
});


</script>
	<div class="modal fade" id="edit_parent" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" data-dismiss="modal" class="close">&times;</button>
			  <h4 class="modal-title">Guardian Edit</h4>
			</div>
			<div class="modal-body">
				<form  role="form" id="gurdian_form" action="student_submit/guardian_edit">
				
					<div class="form-group">
					  <label for="pwd">Guardian Name:</label>
					  <input type="text" class="form-control" name="ugname" id="ugname" placeholder="Enter Catagory">
					</div>
					<div class="form-group">
					  <label for="pwd">Email:</label>
					  <input type="text" class="form-control" name="uemail" id="uemail" placeholder="Enter Catagory">
					</div>
					<div class="form-group">
					  <label for="pwd">Mobile No:</label>
					  
					  <input type="hidden" class="form-control" name="upid" id="upid" placeholder="Enter Catagory">
					  <input type="text" class="form-control" name="umobile" id="umobile" placeholder="Enter Catagory">
					</div>
					<div class="form-group">
					  <button type="submit"  class="btn btn-primary" id="edit_id">Update</button>
					</div>
					
			    </form>
			</div>
			<div class="modal-footer">
			  <button type="button" data-dismiss="modal" class="btn btn-danger">Close</button>
			</div>
		  </div>
		  
		</div>
  </div>
				
<!-----------------------End Edit calagory----------------------->	