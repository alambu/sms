<?php
 	// echo $_POST['ok'];
 	// print_r($_POST);
 	extract($_POST);
 	$edate=date("Y-m-d");
?>
<script language="javascript" type="text/javascript">
            function printDiv(divID) {
            // hide print button
            document.getElementById("pbtn").style.display="none";
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = divElements;

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;
            }
</script>
 <aside class="right-side">
	<section class="content-header">
        <h1>
             Paper Distribute 
            <small>Control panel</small>
        </h1>
            <ol class="breadcrumb">
            	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
    </section>
<section>
		<div class="container-fluid">
			<div class="col-md-12"> 
			<!-- success or failed message -->
	<?php $this->load->view("exam/success"); ?>
<!-- success or failed message -->
            <!-- <div class="col-md-10" style="margin-top:15px;"> -->
	<div class="panel panel-default" style="margin-top:20px;">
		<div class="panel-heading">Distributed paper ID</div>
		<div class="panel-body" id="pd">
<?php
 			for($i=0;$i<count($exam_name);$i++){
				$data=array(
						"subjid"=>$subjpaper[$i],
						"exm_ctgid"=>$exam_name[$i],
						"classid"=>$cls_name[$i],
						"shiftid"=>$sftid[$i],
						"section"=>$section[$i],
						"tpaper"=>$tpaper[$i],
						"disdate"=>$edate,
						"retdate"=>$return_date[$i],
						"techID"=>$teacher[$i]
						);
				// get distributed id
				$id=$this->db->select("*")->from("exm_pdistribute")->where($data)->order_by("pdisid","desc")->limit("1")->get()->row();
				// get exam name
				$xnm=$this->db->query("SELECT * FROM `exm_namectg` WHERE exmnid=(select exmnid from exm_catg where exm_ctgid=$exam_name[$i])")->row();
				// get class name
				$c=$this->db->select("*")->from("class_catg")->where("classid",$cls_name[$i])->get()->row();
				// get shift name
				$s=$this->db->select("*")->from("shift_catg")->where("shiftid",$sftid[$i])->get()->row();
				// get subject name
				$sb=$this->db->query("SELECT s.subjid,p.sub_name FROM subject_class s right join subject_setup p ON s.subsetid = p.subsetid WHERE s.subjid = '$subjpaper[$i]'")->row();
				// get teacher name
				$t=$this->db->select("*")->from("empee")->where("empid",$teacher[$i])->get()->row();

				?>
				<!-- <div class="col-md-1"></div> -->
				<div class="col-md-8" style="margin-bottom:10px;border:1px solid #e3e3e3;">
					<table class="table">
						<tr>
							<th>Paper ID</th>
							<td> : <?php echo $id->pdisid; ?></td>
							<th>Exam </th>
							<td> : <?php echo $xnm->exm_name; ?></td>
						</tr>
						<tr>
							<th>Class </th>
							<td> : <?php echo $c->class_name ?></td>
							<th>Shift </th>
							<td> : <?php echo $s->shift_N ?></td>
						</tr>
						<tr>
							<th>Section </th>
							<td> : <?php echo $section[$i] ?></td>
							<th>Subject </th>
							<td> : <?php echo $sb->sub_name ?></td>
						</tr>
						<tr>
							<th>Teacher </th>
							<td> : <?php echo $t->name . "( " .$t->empid. " )" ?></td>
							<th>Total Paper </th>
							<td> : <?php echo $tpaper[$i] ?></td>
						</tr>
						<tr>
							<th>Distribute Date </th>
							<td> : <?php echo $edate ?></td>
							<th>Return Date </th>
							<td> : <?php echo $return_date[$i] ?></td>
						</tr>
					</table>
				</div>
				<!-- <div class="col-md-1"></div> -->
				
				
			
			<?php	
				}
 ?>			
<div class="col-md-10">
<button class="btn btn-primary" id="pbtn" style="width:30%;margin-left:40%;" onClick="printDiv('pd')">
	Print
	</button>
</div>
		</div>

	</div>
	
	<div>
		<a href="index.php/exam/paperProcessing">
			<button class="btn btn-success" style="width:150px;"> <span class="glyphicon glyphicon-arrow-left"></span> Back</button>
		</a>
	</div>

</div>
</div>
</div>
</section>
</aside>