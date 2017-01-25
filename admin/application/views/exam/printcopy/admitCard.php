
<aside class="right-side">
  <section class="content-header">
    <h1>
      Exam Print Copy
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

<script type="text/javascript">
$(document).ready(function(){
 $('a[data-toggle="tab"]').on('show.bs.tab', function(e){
  localStorage.setItem('activeTab', $(e.target).attr('href'));
 });
 var activeTab = localStorage.getItem('activeTab');
 if(activeTab){
  $('#myTab a[href="' + activeTab + '"]').tab('show');
 }
 
 $("#start").datepicker({format: 'yyyy-mm-dd'
 });
 
 $("#end").datepicker({format: 'yyyy-mm-dd'
 });
 
});

</script>

<script type="text/javascript">
    // get class by shift id for report
function SingleGetClassReceipt( shift ){
    $.ajax({
        url:"account_billgenerate/getClass",
        type:"POST",
        data:{shf:shift},
        success:function( data ){
			alert(data);
            var cls = data.split("+");
            if((cls[0].length > 0) && (cls[1].length > 0)){
                var className = cls[0].split(",");
                var classId = cls[1].split(",");

                // reset class
                document.getElementById("SingleClassidrepo").innerHTML = '';
                document.getElementById("SingleClassidrepo").innerHTML = '<option value="">Select</option>';

                // reset section
                document.getElementById("SingleSectionsrepo").innerHTML = '';
                document.getElementById("SingleSectionsrepo").innerHTML = '<option value="">Select</option>';             

                // set new class
                for(var j = 0;j < className.length;j++){
                    document.getElementById("SingleClassidrepo").innerHTML += '<option value="'+classId[j]+'">'+className[j]+'</option>';
                }

            }else{
                // reset class
                document.getElementById("SingleClassidrepo").innerHTML = '';
                document.getElementById("SingleClassidrepo").innerHTML = '<option value="">Select</option>';
                
                // reset section
                document.getElementById("SingleSectionsrepo").innerHTML = '';
                document.getElementById("SingleSectionsrepo").innerHTML = '<option value="">Select</option>';
            }
        }
    });
}

// get class section name
function SingleClassSectionReceipt(cls){

    document.getElementById("SingleSectionsrepo").innerHTML="<option value=''>Select</option>";
        // document.getElementById("sub").innerHTML="<option value=''>Select</option>";
        //alert(cls);
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
                document.getElementById("SingleSectionsrepo").innerHTML+="<option value='"+secD[i]+"'>"+secNm[i]+"</option>";
                }
            }
        });
    }

// get profil information
function getProfil(shift,cls,section,roll){
    

    $.ajax({
        url:"account/getProfil",
        type:"POST",
        data:{shift:shift,class:cls,section:section,roll:roll},
        success:function(data){
            if(parseInt(data) == 2){
                alert("This roll number is not valid.Give another information.");
                document.getElementById("roll").value = '';
                document.getElementById("roll").focus();
            }else{
                var dataInfo = data.split(",");
                document.getElementById("proStu").value = dataInfo[0]
                document.getElementById("proClass").innerHTML = dataInfo[1];
                document.getElementById("proShift").innerHTML = dataInfo[2];
                document.getElementById("profilPic").src = "img/student_section/registration_form/"+dataInfo[6];
                document.getElementById("proSec").innerHTML = dataInfo[3];
                document.getElementById("proName").innerHTML = dataInfo[4];
                document.getElementById("proRoll").innerHTML = dataInfo[5];

                if( dataInfo[7] < 0 ){
                    document.getElementById("proBalance").innerHTML = dataInfo[7]+'( due )';
                }else{
                    document.getElementById("proBalance").innerHTML = dataInfo[7];
                }

            }
        }
    });
}

    function checkBoxFunction( id,status ){
        //alert(id);
        var total = parseInt(document.getElementById("totalAmount").value);
        var categoryAmount = parseInt(document.getElementById("tamount"+id).value);

        if(status == 0){   
            total += categoryAmount;
            document.getElementById("feeidck"+id).setAttribute("onclick","checkBoxFunction("+id+",1)");
        }else if( status == 1 ){
            total -= categoryAmount;
            document.getElementById("feeidck"+id).setAttribute("onclick","checkBoxFunction("+id+",0)");
        }

        document.getElementById("totalAmount").value = total;
        
    }

