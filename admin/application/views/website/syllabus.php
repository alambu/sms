<aside class="right-side"><!---rightbar start here -->
<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Syllabus
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
											       
<?php
    $select=$this->db->select("*")
					->from("syllabus")
                    ->order_by('id','DESC')
					->get()
					->result();
?>
	<!-- syllabus uploading -->
<?php $this->load->view('website/new_syllabus'); ?>

<!-- syllabus reporting -->
<div class="box">
    <div class="box-body table-responsive">
		<table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
				    <th>Id</th>
                    <th>Class</th>
                    <th>Title</th>
                    <th>Pdf File</th>
                    <th>Date</th>
                    <th>Entry user</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
<?php
    $id = 0;
	foreach($select as $test){
		$id++;
        // get class name
        $clsnm=$this->db->select("*")->from("class_catg")->where("classid",$test->classs)->get()->row();
        // user
        $user=$this->db->select("*")->from("user_reg")->where("userid",$test->entry_user)->get()->row();

        // image information
    $image=array("jpg","png","jpeg","gif");
    $finfo=pathinfo("download/syllabus/".$test->pdf_details);
    if(in_array($finfo['extension'],$image)):$src="download/syllabus/".$test->pdf_details;
    else:$src="download/syllabus/default.jpg";
    endif;
?>
                <tr>
				    <td><?php echo $id; ?></td>
                    <td><?php echo $clsnm->class_name; ?></td>
                    <td><?php echo $test->title; ?></td>
                    <td>
                        <img src="<?php echo $src; ?>" height="50" width="60" class="img-thambnail">
                    </td>
                    <td><?php echo  $test->dates; ?></td>
                    <td> <?php echo  $user->userN; ?></td>
                    <td>
						<a href="index.php/website/edit_syllabus?id=<?php echo $id; ?>"> <button type="button " class="btn btn-primary">  <span class="glyphicon glyphicon-pencil"></span> </button></a>
					
						<a href="index.php/website/delete_syllabus?id=<?php echo $id; ?>" onclick="return confirm('Are You sure to delete this syllabus ?')" >
						<button class="btn btn-danger" >  <span class="glyphicon glyphicon-trash"></span> </button>
					</a>
					</td>
                </tr>
					
<?php } ?>
			</tbody>
                                        
                        </table>
					</div>
				</div>
			</div>
						<!-- right col -->
        </div><!-- /.row (main row) -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->     <!---rightbar close here -->