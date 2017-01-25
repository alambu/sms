<!-- <aside class="right-side"> -->
<style type="text/css">
	#title{
		text-align: center;
		font-size: 16px;
		font-style: italic;
		font-weight: bold;
	}

	table td {
    border-top: none !important;
}

#s{
	position: relative;
	margin:0px;
	/*top: 500px;*/
}

#itemRows3 tr{background: none !important;}
#othxmfo tr{background: none !important;}
</style>


<script type="text/javascript">
var rowNum = 0;
var i=0;

function othXmSet() {
	
	// alert(i);
	rowNum ++;
	var othName=document.getElementById('othName').value;
	if(othName==''){
	   document.getElementById("othName").focus();
	   alert('Empty Examination Name');
	   return false;
	}
	else{
	// var row = '<tr id="rowNum'+rowNum+'"><td></td><td><input type="text" name="othName[]" value="'+frm.othName.value+'" class="form-control" ></td><td><button type="button" class="btn btn-danger" style="margin-left5px;" onClick="removeRow('+rowNum+');"><span class="glyphicon glyphicon-minus" aria-hidden="true"> Drop</span></button></td></tr>';
	// jQuery('#itemRows3').append(row);
	// frm.othName.value = '';
	// i++;
	return true;
}
}


// duplicate other exam name check
function othDupli(st){
	if(st!=''){
	$.ajax({
		url:"index.php/xmAllRequest/othrxm",
		type:"POST",
		data:{d:st},
		success:function(data){
			if(parseInt(data)>0){
				alert("This exam name is already saved.please write down another one.");
				document.getElementById("othName").value='';
				document.getElementById("othName").focus();
			}
		}
	});
}
}

</script>
<!-- <section class="content-header">
                    <h1>
                        Other Examination Name Entry
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>
<section>
<div class="container-fluid">
	<div class="col-md-11"> -->


<!-- success or failed message -->
	<?php $this->load->view("exam/success"); ?>
<!-- success or failed message -->


		<div class="panel panel-info" style="margin-top:20px;">

			<!-- <div class="panel-heading"><p id="title">Examination Name Entry</p></div> -->
		  	<div class="panel-body">
		    	<form action="index.php/allSubmit/otherXmEntry" method="post" class="form-inline">
		    		<div>
		    		<table class="table" id="itemRows3">
		    			<tr>
		    				<td style="text-align:right !important;font-weight:bold;line-height:30px;">Other Examination Name :</td>
		    				<td><input type="text" name="othName" id="othName" onblur="othDupli(this.value)" placeholder="Other Examination Name" class="form-control" style="float:left !important;"></td>
		    				<td>
		    					<button type="submit" name="ok" onclick="return othXmSet();" class="btn btn-primary" >
		    						<span class="glyphicon glyphicon-send" aria-hidden="true"> Submit
		    						</span>
		    					</button>
		    				</td>
		    			</tr>
		    		</table>
		    		</div>
				</form>
		 	 </div>
		</div><!-- 
	</div>		
</div>
</section>
</aside>


 -->