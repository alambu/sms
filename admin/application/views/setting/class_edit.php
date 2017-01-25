<aside class="right-side">
<script type="text/javascript">

// class catgaroy add row

		var rowNum=0;
		function addRow_cls(frm) {
		var shift_name=$('#cls_shift_name').val().trim();
		var section_cls=$('#section_cls').val().trim();
		var section=$('#section').val().trim();
		//alert(section);
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
			document.getElementById('reset').value=rowNum;
			
			$('#section_cls').removeClass('error');
			$('#section').removeClass('error');
			var row='<div id="rowNum'+rowNum+'" class="form-group"><div class="col-sm-10"><input type="text" name="section[]" class="form-control"  onkeypress="return only_chareter(this.value)"   value="'+frm.section.value+'" required /></div><div class="col-sm-2"><button type="button" class="btn btn-danger" data-toggle="tooltip" title="Drop" onClick="removeRow('+rowNum+');" ><span class="glyphicon glyphicon-minus-sign"></span></button></div></div>';
				
			$("#itemRows").after(row);
			
			frm.section.value='';
				
				
			
		}
		
		}
		
		function removeRow(rnum){
			
			$('#rowNum'+rnum).remove();
			rowNum --;
			
		}
		
		function reset_content(reset_id){
			var con=confirm("Are You Sure Reset ?");
			if(con==true){
			for (var i=1;i<=reset_id;i++){
				$('#rowNum'+i).remove();
			}
			rowNum=0;
			}
			else {
				return false;
				
			}
			
		}
		
function validation_cls(){
		  if(rowNum=='0'){
			  alert('Please Add Section');
			  return false;
		  }
		  else{
			  return true;
		  }
	  }
	  
	  

function group_show(v)
{
	if(v==1)
    {		
	document.getElementById("group_row").style.display="block";	
	}
	else if(v==0)
	{
	document.getElementById("group_row").style.display="none";		
	}	
}


//form submit start

$(document).ready(function(){
 $('#class_edit_form').submit(function() {
	 document.getElementById('class_submit').innerHTML = 'Updateing----';
	 document.getElementById('class_submit').disabled = 'disabled';
		$.post(
            "index.php/setting_submit/class_edit",
            $("#class_edit_form").serialize(),
            function(data){
			  // alert(data);	
              if(data==1)
			  {
				 alert('Update Successfully');
				 location.reload();
			  }	
			  else 
			  {  
				  alert(data);
				  document.getElementById('class_submit').disabled = false;
			  }
			  document.getElementById('class_submit').innerHTML = 'Update';
		});
 return false;
 });
});	  

//form submit end	
</script>

		<section class="content-header">
			<h1>
				Class Edit
				<small>Control panel</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</section>
		<?php extract($_GET); ?>
		<section class="content">
			<div class="row">
				<div class="col-sm-12">
					<form class="form-horizontal" role="form" action="Setting_submit/class_edit" method="post" id="class_edit_form">	  
						<div class="form-group">
							<div class="col-sm-8">
								<label>Class Name</label>
								  <input type="text" class="form-control" name="class_name" value="<?php foreach($edit_class as $value) { echo $value->class_name; break; } ?>" placeholder="Class Name">
								  <input type="hidden" class="form-control" name="classid" value="<?php echo $id; ?>" placeholder="Class Name">
								 
								  
							</div>
						</div>
						<?php foreach($edit_class as $value) { ?>
						<div class="form-group">
							<div class="col-sm-8">
								<label>Section</label>
								  <input type="text" class="form-control" name="section_name[]" value="<?php echo $value->section_name; ?>" placeholder="Section Name">
								  <input type="hidden" name="section[]" class="form-control" value="<?php echo $value->sectionid; ?>" placeholder="Section Name">
							</div>	
						</div>
						<?php
						$group=$this->bsetting->group_explode_array($value->groupid);

						foreach($all_group as $gvalue) {
						?>	
						<div class="form-group">
							<div class="col-sm-4">
								 <input type="hidden" class="form-control" name="total_group" value="<?php echo count($all_group); ?>" placeholder="Class Name">
								<label></label>
								<input type="text" class="form-control" disabled value="<?php echo $gvalue->group_name; ?>" placeholder="Section Name"/>
								<input type="hidden" class="form-control" name="group[]"  value="<?php echo $gvalue->groupid; ?>" placeholder="Section Name"/>
							</div>	
							<div class="col-sm-2">
								<label></label>
								<select class="form-control" name="chk_group[]">
									<option value="0">Not Selected</option>
									<option <?php foreach($group as $select_group) { if($select_group==$gvalue->groupid) { echo "selected"; } } ?> value="1">Selected</option>
								
									
								</select> 
							</div>
						</div>
						<?php } } ?>
						<div class="form-group">
							<a href="index.php/basic_setting/setting">
							&nbsp; &nbsp; &nbsp; <button type="button" value="" class="btn btn-success" id="reset" data-toggle="tooltip"title="Go Back"><span class="glyphicon glyphicon-arrow-left"></span> Back</button>
							</a>
							<button type="submit" value="" class="btn btn-primary" id="class_submit" data-toggle="tooltip"title="Click Update">Update</button>
						</div>
					</form>
				</div>
			</div>
		</section>
	<hr/>									
</aside>
