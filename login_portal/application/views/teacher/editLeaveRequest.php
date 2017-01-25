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

<?php
	$tid = $this->session->userdata("lidcheck");  // employee id 
	$id = $this->uri->segment(3);

	// query
	$data = $this->db->select("*")->from("emp_reqlev")->where("reqid",$id)->get()->row();

	// select leave duration
	$leaveDuration = $this->db->select("*")->from("emp_levtype")->where("levid",$data->levid)->get()->row();
?>

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
				
				<!--<button type="button" class="btn btn-info" onclick="abc()">Check</button>-->
                  
				
				  
                <!-- Main content -->
				
                <section class="content">					 
				<div class="container-fluid">
					<div class="box">
						<div class="box-body">
						<?php 
						$this->load->view("teacher/success");
						?>
 					    			  
					  <div class="tab-content">

<!---leave Request Form Start-->  
						<div id="leave_request" class="tab-pane fade in active">
							<div class="row" style="margin-top:40px;">
								<div class="col-md-12">
									   <form  class="form-horizontal" action="teacher/editValueSave" method="post">

											  <div class="form-group">
												<div class="col-md-4" id="leavectg">
			<label>Leave Catagory</label>
			<select  class="form-control" name="leave_catagory" required id="status" onchange="leveMax(this.value)" >
				<option  value="">Please Select</option>
			<?php $fetch=$this->db->get("emp_levtype")->result();
					foreach($fetch as $value){
			?>
				<option value="<?php echo $value->levid; ?>" <?php if( $data->levid == $value->levid ):echo "selected";endif; ?> ><?php echo $value->lev_type; ?></option>
			<?php	
				}
			?>
															
			</select>
		</div>
												
													
			<input type="hidden" name="maxlv" id="maxlv" value="<?php echo $leaveDuration->max_lev ?>"/>

			<input type="hidden" name="reqid" id="reqid" value="<?php echo $id ?>"/>
			
			<input type="hidden" name="employee_name" id="employee_name" value="<?php echo $tid; ?>"/>
													
		<div class="col-md-4">
			<label for="pwd">From</label>
			<input type="text" class="form-control"  required name="sdate" placeholder="Enter start Date" id="s_date" onchange="chkDate(this.value)" value="<?php echo $data->sdate; ?>">
		</div> 
													
		<div class="col-md-4"> 
			<label>To</label>
			<input type="text" class="form-control"  required name="edate" placeholder="Enter End Date" id="e_date" onchange="chkDateValid(s_date.value,this.value,maxlv.value);" value="<?php echo $data->edate; ?>">
		</div>
	</div>
											  
			<div class="form-group">
				
				<div class="col-md-6"> 
				<label>Comment</label>
				 <textarea class="form-control" name="request_comment" required placeholder="Please Enter Comment"><?php echo trim($data->comment); ?></textarea>
				</div>
			</div>
													
	  <div class="form-group"> 
		<div class="col-md-3">
		  <button type="submit" class="btn btn-primary" name="submit" id="submit" onclick="val();"><span class="glyphicon glyphicon-send"></span> Submit</button> &nbsp;&nbsp;&nbsp;
		  <a href="teacher/leaveRequest">
		  	<button type="button" class="btn btn-warning">Cancel</button>
		  </a>
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

		
			</div>	
		</div>			  
	</div>
</div>
 </section><!-- /.content -->
 </aside>					
