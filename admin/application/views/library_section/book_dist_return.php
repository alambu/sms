<aside class="right-side">      <!---rightbar start here --->
    <style>
		.error{
			border-color:red;
		}
		#myTab{
			margin-bottom:15px;
		}
	</style>            <!-- Content Header (Page header) -->
	<script type="text/javascript">
	
		var rowNum=0;
		function addRow(frm) {
		var catagory_value=$('#catagory').val();
		
		if(catagory_value=="" || catagory_value== null) {
			$('#catagory').addClass('error');
			$('#shak_id').effect( "shake",{times:1},100 );
			
		}
		
		else {
			
			rowNum ++;
			document.getElementById('reset').value=rowNum;
			
			$('#catagory').removeClass('error');
			var row='<div id="rowNum'+rowNum+'" class="form-group"><label class="control-label col-sm-2" ></label><div class="col-sm-6"><input type="text" name="catagory[]" value="'+frm.catagory.value+'" class="form-control" readonly /></div><div class="col-sm-2"><button type="button" class="btn btn-danger" onClick="removeRow('+rowNum+');" ><span class="glyphicon glyphicon-minus"></span> Drop</button></div></div>';
				
			$("#itemRows").after(row);
			frm.catagory.value='';
		
		}
		
		}
		
		function removeRow(rnum){
			
			$('#rowNum'+rnum).remove();
			rowNum--;
		}
		
		function reset_content(reset_id){
			
			var con=confirm('Are You Sure ?');
			if(con==true){
			for (var i=1;i<=reset_id;i++){
				$('#rowNum'+i).remove();
			}
			rowNum=0;
			}
			else {
				
			}
		}
		
		function validation(){
		  if(rowNum=='0'){
			  alert('Please Add Data');
			  return false;
		  }
		  else{
			  return true;
		  }
		}
		

	
function ajax_request_clsid(cls_id,ty){
		//alert(cls_id);
		$.ajax({
			url: "index.php/student_submit/ajax_request",
			type: 'POST',	
			data:{cls_id:cls_id},	
			success: function(data)
			{	
			if(data.length!=0){
			var data1=data.split("#");	
			var d=data1[0].split(",");
			var d1=data1[1].split(",");
			var sec="Select Section";
			document.getElementById("section"+ty).innerHTML='';
			document.getElementById("section"+ty).innerHTML="<option value=''>"+sec+"</option>";
			
			for(var i=0;i<d.length;i++){
				
				document.getElementById("section"+ty).innerHTML+="<option value='"+d1[i]+"'>"+d[i]+"</option>";
			}
			}
			else {
				document.getElementById("section"+ty).innerHTML='';
				document.getElementById("section"+ty).innerHTML="<option value=''>Section Select</option>";
			}
			
			}
			
			});
		}		
</script>
	
                <section class="content-header">
                    <h1>
                        Book Distribution
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Book Catagory</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<div class="container-fluid">
                    <div class="row">
						    <div class="col-md-12">							
								    <div class="box">
										<div class="box-body">
<!----------------------confirmation msg start-------------->
								<?php $this->load->view("library_section/submit_confirm"); ?>
<!----------------------confirmation msg End----------------->										
<!--------------Start nav bar-------------------------->										
											<ul class="nav nav-tabs" id="myTab">
												  
												  <li class="active"><a data-toggle="tab" href="#bk_dis">Distribute</a></li>
												  <li><a data-toggle="tab" href="#bk_ret">Return</a></li>
												  <li><a data-toggle="tab" href="#exp_date">Return Expeired</a></li>
												   <!---<li><a data-toggle="tab" href="#re_store">Book Restore</a></li>--->
												 
											</ul>
<!-----------------End Nav bar---------------------------->	

										
<!---------------------Start Tab content-------------------------->
											<div class="tab-content">
											  
								<!------------------Start Book Distribute--------------------->											  
											  <div id="bk_dis" class="tab-pane fade in active">
												<?php $this->load->view('library_section/book_distribution_form'); ?>
											  </div>
											  
								<!------------------End Book Distribute--------------------->											  
								<!------------------Start Book Return--------------------->
											  <div id="bk_ret" class="tab-pane fade">
												<?php
												
												  $this->load->view('library_section/book_return_form');
												?>
											  </div>
								<!------------------End Book Return--------------------->
								
								
								<!------------------Start Expeired date--------------------->											  
											  <div id="exp_date" class="tab-pane fade">
											  <h3>Book Return Expeired</h3>
												<?php $this->load->view('library_section/book_exp'); ?>
											  </div>
											  
								<!------------------End Expeired date--------------------->  								  
								<!------------------Start Book Re store--------------------->											  
											 <!-- <div id="re_store" class="tab-pane fade">
											  <h3>Book Restore</h3>
												<?php //$this->load->view('library_section/book_restore'); ?>
											  </div>-->
											  
								<!------------------End Book Restore--------------------->
																			  
											  
											</div>	
<!--------------End Tab content-------------------------->											
										</div>
								    </div>
						    </div>
                    </div>

				</div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->