<style>
.error
{
	border:1px solid red;
}
</style>

<script type="text/javascript">
$(document).ready(function(){
	  $('#subject_setup_form').submit(function() {
		    document.getElementById('subject_submit').innerHTML = 'Saveing----';
		    document.getElementById('subject_submit').disabled = 'disabled';
		  $.post(
				"index.php/setting_submit/subject_setup",
				$("#subject_setup_form").serialize(),
				function(data){
				 //alert(data);	
				 if(data==1)
				 {
					 $('#confirmation').fadeIn('slow').delay(2000).fadeOut('slow');
					setTimeout(function(){					
					window.location="index.php/basic_setting/setting";
					},2000) 
				 }
				 else 
				 {
					 alert(data);
					 document.getElementById('subject_submit').disabled = false;
				 }
				 document.getElementById('subject_submit').innerHTML = 'Save';
			 });
		 return false;
		 }); 
  });
	
	
	

	
	// remove first space key


		var rowNum=0,test=0,data=1;
		function addRow_sub_setup(frm) {
		var subject_var=frm.subject.value.trim();
		var short_name=frm.short_name.value.trim();
		
		if(subject_var=='')
        {
			//document.getElementByName(subject).focus();
			alert('Subject Name is Empty');
		}
		else if(short_name=='')
        {
			//document.getElementByName(short_name).focus();
			alert('Short Name is Empty');
		}
		
		else {
			
			rowNum ++;
			var row='<tr class="rowNum'+rowNum+'"><td><input type="text" name="subject[]" value="'+subject_var+'" class="form-control" required id=""/></td><td><input type="text" name="short_name[]" required class="form-control" value="'+short_name+'" id=""/></td><td><button type="button" class="btn btn-danger" onclick="removeRow('+rowNum+');"><span class="glyphicon glyphicon-minus-sign"></span></button></td></tr>';
			$("#itemRows_subject_set").after(row);
			frm.subject.value='';
			frm.short_name.value='';
			
							

		}
		
		}
		
	function removeRow(rnum){
		$('.rowNum'+rnum).remove();
		rowNum --;
		
	}
		

	  
  function remove_row(id)
  {
	 //alert(id);
	 $("#row_"+id).remove(); 
  }
</script>

<h3>Subject SetUp</h3>
<div class="row">
	  <div class="col-md-12">
	   <form class="form-horizontal" role="form" action="setting_submit/subject_setup" method="post" id="subject_setup_form">	
			<table class="table table-hover">
				<tr>
					<td class="">Subject</td>
					<td class="">Short Name</td>
					<td class="">Add</td>
				</tr>
				
				<tr id="itemRows_subject_set">
					
					<td>
						<input type="text" name="subject" class="form-control" value=""/>
					</td>
					
					<td>
						<input type="text" name="short_name" class="form-control" value=""/>
					</td>
					
					<td>
						<button type="button" class="btn btn-primary" onclick="addRow_sub_setup(this.form);"><span class="glyphicon glyphicon-plus-sign"></span></button>
					</td>
				</tr>
				
				<tr>
					<td colspan="9"><center style="font-size:20px;"><button type="submit" name="sub_dis" class="btn btn-primary" id="subject_submit">Save</button></center></td>
				</tr>
			</table>	
	
		</form>
	</div>
</div>

		<div class="row">
			<div class="col-md-12">
				<table class="table table-condensed table-striped">
					<tr class="active">
						<td><b style="text-align:left;font-size:16px;">All Subject List</b></td>
					</tr>
				
				</table>
			</div>
		</div>
		<br/>
		<div class="row">
			<div class="col-sm-12">
			<table id="example5" class="table table-bordered table-striped table-condensed">
				<thead>
					<tr>
						<th>Sl.No</th>
						<th>Subject Name</th>
						<th>Short Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $sfid=1;
					foreach($all_subject as $value) {
						$test=$this->bsetting->subject_delete_test($value->subsetid);
						$dis="";
						if($test>0) { $dis="disabled"; }
					?>
					<tr>
						<td><?php echo $sfid++; ?></td>
						<td><?php echo $value->sub_name; ?></td>
						<td><?php echo $value->short_name; ?></td>
						
						<td><a href="basic_setting/subject_edit?id=<?php echo $value->subsetid; ?>"><button type="button" class="btn btn-primary" data-toggle="tooltip" title="Edit" ><span class="glyphicon glyphicon-edit"></span></button></a>
						
						<a onclick="return delete_confirm();" href="setting_submit/subject_delete?id=<?php echo $value->subsetid; ?>"><button  type="button" class="btn btn-danger" <?php echo $dis; ?> data-toggle="tooltip" title="Delete" ><span class="glyphicon glyphicon-remove"></span></button></a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			
			</table>
			</div>
		</div>
