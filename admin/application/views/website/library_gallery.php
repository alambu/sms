
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Library Gallery
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Library Gallery</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
				      <!--<table align="right" width="800px" cellpadding="0" cellspacing="0" style="padding-left:200px; margin-bottom:60px;" >
						<tr>
							<td><a href="index.php/welcome/new_library_gallery"><input type="submit" value="Add New Photo" name="new_data_send" style="width:200px; height:40px; font-size:22px; background-color:#357CA5; color:white; border-radius:5px; font-weight:bold; border:none;"/></a></td>
							
						</tr>
					</table>----------->
					<div class="row">
						<div class="col-md-11">
						<div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Libary gallery Image</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
					<?php
					
					$select=$this->db->select("*")
					->from("library_gallery")
					->get()
					->result();
					
					?>
					  
					  <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
											    <th>Id</th>
                                                <th>Image Title</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php 
											foreach($select as $row){
										?>
										
											 <tr>
											    <td><?php echo $row->id;?></td>
                                                <td><?php echo $row->image_title;?></td>
                                                <td><img class="img-thumbli" src="libraryImage/<?php echo $row->image;?>" style="height:40px; width:40px;"/></td>
                                                
                                                <td>
												<a href="index.php/welcome/edit_library_gallery?id=<?php echo $row->id; ?>"  class="btn btn-primary"  title='SMS Button'><span class="glyphicon glyphicon-pencil"></span></a>
												<a href="index.php/welcome/
												delete_library_gallery?id=<?php echo $row->id ?>" class="btn btn-danger"  onclick="return confirm('Are You Sure To delete this notice ?')" title='Delete Button' ><span class="glyphicon glyphicon-trash"></span></a>
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
					<div class="col-md-1"></div>
					</div>
                </section>
                                                            

                <!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


