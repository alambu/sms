<script>
function dept(stm){
	$.ajax({
		url:"index.php/employee_submit/chekDept",
		type:"POST",
		data:{k:stm},
		success:function(data){
			
			if(data==1){
			document.getElementById("hasan").innerHTML="Oops! This department is already exist. Try another department...";
			
			}
			
			else{
				 
				document.getElementById("hasan").innerHTML="";
			}
			
		}
		
	});
	
}

</script>

<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Employee Vacancy
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Employee Vacancy</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
				
				
				
				
				
				
				
				
<div class="box">
<div class="box-body">
<?php 
$this->load->view("employee_section/success");
?>					  
					  
<div class="container-fluid">

  <ul class="nav nav-tabs" id="myTab">
	<li class="active"><a data-toggle="tab" href="#all_type"  style="font-weight:bold;">Vacancy List</a></li>
   
  </ul>
     
  <div class="tab-content">
    
	<div id="all_type" class="tab-pane fade in active">
          <div class="row" style="margin-top:40px;">
		     <div class="table-responsive">
                <div class="col-md-12">
				<?php
					$this->load->view('employee_section/employee_vacancy_report');
				 ?>	
				</div>	
		      </div>
		   </div>
    </div>
	<!---
    <div id="report" class="tab-pane fade">
         <div class="row" style="margin-top:40px;">
		     <div class="table-responsive">
                <div class="col-md-12">
					thtyhty
				</div>	
		      </div>
		   </div>
     </div>--->
    
  </div>
</div>
					  
</div>
</div>
				
				
				
				
				
				
				

                   


                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
