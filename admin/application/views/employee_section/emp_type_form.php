<aside class="right-side">      <!---rightbar start here --->
    <style>
		.error{
			border-color:red;
		}
		input{
			text-transform:uppercase;
		}
	</style>            <!-- Content Header (Page header) -->
      
	<script type="text/javascript">
	
	</script>
	
	
	
                <section class="content-header">
                    <h1>
                        Setting
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i>Home</a></li>
                        <li class="active">Primary Setting</li>
                    </ol>
                </section>

				
				
				
                <!-- Main content -->
                <section class="content">
					<div class="container-fluid">                    
						<div class="box">
							<div class="box-body">
							<?php 
							$this->load->view("employee_section/success");
							?>
								  <ul class="nav nav-tabs" id="myTab">
								    <li class="active"><a data-toggle="tab" href="#tech_dept"  style="font-weight:bold;">Add Employee Department</a></li>
									<li><a data-toggle="tab" href="#designation"  style="font-weight:bold;">Add Employee Designation</a></li>
									<li><a data-toggle="tab" href="#emp_type" style="font-weight:bold;">Add Employee Type</a></li>
									<li><a data-toggle="tab" href="#leave_type" style="font-weight:bold;" >Add Leave Type</a></li>
								   
								  </ul>
						
								  <div class="tab-content">

								
									<div id="emp_type" class="tab-pane fade">
										<div class="row" style="margin-top:40px;">
									        <!---///emp_type form start here///--->
										    <div class="col-md-12">
													 <form class="form-horizontal"  action="employee_submit/employee_type_catg" method="post">
													 
														<div class="form-group" id="itemRows">
														  <label class="control-label col-sm-2" for="pwd">Employee Type:</label>
														  <div class="col-sm-6">          
															<input type="text" name="typ" required class="form-control" id="types" placeholder="Enter Employee Type"/>
														  </div>

															<div class="col-sm-4"> 
															  <button type="submit" name="submit"  class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Submit</button>
															</div>
														</div>
													</form>			
														
											</div>
										</div>	
											<!---/////emp type form close here////--->
											<br/>
											<table class="table">
												<tr class="active"><td>Employee Type List</td></tr>
											</table>
											<br/>
											
											<!---////emp type report start here////--->
											<div class="row">
												 <div class="col-md-12">
															
														<table id="example1" class="table  table-bordered table-hover table-condensed">
																<thead>
																	<tr>
																	<th>Serial No</th>
																	<th>Emp Type</th>
																	<th>Edit</th>
																	</tr>
																</thead>
																<tbody>
																<?php $nr=1;
																	foreach($info as $value){
																		 
																	?>
																	<tr>
																	<td><?php echo $nr; ?></td>
																	<td><?php echo strtoupper($value->type); ?></td>
																	<td>
																	<a href="employee_edit/employee_type_edit?id=<?php echo $value->emptypeid; ?>"
																	 <button class="btn btn-info" ><span class="glyphicon glyphicon-edit"></span></button>&nbsp;
																	</a>
																	</td>
																	
																	<?php $nr++; } ?>
																	</tr>
																</tbody>
																
														</table>
												 </div>
												 <!-----///emp type report close here///---->
										</div>			  
									  
									</div>
									
									<!----////designation form start here////-->
									
									<div id="designation" class="tab-pane fade">
										  <div class="row" style="margin-top:40px;">
											  <div class="table-responsive">
												<div class="col-md-12">
													  <form class="form-horizontal" action="employee_submit/employee_designation_catg" method="post" >
														<div class="form-group">
														  <div class="col-md-4">
															 <label>Designation:</label>
															<input type="text" name="desig" class="form-control" id="desig"  placeholder="Enter Designation Name" required />
														  </div>
														  
														  <div class="col-md-4"> 
															 <label>Need Employee:</label>
															<input type="number"  name="need" class="form-control" id="desig"  placeholder="Enter Number" required/>
														  </div>
														  <div class="col-md-4"> 
															 <label>Qualification:</label>
															<textarea class="form-control" name="quali" required>
															</textarea>
														  </div>
														</div>
														<div class="form-group">
														  <div class="col-md-4"> 
																<button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Submit</button>
														  </div>
														 
														</div>
														
													  </form>		
												</div>	
												</div>
											</div>	
												<!---////designation form close here--->
											<br/>
											<table class="table">
												<tr class="active"><td>Employee Designation List</td></tr>
											</table>
											<br/>
												
												<!---///designation report start here///--->
												<div class="row">	
													<div class="col-md-12">
														<table id="example3" class="table table-bordered table-hover table-condensed">
																<thead>
																	<tr>
																		<th>Serial No</th>
																		<th>Designation</th>
																		<th>Need Employee</th>
																		<th>Qualification</th>
																		<th>Edit</th>
																	</tr>
																</thead>
																<tbody>
																<?php $nr=1;
																	foreach($desig as $value){
																	?>
																	<tr>
																	<td><?php echo $nr; ?></td>
																	<td><?php echo $value->emp_type;?></td>
																	<td><?php echo $value->need_emp;?></td>
																	<td><?php echo $value->qualification;?></td>
																	<td>
																	<a href="employee_edit/employee_designation_catg?id=<?php echo $value->ecatgid; ?>">
																	<button class="btn btn-info" ><span class="glyphicon glyphicon-edit"></span></button>
																	</a>	&nbsp; 
									
																	</td>
																	
																	<?php $nr++; } ?>
																	</tr>
																</tbody>
																
															</table>
														</div>
													
													<!----///designation report close here---->
											  </div>
										  </div>
									
									
									
									<!----///Employee Department form start here////---->
									
									<div id="tech_dept" class="tab-pane fade in active">
									    <div class="row" style="margin-top:25px;">
											 <div class="col-md-12">
												 <form class="form-horizontal"action="employee_submit/employee_dep_catg" method="post">
													<div class="form-group">
													  <label class="control-label col-md-2" for="pwd">Department:</label>
													  <div class="col-md-6">          
														<input type="text" name="dept"  class="form-control" placeholder="Enter  Employee  Department" required/>
													  </div>
													  <div class="col-md-2">          
														<button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Submit</button>
													  </div>
													</div>
													
												  </form>			
												
											  </div>
											  
										</div>
									
									<!----///Employee Department form start here////---->
									
									<br/>
									<table class="table">
										<tr class="active"><td>Employee Department List</td></tr>
									</table>
									<br/>
									
									<!----///Employee Department Report Start hear////---->
									    <div class="row">
											<div class="col-md-12">
												<table id="example5" class="table table-bordered table-condensed table-hover">
													<thead>
														<tr>
															<td>SL.No</td>
															<td>Department Name</td>
															<td>Edit</td>
														</tr>
													</thead>
													<tbody>
														<?php 
															$dept=$this->db->get("emp_depart_catg")->result();
															$d=1;
															foreach($dept as $value){
														?>
														<tr>
															<td><?php echo $d++; ?></td>
															<td><?php echo $value->manage_type; ?></td>
															<td>
															<a href="employee_edit/employee_dep_catg?id=<?php echo $value->edepid; ?>">
															<button class="btn btn-info" ><span class="glyphicon glyphicon-edit"></span></button>
															</a>
															</a>
															</td>
														</tr>
													<?php } ?>
													</tbody>
												</table>
											</div>
										</div>
									<!----///Employee Department Report Start hear////---->
									</div>
									
									
									<!----///leave type form start here////---->
									<div id="leave_type" class="tab-pane fade">
										 <div class="row" style="margin-top:40px;">
												<div class="col-md-12">
													 <form  class="form-horizontal" action="employee_submit/employee_leave_type_form" method="post">
														  <div class="form-group">
															<label class="control-label col-sm-2" for="leave_type">Leave Type</label>
															<div class="col-sm-3">
															  <input type="text" class="form-control" id="leave_type" name="leave_type" required placeholder="Enter leave type" >
															</div>
															<label class="control-label col-sm-2" for="pwd">Maximum Leave</label>
																<div class="col-sm-3">
																   <input type="text" class="form-control" id="maximum_leave" name="max_leave" required placeholder="maximum leave number" onkeypress="return isNumber(this.event);">
																</div>
																<div class="col-sm-2"> 
																  <button type="submit" class="btn btn-primary" name="submit" id="submit"><span class="glyphicon glyphicon-send"></span> Submit</button>
																</div>
														  </div>
												 </form>	 		
												</div>	
												<!----///leave type form close here///--->
										</div>		
												
												<br/>
													<table class="table">
														<tr class="active"><td>Employee Leave Type List</td></tr>
													</table>
												<br/>
												
												
												<!----///leave type report start here///--->
												<div class="row">
													 <div class="col-md-12">
															<table id="example4" class="table  table-bordered table-condensed table-hover">
																<thead>
																	<tr>
																	<th>Serial No</th>
																	<th>Leave Type</th>
																	<th>Maximum Leave</th>
																	<th>Edit</th>
																	</tr>
																</thead>
																<tbody>
																<?php $nr=1;
																	foreach($leave_type as $value){
																	?>
																	<tr>
																	<td><?php echo $nr; ?></td>
																	<td><?php echo $value->lev_type;?></td>
																	<td><?php echo $value->	max_lev;?></td>
																	
																	<td>
																	<a href="employee_edit/employee_leave_type_edit?id=<?php echo $value->levid; ?>">
																	<button class="btn btn-info" ><span class="glyphicon glyphicon-edit"></span></button> </a>&nbsp; 
									
																	</td>
																	
																	<?php $nr++; } ?>
																	</tr>
																</tbody>
																
															</table>
														
													 </div>
													 
													<!----///leave type report close here////----> 
										   </div>
									</div>
									
								  </div>
						  
						</div> 
					</div>
				</div>	
            </section><!-- /.content -->
        </aside><!-- /.right-side -->     <!---rightbar close here ---->
