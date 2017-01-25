<!-- all query are here -->
<?php
	$bklst=$this->db->get("book_list")->result();
?>
<!-- all query are here -->

<!-- all script are here -->
<script type="text/javascript">
	$(document).ready(function(){
    $('#example1').DataTable({
    	"bFilter":false,
    	"bPaginate":false
    });
});	
</script>
<!-- all script are here -->

<!---this is main dynamic content start--> 
<div class="main_con"><!--Content Start-->
	<div class="row">
		<div class="col-md-9 left_con"><!-- left Content Start--><div class="row">
			<div class="col-md-12"><!-- Welcome Massage Start-->
				<div class="panel panel-primary">
					<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;"> Library Book List</div>
					<div class="panel-body" style="min-height:770px;">
						<table class="table table-hover table-striped" id="example1">
							<thead>
								<tr>
									<th>Book Code</th>
									<th>Book Name</th>
									<th>Writter</th>
									<th>Category</th>
								</tr>
							</thead>
							<tbody>
							<?php
								foreach($bklst as $bk):
									$cat=$this->db->select("*")->from("book_catg")->where("bctg_id",$bk->bctg_id)->get()->row();
							?>
								<tr>
									<td><?php echo $bk->blist_id ?></td>
									<td><?php echo $bk->bookN ?></td>
									<td><?php echo $bk->writterN ?></td>
									<td><?php echo $cat->catg_type ?></td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div><!-- Welcome Massage End-->
		</div>
	</div><!-- left Content End-->