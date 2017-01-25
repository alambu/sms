<style type="text/css">
    table td {
    border-top: none !important;
}
table tr th{
    text-align: center;
}
table tr td{
    text-align: right;
}

form table select{float:left;min-width: 180px;}

form table button{float: left;}
</style>

<script type="text/javascript">
        function markClsSec(cls){
            document.getElementById("markSec").innerHTML="<option value=''>Select</option>";
            document.getElementById("sub").innerHTML="<option value=''>Select</option>";
            $.ajax({
                url:"index.php/exam/classSection",
                data:{clsid:cls},
                type:"POST",
                success:function(str){
                    // alert(str);
                    var data=str.split("+");  // split data into two peices section and subject
                    var s=data[0];  // section value
                    var sb=data[1]; // subject value
                    var sid=data[2]; // subject value

                    var sec=s.split(",");       // section value split into an array
                    var subject=sb.split(",");  // subject value split into an array
                    var subid=sid.split(",");

                    for(var i=0;i<sec.length;i++){
                    document.getElementById("markSec").innerHTML+="<option value='"+sec[i]+"'>"+sec[i]+"</option>";
                    }

                    for(var j=0;j<subject.length-1;j++){
                        document.getElementById("sub").innerHTML+="<option value='"+subid[j]+"'>"+subject[j]+"</option>";   
                    }
                }
            });
        }

    </script>

<!-- <aside class="right-side">
	<section class="content-header">
        <h1>
            Mark Entry
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

			<!-- <div class="panel-heading"><p id="title">Examination Name Entry</p></div> -->
		  	        <div class="panel-body">
		    	        <form action="index.php/exam/stdListMarkEntry" method="post" class="form-inline">
                            <table class="table">
                               <?php
                                    $exm=$this->db->select("*")->from("exm_catg")->where("status",'1')->get()->result();
                               ?>
                                <tr>
                                    <td>Examination Name :</td>
                                    <td>
                                        <select name="exam" id="exam" class="form-control" required >
                                            <option value="">Select Exam Name</option>
                                            <?php
                                                foreach($exm as $e){
                                                    $xmName=$this->db->select("*")->from("exm_namectg")->where("exmnid",$e->exmnid)->get()->row();

                                                    echo "<option value='$e->exm_ctgid'>$xmName->exm_name</option>";
                                                }
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

                                        <select name="class" id="cls" onchange="markClsSec(this.value)" class="form-control" required>
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
                                        <select name="section" id="markSec" class="form-control" required>
                                            <option value="">Select</option>
                                        </select>
                                    </td>
                                </tr>
                            
                            <?php 
                                $shiftid = $this->mkst->get_shift();
                            ?>
                               
                                <tr>
                                    <td>Shift :</td>
                                    <td>
                                        <select name="shift" id="shift" class="form-control" required>
                                            <option value="">Select</option>
                                        <?php foreach($shiftid as $shftd): ?>
                                            <option value="<?php echo $shftd->shiftid; ?>"><?php echo $shftd->shift_N; ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Subject</td>
                                    <td>
                                        <select name="sub" id="sub" class="form-control" required>
                                            <option value="">Select</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                    <table class="table">
                        <tr>
                        <td style="width:25%;"></td>
                        <td style="width:17%;"></td>
                        
                            <td>
                                <button type="submit" name="stdList" class="btn btn-primary" >
                                    <span class="glyphicon glyphicon-send" aria-hidden="true"> Submit
                                    </span>
                                </button>
                                <button type="reset" name="ok" class="btn btn-warning" onclick="resetAll()" style="margin-left:2%;" >
                                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"> Reset
                                    </span>
                                </button>
                            </td>
                            <td></td>
                        </tr>
                    </table>
                        </form>
                    </div>
                </div><!-- 

            </div>

        </div>

    </section>
</aside> -->