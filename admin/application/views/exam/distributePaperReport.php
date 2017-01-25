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
    function edit(disrid){
        
// hide all normal data toggle to edit
        document.getElementById("teach"+disrid).style.display="none";
        document.getElementById("total"+disrid).style.display="none";
        document.getElementById("disDate"+disrid).style.display="none";
        document.getElementById("retrn"+disrid).style.display="none";

// show editing field for edit
        document.getElementById("allTe"+disrid).style.display="block";
        document.getElementById("tot"+disrid).type="text";
        document.getElementById("disDa"+disrid).type="text";
        document.getElementById("disDa"+disrid).disabled=true;
        document.getElementById("ret"+disrid).type="text";


// this is for edit and success button toggle
        document.getElementById("action"+disrid).setAttribute("class","btn btn-success");

        document.getElementById("action"+disrid).setAttribute("onClick","succ("+disrid+")");
        document.getElementById("edit"+disrid).style.display="none";
        document.getElementById("ok"+disrid).style.display="block";
    }

    function succ(disrid){

        // toggle success button to edit button
        document.getElementById("action"+disrid).setAttribute("class","btn btn-primary");
        document.getElementById("action"+disrid).setAttribute("onClick","edit("+disrid+")");
        document.getElementById("edit"+disrid).style.display="block";
        document.getElementById("ok"+disrid).style.display="none";

//  take all value for update
    var allTe=document.getElementById("allTe"+disrid).value;
    var tot=document.getElementById("tot"+disrid).value;
    var ret=document.getElementById("ret"+disrid).value;
    var pdid=document.getElementById("pdid"+disrid).value;

    $.ajax({
        url:"index.php/edit/distPapUp",
        type:"POST",
        data:{t:allTe,dpt:tot,rD:ret,id:pdid},
        success:function(data){
            // alert(data);

            // if(data==1){

// hide all normal data toggle to edit
        document.getElementById("teach"+disrid).style.display="block";
        document.getElementById("total"+disrid).style.display="block";
        document.getElementById("disDate"+disrid).style.display="block";
        document.getElementById("retrn"+disrid).style.display="block";

// show editing field for edit
        document.getElementById("allTe"+disrid).style.display="none";
        document.getElementById("tot"+disrid).type="hidden";
        document.getElementById("disDa"+disrid).type="hidden";
        document.getElementById("disDa"+disrid).disabled=false;
        document.getElementById("ret"+disrid).type="hidden";

// return changed value into normal
        var tName=document.getElementById("allTe"+disrid).options[document.getElementById("allTe"+disrid).selectedIndex].text;
        document.getElementById("teach"+disrid).innerHTML=tName;
        document.getElementById("total"+disrid).innerHTML=tot;
        document.getElementById("retrn"+disrid).innerHTML=ret;

            // }

        }
    });
    }

// datepicker
$(document).ready(function(){
    $("#disdate").datepicker({format:"yyyy-mm-dd"})
    $("#redate").datepicker({format:"yyyy-mm-dd"})
});

// onchange class id set section and subject
function secSub(str){
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
        for(var j=0;j<sbid.length;j++){
            document.getElementById("sub").innerHTML+='<option value="'+sbid[j]+'">'+sbnm[j]+'</option>';
        }
    }
});
}

// onsubmit check
function chkval(){
    var ex      = document.getElementById("ex").value;
    var cls     = document.getElementById("cls").value;
    var sec     = document.getElementById("sec").value;
    var sub     = document.getElementById("sub").value;
    var teach   = document.getElementById("teach") .value;
    var disdate = document.getElementById("disdate").value;
    var redate  = document.getElementById("redate").value;
    var pid     = document.getElementById("pid").value;
// alert(pid);
// if(pid==''){alert("fail");}return false;
    // test
    if((ex=='')&&(cls=='')&&(sec=='')&&(sub=='')&&(teach=='')&&(disdate=='')&&(redate=='')&&(pid=='')){
        alert("Please Select something to search");return false;
    }
}

</script>

<aside class="right-side">
	<section class="content-header">
        <h1>
             Paper Distribute Report
            <small>Control panel</small>
        </h1>
            <ol class="breadcrumb">
            	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
    </section>

