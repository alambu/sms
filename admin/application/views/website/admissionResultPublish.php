<aside class="right-side"><!---rightbar start here -->
<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Admission Result Publish
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
    $admission = $this->db->select("*")
                    ->from("admission_result")
                    ->order_by('id','DESC')
                    ->get()
                    ->result();
?>
    <!-- syllabus uploading -->
<?php $this->load->view('website/newAdmissionResult'); ?>

<!-- syllabus reporting -->
<div class="box">
    <div class="box-body table-responsive">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>SI</th>
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
    foreach($admission as $test){
        $id++;
        // user
        $user = $this->db->select("*")->from("user_reg")->where("userid",$test->euser)->get()->row();

        // image information
        $src="download/syllabus/default.jpg";
?>
                <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $test->title; ?></td>
                    <td>
                        <img src="<?php echo $src; ?>" height="50" width="60" class="img-thambnail">
                    </td>
                    <td><?php echo  $test->edate; ?></td>
                    <td> <?php echo  $user->userN; ?></td>
                    <td>
                        <a href="website/admissionResultUpdate/<?php echo $test->id; ?>"> <button type="button " class="btn btn-primary">  <span class="glyphicon glyphicon-pencil"></span> </button></a>
                    
                        <a href="website/admissionResultDelete/<?php echo $test->id; ?>" onclick="return confirm('Are You sure to delete this result ?')" >
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