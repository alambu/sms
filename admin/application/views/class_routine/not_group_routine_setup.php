<form action="routine_submit/routine_not_group_create" method="post" id="routine_not_group_create<?php echo $i; ?>" onsubmit="return routine_not_group_create(<?php echo $i; ?>);">
					
					    <table class="table table-condensed table-striped">
							<?php foreach($days as $dkey=>$dvalue) { ?>
							<tr><td colspan="4">
								<center><h4><?php echo $dvalue; ?></h4></center>
								<input type="hidden" name="day[]" value="<?php echo $dkey; ?>"/>
								<input type="hidden" name="total_period" value="<?php echo $total_period; ?>"/>
								</td>
							</tr>
							<tr>
								<td>Number Of Period</td>
								<td>Period</td>
								
								<td>Subject</td>
								<td>Teacher</td>
							</tr>
							<?php $j=1; foreach($shidule as $svalue) {   ?>
							<tr>
								<td><?php echo $j." th"; ?>
								<?php if($dkey<2) { ?>
								<input type="hidden" name="year" value="<?php echo $year; ?>"/>
								<input type="hidden" name="shift" value="<?php echo $sft; ?>"/>
								<input type="hidden" name="cls" value="<?php echo $cls; ?>"/>
								<input type="hidden" name="section" value="<?php echo $value->sectionid; ?>"/>
								<input type="hidden" name="shidule_id[]" value="<?php echo $svalue->shidule_id?>"/>
								<?php } ?>
								<input type="hidden" name="period_title[]" value="<?php echo $svalue->period_title?>"/>
								</td>
								<?php if($svalue->period_title>0) { $display="block"; $break=""; }  else { $break="Break"; $display="none"; }  ?>
								<td style="color:#3C8DBC;font-weight:bold;">
									
									<?php echo date("H:i:A",strtotime($svalue->stime)); ?>  &nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-right"></span>&nbsp;&nbsp;  <?php echo date("H:i:A",strtotime($svalue->etime)); ?>
								</td>
								
								<td>
									<?php echo $break; ?>
									<select name="subject[]" class="form-control" style="display:<?php echo $display;?>;">
										<option value="">Select Subject</option>
										<?php foreach($subject as $subvalue) { ?>
										<option value="<?php echo $subvalue->subjid; ?>"><?php echo $subvalue->sub_name; ?></option>
										<?php } ?>
									</select>
								</td>
								<td>
									<?php echo $break; ?>
									<select name="teacher[]" class="form-control" style="display:<?php echo $display;?>;">
										<?php if(($j==1) && ($dkey<7)) { ?> 
										<option value="<?php echo $cls_teacher->empid; ?>"><?php echo $cls_tech_info->name."( ".$cls_tech_info->nickN." )"; ?></option> <?php  }  else { ?>
										<option  value="">Select Teacher</option>
										
										<?php foreach($teacher as $tvalue) { ?>
										<option value="<?php echo $tvalue->empid; ?>"><?php echo $tvalue->name." ( ".$tvalue->nickN." )"; ?></option>
										<?php } ?>
										<?php } ?>
									</select>
								</td>
							</tr>
							<?php if($total_period==$j) { break; } $j++; } } ?>
							<tr><td colspan="4"><button type="submit" name="submit" class="btn btn-primary btn-sm" id="routine_not_group_submit<?php echo $i; ?>">Save</button><?php  ?></td></tr>
					    </table>
						
					</form>