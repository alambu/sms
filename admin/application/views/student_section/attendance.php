<?php 
$this->load->view('header');
$this->load->view('leftbar');
?>
<aside class="right-side">
 <style type="text/css">
	input{
		text-transform:;
	}
	#myTab{
		margin-bottom:15px;
		font-size:18px;
	}
	.error{
		border:1px solid red;
	}
	.badge.badge-success {
		background-color: #00a651;
		color: #ffffff;
	}
	
	.badge.badge-info {
		background-color: #31B0D5;
		color: #ffffff;
	}
	
	.badge.badge-danger {
		background-color: #800000;
		color: #ffffff;
	}
	
 </style>
<script>
$("document").ready(function(){
		$("#sdate,#edate").datepicker({format: 'dd-mm-yyyy'
	});
	});
</script>
                <section class="content-header">
                    <h1>
                        Student Attendance
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<div class="container-fluid">
						<div class="box">
							<div class="box-body">
								<div class="table-responsive">
<!--------------Confirmation msg start---------------------------->
								<?php $this->load->view('student_section/submit_confirm'); ?>
<!--------------Confirmation msg End------------------------------>								
									<ul class="nav nav-tabs" id="myTab">
									  <li class="active"><a data-toggle="tab" href="#attendance"><span class="glyphicon glyphicon-pencil"></span>Attendance Entry</a></li>
									  <li>
										<a data-toggle="tab" href="#today_attendance"><span class="glyphicon glyphicon-screenshot"></span> Today Attendance</a>
									  </li>
									  <li><a data-toggle="tab" href="#atte_report"><span class="glyphicon glyphicon-list-alt"></span> Attendance Report</a></li>
									</ul>
									
									<div class="tab-content">		
										<!----------Start Attendance Report---------------------->
													
										<div id="atte_report" class="tab-pane fade">
										<?php $this->load->view("student_section/attendance_report"); ?>									
										</div>
										<!----------End Attendance Report---------------------->
										
										
										<!--------------Attendance Entry Start------------------------------>	
											
										<div id="attendance" class="tab-pane fade in active">
										<?php $this->load->view('student_section/attendance_entry'); ?>					
										</div>
												
										<!--------------Attendance Entry End------------------------------>			

										
										<!--------------Daily Attendance Report Start------------------------------>

											
										<div id="today_attendance" class="tab-pane fade">
										
											
											<?php $this->load->view("student_section/today_attendance"); ?>
										</div>

										<!--------------Daily Attendance Report End------------------------------>
									</div>	
								</div>	
							</div>	
						</div>
					</div>	
				</section><!-- /.content -->
			</aside><!-- /.right-side -->     <!---rightbar close here ---->
<?php 
$this->load->view('footer');
?>			