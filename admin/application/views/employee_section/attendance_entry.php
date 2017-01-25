				  
												<?php
												extract($_POST);
												?>
											  
					   <form class="form-horizontal" role="form" action="employee_section/employee_attendence" method="post">
													<div class="row" style="margin-top:20px;">
													<div class="col-md-12">
																
													<div class="form-group">
															<div class="control-label col-sm-2"><label  for="pwd">Employee Type</label></div>
															  <div class="col-md-6">
															  
															 <select  class="form-control" name="category_name" required>
																<option value="">Select Type</option>
																<option <?php if($category_name==1) { echo "selected"; } ?> value="1">Teacher</option>
																<option <?php if($category_name==2) { echo "selected"; } ?> value="2">Stuff</option>  
															 </select>
															  </div>
															  
															  
															  <div class="col-md-2">
																<button type="submit" name="submit" class="btn btn-primary">Attendance Sheet  <span class="glyphicon glyphicon-list-alt"></span></button>
															  </div>
													</div>
													</div>
													</div>
											   </form>
									  
												<?php
												if(isset($_POST['submit']))
												{
												$date=date("Y-m-d");
												extract($_POST);
												$today_attendance=$this->employee->day_attendance($date,$category_name);
												if(count($today_attendance)>0){
													?>
													<div class="row">
														<div class="col-md-12">
															<button class="btn btn-warning btn btn-block">
																<span class="glyphicon glyphicon-saved"> </span>
																<?php 
																$type=array("1"=>"Teacher","2"=>"Stuff");
																echo $type[$category_name];
																?> 
																Attendance Already Save
															</button>
														</div>
													</div>
												<?php 	
												}
												else {
												?>
												
												<div class="row">
													<div class="col-md-12">
														<form action="employee_submit/employee_attendence" method="post">
											
														<input type="hidden" class="form-control" name="attend_date"  value="<?php  echo $entry_date=date('Y-m-d '); ?>"/>
														
														<table id="" class="table table-bordered table-condensed table-hover">
												
															<thead>
																<tr>
																	<th>SL.No</th>
																	<th>ID</th>
																	<th>Name</th>
																	<th>Picture</th>
																	<th>Attendance</th>
																</tr>
															</thead>
															<tbody>
															<?php 
															
															$select=$this->employee->type_wise_employee($category_name);
															$i=1;
															foreach($select as $value){
															
															?>
															
															<tr>
																	<td><?php echo $i++; ?></td>
																	<td>
																	<?php echo $value->empid; ?>
																	<input type="hidden" name="employee_id[]" class="form-control"  value="<?php echo $value->empid; ?> " readonly="readonly">
																	</td>
																	<td><?php echo $value->name; ?></td>
																	<td><img src="img/employee_image/<?php echo $value->picture; ?>" style="height:50px;width:50px;" class="img-thumbnail" /></td>
																	<td>
																	<input type="checkbox" name="chk_box[]"  value="<?php  echo trim($value->empid); ?> " checked />
																	<input type="hidden" name="typ" value="<?php echo $category_name; ?>"/>
																	</td>
																	
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
															<input type="hidden" name="emptypeid" value="<?php echo $category_name; ?>"/>
															<button type="submit" name="submit" class="btn btn-primary">Save</button>
													</center>
													
												</div>
												
												</div>
										
											</form>


										<?php } } ?>