
<script type="text/javascript">
	window.onload=function() {
    setTimeout(function(){
		$('#s').fadeOut();
		}, 3000);
}
</script>


<style type="text/css">
	#s{
	position: relative;
	margin:0px;
	/*top: 500px;*/
}
</style>



<!-- successful message start-->

<?php if($this->session->userdata("aff")!==false){
	$aff_r=$this->session->userdata("aff");
	$this->session->unset_userdata("aff");
	if($aff_r>0){ ?>
			<div id="s" class="alert alert-success alert-dismissable">
				<i class="fa fa-check"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<b>Successfully Data Saved</b> <?php //echo $in; ?>
			</div>
<!-- successful message end-->

	<?php }
		else if($aff_r==0){
	?>
				<!-- Failed Message -->
			<div id="s" class="alert alert-danger alert-dismissable">
				<i class="fa fa-check"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<b>Failed To Saved Data</b> <?php //echo $in; ?>
			</div>
				<!-- Failed Message -->
	<?php	}} ?>
