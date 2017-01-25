<style type="text/css">
    table tr td{text-align: center;}
    table tr th{text-align: center;}
    #tHd tr td{border:none !important;}
    #tHd tr th{border:none !important;line-height: 32px !important;}
</style>

<script type="text/javascript">
    function clsSec(str){
        // section by class name
        $.ajax({
            url:"index.php/xmAllRequest/classChng",
            type:"POST",
            data:{clsid:str,rd:1},
            success:function(sec){
                
                // splite data first
                var sD=sec.split("+");
                var virtu=sD[0];
                var secData=virtu.split(",");

                document.getElementById("sect").innerHTML='';
                document.getElementById("sect").innerHTML='<option value="" >Select</option>';
                for(var i=0;i<secData.length;i++){
                    document.getElementById("sect").innerHTML+='<option value="'+secData[i]+'">'+secData[i]+'</option>';
                }

            }
        });

        // subject name by class wise
        $.ajax({
            url:"index.php/xmAllRequest/subjectFind",
            type:"POST",
            data:{clsid:str},
            success:function(sub){
                var septd=sub.split("+");
                var subN=septd[0];
                var subId=septd[1];
                var subNm=subN.split(",");
                var subD=subId.split(",");

                document.getElementById("sub").innerHTML='';
                document.getElementById("sub").innerHTML='<option value="">Select</option>';
                for(var j=0;j<subNm.length;j++){
                    document.getElementById("sub").innerHTML+='<option value="'+subD[j]+'">'+subNm[j]+'</option>';
                }
            }
        });
    }

function chk(){
    var sb=document.getElementById("sub").value;
    var sct=document.getElementById("sect").value;
    var rll=document.getElementById("rll").value;
    var xmyear=document.getElementById("xmyear").value;

    if((sb=='')&&(sct=='')){
        alert("Please Select any one of Subject or Section");
        return false;
    }else if((sct!='')&&(sb=='')){
        alert("Please Select subject name");
        document.getElementById("sub").focus();
        return false;
    }else if((rll!='')&&(xmyear=='')){
        alert("Please Select Year");
        return false;
    }
    else{return true;}
}

</script>

<aside class="right-side">
	<section class="content-header">
        <h1>
            <a href="javascript:void(0);">Student Result</a>
            <small>Control panel</small>
        </h1>
            <ol class="breadcrumb">
            	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
    </section>

<?php
    if(isset($_POST['stdReslt'])){
        extract($_POST);    // extract post method
        $ccllss=$class;

        $stdRst=array(
            "exmid"=>$exam,
            "classid"=>$class,
            "section"=>$section,
            "subjid"=>$sub,
            "exmyear"=>$year
            );

        // print_r($stdRst);

        $rsltList=$this->db->select("*")->from("mark_add")->where($stdRst)->get()->result();

    }
// if GET data set
    if(isset($_POST['go'])){
        extract($_POST);
        $ccllss=$cls;

// query section and subject name by class id
        if($cls!=''){
            $subject=$this->db->select("*")->from("subject_class")->where("classid",$cls)->get()->result();
            $section=$this->db->select("*")->from("class_catg")->where("classid",$cls)->get()->row();
            $sn=explode(",", $section->section);
        }

if(($cls!='')&&($sub!='')&&($sect=='')&&($xmyear=='')&&($rll=='')){ // class and subject
            $rsltList=$this->db->select("*")->from("mark_add")->where("classid",$cls)->where("subjid",$sub)->get()->result();
}else if(($cls!='')&&($sub!='')&&($sect=='')&&($xmyear!='')&&($rll=='')){ // class,sub,year
            $rsltList=$this->db->select("*")->from("mark_add")->where("classid",$cls)->where("subjid",$sub)->where("exmyear",$xmyear)->get()->result();
}else if(($cls!='')&&($sub!='')&&($sect!='')&&($xmyear=='')&&($rll=='')){ //class,sub,section
            $rsltList=$this->db->select("*")->from("mark_add")->where("classid",$cls)->where("subjid",$sub)->where("section",$sect)->get()->result();
}else if(($cls!='')&&($sub!='')&&($sect!='')&&($xmyear!='')&&($rll=='')){ //class,sub,section,year
            $rsltList=$this->db->select("*")->from("mark_add")->where("classid",$cls)->where("subjid",$sub)->where("section",$sect)->where("exmyear",$xmyear)->get()->result();
}else if(($cls!='')&&($sub!='')&&($sect!='')&&($xmyear!='')&&($rll!='')){ //class,sub,section,year,roll
            $rsltList=$this->db->select("*")->from("mark_add")->where("classid",$cls)->where("subjid",$sub)->where("section",$sect)->where("exmyear",$xmyear)->where("roll_no",$rll)->get()->result();
}else if(($cls!='')&&($sub!='')&&($sect=='')&&($xmyear!='')&&($rll!='')){ //class,sub,year,roll
            $rsltList=$this->db->select("*")->from("mark_add")->where("classid",$cls)->where("subjid",$sub)->where("exmyear",$xmyear)->where("roll_no",$rll)->get()->result();
}


}


// not set post class data select
    $cl=$this->db->select("*")->from("class_catg")->get()->result();

