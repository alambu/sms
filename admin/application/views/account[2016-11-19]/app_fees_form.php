<?php 
$this->load->view('header');
$this->load->view('leftbar');
?>
<script type="text/javascript">
$(document).ready(function(){
 $('#formid').submit(function() {
	  document.getElementById('onlinepayment').disabled = 'disabled';
  $.post(
            "index.php/account/applicationfee",
            $("#formid").serialize(),
            function(data){
              if(data==1)
			  {
				  $('#hidemessage').fadeIn('slow').delay(2000).fadeOut('slow');
					setTimeout(function(){					
					window.location="index.php/account/application_fee_form";
					},2000)
			  }			  
			  else{
				  document.getElementById('onlinepayment').disabled = false;
				  alert(data);
			  }
     });
 return false;
 });
 
  $('#formid2').submit(function() {
	   document.getElementById('cashpayment').disabled = 'disabled';
  $.post(
            "index.php/account/cash_application_insert",
            $("#formid2").serialize(),
            function(data){
              if(data==1)
			  {
				  $('#hidemessage').fadeIn('slow').delay(2000).fadeOut('slow');
					setTimeout(function(){					
					//window.location="index.php/account/cash_application_fee";
					window.location="index.php/account/moneyreceit";
					},2000)
			  }			  
			  else{
				   document.getElementById('cashpayment').disabled = false;
				  alert(data);
			  }
     });
 return false;
 });
 
$('#sdate').datepicker({format: "dd-mm-yyyy"});
$('#edate').datepicker({format: "dd-mm-yyyy"}); 
$('#rsdate').datepicker({format: "dd-mm-yyyy"});
$('#redate').datepicker({format: "dd-mm-yyyy"});
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
                        Application Fee Form
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
						<strong> Successfully!</strong>Your Data insert complete.
					</div>
				   </div>
				
					<div class="table-responsive">
						<div class="row">					
                      <div class="col-md-12">
					  <ul class="nav nav-tabs" id="myTab">
						<li class="active"><a data-toggle="tab" href="#home">Online App Fee</a></li>
						<li><a href="#menu1" data-toggle="tab">Cash App Fee</a></li>
						<li><a href="#menu2" data-toggle="tab">Cash Payment List </a></li>
						<li><a href="#menu3" data-toggle="tab">Bikash or DBBL</a></li>
						
					  </ul>
					  
					  <div class="tab-content">
		
<!---------------------------------------------- Start application fee form ------------------>
			<div id="home" class="tab-pane fade in active">
			
			<br/>
                     
					 <form class="form-horizontal" role="form" action="index.php/account/applicationfee" method="post" id="formid">
						<div class="form-group">
						  <label class="control-label col-sm-2" >Application ID:</label>
						  <div class="col-sm-3">          
							<input type="text" class="form-control" name="appid" id="appid" required placeholder="Enter Application ID"/>
						  </div>
						  <label class="control-label col-sm-2">Method:</label>
						  <div class="col-sm-3">          
							<select class="form-control" name="method" required> 
								<option value="">--Select--</option>
								<option value="DBBL">DBBL</option>
								<option value="Bkash">Bkash</option>
							</select>
						  </div>						  
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-2" >Transaction ID:</label>
						  <div class="col-sm-3">          
							<input type="text" name="tansid"  class="form-control" id="tansid" required placeholder="Enter Your Transaction ID" onkeypress="return checkaccnumber(event)"/>
						  </div>
						<label class="control-label col-sm-2">Send Account:</label>
						  <div class="col-sm-3" >          
							<input type="text" name="sendacc" maxlength="12" minlength="11" class="form-control" id="sendacc" required placeholder="Enter Account Number" onkeypress="return checkaccnumber(event)"/>
						  </div>						  
						</div>
						
						<div class="form-group">
						  <label class="control-label col-sm-2" >Received Account:</label>
						  <div class="col-sm-3" >          
							<input type="text" name="recacc" maxlength="12" minlength="11" class="form-control" id="recacc" required placeholder="Enter Account Number" onkeypress="return checkaccnumber(event)"/>
						  </div>
						  <!--<label class="control-label col-sm-2" >Amount:</label>
						  <div class="col-sm-3" >          
							<input type="text" name="tamount"  class="form-control" id="tamount" required placeholder="Enter Amount Name" onkeypress="return isamountonly(event)"/>
						  </div>-->						  
						</div>
						<div class="form-group">        
						  <div class="col-sm-offset-2 col-sm-10">
							<button type="submit" name="submit" id="onlinepayment" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Submit</button>
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
 <!----------------------------------- end online fee form------------------------------------------>
 <!----------------------------------- start cash online fee form------------------------------------------>
					  		<div id="menu1" class="tab-pane fade">
			
								<br/>
								<form class="form-horizontal" role="form" action="index.php/account/cash_application_insert" method="post" id="formid2">
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
							<button type="submit" name="submit" id="cashpayment" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Submit</button>
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
 <!----------------------------------- end online cash fee form------------------------------------------>
 <!----------------------------------- start cash online fee form------------------------------------------>							
							<div id="menu2" class="tab-pane fade">
				
								<br/>
								<form class="form-horizontal" role="form" action="index.php/account_edit/search_appfee" method="post">
						<div class="form-group">
							<div class="col-sm-1" > </div>   						
							<div class="col-sm-2" >   						
							<select class="form-control" name="accnumber" >
									<option value="">--Select Account--</option>
									<?php 
									
										$sqlacc=$this->db->query("SELECT * FROM account_cre WHERE bank_name='Bkash' or bank_name='DBBL'")->result();										
										foreach($sqlacc as $accidshow){
									?>
										<option value="<?php echo $accidshow->accountid?>" <?php if($accountid==$accidshow->accountid){echo "SELECTED";}?>><?php echo $accidshow->acc_name.'('. $accidshow->accountid.')'?></option>
										<?php }?>
							</select>
							</div>
							<div class="col-sm-2" >   						
							<select class="form-control" name="classname">
									<option value="">--Select Class--</option>
									<?php 
										$sqlaccs=$this->db->select('*')->from('application_catg')->get()->result();										
										foreach($sqlaccs as $accidshows){
											$ssqlclass=$this->db->select('class_name')->from('class_catg')->where('classid',$accidshows->classid)->get()->row();
									?>
										<option value="<?php echo $accidshows->appctgid?>" <?php if($catgid==$accidshows->appctgid){echo "SELECTED";}?>><?php echo $ssqlclass->class_name?></option>
										<?php }?>
							</select>
							</div>	
								<div class="col-sm-2">
									<input type="text" name="sdate"  class="form-control" id="sdate" placeholder="Select Date"value="<?php echo $start_date?>"/>
								</div>
								<div class="col-sm-2">
									<input type="text" name="edate"  class="form-control" id="edate" placeholder="Select Date" value="<?php echo $end_date?>"/>
								</div>
								<div class="col-sm-2">
									<input type="submit" class="btn btn-primary" name="submitsearch"  class="form-control" value="Search"/>
								</div>
						</div>
						</form>
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Nr</th>
									<th>Account ID</th>
									<th>Method</th>		
									<th>Application ID</th>										
									<th>Class Name</th>										
									<th>Invoice Number</th>
																					
									<th>Transaction ID</th>														
									<th>Send Account Number</th>
									<th>Purpose</th>														
									<th>Amount</th>														
									<th>Date</th>														
																				
								</tr>
							</thead>
							<tbody>
								<?php $nr=1; foreach($query as $row){									
									?>
								<tr>
									<td><?php echo $nr++ ?></td>									
									<td><?php echo '0'.$row->accountid?></td>
									<td><?php echo $row->method?></td>
									<td><?php echo $row->appid?></td>
									<td><?php echo $row->class_name?></td>
									<td><?php echo $row->invoice_no?></td>
									
									<td><?php echo $row->trans_id;?></td>
									<td><?php echo '0'.$row->saccid?></td>
									<td><?php echo $row->purpose?></td>
									<td><?php echo $row->amount?></td>
									<td><?php  $cdate=$row->e_date;if($cdate>0){echo date('M-d-Y',strtotime($cdate));}?></td>
								</tr>
								<?php }?>
							</tbody>
							</table>
							<div class="row">
								<div class="col-sm-4"></div>
									<div class="col-sm-4">
									  <h3 style=" font-style: italic;">Summary</h3>        
									  <p>Total Amount : <?php echo number_format($tamount,2).'  Taka.';?></p>
									  <p>Today Amount : <?php echo number_format($today_amount,2).'  Taka.';?></p>
									 
									</div>
								<div class="col-sm-4"></div>
								</div>
							</div>
<!-------------------------------------------- end online payment list  ----------------------------------->	
<!-------------------------------------------- start Bkash or DBBL  payment list  ---------------------------->	
							<div id="menu3" class="tab-pane fade">
				
								<br/>
								<form class="form-horizontal" role="form" action="index.php/account_edit/search_appfee_bk_payment" method="post">
						<div class="form-group">
							<div class="col-sm-1" > </div>   						
							<div class="col-sm-2" >   						
							<select class="form-control" name="raccnumber" >
									<option value="">--Select Account--</option>
									<?php 
									
										$rsqlacc=$this->db->query("SELECT * FROM account_cre WHERE bank_name='Bkash' or bank_name='DBBL'")->result();										
										foreach($rsqlacc as $raccidshow){
									?>
										<option value="<?php echo $raccidshow->accountid?>" <?php if($raccountid==$raccidshow->accountid){echo "SELECTED";}?>><?php echo $raccidshow->acc_name.'('. $raccidshow->accountid.')'?></option>
										<?php }?>
							</select>
							</div>
							<!--<div class="col-sm-2" >   						
							<select class="form-control" name="rclassname">
									<option value="">--Select Class--</option>
									<?php 
									//	$rsqlaccs=$this->db->select('*')->from('application_catg')->get()->result();										
										//foreach($rsqlaccs as $raccidshows){
										//	$sqlclass=$this->db->select('class_name')->from('class_catg')->where('classid',$raccidshows->classid)->get()->row();
									?>
										<option value="<?php //echo $raccidshows->appctgid?>" <?php// if($rcatgid==$raccidshows->//appctgid){echo "SELECTED";}?>><?php//echo $sqlclass->class_name?></option>
										<?php //}?>
							</select>
							</div>	-->
								<div class="col-sm-2">
									<input type="text" name="rsdate"  class="form-control" id="rsdate" placeholder="Select Date"value="<?php echo $rstart_date?>"/>
								</div>
								<div class="col-sm-2">
									<input type="text" name="redate"  class="form-control" id="redate" placeholder="Select Date" value="<?php echo $rend_date?>"/>
								</div>
								<div class="col-sm-2">
									<input type="submit" class="btn btn-primary" name="submitsearch"  class="form-control" value="Search"/>
								</div>
						</div>
						</form>
						<table id="example3" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Nr</th>
									<th>Tra.ID</th>
									<th>Method</th>		
									<th>Received Account</th>										
									<th>Sent Account</th>										
									<th>Purpose</th>
									<th>Amount</th>														
									<th>Date</th>														
									<th>Status</th>							
								</tr>
							</thead>
							<tbody>
								<?php $nr=1; foreach($rquery as $rrow){									
									?>
								<tr>
									<td><?php echo $nr++ ?></td>									
									<td><?php echo $rrow->trans_id?></td>
									<td><?php echo $rrow->method?></td>
									<td><?php echo '0'.$rrow->accountid?></td>
									<td><?php echo '0'.$rrow->sent_account?></td>
									<td><?php echo $rrow->purpose?></td>
									<td><?php echo $rrow->amount?></td>									
									<td><?php  $rcdate=$rrow->e_date;if($rcdate>0){echo date('M-d-Y',strtotime($rcdate));}?></td>
									<td><?php echo $rrow->status?></td>
								</tr>
								<?php }?>
							</tbody>
							</table>
							<div class="row">
								<div class="col-sm-4"></div>
									<div class="col-sm-4">
									  <h3 style=" font-style: italic;">Summary</h3>        
									  <p>Total Amount : <?php echo number_format($rtamount,2).'  Taka.';?></p>
									  <p>Today Amount : <?php echo number_format($rtoday_amount,2).'  Taka.';?></p>
									 
									</div>
								<div class="col-sm-4"></div>
								</div>
							</div>							
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