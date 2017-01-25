<script type="text/javascript">
function ajax_request_clsid(cls_id){
	
$.ajax({
	url: "index.php/student_submit/ajax_request",
	type: 'POST',	
	data:{cls_id:cls_id},	
	success: function(data)
	{		
		var d=data.split(",");
		if(data.length>0){
		var sec="Select";
		document.getElementById("section").innerHTML='';
		document.getElementById("section").innerHTML="<option value=''>"+sec+"</option>";
		
		for(var i=0;i<d.length;i++){
			
			document.getElementById("section").innerHTML+="<option value='"+d[i]+"'>"+d[i]+"</option>";
		}
		}
	
	else {
		var sec="Select";
		document.getElementById("section").innerHTML='';
		document.getElementById("section").innerHTML="<option value=''>"+sec+"</option>";
	}
	
	}          
	});
}


function selected_class(sftid)
{
	$.ajax({
	url: "index.php/basic_setting/selected_class",
	type: 'POST',	
	data:{sft_id:sftid},	
	success: function(data)
	{
		if(data.length!=0) {
		var data1=data.split("#");	
		var d=data1[0].split(",");
		var d1=data1[1].split(",");
		var sec="Select Class";
		document.getElementById("class_catg").innerHTML='';
		document.getElementById("class_catg").innerHTML="<option value=''>"+sec+"</option>";
		
		for(var i=0;i<d.length;i++){
			
			document.getElementById("class_catg").innerHTML+="<option value='"+d1[i]+"'>"+d[i]+"</option>";
		}
	}
	else {
		document.getElementById("class_catg").innerHTML='';
		document.getElementById("class_catg").innerHTML="<option value=''>Select Class</option>";
	}
	
	}
	
	});
}


$("document").ready(function(){
	
	$("#attendance_entry").submit(function(e) {
	e.preventDefault();
	
	var formData = new FormData(this);

	$.ajax({  
		 type: "POST",  
		 url: "index.php/student_submit/attendance",  
		 data: formData,
		 async: false,
		 cache: false,
		 contentType: false,
		 processData: false,
		 beforeSend:function(){
			 document.getElementById('attendance_submit').disabled = "disabled";	
			 document.getElementById('attendance_submit').innerHTML = 'Saveing---';
		 },
		 success: function(data) {
			 if(data==1)
			 {
				 alert('Data Save Successfully');
				 location.reload();
			 }
			 else { 
			 alert(data);
			 document.getElementById('attendance_submit').innerHTML = 'Save';
             document.getElementById('attendance_submit').disabled = false;
			 }
		 }
	}); 
	//return false;
	});
		
		
});

function section_routine_show(frm)
{
    var sft,year,cls;
	sft=frm.shift.value.trim();
	year=frm.year.value.trim();
	cls=frm.class_catg.value.trim();
	if((sft=='') || (year=='') || (cls==''))
	{
		alert('Filup All Field');exit;
	}	
	url='class_routine/section_routine_show?sft='+sft+'&year='+year+'&cls='+cls;
	$("#sec_show").empty();
	$("#sec_show").empty().append('<p align="center" style="margin-top:5%"><img src="img/line.gif"></p>');
	$("#sec_show").load(url);

}
</script>
<?php  
$all_shift=$this->student->all_shift();
?>
<div class="row">
	<div class="col-md-12">
		<form class="form-horizontal" role="form" action="student_section/attendance" method="post">

			<table class="table table-condensed">
			
				<tr>
					<td>
						<div class="form-group">
						
							<div class="col-md-3">
								<label  for="pwd">Session</label>
								<select name="year" id="year" class="form-control" required >
								<?php $y=date("Y");$my=date("Y")+1; for($y;$y<=$my;$y++){ ?>
								<option value="<?php echo $y; ?>"><?php echo $y; ?></option>
								<?php } ?>
								</select>
							</div>
						
							<div class="col-md-3">
								<label  for="pwd">Shift </label>
								<select name="shift" id="shift" class="form-control" onchange="selected_class(this.value);" required>
									<option value="">Select</option>
									<?php 
										foreach($all_shift as $value){
									?>
									<option value="<?php echo $value->shiftid; ?>"><?php echo $value->shift_N; ?></option>
										<?php } ?>
								</select>
							
							</div>
							
							<div class="col-md-3">
								<label  for="pwd">Class</label>
								<select name="class_catg" id="class_catg" class="form-control" required >
									<option value="">Select</option>
									
								</select>
							</div>
						 
							<div class="col-md-3">
								<label  for="pwd"></label>
								<button style="margin-top:24px;" type="button" name="search" onclick="section_routine_show(this.form);" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span>  Search</button>
							</div> 
							
						</div>
					</td>
				</tr>	
			</table>
		</form>
	</div>
</div>
</br>
<div id="sec_show">

</div>