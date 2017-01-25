
<?php 
  $meth = trim($this->input->get('ch'));
    if($meth==2){
?>

<div class="form-group">
  <label class="control-label col-sm-2" >Bank Name:</label>
  <div class="col-sm-6" >          
	<input type="text" name="bankN"  class="form-control" id="bankN" required placeholder="Enter Bank Name" onblur="testdate()"/>
  </div>						  
</div>
<div class="form-group">
  <label class="control-label col-sm-2" >Check Number:</label>
  <div class="col-sm-6" >          
	<input type="text" name="checknunber"  class="form-control" id="checknunber" required placeholder="Enter Check Number " onblur="testdate()"/>
  </div>						  
</div>

<div class="form-group">
  <label class="control-label col-sm-2" >Account ID:</label>
  <div class="col-sm-6" >          
	<input type="text" name="payaccount"  class="form-control" id="payaccount" required placeholder="Enter Pay to Account ID " onblur="testdate()"/>
  </div>						  
</div>

<div class="form-group">
    <label class="control-label col-sm-2" >Person Name:</label>
    <div class="col-sm-6" >          
    <input type="text" name="personN" class="form-control" id="personN" required placeholder="Enter Person Name "/>
    </div>              
</div>

 <?php } ?>