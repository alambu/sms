<style type="text/css">
	#rmRepFo tr{
		background: none !important;
	}
	#rmRepFo{margin-top: 10px;}
	#rmRepFo tr th{line-height: 28px;}
</style>

<script type="text/javascript">
	$(document).ready(function(){
   		$("#roomRep").dataTable();    
	});


// this is for edit function
function editData( str ){
	// room number field
	document.getElementById("rmNumber"+str).style.display = 'none';
	document.getElementById("rmNo"+str).type = 'text';

	// room name field
	document.getElementById("rmName"+str).style.display = 'none';
	document.getElementById("rnNm"+str).type = 'text';

	// success button 
	document.getElementById("succErr"+str).setAttribute("onclick","succData("+str+")");
	document.getElementById("succErr"+str).className = "btn btn-success";
	document.getElementById("icon"+str).className = "glyphicon glyphicon-ok";
}


// this is for success function
function succData( str ){

// check if any value is empty
var rmno = document.getElementById("rmNo"+str).value;
var rmnm = document.getElementById("rnNm"+str).value;
var rid = document.getElementById("roomID"+str).value;

if( rmno == '' ){
	alert("Empty Room no.");
	document.getElementById("rmNo"+str).focus();
	return false;
}else if( rmnm == '' ){
	alert("Empty Room Name.");
	document.getElementById("rnNm"+str).focus();
	return false;
}else{
	$.ajax({
		type:"POST",
		url:"index.php/edit/UpdateRoomData",
		data:{d:rmno,dd:rmnm,ddd:rid},
		success:function( data ){
			if( data > 0 ){
				alert("Successfuly data modify.");
				// put data into span 
				document.getElementById("rmNumber"+str).innerHTML = rmno;
				document.getElementById("rmName"+str).innerHTML = rmnm;
			}
		}
	});
}

	// room number field
	document.getElementById("rmNumber"+str).style.display = 'block';
	document.getElementById("rmNo"+str).type = 'hidden';

	// room name field
	document.getElementById("rmName"+str).style.display = 'block';
	document.getElementById("rnNm"+str).type = 'hidden';

	// success button 
	document.getElementById("succErr"+str).setAttribute("onclick","editData("+str+")");
	document.getElementById("succErr"+str).className = "btn btn-primary";
	document.getElementById("icon"+str).className = "glyphicon glyphicon-edit";
}

function duplicateRoomChk( rmNo,rmNm,indicat,rid ){
	$.ajax({
		type:"POST",
		url:"index.php/xmAllRequest/duplicateRoom",
		data:{rn:rmNo,rm:rmNm},
		success:function(data){
			// check on change field
			if( indicat == 'r' ){
				var id = "rmNo";
			}else if( indicat == 'n' ){
				var id = "rnNm";
			}

			if( data > 0 ){
				alert("This room is already setup.");
				document.getElementById(id+rid).value = '';
				document.getElementById(id+rid).focus();
			}
		}
	});
}

</script>
<!-- <aside class="right-side">
<section class="content-header">
    <h1>
        <a href="index.php/xmReport/roomRep">Room Setup</a>
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section> -->

<?php 
// initializer
	$si=0;
// datalist 
	$dList=$this->db->select("*")->from("room_settup")->limit(3)->get()->result();
	// if set search button
	if(isset($_POST['ok'])){
		extract($_POST);
		

		if(($roomNo!='')&&($roomNm=='')){
			$roomLst=$this->db->select("*")->from("room_settup")->where("room_number",$roomNo)->get()->result();
		}else if(($roomNo=='')&&($roomNm!='')){
			$roomLst=$this->db->select("*")->from("room_settup")->like("r_name",$roomNm)->get()->result();
		}else if(($roomNo!='')&&($roomNm!='')){
			$roomLst=$this->db->select("*")->from("room_settup")->where("room_number",$roomNo)->like("r_name",$roomNm)->get()->result();
		}else{
			$roomLst=$this->db->select("*")->from("room_settup")->get()->result();
		}

	}else{
		$roomLst=$this->db->select("*")->from("room_settup")->get()->result();
	}
?>

<!-- <section>
	<div class="container-fluid">
	<div class="col-md-12"> -->
	<div class="panel panel-default" style="margin-top:20px;">
		<div class="panel-heading"><center id="title">Room List</center></div>
		<div class="table-responsive">
		<form action="" method="post">
			<table class="table" id="rmRepFo">
				<tr>
					<th>Room No : </th>
					<td>
						<input type="text" name="roomNo" id="roomNo" class="form-control" value="<?php if(isset($_POST['ok'])){echo $roomNo;} ?>" list="rmNo" />
						<datalist id="rmNo">
							<?php foreach($dList as $d): ?>	
							<option value="<?php echo $d->room_number ?>">
							<?php endforeach; ?>
						</datalist>
					</td>
					<th>Room Name : </th>
					<td>
						<input type="text" name="roomNm" id="roomNm" class="form-control" value="<?php if(isset($_POST['ok'])){echo $roomNm;} ?>" list="rmNm" />
						<datalist id="rmNm">
							<?php foreach($dList as $L): ?>
								<option value="<?php echo $L->r_name ?>">
							<?php endforeach; ?>
						</datalist>
					</td>
					<td></td>
					<td>
						<button class="btn btn-primary" name="ok">
							<span class="glyphicon glyphicon-search"></span> Search
						</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
		<div class="table-responsive">
			<table class="table" id="roomRep">
				<thead>
					<tr style="background:#d0d0d0;">
						<th>SI</th>
						<th>Room No</th>
						<th>Room Name</th>
						<th>Insert Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				
				<?php foreach($roomLst as $r): $si++;$ed=explode(" ", $r->e_date); ?>
				
					<tr>
						<td><?php echo $si; ?></td>
						<td>
							<span id="rmNumber<?php echo $si ?>"><?php echo $r->room_number ?></span>
							<input type="hidden" name="rmNo" id="rmNo<?php echo $si ?>" class="form-control" value="<?php echo $r->room_number ?>" onchange="duplicateRoomChk(this.value,rnNm<?php echo $si ?>.value,'r',<?php echo $si ?>)" />
							<input type="hidden" name="roomID" id="roomID<?php echo $si ?>" value="<?php echo $r->roomid ?>" />
						</td>
						<td>
							<span id="rmName<?php echo $si ?>"><?php echo $r->r_name ?></span>
							<input type="hidden" name="rmName" id="rnNm<?php echo $si ?>" value="<?php echo $r->r_name ?>" class="form-control" onchange="duplicateRoomChk(rmNo<?php echo $si ?>.value,this.value,'n',<?php echo $si ?>)" />
						</td>
						<td><?php echo $ed[0]; ?></td>
						<td>
							<button type="button" id="succErr<?php echo $si ?>" name="succErr" class="btn btn-primary" onclick="editData(<?php echo $si ?>)">
								<span class="glyphicon glyphicon-edit" id="icon<?php echo $si ?>"></span>
							</button>
						</td>
					</tr>

				<?php endforeach; ?>

				</tbody>
			</table>
		</div>
	</div>
	<!-- </div>
</section>
</aside> -->