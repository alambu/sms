<script type="text/javascript">
//Employee Type Test Start
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

// Employee Type Test End

$(document).ready(function () {                
$('#birth_date').datepicker({format: "dd-mm-yyyy"});
$('#join_date').datepicker({format: "dd-mm-yyyy"});
$('#resign_date').datepicker({format: "dd-mm-yyyy"});
//Return function start
 emp_te();
//Return function End 
});


//Nick Name Test Function Start
function nick_name_chk(v,i,ex_v) {
	if(v!=ex_v) {
	$.ajax({
	url:'employee_submit/ajax_request',	
	type:'POST',	
	data:{nick_name:v},
    success:function(data){
		if(data==1){
			alert('Nick Name Already Exists');
			document.getElementById(i).value=ex_v;
			document.getElementById(i).focus();
		}
	}	
	});
	
	}
}
//Nick Name test function End

//Designation Limit check function start
function designation_limit_chk(disv,desid,ex_v) {
	//alert(ex_v);
	if(disv!=ex_v) {
	$.ajax({
		url:"employee_submit/ajax_request",
		type:"POST",
		data:{des_lem:disv},
		success:function(data){
			if(data==0){
				alert('This Post Already Fill Up');
				document.getElementById(desid).value=ex_v;
				//document.getElementById(desid).focus();
			}
		}
		
	});
	
	}
}
//Designation Limit check function start

//national id check function start
function national_id_chk(nidv,n_id,ex_v){
	if(nidv!=ex_v) {
		
	$.ajax({
		url:"employee_submit/ajax_request",
		type:"POST",
		data:{nid_chk:nidv},
		success:function(data){
			if(data==0){
				alert('This ID Already Exist');
				document.getElementById(n_id).value=ex_v;
			}
		}
		
	});
	
	}
}

//national id check function End

//Image Upload Start
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

//image Upload End	
</script>

<style>
@-moz-document url-prefix() {
    .input-file-sm {
        height: auto;
        padding-top: 2px;
        padding-bottom: 1px;
    }
}

