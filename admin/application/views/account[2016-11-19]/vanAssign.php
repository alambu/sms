

<aside class="right-side">      <!---rightbar start here -->

<section class="content-header">
    <h1>
        Student Vahicles Assign 
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Student Vahicles Assign</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="box">
			<div class="box-body">
				<div class="col-md-11" style="min-height:50px;" id="hidemessage">
					<div class="alert alert-success" style="margin-top:5px;margin-bottom:5px;">
						<strong> Successfully!</strong>Your Data insert complete.
					</div>
				</div>
				
				<div class="table-responsive">
					<div class="row">					
                    	<div class="col-md-12">
						  <ul class="nav nav-tabs" id="myTab">
	
							<li><a href="#menu4" data-toggle="tab">Transport Setting</a></li>
							
							<li class="active"><a data-toggle="tab" href="#home">Student Assign</a></li>
							
							<li><a href="#menu2" data-toggle="tab">Report</a></li>

						  </ul>
		
						<div class="tab-content">
							<!--- Start Class Fee Category Form -->
							<div id="home" class="tab-pane fade in active">
							 <?php $this->load->view('account/studentAssign'); ?>
							</div>
	 						<!--- End Class Fee Category Form -->

	 						<!--- Start Class Fee Category Form -->
							<div id="menu2" class="tab-pane fade in">
								<?php $this->load->view('account/report/studentAssignReport'); ?>
							</div>
	 						<!--- End Class Fee Category Form -->
							
							<!--- Start Expense Category Form -->
							<div id="menu4" class="tab-pane fade"><br/>
								<?php $this->load->view('account/vahicleSetting'); ?>
							</div>
							 <!--- End Expense Category Form -->
							
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
</aside>