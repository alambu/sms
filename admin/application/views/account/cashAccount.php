<form class="form-horizontal" role="form" action="" method="post" id="formid">
	<div class="form-group">
	  <label class="control-label col-sm-2" for="pwd">Account Number:</label>
	  <div class="col-sm-6" >          
		<input type="hidden" name="type" value="1" />
		<input type="text" name="accnumber"  class="form-control" id="accnumber" onkeypress="return isNumber(event)" required placeholder="Enter Account Number"/>
	  </div>						  
	</div>
	<div class="form-group">
	  <label class="control-label col-sm-2" for="pwd">Account Name:</label>
	  <div class="col-sm-6" >          
		<input type="text" name="accname"  class="form-control" id="accname" required placeholder="Enter Account Name"/>
	  </div>						  
	</div>
	<div class="form-group">
	  <label class="control-label col-sm-2" for="pwd">Opening Balance:</label>
	  <div class="col-sm-6" >          
		<input type="text" name="openbalance"  class="form-control" id="openbalance" required placeholder="Enter Amount Name" onkeypress="return isamountonly(event)"/>
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
	  <div class="col-sm-offset-2 col-sm-10">
		
	  </div>
	</div>
</form>