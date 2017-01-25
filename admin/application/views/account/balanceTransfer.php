
<script type="text/javascript">
$(document).ready(function(){
 
 $('#formid').submit(function() {
	document.getElementById("submitbtn").disabled="disabled";
	document.getElementById("maincontentdiv").style.opacity = "0.7";
  $.post(
            "index.php/account/balanceTransferEntry",
            $("#formid").serialize(),
            function(data){
			   //alert(data);	
              if(data==1)
			  {
				  
				  $('#hidemessage').fadeIn('slow').delay(2000).fadeOut('slow');
					setTimeout(function(){					
					window.location="index.php/account/balanceTransfer";
					},1000)
			  }			  
			  else{
				  alert(data);
			  }
    document.getElementById("submitbtn").disabled=false;
	document.getElementById("maincontentdiv").style.opacity = "1"; 
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
					window.location="index.php/account/balanceTransfer";
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
                        Account Balance Transfer
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
						<strong> Successfully!</strong>Transfer complete.
					</div>
				   </div>
				
					<div class="table-responsive">
					<div class="row">					
                      <div class="col-md-12">
					  <ul class="nav nav-tabs" id="myTab">
						
						<li class="active"><a data-toggle="tab" href="#cash">Balance Transfer</a></li>
						
						<li><a data-toggle="tab" href="#home">Transfer History</a></li>
						
					  </ul>
					  
					  <div class="tab-content">
		
					
<!-- Balance Transfer Start -->
					<div id="cash" class="tab-pane fade in active"><br/>
						
						<?php $this->load->view("account/transferEntry"); ?>
						
					</div>

<!-- Balance Transfer End -->



<!--- Start account  form -->
					<div id="home" class="tab-pane fade">
												
					</div>	
<!--- End account  form -->
						</div>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>

    </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here-->