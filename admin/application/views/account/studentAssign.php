<script type="text/javascript">	

$(document).ready(function(){   
// start class fee category
$('#formidAss').submit(function(){
        $.post(
            "index.php/account/studentAssign",
            $("#formidAss").serialize(),
            function(data){
              if(data==1)
              {              
                 $('#hidemessage').fadeIn('slow').delay(2000).fadeOut('slow');
                    setTimeout(function(){                  
                    window.location="accountReport/vahicleStdAssign";
                    },2000)
              }           
              else{
                  alert(data);
              }
        });
        return false;
    });
});

// get class by shift id for report
function getClassReceipt( shift ){
	$.ajax({
		url:"account_billgenerate/getClass",
		type:"POST",
		data:{shf:shift},
		success:function( data ){
			var cls = data.split("+");
			if((cls[0].length > 0) && (cls[1].length > 0)){
				var className = cls[0].split(",");
				var classId = cls[1].split(",");

				// reset class
				document.getElementById("classnamerepo").innerHTML = '';
				document.getElementById("classnamerepo").innerHTML = '<option value="">Select</option>';

				// reset section
				document.getElementById("sectionsrepo").innerHTML = '';
				document.getElementById("sectionsrepo").innerHTML = '<option value="">Select</option>';				

				// set new class
				for(var j = 0;j < className.length;j++){
					document.getElementById("classnamerepo").innerHTML += '<option value="'+classId[j]+'">'+className[j]+'</option>';
				}

			}else{
				// reset class
				document.getElementById("classnamerepo").innerHTML = '';
				document.getElementById("classnamerepo").innerHTML = '<option value="">Select</option>';
				
				// reset section
				document.getElementById("sectionsrepo").innerHTML = '';
				document.getElementById("sectionsrepo").innerHTML = '<option value="">Select</option>';
			}
		}
	});
}


// get class section name
function ClassSectionReceipt(cls){
    document.getElementById("sectionsrepo").innerHTML="<option value=''>Select</option>";
        // document.getElementById("sub").innerHTML="<option value=''>Select</option>";
        $.ajax({
            url:"index.php/account/changeClassSection",
            data:{clsid:cls},
            type:"POST",
            success:function(str){
                //alert(str);
                
                var secValue = str.split("+");
                
                var secName = secValue[0];
                var secId = secValue[1];

                var secNm = secName.split(",");  // section value split 
                var secD = secId.split(",");  // section value split 

                for(var i = 0;i < secNm.length;i++){
                document.getElementById("sectionsrepo").innerHTML+="<option value='"+secD[i]+"'>"+secNm[i]+"</option>";
                }
            }
        });
    }


	var rowNum = 0;
