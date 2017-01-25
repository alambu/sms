<?php
	$id=$_GET['id'];
	
	$edit=$this->db->select("*")
					->from("gallery")
					->where("id",$id)
					->get()
					->row();
					$catg=trim($edit->catagory);
// get category of image
$catimg=$this->db->select("*")->from("image_catagory")->get()->result();
?>

<script>
	function imge_upload(img_val){
	if(img_val==''){
	document.getElementById("img_div").style.display = "block";
	}
	else{
	document.getElementById("img_div").style.display = "none";
	$("#img_id").attr('src',URL.createObjectURL(event.target.files[0]));
	}
	}

</script>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Edit Gallery
                         <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Edit Gallery</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					 <div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-2"></div>

						<div class="col-md-2">
							<img src="" class="img-responsive" height="150" width="150" id="img_id" />
						</div>

						<div class="col-md-2" id="img_div">
							<img src="galleryImage/img/<?php echo $edit->image;?>"  class="img-responsive" height="150" width="150" >
						</div>

						<div class="col-md-2"></div>
						
					 </div>
					 
					 <div class="row">
                      <div class="col-md-10">
					   <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
					  <table  class="table" align="center;">
						<tr>
							<td>
								<input type="hidden" name="id" value="<?php echo $id ?>" />
							<div class="form-group" id="itemRows">

							  <div class="col-sm-4" id="shak_id_1">
								<center><label>Catagory</label></center>
								<select  name="cat" class="form-control" id="class_name">
									<option value="">Select</option>
								<?php foreach($catimg as $ct): ?>
									<option value="<?php echo $ct->id ?>" <?php if(isset($_GET['id'])):if($edit->catagory==$ct->id):echo "selected";endif;endif; ?> ><?php echo $ct->image_catagory ?></option>
								<?php endforeach; ?>
								</select>
							  </div>
							
							   <div class="col-sm-4" id="shak_id_2">
								<label>Title</label>
								<input type="text" name="title" class="form-control" id="section" placeholder="Enter Section" value="<?php echo $edit->title ?>" />
							    </div>
							   <div class="col-sm-2">
								<label style="opacity:0;"></label>
								<input type="file"  class="form-control" onchange="imge_upload(this.value);" name="image" />
							   </div>
							  
							</div>
							</td>
						 </tr>
						<tr>
							<td>
								<div class="form-group">        
								   <div class="col-sm-4"></div>
								   <div class="col-sm-4">
										<button name="update" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Update</button>&nbsp;&nbsp;
										<button type="button" value="" class="btn btn-warning" id="reset" onclick=" reset_content(this.value);"><span class="glyphicon glyphicon-refresh"> Reset</button>
									</div>
								  
								  	<div class="col-sm-2"></div>
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

if(isset($_POST['update'])){
	$path="galleryImage/img/";
	$path2="../school_website/all/image_gallery/img/";
	extract($_POST);
		$img=$_FILES['image']['name'];
		$dest=$path.$img;
		$dest2=$path2.$img;
	if($img):
		// copy image
		$c1=move_uploaded_file($_FILES['image']['tmp_name'],$dest);
		$c2=move_uploaded_file($_FILES['image']['tmp_name'],$dest2);
		
		// data array
		$d=array(
			"title"=>$title,
			"catagory"=>$cat,
			"image"=>$img
			);
		// update database
		$up=$this->db->where("id",$id)->update("gallery",$d);
	else:
		// data array
		$d=array(
			"title"=>$title,
			"catagory"=>$cat
			);
		// update database
		$up=$this->db->where("id",$id)->update("gallery",$d);
	endif;	

	// check update
	if($up):
		redirect("website/gallery","location");
	else:
		echo "<script>alert('Data not save.pls check it.');</script>";
	endif;
}
?>
 