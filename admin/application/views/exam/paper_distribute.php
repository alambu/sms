<style type="text/css">
	#itemRows td {
    border-top: none !important;
}
#itemRows tr th{
	text-align: center;
	border-top: none !important;
}

</style>

<script type="text/javascript">
var rowNum = 0;
var i=0;
function valid1(){
	if(i==0){
		alert('No Data added.');
		document.getElementById("add").focus();
		return false;
	}else{
		var e=document.getElementById('exam_name').value;
	var c=document.getElementById('cls_name').value;
	var s=document.getElementById('sft').value;
	var s2=document.getElementById('section').value;
	var s3=document.getElementById('subjpaper1').value;
	var r=document.getElementById('return_date').value;
	var t=document.getElementById('teacher').value;
	// var v=document.getElementById('vir').value;
	// var c2=document.getElementById('clsVir').value;
	// var s4=document.getElementById('sVir').value;
	// var t2=document.getElementById('teachId').value;
	var t3=document.getElementById('tpaper').value;

	// test if any field of first row is selected
	if((e!='')||(c!='')||(s!='')||(s2!='')||(s3!='')||(r!='')||(t!='')||(t3!='')){
		alert("Please complete first row and then click add button.");
		return false;
	}

	}
}
function addRow(frm) {
	
	// alert(i);
	rowNum ++;
	var exam_name=document.getElementById('exam_name').value;
	var cls_name=document.getElementById('cls_name').value;
	var sft=document.getElementById('sft').value;
	var section=document.getElementById('section').value;
	var subjpaper=document.getElementById('subjpaper1').value;
	var return_date=document.getElementById('return_date').value;
	var teacher=document.getElementById('teacher').value;
	var vir=document.getElementById('vir').value;
	var clsVir=document.getElementById('clsVir').value;
	var sVir1=document.getElementById('sVir1').value;
	var teachId=document.getElementById('teachId').value;
	var tpaper=document.getElementById('tpaper').value;
	
// get shift name
var sftVir=document.getElementById("sft").options[document.getElementById("sft").selectedIndex].text;


	if(exam_name==''){
	   alert('Empty Examination Name');
	   document.getElementById("exam_name").focus();
	   return false;
	}else if(cls_name==''){
		alert('Empty Class Name');
	   document.getElementById("cls_name").focus();
	   return false;
	 }else if(sft==''){
		alert('Empty shift');
	   document.getElementById("sft").focus();
	   return false;
	 }else if(section==''){
	 	alert('Empty Section');
	    document.getElementById("section").focus();
	    return false;
	}else if(subjpaper==''){
		alert('Empty Subject Name');
	   document.getElementById("subjpaper1").focus();
	   return false;
	}else if(tpaper==''){
		alert('Empty Total Paper');
	    document.getElementById("tpaper").focus();
	    return false;
	}
	else if(return_date==''){
		alert('Empty Return Date');
	   document.getElementById("return_date").focus();
	   return false;
	}else if(teacher==''){
		alert('Empty teacher');
	   document.getElementById("teacher").focus();
	   return false;
	}
	else{
		
	var row = '<tr id="rowNum'+rowNum+'"><td><input type="text" value="'+frm.vir.value+'" class="form-control" /><input type="hidden" name="exam_name[]" id="xm'+rowNum+'" value="'+frm.exam_name.value+'" ></td><td><input type="text" value="'+frm.clsVir.value+'" class="form-control" /><input type="hidden" name="cls_name[]" value="'+frm.cls_name.value+'" id="clnm'+rowNum+'" /></td><td><input type="text" value="'+sftVir+'" class="form-control" /><input type="hidden" name="sftid[]" value="'+frm.sft.value+'" id="stid'+rowNum+'" /></td><td><input type="text" name="section[]" class="form-control" value="'+frm.section.value+'" id="sc'+rowNum+'" /></td><td><input type="text" value="'+frm.sVir1.value+'" class="form-control" /><input type="hidden" name="subjpaper[]" class="form-control" value="'+frm.subjpaper1.value+'" id="sbj'+rowNum+'" /></td><td><input type="text" name="tpaper[]" value="'+frm.tpaper.value+'" class="form-control" /></td><td><input type="text" name="return_date[]" class="form-control" value="'+frm.return_date.value+'" /></td><td><input type="text" value="'+frm.teachId.value+'" class="form-control" /><input type="hidden" name="teacher[]" class="form-control" value="'+frm.teacher.value+'" /></td><td><button type="button" class="btn btn-danger" style="margin-left5px;" onClick="removeRow('+rowNum+');"><span class="glyphicon glyphicon-minus" aria-hidden="true">Drop</span></button></td></tr>';
	jQuery('#itemRows').append(row);

	// today time
	// var td=new Date();
	// var d=td.getDate();
	// var m=td.getMonth()+1;
	// var y=td.getFullYear();
	// var tdtime=y+"-"+"0"+m+"-"+d;
	// var tddd=Date.UTC(tdtime);;
	// alert(tddd);
	// $('#return_date').datepicker();
	// $('#return_date').datepicker({ dateFormat: 'dd-mm-yy'}).datepicker("setDate", new Date());
	$('#return_date').val('').datepicker('update');
	frm.exam_name.value = '';
	frm.cls_name.value = '';
	frm.sft.value = '';
	frm.section.value = '';
	frm.subjpaper1.value = '';
	// frm.return_date.value = '';
	frm.teacher.value = '';
	frm.tpaper.value = '';
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
	i=0;
}

	function xmName(){
		var txt=document.getElementById("exam_name").options[document.getElementById("exam_name").selectedIndex].text;
		document.getElementById("vir").value=txt;
	}

function sect(str){
	var tt=document.getElementById("cls_name").options[document.getElementById("cls_name").selectedIndex].text;
		document.getElementById("clsVir").value=tt;

	if(str.length!=0){
		$.ajax({
        url:"index.php/xmAllRequest/seatPlanSection",
        data:{clsid:str},
        type:"POST",
        success:function(sec){
        	var data=sec.split(",");
        	document.getElementById("section").innerHTML="";
        	document.getElementById("section").innerHTML="<option value=''>Select</option>";

        	for(var i=0;i<data.length;i++){
        		document.getElementById("section").innerHTML+="<option value='"+data[i]+"'>"+data[i]+"</option>";
        	}
        	
            }
        });
       }
}

function sub(st){
	if(st.length!=0){
		$.ajax({
        url:"index.php/xmAllRequest/subjectFind",
        data:{clsid:st},
        type:"POST",
        success:function(sec){
        	var sub=sec.split("+");  // split receive data into subject name and id

        	var d=sub[0];		// this is subject name
        	var data=d.split(",");	// split subject name

        	var s=sub[1];	// subject id
        	var sData=s.split(',');	// split subject id

        	document.getElementById("subjpaper1").innerHTML="";
        	document.getElementById("subjpaper1").innerHTML="<option value=''>Select</option>";

        	for(var i=1;i<data.length;i++){
        		document.getElementById("subjpaper1").innerHTML+="<option value='"+sData[i]+"'>"+data[i]+"</option>";
        	}
        	
            }
        });
       }
}

function subjectVir(xm,cl,sft,sc,sbvl){
	var d=xm+"+"+cl+"+"+sft+"+"+sc+"+"+sbvl;
	
	var ex=document.getElementById("exam_name").options[document.getElementById("exam_name").selectedIndex].text;
	
	var cTxt=document.getElementById("cls_name").options[document.getElementById("cls_name").selectedIndex].text;
	
	var sec=document.getElementById("section").options[document.getElementById("section").selectedIndex].text;
	
	var sTxt=document.getElementById("subjpaper1").options[document.getElementById("subjpaper1").selectedIndex].text;

	// shift name take
	var sff=document.getElementById("sft").options[document.getElementById("sft").selectedIndex].text;

		// database check duplicate value

	$.ajax({
		url:"index.php/xmAllRequest/duplicateSub",
		type:"POST",
		data:{sb:d},
		success:function(data){
			//explode received data
			var d=data.split("+");
			if(parseInt(d[3])>0){
				alert("Subject "+sTxt+" of class "+cTxt+" of section "+sc+" has been distributed.Please Select another.");
				// reset form data
				// document.getElementById("exam_name").value='';
				// document.getElementById("cls_name").value='';
				// document.getElementById("sft").value='';
				// document.getElementById("section").value='';
				document.getElementById("subjpaper1").value='';
// remove existing tr
	document.getElementById("error").innerHTML='';
// block the error div
				document.getElementById("ediv").style.display="block";

				// create table tr under th
				var er='<tr style="text-align:center;" id="data"><td><input type="text" disabled value="'+ex+'" class="form-control" /></td><td><input type="text" disabled value="'+cTxt+'" class="form-control" /></td><td><input type="text" value="'+sff+'" disabled class="form-control" /></td><td><input type="text" disabled value="'+sec+'" class="form-control" /></td><td><input type="text" disabled value="'+sTxt+'" class="form-control" /></td><td><input type="text" disabled value="'+d[0]+'" class="form-control" /></td><td><input type="text" disabled value="'+d[1]+'" class="form-control" /></td><td><input type="text" disabled value="'+d[2]+'" class="form-control" /></td><td></td></tr>';
				$("#error").append(er);

			}else{
				document.getElementById("tpaper").focus();
				// if(document.getElementById("ediv")!=null){
					document.getElementById("ediv").style.display="none";	
				// }
				document.getElementById("sVir1").value=sTxt;
			}
		}
	});
// on page check duplicate value
if(rowNum!=0){
		for(var i=1;i<=rowNum;i++){
			var ex_nm=document.getElementById("xm"+rowNum).value;
			var clnm=document.getElementById("clnm"+rowNum).value;
			var secnm=document.getElementById("sc"+rowNum).value;
			var sbjnm=document.getElementById("sbj"+rowNum).value;
			var stid=document.getElementById("stid"+rowNum).value;
			
			if((parseInt(ex_nm)==parseInt(xm))&&(parseInt(clnm)==parseInt(cl))&&(secnm==sc)&&(parseInt(sbjnm)==parseInt(sbvl))&&(parseInt(stid)==parseInt(sft))){
				alert("This subject already distributed");
				document.getElementById("rowNum"+i).style.border="1px solid red";
				document.getElementById("subjpaper1").value='';
				document.getElementById("tpaper").focus();
				
			}else{
				document.getElementById("rowNum"+i).style.border="none";
				document.getElementById("tpaper").focus();
				
			}
		}
	}
	// on page check duplicate value

	
}

function teacherId(){
	var tTxt=document.getElementById("teacher").options[document.getElementById("teacher").selectedIndex].text;
		document.getElementById("teachId").value=tTxt;
}

$(document).ready(function(){
	$("#return_date").datepicker({format:"yyyy-mm-dd"});
	$('#return_date').datepicker({ minDate: 0 });
});

function TotalStd(cls,sft,sec){
	$.ajax({
		type:"POST",
		url:"index.php/xmAllRequest/totalStd",
		data:{c:cls,s:sft,sc:sec},
		success:function(data){
			if(parseInt(data)<=0){
				alert("This class has no student.");
			}else{
				document.getElementById("tStd").value=data;
			}
		}
	});
}

function testStd(tot,obt){
	if(parseInt(tot)<parseInt(obt)){
		alert("You input wrong number.Total student of this class is : "+tot);
		document.getElementById("tpaper").value='';
		document.getElementById("tpaper").focus();
	}
}

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
$("#return_date").val('').datepicker('update');
        // return 0;
    }
