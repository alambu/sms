			<script>
					function imge_upload(img_val){
						if(img_val==''){
							document.getElementById("img_div").style.display = "none";
						}
						else{
							document.getElementById("img_div").style.display = "block";
						$("#img_id").attr('src',URL.createObjectURL(event.target.files[0]));
						}
					}

			</script>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       ADD Welcome Message
                         <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Welcome Message</li>
                    </ol>
                </section>
			
                <!-- Main content -->
                <section class="content">
				<form role="form" action="index.php/admin/add_welcome_msg" method="post">
				<div class="row">
				<div class="col-md-10">
				 
					<div class="form-group" id="img_div" style="display:none;">
							<label style="opacity:0;">nothing</label>
							
							 
								<img src="" class="img-thumbnail" height="150" width="150"   id="img_id"/>
							
					</div>

					  <div class="form-group">
						<label for="email">Title</label>
						<input type="text" class="form-control" value="" id="email">
					  </div>
					  
					  <div class="form-group">
						<label for="pwd">Details</label>
						<textarea class="form-control" rows="8">
						
						</textarea>
					  </div>
					  <div class="form-group">
						<label for="pwd">Image</label>
						<input type="file" name="" class="form-control" id="img" onchange="imge_upload(this.value);"/>
					  </div>
					  
					  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> Send</button>
					  &nbsp;&nbsp;
					  <button type="reset" class="btn btn-warning"><span class="glyphicon glyphicon-refresh"></span> Send</button>
				
				</div>
				<div class="col-md-2">
				
				</div>
				
				</div>
				</form>
				</section>
                                                            

                <!-- /.content -->
            </aside><!-- /.right-side -->
			
			

<?php 
if(isset($_POST['data_send'])){
	
$title=$_POST['principle_title'];
$details=$_POST['principal_details'];
$id=$_POST['id'];
$new_image=$_FILES['image']['name'];

if($new_image==""){
	$query=mysql_query("select * from principal_message where id='$id'");
	$fetch=mysql_fetch_array($query);
	$new_image=$fetch['image'];
}
$tmp_name=$_FILES['image']['tmp_name'];

if($_FILES['image']['size']){
	copy($tmp_name,"../school_admin/principalImage/$new_image");
	
}
$update=mysql_query("update principal_message set title='$title',image='$new_image', details='$details' where id='$id'");
if($update){
	redirect('welcome/principal_message','location');
	
}
else{
	
	redirect('welcome/edit_principal_msg','location');
}

}
 ?>
 