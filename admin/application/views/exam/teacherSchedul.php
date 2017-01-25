<head>
    <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php //echo base_url(); ?>autocomplete/src/jquery.tokeninput.js"></script>

    <link rel="stylesheet" href="<?php //echo base_url(); ?>autocomplete/styles/token-input.css" type="text/css" />
    <link rel="stylesheet" href="<?php //echo base_url(); ?>autocomplete/styles/token-input-facebook.css" type="text/css" />-->


<!--<script src="<?php //echo base_url(); ?>autocomplete/anotherTheme/jquery1.10.2.js"></script>
-->

<script type="text/javascript">
	function chkValidity(){
		// get total room row
		var rmNm=document.getElementById("hid").value;
		for(var k=0;k<rmNm;k++){
			// get morinig data
			var mr=document.getElementById("mteach"+k).value;
			// get evening data
			var ev=document.getElementById("eteach"+k).value;
			if((mr!='')&&(ev=='')){
				document.getElementById("eteach"+k).focus();
				alert("Pls complete evening teacher schedule of this room.");
				return false;
			}else if((mr=='')&&(ev!='')){
				document.getElementById("mteach"+k).focus();
				alert("Pls complete morning teacher schedule of this room.");
				return false;
			}else if((mr=='')&&(ev=='')){return false;}
			else{return true;}
		}
	}
</script>

 <link rel="stylesheet" href="<?php echo base_url(); ?>autocomplete/anotherTheme/jqueryUI.css"> 
<!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
<?php
	$data=$this->db->query("SELECT empid,nickN FROM empee WHERE emptypeid='1'")->result();
?>




<?php
	if(isset($_POST['ok'])){
		extract($_POST);
		// get exam name
		$xm=$this->db->query("SELECT * FROM exm_namectg WHERE exmnid IN(SELECT exmnid FROM exm_catg WHERE exm_ctgid=$exam_name)")->row();
		// get room number
		$rm=$this->db->select("*")->from("exm_seatplain")->where("exm_ctgid",$exam_name)->group_by("room")->get()->result();
		// get teacher schedule data
		$tSche=$this->db->select("*")->from("exm_teacher_schedul")->where("exm_date",$xmDate)->where("exm_ctgid",$exam_name)->get()->result();
	}
?>

<aside class="right-side">
	<section class="content-header">
        <h1>
           Teacher Exam Schedule
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
		<p><h4 style="position:relative;top:15px;margin-bottom:25px !important;"><span class="label label-primary">Exam Routine For &raquo; <?php echo $xm->exm_name ?></span><br/> <span class="label label-primary">Date of &raquo; <?php echo $xmDate ?></span></h4>
		</p>
			<div class="panel panel-default" style="margin-top:20px;">
				<div class="panel-body">
  					<?php //if(count($tSche)>=count($rm)): ?>
  						<!-- <h3 style="color:red;">Teacher Schedule for this date of this exam are already completed</h3> -->
  					<?php //else: ?>
  						<form action="index.php/allSubmit/tSchedul" method="post" >
  							<table class="table">
  								<thead>
  									<tr>
  										<th>SI</th>
  										<th>Room Name</th>
  										<th>Morning (10:00 AM-1:00 PM)</th>
  										<th>Evening (2:00 PM-5:00 PM)</th>
  									</tr>
  								</thead>
  								<tbody>
  								<?php $si=0;foreach($rm as $r):$si++; ?>
  									<!-- get room name and number -->
  									<?php 
  									// if this room setting is not set
  									$rmSt=$this->db->select("*")->from("exm_teacher_schedul")->where("exm_date",$xmDate)->where("exm_ctgid",$exam_name)->where("room",$r->room)->get()->num_rows();
  									if($rmSt<=0):
  									// get room name
  										$rNm=$this->db->select("*")->from("room_settup")->where("roomid",$r->room)->get()->row();
  									 ?>
  									<tr>
  										<td><?php echo $si ?></td>
  										<td>
  											<?php echo $rNm->r_name." (".$rNm->room_number." )"; ?>
  										<input type="hidden" name="room[]" value="<?php echo $r->room; ?>" />
  										<input type="hidden" name="exmid" value="<?php echo $exam_name; ?>" />
  										<input type="hidden" name="exmDate" value="<?php echo $xmDate; ?>" />
  										</td>
  										<td>
  											<input type="text" id="mteach<?php echo $si ?>" name="mteach[]" class="form-control" placeholder="Teacher">
  										</td>
  										<td>
  											<input type="text" name="eteach[]" class="form-control" id="eteach<?php echo $si ?>" placeholder="Teacher">
  										</td>
  									</tr>
  								<?php endif;endforeach; ?>
  								<tr>
  									<td>
  										<a href="index.php/exam/xmController">
  										<button class="btn btn-success" type="button" style="position:relative;left:10%;width:100px;"><span class="glyphicon glyphicon-arrow-left"></span> Back</button>
  										</a>
  									</td>
  									<td colspan="3">
  										<input type="hidden" name="hid" id="hid" value="<?php echo $si; ?>">
  										<button class="btn btn-primary" type="submit" style="position:relative;float:right;width:100px;right:10%;" >Save</button>
  									</td>

  								</tr>
  								</tbody>
  							</table>
  						</form>
  					<?php //endif; ?>
  				</div>
			</div>
		</div>
	</div>
</section>
</aside>

<!-- this script for search teacher  -->
<script>
<?php for($j=1;$j<=$si;$j++): ?>

// this is for morning shift
  $(function() {
    var availableTags = [
      <?php foreach($data as $d): ?>
      "<?php echo $d->nickN.'('.$d->empid.')' ?>",
      <?php endforeach; ?>
    ];
    function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
    $( "#mteach<?php echo $j ?>" )
      // don't navigate away from the field on tab when selecting an item
      .bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        minLength: 0,
        source: function( request, response ) {
          // delegate back to autocomplete, but extract the last term
          response( $.ui.autocomplete.filter(
            availableTags, extractLast( request.term ) ) );
        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( ", " );
          return false;
        }
      });
  });

// this is for evening shift
$(function() {
    var availableTags = [
      <?php foreach($data as $d): ?>
      "<?php echo $d->nickN.'('.$d->empid.')' ?>",
      <?php endforeach; ?>
    ];
    function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
    $( "#eteach<?php echo $j ?>" )
      // don't navigate away from the field on tab when selecting an item
      .bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        minLength: 0,
        source: function( request, response ) {
          // delegate back to autocomplete, but extract the last term
          response( $.ui.autocomplete.filter(
            availableTags, extractLast( request.term ) ) );
        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( ", " );
          return false;
        }
      });
  });

<?php endfor; ?>

// end search

  </script>
