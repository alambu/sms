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
							<ul class="nav nav-tabs" id="myTab">
								<li class="active"><a data-toggle="tab" href="#create_routine"><span class="glyphicon glyphicon-home"></span> Create Routine</a></li>
								
								<li><a data-toggle="tab" href="#routine_edit"><span class="glyphicon glyphicon-edit"></span> Routine Edit</a></li>	
								<li><a data-toggle="tab" href="#routine_list"><span class="glyphicon glyphicon-calendar"></span> Routine List</a></li>	
							</ul>

							<div class="tab-content">
								<!--------------------------------Schedule Setting Start------------------->
								<div id="create_routine" class="tab-pane fade in active">
									<?php $this->load->view('class_routine/section_search'); ?> 
								</div>
								<!--------------------------------Schedule Setting Start------------------->
								
								
								<!--------------------------------Class Period Setting Start------------------->

								<div id="routine_list" class="tab-pane fade">
									<?php $this->load->view("class_routine/routine_list_form"); ?>
								</div>

								<!--------------------------------Class Period Setting End--------------------->
								
							
								<!--------------------------------Class Period Setting Start------------------->

								<div id="routine_edit" class="tab-pane fade">
								<?php $this->load->view('class_routine/section_search_edit'); ?>
								</div>

								<!--------------------------------Class Period Setting End--------------------->
							</div>
						</div>
					</div>
				</div>
			</div>
		</section><!-- /.content -->
	</aside><!-- /.right-side -->     <!---rightbar close here ---->
<?php $this->load->view('footer'); ?>			