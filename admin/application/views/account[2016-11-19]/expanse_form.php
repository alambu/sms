<script type="text/javascript">
	$(document).ready(function(){
	 $('#formid').submit(function() {
	  $.post(
	    "index.php/account/expanse_insert",
	    $("#formid").serialize(),
	    function(data){

	      if(data==1)
		  {
			  $("#hidemessage").show(); 
				setTimeout(function(){					
				window.location="index.php/account/expanse_form";
				//window.location="index.php/account_edit/expanse_print";
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

  $(function() {
    $( "#datepicker" ).datepicker();
  });

  function testdate(){			
		$('#sadate').datepicker({format: "dd-mm-yyyy"});			
	}

</script>

<style>
	.error{
		border-color:red;
	}
</style>

<aside class="right-side">
    <section class="content-header">
        <h1>
           School Expanse Section
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
							<li class="active"><a data-toggle="tab" href="#home">Expanse Add</a></li>
							<li><a href="#menu1" data-toggle="tab">Reporting</a></li>
						  </ul>
					  	
					  	<div class="tab-content">
		
						<!--- Start expense form -->
						<div id="home" class="tab-pane fade in active"><br/>
					 		<?php $this->load->view("account/expanseEntry") ?>
					 	</div>
<!--- End of expense form -->



 <!--- Start list of view form -->
					<div id="menu1" class="tab-pane fade"><br/>
						<?php $this->load->view("account/expanseReport") ?>				
					</div>
                </div>
			</div>					  
        </div>
    </div>
</div>
</div>
</section>
</aside>