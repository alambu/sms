<style type="text/css">
    #seatPlanP tr td{
        text-align: right;
        border:none !important;
    }
   
    #seatPlanP tr{background: none !important;}
    #seatPlanP{margin-top: 20px;}
     
     select{float: left;text-align: left;}
    
</style>

<script type="text/javascript">
    function othSecData(str){
        $.ajax({
            type:"POST",
            url:"index.php/xmAllRequest/seatPlanSection",
            data:{clsid:str},
            success:function(data){
                if(data){
                    document.getElementById("OthSec").innerHTML='';
                    document.getElementById("OthSec").innerHTML='<option vlaue="">Select</option>';
                    var dd=data.split(",");
                    for(var i=0;i<dd.length;i++){
                        document.getElementById("OthSec").innerHTML+='<option value="'+dd[i]+'">'+dd[i]+'</option>';
                    }
                }
            }
        });
    }
</script>

<!-- <aside class="right-side">
	<section class="content-header">
        <h1>
            Other Exam Merit List
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
 <!- success message -->
 <?php $this->load->view("exam/success"); ?> 
 <!-- success message end -->
				<div class="panel panel-default" style="margin-top:20px;">
                    <form action="index.php/xmReport/othMrtLst" method="post" class="form-inline">
                            <table class="table" id="seatPlanP">
                               <?php
                                    $exm=$this->db->select("*")->from("exm_markother")->group_by("exm_date")->get()->result();
                               ?>
                                <tr>
                                    <td>Examination Name :</td>
                                    <td>
                                        <select name="oexam" id="oexam" class="form-control" required style="min-width:200px;">
                                            <option value="">Select Exam Name</option>
                                            <?php
                                            	foreach($exm as $e):
                                            		$xmNm=$this->db->select("*")->from("exm_othercatg")->where("othexmid",$e->othexmid)->get()->row();
                                            ?>
                                                    <option value="<?php echo $e->exm_date ?>"><?php echo $xmNm->exm_name." (".$e->exm_date." )"; ?></option>
                                            <?php
                                                endforeach;
                                            ?>
                                        </select>
                                    </td>
                                </tr>

                                <!-- get shift id -->
                                <?php
                                    $sf=$this->db->select("*")->from("shift_catg")->get()->result();
                                ?>
                                <!-- shift id end -->
                                <tr>
                                    <td>Shift : </td>
                                    <td>
                                        <select name="osht" id="osht" required class="form-control" style="min-width:200px;">
                                            <option value="">Select</option>
                                        <?php foreach($sf as $s): ?>
                                            <option value="<?php echo $s->shiftid ?>"><?php echo $s->shift_N; ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Class : </td>
                                    <td>

                                    <?php
                                        $cls=$this->db->select("*")->from("class_catg")->get()->result();
                                    ?>

                                        <select name="oclass" id="ocls" class="form-control" required style="min-width:200px;" onchange="othSecData(this.value)">
                                            <option value="">Select Class</option>
                                            <?php
                                                foreach($cls as $c){
                                                    echo "<option value='$c->classid'>$c->class_name</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>Section :</td>
                                    <td>
                                        <select class="form-control" name="othSec" id="OthSec" style="min-width:200px;">
                                            <option value="">Select</option>

                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>
                                        <button type="submit" name="othmerit" class="btn btn-primary" style="float:left;margin-left:35px;">Show List</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                </div><!-- 
            </div>
        </div>
    </section> -->