<?php
    if(isset($_POST['go'])){
        extract($_POST);

        // data array
        $data=array(
            "exm_ctgid"=>$exam,
            "classid"=>$class,
            "section"=>$sec
            );

        // take exam catg id from exm_catg table
        $xmCtg=$this->db->select("*")->from("exm_catg")->where("exm_ctgid",$exam)->get()->row();
        
        // query exam name from exm_namecatg by exam id
        $xmNm=$this->db->select("*")->from("exm_namectg")->where("exmnid",$xmCtg->exmnid)->get()->row();

        // class name getting
        $cls=$this->db->select("*")->from("class_catg")->where("classid",$class)->get()->row();

        // distribute paper searching
        $disP=$this->db->select("*")->from("exm_pdistribute")->where($data)->get()->result();
    }

    //  this is for search section
    // class search
    $cl=$this->db->select("*")->from("class_catg")->get()->result();
    // teacher search
    $tch=$this->db->select("*")->from("emp_type")->where("type","teacher")->get()->row();
    $teacher=$this->db->select("*")->from("empee")->where("emptypeid",$tch->emptypeid)->get()->result();
    // end search section

    // search exam
$xmNid = $this->db->select("GROUP_CONCAT(exmnid) as cat")->from("exm_namectg")->get()->row();

$xmNid = str_replace("'", "", $xmNid);

$exm = $this->db->select("*")->from("exm_catg")->where_in("exmnid",$xmNid->cat)->get()->result();

    if(isset($_POST['search'])):
        extract($_POST);
        if(($ex!='')&&($cls=='')&&($sec=='')&&($sub=='')&&($disdate=='')&&($redate=='')&&($teach=='')&&($pid=='')):
            // only exam
            $disP=$this->db->select("*")->from("exm_pdistribute")->where('exm_ctgid',$ex)->get()->result();
        elseif(($ex!='')&&($cls!='')&&($sec=='')&&($sub=='')&&($disdate=='')&&($redate=='')&&($teach=='')&&($pid=='')):
            // exam and class
            $disP=$this->db->select("*")->from("exm_pdistribute")->where('exm_ctgid',$ex)->where('classid',$cls)->get()->result();
        // class and section combine search
        elseif(($ex!='')&&($cls!='')&&($sec!='')&&($sub=='')&&($disdate=='')&&($redate=='')&&($teach=='')&&($pid=='')):
            $disP=$this->db->select("*")->from("exm_pdistribute")->where('exm_ctgid',$ex)->where('classid',$cls)->where('section',$sec)->get()->result();
        // class section subject
        elseif(($ex!='')&&($cls!='')&&($sec!='')&&($sub!='')&&($disdate=='')&&($redate=='')&&($teach=='')&&($pid=='')):
            $disP=$this->db->select("*")->from("exm_pdistribute")->where('exm_ctgid',$ex)->where('classid',$cls)->where('section',$sec)->where('subjid',$sub)->get()->result();
        // only teacher
        elseif(($ex!='')&&($cls=='')&&($sec=='')&&($sub=='')&&($disdate=='')&&($redate=='')&&($teach!='')&&($pid=='')):
            $disP=$this->db->select("*")->from("exm_pdistribute")->where('exm_ctgid',$ex)->where('techID',$teach)->get()->result();
        // only distribute id
        elseif(($ex!='')&&($cls=='')&&($sec=='')&&($sub=='')&&($disdate=='')&&($redate=='')&&($teach=='')&&($pid!='')):
            $disP=$this->db->select("*")->from("exm_pdistribute")->where('exm_ctgid',$ex)->where('pdisid',$pid)->get()->result();
        // only distribute date
        elseif(($ex!='')&&($cls=='')&&($sec=='')&&($sub=='')&&($disdate!='')&&($redate=='')&&($teach=='')&&($pid=='')):
            $disP=$this->db->select("*")->from("exm_pdistribute")->where('exm_ctgid',$ex)->where('disdate',$disdate)->get()->result();
        // only return date
        elseif(($ex!='')&&($cls=='')&&($sec=='')&&($sub=='')&&($disdate=='')&&($redate!='')&&($teach=='')&&($pid=='')):
            $disP=$this->db->select("*")->from("exm_pdistribute")->where('exm_ctgid',$ex)->where('retdate',$redate)->get()->result();
        // class section subject teacher
        elseif(($ex!='')&&($cls!='')&&($sec!='')&&($sub!='')&&($disdate=='')&&($redate=='')&&($teach!='')&&($pid=='')):
            $disP=$this->db->select("*")->from("exm_pdistribute")->where('exm_ctgid',$ex)->where('classid',$cls)->where('section',$sec)->where('subjid',$sub)->where("techID",$teach)->get()->result();
        // distribute and return date
        elseif(($ex!='')&&($cls=='')&&($sec=='')&&($sub=='')&&($disdate!='')&&($redate!='')&&($teach=='')&&($pid=='')):
            $disP=$this->db->select("*")->from("exm_pdistribute")->where('exm_ctgid',$ex)->where('disdate',$disdate)->where('retdate',$redate)->get()->result();
        // class and teacher
        elseif(($ex!='')&&($cls!='')&&($sec=='')&&($sub=='')&&($disdate=='')&&($redate=='')&&($teach!='')&&($pid=='')):
            $disP=$this->db->select("*")->from("exm_pdistribute")->where('classid',$cls)->where('exm_ctgid',$ex)->where('techID',$teach)->get()->result();
        endif;
    endif;

