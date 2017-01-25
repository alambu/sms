<?php 
$this->load->view('header');
$this->load->view('leftbar');
?>


            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                 
                <section class="content-header">
                    <h1>
                       Employee Registration
                         <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Employee Registration Form</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
				<div class="container-fluid">
					<div class="box">
						<div class="box-body">
						
						<!---confirmation msg start-->	
					<div id="confirmation" class="alert alert-success alert-dismissable" style="display:none;">
						<i class="fa fa-check"></i>
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<b>Data Save Successfully
					</div>
					<!---confirmation msg End-->
						    <ul class="nav nav-tabs" id="myTab">
								<li class="active"><a data-toggle="tab" href="#new_emp" style="font-weight:bold;"><span class="glyphicon glyphicon-list-alt"></span> Employee Registration</a></li>
								<li ><a data-toggle="tab" href="#all_type" style="font-weight:bold;"><span class="glyphicon glyphicon-user"></span> Employee List</a></li>
								<li><a data-toggle="tab" href="#resign" style="font-weight:bold;"><span class="glyphicon glyphicon-move"></span> Resign Employee</a></li>
						    </ul>
						
						
						  <div class="tab-content">
<!-------------------Add Employee Start heare---------------->							
							<div id="new_emp" class="tab-pane fade in active">
								<?php $this->load->view("employee_section/registration_form"); ?>
							</div>
							
<!-----------------add employee end here---------------->

<!-----------------All employee List Start here---------------->
							
							
							<div id="all_type" class="tab-pane fade">
							<?php $this->load->view("employee_section/employee_list"); ?>		  
							</div>
<!-----------------All employee List End here---------------->



<!-----------------All Resign employee List Start here---------------->	
							
							<div id="resign" class="tab-pane fade">
							<?php $this->load->view("employee_section/resign_employee_list"); ?>					
							</div>
<!-----------------All Resign employee List End here---------------->							
							
				</div>
            </div>				  
		</div>
    </div>


 </section>
 </aside><!-- /.right-side -->
			
			
			
	
 <?php 
  $this->load->view('footer');
 ?>