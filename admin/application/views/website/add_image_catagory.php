 <style>
		.error{
			border-color:red;
		}
	</style>            <!-- Content Header (Page header) -->
	<script type="text/javascript">
	
		var rowNum=0;
		function addRow(frm) {
		var catagory_value=$('#catagory').val();
		
		if(catagory_value=='') {
			$('#catagory').addClass('error');
			$('#shak_id').effect( "shake",{times:1},400 );
			alert("Empty Category Name");
			document.getElementById("catagory").focus();
			
		}
		
		else {
			
			rowNum ++;
			document.getElementById('reset').value=rowNum;
			
			$('#catagory').removeClass('error');
			var row='<div id="rowNum'+rowNum+'" class="form-group"><label class="control-label col-sm-2" ></label><div class="col-sm-6"><input type="text" name="catagory[]" value="'+frm.catagory.value+'" class="form-control"/></div><div class="col-sm-2"><button type="button" class="btn btn-danger" onClick="removeRow('+rowNum+');" ><span class="glyphicon glyphicon-minus"></span> Drop</button></div></div>';
				
			$("#itemRows").after(row);
			frm.catagory.value='';
		
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
		
function chkCatNm(str){
	$.ajax({
		url:"index.php/website/chkCatNm",
		type:"POST",
		data:{d:str},
		success:function(data){
			if(parseInt(data)>0){
				alert("This Category Name already inserted");
				document.getElementById("catagory").value='';
				document.getElementById("catagory").focus();
			}
		}
	});
}

	function valid(){
		if(rowNum<=0){
			alert("Pls add at least one Catagory.");
			return false;
		}else{return true;}
	}

</script>
<aside class="right-side">      <!---rightbar start here --->
        <!-- Content Header (Page header) -->
           <section class="content-header">
                <h1>Create image Catagory<small>Control panel</small></h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
        <div class="row">
			<div class="col-md-11">
                <div class="box">
<!-- success massasge -->
		<?php $this->load->view("website/success"); ?>
<!-- success massasge -->

                    <div class="box-body table-responsive">
					 <form class="form-horizontal" role="form" action="index.php/website/addImgCat" method="post" onsubmit="return valid()">
						<div class="form-group" id="itemRows">
						  <label class="control-label col-sm-2" for="pwd">Catagory Name:</label>
						  <div class="col-sm-6" id="shak_id">          
							<input type="text" name="catagory"  class="form-control" id="catagory" placeholder="Enter Catagory Name" onchange="chkCatNm(this.value)" />
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