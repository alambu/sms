<!-- Content Header (Page header) -->
		 <style>
		.error{
			border-color:red;
		}
		.size{
			height:70px;
			width:70px;
		}
	</style>            <!-- Content Header (Page header) -->
<script type="text/javascript">
	
		var rowNum=0;
		function addRow() {
		var notice_date_var = $('#notice_date').val();
	
		var notice_title_var=$('#notice_title').val();
		var img=$('#img').val();
		
		if(notice_title_var=='') {
			$('#notice_title').addClass('error');
			alert("Empty Notice Title");
			$('#notice_title').focus();
			return false;
			
		}
		else if(notice_date_var==''){
			$('#notice_title').removeClass('error');
			$('#notice_date').addClass('error');
			$('#notice_date').focus();
			alert("Empty Publish Date");
			return false;
		}
		else if(img==''){
		    $('#notice_date').removeClass('error');
			$('#img').addClass('error');
			$('#img').focus();
			alert("Empty Notice file");
			return false;
		}
		else{return true;}
	}
// date format
$(document).ready(function(){
	$("#notice_date").datepicker({format:"yyyy-mm-dd"});
});
</script>		
<input type="hidden"  id='test'/>
        
                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
        <div class="row">
			<div class="col-md-12">
                <div class="box">
				<!-- success massasge -->
						<?php $this->load->view("website/success"); ?>
					<!-- success massasge -->
                    <div class="box-body table-responsive">
					   <form class="form-horizontal" id="idForm"  action="index.php/website/addNotice" method="post" enctype="multipart/form-data" onsubmit="return addRow()" >
					  <table  class="table" >
						<tr>
							<td>
							<div class="form-group" id="itemRows">
								
								 <div class="col-sm-3" id="">
								<center><label>Title</label></center>
								<input type="text" name="notice_title" class="form-control" id="notice_title" placeholder="Notice Title" />
							    </div>
								
							  <div class="col-sm-3" id="">
								<center><label>Published Date</label></center>
								<input type="text" name="notice_date" class="form-control" id="notice_date" placeholder="Publish date" />
								
							  </div>
								
								 <div class="col-sm-3" id="shak_id_3">
								<center><label style="">Notice File</label></center>
								<input type="file" name="img"  id="img" class="form-control" />
							   </div>
							  </form>
							</div>
							 
							</td>
						 </tr>
						<tr>
						<td>
						<div class="form-group">        
						   
						  
						   <div class="col-sm-4">          
								
						   </div>
						   <div class="col-sm-6">
							<button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-open"></span>  Upload</button>&nbsp;&nbsp;
							<button type="button" value="" class="btn btn-warning" id="reset" onclick=" reset_content(this.value);"><span class="glyphicon glyphicon-refresh"> Reset</button>
							
						  </div>
						  
						  
						</div>
						</td>
					    </tr>
                       					  
					  </table>
					 
					  </div>
					 <div class="col-md-2">
					 
					 </div>
                    </div>

					</div>
                </section>
			