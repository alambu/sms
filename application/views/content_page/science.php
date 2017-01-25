<!---this is main dynamic content start--> 
<?php
	if(isset($_GET['id'])){
		 $id=$_GET['id']; 
		$select=$this->db->select("*")->from("department")->where('id',$id)->get()->row(); 
	}
?>	
<div class="main_con"><!--Content Start-->
	<div class="row">
		<div class="col-md-9 left_con"><!-- left Content Start-->
			<div class="row">
				<div class="col-md-12"><!-- Welcome Massage Start-->
					<div class="panel panel-primary">
						<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;"> <?php echo $select->department_name; ?> </div>
						<div class="panel-body" style="min-height:770px;">
							<p style="text-align: justify; line-height: 1.6;">
								<img style="width: 350px; height: 200px; float: left; border: 1px solid #EDEDED; padding: 5px; margin: -3px 10px 0px 0px;" class="img-responsive" src="admin/img/document/department/<?php echo $select->image ?>" alt="Welcome to" />
								<div style="padding:5px;text-align:justify;line-height:30px;color:black;">
								<p style="text-align: justify;">
									<?php echo $select->details; ?>
								</p>
								
								</div>
							</p>
						</div>
					</div>
				</div><!-- Welcome Massage End-->
			</div>
		</div><!-- left Content End-->