?>

	<section>
		<div class="container-fluid">
			<div class="col-md-12">
            <div class="col-md-12" style="margin-top:15px;">
                <form action="" method="post" onsubmit="return chk()">
                    <table class="table" id="tHd">
                        <tr>
                            <th>Class </th>
                            <td>
                                <select name="cls" class="form-control" onchange="clsSec(this.value)" required>
                                    <option value="" >Select</option>
                                    <?php foreach($cl as $c): ?>
                                        <option value="<?php echo $c->classid ?>" <?php if(isset($_POST['go'])){if($c->classid==$cls){echo "selected";}} ?> ><?php echo $c->class_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <th>Section </th>
                            <td>
                                <select name="sect" class="form-control" id="sect">
                                    <option value="">Select</option>
                            <?php if(isset($_POST['go'])){for($k=0;$k<count($sn);$k++): ?>
                                <option value="<?php echo $sn[$k] ?>" <?php if($sn[$k]==$sect){echo "selected";} ?> ><?php echo $sn[$k] ?></option>
                            <?php endfor;} ?>
                                </select>
                            </td>
                            <th>Subject </th>
                            <td>
                                <select name="sub" class="form-control" id="sub">
                                    <option value="">Select</option>
                                <?php if(isset($_POST['go'])){foreach($subject as $s): ?>
                                    <option value="<?php echo $s->subjid ?>" <?php if($s->subjid==$sub){echo "selected";} ?> ><?php echo $s->sub_name ?></option>
                                <?php endforeach;} ?>
                                </select>
                            </td>
                            <th>Year </th>
                            <td>
                                <select name="xmyear" id="xmyear" class="form-control">
                                    <option value="">Select</option>
                                    <?php for($y=date("Y");$y>=2010;$y--): ?>
                                        <option value="<?php echo $y ?>" <?php if(isset($_POST['go'])){if($y==$xmyear){echo "selected";}} ?>><?php echo $y ?></option>
                                    <?php endfor; ?>
                                </select>
                            </td>
                            <th>Roll </th>
                            <td><input type="text" name="rll" id="rll" class="form-control" onkeypress="return isNumber(event)" value="<?php if(isset($_POST['go'])){echo $rll;} ?>" /></td>
                            <td></td>
                            <td>
                                <button class="btn btn-primary" name="go" type="submit">
                                    <span class="glyphicon glyphicon-search"></span> Search
                                </button>
                            </td>
                        </tr>
                    </table>
                </form>
                <div style="height:40px;margin-top:-10px;">
                <?php
                // get subject total mark
                    $tmk=$this->db->select("*")->from("subject_class")->where("classid",$ccllss)->where("subjid",$sub)->get()->row();
                ?>
                    <b style="font-weight: bold !important;font-size:15px;">Total : <?php echo $tmk->exm_mark ?> &nbsp;&nbsp;&nbsp;Theory : <?php echo $tmk->stherory_mk ?>&nbsp;&nbsp;&nbsp; Objective: <?php echo $tmk->sobj_mk ?>&nbsp;&nbsp;&nbsp; Practical : <?php echo $tmk->sprack_mk ?> </b>
                </div>
            </div>
				<div class="panel panel-default" style="margin-top:100px;">
                    <table class="table table-striped table-hover" id="example1">
                        <thead>
                            <tr>
                                <th>Roll</th>
                                <th>Student Name</th>
                                <th>Theory</th>
                                <th>Objective</th>
                                <th>Practical</th>
                                <th>SBA</th>
                                <th>Total</th>
                                <th>Grade</th>
                            </tr>
                        </thead>

                        <tbody>

                        <?php
                        // get this class subject passing mark rang
                        $pkrg=$this->db->select("*")->from("pass_markctg")->where("classid",$ccllss)->where("subjid",$sub)->get()->row();
                        
                            foreach($rsltList as $rL){
                                // this is for grade selection
                                // if total mark not set then check each mark
                                // check if total mark below 100
                                if($tmk->exm_mark<100):
                                    $tmark=(($rL->total_mark*100)/$tmk->exm_mark);
                                else:
                                    $tmark=$rL->total_mark;
                                endif;

                                if($pkrg->t_mark<=0):
                                    if(($rL->theory_mark>=$pkrg->theory)&&($rL->obj_mark>=$pkrg->obj)&&($rL->practical_mark>=$pkrg->diff_pass)):
                                        // then check grade
                                        $gd=$this->db->select("*")->from("exm_grade")->where("mark_from <=",$tmark)->where("mark_upto >=",$tmark)->get()->row();
                                    else:
                                        $gd->grade_N="F";
                                    endif;
                                else:
                                    // then check grade directly
                                        $gd=$this->db->select("*")->from("exm_grade")->where("mark_from <=",$tmark)->where("mark_upto >=",$tmark)->get()->row();
                                endif;
                                
                                // echo $this->db->last_query();
                                
                                // search student name by student id
                                $stdNm=$this->db->select("*")->from("regis_tbl")->where("stu_id",$rL->stu_id)->get()->row(); 
                                
                        ?>

                            <tr>
                                <td><?php echo $rL->roll_no; ?></td>
                                <td><?php echo $stdNm->name; ?></td>
                                <td>
                                    <span <?php if($rL->theory_mark<$pkrg->theory):echo "style='color:red;font-weight:bold;'";endif; ?>><?php if($tmk->stherory_mk>0): echo $rL->theory_mark; else:echo " - ";endif;?></span>
                                </td>
                                <td>
                                    <span <?php if($rL->obj_mark<$pkrg->obj):echo "style='color:red;font-weight:bold;'";endif; ?>><?php if($tmk->sobj_mk>0): echo $rL->obj_mark; else:echo " - ";endif;?></span>
                                </td>
                                <td>
                                    <span <?php if($rL->practical_mark<$pkrg->diff_pass):echo "style='color:red;font-weight:bold;'";endif; ?>><?php if($tmk->sprack_mk>0):echo $rL->practical_mark; else:echo " - ";endif;?></span>
                                </td>
                                <td><?php echo $rL->sba_mark; ?></td>
                                <td><?php echo $rL->total_mark; ?></td>
                                <td><?php echo $gd->grade_N; ?></td>
                            </tr>

                        <?php
                            }
                        ?>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </section>