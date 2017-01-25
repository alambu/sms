<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Gallery
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <?php $this->load->view('website/new_gallery'); ?>

                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
						<div class="col-md-12">
					
					<?php
					
					$select=$this->db->select("*")
					->from("gallery")
					->order_by('id','DESC')
					->get()
					->result();
					
					?>
					 <div class="box">
                                <div class="box-body table-responsive">
					  
					  <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
											    <th>Id</th>
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php 
											$si = 0;
											foreach($select as $row){
												$si++;
                                                // get category name
                                                $catNm=$this->db->select("*")->from("image_catagory")->where("id",$row->catagory)->get()->row();
										?>
										
											 <tr>
											    <td><?php echo $si;?></td>
                                                <td><?php echo $row->title;?></td>
                                                <td><?php echo ucfirst($catNm->image_catagory);?></td>
                                                <td><img  src="galleryImage/img/<?php echo $row->image;?>" style="height:50px; width:50px;"/></td>
                                                
                                                <td>
												
												<a href="index.php/website/edit_gallery?id=<?php echo $row->id; ?>"  class="btn btn-primary"  title='SMS Button'><span class="glyphicon glyphicon-pencil"></span></a>
												
												<a href="index.php/website/delete_gallery?id=<?php echo $row->id; ?>" class="btn btn-danger"  onclick="return confirm('Are You Sure To delete this picture ?')" title='Delete Button' ><span class="glyphicon glyphicon-trash"></span></a>
												
												</td>
                                            </tr>
										<?php
											}
										?>
										
                                            
                                        </tbody>
                                        
                                    </table>
							</div><!-- /.box-body -->
                            </div><!-- /.box -->
						</div>
						<div class="col-md-1"></div>
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->