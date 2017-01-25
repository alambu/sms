<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
	<style type="text/css">
		input{
			text-transform:uppercase;
		}
		.error{
			border-color:red;
		}
		
	</style>            <!-- Content Header (Page header) -->
<script type="text/javascript">
		
<?php 
if(isset($_GET['id'])){
	$verid=$_GET['id'];
	$version=$this->db->query("select * from version_catg where  verid='$verid' ")->row();
	
}
?>	
</script>			
                <section class="content-header">
                    <h1>
                        Version Edit
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> Home</a></li>
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
					 <form class="form-horizontal" role="form" action="student_submit/version_setting" method="post">
						<div class="form-group" id="itemRows">
						  <label class="control-label col-sm-2" for="pwd">Version Name:</label>
						  <div class="col-md-5" id="shak_id">          
							<input type="text" name="version" class="form-control" value="<?php echo $version->version_N; ?>" onkeypress="return only_chareter(this.value)" id="version" placeholder="Enter Version Name" required/>
							<input type="hidden" name="verid" value="<?php echo $verid; ?>"/>
							<input type="hidden" name="old_version" value="<?php echo $version->version_N;; ?>"/>
						  </div>
						  <div class="col-md-3">          
							<button type="submit" name="submit_edit" class="btn btn-primary" data-toggle="tooltip"title="Update"><span class="glyphicon glyphicon-send"></span> Update</button>
							&nbsp;&nbsp;
							<a href="student_section/level_1_setting">
							<button type="button" name="button" class="btn btn-success" data-toggle="tooltip"title="Go Back"><span class="glyphicon glyphicon-backward"></span> Back</button></a>
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