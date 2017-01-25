<?php
	$id=$_GET['id'];
	$edit=$this->db->select("*")
					->from("notice")
					->where("id",$id)
					->get()
					->row();
$image=array("jpg","png","jpeg","gif");
    $finfo=pathinfo("download/notice/".$edit->pdf_details);
    if(in_array($finfo['extension'],$image)):$src="download/notice/".$edit->pdf_details;
    else:$src="download/notice/default.jpg";
    endif;
?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#pdate").datepicker({format:"yyyy-mm-dd"});
	});
</script>

<aside class="right-side"><!---rightbar start here -->
<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Notice Update
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
					<div class="panel panel-primary">
						<div class="panel-heading">
							Edit Notice
						</div>
						<div class="panel-body">
							<form action="index.php/website/updateNotice" method="post" enctype="multipart/form-data">
                     <table class="table">
					  
						   <tr>
							   <td width="100px">Title</td>
							   <td colspan="2"><input type="text" name="title" value="<?php echo $edit->title; ?>" class="form-control" /></td>
						  </tr>
						  
						  <input type="hidden" name="sid" value="<?php echo $id; ?>" class="form-control" />
						  
						  <tr>
							   <td width="100px">Pdf File</td>
							   <td>
							   		<input type="file" name="sfile" class="form-control" />
							   </td>
							   <td>
							   	<img src="<?php echo $src; ?>" height="50" width="50" class="img-thumbnail">
							   	<span><?php echo $edit->pdf_details; ?><span>
							   </td>
						  </tr>
						  
						  <tr>
							   <td width="100px" >Publish Date</td>
							   <td colspan="2">
							   		<input type="text" name="pdate" value="<?php echo $edit->notice_date; ?>" class="form-control" id="pdate" /></td>
						  </tr>
						  
					    <tr>
					      	<td colspan="3">
							    <button class="btn btn-primary">
							    	Submit
							    </button>
							</td>
						</tr>
						  
						  
					</table>  
				</form>	
						</div>
				</div>		
			</div>
		</div>
	</section>
</aside>
