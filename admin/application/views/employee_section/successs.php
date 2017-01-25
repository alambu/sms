
<script type="text/javascript">
	window.onload=function() {
    setTimeout(function(){ document.getElementById('s').style.display = 'none' }, 3000);
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
			<div class="col-md-12" style="min-height:50px;">
			<div class="alert alert-success" id="s" role="alert" style="margin-top:10px;margin-bottom:0px;">
				   Data Update Successfully
			</div>
			</div>
<!-- successful message end-->

	<?php }
		else if($aff_r==0){
	?>
				<!-- Failed Message -->
					<div class="col-md-12" style="min-height:50px;">
							<div class="alert alert-warning" id="s" role="alert" style="margin-top:10px;margin-bottom:0px;">
								  Failed to save data
							</div>
					</div>
				<!-- Failed Message -->
	<?php	}} ?>
