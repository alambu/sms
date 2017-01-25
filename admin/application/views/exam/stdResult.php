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

<aside class="right-side">
	<section class="content-header">
        <h1>
            Indivisual Student Result
            <small>Control panel</small>
        </h1>
            <ol class="breadcrumb">
            	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
    </section>

    <?php
        if(isset($_POST['indstdReslt'])){
            extract($_POST);
            // initialize
            $rstStd=array();
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
            $xmName=$this->db->select("*")->from("exm_namectg")->where("exmnid",$exam)->get()->row();

        }
    ?>

	<section>
		<div class="container-fluid">
			<div class="col-md-12">
            <div class="col-md-12">
                <?php $this->load->view('exam/indivisualStdHeadRslt'); ?>
            </div>
				<div class="panel panel-default" style="margin-top:80px;">
                    
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
                        <h5 style="text-align: center;"><?php echo ucwords($xmName->exm_name); ?> Marksheet</h5>
                        <h5 style="text-align: center;"><?php echo "Class : ".ucwords($clsN->class_name); ?></h5>
                    </div>
                    
                    <div class="table-responsive">
                        <table style="width:100%;background:#eee;margin:0px auto;max-width:700px !important;" id="tblh">
                            <tr>
                                <td id="lfsd" style="width:120px
;">SID </td>
                                <td id="rtsd" >&nbsp;&nbsp; <?php echo $perInfoStd->stu_id; ?></td>
                                <td id="lfsd" style="width: 120px
;">Name </td>
                                <td id="rtsd" >&nbsp;&nbsp; <?php echo ucwords($perInfoStd->name); ?></td>
                            </tr>

                            <tr>
                                <td id="lfsd" style="width: 120px
;">Class </td>
                                <td id="rtsd" >&nbsp;&nbsp; <?php echo $clsN->class_name; ?></td>
                                <td id="lfsd" style="width: 120px
;">Father Name </td>
                                <td id="rtsd" >&nbsp;&nbsp; <?php echo ucwords($perInfoStd->fName); ?></td>
                            </tr>

                            <tr>
                                
                            </tr>

                            <tr>
                                <td id="lfsd" style="width: 120px
;">Section </td>
                                <td id="rtsd" >&nbsp;&nbsp; <?php echo ucwords($perInfoStd->section); ?></td>
                                <td id="lfsd" style="width: 120px
;">Mother Name </td>
                                <td id="rtsd" >&nbsp;&nbsp; <?php echo ucwords($perInfoStd->mName); ?></td>
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
									// get this subject passing mark
									$sbpsmk=$this->db->select("*")->from("pass_markctg")->where("classid",$rSd->classid)->where("subjid",$rSd->subjid)->get()->row();

                                        // subject name
                                        $sbNm=$this->db->select("*")->from("subject_class")->where("subjid",$rSd->subjid)->get()->row();

                                        if($sbpsmk->t_mark<=0):
											if(($rSd->theory_mark>=$sbpsmk->theory)&&($rSd->obj_mark>=$sbpsmk->obj)&&($rSd->practical_mark>=$sbpsmk->diff_pass)):
                                        // then check grade
											$gd=$this->db->select("*")->from("exm_grade")->where("mark_from <=",$rSd->total_mark)->where("mark_upto >=",$rSd->total_mark)->get()->row();
											else:
												$gd->grade_N="F";
											endif;
										else:
										// then check grade directly
											$gd=$this->db->select("*")->from("exm_grade")->where("mark_from <=",$rSd->total_mark)->where("mark_upto >=",$rSd->total_mark)->get()->row();
										endif;
								
										// subject grade
                                        //$gd=$this->db->select("*")->from("exm_grade")->where("mark_from <=",$rSd->total_mark)->where("mark_upto >=",$rSd->total_mark)->get()->row();

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
                                    <td style="border:1px solid #d5d5d5;"><?php if($sbpsmk->diff_pass>0):echo $rSd->practical_mark;else:echo "-";endif; ?></td>
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
                    <button class="btn btn-primary" style="margin-left:43%;width:150px;" onclick="printDiv('pDiv')" >Print</button>

                    
                </div>
                
                <?php
                    }else{
                ?>

                <div style="min-height:100px;">
                   <center style="margin-top:5%;">
                    <b style="color:red;text-align:center !important;">Result Not found.</b>
                   </center>
                </div>

                <?php
                    }
                ?>

                </div>
           
           <div style="min-height:100px;">
               <a href="index.php/exam/result">
                    <button class="btn btn-success">
                       <span class="glyphicon glyphicon-arrow-left"></span> Back To Result processing
                    </button>
               </a>
           </div>

            </div>
        </div>
    </section>