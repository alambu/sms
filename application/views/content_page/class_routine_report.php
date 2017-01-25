<aside class="right-side">      <!---rightbar start here -->
<style>
	.error{
		border-color:red;
	}
</style> 
	<!-- Content Header (Page header) -->
	
<script type="text/javascript">	

	var newwindow;
	function poptastic(url)
	{
	newwindow=window.open(url,'name','height=600,width=1000,left=150,scrollbars=yes,top=10');
	if (window.focus) {newwindow.focus()}
	}


	<?php   
	echo $c=$this->session->userdata('c');  

	if($c>0){
	?>
	document.onreadystatechange = function(){
	     if(document.readyState === 'complete'){
	         setTimeout(function(){ $("#action_report").slideDown(1000); }, 1000);
			 setTimeout(function(){ $("#action_report").slideUp(1000); }, 5500);
	     }
	}
	<?php } ?>	
</script>

        <div class="row">
			  <div class="col-md-12">
				<div class="box">
					   </div>
					   <div class="table-responsive">
							<table id="example1" class="table table-hover">
						<thead>
							<tr>
								<th>Shift</th>
								<th>Class</th>
								<th>Section</th>
								<th>Creator</th>
								<th>Publish Date</th>
								<th>View</th>
								
								
							</tr>
						</thead>
						
						<tbody>
						  
						</tbody>
						</table>
					   </div>
					</div>		
				</div>