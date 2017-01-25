<style type="text/css">
    h3,h5{text-align: center;}
    #ta tr td{
        border:none !important;
    }
    
    #lfsd{
        /*text-align: right;*/
        width: 120px
;
    }

    #rtsd{}

    #ta,#mark{
        margin:10px auto;
        max-width:700px !important;
        /*border:1px solid red;*/
        background: #F2EFEF;
    }

    #mark tr{
        border:1px solid #A08585;
    }

    #mark tr td{
        border:1px solid #d5d5d5;
    }


    #ta,#mark{
        
        /*border:1px solid red;*/
        background: #F2EFEF;
    }

button a{
    color: white;
}

button a:hover{
    color:#D3CDCD;
}

#tblh tr{
    border:1px solid #fff;
}
#tblh td{
    border:1px solid #fff;   
}

</style>




<script language="javascript" type="text/javascript">
            function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = divElements;

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;
            }
</script>

    <?php
        if(isset($_POST['stdReslt'])){
            extract($_POST);

            // array of data
            $data=array(
                "exmid"=>$exam,
                "classid"=>$class,
                "section"=>$section,
                "shift"=>$shift,
                "roll_no"=>$roll,
                "exmyear"=>$year
                );

            // student class name
            $clsN=$this->db->select("*")->from("class_catg")->where("classid",$class)->get()->row();
            
            // student all subject mark
            $rstStd=$this->db->select("*")->from("mark_add")->where($data)->get()->result();
            
            // student total gpa
            $gpa=0;
            $s=0;
            foreach($rstStd as $r):
                // subject grade
                $g=$this->db->select("*")->from("exm_grade")->where("mark_from <=",$r->total_mark)->where("mark_upto >=",$r->total_mark)->get()->row();
                $gpa+=$g->grade_point;
                $s++;
            endforeach;

            // exam name taken by this
            //$xmName=$this->db->select("*")->from("exm_namectg")->where("exmnid",$exam)->get()->row();
			$xmName=$this->db->query("SELECT * from exm_namectg where exmnid=(SELECT exmnid FROM exm_catg where exm_ctgid=$exam)")->row();

        }
    ?>

