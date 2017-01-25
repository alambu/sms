<!-- all php -->
<?php
	$allNtc=$this->db->select("*")->from("notice")->order_by("id","desc")->get()->result();
?>
<!-- all php -->
<!-- script -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#example1").DataTable({
			searching: false
		});
	});
</script>
<!-- script -->
<!--this is main dynamic content start--> 
<div class="main_con"><!--Content Start-->
	<div class="row">
		<div class="col-md-9 left_con"><!-- left Content Start--><div class="row">
			<div class="col-md-12"><!-- Welcome Massage Start-->
				<div class="panel panel-primary">
					<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;"> All Notice </div>
						<div class="panel-body" style="min-height:770px;">
							<table class="table table-striped" id="example1">
								<thead>
									<tr>
										<th>SI</th>
										<th>Publish Date</th>
										<th>Title</th>
										<th>Download</th>
									</tr>
								</thead>
								<tbody>
								<?php $si=0; foreach($allNtc as $al): $si++; ?>
									<tr>
										<td><?php echo $si; ?></td>
										<td><?php echo $al->notice_date; ?></td>
										<td><?php echo $al->title; ?></td>
										<td>
											<a href="">
												<button class="btn btn-primary">Download</button>
											</a>
										</td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>