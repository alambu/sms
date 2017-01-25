<script type="text/javascript">
<?php 
$in=$this->session->userdata('in');
$dis=$this->session->userdata('dis');

if($in>0 || $dis>0){
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
<?php 
}
elseif($in==1){
?>
<div id="action_report" class="alert alert-danger alert-dismissable">
	<i class="fa fa-ban"></i>
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<b>Setup Fail!</b> <?php //echo $in; ?> Setup is Not Completed Successfully.
</div>

<?php
}
elseif($dis>1){
?>
<div id="action_report" class="alert alert-success alert-dismissable">
	<i class="fa fa-check"></i>
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<b>Distribute</b> <?php //echo $in; ?> Complete Successfully
</div>
<?php 	
}
elseif($dis==1){
?>
<div id="action_report" class="alert alert-danger alert-dismissable">
	<i class="fa fa-ban"></i>
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<b>Distribute Fail!</b> <?php //echo $in; ?> Setup is Not Completed Successfully.
</div>
<?php 	
}
?>
<?php	
$this->session->unset_userdata('in');
$this->session->unset_userdata('dis');
?>