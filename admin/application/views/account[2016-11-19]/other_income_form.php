<script type="text/javascript">
$(document).ready(function(){
 $('#formid').submit(function() {

  $.post(
            "index.php/account/extraincome_insert",
            $("#formid").serialize(),
            function(data){
              if(data==1)
			  {
				  $("#hidemessage").show(); 
					setTimeout(function(){
					window.location="account/income_checksohow";
					},2000)
			  }			  
			  else{
				  alert(data);
			  }
     });
 return false;
 });
 $('#sdate').datepicker({format: "yyyy-mm-dd"});
$('#edate').datepicker({format: "yyyy-mm-dd"}); 
});
</script> 

<aside class="right-side">      <!---rightbar start here -->
           <!-- Content Header (Page header) -->
	<script type="text/javascript">
		}
		function testdate(){			
			$('#sadate').datepicker({format: "dd-mm-yyyy"});							
		}

	</script>
	
	
                <section class="content-header">
                    <h1>
                       School Income Section
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
						<li class="active"><a data-toggle="tab" href="#home">Income Add</a></li>
						<li><a href="#menu1" data-toggle="tab">Reporting</a></li>
						
					  </ul>
					  
					  
					<div class="tab-content">
					<!--- Start expense form -->
						<div id="home" class="tab-pane fade in active"><br/>
			            	<?php $this->load->view("account/incomeEntry"); ?>
			            </div>	

					<!-- report section -->
						<div id="menu1" class="tab-pane fade"><br/>
							<?php $this->load->view("account/incomeReport") ?>
						</div>
        			</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</section>
</aside>