<?php 
// $this->load->view('header');
 //$this->load->view('leftbar');
?>
<!---<aside class="right-side">      rightbar start here 
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
  newwindow=window.open(url,'name','height=600,width=800,left=300,scrollbars=yes,top=50');
  if (window.focus) {newwindow.focus()}
  }
  function delete_confirm()
  {
	  var con=confirm("Are You Sure Resign?");
	  if(con==true) { return true; } else { return false; }
  }
</script>


 <script type="text/javascript">
$(document).ready(function (){                
$('#payment_date').datepicker({format: "dd-mm-yyyy"});
$('#end_date').datepicker({format: "dd-mm-yyyy"});
            
});
</script>
<?php
 extract($_POST); 
 if(isset($_GET['del']))
 {
	extract($_GET); 
	if($del==1)
	{
		echo "<script>alert('Resign Successfully');</script>";
	}
	elseif($del==0)
	{
		echo "<script>alert('Not Resign Successfully');</script>";
	}
 } 
?>		
		<div class="row">
			<div class="col-md-12">
				 <form class="form-horizontal" action="employee_section/employee_registration"  method="post">
					<div class="form-group">
						<div class="col-md-1">
							
						</div>
						<div class="col-md-3">
							<select  class="form-control" name="dept_name">
								  <option value="">Department Name</option>
									<?php 
									
									foreach($all_department as $value){
										?>											
										<option <?php if($value->edepid==$dept_name){ echo "selected"; } ?> value="<?php echo $value->edepid?>">
											<?php echo $value->manage_type;?>
										</option>
									<?php	
									}
									?>  
							</select>
						 </div>
						 
						  <div class="col-md-3">
							<select class="form-control" name="type">
								<option value="">Select Type</option>
								<option <?php if($type==1) { echo "selected"; } ?> value="1">Teacher</option>
								<option <?php if($type==2) { echo "selected"; } ?> value="2">Stuff</option>
							</select>
						  </div>
						 
						  <div class="col-md-3">
								<select  class="form-control" name="desig">
								  <option value="">Designation</option>
									<?php 
									foreach($all_designation as $value) {
										?>											
										<option <?php if($value->ecatgid==$desig){ echo "selected"; } ?> value="<?php echo $value->ecatgid?>">
											<?php echo $value->emp_type;?>
										</option>
									<?php	
									}
									?>  
							    </select>
						  </div>
						  
						 
						  <div class="col-md-2">
								<button type="submit" name="search_employee" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
						  </div>
			   
					</div>	
				</form>
			</div>
		</div>			
		</br>			
		<div class="row">
				<div class="col-md-12">
		            <table id="example1" class="table table-condensed table-bordered table-hover">
						<thead>
							<tr>
							<th>SL.NO</th>
							<th>Employee Name</th>
							<th>Nick Name</th>
							<th>Father Name</th>
							<th>Emp Type</th>
							<th>Department</th>
							<th>Designation</th>
							<th>Join Date</th>
							<th>Picture</th>
							<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$nr=1;$type1=array("1"=>"<span class='label label-info'>Teacher</span>","2"=>"<span class='label label-primary'>Stuff</span>");
							foreach($query as $value){
								//$dpcheck=$this->n->department_check($value->department);
							?>
							<tr>
								<td><?php echo $nr; ?></td>
								<td><?php echo $value->name; ?></td>
								<td><?php echo $value->nickN;?></td>
								<td><?php echo $value->fname; ?></td>
								<td><?php 
								echo $type1[$value->emptypeid];
								
								?></td>
								<td><?php echo $this->db->query("select manage_type from emp_depart_catg where edepid='$value->department'")->row()->manage_type; ?></td>
								<td><?php echo $this->db->query("select emp_type from employee_catg where ecatgid='$value->deginition'")->row()->emp_type; ?></td>
								<td><?php echo date("d-m-Y",strtotime ($value->join_date));?></td>
								
								<td>
								<img src="img/employee_image/<?php echo $value->picture; ?>" class="img-thumbnail" height="50px" width="50px"/>
								</td>
								<td>
								<div class="dropdown">
								  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Action
								  <span class="caret"></span></button>
								  <ul class="dropdown-menu">
								  <li>
								<a href="javascript:void(0)" onclick="details('index.php/employee_reports/employee_report_details?id=<?php echo $value->id ?> &nr=<?php echo $nr; ?>')"><span class="glyphicon glyphicon-list-alt"></span>Details</a>
								  </li>
								<li>
								<a href="index.php/employee_section/employee_edit?id=<?php echo $value->empid; ?> "><span class="glyphicon glyphicon-edit"></span>Edit</a>
								</li>
								<li>
								<a onclick="return delete_confirm();" href="index.php/employee_submit/employee_resign?id=<?php echo $value->empid; ?> "><span class="glyphicon glyphicon-remove"></span>Resign</a>
								</li>
								</ul>
								</div>
								</td>
							</tr>
							<?php $nr++; } ?>
						</tbody>
					
				    </table>
		  </div>
    </div>