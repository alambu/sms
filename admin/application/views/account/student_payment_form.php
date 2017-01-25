<script type="text/javascript">
$(document).ready(function(){
 $('#formid').submit(function(){
	 document.getElementById('submitbutton').disabled = 'disabled';
  $.post(
            "index.php/account/student_paymentinset",
            $("#formid").serialize(),
            function(data){
              if(data==1)
			  {
				  $('#hidemessage').fadeIn('slow').delay(2000).fadeOut('slow');
					setTimeout(function(){					
					window.location="index.php/account/student_payment_form";
					//window.location="index.php/account/moneyreceipt_index";
					},10)
			  }			  
			  else{
				  alert(data);
				  document.getElementById('submitbutton').disabled = false;
			  }
     });
 return false;
 });
 $('#sdate').datepicker({format: "dd-mm-yyyy"});
$('#edate').datepicker({format: "dd-mm-yyyy"}); 
});


function ajax_request_clsid(cls_id){						
	$.ajax({
		url: "index.php/account/classsection",
		type: 'POST',	
		data:{classname:cls_id},	
		success: function(data)
		{							
			if(data.length!=0){
			var d=data.split(",");
					
			document.getElementById("sections").innerHTML="<option value=''>--Select--</option>";			
			for(var i=0;i<d.length;i++){				
				document.getElementById("sections").innerHTML+="<option value='"+d[i]+"'>"+d[i]+"</option>";
			}
			}else{
				document.getElementById("sections").innerHTML='';
				document.getElementById("sections").innerHTML='<option value="">--Select--</option>';
			}
		}          
		});
	}
	
	function searching(){		
		var stuid=document.getElementById("stuid").value;
		var clasid=document.getElementById("classname").value;
		var section=document.getElementById('sections').value;
		var rollid=document.getElementById('rollid').value;
		var shiftid=document.getElementById('shiftid').value;
		if(stuid!=''){
			return true;
		}
		else{
			if(clasid==""){
			alert("Please Select Class Name");
			return false;
		}
		
		if(section==''){
			alert("Please Select Section");
			return false;
		}
	
		if(rollid==''){
			alert("Please Select Roll No");
			return false;
		}
		if(shiftid==''){
			alert("Please Select Shift");
			return false;
		}
		}
		
	}

// url requesting to specific tab
$(function() {
      // Javascript to enable link to tab
      var url = document.location.toString();
      if (url.match('#')) {
        $('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
      }

      // Change hash for page-reload
      $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        window.location.hash = e.target.hash;
      });
    });

</script>

<style>
	.error{
		border-color:red;
	}
</style>

<aside class="right-side">      <!---rightbar start here -->
    <!-- Content Header (Page header) -->
    

    <section class="content-header">
        <h1>
           Student Payment 
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
	
	<section class="content">
		<div class="container-fluid">
<!-- notification page -->
		<?php $this->load->view("exam/success"); ?>
<!-- notification page end -->
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
						<li class="active"><a data-toggle="tab" href="#home">Student Payment</a></li>
						<li><a href="#menu1" data-toggle="tab">Reporting</a></li>
						
					  </ul>
					  
					  <div class="tab-content">
		
<!--- Start Student payment form -->
			<div id="home" class="tab-pane fade in active"><br/>
				<?php $this->load->view("account/studentCollection"); ?>	
			</div>
<!--- End Student payment form -->



<!--- Start Student reporting form -->
				<div id="menu1" class="tab-pane fade"><br/>
					<?php $this->load->view("account/studentPaymentReport"); ?>
				</div>
<!--- End Student reporting form -->
					</div>
          		</div>
			</div>
		</div>
    </section><!-- /.content -->
</aside>