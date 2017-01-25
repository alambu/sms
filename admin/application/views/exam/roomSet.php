
<style type="text/css">

	table td {
    border-top: none !important;
}

#s{
	position: relative;
	margin:0px;
	/*top: 500px;*/
}

#rmfoot tr{background: none !important;}
#rmfoot tr td{background: none !important;}
#itemRows2 tr th{text-align: center;}
</style>


<script type="text/javascript">
var rowNum = 0;
var i=0;
function valid1(){
	if(i==0){
		alert('No Data added.First add one or more data.');
		document.getElementById("roomid").focus();
		return false;
	}
}
function addRow(frm) {
	
	// alert(i);
	rowNum ++;
	var roomid=document.getElementById('roomid').value;
	var rname=document.getElementById('rname').value;
	if(roomid==''){
	   alert('Empty Room Number');
	   document.getElementById("roomid").focus();
	   return false;
	}else if(rname==''){
		alert('Empty Room Name');
	   	document.getElementById("rname").focus();
	   	return false;
	}
	else{
	var row = '<tr id="rowNum'+rowNum+'"><td><input type="text" id="roomid'+rowNum+'" name="roomid[]" value="'+frm.roomid.value+'" class="form-control" ></td><td><input type="text" id="rname'+rowNum+'" name="rname[]" value="'+frm.rname.value+'" class="form-control" ></td><td><button type="button" class="btn btn-danger" style="margin-left5px;" onClick="removeRow('+rowNum+');"><span class="glyphicon glyphicon-minus" aria-hidden="true"> Drop</span></button></td></tr>';
	jQuery('#itemRows2').append(row);
	frm.roomid.value = '';
	frm.rname.value = '';
	i++;
	return true;
}
}
function removeRow(rnum) {
	i--;
	//alert(i);
	jQuery('#rowNum'+rnum).remove();
}

function resetAll(){
	for(var j=0;j<=i;j++){
		jQuery('#rowNum'+j).remove();		
	}
}

window.onload=function() {
    setTimeout(function(){ document.getElementById('s').style.display = 'none' }, 3000);
}

// check duplicate value
function chkRm(rmid,rmnm){
	if(rowNum){
		for(var i=1;i<=rowNum;i++){
			var onprmNo=document.getElementById("roomid"+i).value;
			var onprmNm=document.getElementById("rname"+i).value;
			if((parseInt(rmid)==parseInt(onprmNo))&&(rmnm==onprmNm)){
				alert("This room already entered.");
				// document.getElementById("roomid").value='';
				document.getElementById("rname").value='';
				document.getElementById("rname").focus();
			}else{roomChk(rmid,rmnm);}
		}
	}else{roomChk(rmid,rmnm);}
}

function roomChk(rd,rm){
	$.ajax({
		url:"index.php/xmAllRequest/roomDupli",
		type:"POST",
		data:{rno:rd,rmn:rm},
		success:function(data){
			if(parseInt(data)>0){
				alert("This room number already saved.");
				// document.getElementById("roomid").value='';
				document.getElementById("rname").value='';
				document.getElementById("rname").focus();
			}
		}
	});
}

</script>
<!-- <section class="content-header">
    <h1>
        Room Setup
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<section>
<div class="container-fluid">
	<div class="col-md-11"> -->
<?php $this->load->view("exam/success"); ?>

		<div class="panel panel-default" style="margin-top:20px;">
		<div class="panel-heading"><center id="title">Room Setup</center></div>
		  	<div class="panel-body">
		    	<form action="index.php/allSubmit/roomSetup" method="post">
		    		<div class="table-responsive">
		    		<table class="table" id="itemRows2">
		    			<tr>
		    				<th>Room No</th>
		    				<th>Room Name</th>
		    				<th>Action</th>
		    			</tr>
		    			<tr>
		    				<td><input type="text" name="roomid" id="roomid" placeholder="Room Number" class="form-control" onkeypress="return isNumber(event)"></td>
		    				<td>
		    					<input type="text" name="rname" id="rname" class="form-control" placeholder="Room Name" onblur="chkRm(roomid.value,this.value)" />
		    				</td>
		    				<td>
		    					<button type="button" class="btn btn-info" style="height:32px;padding-top:1px;margin-left:2px;" onClick="addRow(this.form);"><span class="glyphicon glyphicon-plus" aria-hidden="true"> ADD</span></button>
		    				</td>
		    			</tr>
		    		</table>
		    		</div>
		    		<table class="table" id="rmfoot">
		    			<tr>
		    			<td style="width:6%;"></td>
		    			
		    				<td>
		    					<button type="submit" name="ok" onclick="return valid1();" class="btn btn-primary" >
		    						<span class="glyphicon glyphicon-send" aria-hidden="true"> Submit
		    						</span>
		    					</button>
		    					<button type="reset" name="ok" class="btn btn-warning" onclick="resetAll()">
		    						<span class="glyphicon glyphicon-refresh" aria-hidden="true"> Reset
		    						</span>
		    					</button>
		    				</td>
		    				<td></td>
		    			</tr>
		    		</table>
				</form>
		 	 </div>
		</div><!-- 
	</div>		
</div>
</section>
</aside>

 -->
