<!--//salary payment script start here//-->
<style>
.badge.badge-success {
	background-color: #00a651;
	color: #ffffff;
}
</style>
<script>

function ajax_request_clsid(emp_id){

     $.ajax({
      url: "index.php/employee_submit/ajax_request",
      type: "POST", 
      data:{emp_id:emp_id}, 
      success: function(data)
      {  
   
	 document.getElementById("present_salary").value=data;
      }          
      });
     }
	

	

function ajax_request_clsid_pay(emp_id_pay){
 // alert(emp_id_pay);
 $.ajax({
  url: "index.php/employee_submit/ajax_request",
  type: "POST", 
  data:{emp_id:emp_id_pay}, 
  success: function(data)
  {  
    //alert(data);
	document.getElementById("present_salary_show").innerHTML="Current Salary amount is "+"<span style='color:blue;'>"+data+"</span>"+" Tk.";
  }          
  });
 }
</script>

<script type="text/javascript">
$(document).ready(function () {                
$('#payment_date').datepicker({format: "dd/mm/yyyy"});

          
});


function sal(){
	var a=document.getElementById("present_salary").value;
      var 	b=document.getElementById("salary").value;
	  if(b>a){
		  
		  alert("Sorry. This salary is bigger than present salary");
		  return false;
	  }
	  
	
}
</script>



<!--//salary payment script close here-->

<!---//salary increment script start here--->
<script type="text/javascript">
$(document).ready(function () {                
$('#encre_date').datepicker({format: "dd/mm/yyyy"});
$('#pay_d').datepicker({format: "dd/mm/yyyy"});          
$('#start_date').datepicker({format: "dd/mm/yyyy"});          
$('#end_date').datepicker({format: "dd/mm/yyyy"});          
});
</script>



<!---salary increment script close here--->


<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Employee Salary  
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Employee Salary </li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
			
			
			
			
			
			
<div class="box">
<div class="box-body">	  
					 
<div class="container-fluid">
	<?php 
		$this->load->view("employee_section/success");
	  ?>
  <ul class="nav nav-tabs" id="myTab">
    <!--<li class="active"><a data-toggle="tab" href="#payment" style="font-weight:bold;">New Payment</a></li>----->
	<li class="active"><a data-toggle="tab" href="#selary_pay"  style="font-weight:bold;"><span class="glyphicon glyphicon-pencil"></span> Payment</a></li>
	<li><a data-toggle="tab" href="#payment_list"  style="font-weight:bold;"><span class="glyphicon glyphicon-book"></span> Payment History</a></li>
	<li><a data-toggle="tab" href="#increment"  style="font-weight:bold;"><span class="glyphicon glyphicon-saved"></span> Increment</a></li>
	<li><a data-toggle="tab" href="#increment_list"  style="font-weight:bold;"><span class="glyphicon glyphicon-book"></span> Increment History</a></li>
  </ul>
    
	 
  <div class="tab-content">
  
	<!-----------------start salary payment----------------->
		<div id="selary_pay" class="tab-pane fade in active">
			</br>
			<!---------Form start----------->
				<form  class="form-horizontal" role="form" action="employee_submit/employee_salary_payment" method="post">

						   <div class="form-group">
							<label class="control-label col-sm-2" for="email">Payment To</label>
							<div class="col-sm-4">
							   <select  class="form-control" name="employee_name" onchange="ajax_request_clsid_pay(this.value);" required>
									<option style="text-align:center;" value="" >Select Employee Name</option>
								       <?php 
										$select=$this->db->query("select * from  empee where status='0'");
									    $fetch=$select->result();
										foreach($fetch as $value){
											?>
											
											<option value="<?php  echo $value->empid;   ?>"><?php echo $value->name; ?> ( <?php    echo  $value->nickN; ?> ) </option>
										<?php	
										}
										?>  
								  </select> 
							</div>
							<label class="control-label col-sm-2" for="pwd">Month</label>
							<div class="col-sm-4"> 
							<?php 
								$month=array('1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');
							?>
							<select name="month"  class="form-control" required>
								<option value="">Select Month</option>
								<?php 
								foreach($month as $val=>$mon){
								?>
								<option value="<?php echo $val; ?>"><?php echo $mon; ?></option>
								<?php 
								}
								?>
							</select>	
							</div>
							
						  </div>
						
						
						  <div class="form-group">
							<label class="control-label col-sm-2" for="email">Year</label>
							<div class="col-sm-4">
							  <select name="year" class="form-control" required>
								<option value="">Select Year</option>
								
								<?php
								$sy=date("Y")-1;
								$ey=date("Y")+1;
								for($sy;$sy<=$ey;$sy++){
								?>
								<option value="<?php echo $sy; ?>"><?php echo $sy; ?></option>
								<?php 
								}
								?>
							  </select>
							</div>
							<label class="control-label col-sm-2" for="pwd">Payment Tk</label>
							<div class="col-sm-4"> 
							 <input type="number" name="salary" class="form-control" id="" required name="increment_date" placeholder="Enter TK">
							</div>
						  </div>
						  <div class="form-group">
							<label class="control-label col-sm-2" for="pwd">Payment Date</label>
							<div  class="col-sm-4">
							<input name="pay_d" type="text" required class="form-control" placeholder="Payment Date" id="pay_d" />
							</div>
							<label id="present_salary_show" style="font-weight:bold;font-size:16px;color:green;"></label>
							
						  </div>

							
						  <div class="form-group"> 
							<div class="col-sm-offset-2 col-sm-10">
							  <button type="submit" class="btn btn-primary" name="submit" id="submit"><span class="glyphicon glyphicon-send"></span> Submit</button> &nbsp;&nbsp;&nbsp;
							  <button type="reset" name="reset" class="btn btn-warning"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
							</div>
						  </div>
					</form>
			<!---------Form End------------->
			
		</div>
	<!-----------------End Salary Payment------------------->
  
