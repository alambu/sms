<?php 
$this->load->view('header');
$this->load->view('leftbar');
?>
<aside class="right-side"> 
     <!---rightbar start here -->
<style type="text/css">
	input{
		text-transform:;
	}
	#myTab{
		margin-bottom:15px;
		font-size:18px;
	}
	.error{
		border:1px solid red;
	}
	
	
 </style> 
<script type="text/javascript">
 $(document).ready(function(){ 
$("#from_d").datepicker({format: 'dd-mm-yyyy'
});
$("#to_d").datepicker({format: 'dd-mm-yyyy'
}); 
 
});


</script>
				<?php
				$return_data=unserialize($_GET["d"]);
				 extract($return_data);
				
				?>
                <!-- Content Header (Page header) -->

                <section class="content-header">
                    <h1>
                        Application
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<div class="box">
						<div class="box-body">
							<div class="table-responsive">
								<div class="container-fluid">
<!---nav ul Start-->							
								<ul class="nav nav-tabs" id="myTab">
									<li class="active"><a data-toggle="tab" href="#app_form"><span class="glyphicon glyphicon-list-alt"></span>  Application Form</a></li>
									<li><a data-toggle="tab" href="#app_report"><span class="glyphicon glyphicon-th-list"></span> Application List</a></li>
									<li><a data-toggle="tab" href="#app_report_gpa"><span class="glyphicon glyphicon-sound-5-1"></span> Search By GPA</a></li>
								</ul>
<!--nav ul End-->	

							
						<div class="tab-content">
<!---application form start-->

<script type="text/javascript">

var LoadFile=function(event){
	var output=document.getElementById("img_id");
	var image_size= parseInt((event.target.files[0].size)/1000);
		if(image_size>150) {
		document.getElementById("picture").value = "";
		document.getElementById("img_div").style.display = "none";
		alert("IMAGE SIZE LARGE MAXIMUM SIZE 150 KB");
		}
		else {
		document.getElementById("img_div").style.display = "block";	
		output.src=URL.createObjectURL(event.target.files[0]);
		}
}
function class_chk(clsid){
	//alert(clsid);
	 var cls_name = clsid.options[clsid.selectedIndex].text;
	 if(cls_name=='SIX'){
		 document.getElementById("show_gpa_text").innerHTML="PSC &nbsp;";
		 document.getElementById("gpa").readOnly = false;
		
	 }
	 else if(cls_name=='NINE'){
		 document.getElementById("show_gpa_text").innerHTML="JSC &nbsp;";
		 document.getElementById("gpa").readOnly = false;
		 
	 }
	 else {
		 document.getElementById("show_gpa_text").innerHTML="";
		 document.getElementById("gpa").value = "";
		 document.getElementById("gpa").readOnly = true;
		 
	 }
}


function inst_chk(v) {
	var clsid_ins=document.getElementById("class_name");
	var gpa=document.getElementById("gpa").value;
	var cls_name_ins = clsid_ins.options[clsid_ins.selectedIndex].text;
	if(cls_name_ins=='SIX' || cls_name_ins=='NINE'){
		if(v==''){
			alert('Institute Name is Empty');
			document.getElementById("inst_name").focus();
			return false;
		}
		else {
			
			if(gpa==''){
			alert('GPA is Empty');
			document.getElementById("gpa").focus();
			return false;
			}
		}
	}
	
	else {
		return true;	
	}
	
}

