<?php 
$this->load->view('header');
$this->load->view('leftbar');
?>

<script>
function readURL(input) {
 if (input.files && input.files[0]) {//Check if input has files.
 var reader = new FileReader(); //Initialize FileReader.
 reader.onload = function (e) {
document.getElementById("img_div").style.display = "block";
 $('#img_id').attr('src', e.target.result);
 $("#img_id").resizable({ aspectRatio: true, maxHeight: 300 });
 };
 reader.readAsDataURL(input.files[0]);
 } 
 else {
 $('#img_id').attr('src', "#");
 }
}
</script>

<script>
$('#hidemessage').fadeIn('slow').delay(2000).fadeOut('slow');
</script>
<style>
#hidemessage {
    position: relative;
    display: none;
}
</style>

<script type="text/javascript">
function emp_te() {  
var t = document.getElementById("emp_type");
var selectedText = t.options[t.selectedIndex].text;
if(selectedText=='TEACHER' || selectedText=='teacher' || selectedText=='Teacher'){
	document.getElementById('subject').disabled=false;
}
else{
	document.getElementById('subject').disabled=true;
}

}

$(document).ready(function () {                
$('#b_date').datepicker({format: "dd/mm/yyyy"});
$('#join_date').datepicker({format: "dd/mm/yyyy"});
 //return function for subject disabled start 
 emp_te();
 //return function for subject disabled End
 
//message er pore khali jayga fill up korar jonno//
 setTimeout(function(){ $("#action_report").slideDown(1000); }, 1000);
   setTimeout(function(){ $("#action_report").slideUp(1000); }, 5000);
 
});

function nick_name_chk(v,i){
	$.ajax({
	url:'employee_submit/ajax_request',	
	type:'POST',	
	data:{nick_name:v},
    success:function(data){
		if(data==1){
			alert('Nick Name Already Exists');
			document.getElementById(i).value='';
			document.getElementById(i).focus();
		}
	}	
	});
}


//Designation Limit check function start
function designation_limit_chk(disv,desid){
	//alert(disv);
	$.ajax({
		url:"employee_submit/ajax_request",
		type:"POST",
		data:{des_lem:disv},
		success:function(data){
			if(data==0){
				alert('This Post Already Fill Up');
				document.getElementById(desid).value="";
				//document.getElementById(desid).focus();
			}
		}
		
	});
}
//Designation Limit check function start

//national id check function start
function national_id_chk(nidv,n_id){
	//alert(disv);
	$.ajax({
		url:"employee_submit/ajax_request",
		type:"POST",
		data:{nid_chk:nidv},
		success:function(data){
			if(data==0){
				alert('This ID Already Exist');
				document.getElementById(n_id).value="";
			}
		}
		
	});
}

//national id check function End
</script>



<style>
@-moz-document url-prefix() {
    .input-file-sm {
        height: auto;
        padding-top: 2px;
        padding-bottom: 1px;
    }
}


error{
	
	border-color: red;
}
</style>
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
						<?php 
						$this->load->view("employee_section/success");
						?>
						<!---////success message deyar jonno////-->
							  <div class="col-md-12" style="min-height:50px;" id="hidemessage">
									  <div class="alert alert-success" id="action_report" style="margin-top:5px;margin-bottom:5px;">
									  <strong> Successfully!</strong>Your Data insert complete.
									  </div>
							  </div>
						 <!---///success message end///--->
						    <ul class="nav nav-tabs" id="myTab">
								<li class="active"><a data-toggle="tab" href="#new_emp" style="font-weight:bold;"><span class="glyphicon glyphicon-list-alt"></span> Employee Registration</a></li>
								<li ><a data-toggle="tab" href="#all_type" style="font-weight:bold;"><span class="glyphicon glyphicon-user"></span> Employee List</a></li>
								<li><a data-toggle="tab" href="#resign" style="font-weight:bold;"><span class="glyphicon glyphicon-move"></span> Resign Employee</a></li>
						    </ul>
						
						<?php 
						//empid create start
							$r=rand(1000,9000);
							$sr=substr($r,0,4);
							$yemp=date("Y");
							$r_emp_id=$yemp.$sr;
						//empid create end	
						?>
						  <div class="tab-content">
