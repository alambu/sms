<?php 
$this->load->view('header');
$this->load->view('leftbar');
?>
<script type="text/javascript">
$(document).ready(function(){
 $('#formid').submit(function() {
	 document.getElementById('submitsearch').disabled = 'disabled';
  $.post(
            "index.php/account_edit/add_balance_insert",
            $("#formid").serialize(),
            function(data){
              if(data==1)
			  {
				 $('#hidemessage').fadeIn('slow').delay(2000).fadeOut('slow');
					setTimeout(function(){					
					window.location="index.php/account/add_balance";
					//window.location="index.php/account_edit/expanse_print";
					},2000)
			  }			  
			  else{
				  alert(data);
				  document.getElementById('submitsearch').disabled = false;
			  }
     });
 return false;
 });
  $('#sdate').datepicker({format: "dd-mm-yyyy"});
  $('#edate').datepicker({format: "dd-mm-yyyy"}); 
});
</script>
<aside class="right-side">      <!---rightbar start here --->
    <style>
		.error{
			border-color:red;
		}
	</style>     
	<!-- Content Header (Page header) -->
	 <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
	<script type="text/javascript">

		function testdate(){			
			$('#sadate').datepicker({format: "dd-mm-yyyy"});							
		}
	</script>
	
	
                <section class="content-header">
                    <h1>
                      Balance Add
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
						<li class="active"><a data-toggle="tab" href="#home">Balance Add</a></li>
						<li><a href="#menu1" data-toggle="tab">Reporting</a></li>
						
					  </ul>
					  
					  <div class="tab-content">
		
<!---------------------------------------------- Start expense form ------------------>
			<div id="home" class="tab-pane fade in active">
			
			<br/>
					 <form class="form-horizontal" role="form" action="" method="post" id="formid">
						<div class="form-group">
						  <label class="control-label col-sm-2" >Account Name:</label>
						  <div class="col-sm-6" >          
							<select class="form-control" name="accountid" required onchange="htmlData('index.php/account/search_add_balance','ch='+this.value)">
									<option value="">--Select Account Name--</option>
									<?php 
										$sqlacc=$this->db->select('*')->from('account_cre')->get()->result();										
										foreach($sqlacc as $accidshow){
									?>
										<option value="<?php echo $accidshow->accountid?>"><?php echo $accidshow->acc_name.'('. $accidshow->accountid.')'?></option>
										<?php }?>
							</select>
						  </div>						  
						</div>
						
						<div id="txtResult"></div>
						<div class="form-group">
						  <label class="control-label col-sm-2" >Amount:</label>
						  <div class="col-sm-6" >          
							<input type="text" name="amount"  class="form-control" id="amount" required placeholder="Enter Amount " onkeypress="return isamountonly(event)"/>
						  </div>						  
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-2" >Comment:</label>
						  <div class="col-sm-6" >          
							<input type="text" name="comment"  class="form-control" id="comment" required placeholder="Enter Comment "/>
						  </div>						  
						</div>					
						<div class="form-group">        
						  <div class="col-sm-offset-2 col-sm-10">
							<button type="submit" name="submit" id="submitsearch" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Submit</button>
							
						  </div>
						</div>
						
						<div class="form-group">        
						  <div class="col-sm-offset-2 col-sm-10">
							
						  </div>
						</div>
					  </form>			
						
					  </div>
<!------------------------------------------ End of expense form ---------------->



 <!------------------------------------------------- Start list of view form ---------------->
						<div id="menu1" class="tab-pane fade">							
							<br/>
							
					<form class="form-horizontal" role="form" action="index.php/account_edit/search_balance_add" method="post">
						<div class="form-group">
							<div class="col-sm-3"> </div>   						
							<div class="col-sm-2" >   						
							<select class="form-control" name="accnumber">
									<option value="">--Select Account Name--</option>
									<?php 
										$sqlaccs=$this->db->select('*')->from('account_cre')->get()->result();										
										foreach($sqlaccs as $accidshows){
									?>
										<option value="<?php echo $accidshows->accountid?>" <?php if($accountid==$accidshows->accountid){echo "SELECTED";}?>><?php echo $accidshows->acc_name.'('. $accidshows->accountid.')'?></option>
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
									<th>Invoice Number</th>										
									<th>Amount</th>
									<th>Comment</th>														
									<th>Date</th>														
									<th>Person</th>													
								</tr>
							</thead>
							<tbody>
								<?php
								
								$nr=1; foreach($query as $row){
									$acname=$this->accmodone->accountinfo($row->accountid);									
									?>
								<tr>
									<td><?php echo $nr++ ?></td>									
									<td><?php echo $acname->acc_name.'('.$row->accountid.')'?></td>
									<td><?php echo $row->invoice_id?></td>
									<td><?php echo $row->balance?></td>
									<td><?php echo $row->comment?></td>
									<td><?php  $cdate=$row->e_date;if($cdate>0){echo date('M-d-Y',strtotime($cdate));}?></td>
									<td><?php echo $row->e_user?></td>
								</tr>
								<?php }?>
							</tbody>
							</table>	
						<div class="row">
								<div class="col-sm-4"></div>
								<div class="col-sm-4">
								  <h3 style=" font-style: italic;">Summary</h3>        
								  <p>Total Amount : <?php echo number_format($tamount->balance,2).'  Taka.';?></p>
						 
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

                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
			<?php $this->load->view('footer');?>