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
									<?php //$this->load->view('student_section/submit_confirm'); ?>
									<!------------------confirmation msg End------------------------->							
									<ul class="nav nav-tabs" id="myTab">
									
										<li class="active">
										
											<a data-toggle="tab" href="#parrent"><span class="glyphicon glyphicon-user"></span> Guardian Entry</a>
										
										</li>
									  
										<li>
											<a data-toggle="tab" href="#regis_form"><span class="glyphicon glyphicon-list-alt"></span> Registration</a>
										
										</li>
										
										<li>
											<!--<a data-toggle="tab" href="#re_admission_form"><span class="glyphicon glyphicon-bookmark
									"></span> Re-Admission</a>---->
										</li>
									
									
									</ul>
									
									<div class="tab-content">
									
										<div id="parrent" class="tab-pane fade in active">
										<!------parrent entry start-------->
										<?php $this->load->view('admission/parrent_entry'); ?>
										<!------parrent entry End---------->
										</div>
										
										
										<div id="regis_form" class="tab-pane fade">
										<!------Registration Form Start----------->		
										<?php $this->load->view('admission/registration_form'); ?>
										<!------Registration Form End--------->
										</div>
										
										
										<div id="re_admission_form" class="tab-pane fade">
										<!------Re-Admission Start------------------->	
										<?php //$this->load->view('student_section/re_admission'); ?>
										<!------Re-Admission End--------------------->
										</div>
										
									</div>	
									
							    </div>	
						    </div>	
					   </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
<?php $this->load->view('footer'); ?>			