<!-------------------Add Employee Start heare---------------->							
							<div id="new_emp" class="tab-pane fade in active">
								<div class="row" style="margin-top:40px;">
									<div class="col-md-12">
										<!---<form  class="" role="form" action="employee_section/employee_reg_form" method="post" enctype="multipart/form-data">--->
										<?php echo form_open('employee_section/employee_reg_form','role="form" class="form-horizontal" enctype="multipart/form-data"');?>	
										
												<div class="form-group" id="img_div" style="display:none;">
												
													<div class="col-sm-2">
													</div>
													
													<div class="col-sm-4">
													 <img src="" class="img-thumbnail" height="150" width="150"   id="img_id"/>
													</div>
													
													<div class="col-sm-2">
													</div>
													
													<div class="col-sm-4">
													</div>
													
												</div>
												<div class="form-group">
													<label class="control-label col-sm-2" for="id">Picture</label>
													<div class="col-sm-4">
													  <input type="file" class="form-control input-sm input-file-sm" id="pic" name="image" required onchange="readURL(this);">
													  
													</div>
													<label class="control-label col-sm-2" for="empid">Employee ID</label>
													<div class="col-sm-4">
														<input type="text" class="form-control" name="emp_id" readonly value="<?php echo trim($r_emp_id); ?>"/>
													</div>
												  </div>
												  <div class="form-group">
													<label class="control-label col-sm-2" for="">Full Name</label>
													<div class="col-sm-4">
													  <input type="text" class="form-control" id="emp_name"  name="emp_name" required value="<?php echo set_value('emp_name'); ?>" placeholder="Enter Employee Name">
													  <span style="color:red;"><?php echo form_error('emp_name'); ?></span>
													</div>
													<span style="font-size:15px;color:red;"><?php //echo validation_errors();?></span>
													<label class="control-label col-sm-2" for="">Nick Name</label>
														<div class="col-sm-4">   
														  <input type="text" class="form-control" id="nick_name" name="nick_name"  required value="<?php echo set_value('nick_name'); ?>" placeholder="Enter Your Nick Name" onchange="nick_name_chk(this.value,this.id);"> 
														  <span style="color:red;"><?php echo form_error('nick_name'); ?></span>
														</div>
												  </div>
												  
													<div class="form-group">
													
													<label class="control-label col-sm-2" for="">Father Name</label>
														<div class="col-sm-4">   
														  <input type="text" class="form-control" id="father_name"  name="father_name"  required value="<?php echo set_value('father_name'); ?>" placeholder="Enter Father Name"> 
														  <span style="color:red;"><?php echo form_error('father_name'); ?></span>
														</div>
														
													<label class="control-label col-sm-2" for="pwd">Mother Name</label>
														<div class="col-sm-4"> 
														 <input type="text" class="form-control" id="mother_name"  name="mother_name" required value="<?php echo set_value('mother_name'); ?>" placeholder="Enter Mother Name"> 
														 <span style="color:red;"><?php echo form_error('mother_name'); ?></span>
														</div>	
													</div>
													
													<div class="form-group">
														<label class="control-label col-sm-2" for="email">Department</label>
														<div class="col-sm-4">
														  <select  class="form-control" id="department"  name="department" required>
																 <option value="">Select Department</option>
																<?php 
																$select=$this->db->query("select * from  emp_depart_catg");
															$fetch=$select->result();
																foreach($fetch as $value){
																	?>
																	<option <?php echo set_select('department',$value->edepid); ?> value="<?php echo $value->edepid; ?>"><?php echo $value->manage_type; ?></option>
																<?php	
																}
																?>  
																
														  </select>
														  <span style="color:red;"><?php echo form_error('department'); ?></span>
														</div>
														
														<label class="control-label col-sm-2" for="email">Designation</label>
														<div class="col-sm-4">
														 <select name="designation" class="form-control" required  id="designation" onchange="designation_limit_chk(this.value,this.id);">
															<option value="">Select Designation</option>
																<?php 
																$select=$this->db->query("select * from  employee_catg");
															$fetch=$select->result();
																foreach($fetch as $value){
																	?>
																	
																	<option <?php echo set_select('designation',$value->ecatgid); ?> value="<?php echo $value->ecatgid;?>"><?php echo $value->emp_type; ?></option>
																<?php	
																}
																?>  
														  </select>
														  <span style="color:red;"><?php echo form_error('designation'); ?></span>
														</div>
														
													</div>
													
													<div class="form-group">
														<label class="control-label col-sm-2" for="picture">Employee Type</label>
														<div class="col-sm-4">
														<select  class="form-control"  id="emp_type" onchange="emp_te();" required name="emp_types">
														
																	<option value="">Select Type</option>
																	<?php $select=$this->db->query("select * from emp_type")->result(); 
																	
																	foreach($select as $value){
																		?>
																		<option <?php echo set_select('emp_types',$value->emptypeid); ?> value="<?php  echo $value->emptypeid; ?>"><?php  echo strtoupper($value->type); ?></option>
																		
																	<?php	
																	}
																	?>
																	
														</select>
														<span style="color:red;"><?php echo form_error('emp_types'); ?></span>
														</div>
														<label class="control-label col-sm-2" for="email">Subject</label>
														<div class="col-sm-4">
														 <select  class="form-control" id="subject"  name="subject" required>
																 <option  value="">Select Subject</option>
																 <?php $sub_data=$this->db->query("select * from subject_class group by sub_name")->result();
																foreach($sub_data as $value){
																 ?>
																	<option <?php echo set_select('subject',$value->sub_name); ?>> <?php echo $value->sub_name; ?></option>
																	
																<?php } ?>	
																
														  </select>
														  <span style="color:red;"><?php echo form_error('subject'); ?></span>
														</div>
														
													</div>
												  
													<div class="form-group">
														<label class="control-label col-sm-2" for="pwd">Date of Birth</label>
														<div class='col-sm-4'>
														<input type="text" name="birth_date" class="form-control" required  id='b_date' value="<?php echo set_value('birth_date'); ?>" placeholder="Enter Birth Date">
														<span style="color:red;"><?php echo form_error('birth_date'); ?></span>
													   </div>
													   
														<label class="control-label col-sm-2" for="email">Join Date</label>
														<div class="col-sm-4">
														  <input type="text" name="join_date" class="form-control" required id="join_date" value="<?php echo set_value('join_date'); ?>"  placeholder="Enter Join Date">
														  <span style="color:red;"><?php echo form_error('join_date'); ?></span>
														</div>
													</div>
													
													
													<div class="form-group">
														
														<label class="control-label col-sm-2" for="email">National Id</label>
														<div class="col-sm-4">
														   <input type="text" class="form-control" maxlength="17" required id="nid" name="nid" value="<?php echo set_value('nid'); ?>" placeholder="Enter National Id" onchange="national_id_chk(this.value,this.id);">
														   <span style="color:red;"><?php echo form_error('nid'); ?></span>
														</div>
														
														<label class="control-label col-sm-2" for="email">Religion</label>
														<div class="col-sm-4">
														  <select  class="form-control" required name="religion" id="religion">
																<option <?php echo set_select('religion',''); ?> value="">Please Select</option>
																<option <?php echo set_select('religion','Islam'); ?> value="Islam">Islam</option>
																<option <?php echo set_select('religion','Hindus'); ?> value="Hindus">Hindus</option>
																<option <?php echo set_select('religion','Buddha'); ?> value="Buddha">Buddha</option>
																<option <?php echo set_select('religion','Christian'); ?> value="Christian">Christian</option>
																
														  </select>
														  <span style="color:red;"><?php echo form_error('religion'); ?></span>
														</div>
														
													</div>
													
													<div class="form-group">
														
														<label class="control-label col-sm-2" for="email">Blood Group</label>
														<div class="col-sm-4">
														  <select class="form-control" required name="blood_group" id="blood_group">
																<option <?php echo set_select('blood_group',''); ?> value="">Please Select</option>
																<option <?php echo set_select('blood_group','A+'); ?> value="A+">A+</option>
																<option <?php echo set_select('blood_group','A-'); ?> value="A-">A-</option>
																<option <?php echo set_select('blood_group','O+'); ?> value="O+">O+</option>
																<option <?php echo set_select('blood_group','O-'); ?> value="O-">O-</option>
																<option <?php echo set_select('blood_group','AB+'); ?> value="AB+">AB+</option>
																<option <?php echo set_select('blood_group','AB-'); ?> value="AB-">AB-</option>
														  </select>
														  <span style="color:red;"><?php echo form_error('blood_group'); ?></span>
														</div>
														
														<label class="control-label col-sm-2" for="email">Mobile Number</label>
														<div class="col-sm-4">
														 <input type="text" name="phone" class="form-control" maxlength="14" required value="<?php echo set_value('phone'); ?>"   placeholder="Emp phone number" onkeypress="return isNumber(event);"/>
														 <span style="color:red;"><?php echo form_error('phone'); ?></span>
														</div>
														
													</div>
													
													
													<div class="form-group">
														<label class="control-label col-sm-2" for="email">Alternate Number</label>
														<div class="col-sm-4">
														 <input type="text" name="alt_phone" required  class="form-control" maxlength="14" placeholder="Emp alternate phone number" value="<?php echo set_value('alt_phone'); ?>" onkeypress="return isNumber(event);"/>
														 <span style="color:red;"><?php echo form_error('alt_phone'); ?></span>
														</div>
														<label class="control-label col-sm-2" for="email">Salary</label>
														<div class="col-sm-4">
														 <input type="text" name="emp_salary" class="form-control"  required  placeholder="Enter Employee Salary" value="<?php echo set_value('emp_salary'); ?>" onkeypress="return isNumber(event);"/>
														 <span style="color:red;"><?php echo form_error('emp_salary'); ?></span>
														</div>
													</div>

													<div class="form-group">
														<label class="control-label col-sm-2" for="email">Gender</label>
														<div class="col-sm-4">
															<select  class="form-control"  name="gender" required>
																<option <?php echo set_select('gender',''); ?> value="">Please Select</option>
																<option <?php echo set_select('gender','Male'); ?> value="Male">Male</option>
																<option <?php echo set_select('gender','Female'); ?> value="Female">Female</option>
																<option <?php echo set_select('gender','Common'); ?> value="Common">Common</option>
																
															</select>
															<span style="color:red;"><?php echo form_error('gender'); ?></span>
														</div>
														<label class="control-label col-sm-2" for="email">Educational Qualification</label>
														<div class="col-sm-4">
														  <textarea rows="4"  style="resize:none;" class="form-control" required id="edu_qualify"  name="edu_qualify" placeholder="Enter Qualification"><?php echo set_value('edu_qualify'); ?></textarea>
														  <span style="color:red;"><?php echo form_error('edu_qualify'); ?></span>
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-sm-2" for="email">Present Address</label>
														<div class="col-sm-4">
														  <textarea rows="4"  style="resize:none;" class="form-control" required id="present_address"  name="present_address" placeholder="Enter Present Address"><?php echo set_value('present_address'); ?></textarea>
														  <span style="color:red;"><?php echo form_error('present_address'); ?></span>
														</div>
														<label class="control-label col-sm-2" for="email">Permanent Address</label>
														<div class="col-sm-4">
														   <textarea rows="4"  style="resize:none;" class="form-control" required id="permanent_address" name="permanent_address" placeholder="Enter Permanent Address"><?php echo set_value('permanent_address'); ?></textarea>
														   <span style="color:red;"><?php echo form_error('permanent_address'); ?></span>
														</div>
													</div>
													
													
												  <div class="form-group"> 
													<div class="col-sm-offset-2 col-sm-10">
													  <button type="submit" class="btn btn-primary" name="submit" id="submit" ><span class="glyphicon glyphicon-send"></span> Submit</button> &nbsp;&nbsp;&nbsp;
													  <button type="reset" name="reset" class="btn btn-warning"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
													</div>
												  </div>
												  
												  
										</form> 	
												
									</div>
								 
								</div>			  
							  
							</div>
							