function gpa_chk(gpid,v){
	var clsid_ins=document.getElementById("class_name");
	if((v>5.00) || (v>5)){
		alert("MAXIMUM GPA IS 5.00");
		document.getElementById(gpid).value='';
		document.getElementById("gpa").focus();
	}
	else {
		
		var cls_name_ins = clsid_ins.options[clsid_ins.selectedIndex].text;
		$.ajax({
			url: "index.php/student_submit/ajax_request",
			type: 'POST',	
			data:{cls_name_gpa:cls_name_ins,in_gpa:v},	
			success: function(data)
			{
				if(v<data){
					alert("Application Can'not Accept  Minimum GPA  "+data);
					document.getElementById("gpa").value='';
					document.getElementById("gpa").focus();
					return false;
				}
			}
		    });
		
		
	}
}
</script>



							<div id="app_form" class="tab-pane fade in active">
								
								<div class="row">
								  <div class="col-md-12">
										
									<form  class="form-horizontal" role="form" action="student_submit/application_form" method="post" enctype="multipart/form-data"  onsubmit="return inst_chk(inst_name.value);">
									 
										
									  <div class="form-group">
										<label class="control-label col-sm-2" for="email">Student's Name   <span  style="color:red;">*</span></label>
										<div class="col-sm-4">
										  <input type="text" class="form-control"  name="sname" id="sname" placeholder="Enter Student's Name" onkeypress="return only_chareter(this.value)" value="<?php echo $sname; ?>" required  />
										</div>
										<label class="control-label col-sm-2" for="email">Father's Name  <span  style="color:red;">*</span></label>
										<div class="col-sm-4">
										  <input type="text" name="fname" class="form-control" id="fname" placeholder="Enter Father's Name" onkeypress="return only_chareter(this.value)" value="<?php echo $fname; ?>" required>
										</div>
									  </div>
									  
										<div class="form-group">
											<label class="control-label col-sm-2" for="email">Mother 's Name <span  style="color:red;">*</span></label>
											<div class="col-sm-4">
											  <input type="text" name="mname" class="form-control" id="mname" value="<?php echo $mname; ?>" onkeypress="return only_chareter(this.value)" placeholder="Enter Mother's Name" required>
											</div>
											
											
											<label class="control-label col-sm-2" for="pwd">Class <span  style="color:red;">*</span></label>
											<div class="col-sm-4">
											<?php
												$y = date("Y");
												$app_list1 = $this->db->query("SELECT a.*,b.class_name from application_catg a,class_catg b where a.classid=b.classid and a.status='0' and a.years='$y'")->result();
												
											?>
											  <select class="form-control"  name="class_name" id="class_name" required onchange="class_chk(this);">
												<option value="">Select Class</option>
												<?php foreach($app_list1 as $value){
													?>
													<option value="<?php echo $value->appctgid; ?>"><?php echo $value->class_name; ?></option>
												<?php 	
												} ?>
											  </select>
											</div>
											
										</div>
										
										
										<div class="form-group">
											<label class="control-label col-sm-2" for="email">Institute Name <span  style="color:red;">*</span></label>
											<div class="col-sm-4">
											  <input type="text" name="inst_name" class="form-control" id="inst_name" value="<?php echo $inst_name; ?>" onkeypress="return only_chareter(this.value)" placeholder="Enter Institute Name">
											</div>
											
											
											<label class="control-label col-sm-2" for="pwd"><span id="show_gpa_text"></span>GPA<span  style="color:red;">*</span></label>
											<div class="col-sm-4"> 
											  <input type="text" class="form-control" placeholder="Example 5.00" name="gpa" onkeypress="return isNumber(event);" maxlength="4" readonly id="gpa" onchange="gpa_chk(this.id,this.value);"/>
											</div>
											
										</div>
										
										
										<div class="form-group">
											<label class="control-label col-sm-2" for="email">Email</label>
											<div class="col-sm-4">
											  <input type="text" name="email" class="form-control" id="email" placeholder="Enter email" value="<?php echo $email; ?>">
											</div>
											<label class="control-label col-sm-2" for="email">Gender <span  style="color:red;">*</span></label>
											<div class="col-sm-4">
											  <select class="form-control" name="gender" id="gender" required>
												<option value="">Enter Gender</option>
												<option <?php if($gender=="Male"){ echo "selected"; } ?>>Male</option>
												<option <?php if($gender=="Female"){ echo "selected"; } ?>>Female</option>
												<option <?php if($gender=="Comon"){ echo "selected"; } ?>>Comon</option>
											  </select>
											</div>
										</div>
										
										<div class="form-group">
											<label class="control-label col-sm-2" for="religion">Relagion <span  style="color:red;">*</span></label>
											<div class="col-sm-4">
											  <select class="form-control" name ="religion" id="religion" required>
												<option value="">Enter Relagion</option>
												<option <?php if($religion=="BUDDHISM"){ echo "selected"; } ?>>BUDDHISM</option>
												<option <?php if($religion=="CHRISTIANITY"){ echo "selected"; } ?>>CHRISTIANITY</option>
												<option <?php if($religion=="HINDUISM"){ echo "selected"; } ?>>HINDUISM</option>
												<option <?php if($religion=="ISLAM"){ echo "selected"; } ?>>ISLAM</option>
												<option <?php if($religion=="JAINISM"){ echo "selected"; } ?>>JAINISM</option>
												<option <?php if($religion=="OTHERS"){ echo "selected"; } ?>>OTHERS</option>
												<option <?php if($religion=="SIKHISM"){ echo "selected"; } ?>>SIKHISM</option>
												
											  </select>
											</div>
											<?php echo $blood_grou; ?>
											<label class="control-label col-sm-2" for="email">Blood Group</label>
											<div class="col-sm-4">
											  <select class="form-control" name="blood_grou" id="blood_grou" placeholder="Enter email">
												<option value="">Group</option>
												<option <?php if($blood_grou=="A+"){echo "selected";} ?>>A+</option>
												<option <?php if($blood_grou=="A-"){echo "selected";} ?>>A-</option>
												<option <?php if($blood_grou=="AB+"){echo "selected";} ?>>AB+</option>
												<option <?php if($blood_grou=="AB-"){echo "selected";} ?>>AB-</option>
												<option <?php if($blood_grou=="B+"){echo "selected";} ?>>B+</option>
												<option <?php if($blood_grou=="B-"){echo "selected";} ?>>B-</option>
												<option <?php if($blood_grou=="O+"){echo "selected";} ?>>O+</option>
												<option <?php if($blood_grou=="O-"){echo "selected";} ?>>O-</option>
											  </select>
											</div>
										</div>
										
										
										<div class="form-group">
											<label class="control-label col-sm-2" for="email">Present address <span  style="color:red;">*</span></label>
											<div class="col-sm-4">
											 <textarea class="form-control" name="pre_address" id="pre_address" rows="5" style="resize:none;" required><?php  echo $pre_address; ?></textarea>
											</div>
											<label class="control-label col-sm-2" for="email">Parmanent address <span  style="color:red;">*</span></label>
											<div class="col-sm-4">
											  
											  
											   <textarea class="form-control" name="par_address" id="par_address" rows="5" style="resize:none;" required><?php  echo $par_address; ?></textarea>
											</div>
										</div>
										
										<div class="form-group">
											<label class="control-label col-sm-2" for="email">City <span  style="color:red;">*</span></label>
											<div class="col-sm-4">
											  <select type="text" class="form-control" name="city" id="city" placeholder="Enter city" required>
											  <?php if(isset($_GET['d'])){ ?>
												<option><?php echo $city; ?></option>
											  <?php  } ?>
											  <?php $this->load->view('student_section/city'); ?>
											  </select>
											</div>
											
											<label class="control-label col-sm-2" for="email">Phone <span  style="color:red;">*</span></label>
											<div class="col-sm-4">
											  <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone Number" value="<?php echo $phone; ?>" onkeypress="return checkaccnumber(event);" maxlength="11" required>
											</div>
										</div>
										 <div class="form-group" id="img_div" style="display:none;">
											<div class="col-sm-2">
											 
												
											</div>
											<div class="col-sm-4">
											 <img src="" class="img-responsive" style="height:160px;width:160px;"   id="img_id"/>
											</div>
											<div class="col-sm-2">
											
											</div>
											<div class="col-sm-2">
											 
											</div>
											<div class="col-sm-2">
											 
											</div>
										
										</div>
										
										<div class="form-group">
										
											<label class="control-label col-sm-2" for="email" >Picture <span  style="color:red;">*</span></label>
											<div class="col-sm-4">
											  <input type="file" name="picture" id="picture" class="form-control" accept="image/jpeg, image/jpg, image/png"  onchange="LoadFile(event)" required/>
											</div>
											
											<label class="control-label col-sm-2" for="email" style="display:none;">Transaction ID</label>
											<div class="col-sm-4">
											  <input type="hidden" class="form-control" name="trans_id" id="trans_id" placeholder="Enter Transaction ID" value="<?php echo rand(); ?>" onkeypress="return isNumber(event);" required>
											</div>
											
										</div>
										

									  <div class="form-group"> 
										<div class="col-sm-offset-2 col-sm-10">
										  <button type="submit" class="btn btn-primary" name="submit" id="submit"><span class="glyphicon glyphicon-send"></span> Submit</button> &nbsp;&nbsp;&nbsp;
										  <button type="reset" onclick="return confirm_reset();" class="btn btn-warning"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
										</div>
									  </div>
									</form>

										
									
								  </div>
								  
								</div>	
							</div>
							
