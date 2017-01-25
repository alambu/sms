<aside class="right-side">      <!---rightbar start here --->
    <style>
		.error{
			border-color:red;
		}
	</style>            <!-- Content Header (Page header) -->
<script>
$(document).ready(function(){
 $('#subject_update_form').submit(function() {
	 document.getElementById('subject_submit').innerHTML = 'Updateing----';
	 document.getElementById('subject_submit').disabled = 'disabled';
		$.post(
            "index.php/setting_submit/subject_edit",
            $("#subject_update_form").serialize(),
            function(data){
              if(data==1)
			  {
				 $('#confirmation').fadeIn('slow').delay(2000).fadeOut('slow');
					setTimeout(function(){					
					window.location="index.php/basic_setting/setting";
					//window.location="index.php/account_edit/expanse_print";
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



</script>

			
                <section class="content-header">
                    <h1>
                        Shift Edit
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
					   <form class="form-horizontal" role="form" action="setting_submit/subject_setup" method="post" id="subject_update_form">	
							<table class="table table-hover">
								<tr>
									<th>Subject Name</th>
									<th>Short Name</th>
								</tr>
								
								<tr>
									
									<td>
										<input type="text" name="subject" class="form-control" required value="<?php echo $edit_subject->sub_name;  ?>"/>
									</td>
									
									<td>
										<input type="text" name="short_name" class="form-control" required value="<?php echo $edit_subject->short_name;  ?>"/>
										<input type="hidden" value="<?php echo $edit_subject->subsetid; ?>" name="hid_subid"/>
									</td>
									
								</tr>
								
								<tr>
									<td colspan="2"><center style="font-size:20px;"><button type="submit" name="sub_dis" class="btn btn-primary" id="subject_submit">Update</button>&nbsp;<a href="index.php/basic_setting/setting">
									<button type="button" value="" class="btn btn-success" id="reset" data-toggle="tooltip"title="Go Back"><span class="glyphicon glyphicon-arrow-left"></span> Back</button></a></center></td>
								</tr>
								
							</table>	
					
						</form>
					</div>
				</div>


                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->