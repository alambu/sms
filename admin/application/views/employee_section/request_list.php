<script>
  function transfer(sdate,edate,srow,m){
	  document.getElementById('startdate').value=sdate;
	  document.getElementById('enddate').value=edate;	 
	  document.getElementById('error_app').innerHTML='';	 
	  var emp=document.getElementById('empid'+srow).value;
	  var r=document.getElementById('req'+srow).value;
	document.getElementById("reqidAprove").value=r;
	document.getElementById("emid").value=emp;
	document.getElementById('hid_sv').value=sdate;
	document.getElementById('hid_ev').value=edate;
	document.getElementById('max_l').value=m;
	  
  }
  function rejectemp(reqid,empid,sdate,edate,cmnt){
	if(cmnt=='con_1'){  
	document.getElementById("hid_rej_id").value=reqid;  
	document.getElementById("hid_rej_emp_id").value=empid;  
	document.getElementById("hid_rej_sdate").value=sdate;  
	document.getElementById("hid_rej_edate").value=edate;
	}
	else {
	$con=confirm("Are You sure reject this request?");
	if($con==true){		
		 $.ajax({
		  url: "index.php/employee_submit/reject_req",
		  type: 'POST', 
		  data:{reqid:reqid,empid:empid,sdate:sdate,edate:edate,cmnt:cmnt}, 
		  success: function(data)
		  {
			  if(data==1){
				  window.location.href="employee_section/employee_rqst_leave_form";
			  }
			  else{
				  alert('Sorry ! Reject not success.');
			  }
		  }
			});
	}
	else{
		 return false;
	}
	}	
  }
  
  
function chkDate_approval(str,k,sv,ev){
// split date
//alert(str);reqidAprove emid
var getD=str.split("-");
var error=document.getElementById("error_app");
// this is for today
var today=new Date();
var dd=today.getDate();
var mm=today.getMonth()+1;
var yy=today.getFullYear();
 //alert(dd);
// alert(mm);
// alert(yy);

if(parseInt(getD[0])<parseInt(yy)){ 
error.innerHTML="You can't select previous date";
if(k=='startdate'){
$("#"+k).val(sv).datepicker('update');
}
else {
$("#"+k).val(ev).datepicker('update');	
}
return false;
}

else if(parseInt(getD[0])==parseInt(yy) && parseInt(getD[1])<parseInt(mm)){
error.innerHTML="You can't select previous date";
if(k=='startdate'){
$("#"+k).val(sv);
}
else {
$("#"+k).val(ev);	
}
return false;
}

else if(parseInt(getD[0])==parseInt(yy) && parseInt(getD[1])==parseInt(mm) && parseInt(getD[2])<parseInt(dd)){
error.innerHTML="You can't select previous date";
if(k=='startdate'){
$("#"+k).val(sv);
}
else {
$("#"+k).val(ev);	
}
return false;
}
else {
error.innerHTML='';
return true;	
}

}


// check this for two date
function twoDate_modal(st,ed){
var error=document.getElementById('error_app');
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
error.innerHTML="You can't select previous date";
document.getElementById("enddate").focus();
 return false;
}

else if(parseInt(getD[0])==parseInt(yy) && parseInt(getD[1])<parseInt(mm)){
error.innerHTML="You can't select previous date";
//$("#e_date").val('').datepicker('update');
document.getElementById("enddate").focus();
return false;
}

else if(parseInt(getD[0])==parseInt(yy) && parseInt(getD[1])==parseInt(mm) && parseInt(getD[2])<parseInt(dd)){
error.innerHTML="You can't select previous date";
//$("#e_date").val('').datepicker('update');
document.getElementById("enddate").focus();
return false;
}
else{return true;}
}

