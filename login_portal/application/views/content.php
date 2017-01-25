<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Dashboard
			<small>Control panel</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol>
	</section>

                <!-- Main content -->
	<section class="content">

		<!-- Small boxes (Stat box) -->
		<?php
		$typeckd=$this->session->userdata('ltype');
		if($typeckd==1){
			$this->load->view('student_dashbord');
		} 
		elseif($typeckd==2){
			$this->load->view('parents_dashbord');
		} 
		
		elseif($typeckd==3){
			$this->load->view('teacher_dashbord');
		}
		 ?>
	</section><!-- /.content -->
</aside><!-- /.right-side -->     <!---rightbar close here ---->