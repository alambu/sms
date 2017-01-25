<style type="text/css">
table td {
    border-top: none !important;
}
table tr th{
	text-align: center;
}

#itemRows tr{background: none !important;}
#itemRows tr th{border: none !important;}

</style>

<script type="text/javascript">
var id=0;
// var rowNum = 0;
var i=0;
// function valid1(){
// 	if(i==0){
// 		alert('Empty Examination Name.');
// 		document.getElementById("exam_name").focus();
// 		return false;
// 	}
// }

// validation test
function addRow() {
	
	// alert(i);
	// rowNum ++;
	var exam_name=document.getElementById('exam_name').value;
	var cls_name=document.getElementById('cls_name').value;
	var time=document.getElementById('time').value;
	var froll=document.getElementById('froll').value;
	var eroll=document.getElementById('eroll').value;
	var room=document.getElementById('room').value;
	var teacher=document.getElementById('teacher').value;
	var section=document.getElementById('section').value;
	// var virtualTxt=document.getElementById('virtualTxt').value;
	// var virTxt=document.getElementById('virTxt').value;
	// var virtual=document.getElementById('virtual').value;
	// var addTdiv=document.getElementById("rm1").innerHTML;
	
	
	if(exam_name==''){
	   alert('Empty Examination Name');
	   document.getElementById("exam_name").focus();
	   return false;
	}else if(cls_name==''){
		alert('Empty Class Name');
	   document.getElementById("cls_name").focus();
	   return false;
	}else if(section==''){
		alert('Empty Section Name');
	   document.getElementById("section").focus();
	   return false;
	}else if(time==''){
		alert('Empty Time');
	   document.getElementById("time").focus();
	   return false;
	}else if(froll==''){
		alert('Empty Starting Roll');
	   document.getElementById("froll").focus();
	   return false;
	}else if(eroll==''){
		alert('Empty Ending Roll');
	   document.getElementById("eroll").focus();
	   return false;
	}else if(room==''){
		alert('Empty Room Number');
	   document.getElementById("room").focus();
	   return false;
	}else if(id<=0){	// teacher selection
		alert('No teacher selected.Select at least one teacher.');
	   document.getElementById("teacher").focus();
	   return false;
	}
	else{
	// var row = '<tr id="rowNum'+rowNum+'"><td><input type="text" value="'+frm.virtualTxt.value+'" class="form-control" /><input type="hidden" name="exam_name[]" value="'+frm.exam_name.value+'"  ></td><td><input type="text" value="'+frm.virTxt.value+'" class="form-control" /><input type="hidden" name="cls_name[]" value="'+frm.cls_name.value+'" /></td><td><input type="text" name="section[]" class="form-control" value="'+frm.section.value+'" /></td><td><input type="text" name="time[]" class="form-control" value="'+frm.time.value+'" /></td><td><input type="text" name="froll[]"  class="form-control" value="'+frm.froll.value+'" style="max-width:60px;float:left;" /><span class="glyphicon glyphicon-minus" aria-hidden="true" style="margin-top:8px;"></span><input type="text" name="eroll[]" class="form-control" value="'+frm.eroll.value+'" style="max-width:50px;float:right;" /></td><td><input type="text" value="'+frm.room.options[frm.room.selectedIndex].text+'" class="form-control" /><input type="hidden" name="room[]" value="'+frm.room.value+'" /></td><td><input type="text" class="form-control" value="'+frm.virtual.value+'" />'+addTdiv+'<input type="hidden" name="teacher[]" class="form-control" value="'+frm.teacher.value+'" /></td><td><button type="button" class="btn btn-danger" style="margin-left5px;" onClick="removeRow('+rowNum+');"><span class="glyphicon glyphicon-minus" aria-hidden="true">Drop</span></button></td></tr>';
	// jQuery('#itemRows').append(row);
	// frm.exam_name.value = '';
	// frm.cls_name.value = '';
	// frm.section.value = '';
	// frm.time.value = '';
	// frm.froll.value = '';
	// frm.eroll.value = '';
	// frm.room.value = '';
	// frm.teacher.value = '';
	// i++;
	return true;
}
}
// function removeRow(rnum) {
// 	i--;
// 	//alert(i);
// 	jQuery('#rowNum'+rnum).remove();
// }

// function resetAll(){
// 	for(var j=0;j<=i;j++){
// 		jQuery('#rowNum'+j).remove();		
// 	}
// }

function show(){
	var tx=document.getElementById('exam_name').options[document.getElementById('exam_name').selectedIndex].text;
	document.getElementById("virtualTxt").value=tx;

}

function rem(div){
	document.getElementById("rm"+div).remove();
	this.remove();
	// d.parentNode.removeChild(d);
}

