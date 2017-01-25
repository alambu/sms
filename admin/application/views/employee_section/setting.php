<aside class="right-side">      <!---rightbar start here --->
    <style>
		.error{
			border-color:red;
		}
		input{
			text-transform:uppercase;
		}
	</style>            <!-- Content Header (Page header) -->
      
	<script type="text/javascript">
	function delete_confirm()
	{
		var con=confirm("Are You Sure?");
		if(con==true) { return true; } else { return false; }
	}
	</script>
<?php 
if(isset($_GET['del'])){
extract($_GET);
if($del==1)
{
	echo "<script>alert('Delete Successfully');</script>";
}
elseif($del==0) 
{
	echo "<script>alert('Sorry Already Use');</script>";
}
}	
?>
	
	
	
                <section class="content-header">
                    <h1>
                        Setting
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i>Home</a></li>
                        <li class="active">Primary Setting</li>
                    </ol>
                </section>

				
				
				
                <!-- Main content -->
                <section class="content">
					<div class="container-fluid"> 
						<!---confirmation msg start-->	
					<div id="confirmation" class="alert alert-success alert-dismissable" style="display:none;">
						<i class="fa fa-check"></i>
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<b>Data Save Successfully
					</div>
					<!---confirmation msg End-->
						<div class="box">
							<div class="box-body">
								  <ul class="nav nav-tabs" id="myTab">
								    <li class="active"><a data-toggle="tab" href="#tech_dept"  style="font-weight:bold;">Add Employee Department</a></li>
									<li><a data-toggle="tab" href="#designation"  style="font-weight:bold;">Add Employee Designation</a></li>
									<!--<li><a data-toggle="tab" href="#emp_type" style="font-weight:bold;">Add Employee Type</a></li>--->
									<li><a data-toggle="tab" href="#leave_type" style="font-weight:bold;" >Add Leave Type</a></li>
								   
								  </ul>
						
								  <div class="tab-content">

									<!----- Employee Type entry start---->
									<div id="emp_type" class="tab-pane fade">
									<?php //$this->load->view("employee_section/employee_type_entry"); ?>	
									</div>
									<!----- Employee Type entry start---->
									
									
									<!----////designation form start here////-->
									
									<div id="designation" class="tab-pane fade">
									<?php $this->load->view("employee_section/employee_designation_entry"); ?>	  
									</div>
									
									<!----////designation form End here////-->
									
									
									<!----///Employee Department form start here////---->
									
									<div id="tech_dept" class="tab-pane fade in active">
									 <?php $this->load->view("employee_section/employee_department_entry"); ?>
									</div>
									
									<!----///Employee Department form End here////---->
									
									
									<!----///leave type form start here////---->
									<div id="leave_type" class="tab-pane fade">
									<?php $this->load->view("employee_section/employee_leave_type_entry"); ?>
									</div>
									<!----///leave type form End here////---->
									
								  </div>
						  
						</div> 
					</div>
				</div>	
            </section><!-- /.content -->
        </aside><!-- /.right-side -->     <!---rightbar close here ---->
