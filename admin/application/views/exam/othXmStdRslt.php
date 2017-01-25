<style type="text/css">
    h3,h4{
        text-align: center;
        margin-bottom: 0px;
    }
h4{font-size: 14px;}
    #Mmain{
        margin-top: 150px;
    }

</style>

<script language="javascript" type="text/javascript">
            function printDiv(divID) {
                // change some css
                document.getElementById("Mhead").setAttribute("style","margin-top:-25px;");
                document.getElementById("prt").style.display="none";
                document.getElementById("othback").style.display="none";
                // document.getElementsByTagName("button").style.display="none";
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

// data table print and declaration
$('#myTable').DataTable( {
    buttons: [
        {
            extend: 'print',
            text: 'Print current page',
            exportOptions: {
                modifier: {
                    page: 'current'
                }
            }
        }
    ]
} );

</script>

<aside class="right-side">
	<section class="content-header">
        <h1>
            Other Exam Result
            <small>Control panel</small>
        </h1>
            <ol class="breadcrumb">
            	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
    </section>

    <?php
        if(isset($_POST['stdList'])){
            extract($_POST);

            $dArray=array(
                "othexmid"=>$exam,
                "classid"=>$class,
                "section"=>$section,
                "shift"=>$shft,
                "subjid"=>$sub,
                "exm_date"=>$exm_date
                );
// exam name search
    $xmNm=$this->db->select("*")->from("exm_othercatg")->where("othexmid",$exam)->get()->row();
// class name search
    $clsNm=$this->db->select("*")->from("class_catg")->where("classid",$class)->get()->row();

// shift name search
    $sftN=$this->db->select("*")->from("shift_catg")->where("shiftid",$shft)->get()->row();

// subject name
    $sb=$this->db->select("*")->from("subject_class")->where("subjid",$sub)->get()->row();

// exam mark
            $std=$this->db->select("*")->from("exm_markother")->where($dArray)->limit(1)->get()->row();

// all student result search
            $stdMkLst=$this->db->select("*")->from("exm_markother")->where($dArray)->order_by("mark","DESC")->get()->result();

        }
    ?>

	<section>
		<div class="container-fluid">
            <div class="col-md-12">
            <div class="col-md-12" style="margin-top:10px;">
                <?php $this->load->view("exam/othrSrcHead.php"); ?>
            </div>
<div class="col-md-12" id="pDivPart">
            <div id="Mhead" class="col-md-11">
                <h3 style="text-align: center;"><?php echo $xmNm->exm_name; ?></h3>
                <h4 style="text-align: center;">Class : <?php echo $clsNm->class_name; ?> | Shift : <?php echo $sftN->shift_N ?></h4>
                <h4 style="text-align: center;">Section : <?php echo ucfirst($section); ?> | Subject : <?php echo $sb->sub_name; ?></h4>
                <h4 style="text-align: center;">Full Mark : <?php if(count($std)): echo $std->exm_mark;endif; ?> | Exam Date : <?php echo $exm_date; ?></h4>
            </div>

			

            	<div class="panel panel-default" id="Mmain">
                    <div class="responsive" id="mm">
                        <table class="table table-striped table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>SI</th>
                                    <th>Roll</th>
                                    <th>Student Name</th>
                                    <th>Mark</th>
                                </tr>
                            </thead>

                            <tbody>
                            
                            <?php
                                $si=0;
                                foreach($stdMkLst as $slt){
                                    $stdNm=$this->db->select("*")->from("regis_tbl")->where("stu_id",$slt->stu_id)->get()->row();
                                    $si++
                            ?>

                                <tr>
                                    <td><?php echo $si; ?></td>
                                    <td><?php echo $slt->roll_no; ?></td>
                                    <td><?php echo ucfirst($stdNm->name); ?></td>
                                    <td><?php echo $slt->mark; ?></td>
                                </tr>
                            
                            <?php
                                }
                            ?>

                            </tbody>

                        </table>
                        <table>
                            <tr>
                                <td style="width:500px;">
                                    <a href="index.php/exam/result" id="othback">
                                        <button class="btn btn-primary" style="position:relative;left:20px;" ><span class="glyphicon glyphicon-arrow-left"></span> Back</button>
                                    </a>
                                </td>
                                <td colspan="2" style="float:right;">
                                    <button class="btn btn-info" style="float:right;width:150px;margin-bottom:5px;" onclick="printDiv('pDivPart')" id="prt" >Print</button>
                                </td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    </aside>