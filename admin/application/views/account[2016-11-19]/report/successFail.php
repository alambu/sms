
<script type="text/javascript">
	document.onreadystatechange = function(){
     if(document.readyState === 'complete'){
         //setTimeout(function(){ $("#action_report").slideDown(1000); }, 1000);
   setTimeout(function(){ $("#action_report").fadeOut(); }, 5000);
     }
}
</script>

<!-- successful message start-->

<?php if($this->session->userdata("aff")!==false){
	$aff_r=$this->session->userdata("aff");
	$this->session->unset_userdata("aff");
	if($aff_r>0){ ?>
		<div id="action_report" class="alert alert-success alert-dismissable">
			<i class="fa fa-check"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
 			Successfully Data modified
		</div>
<!-- successful message end-->

	<?php }
		else if($aff_r==0){
	?>
				<!-- Failed Message -->
					<div id="action_report" class="alert alert-danger alert-dismissable">
						<i class="fa fa-ban"></i>
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
 						Fail to modify Data
					</div>
				<!-- Failed Message -->
	<?php	} } ?>
