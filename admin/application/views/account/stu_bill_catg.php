<?php 
$this->load->view('header');
$this->load->view('leftbar');
?>
<aside class="right-side">      <!---rightbar start here --->
<script type="text/javascript">
$(document).ready(function(){
 $('#formid').submit(function() {
  $.post(
            "index.php/account/student_bill_catginsert",
            $("#formid").serialize(),
            function(data){
              if(data==1)
			  {
				  $("#hidemessage").show(); 
					setTimeout(function(){					
					window.location="index.php/account/stu_bill_catg";
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
	<!-- Content Header (Page header) -->
	<script type="text/javascript">
	
		var rowNum=0;
		function addRow(frm) {
		var title_value=$('#title').val();
		if(title_value=='') {
			$('#title').addClass('error');
			$('#shak_id').effect( "shake",{times:1},100 );
			
		}
		
		else {
			
			rowNum ++;
			document.getElementById('reset').value=rowNum;
			
			$('#title').removeClass('error');
			var row='<div id="rowNum'+rowNum+'" class="form-group"><label class="control-label col-sm-2" ></label><div class="col-sm-6"><input type="text" name="title[]" value="'+frm.title.value+'" class="form-control" required /></div><div class="col-sm-2"><button type="button" class="btn btn-danger" onClick="removeRow('+rowNum+');" ><span class="glyphicon glyphicon-minus"></span> Drop</button></div></div>';
				
			$("#itemRows").after(row);
			frm.title.value='';
		
		}
		
		}
		
		function removeRow(rnum){
			
			$('#rowNum'+rnum).remove();
			
		}
		
		function reset_content(reset_id){
			for (var i=1;i<=reset_id;i++){
				$('#rowNum'+i).remove();
			}
			
		}
		
		
		
	
	</script>
	
                <section class="content-header">
                    <h1>
                        Student Bill Category
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<div class="col-md-11" style="min-height:50px;">
					<div class="alert alert-success" id="hidemessage" style="margin-top:10px;margin-bottom:5px;">
					<strong> Successfully ! </strong> Your Data insert complete.
				   </div>
				   </div>
                    <div class="row">
                      <div class="col-md-10">
					 <form class="form-horizontal" role="form" action="index.php/account/student_bill_catginsert" method="post" id="formid">
						<div class="form-group" id="itemRows">
						  <label class="control-label col-sm-2" for="pwd">Student Bill Name:</label>
						  <div class="col-sm-6" id="shak_id">          
							<input type="text" name="title[]"  class="form-control" id="title" placeholder="Enter Title Name"/>
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
					  <div class="col-md-2">
					  
					  </div>
                    </div>


                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
				<?php $this->load->view('footer');?>