<?php 
$this->load->view('header');
$this->load->view('leftbar');
?>
<aside class="right-side">      <!---rightbar start here --->
    <style>
		.error{
			border-color:green;
		}
	</style>            <!-- Content Header (Page header) -->
	<script>
		function valid_stuid(stu_id){
			if(stu_id==''){document.getElementById('valid').innerHTML='';}
			else{
			$.ajax({
				url: "index.php/student_submit/valid_stuid",
				type: 'POST',	
				data:{stu_id:stu_id},	
				success: function(data)
				{		
					document.getElementById('valid').innerHTML=data;
				}          
				});
		}
		}
	</script>
	
                <section class="content-header">
                    <h1>
                        Student Log
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<div class="row">
						<div class="col-md-4">
							
						</div>
						<div class="col-md-4">
							<span id="valid"></span>
						</div>
						<div class="col-md-2">
						</div>
					</div>
					<?php 
					if(isset($_GET['id'])) {
					?>	
						<div class="box">
							<div class="box-body">
								<div class="row">
									<div class="col-md-12">
										<table id="example1" class="table table-bordered table-hover">
											<thead>
												<tr>
												<th>SL.NO</th>
												<th>Student ID</th>
												<th>Student Name</th>
												<th>Shift</th>
												<th>Class</th>
												<th>Section</th>
												<th>Roll No</th>
												<th>Session</th>
												<th>Readmission Date</th>
												</tr>
											</thead>
											
											<tbody>
											<?php $i=1;foreach($stu_log_pop as $value){ ?>
												<tr>
												<td><?php echo $i++; ?></td>
												<td><?php echo $value->stu_id;?></td>
												<td><?php echo $value->name;?></td>
												<td><?php echo $value->shift_N;?></td>
												<td><?php echo $value->class_name;?></td>
												<td><?php echo $value->section;?></td>
												<td><?php echo $value->roll_no;?></td>
												<td><?php echo $value->syear;?></td>
												<td><?php echo date("d-m-Y",strtotime($value->e_date));?></td>
												</tr>
											<?php } ?>
											<tr>
												<td colspan="9"><center><button type="button" class="btn btn-danger" onclick="window.close();" >Close</button></center></td>
											</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					<?php 		
					}
					?>
                    <div class="row">
                      <div class="col-md-12">
					  
					 <form class="form-horizontal" role="form" action="student_report/student_log" method="post">
						<div class="form-group" id="itemRows">
						  <label class="control-label col-sm-2" for="pwd">Student ID:</label>
						  <div class="col-sm-6" id="shak_id">
							
							<input type="text" name="stu_id" onkeypress="return isNumber(this.value);" onkeyUp="valid_stuid(this.value);" value="<?php if(isset($_POST['submit'])){ echo $this->input->post('stu_id'); } ?>"  class="form-control"  placeholder="Enter Student ID" required />
						  </div>
						  <div class="col-sm-2">          
							<button type="submit"  name="submit"  class="btn btn-info"><span class="glyphicon glyphicon-leaf"></span>  View Log </button>
						  </div>
						</div>
						
					  </form>			
						
					  </div>
					 
                    </div>
					
					<?php 
						if(isset($_POST['submit'])){
							$stu_id=$this->input->post('stu_id');
							$data=$this->report->student_log($stu_id);
							if($data==0){
								?>
								<div class="row">
								<div class="col-md-10">
								 <button class="btn btn-block btn btn-danger">! Sorry Student Not Found</button>
								</div>
								<div class="col-md-2">
								
								</div>
								</div>
							<?php 	
							}
							else {
								
								?>
								<div class="box">
									<div class="box-body">
								<div class="row">
									<div class="col-md-12">
										 
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered  table-hover">
								<thead>
									<tr>
									<th>Student ID</th>
									<th>Student Name</th>
									<th>Shift</th>
									<th>Class</th>
									<th>Section</th>
									<th>Roll No</th>
									<th>Session</th>
									<th>Readmission Date</th>
									</tr>
								</thead>
								<tbody>
									<?php
					
									$i=0;
									foreach($data as $cinfo){
										$shiftid=$this->db->query("select shiftid from regis_tbl where stu_id='$cinfo->stu_id'")->row()->shiftid;;							
									?>
									<tr <?php if($i==0){?> class="success" <?php } ?>>
									<td><?php echo $cinfo->stu_id; ?></td>
									<td><?php echo $this->db->query("select name from regis_tbl where stu_id='$cinfo->stu_id'")->row()->name;?></td>
									<td><?php echo $this->db->query("select shift_N from shift_catg where  shiftid='$shiftid'")->row()->shift_N;?></td>
									<td><?php echo $class_name=$this->db->query("select class_name from class_catg where classid='$cinfo->classid'")->row()->class_name;?></td>
									
									<td><?php echo $cinfo->section;?></td>
									<td><?php echo $cinfo->roll_no; ?></td>
									<td><?php echo $cinfo->syear; ?></td>
									<td><?php  echo date('d-m-Y',strtotime($cinfo->e_date));  if($i==0){?>  <b style="color:green;">  (Running)</b> <?php }?> </td>
									
									</tr>
									
									<?php $i++; } ?>
								</tbody>
								<tfoot>
								    
								</tfoot>
							</table>
						</div>
						</div>
						</div>
									</div>
								
								</div>
							<?php 	
							}
						}
					?>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
<?php $this->load->view('footer'); ?>	