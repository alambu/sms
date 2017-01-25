<?php 
$this->load->view('header');
  $this->load->view('leftbar');
?>
<aside class="right-side">      <!---rightbar start here --->
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

  
  function valid(){
	  var val=confirm('Are you really want to reject?');
	  if(val){
		  return true;
	  }
	  else {
		  return false;
	  }
  }
</script>

 <script type="text/javascript">
$(document).ready(function () {                
$('#sdate').datepicker({format: "dd-mm-yyyy"});
$('#edate').datepicker({format: "dd-mm-yyyy"});             
});
</script>

                <section class="content-header">
                    <h1>
                       Leave Approve or Reject Report
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Employee</li>
						<li class="active"> Leave Approve or Reject Report</li>
                    </ol>
                </section>
				
                <!-- Main content -->
                <section class="content">
				 <?php 
						$this->load->view("employee_section/successs");
					?>
					<div class="container-fluid">
					
					<div class="row">
                      <div class="col-md-12">

					   <form class="form-horizontal" role="form" action="index.php/employee_reports/leave_request_approve_search" method="post">
	
							<div class="form-group">								
							<div class="col-md-2">									  
								 <select  class="form-control" name="empids">
								      <option value="">--Emp Name--</option>
								        <?php 
										$select=$this->db->query("select empid,name from  empee");
									$fetch=$select->result();
										foreach($fetch as $values){
											?>											
											<option value="<?php echo $values->empid?>" <?php if($empid==$values->empid){echo 'Selected';}?>> 
												<?php echo $values->name.'('.$values->empid.')'?>
											</option>
										<?php	
										}
										?>  
							     </select>
								</div>
								<div class="col-md-2">									  
								 <select  class="form-control" name="leavctg">
								      <option value="">--Leave Catg--</option>
								        <?php 
										$selects=$this->db->query("select levid,lev_type from  emp_levtype");
									$fetchs=$selects->result();
										foreach($fetchs as $tvalue){
											?>											
											<option value="<?php echo $tvalue->levid?>" <?php if($levid==$tvalue->levid){echo 'Selected';}?>>
												<?php echo $tvalue->lev_type;?>
											</option>
										<?php	
										}
										?>  
							     </select>
								</div>
								<div class="col-md-2">
									 <select  class="form-control" name="status">
										  <option value="">--Status--</option>
										  <option value="1" <?php if($statu==1){echo 'Selected';}?>>Approve</option>
										  <option value="2" <?php if($statu==2){echo 'Selected';}?>>Reject</option>
									 </select>
								</div>
								
								<div class="col-md-2">
									<input type="text" class="form-control" name="sdate" id="sdate" placeholder="Start date"  value="<?php if(isset($_POST['submit'])){echo $this->input->post('sdate');} else{ echo date("d-m-Y");} ?>"/>
								</div>
								
								<div class="col-md-2">
									<input type="text" class="form-control" name="edate" id="edate" placeholder="End date" value="<?php if(isset($_POST['submit'])){echo $this->input->post('edate');} else{ echo date("d-m-Y");} ?>" />
								</div>

								<div class="col-md-2">
										<button type="submit" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span> Search</button>
								</div>
									 
										
									 
							</div>
					  </form>
					  </div>
					  
                    </div>
					
					
					
					
					
					
						
                    <div class="row">
                      <div class="col-md-12">
					    <div class="panel-body">
                                <div class="table-responsive">
                                   <table id="example1" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
									<th>Nr</th>
									<th>Employee Id</th>
									<th>Employee Name</th>
									<th>Leave Category</th>
									<th>Leave Start</th>								
									<th>Leave End</th>									
									<th>Message</th>
									<th>Date</th>
									<th>Approve/Reject</th>
									<th>Action</th>
									</tr>
								</thead>
								<tbody>
								
								
							<?php $nr=1;
							
					foreach($query as $value){
						
						?>
									
									<tr>
									<td><?php  echo $nr;?></td>
									<td><?php  echo $value->empid;?></td>
									<td><?php  echo $value->name;?></td>
									<td><?php  echo $value->lev_type;?></td>
									<td><?php  echo date('d-m-Y',strtotime($value->sdate));?></td>
									<td><?php  echo date('d-m-Y',strtotime($value->edate));?></td>
									<td><?php  echo $value->comment;?></td>
									<td><?php  echo  date('d-m-Y',strtotime($value->e_date));?></td>
									<td><?php   $st=$value->status; if($st==1){echo '<button class="btn btn-primary"> Approved</button>';}else{echo '<button class="btn btn-warning"> Rejected</button>';}?></td>
									<td>
									<?php
                                   $dates=$this->db->query("select e_date from emp_approved where e_date='$value->e_date'")->row()->e_date;
								   $m_date=date("Y-m-d",strtotime($dates));
								   
								   $today=date("Y-m-d");
								   
									if(($st==1)&& ($today==$m_date )){ ?>
									<a href="index.php/employee_reports/edit_leave_request_approve_report?id=<?php echo $value->reqid; ?> "><button class="btn btn-danger" onclick="return valid();"><span class="glyphicon glyphicon-remove"></span> &nbsp; Reject</button></a> &nbsp; 
									<?php }
                                    else{
										?>
										
										<button class="btn btn-danger" disabled onclick="return valid();"><span class="glyphicon glyphicon-remove"></span> &nbsp; Reject</button>
									<?php	
									}

									?>
									</td>
						<?php $nr++; } ?>
									</tr>
								</tbody>
								
							</table>
						</div>
						</div>
					  </div>
					  
					 
                    </div>
					

					</div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
			
			
<?php   $this->load->view('footer');?>		