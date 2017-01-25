<?php 
$this->load->view('header');
$this->load->view('leftbar');
?>
<
<aside class="right-side">      <!---rightbar start here --->
    <style>
		.error{
			border-color:red;
		}
	</style>            <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Click  Print or Back For payment money receipt. 
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
				</br>
				</br>
				</br>
				<div class="row">
					<div class="col-sm-4"></div>
						<div class="col-sm-4">
						 <a href="index.php/account_edit/print_moneyreceipt?invo=<?php echo $payinvoices?>" target="_blank"><button type="submit" name="submit" class="btn btn-primary" onclick=""><span class="glyphicon glyphicon-print"></span> Money Receipt Print</button></a>
						 <a href="javascript:history.back();"><button type="button" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-arrow-left"></span>  Back</button></a>	
						</div>
					<div class="col-sm-4"></div>
				</div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
			<?php $this->load->view('footer');?>