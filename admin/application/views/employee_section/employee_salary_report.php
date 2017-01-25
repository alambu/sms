
<?php 
  //$this->load->view('header');
  //$this->load->view('leftbar');
?>
<!--<aside class="right-side">      -rightbar start here --->
                <!-- Content Header (Page header) -->
		 <style>
		.error{
			border-color:red;
		}
	</style>            <!-- Content Header (Page header) -->

<script type="text/javascript">



  var newwindow;
  function details(url)
  {
  newwindow=window.open(url,'name','height=370,width=650,left=500,scrollbars=yes,top=105');
  if (window.focus) {newwindow.focus()}
  }

</script>


 <script type="text/javascript">
$(document).ready(function () {                
$('#payment_date').datepicker({format: "dd-mm-yyyy"});
$('#end_date').datepicker({format: "dd-mm-yyyy"});
            
});
</script>

                <!--<section class="content-header">
                    <h1>
                      Employee Salary Payment Report
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Employee</li>
						<li class="active">Employee Salary Payment Report</li>
                    </ol>
                </section>-->
				
                <!-- Main content -->
      
					
					<div class="col-md-12">
						   <form class="form-horizontal" role="form" action="index.php/employee_section/employee_salary_history"  method="post">
								<div class="form-group">
								      
									  <div class="col-md-3">
									  <select  class="form-control" name="emp_name">
								      <option value="">Employee Name</option>
								        <?php 
										$select=$this->db->query("select *  from  empee where status='0'");
									$fetch=$select->result();
										foreach($fetch as $values){
											?>											
											<option value="<?php echo $values->empid?>" <?php if($empid==$values->empid){echo 'selected';}?>> 
												<?php echo $values->name.'('.$values->empid.')'?>
											</option>
										<?php	
										}
										?>  
										</select>
									  </div>
									  
									
									  <div class="col-md-3">
									 <input type="text" class="form-control" Placeholder="start pay Date" id="payment_date" name="start_date" value="<?php if(isset($_POST['submit'])){echo $this->input->post('start_date');} else{ echo date("d-m-Y");} ?>" />
									  </div>
									  
									  <div class="col-md-3">
									  <input type="text" class="form-control" Placeholder="end Pay Date" id="end_date" name="end_date" value="<?php if(isset($_POST['submit'])){echo $this->input->post('end_date');} else{ echo date("d-m-Y");} ?>" />
									  </div>
									  
									  <div class="col-md-3">
									  
										<button type="submit" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span>  Search</button>
				                       
										
									  </div>
									  
									 
									
									   
							</div>	
					
					
					
					</form>
					</div>
					
					
                    <div class="row">
                      <div class="col-md-12">
					    
                                   <table id="example1" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
									<th>Serial No</th>
									<th>Employee Name</th>
									<th>Payment Salary</th>
									<th>Month - Year</th>
									<th>Payment date</th>
									<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php $nr=1;
									foreach($query as $value){
									?>
									<tr>
									<td><?php  echo $nr; ?></td>
									<td><?php $name=$this->db->query("select  name from empee where empid='$value->empid'") ->row()->name;
									
									echo $name.'('.$value->empid.')';  
									?>
									</td>
									
							       <td><?php  echo $value->salary; ?></td>
									<td><?php echo $value->month; ?>- <?php echo $value->years; ?></td>
									<td><?php   echo date("d-m-Y",strtotime ($value->date) );?></td>
									
									<td>
									
									<a href="index.php/employee_reports/edit_employee_salary_report?id=<?php echo $value->empid; ?> "><button class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span> &nbsp; Edit</button></a> &nbsp; 
									
									
									
									
									</td>
									<?php $nr++; } ?>
									</tr>
								</tbody>
								
							</table>
					
					  </div>
					  
					 
                    </div>
					
