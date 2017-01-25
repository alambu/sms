<script type="text/javascript">
        function classSection(cls){
            document.getElementById("section").innerHTML="<option value=''>Select</option>";
            // document.getElementById("sub").innerHTML="<option value=''>Select</option>";
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

                    // for(var j=0;j<subject.length-1;j++){
                    //     document.getElementById("sub").innerHTML+="<option value='"+subid[j]+"'>"+subject[j]+"</option>";   
                    // }
                }
            });
        }

    </script>

<style type="text/css">
   
    #tblhead tr td select{
        min-width:100px;
    }

    #tblhead tr td input[type='text']{width: 50px;}
    #tblhead tr td{border:none !important;}
    #tblhead tr th{border:none !important;text-align: center;}
</style>
<?php
    if(isset($_POST['indstdReslt'])){
        extract($_POST);
        $cl=$this->db->select("*")->from("class_catg")->where("classid",$class)->get()->row();
        $sct=explode(",", $cl->section);
    }
?>
<form action="" method="post">
                            <table class="table" id="tblhead">
                               <?php
                                    $exm=$this->db->select("*")->from("mark_add")->group_by("exmid")->get()->result();
                               ?>
                                <tr>
                                    <th>Exam</th>
                                    <th>Class</th>
                                     <th>Section</th>
                                     <th>Shift</th>
                                     <th>Roll</th>
                                     <th>Year</th>
                                     <th></th>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="exam" id="exam" class="form-control" required style="width:130px;">
                                            <option value="">Select</option>
                                            <?php
                                                foreach($exm as $e){
                                                    $xmName=$this->db->query("SELECT * FROM exm_namectg WHERE exmnid=(SELECT exmnid FROM exm_catg WHERE exm_ctgid=$e->exmid)")->row();
                                            ?>
                                           
                                    <option value="<?php echo $e->exmid ?>" <?php if(isset($_POST['indstdReslt'])){if($e->exmnid==$exam){echo "selected";}} ?> ><?php echo $xmName->exm_name ?></option>
                                            
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </td>
                                
                                    
                                    <td>

                                    <?php
                                        $cls=$this->db->select("*")->from("class_catg")->get()->result();
                                    ?>

                                        <select name="class" id="cls" onchange="classSection(this.value)" class="form-control" required>
                                            <option value="">Select</option>
                                            <?php
                                                foreach($cls as $c){
                                            ?>
                                        <option value="<?php echo $c->classid ?>" <?php if(isset($_POST['indstdReslt'])){if($c->classid==$class){echo "selected";}} ?> ><?php echo $c->class_name ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </td>
                                
                                   
                                    <td>
                                        <select name="section" id="section" class="form-control" required>
                                            <option value="">Select</option>
                                            <?php if(isset($_POST['indstdReslt'])){for($i=0;$i<count($sct);$i++): ?>
                                        <option value="<?php echo $sct[$i] ?>" <?php if($sct[$i]==$section){echo "selected";} ?> ><?php echo $sct[$i] ?></option>
                                            <?php endfor;} ?>
                                        </select>
                                    </td>
                                
                                    
                                    <td>
                                        <select name="shift" id="shift" class="form-control" required>
                                            <option value="">Select</option>
                                            <?php 
                                                $sft=$this->db->select("*")->from("shift_catg")->get()->result();
                                                foreach($sft as $st){
                                            ?>
                                            <option value="<?php echo $st->shiftid ?>" <?php if(isset($_POST['indstdReslt'])){if($st->shiftid==$shift){echo "selected";}} ?> ><?php echo $st->shift_N ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </td>
                                
                                    
                                    <td>
                                        <input type="text" name="roll" id="roll" class="form-control" required onkeypress="return isNumber(event)" value="<?php if(isset($_POST['indstdReslt'])){echo $roll;} ?>" />
                                    </td>
                                
                                    
                                    <td>
                                        <select name="year" id="year" class="form-control" required>
                                            <option value="">Select</option>
                                            <?php
                                                for($i=date("Y");$i>=2010;$i--){
                                            ?>
                                            <option value="<?php echo $i; ?>" <?php if($i==date("Y")){echo "selected";} ?> ><?php echo $i; ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </td>
                                
                                    <td>
                                        <button type="submit" name="indstdReslt" class="btn btn-primary" >
                                            <span class="glyphicon glyphicon-search" aria-hidden="true"> Search
                                            </span>
                                        </button>
                                    </td>
                            </tr>
                    </table>
    </form>