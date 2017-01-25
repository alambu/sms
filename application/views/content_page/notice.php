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

		<div class="main_con"><!--Content Start-->
			<div class="row">
				<div class="col-md-9 left_con"><!-- left Content Start--><div class="row">
	<div class="col-md-12"><!-- Welcome Massage Start-->
		<div class="panel panel-primary">
			<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;"> Academic Notice</div>
			<div class="panel-body" style="min-height:770px;">
				<div id="data_content">
  <div id="content2">
 <?php

$select=$this->db->select("*")
					->from("notice")->order_by("id","DESC")
					->get()
					->result();

?>
	  <div class="table-responsive">
	  <table class="table table-striped table-hover" id="example1">
            <thead>
              <tr>
				<th>SI</th>
				<th>Title</th>
                <th>Date</th>
                <th>Download File</th>
              </tr>
			</thead>
            
            <tbody>
				<?php
					$si=0;
					foreach($select as $row){
					$si++
				?>
					<tr height="30px" id="sub_info" >
						<td><?php echo $si; ?></td>
						<td><?php echo $row->title;?></td>
	                    <td><?php echo $row->notice_date;?></td>
	                    <td>
						<a href="index.php/home/dwnlFl?t=n&d=<?php echo $row->pdf_details; ?>">
							<button class="btn btn-primary" name='do' value='download'> Download
							</button>
						</a>
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
</div>
</div><!-- Welcome Massage End-->
</div>
					



				
				
				
				
		
					
		</div><!-- left Content End-->
		
		<!---This is Main Dynamic Content End-->