function addRowAssign(frm){

	var vahicles = $("#vahicles").val();

	if(vahicles == "" || vahicles == null) {
		alert("First Select Vahicles");
		$("#vahicles").focus();
	}

	else{
		var shiftid = $('#shiftidrepo').val();
		var classid = $('#classnamerepo').val();
		var section = $('#sectionsrepo').val();
		var roll = $('#rollidrepo').val();
		var amount = $('#amount').val();
			

		if(shiftid == "" || shiftid == null) {
			alert("Shift is empty");
			$('#shiftidrepo').addClass('error');
			$('#shiftidrepo').focus();
		}

		else if(classid == "" || classid == null) {
			alert("Class is empty");
			$('#shiftidrepo').removeClass('error');
			$('#classnamerepo').addClass('error');
			$('#classnamerepo').focus();
			
		}

		else if(section == "" || section == null) {
			alert("Section is empty");
			$('#classnamerepo').removeClass('error');
			$('#sectionsrepo').addClass('error');
			$('#sectionsrepo').focus();
			
		}

		else if(roll == "" || roll == null) {
			alert("Roll No is empty");
			$('#sectionsrepo').removeClass('error');
			$('#rollidrepo').addClass('error');
			$('#rollidrepo').focus();
			
		}

		else if(amount == "" || amount == null) {
			alert("No amount selected.provide transport rent amount.");
			$('#rollidrepo').removeClass('error');
			$('#amount').addClass('error');
			$('#amount').focus();
			
		}

		
		else{
			//test vanassign 
			$.ajax({
			url:"index.php/account/studentAssignTest",
			type:"POST",
			data:{shift:shiftid,clsid:classid,section:section,roll:roll},
			success:function(data){
				//alert(data);
				if(data==0) { alert("Van Already Assign");exit; }
				}
			});
			
			
			rowNum++;

			$('#amount').removeClass('error');

			    var s = document.getElementById("shiftidrepo").options[document.getElementById("shiftidrepo").selectedIndex].innerText;

			    var c = document.getElementById("classnamerepo").options[document.getElementById("classnamerepo").selectedIndex].innerText;

			    var sec = document.getElementById("sectionsrepo").options[document.getElementById("sectionsrepo").selectedIndex].innerText;
			

			var row = '<div id="rowNum'+rowNum+'" class="form-group" style="margin-top:5px;" ><div class="col-sm-2"><input type="hidden" name="shift[]" id="assignShift'+rowNum+'" value="'+frm.shiftidrepo.value+'" /><input type="text" value="'+s+'" class="form-control" readonly style="width: 150px;" /></div><div class="col-sm-2"><input type="hidden" name="class[]" id="assignClass'+rowNum+'" value="'+frm.classnamerepo.value+'" /><input type="text" value="'+c+'" class="form-control" readonly style="margin-left: 0px;width: 146px;" /></div><div class="col-sm-2"><input type="hidden" name="section[]" id="assignSection'+rowNum+'" value="'+frm.sectionsrepo.value+'" /><input type="text" value="'+sec+'" class="form-control" readonly style="width: 146px;margin-left: 1px;" /></div><div class="col-sm-2"><input type="text" name="roll[]" value="'+frm.rollidrepo.value+'" id="assignRoll'+rowNum+'" class="form-control" readonly style="width: 146px;margin-left: 1px;" /></div><div class="col-sm-2"><input type="text" name="amount[]" value="'+frm.amount.value+'" id="assignAmount'+rowNum+'" class="form-control" readonly style="width: 147px;margin-left: 1px;" /></div><div class="col-sm-2"><button type="button" class="btn btn-danger" onClick="removeRow('+rowNum+');" style="margin-left: 1px;" ><span class="glyphicon glyphicon-minus"></span></button></div></div>';
				
			$("#vAssignRows").after(row);
			document.getElementById("AssignBtn").style.display = "block";

			frm.shiftidrepo.value	= '';
			frm.classnamerepo.value	= '';
			frm.sectionsrepo.value	= '';
			frm.rollidrepo.value 	= '';
			frm.amount.value 		= '';
		
		}
	}
}
		
function removeRow(rnum){
	$('#rowNum'+rnum).remove();
	rowNum--;

	if(rowNum <= 0){
		document.getElementById("AssignBtn").style.display = "none";
	}

}

// check if any data inserted
function checkData(){
	if(rowNum <= 0 ){
		alert("First Assign any student");
		return false;
	}else{
		return true;
	}
}

function checkDiplicateStudent(vahicles,shift,cls,section,roll){
	var i,assignRoll,assignShift,assignClass,assignSection,error = 0,errRowId;
	if(rowNum){

		for(i = 1;i <= rowNum;i++){
				document.getElementById("rowNum"+i).style = "border:1px solid white";
			}

		for(i = 1;i <= rowNum;i++){
			assignShift = document.getElementById("assignShift"+i).value;
			assignClass = document.getElementById("assignClass"+i).value;
			assignSection = document.getElementById("assignSection"+i).value;
			assignRoll = document.getElementById("assignRoll"+i).value;
			if( (assignShift == shift) && (assignClass == cls) && (assignSection == section) && (assignRoll == roll) ){
				error++;
				errRowId = i;
			}
		}
		if(error){
			alert("This student already assign to this van.Look below.");
			document.getElementById("rowNum"+errRowId).style = "border:1px solid red";
			$('html, body').animate({ scrollTop: $('#rowNum'+errRowId).offset().top }, 'slow');
			document.getElementById("rollidrepo").value = '';
			document.getElementById("rollidrepo").focus();
		}else{
			$('#rollidrepo').removeClass('error');
			duplicateCheckDb( vahicles,shift,cls,section,roll );
		}
	}else{
		$('#rollidrepo').removeClass('error');
		duplicateCheckDb( vahicles,shift,cls,section,roll );
	}
}

function duplicateCheckDb( vahicles,shift,cls,section,roll ){
	$.ajax({
		type:"POST",
		url:"index.php/accountReport/duplicateVanAssign/"+vahicles+"/"+shift+"/"+cls+"/"+section+"/"+roll,
		data:{},
		success:function(data){
			if(parseInt(data) == 1){
				alert("This student already assign for this van.Assign another student.");
				document.getElementById("rollidrepo").value = '';
				document.getElementById("rollidrepo").focus();
			}
		}
	});
}

