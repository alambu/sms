<!-- php -->
<?php
	$ac=$this->db->select("*")->from("academic_cal")->order_by("id","desc")->get()->result();
?>
<!-- php -->
<!-- script -->
<script type="text/javascript">
	$(document).ready(function(){
    $('#example1').DataTable({
    	"bFilter":false,
    	"bPaginate":false
    });
});	
</script>
<!-- script -->
<div class="main_con"><!--Content Start-->
	<div class="row">
		<div class="col-md-9 left_con"><!-- left Content Start--><div class="row">
			<div class="col-md-12"><!-- Welcome Massage Start-->
				<div class="panel panel-primary">
					<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;">Academic Calender</div>
					<div class="panel-body" style="min-height:770px;">
						<table class="table" id="example1">
							<thead>
								<tr>
									<th>SI</th>
									<th>Publish Date</th>
									<th>Title</th>
									<th>Download</th>
								</tr>
							</thead>
							<tbody>
							<?php $si=0; foreach($ac as $a):$si++; ?>
								<tr>
									<td><?php echo $si; ?></td>
									<td><?php echo $a->edate ?></td>
									<td><?php echo $a->title ?></td>
									<td>
										<a href="index.php/home/dwnlFl?t=c&d=<?php echo $a->pdf_details ?>">
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