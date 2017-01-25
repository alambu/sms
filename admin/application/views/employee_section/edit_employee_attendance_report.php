  <script type="text/javascript">
$(document).ready(function () {                
$('#at_date').datepicker({format: "dd/mm/yyyy"});
//$('#end_date').datepicker({format: "dd/mm/yyyy"});

          
});
</script>


<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Edit Employee Attendance
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Edit Employee Attendance </li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="row">
                       <div class="col-md-10">
							
						<form  class="form-horizontal" role="form" action="index.php/employee_edit/edit_employee_attendance_report" method="post" enctype="multipart/form-data">

						<?php
					
                              $id=$_GET['id'];
									$select=$this->db->select("*")
									->from("emp_attendance")
									->where("empid", $id)
									->get()
									->row();
									?>
						
						
						
						
						
						  <div class="form-group">
							<label class="control-label col-sm-2" for="email">Department Name</label>
							<div class="col-sm-4">
							 <input type="text" class="form-control"  readonly="readonly" value="<?php  
                        $man=$this->db->query("select department from empee where empid='$select->empid ' ")->row()->department; 
										
										 echo $tan= $this->db->query("select manage_type from emp_depart_catg where edepid='$man' ")->row()->manage_type; 

							 ?>"  name="present_employee" > 
							</div>
							
							<label class="control-label col-sm-2" for="email">Employee Id</label>
							<div class="col-sm-4">
							  <input type="text" class="form-control" readonly="readonly"  value="<?php echo $select->empid; ?>"  name="present_employee" > 
							</div>
							
						  </div>
						  <input type="hidden" name="id" value="<?php echo $id; ?>" />
						  
						  
						  	 <div class="form-group">
								<label class="control-label col-sm-2" for="pwd">Employee Name</label>
								<div class="col-sm-4"> 
								 <input type="text" class="form-control" readonly="readonly" value="<?php echo $a=$this->db->query("select name from empee where empid='$select->empid' ")->row()->name;  ?>"  name="need_employee">
								</div>
								<label class="control-label col-sm-2" for="pwd">Month</label>
								<div class="col-sm-4">
							    <input type="text" class="form-control" value="<?php echo $select->month; ?>"  name="attend_month">
								</div>
							</div>
						  
						  
						  
							 <div class="form-group">
								<label class="control-label col-sm-2" for="pwd">Attend Date</label>
								<div class="col-sm-4"> 
								 <input type="date" class="form-control" id="at_date" value="<?php echo date("d-m-Y",strtotime ($select->atendate) ); ?>"  name="attend_date">
								</div>
								<label class="control-label col-sm-2" for="pwd">Attend Status</label>
								<div class="col-sm-4">
							    <input type="text" class="form-control" value="<?php echo $select->attend_status; ?>"  name="attend_status">
								</div>
							</div>
							

							
							
						  <div class="form-group"> 
							<div class="col-sm-offset-2 col-sm-10">
							 <button type="submit" class="btn btn-primary" name="submit" id="submit"><span class="glyphicon glyphicon-send"></span> Update</button> &nbsp;&nbsp;&nbsp;
							  <a href="index.php/employee_reports/employee_attendance_report"><button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-backward"></span> Back</button></a>
							</div>
						  </div>
						  
						</form>

							
						
					  </div>
					  
					  <div class="col-md-2"></div>
					  
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
			