?>

	<section>
		<div class="container-fluid">
			<div class="col-md-12">
            
            <div class="col-md-12" style="margin-top:10px;">
                <form action="" method="post" onsubmit="return chkval()">
                    <table style="width:100%;">
                        <tr style="background:none !important;">
                            <th>Exam</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Subject</th>
                            <th>Teacher</th>
                            <th>Distribute Date</th>
                            <th>Return Date</th>
                            <th>Paper ID</th>
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
                                <select name="cls" id="cls" class="form-control" onchange="secSub(this.value)">
                                    <option value="">Select</option>
                                <?php foreach($cl as $c): ?>
                                    <option value="<?php echo $c->classid ?>" <?php if(isset($_POST['search'])):if($cls!=''):if($c->classid==$cls):echo "selected";endif;endif;endif; ?> ><?php echo $c->class_name ?></option>
                                <?php endforeach; ?>
                                </select>
                            </td>
                            
                            <td>
                                <select name="sec" id="sec" class="form-control">
                                    <option value="">Select</option>
                            <?php if(isset($_POST['search'])):if($cls!=''):
                                $sect=$this->db->select("*")->from("class_catg")->where("classid",$cls)->get()->row();
                                $secSep=explode(",",$sect->section);
                                for($j=0;$j<count($secSep);$j++):
                            ?>
                            <option value="<?php echo $secSep[$j]; ?>" <?php if($secSep[$j]==$sec):echo "selected";endif; ?> ><?php echo $secSep[$j]; ?></option>
                            <?php endfor;endif;endif; ?>
                                </select>
                            </td>
                            
                            <td>
                                <select name="sub" id="sub" class="form-control">
                                    <option value="">Select</option>
                            <?php if(isset($_POST['search'])):if($cls!=''):
                                $sbj=$this->db->select("*")->from("subject_class")->where("classid",$cls)->get()->result();
                                foreach($sbj as $sj):
                             ?>
                                <option value="<?php echo $sj->subjid ?>" <?php if($sj->subjid==$sub):echo "selected";endif; ?> ><?php echo $sj->sub_name ?></option>
                            <?php endforeach;endif;endif; ?>
                                </select>
                            </td>
                            
                            <td>
                                <select name="teach" id="teach" class="form-control">
                                    <option value="">Select</option>
                                <?php foreach($teacher as $t): ?>
                                    <option value="<?php echo $t->empid ?>" <?php if(isset($_POST['search'])):if($teach!=''):if($t->empid==$teach):echo "selected";endif;endif;endif; ?> ><?php echo $t->name." (".$t->empid." )"; ?></option>
                                <?php endforeach; ?>
                                </select>
                            </td>
                            
                            <td>
                                <input type="text" name="disdate" id="disdate" class="form-control" placeholder="Distribute date" value="<?php if(isset($_POST['search'])):if(isset($disdate)):echo $disdate;endif;endif;?>" />
                            </td>
                            
                            <td>
                                <input name="redate" id="redate" class="form-control" placeholder="Return date" value="<?php if(isset($_POST['search'])):if(isset($redate)):echo $redate;endif;endif;?>" />
                            </td>
                            
                            
                            <td>
                                <input type="text" name="pid" id="pid" class="form-control" onkeypress="return isNumber(event)" placeholder="Paper ID" />
                            </td>
                            <td>
                                <button type="submit" name="search" id="search" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-search"></span> Search
                                </button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>

            	<div class="panel panel-default" style="margin-top:90px;">
                    <div class="table-responsive">
                    <table class="table table-border table-striped" id="example1">
                        <thead>
                            <tr>
                                <th>Paper ID</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Subject</th>
                                <th>Teacher</th>
                                <th>Total Paper</th>
                                <th>Distribute Date</th>
                                <th>Return Date</th>
                                <th>Action</th>
                                <th>Print Token</th>
                            </tr>    
                        </thead>

                        <tbody>

                        <?php
                            $disp=0;    // initialize each row id value

                            $allTeacher=$this->db->query("SELECT * FROM empee WHERE emptypeid IN(SELECT emptypeid FROM emp_type WHERE type='teacher')")->result();
                            foreach($disP as $dp){
                                $disp++;
                                $teacher=$this->db->select("*")->from("empee")->where("empid",$dp->techID)->get()->row();
                                $subName=$this->db->select("*")->from("subject_class")->where("subjid",$dp->subjid)->get()->row();
                                // class name
                                $c=$this->db->select("*")->from("class_catg")->where("classid",$dp->classid)->get()->row();

                        ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#ret<?php echo $disp ?>").datepicker({format:"yyyy-mm-dd"});
    });