<!-----------------add employee end here---------------->

<!-----------------All employee List Start here---------------->
							
							
							<div id="all_type" class="tab-pane fade">
								<div class="row" style="margin-top:40px;">
									 <div class="col-md-12">
									 		
									 <!----///employee Search code close here///-->
									<?php 
									  $data=array();
									  if(isset($_POST['search_employee'])){
										extract($_POST);//desig dept_name type
										if(empty($desig) && empty($dept_name) && empty($type)){
										$where=array('status'=>0);
										}
										elseif(empty($desig) && empty($dept_name)){
											//echo "type";
											$where=array(
											'status'=>0,
											'emptypeid'=>$type
											);
										}
										elseif(empty($type) && empty($desig)){
											$where=array(
											'status'=>0,
											'department'=>$dept_name
											);
										}
										elseif(empty($type) && empty($dept_name)){
											$where=array(
											'status'=>0,
											'deginition'=>$desig
											);
										}
										elseif(empty($type)){
											$where=array(
											'status'=>0,
											'department'=>$dept_name,
											'deginition'=>$desig
											);
										}
										elseif(empty($desig)){
											$where=array(
											'status'=>0,
											'department'=>$dept_name,
											'emptypeid'=>$type
											);
										}
										elseif(empty($dept_name)){
											$where=array(
											'status'=>0,
											'emptypeid'=>$type,
											'deginition'=>$desig
											);
										}
										else {
										$where=array(
											'status'=>0,
											'department'=>$dept_name,
											'emptypeid'=>$type,
											'deginition'=>$desig
											);
										}
										$data['query']=$this->db->select("*")->from("empee")->where($where)->get()->result();
									  }
									  else { 
									  $data['query']=$this->db->select("*")->from("empee")->where("status","0")->get()->result();
									  }
									  $this->load->view('employee_section/employee_report',$data);
									  ?>
								</div>
								</div>	  
							</div>
