
<script>
    function saveData(str){
        // all variable taken
        var exm=document.getElementById("exm"+str).value;
        var sbid=document.getElementById("sbid"+str).value;
        var cls=document.getElementById("cls"+str).value;
        var sec=document.getElementById("sec"+str).value;
        var rll=document.getElementById("rll"+str).value;
        var stdid=document.getElementById("stdid"+str).value;
        var mark=document.getElementById("mark"+str).value;
        var shft=document.getElementById("shft"+str).value;
        var edate=document.getElementById("edate"+str).value;
        var emark=document.getElementById("emark"+str).value;

        if(mark!=''){

        var data=stdid+"+"+exm+"+"+cls+"+"+sec+"+"+shft+"+"+rll+"+"+sbid+"+"+emark+"+"+mark+"+"+edate;

        $.ajax({
            url:"index.php/allSubmit/oThXmMkEnt",
            type:"POST",
            data:{d:data},
            success:function(sucDa){
                if(sucDa=="suc"){
                    alert("Mark entry successfully");
                    document.getElementById("strow"+str).style.display="none";
                }
                if(sucDa=="fa"){
                    alert("Mark entry failed");
                }
            }
        });

    }else{
        alert("Please Enter Obtain mark");
        document.getElementById("mark"+str).focus();
    }

    }

function chk(mkchk){
    var emk=document.getElementById("emark"+mkchk).value;
    var obtMk=document.getElementById("mark"+mkchk).value;

    if(parseInt(obtMk)>parseInt(emk)){
        alert("Obtain Mark should not more than Exam Mark");
        document.getElementById("mark"+mkchk).style.border="1px solid red !important";
        document.getElementById("mark"+mkchk).value='';
        document.getElementById("mark"+mkchk).focus();
    }else{
        document.getElementById("mark"+mkchk).style.border="1px solid #d0d0d0";
    }
}

// reset all data
function resetAll(rset){
    for(var k=1;k<=rset;k++){
        document.getElementById("mark"+k).value='';
    }
}

</script>

<?php
if(isset($_GET['pre'])){
    $preD=explode("/", $_GET['pre']);

    // senction variable data
    $class=base64_decode($preD[1]);
    $section=base64_decode($preD[2]);
    $OthExam=base64_decode($preD[0]);
    $sub=base64_decode($preD[6]);
    $xmMark=base64_decode($preD[4]);
    $exm_date=base64_decode($preD[5]);
    $shft=base64_decode($preD[3]);
}
    if(isset($_POST['OthstdList'])){
    
    // extract post data
        extract($_POST);
}
        // data array
        $data=array(
            "classid"=>$class,
            "section"=>$section
            );

    // exam search
        $xmNam=$this->db->select("*")->from("exm_othercatg")->where("othexmid",$OthExam)->get()->row();
    // class name search
    $clN=$this->db->select("*")->from("class_catg")->where("classid",$class)->get()->row();

    // subject name search
        $sbj=$this->db->select("*")->from("subject_class")->where("subjid",$sub)->get()->row();

    $st=$this->db->select("*")->from("re_admission")->where($data)->order_by("roll_no","ASC")->get();
    $std=$st->result();

    
?>

