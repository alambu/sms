<style type="text/css">
	#pRecSrc tr td {
		text-align: center;
    border-top: none !important;
}
#pRecSrc tr th{
	text-align: center;
	line-height: 30px !important;
	border:none !important;
}

</style>

<!-- all script are here -->
<script type="text/javascript">
	// get section
	function chnCls(str){
		if(str!=''){
		$.ajax({
			url:"index.php/xmAllRequest/classChng",
			type:"POST",
			data:{clsid:str,rd:'1'},
			success:function(data){
				var sepD=data.split("+");
				var sect=sepD[0];
				var se=sect.split(",");

				// put section into section option
				document.getElementById("sec").innerHTML=''; // clear
				document.getElementById("sec").innerHTML='<option value="">Select</option>';
				for(var i=0;i<se.length;i++){
					document.getElementById("sec").innerHTML+='<option value="'+se[i]+'">'+se[i]+'</option>';
			}

			}
		});

		// get subject name
		$.ajax({
			url:"index.php/xmAllRequest/subjectFind",
			type:"POST",
			data:{clsid:str},
			success:function(sub){
				var sbSep=sub.split("+"); // split into name and id
				var sbnm=sbSep[0]; // subject name
				var sbid=sbSep[1];	// subject id

				var sbNm=sbnm.split(",");	// subject name split
				var sbId=sbid.split(",");	// subject id split

				// clear option
				document.getElementById("sub").innerHTML='';
				document.getElementById("sub").innerHTML='<option value="">Select</option>';
				// for loop
				for(var j=0;j<sbNm.length;j++){
					document.getElementById("sub").innerHTML+='<option value="'+sbId[j]+'">'+sbNm[j]+'</option>';
				}
			}
		});
		}
	}
	function chkVal(){
		var exam=document.getElementById("exam").value;
		var cls=document.getElementById("cls").value
		var shft=document.getElementById("shft").value
		var sec=document.getElementById("sec").value
		var sub=document.getElementById("sub").value
		var pid=document.getElementById("pid").value

		// check
		if((exam=='')&&(cls=='')&&(shft=='')&&(sec=='')&&(sub=='')&&(pid=='')){
			alert("Please select something to search");
			document.getElementById("exam").focus();
			return false;
		}else if((exam=='')&&(cls!='')&&(shft=='')&&(sec=='')&&(sub=='')&&(pid=='')){
			alert("Please select Examination Name");
			document.getElementById("exam").focus();
			return false;
		}else if((exam=='')&&(cls=='')&&(shft!='')&&(sec=='')&&(sub=='')&&(pid=='')){
			alert("Please select Examination Name");
			document.getElementById("exam").focus();
			return false;
		}else if((exam=='')&&(cls=='')&&(shft=='')&&(sec!='')&&(sub=='')&&(pid=='')){
			alert("Please select Examination Name");
			document.getElementById("exam").focus();
			return false;
		}else if((exam=='')&&(cls=='')&&(shft=='')&&(sec=='')&&(sub!='')&&(pid=='')){
			alert("Please select Examination Name");
			document.getElementById("exam").focus();
			return false;
		}
		else{return true;}
	}
</script>
<!-- all script are here -->

<!-- <aside class="right-side">
<section class="content-header">
                    <h1>
                        <a href="index.php/exam/paper_search">Exam Paper Received</a>
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
 -->

<!-- success or failed message -->
	<?php $this->load->view("exam/success"); ?>
<!-- success or failed message -->
<!-- this is for search query -->
<?php


