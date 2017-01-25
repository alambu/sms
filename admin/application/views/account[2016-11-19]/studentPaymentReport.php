<script type="text/javascript">
	// modal call function
function showAjaxModal(url){

	// SHOWING AJAX PRELOADER IMAGE
	jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:50px;"><img src="img/ajax-loader3.GIF" /></div>');

	// LOADING THE AJAX MODAL
	jQuery('#modal_ajax').modal({backdrop: 'static'});

	// SHOW AJAX RESPONSE ON REQUEST SUCCESS
	$.ajax({
		url: url,
		success: function(response)
		{
			jQuery('#modal_ajax .modal-body').html(response);
		}
	});
}
// modal call function end

// receipt modal start
function receiptModalFunction(url){
	// loading image
	jQuery('#receiptModal .modal-body').html('<div style="text-align:center;margin-top:50px;"><img src="img/ajax-loader3.GIF" /></div>');
	
	// ping requested page
	jQuery('#receiptModal').modal({backdrop: 'static'});
	
	// show responed page in modal
	$.ajax({
		url: url,
		success: function(response)
		{
			jQuery('#receiptModal .modal-body').html(response);
		}
	});
}
// receipt modal end

// get class by shift id for report
function getClassReceipt( shift ){
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
				document.getElementById("classnamerepo").innerHTML = '';
				document.getElementById("classnamerepo").innerHTML = '<option value="">Select</option>';

				// reset section
				document.getElementById("sectionsrepo").innerHTML = '';
				document.getElementById("sectionsrepo").innerHTML = '<option value="">Select</option>';				

				// set new class
				for(var j = 0;j < className.length;j++){
					document.getElementById("classnamerepo").innerHTML += '<option value="'+classId[j]+'">'+className[j]+'</option>';
				}

			}else{
				// reset class
				document.getElementById("classnamerepo").innerHTML = '';
				document.getElementById("classnamerepo").innerHTML = '<option value="">Select</option>';
				
				// reset section
				document.getElementById("sectionsrepo").innerHTML = '';
				document.getElementById("sectionsrepo").innerHTML = '<option value="">Select</option>';
			}
		}
	});
}


// get class section name
function ClassSectionReceipt(cls){
    document.getElementById("sectionsrepo").innerHTML="<option value=''>Select</option>";
        // document.getElementById("sub").innerHTML="<option value=''>Select</option>";
        $.ajax({
            url:"index.php/account/changeClassSection",
            data:{clsid:cls},
            type:"POST",
            success:function(str){
                //alert(str);
                
                var secValue = str.split("+");
                
                var secName = secValue[0];
                var secId = secValue[1];

                var secNm = secName.split(",");  // section value split 
                var secD = secId.split(",");  // section value split 

                for(var i = 0;i < secNm.length;i++){
                document.getElementById("sectionsrepo").innerHTML+="<option value='"+secD[i]+"'>"+secNm[i]+"</option>";
                }
            }
        });
    }

</script>

<style type="text/css">
	#paymentBtn{display: none;}
</style>

<?php
	if(isset($_POST['ReportSearch'])):
		extract($_POST);
	endif;
?>

<form action="" method="post" class="form-horizontal" >
	<div class="row">
		<div class="col-sm-12">
			<div class="form-group">
				
		  		
		  		<div class="col-sm-2">
		  			<label class="control-label">Shift:</label>         
					<select class="form-control" name="shiftid" id="shiftidrepo" required onchange="getClassReceipt(this.value)">
						<option value="">Select</option>
					<?php 
						$sqlaccs=$this->db->select('*')->from('shift_catg')->get()->result();										
						foreach($sqlaccs as $accidshows){
					?>
						<option value="<?php echo $accidshows->shiftid ?>" <?php if(isset($shiftid)):if($shiftid == $accidshows->shiftid):echo "Selected";endif;endif; ?> ><?php echo $accidshows->shift_N?></option>
					
					<?php }?>
					
					</select>
		  		</div>

	  			
	  			<div class="col-sm-3">
	  				<label class="control-label" >Class Name:</label>          
					<select class="form-control" name="classname" id="classnamerepo" onchange="ClassSectionReceipt(this.value);">
						<option value="">Select</option>
					<?php
						if(isset($shiftid)):
							$shiftData = array( "shiftid" => $shiftid );
							$getClass = $this->db->get_where("class_catg",$shiftData)->result();
							foreach($getClass as $gc):
					?>
						<option value="<?php echo $gc->classid ?>" <?php if(isset($classname)):if($classname == $gc->classid):echo "selected";endif;endif; ?> ><?php echo $gc->class_name ?></option>
					<?php
						endforeach;
						endif;
					?>
					</select>
	  			</div>

	   			
	  			
	  			<div class="col-sm-3">
	  				<label class="control-label" >Section:</label>          
					<select class="form-control" name="sections" id="sectionsrepo" >
						<option value="">Select</option>
					<?php
						if(isset($classname)):
							$secData = array( "classid" => $classname );
							$getSection = $this->db->order_by("section_name","ASC")->get_where("section_tbl",$secData)->result();
							foreach( $getSection as $gs ):
					?>
						<option value="<?php echo $gs->sectionid ?>" <?php if(isset($sections)):if($sections == $gs->sectionid):echo "selected";endif;endif; ?> ><?php echo $gs->section_name ?></option>
					<?php
						endforeach;
						endif;
					?>
					</select>
	  			</div>

	   			
				  
				  <div class="col-sm-2">
				  	<label class="control-label">Roll No:</label>        
					<input type="text" name="stuclroll"  class="form-control" id="rollidrepo" placeholder="Roll No" value="<?php if(isset($stuclroll)):echo $stuclroll;endif; ?>" />
				  </div>

				  <br/>
				  <div class="col-sm-2" style="margin-top: 7px;">
				  		<button class="btn btn-primary" name="ReportSearch" id="ReportSearch" type="submit" >search</button>
				  </div>

			</div>
  		</div>
	</div>
	</form><br/>
						
