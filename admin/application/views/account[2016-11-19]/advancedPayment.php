<script type="text/javascript">
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
                document.getElementById("classidrepo").innerHTML = '';
                document.getElementById("classidrepo").innerHTML = '<option value="">Select</option>';

                // reset section
                document.getElementById("sectionsrepo").innerHTML = '';
                document.getElementById("sectionsrepo").innerHTML = '<option value="">Select</option>';             

                // set new class
                for(var j = 0;j < className.length;j++){
                    document.getElementById("classidrepo").innerHTML += '<option value="'+classId[j]+'">'+className[j]+'</option>';
                }

            }else{
                // reset class
                document.getElementById("classidrepo").innerHTML = '';
                document.getElementById("classidrepo").innerHTML = '<option value="">Select</option>';
                
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
       /*  if(status == 0){
            document.getElementById("fmonth"+id).disabled = false;
            document.getElementById("tmonth"+id).disabled = false;    
            document.getElementById("feeidck"+id).setAttribute("onclick","checkBoxFunction("+id+",1)");

           submitValidation(id);

        }else if( status == 1 ){
            document.getElementById("fmonth"+id).disabled = true;
            document.getElementById("tmonth"+id).disabled = true;
            document.getElementById("feeidck"+id).setAttribute("onclick","checkBoxFunction("+id+",0)");

            submitValidation( id );
        } */
		
		var total = parseInt(document.getElementById("totalAmount").value);
        var categoryAmount = parseInt(document.getElementById("tamount"+id).value);
		//alert(total);
		//alert(categoryAmount);
		
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
function calculateApproximateTotal( shift,cls,section,roll,frmM,toM,year,catg,id ){
	
    if(parseInt(frmM) > parseInt(toM)){
        alert("Invalid month selection");
        document.getElementById("fmonth"+id).value = '';
        document.getElementById("tmonth"+id).value = '';
        document.getElementById("finamount"+id).value = '';
        document.getElementById("fmonth"+id).focus();
        makeTotal();

    }else{
        $.ajax({
            url:"index.php/account/duplicatAdvanceCheck",
            type:"post",
            data:{s:shift,c:cls,sec:section,r:roll,fm:frmM,tm:toM,y:year,cat:catg},
            success:function(data){
				//alert(data);
                if(parseInt(data)){
                    alert("Advanced Payment for this month of this category has already taken.");
                    document.getElementById("fmonth"+id).value = '';
                    document.getElementById("tmonth"+id).value = '';
                    document.getElementById("finamount"+id).value = '';
                    document.getElementById("fmonth"+id).focus();

                    submitValidation(id);

                }else{
                    var totalMonth = parseInt(toM) - parseInt(frmM) + 1;
                    var feeAmount = document.getElementById("tamount"+id).value;
                    var total = feeAmount * totalMonth;
                    document.getElementById("finamount"+id).value = total;

                    makeTotal();
                }
            }
        });

    }

    submitValidation(id);
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

function submitValidation( id ){
    var amount = document.getElementById("finamount"+id).value;
    if(amount == ''){
        document.getElementById("submitbill").disabled = true;
    }else{
        document.getElementById("submitbill").disabled = false;
    }
}


//bill generate function 
function formSubmitFuncAdvance(frm)
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


<?php
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

<aside class="right-side">
    <section class="content-header">
        <h1>Advanced Payment <small> Control panel</small></h1>
        
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Advanced Payment</li>
        </ol>
    </section>

    <section>
        <div class="container-fluid">
            <div class="col-md-12">
<?php $this->load->view("exam/success"); ?>
            <div class="panel panel-default" style="margin-top:20px;">
                <div class="panel-body">
                    <div class="panel-body">
                    <!-- account/advancePaymentEntry -->
                        <form class="form-horizontal" role="form" action="account/advancePaymentEntry" method="post" onsubmit="return formSubmitFuncAdvance(this);">
                                <div class="form-group col-sm-12">
                                      
                                    <div class="col-sm-2">
                                        <label class="control-label">Shift :</label>
                                        <select class="form-control" name="shift" id="shiftRepo" onchange="getClassReceipt(this.value)">
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

                                      <div class="col-sm-2">
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
                                    <label class="control-label">Year :</label>
                                    <select name="year" id="advYear" class="form-control" onchange="" >
                                        <?php for($i = date("Y");$i <= date("Y")+1;$i++): ?>
                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div> 
								
								<div class="col-sm-2">
                                    <label class="control-label">Month :</label>
                                    <select name="frommonth" id="advYear" class="form-control">
                                        <?php foreach($datamon as $key=>$value): ?>
                                        <option <?php if(date("m")==$key) { echo "selected"; } ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
								
								<div class="col-sm-1">
									<button type="button" style="margin-top:25px;" class="btn btn-primary" onclick="htmlData('index.php/account_billgenerate/advanceFeeGet','shift='+shiftRepo.value+'&ch='+classidrepo.value+'&section='+sectionsrepo.value+'&roll='+rollidrepo.value+'&year='+advYear.value)";><span class="glyphicon glyphicon-search"></span> Search</button>
								</div>
								
                                  </div>

                            <div id="txtResult"></div>
                        <div id="txtResulttow"></div>
                    </form>
            </div>
        </div>
    </div>
  </div>
</div>
</section>
</aside>