// <!-- searching query -->
if(isset($_POST['search'])){
	extract($_POST);
	if(($exam!='')&&($cls=='')&&($shft=='')&&($sec=='')&&($sub=='')&&($pid=='')){ // only exam search
		$rst=$this->db->query("SELECT * FROM `exm_pdistribute` WHERE pdisid NOT in(select pdisid from exm_preceive) and exm_ctgid=$exam ORDER BY  `retdate` DESC")->result();		
	}elseif(($exam!='')&&($cls!='')&&($shft=='')&&($sec=='')&&($sub=='')&&($pid=='')){	// exam and class
		$rst=$this->db->query("SELECT * FROM `exm_pdistribute` WHERE pdisid NOT in(select pdisid from exm_preceive) and exm_ctgid=$exam AND classid=$cls ORDER BY  `retdate` DESC")->result();
	}elseif(($exam!='')&&($cls!='')&&($shft!='')&&($sec=='')&&($sub=='')&&($pid=='')){	// exam and class and shift
		$rst=$this->db->query("SELECT * FROM `exm_pdistribute` WHERE pdisid NOT in(select pdisid from exm_preceive) and exm_ctgid=$exam AND classid=$cls AND shiftid=$shft ORDER BY  `retdate` DESC")->result();
	}elseif(($exam!='')&&($cls!='')&&($shft!='')&&($sec!='')&&($sub=='')&&($pid=='')){	// exam and class and shift and section
		$rst=$this->db->query("SELECT * FROM `exm_pdistribute` WHERE pdisid NOT in(select pdisid from exm_preceive) and exm_ctgid=$exam AND classid=$cls AND shiftid=$shft AND section='$sec' ORDER BY  `retdate` DESC")->result();
	}elseif(($exam!='')&&($cls!='')&&($shft!='')&&($sec!='')&&($sub!='')&&($pid=='')){	// exam and class and shift and section and subject
		$rst=$this->db->query("SELECT * FROM `exm_pdistribute` WHERE pdisid NOT in(select pdisid from exm_preceive) and exm_ctgid=$exam AND classid=$cls AND shiftid=$shft AND section='$sec' AND subjid=$sub ORDER BY  `retdate` DESC")->result();
	}elseif(($exam=='')&&($cls=='')&&($shft=='')&&($sec=='')&&($sub=='')&&($pid!='')){	// only paper distribute id
		$rst=$this->db->query("SELECT * FROM `exm_pdistribute` WHERE pdisid NOT in(select pdisid from exm_preceive) and pdisid=$pid ORDER BY  `retdate` DESC")->result();
	}elseif(($exam!='')&&($cls!='')&&($shft=='')&&($sec!='')&&($sub!='')&&($pid=='')){	// exam , class , section , subject
		$rst=$this->db->query("SELECT * FROM `exm_pdistribute` WHERE pdisid NOT in(select pdisid from exm_preceive) and exm_ctgid=$exam AND classid=$cls AND section='$sec' AND subjid=$sub ORDER BY  `retdate` DESC")->result();
	}
}else{
$rst=$this->db->query("SELECT * FROM `exm_pdistribute` WHERE pdisid NOT IN(SELECT pdisid FROM exm_preceive) AND exm_ctgid IN(SELECT exm_ctgid FROM exm_catg) ORDER BY  `retdate` DESC")->result();
}
// get exam
	$exm=$this->db->select("*")->from("exm_catg")->where("status","1")->get()->result();
	// get class name
	$cl=$this->db->select("*")->from("class_catg")->get()->result();
	// shift name
	$sf=$this->db->select("*")->from("shift_catg")->get()->result();

?>
<!-- searching query -->
<!-- this is for search -->
<div class="col-md-12" style="margin-top:20px;">
	<form action="" method="post" role="form" class="form-inline" onsubmit="return chkVal()">
		<table class="table" id="pRecSrc">
		    	<tr>
		    		<th>Exam</th>
		    		<th>Class</th>
		    		<th>Shift</th>
		    		<th>Section</th>
		    		<th>Subject</th>
		    		<th>paper ID</th>
		    		<th></th>
		    	</tr>
		    	<tr>
		    		<td>
		    			<select class="form-control" name="exam" id="exam">
		    				<option value="">Select</option>
		    			<?php 
		    				foreach($exm as $e):
		    					// take exam name
		    					$xmNm=$this->db->select("*")->from("exm_namectg")->where("exmnid",$e->exmnid)->get()->row();
		    			 ?>
		    				<option value="<?php echo $e->exm_ctgid; ?>" <?php if(isset($_POST['search'])):if($e->exm_ctgid==$exam):echo "selected";endif;endif; ?> ><?php echo $xmNm->exm_name ?></option>
		    			<?php endforeach; ?>
		    			</select>
		    		</td>
		    		
		    		<td>
		    			<select class="form-control" name="cls" id="cls" onchange="chnCls(this.value)" >
		    				<option value="">Select</option>
		    			<?php foreach($cl as $c): ?>
		    				<option value="<?php echo $c->classid ?>" <?php if(isset($_POST['search'])):if($c->classid==$cls):echo "selected";endif;endif; ?> ><?php echo $c->class_name ?></option>
		    			<?php endforeach; ?>
		    			</select>
		    		</td>
		    		
		    		<td>
		    			<select class="form-control" name="shft" id="shft">
		    				<option value="">Select</option>
		    			<?php foreach($sf as $s): ?>
		    				<option value="<?php echo $s->shiftid ?>" <?php if(isset($_POST['search'])):if($s->shiftid==$shft):echo "selected";endif;endif; ?> ><?php echo $s->shift_N ?></option>
		    			<?php endforeach; ?>
		    			</select>
		    		</td>
		    		<!-- this is for selected class section data -->
		    		<?php
		    			if(isset($_POST['search'])){
		    				$secC=$this->db->select("*")->from("class_catg")->where("classid",$cls)->get()->row();
		    				$sTn=explode(",", $secC->section);
		    			}
		    		?>
		    		<!-- end query -->
		    		<td>
		    			<select class="form-control" name="sec" id="sec">
		    				<option value="">Select</option>
		    				<?php
		    					if(isset($_POST['search'])){
		    						for($i=0;$i<count($sTn);$i++):
		    					
		    				?>
		    				<option value="<?php echo $sTn[$i] ?>" <?php if($sTn[$i]==$sec):echo "selected";endif; ?>><?php echo $sTn[$i] ?></option>
		    				<?php endfor;} ?>
		    			</select>
		    		</td>
		    		<!-- get all subject data -->
		    		<?php 
		    			if(isset($_POST['search'])){
		    				$sbj=$this->db->query("SELECT s.subjid,p.sub_name FROM subject_class s right join subject_setup p ON s.subsetid = p.subsetid WHERE s.classid= '$cls'")->result();
		    			}
		    		 ?>
		    		<!-- end query -->
		    		<td>
		    			<select class="form-control" name="sub" id="sub">
		    				<option value="">Select</option>
		    				<?php
		    					if(isset($_POST['search'])){
		    						foreach($sbj as $sb):
		    				?>
		    				<option value="<?php echo $sb->subjid ?>" <?php if($sb->subjid==$sub):echo "selected";endif; ?>><?php echo $sb->sub_name ?></option>
		    				<?php			
		    						endforeach;
		    					}
		    				?>
		    			</select>
		    		</td>
		    		
		    		<td>
		    			<input type="text" class="form-control" name="pid" id="pid" onkeypress="return isNumber(event)" style="min-width:50px;" />
		    		</td>
		    		<td>
		    			<button class="btn btn-primary" type="submit" name="search" value="search">
		    				<span class="glyphicon glyphicon-search"></span> Search
		    			</button>
		    		</td>
		    	</tr>
		    </table>
	</form>
