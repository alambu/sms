
<style type="text/css">
	#title{
		text-align: center;
		font-size: 20px;
		font-style: italic;
	}

	table td {
    border-top: none !important;
}

#s{
	position: relative;
	margin:0px;
	/*top: 500px;*/
}

</style>


<script type="text/javascript">

function xmSub() {
	
	var exam_name=document.getElementById('exam_name').value;
	if(exam_name==''){
	   alert('Empty Examination Name');
	   document.getElementById("exam_name").focus();
	   return false;
	}
	else{
	// var row = '<tr id="rowNum'+rowNum+'"><td></td><td><input type="text" name="exam_name[]" value="'+frm.exam_name.value+'" class="form-control" ></td><td><button type="button" class="btn btn-danger" style="margin-left5px;" onClick="removeRow('+rowNum+');"><span class="glyphicon glyphicon-minus" aria-hidden="true"> Drop</span></button></td></tr>';
	// jQuery('#itemRows').append(row);
	// frm.exam_name.value = '';
	// i++;
	return true;
}
}


window.onload=function() {
    setTimeout(function(){ document.getElementById('s').style.display = 'none' }, 3000);
}

// this is for check duplicate value
function duplicate(str){
	$.ajax({
		url:"index.php/xmAllRequest/duplicate",
		type:"POST",
		data:{val:str},
		success:function(data){
			if(parseInt(data)>0){
				alert("This exam name already inserted.please insert another one.");
				document.getElementById("exam_name").value='';
				document.getElementById("exam_name").focus();
			}
		}
	});
}
</script>
<!-- <section class="content-header">
                    <h1>
                        Examination Name Entry
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>
<section>
<div class="container-fluid">
	<div class="col-md-11">-->
<?php $this->load->view("exam/success"); ?> 

		<div class="panel panel-default" style="margin-top:10px;">
		  	<div class="panel-body">
		    	<form action="index.php/allSubmit/exm_name" method="post" class="form-inline" onsubmit="return xmSub()">
		    		<div>
		    		<table class="table" id="itemRows">
		    			<tr style="background:none !important;">
		    				<td style="text-align:right !important;line-height:30px;font-weight:bold;">Examination Name :</td>
		    				<td><input type="text" name="exam_name" id="exam_name" placeholder="Examination Name" class="form-control" onblur="duplicate(this.value)"></td>
		    				<td>
		    					<button type="submit" name="okxm"  class="btn btn-primary" >
		    						<span class="glyphicon glyphicon-send" aria-hidden="true"> Submit
		    						</span>
		    					</button>
		    				</td>
		    			</tr>
		    		</table>
		    		</div>
				</form>
		 	</div> 
		</div> <!--
	</div>		
</div>
</section>
</aside>


 -->