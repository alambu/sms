<script type="text/javascript">
	// get class by shift id for report
function getClassRepo( shift ){
	$.ajax({
		url:"account_billgenerate/getClass",
		type:"POST",
		data:{shf:shift},
		success:function( data ){
			var cls = data.split("+");
			if((cls[0].length > 0) && (cls[1].length > 0)){
				var className = cls[0].split(",");
				var classId = cls[1].split(",");

				// reset class
				document.getElementById("classname").innerHTML = '';
				document.getElementById("classname").innerHTML = '<option value="">Select</option>';

				// reset section
				document.getElementById("sections").innerHTML = '';
				document.getElementById("sections").innerHTML = '<option value="">Select</option>';				

				// set new class
				for(var j = 0;j < className.length;j++){
					document.getElementById("classname").innerHTML += '<option value="'+classId[j]+'">'+className[j]+'</option>';
				}

			}else{
				// reset class
				document.getElementById("classname").innerHTML = '';
				document.getElementById("classname").innerHTML = '<option value="">Select</option>';
				
				// reset section
				document.getElementById("sections").innerHTML = '';
				document.getElementById("sections").innerHTML = '<option value="">Select</option>';
			}
		}
	});
}


// get class section name
function ClassSection(cls){
    document.getElementById("sections").innerHTML="<option value=''>Select</option>";
        // document.getElementById("sub").innerHTML="<option value=''>Select</option>";
        $.ajax({
            url:"index.php/exam/classSection",
            data:{clsid:cls},
            type:"POST",
            success:function(str){
                //alert(str);
                var data=str.split("+");  // split data into two peices section and subject
                var s=data[0];  // section value
                var sb=data[1]; // subject value
                var sid=data[2]; // subject value

                var sec=s.split(",");       // section value split into an array
                var subject=sb.split(",");  // subject value split into an array
                var subid=sid.split(",");

                for(var i=0;i<sec.length;i++){
                document.getElementById("sections").innerHTML+="<option value='"+sec[i]+"'>"+sec[i]+"</option>";
                }
            }
        });
        }

// calculate due payment of
function calculateDue( discount,totalBill ){
	
	var receiveamount=totalBill;
	if(parseInt(discount)<=parseInt(totalBill)){
		receiveamount=(parseInt(totalBill))-(parseInt(discount));
	}
	else {
		document.getElementById("discount_amount").value=0;
	}
	document.getElementById("payment").value=receiveamount;
}

var newwindow;
  function details(url){
  	newwindow=window.open(url,'name','height=600,width=800,left=300,scrollbars=yes,top=20');
  if (window.focus) {newwindow.focus()}
}
  
// modal call function
function collectionBillInfo(url){
	
	// SHOWING AJAX PRELOADER IMAGE
	jQuery('#modal_ajax_collection .modal-body').html('<div style="text-align:center;margin-top:50px;"><img src="img/ajax-loader3.GIF" /></div>');

	// LOADING THE AJAX MODAL
	jQuery('#modal_ajax_collection').modal({backdrop: 'static'});

	var str=url.split("/");
	// LOADING THE AJAX MODAL
	var receipturl="account_billgenerate/bill_description?invoice="+str[3];
	var printurl="account_billgenerate/singleinvoicePrint?invoice="+str[3];
	$("#printlink").attr("href",printurl);
	$("#invoIdrecipt").val(str[3]);
	jQuery('#modal_ajax_collection .modal-body').load(receipturl);
}
// modal call function end

	//bill payment Submit
	function formSubmitFunc(frm)
	{
		document.getElementById('pay').disabled = 'disabled';
		var formData = new FormData(frm);
		$.ajax({  
		 type: "POST",  
		 url: frm.action,  
		 data: formData,
		 async: true,
		 cache: false,
		 contentType: false,
		 processData: false,
		 beforeSend:function(){
			 document.getElementById("maincontentdiv").style.opacity = "0.7";
		 },
		 success: function(data) 
		 {
			
			document.getElementById("maincontentdiv").style.opacity = "1";
			if(data==1){
				alert("Payment Receive Successfully");
				location.reload();
			}
			else {
				alert(data);
			}
			document.getElementById("pay").disabled = false;
		 }
		}); 
		
		return false;
	}
