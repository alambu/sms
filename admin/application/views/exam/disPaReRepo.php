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
</style>

<script type="text/javascript">

$(document).ready(function(){
    $("#receivedDate").datepicker(
        {format:"yyyy-mm-dd"}
        );
});


    function secCls(str){
        if(str!=''){
        // this is for section search
        $.ajax({
            url:"index.php/xmAllRequest/seatPlanSection",
            type:"POST",
            data:{clsid:str},
            success:function(data){
                var sec=data.split(",");
                document.getElementById("sec").innerHTML='';
                document.getElementById("sec").innerHTML='<option value="">Select</option>';

                for(var i=0;i<sec.length;i++){
                    document.getElementById("sec").innerHTML+='<option value="'+sec[i]+'">'+sec[i]+'</option>';
                }
            }
        });
    }else{
        document.getElementById("sec").innerHTML='';
        document.getElementById("sec").innerHTML='<option value="">Select</option>';
        document.getElementById("sub").innerHTML='';
    }
// this is for subject search
$.ajax({
    url:"index.php/xmAllRequest/subjectFind",
    type:"POST",
    data:{clsid:str},
    success:function(data){
        var sep=data.split("+");
        var subnm=sep[0];
        var subid=sep[1];

        var sbid=subid.split(",");
        var sbnm=subnm.split(",");

        // clear selection field
        document.getElementById("sub").innerHTML='';
        document.getElementById("sub").innerHTML='<option value="">Select</option>';

        // adding selection
        for(var j=1;j<sbid.length;j++){
            document.getElementById("sub").innerHTML+='<option value="'+sbid[j]+'">'+sbnm[j]+'</option>';
        }
    }
});
}

function chkSubBtn(){
    var prxm = document.getElementById("ex").value;
    var prShift = document.getElementById("sht").value;
    var prClass = document.getElementById("cls").value;
    var prSec = document.getElementById("sec").value;
    var prSub = document.getElementById("sub").value;
    var prPid = document.getElementById("pid").value;
    var prRecD = document.getElementById("receivedDate").value;

    // test
    if(( prxm == '' )&&(( prShift != '' )||( prClass != '' )||( prSec != '' )||( prSub != '' ))){
        alert("Pls select Exam and shift or class or section or subject");
        document.getElementById("ex").focus();
        return false;
    }
}

</script>


<aside class="right-side">
	<section class="content-header">
        <h1>
            <a href="javascript:void(0);">Received Paper Report</a>
            <small>Control panel</small>
        </h1>
            <ol class="breadcrumb">
            	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
    </section>

<?php
    
// shift data get
$shft = $this->db->get("shift_catg")->result();

    if(isset($_POST['go'])){
        extract($_POST);

        // data array
        $data=array(
            "exm_ctgid"=>$exam,
            "classid"=>$class,
            "section"=>$sec
            );
// distribute paper searching
        $pdis=$this->db->select("*")->from("exm_pdistribute")->where($data)->get()->result();

    // all executable query are here

    $date=date("Y");

// this is for select current exam
    $win=$this->db->query("SELECT * FROM exm_catg WHERE exm_ctgid IN(SELECT MAX(exm_ctgid)  FROM exm_catg WHERE  status=1 and year='$date' GROUP BY  exmnid ORDER BY  exm_ctgid DESC)")->result();

}
    //  take examctgid from this query and search from paper distribute by this id
   
// this section for search part
// search exam
$xmNid = $this->db->select("GROUP_CONCAT(exmnid) as cat")->from("exm_namectg")->get()->row();

$xmNid = str_replace("'", "", $xmNid);

$exm = $this->db->select("*")->from("exm_catg")->where_in("exmnid",$xmNid->cat)->get()->result();
// search class

$cl=$this->db->select("*")->from("class_catg")->get()->result();

if(isset($_POST['search'])):
    extract($_POST);
$date=date("Y");
    // logic test
    if($ex!=''):
        $win=$this->db->query("SELECT * FROM exm_catg WHERE exm_ctgid='$ex'")->result();
    else:
    // this is for select current exam
        $win=$this->db->query("SELECT * FROM exm_catg WHERE exm_ctgid IN(SELECT MAX(exm_ctgid)  FROM exm_catg WHERE  status=1 and year='$date' GROUP BY  exmnid ORDER BY  exm_ctgid DESC)")->result();
    endif;
else:
    $win = $this->db->query("SELECT * FROM exm_catg WHERE exm_ctgid='$exam'")->result(); 
endif;

