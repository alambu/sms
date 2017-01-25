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

<script type="text/javascript">
$(document).ready(function(){
 $('a[data-toggle="tab"]').on('show.bs.tab', function(e){
  localStorage.setItem('activeTab', $(e.target).attr('href'));
 });
 var activeTab = localStorage.getItem('activeTab');
 if(activeTab){
  $('#myTab a[href="' + activeTab + '"]').tab('show');
 }
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
	//alert(str);
	if(parseInt(str)!=''){
		$('#status').removeClass( "error");
	}
   $.ajax({
	url:"teacher/maxlv",
	type:"POST",
	data:{d:str},
	success:function(data){
		document.getElementById("maxlv").value=data;
	}
    });
document.getElementById("e_date").value='';
}

function chkDateValid(str,endD,dept){
	if( dept == '' || parseInt(dept) == null ){
		document.getElementById("status").focus();
		alert("Pls select leave category first.");
	}
	else if( str == '' ){
		document.getElementById("s_date").focus();
		alert("Pls select start date first.");
		$("#e_date").val('').datepicker('update');
	}else{
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
}

</script>

<?php $tid=$this->session->userdata("lidcheck");  // employee id ?>

<aside class="right-side">      <!---rightbar start here -->
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
				
                <!-- Main content -->
				
    <section class="content">					 
	<div class="container-fluid">
		<div class="box">
			<div class="box-body">
			<?php 
			$this->load->view("teacher/success");
			?>
			    <ul class="nav nav-tabs" id="myTab">
				<li class="active"><a data-toggle="tab" href="#leave_request" style="font-weight:bold;">Leave Request</a></li>
				<li><a data-toggle="tab" href="#all_type" style="font-weight:bold;">Request History</a></li>
			</ul>			  
		  <div class="tab-content">

<!---leave Request Form Start-->  
		<div id="leave_request" class="tab-pane fade in active">
		<div class="row" style="margin-top:40px;">
		<div class="col-md-12">
		   <form  class="form-horizontal" action="teacher/employee_rqst_leave_form" method="post">

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
												
													
			<input type="hidden" name="maxlv" id="maxlv" value=""/>
			<input type="hidden" name="employee_name" id="employee_name" value="<?php echo $tid; ?>"/>
													
		<div class="col-md-4">
			<label for="pwd">From</label>
			<input type="text" class="form-control"  required name="request_start_date" placeholder="Enter start Date" id="s_date" onchange="chkDate(this.value)">
		</div> 
													
		<div class="col-md-4"> 
			<label>To</label>
			<input type="text" class="form-control"  required name="request_end_date" placeholder="Enter End Date" id="e_date" onchange="chkDateValid(s_date.value,this.value,maxlv.value);">
		</div>
	</div>
											  
			<div class="form-group">
				
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
						
<!---Leave Request Form End-->

	
<!---Leave Request SHow Start-->					
						
	<div id="all_type" class="tab-pane fade">
		<div class="row" style="margin-top:40px;">
			<div class="col-md-12">
				<?php
				$data=array();
				$select=$this->db->query("SELECT emp_reqlev.reqid,emp_reqlev.show_status,emp_reqlev.e_date,empee.name,empee.empid,empee.picture,emp_reqlev.sdate,emp_reqlev.edate,emp_reqlev.comment,emp_reqlev.levid,emp_type.type,emp_levtype.lev_type,emp_levtype.max_lev from emp_reqlev left join empee on emp_reqlev.empid=empee.empid left join emp_type on emp_type.emptypeid=empee.emptypeid left join emp_levtype on emp_levtype.levid=emp_reqlev.levid where empee.empid=$tid ORDER BY reqid DESC");
				$data['query']=$select->result();
				$data['catg']='';
				$this->load->view('teacher/requestList',$data);
				?>
			</div>	
		</div>
	</div>
<!--Leave Request SHow End-->		
			</div>	
		</div>			  
	</div>
</div>
 </section><!-- /.content -->
 </aside>					
