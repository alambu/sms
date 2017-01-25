<style type="text/css">
	table td {
    border-top: none !important;
}
#itemRows tr td{text-align: right;}
#itemRows tr td input,textarea,select{float: left;}

</style>

<script type="text/javascript">
	$(document).ready(function () {                
	    $('#schxmDate').datepicker({format: "yyyy-mm-dd"});            
	});


// check valid exam date
function SchchkDate(str){
    // split date
    var getD=str.split("-");

    // this is for today
    var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yy = today.getFullYear();

    
    // alert(dd);
    // alert(mm);
    // alert(yy);

if(parseInt(getD[0])<parseInt(yy)){ 
    alert("You can't select exam date below schedule date");
$("#schxmDate").val('').datepicker('update');
        // return 0;
    }
else if(parseInt(getD[0])==parseInt(yy) && parseInt(getD[1])<parseInt(mm)){
    alert("You can't select exam date below schedule date");
$("#schxmDate").val('').datepicker('update');
}

else if(parseInt(getD[0])==parseInt(yy) && parseInt(getD[1])==parseInt(mm) && parseInt(getD[2])<parseInt(dd)){
    alert("You can't select exam date below schedule date");
$("#schxmDate").val('').datepicker('update');
}

}

// exam duplicate setting
function checkDuplicateXm( xmid ){
	$.ajax({
		url:'allSubmit/duplicateScheduling',
		type:'POST',
		data:{xid:xmid},
		success:function(data){
			if(parseInt(data)==1){
				alert("This exam already active.To schedule this exam pls close this exam first.");
				document.getElementById("exam_name").value = '';
			}
		}
	});
}

</script>
<!-- <aside class="right-side">
<section class="content-header">
                    <h1>
                        Examination Schedule Settings
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

				<?php $this->load->view("exam/success"); ?>
				
				<div class="panel panel-default" style="margin-top:20px;">

			<!-- <div class="panel-heading"><p id="title">Examination Name Entry</p></div> -->
		  	<div class="panel-body">
		    	<form action="index.php/allSubmit/exm_cat" method="post" class="form-inline">
		    		<div>
		    		<table class="table" id="itemRows">
		    			<tr>
		    				<td>Examination Name :</td>
		    				<td>
		    					<select name="exam_name" id="exam_name" class="form-control" onchange="checkDuplicateXm(this.value)" required style="max-width:350px;min-width:200px;" >
		    					<option value="" >Select</option>
		    				<?php 
		    					$exm=$this->db->select("exmnid,exm_name")->from("exm_namectg")->get()->result();
		    				
		    					foreach ($exm as $key) {
		    						?>
		    				<option value="<?php echo $key->exmnid ?>"><?php echo $key->exm_name ?></option>		
		    			<?php
		    				}
		    			?>
		    				</select>
		    				</td>
		    				<td>Exam Start Date :</td>
		    				<td><input class="form-control" type="text" id="schxmDate" name="exam_date" required placeholder="Date" style="width:150px;" onchange="SchchkDate(this.value)" /></td>
		    			</tr>
		    			<tr>
		    				<td>Comment :</td>
		    				<td>
		    					<textarea class="form-control" rows="3" style="width:200px;" name="comment" ></textarea>
		    				</td>
		    			</tr>
		    		</table>
		    		</div>
		    		<table class="table">
		    			<tr>
		    				<td></td>
		    				<td>
		    					<button type="submit" name="ok" onclick="return valid1();" class="btn btn-primary" style="margin-left:35%;" >
		    						<span class="glyphicon glyphicon-send" aria-hidden="true"> Submit
		    						</span>
		    					</button>
		    					<button type="reset" name="reset" class="btn btn-warning" onclick="resetAll()"  >
		    						<span class="glyphicon glyphicon-refresh" aria-hidden="true"> Reset
		    						</span>
		    					</button>
		    				</td>
		    				<td></td>
		    				<td></td>
		    			</tr>
		    		</table>
				</form>
		 	 </div>
			</div><!-- 
		</div>
	</section>
</aside> -->