<aside class="right-side">      <!---rightbar start here --->

                <section class="content-header">
                    <h1>
                       Employee Attendance
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                         <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                         <li class="active">Employee Attendance</li>
                    </ol>
                </section>
				
			<section class="content">
			<div class="container-fluid">
					<div class="box">
						<div class="box-body">			
						<?php 
						$this->load->view("employee_section/success");
						?>	
						<ul class="nav nav-tabs" id="myTab">
						  <li class="active"><a data-toggle="tab" href="#emp_attendance" style="font-weight:bold;"><span class="glyphicon glyphicon-pencil"></span> Attendance Entry</a></li>
						  
						    <li><a data-toggle="tab" href="#emp_attendance_edit" style="font-weight:bold;"><span class="glyphicon glyphicon-edit"></span> Attendance Edit</a></li>
						<li><a data-toggle="tab" href="#today_aten_report" style="font-weight:bold;" ><span class="glyphicon glyphicon-screenshot"></span> Today Attendance</a></li>
						<li><a data-toggle="tab" href="#aten_report" style="font-weight:bold;" ><span class="glyphicon glyphicon-book"></span> Attendance History</a></li>
						</ul>

						<div class="tab-content">
						
						<!-------------------Attendance Sheet Start--------------------->

							<div id="emp_attendance" class="tab-pane fade in active">
							<?php $this->load->view("employee_section/attendance_entry"); ?>
							</div>
						<!-------------------Attendance Sheet End----------------------->
						
						
						<!-------------------Attendance Sheet Edit Start--------------------->
							<div id="emp_attendance_edit" class="tab-pane fade">
							<?php $this->load->view("employee_section/attendance_edit"); ?>
							</div>
						<!-------------------Attendance Sheet Edit  End--------------------->
						
						

						<!-----------Today Attendance Report Start----------------------->
							<div id="today_aten_report" class="tab-pane fade">	  
							   <?php $this->load->view('employee_section/today_attendance_report');?>		
							</div>
						<!-----------Today Attendance Report End-----------------------> 
						
						
						<!----------------Attendance Report Start------------------>
							<div id="aten_report" class="tab-pane fade">
							<?php $this->load->view("employee_section/attendance_history"); ?>	
							</div>
						<!----------------Attendance Report End------------------>

						</div> 

					</div>
				</div>
			</div>
		</section>
</aside>