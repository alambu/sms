
<aside class="right-side">      <!---rightbar start here -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Scholarship Student Add
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	<div class="container-fluid">

	<?php $this->load->view("account/successFail"); ?>

	   <div class="box">
	 <div class="box-body">
	  
	
		<div class="table-responsive">
			<div class="row">					
          <div class="col-md-12">
		  
		  <ul class="nav nav-tabs" id="myTab">
			<li class="active"><a data-toggle="tab" href="#home">Scholarship Add</a></li>
			<li><a href="#menu2" data-toggle="tab">Reporting</a></li>
		  </ul>
		  
		  <div class="tab-content">
		
<!--- Start application fee form -->
			<div id="home" class="tab-pane fade in active"><br/>
				<?php $this->load->view("account/addSchoolerShip"); ?>
			</div>

<!--- end form view -->



<!--- start Reporting of student scholarship view-->
				<div id="menu2" class="tab-pane fade"><br/>
					<?php $this->load->view("account/schoolerShipList") ?>
				</div>
			</div>
		</div>
	</div>
</div>
			</div>
		</div>
	</div>
</section><!-- /.content -->
 </aside><!-- /.right-side -->     <!---rightbar close here ---->
			<?php ?>