<script type="text/javascript">
// get class by shift id for report
function getClassReceipt( shift ){
    $.ajax({
        url:"account_billgenerate/getClass",
        type:"POST",
        data:{shf:shift},
        success:function( data ){
            var cls = data.split("+");
            if((cls[0].length > 0) && (cls[1].length > 0)){
                var className = cls[0].split(",");
                var classId = cls[1].split(",");

                // reset class
                document.getElementById("classnamerepo").innerHTML = '';
                document.getElementById("classnamerepo").innerHTML = '<option value="">Select</option>';

                // reset section
                document.getElementById("sectionsrepo").innerHTML = '';
                document.getElementById("sectionsrepo").innerHTML = '<option value="">Select</option>';             

                // set new class
                for(var j = 0;j < className.length;j++){
                    document.getElementById("classnamerepo").innerHTML += '<option value="'+classId[j]+'">'+className[j]+'</option>';
                }

            }else{
                // reset class
                document.getElementById("classnamerepo").innerHTML = '';
                document.getElementById("classnamerepo").innerHTML = '<option value="">Select</option>';
                
                // reset section
                document.getElementById("sectionsrepo").innerHTML = '';
                document.getElementById("sectionsrepo").innerHTML = '<option value="">Select</option>';
            }
        }
    });
}


// get class section name
function ClassSectionReceipt(cls){
    document.getElementById("sectionsrepo").innerHTML="<option value=''>Select</option>";
        // document.getElementById("sub").innerHTML="<option value=''>Select</option>";
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
                document.getElementById("sectionsrepo").innerHTML+="<option value='"+secD[i]+"'>"+secNm[i]+"</option>";
                }
            }
        });
    }

</script>

<aside class="right-side">
    <section class="content-header">
        <h1>Advanced Payment Report <small> Control panel</small></h1>
        
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Advanced Payment Report</li>
        </ol>
    </section>

    <section>
        <div class="container-fluid">



            <div class="col-md-12">
                <div class="panel panel-default" style="margin-top:20px;">

<?php
    if(isset($_POST['ReportSearch'])):
        extract($_POST);
    endif;
?>

<form action="" method="post" class="form-horizontal" >
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                
                <!-- start searching option -->

                <div class="col-sm-1"></div>
                <div class="col-sm-2">
                    <label class="control-label">Shift:</label>         
                    <select class="form-control" name="shiftid" id="shiftidrepo" required onchange="getClassReceipt(this.value)">
                        <option value="">Select</option>
                    <?php 
                        $sqlaccs=$this->db->select('*')->from('shift_catg')->get()->result();                                       
                        foreach($sqlaccs as $accidshows){
                    ?>
                        <option value="<?php echo $accidshows->shiftid ?>" <?php if(isset($shiftid)):if($shiftid == $accidshows->shiftid):echo "Selected";endif;endif; ?> ><?php echo $accidshows->shift_N?></option>
                    
                    <?php }?>
                    
                    </select>
                </div>

                
                <div class="col-sm-2">
                    <label class="control-label" >Class Name:</label>          
                    <select class="form-control" name="classname" id="classnamerepo" onchange="ClassSectionReceipt(this.value);">
                        <option value="">Select</option>
                    <?php
                        if(isset($shiftid)):
                            $shiftData = array( "shiftid" => $shiftid );
                            $getClass = $this->db->get_where("class_catg",$shiftData)->result();
                            foreach($getClass as $gc):
                    ?>
                        <option value="<?php echo $gc->classid ?>" <?php if(isset($classname)):if($classname == $gc->classid):echo "selected";endif;endif; ?> ><?php echo $gc->class_name ?></option>
                    <?php
                        endforeach;
                        endif;
                    ?>
                    </select>
                </div>

                
                
                <div class="col-sm-2">
                    <label class="control-label" >Section:</label>          
                    <select class="form-control" name="sections" id="sectionsrepo" >
                        <option value="">Select</option>
                    <?php
                        if(isset($classname)):
                            $secData = array( "classid" => $classname );
                            $getSection = $this->db->order_by("section_name","ASC")->get_where("section_tbl",$secData)->result();
                            foreach( $getSection as $gs ):
                    ?>
                        <option value="<?php echo $gs->sectionid ?>" <?php if(isset($sections)):if($sections == $gs->sectionid):echo "selected";endif;endif; ?> ><?php echo $gs->section_name ?></option>
                    <?php
                        endforeach;
                        endif;
                    ?>
                    </select>
                </div>

                
                  
                  <div class="col-sm-1">
                    <label class="control-label">Roll No:</label>        
                    <input type="text" name="stuclroll"  class="form-control" id="rollidrepo" placeholder="Roll No" value="<?php if(isset($stuclroll)):echo $stuclroll;endif; ?>" onkeypress="return isNumber(event)" />
                  </div>

                  <div class="col-sm-2">
                    <label class="control-label">Year:</label>        
                    <select name="advYear"  class="form-control" id="advYear" >
                    <option value="">Select</option>
                    <?php for($i = date("Y")+1;$i >= 2015;$i--): ?>
                        <option value="<?php echo $i ?>" <?php if(isset($advYear)):if($advYear == $i):echo "selected";endif;endif; ?> ><?php echo $i ?></option>
                    <?php endfor; ?>
                    </select>
                  </div>

                  <br/>
                  <div class="col-sm-2" style="margin-top: 7px;">
                        <button class="btn btn-primary" name="ReportSearch" id="ReportSearch" type="submit" >search</button>
                  </div>

            </div>
        </div>
    </div>
    </form><br/>

    <!-- end searching option -->

                    <div class="panel-body">
                        <div class="panel-body">

