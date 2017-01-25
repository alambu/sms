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

input:invalid{
    color:red;
}
form table select{float:left;min-width: 180px;}

form table button{float: left;}
</style>

<script type="text/javascript">
        function OthClassSection(cls){
            document.getElementById("OthSection").innerHTML="<option value=''>Select</option>";
            document.getElementById("OthSub").innerHTML="<option value=''>Select</option>";
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
                    document.getElementById("OthSection").innerHTML+="<option value='"+sec[i]+"'>"+sec[i]+"</option>";
                    }

                    for(var j=0;j<subject.length-1;j++){
                        document.getElementById("OthSub").innerHTML+="<option value='"+subid[j]+"'>"+subject[j]+"</option>";   
                    }
                }
            });
        }

// this is for datepicker
$(document).ready(function () {                
    $('#OthXmDate').datepicker({format: "yyyy-mm-dd"});            
});

// this is for check date
// check valid exam date
function chkD(str){
    // split date
    var getD=str.split("-");

    // this is for today
    var today=new Date();
    var dd=today.getDate();
    var mm=today.getMonth()+1;
    var yy=today.getFullYear();
    
    // alert(dd);
    // alert(mm);
    // alert(yy);

if(parseInt(getD[0])<parseInt(yy)){ 
    alert("You can't select previous date");
$("#OthXmDate").val('').datepicker('update');
        // return 0;
    }
else if(parseInt(getD[0])==parseInt(yy) && parseInt(getD[1])<parseInt(mm)){
    alert("You can't select previous date");
$("#OthXmDate").val('').datepicker('update');
}

else if(parseInt(getD[0])==parseInt(yy) && parseInt(getD[1])==parseInt(mm) && parseInt(getD[2])<parseInt(dd)){
    alert("You can't select previous date");
$("#OthXmDate").val('').datepicker('update');
}

}

</script>
<!--  for date picker -->

<!-- <aside class="right-side">
	<section class="content-header">
        <h1>
            Other Exam Mark Entry
            <small>Control panel</small>
        </h1>
            <ol class="breadcrumb">
            	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
    </section>

	<section>
		<div class="container-fluid"> 
			<div class="col-md-12">-->
            <?php $this->load->view("exam/success"); ?>
				<div class="panel panel-default" style="margin-top:20px;">

			<!-- <div class="panel-heading"><p id="title">Examination Name Entry</p></div> -->
		  	        <div class="panel-body">
		    	        <form action="index.php/exam/otherXmStd" method="post" class="form-inline">
                            <table class="table">
                               <?php
                                    $y = date("Y");
                                    $exm=$this->db->select("*")->from("exm_othercatg")->where("xm_year",$y)->get()->result();
                               ?>
                                <tr>
                                    <td>Examination Name :</td>
                                    <td>
                                        <select name="OthExam" id="OthExam" class="form-control" required >
                                            <option value="">Select OthExam Name</option>
                                            <?php
                                                foreach($exm as $e){
                                                    echo "<option value='$e->othexmid'>$e->exm_name</option>";
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

                                        <select name="class" id="OthCls" onchange="OthClassSection(this.value)" class="form-control" required>
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
                                        <select name="section" id="OthSection" class="form-control" required>
                                            <option value="">Select</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Shift :</td>
                                    <td>
                                        <select name="shft" class="form-control">
                                            <option value="">Select</option>
                                            <?php
                                                $sft=$this->db->select("*")->from("shift_catg")->get()->result();
                                                foreach($sft as $st){
                                            ?>
                                            <option value="<?php echo $st->shiftid; ?>"><?php echo $st->shift_N; ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Subject</td>
                                    <td>
                                        <select name="sub" id="OthSub" class="form-control" required>
                                            <option value="">Select</option>
                                        </select>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>
                                        OthExam Date :
                                    </td>        
                                    <td>
                                        <input type="text" id="OthXmDate" name="exm_date" class="form-control" required style="width: 180px !important;float:left;" placeholder="<?php echo date("Y-m-d") ?>" />
                                    </td>        
                                </tr>

                                <tr>
                                    <td>
                                        OthExam Mark :
                                    </td>        
                                    <td>
                                        <input type="text" id="xmMark" name="xmMark" class="form-control" required style="width: 180px !important;float:left;" placeholder="Exam Mark" pattern="[0-9]{1,3}" />
                                    </td>        
                                </tr>
                            
                            </table>
                            <table class="table">
                        <tr>
                        <td style="width:22%;"></td>
                        <td style="width:18%;"></td>
                        
                            <td>
                                <button type="submit" name="OthstdList" class="btn btn-primary" >
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
</aside>
 -->