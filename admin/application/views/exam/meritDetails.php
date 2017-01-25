<?php
    
// getting data
$exm=$this->db->select("*")->from("mark_add")->group_by("exmid")->get()->result();
// shift
$sf=$this->db->select("*")->from("shift_catg")->get()->result();
// class
$clsHead=$this->db->select("*")->from("class_catg")->get()->result();

// getting data by submiting form
    if(isset($_POST['merit'])){
        extract($_POST);
        // data array
        $data=array(
            "exmid"    => $mexam,
            "classid"  => $mclass,
            "shift"    => $msht,
            "section"  => $section
            );
        $mrt=$this->db->select("*,sum(total_mark) as total")->from("mark_add")->where($data)->group_by("stu_id")->order_by("total","desc")->get()->result();

        // getting school name
        $scNm=$this->db->select("*")->from("sprofile")->order_by("id","desc")->limit(1)->get()->row();

        // exam name
        $xmN=$this->db->query("SELECT * FROM exm_namectg WHERE exmnid=(SELECT exmnid FROM exm_catg WHERE exm_ctgid=$mexam)")->row();

        // class name
        $cls=$this->db->select("*")->from("class_catg")->where("classid",$mclass)->get()->row();
    }
?>

<!-- all style -->
<style type="text/css">
    #searchHead tr th{border:none !important;text-align: center;}
    #searchHead tr td{border:none !important;}
</style>
<!-- all style end -->

<!-- all script -->
<script type="text/javascript">
    function getClsSection(str){
        $.ajax({
            url:"index.php/xmAllRequest/seatPlanSection",
            type:"POST",
            data:{clsid:str},
            success:function(data){
                if( data ){
                    document.getElementById("sect").innerHTML = '';
                    document.getElementById("sect").innerHTML = '<option value="">Select</option>';
                    var secData = data.split(",");

                    for(var i = 0; i < secData.length; i++ ){
                        document.getElementById("sect").innerHTML += '<option value="'+secData[i]+'">'+secData[i]+'</option>';
                    }
                }
            }
        });
    }
</script>
<!-- all script -->

