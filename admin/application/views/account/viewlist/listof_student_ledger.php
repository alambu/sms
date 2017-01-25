<?php 

$this->load->view('header');
$this->load->view('leftbar');
?>
<style>
.cellClass {
    vertical-align:middle !important;
    height:auto;
}
</style>

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
                        Student Ledger Information
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
						<form class="form-horizontal" role="form" action="index.php/account_billgenerate/search_student_ledger" method="post">
						<div class="form-group">
							<div class="col-sm-1" > </div>   						
													
							<div class="col-sm-2" >   						
							<select class="form-control" name="stuid" >
									<option value="">--Student ID--</option>
									<?php 
										$sqlacc=$this->db->select('stu_id')->from('regis_tbl')->get()->result();										
										foreach($sqlacc as $accidshow){
									?>
										<option value="<?php echo $accidshow->stu_id?>" <?php if($stuids==$accidshow->stu_id){echo "SELECTED";}?>><?php echo $accidshow->stu_id?></option>
										<?php }?>
							</select>
							</div>
							<div class="col-sm-2" >   						
							<select class="form-control" name="bilpay" >
									<option value="">--Select Category--</option>
									<option value="1" <?php if($bilpay=='1'){echo "SELECTED";}?>>Bill</option>
									<option value="2" <?php if($bilpay=='2'){echo "SELECTED";}?>>Payment</option>
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
                    <div class="row">					
					<hr/>
						<div class="col-md-12">
						<div class="panel-body">
						 <div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Nr</th>									
										<?php if($checks==2){?>
										<th>Student ID</th>	
										<th>Invoice Number</th>
										<th>Purpose</th>
										<th>Amount</th>
										<?php } else{?>
									<th>Tr. ID</th>
									<th>Student ID</th>	
									<th>Bill Invoice</th>	
									<th>Payment Invoice</th>	
									<th>Purpose</th>										
									<th>Credit</th>											
									<th>Debit</th>											
									<th>Balance</th>
										<?php }?>
									<th>Entry Person</th>					
									<th>Entry Date</th>					
								</tr>
							</thead>
							<tbody>
								<?php $nr=1; foreach($query as $row){
										$acname=$this->accmodone->accountinfo($row->accountid);
									?>
								<tr>
									<td><?php echo $nr++ ?></td>
									<?php if($checks=='2'){?>
									<td><?php echo $row->stu_id;?></td>
									<td><?php if($bilpay=='1'){ ?>
									<a href="javascript:void(0)" onclick="showAjaxModal('index.php/account_edit/bill_description/<?php echo $row->invoice_no;?>');"><?php echo $row->invoice_no;?></a>
									<?php } else {?>
									<a href="index.php/account/moneyreceipt_index_reprint_stuledger?inv=<?php echo $row->invoice_no;?>">
									<?php echo $row->invoice_no;?>
									</a>
									<?php }?>
									</td>
																
									<td><?php echo $row->billpay_type;?></td>
									<td><?php echo $row->amount;?></td>
									<?php } else { ?>
									<td><?php echo $row->trans_id?></td>
									<td><?php echo $row->stu_id?></td>									
									<td><a href="javascript:void(0)" onclick="showAjaxModal('index.php/account_edit/bill_description/<?php echo $row->bill_invoice;?>');"><?php $bill=$row->bill_invoice; if($bill>'0'){echo $bill;}?></a></td>
									<td><a href="index.php/account/moneyreceipt_index_reprint_stuledger?inv=<?php echo $row->pay_invoice;?>"><?php $pay=$row->pay_invoice; if($pay>'0'){echo $pay;}?></a></td>
									<td><?php echo $row->porpose?></td>
									<td><?php echo $row->credit?></td>
									<td><?php echo $row->debit?></td>
									<td><?php echo $row->balance?></td>
										<?php } ?>
									<td><?php echo $row->e_user?></td>
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
							<?php if($checks=='2'){?>
							<p>Total Amount : <?php echo number_format($total_amount,2).'  Taka.';?></p>
							<?php } else{ ?>
						  <p>Total Bill : <?php echo number_format($credit_t,2).'  Taka.';?></p>
						  <p>Total Payment : <?php echo number_format($debit_t,2).'  Taka.';?></p>
						  <p>Today Bill : <?php echo number_format($today_credit,2).'  Taka.';?></p>
						  <p>Today Payment : <?php echo number_format($today_debit,2).'  Taka.';?></p>
							<?php }?>
						</div>
					<div class="col-sm-4"></div>
					</div>
				<div class="modal fade" id="modal_ajax" role="dialog">
						<div class="modal-dialog">
						
						  <!-- Modal content-->
						  <div class="modal-content">
							<div class="modal-header">
							  <button type="button" class="close" data-dismiss="modal">×</button>
							  <h4 class="modal-title">Bill Generate Details</h4>
							</div>
							<div class="modal-body">
								
							</div>
							<div class="modal-footer">
							  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						  </div>						  
						</div>
				</div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
		<?php $this->load->view('footer');?>