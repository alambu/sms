      <!---rightbar start here --->
    <style>
		.error{
			border-color:red;
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
			var row='<div id="rowNum'+rowNum+'" class="form-group"><label class="control-label col-sm-2" ></label><div class="col-sm-6"><input type="text" name="catagory[]" value="'+frm.catagory.value+'" class="form-control" readonly /></div><div class="col-sm-2"><button type="button" class="btn btn-danger" onClick="removeRow('+rowNum+');" ><span class="glyphicon glyphicon-minus-sign"></span> </button></div></div>';
				
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
	
               <!--- <section class="content-header">
                    <h1>
                        Book Catagory Setup<?php echo $ok; ?>
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Book Catagory</li>
                    </ol>
                </section>-------->

                <!-- Main content -->
              
					<?php // $this->load->view('library_section/submit_confirm'); ?>
                    <div class="row">
                      <div class="col-md-12">
							 <form class="form-horizontal" role="form" action="library_submit/category_form" method="post" onsubmit="return validation();">
								<div class="form-group" id="itemRows">
								  <label class="control-label col-sm-2" for="pwd">Catagory Name:</label>
								  <div class="col-sm-6" id="shak_id"> 
									
									<input type="text" name="catagory"  class="form-control"  id="catagory" placeholder="Enter Catagory Name" onkeypress="return only_chareter(this.value);"/>
								  </div>
								  <div class="col-sm-2">          
									<button type="button"  name="section" value="ADD" class="btn btn-info" id="fee" onclick="addRow(this.form);"><span class="glyphicon glyphicon-plus-sign"></span></button>
								  </div>
								</div>
								
								
								<div class="form-group">        
								  <div class="col-sm-offset-2 col-sm-10">
									<button type="submit"  name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Submit</button>
									&nbsp;&nbsp;
									<button type="button" value="" class="btn btn-warning" id="reset" onclick=" reset_content(this.value);"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
								  </div>
								</div>
								
								<div class="form-group">        
								  <div class="col-sm-offset-2 col-sm-10">
									
								  </div>
								</div>
							  </form>			
					
					  </div>
					  
                    </div>
   <!---rightbar close here ---->