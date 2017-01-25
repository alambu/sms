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
			$('#shak_id_1').effect( "shake",{times:1},2 );
			
		}
		else if(class_name_var==''){
			$('#fee').removeClass('error');
			$('select#class_name').addClass('error');
			$('#shak_id_2').effect( "shake",{times:1},5 );
		}
		else if(img==''){
		    $('select#class_name').removeClass('error');
			$('#img').addClass('error');
			$('#shak_id_3').effect( "shake",{times:1},5 );
		}
		
</script>

<?php
	$cls=$this->db->get("class_catg")->result();
?>

<section class="content">
	<div class="row">
		<div class="col-md-12">
            <div class="box">
				<!-- success massasge -->
					<?php $this->load->view("website/success"); ?>
				<!-- success massasge -->
					<div class="box-body table-responsive">
					   <form class="form-horizontal" id="idForm"  action="index.php/website/addSyllubus" method="post" enctype="multipart/form-data">
					  <table  class="table" >
						<tr>
							<td>
							<div class="form-group" id="itemRows">
								
								 <div class="col-sm-3" id="">
								<center><label>Title</label></center>
								<input type="text" name="cls_title" class="form-control" id="fee" placeholder="Enter Title Name" onkeypress=""/>
							    </div>
								
							  <div class="col-sm-3" id="">
								<center><label>Class Name</label></center>
								<select  name="class_name" class="form-control" id="class_name">
									<option value=''>Select</option>
									<?php foreach($cls as $c): ?>
										<option value="<?php echo $c->classid ?>"><?php echo $c->class_name ?></option>
									<?php endforeach; ?>
								</select>
							  </div>

								 <div class="col-sm-3" id="shak_id_3">
								<center><label style="">Syllabus File</label></center>
								<input type="file" name="img"  id="img" class="form-control" />
							   </div>
							 
							  </form>
							</div>
							 
							</td>
						 </tr>
						<tr>
						<td>
						<div class="form-group">        
						   <div class="col-sm-4"></div>
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
                </section>
			