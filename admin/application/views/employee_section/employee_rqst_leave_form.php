<script type="text/javascript">
$(document).ready(function () {               
$('#s_date').datepicker({format: "yyyy-mm-dd"});
$('#e_date').datepicker({format: "yyyy-mm-dd"});
          
});


function comment(){
	var cmnt= document.getElementById(com).value;
	alert('Please Write Your Comment');
	if(cmnt==''){
		return false;
	}
	else{
		return true;
	}
}
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
	//alert(str);
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
	//alert(dept);
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

function chk_max_leave(sd,ed,m,cat,em){
	var error=document.getElementById("error");
	var e_date=document.getElementById("e_date");
	var s_date=document.getElementById("s_date");
	var emp_n=document.getElementById("emp_n");
	if(cat==''){
	error.innerHTML="Please Select Leave Catagory";
	e_date.value="";
	document.getElementById("status").focus();
	return false;
	}
	if(em==''){
	error.innerHTML="Please Select Employee";
	e_date.value="";
	document.getElementById("emp_n").focus();
	return false;
	}
	else if(sd==''){
	error.innerHTML="Please Select Start Date";
    e_date.value="";	
	//s_date.focus();
	return false;
	}
	var d=sd+"/"+ed+"/"+m;
	$.ajax({
	  url:'employee_submit/ajax_request',
      type:'POST',
      data:{mv_test:d},
      success:function(data){
		  if(data!='ok'){
			  e_date.value='';
			  error.innerHTML=data;
			  return false;
		  }
		  else {
			 error.innerHTML=""; 
		  }
		  
	  }	  
	});
}
</script>



<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
            			Leave  Request 
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Employee Leave  Request  </li>
                    </ol>
                </section>
				
				<!--<button type="button" class="btn btn-info" onclick="abc()">Check</button>-->
                  
				
				  
                <!-- Main content -->
				
                <section class="content">					 
				<div class="container-fluid">
					<?php 
						$this->load->view("employee_section/success");
					?>
					<div class="box">
						<div class="box-body">
 					    <ul class="nav nav-tabs" id="myTab">
							<li class="active"><a data-toggle="tab" href="#leave_request" style="font-weight:bold;"><span class="glyphicon glyphicon-sort"></span> Leave Request</a></li>
							<li><a data-toggle="tab" href="#all_type" style="font-weight:bold;"><span class="glyphicon glyphicon-list-alt"></span> View Request</a></li>
							<li><a data-toggle="tab" href="#exp_request" style="font-weight:bold;"><span class="glyphicon glyphicon-remove-circle"></span> Expeired Request</a></li>
							<li><a data-toggle="tab" href="#request_his" style="font-weight:bold;"><span class="glyphicon glyphicon-book"></span> Request History</a></li>
							
						</ul>			  
					  <div class="tab-content">

