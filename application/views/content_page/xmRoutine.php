<!-- all style are here -->
<style type="text/css" media="print" media="screen">
    table tr td{border:none !important;}
    @media print{
        .table{border:none !important;}
        .table tr td{border:none !important;}
        .table td{border:none !important;}
        #pBtn{display:none !important;}
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

<?php
    if(isset($_GET['ok'])){
        $exam_name=$_GET['ok'];

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

<div class="main_con"><!--Content Start-->
    <div class="row">
        <div class="col-md-9 left_con"><!-- left Content Start-->
            <div class="row">
                <div class="col-md-12"><!-- Welcome Massage Start-->
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;">  Exam Routine</div>
                        <div class="panel-body" style="min-height:770px;">
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
            $eachDate=$this->db->select("*")->from("exm_routine")->where("exm_date",$x->exm_date)->get()->result();
            $erow=count($eachDate);
         
         ?>
            <tr style="border-bottom:1px solid green;">
                <td><b><?php echo $x->exm_date ?></b></td>
                <td>
                    <?php 
                        foreach($eachDate as $ed){
                            if($ed->stime<13):
                            // class search
                            $cls=$this->db->select("*")->from("class_catg")->where("classid",$ed->classid)->get()->row();
                            // subject
                            $sbj=$this->db->select("*")->from("subject_class")->where("subjid",$ed->subject)->get()->row();
                    ?>
                    <table class="table">
                        <tr>
                            <td style="text-align:center;"><?php if($ed->stime<13){echo "<b>Class :</b> <i>".$cls->class_name."</i><br> <b>Subject:</b> <i>".$sbj->sub_name." </i>"; }?></td>
                        </tr>
                    </table>
                    <?php
                      endif;  }
                    ?>
                </td>
                <td>
                    <?php 
                        foreach($eachDate as $ed){
                            if($ed->stime>13):
                            // class search
                            $cls=$this->db->select("*")->from("class_catg")->where("classid",$ed->classid)->get()->row();
                            // subject
                            $sbj=$this->db->select("*")->from("subject_class")->where("subjid",$ed->subject)->get()->row();
                    ?>
                    <table class="table">
                        <tr>
                            <td style="text-align:center;"><?php if($ed->stime>13){echo "<b>Class :</b> <i>".$cls->class_name."</i><br> <b>Subject :</b> <i>".$sbj->sub_name."</i>"; }?></td>
                        </tr>
                    </table>
                    <?php
                        endif; }
                    ?>
                </td>
            </tr>
            

    <?php    
        }
    ?>
        </tbody>
        </table>
        <table class="table">
            <tr>
                <td>
                    <button id="pBtn" class="btn btn-warning" style="float:right;margin-right:250px;width:100px;" onClick="printDiv('pMainDiv')" >Print</button>
                </td>
            </tr>
        </table>
        <?php
            }
        ?>
        </div>
    </div>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!--  -->