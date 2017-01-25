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
	
		function messagetext(textv){
			var tlen=textv.length;
			var tlensms=parseInt(tlen)/160;
			var finalsms=Math.ceil(tlensms);
			document.getElementById("toword").innerHTML=tlen;
			document.getElementById("tosms").innerHTML=finalsms;
		}
		function messagetexttec(textv){
			var tlen=textv.length;
			var tlensms=parseInt(tlen)/160;
			var finalsms=Math.ceil(tlensms);
			document.getElementById("towordtec").innerHTML=tlen;
			document.getElementById("tosmstec").innerHTML=finalsms;
		}
		function messagetexttwo(textv){
			var tlen=textv.length;
			var tlensms=parseInt(tlen)/160;
			var finalsms=Math.ceil(tlensms);
			document.getElementById("stoword").innerHTML=tlen;
			document.getElementById("stosms").innerHTML=finalsms;
		}
	</script>
	<script type="text/javascript">
$(document).ready(function(){
 $('#formid').submit(function() {
	 document.getElementById("submitb").disabled = true;
  $.post(
            "index.php/account/sendsms",
            $("#formid").serialize(),
            function(data){
              if(data==1)
			  {
				  $('#hidemessage').fadeIn('slow').delay(2000).fadeOut('slow');
					setTimeout(function(){					
					window.location="index.php/account/smsportal";
					},2000)
			  }			  
			  else{
				  document.getElementById("submitb").disabled = false;
				  alert(data);
			  }
     });
 return false;
 });
 $('#formid1').submit(function() {
	 document.getElementById("submitbtwo").disabled = true;
  $.post(
            "index.php/account/sendsmstwo",
            $("#formid1").serialize(),
            function(data){
              if(data==1)
			  {
				  $('#hidemessage').fadeIn('slow').delay(2000).fadeOut('slow');
					setTimeout(function(){					
					window.location="index.php/account/smsportal";
					},2000)
			  }			  
			  else{
				  document.getElementById("submitbtwo").disabled = false;
				  alert(data);
			  }
     });
 return false;
 });
 $('#formid2').submit(function() {
	 document.getElementById("techteacher").disabled = true;
  $.post(
            "index.php/account/teacherSMS",
            $("#formid2").serialize(),
            function(data){
              if(data==1)
			  {
				  $('#hidemessage').fadeIn('slow').delay(2000).fadeOut('slow');
					setTimeout(function(){					
					window.location="index.php/account/smsportal";
					},2000)
			  }			  
			  else{
				  document.getElementById("techteacher").disabled = false;
				  alert(data);
			  }
     });
 return false;
 });
});
</script>
	
                <section class="content-header">
                    <h1>
                        SMS Portal
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
		
				   <div class="box">
				 <div class="box-body">
				  <div class="col-md-11" style="min-height:50px;" id="hidemessage">
					<div class="alert alert-success" style="margin-top:5px;margin-bottom:5px;">
						<strong> Successfully!</strong>Your SMS Successfully Sent Complete.
					</div>
				   </div>
				
					<div class="table-responsive">
					<div class="row">					
                      <div class="col-md-12">
					  <ul class="nav nav-tabs" id="myTab">
						<li class="active"><a data-toggle="tab" href="#home">Class SMS</a></li>
						<li><a data-toggle="tab" href="#menu2">Teacher SMS</a></li>
						<li><a data-toggle="tab" href="#commitee_sms">Comitee SMS</a></li>
						<li><a data-toggle="tab" href="#menu1">Single SMS</a></li>
					  </ul>
					  
					  <div class="tab-content">
		
