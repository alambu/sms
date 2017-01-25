<?php
	if(isset($_POST['go'])){
		$id=$_POST['cl'];
		$sub=$this->db->query("SELECT s.subjid,p.sub_name FROM subject_class s right join subject_setup p ON s.subsetid = p.subsetid WHERE s.classid = '$id'")->result();
}
?>

<style type="text/css">
	table td {
    border-top: none !important;
}
table tr th{
	text-align: center;
}
#searchTbl tr{background: none !important;}
#itemRows1 tr{background: none !important;}
#footerLast tr{background: none !important;}
</style>

<script type="text/javascript">
var rowNum = 0;
var i=0;
function valid1(){
	if(i==0){
		alert('No Data added.');
		// document.getElementById("add").focus();
		return false;
	}
}
function addRow1(frm) {
	var err = 0;
	rowNum ++;
	var sub_name=document.getElementById('sub_name').value;
	var theory=document.getElementById('theory').value;
	var obj=document.getElementById('obj').value;
	var practical=document.getElementById('practical').value;
	var total=document.getElementById('total').value;
	var sindex=document.getElementById("sub_name").options[document.getElementById("sub_name").selectedIndex].text;
	
	if( (sub_name != '') && ( theory == '' ) && ( obj == '' ) && ( practical == '' ) && ( total != '' ) ){
		// do nothing.mean that data can inserted
		//return true;
	}
	// test subject is empty
	else if( (sub_name == '') && ( theory == '' ) && ( obj == '' ) && ( practical == '' ) && ( total == '' ) ){
		alert('Empty Subject Name');
	    document.getElementById("sub_name").focus();
	    err++;
	   	// return false;
	}
	// again check subject is empty
	else if( (sub_name == '') && ( ( theory != '' ) || ( obj != '' ) || ( practical != '' ) || ( total != '' ) ) ){
		alert('Empty Subject Name');
	    document.getElementById("sub_name").focus();
	    err++;
	   	// return false;
	}
	// test no mark given
	else if( (sub_name != '') && ( theory == '' ) && ( obj == '' ) && ( practical == '' ) && ( total == '' ) ){
			alert('No Data.Pls give separatly or average pass mark.');
	   		document.getElementById("theory").focus();
	   		err++;
	   		// return false;
		}
	// check separate data.if objective pass mark is empty
	else if( (sub_name != '') && ( theory != '' ) && ( obj == '' ) && ( practical == '' ) && ( total == '' ) ){
		var obt=document.getElementById("obtv").value;
		if(obt==0){
			alert("This subject has no objective mark.pls put zero here.");
			document.getElementById("obj").focus();
			err++;
			//return true;
		}else{
			alert('Empty Objective Mark');
		   document.getElementById("obj").focus();
		   err++;
		   //return false;	
		}
		
	}
	// if practical pass mark is empty
	else if( (sub_name != '') && ( theory != '' ) && ( obj != '' ) && ( practical == '' ) && ( total == '' ) ){
		
		var pt=parseInt(document.getElementById("prac").value);
		
		if(pt==0){
			alert("This subject has no practical mark.pls put zero here.");
			document.getElementById("practical").focus();
			err++;
			//return true;
		}else{
			alert('Empty Practical Mark');
		   document.getElementById("practical").focus();
		   err++;
		   //return false;	
		}
		
	}
	// if separate data is given then
	else if( (sub_name != '') && ( theory != '' ) && ( obj != '' ) && ( practical != '' ) && ( total == '' ) ){
		//return true;
	}

	if( err <= 0 ){
		
	var row = '<tr id="rowNum'+rowNum+'"><td><input type="hidden" name="sub_name[]" value="'+frm.sub_name.value+'" /><input type="text" value="'+sindex+'" class="form-control" /></td><td><input type="text" name="theory[]" class="form-control" value="'+frm.theory.value+'" /></td><td><input type="text" name="obj[]" class="form-control" value="'+frm.obj.value+'" /></td><td><input type="text" name="practical[]" class="form-control" value="'+frm.practical.value+'" /></td><td><input type="text" name="total[]" class="form-control" value="'+frm.total.value+'" /></td><td><button type="button" class="btn btn-danger" style="margin-left5px;" onClick="removeRow('+rowNum+');"><span class="glyphicon glyphicon-minus" aria-hidden="true">Drop</span></button></td></tr>';
	
	jQuery('#itemRows1').append(row);
	frm.sub_name.value = '';
	frm.theory.value = '';
	frm.obj.value = '';
	frm.practical.value = '';
	frm.total.value = '';
	i++;
	return true;
	}
}

