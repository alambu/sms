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
                        All Extra Income Information
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
						<form class="form-horizontal" role="form" action="index.php/account_edit/search_other_income" method="post">
						<div class="form-group">
							<div class="col-sm-1" > </div>   						
							<div class="col-sm-2" >   						
							<select class="form-control" name="accnumber" >
									<option value="">--Select Account Name--</option>
									<?php 
										$sqlacc=$this->db->select('*')->from('account_cre')->get()->result();										
										foreach($sqlacc as $accidshow){
									?>
										<option value="<?php echo $accidshow->accountid?>" <?php if($accountid==$accidshow->accountid){echo "SELECTED";}?>><?php echo $accidshow->acc_name.'('. $accidshow->accountid.')'?></option>
										<?php }?>
							</select>
							</div>
							<div class="col-sm-2" >   						
							<select class="form-control" name="categoryid">
									<option value="">--Select Category Name--</option>
									<?php 
										$sqlaccs=$this->db->select('*')->from('income_catg')->get()->result();										
										foreach($sqlaccs as $accidshows){
									?>
										<option value="<?php echo $accidshows->income_type?>" <?php if($catgid==$accidshows->income_type){echo "SELECTED";}?>><?php echo $accidshows->income_type?></option>
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
                    <div class="row">					
					<hr/>
						<div class="col-md-12">
						<div class="panel-body">
						 <div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Nr</th>
									<th>Account Receive</th>
									<th>Invoice Number</th>										
									<th>Income Category</th>										
									<th>Person Name</th>														
									<th class="cellClass">Method</th>					
									<th>Bank Name</th>														
									<th>Person Account ID</th>														
									<th>Check Number</th>														
									<th>Expire Date</th>														
									<th>Amount</th>														
									<th>Description</th>														
								</tr>
							</thead>
							<tbody>
								<?php $nr=1; foreach($query as $row){
										$acname=$this->accmodone->accountinfo($row->accountid);
									?>
								<tr>
									<td><?php echo $nr++ ?></td>									
									<td><?php echo $acname->acc_name.'('.$row->accountid.')'?></td>
									<td><?php echo $row->invoice_no?></td>
									<td><?php echo $row->income_type?></td>
									<td><?php echo $row->pname?></td>
									<td><?php $method=$row->method;if($method==1){echo 'Cash';}else{echo 'Check';}?></td>
									<td><?php echo $row->bank_name?></td>
									<td><?php  $pacid=$row->p_accountid;if($pacid>0){echo $pacid;}?></td>
									<td><?php echo $row->check_no?></td>
									<td><?php  $cdate=$row->exp_date;if($cdate>0){echo date('M-d-Y',strtotime($cdate));}?></td>
									<td><?php echo $row->balance?></td>
									<td><?php echo $row->descrp?></td>
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