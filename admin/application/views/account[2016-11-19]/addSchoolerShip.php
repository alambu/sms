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
        
		//receiveing form submit start

		function formSubmitFunc(frm)
		{
			document.getElementById('submitbtn').disabled = 'disabled';
			var formData = new FormData(frm);
			$.ajax({  
			 type: "POST",  
			 url: frm.action,  
			 data: formData,
			 async: true,
			 cache: false,
			 contentType: false,
			 processData: false,
			 beforeSend:function(){
				 document.getElementById("maincontentdiv").style.opacity = "0.5";
			 },
			 success: function(data) 
			 {
				
				document.getElementById("maincontentdiv").style.opacity = "1";
				if(data==1){
					alert("Data Save Successfully");
					location.reload();
				}
				else {
					alert(data);
				}
				document.getElementById("submitbtn").disabled = false;
			 }
			}); 
			
			return false;
		}
		
		function schoolerShipCatg(year,sft,cls,sec,roll){
			var url="index.php/account/schoolerShipCatg?cid="+cls+"&yearck="+year+"&sec="+sec+"&rol="+roll+"&sft="+sft;
			$("#showctg").load(url);
		}
		
		// get class section name
		function SingleClassSectionReceipt(cls){

			document.getElementById("SingleSectionsrepo").innerHTML="<option value=''>Select</option>";
				// document.getElementById("sub").innerHTML="<option value=''>Select</option>";
				//alert(cls);
				$.ajax({
					url:"index.php/account/changeClassSection",
					data:{clsid:cls},
					type:"POST",
					success:function(str){
						//alert(str);
						
						var secValue = str.split("+");
						
						var secName = secValue[0];
						var secId = secValue[1];

						var secNm = secName.split(",");  // section value split 
						var secD = secId.split(",");  // section value split 

						for(var i = 0;i < secNm.length;i++){
						document.getElementById("SingleSectionsrepo").innerHTML+="<option value='"+secD[i]+"'>"+secNm[i]+"</option>";
						}
					}
				});
			}

    </script>

<!-- <aside class="right-side">
	<section class="content-header">
        <h1>
            Indivisual Student Result
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
				<!-- <div class="panel panel-default"> -->

			<!-- <div class="panel-heading"><p id="title">Examination Name Entry</p></div> -->
		  	        <!-- <div class="panel-body"> -->
		    	        <form action="index.php/account_billgenerate/addSchoolerShip" method="post" class="form-inline" onsubmit="return formSubmitFunc(this);">
                            <table class="table">
                               <?php
                                    $exm=$this->db->select("*")->from("mark_add")->group_by("exmid")->get()->result();
                               ?>
                                <tr>
                                    <td>Year :</td>
                                    <td>
                                        <select name="year" id="indYear" class="form-control" required>
                                            <option value="">Select</option>
                                            <?php
                                                for($i = date("Y")+1;$i>= date("Y");$i--){
                                            ?>
                                            <option value="<?php echo $i; ?>" <?php if($i==date("Y")){echo "selected";} ?> ><?php echo $i; ?></option>
                                            <?php
                                                }
                                            ?>
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
                                    <td>Class : </td>
                                    <td>

                                    <?php
                                        $cls=$this->db->select("*")->from("class_catg")->get()->result();
                                    ?>

                                        <select name="class" id="indCls" onchange="SingleClassSectionReceipt(this.value)" class="form-control" required>
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
                                        <select name="section" id="SingleSectionsrepo" class="form-control" required>
                                            <option value="">Select</option>
                                        </select>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>Roll No :</td>
                                    <td>
                                        <input type="text" name="roll" id="roll" class="form-control" required style="width:180px;float:left;" placeholder="Enter Roll No" onkeypress="return isNumber(event)" />
                                    </td>
                                </tr>

                               
                                
                                
                            </table>
                            <table class="table">
								<tr>
									<td style="width:10%;"></td>
									<td style="width:16%;"></td>
								
									<td>
									<button type="button" onclick="schoolerShipCatg(indYear.value,indShift.value,indCls.value,SingleSectionsrepo.value,roll.value);" name="schoolerShip" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> Fee Category
									</button>
									</td>
									<td></td>
								</tr>
							</table>
							<div id="showctg">
							</div>
                </form>
                    <!-- </div> -->
                <!-- </div> 

            </div>

        </div>

    </section>
</aside> -->