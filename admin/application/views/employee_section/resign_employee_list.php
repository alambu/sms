					</br>
					<?php extract($_POST); ?>
					    <!----search form start------->
					<div class="row">
							<div class="col-md-12">
								 <form class="form-horizontal" action="employee_section/employee_registration"  method="post">
									<div class="form-group">
										<div class="col-md-1"></div>
										<div class="col-md-3">
											<select  class="form-control" name="dept_name_re">
												  <option value="">Department Name</option>
													<?php 
													foreach($all_department as $value){
														?>											
														<option <?php if($value->edepid==$dept_name_re){ echo "selected"; } ?> value="<?php echo $value->edepid?>">
															<?php echo $value->manage_type;?>
														</option>
													<?php	
													}
													?>  
											</select>
										 </div>
										 
										  <div class="col-md-3">
											<select  class="form-control" name="type_re">
												<option value="">Select Type</option>
												<option <?php if($type==1) { echo "selected"; } ?> value="1">Teacher</option>
												<option <?php if($type==2) { echo "selected"; } ?> value="2">Stuff</option>    
											</select>
										  </div>
										 
										  <div class="col-md-3">
												<select  class="form-control" name="desig_re">
												  <option value="">Designation</option>
													<?php
													foreach($all_designation as $value){
														?>											
														<option <?php if($value->ecatgid==$desig_re){ echo "selected"; } ?> value="<?php echo $value->ecatgid?>">
															<?php echo $value->emp_type;?>
														</option>
													<?php	
													}
													?>  
												</select>
										  </div>
										  
										 
										  <div class="col-md-2">
												<button type="submit" name="search_employee_re" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
										  </div>
							   
									</div>	
								</form>
							</div>
						</div>
						</br>
					    <!----search form End--------->
			<!-----------start report heare------------------->
									<?php 
									  $data=array();
									  if(isset($_POST['search_employee_re'])){
										extract($_POST);//desig dept_name type
										if(empty($desig_re) && empty($dept_name_re) && empty($type_re)){
										$where=array('status'=>0);
										}
										elseif(empty($desig) && empty($dept_name)){
											//echo "type";
											$where=array(
											'status'=>0,
											'emptypeid'=>$type_re
											);
										}
										elseif(empty($type_re) && empty($desig_re)){
											$where=array(
											'status'=>0,
											'department'=>$dept_name_re
											);
										}
										elseif(empty($type_re) && empty($dept_name_re)){
											$where=array(
											'status'=>0,
											'deginition'=>$desig_re
											);
										}
										elseif(empty($type_re)){
											$where=array(
											'status'=>0,
											'department'=>$dept_name_re,
											'deginition'=>$desig_re
											);
										}
										elseif(empty($desig_re)){
											$where=array(
											'status'=>0,
											'department'=>$dept_name_re,
											'emptypeid'=>$type_re
											);
										}
										elseif(empty($dept_name_re)){
											$where=array(
											'status'=>0,
											'emptypeid'=>$type_re,
											'deginition'=>$desig_re
											);
										}
										else {
										$where=array(
											'status'=>0,
											'department'=>$dept_name_re,
											'emptypeid'=>$type_re,
											'deginition'=>$desig_re
											);
										}
										$query_re=$this->employee->employee_list($where);
									  }
									  else { 
									    $where=array("status"=>0);
									    $query_re=$this->employee->employee_list($where);
									  }
									?>
<script>
function re_join_confirm(){
	con=confirm("Are You Sure Re-Join?");
	if(con==true){ return true; }
	else { return false; }
}
</script>									
						
					<table id="example3" class="table table-condensed table-bordered table-hover">
						<thead>
							<tr>
							<th>SL.NO</th>
							<th>Employee Name</th>
							<th>Nick Name</th>
							<th>Emp Type</th>
							<th>Department</th>
							<th>Designation</th>
							<th>Join Date</th>
							<th>Resign Date</th>
							<th>Picture</th>
							<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$sl=1;$type1=array("1"=>"<span class='label label-info'>Teacher</span>","2"=>"<span class='label label-primary'>Stuff</span>");
							foreach($query_re as $value){
							?>
							<tr>
								<td><?php echo $sl++; ?></td>
								<td><?php echo $value->name; ?></td>
								<td><?php echo $value->nickN;?></td>
								
								<td>
								<?php 
								echo $type1[$value->emptypeid];
								?>
								</td>
								<td><?php echo $this->db->query("select manage_type from emp_depart_catg where edepid='$value->department'")->row()->manage_type; ?></td>
								<td><?php echo $this->db->query("select emp_type from employee_catg where ecatgid='$value->deginition'")->row()->emp_type; ?></td>
								<td><?php echo date("d-m-Y",strtotime ($value->join_date));?></td>
								<td><?php echo date("d-m-Y",strtotime ($value->resign_date));?></td>
								<td>
								<?php //if($value->status==1){echo '<button class="btn btn-danger"> In-Active</button>';}else{echo '<button class="btn btn-primary"> Active</button>';}?>
								<img src="img/employee_image/<?php echo $value->picture; ?>" class="img-thumbnail" height="50px" width="50px"/>
								</td>
								<td>
								
								<div class="dropdown">
								  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Action
								  <span class="caret"></span></button>
								  <ul class="dropdown-menu">
									<li><a href="javascript:void(0)" onclick="details('employee_reports/employee_report_details?id=<?php echo $value->id ?> &nr=<?php echo $nr; ?>')"><span class="glyphicon glyphicon-list-alt"></span>Details</a></li>
									
								  </ul>
								</div>
								
								</td>
							</tr>
							<?php $nr++; } ?>
						</tbody>
					
				    </table>
			<!-----------End report heare--------------------->	