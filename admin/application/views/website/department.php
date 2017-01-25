<aside class="right-side">
	<!-- Content Header (Page header) -->
	<section class="content-header">
	    <h1>
	        Department
	        <small>Control Panel</small>
	    </h1>
	    <ol class="breadcrumb">
	        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
	        <li class="active"> Vacancy</li>
	    </ol>
	</section>

	<section>
		<aside class="right-side">
			<div class="row">
				<a href="website/add_department"><button class="btn btn-primary" style="float:right;margin:10px 20px;">New Department</button></a>
			</div>
		</aside>
	</section>

    <!-- Main content -->
    <section class="content">
	    <div class="container-fluid"> 
		 	<div class="row">	 	
			<div class="col-md-12">

<?php
	$select=$this->db->select("*")
					->from("department")
					->get()
					->result();
?>
		  <div class="box">
<!-- success massasge -->
	<?php $this->load->view("website/success"); ?>
<!-- success massasge -->

            	<div class="box-body table-responsive">

					<table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
							    <th>Id</th>
							    <th>Image</th>
							    <th>Department name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
<?php 
	$si = 0;
	foreach($select as $row){
		$si++;
?>
										
						 <tr>
						    <td><?php echo $si;?></td>
						    <td>
						    	<img src="img/document/department/<?php echo $row->image;?>" height="60" width="100" class="img-thumbnail" />
						    </td>
	                        <td><?php echo $row->department_name;?></td>
	                        <td><p><?php echo substr($row->details, 0,350)."..........";?></p></td>
	                   
	                        <td>
							
							<a href="index.php/website/edit_department?id=<?php echo $row->id; ?>"  class="btn btn-primary"  title='SMS Button'><span class="glyphicon glyphicon-pencil"></span></a>
							
							</td>
	                    </tr>
<?php
	}
?>
					</tbody>
                </table>
						</div>
					</div>
				</div>
			</div>
		</div>				
	</section>
</aside><!-- /.right-side -->
