<?php 
  //$this->load->view('header');
  //$this->load->view('leftbar');
?>
     <!---rightbar start here --->
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
$('#start_date').datepicker({format: "dd-mm-yyyy"});
$('#end_date').datepicker({format: "dd-mm-yyyy"});             
});
</script>

					
						   <form class="form-horizontal" role="form" action="employee_section/employee_rqst_leave_form"  method="post">
						   
								   <div class="form-group">
											   <div class="col-md-3">
												 <select  class="form-control" name="leavctg">
												  <option  value="">Leave Category</option>
												   <?php
													$select=$this->db->query("select * from  emp_levtype")->result();
													foreach($select as $value){
													?>
													<option style="text-align:left;" value="<?php echo $value->levid; ?>" <?php if($leavctg==$value->levid){echo 'selected';} ?> ><?php echo $value->lev_type;?></option>
												   <?php } ?>
												 </select>
											
											  </div>
											 
											
											  <div class="col-md-3">
											 <input type="text" class="form-control" id="start_date" name="start_date" value="<?php if(isset($_POST['submit'])){echo $this->input->post('start_date');} else{ echo date("d-m-Y");} ?>" placeholder="From" />
											  </div>
										
											 <div class="col-md-3">
											 <input type="text" class="form-control" id="end_date" name="end_date" value="<?php if(isset($_POST['submit'])){echo $this->input->post('end_date');} else{ echo date("d-m-Y");} ?>" placeholder="To" />
											 </div>
											  
											 <div class="col-md-3">							
											 <select class="form-control" name="status">
										
												<option  value="">Select Satus</option>
												 <option value="1" <?php if($status==1){echo 'selected';}?>>Approved</option>
												 <option value="2" <?php if($status==2){echo 'selected';}?>>Reject</option>
												 <option <?php if(isset($_POST['submit'])){ if($status==0){
													 
													 echo 'selected';
												 } }?> value="0" >Not show</option>
											 </select>
											 </div>
									</div>		  
									<div class="form-group">		  
											  <div class="col-md-4">
												<button type="submit" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span>   Search </button>
												
													<button type="reset" name="refresh" class="btn btn-warning"><span class="glyphicon glyphicon-refresh"></span>   Refresh </button>
											  </div>
										
									</div>  
							</form>
					
					    
                            <table id="example1" class="table table-condensed table-bordered table-hover">
								<thead>
									<tr>
									<th>Serial No</th>
									<th>Employee Name</th>
									<th>Leave Category</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Comment</th>
									<th>Date</th>
									<th>Status</th>									
									<th>Action</th>
									
									</tr>
								</thead>
								<tbody>
									<?php
									
									$nr=1;
									foreach($query as $values){
									?>
									<tr>
									<td><?php  echo $nr; ?></td>
									<td><?php echo $values->name.'('.$values->empid.')'?></td>
									<td><?php echo $values->lev_type?></td>
									<td><?php echo date("d-m-Y",strtotime ($values->sdate) );  ?> </td>
									<td><?php echo date("d-m-Y",strtotime ($values->edate) );  ?> </td>
							       <td><?php echo $values->comment; ?></td>
								   <td><?php  echo date("d-m-Y",strtotime ($values->e_date) ); ?></td>
							       <td><?php 
								         
										 $st=$values->show_status; 
										 $sapp=$values->status;
											if($st==1){
												if($sapp==1){
													echo '<button type="button" class="btn btn-primary">Approved</button>';
												}
												if($sapp==2){
													echo '<button type="button" class="btn btn-danger">Rejected</button>';
												}
											}
											else {
												echo '<button type="button" class="btn btn-warning">Not show</button>';
											}
										
								   ?></td>
							       
								 									
									<td>
									 <?php 
									if(($sapp==0)&&($st==0)){
									?>
									<a href="employee_reports/edit_employee_leave_report?id=<?php echo $values->reqid; ?>&name=<?php echo $values->name; ?>&empid=<?php echo $values->empid; ?>"><button class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span> &nbsp; Edit</button></a> &nbsp; 
									<?php
									}									
									else{
										
										echo '';
										
									}
									?>
									</td>
									<?php 
									
									
									  $nr++;
									}
                                   
									?>
									</tr>
								</tbody>
								
							</table>