else if(parseInt(getD[0])==parseInt(yy) && parseInt(getD[1])<parseInt(mm)){
    alert("You can't select previous date");
$("#return_date").val('').datepicker('update');
}

else if(parseInt(getD[0])==parseInt(yy) && parseInt(getD[1])==parseInt(mm) && parseInt(getD[2])<parseInt(dd)){
    alert("You can't select previous date");
$("#return_date").val('').datepicker('update');
}

}
</script>

<!-- <aside class="right-side">
<section class="content-header">
                    <h1>
                        Exam Paper Distribute
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


		<div class="panel panel-default" style="margin-top:20px;">

			<!-- <div class="panel-heading"><p id="title">Examination Name Entry</p></div> -->
		  	<div class="panel-body">
		    	<form action="index.php/allSubmit/paperDistribute" method="post" class="form-inline">
		    		<div>
		    		<table class="table" id="itemRows">
		    			<tr>
		    				<th>Examination Name</th>
		    				<th>Class</th>
		    				<th>Shift</th>
		    				<th>Section</th>
		    				<th>Subject/Paper</th>
		    				<th>Total Paper</th>
		    				<th>Return Date</th>
		    				<th>Teacher</th>
		    				<th></th>
		    			</tr>

		    			<?php
		    				$exam=$this->db->select("*")->from("exm_catg")->where("status",'1')->get()->result();
		    				$cls=$this->db->select("*")->from("class_catg")->get()->result();
		    				//$emp=$this->db->select("*")->from("emp_type")->where("type","teacher")->get()->row();

		    				$teacher=$this->db->select("*")->from("empee")->where("emptypeid",'1')->get()->result();
		    				// echo $this->db->last_query();
		    				// get shift name and id
		    				$sft=$this->db->select("*")->from("shift_catg")->get()->result();
		    			?>

		    			<tr>
		    				<td>
		    					<select name="exam_name" id="exam_name" class="form-control" onchange="xmName()" style="width:100px;font-size:12px;">
		    						<option value=""> Select </option>
		    						<?php
		    							foreach ($exam as $key) {
		    								$xmN=$this->db->select("*")->from("exm_namectg")->where("exmnid",$key->exmnid)->get()->row();
		    							echo "<option value='$key->exm_ctgid'>$xmN->exm_name</option>";	
		    							}
		    						?>
		    					</select>
		    					<input type="hidden" name="vir" id="vir" />
		    				</td>
		    				<td>
		    					<select name="cls_name" id="cls_name" class="form-control" onchange="sect(this.value);sub(this.value);" style="max-width:90px;">
		    						<option value=""> Select </option>
		    						<?php
		    							foreach ($cls as $c) {
		    							echo "<option value='$c->classid'>$c->class_name</option>";	
		    							}
		    						?>
		    					</select>
		    					<input type="hidden" name="clsVir" id="clsVir" />
		    				</td>
		    				<td>
		    					<select name="sft" id="sft" class="form-control" style="max-width:90px;font-size:12px;">
		    						<option value="">Select</option>
		    					<?php 
		    						foreach($sft as $sf):
		    					 ?>
		    						<option value="<?php echo $sf->shiftid ?>"><?php echo $sf->shift_N ?></option>
		    					<?php 
		    						endforeach;
		    					 ?>
		    					</select>
		    				</td>
		    				<td>
		    					<select name="section" id="section" class="form-control" style="max-width:75px;font-size:11px;" onchange="TotalStd(cls_name.value,sft.value,this.value)" >
		    						<option value="">Select</option>
		    					</select>
		    					<input type="hidden" name="tStd" id="tStd" />
		    				</td>
		    				<td>
		    					<select name="subjpaper" id="subjpaper1" class="form-control" onchange="subjectVir(exam_name.value,cls_name.value,sft.value,section.value,this.value)" style="max-width:120px;font-size:12px;" >
		    						<option value="">Select</option>
		    					</select>
		    					<input type="hidden" name="sVir" id="sVir1" />
		    				</td>
		    				<td>
		    					<input type="text" name="tpaper" id="tpaper" class="form-control" style="min-width:50px;max-width:90px;" onchange="testStd(tStd.value,this.value)" onkeypress="return isNumber(event)" />
		    				</td>
		    				<td><input type="text" name="return_date" id="return_date" class="form-control" placeholder="Return Date" style="min-width:110px;" onchange="chkDate(this.value)" /></td>
		    				<td>
		    					<select name="teacher" id="teacher" class="form-control" onchange="teacherId()" style="width:120px;font-size:12px;">
		    						<option value=""> Select </option>
		    					<?php
		    						foreach($teacher as $t){
		    							echo "<option value='$t->empid'>$t->name ($t->empid)</option>";
		    						}
		    					?>
		    					</select>
		    					<input type="hidden" name="teachId" id="teachId" />
		    				</td>
		    				<td>
		    					<button type="button" id="add" class="btn btn-info" style="height:32px;padding-top:1px;margin-left:1px;" onClick="addRow(this.form);"><span class="glyphicon glyphicon-plus" aria-hidden="true">ADD</span></button>
		    				</td>
		    			</tr>
		    		</table>
		    		</div>
		    		<table class="table">
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
		</div>

		<div class="col-md-12" style="border:1px solid red;display:none;" id="ediv">
			<table class="table">
				<thead>
					<tr>
						<th>Examination Name</th>
	    				<th>Class</th>
	    				<th>Shift</th>
	    				<th>Section</th>
	    				<th>Subject/Paper</th>
	    				<th>Total Paper</th>
	    				<th>Return Date</th>
	    				<th>Teacher</th>
	    				<th></th>
					</tr>
				</thead>
				<tbody id="error">
					
				</tbody>
			</table>
		</div> 
<!-- 
	</div>		
</div>
</section>
</aside> -->