function virtu(){
	id++;
	var txt=document.getElementById('teacher').options[document.getElementById('teacher').selectedIndex].text;
	var tid=document.getElementById("teacher").value;

	
if(txt!='Select'){

	document.getElementById("virtual").value=txt;

	var inp=document.createElement("DIV");
	inp.setAttribute("style","border:1px solid #d0d0d0;margin:3px;background-color:#d9edf7;height:50px;width:140px;");
	inp.setAttribute("id","rm"+id);
	// inp.setAttribute("style","");
	// inp.setAttribute("onfocus","this.style.backgroundImage='url(img/cross.png)';");
	// inp.setAttribute("disabled","disabled");
	var sp=document.createElement("span");
	sp.setAttribute("style","float:right;position:relative;");
	sp.setAttribute("onClick","rem("+id+")");
	sp.className="glyphicon glyphicon-remove";
	// inp.setAttribute("value",""+txt+"");
	
	// input teacher empid value
	var storage=document.createElement("input");
	storage.setAttribute("type","hidden");
	storage.setAttribute("id","storage"+id);
	storage.setAttribute("name","storage[]");
	storage.setAttribute("value",tid);


	var t=document.createTextNode(txt);
	inp.appendChild(sp);
	inp.appendChild(t);
	inp.appendChild(storage);
	document.getElementById("tt").appendChild(inp);
	document.getElementById("teacher").value='';
	// }
}
}

// teacher id check if exist
// function tidChk(st){
// 	var err=0;
// 	if(id>0){
// 	for(var i=1;i<=id;i++){
// 		var ttid=document.getElementById("storage"+i).value;
// 		if(parseInt(st)==parseInt(ttid)){
// 			err++;
// 			alert("This Teacher already selected for this room.");
// 			document.getElementById("teacher").value='';
// 		}
// 	}
// 	if(err<=0){virtu();}
// }else{virtu();}
// }

