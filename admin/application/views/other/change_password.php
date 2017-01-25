<?php 
$this->load->view('header');
$this->load->view('leftbar');

?>
<aside class="right-side">      <!---rightbar start here --->
              <!-- Content Header (Page header) -->
		<script type="text/javascript">
$(document).ready(function(){
 $('#userReg').submit(function() {
  $.post(
            "index.php/userpanel/change_password_submit",
            $("#userReg").serialize(),
            function(data){
              if(data==1)
			  {
				alert('Password Update Successfully');
				location.reload();
			  }			  
			  else{
				  alert(data);
			  }
     });
 return false;
 });
});
function AllowAlphabet(){
if (!userReg.username.value.match(/^[a-zA-Z]{1,20}[0-9]{0,20}$/) && userReg.username.value !="")
{
userReg.username.value="";
userReg.username.focus();
alert("Please Enter First Leter Character");
}
}
function passwords() {
    var x = document.getElementById("password").value;
    var y = document.getElementById("confirmpass").value;
	if(x!=y){		
			$('#password').addClass('error');
			$('#confirmpass').addClass('error');
			userReg.password.value="";
			userReg.confirmpass.value="";
			$('#errorid').effect( "shake",{times:1},100 );
			alert('Password Not Match.');
		}
		
	} 
</script>
	
	
                <section class="content-header">
                    <h1>
                        User Registration Create Form
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="row">
                      <div class="col-md-10">
					 <form class="form-horizontal" role="form" action="index.php/userpanel/change_password_submit" method="post" name="userReg" id="userReg">
					
						<div class="form-group">
						  <label class="control-label col-sm-2" >Old Password:</label>
						  <div class="col-sm-6">          
							<input type="password" name="old_password"  class="form-control" value="" id="old_password" required placeholder="Enter Password"/>
						  </div>						  
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-2" >New Password:</label>
						  <div class="col-sm-6" id="errorid">          
							<input type="password" name="password"  class="form-control" value="" id="password" required placeholder="Enter Password"/>
						  </div>						  
						</div>
						<div class="form-group" >
						  <label class="control-label col-sm-2" >Confirm Password:</label>
						  <div class="col-sm-6" id="errorid">          
							<input type="password" name="confirmpass"  class="form-control" value="" id="confirmpass" required placeholder="Enter Retype Password" onblur="passwords()"/>
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
					<div id='msg'><p>Upate Record Successfully.</p></div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
		<?php $this->load->view('footer');?>