</script>



            <div class="panel panel-default" style="margin-top:20px;">
                <div class="panel-body">
                    <div class="panel-body">

<form action="" method="post" class="form-horizontal" onsubmit="return checkData()" id="formidAss" >
	<div class="row">
		<div class="col-sm-12">

			<div class="form-group">
				<div class="col-md-offset-4 col-md-4">
					 <label for="vahicle">Vahicles</label>
					 <select name="vahicles" id="vahicles" class="form-control">
					 	<option value="">Select</option>
					 	<?php
							$where=array("status"=>1);
					 		$vInfo = $this->db->get_where("vahicles",$where)->result();
					 		foreach($vInfo as $v):
					 	?>
					 	<option value="<?php echo $v->vid ?>"><?php echo $v->name.'( '.$v->vnumber.' )'; ?></option>
					 	<?php
					 		endforeach;
					 	?>
					 </select>

				</div>
			</div>

			<div class="form-group" id="vAssignRows">
				
		  		
		  		<div class="col-sm-2">
		  			<label class="control-label">Shift:</label>         
					<select class="form-control" name="shiftid" id="shiftidrepo" onchange="getClassReceipt(this.value)">
						<option value="">Select</option>
					<?php 
						$sqlaccs=$this->db->select('*')->from('shift_catg')->get()->result();										
						foreach($sqlaccs as $accidshows){
					?>
						<option value="<?php echo $accidshows->shiftid ?>" <?php if(isset($shiftid)):if($shiftid == $accidshows->shiftid):echo "Selected";endif;endif; ?> ><?php echo $accidshows->shift_N?></option>
					
					<?php }?>
					
					</select>
		  		</div>

	  			
	  			<div class="col-sm-2">
	  				<label class="control-label" >Class Name:</label>          
					<select class="form-control" name="classname" id="classnamerepo" onchange="ClassSectionReceipt(this.value);">
						<option value="">Select</option>
					<?php
						if(isset($shiftid)):
							$shiftData = array( "shiftid" => $shiftid );
							$getClass = $this->db->get_where("class_catg",$shiftData)->result();
							foreach($getClass as $gc):
					?>
						<option value="<?php echo $gc->classid ?>" <?php if(isset($classname)):if($classname == $gc->classid):echo "selected";endif;endif; ?> ><?php echo $gc->class_name ?></option>
					<?php
						endforeach;
						endif;
					?>
					</select>
	  			</div>

	   			
	  			
	  			<div class="col-sm-2">
	  				<label class="control-label" >Section:</label>          
					<select class="form-control" name="sections" id="sectionsrepo" >
						<option value="">Select</option>
					<?php
						if(isset($classname)):
							$secData = array( "classid" => $classname );
							$getSection = $this->db->order_by("section_name","ASC")->get_where("section_tbl",$secData)->result();
							foreach( $getSection as $gs ):
					?>
						<option value="<?php echo $gs->sectionid ?>" <?php if(isset($sections)):if($sections == $gs->sectionid):echo "selected";endif;endif; ?> ><?php echo $gs->section_name ?></option>
					<?php
						endforeach;
						endif;
					?>
					</select>
	  			</div>

	   			
				  
				  <div class="col-sm-2">
				  	<label class="control-label">Roll No:</label>        
					<input type="text" name="stuclroll"  class="form-control" id="rollidrepo" placeholder="Roll No" value="<?php if(isset($stuclroll)):echo $stuclroll;endif; ?>" onkeypress="return isNumber(event)" onchange="checkDiplicateStudent(vahicles.value,shiftidrepo.value,classnamerepo.value,sectionsrepo.value,this.value)" />
				  </div>

				  <br/>
				  
				  <div class="col-sm-2" style="margin-top:-20px;">
				  	<label class="control-label">Rent Amount</label>
				  	<input type="number" name="amount" id="amount" class="form-control">
				  </div>

				  <div class="col-sm-2" style="margin-top: 7px;">
				  		<button class="btn btn-primary" name="ReportSearch" id="ReportSearch" type="button" onclick="addRowAssign(this.form)" ><span class="glyphicon glyphicon-plus"></span></button>
				  </div>

			</div>

			<div class="col-md-offset-4 col-md-2" style="margin-top: 10px;float: right;margin-right: 20px;">
				<button class="btn btn-primary" name="submitBtn" id="AssignBtn" style="display: none;" >Submit</button>
			</div>

  		</div>
	</div>
	</form><br/>
</div>
</div>
</div>