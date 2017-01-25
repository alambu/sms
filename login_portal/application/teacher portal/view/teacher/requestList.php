<script>
  function transfer(sdate,edate,srow,m){
	  document.getElementById('startdate').value=sdate;
	  document.getElementById('enddate').value=edate;	 
	  var emp=document.getElementById('empid'+srow).value;
	  var r=document.getElementById('req'+srow).value;
	document.getElementById("reqidAprove").value=r;
	document.getElementById("emid").value=emp;
	document.getElementById('hid_sv').value=sdate;
	document.getElementById('hid_ev').value=edate;
	document.getElementById('max_l').value=m;
	  
  }
  function rejectemp(reqid,empid,sdate,edate){
	$con=confirm("Are You sure reject this request?");
	if($con==true){		
		 $.ajax({
		  url: "index.php/employee_submit/reject_req",
		  type: 'POST', 
		  data:{reqid:reqid,empid:empid,sdate:sdate,edate:edate}, 
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
</script>
 <script type="text/javascript">
$(document).ready(function () {                
$('#startdate').datepicker({format: "yyyy-mm-dd"});
$('#enddate').datepicker({format: "yyyy-mm-dd"});             
});
</script>

<form  class="form-horizontal" role="form" action="index.php/employee_section/request_list" method="post">
	<table id="example4" class="table table-striped table-bordered">
		<thead>
		  <tr>
			<th>SL.No</th>
			<th>employee id</th>
			<th>Picture</th>
			<th>Name</th>
			<th>Leave Category</th>
			<th>Message</th>
			<th>Request Date</th>
			<th>Status</th>
		  </tr>
		</thead>
		
		<tbody>
<?php
	$nr=1;
	foreach($query as $value){
// this is for request status
		if($value->show_status == 0):
			$msg = "Pending";
		else:
			// check if aproved or rejected
			$appRej = $this->db->select("*")->from("emp_approved")->where("reqid",$value->reqid)->get()->row();
			if($appRej->status == 1):
				$msg = "Approved";
			elseif($appRej->status == 2):
				$msg = "Rejected";
			endif;
		endif;
// request status end
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
								<img src="../school_admin/img/employee_image/<?php echo $value->picture; ?>" class="img-thumbnail" height="70" width="70"/>
								
							</td>
							
							<td>
								<?php echo $value->name;?>
								
							</td>
							
							<td>
								<?php echo $value->lev_type;?>
							</td>

							<td>
								<p><b>From :</b> <?php echo date("d-m-Y",strtotime ($value->sdate) );?><b>&nbsp;&nbsp;  To :</b> <?php echo date("d-m-Y",strtotime ($value->edate) );?></p>
								<p><?php echo $value->comment;?></p>
							</td>
							
							<td>
								<?php $dd = explode(" ",$value->e_date);echo $dd[0]; ?>
							</td>

							<td>
								<label class="label <?php if($msg == 'Approved'):echo 'label-success';elseif($msg == 'Rejected'):echo 'label-danger';else:echo 'label-warning';endif; ?>"><?php echo $msg ?></label>
							</td>
						</tr>
	  
						 <?php $nr++;
										}					 
						 ?>
						 
						</tbody>
						</table>					
						</form>



  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
		<form role="form" action="employee_submit/request_list" method="post">
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
          <button type="submit" name="submit" class="btn btn-info" toggle-dismiss="" id="approb_submit"><span class="glyphicon glyphicon-send"></span> Send</button>
		  
          <button type="button" class="btn btn-danger" data-dismiss="modal" ><span class="glyphicon glyphicon-remove"></span> Close</button>
		  
        </div>
		</form>
      </div>
      
    </div>
  </div>


     <!-- /.content -->
     <!-- /.right-side -->
 
 