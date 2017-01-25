<style>
    table tr:nth-child(even){
        background: #f9f9f9;
    }

    table tr:nth-child(odd){
        background: #f1f1f1;
    }

    table tr th{
        text-align: center;
    }

    table tr td{
        text-align: center;
    }
#hdr tr{background: none !important;}
#hdr tr th{border: none !important;}

</style>

<!-- java script start -->
<!-- java script start -->
<!-- java script start -->

<script type="text/javascript">
    function editSeatPlan(rid){

        // class name
        document.getElementById("clsName"+rid).style.display="block";
        document.getElementById("className"+rid).style.display="none";
        
        // section
        document.getElementById("section"+rid).style.display="none";
        document.getElementById("allSection"+rid).style.display="block";

        // roll part
        document.getElementById("rollNo"+rid).style.display="none";
        document.getElementById("diff"+rid).style.display="block";
        document.getElementById("sRoll"+rid).type="text";
        document.getElementById("eRoll"+rid).type="text";

        // room part
        document.getElementById("room"+rid).style.display="none";
        document.getElementById("roomNo"+rid).style.display="block";

        // shift
        document.getElementById("stSht"+rid).style.display="block";
        document.getElementById("sht"+rid).style.display="none";
        
        // action button
        document.getElementById("edit"+rid).style.display="none";
        document.getElementById("sucbtn"+rid).style.display="block";

    }

function classChng(str,rid){
    if(str==0){
        document.getElementById("allSection"+rid).innerHTML='';
        document.getElementById("allSection"+rid).innerHTML="<option value='0'>Select</option>";
    }else{
    $.ajax({
        url:"index.php/xmAllRequest/classChng",
        data:{clsid:str,rd:rid},
        type:"POST",
        success:function(data){
            var std=data.split("+");    // split data into two pieces
            var secSub=std[0];  // section data split first part
            var rowID=std[1];       // selection id number

            var secSeparat=secSub.split(",");   // section separate

            document.getElementById("allSection"+rowID).innerHTML='';
            document.getElementById("allSection"+rowID).innerHTML="<option value='0'>Select</option>";
            for(var i=0;i<secSeparat.length;i++){
                document.getElementById("allSection"+rowID).innerHTML+="<option value='"+secSeparat[i]+"'>"+secSeparat[i]+"</option>";
            }
        }
    });}
}


function greatLess(first,second,rID){
    if(first>second){
        alert("Starting Roll Number Can't bigger than Ending Number");
        document.getElementById("sRoll"+rID).style.border="1px solid red";
        document.getElementById("sRoll"+rID).focus();
    }else{
        document.getElementById("sRoll"+rID).style.border="none";
    }
}