?>

    <section>
        <div class="container-fluid">
            <div class="col-md-12">
            <div class="col-md-12" style="margin-top:5px;">
                <form action="" method="post">
                    <table style="width:100%;">
                        <tr style="background:none !important;">
                            <th>Exam</th>
                            <th>Shift</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Subject</th>
                            <th>Paper ID</th>
                            <th>Received Date</th>
                            <th></th>
                        </tr>

                        <tr>
                            <td>
                                <select name="ex" id="ex" class="form-control">
                                    <option value="">Select</option>
                                <?php 
                                    foreach($exm as $rows):
                                        // $xmID=$rows['exmnid'];
                                        $xmNmCtg = $this->db->select("*")->from("exm_namectg")->where("exmnid",$rows->exmnid)->get()->row();
                                        ?>
                                        <option value="<?php echo $rows->exm_ctgid; ?>" <?php if(isset($_POST['search'])):if($rows->exm_ctgid==$ex):echo "selected";endif;endif; ?>><?php echo $xmNmCtg->exm_name.' - '.$rows->year; ?></option>
                                        <?php
                                    endforeach;
                                 ?>
                                </select>
                            </td>
                            
                            <td>
                                <select name="sht" id="sht" class="form-control">
                                    <option value="">Select</option>
                                <?php foreach($shft as $sh): ?>
                                    <option value="<?php echo $sh->shiftid ?>" <?php if(isset($_POST['search'])):if($sh->shiftid==$sht):echo "selected";endif;endif; ?>><?php echo $sh->shift_N ?></option>
                                <?php endforeach; ?>
                                </select>
                            </td>

                            <td>
                                <select name="cls" id="cls" class="form-control" onchange="secCls(this.value)">
                                    <option value="">Select</option>
                                <?php foreach($cl as $c): ?>
                                    <option value="<?php echo $c->classid ?>" <?php if(isset($_POST['search'])):if($c->classid==$cls):echo "selected";endif;endif; ?>><?php echo $c->class_name ?></option>
                                <?php endforeach; ?>
                                </select>
                            </td>
                            
                            <td>
                                <select name="sec" id="sec" class="form-control">
                                    <option value="">Select</option>
                            <?php 
                                if(isset($_POST['search'])):
                                    if($cls!=''):
                                    $sc=$this->db->select("*")->from("class_catg")->where("classid",$cls)->get()->row();
                                $sstion=explode(",",$sc->section);
                                for($k=0;$k<count($sstion);$k++):
                            ?>
                                <option value="<?php echo $sstion[$k]; ?>" <?php if(isset($_POST['search'])):if($sstion[$k]==$sec):echo "selected";endif;endif; ?> ><?php echo $sstion[$k]; ?></option>
                            <?php endfor;endif;endif; ?>
                                </select>
                            </td>
                            
                            <td>
                                <select name="sub" id="sub" class="form-control">
                                    <option value="">Select</option>
                            <?php 
                                if(isset($_POST['search'])):
                                    $sb=$this->db->query("SELECT s.subjid,p.sub_name FROM subject_class s right join subject_setup p ON s.subsetid = p.subsetid WHERE s.classid = '$cls'")->result();
                                foreach($sb as $s):
                             ?>
                            <option value="<?php echo $s->subjid ?>" <?php if(isset($sub)):if($s->subjid==$sub):echo "selected";endif;endif; ?> ><?php echo $s->sub_name ?></option>
                        <?php endforeach;endif; ?>
                                </select>
                            </td>
                            
                            <td><input type="text" name="pid" id="pid" onkeypress="return isNumber(event)" class="form-control" value="<?php if(isset($_POST['search'])):if($pid!=''):echo $pid;endif;endif; ?>" /></td>
                            
                            <td>
                                <input type="text" name="receivedDate" id="receivedDate" class="form-control" value="<?php if(isset($_POST['search'])):if($receivedDate):echo $receivedDate;endif;endif; ?>" />
                            </td>

                            <td>
                                <button name="search" id="search" type="submit" class="btn btn-primary" onclick="return chkSubBtn();">
                                    <span class="glyphicon glyphicon-search"></span> search
                                </button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
                <div class="panel panel-default" style="margin-top:70px;">
                <div class="table-responsive">
                   <table class="table table-border table-striped" id="example1">
                    <thead>
                       <tr style="background:#E6EFF2;">
                           <th>Paper ID</th>
                           <th>Exam Name</th>
                           <th>Shift</th>
                           <th>Class</th>
                           <th>Section</th>
                           <th>Subject</th>
                           <th>Distribute Date</th>
                           <th>Received Date</th>
                       </tr>
                    </thead>

                    <tbody>
                <?php
