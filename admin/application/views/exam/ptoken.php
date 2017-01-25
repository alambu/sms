<?php
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$pid=$this->db->select("*")->from("exm_pdistribute")->where("pdisid",$id)->get()->result();
	}elseif(isset($_POST['goPt'])){
		extract($_POST);
		$pid=$this->db->select("*")->from("exm_pdistribute")->where("pdisid >=",$pidf)->where("pdisid <=",$pidt)->get()->result();
	}elseif(isset($_GET['pid'])){
		$id=$_GET['pid'];
		$pid=$this->db->select("*")->from("exm_pdistribute")->where("pdisid",$id)->get()->result();
	}
?>
<script language="javascript" type="text/javascript">
    function printDiv(divID) {
    // hide print button
    document.getElementById("pbtn").style.display="none";
    document.getElementById("eachPid").style.display="block";
    document.getElementById("eachPid").style.pageBreakAfter = "always";
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
<style type="text/css">
#eachPid{display: block;}
	@media print{
		#pd{page-break-after: avoid;page-break-before: auto;page-break-inside: avoid;}
		#eachPid{display:block;border:1px solid #e3e3e3;width:90%;}
		#ptokenHead{display: none;}
		#ptMnDiv{border: none;;margin-left:-10%;padding: 0px 0px 0px 0px;}
		#ptMnHd{margin-top: -27%;border:none !important;}
		#pBtn{display: none;}
	}
#ptMnDiv{margin-top:60px;}
#pTokn tr td{border:none !important;}
#pTokn tr th{border:none !important;}
#pd{margin: 0px auto !important;}
#eachPid{
	margin-bottom:10px;
	border:1px solid #e3e3e3;
	left:9%;
}
</style>
<?php
 if(isset($_POST['go'])||isset($_GET['pid'])){
?>
  <aside class="right-side">
	<section class="content-header">
        <h1>
            Examination Paper Distribute Token
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
	</section>

	<section>

		<div class="container-fluid">
			<div class="col-md-11">
<?php
	}
 ?>
				<div class="col-md-10" style="margin-top:25px;">  
				
				<div class="col-md-10" id="ptokenHead">
					<form action="index.php/exam/paperProcessing" method="post" class="form" role="form">
						<table style="width:100%;">
							<tr>
								<th>Paper ID  From </th>
								<td><input type="text" name="pidf" id="pidf" class="form-control" required onkeypress="return isNumber(event)" value="<?php if(isset($_POST['goPt'])):echo trim($pidf); endif; ?>"></td>
								<th>To</th>
								<td><input type="text" name="pidt" id="pidt" class="form-control" required onkeypress="return isNumber(event)" value="<?php if(isset($_POST['goPt'])):echo trim($pidt); endif; ?>"></td>
								<td>
									<button type="submit" name="goPt" class="btn btn-primary">
										<span class="glyphicon glyphicon-search"></span> Search
									</button>
								</td>
							</tr>
						</table>
					</form>
				</div>
					
					<div class="panel panel-default" id="ptMnDiv">
						<div class="panel-heading" id="ptMnHd">Distributed paper ID</div>
							<div class="panel-body" id="pd">
							
							<?php 
							if(isset($_GET['id'])||isset($_POST['goPt'])||isset($_GET['pid'])){
								foreach($pid as $p):
									// get exam name
									$xnm=$this->db->query("SELECT * FROM `exm_namectg` WHERE exmnid=(select exmnid from exm_catg where exm_ctgid=$p->exm_ctgid)")->row();
									// get class name
									$c=$this->db->select("*")->from("class_catg")->where("classid",$p->classid)->get()->row();
									// get shift name
									$s=$this->db->select("*")->from("shift_catg")->where("shiftid",$p->shiftid)->get()->row();
									// get subject name
									$sb=$this->db->select("*")->from("subject_class")->where("subjid",$p->subjid)->get()->row();
									// get teacher name
									$t=$this->db->select("*")->from("empee")->where("empid",$p->techID)->get()->row();
							
							?>
							
								<div class="col-md-10" style="" id="eachPid" style="border:1px solid #e3e3e3;">
									<table class="table" id="pTokn">
										<tr>
											<th>Paper ID</th>
											<td> : <?php echo $p->pdisid; ?></td>
											<th>Exam </th>
											<td> : <?php echo ucwords($xnm->exm_name); ?></td>
										</tr>
										<tr>
											<th>Class </th>
											<td> : <?php echo ucwords($c->class_name) ?></td>
											<th>Shift </th>
											<td> : <?php echo ucwords($s->shift_N) ?></td>
										</tr>
										<tr>
											<th>Section </th>
											<td> : <?php echo ucwords($p->section) ?></td>
											<th>Subject </th>
											<td> : <?php echo ucwords($sb->sub_name) ?></td>
										</tr>
										<tr>
											<th>Teacher </th>
											<td> : <?php echo $t->name . "( " .$t->empid. " )" ?></td>
											<th>Total Paper </th>
											<td> : <?php echo $p->tpaper ?></td>
										</tr>
										<tr>
											<th>Distribute Date </th>
											<td> : <?php echo $p->disdate ?></td>
											<th>Return Date </th>
											<td> : <?php echo $p->retdate ?></td>
										</tr>
									</table>
							</div>

						<?php endforeach; } if(isset($_GET['id'])||isset($_POST['goPt'])){?>
						
						<div class="col-md-10" id="pBtn">
							<button class="btn btn-primary" id="pbtn" style="width:30%;margin-left:40%;" onClick="window.print()">
								Print
							</button>
						</div>
						<?php } ?>
						</div>
					</div> 
				 </div>
<?php
 if(isset($_POST['go'])||isset($_GET['pid'])){
?>
			</div>
		</div>
	</section>
</aside> 
<?php } ?>