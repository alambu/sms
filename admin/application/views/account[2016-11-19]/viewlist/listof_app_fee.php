<?php 
$this->load->view('header');
$this->load->view('leftbar');
?>
 <script type="text/javascript">
 // When the document is ready
$(document).ready(function () {                
$('#sdate').datepicker({format: "dd-mm-yyyy"});
$('#edate').datepicker({format: "dd-mm-yyyy"});             
});
</script>
<aside class="right-side">      <!---rightbar start here --->
              <!-- Content Header (Page header) -->

                <section class="content-header">
                    <h1>
                        All Application Fee Information
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
						<div class="col-sm-12">
						<form class="form-horizontal" role="form" action="index.php/account_edit/search_appfee" method="post">
						<div class="form-group">
							<div class="col-sm-1" > </div>   						
							<div class="col-sm-2" >   						
							<select class="form-control" name="accnumber" >
									<option value="">--Select Account--</option>
									<?php 
									
										$sqlacc=$this->db->query("SELECT * FROM account_cre WHERE bank_name='Bkash' or bank_name='DBBL'")->result();										
										foreach($sqlacc as $accidshow){
									?>
										<option value="<?php echo $accidshow->accountid?>" <?php if($accountid==$accidshow->accountid){echo "SELECTED";}?>><?php echo $accidshow->acc_name.'('. $accidshow->accountid.')'?></option>
										<?php }?>
							</select>
							</div>
							<div class="col-sm-2" >   						
							<select class="form-control" name="classname">
									<option value="">--Select Class--</option>
									<?php 
										$sqlaccs=$this->db->select('*')->from('application_catg')->get()->result();										
										foreach($sqlaccs as $accidshows){
									?>
										<option value="<?php echo $accidshows->appctgid?>" <?php if($catgid==$accidshows->appctgid){echo "SELECTED";}?>><?php echo $accidshows->app_name?></option>
										<?php }?>
							</select>
							</div>	
								<div class="col-sm-2">
									<input type="text" name="sdate"  class="form-control" id="sdate" placeholder="Select Date"value="<?php echo $start_date?>"/>
								</div>
								<div class="col-sm-2">
									<input type="text" name="edate"  class="form-control" id="edate" placeholder="Select Date" value="<?php echo $end_date?>"/>
								</div>
								<div class="col-sm-2">
									<input type="submit" class="btn btn-primary" name="submitsearch"  class="form-control" value="Search"/>
								</div>
						</div>
						</form>
						</div>
						
					</div>
					<hr/>
                    <div class="row">
						<div class="col-md-12">
						<div class="panel-body">
						 <div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Nr</th>
									<th>Account ID</th>
									<th>Method</th>		
									<th>Application ID</th>										
									<th>Class Name</th>										
									<th>Invoice Number</th>
																					
									<th>Transaction ID</th>														
									<th>Send Account Number</th>
									<th>Purpose</th>														
									<th>Amount</th>														
									<th>Date</th>														
																				
								</tr>
							</thead>
							<tbody>
								<?php $nr=1; foreach($query as $row){									
									?>
								<tr>
									<td><?php echo $nr++ ?></td>									
									<td><?php echo '0'.$row->accountid?></td>
									<td><?php echo $row->method?></td>
									<td><?php echo $row->appid?></td>
									<td><?php echo $row->app_name?></td>
									<td><?php echo $row->invoice_no?></td>
									
									<td><?php echo $row->trans_id;?></td>
									<td><?php echo '0'.$row->saccid?></td>
									<td><?php echo $row->purpose?></td>
									<td><?php echo $row->amount?></td>
									<td><?php  $cdate=$row->e_date;if($cdate>0){echo date('M-d-Y',strtotime($cdate));}?></td>
								</tr>
								<?php }?>
							</tbody>
							</table>
							</div>
							</div>							
						</div>
					</div>
					<div class="row">
					<div class="col-sm-4"></div>
						<div class="col-sm-4">
						  <h3 style=" font-style: italic;">Summary</h3>        
						  <p>Total Amount : <?php echo number_format($tamount,2).'  Taka.';?></p>
						  <p>Today Amount : <?php echo number_format($today_amount,2).'  Taka.';?></p>
						 
						</div>
					<div class="col-sm-4"></div>
					</div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
		<?php $this->load->view('footer');?>