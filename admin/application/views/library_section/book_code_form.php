          <!-- Content Header (Page header) -->
<script type="text/javascript">
	function find_book_name(b_id){
	$.ajax({	
		url: "index.php/library_submit/ajax_request",
		type: 'POST',	
		data:{ctg_id:b_id},	
		success: function(data)
		{	
			document.getElementById('bk_name').innerHTML=data;
		}
		
	 });
	}
</script>

<!------------------Start Searching Book---------------------------->
                    <div class="row" style="margin-bottom:10px;">
                      <div class="col-md-12">
									<form class="form-horizontal" role="form" action="library_section/book_setup" method="post">
										
										<div class="form-group">
												<div class="col-md-1">
												<label for="catg">Catagory:</label>
												</div>
												<div class="col-md-4">
												<select name="catg_name" onchange="find_book_name(this.value);" class="form-control" required>
													<option value="">Select</option>
													<?php 
														$select=$this->db->select("*")->from("book_catg")->get()->result();
														foreach($select as $value){
														?>
														<option <?php if(isset($_POST['submit_view'])){ if($this->input->post('catg_name')==$value->bctg_id) { echo "selected"; } } ?> value="<?php echo $value->bctg_id; ?>"><?php echo $value->catg_type; ?></option>	
														<?php 	
														}
													?>
												</select>	
												</div>
												<div class="col-md-1">
												<label for="bk">Book:</label>
												</div>
												<div class="col-md-4">
												<select name="list_no" id="bk_name" class="form-control" required>
												    <?php 
														if(isset($_POST['submit_view'])){
															$c=$_POST['catg_name'];
															$select=$this->db->query("select * from book_list where bctg_id='$c'")->result();
															foreach($select as $value){
														?>
														<option <?php if($value->blist_id==$_POST['list_no']) { echo "selected"; } ?> value="<?php echo $value->blist_id; ?>">
														<?php  echo $this->db->query("select bookN from book_list where blist_id='$value->blist_id'")->row()->bookN; ?>
														</option>
													<?php 
													}
													}
													else {
													?>
													<option value="">Book</option>
													<?php } ?>
												</select>
												</div>
											<div class="col-md-2">	
											<button type="submit" name="submit_view" class="btn btn-primary">
												<span class="glyphicon glyphicon-send"></span> Send
											</button>
											</div>
										</div>
									</form>					  
					  </div>
					 
                    </div>
					
<!------------------End Searching Book------------------------------>


<!------------------Start Book Submit Form-------------------------------->
					

