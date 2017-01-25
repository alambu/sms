
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
		var class_name_var = $('select#class_name').val();
	
		var fee_var=$('#fee').val();
		var img=$('#img').val();
		
		if(fee_var=='') {
			$('#fee').addClass('error');
			alert("Empty Title.");
			$("#fee").focus();
			
		}
		else if(class_name_var==''){
			$('#fee').removeClass('error');
			$('select#class_name').addClass('error');
			alert("Empty Image Catagory.");
			$("#class_name").focus();
		}
		else if(img==''){
		    $('select#class_name').removeClass('error');
			$('#img').addClass('error');
			alert("No Image Selected.");
			$("#img").focus();
		}
		
		else {
			
			rowNum ++;
			document.getElementById('reset').value=rowNum;
			
			$('#class_name').removeClass('error');
			$('#img').removeClass('error');
			$('#fee').removeClass('error');
			var row='<div id="rowNum'+rowNum+'" class="form-group"><div class="col-sm-3"><input type="text" name="fee[]" class="form-control"  value="'+frm.fee.value+'"/></div><div class="col-sm-3"><input type="hidden" name="class_name[]" value="'+frm.class_name.value+'" class="form-control"/><input type="text" value="'+frm.class_name.options[frm.class_name.selectedIndex].text+'" class="form-control"/></div><div class="col-sm-3"><img src="" id="show_img" style="align:center;"  class="img-thumbnail"/><input type="hidden" name="img[]" class="form-control"  value="'+frm.img.value+'"/></div><div class="col-sm-3"><button type="button" class="btn btn-danger" onClick="removeRow('+rowNum+');"><span class="glyphicon glyphicon-minus-sign"></span> Drop</button></div></div>';
		
		$("#itemRows").after(row);
			frm.class_name.value='';
			frm.fee.value='';
			
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

    function valid(){
    	if(rowNum<=0){
    		alert("Pls add minimum one image");
    		return false;
    	}else{
    		return true;
    	}
    }

</script>		
				<input type="hidden"  id='test'/>
                <!-- Main content -->
                <section class="content">
					<div class="container-fluid">
                    <div class="row">
<!-- success massasge -->
<?php $this->load->view("website/success"); ?>
<!-- success massasge -->
                      <div class="col-md-12">
					   <form class="form-horizontal" id="idForm"  action="index.php/website/gallery_update" method="post" enctype="multipart/form-data" onsubmit="return valid()">
					  <table  class="table" >
						<tr>
							<td>
							<div class="form-group" id="itemRows">
								
								 <div class="col-sm-3" id="">
								<center><label>Title</label></center>
								<input type="text" name="title" class="form-control" id="title" placeholder="Image Title" required />
							    </div>
								
							  <div class="col-sm-3" id="">
								<center><label>Catagory</label></center>
								<select  name="cat" class="form-control" id="cat">
									<option value="">--Select--</option>
									<?php
										$imgCat=$this->db->select("*")->from("image_catagory")->get()->result();
										foreach($imgCat as $ic):
									?>
									<option value="<?php echo $ic->id ?>"><?php echo $ic->image_catagory ?></option>
									<?php
										endforeach;
									?>
								</select>
							  </div>
								
								 <div class="col-sm-3" id="shak_id_3">
								<center><label style="opacity:0;">nothing</label></center>
								<input type="file" name="img"  id="img" class="form-control" accept="image/*" />
							   </div>
							 
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
							<button type="reset" value="" class="btn btn-warning" id="reset" onclick=" reset_content(this.value);"><span class="glyphicon glyphicon-refresh"> Reset</button>
							
						  </div>
						  
						  
						</div>
						</td>
					    </tr>
                       					  
					  </table>
					  </form>
					  </div>
					 <div class="col-md-2">
					 
					 </div>
                    </div>

					</div>
                </section>