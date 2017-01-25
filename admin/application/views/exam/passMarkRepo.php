<style type="text/css">

table tr td{text-align: center;border:none !important;}
table tr th{text-align: right;border:none !important;}
#repoHd tr{background: none !important;}
</style>

<script type="text/javascript">
    function edit(str){

        // hide all normal text
        document.getElementById("thry"+str).style.display="none";
        document.getElementById("obj"+str).style.display="none";
        document.getElementById("prac"+str).style.display="none";
        document.getElementById("avg"+str).style.display="none";
        // document.getElementById("total"+str).style.display="none";

        // show editing field
        document.getElementById("thory"+str).type="text";
        document.getElementById("ob"+str).type="text";
        document.getElementById("pra"+str).type="text";
        document.getElementById("avar"+str).type="text";
        // document.getElementById("tot"+str).type="text";
        // document.getElementById("tot"+str).disabled=true;

        // change action button to submit
        document.getElementById("btn"+str).className="btn btn-success";
        document.getElementById("btn"+str).setAttribute("onclick","return submitData("+str+")");
        document.getElementById("sucFailBtn"+str).className="glyphicon glyphicon-ok";

    }

    function submitData(str){
        var err = 0;
        var theory=document.getElementById("thory"+str).value;
        var obj=document.getElementById("ob"+str).value;
        var prac=document.getElementById("pra"+str).value;
        var avg=document.getElementById("avar"+str).value;
        // var total=document.getElementById("tot"+str).value;
        var pid=document.getElementById("passid"+str).value;

        // test data
        if( ( theory == '' ) && ( obj == '' ) && ( prac == '' ) && ( avg == '' ) ){
            alert("No data.Pls give passing mark.");
            err++;
            return false;
        }else if( ( theory != '' ) && ( obj == '' ) && ( prac == '' ) && ( avg == '' ) ){
            alert("Objective mark is empty.");
            err++;
            return false;
        }else if( ( theory != '' ) && ( obj != '' ) && ( prac == '' ) && ( avg == '' ) ){
            alert("Practical Mark is empty.");
            err++;
            return false;
        }else if( ( theory != '' ) && ( obj != '' ) && ( prac != '' ) && ( avg == '' ) ){
            var data=theory+"+"+obj+"+"+prac+"+"+avg+"+"+pid;
        }else if( ( theory == '' ) && ( obj == '' ) && ( prac == '' ) && ( avg != '' ) ){
            var data=theory+"+"+obj+"+"+prac+"+"+avg+"+"+pid;
        }


// send all data for editing
    if( err <= 0 ){
        $.ajax({
            url:"index.php/edit/passMarkEdit",
            type:"POST",
            data:{d:data},
            success:function(edata){
                if(parseInt(edata) == 1){
                    alert("successfully save change");

                    // hide eiditing option
                    document.getElementById("thory"+str).type="hidden";
                    document.getElementById("ob"+str).type="hidden";
                    document.getElementById("pra"+str).type="hidden";
                    document.getElementById("avar"+str).type="hidden";
                    // document.getElementById("tot"+str).type="hidden";
                    // document.getElementById("tot"+str).disabled=false;

                    // show editing normal text
                    document.getElementById("thry"+str).style.display="block";
                    document.getElementById("obj"+str).style.display="block";
                    document.getElementById("prac"+str).style.display="block";
                    document.getElementById("avg"+str).style.display="block";
                    // document.getElementById("total"+str).style.display="block";

                    // show changed value

                    document.getElementById("thry"+str).innerHTML=theory;
                    document.getElementById("obj"+str).innerHTML=obj;
                    document.getElementById("prac"+str).innerHTML=prac;
                    document.getElementById("avg"+str).innerHTML=avg;
                    // document.getElementById("total"+str).innerHTML=;

                   // change action button to submit
                    document.getElementById("btn"+str).className="btn btn-primary";
                    document.getElementById("btn"+str).setAttribute("onclick","edit("+str+")");
                    document.getElementById("sucFailBtn"+str).className="glyphicon glyphicon-edit";

                }
            }
        });
    }
}


