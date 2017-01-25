<form class="form-horizontal" role="form" action="" method="post" id="formid">
	<div class="form-group">
		<label class="control-label col-sm-2" >Account Name:</label>
		<div class="col-sm-6" >          
			<select class="form-control" name="accnumber" required>
				<option value="">--Select Account Name--</option>
				<?php 
					$sqlacc=$this->db->select('*')->from('account_cre')->get()->result();										
					foreach($sqlacc as $accidshow){
				?>
				<option value="<?php echo $accidshow->accountid?>"><?php echo $accidshow->acc_name.'('. $accidshow->accountid.')'?></option>
				<?php }?>
			</select>
		</div>						  
	</div>
	
	<div class="form-group">
		<label class="control-label col-sm-2" >Income Category:</label>
		<div class="col-sm-6" >          
			<select class="form-control" name="incomecatg" required onchange="testing()">
				<option value="">--Select Category--</option>
				<?php 
					$sqlctg=$this->db->select('*')->from('income_catg')->get()->result();					
					foreach($sqlctg as $expctg){
				?>
					<option value="<?php echo trim($expctg->id)?>"><?php echo $expctg->income_type?>
					</option>
				<?php } ?>
			</select>
		</div>						  
	</div>
	
	<div class="form-group">
		<label class="control-label col-sm-2" >Method:</label>
		<div class="col-sm-6" >          
			<select class="form-control" name="method" id="method" onchange="htmlData('index.php/account/extincome_checksohow','ch='+this.value)" required>
					<option value="">Please Select--</option>
					<option value="1">Cash</option>
					<option value="2">Check</option>
			</select>
		</div>						  
	</div>
	
	<div id="txtResult"></div>
	
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
		<button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Submit</button>
		&nbsp;&nbsp;
		<button type="reset" value="" class="btn btn-warning" id="reset"><span class="glyphicon glyphicon-refresh"></span> Reset</button>
	  </div>
	</div>
						
	<div class="form-group">        
	  <div class="col-sm-offset-2 col-sm-10"></div>
	</div>
</form>