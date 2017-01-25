
<!------------------Start Catagory form------------------------------>
			
		    <form class="form-horizontal" action="library_section/book_setup" method="post">
			  
									<div class="form-group">
									  <label class="control-label col-sm-2" for="pwd">Catatory Name:</label>
									  <div class="col-md-4" id="shak_id_1">          
										<select class="form-control" name="catagory" id="catagory" required>
											<option value="">Select Catagory</option>
											<?php 
												$select=$this->db->select("*")->from("book_catg")->get()->result();
												foreach($select as $value){
												?>
												<option <?php if(isset($_POST['len_submit'])){ if($this->input->post('catagory')==$value->bctg_id){ echo "selected"; } } ?> value="<?php echo $value->bctg_id;?>"><?php echo $value->catg_type; ?></option>
												<?php 	
												}
											?>
										</select>
									  </div>
									  <div class="col-md-4">          
										<input type="text" name="len" value="<?php if(isset($_POST['len_submit'])){ echo $this->input->post('len'); }  ?>" class="form-control" placeholder="How Many Book You Want to Store" onkeypress="return checkaccnumber(event);" required/>
									  </div>
									  
									  <div class="col-md-2">          
										<button type="submit" name="len_submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> Send</button>
									  </div>
									</div>
			</form>	
	
	
<!------------------End Catagory form------------------------------>


<!-----------------Start Book Submit Form--------------------------->
<?php
if(isset($_POST['len_submit'])){
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
	var t,bk,wt,qt,pr,fpr;
	t=document.getElementById("len_input").value;
	bk=document.getElementById("bk_"+r).value;
	wt=document.getElementById("wt_"+r).value;
	qt=document.getElementById("qt_"+r).value;
	pr=document.getElementById("pr_"+r).value;
	fpr=document.getElementById("fpr_"+r).value;
	if((bk=='') || (wt=='') || (qt=='') || (pr=='') || ((fpr>100) || (fpr==''))) {
		if(fpr>100) {
			alert('Sorry ! Fine price Maximum 100');
			$("fpr_"+r).addClass('error');
		}
		else {
			$("fpr_"+r).removeClass('error');
		}
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
	var tp,bk,wt,qt,pr,fpr,ctg,msg,n,i,sl,hid_val;
	bk=document.getElementById('bk_'+r).value;
	wt=document.getElementById('wt_'+r).value;
	qt=document.getElementById('qt_'+r).value;
	pr=document.getElementById('pr_'+r).value;
    fpr=document.getElementById('fpr_'+r).value;
    ctg=document.getElementById('ctg').value;
	//alert(hid);
	sl="";
	n=hid.split(",");
	for(i=0;i<n.length;i++){
		if(n[i]!=r){
		sl+=n[i]+",";
		}
	}
	hid_val=sl.slice(0,sl.length-1);
	var d= bk+","+wt+","+qt+","+pr+","+fpr+","+ctg;
	tp='book_list';
	
	var con=confirm('Are You Sure?');
	
	if(con==true){
		
	// start input validation
		msg="";
		if(bk==''){ document.getElementById('bk_'+r).style.borderColor = "red"; msg+='enty error'; }
		else { document.getElementById('bk_'+r).style.borderColor = ""; }
		
		if(wt==''){ document.getElementById('wt_'+r).style.borderColor = "red"; msg+='enty error'; }
		else { document.getElementById('wt_'+r).style.borderColor = "";  }
		if(qt==''){ document.getElementById('qt_'+r).style.borderColor = "red"; msg+='enty error'; }
		else { document.getElementById('qt_'+r).style.borderColor = ""; }
		
		if(pr==''){ document.getElementById('pr_'+r).style.borderColor = "red"; msg+='enty error'; }
		else { document.getElementById('pr_'+r).style.borderColor = "";  }
		
		if(fpr==''){ document.getElementById('fpr_'+r).style.borderColor = "red"; msg+='enty error'; } 
		else {
			if(fpr>100){ alert('Fine Price is Maximum 100'); msg+='enty error'; document.getElementById('fpr_'+r).focus(); }
			else { document.getElementById('fpr_'+r).style.borderColor = ""; }
			}
		
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
			document.getElementById('wt_'+r).disabled=true;
			document.getElementById('qt_'+r).disabled=true;
			document.getElementById('pr_'+r).disabled=true;
			document.getElementById('fpr_'+r).disabled=true;
			document.getElementById("hid_array").value=hid_val;
			}
			else {
				document.getElementById('pic_'+r).style.opacity="0";
				alert('Insert is Fail For Dublicate Book Name');
			}
		}
		
	  });
	   }
	   else {
		   
	   }
	  
    //End insert request by ajax	  
	
	}
}

