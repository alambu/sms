<?php 
$meth=trim($this->input->get('ch'));
 if($meth==2){?>

<div class="form-group">
  <label class="control-label col-sm-2" >Check Number:</label>
  <div class="col-sm-6" >          
	<input type="text" name="checknunber"  class="form-control" id="checknunber" required placeholder="Enter Check Number " onblur="testdate()"/>
  </div>						  
</div>

<div class="form-group">
  <label class="control-label col-sm-2" >Pay Person:</label>
  <div class="col-sm-6" >          
	<input type="text" name="payperson"  class="form-control" id="payperson" required placeholder="Enter Pay to Order Person " onblur="testdate()"/>
  </div>						  
</div>

 <?php } ?>