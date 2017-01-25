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
                        School Commitee
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
										
											<a data-toggle="tab" href="#entry_commitee"><span class="glyphicon glyphicon-list-alt"></span> Add Commitee Member</a>
										
										</li>
										<li>
										
											<a data-toggle="tab" href="#commitee_list"><span class="glyphicon glyphicon-user"></span> Commitee List</a>
										
										</li>
										
										
									</ul>
									
									<div class="tab-content">
									
										<div id="entry_commitee" class="tab-pane fade in active">
										<!------parrent entry start-------->
										<?php $this->load->view('other/commitee_entry_form'); ?>
										<!------parrent entry End---------->
										</div>
										
										<div id="commitee_list" class="tab-pane fade">
											<?php $this->load->view('other/commitee_list'); ?>
										</div>
										
										<div id="commitee_sms" class="tab-pane fade">
											<?php $this->load->view('other/commitee_sms'); ?>
										</div>
										
									</div>	
									
							    </div>	
						    </div>	
					   </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
		