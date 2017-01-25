<script type="text/javascript">

// class catgaroy add row

		var rowNum=0;
		function addRow_cls(frm) {
		var shift_name=$('#cls_shift_name').val().trim();
		var section_cls=$('#section_cls').val().trim();
		var section=$('#section').val().trim();
		var tgrp=frm.tgroup.value;
		var grptext=[];var grpval=[];var chkv;
		for(var i=1;i<=tgrp;i++)
		{	chkv=document.getElementById("chk_group_"+i).value;
			if(chkv>0)
			{
				
				grptext.push(document.getElementById("chose_group_"+i).value);
				grpval.push(document.getElementById("chk_group_"+i).value);
			}	
		}
		var imp_grp_text=grptext.join();
		var imp_grpval=grpval.join();
		if(imp_grp_text=='' || imp_grpval=='')
		{
			imp_grp_text='has No Group';
		}	
		//check box end
		
		if(shift_name=='')
		{
			alert('Shift Name is Empty');
		}
		
		else if(section_cls=='')
		{
			alert('Class is Empty');
		}
		else if(section=='')
		{
			alert('Section is Empty');
		}
		else 
		{
			
					
			rowNum ++;
			var row='<div id="rowNum'+rowNum+'" class="form-group"><div class="col-sm-5"><input type="text" name="section[]" class="form-control"  onkeypress="return only_chareter(this.value)"   value="'+frm.section.value+'" required /></div><div class="col-sm-5"><input type="text" name="grouptxt[]" readonly class="form-control"  onkeypress="return only_chareter(this.value)"   value="'+imp_grp_text+'" required /><input type="hidden" name="group[]" readonly class="form-control"  onkeypress="return only_chareter(this.value)"   value="'+imp_grpval+'" required /></div><div class="col-sm-2"><button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Drop" onClick="removeRow_cls('+rowNum+');" >Remove Section</button></div></div>';
			for(var j=1;j<=tgrp;j++)
			{ 
			if(document.getElementById("chk_group_"+j).value>0)
			{
			document.getElementById("chk_group_"+j).value=0;
			} 
			}	
			$("#itemRows").after(row);
			frm.section.value='';
				
				
			
		}
		
		}
		
		function removeRow_cls(rnum){
			$('#rowNum'+rnum).remove();
			rowNum --;	
		}


$(document).ready(function(){
 $('#class_setup_form').submit(function() {
	 document.getElementById('class_submit').innerHTML = 'Saveing----';
	 document.getElementById('class_submit').disabled = 'disabled';
		$.post(
            "index.php/setting_submit/class_setting",
            $("#class_setup_form").serialize(),
            function(data){	
              if(data==1)
			  {
				alert('Data Save Successfully');
				location.reload();
			  }	
			  else 
			  {  
				  alert(data);
				  document.getElementById('class_submit').disabled = false;
			  }
			  document.getElementById('class_submit').innerHTML = 'Save';
		});
 return false;
 });
});	  

//form submit end	


function show_class(sft)
{
	if(sft!='')
	{
	url='basic_setting/show_class?sft='+sft;
	$("#show_cls").empty().append('<p align="center" style="margin-top:5%"><img src="img/line.gif"></p>');
	$("#show_cls").load(url);
	}
}
</script>

		<form class="form-horizontal" role="form" action="setting_submit/class_setting" method="post" id="class_setup_form">
			  
			<div class="form-group">
			  <div class="col-sm-6" id="shak_id_1">
				<label>Shift Name</label>
				<select name="shift_name" id="cls_shift_name" class="form-control">
					<option value="">Select Shift</option>
					<?php foreach($sft as $value) {  ?>
					<option value="<?php echo $value->shiftid; ?>"><?php echo $value->shift_N; ?></option>
					<?php } ?>
				</select>	
			  </div>
			  
			  <div class="col-sm-6">
				<label>Class Name</label>
				<input type="text"  name="cls_name" class="form-control"  onkeypress="return only_chareter(this.value)" id="section_cls" placeholder="Select Class name"/>	
			  </div>
			</div>
			
			<div class="form-group">
			  <div class="col-sm-12" id="shak_id_1">
				<label>Section Name</label>
				<input type="text"  name="sec_name" class="form-control"  onkeypress="return only_chareter(this.value)" id="section" placeholder="Enter Class name"/>	
			  </div>
			</div>
			
			<div class="form-group">
			    <div class="col-sm-10">
					You Can ADD Group This Section
			    </div>
				<div class="col-sm-2">
					Select Group
				</div>
			</div>
			
			<?php $g=0; foreach($all_group as $value) { $g++; ?>
			<div class="form-group">
			    <div class="col-sm-10">
					<input type="text" name="" id="chose_group_<?php echo $g; ?>" class="form-control" readonly value="<?php echo $value->group_name; ?>"/>
			    </div>
				<div class="col-sm-2">
					<select class="form-control" name="" id="chk_group_<?php echo $g; ?>">
						<option value='0'>No</option>
						<option value='<?php echo $value->groupid; ?>'>Yes</option>
					</select>
				</div>
			</div>
			<?php } ?>
			<div class="form-group" id="itemRows">
			    <div class="col-sm-10">
				<input type="hidden" name="tgroup"  value="<?php echo count($all_group); ?>"/>
			    </div>
				<div class="col-sm-2">
					<center><label style="opacity:0;">nothing</label></center>
					<button type="button"  value="ADD" class="btn btn-success btn-sm" onclick="addRow_cls(this.form);" data-toggle="tooltip" title="Add">ADD SECTION</button>
			    </div>

			</div>
			
															
		<div class="form-group">        
		   
		  
		   <div class="col-sm-12"> 
				<center>
					<button type="submit" name="class_submit" id="class_submit" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Save">Save Class</button>
				</center>
		   </div>
		  
		</div>
			
		</form>

	<hr/>									
<!---Class Setting End-->

<!-- subject setting start -->
<!---Class List Start-->

<?php if($t_crow>0){ ?>


<div class="row">
	<div class="col-md-12">
		<table class="table table-condensed">
			<tr class="active">
				<td><b style="font-size:18px;line-height:20px;color:dark-gray ;">Class List</b></td>
			</tr>
		
		</table>
	</div>
</div>

<br/>

<!-----class list report start------->
<style>
.panel-heading a:after {
    font-family:'Glyphicons Halflings';
    content:"\e114";
    float: right;
    color: black;
}
.panel-heading a.collapsed:after {
    content:"\e080";
}
table tr:hover{
	background:lightblue;
}
table tr:hover {
	background:lightblue !important;
}
</style>
	
	<div class="row">
		<div class="col-md-12">
			<label>Shift Name</label>
			<select name="shift_name" id="cls_shift_search" class="form-control" onchange="show_class(this.value);">
				<option value="">Select Shift</option>
				<?php foreach($sft as $value) {  ?>
				<option value="<?php echo $value->shiftid; ?>"><?php echo $value->shift_N; ?></option>
				<?php } ?>
			</select>	
		</div>
	</div>
	</br>
	<div id="show_cls">
	</div>
<!-----class list report End------->	
<?php } ?>