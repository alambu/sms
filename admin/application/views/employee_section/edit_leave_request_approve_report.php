

<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
		 <style>
		.error{
			border-color:red;
		}
	</style>            <!-- Content Header (Page header) -->

<script type="text/javascript">
  var newwindow;
  function details(url)
  {
  newwindow=window.open(url,'name','height=370,width=650,left=500,scrollbars=yes,top=105');
  if (window.focus) {newwindow.focus()}
  }

</script>

 <script type="text/javascript">
$(document).ready(function () {                
$('#sdate').datepicker({format: "dd-mm-yyyy"});
$('#edate').datepicker({format: "dd-mm-yyyy"});             
});
</script>

                <section class="content-header">
                    <h1>
                      Edit Leave Approve or Reject Report
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Employee</li>
						<li class="active">Edit Leave Approve or Reject Report</li>
                    </ol>
                </section>
				
                <!-- Main content -->
                <section class="content">
				 <?php 
						$this->load->view("employee_section/successs");
					?>
					<div class="container-fluid">
		
                    <div class="row">
                      <div class="col-md-12">
					    <div class="panel-body">
                                <div class="table-responsive">
                                   <table id="example1" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
									<th>Nr</th>
									<th>Employee Id</th>
									<th>Employee Name</th>
									<th>Leave Category</th>
									<th>Leave Start</th>									
									<th>Leave End</th>									
									<th>Message</th>
									<th>Status</th>
									<th>Action</th>
									</tr>
								</thead>
								<tbody>
								
								
							<?php $nr=1;
					foreach($query as $value){
						
						?>
									
									<tr>
									<td><?php  echo $nr;?></td>
									<td><?php  echo $value->empid;?></td>
									<td><?php  echo $value->name;?></td>
									<td><?php  echo $value->lev_type;?></td>
									<td><?php  echo date('d-m-Y',strtotime($value->sdate));?></td>
									<td><?php  echo date('d-m-Y',strtotime($value->edate));?></td>
									<td><?php  echo $value->comment;?></td>
									
									
									
									<td>
									
									<button type="button" name="reject" class="btn btn-danger" onclick="return rejectemp(req<?php echo $nr?>.value,empid<?php echo $nr?>.value,sdates<?php echo $nr?>.value,edates<?php echo $nr?>.value)"><span class="glyphicon glyphicon-remove"></span> Reject</button>

									</td>
						<?php $nr++; }?>
									</tr>
								</tbody>
								
							</table>
						</div>
						</div>
					  </div>
					  
					 
                    </div>
					

					</div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
			
			
	