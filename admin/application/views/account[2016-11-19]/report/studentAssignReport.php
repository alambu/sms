<script type="text/javascript">
	// get class by shift id for report
function getClassAss( shift ){
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
				document.getElementById("classnameAss").innerHTML = '';
				document.getElementById("classnameAss").innerHTML = '<option value="">Select</option>';

				// reset section
				document.getElementById("sectionsAss").innerHTML = '';
				document.getElementById("sectionsAss").innerHTML = '<option value="">Select</option>';				

				// set new class
				for(var j = 0;j < className.length;j++){
					document.getElementById("classnameAss").innerHTML += '<option value="'+classId[j]+'">'+className[j]+'</option>';
				}

			}else{
				// reset class
				document.getElementById("classnameAss").innerHTML = '';
				document.getElementById("classnameAss").innerHTML = '<option value="">Select</option>';
				
				// reset section
				document.getElementById("sectionsAss").innerHTML = '';
				document.getElementById("sectionsAss").innerHTML = '<option value="">Select</option>';
			}
		}
	});
}


// get class section name
function ClassSectionAss(cls){
    document.getElementById("sectionsAss").innerHTML="<option value=''>Select</option>";
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
                document.getElementById("sectionsAss").innerHTML+="<option value='"+secD[i]+"'>"+secNm[i]+"</option>";
                }
            }
        });
}

//vahicale rent update
$(document).ready(function(){   
// start class fee category
$('#rentchange').submit(function(){
        $.post(
            "index.php/account/studentRentChange",
            $("#rentchange").serialize(),
            function(data){
              if(data==1)
              {              
                alert("Rent Change Successfully");                 
                window.location="accountReport/vahicleStdAssign";
                   
              }           
              else{
                  alert(data);
              }
        });
        return false;
    });
});


function vanEnableDisable( vassid,status,id ){
	var mStatus,msg,innerText,statusClass,actionBtnText,actionBtnClass,actionBtnFunction;
	if( parseInt(status) == 0 ){
		mStatus = 1;
		msg = "Van service for this student activated.";
		innerText = "Active";
		statusClass = "label label-success";
		actionBtnText = "Disable";
		actionBtnClass = "btn btn-sm btn-danger";
		actionBtnFunction = "vanEnableDisable("+vassid+","+mStatus+","+id+")";
	}else if( parseInt(status) == 1 ){
		mStatus = 0;
		msg = "Van service for this student deactivated.";
		innerText = "Deactive";
		statusClass = "label label-danger";
		actionBtnText = "Enable";
		actionBtnClass = "btn btn-sm btn-success";
		actionBtnFunction = "vanEnableDisable("+vassid+","+mStatus+","+id+")";
	}

	$.ajax({
		type:"POST",
		url:"index.php/accountReport/EnableDisableVan/"+vassid+"/"+mStatus,
		data:{},
		success:function( data ){
			if(parseInt(data) == 1 ){
				alert(msg);
				document.getElementById("status"+id).innerText = innerText;
				document.getElementById("status"+id).setAttribute("class",statusClass);
				document.getElementById("actionBtn"+id).innerHTML = actionBtnText;
				document.getElementById("actionBtn"+id).setAttribute("class",actionBtnClass);
				document.getElementById("actionBtn"+id).setAttribute("onclick",actionBtnFunction);
			}else{
				alert("Data can't modify.");
			}
		}
	});

}


// modal call function
function showAjaxModalHistory(url){
	//alert(url);
	// SHOWING AJAX PRELOADER IMAGE
	jQuery('#modal_ajax1 .modal-body').html('<div style="text-align:center;margin-top:50px;"><img src="img/ajax-loader3.GIF" /></div>');

	// LOADING THE AJAX MODAL
	jQuery('#modal_ajax1').modal({backdrop: 'static'});

	// SHOW AJAX RESPONSE ON REQUEST SUCCESS
	//$.ajax({
	//	url: url,
		//success: function(response)
		//{
			//alert(response);
			$('#modal_ajax1 .modal-body').load(url);
		//}
	//});
}


function changeVahicaleRent(rent,assid) {
	// SHOWING AJAX PRELOADER IMAGE
	
	// LOADING THE AJAX MODAL
	document.getElementById("rent").value=rent;
	document.getElementById("assid").value=assid;
	jQuery('#modal_ajax2').modal({backdrop: 'static'});
}

// modal call function end
</script>

<?php
	error_reporting(1);
	if(isset($_POST['AssignReport'])):
		extract($_POST);
	endif;
?>

<div class="panel panel-default" style="margin-top:20px;">
        <div class="panel-body">
			<div class="col-md-12">
			<form action="" method="post" class="form">
               <div class="form-group" id="vAssignResult">
					<div class="col-sm-2">
			  			<label class="control-label">Shift:</label>         
						<select class="form-control" name="shiftid" id="shiftidAss" onchange="getClassAss(this.value)">
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
					<select class="form-control" name="classname" id="classnameAss" onchange="ClassSectionAss(this.value);">
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
					<select class="form-control" name="sections" id="sectionsAss" >
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
					<input type="text" name="stuclroll"  class="form-control" id="rollidAss" placeholder="Roll No" value="<?php if(isset($stuclroll)):echo $stuclroll;endif; ?>" onkeypress="return isNumber(event)" />
				  </div>

				  <br/>
				  <div class="col-sm-2" style="margin-top: 7px;">
				  	<button class="btn btn-primary" name="AssignReport" id="AssignReport" type="submit" ><span class="glyphicon glyphicon-search"> Search</span></button>
				  </div>
			</div>
    	</form>
    </div>

