
<script type="text/javascript">
$(document).ready(function(){
 
 $('#formid').submit(function() {
  $.post(
            "index.php/account/accountopen_insert",
            $("#formid").serialize(),
            function(data){
              if(data==1)
			  {
				  $('#hidemessage').fadeIn('slow').delay(2000).fadeOut('slow');
					setTimeout(function(){					
					window.location="index.php/account/account_open";
					},2000)
			  }			  
			  else{
				  alert(data);
			  }
     });
 return false;
 });

 $('#formid2').submit(function() {
  $.post(
            "index.php/account/accountopen_insert",
            $("#formid2").serialize(),
            function(data){
              if(data==1)
			  {
				  $('#hidemessage').fadeIn('slow').delay(2000).fadeOut('slow');
					setTimeout(function(){					
					window.location="index.php/account/account_open";
					},2000)
			  }			  
			  else{
				  alert(data);
			  }
     });
 return false;
 });

});
</script>
<aside class="right-side">      <!---rightbar start here -->
    <style>
		.error{
			border-color:red;
		}
	</style>            <!-- Content Header (Page header) -->
	<script type="text/javascript">
	
		var rowNum=0;
		function addRow(frm) {
		var title_value=$('#title').val();
		if(title_value=='') {
			$('#title').addClass('error');
			$('#shak_id').effect( "shake",{times:1},100 );
			
		}
		
		else {
			
			rowNum ++;
			document.getElementById('reset').value=rowNum;
			
			$('#title').removeClass('error');
			var row='<div id="rowNum'+rowNum+'" class="form-group"><label class="control-label col-sm-2" ></label><div class="col-sm-6"><input type="text" name="title[]" value="'+frm.title.value+'" class="form-control"/></div><div class="col-sm-2"><button type="button" class="btn btn-danger" onClick="removeRow('+rowNum+');" ><span class="glyphicon glyphicon-minus"></span> Drop</button></div></div>';
				
			$("#itemRows").after(row);
			frm.title.value='';
		
		}
		
		}
		
		function removeRow(rnum){
			
			$('#rowNum'+rnum).remove();
			
		}
		
		function reset_content(reset_id){
			for (var i=1;i<=reset_id;i++){
				$('#rowNum'+i).remove();
			}
			
		}
		
		
		
	
	</script>
	
                <section class="content-header">
                    <h1>
                        New Account Open
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
						
						<li class="active"><a data-toggle="tab" href="#cash">New Cash Account</a></li>
						
						<li><a data-toggle="tab" href="#home">New Bank Account</a></li>
						
						<li><a href="#menu1" data-toggle="tab">List of Account</a></li>
						
					  </ul>
					  
					  <div class="tab-content">
		
					
<!-- start cash account section -->
					<div id="cash" class="tab-pane fade in active"><br/>
						<?php $this->load->view("account/cashAccount"); ?>						
					</div>

<!-- end of cash account -->

<!--- Start account  form -->
					<div id="home" class="tab-pane fade">
			
						<br/>
						
						 <form class="form-horizontal" role="form" action="" method="post" id="formid2">
							<div class="form-group">
							  <label class="control-label col-sm-2" for="pwd">Account Number:</label>
							  <div class="col-sm-6" >          
								<input type="hidden" name="type" value="2" />
								<input type="text" name="accnumber"  class="form-control" id="accnumber" onkeypress="return isNumber(event)" required placeholder="Enter Account Number"/>
							  </div>						  
							</div>
							<div class="form-group">
							  <label class="control-label col-sm-2" for="pwd">Account Name:</label>
							  <div class="col-sm-6" >          
								<input type="text" name="accname"  class="form-control" id="accname" required placeholder="Enter Account Name"/>
							  </div>						  
							</div>
							<div class="form-group">
							  <label class="control-label col-sm-2" for="pwd">Bank Name:</label>
							  <div class="col-sm-6" >          
								<input type="text" name="bankname"  class="form-control" id="bankname" placeholder="Enter Bank Name"/>
							  </div>						  
							</div>
							<div class="form-group">
							  <label class="control-label col-sm-2" for="pwd">Opening Balance:</label>
							  <div class="col-sm-6" >          
								<input type="text" name="openbalance"  class="form-control" id="openbalance" required placeholder="Enter Amount Name" onkeypress="return isamountonly(event)"/>
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
<!--- End account  form -->

<!--- Start account  list view form -->
								<div id="menu1" class="tab-pane fade">			
									<br/>
									<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Nr</th>
									<th>Account Number</th>
									<th>Account Name</th>										
									<th>Bank Name</th>										
									<th>Balance</th>														
								</tr>
							</thead>
							<tbody>
								<?php $nr=1; 
								$query=$this->db->query("SELECT * FROM account_cre")->result();
								foreach($query as $row){									
									?>
								<tr>
									<td><?php echo $nr++ ?></td>									
									<td><?php echo $row->accountid?></td>
									<td><?php echo $row->acc_name?></td>
									<td><?php echo $row->bank_name?></td>
									<td><?php echo $row->balance?></td>
								</tr>
								<?php }?>
							</tbody>
							</table>
								</div>
<!--- Start account list view form -->
						</div>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>

    </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here-->