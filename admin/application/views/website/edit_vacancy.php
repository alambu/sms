<?php
	$id=$_GET['id'];
	
	$edit=$this->db->select("*")
					->from("vacancy")
					->where("id",$id)
					->get()
					->row();
					//$catg=trim($edit->catagory);
?>
 	

 <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Book Category Form
                         <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Book Category Form</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
			
				<div class="row">
				<div class="col-md-10">
				    
		<form  class="form-horizontal" role="form" action="index.php/admin/edit_vacancy" method="post" enctype="multipart/form-data">

						
						  <div class="form-group">
							<label class="control-label col-sm-2" for="email">Designation Name</label>
							<div class="col-sm-4">
							  <input type="name" class="form-control" id="name" value="<?php echo $edit->designation_name; ?>" >
							</div>
							<label class="control-label col-sm-2" for="pwd">Total Teacher</label>
								<div class="col-sm-4"> 
								  <input type="text" value="<?php echo $edit->total_teacher; ?>" class="form-control" name="appctgid" id="appctgid"/>
									
								</div>
						  </div>
						  
							<div class="form-group">
								<label class="control-label col-sm-2" for="pwd">vacancy</label>
								<div class="col-sm-4"> 
								  <input type="text" value="<?php echo $edit->vacancy; ?>" class="form-control" name="appctgid" id="appctgid"/>
								</div>
								
								
								<label class="control-label col-sm-2" for="pwd">Present teacher</label>
								<div class="col-sm-4"> 
								  <input type="text" name="mName" value="<?php echo  $edit->present_teacher; ?>" class="form-control" id="mName">
								</div>
								
							</div>
							
							
							
							
							
						  <div class="form-group"> 
							<div class="col-sm-offset-2 col-sm-10">
							  <button type="submit" class="btn btn-primary" name="submit" id="submit"><span class="glyphicon glyphicon-send"></span> Update</button> &nbsp;&nbsp;&nbsp;
							  <button type="reset" class="btn btn-warning"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
							</div>
						  </div>
						</form>
				</div>
				<div class="col-md-2">
				
				</div>
				
				</div>

				</section>
                                                            

                <!-- /.content -->
            </aside>

<?php 

if(isset($_POST['submit_btn'])){
	$id=$_POST['id'];
	$designation= $_POST['designation'];
	$total_teacher= $_POST['total_teacher'];
	$vacancy_teacher= $_POST['vacancy_teacher'];
	$present_teacher= $_POST['present_teacher'];



//$insert=mysql_query("insert into  library_gallery values ('','$image_title','')");
 $insert=$this->db->query("UPDATE vacancy set designation_name='$designation',total_teacher='$total_teacher',vacancy='$vacancy_teacher', present_teacher='$present_teacher' where id='$id'");
 

 
if($insert){
	
	redirect('welcome/vacancy',location);
	//echo "<script>alert('data save successfully');</script>";
}
else{
	echo "<script>alert('data not save');</script>";
	
	
}

}
?>
 