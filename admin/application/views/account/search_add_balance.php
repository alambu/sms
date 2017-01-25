<?php 
 $meth=trim($this->input->get('ch'));
 if($meth!=""){
	 $sql_bl=$this->db->select("balance")->from("account_cre")->where("accountid",$meth)->limit(1)->get()->row();
?>
<div class="form-group">
  <label class="control-label col-sm-2" >Total Balance:</label>
  <div class="col-sm-6" >          
	<input type="text" name="tbalance"  class="form-control" id="tbalance" readonly placeholder="Enter Check Number" value="<?php echo $sql_bl->balance?>"/>
  </div>						  
</div>
 <?php } ?>