</script>

<?php
	if(isset($_POST['stdSearch'])):
		extract($_POST);
	endif;
?>

<div class="form-horizontal" role="form" action="" method="post">		

	<!-- search by student id -->
<form action="" method="post" class="form-horizontal">
	<div class="row">
		<div class="col-sm-12">
			<div class="form-group">
	  			<form action="" method="post">
		  			<label class="control-label col-sm-2" for="pwd">Student ID:</label>
		  		
			  		<div class="col-sm-4" id="shak_id">          
						<input type="text" name="stuid"  class="form-control" id="stuid"  placeholder="Type Student ID" required value="<?php if($stuid):echo $stuid;endif; ?>" />
			  		</div>

			  		<div class="col-sm-2">
			  			<button class="btn btn-primary" name="stdSearch" id="stdSearch">Search</button>
			  		</div>
		  		</form>
			</div>
		</div>
	</div>
</form>

<!-- search by invoice id -->

<form action="" method="post" class="form-horizontal">
	<div class="row">
		<div class="col-sm-12">
			<div class="form-group">
	  			<label class="control-label col-sm-2" for="pwd">Invoice ID:</label>
	  		
		  		<div class="col-sm-4" id="shak_id">          
					<input type="text" name="invoId"  class="form-control" id="invoId"  placeholder="Type Invoce No" required value="<?php if(isset($_POST['invSearch'])):echo $_POST['invoId']; endif; ?>" />
		  		</div>

		  		<div class="col-sm-2">
		  			<button class="btn btn-primary" name="invSearch" id="invSearch">Search</button>
		  		</div>

			</div>
		</div>
	</div>
</form>


<!-- search by menu selection  -->

<?php
	if(isset($_POST['clsSearch'])):
			extract($_POST);
	endif;
?>
		
<form action="" method="post" class="form-horizontal" >
	<div class="row">
		<div class="col-sm-12">
			<div class="form-group">
				
		  		
		  		<div class="col-sm-2">
		  			<label class="control-label">Shift:</label>         
					<select class="form-control" name="shiftid" id="shiftid" required onchange="getClassRepo(this.value)">
						<option value="">Select</option>
					<?php 
						$sqlaccs=$this->db->select('*')->from('shift_catg')->get()->result();										
						foreach($sqlaccs as $accidshows){
					?>
						<option value="<?php echo $accidshows->shiftid ?>" <?php if(isset($shiftid)):if($shiftid == $accidshows->shiftid):echo "selected";endif;endif; ?> ><?php echo $accidshows->shift_N?></option>
						<?php }?>
					</select>
		  		</div>

	  			
	  			<div class="col-sm-3">
	  				<label class="control-label" >Class Name:</label>          
					<select class="form-control" name="classname" id="classname" required onchange="ClassSection(this.value);">
						<option value="">Select</option>
						<?php
							if(isset($shiftid)):
								$cData = array( "shiftid" => $shiftid );
								$allCls = $this->db->get_where("class_catg",$cData)->result();
								foreach($allCls as $ac):
						?>
							<option value="<?= $ac->classid ?>" <?php if(isset($classname)):if($classname == $ac->classid):echo "selected";endif;endif; ?> ><?= $ac->class_name ?></option>
						<?php
								endforeach;
							endif;
						?>
					</select>
	  			</div>

	   			
	  			
	  			<div class="col-sm-3">
	  				<label class="control-label" >Section:</label>          
					<select class="form-control" name="sections" id="sections" >
						<option value="">Select</option>
						
						<?php
							if(isset($classname)):
								$sData = array( "classid" => $classname );
								$secInfo = $this->db->get_where("section_tbl",$sData)->result();
								foreach( $secInfo as $sInfo ):
						?>
							<option value="<?= $sInfo->sectionid ?>" <?php if(isset($sections)):if($sections == $sInfo->section_name):echo "selected";endif;endif; ?>  ><?= $sInfo->section_name ?></option>
						<?php
								endforeach;
							endif;
						?>

					</select>
	  			</div>

	   			
				  
				  <div class="col-sm-2">
				  	<label class="control-label">Roll No:</label>        
					<input type="text" name="stuclroll"  class="form-control" id="rollid" placeholder="Roll No" value="<?php if(isset($stuclroll)):echo $stuclroll;endif; ?>" />
				  </div>

				  <br/>
				  <div class="col-sm-2" style="margin-top: 7px;">
				  		<button class="btn btn-primary" name="clsSearch" id="clsSearch" type="submit" >search</button>
				  </div>

			</div>
  		</div>
	</div>
	</form> 