function subNm( str ){
    $.ajax({
        url:"index.php/xmAllRequest/subjectFind",
        type:"POST",
        data:{clsid:str},
        success:function(data){
        
            var dd=data.split("+");
        // explode this array
            var sb=dd[0];
            var id=dd[1];

        // get value by explode
            var sbNm=sb.split(",");
            var sbId=id.split(",");

        // return value into option
            document.getElementById("sub").innerHTML='';
            document.getElementById("sub").innerHTML='<option value="">Select</option>';

        // looping option
            for(var i=1;i<sbNm.length;i++){
                document.getElementById("sub").innerHTML+='<option value="'+sbId[i]+'">'+sbNm[i]+'</option>';
            }

        }
    });
}

$(document).ready(function(){
    $("#passMkRep").dataTable();    
});


/** when give input value in average
* then other separate pass mark
* should be remove.
*/
function removeOtherRepo( str ){
    // replace input field to empty
    document.getElementById("thory"+str).value = '';
    document.getElementById("ob"+str).value = '';
    document.getElementById("pra"+str).value = '';
    document.getElementById("tot"+str).value = '';
    // document.getElementById("total"+str).innerHTML = '';
}

/**
* when separate value give
* then average field is empty
*/

function removeAvgRepo( avgR ){
    document.getElementById("avar"+avgR).value = '';
}

// check total value and given value valid
function chkPassRepo( gVal,tVal,id ){

    if(parseInt(gVal)>parseInt(tVal)){
        alert("Passing Mark can't greater than maximum mark.Maximum mark is : "+tVal);
        document.getElementById(id).value='';
        document.getElementById(id).focus();
        return false;
    }else{
        return true;
    }
}
</script>


<!-- <aside class="right-side">
	<section class="content-header">
        <h1>
            <a href="index.php/xmReport/passMarkRepo"> Passing Mark Report</a>
            <small>Control panel</small>
        </h1>
            <ol class="breadcrumb">
            	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
    </section> -->

<?php
    if(isset($_POST['search'])){
        
        extract($_POST);
        $s=$this->db->select("*")->from("subject_class")->where("classid",$cls)->get()->result();
        // echo count($s);echo "<pre>";print_r($s);

        if(($cls!='')&&($sub=='')){
            $passMark=$this->db->select("*")->from("pass_markctg")->where("classid",$cls)->get()->result();
        }else if(($cls=='')&&($sub!='')){
            $passMark=$this->db->select("*")->from("pass_markctg")->where("subjid",$sub)->get()->result();
        }else if(($cls!='')&&($sub!='')){
            $passMark=$this->db->select("*")->from("pass_markctg")->where("classid",$cls)->where("subjid",$sub)->get()->result();
        }else{
            $passMark=$this->db->select("*")->from("pass_markctg")->get()->result();
        }
    }else{
        $passMark=$this->db->select("*")->from("pass_markctg")->get()->result();
    }
        
        $cl=$this->db->select("*")->from("class_catg")->get()->result();