<!--------------------------------application form End------------------------------->	




						
<!--------------------------------application Report Start------------------------------->
<script type="text/javascript">
var newwindow;
  function details(url)
  {
  newwindow=window.open(url,'name','height=600,width=800,left=300,scrollbars=yes,top=20');
  if (window.focus) {newwindow.focus()}
  }

</script>

							<div id="app_report" class="tab-pane fade">
								<h3>Application Report</h3>
								
								
								<div class="row">
										<div class="col-md-12">
											<form action="student_section/application_form" method="post">
												<table class="table table-condensed">
													<tr>
													<?php 
														if(isset($_POST['submit_report'])){
															extract($_POST);
														}
													?>
														<td>
															<select name="cls" class="form-control">
																<option  value="">Class</option>
																<?php 
																	
																	foreach($app_list_search as $val){
																?>
																	<option <?php if($cls==$val->appctgid){echo "selected";} ?> value="<?php echo $val->appctgid; ?>"><?php echo $val->class_name; ?></option>
																<?php } ?>
															</select>
														</td>
														<td>
															<input type="text" class="form-control" placeholder="From Application Date" name="from_d" id="from_d" value="<?php echo $from_d; ?>"/>
														</td>
														<td>
															<input type="text" class="form-control" placeholder="To"  id="to_d" name="to_d" value="<?php echo $to_d; ?>"/>
														</td>
														<td>
															<select name="city" class="form-control" id="city"> 
																	<?php 
																		if(!(empty($city))){
																			
																			?>
																			<option>
																			<?php echo $city; ?></option>
																		<?php 	
																		}
																		else {
																	?>
																	<option value="">Select City</option>
																<?php } ?>
																 <?php
																 $this->load->view('student_section/city');
																 ?>
																 
															</select>
														</td>
														 
														<td>
															<select name="year" class="form-control">
																<option value="">Year</option>
																<?php 
																for($i=date("Y");$i>=2010; $i--){
																?>
																<option <?php if($from_d=='' && $to_d==''){ if($year==$i){echo "selected";} }?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
																<?php
																}
																?>
															</select>
														</td>
														
														<td>
															<button type="submit" name="submit_report" class="btn btn-info"><span class="glyphicon glyphicon-search"></span> Search</button>
														</td>
													</tr>
												</table>
											</form>
										</div>	
									</div>
								
								
								<div class="row" style="margin-top:15px;">
									<div class="col-md-12">
										<table id="example1" class="table table-condensed  table-bordered table-hover">
												<thead>
													<tr>
													<th>Serial</th>
													<th>ID</th>
													<th>Applicant Name</th>
													<th>Institute Name</th>
													<th>Class</th>
													<th>GPA</th>
													<th>City</th>
													<th>Application Date</th>
													<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php
														$i=1;
														foreach($info as $value){
													?>
													<tr>
													<td><?php echo $i++; ?></td>
													<td><?php echo $value->appid; ?></td>
													<td><?php echo $value->name; ?></td>
													<td><?php echo $value->inst_name; ?></td>
													<td><?php echo $value->class_name; ?></td>
													<td><?php echo $value->gpa; ?></td>
													<td><?php echo $value->city; ?></td>
													<td><?php echo date('d-m-Y',strtotime($value->e_date)); ?></td>
													<td><a href="javascript:void(0)" onclick="details('index.php/student_report/application_details?id=<?php  echo  $value->appid; ?>');"><button class="btn btn-info"><span class="glyphicon glyphicon-list-alt"></span> Details</button></a> &nbsp;</td>
													
													</tr>
												<?php } ?>
												
												</tbody>
										</table>
										<p style="font-size:17px;text-align:center;">Total Applicant: <?php echo $i-1; ?></p>
									</div>
								</div>
								
								
						  </div>
						  
						  
						  
