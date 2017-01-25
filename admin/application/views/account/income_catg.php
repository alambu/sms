<script type="text/javascript">

// income category start
$(document).ready(function(){
	$('#formid3').submit(function() {
  		$.post(
            "index.php/account/income_catginsert",
            $("#formid3").serialize(),
            function(data){
              if(data==1)
			  {
				 $('#hidemessage').fadeIn('slow').delay(2000).fadeOut('slow');
					setTimeout(function(){	
										
					window.location="index.php/account/student_fee_catg";
					},3000)
			  }			  
			  else{
				  alert(data);
			  }
     	});
 		return false;
 	});
});
function sedittitle(tvalue,rowid,nr){	
    $.ajax({
        url:"index.php/account_edit/edit_billpay_catg",				
        data:{tvalue:tvalue.trim(),feectgid:rowid,uniqid:'id',tabname:'income_catg',cloname:'income_type'},
        type:"POST",
        success:function(data){
			if(data==1){
				document.getElementById("scatgtyp"+nr).style.display="block";
				document.getElementById("scatgtyp"+nr).innerHTML=tvalue.trim();
				document.getElementById("scatgtype"+nr).value=tvalue.trim();
				document.getElementById("scatgtype"+nr).type="hidden";
			}
			else{
				alert(data);
			}
        }
    });
}

// editing function
function sedit(sid){
    document.getElementById("scatgtyp"+sid).style.display="none";
    document.getElementById("scatgtype"+sid).type="text";
    document.getElementById("scatgtype"+sid).focus();
}

// end income category section

</script>


<form class="form-horizontal" role="form" action="" method="post" id="formid3">
	<div class="form-group" id="itemRows">
	  <label class="control-label col-sm-2" for="pwd">Income Name:</label>
	  <div class="col-sm-6" id="shak_id">          
		<input type="text" name="title[]"  class="form-control" id="title" placeholder="Enter Title Name" />
		<!-- onkeypress="return only_chareterNumber(event)" -->
	  </div>
	  <div class="col-sm-2">          
		<button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>Submit</button>
	  </div>
	</div>
</form>
						  
							
<label class="control-label col-sm-12" style="text-align:center;font-size:20px;background:#F3F4F5;height:35px;">List of Income Category</label>
	<table id="example4" class="table table-bordered table-striped">
		<thead>
		
			<tr>
				<th>Nr</th>
				<th>Income Category</th>											
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php $nr=1; 
			$sqlincome=$this->db->query("SELECT * FROM income_catg order by id DESC, income_type ASC")->result();
			foreach($sqlincome as $rowincome){									
				?>
			<tr>
				<td><?php echo $nr++ ?></td>									
				<td>
				<input type="hidden" name="srowid[]" value="<?php echo $rowincome->id;?>" id="srowid<?php echo $nr?>"/>
				<span id="scatgtyp<?php echo $nr; ?>"><?php echo $rowincome->income_type;?></span>
            <input type="hidden" name="title[]" id="scatgtype<?php echo $nr; ?>" value="<?php echo $rowincome->income_type;?>" onkeypress="return only_chareterNumber(event)" onchange="sedittitle(this.value,srowid<?php echo $nr; ?>.value,<?php echo $nr; ?>)" class="form-control" />
				</td>
				<td><button type="reset" id="sedit<?php echo $nr; ?>" value="" class="btn btn-info" id="reset" onclick="sedit(<?php echo $nr;?>)"?><span class="glyphicon glyphicon-edit"></span> Edit</button></td>	
			</tr>
			<?php }?>
		</tbody>
	</table>