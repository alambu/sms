<!-- all query here -->

<!-- all query here -->
<script type="text/javascript">
	$(document).ready(function(){
    $('#example1').DataTable({
    	"bFilter": false,
    	"bPaginate":false
    });
});	
</script>
<!--this is main dynamic content start--> 	
<div class="main_con"><!--Content Start-->
	<div class="row">
		<div class="col-md-9 left_con"><!-- left Content Start--><div class="row">
			<div class="col-md-12"><!-- Welcome Massage Start-->
				<div class="panel panel-primary">
					<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;"> Vacancy Information </div>
					<div class="panel-body" style="min-height:770px;">
						<table class="table table-hover" id="example1">
							<thead>
									<tr>
									<th>Serial No</th>
									<th>Designation</th>
									<th>Total Post</th>
									<th>Present Employee</th>
									<th>Vacancy</th>
									</tr>
								</thead>
								<tbody>
									<?php
									
								$select=$this->db->select("*")
									->from("employee_catg")
									->get()
									->result();
									$vid=1;
									foreach($select as $value){
									?>
									<tr>
									<td><?php  echo $vid++; ?></td>
									<td><?php echo $value->emp_type ; ?></td>
							        <td><?php  echo $value->need_emp; ?></td>
									<td><?php echo $pre=$this->db->query("select count(empid) as pre_emp from empee where deginition='$value->ecatgid' and status='1' ")->row()->pre_emp; ?></td>
									<td>
									
									<?php echo $value->need_emp-$pre; ?>
									</td>
									
									<?php } ?>
									</tr>
								</tbody>
								
						</table>
					</div>
				</div>
			</div><!-- Welcome Massage End-->
		</div>
	</div><!-- left Content End-->