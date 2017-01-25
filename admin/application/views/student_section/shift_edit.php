<aside class="right-side">      <!---rightbar start here --->
    <style>
		.error{
			border-color:red;
		}
		input{
			text-transform:uppercase;
		}
	</style>            <!-- Content Header (Page header) -->

	<?php 
		if(isset($_GET['id'])){
			$id=$_GET['id'];
			$select=$this->db->query("select * from shift_catg where shiftid='$id' ")->row()->shift_N;
		}
	?>
	
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
<!-----------------confirmation msg start--------------------------->
					<?php $this->load->view('student_section/submit_confirm'); ?>
<!-----------------confirmation msg End----------------------------->
                    <div class="row">
                      <div class="col-md-10">
					 <form class="form-horizontal" role="form" action="student_submit/shift_setting" method="post">
						<div class="form-group" id="itemRows">
						  <label class="control-label col-sm-2" for="pwd">Shift Name:</label>
						  <div class="col-sm-5" id="shak_id">          
							<input type="text" name="shift" value="<?php echo $select; ?>"  class="form-control" onkeypress="return only_chareter(this.value)" id="shift" placeholder="Enter Shift Name" required />
							<input type="hidden" name="shiftid" value="<?php echo $id; ?>"/>
							<input type="hidden" name="old_shift" value="<?php echo $select; ?>"/>
						  </div>
						  <div class="col-sm-3">          
							<button type="submit" name="submit_edit" class="btn btn-primary" data-toggle="tooltip"title="Update"><span class="glyphicon glyphicon-send"></span> Update</button>
							&nbsp;&nbsp;
							<a href="student_section/level_1_setting">
							<button type="button" value="" class="btn btn-success" id="reset" data-toggle="tooltip"title="Go Back"><span class="glyphicon glyphicon-backward"></span> Back</button></a>
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