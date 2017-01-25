<script>
$(document).ready(function(){
 $('#group_form').submit(function() {
	 document.getElementById('group_submit').innerHTML = 'Saveing----';
	 document.getElementById('group_submit').disabled = 'disabled';
		$.post(
            "index.php/setting_submit/group_setting",
            $("#group_form").serialize(),
            function(data){
              if(data==1)
			  {
				 $('#confirmation').fadeIn('slow').delay(2000).fadeOut('slow');
					setTimeout(function(){					
					window.location="index.php/basic_setting/setting";
					//window.location="index.php/account_edit/expanse_print";
					},2000)
			  }	
			  else if(data==3){
				 alert('Field is Empty');  
			  }	  
			  else if(data==4){
				  alert('Shift Already Exist');
				  document.getElementById('group_submit').disabled = false;
			  }
			  document.getElementById('group_submit').innerHTML = 'Save';
		});
 return false;
 });
});


</script>

<form class="form-horizontal" role="form" action="Setting_submit/group_setting" method="post" id="group_form">
	<div class="form-group">
		<div class="col-md-2">
			<b style="float:right;padding-top:5px;">Group Name</b>
		</div>
		<div class="col-md-8">	
			<input type="text" name="group" class="form-control"  onkeypress="return only_chareter(this.value)" placeholder="Enter Group Name" required/>
		</div>
					
		<div class="col-md-2">
			<button type="submit" name="submit" id="group_submit" class="btn btn-primary" data-toggle="tooltip" title="Save"> Save</button>
		</div>
	</div>
</form>
 
<hr/>
																					
<!---Shift Setting End-->



<!---Shift Edit Start-->
										
	<?php if($t_srow!=0){ ?>
		
		<div class="row">
			<div class="col-md-12">
				<table class="table table-condensed table-striped">
					<tr class="active">
						<td><b style="text-align:left;font-size:16px;">Group List</b></td>
					</tr>
				
				</table>
			</div>
		</div>
		<br/>
		<div class="row">
			<div class="col-sm-12">
			<table id="example3" class="table table-bordered table-striped table-condensed">
				<thead>
					<tr>
						<th>Sl.No</th>
						<th>Group Name</th>
						<th>Action</th	>
					</tr>
				</thead>
				<tbody>
					<?php $sfid=1;
					foreach($all_group as $value){
					$test=$this->bsetting->group_delete_test($value->groupid);
					if($test>0) { $disable="disabled"; } else { echo $disable=""; }	
					?>
					<tr>
						<td><?php echo $sfid++; ?></td>
						<td><?php echo $value->group_name ?></td>
						<td><a href="basic_setting/group_edit?id=<?php echo $value->groupid; ?>"><button type="button" class="btn btn-primary" data-toggle="tooltip" title="Edit" ><span class="glyphicon glyphicon-edit"></span></button></a>
						
						<a onclick="return delete_confirm();" href="setting_submit/group_delete?id=<?php echo $value->groupid; ?>"><button  type="button" class="btn btn-danger" <?php echo $disable; ?> data-toggle="tooltip" title="Delete" ><span class="glyphicon glyphicon-remove"></span></button></a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			
			</table>
			</div>
		</div>
	<?php } ?>