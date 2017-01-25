<?php
	$id=$_GET['id'];
	$edit=$this->db->select("*")
					->from("book_list")
					->where("blist_id",$id)
					->get()
					->row();
// get category
$bct=$this->db->get("book_catg")->result();

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
            Book Update
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
							Edit Book List
						</div>
						<div class="panel-body">
							<form action="index.php/website/updateBookLst" method="post" enctype="multipart/form-data">
                     <table class="table">
					  
					      <tr>
							   <th>Category</th>
							   <td colspan="2">
							   		<select class="form-control" name="cat" id="cat">
							   			<option value="">Select</option>
							   		<?php foreach($bct as $bc): ?>
							   			<option value="<?php echo $bc->bctg_id ?>" <?php if($bc->bctg_id==$edit->bctg_id):echo "selected";endif; ?> ><?php echo $bc->catg_type ?></option>
							   		<?php endforeach; ?>
							   		</select>
							   </td>
						  </tr>
						  
						   <tr>
							   <th>Book Name</th>
							   <td colspan="2"><input type="text" name="bknm" value="<?php echo $edit->bookN; ?>" class="form-control" /></td>
						  </tr>
						  
						  <input type="hidden" name="bid" value="<?php echo $id; ?>" class="form-control" />
						  
						  <tr>
							   <th>Writter Name</th>
							   <td colspan="2">
							   		<input type="text" name="wnm" class="form-control" value="<?php echo $edit->writterN ?>" />
							   </td>
						  </tr>
						  
						  <tr>
							   <th>Total Quantity</th>
							   <td colspan="2">
							   		<input type="text" name="qnt" value="<?php echo $edit->tquantity; ?>" class="form-control" id="qnt" /></td>
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
