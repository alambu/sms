<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side"><!---rightbar start here -->
<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Book List
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
											       			
<div class="box">
    <div class="box-body table-responsive">

<!-- success massasge -->
        <?php $this->load->view("website/success"); ?>
<!-- success massasge -->
      
<?php
	$bklst=$this->db->get("book_list")->result();
?>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
		    <th>Id</th>
            <th>Catagory</th>
            <th>Book Name</th>
            <th>Writer Name</th>
            <th>Total Quantity</th>
            <th>Action</th>
        </tr>
    </thead>
  	<tbody>
					
<?php
	$id=0;
	foreach($bklst as $bk){
		$id++;
		$bkCtg=$this->db->select("*")->from("book_catg")->where("bctg_id",$bk->bctg_id)->get()->row();
?>
	<tr>
	    <td><?php echo $id; ?></td>
        <td><?php echo ucfirst($bkCtg->catg_type) ?></td>
        <td><?php echo  $bk->bookN; ?></td>
        <td><?php echo  $bk->writterN; ?></td>
        <td> <?php echo  $bk->tquantity; ?></td>
        <td>
		<a href="index.php/website/edit_book_list?id=<?php echo $bk->blist_id; ?>"  class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
		<a href="index.php/website/delete_book_list?id=<?php echo $bk->blist_id; ?>" class="btn btn-danger"  onclick="return confirm('Are You Sure To delete this book ?')" title='Delete Button' ><span class="glyphicon glyphicon-trash"></span></a>
		</td>
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
</aside><!-- /.right-side -->
 