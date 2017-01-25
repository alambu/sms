
<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
<style>
.bold{
font-weight:bold;
font-size:17px;
}
.badge.badge-success {
background-color: #00a651;
color: #ffffff;
}
.badge.badge-danger{
background-color: #cc2424;
color: #ffffff;
}
</style>            <!-- Content Header (Page header) -->

<?php
if(isset($_GET['y'])){
	extract($_GET);
	$data=$this->db->query("select * from emp_attendance where month='$m' and emptypeid='$typ' and  atendate like '$y%'");
	$warking_day=$data->num_rows();
	$emp_info=$this->db->query("select a.*,b.emp_type from empee a,employee_catg b where a.deginition=b.ecatgid and a.empid='$emp'")->row();
}
?>
                <section class="content-header">
                    <h1>
                       Attendance Details
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>
				
                <!-- Main content -->
                <section class="content">
					<div class="container-fluid">
					<?php 
					$month=array('January'=>'01','February'=>'02','March'=>'03','April'=>'04','May'=>'05','June'=>'06','July'=>'07','August'=>'08','September'=>'09','October'=>'10','November'=>'11','December'=>'12');
					?>
                    <div class="row">
                      <div class="col-md-11">
					    <div class="box">
						<div class="box-header">
						   <center>
							<h2>Attendance Report</h2>
							<h3>Year: <?php echo $y; ?></h3>
							<h4>Month: <?php foreach($month as $key=>$val){ if($val==$m) { echo $key; } } ?></h4>
							<h5>Warking Days: <?php echo $warking_day; ?></h5>
							<img src="img/employee_image/<?php echo $emp_info->picture; ?>" height="100" width="100" class="img-responsive img-thambail"/>
							<p><b>Designation:</b><?php echo $emp_info->emp_type; ?></p>
						   </center>
						</div>
					    <div class="box-body">
                                <div class="table-responsive">	
									<table id="example1" class="table table-responsive table-condensed">
										<thead>
											<tr>
												<th>SL.No</th>
												<th>Date</th>
												<th>Day</th>
												<th>Attendance</th>
											</tr>
										</thead>
										<?php $i=1; foreach($data->result() as $value){
										?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td><span class="badge badge-success"><?php echo date("d-m-Y",strtotime($value->e_date)); ?></span></td>
												<td><?php echo date("D",strtotime($value->e_date)); ?></td>
												<?php $ex=explode(",",$value->empid); ?>
												<td><?php if(in_array($emp,$ex)) { echo "<span class='badge badge-success'>Present</span>"; } else {  echo "<span class='badge badge-danger'>Absent</span>"; } ?></td>
											</tr>
										<?php 
										} ?>
									</table>
									<center>
									<button type="button" class="btn btn-danger" onclick="window.close();"> Close</button>
									</center>
								</div>
						</div>
					  </div>
					  </div>
					 <div class="col-md-1">
					 
					 </div>
                    </div>
					

					</div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
<?php 
$this->load->view('footer');
?>			