// calculation of approximate total
function calculateApproximateTotal( frmM,toM,id ){
    if(parseInt(frmM) > parseInt(toM)){
        alert("Invalid month selection");
        document.getElementById("fmonth"+id).value = '';
        document.getElementById("tmonth"+id).value = '';
        document.getElementById("finamount"+id).value = '';
        document.getElementById("fmonth"+id).focus();

        makeTotal();

    }else{
        var totalMonth = parseInt(toM) - parseInt(frmM) + 1;
        var feeAmount = document.getElementById("tamount"+id).value;
        var total = feeAmount * totalMonth;
        document.getElementById("finamount"+id).value = total;

        makeTotal();

    }
}

// make intotal amount
function makeTotal(){
    var max = document.getElementById("rowValue").value;
    var amount;
    var total = 0;
    
    for(var i = 1;i < max;i++){
        amount = document.getElementById("finamount"+i).value;
        
        if(isNaN(amount) || amount == '' ){
            amount = 0;
        }

        total = parseInt(total) + parseInt(amount);
    }

    document.getElementById("totalAmount").value = total;

}


//bill generate function 
function formSubmitFuncSingel(frm)
{
	document.getElementById('submitbillbtn').disabled = 'disabled';
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
		document.getElementById("submitbillbtn").disabled = false;
	 }
	}); 
	
	return false;
}

</script>


<section>
  <div class="container-fluid">
    <div class="col-md-12">

<?php $this->load->view("exam/success"); ?>

      <div class="panel panel-default" style="margin-top:20px;">

      <!-- <div class="panel-heading"><p id="title">Examination Name Entry</p></div> -->
        <div class="panel-body">

        <ul class="nav nav-tabs" id="myTab">
          <li class="active"><a data-toggle="tab" href="#home">Admit Card Print</a></li>
		  <!----
          <li><a data-toggle="tab" href="#pass">Passing Mark Setup</a></li>
          <li><a data-toggle="tab" href="#grade">Grading System</a></li>
          <li><a data-toggle="tab" href="#room">Room Setup</a></li>
          <li><a data-toggle="tab" href="#othexm">Other Exam name Setup</a></li>
		  ---------->
        </ul>

        <div class="tab-content">
          <!-- this is exam name setup -->
          <div id="home" class="tab-pane fade in active">
		  
				<div class="row">
					<div class="col-md-12">
						<form class="form-horizontal" role="form" action="index.php/exam/cardPrint" method="get" target="_blink">
							<div class="form-group col-sm-12">
								
								<div class="col-sm-2">
									<label class="control-label">Class:</label>
									<select class="form-control" name="classid" id="SingleClassidrepo"  onchange="SingleClassSectionReceipt(this.value)" required>
										<option value="">Select</option>
									<?php 
									$sqlaccs = $this->db->select('*')->from('class_catg')->get()->result();
									foreach($sqlaccs as $accidshows):
									?>
									<option value="<?php echo $accidshows->classid ?>" <?php if($classid == $accidshows->classid):echo 'selected';endif; ?> ><?php echo $accidshows->class_name ?></option>
									
									<?php endforeach; ?>
									
									</select>
							    </div>
								
								<div class="col-sm-2">
									<label class="control-label">Year :</label>
									<select class="form-control" name="year" id="SingleShift" required onchange="">
										<option value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
										<option value="<?php echo date("Y")+1; ?>"><?php echo date("Y")+1; ?></option>
									</select>
								</div>
								
								<div class="col-sm-3">
									<label class="control-label">Exam Name:</label>
									<Input type="text" name="examname" class="form-control" value="" required/>
								</div>
								
								<div class="col-sm-2">
									<label class="control-label">Start:</label>
									<Input type="text" name="start" class="form-control" id="start" value="" required/>
								</div>
								
								<div class="col-sm-2">
									<label class="control-label">End:</label>
									<Input type="text" name="end" class="form-control" id="end" value="" required/>
								</div>
								<div class="col-sm-1">
								<label class="control-label">Print:</label>
									<button type="submit"  class="btn btn-primary" ><span class="glyphicon glyphicon-print"></span> Print</button>
								</div>
							</div>	
						</form>
					</div>
				</div>
				
            
          </div>
         
        </div>
      </div>
    </div>
  </div>
</div>
</section>
</aside>