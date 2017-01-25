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
        function indclassSection(cls){
            document.getElementById("indSection").innerHTML="<option value=''>Select</option>";
            // document.getElementById("sub").innerHTML="<option value=''>Select</option>";
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
                    document.getElementById("indSection").innerHTML+="<option value='"+sec[i]+"'>"+sec[i]+"</option>";
                    }

                    // for(var j=0;j<subject.length-1;j++){
                    //     document.getElementById("sub").innerHTML+="<option value='"+subid[j]+"'>"+subject[j]+"</option>";   
                    // }
                }
            });
        }

    </script>

<aside class="right-side">
	<section class="content-header">
        <h1>
            Indivisual Student Marksheet
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
				<div class="panel panel-default" style="margin-top:20px;">

			<!-- <div class="panel-heading"><p id="title">Examination Name Entry</p></div> -->
		  	        <div class="panel-body">
		    	        <form action="index.php/xmReport/marksheet_single" method="post" class="form-inline" target="_blank">
                            <table class="table">
                                <tr>
                                    <td>Class : </td>
                                    <td>

                                    <?php
                                        $cls=$this->db->select("*")->from("class_catg")->get()->result();
                                    ?>

                                        <select name="class" id="indCls" onchange="indclassSection(this.value)" class="form-control" required>
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
                                        <select name="section" id="indSection" class="form-control" required>
                                            <option value="">Select</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Shift :</td>
                                    <td>
                                        <select name="shift" id="indShift" class="form-control" required>
                                            <option value="">Select</option>
                                            <?php 
                                                $sft=$this->db->select("*")->from("shift_catg")->get()->result();
                                                foreach($sft as $st){
                                            ?>
                                            <option value="<?php echo $st->shiftid ?>"><?php echo $st->shift_N ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Roll No :</td>
                                    <td>
                                        <input type="text" name="roll" id="roll" class="form-control" required style="width:180px;float:left;" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Year :</td>
                                    <td>
                                        <select name="year" id="indYear" class="form-control" required>
                                            <option value="">Select</option>
                                            <?php
                                                for($i=date("Y");$i>=2010;$i--){
                                            ?>
                                            <option value="<?php echo $i; ?>" <?php if($i==date("Y")){echo "selected";} ?> ><?php echo $i; ?></option>
                                            <?php
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <table class="table">
                        <tr>
                        <td style="width:22%;"></td>
                        <td style="width:20%;"></td>
                        
                            <td>
                                <button type="submit" name="marksheet" class="btn btn-primary" >
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
                </div> 

            </div>

        </div>

    </section>
</aside> 