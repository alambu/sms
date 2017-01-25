<!-- all style are here -->
<style type="text/css" media="print" media="screen">
    table tr td{border:none !important;}
    @media print{
        .table{border:none !important;}
        .table tr td{border:none !important;}
        .table td{border:none !important;}
        #pBtn{display:none !important;}
        #pbls{display:none !important;}
    }
</style>
<style type="text/css" media="screen">
        #maintbl tbody tr td{border:none !important;}
        table tbody tr td{border:none !important;}
</style>

<!-- all style are here end -->


<script>
    function printDiv(divID) {

        // hide the print button
            document.getElementById("ftrtbl").style.display="none";
            document.getElementById("pBtn").style.display="none";

            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;
            }
</script>

<aside class="right-side">
<section class="content-header">
                    <h1>
                        Examination Routine Print Report
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>
<?php
    if(isset($_POST['ok'])||(isset($_POST['publish']))){
        extract($_POST);

// exam routine subject search
        $xmRou=$this->db->select("*")->from("exm_routine")->where("exm_ctgid",$exam_name)->group_by("exm_date")->get()->result();

// search exam name
    $exid=$this->db->select("exmnid")->from("exm_catg")->where("exm_ctgid",$exam_name)->get()->row();

$exmName=$this->db->select("exm_name")->from("exm_namectg")->where("exmnid",$exid->exmnid)->get()->row();

           // time check function
            function TimeCheck($Ms){
                $MsEx=explode(":", $Ms);

                if($MsEx[0]>12){$MsTime=($MsEx[0]-12)." : ".$MsEx[1]." PM";return $MsTime;}
                else if($MsEx[0]==12){$MsTime=$MsEx[0]." : ".$MsEx[1]." PM"; return $MsTime;}
                else{$MsTime=$MsEx[0]." : ".$MsEx[1]." AM"; return $MsTime;}
            }

            // time check function end

    }
?>


<section>

<div class="container-fluid">
	<div class="col-md-11" id="pMainDiv">
        <div>
            <h3 style="text-align:center;">Exam Routine</h3>
            <h4 style="text-align:center;"><?php echo $exmName->exm_name." - ".date("Y"); ?></h4>
        </div>
		<div class="panel panel-default" style="margin-top:30px;">
        <?php
            if(count($xmRou)>0){
        ?>
           <table class="table" id="maintbl">
            <thead>
                <tr>
                    <th>Exam Date</th>
                    <th style="text-align:center;">Morning  <br/>(10:00 AM - 1:00 PM)</th>
                    <th style="text-align:center;">Evening  <br/>(2:00 PM - 5:00 PM)</th>
                </tr>
            </thead>
            <tbody>
           <?php
           
            foreach($xmRou as $x){
            $eachDate=$this->db->select("*")->from("exm_routine")->where("exm_ctgid",$exam_name)->where("exm_date",$x->exm_date)->get()->result();
            $erow=count($eachDate);
         
         ?>
            <tr style="border-bottom:1px solid green;">
                <td><?php echo $x->exm_date ?></td>
                <td>
                    <?php 
                        foreach($eachDate as $ed){
							if($ed->stime<13):
                            // class search
                            $cls=$this->db->select("*")->from("class_catg")->where("classid",$ed->classid)->get()->row();
                            // subject
                            $sbj=$this->db->query("SELECT s.subjid,p.sub_name FROM subject_class s right join subject_setup p ON s.subsetid = p.subsetid WHERE s.subjid = '$ed->subject'")->row();
                    ?>
                    <table class="table">
                        <tr>
                            <td style="text-align:center;"><?php if($ed->stime<13){echo "<b>Class :</b> <i>".$cls->class_name."</i><br> <b>Subject:</b> <i>".$sbj->sub_name." </i><br>"; }?></td>
                        </tr>
                    </table>
                    <?php
						endif;
                        }
                    ?>
                </td>
                <td>
                    <?php 
                        foreach($eachDate as $ed){
							if($ed->stime>13):
                            // class search
                            $cls=$this->db->select("*")->from("class_catg")->where("classid",$ed->classid)->get()->row();
                            // subject
                            $sbj=$this->db->query("SELECT s.subjid,p.sub_name FROM subject_class s right join subject_setup p ON s.subsetid = p.subsetid WHERE s.subjid = '$ed->subject'")->row();
                            
                    ?>
                    <table class="table">
                        <tr>
                            <td style="text-align:center;"><?php if($ed->stime>13){echo "<b>Class :</b> <i>".$cls->class_name."</i><br> <b>Subject :</b> <i>".$sbj->sub_name."</i> <br>"; }?></td>
                        </tr>
                    </table>
                    <?php
						endif;
					   }
                    ?>
                </td>
            </tr>
            

    <?php    
        }
    ?>
        </tbody>
        </table>
        <table class="table" id="ftrtbl">
            <tr>
                <td>
                    <form action="" method="post" id="pblfrm">
                        <input type="hidden" value="<?php echo $exmName->exm_name." - ".date("Y"); ?>" name="xmName">
                        <input type="hidden" name="exam_name" value="<?php echo $exam_name ?>">
                        <button class="btn btn-primary" type="submit" name="publish" id="pbls" style="position:relative;left:35%;width:100px;">
                            Publish
                        </button>
                    </form>

                    <button id="pBtn" class="btn btn-warning" style="position:relative;left:50%;width:100px;margin-top:-50px;" onClick="window.print()" >Print</button>
                </td>
            </tr>
        </table>
        <?php
            }else{
        ?>
<h3 style="text-align:center;color:red;">Exam Routine is not create yet</h3>
<a href="index.php/xmReport/xmRoutinePrint"><button class="btn btn-info" style="margin:10px;margin-left:150px;"> <span class="glyphicon glyphicon-arrow-left"></span> Back</button></a>
        <?php
            }
        ?>
        </div>
    </div>
</div>
        
</section>

</aside>

<?php 
    if(isset($_POST['publish'])):
        extract($_POST);
        $title=$xmName." routine published";
        // inititalize data
        $ed=date("Y-m-d");
        $eu=$this->session->userdata('userid');
        // data array
        $noticeData=array(
            "id"=>'',
            "title"=>$title,
            "pdf_details"=>'',
            "notice_date"=>$ed,
            "entry_user"=>$eu
        );
    // insert notice
    $ext=$this->db->select("*")->from("notice")->where("title",$title)->get()->num_rows();
    if($ext):
        echo '<script>alert("This Exam routine already Published.");</script>';
    else:
        $ntc=$this->db->insert("notice",$noticeData);
        echo '<script>alert("Exam routine Published.");</script>';
    endif;
    endif;
?>