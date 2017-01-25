<?php 

$datamons=array(
		'1'=>'January',
		'2'=>'February',
		'3'=>'March',
		'4'=>'April',
		'5'=>'May',
		'6'=>'June',
		'7'=>'July',
		'8'=>'August',
		'9'=>'September',
		'10'=>'October',
		'11'=>'November',
		'12'=>'December'
	);

$datamon=array(
		'1'=>'January',
		'2'=>'February',
		'3'=>'March',
		'4'=>'April',
		'5'=>'May',
		'6'=>'June',
		'7'=>'July',
		'8'=>'August',
		'9'=>'September',
		'10'=>'October',
		'11'=>'November',
		'12'=>'December'
	);

?>

<script>
function monthcek(){
	var fdate = document.getElementById("monthfdate").value;
	var edate = document.getElementById("monthedate").value;
	
	if(fdate==""){ 
		return false;
	}
	else if(edate==""){ 
		return false;
	}
	else{
var i,j,tm=0;		
		for(i=fdate;i<=edate;i++){
			tm=tm+1;
		}
		
	var tnr=document.getElementById("tonr").value;
	var totalv=0;
	for(j=1;j<tnr;j++){
		var feeid=document.getElementById("feeidck"+j).checked;
			if(feeid==true){
				var camount=document.getElementById('tamount'+j).value;
					document.getElementById("check_person"+j).value=tm;
				var tamount=parseFloat(tm)*parseFloat(camount);
					document.getElementById("finamount"+j).value=tamount.toFixed(2);
				var balan=parseFloat(tamount)+parseFloat(totalv);
				 totalv=document.getElementById("totalAmount").value=balan;
			}
	}
	
		return true;
	}
}

function checkfun(nr){
	//alert(nr);
	var frmmonth=document.getElementById("monthfdate").value;
	var endmonth=document.getElementById("monthedate").value;
	var t='feeidck'+nr;
	var d='selectg'+nr;
	var amounts="tamount"+nr;
	var ckperson="check_person"+nr;
	var selcg=document.getElementById(t).checked;
	if(frmmonth=='' || endmonth==''){
		alert("Please select month.");
		document.getElementById(t).checked=false;
		return false;
	}
	if(selcg==true){
		var bal=0;
		var i=0;
		var tm=0;
		for(i=frmmonth;i<=endmonth;i++){
			tm=tm+1;
		}
		var totalv=document.getElementById("totalAmount").value; 
		if(totalv==""){ totalv=0;}
		var camount=document.getElementById(amounts).value;
			document.getElementById(ckperson).value=tm;
		var tamount=parseFloat(tm)*parseFloat(camount);
			document.getElementById("finamount"+nr).value=tamount;
		var balan=parseFloat(tamount)+parseFloat(totalv);
		 document.getElementById("totalAmount").value=balan;			 	
		document.getElementById(d).value='1';			
	}
	else{
		document.getElementById(d).value="";
		var totalv=document.getElementById("totalAmount").value; 
		if(totalv==""){ totalv=0;}
		var camount=document.getElementById("finamount"+nr).value;
			document.getElementById(ckperson).value='';		
			document.getElementById("finamount"+nr).value='';
		var balan=totalv-camount;
		 document.getElementById("totalAmount").value=balan;			 	
		}
}
function boxdis(tcount,nr){
	if(tcount==''){tcount=0;}
	var t='feeidck'+nr;
	var selcg=document.getElementById(t).checked;
	if(selcg==false){
		document.getElementById("check_person"+nr).value=''; 
		alert("Please select at first.");
		return false;
	}
	var amounts="tamount"+nr;
	var ckperson="check_person"+nr;
	var totalv=document.getElementById("totalAmount").value; 
		if(totalv==""){ totalv=0;}
		var camount=document.getElementById(amounts).value;
		var finv=document.getElementById("finamount"+nr).value;
		var tamv=parseFloat(totalv)-parseFloat(finv);
		var tamount=parseFloat(tcount)*parseFloat(camount);
			document.getElementById("finamount"+nr).value=tamount;
		var balan=parseFloat(tamount)+parseFloat(tamv);
		 document.getElementById("totalAmount").value=balan;
}


