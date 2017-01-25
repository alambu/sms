<!-- -this is main dynamic content start-->
	
<!-- all query are here -->
<?php
	$allXm=$this->db->select("*")->from("exm_routine")->group_by("exm_ctgid")->order_by("id","desc")->get()->result();
?>
<!-- all query are here -->

<div class="main_con"><!--Content Start-->
	<div class="row">
		<div class="col-md-9 left_con"><!-- left Content Start-->
			<div class="row">
				<div class="col-md-12"><!-- Welcome Massage Start-->
					<div class="panel panel-primary">
						<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;">  Exam Routine</div>
						<div class="panel-body" style="min-height:770px;">
							<div class="table-responsive">
								<table class="table" id="example1">
									<thead>
										<tr>
											<th>SI</th>
											<th>Exam Name</th>
											<th>Publish Date</th>
											<th>View</th>
										</tr>
									</thead>
									<tbody>
									<?php
										 $si=0;foreach($allXm as $ax):$si++;
										 $q=$this->db->query("SELECT * FROM `exm_namectg` WHERE `exmnid`=(select `exmnid` from exm_catg where exm_ctgid=$ax->exm_ctgid)")->row();
										 $pd=explode(" ", $ax->e_date);
									 ?>
										<tr>
											<td><?php echo $si ?></td>
											<td><?php echo $q->exm_name ?></td>
											<td><?php echo $pd[0] ?></td>
											<td>
												<a href="index.php/home/xmR?ok=<?php echo $ax->exm_ctgid ?>">
													<button class="btn btn-primary">View</button>
												</a>
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div><!-- Welcome Massage End-->
			</div>
		</div><!-- left Content End