<style>
    table tr:nth-child(even){
        background: #f9f9f9;
    }


    input[type="text"]:valid {
    color: green;
}

input[type="text"]:valid ~ .input-validation::before {
    /*content: "✓";*/
    color: green;
}

input[type="text"]:invalid {
    color: red;
}

</style>

<script type="text/javascript">
    function editList(rid){
        // hide all normal data
        document.getElementById("gdName"+rid).style.display="none";
        document.getElementById("markRang"+rid).style.display="none";
        document.getElementById("gdPoint"+rid).style.display="none";
        document.getElementById("editId"+rid).style.display="none";
        
        // show success button
        document.getElementById("succId"+rid).style.display="block";
        document.getElementById("succId"+rid).setAttribute("style","margin-left:5px;");
        document.getElementById("gdInNm"+rid).type="text";
        document.getElementById("sRang"+rid).type="text";
        document.getElementById("minSn"+rid).style.display="block";
        document.getElementById("eRang"+rid).type="text";
        document.getElementById("gdInPoint"+rid).type="text";
    }

function rangChk(start,end,row){
    
    if(parseInt(start)>parseInt(end)){
        alert("First Rang value can't bigger than last rang value");
        document.getElementById("sRang"+row).value = '';
        document.getElementById("sRang"+row).focus();
    }
}

function succList(rid){

    var gdName=document.getElementById("gdInNm"+rid).value;
    var sRn=document.getElementById("sRang"+rid).value;
    var eRn=document.getElementById("eRang"+rid).value;
    var gdPt=document.getElementById("gdInPoint"+rid).value;
    var gdRow=document.getElementById("gdID"+rid).value;

    if( gdName == '' ){
        document.getElementById("gdInNm"+rid).focus();
        alert("Grade Name is empty.Pls check this.");
    }else if( sRn == '' ){
        document.getElementById("sRang"+rid).focus();
        alert("Start mark is empty.");
    }else if( eRn == '' ){
        document.getElementById("eRang"+rid).focus();
        alert("End mark is empty.");
    }else if( gdPt == '' ){
        document.getElementById("gdInPoint"+rid).focus();
        alert("Grade Point is empty.");
    }else{

    var data=gdName+","+sRn+","+eRn+","+gdPt+","+gdRow;
    $.ajax({
        url:"index.php/edit/gdEdit",
        type:"POST",
        data:{d:data},
        success:function(dDt){
            if(dDt==1){

                // show normal value
                document.getElementById("gdName"+rid).style.display="block";
                document.getElementById("markRang"+rid).style.display="block";
                document.getElementById("gdPoint"+rid).style.display="block";
                document.getElementById("editId"+rid).style.display="block";
                document.getElementById("editId"+rid).setAttribute("style","margin-left:2px;");
            
                // hide editing option
                document.getElementById("succId"+rid).style.display="none";
                document.getElementById("gdInNm"+rid).type="hidden";
                document.getElementById("sRang"+rid).type="hidden";
                document.getElementById("minSn"+rid).style.display="none";
                document.getElementById("eRang"+rid).type="hidden";
                document.getElementById("gdInPoint"+rid).type="hidden";

                // give them changed value
                document.getElementById("gdName"+rid).innerHTML=gdName;
                document.getElementById("markRang"+rid).innerHTML=sRn+"-"+eRn;
                document.getElementById("gdPoint"+rid).innerHTML=gdPt;    

            }else if( dDt == 2 ){
                document.getElementById("gdInNm"+rid).focus();
                alert("Sorry.This data can't modify.Because Grade Name or Grade Point or Mark Rang is already setup.");
            }
        }
    });
}
}

// this is for sorting table
$(document).ready(function() {
    $("#gradeRpo").dataTable({
        "order":[[2, 'desc']]
  });
});

</script>


<!-- <aside class="right-side">
	<section class="content-header">
        <h1>
            <a href="index.php/xmReport/gradeSysRep">Grading System List</a> 
            <small>Control panel</small>
        </h1>
            <ol class="breadcrumb">
            	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
    </section> -->

<?php
    if(isset($_POST['sub'])){
        extract($_POST);
        if(($grade!='')&&($point=='')&&($number=='')){ // if only grade value is found
            $gdList=$this->db->select("*")->from("exm_grade")->where("grade_N",$grade)->get()->result();
        }
        else if(($grade=='')&&($point!='')&&($number=='')){ // if only point value
            $gdList=$this->db->select("*")->from("exm_grade")->where("grade_point",$point)->get()->result();
        }
        else if(($grade=='')&&($point=='')&&($number!='')){    // only number value
            $gdList=$this->db->select("*")->from("exm_grade")->where('mark_from <=',$number)->where('mark_upto >=',$number)->get()->result();
        }
        else if(($grade!='')&&($point!='')&&($number=='')){ // grade and point value
            $gdList=$this->db->select("*")->from("exm_grade")->where("grade_N",$grade)->where("grade_point",$point)->get()->result();
        }
        else if(($grade=='')&&($point!='')&&($number!='')){ // point and number value
            $gdList=$this->db->select("*")->from("exm_grade")->where("grade_point",$point)->where('mark_from <=',$number)->where('mark_upto >=',$number)->get()->result();
        }
        else if(($grade!='')&&($point=='')&&($number!='')){ // grade and number value
            $gdList=$this->db->select("*")->from("exm_grade")->where("grade_N",$grade)->where('mark_from <=',$number)->where('mark_upto >=',$number)->get()->result();
        }
        else if(($grade=='')&&($point=='')&&($number=='')){ // no value
            $gdList=$this->db->select("*")->from("exm_grade")->order_by("grade_point","desc")->get()->result();
        }
        else{
        }
    }else{  // if search is not set
        $gdList=$this->db->select("*")->from("exm_grade")->order_by("grade_point","desc")->get()->result();
    }
