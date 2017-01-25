<!---this is main dynamic content start--> 

<?php

$select=$this->db->select("*")
					->from("about")
					->get()
					->row();

?>
	
		<div class="main_con"><!--Content Start-->
			<div class="row">
				<div class="col-md-9 left_con"><!-- left Content Start--><div class="row">
	<div class="col-md-12"><!-- Welcome Massage Start-->
		<div class="panel panel-primary">
			<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;"><?php echo $select->title; ?> </div>
			<div class="panel-body" style="min-height:770px;">
				<p style="text-align: justify; line-height: 1.6;">
					<img style="width: 350px; height: 200px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -3px 10px 0px 0px;" class="img-responsive" src="admin/img/document/about/<?php echo $select->image ?>" alt="Welcome to" />
					<div style="padding:5px;text-align:justify;line-height:30px;color:black;">
					<p style="text-align: justify;">
					<p style="text-align:justify">
						<?php echo trim($select->details); ?>
					</p>
					
					</div>
				</p>
			</div>
		</div>
	</div><!-- Welcome Massage End-->
</div>
					



				
				
				
				
		
					
		</div><!-- left Content End-->
		
		<!--------------------This is Main Dynamic Content End------------------------------->