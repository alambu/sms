<style type="text/css">
	table tr td {
    border-top: none !important;

}
table tr th{
	text-align: center;
}


input[type="text"]:valid {
    color: green;
}

input[type="text"]:valid ~ .input-validation::before {
    /*content: "✓";*/
    color: green;
}

input[type="text"]:invalid {
    color: red;
}

</style>

<script type="text/javascript">
// var rowNum = 0;
// var i=0;

function gradingEnt(){
	
	// alert(i);
	// rowNum ++;
	var gradeSet=document.getElementById('gradeSet').value;
	var pointSet=document.getElementById('pointSet').value;
	var smark=document.getElementById('smark').value;
	var emark=document.getElementById('emark').value;
	var comment=document.getElementById('comment').value;
	
	if(gradeSet==''){
	   alert('Empty grade');
	   document.getElementById("gradeSet").focus();
	   return false;
	}else if(pointSet==''){
		alert('Empty point');
	   document.getElementById("pointSet").focus();
	   return false;
	}else if(smark==''){
		alert('Empty Start Mark');
	   document.getElementById("smark").focus();
	   return false;
	}else if(emark==''){
		alert('Empty End Mark');
	   document.getElementById("emark").focus();
	   return false;
	}
	
	else{
	// var row = '<tr id="rowNum'+rowNum+'"><td><input type="text" id="gd'+rowNum+'" name="gradeSet[]" value="'+frm.gradeSet.value+'" class="form-control" ></td><td><input type="text" name="pointSet[]" class="form-control" value="'+frm.pointSet.value+'" /></td><td><input type="text" name="smark[]" class="form-control" value="'+frm.smark.value+'" style="max-width:50px;float:left;" /><span class="glyphicon glyphicon-minus" aria-hidden="true" style="margin-top:8px;"></span><input type="text" name="emark[]" class="form-control" value="'+frm.emark.value+'" style="max-width:50px;float:right;" /></td><td><input type="text" name="comment[]" class="form-control" value="'+frm.comment.value+'"/></td><td><button type="button" class="btn btn-danger" style="margin-left5px;" onClick="removeRow('+rowNum+');"><span class="glyphicon glyphicon-minus" aria-hidden="true">Drop</span></button></td></tr>';
	// jQuery('#itemRows').append(row);
	// frm.gradeSet.value = '';
	// frm.pointSet.value = '';
	// frm.smark.value = '';
	// frm.emark.value = '';
	// frm.comment.value = '';
	// i++;
	return true;
}
}


// check duplicate value
function chkgd(str){
	var pt=/[ABCDF]{1}[+-]{0,1}/;
	
	if(pt.test(str)){

	$.ajax({
		url:"index.php/xmAllRequest/chkgd",
		type:"POST",
		data:{d:str},
		success:function(data){
			if(data>0){
				alert("This grade already inserted.Please type another one.");
				document.getElementById("gradeSet").value="";
				document.getElementById("gradeSet").focus();
			}
		}
	});
}else{
	alert("This grade name doesn't supported.");
	document.getElementById("gradeSet").value="";
	document.getElementById("gradeSet").focus();
}
}

// check duplicate pointSet
function chkpt(str){
	$.ajax({
		url:"index.php/xmAllRequest/chkpt",
		type:"POST",
		data:{d:str},
		success:function(data){
			if(data>0){
				alert("This point already inserted.Please type another one.");
				document.getElementById("pointSet").value="";
				document.getElementById("pointSet").focus();
			}
		}
	});
}

// check duplicate mark rang
function chkrg(s,e){
	if(parseInt(s)>parseInt(e)){
		alert("Invalid Mark rang.Starting mark can't grater than ending mark");
		document.getElementById("smark").value="";
		document.getElementById("emark").value="";
		document.getElementById("smark").focus();
	}else{
	$.ajax({
		url:"index.php/xmAllRequest/chkrg",
		type:"POST",
		data:{d:str},
		success:function(data){
			if(data>0){
				alert("This mark rang already inserted.Please type another one.");
				document.getElementById("smark").value="";
				document.getElementById("emark").value="";
				document.getElementById("smark").focus();
			}
		}
	});
	}
}

// capital
function noNumerics(evt)
    {
    var e = event || evt;
    var charCode = e.which || e.keyCode;
    if ((charCode >= 48) && (charCode <= 57))
       return false;
    return true;
    }

$(function() {
    $('#gradeSet').keyup(function() {
        $(this).val($(this).val().toUpperCase());
    });
});

</script>


<!-- <aside class="right-side">
<section class="content-header">
                    <h1>
                        gradeSet Setting
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

<section>
<div class="container-fluid">
	<div class="col-md-12">
-->
<?php //$this->load->view("exam/success"); ?>

		<div class="panel panel-default" style="margin-top:20px;">

		<div class="panel-heading"><center id="title">grade Setting</center></div> 
		  	<div class="panel-body"> 
		    	<form action="index.php/allSubmit/gradeSetting" method="post" onsubmit="return gradingEnt()" >
		    		 <div id="table-responsive">
		    		<table class="table">
		    			<tr style="background:none !important;">
		    				<th>Grade</th>
		    				<th>Point</th>
		    				<th>Mark</th>
		    				<th>Comment</th>
		    				<th></th>
		    			</tr>
		    			<tr style="background:none !important;">
		    			
		    				<td>
		    					<input type="text" name="gradeSet" id="gradeSet" class="form-control" placeholder="grade" pattern="[ABCDF+-]{1,2}" onchange="chkgd(this.value);chkonp(this.value);" maxlength="2" style="text-transform:uppercase" onkeypress="return noNumerics(event)" /><div class="input-validation"></div>
		    				</td>
		    				<td>
		    					<input type="text" name="pointSet" id="pointSet" class="form-control" placeholder="point" pattern="[1-5]{1}[.]{1}[0-9]{2}" onchange="chkpt(this.value)" onkeypress="return isamountonly(event)" />
		    				</td>
		    				<td style="width:140px;">
		    					<input type="text" name="smark" id="smark" pattern="[0-9]{1,2}" class="form-control" placeholder="From" style="max-width:60px;float:left;" onkeypress="return isNumber(event)" /> <span class="glyphicon glyphicon-minus" aria-hidden="true" style="margin-top:8px;"></span>
		    					<input type="text" name="emark" id="emark" pattern="[0-9]{2,3}" class="form-control" placeholder="To" style="max-width:50px;float:right;" onchange="chkrg(smark.value,this.value)" onkeypress="return isNumber(event)" />
		    				</td>
		    				<td><input type="text" name="comment" id="comment" class="form-control" placeholder="comment" /></td>
		    				<td>
		    					<button type="submit" name="gd" class="btn btn-primary" >
		    						<span class="glyphicon glyphicon-send" aria-hidden="true"> Submit
		    						</span>
		    					</button>
		    				</td>
		    			</tr>
		    		</table>
		    		</div>
				</form>
		 	 </div>
	 </div>
		<!--</div>		
</div>
</section>
</aside> -->