<!--------------------------------application Report End------------------------------->

	
	
	
<!--------------------------------application Report By GPA Start------------------------------->

							<div id="app_report_gpa" class="tab-pane fade">
								<h3>Application Report</h3>
								
								
								<div class="row">
										<div class="col-md-12">
											<form action="student_section/application_form" method="post">
												<table class="table table-condensed">
													<tr>
													<?php 
														if(isset($_POST['submit_report_gpa'])){
															extract($_POST);
															//print_r($app_list_search);
														}
													?>
														<td>
															<select name="cls" class="form-control">
																<option  value="">Class</option>
																<?php 
																	
																	foreach($app_list_search as $val){
																?>
																	<option <?php if($cls==$val->appctgid){echo "selected";} ?> value="<?php echo $val->appctgid; ?>"><?php echo $val->class_name; ?></option>
																<?php } ?>
															</select>
														</td>
														<td>
															<input type="number" class="form-control" placeholder="Enter From GPA Example 4.00" min="1" maxlength="4" name="s_gpa" id="s_gpa" value="<?php echo $s_gpa; ?>"/>
														</td>
														<td>
															<input type="number" class="form-control" placeholder="Enter To GPA Example 5.00" min="1" maxlength="4" id="e_gpa" name="e_gpa" value="<?php echo $e_gpa; ?>"/>
														</td>
														
														 
														<td>
															<select name="year" class="form-control" required>
																<option value="">Select Year</option>
																<?php 
																for($i=date("Y");$i>=2010; $i--){
																?>
																<option <?php if($year==$i){echo "selected";} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
																<?php
																}
																?>
															</select>
														</td>
														
														<td>
															<button type="submit" name="submit_report_gpa" class="btn btn-info"><span class="glyphicon glyphicon-search"></span> Search</button>
														</td>
													</tr>
												</table>
											</form>
										</div>	
									</div>
									</br>
								<div class="row">
									<div  class="col-md-12">
										<table id="example3" class="table table-bordered table-condensed ">
										<thead>
											<tr>
												<td>SL.No</td>
												<td>ID</td>
												<td>Applicant Name</td>
												<td>Institute Name</td>
												<td>GPA</td>
												<td>Class</td>
												<td>Date</td>
												<td>Action</td>
											</tr>
										</thead>	
											<?php
											$i=1; foreach($info as $value){
											?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td><?php echo $value->appid; ?></td>
												<td><?php echo $value->name; ?></td>
												<td><?php echo $value->inst_name; ?></td>
												<td><?php echo $value->gpa; ?></td>
												<td><?php echo $value->class_name; ?></td>
												<td><?php echo date("d-m-Y",strtotime($value->e_date)); ?></td>
												<td>
													<a href="javascript:void(0)" onclick="details('student_report/application_details?id=<?php  echo  $value->appid; ?>');"><button class="btn btn-info"><span class="glyphicon glyphicon-list-alt"></span> Details</button></a>
												</td>
											</tr>	
											<?php 	
											} ?>
										</table>
									</div>
								</div>
									
							</div>
<!--------------------------------application Report By GPA End---------------------------------------->	
						
							
						</div>	
					</div>
				</div>
            </div>				
        </div>				
    </section><!-- /.content -->
</aside><!-- /.right-side -->     <!---rightbar close here ---->
<?php $this->load->view('footer'); ?>			