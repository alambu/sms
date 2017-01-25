<?php

$select=$this->db->select("*")
					->from("library_info")
					->get()
					->result();

?>
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Libary Information
                        <small>Control Panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"> Vacancy</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
				  
						 <div class="row">
							<div class="col-md-11">
							
								<div class="box">
<div class="box-header">
<h3 class="box-title">library Information</h3>                                    
</div><!-- /.box-header -->
<div class="box-body table-responsive">

<table id="example2"  class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Id</th>				
					<th>Title</th>
					<th>Details</th>
					<th>Action</th>
                </tr>
			</thead>
<tbody>			
				<?php
				
foreach($select as $test){
	
		        $id= $test->id;	
				
	   
		

?>
		
	   
	  <tr>
			<td><?php echo $id; ?></td>
			<td><?php echo $test->title; ?></td>
			<td><?php echo  $test->details; ?></td>
			<td><a href="index.php/admin/edit_library_info?id=<?php echo $id; ?>" ><button class="btn btn-info"> <span class="glyphicon glyphicon-pencil"></span> Edit</button> </a> </td>
      </tr>
	 

<?php } ?>
</tbody>
</table>
</div>
</div>

							 </div>
							 <div class="col-md-1">
							 
							 </div>
						 </div>
						

                </section>
                                                            

                <!-- /.content -->
            </aside><!-- /.right-side -->
<!-- ./wrapper -->

		
		  <!-- jQuery 2.0.2 -->
        


