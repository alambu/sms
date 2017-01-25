<script type="text/javascript">
	$(document).ready(function(){
	$('#formid4').submit(function() {
  		$.post(
            "index.php/account/expanse_catginsert",
            $("#formid4").serialize(),
            function(data){
              if(data==1)
			  {
				  //$("#hidemessage").show(); 
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

function tedittitle(tvalue,rowid,nr){	
    $.ajax({
        url:"index.php/account_edit/edit_billpay_catg",				
        data:{tvalue:tvalue.trim(),feectgid:rowid,uniqid:'id',tabname:'expance_catg',cloname:'expance_type'},
        type:"POST",
        success:function(data){
			if(data==1){
				document.getElementById("tcatgtyp"+nr).style.display="block";
				document.getElementById("tcatgtyp"+nr).innerHTML=tvalue.trim();
				document.getElementById("tcatgtype"+nr).value=tvalue.trim();
				document.getElementById("tcatgtype"+nr).type="hidden";
			}
			else{
				alert(data);
			}
        }
    });
}

// editing function
function tedit(sid){
    document.getElementById("tcatgtyp"+sid).style.display="none";
    document.getElementById("tcatgtype"+sid).type="text";
    document.getElementById("tcatgtype"+sid).focus();
}

</script>


<form class="form-horizontal" role="form" action="index.php/account/expanse_catginsert" method="post" id="formid4">
	<div class="form-group" id="itemRows">
	  <label class="control-label col-sm-2" for="pwd">Expense Name:</label>
	  <div class="col-sm-6" id="shak_id">          
		<input type="text" name="title[]"  class="form-control" id="title" placeholder="Enter Title Name" />
		<!-- onkeypress="return only_chareterNumber(event)" -->
	  </div>
	  <div class="col-sm-2">          
		<button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Submit</button>
	  </div>
	</div>												
</form>

<label class="control-label col-sm-12" style="text-align:center;font-size:20px;background:#F3F4F5;height:35px;">List of Expense Category</label>
	<table id="example5" class="table table-bordered table-striped">
		<thead>
		
			<tr>
				<th>Nr</th>
				<th>Expense Category</th>																		
				<th>Action</th>
			</tr>
		</thead>
			<tbody>
				<?php $nr=1; 
				$sqlexpanse=$this->db->query("SELECT * FROM expance_catg order by id DESC,expance_type ASC")->result();
				foreach($sqlexpanse as $rowexpanse){									
					?>
				<tr>
					<td><?php echo $nr++ ?></td>									
					<td>
					<input type="hidden" name="trowid[]" value="<?php echo $rowexpanse->id;?>" id="trowid<?php echo $nr?>"/>
					<span id="tcatgtyp<?php echo $nr; ?>"><?php echo $rowexpanse->expance_type;?></span>
                <input type="hidden" name="title[]" id="tcatgtype<?php echo $nr; ?>" value="<?php echo $rowexpanse->expance_type;?>" onkeypress="return only_chareterNumber(event)" onchange="tedittitle(this.value,trowid<?php echo $nr; ?>.value,<?php echo $nr; ?>)" class="form-control" />
					</td>
					<td><button type="reset" id="tedit<?php echo $nr; ?>" value="" class="btn btn-info" id="reset" onclick="tedit(<?php echo $nr;?>)"?><span class="glyphicon glyphicon-edit"></span> Edit</button></td>	
				</tr>
				<?php }?>
			</tbody>
		</table>