<!---------payment list start------------->
	<div id="payment_list" class="tab-pane fade">
		</br>
		<?php extract($_POST); ?>
		<!--- form start------>
		<div class="row">
			<div class="col-md-12">
			 <form class="form-horizontal" role="form" action="employee_section/employee_salary_history"  method="post">
				<div class="form-group">
					 <?php extract($_POST); ?> 
					<div class="col-md-4">
						  <label>Employee Name</label>	
						  <select  class="form-control" name="emp_name" required>
						  <option value="">Select</option>
							<?php 
							$select=$this->db->query("select *  from  empee where status='0'");
							$fetch=$select->result();
							foreach($fetch as $values){
								?>											
								<option <?php if($emp_name==$values->empid){ echo "selected"; } ?> value="<?php echo $values->empid?>" <?php if($empid==$values->empid){echo 'selected';}?>> 
									<?php echo $values->name.'('.$values->nickN .')'?>
								</option>
							<?php	
							}
							?>  
						 </select>
					</div>
					  
					
					<div class="col-md-3">
						<label>Year</label>
					  <select class="form-control" name="spay_year">
							<?php 
							$search_year=date("Y");
							$search_end=date("Y")-10;
							for($search_year;$search_end<=$search_year;$search_year--){
							?>
							<option <?php if(isset($_POST['submit_pay_list'])){ if($spay_year==$search_year){ echo "selected"; } } ?> value="<?php echo $search_year; ?>"><?php echo $search_year; ?></option>
							<?php } ?>
						</select>
						
					</div>
					  
					<div class="col-md-3">
					   <label>Month</label>
					   <?php 
					   $month=array('1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');
					   ?>
						<select class="form-control"  name="spay_month">
							<option value="">Select Month</option>
							<?php foreach($month as $key=>$m){ ?>
							<option <?php if(isset($_POST['submit_pay_list'])){ if($spay_month==$key){ echo "selected"; } } ?> value="<?php echo $key; ?>"><?php echo $m; ?></option>
							<?php } ?>
						</select>
					</div>
					  
					<div class="col-md-2">
						<label style="opacity:;"></label>
						<button type="submit" name="submit_pay_list" style="margin-top:25px;" class="btn btn-info"><span class="glyphicon glyphicon-search"></span>  Search</button>
					   
						
					</div>
					  
				</div>	
				</div>
				</div>
			</form>
		<!-----form end-------->
		<?php 
		if(isset($_POST['submit_pay_list'])){ 
		extract($_POST);
		$his_y=date("Y");
		?>
        <div class="row">
		     
			<div class="col-md-12">
				<div class="panel-group" id="accordion">	
			<?php
			if(empty($spay_month)) {
			//echo "year and emp";
			 $month=array('1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');
			 foreach($month as $key=>$m){
			?>
			
			  <div class="panel panel-info">
				<div class="panel-heading">
				  <h4 class="panel-title" style="text-align:left;">
					<a data-toggle="collapse" style="display:block;" data-parent="#accordion" href="#<?php echo $m; ?>">
					
					<?php echo $m; ?></a>
				  </h4>
				</div>
				<div id="<?php echo $m; ?>" class="panel-collapse collapse">
				  <div class="panel-body">
				  <?php 
				  $query=$this->db->query("select a.*,b.* from emp_salary_his a , empee b  where  a.years='$spay_year' and a.empid='$emp_name' and b.empid='$emp_name' and a.month='$key'")->result();
				  ?>
					<table class="table table-condensed">
				
						<tr class="active">
							<th>Serial No</th>
							<th>Payment Salary</th>
							<th>Month - Year</th>
							<th>Payment date</th>
							<th>Action</th>
						</tr>
						<?php $nr=1;
						foreach($query as $value){
						?>
						<tr>
							<td><?php  echo $nr; ?></td>
						    <td><?php  echo $value->salary; ?> Tk</td>
							<td><?php echo $m; ?>- <?php echo $value->years; ?></td>
							<td><span class="badge badge-success"><?php echo date("d-m-Y",strtotime($value->date));?></span></td>
							<td>
							<a href="index.php/employee_reports/edit_employee_salary_report?id=<?php echo $value->empid; ?> "><button class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span> Edit</button></a> &nbsp;
							</td>
						</tr>	
					<?php $nr++; } ?>
					</table>	
						
				  </div>
				</div>
			  </div>
			
			<?php
			} 
			}
			
			else {
			  $query=$this->db->query("select a.*,b.* from emp_salary_his a , empee b where a.empid='$emp_name' and a.month='$spay_month' and a.years='$spay_year' and b.empid='$emp_name'")->result();
			  
			  $month=array('1'=>'January','2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August','9'=>'September','10'=>'October','11'=>'November','12'=>'December');
			?>  
			<div class="panel panel-info">
				<div class="panel-heading">
				  <h4 class="panel-title">
					<a data-toggle="collapse" style="display:block;" data-parent="#accordion" href="#<?php echo $spay_month; ?>">
					<?php foreach($month as $key=>$v){ if($key==$spay_month) { echo $m=$v; } } ?></a>
				  </h4>
				</div>
				<div id="<?php echo $spay_month; ?>" class="panel-collapse collapse in">
				  <div class="panel-body">
						<table class="table table-condensed">
				
						<tr class="active">
							<th>Serial No</th>
							<th>Payment Salary</th>
							<th>Month - Year</th>
							<th>Payment date</th>
							<th>Action</th>
						</tr>
						<?php $nr=1;
						foreach($query as $value){
						?>
						<tr>
							<td><?php  echo $nr; ?></td>
						    <td><?php  echo $value->salary; ?> Tk</td>
							<td><?php echo $m; ?>- <?php echo $value->years; ?></td>
							<td><span class="badge badge-success"><?php echo date("d-m-Y",strtotime($value->date));?></span></td>
							<td>
							<a href="index.php/employee_reports/edit_employee_salary_report?id=<?php echo $value->empid; ?> "><button class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span> Edit</button></a> &nbsp;
							</td>
						</tr>	
						<?php $nr++; } ?>
						</table>
				  </div>
				</div>
			</div>
			<?php
			}
			?>	  
			
				</div>  
			

			
			</div>	
		  
		</div>
		<?php } ?>
    </div>
	