<!-----------------All employee List End here---------------->

<!-----------------All Resign employee List Start here---------------->	
<?php extract($_POST); ?>
					<div id="resign" class="tab-pane fade">
					<h3>Resign Teacher</h3>
					    <!----search form start------->
					<div class="row">
							<div class="col-md-12">
								 <form class="form-horizontal" action="employee_section/employee_reg_form"  method="post">
									<div class="form-group">
										<div class="col-md-1"></div>
										<div class="col-md-3">
											<select  class="form-control" name="dept_name_re">
												  <option value="">Department Name</option>
													<?php 
													$dept=$this->db->get("emp_depart_catg")->result();
													foreach($dept as $value){
														?>											
														<option <?php if($value->edepid==$dept_name_re){ echo "selected"; } ?> value="<?php echo $value->edepid?>">
															<?php echo $value->manage_type;?>
														</option>
													<?php	
													}
													?>  
											</select>
										 </div>
										 
										  <div class="col-md-3">
											<select  class="form-control" name="type_re">
												  <option value="">Type</option>
													<?php 
													$emptype=$this->db->get("emp_type")->result();
													foreach($emptype as $value){
														?>											
														<option <?php if($value->emptypeid==$type_re){ echo "selected"; } ?>  value="<?php echo $value->emptypeid?>">
															<?php echo $value->type;?>
														</option>
													<?php	
													}
													?>  
												</select>
										  </div>
										 
										  <div class="col-md-3">
												<select  class="form-control" name="desig_re">
												  <option value="">Designation</option>
													<?php 
													$desig=$this->db->get("employee_catg")->result();
													foreach($desig as $value){
														?>											
														<option <?php if($value->ecatgid==$desig_re){ echo "selected"; } ?> value="<?php echo $value->ecatgid?>">
															<?php echo $value->emp_type;?>
														</option>
													<?php	
													}
													?>  
												</select>
										  </div>
										  
										 
										  <div class="col-md-2">
												<button type="submit" name="search_employee_re" class="btn btn-info"><span class="glyphicon glyphicon-search"></span>Search</button>
										  </div>
							   
									</div>	
								</form>
							</div>
						</div>
						</br>
					    <!----search form End--------->
			<!-----------start report heare------------------->
									<?php 
									  $data=array();
									  if(isset($_POST['search_employee_re'])){
										extract($_POST);//desig dept_name type
										if(empty($desig_re) && empty($dept_name_re) && empty($type_re)){
										$where=array('status'=>1);
										}
										elseif(empty($desig) && empty($dept_name)){
											//echo "type";
											$where=array(
											'status'=>1,
											'emptypeid'=>$type_re
											);
										}
										elseif(empty($type_re) && empty($desig_re)){
											$where=array(
											'status'=>1,
											'department'=>$dept_name_re
											);
										}
										elseif(empty($type_re) && empty($dept_name_re)){
											$where=array(
											'status'=>1,
											'deginition'=>$desig_re
											);
										}
										elseif(empty($type_re)){
											$where=array(
											'status'=>1,
											'department'=>$dept_name_re,
											'deginition'=>$desig_re
											);
										}
										elseif(empty($desig_re)){
											$where=array(
											'status'=>1,
											'department'=>$dept_name_re,
											'emptypeid'=>$type_re
											);
										}
										elseif(empty($dept_name_re)){
											$where=array(
											'status'=>1,
											'emptypeid'=>$type_re,
											'deginition'=>$desig_re
											);
										}
										else {
										$where=array(
											'status'=>1,
											'department'=>$dept_name_re,
											'emptypeid'=>$type_re,
											'deginition'=>$desig_re
											);
										}
										$query_re=$this->db->select("*")->from("empee")->where($where)->get()->result();
									  }
									  else { 
									    $query_re=$this->db->select("*")->from("empee")->where("status","1")->get()->result();
									  }
									?>
