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
                        Class Period Edit
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
<!-----------------------confirmation msg start-------------------------->	
						<?php $this->load->view('student_section/submit_confirm'); ?>
<!-----------------------confirmation msg End-------------------------->					
                    <div class="row">
                      <div class="col-md-12">
					   <form class="form-horizontal" role="form" action="student_submit/class_period_setting" method="post">
					  <table  class="table table-hover">
					  
						<tr>
							<td>
							<div class="form-group">

							  <div class="col-md-4">
								<center><label>Class Name</label></center>
								<input type="text" class="form-control" readonly value="<?php echo $period->class_name; ?>"  />
								<input type="hidden" name="perid" value="<?php echo $period->perid; ?>"/>
							  </div>
							
							   <div class="col-md-4">
								<center><label>Total Period</label></center>
								<input type="text" name="total_class" class="form-control" id="total_class" onkeypress="return isNumber(event);" value="<?php echo $period->maxclass; ?>" placeholder="Total Class" required/>
							    </div>
							
							   <div class="col-md-4">
								<center><label style="opacity:0;">nothing</label></center>
								<button type="submit" name="submit_edit"  value="ADD" class="btn btn-primary" data-toggle="tooltip" title="Update"><span class="glyphicon glyphicon-send"></span> Update</button>
								
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