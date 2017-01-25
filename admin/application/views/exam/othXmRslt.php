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
        function classSection(cls){
            document.getElementById("othSection").innerHTML="<option value=''>Select</option>";
            document.getElementById("othSub").innerHTML="<option value=''>Select</option>";
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
                    document.getElementById("othSection").innerHTML+="<option value='"+sec[i]+"'>"+sec[i]+"</option>";
                    }

                    for(var j=0;j<subject.length-1;j++){
                        document.getElementById("othSub").innerHTML+="<option value='"+subid[j]+"'>"+subject[j]+"</option>";   
                    }
                }
            });
        }



// for date picker 

// $(document).ready(function () {                
//     $('#othXmDate').datepicker({format: "yyyy-mm-dd"});            
// });


function othXmDateGet(sValue){
    var xm=document.getElementById("othXm").value;
    var cls=document.getElementById("othCls").value;
    var section=document.getElementById("othSection").value;
    var shft=document.getElementById("othShft").value;
    var sub=document.getElementById("othSub").value;

    var dataArray=xm+"+"+cls+"+"+section+"+"+shft+"+"+sub;
    // alert(dataArray);
    // ajax request
    $.ajax({
        url:"index.php/xmAllRequest/xmDateSearch",
        type:"POST",
        data:{d:dataArray},
        success:function(xmD){
            // alert(xmD);
            var xmOpt=xmD.split(",");
            
            document.getElementById("othXmDate").innerHTML='';
            document.getElementById("othXmDate").innerHTML="<option value=''>Select</option>";

            for(var i=1;i<xmOpt.length;i++){
                document.getElementById("othXmDate").innerHTML+='<option value="'+xmOpt[i]+'" >'+xmOpt[i]+'</option>';
            }
        }
    });
}

</script>
<!--  for date picker -->

<!-- <aside class="right-side">
	<section class="content-header">
        <h1>
            Other Exam Result
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
		    	        <form action="index.php/xmReport/othXmStdRslt" method="post" class="form-inline">
                            <table class="table">
                               <?php
                                    $exm=$this->db->select("*")->from("exm_othercatg")->get()->result();
                               ?>
                                <tr>
                                    <td>Examination Name :</td>
                                    <td>
                                        <select name="exam" id="othXm" class="form-control" required >
                                            <option value="">Select Exam Name</option>
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

                                        <select name="class" id="othCls" onchange="classSection(this.value)" class="form-control" required>
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
                                        <select name="section" id="othSection" class="form-control" required>
                                            <option value="">Select</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Shift :</td>
                                    <td>
                                        <select name="shft" id="othShft" class="form-control">
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
                                        <select name="sub" id="othSub" class="form-control" required onchange="othXmDateGet(this.value)">
                                            <option value="">Select</option>
                                        </select>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>
                                        Exam Date :
                                    </td>        
                                    <td>
                                        <select name="exm_date" id="othXmDate" class="form-control" required >
                                            <option value="">Select</option>
                                        </select>
                                    </td>        
                                </tr>
                            
                            </table>
                            <table class="table">
                        <tr>
                        <td style="width:22%;"></td>
                        <td style="width:20%;"></td>
                        
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
</aside>
 -->