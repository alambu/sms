<script>
function only_chareter(v){
 if((event.keyCode==32) && (v=='')){
	return false;
 }
 else if ((event.keyCode > 64 && event.keyCode < 91) || (event.keyCode > 96 && event.keyCode < 123) || event.keyCode == 8 || event.keyCode==32)
 {
	return true;
 }	
else
   {
 
   return false;
}
}
</script>

<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Employee Leave Type Form
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Employee Leave Type Form</li>
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
    <li class="active"><a data-toggle="tab" href="#leave_type" style="font-weight:bold;">Add Leave Type</a></li>
	<li ><a data-toggle="tab" href="#all_type"  style="font-weight:bold;">All Leave Type List</a></li>
    <li><a data-toggle="tab" href="#report" style="font-weight:bold;">Report</a></li>
   
  </ul>

  <div class="tab-content">
    
    <div id="leave_type" class="tab-pane fade in active">
	    <div class="row" style="margin-top:40px;">
		 <div class="table-responsive">
    

            <div class="col-md-12">
			
				   <form  class="form-horizontal" role="form" action="index.php/employee_submit/employee_leave_type_form" method="post" enctype="multipart/form-data">

						
						  <div class="form-group">
							<label class="control-label col-sm-2" for="leave_type">Leave Type</label>
							<div class="col-sm-4">
							  <input type="text" class="form-control" id="leave_type" name="leave_type" required placeholder="Enter leave type" style="text-transform:uppercase;">
							</div>
							<label class="control-label col-sm-2" for="pwd">Maximum Leave</label>
								<div class="col-sm-4"> 
								   <input type="text" class="form-control" id="maximum_leave" name="max_leave" required placeholder="maximum leave number" onkeypress="return only_chareter(this.value);">
								</div>
						  </div>
						  
							
							  <div class="form-group">
							<label class="control-label col-sm-2" for="leave_type"></label>
							<div class="col-sm-4">
							   <input type="hidden" class="form-control" name="status" value="1"  readonly  id="status"   />
								       
										
									
							</div>
							<label class="control-label col-sm-2" for="pwd"></label>
								<div class="col-sm-4"> 
								  
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
							 <th>Leave Type</th>
							 <th>Entry Name</th>
							 <th>Action</th>
						   </tr>	
						</thead>
						
					   <tbody >
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
							<th>Leave Type</th>
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
			
