<script type="text/javascript">
$(document).ready(function () {               
$('#s_date').datepicker({format: "yyyy-mm-dd"});
$('#e_date').datepicker({format: "yyyy-mm-dd"});
          
});
</script>

<script>
 function val()
    {
      if(document.getElementById("textAread_id").value==null || document.getElementById("textAread_id").value=="")
alert("blank text area");
    } 
</script>

<script type="text/javascript">

// check valid exam date
function chkDate(str){
// split date
var getD=str.split("-");
// this is for today
var today=new Date();
var dd=today.getDate();
var mm=today.getMonth()+1;
var yy=today.getFullYear();
// alert(dd);
// alert(mm);
// alert(yy);

if(parseInt(getD[0])<parseInt(yy)){ 
alert("You can't select previous date");
$("#s_date").val('').datepicker('update');
// return 0;
}

else if(parseInt(getD[0])==parseInt(yy) && parseInt(getD[1])<parseInt(mm)){
alert("You can't select previous date");
$("#s_date").val('').datepicker('update');
}

else if(parseInt(getD[0])==parseInt(yy) && parseInt(getD[1])==parseInt(mm) && parseInt(getD[2])<parseInt(dd)){
alert("You can't select previous date");
$("#s_date").val('').datepicker('update');
}

}

// check this for two date
function twoDate(st,ed){
// split date
var getD=ed.split("-");
var edD=st.split("-");
// this is for today
//var today=new Date();
var dd=edD[2];
var mm=edD[1];
var yy=edD[0];
// alert(dd);
// alert(mm);
// alert(yy);

if(parseInt(getD[0])<parseInt(yy)){ 
alert("You can't select previous date");
$("#e_date").val('').datepicker('update');
 return false;
}

else if(parseInt(getD[0])==parseInt(yy) && parseInt(getD[1])<parseInt(mm)){
alert("You can't select previous date");
$("#e_date").val('').datepicker('update');
return false;
}

else if(parseInt(getD[0])==parseInt(yy) && parseInt(getD[1])==parseInt(mm) && parseInt(getD[2])<parseInt(dd)){
alert("You can't select previous date");
$("#e_date").val('').datepicker('update');
return false;
}
else{return true;}
}
</script>


<script type="text/javascript">


// ajax function 
function leveMax(str){
	if(parseInt(str)!=''){
		$('#status').removeClass( "error");
	}
$.ajax({
	url:"index.php/employee_submit/maxlv",
	type:"POST",
	data:{d:str},
	success:function(data){
		document.getElementById("maxlv").value=data;
	}
});
document.getElementById("e_date").value='';
}

function chkDateValid(str,endD,dept){
	var firstChk=twoDate(str,endD);
	if(firstChk){
	var start=str.split("-");
	var end=endD.split("-");
	
	var totalD=parseInt(start[2])+parseInt(dept);
	start[2]=totalD;
	var monthDefin=[31,28,31,30,31,30,31,31,30,31,30,31];
	if(totalD>monthDefin[start[1]]){	// if total day greater than month max day
		start[1]++;
	}
	
	// check if total date overflow deft date
var dd=end[2];
var mm=end[1];
var yy=end[0];
// alert(dd);
// alert(mm);
// alert(yy);

if(parseInt(start[0])<parseInt(yy)){ 
alert("You can't select previous date");
$("#e_date").val('').datepicker('update');
// return 0;
}

else if(parseInt(start[0])==parseInt(yy) && parseInt(start[1])<parseInt(mm)){
alert("Sorry. You don't know maxium leaves. please try again...");
$("#e_date").val('').datepicker('update');
}

else if(parseInt(start[0])==parseInt(yy) && parseInt(start[1])==parseInt(mm) && parseInt(start[2])<parseInt(dd)){
alert("Sorry. You don't know maxium leaves. please try again...");
$("#e_date").val('').datepicker('update');
}

}	
}

</script>


<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
            			 Edit Employee  Leave  Request 
                        <small>Control panel</small>
                    </h1>
					
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Edit Employee Leave  Request  </li>
                    </ol>
                </section>

                <!-- Main content -->
				
                <section class="content">

                    <div class="row">
                       <div class="col-md-10">
							
						<form  class="form-horizontal" role="form" action="index.php/employee_edit/edit_employee_leave_report" method="post" enctype="multipart/form-data" >

											
						 
								<?php                           
																
								$name=$_GET['name'];
								$empid=$_GET['empid'];  
								$id=$_GET['id'];
								$select=$this->db->select("*")
								->from("emp_reqlev")
								->where("reqid", $id)
								->get()
								->row();
								$mxd=$this->db->select("*")->from("emp_levtype")->where("levid",$select->levid)->get()->row();

								?>
						         
						
						
						  <div class="form-group">
								
								<label class="control-label col-sm-2" for="pwd">Employee Name</label>
								<div class="col-sm-4"> 
								   <input type="text" class="form-control" disabled value="<?php echo $name.'('.$empid.')';?>" name="emp_name">
								</div>
							
							
								<label class="control-label col-sm-2" for="email">Leave Catagory</label>
							<div class="col-sm-4"  id="leavectg">
							 <select  class="form-control" name="leave_catagory" required id="status" onchange="leveMax(this.value)" >
							          <option  value="">please select</option>
								        <?php 
										$select2=$this->db->query("select  * from  emp_levtype");
									$fetch=$select2->result();
										foreach($fetch as $value){
											
											?>
											<option <?php if($select->levid==$value->levid){echo 'selected';} ?> value="<?php echo $value->levid; ?>"><?php echo $value->lev_type ?></option>
											
										<?php
                                      										
										}
										?>
										
							  </select>
							</div>
								
								
						  </div>
						
						 <input type="hidden" name="maxlv" id="maxlv" value="<?php  echo $mxd->max_lev  ?>" />
						
						
						  <div class="form-group">
							<label class="control-label col-sm-2" for="pwd">Start Date</label>
								<div class="col-sm-4"> 
								 <input type="text" class="form-control" required id="s_date" onchange="chkDate(this.value)" name="request_start_date" value="<?php echo date("Y-m-d",strtotime($select->sdate) ); ?> ">
								</div>
								
								
								<label class="control-label col-sm-2" for="pwd">End Date</label>
								<div class="col-sm-4"> 
								   <input type="text" class="form-control"  required name="request_end_date" placeholder="Enter End Date" id="e_date" onchange="return chkDateValid(s_date.value,e_date.value,maxlv.value)" value="<?php echo date("Y-m-d",strtotime ($select->edate) ); ?> ">
								</div>
								
						    </div>
								
								
							<div class="form-group">
								<label class="control-label col-sm-2" for="pwd">Comment</label>
								<div class="col-sm-4">
								 <textarea class="form-control" required name="request_comment" ><?php echo trim($select->comment);?></textarea>
								</div>
								<label class="control-label col-sm-2" for="pwd"></label>
								<div class="col-sm-4"> 
								</div>
							</div>
								
								<input type="hidden" name="id" value="<?php echo $id; ?>" />
							
						
							
						  <div class="form-group"> 
							<div class="col-sm-offset-2 col-sm-10">
							  <button type="submit" class="btn btn-primary" onclick="val();" name="submit" id="Update"><span class="glyphicon glyphicon-send"></span> Submit</button> &nbsp;&nbsp;&nbsp;
							  
							  <a href="index.php/employee_section/employee_rqst_leave_form"><button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-backward"></span> Back</button></a>
							</div>
						  </div>
						</form>

							
						</div>
					  </div>
					  
					
					  
                    </div>

                </section><!-- /.content -->
				
</aside><!-- /.right-side -->     <!---rightbar close here ---->
