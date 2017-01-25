<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
		 <style>
		.error{
			border-color:red;
		}
	</style>            <!-- Content Header (Page header) -->
<?php 
if(isset($_GET['id'])){
	$classid=$_GET['id'];
	$select=$this->db->query("select * from class_catg where classid='$classid'")->row();
}
?>			
                <section class="content-header">
                    <h1>
                        Class Catg Edit
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<div class="container">
					
                    <div class="row">
                      <div class="col-md-10">
					   <form class="form-horizontal" role="form" action="index.php/student_submit/class_catg_setting" method="post">
					  <table  class="table table-striped" align="">
					    <tr>
							<td>
							<div class="form-group">

							  <div class="col-sm-10" id="shak_id_1">
								<label>Class Name</label>
								<input type="text"  name="class_name" value="<?php echo $select->class_name; ?>" class="form-control" readonly id="class_name" placeholder="Select Class name" required/>
									
							  </div>
							  <input type="hidden" name="classid" value="<?php echo $select->classid;?>"/>
							
							</div>
							</td>
						 </tr>
						<tr>
							<td>
							<div class="form-group" id="itemRows">

								<?php 
									$s=explode(",",$select->section);
									foreach ($s as $s_v){
								?>
							   <div class="col-sm-10" id="shak_id_2">
								<label style="opacity:0;">Section</label>
								<input type="text" name="section[]" value="<?php echo $s_v; ?>" class="form-control" id="section" placeholder=""/>
							    </div>
							   <div class="col-sm-2">
								
							   </div>
									<?php  }?>
							</div>
							</td>
						 </tr>
						<tr>
						<td>
						<div class="form-group">        
						   
						  
						   <div class="col-sm-4">          
								<button type="submit" name="submit_edit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Update</button>&nbsp;&nbsp;
						   </div>
						   <div class="col-sm-4">
							
							
						  </div>
						  
						  <div class="col-sm-2">          
								
						   </div>
						  
						</div>
						</td>
					    </tr>
                       					  
					  </table>
					  </form>
					  </div>
					 <div class="col-md-2">
					 
					 </div>
                    </div>

					</div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->