<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
		 <style>
		.error{
			border-color:red;
		}
	</style>            <!-- Content Header (Page header) -->
<?php

?>				
                <section class="content-header">
                    <h1>
                        Class Routine Edit
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<div class="container-fluid">
<!-----------------confirmation msg start--------------------------->
					<?php $this->load->view('student_section/submit_confirm'); ?>
<!-----------------confirmation msg End----------------------------->					
                    <div class="row">
                      <div class="col-md-12">
					   <form class="form-horizontal" role="form" action="student_submit/class_routine_setting" method="post">
					  <table  class="table table-hover">
					  
						<tr>
							<td>
							<div class="form-group">

							  <div class="col-md-2">
								<center><label>Shift Name</label></center>
								<input type="text" class="form-control" readonly name="" value="<?php echo $info->shift_N; ?>"  />
								<input type="hidden" name="shiftid" value="<?php echo $info->shiftid; ?>"/>
								<input type="hidden" name="up_id" value="<?php echo $info->id; ?>"/>
							  </div>
							  
							  <div class="col-md-3">
								<center><label>Class Name</label></center>
								<input type="text" class="form-control" readonly value="<?php echo $info->class_name; ?>"  />
								<input type="hidden" name="class_name" value="<?php echo $info->classid; ?>"/>
							  </div>
								<div class="col-md-3">
								<center><label>Class Start</label></center>
								<input type="time" name="stime" class="form-control" id="stime" value="<?php echo $info->stime; ?>" placeholder="Start Time" required/>
							    </div>
								
							   <div class="col-md-4">
								<center><label style="opacity:0;">nothing</label></center>
								<button type="submit" name="submit_edit"  value="ADD" class="btn btn-primary" data-toggle="tooltip" title="Update"><span class="glyphicon glyphicon-send"></span> Update</button>
								&nbsp;&nbsp;
								<a href="student_section/level_2_setting">
								<button type="button" class="btn btn-success" data-toggle="tooltip" title="Go Back"><span class="glyphicon glyphicon-backward"></span> Back</button>
								</a>
							   </div>
							  
							</div>
							</td>
						 </tr>
						<tr>
						<td>
						
						</td>
					    </tr>
                       					  
					  </table>
					  </form>
					  </div>
                    </div>

					</div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->