<div class="main_con"><!--Content Start-->
    <div class="row">
        <div class="col-md-9 left_con"><!-- left Content Start--><div class="row">
            <div class="col-md-12"><!-- Welcome Massage Start-->
                <div class="panel panel-primary">
                    <div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;">Academic Examination Result</div>
                    <div class="panel-body" style="min-height:750px;">
                    
                        <?php
                            if(count($rstStd)>0){
                                // student id taken by this
                                $stdid=$rstStd[0]->stu_id;

                        // take student personal information to show
                                $perInfoStd=$this->db->select("*")->from("regis_tbl")->where("stu_id",$stdid)->get()->row();
                                // get student shift id
                                $sftnm=$this->db->select("*")->from("shift_catg")->where("shiftid",$perInfoStd->shiftid)->get()->row();

                        // school information
                            $sName=$this->db->select("*")->from("sprofile")->order_by("id","desc")->limit("1")->get()->row(); 
                        
                        ?>

                    <div style="width:66%;margin:5px auto;border:1px solid #e3e3e3;" id="pDiv" >
                    <div>
                        <h3 style="text-align: center;"><?php echo $sName->schoolN; ?></h3>
                        <h5 style="text-align: center;"><?php echo $sName->address; ?></h5>
                        <h5 style="text-align: center;"><?php echo $xmName->exm_name; ?> Marksheet</h5>
                        <h5 style="text-align: center;"><?php echo "Class : ".$clsN->class_name; ?></h5>
                    </div>
                    
                    <div class="table-responsive">
                        <table style="width:100%;background:#eee;margin:0px auto;max-width:700px !important;" id="tblh">
                            <tr>
                                <td id="lfsd" style="width:120px
;">SID </td>
                                <td id="rtsd" >&nbsp;&nbsp; <?php echo $perInfoStd->stu_id; ?></td>
                                <td id="lfsd" style="width: 120px
;">Name </td>
                                <td id="rtsd" >&nbsp;&nbsp; <?php echo $perInfoStd->name; ?></td>
                            </tr>

                            <tr>
                                <td id="lfsd" style="width: 120px
;">Class </td>
                                <td id="rtsd" >&nbsp;&nbsp; <?php echo $clsN->class_name; ?></td>
                                <td id="lfsd" style="width: 120px
;">Father Name </td>
                                <td id="rtsd" >&nbsp;&nbsp; <?php echo $perInfoStd->fName; ?></td>
                            </tr>

                            <tr>
                                
                            </tr>

                            <tr>
                                <td id="lfsd" style="width: 120px
;">Section </td>
                                <td id="rtsd" >&nbsp;&nbsp; <?php echo $perInfoStd->section; ?></td>
                                <td id="lfsd" style="width: 120px
;">Mother Name </td>
                                <td id="rtsd" >&nbsp;&nbsp; <?php echo $perInfoStd->mName; ?></td>
                            </tr>

                            <tr>
                                <td id="lfsd" style="width: 120px
;">Shift</td>
                                <td id="rtsd" >&nbsp;&nbsp; <?php echo $sftnm->shift_N; ?></td>
                                <td id="lfsd" style="width: 120px
;">Birthdate </td>
                                <td id="rtsd" >&nbsp;&nbsp; <?php echo $perInfoStd->dob; ?></td>
                            </tr>

                            <tr>
                                
                            </tr>

                            <tr>
                                <td id="lfsd" style="width: 120px
;">Roll </td>
                                <td id="rtsd" >&nbsp;&nbsp; <?php echo $roll; ?></td>
                                <td id="lfsd" style="width: 120px
;">GPA</td>
                                <td id="rtsd" >&nbsp;&nbsp; <?php echo $gpa/$s; ?></td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table" id="mark" style="margin-top:10px;">
                            <thead>
                                <tr style="border:1px solid #d5d5d5;">
                                    <td style="border:1px solid #d5d5d5;">SI</td>
                                    <td style="border:1px solid #d5d5d5;">Subject Name</td>
                                    <td style="border:1px solid #d5d5d5;">Theory</td>
                                    <td style="border:1px solid #d5d5d5;">Obj</td>
                                    <td style="border:1px solid #d5d5d5;">Practical</td>
                                    <td style="border:1px solid #d5d5d5;">70%</td>
                                    <td style="border:1px solid #d5d5d5;">SBA</td>
                                    <td style="border:1px solid #d5d5d5;">Total</td>
                                    <td style="border:1px solid #d5d5d5;">Grade</td>
                                </tr>
                            </thead>
                            <tbody>
                                    
                                <?php
                                    $var=0;
                                    foreach($rstStd as $rSd){
                                        $var++;

                                        // subject name
                                        $sbNm=$this->db->select("*")->from("subject_class")->where("subjid",$rSd->subjid)->get()->row();

                                        // subject grade
                                        $gd=$this->db->select("*")->from("exm_grade")->where("mark_from <=",$rSd->total_mark)->where("mark_upto >=",$rSd->total_mark)->get()->row();

                                        $th=$rSd->theory_mark;
                                        $ob=$rSd->obj_mark;
                                        $pr=$rSd->practical_mark;
                                        
                                        $persent=(((($th+$ob+$pr))*70)/100);
                                    
                                ?>

                                <tr style="border:1px solid #d5d5d5;">
                                    <td style="border:1px solid #d5d5d5;"><?php echo $var; ?></td>
                                    <td style="border:1px solid #d5d5d5;"><?php echo $sbNm->sub_name; ?></td>
                                    <td style="border:1px solid #d5d5d5;"><?php echo $rSd->theory_mark; ?></td>
                                    <td style="border:1px solid #d5d5d5;"><?php echo $rSd->obj_mark; ?></td>
                                    <td style="border:1px solid #d5d5d5;"><?php echo $rSd->practical_mark; ?></td>
                                    <td style="border:1px solid #d5d5d5;"><?php echo ceil($persent) ?></td>
                                    <td style="border:1px solid #d5d5d5;"><?php echo $rSd->sba_mark; ?></td>
                                    <td style="border:1px solid #d5d5d5;"><?php echo $rSd->total_mark; ?></td>
                                    <td style="border:1px solid #d5d5d5;"><?php echo $gd->grade_N; ?></td>
                                </tr>

                                <?php
                                    }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div style="margin:5px;">
                    <button class="btn btn-primary" style="margin-left:43%;" onclick="printDiv('pDiv')" >Print</button>

                    <a href="index.php/home/indStdRslt">
                    <button class="btn btn-primary" style="margin-left:5px;">
                    <span class="glyphicon glyphicon-repeat" style="line-height:15px;"></span>
                         &nbsp;Search Again
                    
                    </button>
                    </a>
                </div>
                
                <?php
                    }else{
                ?>

                <div class="col-md-12" style="margin-top:10%;margin-left:40%;">
                    <b style="color:red;text-align:center;">Result Not found.</b><br/><br/><br/>
                    <a href="index.php/home/indStdRslt">
                        <button class="btn btn-primary" style="margin-left:5px;">
                        <span class="glyphicon glyphicon-repeat" style="line-height:15px;"></span> Search Again</button>
                    </a>
                    
                </div>

                <?php
                    }
                ?>

                </div>
            </div>
        </div>
    </div>
</div>
