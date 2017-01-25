<title>Examination Result</title>
<style type="text/css">
    table td,th {
    border-top: none !important;
}
table tr th{
    text-align: right;
}
table tr td{
    text-align: right;
}

form table select{float:left;min-width: 180px;}

form table button{float: left;}
</style>

<script type="text/javascript">
        function classSection(cls){
            $.ajax({
		url: "index.php/home/changeCls",
		type: 'POST',	
		data:{cls_id:cls},	
		success: function(data)
		{	
			if(data.length!=0){
			var data1=data.split("#");	
			var d=data1[0].split(",");
			var d1=data1[1].split(",");
			var sec="Select Section";
			document.getElementById("section").innerHTML='';
			document.getElementById("section").innerHTML="<option value=''>"+sec+"</option>";
			
			for(var i=0;i<d.length;i++){
				
				document.getElementById("section").innerHTML+="<option value='"+d1[i]+"'>"+d[i]+"</option>";
			}
			}
			else {
				document.getElementById("section").innerHTML='';
				document.getElementById("section").innerHTML="<option value=''>Section Select</option>";
			}
		}
		
		});
        }
        
        
        
        function selected_class(sftid) {
	$.ajax({
	url: "index.php/home/selected_class",
	type: 'POST',	
	data:{sft_id:sftid},	
	success: function(data)
	{
		if(data!='#') {
		var data1=data.split("#");	
		var d=data1[0].split(",");
		var d1=data1[1].split(",");
		var sec="Select Class";
		document.getElementById("cls").innerHTML='';
		document.getElementById("cls").innerHTML="<option value=''>"+sec+"</option>";
		
		for(var i=0;i<d.length;i++){
			
			document.getElementById("cls").innerHTML+="<option value='"+d1[i]+"'>"+d[i]+"</option>";
		}
		
		}
		
		else {
			document.getElementById("cls").innerHTML='';
			document.getElementById("cls").innerHTML="<option value=''>Select Class</option>";
		}
	
	}
	
	});
}





    </script>
    <div class="main_con"><!--Content Start-->
    <div class="row">
        <div class="col-md-9 left_con"><!-- left Content Start--><div class="row">
            <div class="col-md-12"><!-- Welcome Massage Start-->
                <div class="panel panel-primary">
                    <div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;">Academic Examination Result</div>
                    <div class="panel-body" style="min-height:750px;">
                        <div style="border:1px solid grey;">
                        <form action="index.php/home/indStdR" method="post" class="form-inline">
                            <table class="table">
                               <?php
                                    $exm=$this->db->select("*")->from("mark_add")->group_by("exmid")->get()->result();
                               ?>
                                <tr>
                                    <th>Examination Name :</th>
                                    <td>
                                        <select name="exam" id="exam" class="form-control" required title="Invalid" >
                                            <option value="">Select Exam Name</option>
                                            <?php
                                                foreach($exm as $e){
                                                    $xmName=$this->db->query("SELECT * from exm_namectg where exmnid=(SELECT exmnid FROM exm_catg where exm_ctgid=$e->exmid)")->row();

                                                    echo "<option value='$e->exmid'>$xmName->exm_name</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                 <?php
                                        $shift=$this->db->select("*")->from("shift_catg")->get()->result();
                                    ?>
                                 <tr>
                                    <th>Shift: </th>
                                    <td>


                                        <select name="sft" id="sft" onchange="selected_class(this.value)" class="form-control" required>
                                            <option value="">Select Class</option>
                                            <?php foreach($shift as $value) { ?>
                                            <option value="<?php echo $value->shiftid; ?>"><?php echo $value->shift_N; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th>Class : </th>
                                    <td>

                                        <select name="class" id="cls" onchange="classSection(this.value)" class="form-control" required>
                                            <option value="">Select Class</option>
                                            
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Section :</th>
                                    <td>
                                        <select name="section" id="section" class="form-control" required>
                                            <option value="">Select</option>
                                        </select>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th>Roll No :</th>
                                    <td>
                                        <input type="text" name="roll" id="roll" class="form-control" required style="width:180px;float:left;" />
                                    </td>
                                </tr>
                                <tr>
                                    <th>Year :</th>
                                    <td>
                                        <select name="year" id="year" class="form-control" required>
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
                        <td style="width:40%;"></td>
                        
                            <td>
                                <button type="submit" name="stdReslt" class="btn btn-primary" >
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
        </div>
    </div>