// get class by shift id
function getClass( shift,id ){
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
				document.getElementById(id).innerHTML = '';
				document.getElementById(id).innerHTML = '<option value="">Select</option>';

				// set new class
				for(var j = 0;j < className.length;j++){
					document.getElementById(id).innerHTML += '<option value="'+classId[j]+'">'+className[j]+'</option>';
				}

			}else{
				// reset class
				document.getElementById(id).innerHTML = '';
				document.getElementById(id).innerHTML = '<option value="">Select</option>';				
			}
		}
	});
}





// modal call function
function showAjaxModal(url){
	//alert(url);
	// SHOWING AJAX PRELOADER IMAGE
	jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:50px;"><img src="img/ajax-loader3.GIF" /></div>');

	// LOADING THE AJAX MODAL
	jQuery('#modal_ajax').modal({backdrop: 'static'});

	// SHOW AJAX RESPONSE ON REQUEST SUCCESS
	$.ajax({
		url: url,
		success: function(response)
		{	
			//alert(response);
			//alert(response);
			jQuery('#modal_ajax .modal-body').html(response);
		}
	});
}
// modal call function end


// get section by class start
function ClassSectionReceipt(cls){
    document.getElementById("sectionsrepo").innerHTML="<option value=''>Select</option>";
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

// get section by class end

//bill generate function 
function formSubmitFunc(frm)
{
	document.getElementById('submitbill').disabled = 'disabled';
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
			alert("Bill Genearate Successfully");
			location.reload();
		}
		else {
			alert(data);
		}
		document.getElementById("submitbill").disabled = false;
	 }
	}); 
	
	return false;
}
</script>
<aside class="right-side"> 
 <section class="content-header">
    <h1>
        Bill Generate 
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="box">
			<div class="box-body">
				
				<div class="col-md-11" style="min-height:50px;" id="hidemessage">
					<div class="alert alert-success" style="margin-top:5px;margin-bottom:5px;">
						<strong> Successfully!</strong>Your Data insert complete.
					</div>
				</div>
				
				<div class="table-responsive">
					<div class="row">					
                    	<div class="col-md-12">
						  <ul class="nav nav-tabs" id="myTab">
							<li class="active"><a data-toggle="tab" href="#home">Bill Generate</a></li>
							<li><a href="#sbill" data-toggle="tab">Single Bill Generate</a></li>
							<li><a href="#menu1" data-toggle="tab">Reporting</a></li>
							
							<li><a href="#billPrint" data-toggle="tab">Bill Print</a></li>
						  
						  </ul>

					  <div class="tab-content">		
<!--- Start account  form -->
							<div id="home" class="tab-pane fade in active"><br/>
								<form class="form-inline" role="form" action="account_billgenerate/studentbill" onsubmit="return formSubmitFunc(this);" method="post" id="formid">
									<div class="form-group col-sm-12">
									  
									<div class="control-label col-sm-3">
										<label class="control-label">Shift :</label>
										<select class="form-control" name="shift" id="shift" onchange="getClass(this.value,'classid')">
											<option value="">Select</option>
											
											<?php
												$sft = $this->db->get("shift_catg")->result();
												foreach($sft as $s):
											?>
											<option value="<?php echo $s->shiftid ?>"><?php echo $s->shift_N ?></option>
										<?php endforeach; ?>
										</select>
									</div>


									  
									  <div class="col-sm-3" >          
											<label class="control-label">Class Name:</label>
											<select class="form-control" name="classid" id="classid" required >
											<option value="">Select</option>
											
											</select>
									  </div>

									
									<div class="col-sm-3"> 
										<label class="control-label">From Month:</label>
										<select class="form-control" name="monthfdate" id="monthfdate" required onchange="var searchval=monthcek();if(searchval==false){return false};">
											<option value="">Select Month</option>
											<?php 
													for($i=1;$i<=12;$i++){
											?>
												<option value="<?php echo $i ?>" <?php if($i < date("m")):echo "disabled";endif; ?> ><?php echo $datamon[$i]?></option>
												<?php }?>
										</select>
									</div>

									
									<div class="col-sm-3">
										<label class="control-label"> To </label>
										<!-- onchange="var searchval=monthcek();if(searchval==false){return false};" -->

										<select class="form-control" name="monthedate" id="monthedate" required onchange="htmlData('index.php/account_billgenerate/monthcheck','ch='+classid.value+'&sm='+monthfdate.value+'&tm='+this.value)" >

											<option value="">Select Month</option>
											<?php 
													for($i=1;$i<=12;$i++){
											?>
												<option value="<?php echo $i?>" <?php if($i < date("m")):echo "disabled";endif; ?> ><?php echo $datamon[$i]?></option>
												<?php }?>
										</select>
									</div>							
								</div>

									<div id="txtResult"></div>
									<div id="txtResulttow"></div>

								</form>
							</div>
							
							
							<!--- single student bill generate start -->
							<div id="sbill" class="tab-pane fade"><br/>
								<?php $this->load->view("account/singleBillGenerate") ?>
							</div>
							<!--- single student bill generate end -->
							


