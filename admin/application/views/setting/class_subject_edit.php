<aside class="right-side">      <!---rightbar start here --->
    <style>
		.error{
			border-color:red;
		}
	</style>            <!-- Content Header (Page header) -->
<script>
$(document).ready(function(){
 $('#subject_class_form').submit(function() {
	 document.getElementById('subject_submit').innerHTML = 'Updateing----';
	 document.getElementById('subject_submit').disabled = 'disabled';
		$.post(
            "index.php/setting_submit/subject_class_edit",
            $("#subject_class_form").serialize(),
            function(data){
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
			  document.getElementById('subject_submit').innerHTML = 'Update';
		});
 return false;
 });
});


// subject mark calculation start
function sub_setup_mark_calculation(theo_mrk,ex_mark,prac_mark) {
	var t,o,p;
	t=parseInt(theo_mrk);
	o=parseInt(ex_mark);
	p=parseInt(prac_mark);
	
	if(isNaN(t)){
	t=0;
	}
	
	if(isNaN(o)){
		o=0;
	}
	
	if(isNaN(p)){
		p=0;
	}
  
  var total=t+o+p;
  if(total=='') { alert('Total Mark is Empty'); return false; }
  document.getElementById("total_mark").value=total;
}
//subject mark calculation end

</script>

			
                <section class="content-header">
                    <h1>
                        Subject Edit
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<!---confirmation msg start-->	
					<div id="confirmation" class="alert alert-success alert-dismissable" style="display:none;">
						<i class="fa fa-check"></i>
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<b>Data Update Successfully
					</div>
					<!---confirmation msg End-->
					<div class="row">
					  <div class="col-md-12">
					   <form class="form-horizontal" role="form" action="Setting_submit/subject_class_edit" method="post" id="subject_class_form">	
							<table class="table table-hover">
								<tr>
									<th>Subject Name</th>
									<th>Theory</th>
									<th>Objective</th>
									<th>Practical</th>
									<th>Total</th>
									<th>Sequence</th>
									<th>Group</th>
									<th>Option</th>
								</tr>
								
								<tr>
									
									<td>
										<input type="text" name="subject" class="form-control" readonly required value="<?php echo $edit_subject->sub_name;  ?>"/>
									</td>
									
									<td>
										<input type="number" min="0" name="theo_mark" onkeyup="sub_setup_mark_calculation(this.value,obj_mark.value,prac_mark.value);" id="theo_mark" class="form-control" required value="<?php echo $edit_subject->stherory_mk;  ?>"/>
										<input type="hidden" value="<?php echo $edit_subject->subjid; ?>" name="hid_subid"/>
									</td>
									
									<td>
										<input type="number" min="0" name="obj_mark" onkeyup="sub_setup_mark_calculation(theo_mark.value,this.value,prac_mark.value);" id="obj_mark" class="form-control" required value="<?php echo $edit_subject->sobj_mk;  ?>"/>
									</td>
									
									<td>
										<input type="number" min="0" name="prac_mark" onkeyup="sub_setup_mark_calculation(theo_mark.value,obj_mark.value,this.value);" id="prac_mark" class="form-control" required value="<?php echo $edit_subject->sprack_mk;  ?>"/>
									</td>
									
									<td>
										<input type="number"  min="0" name="total_mark" id="total_mark" readonly class="form-control" required value="<?php echo $edit_subject->exm_mark;  ?>"/>
									</td>
									
									<td>
										<input type="number" min="0" name="sequence" required class="form-control" required value="<?php echo $edit_subject->sequence;  ?>"/>
									</td>
									
									<td>
										<select name="group" class="form-control">
											<option value="0">Group</option>
											<?php foreach($all_group as $value){  ?>
											<option value="<?php echo $value->groupid; ?>"><?php echo $value->group_name; ?></option>
											<?php } ?>
										</select>
									</td>
									
									<td>
										<select name="optional" class="form-control">
											<option value="0">No</option>
											<option value="1">Yes</option>
										</select>
									</td>
									
								</tr>
								
								<tr>
									<td colspan="8"><center style="font-size:20px;"><button type="submit" name="sub_dis" class="btn btn-primary" id="subject_submit">Update</button>&nbsp;<a href="index.php/basic_setting/setting">
									<button type="button" value="" class="btn btn-success" id="reset" data-toggle="tooltip"title="Go Back"><span class="glyphicon glyphicon-arrow-left"></span> Back</button></a></center></td>
								</tr>
								
							</table>	
					
						</form>
					</div>
				</div>


                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->