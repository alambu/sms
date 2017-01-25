<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
	
	 <style>
		.error{
			border-color:red;
		}
	</style>            <!-- Content Header (Page header) -->
<script type="text/javascript">
	
		var rowNum=0;
		function addRow(frm) {
		var msg="";	
		var class_name = $('select#class_name').val();
		var sub_name=$('#sub_name').val();
		var exam_mark=$('#exam_mark').val();
		var theo_mrk=$('#theo_mrk').val();
		var prac_mark=$('#prac_mark').val();
		var ex_mark=$('#ex_mark').val();
		
		if(class_name=='') {
			$('select#class_name').addClass('error');
			$('#shak_id_1').effect( "shake",{times:1},100 );
			msg+='enty error';
			
		}
		else{
			$('select#class_name').removeClass('error');
		}
		if(sub_name==''){
			msg+='enty error';
			$('#sub_name').addClass('error');
			
		}
		else {
			$('#sub_name').removeClass('error');
		}
		
		if(exam_mark==''){
			
			$('#exam_mark').addClass('error');
			msg+='enty error';
		}
		else{
			$('#exam_mark').removeClass('error');
		}
		
		if(theo_mrk==''){
			msg+='enty error';
			$('#theo_mrk').addClass('error');
		}
		else{
			$('#theo_mrk').removeClass('error');
		}
		
		if(prac_mark==''){
			msg+='enty error';
			$('#prac_mark').addClass('error');
		}
		else{
			$('#prac_mark').removeClass('error');
		}
		
		if(ex_mark==''){
			msg+='enty error';
			$('#ex_mark').addClass('error');
			
		}
		else{
			$('#ex_mark').removeClass('error');
			
		}
		
		if(msg==""){
			
			rowNum ++;
			document.getElementById('reset').value=rowNum;
			
			$('#exam_mark').removeClass('error');
			
			
			
			var row='<div id="rowNum'+rowNum+'" class="form-group"><div class="col-md-3"><input type="text" name="sub_name[]" value="'+frm.sub_name.value+'" class="form-control"/></div><div class="col-md-3"><input type="text" name="exam_mark[]" class="form-control"  value="'+frm.exam_mark.value+'"/></div><div class="col-md-3"><input type="text" name="theo_mrk[]" value="'+frm.theo_mrk.value+'" class="form-control"/></div><div class="col-md-2"><input type="text" name="prac_mark[]" class="form-control"  value="'+frm.prac_mark.value+'"/></div><div class="col-md-1"><button type="button" class="btn btn-danger" onClick="removeRow('+rowNum+');"><span class="glyphicon glyphicon-minus-sign"></span> Drop</button></div></div>';
				
			$("#itemRows").after(row);
			frm.sub_name.value='';
			frm.exam_mark.value='';
			frm.theo_mrk.value='';
			frm.prac_mark.value='';
			frm.ex_mark.value='';
			frm.class_name.value='';
		
		}
		else{
			
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
		
// onsubmit function
function valid(){
	if(rowNum<=0){
		alert("pls add any book list first.");
		return false;
	}else{return true;}
}
	
</script>
	
                <section class="content-header">
                    <h1>
                        ADD Book List
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<div class="container">
                    <div class="row">
                      <div class="col-md-11">
					   <form class="form-horizontal" role="form" action="index.php/website/new_book_list" method="post" onsubmit="return valid()">
					  <table  class="table table-striped">
						<tr id="itemRows">
						<td>
						<div class="form-group">

						  <div class="col-md-3" id="shak_id_2">
							<center><label>Catagory Name</label></center>
							<input type="text" name="sub_name" class="form-control" id="sub_name" placeholder="Catagory Name"/>
						  </div>
						
						   <div class="col-md-3">
							<center><label>Book Name</label></center>
							<input type="text" name="exam_mark" class="form-control" id="exam_mark" placeholder="Book Name" onkeypress=""/>
						  </div>
						  
						   <div class="col-md-3"> 
							<center><label>Writer Name</label></center>
							<input type="text" name="theo_mrk" class="form-control" id="theo_mrk" placeholder="Writer Name" onkeypress=""/>
						  </div>
						   <div class="col-md-2">
							<center><label>Total Quantity</label></center>
							<input type="text" name="prac_mark" class="form-control" id="prac_mark" placeholder="Total Quantity" onkeypress="return isNumber(event);"/>
						  </div>
						   
						  <div class="col-md-1">
							<center><label><span style="opacity:0;">nothing</span></label></center>
							<button type="button"  name="section" value="ADD" class="btn btn-info" onclick="addRow(this.form);"><span class="glyphicon glyphicon-plus-sign"></span> ADD </button>
						  </div>
						</div>
						</td>
						 </tr>
                       					  
					  </table>
					 
					  </div>
					  
					 </div>
					 <div class="row">
						<div class="col-md-12">
						
						<div class="form-group">        
						   <div class="col-md-2">          
							
						  </div>
						   <div class="col-md-2">          
							
						  </div>
						  
						   <div class="col-md-2">          
								
						  </div>
						   <div class="col-md-2">          
							
						  </div>
						   <div class="col-md-4">          
							<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Submit</button>&nbsp;&nbsp;
							<button type="button" value="" class="btn btn-warning" id="reset" onclick="reset_content(this.value);"><span class="glyphicon glyphicon-refresh"></span>  Reset</button>
							
						  </div>
						  
						</div>
						
						
						</div>
					 </div>
					  </form>
                    </div>

					</div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->