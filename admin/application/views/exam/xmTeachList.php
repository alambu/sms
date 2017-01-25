<?php
	$exam=$this->db->select("*")->from("exm_catg")->where("status",'1')->get()->result();
	// get room number
		$rM=$this->db->get("room_settup")->result();
	// teacher
		$ttd=$this->db->query("SELECT * FROM `empee` WHERE `emptypeid`=1 AND status = 1")->result();
?>


<script type="text/javascript">
	function xmDateF(str){
		$.ajax({
			type:"POST",
			url:"index.php/xmAllRequest/getXmDate",
			data:{d:str},
			success:function(data){
				if(data){
					// clear option
					document.getElementById("xmD").innerHTML='';
					document.getElementById("xmD").innerHTML='<option value="">Select</option>';
					// split data for return option
					var dArray=data.split(",");
					for(var i=0;i<dArray.length;i++){
						document.getElementById("xmD").innerHTML+='<option value="'+dArray[i]+'">'+dArray[i]+'</option>';
					}

				}else{alert("No Exam date found.First Create exam routine.");}
			}
		});
	}

	// onsubmit validation
	function checkD(){
		var rm=document.getElementById("rm").value;
		var xm=document.getElementById("xmN").value;
		var tchr=document.getElementById("tid").value;
		// test
		if((rm!='')&&(xm=='')){
			alert("Pls select exam first.");
			document.getElementById("xmN").focus();
			return false;
		}
		else if((tchr!='')&&(xm=='')){
			alert("Pls Select exam first.");
			document.getElementById("xmN").focus();
			return false;
		}
		else{return true;}
	}
	// print option
    function printDiv(divID) {
    		// hidden print button
    		document.getElementById("prt").style.display='none';

            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;
            }
</script>

<?php
	if(isset($_POST['xmSrc'])):
		extract($_POST);
	endif;
?>
<div class="panel panel-default" style="margin-top:20px;">
	<div class="panel-body">
		<form action="index.php/exam/xmController" method="post" onsubmit="return checkD()">
			<table class="table">
				<thead>
					<tr>
						<th>Exam</th>
						<th>Exam Date</th>
						<th>Time</th>
						<th>Room</th>
						<th>Teacher</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<select name="xmN" id="xmN" onchange="xmDateF(this.value)" class="form-control" style="min-width:30%;float:left;">
		    						<option value=""> Select Exam </option>
		    						<?php
		    							foreach ($exam as $key) {
		    								$exNm=$this->db->select("*")->from("exm_namectg")->where("exmnid",$key->exmnid)->get()->row();
		    							?>
		    							<option value="<?php echo $key->exm_ctgid ?>" <?php if(isset($_POST['xmSrc'])):if($xmN==$key->exm_ctgid):echo "selected";endif;endif; ?> ><?php echo $exNm->exm_name ?></option>";
		    						<?php
		    							}
		    						?>
		    					</select>
						</td>
						<td>
							<select class="form-control" name="xmD" id="xmD" style="min-width:30%;float:left;">
		    						<option value="">Select</option>
									<?php
										if( isset($_POST['xmSrc']) ):
											$xd = $this->db->select("*")->from("exm_routine")->where("exm_ctgid",$xmN)->group_by("exm_date")->get()->result();
											foreach( $xd as $xmd ):
									?>
										<option value="<?php echo $xmd->exm_date ?>" <?php if( $xmd->exm_date == $xmD ):echo "Selected";endif; ?> > <?php echo $xmd->exm_date ?> </option>
									<?php
											endforeach;
										endif;
									?>
		    					</select>
						</td>
						<td>
							<select class="form-control" name="xmTime" id="xmTime">
								<option value="">Select</option>
								<option value="10:00:00" <?php if(isset($_POST['xmSrc'])):if($xmTime=='10:00:00'):echo "selected";endif;endif; ?> >Morning</option>
								<option value="14:00:00" <?php if(isset($_POST['xmSrc'])):if($xmTime=='14:00:00'):echo "selected";endif;endif; ?>>Evening</option>
							</select>
						</td>
						<td>
							<select class="form-control" name="rm" id="rm">
								<option value="">Select</option>
								<?php foreach($rM as $r): ?>
									<option value="<?php echo $r->roomid ?>" <?php if(isset($_POST['xmSrc'])):if($rm==$r->roomid):echo "selected";endif;endif; ?>><?php echo $r->r_name."( ".$r->room_number." )" ?></option>
								<?php endforeach; ?>
							</select>
						</td>
						<td>
							<select class="form-control" name="tid" id="tid">
								<option value="">Select</option>
								<?php foreach($ttd as $t): ?>
									<option value="<?php echo $t->empid ?>" <?php if(isset($_POST['xmSrc'])):if($tid==$t->empid):echo "selected";endif;endif; ?> ><?php echo $t->name."( ".$t->empid." )" ?></option>
								<?php endforeach; ?>
							</select>
						</td>
						<td>
							<button class="btn btn-primary" type="submit" name="xmSrc"><span class="glyphicon glyphicon-search"></span> Search</button>
						</td>
					</tr>
				</tbody>
			</table>
		</form>

