<?php
    // first get teacher id
    $tid = $this->session->userdata("lidcheck");

    // shift
    $shift=$this->uri->segment(3);
    $sNm=$this->db->select("*")->from("shift_catg")->where("shiftid",$shift)->get()->row();
    // initialize
    $d=date("Y");
    $day=date("D")."day";
    // time function
    function chngTime($tm){
        $expTm=explode(":",$tm);
        if($expTm[0]>=12):
            $ampm=" PM";
        else:
            $ampm=" AM";
        endif;
        return $gtm=$expTm[0].":".$expTm[1].$ampm;
    }

// week all days name array
    $week=array("Saturday","Sunday","Monday","Tuesday","Wednesday","Thursday","Friday");

?>


<aside class="right-side">      <!---rightbar start here -->
<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Teacher Class Routine
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
<!-- Main content -->
    <section class="content">
    <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-11">
                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: center !important;"><b><?php echo ucfirst(strtolower($sNm->shift_N)) ?> Shift  <br/>  Class Routine</b></div>
                    <div class="panel-body">
                        <table class="table">
                            <tbody>

<?php
for($i=0;$i<count($week);$i++):
    // get saturday class routine
    $sat=array(
        "teacherid"=>$tid,
        "day"=>$week[$i],
        "shiftid"=>$shift,
        "year"=>$d
        );

    $satR=$this->db->select("*")->from("routine")->where($sat)->get()->result();
?>

                                <tr>
                                    <th style="width: 150px;" class="active"><?php echo $week[$i] ?></th>
                                    <td>
                                    <?php 
                                        foreach($satR as $s):
                                            // get class name
                                            $satC=$this->db->select("*")->from("class_catg")->where("classid",$s->classid)->get()->row();
                                            // get subject name
                                            $satSb=$this->db->select("*")->from("subject_class")->where("subjid",$s->subjid)->get()->row();
                                    ?>
                                        
                                        <button class="btn btn-default" style="background: #303641 !important;color:#ffffff;border-radius:5px;float:left;">Class - <?php echo $satC->class_name ?><br/>
                                        <?php echo $satSb->sub_name ?><br/>
                                        <?php echo chngTime($s->stime)." - ".chngTime($s->etime) ?>
                                        </button>

                                    <?php endforeach;endfor; ?>
                                    
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>    
            </div>
        </div>
    </section>
</aside>