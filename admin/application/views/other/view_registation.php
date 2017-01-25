<?php 
$this->load->view('header');
$this->load->view('leftbar');
?>
<aside class="right-side">      <!---rightbar start here --->
              <!-- Content Header (Page header) -->

                <section class="content-header">
                    <h1>
                        All User Registration Information
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="row">
						<div class="col-md-12">
							<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Nr</th>
									<th>User Name</th>
									<th>Full Name</th>
									<th>Phone Number</th>
									<th>Email Address</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $nr=1; foreach($query as $row){?>
								<tr>
									<td><?php echo $nr++ ?></td>
									<td><?php echo $row->userN?></td>
									<td><?php echo $row->fullname?></td>
									<td><?php echo $row->phone?></td>
									<td><?php echo $row->email?></td>
									<td><?php echo $row->status?></td>
									<td><a href="index.php/userpanel/registaion_edit?reg=<?php echo $row->userid?>"><button class="btn btn-primary">Edit</button></a></td>
								</tr>
								<?php }?>
							</tbody>
							</table>
						</div>
					</div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
		<?php $this->load->view('footer');?>