
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Vacancy
                        <small>Control Panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void"><i class="fa fa-dashboard"></i> Home</a></li>
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
					->from("vacancy")
					->get()
					->result();
					
					?>
					    <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Vacancy of school</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
					  <table id="example1"  class="table table-bordered table-striped">
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
											    <td><?php echo $row->id;?></td>
                                                <td><?php echo $row->designation_name;?></td>
                                                <td><?php echo $row->total_teacher;?></td>
                                                <td><?php echo $row->vacancy;?></td>
                                                <td><?php echo $row->present_teacher;?></td>
                                           
                                                <td>
												
												<a href="index.php/admin/edit_vacancy?id=<?php echo $row->id; ?>"  class="btn btn-primary"  title='SMS Button'><span class="glyphicon glyphicon-pencil"></span></a>
												
												<a href="index.php/admin/delete_vacancy?id=<?php echo $row->id; ?>" class="btn btn-danger"  onclick="return confirm('Are You Sure To delete this vacancy ?')" title='Delete Button' ><span class="glyphicon glyphicon-trash"></span></a>
												
												</td>
                                            </tr>
										<?php
											}
										?>
										
                                            
                                        </tbody>
										<tfoot>
											<td>Action</td>
											<td>Action</td>
											<td>Action</td>
											<td>Action</td>
											<td>Action</td>
											<td>Action</td>
										</tfoot>
                                        
							 </div><!-- /.box-body -->
                            </div><!-- /.box -->
						 </table>
						 </div>
						 <div class="col-md-1">
						 
						 </div>
						 </div>
					</div>				

                </section>
                                                            

                <!-- /.content -->
            </aside><!-- /.right-side -->

		
		  <!-- jQuery 2.0.2 -->
        


