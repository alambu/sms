<style type="text/css">
    #pDisDiaLg tr td{
        text-align: right;
        border:none !important;
    }
     select{float: left;text-align: left;}
</style>

<script type="text/javascript">
    
    //  onchange class select section
    function SectionClass(cls){
        $.ajax({
            url:"index.php/xmAllRequest/classChng",
            type:"POST",
            data:{clsid:cls,rd:1},
            success:function(data){
                var d=data.split("+");
                var dSec=d[0];
                var secExt=dSec.split(",");

                document.getElementById("sec1").innerHTML="";
                document.getElementById("sec1").innerHTML="<option value=''>Select</option>";

                for(var i=0;i<secExt.length;i++){
                    document.getElementById("sec1").innerHTML+="<option value='"+secExt[i]+"'>"+secExt[i]+"</option>";
                }

            }
        });
    }

</script>

<!-- <aside class="right-side">
	<section class="content-header">
        <h1>
            Paper Distribute Dialouge
            <small>Control panel</small>
        </h1>
            <ol class="breadcrumb">
            	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
    </section>

	<section>
		<div class="container-fluid">
			<div class="col-md-12"> -->
				<div class="panel panel-default" style="margin-top:20px;">
                    <form action="index.php/xmReport/disPaRep" method="post" class="form-inline">
                            <table class="table" id="pDisDiaLg">
                               <?php
                                    $xmNid = $this->db->select("GROUP_CONCAT(exmnid) as cat")->from("exm_namectg")->get()->row();

                                    $xmNid = str_replace("'", "", $xmNid);
                                    
                                    $exm = $this->db->select("*")->from("exm_catg")->where_in("exmnid",$xmNid->cat)->get()->result();
                               ?>
                                <tr>
                                    <td>Examination Name :</td>
                                    <td>
                                        <select name="exam" id="exam" class="form-control" required style="min-width:200px;">
                                            <option value="">Select Exam Name</option>
                                            <?php
                                                foreach($exm as $rows):
                                                    // $xmID=$rows['exmnid'];
                                                    $xmNmCtg = $this->db->select("*")->from("exm_namectg")->where("exmnid",$rows->exmnid)->get()->row();
                                                    // $nm=mysql_fetch_array($xmNmCtg);
                                                    // $xmName=$this->db->select("*")->from("exm_namectg")->where("exmnid",$xmID)->get()->row();

                                                    // echo '<option value="$rows[\'exmnid\']">$xmName->exm_name</option>';
                                                    ?>
                                                    <option value="<?php echo $rows->exm_ctgid; ?>"><?php echo $xmNmCtg->exm_name.' - '.$rows->year; ?></option>
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

                                        <select name="class" id="cls" onchange="SectionClass(this.value)" class="form-control" required style="min-width:200px;">
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
                                        <select name="sec"  id="sec1" class="form-control" required style="min-width:200px;" >
                                            <option value="">Select</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <button type="submit" name="go" class="btn btn-primary" style="float:left;margin-left:35px;">View Report</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                </div><!-- 
            </div>
        </div>
    </section> -->