	<?php
	$this->load->view('header');
	$this->load->view('leftbar');
	?>
	<aside class="right-side">      <!---rightbar start here --->
			   <!-- Content Header (Page header) -->
	<style type="text/css">
		input{
			text-transform:uppercase;
		}
		#myTab{
			margin-bottom:15px;
			font-size:15px;
		}
		
		
		
	</style>


		<section class="content-header">
			<h1>
			   Class Routine Setup
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
<!------------------confirmation message start----------------------->		
					<?php //$this->load->view('student_section/submit_confirm'); ?>
<!------------------confirmation message End------------------------->
						
							<ul class="nav nav-tabs" id="myTab">
								<li class="active"><a data-toggle="tab" href="#shidule"><span class="glyphicon glyphicon-home"></span> Class Schedule</a></li>
								
								<li><a data-toggle="tab" href="#period_sett"><span class="glyphicon glyphicon-calendar"></span> SetUp Class Period</a></li>
								
								<li><a data-toggle="tab" href="#cls_teacher_set"><span class="glyphicon glyphicon-user"></span> Class Teacher</a></li>
								
								<!---
								<li><a data-toggle="tab" href="#cls_teacher_list"><span class="glyphicon glyphicon-user"></span> Teacher List</a></li>--->
								
							</ul>

							<div class="tab-content">
							
								<!--------------------------------Schedule Setting Start------------------->
								<div id="shidule" class="tab-pane fade in active">
								 <?php $this->load->view("class_routine/shidule_setup"); ?> 
								</div>
								<!--------------------------------Schedule Setting Start------------------->
							
							
								<!--------------------------------Class Period Setting Start------------------->

								<div id="period_sett" class="tab-pane fade">
								<?php $this->load->view("class_routine/class_period_setup"); ?>
								</div>

								<!--------------------------------Class Period Setting End--------------------->
								
								<!------------------Class Teacher Setting Start-------------------------------->
								<div id="cls_teacher_set" class="tab-pane fade">
								<?php $this->load->view("class_routine/class_teacher_setup"); ?>	
								</div>
								<!-------------------Class Teacher Setting End---------------------------------->


								<!----------Class Teacher List Start---------------------------------->						
								<!---<div id="cls_teacher_list" class="tab-pane fade">
								<?php //$this->load->view("class_routine/class_teacher_list"); ?>
								</div>-->
								<!----------Class Teacher List End---------------------------------->

					
							</div>
						</div>
					</div>
				</div>
			</div>
		</section><!-- /.content -->
	</aside><!-- /.right-side -->     <!---rightbar close here ---->
<?php $this->load->view('footer'); ?>			