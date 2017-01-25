
<script type="text/javascript">
$(document).ready(function(){
 $('#formid').submit(function() {
  $.post(
            "index.php/account/classfeesett",
            $("#formid").serialize(),
            function(data){
              if(data==1)
			  {
				  $("#hidemessage").show(); 
					setTimeout(function(){					
					window.location="index.php/account/class_fee_sett";
					},3000)
			  }			  
			  else{
				  alert(data);
			  }
     });
 return false;
 });
});
</script>
<script type="text/javascript">
    function edittitle(classid,catgory,amount,rowid,nr,year){	
			
        $.ajax({
                url:"index.php/account_edit/edit_fee_setting_catg",				
                data:{classid:classid.trim(),catgory:catgory.trim(),amount:amount.trim(),rowid:rowid.trim(),year:year},
                type:"POST",
                success:function(data){
					if(data==1){
						var clasName=document.getElementById("classname"+nr).options[document.getElementById("classname"+nr).selectedIndex].text;
						var feeCatg=document.getElementById("feectg"+nr).options[document.getElementById("feectg"+nr).selectedIndex].text;
						document.getElementById("classN"+nr).style.display="block";						
						document.getElementById("feectgspan"+nr).style.display="block";
						document.getElementById("amountspan"+nr).style.display="block";
						document.getElementById("feectgspan"+nr).innerHTML=feeCatg;
						document.getElementById("classN"+nr).innerHTML=clasName;
						document.getElementById("amount"+nr).type="hidden";
						document.getElementById("amountspan"+nr).innerHTML=amount;
						document.getElementById("classname"+nr).style.display="none";
						document.getElementById("feectg"+nr).style.display="none";
						document.getElementById("subedit"+nr).style.display="none";
					}
					else{
						alert(data);
					}
                }
            });
    }
	
	
	// editing function
    function edit(sid){
		
        document.getElementById("classN"+sid).style.display="none";
        document.getElementById("feectgspan"+sid).style.display="none";
        document.getElementById("amountspan"+sid).style.display="none";
        document.getElementById("classname"+sid).style.display="inline";
        document.getElementById("feectg"+sid).style.display="inline";
        document.getElementById("subedit"+sid).style.display="inline";
        document.getElementById("amount"+sid).type="text";
        document.getElementById("classname"+sid).focus();
       
    }
// editing function
// edit action
</script>

<aside class="right-side"> 
	
    <section class="content-header">
        <h1>
            Class Fees Setting Form
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
	
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
								
								<li class="active"><a data-toggle="tab" href="#home">Add Class Fee</a></li>
								
								<li><a href="#menu1" data-toggle="tab">List of Class</a></li>
							  
							  </ul>
					  			
					  		<div class="tab-content">
					  			<div id="home" class="tab-pane fade in active"><br/>
								<?php $this->load->view('account/addClassFees'); ?>					  
					  			</div>
						
					<!---Start view part -->	
					  		<div id="menu1" class="tab-pane fade"><br/>
								<?php $this->load->view('account/feesReport') ?>
					  		</div>
					<!---End view part -->	
			 			</div>
					</div>
				</div>
            </div>	
        </div>	
    </div>	
</div>	
</section>
</aside>