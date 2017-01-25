<!-------form start------>
								<br/>
								<?php extract($_POST); ?>
								<form action="employee_section/employee_attendence" method="post" class="form-horizontal">
									<div class="form-group">
										  <div class="col-md-5">
											<label  for="pwd">Employee Name</label>
											 <select  class="form-control" name="emp_name" required>
											  <option value="">Please Select</option>
												<?php 
												$type=array("1"=>"Teacher","2"=>"Stuff");
												$where=array("status"=>1);
												$allEmp=$this->employee->employee_list($where);
												foreach($allEmp as $value){
													?>
													
													<option value="<?php   echo $value->empid;  ?>" <?php if(isset($_POST['submit_report'])){if($value->empid==$emp_name){echo "selected";}} ?> ><?php echo $value->name; ?> (<?php echo $type[$value->emptypeid]; ?>)</option>
												<?php	
												}
												?>  
											 </select>
										  </div>
										  <div class="col-md-4">
											<label  for="pwd">Year</label>
											<?php 
											$py=date("Y");
											$sy=date("Y")-10;
											?>
											<select name="ryear" class="form-control">
												<?php for($py;$py>=$sy;$py--){ ?>
												<option <?php if(isset($_POST['submit_report'])){ if($py==$ryear){ echo "selected"; } } ?> value="<?php echo $py; ?>"><?php echo $py; ?></option>
												<?php } ?>
											</select>
										  </div>
										  
										  <div class="col-md-3">
											<button type="submit" name="submit_report" style="margin-top:23px;" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> Search</button>
										  </div>
									</div>
								</form>
								<!-------form End------>
								
								<script type="text/javascript">

								  var newwindow;
								  function attendance_details(url)
								  {
								  newwindow=window.open(url,'name','height=600,width=800,left=300,scrollbars=yes,top=20');
								  if (window.focus) {newwindow.focus()}
								  } 
								 
								</script>
								
								<?php 
								if(isset($_POST['submit_report'])){
									extract($_POST);
									$emp_info=$this->employee->employee_info($emp_name);
								?>
								<div class="row">
									<div class="col-md-4">
									</div>
									<div class="col-md-4">
										<center>
											<img src="img/employee_image/<?php echo $emp_info->picture; ?>" class="img-thumbnail img-responsive" style="height:100px;width:100px;"/>
											<p><b>Name:</b><?php echo $emp_info->name; ?></p>
											<p style="line-height:10px;"><b>Designation:</b><?php echo $emp_info->emp_type;?></p>
										</center>
									</div>
									<div class="col-md-4">
									</div>
								</div>
								<div class="panel-group" id="accordion">
								<?php 
								$month=array('January'=>'01','February'=>'02','March'=>'03','April'=>'04','May'=>'05','June'=>'06','July'=>'07','August'=>'08','September'=>'09','October'=>'10','November'=>'11','December'=>'12');
								foreach($month as $key=>$val){
								?>
								<div class="panel panel-info">
									<div class="panel-heading">
									  <h4 class="panel-title" style="text-align:left;">
										<a data-toggle="collapse" style="display:block;" data-parent="#accordion" href="#<?php echo $key; ?>">
										<?php echo $key; ?>
										</a>
									  </h4>
									</div>
									<div id="<?php echo $key; ?>" class="panel-collapse collapse">
									  <div class="panel-body">
										<?php 
										$emptype=$emp_info->emptypeid;
										$total_days=$this->db->query("select * from emp_attendance where month='$val' and emptypeid='$emptype' and  atendate like '$ryear%'");
										$row=$this->db->affected_rows();
										if($row>0){
										$p=0;	
										foreach($total_days->result() as $value){
											$ex=explode(",",$value->empid);
											if(in_array($emp_name,$ex))	{
												$p++;
											}
										}	
										?>
										<table class="table table-condensed">
											<tr class="active" style="line-height:30px;">
												<th>Total Warking Days</th>
												<th>Present</th>
												<th>Absent</th>
												<th>Persentis</th>
												<th>Details</th>
												
											</tr>
											<tr>
												<td><?php echo $row; ?></td>
												<td><?php echo $p; ?></td>
												<td><?php echo $a=$row-$p; ?></td>
												<?php $per=round(($p/$row)*100); ?>
												<td>
													<div class="progress">
													  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $per; ?>"
													  aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $per; ?>%">
														<?php echo $per; ?>% Complete
													  </div>
													</div>
												</td>
												<td><a href="javascript:void(0);" onclick="attendance_details('employee_reports/attendance_details?y=<?php echo $ryear; ?>&m=<?php echo $val; ?>&emp=<?php echo $emp_name; ?>&typ=<?php echo $emptype; ?>');"><span class="badge badge-info">Details</span></a></td>
											</tr>
										</table>
										<?php 
										}
										else {
											
										?>	
										<h3 style="color:red;"><span class="glyphicon glyphicon-ban-circle"></span> Attendance Not Found</h3>
										<?php 
										}
										?>
										
									  </div>
									</div>
								</div>
								<?php } ?>  
								</div>
								<?php 
								}
								?>
								
								
								