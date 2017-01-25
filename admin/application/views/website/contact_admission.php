   
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Contact Admission
                        <small>Control Panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php/admin"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">History</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<div class="container-fluid">
					<div class="row">
					<div class="col-md-11">
				       
					 			<?php

$select=$this->db->select("*")
					->from("about")
					->get()
					->result();

					?>
<table id="example1" class="table table-bordered table-striped">
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
			<td><a href="index.php/admin/edit_department?id=<?php echo $id; ?>" ><button class="btn btn-info"> <span class="glyphicon glyphicon-pencil"></span> Edit</button> </a> </td>
      </tr>
	 

<?php } ?>
</tbody>
</table>


		  
				</div>
				<div class="col-md-1">
				</div>
				</div>
				
				
				</div>
                </section>
                                                            

                <!-- /.content -->
            </aside><!-- /.right-side -->
