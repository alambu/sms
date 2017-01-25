<!-- all query here -->
<?php
	$rule=$this->db->select("*")->from("rules")->order_by("id","desc")->limit(1)->get()->row();
?>
<!-- all query here -->

<!--this is main dynamic content start--> 	
<div class="main_con"><!--Content Start-->
	<div class="row">
		<div class="col-md-9 left_con"><!-- left Content Start--><div class="row">
			<div class="col-md-12"><!-- Welcome Massage Start-->
				<div class="panel panel-primary">
					<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;"> <?php echo $rule->title; ?> </div>
					<div class="panel-body" style="min-height:770px;">
						<p style="text-align: justify; line-height: 1.6;">
							<div style="padding:5px;text-align:justify;line-height:30px;color:black;">
							<p style="text-align: justify;">
								<?php echo $rule->details; ?>
							</p>
							</div>
						</p>
					</div>
				</div>
			</div><!-- Welcome Massage End-->
		</div>
					



				
				
				
				
		
					
		</div><!-- left Content End-->
		
		<!--------------------This is Main Dynamic Content End------------------------------->