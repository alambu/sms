
	
<!-- some information query -->
<?php
// school profile
	$schnm=$this->db->select("*")->from("sprofile")->order_by("id","desc")->limit(1)->get()->row();
	// welcome message
	$msg=$this->db->select("*")->from("welcome_message")->order_by("id","desc")->limit(1)->get()->row();
	// principal message
	$prcl=$this->db->select("*")->from("principal_message")->order_by("id","desc")->limit(1)->get()->row();
	// vice principal message
	$vc=$this->db->select("*")->from("vice_principal_message")->order_by("id","desc")->limit(1)->get()->row();

?>
<!-- some information query -->

<div class="main_con"><!--Content Start-->
	<div class="row">
		<div class="col-md-9 left_con"><!-- left Content Start--><div class="row">
	<div class="col-md-12"><!-- Welcome Massage Start-->
		<div class="panel panel-primary">
			<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;">Welcome to <?php echo $schnm->schoolN; ?> </div>
			<div class="panel-body" style="min-height:250px;">
				<p style="text-align: justify;">
					<img style="width: 250px; height: 200px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -3px 10px 0px 0px;" class="img-thumbnail" src="admin/message/welcome/<?php echo $msg->image ?>" alt="Welcome to" />
					<div style="padding:5px;text-align:justify;line-height:30px;color:black;">
					
					<p style="text-align: justify;">
						<?php
						 	echo substr($msg->details, 0,400);
						 ?>
						 <a href="index.php/home/details?t=w" style="font-weight:bold;">....more read</a>
					</p>
					</div>
				</p>
			</div>
		</div>
		<!-- principal message -->
<div class="col-md-6">
	<div class="panel panel-primary">
		<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;"> <?php echo $prcl->title ?> </div>
			<div class="panel-body">
				<p style="text-align: justify;">
					<img style="width: 150px; height: 130px;  float: left; border: 1px solid #EDEDED; padding: 5px; margin: -3px 10px 0px 0px;" class="img-responsive" src="admin/message/principal/<?php echo $prcl->image ?>" alt="Welcome to" />
					<div style="padding:5px;text-align:justify;line-height:30px;color:black;">
					
					<p style="text-align: justify;">
						<?php
						 	echo substr($prcl->details, 0,400);
						 ?>
						 <a href="index.php/home/details?t=p" style="font-weight:bold;">....more read</a>
					</p>
					</div>
				</p>
			</div>
		</div>
	</div>
	<!-- vice principal message -->
	<div class="col-md-6">
		<div class="panel panel-primary">
		<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;"><?php echo $vc->title; ?> </div>
			<div class="panel-body">
				<p style="text-align: justify;">
					<img style="width: 150px; height: 130px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -3px 10px 0px 0px;" class="img-responsive" src="admin/message/vice_principal/<?php echo $vc->image ?>" alt="Welcome to" />
					<div style="padding:5px;text-align:justify;line-height:30px;color:black;">
					
					<p style="text-align: justify;">
						<?php
						 	echo substr($vc->details, 0,400);
						 ?>
						 <a href="index.php/home/details?t=v" style="font-weight:bold;">....more read</a>
					</p>
					
					</div>
				</p>
			</div>
		</div>
	</div>
	<!-- vice principal message -->
	</div><!-- Welcome Massage End-->
</div>
</div><!-- left Content End-->