<!--------------leave Request Form Start------------------->
				<div id="exp_request" class="tab-pane fade">
				<script>
				function request_cancel_confirm(){
					var con=confirm('Are You Sure Cancel?');
					if(con==true){
						return true;
					}
					else {
						return false;
					}
				}
				</script>
					<?php 
						if(isset($_GET['riq_c'])){
							extract($_GET);
							$req=$this->db->query("select * from emp_reqlev where reqid='$riq_c'")->row();
							$user_id=$this->session->userdata('userid');
							$e_date=date("Y-m-d h:i:a");
							$comment="This Request Cancel For Not Response During Request Date";
							$insert_data=array(
							'levaprov'=>'',
							'userid'=>$user_id,
							'reqid'=>$req->reqid,
							'sdate'=>$req->sdate,
							'edate'=>$req->edate,
							'comment'=>$comment,
							'status'=>"3",
							'e_date'=>$e_date,
							'e_user'=>$user_id
							);
							//update emp_reqlev table start
							$s=1;
							$up_data=array('show_status'=>$s,'up_date'=>$e_date,'up_user'=>$user_id);
							$this->db->where("reqid",$req->reqid);
							$this->db->update("emp_reqlev",$up_data);
							// update emp_reqlev table End
							
							//insert emp_approved table start
							$in=$this->db->insert("emp_approved",$insert_data);
							if($in){
								redirect('employee_section/employee_rqst_leave_form','location');
							}
							//insert emp_approved table end
						}
					?>
					<h3>All Expeired Request</h3>
				    <table id="example6" class="table table-bordered table-condensed">
					<?php 
					$today=date("Y-m-d");
					$experied=$this->db->query("select emp_reqlev.reqid,empee.name,empee.empid,empee.picture,empee.nickN,emp_reqlev.sdate,emp_reqlev.edate,emp_reqlev.comment,emp_reqlev.levid,emp_type.type,emp_levtype.lev_type,emp_levtype.max_lev from emp_reqlev left join empee on emp_reqlev.empid=empee.empid left join emp_type on emp_type.emptypeid=empee.emptypeid left join emp_levtype on emp_levtype.levid=emp_reqlev.levid where emp_reqlev.show_status='0' and emp_reqlev.edate<'$today'")->result();
					?>
					<thead>
						<tr>
							<th>SL.No</th>
							<th>Employee ID</th>
							<th>Name</th>
							<th>Leave Catagory</th>
							<th>Type</th>
							<th>Picture</th>
							<th>Message</th>
							<th>Action</th>
						</tr>
					</thead>	
					<tbody>	
						<?php 
						$i=1;
						foreach($experied as $value){
						?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $value->empid; ?></td>
							<td><?php echo $value->name.'  ('.$value->nickN.')'; ?></td>
							<td><?php echo $value->lev_type; ?></td>
							<td><?php echo $value->type; ?></td>
							<td><img src="img/employee_image/<?php echo $value->picture; ?>" class="img-thumbnail" height="70" width="70"/></td>
							<td>
							<p><b>From :</b> <?php echo date("d-m-Y",strtotime ($value->sdate) );?><b>&nbsp;&nbsp;  To :</b> <?php echo date("d-m-Y",strtotime ($value->edate) );?></p>
								<p><?php echo $value->comment;?></p>
								
							</td>
							<td>
								<a href="employee_section/employee_rqst_leave_form?riq_c=<?php echo $value->reqid; ?>" onclick="return request_cancel_confirm();">
								<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Cancel</button>
								</a>
							</td>
						</tr>
						<?php 	
						}
						?>
					</tbody>
				    
					</table>
				</div>
<!--------------leave Request Form Start------------------->  



<!--------------leave Request Form Start------------------->  
						<div id="leave_request" class="tab-pane fade in active">
							<div class="row" style="margin-top:40px;">
								<div class="col-md-12">
									   <form  class="form-horizontal" action="employee_submit/employee_rqst_leave_form" method="post">

											  <div class="form-group">
												<div class="col-md-4" id="leavectg">
												<label>Leave Catagory</label>
												  <select  class="form-control" name="leave_catagory" required id="status" onchange="leveMax(this.value)" >
														  <option  value="">Please Select</option>
															<?php 
															$fetch=$this->db->get("emp_levtype")->result();
															foreach($fetch as $value){
																?>
																<option value="<?php echo $value->levid; ?>"><?php echo $value->lev_type; ?></option>
															<?php	
															}
															?>
															
												  </select>
												</div>
												
													 
													 
												   
													<div class="col-md-4"> 
													 <label>Employee</label>
													 <input type="hidden" name="maxlv" id="maxlv" value=""/>
													<select  class="form-control" name="employee_name" id="emp_n" required>
														<option  value="">Please Select</option>
															<?php 
																$fetch=$this->db->select("*")->from("empee")->where("status","0")->get()->result();
																foreach($fetch as $value){ 
																?>
																<option value="<?php  echo $value->empid;   ?>"><?php echo $value->name; ?></option>
															<?php	
															}
															?>  
													 </select>
													</div>
													 <div class="col-md-4">
													 <label for="pwd">From</label>
													 <input type="text" class="form-control"  required name="request_start_date" placeholder="Enter start Date" id="s_date" onchange="chkDate(this.value)">
													 </div> 
													
											  </div>
											  
												<div class="form-group">
													
													<div class="col-md-4"> 
													<label>To</label>
													   <input type="text" class="form-control"  required name="request_end_date" placeholder="Enter End Date" id="e_date" onchange="chk_max_leave(s_date.value,this.value,maxlv.value,status.value,emp_n.value);">
													   
													   <!--return chkDateValid(s_date.value,e_date.value,maxlv.value);-->
													</div>
													<div class="col-md-6"> 
													<label>Comment</label>
													 <textarea class="form-control" name="request_comment" required placeholder="Please Enter Comment"></textarea>
													</div>
												</div>
													
												
												
												
												
												
											  <div class="form-group"> 
												<div class="col-md-3">
												  <button type="submit" class="btn btn-primary" name="submit" id="submit" onclick="val();"><span class="glyphicon glyphicon-send"></span> Submit</button> &nbsp;&nbsp;&nbsp;
												  <button type="reset" class="btn btn-warning"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
												</div>
												<div class="col-md-6">
													<span id="error" style="font-size:15px;font-weight:bold;color:red;"></span>
												</div>
											  </div>
											</form>	 			
											
								</div>
							</div>			  
						  
						</div>
						