<!----------Payment list End---------->	
	<div id="increment" class="tab-pane fade">
	       </br>
          <div class="row">
		     <div class="table-responsive">
                <div class="col-md-12">
				   <form  class="form-horizontal" role="form" action="employee_submit/employee_salary_increment" method="post" enctype="multipart/form-data">

						   <div class="form-group">
							<label class="control-label col-sm-2" for="email">Employee Name</label>
							<div class="col-sm-4">
							   <select  class="form-control" name="employee_name" required  onchange="ajax_request_clsid(this.value);" >
									<option style="text-align:center;" value="" >Please select</option>
								       <?php 
										$select=$this->db->query("select name, empid from  empee where status='0'");
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
								<input type="text"  class="form-control" readonly name="present_salary" id="present_salary" />
								</div>
						  </div>
						
						
						  <div class="form-group">
							<label class="control-label col-sm-2" for="email">Salary With Increment</label>
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
	
	
	<div id="increment_list" class="tab-pane fade">
	<?php
	if(isset($_POST['submit_in_his'])){
		extract($_POST);
	}
	?>
			<div class="row" style="margin-top:20px;">
				<div class="col-md-12">
					<form class="form-horizontal" action="employee_section/employee_salary_history" method="post">
						<div class="form-group">
							<div class="col-md-2">
								Employee Name
							</div>
							<div class="col-md-6">
							    <select class="form-control" name="emp_his" required>
								<option value="">Employee Name</option>
								<?php 
									$emp=$this->db->select("*")->from("empee")->where("status","0")->get()->result();
									foreach($emp as $value){
									?>
									<option value="<?php echo $value->empid; ?>"><?php echo $value->name; ?></option>
									<?php 	
									}
								?>
								</select>
							</div>
							<div class="col-md-2">
								<button type="submit" name="submit_in_his" class="btn btn-info"><span class="glyphicon glyphicon-search"></span> search</button>
							</div>
						</div>
					</form>
				</div>
			</div>
         <div class="row">
                <div class="col-md-12">
   					 <?php 
					 if(isset($_POST['submit_in_his'])){
						 extract($_POST);
						 $dvalue=$this->db->select("*")
                                ->from("emp_salary_incre")
								->where("empid",$emp_his)
								->get()
								->result();
								
					 }
					 else {
					 $ye=date("Y")."-01-01";
					 $y=date("Y");
					 $dvalue=$this->db->select("*")
                                ->from("emp_salary_incre")
								->where("date >",$ye)
								->order_by("empid")
								->get()
								->result();
						
								
					 }			
					 ?>
					 
					 
					    
					    <table id="example3" class="table table-condensed table-bordered table-hover">
								<thead>
									<tr>
									<th>Nr</th>
									<th>Employee Id</th>
									<th>Emp Name</th>
									<th>Increment Salary</th>
									<th>Increment Date</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									
								    $nr=1;
									foreach($dvalue as $ddata){
										
									?>
									<tr>
									<td><?php echo $nr;?></td>
									<td><?php 
									
									echo $emp=$this->db->query("select empid from empee where empid='$ddata->empid'")->row()->empid;
									
									?></td>
									<td><?php 
									
									echo $emp=$this->db->query("select name from empee where empid='$ddata->empid'")->row()->name; 

									?></td>
									<td><?php echo $ddata->salary;?> Tk</td>
									<td><?php echo date("d-m-Y",strtotime($ddata->date) );?></td>
									</tr>
									<?php $nr++; } ?>
								</tbody>
								
							</table>
						
				</div>	
		      
		   </div>
     </div>
	

    
  </div>
</div>
					  
</div>
</div>
              			
			
			
			
			
			



                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
			