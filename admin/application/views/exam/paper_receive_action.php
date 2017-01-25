<style type="text/css">
	table tr td{
		border:none !important;
	}
</style>

<!-- script -->
<script type="text/javascript">
	function chkTot(gTot,aTot){     // gTot->given total  //aTot->actual total
		if(parseInt(gTot)>parseInt(aTot)){
			alert("Wrong Entry.Distribute paper amount is "+aTot);
			document.getElementById("tt").value="";
			document.getElementById("tt").focus();
		}else if(parseInt(gTot)<parseInt(aTot)){
			alert("Some exam paper missing.You should be comment.");
			document.getElementById("comment").setAttribute("required","required");
			document.getElementById("comment").focus();
		}else{
			$("#comment").removeAttr("required");
		}
	}
</script>
<!-- script -->

<aside class="right-side">
<section class="content-header">
                    <h1>
                        Exam Paper Received
                        <small>Control panel</small>
                    </h1>
                <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<?php 
	$id=$_POST['pid'];
// check if this id is valid
	$idValid=$this->db->select("*")->from("exm_pdistribute")->where("pdisid",$id)->get()->num_rows();

if($idValid>0){

// check if duplicate value found
	$dupfnd=$this->db->select("*")->from("exm_preceive")->where("pdisid",$id)->get();
	
// check if data found
	if($dupfnd->num_rows()<=0){
// search paper value
		$dist=$this->db->select("*")->from("exm_pdistribute")->where("pdisid",$id)->get()->row();
// distribute all data
		
// distributed paper class search
	$clsName=$this->db->select("*")->from("class_catg")->where("classid",$dist->classid)->get()->row();
	
// teacher  search by teacher id	
	$teacher=$this->db->select("*")->from("empee")->where("empid",$dist->techID)->get()->row();
	
// select subject name
	$sub=$this->db->query("SELECT s.subjid,p.sub_name FROM subject_class s right join subject_setup p ON s.subsetid = p.subsetid WHERE s.subjid = '$dist->subjid'")->row();
	
// get exam id
	$exam_id=$this->db->select("*")->from("exm_catg")->where("exm_ctgid",$dist->exm_ctgid)->get()->row();
	
// get exam name
	$exam=$this->db->select("*")->from("exm_namectg")->where("exmnid",$exam_id->exmnid)->get()->row();
				
			
?>

<section>
	<div class="container-fluid">
	<div class="col-md-12">
		<div style="margin-top:20px;">
			<div class="panel panel-primary">
			<div class="panel-body">
				<form action="index.php/allSubmit/paperReceived" class="form-inline" method="post">
				<table class="table">
					<tr>
						<td>Examination Name :</td>
						<td colspan="2">
						<input type="hidden" name="distId" id="distId" value="<?php echo $id; ?>" />
							<input type="text" name="exam" value="<?php echo $exam->exm_name; ?>" class="form-control" disabled /></td>
						<td></td>
					</tr>
					<tr>
						<td>Teacher Name :</td>
						<td><input type="text" name="tname" value="<?php echo $teacher->name; ?>" class="form-control" disabled /> </td>
						<td>Subject :</td>
						<td><input type="text" name="sub" value="<?php echo $sub->sub_name  ?>" class="form-control" disabled /></td>
					</tr>
					<tr>
						<td>Class : </td>
						<td><input type="text" name="class" value="<?php echo $clsName->class_name ?>" class="form-control" disabled /></td>
						<td>Section :</td>
						<td><input type="text" name="section" value="<?php echo $dist->section ?>" class="form-control" disabled /> <?php  ?></td>
					</tr>
					
					<tr>
						<td>Distribute Date :</td>
						<td><input type="text" name="disDate" value="<?php echo $dist->disdate ?>" class="form-control" disabled /></td>
						<td>Return Date :</td>
						<td><input type="text" name="returnDate" value="<?php echo $dist->retdate ?>" class="form-control" disabled /></td>
					</tr>

					<tr>
						<td>Received Paper :</td>
						<td>
							<input type="text" name="tt" id="tt" class="form-control" onkeypress="return isNumber(event)" onchange="chkTot(this.value,tt1.value)" required />
						</td>
						<td>Total Paper :</td>
						<td>
							<input type="text" name="tt1" id="tt1" value="<?php echo $dist->tpaper;  ?>" class="form-control" disabled />
						</td>
					</tr>

					<tr>
						<td>Comment :</td>
						<td colspan="2">
							<textarea class="form-control" name="comment" id="comment"></textarea>
						</td>
						<td></td>
					</tr>
				</table>

				<table class="table">
		    			<tr>
		    			<td style="width:1%;"></td>
		    			
		    				<td>
			    				<a href="index.php/exam/paperProcessing">
			    					<button type="button" name="reset" class="btn btn-info" onclick="resetAll()">
			    						<span class="glyphicon glyphicon-arrow-left" aria-hidden="true"> Back
			    						</span>
			    					</button>
			    				</a>
		    					<button type="submit" name="ok" class="btn btn-primary" >
		    						<span class="glyphicon glyphicon-send" aria-hidden="true"> Submit
		    						</span>
		    					</button>
		    				</td>
		    				<td></td>
		    			</tr>
		    		</table>

				</form>
			</div>
			</div>
			</div>
		</div>
	</div>
</section>
</aside>

<?php
	}else{
		
?>

	<section>
	<div class="container-fluid">
		<div class="col-md-12">
			<div class="col-md-12" style="min-height:50px;">
				<div class="alert alert-success" id="s" role="alert" style="margin-top:10px;margin-bottom:0px;">
				  <p><span class="glyphicon glyphicon-ok"></span> &nbsp;&nbsp;Sorry !!! This paper already received.</p>
				</div>
				<a href="index.php/exam/paperProcessing">
					<button class="btn btn-primary" style="margin-left:50%;margin-top:5px;"><span class="glyphicon glyphicon-arrow-left"></span> &nbsp;&nbsp;Back</button>
				</a>
			</div>
		</div>
	</div>
  </section>

<?php
	}
}else{

?>

<section>
	<div class="container-fluid">
		<div class="col-md-12">
			<div class="col-md-12" style="min-height:50px;">
				<div class="alert alert-warning" id="s" role="alert" style="margin-top:10px;margin-bottom:0px;">
				  <p><span class="glyphicon glyphicon-remove"></span> &nbsp;&nbsp;Sorry !!! No Data Availabe for this Distribute Code</p>
				</div>
				<a href="index.php/exam/paperProcessing">
					<button class="btn btn-primary" style="margin-left:50%;margin-top:5px;"><span class="glyphicon glyphicon-arrow-left"></span> &nbsp;&nbsp;Back</button>
				</a>
			</div>
		</div>
	</div>
  </section>
</aside>

<?php
}
?>