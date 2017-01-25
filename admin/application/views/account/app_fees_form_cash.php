<?php 
$this->load->view('header');
$this->load->view('leftbar');
?>
<script type="text/javascript">
$(document).ready(function(){
 $('#formid').submit(function() {
  $.post(
            "index.php/account/cash_application_insert",
            $("#formid").serialize(),
            function(data){
              if(data==1)
			  {
				  $("#hidemessage").show(); 
					setTimeout(function(){					
					//window.location="index.php/account/cash_application_fee";
					window.location="index.php/account/moneyreceit";
					},2000)
			  }			  
			  else{
				  alert(data);
			  }
     });
 return false;
 });
});
function appicationfeecheck(appid){
	$.ajax({
		url: "index.php/account_edit/appidamount",
		type: 'POST',	
		data:{appids:appid},	
		success: function(data)
		{				
			var d=data.split(",");
			if(d.length>1){
				document.getElementById("cname").value=d[0];	
				document.getElementById("totalfee").value=d[1];	
			}
			else{
				document.getElementById("cname").value='';	
				document.getElementById("totalfee").value='';
				alert(data);
			}
		}          
		});
	}
</script>
<aside class="right-side">      <!---rightbar start here --->
           <!-- Content Header (Page header) -->
	
                <section class="content-header">
                    <h1>
                      Cash  Application Fee Payment
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<div class="col-md-11" style="min-height:60px;">
					<div class="alert alert-success" id="hidemessage" style="margin-top:10px;margin-bottom:5px;">
					<strong> Successfully ! </strong> Your Data insert complete.
				   </div>
				   </div>
                    <div class="row">
                      <div class="col-md-10">
					 <form class="form-horizontal" role="form" action="index.php/account/cash_application_insert" method="post" id="formid">
						<div class="form-group">
						  <label class="control-label col-sm-2" >Application ID:</label>
						  <div class="col-sm-3">          
							<input type="text" class="form-control" name="appcid" id="appcid" required placeholder="Enter Application ID" onblur="appicationfeecheck(this.value)"/>
						  </div>
						  <label class="control-label col-sm-2">Account Name:</label>
						  <div class="col-sm-3">          
							<select class="form-control" name="accnumber" required>
									<option value="">--Select Account Name--</option>
									<?php 
										$sqlacc=$this->db->select('*')->from('account_cre')->Where('bank_name','Cash')->get()->result();										
										foreach($sqlacc as $accidshow){
									?>
										<option value="<?php echo $accidshow->accountid?>"><?php echo $accidshow->acc_name.'('. $accidshow->accountid.')'?></option>
										<?php }?>
							</select>
						  </div>						  
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-2" >Class Name:</label>
						  <div class="col-sm-3">          
							<input type="text" name="cname"  class="form-control" id="cname" value="" required readonly/>
						  </div>
						<label class="control-label col-sm-2">Total Fee:</label>
						   <div class="col-sm-3">          
							<input type="text" name="totalfee"  class="form-control" id="totalfee" value="" required readonly/>
						  </div>						  
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-2" >Payment Amount:</label>
						  <div class="col-sm-3">          
							<input type="text" name="payamount"  class="form-control" id="payamount" onkeypress="return isamountonly(event)" required />
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