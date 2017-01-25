<script>

function ajax_request_clsid(emp_id){
      
     $.ajax({
      url: "index.php/employee_submit/ajax_request",
      type: "POST", 
      data:{emp_id:emp_id}, 
      success: function(data)
      {  
    
	 document.getElementById("presnt_salary").value=data;
      }          
      });
     }
	 
</script>

<script type="text/javascript">
$(document).ready(function () {                
$('#encre_date').datepicker({format: "dd/mm/yyyy"});

          
});
</script>



<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Employee Salary Increment 
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Employee Salary Increment </li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					
					
					
					
					
					
<div class="box">
<div class="box-body">
   
 					  
					  
					  <?php 
						$this->load->view("employee_section/success");
					  ?>
<div class="container-fluid">

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#leave_type" style="font-weight:bold;">New Increment </a></li>
	<li ><a data-toggle="tab" href="#all_type"  style="font-weight:bold;">All Increment List</a></li>
    <li><a data-toggle="tab" href="#report" style="font-weight:bold;">Report</a></li>
   
  </ul>

  <div class="tab-content">
    
    <div id="leave_type" class="tab-pane fade in active">
	    <div class="row" style="margin-top:40px;">
		 <div class="table-responsive">
    

            <div class="col-md-12">
			
				   <form  class="form-horizontal" role="form" action="index.php/employee_submit/employee_salary_increment" method="post" enctype="multipart/form-data">

						   <div class="form-group">
							<label class="control-label col-sm-2" for="email">Employee Name</label>
							<div class="col-sm-4">
							   <select  class="form-control" name="employee_name" required  onchange="ajax_request_clsid(this.value);" >
									<option style="text-align:center;" value="" >Please select</option>
								       <?php 
										$select=$this->db->query("select name, empid from  empee");
									$fetch=$select->result();
										foreach($fetch as $value){
											?>
											
											<option value="<?php  echo $value->empid;   ?>"><?php echo $value->name; ?> ( <?php    echo  $value->empid; ?> ) </option>
										<?php	
										}
										?>  
								  </select>
								  
								
									
								 
							</div>
							<label class="control-label col-sm-2" for="pwd">Present Salary</label>
								<div class="col-sm-4"> 
								<input type="text"  class="form-control" readonly name="present_salary"   id="presnt_salary" />
								</div>
						  </div>
						
						
						  <div class="form-group">
							<label class="control-label col-sm-2" for="email">New Salary</label>
							<div class="col-sm-4">
							  <input type="text" class="form-control" name="increment_salary" required id="increment_salary" placeholder="Enter Increment Salary" onkeypress="return isNumber(event);">
							</div>
							<label class="control-label col-sm-2" for="pwd">Date</label>
								<div class="col-sm-4"> 
								 <input type="text" class="form-control" id="encre_date" required name="increment_date" placeholder="Enter Increment Date">
								</div>
						  </div>
						  

							
						  <div class="form-group"> 
							<div class="col-sm-offset-2 col-sm-10">
							  <button type="submit" class="btn btn-primary" name="submit" id="submit"><span class="glyphicon glyphicon-send"></span> Submit</button> &nbsp;&nbsp;&nbsp;
							  <button type="reset" class="btn btn-warning"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
							</div>
						  </div>
						</form>	 			
						
			</div>
	     </div>
	    </div>			  
      
    </div>
	
	<div id="all_type" class="tab-pane fade">
          <div class="row" style="margin-top:40px;">
		     <div class="table-responsive">
                <div class="col-md-12">
					<table class="table" id="example1">
						<thead>
						   <tr>
							 <th>Sl No</th>
							 <th>Increment Salary</th>
							 <th>Entry Name</th>
							 <th>Action</th>
						   </tr>	
						</thead>
						
					   <tbody>
						  <?php $nr=1;
									foreach($query as $value){
									?>
									<tr>
									<td><?php //echo $nr; ?>sdfds</td>
									<td><?php //echo $value->type; ?>sdf</td>
									<td><?php //echo $value->e_user;?>sdf</td>
									<td>
									<button class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span>  Edit</button>  
									</td>
									<?php $nr++; } ?>
									</tr>
						 
						</tbody>
					</table>
				</div>	
		      </div>
		   </div>
    </div>
	
    <div id="report" class="tab-pane fade">
         <div class="row" style="margin-top:40px;">
		     <div class="table-responsive">
                <div class="col-md-12">
					<table class="table" id="example2">
						<thead>
							<th>Sl No</th>
							<th>Increment Salary</th>
							<th>Entry Name</th>
							
						</thead>
						
						<tbody>
						    <td></td>
						    <td></td>
						    <td></td>
						   
						</tbody>
					</table>
				</div>	
		      </div>
		   </div>
     </div>
    
  </div>
</div>
					  
</div>
</div>
					
					
			

                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
			
	