<?php
if(isset($_POST['submit_view'])){
	extract($_POST);
?>
<style>
.center_text{
	text-align:center;
}
.error{
	border:1px solid red;
}
</style>
<script>
function inline_validation(r) {
	var bk;
	bk=document.getElementById("bk_"+r).value;
	
	if(bk=='') {
		document.getElementById("row_"+r).className ="warning";
	}
	else {
		document.getElementById("row_"+r).className ="success";
	}
}

function remove_row(r,d,hid){
	var s,n,l,sl,con;
	s=hid.split(",");
	n="";
	for(var i=0;i<s.length;i++){
		if(s[i]!=d){
			n+=s[i]+",";
		}
	}
	l=n.length;
    sl= n.slice(0,l-1);
	con=confirm('Are You Sure?');
	if(con==true){
	r.parentNode.parentNode.remove();
	document.getElementById("hid_array").value=sl;
	}
}


function inline_insert(r,hid){
	var tp,bk,lsid,ctgid,msg,n,sl;
	
	bk=document.getElementById('bk_'+r).value;
	lsid=document.getElementById('list_id').value;
	
	var d= bk+","+lsid;
	tp='book_code';
	sl="";
	n=hid.split(",");
	for(i=0;i<n.length;i++){
		if(n[i]!=r){
		sl+=n[i]+",";
		}
	}
	hid_val=sl.slice(0,sl.length-1);
	var con=confirm('Are You Sure?');
	
	if(con==true){
		
	// start input validation
		msg="";
		if(bk==''){ document.getElementById('bk_'+r).style.borderColor = "red"; msg+='enty error'; }
		else { document.getElementById('bk_'+r).style.borderColor = ""; }	
	// End input validation	
	
	//send insert request by ajax
	
	if(msg==""){
	
	$.ajax({
		url: "index.php/library_submit/inline_insert",
		type: 'POST',	
		data:{ins_data:d,typ:tp},
		beforeSend:function()
		{
			document.getElementById('pic_'+r).style.opacity="1";
		},
		success: function(data)
		{		
			if(data==1){
			alert('Data Insert Succussfully');	
			document.getElementById('row_'+r).style.display = "none";
			document.getElementById('bk_'+r).disabled=true;
			document.getElementById("hid_array").value=hid_val;
			}
			else if(data==0){
				alert('Data Insert Fail');	
			}
			else {
				document.getElementById('pic_'+r).style.opacity="0";
				alert('Book ID is Dublicate');
				document.getElementById('bk_'+r).focus();
				//return false; 
			}
		}
		
	  });
	   }
	   else {
		   
	   }
	  
    //End insert request by ajax	  
	
	}
}

//form submit start

$("document").ready(function() {	
 $('#book_form').submit(function() {
   $.post(
    "library_submit/book_code_form",
    $("#book_form").serialize(),
    function(data){
	 var d=data.split("_");
     if(d[0]=='bk')
     {		 
     document.getElementById(data).focus();
	 document.getElementById(data).style.borderColor = "red";
	 }
	 else if(d[0]=='ck') 
	 {
	 document.getElementById("bk_"+d[1]).focus();
	 alert('book code exist');
	 document.getElementById("bk_"+d[1]).style.Color = "red";
	 }
	 else if(data=='ok')
	 {
		 alert('data save successfully');
		 window.location="library_section/book_setup";
	 }
	 else 
	 {
		 alert('data not save');
	 }
   });
  return false;
  });
});

//form submit end
</script>
	<div class="row">
        <div class="col-md-12">	
			<form class="form-horizontal" role="form" action="library_submit/book_code_form" method="post" id="book_form">
						<?php 
						$select=$this->db->query("select * from book_list where bctg_id='$catg_name' and blist_id='$list_no'")->row();
						$total=$this->db->query("select count(bcid) as total from book_code where blist_id='$list_no'")->row()->total;
						$book_num=$select->tquantity-$total;
						if($book_num!=0)
						{	
						?>
						<table id="" class="table table-hover table-condensed">
							
								<tr class="active">
									<td class="center_text">Serial No</td>
									<td class="center_text">Book Name</td>
									<td class="center_text">Writer Name</td>
									<td  class="center_text">Book Code</td>
									<td></td>
									<input type="hidden" id="list_id" name="list_id" value="<?php echo $list_no; ?>"/>
								</tr>
							
							<tbody>	
								<?php	
									$a=array();
									for($i=1;$i<=$book_num;$i++){
									array_push($a,$i);	
								?>
							
								<tr id="row_<?php echo $i; ?>" class="warning">
									<td>
									 <input type="text" class="form-control" disabled size="2" value="<?php echo $i; ?>"/></td>
									<td>
										<input type="text" name="book_name[]" disabled class="form-control" value="<?php echo $select->bookN; ?>" placeholder="Book Name" required/>	
									</td>

									<td>
										<input type="text" name="writer_name[]" disabled class="form-control" placeholder="Enter Writer Name" value="<?php echo $select->writterN; ?>"  required/>	
									</td>
									
									<td>
										<input type="text" name="bk_code[]" class="form-control"  size="4" id="bk_<?php echo $i; ?>" placeholder="Book Code" onkeyup="inline_validation(<?php echo $i; ?>);" onkeypress="return checkaccnumber(event);"/>
										
									</td>
									<td>
									    <img id="pic_<?php echo $i; ?>" style="opacity:0;" src="img/book_recive.gif"/>
										<button type="button" value="<?php echo $i; ?>" onclick="inline_insert(<?php echo $i; ?>,hid_array.value);" class="btn btn-success" ><span class="glyphicon glyphicon-ok"></span></button>
										
										<button type="button" onclick="remove_row(this,<?php echo $i; ?>,hid_array.value);" class="btn btn-danger" ><span class="glyphicon glyphicon-remove"></span></button>
									</td>
									
								</tr>
								
							<?php }
							foreach($a as $v){
								$array.=$v.",";
							}
							$a=chop($array,",");

							?>
							</tbody>
							       		  
						</table>
						<table class="table">
							<tr>
								<input type="hidden" name="hid_array" id="hid_array" value="<?php echo $a;?>"/>
								<td colspan="5" class="center_text">
													
									<button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Submit</button>&nbsp;&nbsp;
									<button type="reset" value="" class="btn btn-warning" id="reset" onclick="return confirm_reset();"><span class="glyphicon glyphicon-refresh"></span>  Reset</button>
								</td>
							</tr>
						</table>
					<?php } else {  ?>
					<center><h3>Book Not Found</h3></center>
					<?php } ?>
		  </form>
		</div>
</div>
		
<?php } ?>

<!-----------------End Book Submit Form--------------------------->