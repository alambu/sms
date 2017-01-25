							<?php 
							extract($_POST);
							?>
							<!-------Search Form start------------>
							 <form class="form-horizontal" action="employee_section/employee_attendence" method="post">
												<div class="row" style="margin-top:20px;">
													<div class="col-md-12">		
														<div class="form-group">
																<div class="control-label col-sm-2"><label  for="pwd">Employee Type</label></div>
																  <div class="col-md-6">
																  
																 <select  class="form-control" name="category_name_edit" required>
																  <option value="">Select Type</option>
																<option <?php if($category_name_edit==1) { echo "selected"; } ?> value="1">Teacher</option>
																<option <?php if($category_name_edit==2) { echo "selected"; } ?> value="2">Stuff</option> 
																 </select>
																  </div>
																  
																  
																  <div class="col-md-2">
																	<button type="submit" name="submit_edit" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> Attendance Sheet</button>
																  </div>
														</div>
													</div>
												</div>
											</form>
							<!-------Search Form End-------------->
							
							
							<!-------Edit Sheet Start -------------->
								<?php 
								if(isset($_POST['submit_edit'])){
								    $date=date("Y-m-d");
									extract($_POST);
									$today_attendance=$this->employee->day_attendance($date,$category_name_edit);
									if(count($today_attendance)>0){
								 ?>
								<form class="form-horizontal" action="employee_submit/employee_attendence_edit" method="post"> 
								<div class="row">
								<div class="col-md-12">
								<table id="" class="table table-bordered table-condensed">
									<thead>
										<tr>
										<th>Serial No</th>
										<th>Employee Id</th>
										<th>Employee Name</th>
										<th>Picture</th>
										<th>Attendance</th>
										
										</tr>
									</thead>
									<tbody>
								<?php 
								 $present=$today_attendance;
								 $att_id=$today_attendance->eattenid;
								 $pEmp=array();
								 //// all present id
								 $test=explode(",",$present->empid);
								 $pEmp=array_merge($pEmp,$test);
								 
								 $allEm=$this->employee->type_wise_employee($category_name_edit);
								 ?>
								<?php 
								$i=0;
								foreach($allEm as $amp){
								$i++;
								?>	
										<tr>
											<td><?php echo $i; ?>
											<input type="hidden" name="employee_id[]" class="form-control"  value="<?php echo $amp->empid; ?>">
											</td>
											<td><?php echo $amp->empid; ?></td>
											<td><?php echo $amp->name; ?></td>
											<td><img src="img/employee_image/<?php echo $amp->picture; ?>" height="50px;" width="50px" class="img-thumbnail"/></td>
											<td><input type="checkbox" name="chk_box[]" value="<?php echo $amp->empid; ?>" <?php if(in_array($amp->empid,$pEmp)){echo "checked";} else {echo 'unchecked';} ?> /></td>
											
										</tr>
							    <?php 	
								}
								?>  
								    </tbody>
								</table>
								</div>
								</div>
								</br>
								<div class="row">
									<div class="col-md-12">
										<center>
											<input type="hidden" name="emptypeid" value="<?php echo trim($category_name); ?>"/>
											<input type="hidden" name="att_id" value="<?php echo trim($att_id); ?>"/>
											<button type="submit" name="submit_edit" class="btn btn-primary">Update</button>
										</center>
									</div>
								</div>
								</form>
								<?php
								}
								else {
								?>
								<center><h3>Attendance Not Found Today</h3></center>
								<?php	
								}
								}
								?>
							
							<!-------Edit Sheet End-------------->