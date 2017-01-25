<div class="panel-group" id="accordion">
		<?php  foreach($cls as $value) { ?>
			  <div class="panel panel-success">
				<div class="panel-heading">
				  <h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion" href="#shift_<?php echo $value->classid; ?>">
					<span class="glyphicon glyphicon-hand-right"></span> Class  <?php echo $value->class_name; ?></a>
				  </h4>
				</div>
				<div id="shift_<?php echo $value->classid; ?>" class="panel-collapse collapse">
				
					<div class="panel-body">
						<?php $sec_info=$this->bsetting->section_info($value->classid); ?>
						
						<table class="table table-striped table-condensed">
							
								<tr>
									<th>Section Name</th>
									<th>Group</th>
									<th>Section Action</th>
								</tr>
							
							
							
								<?php 
								foreach($sec_info as $svalue) {
								
								?>
								
								<tr>
									<td> <?php echo $svalue->section_name; ?></td>
									<td><?php echo $this->bsetting->group_explode($svalue->groupid); ?></td>
									<td>
										<a href="setting_submit/section_delete?id=<?php echo $svalue->sectionid; ?>" onclick="return delete_confirm();">
											<button class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete"><span class="glyphicon glyphicon-remove"></span> Remove</button>
										</a>
									</td>
									
								</tr>
								
								<?php 
								} 
								$test=$this->bsetting->class_delete_test($value->classid);
								$dis="";
								if($test>0)
								{
									$dis="disabled";
								}
								?>
								<tr>
									<td colspan="3">
										<center>
										<a href="basic_setting/class_edit?id=<?php echo $value->classid; ?>">
											<button class="btn btn-primary btn-sm"  data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></button>
										</a>
										
										<a href="setting_submit/class_delete?id=<?php echo $value->classid; ?>" onclick="return delete_confirm();">
											<button class="btn btn-danger btn-sm" <?php echo $dis; ?> data-toggle="tooltip" title="Delete"><span class="glyphicon glyphicon-remove"></button></span>
										</a>
										</center>
									</td>
								</tr>
							
						</table>
					</div>
					  
				</div>
			  </div>
		<?php } ?>	  
	</div>