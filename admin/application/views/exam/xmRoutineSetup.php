<script type="text/javascript">
$(document).ready(function () {
    $('#xmDate').datepicker({format:"yyyy-mm-dd"});
    // $('#xmDate').datepicker('setDate', new Date(2015, 10, 19));
    // $("#xmDate").datepicker( "option", "defaultDate", $('#xD').val() );         
});
</script>

<script type="text/javascript">
    function chgSub(cls,type){
        $.ajax({url:"index.php/xmAllRequest/subjectFind",
        type:"POST",
        data:{clsid:cls},
        success:function(data){
            var dSplit=data.split("+");
            var su=dSplit[0];
            var subjNm=su.split(",");

            var sd=dSplit[1];
            var subjid=sd.split(",");

            if(type=='m'){
                document.getElementById("mSub").innerHTML='';
                document.getElementById("mSub").innerHTML="<option value=''>Select</option>";
                if(subjid!=''){
                    for(var i=0;i<subjid.length;i++){
                    document.getElementById("mSub").innerHTML+="<option value='"+subjid[i]+"'>"+subjNm[i]+"</option>";
                    }    
                }
                
            }

            else if(type=='e'){
                document.getElementById("Esub").innerHTML='';
                document.getElementById("Esub").innerHTML="<option value=''>Select</option>";
                if(subjid!=''){
                    for(var i=0;i<subjid.length;i++){
                        document.getElementById("Esub").innerHTML+="<option value='"+subjid[i]+"'>"+subjNm[i]+"</option>";
                    }
                }
            }
        }
    });
    }

var rowNum = 0;
var i=0;

function addRow(frm) {
    
    if((frm.Mcls.value=='')&&(frm.mSub.value=='')&&(frm.Ecls.value=='')&&(frm.Esub.value=='')){
        alert("No Class and Subject are selected");
        document.getElementById("Mcls").focus();
    }
    else if((frm.Mcls.value)&&(frm.mSub.value=='')){
        alert("Pls select a subject");
        document.getElementById("mSub").focus();
    }
    else if((frm.Ecls.value)&&(frm.Esub.value=='')){
        alert("Pls select a subject");
        document.getElementById("Esub").focus();
    }
    else{
    
    rowNum ++;

    if(isNaN(parseInt(frm.Mcls.value))){
       
        var row = '<tr id="rowNum'+rowNum+'"><td></td><td></td><td><input type="hidden" name="Ecls[]" value="'+frm.Ecls.value+'" class="form-control" style="float:left;width:100px;margin-right:5px;" id="ecls'+rowNum+'" ><input type="text" value="'+frm.Ecls.options[frm.Ecls.selectedIndex].text+'" class="form-control" style="float:left;width:100px;margin-right:5px;" disabled ><input type="hidden" name="Esub[]" value="'+frm.Esub.value+'" class="form-control" style="width:100px;margin-left:5px;" id="esub'+rowNum+'" ><input type="text" value="'+frm.Esub.options[frm.Esub.selectedIndex].text+'" class="form-control" style="float:left;width:100px;margin-right:5px;" disabled ></td><td><button type="button" class="btn btn-danger"  onClick="removeRow('+rowNum+');"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button></td></tr>';
    }else if(isNaN(parseInt(frm.Ecls.value))){
        
            var row = '<tr id="rowNum'+rowNum+'"><td></td><td><input type="hidden" name="Mcls[]" value="'+frm.Mcls.value+'" class="form-control" id="mcls'+rowNum+'"><input type="text" value="'+frm.Mcls.options[frm.Mcls.selectedIndex].text+'" class="form-control" style="float:left;width:100px;margin-right:5px;" disabled ><input type="hidden" name="mSub[]" value="'+frm.mSub.value+'" class="form-control" style="width:100px;margin-left:5px;" id="mSub'+rowNum+'" ><input type="text" value="'+frm.mSub.options[frm.mSub.selectedIndex].text+'" class="form-control" style="float:left;width:100px;margin-right:5px;" disabled ></td><td></td><td><button type="button" class="btn btn-danger"  onClick="removeRow('+rowNum+');"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button></td></tr>';
    }else{
    var row = '<tr id="rowNum'+rowNum+'"><td></td><td><input type="hidden" name="Mcls[]" value="'+frm.Mcls.value+'" class="form-control" id="mcls'+rowNum+'"><input type="text" value="'+frm.Mcls.options[frm.Mcls.selectedIndex].text+'" class="form-control" style="float:left;width:100px;margin-right:5px;" disabled ><input type="hidden" name="mSub[]" value="'+frm.mSub.value+'" class="form-control" style="width:100px;margin-left:5px;" id="mSub'+rowNum+'" ><input type="text" value="'+frm.mSub.options[frm.mSub.selectedIndex].text+'" class="form-control" style="float:left;width:100px;margin-right:5px;" disabled ></td><td><input type="hidden" name="Ecls[]" value="'+frm.Ecls.value+'" class="form-control" id="ecls'+rowNum+'" style="float:left;width:100px;margin-right:5px;" ><input type="text" value="'+frm.Ecls.options[frm.Ecls.selectedIndex].text+'" class="form-control" style="float:left;width:100px;margin-right:5px;" disabled ><input type="hidden" name="Esub[]" value="'+frm.Esub.value+'" class="form-control" style="width:100px;margin-left:5px;" id="esub'+rowNum+'" ><input type="text" value="'+frm.Esub.options[frm.Esub.selectedIndex].text+'" class="form-control" style="float:left;width:100px;margin-right:5px;" disabled ></td><td><button type="button" class="btn btn-danger"  onClick="removeRow('+rowNum+');"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button></td></tr>';
    }

    jQuery('#itemRows').append(row);
    
    frm.Mcls.value = '';
    frm.mSub.value = '';
    frm.mSub.innerHTML='';
    frm.mSub.innerHTML='<option value="">Subject</option>';
    frm.Ecls.value = '';
    frm.Esub.value = '';
    frm.Esub.innerHTML='';
    frm.Esub.innerHTML='<option value="">Subject</option>';
    i++;
    return true;
}
}
function removeRow(rnum) {
    i--;
    //alert(i);
    jQuery('#rowNum'+rnum).remove();
}

