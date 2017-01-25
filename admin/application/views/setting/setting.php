<aside class="right-side">      <!---rightbar start here -->
 <style type="text/css">
	
	#myTab{
		margin-bottom:15px;
		font-size:16px;
	}
	.error{
		border:1px solid red;
	}
	.badge.badge-success {
	background-color: #00a651;
	color: #ffffff;
	}
	
 </style>             <!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Setting
			<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol>
	</section>
	<section class="content">
		<div class="box">
			<div class="box-body">
				<div class="table-responsive">
					<div class="container-fluid">
					
					<!---confirmation msg start-->	
					<div id="confirmation" class="alert alert-success alert-dismissable" style="display:none;">
						<i class="fa fa-check"></i>
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<b>Data Save Successfully
					</div>
					<!---confirmation msg End-->								 
					 
					 
					<!---nav ul Start-->								 
															
						<ul class="nav nav-tabs" id="myTab">
							
							<li class="active"><a data-toggle="tab" href="#shift">Shift</a></li>
							<li><a data-toggle="tab" href="#group"></span> Group</a></li>
							<li><a data-toggle="tab" href="#cls">Class</a></li>
							<li><a data-toggle="tab" href="#subsetup">Subject Setup</a></li>
							<li><a data-toggle="tab" href="#subdeclar">Subject Distribute</a></li>	
							<li><a data-toggle="tab" href="#sub_list">Subject List</a></li>	
						</ul>
					<!---nav ul End-->
					
						<div class="tab-content">
							
							
																				
							<!---Shift Setting Start-->																						
								<div id="shift" class="tab-pane fade in active">

								<?php $this->load->view('setting/shift_setting'); ?>
								
								</div>
							<!-----Shift setting end----->


							<!---Group Setting Start-->											
								<div id="group" class="tab-pane fade">
								<?php $this->load->view('setting/group_setting'); ?>	
								</div>
							<!-----Group setting end----->


							<!--Class Setting Start-->
								<div id="cls" class="tab-pane fade">
								<?php $this->load->view('setting/class_setting'); ?>
								</div>		
							<!---Class Setting End-->


							<!--Subject Setting Start-->
								<div id="subsetup" class="tab-pane fade">
								<?php $this->load->view('setting/subject_setting'); ?>
								</div>		
							<!---Subject Setting End-->


							<!--Subject Define Start-->
								<div id="subdeclar" class="tab-pane fade">
								<?php $this->load->view('setting/subject_distribute'); ?>
								</div>		
							<!---Subject Defaine End-->
							
							
							<!--Subject Define Start-->
								<div id="sub_list" class="tab-pane fade">
								<?php $this->load->view('setting/subject_list'); ?>
								</div>		
							<!---Subject Defaine End-->

						</div>
					</div>
				</div>					
			</div>
		</div>
	</section>
</aside>
<?php 
$this->load->view('footer');
?>			