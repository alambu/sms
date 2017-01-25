	
	<link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
	<script>
	var newwindow;
	function details(url)
	{
	newwindow=window.open(url,'name','height=600,width=800,left=300,scrollbars=yes,top=20');
	if (window.focus) {newwindow.focus()}
	} 
	
	function student_log(url)
	{
	newwindow=window.open(url,'name','height=600,width=800,left=300,scrollbars=yes,top=20');
	if (window.focus) {newwindow.focus()}	
	}
	</script>
	<?php extract($_GET); ?>
	<div class="row">
		<div class="col-sm-12">
		<center><p><b>Session:</b> <?php foreach($sinfo as $value) { echo $value->syear; break; } ?> </p>
		<center><p><b>Shift:</b> <?php foreach($sinfo as $value) { echo $value->shift_N; break; } ?> </p>
		<p><b>Total Student:</b> <?php echo number_format(count($sinfo)); ?> </p></center>
		<table id="example1" class="table table-bordered table-striped table-condensed">
			<thead>
				<tr>
					<th>Sl.No</th>
					<th>Student ID</th>
					<th>Student Name</th>
					<th>Class</th>
					<th>Section</th>
					<th>Roll No</th>
					<th>Group</th>
					<th>Picture</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php  $i=1; foreach($sinfo as $value) {
				//echo $value->groupid;
				$grp=$this->bsetting->selected_group($value->groupid)->group_name;
				if($grp=='') { $grp="No Group"; $cls="danger"; } else { $cls="info"; }
				?>
				<tr>
					<td><?php echo $i;?></td>
					<td><?php echo $value->stu_id; ?></td>
					<td><?php echo $value->name; ?></td>
					<td><?php echo ucfirst($value->class_name); ?></td>
					<td><?php echo $this->bsetting->ge_section($value->section)->section_name; ?></td>
					<td><?php echo $value->roll_no; ?></td>
					<td><span class='label label-<?php echo $cls; ?>'><?php echo ucfirst($grp); ?></span></td>
					<td><img src="img/student_section/registration_form/<?php echo $value->picture; ?>" class="img-thumbnail"style="height:50px;width:50px;"/></td>
					
					<td>
						<div class="btn-group">
						  <button type="button" class="btn btn-success">Action</button>
						  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
							<span class="caret"></span>
							<span class="sr-only">Toggle Dropdown</span>
						  </button>
						  <ul class="dropdown-menu" role="menu">
							<li><a href="javascript:void(0);" onclick="details('student_section/registration_details?id=<?php echo $value->stu_id; ?>&class_name=<?php echo $value->classid; ?>&roll_no=<?php echo $value->roll_no; ?>&section=<?php echo $value->section; ?>&session=<?php echo $value->syear; ?>');"><span class="glyphicon glyphicon-list-alt"></span> Details</a></li>
							<li onclick="student_edit(<?php echo $value->stu_id; ?>,'<?php echo $str; ?>');"><a href="javascript:void(0);"><span class="glyphicon glyphicon-edit"></span> Edit</a></li>
							<li class="divider"></li>
							<li><a href="javascript:void(0);" onclick="student_log('student_section/student_log_popup?id=<?php echo $value->stu_id;?>');"><span class="glyphicon glyphicon-repeat"></span> Previus History</a></li>
						  </ul>
						</div>
					</td>
				</tr>
				<?php $i++; } ?>
			</tbody>
		
		</table>
		</div>
	</div>
	
	<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(function() {
			$("#example1").dataTable();
		});
    </script>