</div>					

<!-- student searching option start -->
<?php
	if( (isset($_POST['stdSearch'])) || (isset($_POST['clsSearch'])) ) :
		if(isset($_POST['stdSearch'])):
			$data = array(
					"s.stu_id" => $stuid,
					"s.status" => 0
				);
			$billInfo = $this->db->select("s.*,r.name,a.roll_no,a.section,a.syear")->from("stu_bill s")->join("regis_tbl r","r.stu_id = s.stu_id","right")->join("re_admission a","a.stu_id = s.stu_id","right")->where($data)->get()->result();
		elseif(isset($_POST['clsSearch'])):

			$wdata = array(
					"r.shiftid"	=> $shiftid,
					"r.classid"	=> $classname,
					"s.section_name" => $sections,
					"r.roll_no"	=> $stuclroll
				);

			$sid = $this->db->select("r.stu_id")->from("re_admission r")->join("section_tbl s","r.section = s.sectionid","left")->where($wdata)->limit(1)->get()->row();

			$stuid = $sid->stu_id;
			
			$data = array(
					"s.stu_id" => $stuid,
					"s.status" => 0
				);

			$billInfo = $this->db->select("s.*,r.name,a.roll_no,a.section,a.syear")->from("stu_bill s")->join("regis_tbl r","r.stu_id = s.stu_id","right")->join("re_admission a","a.stu_id = s.stu_id","right")->where($data)->get()->result();
		endif;

	if(count($billInfo)):

?>

<div class="panel panel-default">
	<div class="panel-body">
	<table class="table table-border">
		<thead>
			<tr>
				<th>SI No</th>
				<th>Student ID</th>
				<th>Name</th>
				<th>Invoice No</th>
				<th>Month</th>
				<th>Amount</th>
				<th>Generated Date</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$si = 0;
			foreach($billInfo as $bInfo):
				$si++;
		?>
			<tr>
				<td><?= $si ?></td>
				<td><?= $stuid ?></td>
				<td>
					<a href="javascript:void(0);" onclick="details('student_section/registration_details?id=<?= $stuid ?>&class_name=<?= $bInfo->classid ?>&roll_no=<?= $bInfo->roll_no ?>&section=<?= $bInfo->section ?>&session=<?= $bInfo->syear ?>');"><?= $bInfo->name ?></a>
				</td>
				<td>
					<a href="javascript:void(0)" onclick="collectionBillInfo('index.php/account_billgenerate/bill_description/<?= $bInfo->invoice_no ?>');">
						<?= $bInfo->invoice_no ?>
					</a>
				</td>
				<td>
					<span class="label label-primary"><?= $this->accmodone->getMonthName($bInfo->from_month) ?></span>
					<span class="glyphicon glyphicon-minus"></span>
					<span class="label label-primary"><?= $this->accmodone->getMonthName($bInfo->to_month) ?></span>
				</td>
				<td><?= number_format($bInfo->total_bill,2); ?></td>
				<td><?= nice_date($bInfo->e_date,"Y-m-d") ?></td>
			</tr>
		
		<?php endforeach; ?>
		
		</tbody>
	</table>
	</div>