<aside class="right-side">
	<section class="content-header">
        <h1>
            Student Merit List
            <small>Control panel</small>
        </h1>
            <ol class="breadcrumb">
            	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
    </section>

	<section>
		<div class="container-fluid">
			<div class="col-md-12">
            
            <div class="col-md-10">
                <form action="" method="post" class="form" role="form">
                    <table class="table" id="searchHead">
                        <thead>
                            <tr>
                                <th>Examination Name</th>
                                <th>Shift</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="mexam" id="mexam" class="form-control" required style="min-width:180px;">
                                            <option value="">Select</option>
                                            <?php
                                                foreach($exm as $e):
                                                    $xmNm=$this->db->query("SELECT * FROM exm_namectg WHERE exmnid=(SELECT exmnid FROM exm_catg WHERE exm_ctgid=$e->exmid)")->row();
                                            ?>
                                                    <option value="<?php echo $e->exmid ?>" <?php if(isset($_POST['merit'])){if($e->exmid==$mexam):echo "selected";endif;} ?>><?php echo $xmNm->exm_name." - ".$e->exmyear; ?></option>
                                            <?php
                                                endforeach;
                                            ?>
                                        </select>
                                </td>
                                <td>
                                    <select name="msht" id="msht" required class="form-control" style="min-width:180px;">
                                            <option value="">Select</option>
                                        <?php foreach($sf as $s): ?>
                                            <option value="<?php echo $s->shiftid ?>" <?php if(isset($_POST['merit'])){if($s->shiftid==$msht):echo "selected";endif;} ?>><?php echo $s->shift_N; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="mclass" id="mcls" class="form-control" required style="min-width:180px;" onchange="getClsSection(this.value)">
                                            <option value="">Select Class</option>
                                            <?php
                                                foreach($clsHead as $c){
                                            ?>
                                           <option value="<?php echo $c->classid ?>" <?php if(isset($_POST['merit'])){if($c->classid==$mclass):echo "selected";endif;} ?>><?php echo $c->class_name ?></option>
                                            <?php  
                                                }
                                            ?>
                                        </select>
                                </td>
        <?php
            if(isset($_POST['merit'])):
                $getClsSectionData = $this->db->select("*")->from("class_catg")->where("classid",$mclass)->get()->row();
            $dataExplode = explode(",", $getClsSectionData->section);
            endif;
        ?>
                                <td>
                                    <select name="section" id="sect" class="form-control" style="min-width:180px;">
                                        <option value="">Select</option>
                                        <?php if(isset($_POST['merit'])):for( $j = 0; $j < count($dataExplode); $j++ ): ?>
                                        <option value="<?php echo $dataExplode[$j]; ?>" <?php if( $dataExplode[$j] == $section ):echo "Selected";endif; ?>><?php echo $dataExplode[$j]; ?></option>
                                    <?php endfor;endif; ?>
                                    </select>
                                </td>
                                <td>
                                    <button type="submit" name="merit" class="btn btn-primary" style="float:left;margin-left:35px;"><span class="glyphicon glyphicon-search"></span> Search</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div> 
			
            	<div class="panel panel-info" style="margin-top:100px;">
                    <div class="panel-heading" style="text-align:center;"><?php echo $scNm->schoolN  ?><br/><?php echo $xmN->exm_name ?><br/>Class : <?php echo $cls->class_name ?> Section : <?php echo $section; ?></div>
                
                <div class="panel-body">
                    <form action="index.php/allSubmit/meritSub" method="post">
                    <table class="table" id="example1">
                        <thead>
                            <tr>
                                <th>SI</th>
                                <th>Name</th>
                                <th>Previous Roll</th>
                                <th>Mark</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $si=0; foreach($mrt as $m): $si++;
                            $stdNm=$this->db->select("name")->from("regis_tbl")->where("stu_id",$m->stu_id)->get()->row(); 
                        ?>
                            <tr>
                                <td>
                                    <?php echo $si ?>
                                    <input type="hidden" name="presentRoll[]" value="<?php echo $si ?>">
                                    <!-- others data -->
                                    <!-- exam -->
                                    <input type="hidden" name="xmid[]" value="<?php echo $m->exmid ?>">
                                    <!-- class -->
                                    <input type="hidden" name="clsid[]" value="<?php echo $m->classid ?>">
                                    <!-- section -->
                                    <input type="hidden" name="secId" value="<?php echo $section ?>">
                                    <!-- shift -->
                                    <input type="hidden" name="shft[]" value="<?php echo $m->shift ?>">
                                    <!-- exam year -->
                                    <input type="hidden" name="xmy[]" value="<?php echo $m->exmyear ?>">
                                    <!-- others data end -->
                                </td>
                                <td>
                                    <?php echo $stdNm->name ?>
                                    <input type="hidden" name="stuid[]" value="<?php echo $m->stu_id ?>">
                                </td>
                                <td>
                                    <?php echo $m->roll_no ?>
                                    <input type="hidden" name="pre_roll[]" value="<?php echo $m->roll_no ?>">
                                </td>
                                <td>
                                    <?php echo $m->total ?>
                                    <input type="hidden" name="total_mark[]" value="<?php echo $m->total ?>">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <table class="table">
                        <tr>
                            <td>
                                <a href="index.php/xmReport/meritListPanel">
                                <button type="button" class="btn btn-primary" style="position:relative;left:40%;width:130px;"><span class="glyphicon glyphicon-arrow-left"></span> Back</button>
                                </a>

                                <button type="submit" class="btn btn-success" name="publish" style="margin:15px;left:40%;position:relative;width:150px;font-weight:bold;">Publish</button>
                            </td>
                        </tr>
                    </table>
                </form>
                </div>
            </div>
            </div>
        </div>
    </section>
</aside>