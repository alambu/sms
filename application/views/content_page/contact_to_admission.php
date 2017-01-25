<!------this is main dynamic content start-------------------------------> 
<?php

$select=$this->db->select("*")
					->from("contact_admission")
					->get()
					->row();

?>
	
		<div class="main_con"><!--Content Start-->
			<div class="row">
				<div class="col-md-9 left_con"><!-- left Content Start--><div class="row">
	<div class="col-md-12"><!-- Welcome Massage Start-->
		<div class="panel panel-primary">
			<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;"> <?php echo $select->title;?></div>
			<div class="panel-body" style="min-height:770px;">
				<p style="align:justify;"> <?php echo $select->details; ?></p>
			</div>
		</div>
	</div><!-- Welcome Massage End-->
</div>
					



				
				
				
				
		
					
		</div><!-- left Content End-->
		
		<!--------------------This is Main Dynamic Content End------------------------------->