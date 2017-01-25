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

<div class="row">
	<div class="col-md-9 left_con"><!-- left Content Start--><div class="row">
		<div class="col-md-12"><!-- Welcome Massage Start-->
			<div class="panel panel-primary">
				<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;"> Academic Sylabuss</div>
				<div class="panel-body" style="min-height:770px;">
				<div id="data_content">
  					<div id="content2">
  						
 <?php

$select=$this->db->select("*")
					->from("syllabus")
					->order_by("id","desc")
					->get()
					->result();

?>
	  
<table class="table table-striped table-hover" id="example1">
    <thead>
        <tr height="40px" style="background-color:#F5F5F5">
			<th width="270px">Title</th>
	        <th width="120px">Class</th>
	        <th width="120px">Date</th>
	        <th width="120px">Download File</th>
        </tr>
    </thead>
    <tbody>
		<?php 
			foreach($select as $row){
				// get class
				$cls=$this->db->select("*")->from("class_catg")->where("classid",$row->classs)->get()->row();
		?>
			<tr height="30px"  >
				<td width="270px" style="text-align:left;"><?php echo $row->title;?></td>
                <td width="120px" ><?php echo $cls->class_name; ?></td>
                <td width="120px"><?php echo $row->dates;?></td>
                <td width="120px" style="text-align:center;">
					<a href="index.php/home/dwnlFl?t=s&d=<?php echo $row->pdf_details; ?>">
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
</div><!-- Welcome Massage End-->
</div>
</div><!-- left Content End-->