<script>
function re_join_confirm(){
	con=confirm("Are You Sure Re-Join?");
	if(con==true){ return true; }
	else { return false; }
}
</script>									
						
					<table id="example3" class="table table-condensed table-bordered table-hover">
						<thead>
							<tr>
							<th>SL.NO</th>
							<th>Employee Name</th>
							<th>Nick Name</th>
							<th>Emp Type</th>
							<th>Department</th>
							<th>Designation</th>
							<th>Join Date</th>
							<th>Resign Date</th>
							<th>Picture</th>
							<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$sl=1;
							foreach($query_re as $value){
							?>
							<tr>
								<td><?php echo $sl++; ?></td>
								<td><?php echo $value->name; ?></td>
								<td><?php echo $value->nickN;?></td>
								
								<td><?php 
								echo $this->db->query("select type from emp_type where emptypeid='$value->emptypeid'")->row()->type;
								
								?></td>
								<td><?php echo $this->db->query("select manage_type from emp_depart_catg where edepid='$value->department'")->row()->manage_type; ?></td>
								<td><?php echo $this->db->query("select emp_type from employee_catg where ecatgid='$value->deginition'")->row()->emp_type; ?></td>
								<td><?php echo date("d-m-Y",strtotime ($value->join_date));?></td>
								<td><?php echo date("d-m-Y",strtotime ($value->resign_date));?></td>
								<td>
								<?php //if($value->status==1){echo '<button class="btn btn-danger"> In-Active</button>';}else{echo '<button class="btn btn-primary"> Active</button>';}?>
								<img src="img/employee_image/<?php echo $value->picture; ?>" class="img-thumbnail" height="50px" width="50px"/>
								</td>
								<td>
								
								<div class="dropdown">
								  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Action
								  <span class="caret"></span></button>
								  <ul class="dropdown-menu">
									<li><a href="javascript:void(0)" onclick="details('employee_reports/employee_report_details?id=<?php echo $value->id ?> &nr=<?php echo $nr; ?>')"><span class="glyphicon glyphicon-list-alt"></span>Details</a></li>
									<li><a onclick="return re_join_confirm();" href="employee_section/employee_reg_form?id=<?php echo $value->id; ?> "><span class="glyphicon glyphicon-repeat"></span>Re-Join</a> </li>
								  </ul>
								</div>
								
								</td>
							</tr>
							<?php $nr++; } ?>
						</tbody>
					
				    </table>
			<!-----------End report heare--------------------->						
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