<!---------------------------------------------- Start Student SMS  form ------------------>
					<div id="home" class="tab-pane fade in active">
			
						<br/>
						
						 <form class="form-horizontal" role="form" action="" method="post" id="formid">
							<div class="form-group">
							  <label class="control-label col-sm-2">Class Name:</label>
							  <div class="col-sm-6">          
								<select class="form-control" name="classid" id="classid" required>
											<option value="">--Select--</option>
											<option value="all">ALL</option>
											<?php 
												$sqlacc=$this->db->select('*')->from('class_catg')->get()->result();										
												foreach($sqlacc as $accidshow){
											?>
												<option value="<?php echo $accidshow->classid?>"><?php echo $accidshow->class_name?></option>
												<?php }?>
								</select>
							  </div>						  
							</div>
							<div class="form-group">
							  <label class="control-label col-sm-2">Message:</label>
							  <div class="col-sm-6" >  								
								<textarea class="form-control custom-control" rows="3" name="messages" style="resize:none;height:150px;" onkeyup="messagetext(this.value)" required></textarea>
							  </div>						  
							</div>
							<div class="form-group">
							  <label class="control-label col-sm-2">&nbsp;</label>
							  <label class="control-label col-sm-2" style="text-align:left;">Word : <span id="toword"></span></label>
							  <label class="control-label col-sm-2" style="text-align:left;">SMS : <span id="tosms"></span></label>
							</div>
							<div class="form-group">        
							  <div class="col-sm-offset-2 col-sm-10">
								<button type="submit" name="submit" id="submitb" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Submit</button>
							  </div>
							</div>
							
							<div class="form-group">        
							  <div class="col-sm-offset-2 col-sm-10">
								
							  </div>
							</div>
						  </form>										
						</div>	

						
<!---------------------------------------------- Start single SMS    form ------------------>
								<div id="menu1" class="tab-pane">
			
								<br/>
										<form class="form-horizontal" role="form" action="" method="post" id="formid1">
									<div class="form-group">
									  <label class="control-label col-sm-2">Mobile Number:</label>
									  <div class="col-sm-6">          
										<input type="text" name="phoneN" maxlength="11" pattern=".{11,11}"  class="form-control" id="phoneN"  placeholder="Enter Phone Number." onkeypress="return isNumber(event)" required title="Mobile Number 11 digit."/>
									  </div>						  
									</div>
									<div class="form-group">
									  <label class="control-label col-sm-2">Message:</label>
									  <div class="col-sm-6" >  								
										<textarea class="form-control custom-control" rows="3" name="messages" style="resize:none;height:150px;" onkeyup="messagetexttwo(this.value)" required></textarea>
									  </div>						  
									</div>
									<div class="form-group">
									  <label class="control-label col-sm-2">&nbsp;</label>
									  <label class="control-label col-sm-2" style="text-align:left;">Word : <span id="stoword"></span></label>
									  <label class="control-label col-sm-2" style="text-align:left;">SMS : <span id="stosms"></span></label>
									</div>
									<div class="form-group">        
									  <div class="col-sm-offset-2 col-sm-10">
										<button type="submit" name="submit" id="submitbtwo" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Submit</button>
									  </div>
									</div>
									
									<div class="form-group">        
									  <div class="col-sm-offset-2 col-sm-10">
										
									  </div>
									</div>
								  </form>
								</div>
		<!---------------- Teacher SMS ===================  -->
					<div id="menu2" class="tab-pane">
			
						<br/>
						
						 <form class="form-horizontal" role="form" action="" method="post" id="formid2">
							
							<div class="form-group">
							  <label class="control-label col-sm-2">Type:</label>
							   <div class="col-sm-6" > 
							  <select class="form-control" name="tectype" style="width:100%;" required>
								<option value="">--Select--</option>
								<option value="all">All</option>
								<option value="1">Teacher</option>
								<option value="2">Staff</option>
							  </select>
							  </div>
							</div>
							<div class="form-group">
							  <label class="control-label col-sm-2">Message:</label>
							  <div class="col-sm-6" >  								
								<textarea class="form-control custom-control" rows="3" name="messages" style="resize:none;height:150px;" onkeyup="messagetexttec(this.value)" required></textarea>
							  </div>						  
							</div>
							<div class="form-group">
							  <label class="control-label col-sm-2">&nbsp;</label>
							  <label class="control-label col-sm-2" style="text-align:left;">Word : <span id="towordtec"></span></label>
							  <label class="control-label col-sm-2" style="text-align:left;">SMS : <span id="tosmstec"></span></label>
							</div>
							<div class="form-group">        
							  <div class="col-sm-offset-2 col-sm-10">
								<button type="submit" name="submit" id="techteacher" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Submit</button>
							  </div>
							</div>
							
							<div class="form-group">        
							  <div class="col-sm-offset-2 col-sm-10">
								
							  </div>
							</div>
						  </form>										
						</div>
<!---------------------------------------------- Start account list view form ------------------>

<!--- comitee sms start ---->
	<div id="commitee_sms" class="tab-pane"><br/>
		<?php $this->load->view("other/commitee_sms"); ?>
	</div>
<!--- comitee sms end ---->

						</div>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>

    </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->

<?php $this->load->view('footer');?>