</div>

<?php 
	else:
		echo '<h3 style="text-align:center;color:green;">No Payment remaining.All bill are paid.</h3>';
	endif;
endif;
?>
<!-- student searching option end -->


<!-- all submit resutl -->
<?php
	if(isset($_POST['invSearch'])){
		extract($_POST);
		$totalbill=$this->db->query("select * from stu_bill where invoice_no=$invoId and status=0")->row();
		if(count($totalbill)>0):
		$data=array();
		$data['invoice']=$invoId;
		echo "<div style='border:1px solid gray;min-height:700px;'>";
			$this->load->view("account/invoice/moneyReceiptModal",$data);
	
		?>
		<div class="row" style="margin-top:-70px;">
		
			<div class="col-md-6">
			
			</div>
			
			<div class="col-md-4">	
				<form action="account/studentBillPayment" method="post" style="margin-top:-70px;" onsubmit="return formSubmitFunc(this);">
					<table width="200px" class="table" style="">
						<tr>
							<td>
								Bill Amount :<input name="bill_amount" readonly id="bill_amount" required type="text" onkeypress="return isNumber(event)" class="form-control input-sm" value="<?php echo $totalbill->total_bill; ?>" required />
								
							</td>
						</tr>
						
						<tr>
							<td>
								Special Wever(-) :<input name="discount_amount" id="discount_amount" required type="number" min="0" onkeypress="return isNumber(event)" class="form-control input-sm" onchange="calculateDue(this.value,totalBill.value)" value="0" required />
								
							</td>
						</tr>
						
						<tr>
							<td>
								Receive Amount :<input name="payment" id="payment" readonly required type="text" onkeypress="return isNumber(event)" class="form-control input-sm" value="<?php echo $totalbill->total_bill; ?>" required />
								<input type="hidden" name="invoice_no" id="invoice_no" value="<?php echo $invoId;?>" />
								<input type="hidden" name="totalBill" id="totalBill" value="<?php echo $totalbill->total_bill; ?>" required />
							</td>
						</tr>
						<!--
						<tr>
							<td>
								 Due :
								<input type="text" disabled readonly id="due" value="0" class="form-control" />
							</td>
						</tr>--->
						<tr>
							<td>
								<button type="submit" name="pay" id="pay" onclick="return confirm('Are Your Sure Receive Payment?');" class="btn btn-primary" style="float:right;"><span class="glyphicon glyphicon-send"></span> Receive</button>
							</td>
						</tr>
					</table>
				</form>
			</div>
			
			<div class="col-md-2">
			
			</div>
		</div>
	<?php echo "</div>"; ?>
<?php
	else:
		echo "<h3 style='color:green;text-align:center;'>Invoice ID <i style='font-size:30px;color:blue;'>".$invoId."</i> is paid !!!</h3>";
	endif; // invoice is not paid section
    }
?>

<style type="text/css">
	
</style>
<!-- start bill details modal -->

<form action="account/student_payment_form#home" method="post">
	<div class="modal fade" id="modal_ajax_collection" role="dialog">
		<div class="modal-dialog" style="width:900px;">
		
		  
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">×</button>
			  <h4 class="modal-title">Bill Generate Details</h4>
			</div>
			<div class="modal-body">
				
			</div>
			<div class="modal-footer">
			
			  <button type="submit" class="btn btn-default" name="invSearch" ><span class="glyphicon glyphicon-send"></span> Payment</button>
			  <input type="hidden" name="invoId"  id="invoIdrecipt" value="" required/>
			  <a href="javascript:void(0);" target="_blank" id="printlink">
			  <button type="button" class="btn btn-default" id="printBtn" name="printSearch" value=""><span class="glyphicon glyphicon-print"></span> Print</button>
			  </a>
			  
			  <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
			  
			</div>
		  </div>						  
		</div>
	</div>
</form>

<!-- bill details modal end -->