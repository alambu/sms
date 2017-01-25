   <script type="text/javascript">
$(document).ready(function () {                
$('#birth_date').datepicker({format: "dd/mm/yyyy"});
$('#join_date').datepicker({format: "dd/mm/yyyy"});

          
});
</script>
   <aside class="right-side">   
                <section class="content-header">
                    <h1>
                      Edit Employee Salary Payment Report
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Employee</li>
						<li class="active">Edit Employee Salary Payment Report</li>
                    </ol>
                </section>
  
   
   <section class="content">
         <div class="row">
                       <div class="col-md-10">
							
						<form  class="form-horizontal" role="form" action="index.php/employee_edit/edit_employee_salary_report" method="post" enctype="multipart/form-data">
						
						
						 
<?php
						if(isset($_GET['id'])){
							$id=$_GET['id'];
							
							$select=$this->db->query("select empee.name,emp_salary_his.salary, emp_salary_his.month,emp_salary_his.empid,emp_salary_his.years,emp_salary_his.date
                                    FROM empee, emp_salary_his
                                    WHERE empee.empid='$id' and  emp_salary_his.empid='$id'  ")->row(); 
							
						}
                                    
								
									
							/*
									
									$select=$this->db->select("*")
									->from("empee")
									->where("id", $id)
									->get()
									->row();*/
									
									?>
									
					
						  <div class="form-group">
							<label class="control-label col-sm-2" for="">Employee Name</label>
							<div class="col-sm-4">
							  <input type="text" class="form-control" readonly="readonly" value="<?php  echo $select->name.'('.$select->empid.')'; ?> "    >
							</div>
							<label class="control-label col-sm-2" for="">Salary</label>
								<div class="col-sm-4">   
								  <input type="text" class="form-control"  value="<?php echo $select->salary;?>" name="salary" > 
								</div>
						  </div>
						  
						  
						  	  <div class="form-group">
							<label class="control-label col-sm-2" for="">Month</label>
							<div class="col-sm-4">
							  <input type="text" class="form-control"  readonly="readonly" value="<?php echo $select->month; ?> "    >
							</div>
						<label class="control-label col-sm-2" for="">Years</label>
								<div class="col-sm-4">   
								  <input type="text" class="form-control" readonly="readonly"  value="<?php echo  $select->years;?>"   > 
								</div>
						  </div>
						  
						    <div class="form-group">
								<label class="control-label col-sm-2" for="">Payment Date</label>
								<div class="col-sm-4">   
								  <input type="text" class="form-control" readonly="readonly"  value="<?php echo    date("d-m-Y",strtotime ( $select->date) );?>" > 
								</div>
							<label class="control-label col-sm-2" for=""></label>
								<div class="col-sm-4">   
								 
								</div>
						  </div>
						  
							<input type="hidden" name="id" value="<?php echo $id; ?>" />
						
							
							
						
							
						  <div class="form-group"> 
							<div class="col-sm-offset-2 col-sm-10">
							  <button type="submit" class="btn btn-primary" name="submit" id="submit" ><span class="glyphicon glyphicon-send"></span> Update</button> &nbsp;&nbsp;&nbsp;
							  <a href="index.php/employee_section/employee_salary_history"><button type="button" class="btn btn-warning"><span class=" 	glyphicon glyphicon-backward"></span> Back</button></a>
							</div>
						  </div>
						  
						  	
						</form>

							
						
					  </div>
					  <div class="col-md-2">
					  </div>
					  
					  
					
                    </div>


 </section>
</aside>