?>

	<!-- <section>
		<div class="container-fluid">
			<div class="col-md-12">-->
<!-- 
            <div class="col-md-12"> -->
            <div class="panel panel-default">
                <div class="panel-heading"><center id="title">Grade List</center></div>
                <div class="panel-body">
                <form action="" method="post">
                    <table class="table" id="gradeLst">
                        <thead>
                            <tr style="background:none !important;">
                                <th>Grade</th>
                                <th>Point</th>
                                <th>Number</th>    
                                <th></th>    
                            </tr>
                        </thead>
                        <tr style="background:none !important;">
                            
                            <td><input type="text" name="grade" id="grade" class="form-control" value="<?php if(isset($_POST['sub'])){if($grade!=''){echo $grade;}} ?>" placeholder="Grade" /></td>
                            
                            <td><input type="text" name="point" id="point" class="form-control" value="<?php if(isset($_POST['sub'])){if($point!=''){echo $point;}} ?>" placeholder="Point" /></td>
                            
                            <td><input type="text" name="number" id="number" class="form-control" value="<?php if(isset($_POST['sub'])){if($number!=''){echo $number;}} ?>" placeholder="Number" /></td>
                            <td>
                                <button name="sub" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-search"></span> Search
                                </button>
                            </td>
                        </tr>
                    </table>
                </form>
                <hr style="width:100%;background:#6E6B6B;" />
            </div>

				<div class="">
                <div>
                    <table class="table table-striped" id="gradeRpo">
                        <thead>
                            <tr style="background:#d0d0d0;">
                                <th>Grade Name</th>
                                <th>Mark Rang</th>
                                <th>Grade Point</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $gd=0;
                            foreach($gdList as $gdL){
                                $gd++;

                        ?>

                        <tr>
                            <td>
                                <input type="hidden" id="gdID<?php echo $gd; ?>" value="<?php echo $gdL->gradid; ?>" />
                                <span id="gdName<?php echo $gd; ?>"><?php echo $gdL->grade_N; ?></span>
                                <input type="hidden" id="gdInNm<?php echo $gd; ?>" value="<?php echo $gdL->grade_N; ?>" class="form-control" pattern="[ABCDF+-]{1,2}" />
                            </td>

                            <td style="width:180px;">
                                <span id="markRang<?php echo $gd; ?>"><?php echo $gdL->mark_from." - ".$gdL->mark_upto; ?></span>
                                <input type="hidden" id="sRang<?php echo $gd; ?>" value="<?php echo $gdL->mark_from; ?>" class="form-control" style="width:50px;float:left;" onchange="rangChk(this.value,eRang<?php echo $gd; ?>.value,<?php echo $gd; ?>)" />
                                <span id="minSn<?php echo $gd; ?>" class="glyphicon glyphicon-minus" style="display:none;width:40px;float:left;margin-top:5px;margin-left:8px;"></span>
                                <input type="hidden" id="eRang<?php echo $gd; ?>" value="<?php echo $gdL->mark_upto; ?>" class="form-control" style="width:50px;float:right;" onchange="rangChk(sRang<?php echo $gd; ?>.value,this.value,<?php echo $gd; ?>)" />
                            </td>        
                            
                            <td>
                                <span id="gdPoint<?php echo $gd; ?>"><?php if(strlen($gdL->grade_point)==1){echo $gdL->grade_point.".00";}else{echo $gdL->grade_point."0";} ?></span>
                                <input type="hidden" id="gdInPoint<?php echo $gd; ?>" value="<?php if(strlen($gdL->grade_point)==1){echo $gdL->grade_point.".00";}else{echo $gdL->grade_point."0";} ?>" class="form-control" pattern="[1-5]{1}[.]{1}[0-9]{2}" />
                            </td>
                            
                            <td>
                                <button class="btn btn-primary" id="editId<?php echo $gd; ?>" onclick="editList(<?php echo $gd; ?>)"><span class="glyphicon glyphicon-edit"></span></button>
                                
                                <button class="btn btn-success" id="succId<?php echo $gd; ?>" style="display:none;" onclick="succList(<?php echo $gd; ?>)"><span class="glyphicon glyphicon-ok"></span></button>
                           </td>        
                        </tr>

                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
                    </div>
                    </div>
               </div>
     <!--  </div> -->
   <!-- </section> -->