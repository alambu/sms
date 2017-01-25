<aside class="right-side">      <!---rightbar start here --->
    <style>
		.error{
			border-color:red;
		}
	</style>            <!-- Content Header (Page header) -->

	<script type="text/javascript">
	
		var rowNum=0;
		function addRow(frm) {
		var shift_value=$('#shift').val();
		
		if(shift_value=='') {
			$('#shift').addClass('error');
			$('#shak_id').effect( "shake",{times:1},100 );
			
		}		
		else {			
			rowNum ++;
			document.getElementById('reset').value=rowNum;
			$('#shift').removeClass('error');
			var row='<div id="rowNum'+rowNum+'" class="form-group"><label class="control-label col-sm-2" ></label><div class="col-sm-6"><input type="text" name="shift[]" value="'+frm.shift.value+'" readonly class="form-control"/></div><div class="col-sm-2"><button type="button" class="btn btn-danger" onClick="removeRow('+rowNum+');" ><span class="glyphicon glyphicon-minus"></span> Drop</button></div></div>';
				
			$("#itemRows").after(row);
			frm.shift.value='';
		
		}
		
		}
		
		function removeRow(rnum){
			$('#rowNum'+rnum).remove();
			rowNum--;
			
		}
		
		
		function reset_content(reset_id){
			for (var i=1;i<=reset_id;i++){
				$('#rowNum'+i).remove();
			}
			
		}
		
		
		
	   function validation(){
		   
		if(rowNum=='0'){
		 alert('please Add Data');
		 return false;
		}
		else{
		 return true;
		}
   }
	
	
	</script>
	
	
                <section class="content-header">
                    <h1>
                        Employee Department
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Employee Department</li>
                    </ol>
                </section>

				
				
				
                <!-- Main content -->
                <section class="content">
					<?php 
						$this->load->view("employee_section/success");
					?>
                    <div class="row">
                      <div class="col-md-12">
					 <form class="form-horizontal" role="form" action="index.php/employee_submit/employee_dep_catg" method="post" onsubmit="return validation(); ">
						<div class="form-group" id="itemRows">
						  <label class="control-label col-sm-2" for="pwd">Employee Category:</label>
						  <div class="col-sm-6" id="shak_id">          
							<input type="text" name="shift"  class="form-control" id="shift" placeholder="Enter Employee Category"/>
						  </div>
						  <div class="col-sm-2">          
							<button type="button"  name="section" value="ADD" class="btn btn-info" id="fee" onclick="addRow(this.form);"><span class="glyphicon glyphicon-plus"></span> ADD </button>
						  </div>
						</div>
						
						
						<div class="form-group">        
						  <div class="col-sm-offset-2 col-sm-10">
							<button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Submit</button>
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


                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
			
			
			
			
			
		
			
			
			
			
			
			
			
			
			
			