foreach($win as $rows){   // this is for unique exam representation
$ctgID=$rows->exm_ctgid;  // this is exam ctg id

if(isset($_POST['search'])):                        

if(($sht != '')&&($cls == '')&&($sec == '')&&($sub == '')&&($pid == '')&&($receivedDate == '')): // shift search
    $pdis=$this->db->select("*")->from("exm_pdistribute")->where("exm_ctgid",$ctgID)->where("shiftid",$sht)->get()->result();

elseif(($sht != '')&&($cls != '')&&($sec == '')&&($sub == '')&&($pid == '')&&($receivedDate == '')): // shift and class search
    $pdis=$this->db->select("*")->from("exm_pdistribute")->where("exm_ctgid",$ctgID)->where("classid",$cls)->where("shiftid",$sht)->get()->result();

elseif(($sht != '')&&($cls != '')&&($sec != '')&&($sub == '')&&($pid == '')&&($receivedDate == '')): // shift and class and section
    $pdis = $this->db->select("*")->from("exm_pdistribute")->where("exm_ctgid",$ctgID)->where("shiftid",$sht)->where("classid",$cls)->where("section",$sec)->get()->result();

elseif(($sht != '')&&($cls != '')&&($sec != '')&&($sub != '')&&($pid == '')&&($receivedDate == '')): // shift class section subject search
    $pdis=$this->db->select("*")->from("exm_pdistribute")->where("exm_ctgid",$ctgID)->where("shiftid",$sht)->where("classid",$cls)->where("section",$sec)->where("subjid",$sub)->get()->result();

elseif(($sht == '')&&($cls=='')&&($sec=='')&&($sub=='')&&($pid!='')&&($receivedDate == '')): // only pid
    $pdis=$this->db->select("*")->from("exm_pdistribute")->where("exm_ctgid",$ctgID)->where("pdisid",$pid)->get()->result();

elseif(($sht != '')&&($cls!='')&&($sec!='')&&($sub!='')&&($pid!='')&&($receivedDate == '')): // class section subject pid
    $pdis=$this->db->select("*")->from("exm_pdistribute")->where("exm_ctgid",$ctgID)->where("pdisid",$pid)->where("classid",$cls)->where("section",$sec)->where("subjid",$sub)->get()->result();
elseif(($sht == '')&&($cls == '')&&($sec == '')&&($sub == '')&&($pid == '')&&($receivedDate != '')): // only distribute date
    $pdis=$this->db->select("*")->from("exm_pdistribute")->where("exm_ctgid",$ctgID)->get()->result();
else:
    $pdis=$this->db->select("*")->from("exm_pdistribute")->where("exm_ctgid",$ctgID)->get()->result(); // this is for search by exam ctg id
endif;
endif;

if(count($pdis)!=0){
    foreach($pdis as $p){

        // shift name
        $shiftName = $this->db->select("*")->from("shift_catg")->where("shiftid",$p->shiftid)->get()->row();

        // class name taking
        $clsNm=$this->db->select("*")->from("class_catg")->where("classid",$p->classid)->get()->row();

        // subject id
        $s=$this->db->query("SELECT s.subjid,p.sub_name FROM subject_class s right join subject_setup p ON s.subsetid = p.subsetid WHERE s.subjid = '$p->subjid'")->row();

        // if distribute date selected
        if(($sht == '')&&($cls == '')&&($sec == '')&&($sub == '')&&($pid == '')&&($receivedDate != '')):
        $preceive=$this->db->select("*")->from("exm_preceive")->where("pdisid",$p->pdisid)->where("subdate",$receivedDate)->get()->row();    // this is for search paper received id by paper distribute id
        else:
            $preceive=$this->db->select("*")->from("exm_preceive")->where("pdisid",$p->pdisid)->get()->row();    // this is for search paper received id by paper distribute id
        endif;

        // this is for search exam name from exam catg->exam_namecatg by exm_ctgid
        $xmNm=$this->db->select("*")->from("exm_catg")->where("exm_ctgid",$ctgID)->get()->row();

        // exam name search 
        $xmName=$this->db->select("*")->from("exm_namectg")->where("exmnid",$xmNm->exmnid)->get()->row();

if(count($preceive) != 0){
                ?>

                <tr>
                    <td><?php echo $p->pdisid; ?></td>
                    <td><?php echo $xmName->exm_name; ?></td>    
                    <td><?php echo $shiftName->shift_N; ?></td>    
                    <td><?php echo $clsNm->class_name; ?></td>    
                    <td><?php echo $p->section; ?></td>    
                    <td><?php echo $s->sub_name; ?></td>    
                    <td><?php echo $p->disdate; ?></td>    
                    <td><?php if(count($preceive) != 0):echo $preceive->subdate;endif; ?></td>    
                </tr>
                
                <?php
           
                        }
                            }
                        }
                    }
                    
                ?>
                </tbody>
                </table>
                </div>
                </div>
            </div>
        </div>
    </section>