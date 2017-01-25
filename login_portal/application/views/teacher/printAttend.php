<link href="<?php echo base_url() ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>css/AdminLTE.css" rel="stylesheet" type="text/css" />

<?php
    $tid=$this->session->userdata("lidcheck");  // employee id
    $tidName = $this->db->select("*")->from("empee")->where("empid",$tid)->get()->row();
    $schNm = $this->db->select("*")->from("sprofile")->limit(1)->get()->row();
    $month = array("January","February","March","Appril","May","June","July","August","September","October","November","December");
    $y = $this->uri->segment(3);
?>

<body onload="return window.print();window.close();">
    <!---rightbar start here -->

<style type="text/css">
	/*.content{margin-left:8% !important;}*/
</style>

<!-- Main content -->
    <section class="content">
    <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-11" style="margin-top:-10px;">


                <div class="alert alert-info" style="text-align: center;">
                    <h3><?php echo $schNm->schoolN ?></h3>
                    Teacher : <?php echo $tidName->name ?><br/>
                    Attendance Sheet - <?php echo $y; ?>
                </div>

                
                          <?php echo $month[$i] ?>
                          
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SI</th>
                                        <th>Month</th>
                                        <th>Total working day</th>
                                        <th>Present</th>
                                        <th>Absence</th>
                                        <th>satus</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                        
                        <?php $j = 1; for($i = 0;$i < count($month);$i++): ?>
                        <?php
	                        $sd = $y."-".$j."-01";
	                        $ed = $y."-".$j."-31";

	                        $tattend = $this->db->select("*")->from("emp_attendance")->where("atendate >=",$sd)->where("atendate <=",$ed)->get()->result();

	                        $wd = array();
	                        foreach($tattend as $td):
	                            $workday = explode(",",$td->empid);
	                            $wd = array_merge($wd,$workday);
	                        endforeach;
	                        $duplicate = array_count_values($wd);
                        
                    	?>

                                    <tr>
                                    	<td><?php echo $j ?></td>
                                    	<td><?php echo $month[$i] ?></td>
                                        <td><?php echo $twd = count($tattend); ?></td>
                                        <td><?php if($duplicate[$tid] <= 0):echo "0";else:echo $duplicate[$tid];endif;  ?></td>
                                        <td><?php echo count($tattend)-$duplicate[$tid]; ?></td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $persent = ceil(($duplicate[$tid]*100)/$twd) ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $persent ?>%">
                                                <b style="color:<?php if($persent > 0):echo "white";else:echo "#34495e";endif; ?> !important;"><?php echo $persent ?>%</b>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                        <?php $j++; endfor; ?>
                                </tbody>
                            </table>
                        </div>
                      </div>
    </section>
</body>