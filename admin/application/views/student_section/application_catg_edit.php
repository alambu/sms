
<aside class="right-side">      <!---rightbar start here --->
           <!-- Content Header (Page header) -->
<script type="text/javascript">


<?php
if(isset($_GET['id'])){
	extract($_GET);
	$select=$this->db->query("select a.*,b.class_name from application_catg a, class_catg b where a.classid=b.classid and a.years='$y' and a.appctgid='$id'")->row();
	
}
?>  
</script>	
		
                <section class="content-header">
                    <h1>
                        Edit Application Catagory
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>
				
                <!-- Main content -->
                <section class="content">
					<div class="container-fluid">
<!-----------------confirmation msg start--------------------------->
					<?php $this->load->view('student_section/submit_confirm'); ?>
<!-----------------confirmation msg End----------------------------->
                    <div class="row">
                      <div class="col-md-12">
					   <form class="form-horizontal" role="form" action="student_submit/application_catg_setting" method="post">
					  <table  class="table table-hover" align="center;">
						<tr>
							<td>
							<div class="form-group" id="itemRows">
							  <div class="col-sm-3">
								<center><label>Class Name</label></center>
								<input type="hidden" name="appctgid" value="<?php echo trim($id); ?>"/>
								<input type="text" value='<?php echo $select->class_name; ?>' name="class_name" readonly class="form-control" id="class_name" required />
								
							  </div>
							
							   <div class="col-sm-2">
								<center><label>Fee</label></center>
								<input type="text" name="fee" class="form-control" value="<?php echo $select->fee; ?>" id="fee" placeholder="Enter Fee" onkeypress="return checkaccnumber(event)" required/>
							    </div>
								
								<div class="col-sm-2">
								<center><label>Minimum GPA</label></center>
								<input type="text" name="gpa" class="form-control" value="<?php echo $select->min_gpa; ?>" id="fee" placeholder="Enter Fee" onkeypress="return isNumber(event)"/>
							    </div>
								
								<div class="col-sm-2">
								<center><label>Year</label></center>
								<input type="text" name="years" class="form-control" value="<?php echo $select->years; ?>" id="fee" placeholder="Enter Fee" onkeypress="return isNumber(event)" readonly required/>
							    </div>
								
							   <div class="col-sm-3">
								<center><label id="error_add" style="opacity:0;color:red;">ADD Data</label></center>
								<button type="submit"  name="submit_edit" value="ADD" class="btn btn-primary" ><span class="glyphicon glyphicon-send" data-toggle="tooltip" title="Update"></span> Update</button>
								<a href="student_section/level_1_setting">
								<button type="button"  name="" value="ADD" class="btn btn-success" data-toggle="tooltip" title="Go Back"><span class="glyphicon glyphicon-backward"></span> Back</button>
								</a>
							   </div>
							  
							</div>
							</td>
						 </tr>
						<tr>
						<td>
						
						</td>
					    </tr>
                       					  
					  </table>
					  </form>
					  </div>
					 
                    </div>

					</div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
		