<?php
	if(isset($_POST['AssignReport'])):
		$data = array();

		// make data
		if($shiftid):
			$data['v.shiftid'] 	 = $shiftid;
		endif;

		if($classname):
			$data['v.classid'] 	 = $classname;
		endif;

		if($sections):
			$data['v.sectionid'] = $sections;
		endif;

		if($stuclroll):
			$data['v.roll'] 	 = $stuclroll;
		endif;

	else:
		$data = array(
				"v.year" => date("Y")
			);
	endif;

	// query
	$reportInfo = $this->accmodone->vanAssignReport($data);
	//echo "<pre>";
	//print_r($reportInfo);

?>

  	<!-- report section start -->
  		<div class="col-md-12" style="margin-top: 40px;">
  			<table class="table table-striped" id="example1">
  				<thead>
  					<tr>
  						<th>SI</th>
  						<th>Picture</th>
  						<th>Student Name</th>
  						<th>Shift</th>
  						<th>Class</th>
  						<th>Section</th>
  						<th>Roll</th>
  						<th>Rent</th>
  						<th>Start Date</th>
  						<th>End Date</th>
  						<th>Status</th>
  						<th>Action</th>
  					</tr>
  				</thead>
  				<tbody>

  				<?php
  					$si = 0;
  					foreach($reportInfo as $repo):
  						$si++;
  				?>

  					<tr>
  						<td><?php echo $si ?></td>
  						<td><img class="img-thumbnail" src="img/student_section/registration_form/<?php echo $repo->picture; ?>" style="height:50px;width:50px;"/></td>
  						<td><?php echo $repo->name; ?></td>
  						<td>
  							<?php echo $repo->shift_N ?>
  						</td>
  						<td><?php echo $repo->class_name ?></td>
  						<td><?php echo $repo->section_name ?></td>
  						<td><?php echo $repo->roll ?></td>
						<td><a href="javascript:void(0);" onclick="changeVahicaleRent(<?php echo $repo->amount.",".$repo->assid; ?>);"><?php echo $repo->amount ?> Tk</a></td>
  						<td><?php echo $repo->edate ?></td>
  						<td><?php if(date($repo->udate)):echo $repo->udate;endif; ?></td>
  						<td>
  						<?php
  							if($repo->status):
  								$class = "class = 'label label-success'";
  								$innerText = "Active";
  								$linkButtonText = "Disable";
  								$linkButtonClass = "btn btn-sm btn-danger";
  								$linkFunction = "onclick='vanEnableDisable(".$repo->assid.",".$repo->status.",".$si.")'";
  							else:
  								$class = "class = 'label label-danger'";
  								$innerText = "Deactived";
  								$linkButtonText = "Enable";
  								$linkButtonClass = "btn btn-sm btn-success";
  								$linkFunction = "onclick='vanEnableDisable(".$repo->assid.",".$repo->status.",".$si.")'";
  							endif;
  						?>

  							<label <?php echo $class ?> id="status<?php echo $si ?>" > <?php echo $innerText ?> </label>
  						</td>
  						<td>
  							<button class="<?php echo $linkButtonClass ?>" <?php echo $linkFunction ?> id="actionBtn<?php echo $si ?>" ><?php echo $linkButtonText ?></button>
							<button type="button" class="btn btn-info btn-sm" onclick="showAjaxModalHistory('index.php/accountReport/vanPaymentHistory?stu_id=<?php echo $repo->stu_id; ?>');">Rent History</button>
  						</td>
  					</tr>
  					<?php
  						endforeach;
  					?>
  				</tbody>
  			</table>
  		</div>
  	</div>
</div>
  	<!-- report section end -->
	
		<!-- start modal -->
			
				<div class="modal fade" id="modal_ajax1" role="dialog">
					<div class="modal-dialog">
					
					  <!-- Modal content-->
					  <div class="modal-content">
						<div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal">×</button>
						  <h4 class="modal-title"><i class="fa fa-car"></i> Vehicles Rent History</h4>
						</div>
						<div class="modal-body">
							
						</div>
						<div class="modal-footer">
						

						  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						
						</div>
					  </div>						  
					</div>
				</div>
				
				<div class="modal fade" id="modal_ajax2" role="dialog">
					<div class="modal-dialog modal-sm">
					
					  <!-- Modal content-->
					  <div class="modal-content">
						<div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal">×</button>
						  <h4 class="modal-title"><i class="fa fa-car"></i> Vehicles Rent Change</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" id="rentchange">
							
								
								<div class="form-group">
									<label class="control-label col-sm-2" for="rent">Rent(TK):</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" required name="rent" id="rent" placeholder="Enter Rent">
										<input type="hidden" name="assid" id="assid" required value=""/>
									</div>
								</div>
							  
								<div class="form-group"> 
									<div class="col-sm-offset-2 col-sm-10">
										<button type="submit" name="changeRent" class="btn btn-primary">Change Rent</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
						

						  
						
						</div>
					  </div>						  
					</div>
				</div>
			
		<!-- end -->
