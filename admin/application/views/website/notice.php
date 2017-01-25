 <!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Notice
            
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Notice</li>
        </ol>
    </section>

<?php $this->load->view('website/new_notice'); ?>

    <!-- Main content -->
    <section class="content">
		<div class="row">


			<div class=" col-md-12">
				<div class="box">
                    <div class="box-body table-responsive">
<?php
    $select=$this->db->select("*")
					->from("notice")
                    ->order_by('id','DESC')
					->get()
					->result();
?>
				     
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
		    <th>Id</th>
            <th>Notice_date</th>
            <th>File</th>
            <th>Title</th>
            <th>Entry_user</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
	<?php
        $id = 0;
		foreach($select as $row){
            $id++;
            // user
            $user=$this->db->select("*")->from("user_reg")->where("userid",$row->entry_user)->get()->row();
            // image information
    $image=array("jpg","png","jpeg","gif");
    $finfo=pathinfo("download/notice/".$row->pdf_details);
    if(in_array($finfo['extension'],$image)):$src="download/notice/".$row->pdf_details;
    else:$src="download/notice/default.jpg";
    endif;
	?>
	
		 <tr>
		    <td><?php echo $id;?></td>
            <td><?php echo $row->notice_date;?></td>
            <td>
                <img src="<?php echo $src; ?>" class="img-thumbnail" height="50" width="50">
            </td>
            <td><?php echo $row->title;?></td>
            <td> <?php echo $user->userN;?></td>
            <td>
			<a href="index.php/website/edit_notice?id=<?php echo $row->id; ?>"  class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
			<a href="index.php/website/delete_notice?id=<?php echo $row->id ?>"  class="btn btn-danger"  onclick="return confirm('Are You Sure To delete this notice ?')" title='Delete Button' ><span class="glyphicon glyphicon-trash"></span></a>
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
    </section>
</aside><!-- /.right-side -->
 