</style>

   <aside class="right-side">   
                <section class="content-header">
                    <h1>
                      Edit  Employee Report
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Employee</li>
						<li class="active">Edit Employee Report</li>
                    </ol>
                </section>
   
   
   
   
  
									
									
								
	
   
   <section class="content">
		<!--------Confirmation message start----------->
						<?php 
						$this->load->view("employee_section/success");
						?>
		<!--------Confirmation Message End-------------->
         <div class="row">
                       <div class="col-md-10">
						<form class="form-horizontal" role="form" action="employee_edit/edit_employee_report" method="post" enctype="multipart/form-data">
						
						
						 
                                    <?php
					                //$empid=$_GET['empid'];
                                    $id=$_GET['id'];
									$select=$this->db->select("*")
									->from("empee")
									->where("id", $id)
									->get()
									->row();
									$type=$this->db->query("select type from emp_type where emptypeid='$select->emptypeid'")->row()->type;
									?>
									
					
						    <div class="form-group">
							<label class="control-label col-sm-2" for=""></label>
							<div class="col-sm-4" id="img_div">
							  <img class="img-thumbnail" id="img_id" name="" src="img/employee_image/<?php echo $select->picture; ?>" style="height:150px; width:150px; "/>
							  
							 <input type="file" class="form-control input-sm input-file-sm" id="pic"  name="image" onchange="readURL(this);">
							</div>
							<label class="control-label col-sm-2" for=""></label>
								<div class="col-sm-4">   
								 
								</div>
						  </div>
						
						  <div class="form-group">
							<label class="control-label col-sm-2" for="">Full Name</label>
							<div class="col-sm-4">
							  <input type="text" class="form-control"  required value="<?php echo $select->name; ?> "  name="emp_name" >
							</div>
							<label class="control-label col-sm-2" for="">Nick Name</label>
								<div class="col-sm-4">   
								  <input type="text" class="form-control"  required value="<?php echo $select->nickN;?>" name="nick_name" id="nick_name" onchange="nick_name_chk(this.value,this.id,'<?php echo $select->nickN; ?>');"> 
								</div>
						  </div>
						  
						  
						   <div class="form-group">
							
							<label class="control-label col-sm-2" for="">Father Name</label>
								<div class="col-sm-4">   
								  <input type="text" class="form-control"  required value="<?php echo $select->fname;?>" name="father_name" > 
								</div>
								
								<label class="control-label col-sm-2" for="pwd">Mother Name</label>
								<div class="col-sm-4"> 
								 <input type="text" class="form-control" required value=" <?php echo $select->mname;?>"  name="mother_name"  > 
								</div>
						   </div>
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="email">Department</label>
								<div class="col-sm-4">
								
								  <select  class="form-control" id="department" required name="department">
								         
								        <?php 
										$selected=$this->db->select("*")->from("emp_depart_catg")->get()->result();
										
									
										foreach($selected as $dept){ 
											?>
											
											<option value="<?php  echo $dept->edepid; ?>" <?php if($select->department==$dept->edepid){echo " selected";} ?>><?php echo $dept->manage_type; ?></option>
										<?php	
										}
										?>  
										
								  </select>
								</div>
								
								<label class="control-label col-sm-2" for="email">Designation</label>
								<div class="col-sm-4">
								 <select name="designation" class="form-control" id="designation" required onchange="designation_limit_chk(this.value,this.id,<?php echo $select->deginition; ?>);">
									
								        <?php 
										$selected=$this->db->select("*")->from("employee_catg")->get()->result();
										foreach($selected as $desig){ 
											?>
											
											<option value="<?php  echo $desig->ecatgid; ?>" <?php if($desig->ecatgid==$select->deginition){echo "selected";} ?>><?php echo $desig->emp_type; ?></option>
										<?php	
										}
										?>  
								  </select>
								</div>
								
							</div>
							
							
							<div class="form-group">
								
								<label class="control-label col-sm-2" for="email">Employee Type</label>
								<div class="col-sm-4">
								<select name="emp_type" class="form-control" id="emp_type" required onchange="emp_te();">
									
							    <?php 
										$selected=$this->db->select("*")->from("emp_type")->get()->result();
										foreach($selected as $type){ 
											?>
											
											<option value="<?php echo $type->emptypeid; ?>" <?php if($select->emptypeid==$type->emptypeid){echo "selected";} ?>><?php echo strtoupper($type->type); ?></option>
										<?php } ?>
								
                                </select>
								<input type="hidden" name="employee_type" value="<?php echo $select->emptypeid;?>"/>
							 
								</div>
								
								<label class="control-label col-sm-2" for="email">Subject</label>
								<div class="col-sm-4">
								 <select  class="form-control" id="subject"  name="subject" required <?php if(($type=='stuff') || ($type=='Stuff') || ($type=='STUFF')){ echo "disabled"; } ?>>

									<?php 
									$allSub=$this->db->select("*")->from("subject_class")->get()->result();
									foreach($allSub as $a){											
									?>
							
								<option value="<?php echo $a->subjid;?>" <?php if($select->subject==$a->subjid){echo "selected";}?> ><?php echo $a->sub_name;?></option>
										<?php
                                     }
										?>
										
								  </select>
								</div>
								
							</div>
							
							<div class="form-group">

								
								<label class="control-label col-sm-2" for="pwd">Date of Birth</label>
									<div class='col-sm-4'>
									<input type="text" name="birth_date" required class="form-control" id="birth_date" value="<?php echo date("d-m-Y",strtotime ($select->dob) );?>" >	
									</div>
								<label class="control-label col-sm-2" for="email">Join Date</label>
								<div class="col-sm-4">
								  <input type="text" name="join_date" required  class="form-control" id="join_date"  value="<?php echo date("d-m-Y",strtotime ($select->join_date) );?>">
								</div>	
								
							</div>
							
							
							<div class="form-group">
								
								<label class="control-label col-sm-2" for="email">Resign Date</label>
								<div class="col-sm-4">
									<input type="text" name="resign_date"  class="form-control" id="resign_date" value=" <?php   if($value->resign_date==""){ echo "dd-mm-yyyy";}else{ echo  $select->resign_date;} ?>" />
								 
								</div>
							<label class="control-label col-sm-2" for="email">National Id</label>
								<div class="col-sm-4">
								   <input type="text" class="form-control" required maxlength="17" name="nid" id="nid"  value="<?php echo $select->nid;?>" onchange="national_id_chk(this.value,this.id,<?php echo $select->nid; ?>);">
								</div>	

							</div>
							
							
						   <div class="form-group">
							 
							<label class="control-label col-sm-2" for="">Phone</label>
								<div class="col-sm-4">   
								  <input type="text" class="form-control" required name="phone" maxlength="14"   value="<?php echo $select->phone;?>">
								</div>
							<label class="control-label col-sm-2" for="">Alternate Phone</label>
								<div class="col-sm-4">   
								  <input type="text" class="form-control" name="alt_phone" maxlength="14" value="<?php echo $select->alt_phone;?>">
								</div>	

						   </div>
							
							<input type="hidden" name="id" value="<?php echo $select->id; ?>"/>
							<input type="hidden" name="empsid" value="<?php echo $select->empid; ?>"/>
							
								
							<div class="form-group">
								<label class="control-label col-sm-2" for="email">Religion</label>
								<div class="col-sm-4">
								  <select  class="form-control" required name="religion" id="religion">
								        
										<option value="Islam" <?php if($select->religion=='Islam'){echo "selected";} ?>>Islam</option>
										<option value="Hindus" <?php if($select->religion=='Hindus'){echo "selected";} ?> >Hindus</option>
										<option value="Buddha" <?php if($select->religion=='Buddha'){echo "selected";} ?> >Buddha</option>
										<option value="Christian" <?php if($select->religion=='Christian'){echo "selected";} ?> >Christian</option>
										<option value="Others" <?php if($select->religion=='Others'){echo "selected";} ?> >Others</option>
								  </select>
								</div>
								<label class="control-label col-sm-2" for="email">Blood Group</label>
								<div class="col-sm-4">
								  <select class="form-control" required name="blood_group" id="blood_group">
								        
										<option value="A+"  <?php if($select->blood=='A+'){echo "selected";} ?>>A+</option>
										<option value="A-"   <?php if($select->blood=='A-'){echo "selected";} ?> >A-</option>
										<option value="O+"  <?php if($select->blood=='O+'){echo "selected";} ?>>O+</option>
										<option value="O-"   <?php if($select->blood=='O-'){echo "selected";} ?>>O-</option>
										<option value="AB+" <?php if($select->blood=='AB+'){echo "selected";} ?>>AB+</option>
										<option value="AB-"  <?php if($select->blood=='AB-'){echo "selected";} ?>>AB-</option>
								  </select>
								</div>
							</div>
							
							
							
							
							
								
							  <div class="form-group">
								<label class="control-label col-sm-2" for="email">Present Address</label>
								<div class="col-sm-4">
								 <textarea rows="4"  style="resize:none;" class="form-control" required  value=""  name="present_address" > <?php echo $select->pre_address;?>  </textarea>
								</div>
								
								<label class="control-label col-sm-2" for="email">Permanent Address</label>
								<div class="col-sm-4">
								   <textarea rows="4"  style="resize:none;" class="form-control" required value=" " name="permanent_address" ><?php echo $select->par_address; ?></textarea>
								</div>
							</div>
							
							 <div class="form-group">
								<label class="control-label col-sm-2" for="email">Gender</label>
								<div class="col-sm-4">
								  <select class="form-control" required name="gender" id="gender">
								        
										<option value="Male"  <?php if($select->gender=='Male'){echo "selected";} ?>>Male</option>
										<option value="Female"   <?php if($select->gender=='Female'){echo "selected";} ?> >Female</option>
										<option value="O+"  <?php if($select->gender=='Common'){echo "selected";} ?>>Common</option>
										
								  </select>
								</div>
								<label class="control-label col-sm-2" for="email">Education Qualification</label>
								<div class="col-sm-4">
								   <textarea rows="4"  style="resize:none;" class="form-control" required  name="edu_qualify" ><?php echo $select->edu_q;?></textarea>
								</div>
							</div>
							  
								
							
						  <div class="form-group"> 
							<div class="col-sm-offset-2 col-sm-10">
							  <button type="submit" class="btn btn-primary" name="submit" id="submit" ><span class="glyphicon glyphicon-send"></span> Update</button> &nbsp;&nbsp;&nbsp;
							  <a href="index.php/employee_section/employee_reg_form"><button type="button" class="btn btn-warning" ><span class="glyphicon glyphicon-backward"></span> Back</button></a>
							</div>
						  </div>
						  
						  	
						</form>

							
						
					  </div>
					  <div class="col-md-2">
					  </div>
					  
					  
					
                    </div>


 </section>
</aside>