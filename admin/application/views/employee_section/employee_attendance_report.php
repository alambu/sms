<!--<aside class="right-side">-->      <!---rightbar start here -->
                <!-- Content Header (Page header) -->
 <style>
.error{
	border-color:red;
}

h3,h4{text-align:center;}
.badge.badge-success {
background-color: #00a651;
color: #ffffff;
}
.badge.badge-danger{
background-color: #cc2424;
color: #ffffff;
}

.badge.badge-info{
background-color: #00ACD6;
color: #ffffff;
}

</style>            <!-- Content Header (Page header) -->

<script type="text/javascript">
  var newwindow;
  function details(url)
  {
  newwindow=window.open(url,'name','height=370,width=650,left=500,scrollbars=yes,top=105');
  if (window.focus) {newwindow.focus()}
  }

$(document).ready(function () {                
$('#dSearch').datepicker({format: "yyyy-mm-dd"});
       
});
</script>
				
					<div class="row" style="margin-top:20px;">
					 
                      <div class="col-md-12">
					  
						<?php
							$cid=$_POST['category_name'];
							if(isset($_POST['submit'])){
								$cid=$_POST['category_name'];
								
							} 	
						?>
					  
					   <form class="form-horizontal" role="form" action="index.php/employee_section/employee_attendence" method="post">			
							<div class="form-group">
									<div class="col-md-1">
										
									</div>
									<div class="col-md-4">
										<select  class="form-control" name="category_name">
											<option value="">Employee Type</option>
											<?php 
											 $select=$this->db->query("select * from  emp_type");
										$fetch=$select->result();
											foreach($fetch as $value){ 
												?>
												
												<option value="<?php   echo $value->emptypeid;  ?>" <?php if($value->emptypeid==$cid){echo 'selected';} ?> ><?php echo strtoupper($value->type); ?></option>
											<?php	
											}
											?>  
									    </select>
									</div>
									  
									  
									<div class="col-md-4">
									
									<input type="text" name="dSearch" id="dSearch" class="form-control" placeholder="Attendance Date" value="<?php if(isset($_POST['go'])){echo $this->input->post('dSearch');} else{ echo date("Y-m-d");} ?>"/>
									
									</div>
										
										
									<div class="col-md-2">
										<button type="submit" name="go" class="btn btn-info" value="" /><span class="glyphicon glyphicon-search"></span>   Search</button>
									</div>
								
							</div>
							
					  </form>
					  </div>
					  
                    </div>
			
						
                    <div class="row">
						<div class="col-md-4">
							<table class="table table-condensed table-bordered table-hover">
								<tr class="success">
									<th>Emp.Type</th>
									<th>Total</th>
									<th>Present</th>
									<th>Absent</th>
									<th>Persentis</th>
								</tr>
								<?php
								$d=date("Y-m-d");
								$teach_id=$this->db->query("select emptypeid from emp_type where type='teacher'")->row()->emptypeid;
								
								$stuff_id=$this->db->query("select emptypeid from emp_type where type='stuff'")->row()->emptypeid;
								
								$total_teacher=$this->db->query("select count(id) as total_tech from empee where emptypeid='$teach_id' and status='0'")->row()->total_tech;
								
								$total_stuff=$this->db->query("select count(id) as total_stuf from empee where emptypeid='$stuff_id' and status='0'")->row()->total_stuf;
								
								$pre_teach=$this->db->query("select * from emp_attendance where emptypeid='$teach_id' and atendate='$d'")->row();
								
								$pre_stuf=$this->db->query("select * from emp_attendance where emptypeid='$stuff_id' and atendate='$d'")->row();
								
								$present_teacher=$pre_teach->empid;
								$present_stuff=$pre_stuf->empid;
								
								if($present_teacher==''){
									$pt=0;
								}
								else {
									$ex_pt=explode(",",$present_teacher);
									$pt=count($ex_pt);
								}
								if($present_stuff==''){
									//$ex_ps=0;
									$ps=0;
								}
								else {
									$ex_ps=explode(",",$present_stuff);
									$ps=count($ex_ps);
								}
								
								?>
								<tr>
									<td>Teacher</td>
									<td><?php echo $total_teacher; ?></td>
									<td><?php echo $pt; ?></td>
									<td><?php echo $a=$total_teacher-$pt; ?></td>
									<td><?php echo $per=round(($pt*100)/$total_teacher);  ?>%</td>
								</tr>
								
								<tr>
									<td>Stuff</td>
									<td><?php echo $total_stuff; ?></td>
									<td><?php echo $ps; ?></td>
									<td><?php echo $a=$total_stuff-$ps; ?></td>
									<td><?php echo $per=round(($ps*100)/$total_stuff);  ?>%</td>
								</tr>
							</table>
						</div>
                      <div class="col-md-4">
					    
								<h3>Today Attendance</h3>
								<?php 
								$search=$this->input->post('dSearch');
									if(empty($search)&&!empty(dEmpS)) {
										$tid=$this->input->post('category_name');
										
										$et=$this->db->select("*")->from("emp_type")->where("emptypeid",$tid)->get()->row();
										
										echo "<h4>All ".ucfirst($et->type)."</h4>";
										
                        		   if(date('d-m-Y',strtotime($tid))){echo '<h4><center><b><u>'. date('d-m-Y').'</u></b></center></h4>'; }




									}
								else if(!empty($search) && !empty(dSearch)){
										$tid=$this->input->post('category_name');
										
										$et=$this->db->select("*")->from("emp_type")->where("emptypeid",$tid)->get()->row();
										
										echo "<h4>All ".ucfirst($et->type)."</h4>";
										
                        		  
								echo '<h4><center><b><u>'. date('d-m-Y',strtotime($search)).'</u></b></center></h4>';

										
								}
									
								else
								{
								echo "<h4>All Employee</h4>";
								}
								?>
					
						</div>	
						<div class="col-md-4">
						</div>
					</div>
					
					<div class="row">
					
                      <div class="col-md-12">	
                            <table id="example1" class="table table-bordered table-condensed">
								<thead>
									<tr>
									<th>Serial No</th>
									<th>Employee Id</th>
									<th>Employee Name</th>
									<th>Employee Type</th>
									<th>Picture</th>
									<th>Attendance</th>
									</tr>
								</thead>
								<tbody>
								
								
							<?php 
							
							if(isset($_POST[go])){
								extract($_POST);
					 if(!empty($category_name)&&empty($dSearch)) {
						 $category_name=$this->input->post('category_name');
						 $date=date("Y-m-d");
						 $emType=$this->db->select("*")->from("emp_type")->where("emptypeid",
						 $category_name)->get()->row();
						 
						
						 $present=$this->db->query("select * from emp_attendance where 	atendate='$date'")->result();
						 
						 $pEmp=array();
						 foreach($present as $p){
							//// all present id
							$test=explode(",",$p->empid);
							$pEmp=array_merge($pEmp,$test);
						 }
						 $allEm=$this->db->query("select * from empee where  emptypeid='$category_name' and status='0'")->result();
						 
						}
						
						
						elseif(!empty($category_name)&&!empty($dSearch)){
							$category_name=$this->input->post('category_name');
						 
						 $date=date("Y-m-d");
						 $emType=$this->db->select("*")->from("emp_type")->where("emptypeid",
						 $category_name)->get()->row();
						 
						
						 $present=$this->db->query("select * from emp_attendance where 	atendate='$dSearch'")->result();
						 
						 $pEmp=array();
						 foreach($present as $p){
							//// all present id
							$test=explode(",",$p->empid);
							$pEmp=array_merge($pEmp,$test);
						 }
						 $allEm=$this->db->query("select * from empee where  emptypeid='$category_name' and status='0'")->result();
						}
						
						
						elseif(empty($category_name)&&!empty($dSearch)){
							
							// all employee
							$allEmp=$this->db->select("*")->from("empee")->where("status","0")->get()->result();
							
							// all today present employee
							
							$tPresent=$this->db->query("select * from emp_attendance where 	atendate='$dSearch'")->result();
							
							$pEmp=array();
							foreach($tPresent as $p){
								// all present id
								$test=explode(",",$p->empid);
								$pEmp=array_merge($pEmp,$test);
							}
							 // increment id
							 $si=0;
							 
							 
							foreach($allEmp as $ae){
								$si++;
								$eTy=$this->db->select("*")->from("emp_type")->where("emptypeid",$ae->emptypeid)->get()->row();
						?>
						
							<tr>
								<td><?php echo $si; ?></td>
								<td><?php echo $ae->empid; ?></td>
								<td><?php echo $ae->name; ?></td>
								<td><span class='badge badge-info'><?php echo $eTy->type; ?></span></td>
								<td><img src="img/employee_image/<?php echo $ae->picture; ?>" height="50px" width="50px" class="img-thumbnail"/></td>
								<td>
									<?php if(in_array($ae->empid,$pEmp)){echo "<span class='badge badge-success'>Present</span>";} else {echo "<span class='badge badge-danger'>Absent</span>";} ?> 
								</td>
								
							</tr>
						
						<?php
							}
						}
						
						
						 //date wise search///
                       		
						
						
								$i=0;
								foreach($allEm as $amp){
									$i++;
										?>	
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $amp->empid; ?></td>
											<td><?php echo $amp->name; ?></td>
											<td><span class='badge badge-info'><?php echo $emType->type; ?></span></td>
											<td><img src="img/employee_image/<?php echo $amp->picture; ?>" height="50" width="50" class="img-thumbnail"/></td>
											<td><?php if(in_array($amp->empid,$pEmp)){ echo "<span class='badge badge-success'>Present</span>";} else { echo "<span class='badge badge-danger'>Absent</span>";} ?></td>
											
										</tr>
										<?php 	
								}
						
						
						}
					
						
						else{
							
							// all employee
							$allEmp=$this->db->select("*")->from("empee")->where("status","0")->order_by("emptypeid","asc")->get()->result();
							
							// all today present employee
							$date=date("Y-m-d");
							$tPresent=$this->db->query("select * from emp_attendance where 	atendate='$date'")->result();
							
							$pEmp=array();
							foreach($tPresent as $p){
								// all present id
								$test=explode(",",$p->empid);
								$pEmp=array_merge($pEmp,$test);
							}
							 // increment id
							 $si=0;
							 
							 
							foreach($allEmp as $ae){
								$si++;
								$eTy=$this->db->select("*")->from("emp_type")->where("emptypeid",$ae->emptypeid)->get()->row();
						?>
						
							<tr>
								<td><?php echo $si; ?></td>
								<td><?php echo $ae->empid; ?></td>
								<td><?php echo $ae->name; ?></td>
								<td><span class='badge badge-info'><?php echo $eTy->type; ?></span></td>
								<td><img src="img/employee_image/<?php echo $ae->picture; ?>" style="height:50px;width:50px;" class="img-thumbnail"/></td>
								<td>
									<?php if(in_array($ae->empid,$pEmp)){echo "<span class='badge badge-success'>Present</span>";} else {echo "<span class='badge badge-danger'>Absent</span>";} ?> 
								</td>
								
							</tr>
						
						<?php
							}
							
						}

						?>
									
								</tbody>
								
							</table>
						
						</div>
					  </div>

					


          <!-- </aside>  /.right-side -->     <!---rightbar close here ---->
			
		