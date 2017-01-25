

<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Edit Employee Vacancy
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Edit Employee Vacancy </li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="row">
                       <div class="col-md-10">
							
						<form  class="form-horizontal" role="form" action="index.php/employee_edit/edit_employee_vacancy_report" method="post" enctype="multipart/form-data">

						<?php
					
                               $id=$_GET['id'];
									$select=$this->db->select("*")
									->from("emp_vacancy")
									->where("vanid", $id)
									->get()
									->row();
									?>
						
						
						
						
						
						  <div class="form-group">
							<label class="control-label col-sm-2" for="email">Department Name</label>
							<div class="col-sm-4">
							   <input type="text" disabled class="form-control"  value="<?php echo $select->dept_name; ?>"  name="depts_name"> 
							</div>
							
							<label class="control-label col-sm-2" for="email">Present Employee</label>
							<div class="col-sm-4">
							  <input type="text" class="form-control"  value="<?php echo $select->precent_emp; ?>"  name="present_employee" > 
							</div>
							
						  </div>
						  <input type="hidden" name="id" value="<?php echo $id; ?>" />
						  
							 <div class="form-group">
								<label class="control-label col-sm-2" for="pwd">Need Employee</label>
								<div class="col-sm-4"> 
								 <input type="text" class="form-control" value="<?php echo $select->need_emp; ?>"  name="need_employee">
								</div>
								<label class="control-label col-sm-2" for="pwd"></label>
								<div class="col-sm-4">
							  
								</div>
							</div>
							
							
							
						  <div class="form-group"> 
							<div class="col-sm-offset-2 col-sm-10">
							 <button type="submit" class="btn btn-primary" name="submit" id="submit"><span class="glyphicon glyphicon-send"></span> Update</button> &nbsp;&nbsp;&nbsp;
							  <a href="index.php/employee_section/employee_vacancy"><button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-backward"></span> Back</button></a>
							</div>
						  </div>
						  
						</form>

							
						
					  </div>
					  
					  <div class="col-md-2"></div>
					  
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
			