function removeRow(rnum) {
	i--;
	jQuery('#rowNum'+rnum).remove();
	
}

function resetAll(){
	for(var j=0;j<=i;j++){
		jQuery('#rowNum'+j).remove();	
	}
	i=0;
	rowNum=0;
}

// subject change placeholder change
function subChng(s,c){
	
	$.ajax({
		url:"index.php/xmAllRequest/subjectTmark",
		type:"POST",
		data:{s:s,c:c},
		success:function(data){
			
			if(data!='fail'){
			var sepData=data.split("+");
			
// replace input field to empty
	document.getElementById("theory").value = '';
	document.getElementById("obj").value = '';
	document.getElementById("practical").value = '';
	document.getElementById("total").value = '';
// set placeholder text
			$("#theory").attr("placeholder","Maximum mark "+sepData[0]);
			$("#obj").attr("placeholder","Maximum mark "+sepData[1]);
			$("#practical").attr("placeholder","Maximum mark "+sepData[2]);
			$("#total").attr("placeholder","Maximum mark "+sepData[3]);
// set hidden value for validation
			document.getElementById('thry').value=sepData[0];
			document.getElementById('obtv').value=sepData[1];
			document.getElementById('prac').value=sepData[2];
			document.getElementById('tot').value=sepData[3];
}else{
	alert("This subject pass mark already settup.Select another one.");
	document.getElementById("sub_name").value='';
}
	}
});

}
// subject change placeholder change

// check total value and given value valid
function chk(gVal,tVal,id){

	if(parseInt(gVal)>parseInt(tVal)){
		alert("Passing Mark can't greater than maximum mark");
		document.getElementById(id).value='';
		document.getElementById(id).focus();
		return false;
	}else{
		return true;
	}
}

/** when give input value in average
* then other separate pass mark
* should be remove.
*/
function removeOther(){
	// replace input field to empty
	document.getElementById("theory").value = '';
	document.getElementById("obj").value = '';
	document.getElementById("practical").value = '';
}

/**
* when separate value give
* then average field is empty
*/

function removeAvg(){
	document.getElementById("total").value = '';
}

</script>

<!-- <aside class="right-side">
	<section class="content-header">
        <h1>
            <a href="index.php/exam/passing_mark_set">Passing Mark Settup</a>
            <small>Control panel</small>
        </h1>
            <ol class="breadcrumb">
            	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
    </section>

	<section>
		<div class="container-fluid">
			<div class="col-md-12"> -->

<!-- success or failed message -->
	<?php $this->load->view("exam/success"); ?>
<!-- success or failed message -->

<!-- this is for class select -->
<?php 
    $cls=$this->db->select("*")->from("class_catg")->get()->result();
?>
<div class="panel panel-default" style="margin-top:20px;">
	<div class="panel-heading" style="text-align:center !important;"><center id="title">Passing mark setup</center></div>
	<div class="panel-body">