function resetAll(){
    for(var j=0;j<=i;j++){
        jQuery('#rowNum'+j).remove();       
    }
}

function valid(){
    var xmDt=document.getElementById("xmDate").value;
    
    if(xmDt==''){
        alert("Invalid exam date");
        document.getElementById("xmDate").focus();
        return false;
    }else if(i<1){
        alert("Pls add one entry");
        return false;
    }

    else{
        return true;
    }
}

// check duplicate subject
function chkDupSub(sb,cl,indicat){
    var Mcls=document.getElementById("Mcls").value;
    var mSub=document.getElementById("mSub").value;
    var Ecls=document.getElementById("Ecls").value;
    var Esub=document.getElementById("Esub").value;
   
    // check if selected subject may select again ?
    if(indicat=='m'){
        if((parseInt(cl)==parseInt(Ecls))&&(parseInt(sb)==parseInt(Esub))){
            alert("This subject routine already made.check pls.");
            document.getElementById("mSub").value='';
        }
    }else if(indicat=='e'){
        if((parseInt(cl)==parseInt(Mcls))&&(parseInt(sb)==parseInt(mSub))){
            alert("This subject routine already made.check pls.");
            document.getElementById("Esub").value='';
        }
    }

// check database data
// var ed=0;
var xmid=document.getElementById("exmid").value;
// var ed=document.getElementById("xmDate").value;

if(document.getElementById("xmDate").value==''){
    document.getElementById("xmDate").focus();
    alert("You should first select Exam Date.");
}else{
    var ed=document.getElementById("xmDate").value;
}
var dd=xmid+"+"+ed+"+"+cl+"+"+sb;

$.ajax({
    url:"index.php/xmAllRequest/chkDupXmRtn",
    type:"POST",
    data:{da:dd},
    success:function(data){
        if(parseInt(data)>0){
            alert("This class subject exam routine already set.");
            if(indicat=='m'){
                document.getElementById("mSub").value='';
            }else if(indicat=='e'){
                document.getElementById("Esub").value='';
            }
        }
    }
});
// database data check end

    // this check is for many row data
    if(rowNum>0){   // if any row added
        for(var k=1;k<=rowNum;k++){ // test each row by loop
            // evening value test
            var evcls=document.getElementById("ecls"+k).value;
            var evsb=document.getElementById("esub"+k).value;
            
            // morning value test
            var mrcls=document.getElementById("mcls"+k).value;
            var mrsb=document.getElementById("mSub"+k).value;
// checking
            if(((parseInt(cl)==parseInt(mrcls))&&(parseInt(sb)==parseInt(mrsb)))||((parseInt(cl)==parseInt(evcls))&&(parseInt(sb)==parseInt(evsb)))){
                alert("This subject routine already made.check pls.");
                document.getElementById("rowNum"+k).setAttribute("style","border:1px solid red");
                if(indicat=='m'){
                    document.getElementById("mSub").value='';
                }else if(indicat=='e'){
                    document.getElementById("Esub").value='';
                }
                }else{
                    document.getElementById("rowNum"+k).setAttribute("style","border:none;");
                }
        }
    }
}

