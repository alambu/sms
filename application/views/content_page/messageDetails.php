<?php
	if($mtype=="w"):
		$f="welcome_message";
		$fld="welcome";
	elseif($mtype=='v'):
		$f="vice_principal_message";
		$fld="vice_principal";
	elseif($mtype=='p'):
		$f="principal_message";
		$fld="principal";
	endif;
	// query
	$msg=$this->db->select("*")->from($f)->order_by("id","desc")->limit(1)->get()->row();
?>


<div class="main_con"><!--Content Start-->
	<div class="row">
		<div class="col-md-9 left_con"><!-- left Content Start--><div class="row">
			<div class="col-md-12"><!-- Welcome Massage Start-->
				<div class="panel panel-primary">
					<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;"><?php echo $title; ?></div>
						<div class="panel-body" style="min-height:770px;">
							<p style="text-align: justify;">
									<img style="width: 250px; height: 200px;  float: left; border: 1px solid #EDEDED; padding: 5px; margin: -3px 10px 0px 0px;" class="img-responsive" src="admin/message/<?php echo $fld; ?>/<?php echo $msg->image ?>" alt="Welcome to" />
								<div style="padding:5px;text-align:justify;line-height:30px;color:black;">
					
									<p style="text-align: justify;">
										<?php
										 	echo $msg->details;
										 ?>
									</p>

					
								</div>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>