function form_validation(n){
	//alert(n);
	var bk,wt,qt,pr,fpr,i,j,msg,coutn_row;
	i=0;j=0;msg="";
	coutn_row=n.split(",");
	//alert(coutn_row.length);
	for(i;i<coutn_row.length;i++){
		//alert(coutn_row[i]);
		bk=document.getElementById('bk_'+coutn_row[i]).value;
		wt=document.getElementById('wt_'+coutn_row[i]).value;
		qt=document.getElementById('qt_'+coutn_row[i]).value;
		pr=document.getElementById('pr_'+coutn_row[i]).value;
	    fpr=document.getElementById('fpr_'+coutn_row[i]).value;
		
		if((bk!='') || (wt!='') || (qt!='') || (pr!='') || (fpr!='')){
			if(bk==''){
				document.getElementById('bk_'+coutn_row[i]).style.borderColor = "red"; msg+='enty error';
			}
			else{
				document.getElementById('bk_'+coutn_row[i]).style.borderColor = "";
			}
			if(wt==''){
				document.getElementById('wt_'+coutn_row[i]).style.borderColor = "red"; msg+='enty error';
			}
			else{
				document.getElementById('wt_'+coutn_row[i]).style.borderColor = "";
			}
			if(qt==''){
				document.getElementById('qt_'+coutn_row[i]).style.borderColor = "red"; msg+='enty error';
			}
			else {
				document.getElementById('qt_'+coutn_row[i]).style.borderColor = "";
			}
			if(pr==''){
				document.getElementById('pr_'+coutn_row[i]).style.borderColor = "red"; msg+='enty error';
			}
			else {
				document.getElementById('pr_'+coutn_row[i]).style.borderColor = "";
			}
			if(fpr==''){
				document.getElementById('fpr_'+coutn_row[i]).style.borderColor = "red"; msg+='enty error';
			}
			else {
				document.getElementById('fpr_'+coutn_row[i]).style.borderColor = "";
			}
		}
		else {
			document.getElementById('bk_'+coutn_row[i]).style.borderColor = "";
			document.getElementById('wt_'+coutn_row[i]).style.borderColor = "";
			document.getElementById('qt_'+coutn_row[i]).style.borderColor = "";
			document.getElementById('pr_'+coutn_row[i]).style.borderColor = "";
			document.getElementById('fpr_'+coutn_row[i]).style.borderColor = "";
			j++;
		}
		
	}
	
	if(coutn_row.length==j){
		alert('Sorry! All Field is null');
		return false;
	}
	if((msg=='') && (coutn_row.length!=j)){
		return true;
		
	}
	else {
		return false;
	}
	//return false;
}
</script>
	<div class="row">
        <div class="col-md-12">	
			<form class="form-horizontal" role="form" action="index.php/library_submit/book_list_form" method="post" onsubmit="return form_validation(hid_array.value);">
				
						<table id="frm_tbl" class="table table-hover">
								<tr class="active">
									<!---<td class="center_text">SL.No</td>---->
									<td class="center_text">Book Name</td>
									<td class="center_text">Writter Name</td>
									<td class="center_text">Quantity</td>
									<td class="center_text">Price</td>
									<td class="center_text">Fine(%)</td>
									<td class="">Action</td>
									<input type="hidden" id="ctg" name="catagory" value="<?php echo  $catagory; ?>"/>
									<input type="hidden" id="len_input" name="ds"  value="<?php echo $len; ?>"/>
								</tr>
								
								<?php
									$a=array();
									for($i=1;$i<=$len;$i++){
									array_push($a,$i);	
								?>
								
								<tr id="row_<?php echo $i; ?>" class="warning">
									<td>
										<input type="text" name="book_name[]" class="form-control" onkeypress="return block_space(this.value);" size="30"  id="bk_<?php echo $i; ?>" placeholder="Enter Book Name" onkeyup="inline_validation(<?php echo $i; ?>);"  />	
									</td>

									<td>
										<input type="text" name="writer_name[]" class="form-control" onkeypress="return block_space(this.value);" size="30" id="wt_<?php echo $i; ?>" placeholder="Enter Writer Name" onkeyup="inline_validation(<?php echo $i; ?>);" />	
									</td>
									
									<td>
										<input type="text" name="tquantity[]" class="form-control"  size="4" id="qt_<?php echo $i; ?>" placeholder="Quantity" onkeyup="inline_validation(<?php echo $i; ?>);" onkeypress="return checkaccnumber(event);"/>
										
									</td>
									
									<td>
										<input type="text" name="price[]" class="form-control" size="4" id="pr_<?php echo $i; ?>" placeholder="Price" onkeyup="inline_validation(<?php echo $i; ?>);" onkeypress="return isNumber(event);" />
									
									</td>
									
									<td>
										<input type="text" name="fine_price[]" class="form-control" size="2" id="fpr_<?php echo $i; ?>" placeholder="Fine" onkeyup="inline_validation(<?php echo $i; ?>);" maxlength="3" onkeypress="return checkaccnumber(event);" />
									
									</td>
									<td style="width:120px;">
										<img id="pic_<?php echo $i; ?>" style="opacity:0;" src="img/book_recive.gif"/>
										<button type="button" class="btn btn-success" onclick="inline_insert(<?php echo $i; ?>,hid_array.value);"><span class="glyphicon glyphicon-ok"></span></button>
										<button type="button" class="btn btn-danger" id="btnD_<?php echo $i; ?>" onclick="remove_row(this,<?php echo $i; ?>,hid_array.value);"><span class="glyphicon glyphicon-remove"></span></button>
									</td>
									
								</tr>
								
							<?php }
							//["Banana", "Orange", "Lemon", "Apple", "Mango"]
							// print_r($a);
							foreach($a as $v){
								$array.=$v.",";
							}
							$a=chop($array,",");
							
							?>
								
								<tr>
									
									<td colspan="6" class="center_text">
											<input type="hidden" id="hid_array" value="<?php echo $a;?>"/>	
											<button type="submit" name="submit" onclick="return confirm_reset();" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Submit</button>&nbsp;&nbsp;
											<button type="reset" value="" class="btn btn-warning" id="reset" onclick="return confirm_reset();"><span class="glyphicon glyphicon-refresh"></span>  Reset</button>
									</td>
								</tr>
											  
						  </table>
				 
		  </form>

  
	</div>
	
	
</div>
			  
<!-----------------End  Book Submit Form--------------------------->			
<?php } ?>
<!-- /.right-side -->     <!---rightbar close here ---->