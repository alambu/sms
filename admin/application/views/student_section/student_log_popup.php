<?php 

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
					<?php 
					if(isset($_GET['id'])) {
					?>	
					<div class="container-fluid">
						<div class="box">
							<div class="box-body">
								<div class="row">
									<div class="col-md-12">
										<table  class="table table-bordered table-hover">
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
												<tr <?php if($i==1){ echo "class='success'"; } ?>>
												<td><?php echo $i++; ?></td>
												<td><?php echo $value->stu_id;?></td>
												<td><?php echo $value->name;?></td>
												<td><?php echo $value->shift_N;?></td>
												<td><?php echo $value->class_name;?></td>
												<td><?php echo $this->bsetting->ge_section($value->section)->section_name;?></td>
												<td><?php echo $value->roll_no;?></td>
												<td><?php echo $value->syear;?></td>
												<td><?php echo date("d-m-Y",strtotime($value->e_date));?> (Running---)</td>
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
					</div>	
					<?php 		
					}
					?>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
	