<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Student Notice
			<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol>
	</section>

                <!-- Main content -->
	<section class="content">
		<?php $notice=$this->stu_parensts->notice(); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading"><center>Notice</center></div>
					<div class="panel-body">
						<table id="example1" class="table table-striped table-bordered table-condensed">
							<thead>
								<tr>
									<th>SL.No</th>
									<th>Title</th>
									<th>Details</th>
									<th>Publish Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1; foreach($notice as $value){ ?>
								<tr>
									<td><?php echo $i++; ?></td>
									<td><?php echo $value->title; ?></td>
									<td><?php echo $value->pdf_details; ?></td>
									<td><?php echo $value->notice_date; ?></td>
									<td>
									<a href="index.php/student/dwnlFl?t=n&d=<?php echo $value->pdf_details; ?>">
									<button type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-download-alt"></span> Download</button>
									</a>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section><!-- /.content -->
</aside><!-- /.right-side -->     <!---rightbar close here ---->