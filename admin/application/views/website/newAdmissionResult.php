<style>
	.error{
		border-color:red;
	}
	.size{
		height:70px;
		width:70px;
	}
</style>            <!-- Content Header (Page header) -->

<?php
	$id = $this->uri->segment(3);
	$w = array( "id" => $id );
	$data = $this->db->get_where("admission_result",$w)->row();

	if($id):

?>

<aside class="right-side"><!---rightbar start here -->
<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Admission Result Update
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
        
        <?php endif; ?>

<section class="content">
	<div class="row">
		<div class="col-md-12">
            <div class="box">
				<!-- success massasge -->
					<?php $this->load->view("website/success"); ?>
				<!-- success massasge -->
					<div class="box-body table-responsive">
					   <form class="form-horizontal" id="idForm"  action="website/uploadAdmissionFile" method="post" enctype="multipart/form-data">
					  <table  class="table" >
						<tr>
							<td>
							<div class="form-group" id="itemRows">
								
							<input type="hidden" name="id" value="<?php if($id):echo $id;endif; ?>" />

								 <div class="col-sm-3" id="">
									<center><label>Title</label></center>
									<input type="text" name="title" class="form-control" id="fee" placeholder="Enter Title Name" required value="<?php if($id):echo $data->title;endif; ?>" />
							    </div>
								
								 <div class="col-sm-3" id="shak_id_3">
									<center><label style="">Admission Result File</label></center>
									<input type="file" name="resultFile"  id="img" class="form-control" required />
							   </div>

							 <?php if($id): ?>
							   <div class="col-sm-3">
							   		<img src="download/admission_result/default.jpg" height="50" width="60" class="img-thambnail">
							   		<span><?php echo $data->file_name; ?></span>
							   		<input type="hidden" name="filename" value="<?php echo $data->file_name; ?>" />
							   </div>
							  <?php endif; ?>

							  </form>
							</div>
							 
							</td>
						 </tr>
						<tr>
						<td>
						<div class="form-group">        
						   <div class="col-sm-4"></div>
						   <div class="col-sm-6">
								<button type="submit" name="upload" class="btn btn-primary"><span class="glyphicon glyphicon-open"></span>  Upload</button>&nbsp;&nbsp;
								<button type="reset" value="" class="btn btn-warning" id="reset"><span class="glyphicon glyphicon-refresh"> Reset</button>
							
						  	</div>
						</div>
						</td>
					    </tr>
                       					  
					  </table>
					 
					  </div>
					 <div class="col-md-2">
					 
					 </div>
                    </div>

					</div>
                </section>

<?php if($id): ?>

            </div>
        </div>
    </section>
</aside>

<?php endif; ?>
			