</div>
	
<?php
	function chkDate($str){
    // split date
    $getD=explode("-", $str);

    // this is for today
    $dd=date("d");
    $mm=date("m");
    $yy=date("Y");
    
    // alert(dd);
    // alert(mm);
    // alert(yy);

if($getD[0]<$yy){ 
    $rCls="danger";
    return "danger";
}
elseif($getD[0]==$yy && $getD[1]<$mm){
    $rCls="danger";
    return "danger";
}
elseif($getD[0]==$yy && $getD[1]==$mm && $getD[2]<$dd){
    $rCls="danger";
    return "danger";
}

}
?>

<!-- show result and output part -->
<div class="col-md-12">
<div class="panel panel-default">
	<div class="table-responsive">
		<table class="table table-hover" id="receiveP">
			<thead>
				<tr>
					<th>SI</th>
					<th>Paper ID</th>
					<th>Teacher</th>
					<th>Exam Name</th>
					<th>Class</th>
					<th>Shift</th>
					<th>Section</th>
					<th>Subject</th>
					<th>Total</th>
					<th>Distribute Date</th>
					<th>Return Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$v=0;
				foreach($rst as $r):
					$v++;

				// get exam id from exm_catg
				$xm=$this->db->select("*")->from("exm_catg")->where("exm_ctgid",$r->exm_ctgid)->get()->row();
				// get teacher id
				$thr=$this->db->select("*")->from("empee")->where("empid",$r->techID)->get()->row();

				// get exam name from exm_namecatg
				$xmNm=$this->db->select("*")->from("exm_namectg")->where("exmnid",$xm->exmnid)->get()->row();
				// get class name
				$cls=$this->db->select("*")->from("class_catg")->where("classid",$r->classid)->get()->row();
				// get shift name
				$sft=$this->db->select("*")->from("shift_catg")->where("shiftid",$r->shiftid)->get()->row();
				// get subject name
				$sbnm=$this->db->query("SELECT s.subjid,p.sub_name FROM subject_class s right join subject_setup p ON s.subsetid = p.subsetid WHERE s.subjid = '$r->subjid'")->row();
				$rCls='';
				
				// check valid exam date

$rCls=chkDate($r->retdate);
			 ?>
				
					<tr class="<?php echo $rCls; ?>">
					<form action="index.php/exam/paper_receive" method="post">
						<td><?php echo $v; ?></td>
						<td>
							<?php echo $r->pdisid ?><input type="hidden" name="pid" id="pid" value="<?php echo $r->pdisid ?>" />
						</td>
						<td><?php echo $thr->name; ?></td>
						<td><?php echo $xmNm->exm_name ?></td>
						<td><?php echo $cls->class_name ?></td>
						<td><?php echo $sft->shift_N ?></td>
						<td><?php echo strtoupper($r->section) ?></td>
						<td><?php echo $sbnm->sub_name ?></td>
						<td><?php echo $r->tpaper ?></td>
						<td><?php echo $r->disdate ?></td>
						<td><?php echo $r->retdate ?></td>
						<td>
							<button type="submit" name="go" class="btn btn-primary">
								<span class="glyphicon glyphicon-ok-sign"></span> Receive
							</button>
						</td>
						</form>
					</tr>
				
			<?php endforeach; ?>
			</tbody>
		</table>
		</div>
	</div>
</div>

<script type="text/javascript">
    $(function() {
        $('#receiveP').dataTable({
             "aaSorting": [[10, 'desc']]
        });
    });
</script>


<!-- show result and output part -->
<!-- 
		</div>
	</div>		
</section>
</aside> -->