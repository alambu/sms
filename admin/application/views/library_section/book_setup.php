<aside class="right-side">      <!---rightbar start here --->
    <style>
		.error{
			border-color:red;
		}
		#myTab{
			margin-bottom:15px;
		}
		input{
		text-transform:uppercase;
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
		

</script>
	
                <section class="content-header">
                    <h1>
                        Book Setup<?php echo $ok; ?>
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Book Catagory</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
						    <div class="col-md-12">
								    <div class="box">
<!------------------confirmation msg start------------------------->
									<?php $this->load->view('library_section/submit_confirm'); ?>
<!------------------confirmation msg End--------------------------->	
										<div class="box-body">
<!--------------Start nav bar-------------------------->										
											<ul class="nav nav-tabs" id="myTab">
												  
												  <li class="active"><a data-toggle="tab" href="#bk_catg">Book Catagory Entry</a></li>
												  <li><a data-toggle="tab" href="#bk_list">Book Entry</a></li>
												  <li><a data-toggle="tab" href="#bk_code">Book Code Entry</a></li>
											</ul>
<!-----------------End Nav bar---------------------------->	

										
<!---------------------Start Tab content-------------------------->
											<div class="tab-content">
											  
								<!------------------Start Book Catagory--------------------->											  
											  <div id="bk_catg" class="tab-pane fade in active">
												<?php 
												$this->load->view('library_section/category_form'); 
												$this->load->view('library_section/category_report');
												?>
											  </div>
											  
								<!------------------End Book Catagory--------------------->											  
								<!------------------Start Book Code--------------------->
											  <div id="bk_code" class="tab-pane fade">
												<?php
												$this->load->view('library_section/book_code_form');
												?>
											  </div>
								<!------------------End Book Code--------------------->
								
								
								<!------------------Start Book Setup--------------------->											  

											  <div id="bk_list" class="tab-pane fade">
												<?php
												$this->load->view('library_section/book_list_form');
												?>
											  </div>
								<!------------------End Book Setup--------------------->											  

																			  
											  
											</div>	
<!--------------End Tab content-------------------------->											
										</div>
								    </div>
						    </div>
                    </div>


                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->