// check valid exam date
function chkDate(str){
    // split date
    var getD=str.split("-");

    // this is for today
    var exmD = document.getElementById("xD").value;
    var d=exmD.split("-");
    var yy=d[0];
    var mm=d[1];
    var dd=d[2];

    var tday = new Date();
    var td = tday.getDate();
    var tm = tday.getMonth();
    var ty = tday.getFullYear();
    
    if( parseInt(ty) > parseInt(yy) ){
        yy = ty;    
    }else if( parseInt(tm) > parseInt(mm) ){
        mm = tm;
    }else if( parseInt(td) > parseInt(dd) ){
        dd = td;
    }

if(parseInt(getD[0])<parseInt(yy)){ 
    alert("You can't select exam date below schedule date");
$("#xmDate").val('').datepicker('update');
        // return 0;
    }
else if(parseInt(getD[0])==parseInt(yy) && parseInt(getD[1])<parseInt(mm)){
    alert("You can't select exam date below schedule date");
$("#xmDate").val('').datepicker('update');
}

else if(parseInt(getD[0])==parseInt(yy) && parseInt(getD[1])==parseInt(mm) && parseInt(getD[2])<parseInt(dd)){
    alert("You can't select exam date below schedule date");
$("#xmDate").val('').datepicker('update');
}

}

</script>

<style type="text/css">
    input{text-align: center;margin:0px auto;}
    table tr td{border: none !important;}
</style>

<aside class="right-side">
<section class="content-header">
                    <h1>
                        Examination Routine Setting
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
</section>

    <?php 
        if((isset($_POST['ok']))||(isset($_GET['xm']))){
            
// this is for get data
            if(isset($_GET['xm'])){$exam_name=$_GET['xm'];}
            
// this is for post data
            extract($_POST);

 // select exam date from catg
            $xmCat=$this->db->select("*")->from("exm_catg")->where("exm_ctgid",$exam_name)->get()->row();


            // get exam name
            $xmN=$this->db->query("SELECT * FROM exm_namectg WHERE exmnid IN(select exmnid from exm_catg where exm_ctgid=$exam_name)")->row();

            $cls=$this->db->select("*")->from("class_catg")->get()->result();
            $sbj=$this->db->select("*")->from("subject_class")->get()->result();
            
        }
     ?>

<section>

<div class="container-fluid">
	<div class="col-md-11">

<?php $this->load->view("exam/success"); ?>
<h4 style="margin-top:40px;">Exam Name : <?php echo $xmN->exm_name ?></h4>
		<div class="panel panel-default" style="margin-top:5px;">
            <form action="index.php/allSubmit/routine" method="post" onsubmit="return valid()">
                <table class="table" id="itemRows">
                    <tr style="background:#d9d9d9;">
                        <input type="hidden" id="exmid" name="exmid" value="<?php echo $exam_name ?>" />
                        <th>Exam Date</th>
                        <th>Morning</th>
                        <th>Evening</th>
                        <th>Action</th>
                    </tr>

                    <tr>
                        <td>
                            <input type="text" id="xmDate" name="eDate" placeholder="<?php echo date('Y-m-d'); ?>" autofocus onchange="chkDate(this.value)" />
                            <input type="hidden" name="xD" id="xD" value="<?php echo $xmCat->exmdate ?>">
                        </td>
                        <td>
                            <input type="time" name="MsTi" id="MsTi" class="form-control" style="float:left;width:110px;margin-right:5px;" value="10:00" >
                            <input type="time" name="MeTi" id="MeTi" class="form-control" style="width:110px;margin-left:5px;" value="13:00" >
                        </td>
                        <td>
                            <input type="time" name="EsTi" id="EsTi" class="form-control" style="float:left;width:110px;margin-right:5px;" value="14:00" >
                            <input type="time" name="EeTi" id="EeTi" class="form-control" style="width:110px;margin-left:5px;" value="17:00" >
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>
                            
                        </td>
                        <td>
                            <select class="form-control" style="float:left;width:110px;margin-right:5px;" id="Mcls" name="Mcls" onchange="chgSub(this.value,'m')" >
                                <option value="">Class</option>
                                <?php 
                                    foreach($cls as $c){
                                ?>
                                    <option value="<?php echo $c->classid ?>"><?php echo $c->class_name ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <select class="form-control" id="mSub" name="mSub" style="width:110px;float:left;margin-right:5px;"  onchange="chkDupSub(this.value,Mcls.value,'m')" >
                                <option value="">Subject</option>
                            </select>
                            
                        </td>
                        <td style="border:1px solid red;">
                            <select class="form-control" style="float:left;width:110px;margin-right:5px;" id="Ecls" name="Ecls" onchange="chgSub(this.value,'e')" >
                                <option value="">Class</option>
                                <?php 
                                    foreach($cls as $c){
                                ?>
                                    <option value="<?php echo $c->classid ?>"><?php echo $c->class_name ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <select class="form-control" style="width:110px;float:left;margin-right:5px;" id="Esub" name="Esub" onchange="chkDupSub(this.value,Ecls.value,'e')">
                                <option value="">Subject</option>
                            </select>
                            
                        </td>
                        <td>
                            <button class="btn btn-info" type="button" onClick="addRow(this.form)">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </td>
                    </tr>
                </table>
                <table class="table">
                    <tr>
                        <td style="width:250px;"></td>
                        <td style="width:300px;"></td>
                        <td></td>
                        <td>
                            <button class="btn btn-primary" name="submit" type="submit">Submit</button>
                            <button class="btn btn-warning" type="reset" onClick="resetAll()">Reset</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

</section>
</aside>
