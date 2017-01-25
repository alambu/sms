
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
                        Admission
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
										
											<a data-toggle="tab" href="#app_form_fee"><span class="glyphicon glyphicon-user"></span> Application Form Fee</a>
										
										</li>
										<li>
											<a data-toggle="tab" href="#admission_fee"><span class="glyphicon glyphicon-user"></span> Admission Fee</a>
										</li>
									</ul>
									
									<div class="tab-content">
									
										<div id="app_form_fee" class="tab-pane fade in active">
										<!------parrent entry start-------->
										<?php $this->load->view('admission/application_form_fee'); ?>
										<!------parrent entry End---------->
										</div>
										
										<div id="admission_fee" class="tab-pane fade">
										<!------parrent entry start-------->
										<?php $this->load->view('admission/admission_fee'); ?>
										<!------parrent entry End---------->
										</div>
										
									</div>	
									
							    </div>	
						    </div>	
					   </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
		