<aside class="right-side">
    <section class="content-header">
        <h1>
            Other Exam Mark Entry
            <small>Control panel</small>
        </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
    </section>

    <section>
        <div class="container-fluid">
            <div class="col-md-12">
            <?php $this->load->view("exam/success"); ?>
                <div class="col-md-10">
                    <?php echo "<h3>".$xmNam->exm_name." > ".$clN->class_name." > ".$section." > ".$sbj->sub_name."</h3>"; 
                       echo "<h3 style='text-align:right;margin-top:-35px;'>Mark : ".$xmMark."</h3>";
                    ?>
                </div>
                <div class="panel panel-default" style="margin-top:70px;">
                    <div class="panel-body">
                        <form action="index.php/allSubmit/othXmMk" method="post">
                        <table class="table" id="example1">
                            <thead>
                                <tr>
                                    <th>Roll</th>
                                    <th>Name</th>
                                    <th>Mark</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                        <?php
                            
                            $var=0;
                            $ed=date("Y-m-d");

                            foreach($std as $s){

                                $stdChkD=array(
                                    "stu_id"=>$s->stu_id,
                                    "othexmid"=>$OthExam,
                                    "subjid"=>$sub,
                                    "roll_no"=>$s->roll_no,
                                    "classid"=>$class,
                                    "section"=>$section,
                                    "shift"=>$shft,
                                    "exm_date"=>$exm_date
                                    );

                                $stdEntChk=$this->db->select("count(*) as tstd")->from("exm_markother")->where($stdChkD)->get()->row();
                                

                                // check if this students mark has already inserted
                                if($stdEntChk->tstd<=0){

                                $stdN=$this->db->select("*")->from("regis_tbl")->where("stu_id",$s->stu_id)->get()->row();
                                 $shift=$this->db->select("*")->from("shift_catg")->where("shiftid",$stdN->shiftid)->get()->row();

                                $var++;
                        ?>
                        

                            <tr id="strow<?php echo $var; ?>">

                                <!-- <form id="frm<?php //echo $var; ?>"> -->

                        <!-- all hidden value are here -->
                            <input type="hidden" name="exam" value="<?php echo $OthExam; ?>" id="exm<?php echo $var; ?>" >
                            <input type="hidden" name="subid" value="<?php echo $sub; ?>" id="sbid<?php echo $var; ?>" >
                            <input type="hidden" name="class" value="<?php echo $class; ?>" id="cls<?php echo $var; ?>">
                            <input type="hidden" name="section" value="<?php echo $section; ?>" id="sec<?php echo $var; ?>" >
                            <input type="hidden" name="shift" value="<?php echo $stdN->shiftid; ?>" id="shft<?php echo $var; ?>" >
                            <input type="hidden" name="roll[]" value="<?php echo $s->roll_no; ?>" id="rll<?php echo $var; ?>" >
                            <input type="hidden" name="stdid[]" value="<?php echo $s->stu_id; ?>" id="stdid<?php echo $var; ?>" >
                            <input type="hidden" name="edate" value="<?php echo $exm_date; ?>" id="edate<?php echo $var; ?>" >
                            <input type="hidden" name="emark" value="<?php echo $xmMark; ?>" id="emark<?php echo $var; ?>" >
                        <!-- all hidden value are here -->

                                <td>
                                    <input type="text" name="roll[]" class="form-control" value="<?php echo $s->roll_no; ?>" disabled />
                                </td>
                                <td>
                                    <input type="text" name="stdName[]" class="form-control" value="<?php echo $stdN->name; ?>" disabled />
                                </td>
                                <td>
                                    <input type="hidden" name="idvar" id="idvar<?php echo $var; ?>" value="<?php echo $var ?>" />
                                    <input type="text" name="mark[]" id="mark<?php echo $var; ?>" class="form-control" placeholder="Mark" onchange="chk(<?php echo $var ?>)" onkeypress="return isNumber(event)" />
                                </td>

                                
                                <td>
                                    <button type="button" class="btn btn-primary" name="SglStdEn" onclick="saveData(<?php echo $var; ?>)" >
                                        Entry
                                    </button>
                                </td>
                                <!-- </form> -->
                            </tr>
                        
                        
                        <?php
                            
                            }
                        }
                        ?>
                        </tbody>
                        </table>

                        

                        <?php
                    
                            if($var<=0){
                        ?>

                        <table class="table">
                            <tr>
                                <td></td>
                                <td>
                                <a href="index.php/exam/otherXmEnty">
                                    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> &nbsp;&nbsp;&nbsp;Back</button>
                                </a>
                                </td>
                                <td></td>
                            </tr>
                        </table>

                        <?php
                            }else{
                        ?>

                        <table class="table">
                        <tr>
                        <td style="width:1%;"></td>
                            <td>
                                <a href="index.php/exam/result">
                                    <button type="button" class="btn btn-success">
                                    <span class="glyphicon glyphicon-arrow-left"></span> Back</button>
                                </a>
                            </td>

                            <td>
                                <button type="submit" name="allSub" onclick="return valid1();" class="btn btn-primary" >
                                    <span class="glyphicon glyphicon-send" aria-hidden="true"> Submit
                                    </span>
                                </button>
                                <button type="reset" name="ok" class="btn btn-warning" onclick="resetAll(<?php echo $var; ?>)">
                                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"> Reset
                                    </span>
                                </button>
                            </td>
                            <td></td>
                        </tr>
                    </table>

                    <?php
                        }
                    ?>

                       </form> 
                    </div>
                </div>
            </div>
        </div>
    </section>
</aside>