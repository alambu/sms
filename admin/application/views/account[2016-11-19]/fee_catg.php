<aside class="right-side">      <!---rightbar start here -->

<section class="content-header">
    <h1>
        General Setting 
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
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
							
							<li class="active"><a data-toggle="tab" href="#home">Fees Category</a></li>
							
							<li><a href="#menu2" data-toggle="tab">Income Category</a></li>
							
							<li><a href="#menu3" data-toggle="tab">Expense Category</a></li>

						  </ul>
		
						<div class="tab-content">
		
		 					<!--- Start Class Fee Category Form -->
							<div id="home" class="tab-pane fade in active"><br/>
							 <?php $this->load->view('account/classFeesCatg'); ?>
							</div>
	 						<!--- End Class Fee Category Form -->
	 
	 
							 <!--- Start Income Category Form -->
							<div id="menu2" class="tab-pane fade"><br/>
								<?php $this->load->view('account/income_catg'); ?>
							</div>
							 <!--- End Income Category Form -->
	 
							<!--- Start Expense Category Form -->
							<div id="menu3" class="tab-pane fade"><br/>
								<?php $this->load->view('account/expanseCategory'); ?>
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