<?php 
	if(isset($_POST['xmSrc'])):
		extract($_POST);
	
	// only exam search
		if(($xmN != '')&&($xmD == '')&&($rm == '')&&($tid == '')&&($xmTime == '')):
			$data=$this->db->select("*")->from("exm_teacher_schedul")->where("exm_ctgid",$xmN)->get()->result();
		// exam date
		elseif(($xmN=='')&&($xmD!='')&&($rm=='')&&($tid=='')&&($xmTime=='')):
			$data=$this->db->select("*")->from("exm_teacher_schedul")->where("exm_date",$xmD)->get()->result();
		// exam name and date
		elseif(($xmN != '')&&($xmD != '')&&($rm == '')&&($tid == '')&&($xmTime == '')):
			$data=$this->db->select("*")->from("exm_teacher_schedul")->where("exm_ctgid",$xmN)->where("exm_date",$xmD)->get()->result();
		// exam name and date and time
		elseif(($xmN != '')&&($xmD != '')&&($rm == '')&&($tid == '')&&($xmTime != '')):
			$data=$this->db->select("*")->from("exm_teacher_schedul")->where("exm_ctgid",$xmN)->where("exm_date",$xmD)->where("exm_time",$xmTime)->get()->result();
		// exam name and date and time and room
		elseif(($xmN != '')&&($xmD != '')&&($rm != '')&&($tid == '')&&($xmTime != '')):
			$data=$this->db->select("*")->from("exm_teacher_schedul")->where("exm_ctgid",$xmN)->where("exm_date",$xmD)->where("exm_time",$xmTime)->where("room",$rm)->get()->result();
		// exam name and date and time and room and teacher id
		elseif(($xmN != '')&&($xmD != '')&&($rm != '')&&($tid != '')&&($xmTime != '')):
			$data=$this->db->select("*")->from("exm_teacher_schedul")->where("exm_ctgid",$xmN)->where("exm_date",$xmD)->where("exm_time",$xmTime)->where("room",$rm)->where("teachID",$tid)->get()->result();
		// exam name and room
		elseif(($xmN!='')&&($xmD=='')&&($rm!='')&&($tid=='')&&($xmTime=='')):
			$data=$this->db->select("*")->from("exm_teacher_schedul")->where("exm_ctgid",$xmN)->where("room",$rm)->get()->result();
		// exam name and time
		elseif(($xmN!='')&&($xmD=='')&&($rm=='')&&($tid=='')&&($xmTime!='')):
			$data=$this->db->select("*")->from("exm_teacher_schedul")->where("exm_ctgid",$xmN)->where("exm_time",$xmTime)->get()->result();
		// exam name and teacher
		elseif(($xmN!='')&&($xmD=='')&&($rm=='')&&($tid!='')&&($xmTime=='')):
			$temp=$this->db->select("*")->from("exm_teacher_schedul")->where("exm_ctgid",$xmN)->get()->result();
			// array data declaration
			$ttid=array();
			foreach($temp as $tp):
				// explode this data
				$tempid=explode(",", $tp->teachID);
				if(in_array($tid, $tempid)):
					array_push($ttid, $tp->id);
				endif;
			endforeach;
			$data=$this->db->select("*")->from("exm_teacher_schedul")->where_in("id",$ttid)->get()->result();
		else:
			$data=array();
		endif;
	else:
		$data=array();
	endif;
?>
<div id="printD">
	<table class="table table-striped" id="example1">
		<thead>
			<tr>
				<th>SI</th>
				<th>Exam</th>
				<th>Exam Date</th>
				<th>Time</th>
				<th>Room</th>
				<th>Teacher</th>
			</tr>
		</thead>
		<tbody>
		<?php
			 $si=0;foreach($data as $d):$si++;
			 // exam name
			$xn=$this->db->query("SELECT * FROM exm_namectg where exmnid=(SELECT exmnid from exm_catg where exm_ctgid=$d->exm_ctgid)")->row();
			// room name
			$rMn=$this->db->select("*")->from("room_settup")->where("roomid",$d->room)->get()->row();
			// explode teacher id to get teacher name
			$tcid=explode(",", $d->teachID);
			// initial store array
			$tDetails=array();
			for($m=0;$m<count($tcid);$m++):
				$tq=$this->db->select("name")->from("empee")->where("empid",$tcid[$m])->get()->row();
				$tString=$tq->name." (".$tcid[$m]." )";
				array_push($tDetails, $tString);
			endfor;

		 ?>
			<tr>
				<td><?php echo $si; ?></td>
				<td><?php echo $xn->exm_name ?></td>
				<td><?php echo $d->exm_date ?></td>
				<td><?php if(($d->exm_time>=10)&&($d->exm_time<14)):echo "Morning";else:echo "Evening";endif; ?></td>
				<td><?php echo $rMn->r_name." ( ".$rMn->room_number." )" ?></td>
				<td><?php for($n=0;$n<count($tDetails);$n++):echo $tDetails[$n]."<br/>";endfor; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<button class="btn btn-primary" id="prt" style="position:relative;left:40%;width:150px;" onclick="printDiv('printD')">Print</button>
	</div>
	</div>
</div>