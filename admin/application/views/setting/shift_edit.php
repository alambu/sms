<aside class="right-side">      <!---rightbar start here --->
    <style>
		.error{
			border-color:red;
		}
	</style>            <!-- Content Header (Page header) -->
<script>
$(document).ready(function(){
 $('#shift_form').submit(function() {
	 document.getElementById('shift_submit').innerHTML = 'Updateing----';
	 document.getElementById('shift_submit').disabled = 'disabled';
		$.post(
            "index.php/setting_submit/shift_edit",
            $("#shift_form").serialize(),
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
				  document.getElementById('shift_submit').disabled = false;
			  }
			  document.getElementById('shift_submit').innerHTML = 'Update';
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
                      <div class="col-md-10">
					 <form class="form-horizontal" role="form" action="Setting_submit/shift_edit" method="post" id="shift_form">
						<div class="form-group" id="itemRows">
						  <label class="control-label col-sm-2" for="pwd">Shift Name:</label>
						  <div class="col-sm-5" id="shak_id">          
							<input type="text" name="shift" value="<?php echo $edit_shift->shift_N; ?>"  class="form-control"  id="shift" placeholder="Enter Shift Name" required />
							<input type="hidden" name="shiftid" value="<?php echo $edit_shift->shiftid; ?>"/>
						  </div>
						  <div class="col-sm-3">          
							<button type="submit"  name="submit_edit" class="btn btn-primary" data-toggle="tooltip"title="Update" id="shift_submit">Update</button>
							&nbsp;&nbsp;
							<a href="index.php/basic_setting/setting">
							<button type="button" value="" class="btn btn-success" id="reset" data-toggle="tooltip"title="Go Back"><span class="glyphicon glyphicon-arrow-left"></span> Back</button></a>
						  </div>
						</div>
						
						
						<div class="form-group">        
						  <div class="col-sm-offset-2 col-sm-10">
							
							
						  </div>
						</div>
						
						<div class="form-group">        
						  <div class="col-sm-offset-2 col-sm-10">
							
						  </div>
						</div>
					  </form>			
						
					  </div>
					  <div class="col-md-2">
					  
					  </div>
                    </div>


                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->