function chkDateValid_modal(sd,endD,dept){
	//alert(dept);
	var firstChk=twoDate_modal(sd,endD);
	if(firstChk){
	var start=sd.split("-");
	var end=endD.split("-");
	
	var totalD=parseInt(start[2])+parseInt(dept);
	start[2]=totalD;
	var monthDefin=[31,28,31,30,31,30,31,31,30,31,30,31];
	if(totalD>monthDefin[start[1]]){	// if total day greater than month max day
		start[1]++;
	}

	var dd=end[2];
	var mm=end[1];
	var yy=end[0];

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

function chk_max_leave_approved(sd,ed,m,i){
	var error=document.getElementById("error_app");
	var ev=document.getElementById("hid_ev").value;
	var d=sd+"/"+ed+"/"+m;
	$.ajax({
	  url:'employee_submit/ajax_request',
      type:'POST',
      data:{mv_test:d},
      success:function(data){
		  if(data!='ok'){
			  e_date.value='';
			  error.innerHTML=data;
			 // alert(ed);
			  document.getElementById(i).value=ev;
			  return false;
		  }
		  else {
			 error.innerHTML=""; 
		  }
		  
	  }	  
	});
    //return false;
}

function validation_chk(sv,ev){
	if(sv=='' || ev==''){
		alert('Empty From Date Or To Date');
		return false;
	}
	else {
		return true;
	}
}
</script>
 <script type="text/javascript">
$(document).ready(function () {                
$('#startdate').datepicker({format: "yyyy-mm-dd"});
$('#enddate').datepicker({format: "yyyy-mm-dd"});             
});
</script>

									  
						    <form class="form-horizontal" role="form" action="index.php/employee_section/employee_rqst_leave_form" method="post">			
								<div class="form-group">
										<div class="control-label col-sm-2"><label  for="pwd">Employee Type</label></div>
										  <div class="col-md-6">
										  
										 <select  class="form-control" name="categoryname">
										  <option value="">please select</option>
											<?php 
												$select=$this->db->query("select * from  emp_type");
											$fetch=$select->result();
												foreach($fetch as $value){
													?>											
													<option value="<?php   echo $value->emptypeid?>" <?php if($catg==$value->emptypeid){echo 'selected';}?>>
													<?php echo $value->type?>
													</option>
												<?php	
												}
												?>  
										  </select>
									    </div>
										  
										  
								    <div class="col-md-2">
										<button type="submit" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span> Request List</button>
								    </div>
								</div>
						    </form>
						<form  class="form-horizontal" role="form" action="index.php/employee_section/request_list" method="post">

					
                              <table id="example4" class="table table-striped table-bordered">
	
	
									<thead>
									  <tr>
										<th>SL.No</th>
										<th>employee id</th>
										<th>Name</th>
										<th>Leave Category</th>
										<th>Type</th>
										<th>Picture</th>
										<th>Message</th>
										<th>Action</th>
									  </tr>
									</thead>
									<tbody>
	
				
							<?php
							$nr=1;
								foreach($query as $value){
								?>
	
                        <tr>
							<td>
								<?php echo $nr;?>
							</td>
							<td>
							<input type="hidden" name="reqid" id="req<?php echo $nr; ?>" value="<?php echo $value->reqid; ?>" />
							<input type="hidden" name="empid" id="empid<?php echo $nr; ?>" value="<?php echo $value->empid ?>" />
								<?php    echo  $value->empid?>
							</td>
							
							<td>
								<?php echo $value->name;?>
							</td>
							
							<td>
								<?php echo $value->lev_type;?>
							</td>
							
							<td><?php echo $value->type;?>
								<input type="hidden" id="sdates<?php echo $nr?>" value="<?php echo date("Y-m-d",strtotime ($value->sdate) );?>"/>
								<input type="hidden" id="edates<?php echo $nr?>" value="<?php echo date("Y-m-d",strtotime ($value->edate) );?>"/>
							</td>
							<td>
								<img src="img/employee_image/<?php echo $value->picture; ?>" class="img-thumbnail" height="70" width="70"/>
							</td>
							<td>
							<p><b>From :</b> <?php echo date("d-m-Y",strtotime ($value->sdate) );?><b>&nbsp;&nbsp;  To :</b> <?php echo date("d-m-Y",strtotime ($value->edate) );?></p>
								<p><?php echo $value->comment;?></p>
								
							</td>
							
		                    <td>

								<button type="submit" name="approved" onclick="transfer(sdates<?php echo $nr?>.value,edates<?php echo $nr?>.value,<?php echo $nr?>,<?php echo $value->max_lev; ?>)" class="btn btn-info" data-toggle="modal" data-target="#myModal_app"><span class="glyphicon glyphicon-ok"></span> Approved</button>
								
								<button type="button" name="reject" class="btn btn-danger" data-toggle="modal" data-target="#myModal_rej" onclick="rejectemp(req<?php echo $nr?>.value,empid<?php echo $nr?>.value,sdates<?php echo $nr?>.value,edates<?php echo $nr?>.value,'con_1')"><span class="glyphicon glyphicon-remove"></span> Reject</button>
								<!------onclick="return rejectemp(req<?php //echo $nr?>.value,empid<?php //echo $nr?>.value,sdates<?php //echo $nr?>.value,edates<?php //echo $nr?>.value)"--->
								
							</td>
		
						</tr>
	  
						 <?php $nr++;
										}					 
						 ?>
						 
						</tbody>
						</table>					
						</form>


<!----------Approved modal start------------>

  <!-- Modal -->
  <div class="modal fade" id="myModal_app" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
		<form role="form" action="employee_submit/request_list" method="post" onsubmit="return validation_chk(startdate.value,enddate.value);">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Leave Approved</h4>
		  
        </div>
        <div class="modal-body">
			  <div class="form-group">
				<label id="error_app" style="font-size:17px;font-weight:bold;color:red;"></label>
			  </div>	
			  <div class="form-group">
				<input type="hidden" name="emid" id="emid" />
				<input type="hidden" name="reqidAprove" id="reqidAprove" />
				<input type="hidden" name="" id="hid_ev" />
				<input type="hidden" name="" id="hid_sv" />
				<input type="hidden" name="" id="max_l" />
				<label>From:</label>
				<input type="text"  class="form-control" id="startdate" onchange="chkDate_approval(this.value,this.id,hid_sv.value,hid_ev.value);" name="startdate" required value="">
			  </div>
			  <div class="form-group">
				<label >To:</label>
				<input type="text"  class="form-control" id="enddate" onchange="chkDate_approval(this.value,this.id,hid_sv.value,hid_ev.value);chk_max_leave_approved(startdate.value,enddate.value,max_l.value,this.id);" name="enddate" required value="">
			  </div>
			  <div class="form-group">
				<label for="pwd">Message:</label>
				<textarea class="form-control" required rows="4" name="message"></textarea>
			  </div>
			  
			
			  
		
        </div>
        <div class="modal-footer">
          <button type="submit" name="submit" class="btn btn-info"  id="approb_submit"><span class="glyphicon glyphicon-send"></span> Send</button>
		  
          <button type="button" class="btn btn-danger" data-dismiss="modal" ><span class="glyphicon glyphicon-remove"></span> Close</button>
		  
        </div>
		</form>
      </div>
      
    </div>
  </div>

<!----------Approved modal End------------>


<!----------Reject Modal Start------------>
	<div class="modal fade" id="myModal_rej" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Comment</h4>
        </div>
        <div class="modal-body">
		  <input type="hidden" id="hid_rej_id" value=""/>
		  <input type="hidden" id="hid_rej_emp_id" value=""/>
		  <input type="hidden" id="hid_rej_sdate" value=""/>
		  <input type="hidden" id="hid_rej_edate" value=""/>
		  <label>Write Comment</label>
          <textarea class="form-control" id="reject_cmnt"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button"  class="btn btn-info" onclick="return rejectemp(hid_rej_id.value,hid_rej_emp_id.value,hid_rej_sdate.value,hid_rej_edate.value,reject_cmnt.value);">Reject</button>
		  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!----------Reject Modal End-------------->
