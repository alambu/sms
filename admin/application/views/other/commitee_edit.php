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
			$info=$this->db->query("select * from manageing_commitee where memberid='$id' ")->row();
		}
	?>
	
                <section class="content-header">
                    <h1>
                        Commitee Edit
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					 <!-- Content Header (Page header) -->
<script>
function imge_upload(img_val,img_id) {
	if(img_val==''){
		document.getElementById("img_div").style.display = "none";
		document.getElementById("pic_error").style.display = "none";
	}
	else{
		var image_size= parseInt((event.target.files[0].size)/1000);
		if(image_size>150) {
					document.getElementById(img_id).value = "";
					alert("imge size large maximum size 150 kb");
					 

		}
		else{
			document.getElementById("img_div").style.display = "block";
			$("#img_id").attr('src',URL.createObjectURL(event.target.files[0]));
	}
	}
}
					
$("document").ready(function(){
$("#dob").datepicker({format: 'yyyy-mm-dd'});
	
	$("#application_form").submit(function(e) {
	e.preventDefault();
	var formData = new FormData(this);

	$.ajax({  
		 type: "POST",  
		 url: "index.php/userpanel/school_commitee_edit",  
		 data: formData,
		 async: false,
		 cache: false,
		 contentType: false,
		 processData: false,
		 beforeSend:function(){
			 document.getElementById('submit').disabled = "disabled";	
			 document.getElementById('submit').innerHTML = 'Processing---';
		 },
		 success: function(data) {
			 if(data==1)
			 {	
				alert('Update Successfully');
				window.location="userpanel/school_commitee";
			 }
			 else { 
			 alert(data);
			 document.getElementById('submit').innerHTML = 'Send';
             document.getElementById('submit').disabled = false;
			 }
		 }
	}); 
	//return false;
	});
		
		
});
</script>
<!--Content Start-->

					
							
			<div class="row">
			  <div class="col-md-12">
							
				<form  class="form-horizontal" role="form" action="index.php/userpanel/school_commitee_edit" method="post" enctype="multipart/form-data" id="application_form">
                         
							
						  <div class="form-group">
							<label class="control-label col-sm-2" for="email">Name <span style="color:red;">*</span></label>
							<div class="col-sm-4">
							  <input type="text" class="form-control" required name="sname" id="sname" placeholder="" value="<?php echo $info->name; ?>" >
							</div>
							<label class="control-label col-sm-2" for="email">Father's Name <span style="color:red;">*</span></label>
							<div class="col-sm-4">
							  <input type="text" name="fname" class="form-control" id="fname" placeholder="" value="<?php echo $info->fname; ?>" required>
							</div>
						  </div>
						  
							<div class="form-group">
								<label class="control-label col-sm-2" for="email">Mother 's Name <span style="color:red;">*</span></label>
								<div class="col-sm-4">
								  <input type="text" name="mname" class="form-control" id="mname" placeholder="Enter Mother's Name" value="<?php echo $info->mname; ?>" required>
								</div>
								
								
								<label class="control-label col-sm-2" for="phone">Mobile</label>
								<div class="col-sm-4">
								  <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Phone Number" onkeypress="return checkaccnumber(event);" value="<?php echo $info->mobile; ?>" maxlength="11" required>
								</div>
								
							</div>
							
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="email">Email</label>
								<div class="col-sm-4">
								 <input type="hidden" name="hid_id" value="<?php echo $info->memberid; ?>"/>	
								  <input type="text" name="email" class="form-control" id="email" placeholder="Enter email" value="<?php echo $info->email; ?>">
								</div>
								<label class="control-label col-sm-2" for="email">Gender <span style="color:red;">*</span></label>
								<div class="col-sm-4">
								  <select class="form-control" name="gender" id="gender" required>
									<option value="">--Select Gender--</option>
									<option <?php if($info->gender=='Male') { echo "selected"; } ?> value="Male">Male</option>
									<option <?php if($info->gender=='Female') { echo "selected"; } ?> value="Female">Female</option>
									<option <?php if($info->gender=='Comon') { echo "selected"; } ?> value="Comon">Common</option>
								  </select>
								</div>
							</div>
							
							
							
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="email">Present address <span style="color:red;">*</span></label>
								<div class="col-sm-4">
								 <textarea class="form-control" name="pre_address" id="pre_address" rows="5" style="resize:none;" required><?php echo $info->pre_address; ?></textarea>
								</div>
								<label class="control-label col-sm-2" for="email">Permanent address <span style="color:red;">*</span></label>
								<div class="col-sm-4">
								   <textarea class="form-control" name="par_address" id="par_address" rows="5" style="resize:none;" required><?php echo $info->per_address; ?></textarea>
								</div>
							</div>
							
							<div class="form-group">
								<label class="control-label col-sm-2" for="pob">Designation <span style="color:red;">*</span></label>
								<div class="col-sm-4">
								  <input type="text" name="desig" class="form-control" value="<?php echo $info->designation; ?>" required/>
								</div>
								
								
							</div>
							 <div class="form-group" id="img_div">
								<div class="col-sm-2">
								 
									
								</div>
								<div class="col-sm-4">
								 <img src="img/school_commitee/<?php echo $info->picture; ?>" class="img-thumbnil" class="img-responsive" style="height:160px;width:160px;"   id="img_id"/>
								</div>
								<div class="col-sm-2">
								
								</div>
								<div class="col-sm-2">
								 
								</div>
								<div class="col-sm-2">
								 
								</div>
							
							</div>
							
							<div class="form-group">
							
								<label class="control-label col-sm-2" for="email" >Picture</label>
								<div class="col-sm-4">
								  <input type="file" name="picture" id="picture" class="form-control" accept="image/jpeg, image/jpg, image/png"  onchange="imge_upload(this.value , this.id);" />
								</div>
								
							</div>
							

						  <div class="form-group"> 
							<div class="col-sm-offset-2 col-sm-10">
							  <button type="submit" class="btn btn-primary" name="submit" id="submit">Send</button> &nbsp;&nbsp;&nbsp;
							 <a href="userpanel/school_commitee"> <button type="button" class="btn btn-warning">Back</button></a>
							</div>
						  </div>
						</form>

							
						
					  </div>
					  
                    </div>
		

                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->