<!------------------Leave Request Form End--------------->

	
<!------------------Leave Request SHow Start------------->					
						
						<div id="all_type" class="tab-pane fade">
							 <div class="row" style="margin-top:40px;">
									<div class="col-md-12">
										<?php
										$data=array();
										$today=date("Y-m-d");
										$select=$this->db->query("select emp_reqlev.reqid,empee.name,empee.empid,empee.picture,emp_reqlev.sdate,emp_reqlev.edate,emp_reqlev.comment,emp_reqlev.levid,emp_type.type,emp_levtype.lev_type,emp_levtype.max_lev from emp_reqlev left join empee on emp_reqlev.empid=empee.empid left join emp_type on emp_type.emptypeid=empee.emptypeid left join emp_levtype on emp_levtype.levid=emp_reqlev.levid where emp_reqlev.show_status='0' and emp_reqlev.edate>='$today'");
										$data['query']=$select->result();
										$data['catg']='';
										$this->load->view('employee_section/request_list',$data);
										?>
									</div>	
							 </div>
						</div>
<!------------------Leave Request SHow End------------->							
						
<!------------------Request History Show Start---------->						
						 <div id="request_his" class="tab-pane fade">
							 <div class="row" style="margin-top:40px;">
								<div class="col-md-12">
										<?php 
										$data=array();
										extract($_POST);
										$data=array();
										if($start_date!=''){
												  $ssdate=date('Y-m-d',strtotime($start_date));
										}
										if($end_date!=''){
												  $eedate=date('Y-m-d',strtotime($end_date));
										}
										if(empty($leavctg) && empty($start_date) && empty($end_date) && $status==''){
									
											 $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,b.status,a.e_date
										   from  emp_reqlev as a left join emp_approved as b  on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid")->result();
											$data['sdates']=$sdate;
										   $data['edates']=$edate;
										   $data['leavctg']=$leavctg;
										   $data['status']=$status; 
										  $this->load->view('employee_section/employee_leave_report',$data);
										  
										}
										
										elseif(empty($start_date) && empty($end_date) && $status=='' ){
										
										 $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,b.status,a.e_date
										   from  emp_reqlev as a left join emp_approved as b on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where a.levid='$leavctg'")->result();	
											  $data['sdates']=$sdate;
										   $data['edates']=$edate;
										   $data['leavctg']=$leavctg;
										   $data['status']=$status;
										  $this->load->view('employee_section/employee_leave_report',$data);
										}
										
										
										elseif(empty($start_date)&&empty($end_date)&&empty($leavctg)&&($status!='')){
											
										 if($status==0){
											$data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,a.e_date
										   from emp_reqlev as a left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where a.show_status='$status'")->result();
										  
										   $data['sdates']=$sdate;
										   $data['edates']=$edate;
										   $data['leavctg']=$leavctg;
										   $data['status']=$status;
										 }
										 else{
											$data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,b.status,a.e_date
										   from emp_reqlev as a  left join emp_approved as b on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where b.status='$status'")->result();
										  $data['sdates']=$sdate;
										   $data['edates']=$edate;
										   $data['leavctg']=$leavctg;
										   $data['status']=$status; 
										 }
										  $this->load->view('employee_section/employee_leave_report',$data);
										}
										
										
										
										elseif(empty($leavctg) && $status==''){
										
										 $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,b.status,a.e_date
										   from emp_reqlev as a left join emp_approved as b on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where date(a.e_date) between '$ssdate' AND '$eedate'")->result();
										   $data['sdates']=$sdate;
										   $data['edates']=$edate;
										   $data['leavctg']=$leavctg;
										   $data['status']=$status;		   
										  $this->load->view('employee_section/employee_leave_report',$data);
										}
										
										elseif(empty($start_date) && empty($end_date)&& $status==''){	
										
										$data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,b.status,a.e_date
										   from emp_reqlev as a  left join emp_approved as b on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where b.status='$status' AND a.levid='$leavctg'")->result();	
										   $data['sdates']=$sdate;
										   $data['edates']=$edate;
										   $data['leavctg']=$leavctg;
										   $data['status']=$status;
										  $this->load->view('employee_section/employee_leave_report',$data);
										}
										
										elseif($status==''){	
									
										$data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,b.status,a.e_date
										   from emp_reqlev as a left join emp_approved as b on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where a.levid='$leavctg' AND date(a.e_date) between '$ssdate' AND '$eedate' ")->result();	
											$data['sdates']=$sdate;
										   $data['edates']=$edate;
										   $data['leavctg']=$leavctg;
										   $data['status']=$status;
										  $this->load->view('employee_section/employee_leave_report',$data);
										}
										
										elseif(empty($leavctg)&& $status==''){
										
										$data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,b.status,a.e_date
										   from emp_reqlev as a  left join emp_approved as b  on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where date(a.e_date) between '$ssdate' AND '$eedate' AND b.status='$status'")->result();	
											 $data['sdates']=$sdate;
										   $data['edates']=$edate;
										   $data['leavctg']=$leavctg;
										   $data['status']=$status;
										  $this->load->view('employee_section/employee_leave_report',$data);
										}
										
										elseif(empty($leavctg)){
											 if($status==0){
										
										$data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,b.status,a.e_date
										   from emp_reqlev as a  left join emp_approved as b  on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where date(a.e_date) between '$ssdate' AND '$eedate' AND a.show_status='$status'")->result();	
											 $data['sdates']=$sdate;
										   $data['edates']=$edate;
										   $data['leavctg']=$leavctg;
										   $data['status']=$status;
										}
										else
											
										{
											$data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,b.status,a.e_date
										   from emp_reqlev as a  left join emp_approved as b  on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where date(a.e_date) between '$ssdate' AND '$eedate' AND b.status='$status' ")->result();	
											 $data['sdates']=$sdate;
										   $data['edates']=$edate;
										   $data['leavctg']=$leavctg;
										   $data['status']=$status;
										 
										}
										$this->load->view('employee_section/employee_leave_report',$data);
										}
										
											elseif(empty($start_date)&&empty($end_date)){
											 if($status==0){
										
										$data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,b.status,a.e_date
										   from emp_reqlev as a  left join emp_approved as b  on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where a.levid='$leavctg' AND a.show_status='$status'")->result();	
											 $data['sdates']=$sdate;
										   $data['edates']=$edate;
										   $data['leavctg']=$leavctg;
										   $data['status']=$status;
										}
										else
											
										{
											$data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,b.status,a.e_date
										   from emp_reqlev as a  left join emp_approved as b  on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where a.levid='$leavctg'  AND b.status='$status' ")->result();	
											 $data['sdates']=$sdate;
										   $data['edates']=$edate;
										   $data['leavctg']=$leavctg;
										   $data['status']=$status;
										 
										}
										$this->load->view('employee_section/employee_leave_report',$data);
										}
										
										
											
									else{
										 if($status==0){
										 $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,b.status,a.e_date
										   from emp_reqlev as a  left join emp_approved as b on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where a.show_status='$status' AND date(a.e_date) between '$ssdate' AND '$eedate' AND a.levid='$leavctg'")->result();	
										   $data['sdates']=$sdate;
										   $data['edates']=$edate;
										   $data['leavctg']=$leavctg;
										   $data['status']=$status; 
										 }
										 
										else{
											 $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,b.status,a.e_date
											from emp_reqlev as a  left join emp_approved as b on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where b.status='$status' AND date(a.e_date) between '$ssdate' AND '$eedate' AND a.levid='$leavctg'")->result();	
											$data['sdates']=$sdate;
											$data['edates']=$edate;
											$data['leavctg']=$leavctg;
											$data['status']=$status;
									
										  }
										$this->load->view('employee_section/employee_leave_report',$data);
									  }
											
											 ?>
								 
								</div>
							 </div>
						 </div>
						 
<!------------------Request History Show End---------->
						 
						
			</div>	
		</div>			  
	</div>
</div>
 </section><!-- /.content -->
 </aside>					