<div class="col-md-4" style="margin-top:10px;margin-bottom:10px;border:0px;">
	<form action="" method="post" class="form-inline" role="form">
		<table class="table" id="searchTbl">
			<tr>
				<th>Class : </th>
				<td>
					<select name="cl" id="cl" class="form-control" required>
						<option value="">Select</option>
						<?php
							foreach($cls as $c){
						?>	

						<option <?php if(isset($_POST['go'])){if($c->classid==$id){echo "selected";}} ?> value="<?php echo $c->classid ?>"><?php echo $c->class_name; ?></option>";
					
					<?php
							}
					?>
					</select>
				</td>
				<td>
					<button class="btn btn-primary" name="go">
						GO &nbsp;<span class="glyphicon glyphicon-arrow-right"></span>
					</button>
				</td>
			</tr>
		</table>
	</form>
</div>
<!-- this is for class select -->

<?php
	if(isset($_POST['go'])){
?>
<div class="col-md-12">
	<form action="index.php/allSubmit/passMarkSett" method="post" class="form-inline">
		    		<table class="table" id="itemRows1">
		    			<tr>
		    				<th>Subject</th>
		    				<th>Theory</th>
		    				<th>Objective</th>
		    				<th>Practical</th>
		    				<th>Avarage Pass Mark</th>
		    				<th></th>
		    			</tr>

		    			<tr>
		    				<td>
		    				<input type="hidden" name="clsid" id="clsid" value="<?php echo $id; ?>" />
		    					<select name="sub_name" id="sub_name" class="form-control"  onchange="subChng(this.value,clsid.value)" >
		    						<option value=""> Select </option>
		    						<?php
		    							foreach ($sub as $key) {
		    							echo "<option value='$key->subjid'>$key->sub_name</option>";	
		    							}
		    						?>
		    					</select>
		    					<!-- <input type="text" name="virTual" id="virTual" /> -->
		    				</td>
		    				<td>
		    					<input type="text" name="theory" id="theory" class="form-control" placeholder="Theory" onkeypress="return isNumber(event)" onchange="chk(this.value,thry.value,'theory')" onkeydown="removeAvg()" />
		    					<input type="hidden" id="thry" />
		    				</td>
		    				<td>
		    					<input type="text" name="obj" id="obj" class="form-control" placeholder="Objective"  onkeypress="return isNumber(event)" onchange="chk(this.value,obtv.value,'obj')" onkeydown="removeAvg()" />
		    					<input type="hidden" id="obtv" />
		    				</td>
		    				<td>
		    					<input type="text" name="practical" id="practical" class="form-control" placeholder="Practical" onkeypress="return isNumber(event)" onchange="chk(this.value,prac.value,'practical')" onkeydown="removeAvg()" />
		    					<input type="hidden" id="prac" />
		    				</td>
		    				<td>
		    					<input type="text" name="total" id="total" class="form-control" placeholder="Total" onkeypress="return isNumber(event)" onkeydown="removeOther()" onchange="chk(this.value,tot.value,'total')" />
		    					<input type="hidden" id="tot" />
		    				</td>
		    				
		    				<td>
		    					<button type="button" class="btn btn-info" style="height:32px;padding-top:1px;margin-left:1px;" onClick="return addRow1(this.form);"><span class="glyphicon glyphicon-plus" aria-hidden="true">ADD</span></button>
		    				</td>
		    			</tr>
		    		</table>
		    		
		    		<table class="table" id="footerLast">
		    			<tr>
		    			<td style="width:1%;"></td>
		    			
		    				<td>
		    					<button type="submit" name="ok" onclick="return valid1();" class="btn btn-primary" >
		    						<span class="glyphicon glyphicon-send" aria-hidden="true"> Submit
		    						</span>
		    					</button>
		    					<button type="reset" name="reset" class="btn btn-warning" onclick="resetAll()">
		    						<span class="glyphicon glyphicon-refresh" aria-hidden="true"> Reset
		    						</span>
		    					</button>
		    				</td>
		    				<td></td>
		    			</tr>
		    		</table>
				</form>	
			</div>
<?php
	}
?>
			 </div>
		</div>
	<!--</section>
</aside> -->