<script type="text/javascript">
<?php 
$in=$this->session->userdata('in');
$reg_in=$this->session->userdata('reg_in');
$att_in=$this->session->userdata('att_in');
$up=$this->session->userdata('up');
$att_up=$this->session->userdata('att_up');
$reg_up=$this->session->userdata('reg_up');

if($in>0 || $reg_in>0 || $att_in>0 || $up>0 || $att_up>0 || $reg_up>0){
?>
document.onreadystatechange = function(){
     if(document.readyState === 'complete'){
         //setTimeout(function(){ $("#action_report").slideDown(1000); }, 1000);
		 setTimeout(function(){ $("#action_report").fadeOut(); }, 5000);
     }
}
<?php } ?>
</script>
<?php if($in>1){ ?>
<div id="action_report" class="alert alert-success alert-dismissable">
	<i class="fa fa-check"></i>
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<b>Setup</b> <?php //echo $in; ?> Complete Successfully
</div>
<?php } elseif($in==1) {  ?>
<div id="action_report" class="alert alert-danger alert-dismissable">
	<i class="fa fa-ban"></i>
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<b>Setup Fail!</b> <?php //echo $in; ?> Setup is Not Completed Successfully.
</div>

<?php }
elseif($reg_in>1){
?>
<div id="action_report" class="alert alert-success alert-dismissable">
	<i class="fa fa-check"></i>
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<b>Registration</b> <?php //echo $in; ?> Complete Successfully
</div>
<?php 	
}
elseif($reg_in==1){
?>
<div id="action_report" class="alert alert-danger alert-dismissable">
	<i class="fa fa-ban"></i>
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<b>Registration Fail!</b> <?php //echo $in; ?> Setup is Not Completed Successfully.
</div>
<?php 	
}
elseif($reg_up==1){
?>
<div id="action_report" class="alert alert-danger alert-dismissable">
	<i class="fa fa-ban"></i>
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<b>Registration Fail!</b> <?php //echo $in; ?> Setup is Not Completed Successfully.
</div>	
<?php 	
}
elseif($att_in>1){
?>
<div id="action_report" class="alert alert-success alert-dismissable">
	<i class="fa fa-check"></i>
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<b>Attendance</b> <?php //echo $in; ?> Complete Successfully
</div>	
<?php 	
}
elseif($att_in==1){
?>	
<div id="action_report" class="alert alert-danger alert-dismissable">
	<i class="fa fa-ban"></i>
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<b>Attendance Fail!</b> <?php //echo $in; ?> Setup is Not Completed Successfully.
</div>
<?php	
}
elseif($up>1){
?>
<div id="action_report" class="alert alert-success alert-dismissable">
	<i class="fa fa-check"></i>
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<b>Update</b> <?php //echo $in; ?> Complete Successfully
</div>	
<?php 	
}
elseif($up==1){
?>	
<div id="action_report" class="alert alert-danger alert-dismissable">
	<i class="fa fa-ban"></i>
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<b>Update Fail!</b> <?php //echo $in; ?> Setup is Not Completed Successfully.
</div>
<?php	
}

elseif($att_up>1){
?>
<div id="action_report" class="alert alert-success alert-dismissable">
	<i class="fa fa-check"></i>
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<b>Attendance Update</b> <?php //echo $in; ?> Complete Successfully
</div>	
<?php 	
}
elseif($att_up==1){
?>	
<div id="action_report" class="alert alert-danger alert-dismissable">
	<i class="fa fa-ban"></i>
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<b>Attendance Update Fail!</b> <?php //echo $in; ?> Setup is Not Completed Successfully.
</div>
<?php	
}
 
$this->session->unset_userdata('in');
$this->session->unset_userdata('reg_in');
$this->session->unset_userdata('att_in');
$this->session->unset_userdata('up');
$this->session->unset_userdata('att_up');
$this->session->unset_userdata('reg_up');
?>