<!-- report form submit -->
<?php
	if(isset($_POST['billReport'])):
		extract($_POST);
	endif;
?>
<!-- report section end -->

							<div id="menu1" class="tab-pane fade"><br/>
								<form class="form-horizontal" role="form" action="" method="post">
								<div class="form-group col-sm-12">
									  
									<div class="col-sm-2">
										<label class="control-label">Shift :</label>
										<select class="form-control" name="shift" id="shiftRepo" onchange="getClass(this.value,'classidrepo')">
											<option value="">Select</option>
											
											<?php
												$sft = $this->db->get("shift_catg")->result();
												foreach($sft as $s):
											?>
											<option value="<?php echo $s->shiftid ?>" <?php if(isset($_POST['billReport'])):if($shift == $s->shiftid):echo "selected";endif;endif; ?> ><?php echo $s->shift_N ?></option>
										<?php endforeach; ?>
										</select>
									</div>

									  
									  <div class="col-sm-2">
									  	<label class="control-label">Class:</label>
										<select class="form-control" name="classid" id="classidrepo"  onchange="ClassSectionReceipt(this.value)" >
											<option value="">Select</option>
										<?php 
											if(isset($shift)):
											$sqlaccs = $this->db->select('*')->from('class_catg')->where("shiftid",$shift)->get()->result();					

											foreach($sqlaccs as $accidshows):
										?>
											<option value="<?php echo $accidshows->classid ?>" <?php if($classid == $accidshows->classid):echo 'selected';endif; ?> ><?php echo $accidshows->class_name ?></option>
										
										<?php endforeach;endif; ?>
										
										</select>
									  </div>

									  <div class="col-sm-1">
						  				<label class="control-label" >Section:</label>          
										<select class="form-control" name="sections" id="sectionsrepo" >
											<option value="">Select</option>
										<?php
											if(isset($classid)):
												$secData = array( "classid" => $classid );
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

						   			
									  
									  <div class="col-sm-1">
									  	<label class="control-label">Roll No:</label>        
										<input type="text" name="stuclroll"  class="form-control" id="rollidrepo" value="<?php if(isset($stuclroll)):echo $stuclroll;endif; ?>" />
									  </div>
									  
										<div class="col-sm-2">
											<label class="control-label">From:</label>
											<select class="form-control" name="monthfdate" id="monthfdate" onchange="var searchval=monthcek();if(searchval==false){return false};">
											<option value="">Select Month</option>
											<?php 
													for($i=1;$i<=12;$i++){
											?>
												<option value="<?php echo $i ?>" <?php if($monthfdate):if($monthfdate == $i):echo "selected";endif;endif; ?> ><?php echo $datamon[$i]?></option>
												<?php }?>
										</select>
									</div>
									  
									  
									  <div class="col-sm-2">
									  		<label class="control-label">To:</label>
											<select class="form-control" name="monthedate" id="monthedate" onchange="htmlData('index.php/account_billgenerate/monthcheck','ch='+classid.value+'&sm='+monthfdate.value+'&tm='+this.value)" >

											<option value="">Select Month</option>
											<?php 
													for($i=1;$i<=12;$i++){
											?>
												<option value="<?php echo $i ?>" <?php if($monthedate):if($monthedate == $i):echo "selected";endif;endif; ?> ><?php echo $datamon[$i] ?></option>
												<?php }?>
										</select>
										</div>


										<div class="col-sm-1">          
											<button type="submit" name="billReport" class="btn btn-primary" style="position:relative;top:26px;" ><span class="glyphicon glyphicon-send"></span>  Submit</button>
										</div>
						
								  </div>
								</form>
								
