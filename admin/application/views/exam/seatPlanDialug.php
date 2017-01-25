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
    function classSectionP(str){
        $.ajax({
            type:"POST",
            url:"index.php/xmAllRequest/seatPlanSection",
            data:{clsid:str},
            success:function(data){
                if(data){
                    document.getElementById("secP").innerHTML='';
                    document.getElementById("secP").innerHTML='<option value="">Select</option>';
                    var dArray=data.split(",");
                    // put option getting data
                    for(var i=0;i<dArray.length;i++){
                        document.getElementById("secP").innerHTML+='<option value="'+dArray[i]+'">'+dArray[i]+'</option>';
                    }

                }
            }
        });
    }

    // get room list
    function getRoomLst(x,s,c,se){
        var mkData=x+"+"+s+"+"+c+"+"+se;
        $.ajax({
            type:"POST",
            url:"index.php/xmAllRequest/getRmLst",
            data:{d:mkData},
            success:function(data){
                
                if(data){
                    document.getElementById("rmPr").innerHTML='';
                    document.getElementById("rmPr").innerHTML='<option value="">Select</option>';
                    // split data
                    var otData=data.split("+");
                    var rid=otData[0];  // room id
                    var rnum=otData[1];  // room number
                    var rnam=otData[2];  // room name
                    // explore these data
                    var rd=rid.split(",");
                    var rno=rnum.split(",");
                    var rnm=rnam.split(",");

                    // put option to destination
                    for(var j=0;j<rd.length-1;j++){
                        document.getElementById("rmPr").innerHTML+='<option value="'+rd[j]+'">'+rnm[j]+' ('+rno[j]+') '+'</option>';
                    }

                }
            }
        });
    }


</script>

<?php
    // xm name
    $exmp=$this->db->select("*")->from("exm_catg")->get()->result();
    // get shift name
    $shp=$this->db->get("shift_catg")->result();
?>

<!-- <aside class="right-side">
	<section class="content-header">
        <h1>
            Exam Seat Plan
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
                    <form action="index.php/xmReport/seatPlanPrint" method="post" class="form-inline">
                            <table class="table" id="seatPlanP">
                               
                                <tr>
                                    <td>Examination Name :</td>
                                    <td>
                                        <select class="form-control" name="xm" id="xm" required style="min-width:200px;">
                                            <option value="">Select</option>
                                            <?php foreach($exmp as $xp): 
                                                $nmp=$this->db->select("*")->from("exm_namectg")->where("exmnid",$xp->exmnid)->get()->row();
                                            ?>
                                            <option value="<?php echo $xp->exm_ctgid ?>"><?php echo $nmp->exm_name."-".$xp->year ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                </td>
                                </tr>
                                
                                <tr>
                                    <td>Shift : </td>
                                    <td>
                                        <select class="form-control" name="shtp" id="shtp" style="width:200px;">
                                            <option value="">Select</option>
                                            <?php foreach($shp as $sp): ?>
                                                <option value="<?php echo $sp->shiftid ?>"><?php echo $sp->shift_N ?></option>
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

                                        <select name="class" id="cls" onchange="classSectionP(this.value)" class="form-control" required style="min-width:200px;">
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
                                    <td>Section : </td>
                                    <td>
                                        <select class="form-control" name="secP" id="secP" style="width:200px;" onchange="getRoomLst(xm.value,shtp.value,cls.value,this.value)">
                                            <option value="">Select</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Room : </td>
                                    <td>
                                        <select class="form-control" name="rmPr" id="rmPr" style="width:200px;">
                                            <option value="">Select</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>
                                        <button type="submit" name="go" class="btn btn-primary" style="float:left;margin-left:35px;">Show Seat Plan</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                </div><!-- 
            </div>
        </div>
    </section> -->