<?php 
$this->load->view('header');
$this->load->view('leftbar');
?>
<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
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
                        Students
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
<!------------------confirmation msg start----------------------->
						<?php $this->load->view('student_section/submit_confirm'); ?>
<!------------------confirmation msg End------------------------->							
							<ul class="nav nav-tabs" id="myTab">
							  
							    <li class="active"><a data-toggle="tab" href="javascript:void(0);#student_list"><span class="glyphicon glyphicon-user
							"></span> Student List</a></li>
								<!--<li><a data-toggle="tab" href="#student_log"><span class="glyphicon glyphicon-book
							"></span> Student Log</a></li>---->
							
							</ul>
						<div class="tab-content">
					
					
							<div id="student_list" class="tab-pane fade in active">
							<!----------Student List Start---------------->	
							<?php $this->load->view('student_section/student_list'); ?>
							<!----------Student List End------------------>	
							</div>
							
							<!--<div id="student_log" class="tab-pane fade">
							<!--------Student Log End--------------------->
							<?php //$this->load->view('student_section/student_log_report'); ?>
							<!-------Student Log End---------------------->
							<!--</div>-->
					
							
						</div>		
		</div>	
	</div>	
</div>
	
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
<?php $this->load->view('footer'); ?>			