<?php
	if(isset($_POST['billReport'])):
		
		$data = array();
		// if shift selected
		if( $shift ):
			$data['r.shiftid'] = $shift;
		endif;

		// if class is selected
		if( $classid ):
			$data['stb.classid'] = $classid;
		endif;

		// if section is seleted
		if( $sections ):
			$data['r.section'] = $sections;
		endif;

		// if roll_no seelcted
		if( $stuclroll ):
			$data['r.roll_no'] = $stuclroll;
		endif;

		// from month date
		if( $monthfdate ):
			$data['from_month >'] = $monthfdate;
		endif;

		// to month date
		if( $monthedate ):
			$data['to_month <'] = $monthedate;
		endif;

	else:
		$date = 'date('.date('"Y-m-01"').')';
		$data = array(
				"stb.years" => date("Y"),
				"date(stb.e_date) >" => $date 
			);
	endif;

	// bill generate report
	$report = $this->accmodone->billGenerateReport( $data );
	
?>

								  <div class="col-md-12" style="float: left;margin-top: 50px !important;">
								  <table id="example3" class="table table-bordered table-striped">
									<thead>									
										<tr>
											<th>Nr</th>
											<th>Student ID</th>	
											<th>Student Name</th>	
											<th>Shift</th>	
											<th>Class</th>	
											<th>Section</th>	
											<th>Roll</th>	
											<th>Invoice Number</th>
											<th>Amount</th>
											<th>Month</th>	
											<th>Year</th>
											<th>Generate Date</th>
											<th>Payment Status</th>
											<th>Generate Person</th>
										</tr>
									</thead>
									<tbody>
								<?php 
									$nr = 1;
									foreach($report as $repo){
								?>
										<tr>
											<td><?php echo $nr ?></td>									
											<td><?php echo $repo->stu_id ?></td>
											<td><?php echo $repo->name; ?></td>
											
											<td><?php echo $repo->shift_N; ?></td>
											
											<td><?php echo $repo->class_name;?></td>
											
											<td><?php echo $repo->section_name; ?></td>
											
											<td><?php echo $repo->roll_no; ?></td>

											<td><a href="javascript:void(0)" onclick="showAjaxModal('index.php/account_billgenerate/bill_description/<?php echo $repo->invoice_no;?>');"><?php echo $repo->invoice_no;?></a></td>

											<td><?php echo $repo->total_bill;?></td>

											<td><?php echo $datamons[$repo->from_month] .'-'.$datamons[$repo->to_month];?></td>

											<td><?php echo $repo->years;?></td>

											<td><?php echo date("Y-m-d",strtotime($repo->gdate));?></td>
											
											<?php
												if($repo->status):
													$lclass = "label label-success";
													$ltext = "Paid";
												else:
													$lclass = "label label-danger";
													$ltext = "Unpaid";
												endif;
											?>

											<td><label class="<?php echo $lclass ?>"><?php echo $ltext ?></label></td>

											<td><?php echo $this->accmodone->getUserName($repo->e_user); ?></td>
										</tr>
										<?php $nr++;}?>
										
									</tbody>
									
							</table>
						</div>
					</div>

					<div id="billPrint" class="tab-pane fade in"><br/>
						<?php $this->load->view("account/bill_generate/invoicePrint"); ?>
					</div>
							
<!-- end of tab -->

<!-- start modal -->
						<form action="account/student_payment_form#home" method="post">
							<div class="modal fade" id="modal_ajax" role="dialog">
								<div class="modal-dialog">
								
								  <!-- Modal content-->
								  <div class="modal-content">
									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal">×</button>
									  <h4 class="modal-title">Bill Generate Details</h4>
									</div>
									<div class="modal-body">
										
									</div>
									<div class="modal-footer">
									
									  <button type="submit" class="btn btn-default" id="paymentBtn" name="invSearch" >Payment</button>

									  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									
									</div>
								  </div>						  
								</div>
							</div>
						</form>
<!-- end -->

						</div>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>
</aside>