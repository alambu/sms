<?php 
$this->load->view('header');
$this->load->view('leftbar');
?>
<aside class="right-side">      <!---rightbar start here --->
    <style>
		.error{
			border-color:red;
		}
		#myTab{
			margin-bottom:15px;
		}
	</style>            <!-- Content Header (Page header) -->
<script type="text/javascript">

</script>
	
                <section class="content-header">
                    <h1>
                        Book Report
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Book Catagory</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<?php $this->load->view('student_section/submit_confirm'); ?>
                    <div class="row">
						    <div class="col-md-12">
								    <div class="box">
										<div class="box-body">
<!--------------Start nav bar-------------------------->										
											<ul class="nav nav-tabs" id="myTab">
												  <li class="active"><a data-toggle="tab" href="#bk_store"><span class="glyphicon glyphicon-shopping-cart"></span> Your Storage</a></li>
												  <li><a data-toggle="tab" href="#bk_dis"><span class="glyphicon glyphicon-bookmark"></span> Distribute Report</a></li>
												 <li><a data-toggle="tab" href="#all_bk"><span class="glyphicon glyphicon-book"></span>  All Book</a></li>
												 <li><a data-toggle="tab" href="#re_store"><span class="glyphicon glyphicon-trash"></span> Your Lost Book</a></li>
												   
											</ul>
<!-----------------End Nav bar---------------------------->	

										
<!---------------------Start Tab content-------------------------->
											<div class="tab-content">
								<!------------------Start Book Re store--------------------->											  
											  <div id="re_store" class="tab-pane fade">
												<?php  $this->load->view('library_section/book_restore'); ?>
											  </div>
											  
								<!------------------End Book Restore--------------------->
								
								
								
								<!------------------Start Book Distribute--------------------->											  
											  <div id="bk_store" class="tab-pane fade in active">
											  
												<?php
													$this->load->view('library_section/library_storeg_report');
												?>
												
											  </div>
											  
								<!------------------End Book Distribute--------------------->

								
								<!------------------Start Book Return--------------------->
											  <div id="bk_dis" class="tab-pane fade">
												<?php
												
												   $this->load->view('library_section/distribute_report');
												?>
											  </div>
								<!------------------End Book Return--------------------->
								
								<!------------------Start All Book Report--------------------->
											  <div id="all_bk" class="tab-pane fade">
												<?php
												
												 $this->load->view('library_section/all_book_report');
												?>
											  </div>
								<!------------------End All Book Report--------------------->
																			  

																			  
											  
											</div>	
<!--------------End Tab content-------------------------->											
										</div>
								    </div>
						    </div>
                    </div>


                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
<?php 
$this->load->view('footer'); 
?>			