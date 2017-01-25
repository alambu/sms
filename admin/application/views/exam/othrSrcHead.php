<script type="text/javascript">
        function classSection(cls){
            document.getElementById("section").innerHTML="<option value=''>Select</option>";
            document.getElementById("sub").innerHTML="<option value=''>Select</option>";
            $.ajax({
                url:"index.php/exam/classSection",
                data:{clsid:cls},
                type:"POST",
                success:function(str){
                    // alert(str);
                    var data=str.split("+");  // split data into two peices section and subject
                    var s=data[0];  // section value
                    var sb=data[1]; // subject value
                    var sid=data[2]; // subject value

                    var sec=s.split(",");       // section value split into an array
                    var subject=sb.split(",");  // subject value split into an array
                    var subid=sid.split(",");

                    for(var i=0;i<sec.length;i++){
                    document.getElementById("section").innerHTML+="<option value='"+sec[i]+"'>"+sec[i]+"</option>";
                    }

                    for(var j=0;j<subject.length-1;j++){
                        document.getElementById("sub").innerHTML+="<option value='"+subid[j]+"'>"+subject[j]+"</option>";   
                    }
                }
            });
        }



// for date picker 

$(document).ready(function () {                
    $('#xmDate').datepicker({format: "yyyy-mm-dd"});            
});


function xmDate(sValue){
    var xm=document.getElementById("exam").value;
    var cls=document.getElementById("cls").value;
    var section=document.getElementById("section").value;
    var shft=document.getElementById("shft").value;
    var sub=document.getElementById("sub").value;

    var dataArray=xm+"+"+cls+"+"+section+"+"+shft+"+"+sub;

    // ajax request
    $.ajax({
        url:"index.php/xmAllRequest/xmDateSearch",
        type:"POST",
        data:{d:dataArray},
        success:function(xmD){
            var xmOpt=xmD.split(",");
            
            document.getElementById("exm_date").innerHTML='';
            document.getElementById("exm_date").innerHTML="<option value=''>Select</option>";

            for(var i=1;i<xmOpt.length;i++){
                document.getElementById("exm_date").innerHTML+='<option value="'+xmOpt[i]+'" >'+xmOpt[i]+'</option>';
            }
        }
    });
}

</script>

<style type="text/css">
    #othHead tr td{border:none;}
    #othHead tr th{border:none;line-height: 30px;}
</style>

<?php 
    if(isset($_POST['stdList'])){
        extract($_POST);

        // query for section selection
        $st=$this->db->select("*")->from("class_catg")->where("classid",$class)->get()->row();
        $stExp=explode(",", $st->section);

        // query for subject select
        $sb=$this->db->select("*")->from("subject_class")->where("classid",$class)->get()->result();

        // this query for exam date search
        $data=array(
            "othexmid"=>$exam,
            "classid"=>$class,
            "section"=>$section,
            "shift"=>$shft,
            "subjid"=>$sub
        );

    $xmS=$this->db->select("exm_date")->distinct()->from("exm_markother")->where($data)->order_by("id","desc")->limit(15)->get()->result();
    }
 ?>

<form action="" method="post">
                            <table id="othHead" width="100%;">
                               <?php
                                    $exm=$this->db->select("*")->from("exm_othercatg")->get()->result();
                               ?>
                                <tr>
                                    <th>Exam</th>
                                    <td>
                                        <select name="exam" id="exam" style="min-width:120px;" class="form-control" required >
                                            <option value="">Select</option>
                                            <?php
                                                foreach($exm as $e){
                                            ?>
                                            
                                        <option value="<?php echo $e->othexmid ?>" <?php if(isset($_POST['stdList'])){if($e->othexmid==$exam){echo "selected";}} ?> ><?php echo $e->exm_name ?></option>
                                            
                                            <?php  
                                                }
                                            ?>
                                        </select>
                                    </td>
                                    <th>Class</th>
                                    <td>

                                    <?php
                                        $cls=$this->db->select("*")->from("class_catg")->get()->result();
                                    ?>

                                        <select name="class" id="cls" onchange="classSection(this.value)" class="form-control" required style="min-width:70px;">
                                            <option value="">Select</option>
                                            <?php
                                                foreach($cls as $c){
                                            ?>
                                        <option value="<?php echo $c->classid ?>" <?php if(isset($_POST['stdList'])){if($c->classid==$class){echo "selected";}} ?> ><?php echo $c->class_name ?></option>
                                            
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </td>
                                
                                    <th>Section</th>
                                    <td>
                                        <select name="section" id="section" class="form-control" required>
                                            <option value="">Select</option>
                                            <?php if(isset($_POST['stdList'])){for($k=0;$k<count($stExp);$k++): ?>
                                        <option value="<?php echo $stExp[$k] ?>" <?php if($stExp[$k]==$section){echo "selected";} ?> ><?php echo $stExp[$k] ?></option>
                                            <?php endfor;} ?>
                                        </select>
                                    </td>
                                
                                    <th>Shift</th>
                                    <td>
                                        <select name="shft" id="shft" class="form-control" style="min-width:70px;">
                                            <option value="">Select</option>
                                            <?php
                                                $sft=$this->db->select("*")->from("shift_catg")->get()->result();
                                                foreach($sft as $st){
                                            ?>
                                            <option value="<?php echo $st->shiftid; ?>" <?php if(isset($_POST['stdList'])):if($st->shiftid==$shft){echo "selected";}endif; ?>><?php echo $st->shift_N; ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </td>
                                
                                    <th>Subject</th>
                                    <td>
                                        <select name="sub" id="sub" class="form-control" required onchange="xmDate(this.value)" style="min-width:120px;">
                                            <option value="">Select</option>
                                    <?php if(isset($_POST['stdList'])): foreach($sb as $b): ?>
                                    <option value="<?php echo $b->subjid ?>" <?php if($b->subjid==$sub):echo "selected";endif; ?> ><?php echo $b->sub_name ?></option>
                                    <?php
                                        endforeach;
                                        endif; 
                                    ?>
                                        </select>
                                    </td>
                                
                                    <th>
                                        Date
                                    </th>        
                                    <td>
                                        <select name="exm_date" id="exm_date" class="form-control" required style="min-width:125px;" >
                                            <option value="">Select</option>
                                    <?php if(isset($_POST['stdList'])):foreach($xmS as $x): ?>
                                        <option value="<?php echo $x->exm_date ?>" <?php if($x->exm_date==$exm_date):echo "selected";endif; ?> ><?php echo $x->exm_date ?></option>
                                    <?php 
                                        endforeach;
                                        endif;
                                     ?>

                                        </select>
                                    </td>
                            
                            <td>
                                <button type="submit" name="stdList" class="btn btn-primary" >Submit
                                </button>
                            </td>
                        </tr>
                    </table>
            </form>