<style>
.panel-heading a:after {
    font-family:'Glyphicons Halflings';
    content:"\e114";
    float: right;
    color: black;
}
.panel-heading a.collapsed:after {
    content:"\e080";
}
table tr:hover{
	background:lightblue;
}
table tr:hover {
	background:lightblue !important;
}
</style>
	<?php 
	extract($_GET); 
	$cls=$this->db->query("select * from class_catg where shiftid='$sid'")->result();
	?>
	<div class="panel-group" id="accordion1">
		<?php foreach($cls as $value){  ?>
		<div class="panel panel-success">
			<div class="panel-heading">
			  <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion1" href="#cls_<?php echo $value->classid; ?>">
				 <span class="glyphicon glyphicon-book"></span>  Class <?php echo $value->class_name; ?> All Subject </a>
			  </h4>
			</div>
			
			<div id="cls_<?php echo $value->classid; ?>" class="panel-collapse collapse">
				<?php 
				$sub_info=$this->bsetting->class_wise_subject($value->classid);
				?>
				<div class="panel-body">
				  <table class="table table-condensed table-striped">
						<tr>
							<td>SL</td>
							<td>Subject Name</td>
							<td>Theory Mark</td>
							<td>Objective Mark</td>
							<td>Practical Mark</td>
							<td>Total Mark</td>
							<td>Subject Catagory</td>
							<td>Subject Title</td>
							<td>Action</td>
						</tr>
						<?php $i=1; foreach($sub_info as $value) {  ?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $value->sub_name; ?></td>
							<td><?php echo $value->stherory_mk; ?></td>
							<td><?php echo $value->sobj_mk; ?></td>
							<td><?php echo $value->sprack_mk; ?></td>
							<td><?php echo $value->exm_mark; ?></td>
							<td><?php if($value->groupid!=0) { echo $this->bsetting->selected_group($value->groupid)->group_name; } else { echo "Combine"; } ?></td>
							<td><?php  if($value->optional!=0) { echo "Optional"; } else { echo "NoN-Optional"; } ?></td>
							<td>
								<a href="basic_setting/class_subject_edit?id=<?php echo $value->subjid; ?>"><button type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span></button></a>
								<a onclick="return delete_confirm();" href="setting_submit/class_subject_delete?id=<?php echo $value->subjid; ?>"><button type="button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span></button></a>
							</td>
						</tr>
						<?php } ?>
				  </table>
				</div>
				  
			</div>
			
		</div>
		<?php } ?>
	</div>