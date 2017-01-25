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


<!-- 
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
 <!- success message -->
 <?php $this->load->view("exam/success"); ?> 
 <!-- success message end -->
				<div class="panel panel-default" style="margin-top:20px;">
                    <form action="index.php/xmReport/meritList" method="post" class="form-inline">
                            <table class="table" id="seatPlanP">
                               <?php
                                    $exm=$this->db->select("*")->from("mark_add")->group_by("exmid")->get()->result();
                               ?>
                                <tr>
                                    <td>Examination Name :</td>
                                    <td>
                                        <select name="mexam" id="mexam" class="form-control" required style="min-width:200px;">
                                            <option value="">Select Exam Name</option>
                                            <?php
                                            	foreach($exm as $e):
                                            		$xmNm=$this->db->query("SELECT * FROM exm_namectg WHERE exmnid=(SELECT exmnid FROM exm_catg WHERE exm_ctgid=$e->exmid)")->row();
                                            ?>
                                                    <option value="<?php echo $e->exmid ?>"><?php echo $xmNm->exm_name." - ".$e->exmyear; ?></option>
                                            <?php
                                                endforeach;
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Class : </td>
                                    <td>

                                    <?php
                                        $cls=$this->db->select("*")->from("class_catg")->get()->result();
                                    ?>

                                        <select name="mclass" id="mcls" class="form-control" required style="min-width:200px;" onchange="getClsSection(this.value)">
                                            <option value="">Select Class</option>
                                            <?php
                                                foreach($cls as $c){
                                                    echo "<option value='$c->classid'>$c->class_name</option>";
                                                }
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
                                		<select name="msht" id="msht" required class="form-control" style="min-width:200px;">
                                			<option value="">Select</option>
                                		<?php foreach($sf as $s): ?>
                                			<option value="<?php echo $s->shiftid ?>"><?php echo $s->shift_N; ?></option>
                                		<?php endforeach; ?>
                                		</select>
                                	</td>
                                </tr>

                                <tr>
                                    <td>Section :</td>
                                    <td>
                                        <select name="section" id="sect" class="form-control" style="min-width:200px;">
                                            <option value="">Select</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>
                                        <button type="submit" name="merit" class="btn btn-primary" style="float:left;margin-left:35px;">Show List</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                </div><!-- 
            </div>
        </div>
    </section> -->