//  submit all validated data
function submitData(xmid,sid,updateID){
    var rNuM;
    // all data collection
    var clsD=document.getElementById("clsName"+sid).value;
    var sft=document.getElementById("stSht"+sid).value;
    var secD=document.getElementById("allSection"+sid).value;
    var sRollD=document.getElementById("sRoll"+sid).value;
    var eRollD=document.getElementById("eRoll"+sid).value;
    var roomD=document.getElementById("roomNo"+sid).value;
    var rNuM=document.getElementById("roomNo"+sid).options[document.getElementById("roomNo"+sid).selectedIndex].text;

    // concate all data as a string
    var allData=clsD+"+"+secD+"+"+sRollD+"-"+eRollD+"+"+roomD+"+"+xmid+"+"+sid+"+"+rNuM+"+"+sft+"+"+updateID;

// logical test
     if(clsD==0){
        alert("Select valid class Name");
        document.getElementById("clsName"+sid).focus();
        // return false;
    }else if(sft==0){
        alert("Select valid Shift");
        document.getElementById("stSht"+sid).focus();
        // return false;
    }else if(secD==0){
        alert("Select Setection");
        document.getElementById("allSection"+sid).focus();
        // return false;
    }else if(sRollD==''){
        alert("Starting Roll is empty");
        document.getElementById("sRoll"+sid).focus();
        // return false;
    }else if(eRollD==''){
        alert("Ending Roll is empty");
        document.getElementById("eRoll"+sid).focus();
        // return false;
    }else if(roomD==''){
        alert("Room Number is empty");
        document.getElementById("roomNo"+sid).focus();
        // return false;
     }else{
        // return true;
        $.ajax({
            url:"index.php/edit/xmSeatPlanEdit",
            type:"POST",
            data:{data:allData},
            success:function(d){
                var allD=d.split("+");
   
   // changed all value             
                // var clsU=allD[0];
                var secU=allD[1];
                var RollU=allD[2];
                var roomU=allD[3];
                // var tidU=allD[4];
                
                var rowU=allD[5];


     // hide all editing option
        // document.getElementById("ti"+rowU).style.display="none";
        document.getElementById("clsName"+rowU).style.display="none";
        document.getElementById("allSection"+rowU).style.display="none";
        document.getElementById("sRoll"+rowU).type="hidden";
        document.getElementById("eRoll"+rowU).type="hidden";
        document.getElementById("roomNo"+rowU).style.display="none";
        document.getElementById("stSht"+rowU).style.display="none";

        // for(var p=0;p<tt;p++){
        //     document.getElementById("tid"+rowU+"t"+p).style.display="none";
        // }

        document.getElementById("diff"+rowU).style.display="none";
        document.getElementById("sucbtn"+rowU).style.display="none";

// take select option selected value for setup
var clsU=document.getElementById("clsName"+rowU).options[document.getElementById("clsName"+rowU).selectedIndex].text;
// get shift name
var suSht = document.getElementById("stSht"+rowU).options[document.getElementById("stSht"+rowU).selectedIndex].text;
// var tidU="";
// for(var q=0;q<tt;q++){
//     tidU+=document.getElementById("tid"+rowU+"t"+q).options[document.getElementById("tid"+rowU+"t"+q).selectedIndex].text+",";    
// }

// changed value return
    // document.getElementById("xmTime"+rowU).innerHTML=timeV;
    document.getElementById("className"+rowU).innerHTML=clsU;
    document.getElementById("section"+rowU).innerHTML=secU;
    document.getElementById("rollNo"+rowU).innerHTML=RollU;
    document.getElementById("room"+rowU).innerHTML=rNuM;
    document.getElementById("sht"+rowU).innerHTML=suSht;

    // var ot=tidU.split(",");
    // document.getElementById("teacherId"+rowU).innerHTML="";
    // for(var teachd=0;teachd<ot.length;teachd++){
        // document.getElementById("teacherId"+rowU).innerHTML+=ot[teachd]+"<br/>";    
    // }
    

    // show normal text value
    // document.getElementById("xmTime"+rowU).style.display="block";
    document.getElementById("className"+rowU).style.display="block";
    document.getElementById("section"+rowU).style.display="block";
    document.getElementById("rollNo"+rowU).style.display="block";
    document.getElementById("room"+rowU).style.display="block";
    document.getElementById("sht"+rowU).style.display="block";
    document.getElementById("edit"+rowU).style.display="block";
    document.getElementById("edit"+rowU).setAttribute("style","margin-left:1px;");

            }
        });
    }
}

function clsSec(str){
    if(isNaN(parseInt(str))){
        document.getElementById("sec").innerHTML='';
        document.getElementById("sec").innerHTML='<option value="">Select</option>';
    }
    else{
    $.ajax({
        url:"index.php/xmAllRequest/seatPlanSection",
        type:"POST",
        data:{clsid:str},
        success:function(data){

            var ss=data.split(",");
            document.getElementById("sec").innerHTML='';
            document.getElementById("sec").innerHTML='<option value="">Select</option>';

            for(var i=0;i<ss.length;i++){
                document.getElementById("sec").innerHTML+='<option value="'+ss[i]+'">'+ss[i]+'</option>';
            }
        }
    });
}
}

// submition validation check
function validityChk(){
    var em=document.getElementById("xm").value;
    var cls=document.getElementById("cls").value;
    var sft2=document.getElementById("shft").value;
    var sct=document.getElementById("sec").value;
    var rl=document.getElementById("roll").value;

    if(rl!=''){
        if(em==''){
            alert("Please Select Exam.");
            document.getElementById("xm").focus();
            return false;
        }
        else if(cls==''){
            alert("Please Select class.");
            document.getElementById("cls").focus();
            return false;
        }
        else if(sft2==''){
            alert("Please Select Shift.");
            document.getElementById("shft").focus();
            return false;
        }
        else if(sct==''){
            alert("Please select section");
            document.getElementById("sec").focus();
            return false;
        }else{
            return true;
        }
    }
}