<?php

	$months = array(
			"1" => "January",
			"01" => "January",
			"2" => "February",
			"02" => "February",
			"3" => "March",
			"03" => "March",
			"4" => "Appril",
			"04" => "Appril",
			"5" => "May",
			"05" => "May",
			"6" => "June",
			"06" => "June",
			"7" => "July",
			"07" => "July",
			"8" => "August",
			"08" => "August",
			"9" => "September",
			"09" => "September",
			"10" => "October",
			"11" => "November",
			"12" => "December"
		);

    if(isset($_POST['ReportSearch'])):
        $data = array();

        // if shift is selected
        if($shiftid):
            $data['a.shiftid'] = $shiftid;
        endif;

        // if class is selected
        if($classname):
            $data['a.classid'] = $classname;
        endif;

        // if section is selected
        if($sections):
            $data['a.sectionid'] = $sections;
        endif;

        // if roll is selected
        if($stuclroll):
            $data['a.roll'] = $stuclroll;
        endif;

        if($advYear):
            $data['a.adv_year'] = $advYear;
        endif;

    else:
        $date = "date('".date("Y-m-01")."')";
        $data = array(
                "date(a.edate) >" => $date
            );
    endif;
    // call the quer
    $reportData = $this->accmodone->advancedReport( $data );
    
?>

                            <table class="table table-striped table-border" id="example1">
                                <thead>
                                    <tr>
                                        <th>SI</th>
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        <th>Shift</th>
                                        <th>Class</th>
                                        <th>Section</th>
                                        <th>Roll</th>
                                        <th>Month</th>
                                        <th>Amount</th>
                                        <th>Payment Year</th>
                                        <th>Payment Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php
                            $si = 0;
                            $total = 0;
                            foreach($reportData as $rD):
                                $si++;
                        ?>
                                    <tr>
                                        <td><?php echo $si ?></td>
                                        <td><?php echo $rD->stu_id ?></td>
                                        <td>
                                            <?php echo $rD->name ?>
                                        </td>
                                        <td>
                                            <?php echo $rD->shift_N ?>
                                        </td>
                                        <td>
                                            <?php echo $rD->class_name ?>
                                        </td>
                                        <td>
                                            <?php echo $rD->section_name ?>
                                        </td>
                                        <td>
                                            <?php echo $rD->roll_no ?>
                                        </td>
                                        <td>
                                            <span class="label label-primary"><?php echo $months[$rD->from_month] ?></span>
                                            <span class="glyphicon glyphicon-minus"></span>
                                            <span class="label label-primary"><?php echo $months[$rD->to_month] ?></span>
                                        </td>
                                        <td>
                                            <?php echo $rD->amount;$total += $rD->amount; ?>
                                        </td>
                                        <td>
                                            <?php echo $rD->adv_year ?>
                                        </td>
                                        <td>
                                            <?php echo $rD->edate ?>
                                        </td
                                    </tr>

                        <?php
                            endforeach;
                        ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Total :</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th><?php echo $total ?></th>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</aside>