
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
.badge.badge-danger{
background-color: #00ACD6;
color: #ffffff;
}
	
 </style>

	<section class="content-header">
		<h1>
			Students Certificate
			<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="box">
			<div class="box-body">
				<div class="box-body table-responsive">						
					<ul class="nav nav-tabs" id="myTab">
						<li class="active">
						<a data-toggle="tab" href="#id_card"><span class="glyphicon glyphicon-print
						"></span> ID Card Print</a>
						</li>
					
						<li>
						<a data-toggle="tab" href="#certificate"><span class="glyphicon glyphicon-print
						"></span> Certificate Print</a>
						</li>
					</ul>
					<div class="tab-content">
					
						<div id="id_card" class="tab-pane fade in active">
							<!----------TC/Testimonial Start-------------->	
							<?php $this->load->view('student_section/student_id_card'); ?>
							<!----------TC/Testimonial End---------------->	
						</div>
					
						<div id="certificate" class="tab-pane fade">
							<!----------TC/Testimonial Start-------------->	
							<?php $this->load->view('student_section/tc_testomonial'); ?>
							<!----------TC/Testimonial End---------------->	
						</div>
						
					</div>		
				</div>	
			</div>	
		</div>
	</section><!-- /.content -->
</aside><!-- /.right-side -->     <!---rightbar close here ---->
		