<script>
function showTypeAccount(v) {
	if(v!=''){
		if(v==6) {
			document.getElementById("txtResult").style.display="none";
		}
		else {
			document.getElementById("txtResult").style.display="block";
		}
	}
	else {
		document.getElementById("txtResult").style.display="none";
	}
}
</script>
<form class="form-horizontal" role="form" action="" method="post" id="formid">
	<div class="form-group">
		<label class="control-label col-sm-2" >Transfer Type:</label>
		<div class="col-sm-6" >          
			<select class="form-control" onchange="showTypeAccount(this.value);" name="transtype" required>
				<option value="">----select type----</option>
				<option value="6">Cash To Bank</option>
				<option value="7">Bank To Cash</option>
			</select>
		</div>						  
	</div>
	
	<div class="form-group">
		<label class="control-label col-sm-2" >Bank Account:</label>
		<div class="col-sm-6" >          
			<select class="form-control" name="bankaccno">
				<option value="">--Select Account Name--</option>
				<?php 
					$where=array('bank_type'=>2);
					$sqlacc=$this->db->select('*')->from('account_cre')->where($where)->get()->result();										
					foreach($sqlacc as $accidshow){
				?>
				<option value="<?php echo $accidshow->accountid?>"><?php echo $accidshow->acc_name.'('. $accidshow->accountid.')'?></option>
				<?php }?>
			</select>
		</div>						  
	</div>
	
	
	<div id="txtResult" style="display:none;">
		<div class="form-group">
		  <label class="control-label col-sm-2" >Check Number:</label>
		  <div class="col-sm-6" >          
			<input type="text" name="checknunber"  class="form-control" id="checknunber"  placeholder="Enter Check Number " onblur="testdate()"/>
		  </div>						  
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2" >Person Name:</label>
			<div class="col-sm-6" >          
			<input type="text" name="personN" class="form-control" id="personN"  placeholder="Enter Person Name "/>
			</div>              
		</div>
	</div>
	
	<div class="form-group">
		<label class="control-label col-sm-2" >Amount:</label>
		<div class="col-sm-6" >          
			<input type="text" name="amount"  class="form-control" id="openbalance" required placeholder="Enter Amount " onkeypress="return isamountonly(event)"/>
		</div>						  
	</div>
	
	<div class="form-group">
	  <label class="control-label col-sm-2" >Comment:</label>
	  <div class="col-sm-6" >          
		<input type="text" name="comment"  class="form-control" id="openbalance"  placeholder="Enter Your Comment "/>
	  </div>						  
	</div>
	
	<div class="form-group">        
	  <div class="col-sm-offset-2 col-sm-10">
		<button type="submit" name="submit" onclick="return confirm('Are You Sure?');" id="submitbtn" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Submit</button>
		&nbsp;&nbsp;
		<button type="reset" value="" class="btn btn-warning" id="reset"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
	  </div>
	</div>
						
	<div class="form-group">        
	  <div class="col-sm-offset-2 col-sm-10"></div>
	</div>
</form>