<?php
	if(isset($_POST['ReportSearch'])):

		$data = array();
		
		// if shift selected
		if( $shiftid ):
			$data['r.shiftid'] = $shiftid;
		endif;

		// if class selected
		if( $classname ):
			$data["stp.classid"] = $classname;
		endif;

		// if roll no selected
		if( $stuclroll ):
			$data['r.roll_no'] = $stuclroll;
		endif;
	
		// if section is set
		if( $sections ):
			$data['p.sectionid'] = $sections;
		endif;

	else:
		
		$month = date("m");
		$year = date("Y");

		$data = array(
				"stp.month" => $month,
				"stp.year"  => $year
			);
	endif;

	$paymentReport = $this->accmodone->studentPaymentReport( $data );

	// echo "<pre>";
	// print_r($paymentReport);
	// echo $this->db->last_query();

?>

	<table id="example1" class="table table-bordered table-striped">
		
		<thead>
			<tr>
				<th>SI</th>
				<th>Student ID</th>	
				<th>Student Name</th>
				<th>Shift</th>
				<th>Class</th>
				<th>Section</th>
				<th>Roll</th>
				<th>Invoice No</th>
				<th>Transaction No</th>
				<th>Amount</th>
				<th>Bill Date</th>
				<th>Payment Date</th>				
				<th>Action</th>				
			</tr>
		</thead>
		
		<tbody>
	
<?php
	$si = 0; 
	foreach($paymentReport as $report):
		$si++;
?>

			<tr>
				<td><?php echo $si ?></td>
				<td><?php echo $report->stu_id ?></td>
				<td><?php echo $report->name ?></td>
				<td><?php echo $report->shift_N ?></td>
				<td><?php echo $report->class_name ?></td>
				<td><?php echo $report->section_name ?></td>
				<td><?php echo $report->roll_no ?></td>
				<td>
					<a href="javascript:void(0)" onclick="showAjaxModal('index.php/account_billgenerate/bill_description/<?php echo $report->invoice_no ?>');">
					
					<?php echo $report->invoice_no ?>
					
					</a>
				</td>
				<td>
					<a href="javascript:void(0)" onclick="receiptModalFunction('index.php/account_billgenerate/receiptCopy/<?php echo $report->trans_id ?>');">
					
					<?php echo $report->trans_id ?>

					</a>
				</td>
				<td><?php echo $report->payment ?></td>
				<td><?php echo $report->bdate ?></td>
				<td><?php echo $report->pdate ?></td>
				<td>
					<a href="account_billgenerate/receiptCopyPrint/<?php echo $report->trans_id ?>" target="_blank" ><button class="btn btn-primary btn-sm">Print</button></a>
				</td>
			</tr>
<?php
	endforeach;
?>
		</tbody>
	</table>


	<!-- start bill details modal -->
	<div class="modal fade" id="modal_ajax" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">×</button>
			  <h4 class="modal-title">Bill Details</h4>
			</div>
			<div class="modal-body">
				
			</div>
			<div class="modal-footer">
			
			  <button type="submit" class="btn btn-default" id="paymentBtn" >Payment</button>

			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			
			</div>
		  </div>						  
		</div>
	</div>

<!-- bill details modal end -->

<!-- receipt copy section start -->
<div class="modal fade" id="receiptModal" role="dialog">
		<div class="modal-dialog">
		
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">×</button>
			  <h4 class="modal-title">Receipt Copy</h4>
			</div>
			<div class="modal-body">
				
			</div>
			
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		  
		  </div>						  
		</div>
	</div>
<!-- receipt copy section end -->