</script>


                        <tr>
                            <td>
                                <?php echo $dp->pdisid; ?>
                            </td>
                            
                            <td><?php echo $c->class_name; ?></td>

                            <td><?php echo $dp->section; ?></td>
                            
                            <td>
                                <span><?php echo $subName->sub_name; ?></span>
                            </td>

                            <td>
                                <input type="hidden" name="pdid" id="pdid<?php echo $disp ?>" value="<?php echo $dp->pdisid; ?>" />
                                <span id="teach<?php echo $disp; ?>"><?php echo $teacher->name." (".$teacher->empid." )"; ?></span>
                                <select name="allTe" id="allTe<?php echo $disp; ?>" style="display:none;" class="form-control">
                                    <option value="">Select</option>
                                    <?php
                                        foreach($allTeacher as $alTe){
                                    ?>
                                        <option value="<?php echo $alTe->empid; ?>" <?php if($dp->techID==$alTe->empid){echo "selected";} ?> ><?php echo $alTe->name.' ('.$alTe->empid.' )'; ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </td>
                            
                            <td>
                                <span id="total<?php echo $disp; ?>"><?php echo $dp->tpaper; ?></span>
                                <input type="hidden" name="total" id="tot<?php echo $disp ?>" value="<?php echo $dp->tpaper; ?>" class="form-control" />
                            </td>
                            
                            <td>
                                <span id="disDate<?php echo $disp; ?>"><?php echo $dp->disdate; ?></span>
                                <input type="hidden" name="disDate" id="disDa<?php echo $disp ?>"  value="<?php echo $dp->disdate; ?>" class="form-control" />
                            </td>
                            
                            <td>
                                 <spna id="retrn<?php echo $disp; ?>"><?php echo $dp->retdate; ?></spna>
                                 <input type="hidden" name="retrn" id="ret<?php echo $disp ?>" value="<?php echo $dp->retdate; ?>" class="form-control" />
                            </td>
                            <td>
                                <button class="btn btn-primary" id="action<?php echo $disp; ?>" onclick="edit(<?php echo $disp; ?>)">
                                    <span class="glyphicon glyphicon-edit" id="edit<?php echo $disp; ?>"></span>
                                    <span class="glyphicon glyphicon-ok" id="ok<?php echo $disp; ?>"  style="display:none;"></span>
                                </button>
                            </td>
                            <td>
                                <a href="index.php/xmReport/printToken?pid=<?php echo $dp->pdisid; ?>">
                                    <button class="btn btn-primary" type="button">
                                        Print
                                    </button>
                                </a>
                                
                            </td>
                        </tr>

                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </section>