?>

	<!-- <section>
		<div class="container-fluid">
			<div class="col-md-12">
            <div class="col-md-2"></div> -->

        <div class="panel panel-default">
        <div class="panel-heading" style="text-align:center !important;"><center id="title">Passing mark list</center></div>
            <div class="table-responsive" style="margin-top:10px;margin-bottom:20px;">
                <form action="" method="post">
                    <table class="table" style="margin:0px auto;" id="repoHd">
                        <tr>
                            <th>Class</th>
                            <td>
                                <select name="cls" id="cls" class="form-control" onchange="subNm(this.value)">
                                    <option value="">Select</option>
                                    <?php foreach($cl as $c): ?>
                                    <option <?php if(isset($_POST['search'])){if($cls==$c->classid){echo "Selected";}} ?> value="<?php echo $c->classid ?>"><?php echo $c->class_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <th>Subject : </th>
                            <td>
                                <select name="sub" id="sub" class="form-control">
                                    <option value="">Select</option>
                                    <?php if(isset($_POST['search'])){ if(count($s)>0):foreach($s as $snm):  ?>
                                        <option <?php if($sub==$snm->subjid){echo "selected";} ?> value="<?php echo $snm->subjid; ?>"><?php echo $snm->sub_name; ?></option>
                                    <?php endforeach;endif; } ?>
                                </select>
                            </td>
                            <td>
                                <button class="btn btn-primary" name="search"> 
                                    <span class="glyphicon glyphicon-search"></span> Search
                                </button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
    			<div class="table-responsive">
                    <table class="table table-striped" id="passMkRep">
                        <thead>
                            <tr style="background:#d0d0d0 !important;">
                                <th>SI</th>
                                <th>Class</th>
                                <th>Subject</th>
                                <th>Theory</th>
                                <th>Objective</th>
                                <th>Practical</th>
                                <th>Avarage Pass Mark</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $si=0;
                            foreach($passMark as $psmk){
                                $si++;

                                // take class name form class_catg by class id
                                $clsName=$this->db->select("*")->from("class_catg")->where("classid",$psmk->classid)->get()->row();

                                // subject name from subject_class tbl by subjid
                                $subName=$this->db->query("SELECT s.subjid,p.sub_name FROM subject_class s right join subject_setup p ON s.subsetid = p.subsetid WHERE s.classid = '$psmk->classid' AND s.subjid = '$psmk->subjid'")->row();
                        ?>
                            <tr>
                                <td><?php echo $si; ?></td>
                                <td><?php echo $clsName->class_name; ?></td>
                                <td><?php echo $subName->sub_name; ?></td>
                                
                                <td>
                                    <input type="hidden" id="passid<?php echo $si; ?>" value="<?php echo $psmk->passid; ?>" />
                                    <span id="thry<?php echo $si; ?>"><?php if( $psmk->t_mark <= 0 ): echo $psmk->theory; else: echo "-"; endif; ?></span>
                                    <input type="hidden" id="thory<?php echo $si; ?>" class="form-control" value="<?php echo $psmk->theory; ?>" onchange="chkPassRepo(this.value,subjTthr<?php echo $si; ?>.value,this.id)" onkeypress="return isNumber(event)" onkeydown="removeAvgRepo(<?php echo $si ?>)" />
                                    <input type="hidden" name="subjTthr[]" id="subjTthr<?php echo $si ?>" value="<?php echo $subName->stherory_mk ?>" />
                                </td>
                                
                                <td>
                                    <span id="obj<?php echo $si; ?>"><?php if( $psmk->t_mark <= 0 ): echo $psmk->obj; else: echo "-"; endif; ?></span>
                                    <input type="hidden" class="form-control" id="ob<?php echo $si; ?>" value="<?php echo $psmk->obj; ?>" onchange="chkPassRepo(this.value,subjTobj<?php echo $si; ?>.value,this.id)" onkeypress="return isNumber(event)" onkeydown="removeAvgRepo(<?php echo $si ?>)" />
                                    <input type="hidden" name="subjTobj[]" id="subjTobj<?php echo $si ?>" value="<?php echo $subName->sobj_mk ?>" />
                                </td>
                                
                                <td>
                                    <span id="prac<?php echo $si; ?>"><?php if( $psmk->t_mark <= 0 ): echo $psmk->diff_pass; else: echo "-"; endif; ?></span>
                                    <input type="hidden" id="pra<?php echo $si; ?>" value="<?php echo $psmk->diff_pass; ?>" class="form-control" onchange="chkPassRepo(this.value,subjTprac<?php echo $si; ?>.value,this.id)" onkeypress="return isNumber(event)" onkeydown="removeAvgRepo(<?php echo $si ?>)" />
                                    <input type="hidden" name="subjTprac[]" id="subjTprac<?php echo $si ?>" value="<?php echo $subName->sprack_mk ?>" />
                                </td>
                                
                                
                                <td>
                                    <span id="avg<?php echo $si; ?>"><?php if( $psmk->t_mark > 0 ): echo $psmk->t_mark; else: echo "-"; endif; ?></span>
                                    <input type="hidden" value="<?php echo $psmk->t_mark; ?>" class="form-control" id="avar<?php echo $si; ?>" onkeypress="return isNumber(event)" onkeydown="removeOtherRepo(<?php echo $si ?>)" onchange="chkPassRepo(this.value,subjTtot<?php echo $si; ?>.value,this.id)" />
                                    <input type="hidden" name="subjTtot[]" id="subjTtot<?php echo $si ?>" value="<?php echo $subName->exm_mark ?>" />
                                </td>
                                
                                <td>
                                    <button class="btn btn-primary" id="btn<?php echo $si; ?>" onclick="edit(<?php echo $si; ?>)" >
                                        <span class="glyphicon glyphicon-edit" id="sucFailBtn<?php echo $si; ?>"></span>
                                    </button>
                                </td>
                            </tr>
                            
                        <?php
                            }
                        ?>
                        
                        </tbody>
                    </table>
                </div> 
          </div>
         <!-- </div>
    </section>
 -->