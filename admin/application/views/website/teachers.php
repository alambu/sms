
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Teacher Information
                        <small>Control Panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"> Vacancy</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					 <div class="container-fluid"> 
					 <div class="row">
						<div class="col-md-11">
					<?php
					
					$select=$this->db->select("*")
					->from("teachers_info")
					->get()
					->result();
					
					?>
					  
					  <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
											    <th>Id</th>
                                                <th>Name of Designation</th>
                                                <th>Total Teacher</th>
                                                <th>Vacancy</th>
                                                <th>Present Teacher</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php 
											foreach($select as $row){
										?>
										
											 <tr>
											    <td><?php echo $row->teacher_id;?></td>
                                                <td><?php echo $row->name;?></td>
                                                <td><?php echo $row->designation;?></td>
                                                <td><?php echo $row->birth_date;?></td>
                                                <td><?php echo $row->joining_date;?></td>
                                           
                                                <td>
												
												<a href="index.php/admin/edit_teachers?id=<?php echo $row->teacher_id; ?>"  class="btn btn-primary"  title='SMS Button'><span class="glyphicon glyphicon-pencil"></span></a>
												
												<a href="javascript:void(0);" class="btn btn-danger"  onclick="return confirm('Are You Sure To delete this vacancy ?')" title='Delete Button' ><span class="glyphicon glyphicon-trash"></span></a>
												
												</td>
                                            </tr>
										<?php
											}
										?>
										
                                            
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
<!-- ./wrapper -->

		
		  <!-- jQuery 2.0.2 -->
        


