<?php
	$id=$_GET['id'];
	
	$edit=$this->db->select("*")
					->from("library_gallery")
					->where("id",$id)
					->get()
					->row();
?>




            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Edit Libary Gallery
                         <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Book Category Form</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
			
				<div class="row">
				<div class="col-md-10">
				  
<table align="right" width="800px" cellpadding="0" cellspacing="0" style=" margin-top:20px;" >
						<tr>
							<td><input type="button" value="Edit Library Gallery" style="width:220px; height:30px; font-size:22px;  color:#357CA5; border-radius:5px; font-weight:bold; border:none; text-align:center; text-decoration:underline; "/></td>
							
						</tr>
					  </table>

		<form action="" method="post" enctype="multipart/form-data">
                      <table align="center" cellpadding="0" cellspacing="0" width="800px"  height="220px" border="0px" style="border-color:1px solid gray; margin-top:70px; margin-left:400px;" >
					  
					      <tr height="40px">
							   <td width="150px" style="font-size:25px; align:center;">Image Title</td>
							   <td><input type="text" name="title" style="width:500px; height:35px; font-size:25px;" value="<?php echo $edit->image_title; ?>" /></td>
						  </tr>
						 
						  
						  <input type="hidden" name="id" value="<?php echo $id; ?>" />
						  
						  <tr height="40px">
							   <td width="100px" style="font-size:25px; align:center; vertical-align:top;">Image</td>
							   <td>
							   <img src="libraryImage/<?php echo $edit->image;?>" style="height:100px; width:100px;" />
							   <input type="file" name="image" style="height:35px; font-size:25px; margin-top:5px;" /> </td>
						  </tr>

						  <tr height="20px"></tr>
						  
					      <tr height="20px">
						  
							   <td colspan="2" style="text-align:center;">
							     <input type="submit" value="Submit" name="submit_btn" style="width:120px; height:40px; font-size:22px; background-color:#357CA5; color:white; border-radius:5px; font-weight:bold; border:none;"/>
							   </td>
							   
						  </tr>
						  
						  
					  </table>  
</form>	
				</div>
				<div class="col-md-2">
				
				</div>
				
				</div>

				</section>
                                                            

                <!-- /.content -->
            </aside><!-- /.right-side -->
			
			

<?php 

if(isset($_POST['submit_btn'])){
$image_title= $_POST['title'];
echo $new_image=$_FILES['image']['name'];

if($new_image==""){
	$query=mysql_query("select * from library_gallery where id='$id'");
	$fetch=mysql_fetch_array($query);
	$new_image=$fetch['image'];
}
echo $tmp_name=$_FILES['image']['tmp_name'];
if($_FILES['image']['size']){
	copy($tmp_name,"libraryImage/$new_image");
	
}





//$insert=mysql_query("insert into  library_gallery values ('','$image_title','')");
 $insert=$this->db->query("UPDATE library_gallery set image_title='$image_title',image='$new_image' where id='$id'");
if($insert){
	
	redirect('welcome/library_gallery',location);
	//echo "<script>alert('data save successfully');</script>";
}
else{
	echo "<script>alert('data not save');</script>";
	
	
}

}
?>
 