</script>

<!-- java script end -->
<!-- java script end -->
<!-- java script end -->

<!-- <aside class="right-side">
	<section class="content-header">
        <h1>
            <a href="index.php/xmReport/seatPlaning">Exam Seat Planing</a>
            <small>Control panel</small>
        </h1>
            <ol class="breadcrumb">
            	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
    </section> -->

<?php
    // $seat=$this->db->select("*")->from("exm_catg")->where("status","1")->get()->result();
    // class select
    $cl=$this->db->select("*")->from("class_catg")->get()->result();
    // select shift
    $shf=$this->db->select("*")->from("shift_catg")->get()->result();
    // select all room
    $rm=$this->db->select("*")->from("room_settup")->get()->result();
    // xm name
    $exm=$this->db->select("*")->from("exm_catg")->get()->result();
    if(isset($_POST['go'])){
        extract($_POST);
    // when only room selected
    if($cls!=''):
        $sc=$this->db->select("*")->from("class_catg")->where("classid",$cls)->get()->row();
        $eachSect=explode(",", $sc->section);
    endif;
    }
?>

   <!--  <section>
        <div class="container-fluid">
            <div class="col-md-12"> -->
            <!-- search option -->
                <div class="col-md-12" style="margin-top:20px;">
                    <form action="" method="post" onsubmit="return validityChk()">
                        <table class="table" style="width:100%" id="hdr">
                            <tr>
                                <th>Exam</th>
                                <th>Class</th>
                                <th>Shift</th>
                                <th>Section</th>
                                <th>Room</th>
                                <th>Roll</th>
                                <!-- <th>Teacher</th> -->
                            </tr>
                            <tr>
                                <td>
                                    <select class="form-control" name="xm" id="xm">
                                        <option value="">Select</option>
                                        <?php foreach($exm as $x): 
                                            $nm=$this->db->select("*")->from("exm_namectg")->where("exmnid",$x->exmnid)->get()->row();
                                        ?>
                                        <option value="<?php echo $x->exm_ctgid ?>" <?php if(isset($_POST['go'])):if($x->exm_ctgid==$xm):echo "selected";endif;endif; ?>><?php echo $nm->exm_name."-".$x->year ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" name="cls" id="cls" onchange="clsSec(this.value)">
                                        <option value="">Select</option>
                                        <?php foreach($cl as $c): ?>
                                            <option value="<?php echo $c->classid ?>" <?php if(isset($_POST['go'])):if($c->classid==$cls):echo "selected";endif;endif; ?> ><?php echo $c->class_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>

                                <td>
                                    <select class="form-control" name="shft" id="shft">
                                        <option value="">Select</option>
                                        <?php foreach($shf as $sf): ?>
                                            <option value="<?php echo $sf->shiftid ?>" <?php if(isset($_POST['go'])):if($sf->shiftid==$shft):echo "selected";endif;endif; ?>><?php echo $sf->shift_N ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                
                                <td>
                                    <select class="form-control" name="sec" id="sec">
                                        <option value="">Select</option>
                                        <?php if(isset($_POST['go'])):for($j=0;$j<count($eachSect);$j++): ?>
                                            <option value="<?php echo $eachSect[$j] ?>" <?php if($eachSect[$j]==$sec):echo "selected";endif; ?>><?php echo $eachSect[$j] ?></option>
                                        <?php endfor;endif; ?>
                                    </select>
                                </td>
                                
                                <td>
                                    <select class="form-control" name="room" id="room" >
                                        <option value="">Select</option>
                                <?php foreach($rm as $r): ?>
                                    <option value="<?php echo $r->roomid ?>" <?php if(isset($_POST['go'])):if($r->roomid==$room):echo "selected";endif;endif; ?>><?php echo $r->r_name." (".$r->room_number.")" ?></option>
                                <?php endforeach; ?>
                                    </select>
                                </td>
                                
                                <td>
                                    <input type="text" name="roll" id="roll" class="form-control" value="<?php if(isset($_POST['go'])):echo $roll;endif; ?>" />
                                </td>
                                
                                <td>
                                    <button type="submit" class="btn btn-primary" name="go">
                                        <span class="glyphicon glyphicon-search"></span> Search
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            <!-- search option -->
                <div class="panel panel-default" style="margin-top:10px;">
                    <table class="table" id="example1">
                        <thead>
                            <tr>
                                <th>Exam Name</th>
                                <th>Class Name</th>
                                <th>Shift</th>
                                <th>Section</th>
                                <th>Roll No</th>
                                <th>Room No</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $rid=0;
                            // foreach($seat as $s){

                                // start isset POST
                                if(isset($_POST['go'])){
                                    extract($_POST);
                                    // only exam
                                    if(($xm!='')&&($cls=='')&&($shft=='')&&($sec=='')&&($room=='')&&($roll=='')){
                                        $seatP=$this->db->select("*")->from("exm_seatplain")->where("exm_ctgid",$xm)->get()->result();
                                    }
                                    // exam and class
                                    elseif(($xm!='')&&($cls!='')&&($shft=='')&&($sec=='')&&($room=='')&&($roll=='')){
                                    $seatP=$this->db->select("*")->from("exm_seatplain")->where("exm_ctgid",$xm)->where("classN",$cls)->get()->result();
                                    }
                                    // exam class shift
                                    else if(($xm!='')&&($cls!='')&&($shft!='')&&($sec=='')&&($room=='')&&($roll=='')){ // teacher search
                                        $seatP=$this->db->select("*")->from("exm_seatplain")->where("classN",$cls)->where("exm_ctgid",$xm)->where("shiftid",$shft)->get()->result();
                                    }
                                    // exam class shift section
                                    else if(($xm!='')&&($cls!='')&&($shft!='')&&($sec!='')&&($room=='')&&($roll=='')){ 
                                        $seatP=$this->db->select("*")->from("exm_seatplain")->where("exm_ctgid",$xm)->where("shiftid",$shft)->where("classN",$cls)->where("section",$sec)->get()->result();

                                    }
                                    // exam class shift section room
                                    else if(($xm!='')&&($cls!='')&&($shft!='')&&($sec!='')&&($room!='')&&($roll=='')){ 
                                        $seatP=$this->db->select("*")->from("exm_seatplain")->where("exm_ctgid",$xm)->where("section",$sec)->where("classN",$cls)->where("shiftid",$shft)->where("room",$room)->get()->result();

                                    }
                                    // exam shift
                                    else if(($xm!='')&&($cls=='')&&($shft!='')&&($sec=='')&&($room=='')&&($roll=='')){
                                        $seatP=$this->db->select("*")->from("exm_seatplain")->where("exm_ctgid",$xm)->where("shiftid",$shft)->get()->result();
                                    }
                                    // exam class section
                                    else if(($xm!='')&&($cls!='')&&($shft=='')&&($sec!='')&&($room=='')&&($roll=='')){ // class and section and teacher
                                        $seatP=$this->db->select("*")->from("exm_seatplain")->where("exm_ctgid",$xm)->where("classN",$cls)->where("section",$sec)->get()->result();

                                    }
                                    // exam room
                                    else if(($xm!='')&&($cls=='')&&($shft=='')&&($sec=='')&&($room!='')&&($roll=='')){
                                        $seatP=$this->db->select("*")->from("exm_seatplain")->where("exm_ctgid",$xm)->where("room",$room)->get()->result();
                                    }
                                    // exam class shift section roll
                                    else if(($xm!='')&&($cls!='')&&($shft!='')&&($sec!='')&&($room=='')&&($roll!='')){
                                        // getting data by given roll
                                        $rollData=$this->db->select("*")->from("exm_seatplain")->where("exm_ctgid",$xm)->where("classN",$cls)->where("shiftid",$shft)->where("section",$sec)->get()->result();
                                        // fetching data
                                        $rA=array();
                                        foreach($rollData as $rd):
                                            $rollArray=explode("-", $rd->roll_no);
                                        // check if given roll in array
                                            if($roll >= $rollArray[0] && $roll <= $rollArray[1]):
                                                array_push($rA, $rd->id);
                                            endif;
                                        endforeach;
                                        // get actual data
                                        if(count($rA)):
                                            $seatP=$this->db->select("*")->from("exm_seatplain")->where_in("id",$rA)->get()->result();
                                        else:$seatP=array();
                                        endif;
                                    }
                                    // exam class section
                                    else if(($xm!='')&&($cls!='')&&($shft=='')&&($sec!='')&&($room=='')&&($roll=='')){
                                        $seatP=$this->db->select("*")->from("exm_seatplain")->where("exm_ctgid",$xm)->where("classN",$cls)->where("section",$sec)->get()->result();
                                    }
                                    // exam class room
                                    elseif(($xm!='')&&($cls!='')&&($shft=='')&&($sec=='')&&($room!='')&&($roll=='')){
                                        $seatP=$this->db->select("*")->from("exm_seatplain")->where("exm_ctgid",$xm)->where("classN",$cls)->where("room",$room)->get()->result();
                                    }
                                    // exam class shift room
                                    elseif(($xm!='')&&($cls!='')&&($shft!='')&&($sec=='')&&($room!='')&&($roll=='')){
                                            $seatP=$this->db->select("*")->from("exm_seatplain")->where("exm_ctgid",$xm)->where("classN",$cls)->where("room",$room)->where("shiftid",$shft)->get()->result();
                                    }
                                    // exam class shift section room roll
                                    elseif(($xm != '')&&($cls != '')&&($shft != '')&&($sec != '')&&($room != '')&&($roll != '')){
                                        $prevQ = $this->db->select("*")->from("exm_seatplain")->where("exm_ctgid",$xm)->where("classN",$cls)->where("shiftid",$shft)->where("section",$sec)->where("room",$room)->get()->result();
                                        // fetching data
                                        $rA=array();
                                        foreach($prevQ as $rd):
                                            $rollArray=explode("-", $rd->roll_no);
                                        // check if given roll in array
                                            if($roll >= $rollArray[0] && $roll <= $rollArray[1]):
                                                array_push($rA, $rd->id);
                                            endif;
                                        endforeach;
                                        // get actual data
                                        if(count($rA)):
                                            $seatP=$this->db->select("*")->from("exm_seatplain")->where_in("id",$rA)->get()->result();
                                        else:$seatP=array();
                                        endif;
                                    }
                               
                                
// echo $this->db->last_query(); print_r($seatP);   
                                if(count($seatP)>0){
                                    // echo "<pre>";print_r($f);
    foreach($seatP as $f):
                                    // echo $f->classN; 

                                $rid++;
                                // exam category id
                                $ctgid=$f->exm_ctgid;
                                
                                // class id
                                if(isset($f->classN)):
                                    $clsid=$f->classN;
                                elseif(isset($f['classN'])):
                                    $clsid=$f['classN'];
                                endif;
                                // class name getting
                                $clsName=$this->db->select("*")->from("class_catg")->where("classid",$clsid)->get()->row();
                                // $clsName=mysql_fetch_array($clsnm);



                                // exam name query
                                $xmFet = $this->db->select("*")->from("exm_catg")->where("exm_ctgid",$ctgid)->get()->row();
                                // $xmFet=mysql_fetch_array($exam);

                                $xmid=$xmFet->exmnid;

                                $nMxMfet = $this->db->select("*")->from("exm_namectg")->where("exmnid",$xmid)->get()->row();

                                // $nMxMfet=mysql_fetch_array($nMxM);

                                // all class id and name
                                $clsN=$this->db->select("*")->from("class_catg")->get()->result();
                                // shift name
                                $seatSht=$this->db->select("*")->from("shift_catg")->where("shiftid",$f->shiftid)->get()->row();
                                // selected teacher name
                                // $td=explode(",",$f->techID);

                                // initialize
                                // $n=array();
                                // $tchd=array();
                                // // do a looping for how many teacher
                                // for($i=0;$i<count($td);$i++){
                                //     $tN=mysql_query("SELECT * FROM empee WHERE empid='$td[$i]' limit 1");
                                //     $tName=mysql_fetch_array($tN);
                                //     // insert value into array
                                //     array_push($n, $tName['name']);
                                //     array_push($tchd, $tName['empid']);

                                // }


                                // teacher all data search
                                //$teacher=$this->db->select("*")->from("empee")->get()->result();

                                // roll number separation into two part
                                $rollSep=explode("-", $f->roll_no);
                                // echo $f->roll_no;
                                // $f->roll_no;
                                $sRoll=$rollSep[0];
                                $eRoll=$rollSep[1];


                        ?>

                        <tr>
                            <td>
                                <input type="hidden" name="xmId" id="xmId<?php echo $rid; ?>" value="<?php echo $f->id; ?>" />
                                <?php echo $nMxMfet->exm_name; ?>
                            </td>
                            
                            <td>
                                <select name="cls" style="display:none;" id="clsName<?php echo $rid; ?>" class="form-control" onchange="classChng(this.value,<?php echo $rid; ?>)" >
                                    <option value="0">Select</option>
                                    
                                    <?php
                                        foreach($clsN as $cl){
                                    ?>

                                    <option value="<?php echo $cl->classid; ?>" <?php if($cl->classid==$clsid){echo "selected";} ?> ><?php echo $cl->class_name; ?></option>

                                    <?php
                                        }
                                    ?>
                                
                                </select>
                                <span id="className<?php echo $rid; ?>"><?php echo $clsName->class_name; ?></span>
                            </td>
                            <td>
                                <select name="seatSht" style="display:none;" id="stSht<?php echo $rid; ?>" class="form-control">
                                    <option value="0">Select</option>
                                    <?php foreach($shf as $st): ?>
                                        <option value="<?php echo $st->shiftid ?>" <?php if($st->shiftid==$f->shiftid):echo "Selected";endif; ?> ><?php echo $st->shift_N ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span id="sht<?php echo $rid; ?>"><?php echo $seatSht->shift_N; ?></span>
                            </td>
                            <td>
                                <span id="section<?php echo $rid; ?>"><?php echo $f->section; ?></span>
                                <select id="allSection<?php echo $rid; ?>" class="form-control" style="display:none;">
                                    <option value="0">Select</option>
                                    <option value="<?php echo $f->section; ?>" selected><?php echo $f->section; ?></option>
                                </select>
                            </td>
                            
                            <td style="width:150px;">
                                <span id="rollNo<?php echo $rid; ?>"><?php echo $f->roll_no; ?></span>
                                <input type="hidden" name="sRoll" id="sRoll<?php echo $rid; ?>" value="<?php echo $sRoll; ?>" class="form-control" style="width:50px;float:left;" onchange="greatLess(this.value,eRoll<?php echo $rid; ?>.value,<?php echo $rid; ?>)" />
                                <span class="glyphicon glyphicon-minus" id="diff<?php echo $rid; ?>" aria-hidden="true" style="display:none;width:20px;float:left;padding-top:10px;margin-left:7px;"></span>
                                <input type="hidden" name="eRoll" id="eRoll<?php echo $rid; ?>" value="<?php echo $eRoll; ?>" class="form-control" style="width:50px;float:right;" />
                            </td>
<!-- get room number by id -->
<?php
    $rMnO=$this->db->select("*")->from("room_settup")->where("roomid",$f->room)->get()->row();
    $allRm=$this->db->get("room_settup")->result();
?>
<!-- end -->
                            <td>
                                <span id="room<?php echo $rid; ?>"><?php echo $rMnO->r_name." (".$rMnO->room_number." )"; ?></span>
                                <select id="roomNo<?php echo $rid; ?>" class="form-control" style="display:none;" class="form-control">
                                <?php
                                    foreach($allRm as $aR):
                                ?>
                                    <option value="<?php echo $aR->roomid; ?>" <?php if($rMnO->roomid==$aR->roomid):echo "selected";endif; ?>><?php echo $aR->r_name." (".$aR->room_number." )" ?></option>
                                <?php endforeach; ?>
                                </select>
                            </td>
                           
                            <td>
                                <button class="btn btn-primary" id="edit<?php echo $rid; ?>" onclick="editSeatPlan(<?php echo $rid; ?>)"><span class="glyphicon glyphicon-edit"></span></button>
                                
                                <button class="btn btn-success" id="sucbtn<?php echo $rid; ?>" style="display:none;" onclick="submitData(xmId<?php echo $rid; ?>.value,<?php echo $rid; ?>,<?php echo $f->id ?>)"><span class="glyphicon glyphicon-ok"></span></button>
                            </td>
                        </tr>
                        
                        <?php
                            endforeach;
                            }
                         }// end post
                        ?>

                        </tbody>
                    </table>
                </div><!-- 
            </div>
        </div>
    </section> -->