function sec(str){

	var tx=document.getElementById('cls_name').options[document.getElementById('cls_name').selectedIndex].text;
	document.getElementById("virTxt").value=tx;

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


</script>
<!-- this is for auto complete -->
<script>

function rollChk(first,second){
	if(parseInt(first)>parseInt(second)){
		alert("Last roll number is can't less than first roll.");
		document.getElementById("eroll").value="";
		document.getElementById("eroll").focus();
	}else{
		var eid=document.getElementById("exam_name").value;
		var cid=document.getElementById("cls_name").value;
		var sid=document.getElementById("sht").value;
		var section=document.getElementById("section").value;
		var rl=first+'-'+second;
		// make a data
		var d=eid+'+'+cid+'+'+sid+'+'+section+'+'+rl;
		// call a function to check this value is exits or not
		$.ajax({
			type:"POST",
			url:"index.php/xmAllRequest/seatChkRl",
			data:{dA:d},
			success:function(data){
				if(parseInt(data)>0){
					alert("Sorry.Seat plan for this roll rang of this class already settup.Select another roll rang.");
					document.getElementById("froll").value='';
					document.getElementById("eroll").value='';
					document.getElementById("froll").focus();
				}
			}
		});	
	}
}

function checkRmExt(str){
	// get exam,class shift section id
	var eid=document.getElementById("exam_name").value;
	var cid=document.getElementById("cls_name").value;
	var sid=document.getElementById("sht").value;
	var section=document.getElementById("section").value;

	// make a data
	var d=eid+'+'+cid+'+'+sid+'+'+section+'+'+str;
	// call a function to check this value is exits or not
	$.ajax({
		type:"POST",
		url:"index.php/xmAllRequest/seatChk",
		data:{dA:d},
		success:function(data){
			if(parseInt(data)>0){
				alert("Sorry.Seat plan for this class already settup.Select another room.");
				document.getElementById("room").value='';
			}
		}
	});
}

  </script>
<!-- this is for auto complete -->

<!-- <aside class="right-side">
<section class="content-header">
                    <h1>
                        Seat Plan Setting
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

<!- success or failed message -->
	<?php //$this->load->view("exam/success"); ?>
<!-- success or failed message -->

		<div class="panel panel-default" style="margin-top:20px;">
			<!-- <div class="panel-heading"><p id="title">Examination Name Entry</p></div> -->
		  	<div class="panel-body">
		    	<form action="index.php/allSubmit/seatPlanSet" method="post" class="form-inline" onsubmit="return addRow()" >
		    		<div>
		    		<table class="table" id="itemRows">
		    			<tr>
		    				<th>Examination Name</th>
		    				<th>Class</th>
		    				<th>Shift</th>
		    				<th>Section</th>
		    				<th>Roll</th>
		    				<th>Room</th>
		    				<!-- <th>Teacher</th> -->
		    				<th></th>
		    			</tr>

		    			<?php
		    				$exam=$this->db->select("*")->from("exm_catg")->where("status",'1')->get()->result();
		    				$cls=$this->db->select("*")->from("class_catg")->get()->result();
		    				$emp=$this->db->select("*")->from("emp_type")->where("type","teacher")->get()->row();

		    				$teacher=$this->db->select("*")->from("empee")->where("emptypeid",$emp->emptypeid)->get()->result();
		    				// get shift
		    				$sh=$this->db->select("*")->from("shift_catg")->get()->result();
		    				// echo $this->db->last_query();
		    					
		    			?>

		    			<tr>
		    				<td>
		    					<select name="exam_name" id="exam_name" class="form-control" >
		    						<option value=""> Select Exam </option>
		    						<?php
		    							foreach ($exam as $key) {
		    								$exNm=$this->db->select("*")->from("exm_namectg")->where("exmnid",$key->exmnid)->get()->row();
		    							echo "<option value='$key->exm_ctgid'>$exNm->exm_name</option>";	
		    							}
		    						?>
		    					</select>
		    					<input type="hidden" name="virtualTxt" id="virtualTxt"  />
		    				</td>
		    				<td>
		    					<select name="cls_name" id="cls_name" class="form-control" onchange="sec(this.value);">
		    						<option value=""> Select Class </option>
		    						<?php
		    							foreach ($cls as $c) {
		    							echo "<option value='$c->classid'>$c->class_name</option>";	
		    							}
		    						?>
		    					</select>
		    					<input type="hidden" name="virTxt" id="virTxt" />
		    				</td>
		    				<td>
		    					<select name="sht" id="sht" class="form-control">
		    						<option value="">Select</option>
		    						<?php foreach($sh as $s): ?>
		    							<option value="<?php echo $s->shiftid ?>"><?php echo $s->shift_N ?></option>
		    						<?php endforeach; ?>
		    					</select>
		    				</td>
		    				<td>
		    					<select name="section" id="section" class="form-control">
		    						<option value="">Select</option>
		    						
		    					</select>
		    				</td>
		    				<!-- <td>
		    					<input type="time" name="time" id="time" class="form-control" />
		    				</td> -->
		    				<td style="min-width:140px;">
		    					<input type="text" name="froll" id="froll" class="form-control" placeholder="From" style="max-width:60px;float:left;" onkeypress="return isNumber(event)" /> <span class="glyphicon glyphicon-minus" aria-hidden="true" style="margin-top:8px;"></span>
		    					<input type="text" name="eroll" id="eroll" class="form-control" placeholder="To" style="max-width:50px;float:right;" onkeypress="return isNumber(event)" onchange="rollChk(froll.value,this.value)" />
		    				</td>
		    				
<?php 
	$rm=$this->db->select("*")->from("room_settup")->get()->result();
?>

		    				<td>
								<select name="room" id="room" class="form-control" onchange="checkRmExt(this.value)" >
									<option value="">Select</option>
							<?php
								foreach($rm as $m){
									echo '<option value="'.$m->roomid.'">('.$m->room_number.') '.$m->r_name.'</option>';
								}
							?>
								</select>
		    				</td>
		    				
		    				<!-- <td id="tt">
		    					<select name="teacher" id="teacher" class="form-control" onchange="tidChk(this.value)" style="width:140px;">
		    						<option value="">Select</option>
		    					<?php
		    						//foreach($teacher as $t){
		    						//	echo "<option value='$t->empid'>$t->name ($t->empid)</option>";
		    						//}
		    					?>
		    					</select>
		    					<input type="hidden" name="virtual" id="virtual" />
		    				</td> -->
		    				<!-- <td>
		    					<button type="button" class="btn btn-info" style="height:32px;padding-top:1px;margin-left:1px;" onClick="addRow(this.form);"><span class="glyphicon glyphicon-plus" aria-hidden="true">ADD</span></button>
		    				</td> -->
		    			</tr>
		    		</table>
		    		</div>
		    		<table>
		    			<tr>
		    			<td style="width:1%;"></td>
		    			
		    				<td>
		    					<button type="submit" name="ok" class="btn btn-primary" >
		    						<span class="glyphicon glyphicon-send" aria-hidden="true"> Submit
		    						</span>
		    					</button>
		    					<button type="reset" name="reset" class="btn btn-warning">
		    						<span class="glyphicon glyphicon-refresh" aria-hidden="true"> Reset
		    						</span>
		    					</button>
		    				</td>
		    				<td></td>
		    			</tr>
		    		</table>
				</form>
		 	 </div>
		 	 <!-- <input type="text" name="tags" id="tags" style="width:500px;" /> -->
		</div><!-- 
	</div>		
</div>
</section>
</aside> -->