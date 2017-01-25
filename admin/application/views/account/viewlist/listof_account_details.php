<?php 
$this->load->view('header');
$this->load->view('leftbar');
?>
<aside class="right-side">      <!---rightbar start here --->
              <!-- Content Header (Page header) -->

                <section class="content-header">
                    <h1>
                        All Account Information
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
						<div class="panel-body">
						 <div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Nr</th>
									<th>Account Number</th>
									<th>Account Name</th>										
									<th>Bank Name</th>										
									<th>Balance</th>														
								</tr>
							</thead>
							<tbody>
								<?php $nr=1; foreach($query as $row){									
									?>
								<tr>
									<td><?php echo $nr++ ?></td>									
									<td><?php echo $row->accountid?></td>
									<td><?php echo $row->acc_name?></td>
									<td><?php echo $row->bank_name?></td>
									<td><?php echo $row->balance?></td>
								</tr>
								<?php }?>
							</tbody>
							</table>
							</div>
							</div>
						</div>
					</div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
		<?php $this->load->view('footer');?>