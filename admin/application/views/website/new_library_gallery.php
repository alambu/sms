<aside class="right-side">      <!---rightbar start here --->
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
		function addRow(frm) {
		
	
		var fee_var=$('#fee').val();
		var img=$('#img').val();
		
		if(fee_var=='') {
			$('#fee').addClass('error');
			$('#shak_id_2').effect( "shake",{times:1},2 );
			
		}
		
		else if(img==''){
		    
			$('#img').addClass('error');
			$('#shak_id_3').effect( "shake",{times:1},5 );
		}
		
		else {
			
			
			rowNum ++;
			document.getElementById('reset').value=rowNum;
			
			$('#class_name').removeClass('error');
			$('#img').removeClass('error');
			$('#fee').removeClass('error');
			var row='<div id="rowNum'+rowNum+'" class="form-group"><div class="col-sm-4"><input type="text" name="fee[]" class="form-control"  value="'+frm.fee.value+'"/></div><div class="col-sm-4"><img src="" id="show_img" style="align:center;"  class="img-thumbnail"/><input type="hidden" name="img[]" class="form-control"  value="'+frm.img.value+'"/></div><div class="col-sm-4"><button type="button" class="btn btn-danger" onClick="removeRow('+rowNum+');"><span class="glyphicon glyphicon-minus-sign"></span> Drop</button></div></div>';
		
				
			$("#itemRows").after(row);
			
			frm.fee.value='';
			
			
				 var url = "index.php/admin/image_upload"; 
				//var formData = new FormData("#idForm");
				
				
				$("#idForm").submit(function(e)
						{
						 
							var formObj = $(this);
							var formURL = url;
							var formData = new FormData(this);
							$.ajax({
								url: formURL,
							type: 'POST',
								data:  formData,
							mimeType:"multipart/form-data",
							contentType: false,
								cache: false,
								processData:false,
							beforeSend:function(){
								
								document.getElementById('show_img').src="img/712.gif";
								
							},	
							success: function(data, textStatus, jqXHR)
							{		
									$("#show_img").addClass('size');
									document.getElementById('show_img').src=document.getElementById('test').value;
									frm.img.value='';
							},
							 error: function(jqXHR, textStatus, errorThrown) 
							 {
							 }          
							});
							e.preventDefault(); //Prevent Default action. 
							e.unbind();
						}); 
						$("#idForm").submit();
					 
					 
					 
					 
				
		
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
		
	function upload_img(){
						var tmppath = URL.createObjectURL(event.target.files[0]);
						document.getElementById('test').value=tmppath;
        }
</script>		
				<input type="hidden"  id='test'/>
                <section class="content-header">
                    <h1>
                        Library Gallery
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"> Gallery Image</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<div class="container-fluid">
                    <div class="row">
                      <div class="col-md-10">
					   <form class="form-horizontal" id="idForm"  action="index.php/admin/new_library_gallery" method="post" enctype="multipart/form-data">
					  <table  class="table" >
						<tr>
							<td>
							<div class="form-group" id="itemRows">
								
								 <div class="col-sm-4" id="shak_id_2">
								<center><label>Title</label></center>
								<input type="text" name="fee" class="form-control" id="fee" placeholder="Enter Title"/>
							    </div>
								
								
								 <div class="col-sm-4" id="shak_id_3">
								<center><label style="opacity:0;">nothing</label></center>
								<input type="file" name="img"  id="img" class="form-control" onchange="upload_img();" />
							   </div>
							 
							   <div class="col-sm-4">
								<center><label style="opacity:0;">nothing</label></center>
								<button type="button"  name="section" value="ADD" class="btn btn-info" onclick="addRow(this.form);"><span class="glyphicon glyphicon-plus-sign"></span>  ADD</button>
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
							<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-open"></span>  Upload</button>&nbsp;&nbsp;
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
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
			