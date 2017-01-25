<?php 
$this->load->view('header');
$this->load->view('leftbar');
?>
<aside class="right-side">      <!---rightbar start here --->
    <style>
		.error{
			border-color:red;
		}
	</style>            <!-- Content Header (Page header) -->
	<script type="text/javascript">
$(document).ready(function(){
 $('#schollpro').submit(function() {
  $.post(
            "index.php/userpanel/school_profile_update",
            $("#schollpro").serialize(),
            function(data){
              if(data==1)
			  {
				  $("#hidemessage").show(); 
					setTimeout(function(){					
					window.location="index.php/userpanel/school_profile";
					},3000)
			  }			  
			  else{
				  alert(data);
			  }
     });
 return false;
 });
});

function imge_upload(img_val,img_id){
	if(img_val==''){
		document.getElementById("img_div").style.display = "none";
		document.getElementById("pic_error").style.display = "none";
	}else{							
		document.getElementById("img_div").style.display = "block";
		$("#img_id").attr('src',URL.createObjectURL(event.target.files[0]));
		var image_size= parseInt((event.target.files[0].size));							
		else{								
			document.getElementById("dbimage").style.display = "none";
			document.getElementById("img_div").style.display = "block";
			$("#img_id").attr('src',URL.createObjectURL(event.target.files[0]));
		}
	}
}

</script>
	
                <section class="content-header">
                    <h1>
                        School Profile Create Form
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
				<div class="col-md-11" style="min-height:50px;">
					<div class="alert alert-success" id="hidemessage" style="margin-top:10px;margin-bottom:5px;">
					<strong> School Profile Edit Successfully!</strong>
				   </div>
				   </div>
                    <div class="row">
                      <div class="col-md-10">
					 

					 <form class="form-horizontal" role="form" action="index.php/userpanel/school_profile_update" method="post" id="schollpros" enctype="multipart/form-data">
					<div class="form-group" id="img_div" style="display:none;">
					  <label class="control-label col-sm-2" ></label>
					   <div class="col-sm-6"> 
							<img src="" class="img-responsive" style="height:160px;width:160px;" id="img_id"/>
						</div>
					</div>
					<div class="form-group" id="dbimage">
					  <label class="control-label col-sm-2" ></label>
					   
					   <!-- previous school logo -->
					   <div class="col-sm-6"> 
							<img src="img/document/school_logo/<?php echo $row->logo?>" class="img-responsive" style="height:160px;width:160px;" />
						</div>
					<!-- end previous school logo section -->
					
					</div>
					 <input type="hidden" name="idschol" value="<?php echo $row->id?>"/>					
						<div class="form-group">
						  <label class="control-label col-sm-2" >School Name:</label>
						  <div class="col-sm-6">          
							<input type="text" name="schName"  class="form-control" id="accnumber" required placeholder="Enter School Name " value="<?php echo $row->schoolN?>"/>
						  </div>						  
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-2" >Address:</label>
						  <div class="col-sm-6" >          
							<input type="text" name="schaddress"  class="form-control" id="accname" required placeholder="Enter Address Name" value="<?php echo $row->address?>"/>
						  </div>						  
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-2" >Phone Number:</label>
						  <div class="col-sm-6" >          
							<input type="text" name="phonenumber"  class="form-control" id="phonenumber" required placeholder="Enter Phone Nubmer " value="<?php echo $row->phone?>"/>
						  </div>						  
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-2" >Mobile Number:</label>
						  <div class="col-sm-6" >          
							<input type="text" name="mobilenumber"  class="form-control" id="mobilenumber" required placeholder="Enter MObile Numnber" value="<?php echo $row->mobile?>"/>
						  </div>						  
						</div>
						
						<div class="form-group">
						  <label class="control-label col-sm-2" >Email Address:</label>
						  <div class="col-sm-6" >          
							<input type="email" name="emailaddress"  class="form-control" id="emailaddress" required placeholder="Enter Email Address " value="<?php echo $row->email?>"/>
						  </div>						  
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-2" >Logo :</label>
						  <div class="col-sm-6" >          							
							<input type="file" name="userfile" id="userfile" class="form-control" accept="image/*"  onchange="imge_upload(this.value ,this.id);" style="display:"/>
						  </div>						  
						</div>
						<div class="form-group">        
						  <div class="col-sm-offset-2 col-sm-10">
							<button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Submit</button>
							&nbsp;&nbsp;
							<button type="reset" value="" class="btn btn-warning" id="reset"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
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
			<?php $this->load->view('footer');?>