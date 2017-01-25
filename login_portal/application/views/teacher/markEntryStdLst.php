<style type="text/css">
    table tr th{
        text-align: center;
    }
    table tr td{border:none !important;}

    ul li{font-style: bold !important;}
</style>

<script type="text/javascript">
    function sum(th,ob,pra,id,identifier){
        
        if(identifier=='t'){
            var thry=document.getElementById("thMk").value;
            if(parseInt(th)>parseInt(thry)){
                alert("Given mark exceed maximum mark");
                document.getElementById("theory"+id).value="";
                document.getElementById("theory"+id).focus();
            }else{calc(th,ob,pra,id);}
        }else if(identifier=='o'){
            var obtv=document.getElementById("obMk").value;
            if(parseInt(ob)>parseInt(obtv)){
                alert("Given mark exceed maximum mark");
                document.getElementById("obj"+id).value="";
                document.getElementById("obj"+id).focus();
            }else{calc(th,ob,pra,id);}
            
        }else{
            var pct=document.getElementById("pcMk").value;
            if(parseInt(pra)>parseInt(pct)){
                alert("Given mark exceed maximum mark");
                document.getElementById("practical"+id).value="";
                document.getElementById("practical"+id).focus();
            }else{calc(th,ob,pra,id);}
            
        }        
}
// start calcultion part
function calc(th,ob,pra,id){
var t,o,p;

        var tmark=document.getElementById("sTm").value;
        var tm=parseInt(tmark);

        t=parseInt(th);
        o=parseInt(ob);
        p=parseInt(pra);

        if(isNaN(t)){
            t=0;
        }

        if(isNaN(o)){
            o=0;
        }

        if(isNaN(p)){
            p=0;
        }

        var total=t+o+p;

        if(total>tm){
            
            // border color change
            document.getElementById("theory"+id).style.border="1px solid red";
            document.getElementById("obj"+id).style.border="1px solid red";
            document.getElementById("practical"+id).style.border="1px solid red";
            document.getElementById("sba"+id).disabled=true;
            
            alert("Obtain mark cross the total mark.pls check it.");
            
            if((t>o)&&(t>p)){
                document.getElementById("theory"+id).focus();
            }

            else if((o>t)&&(o>p)){
                document.getElementById("obj"+id).focus();

            }else{
                document.getElementById("practical"+id).focus();
            }
        }else{

            // border color release
            document.getElementById("theory"+id).style.border="1px solid #d0d0d0";
            document.getElementById("obj"+id).style.border="1px solid #d0d0d0";
            document.getElementById("practical"+id).style.border="1px solid #d0d0d0";
            document.getElementById("sba"+id).disabled=false;

        var seventyPers=Math.ceil((total*70)/100);    

        document.getElementById("ptotal"+id).value=total;

        document.getElementById("persent"+id).value=seventyPers;
    }
}
    // end calc


function sbaSum(sba,ptotal,sid){
    var sbaMx=document.getElementById("sbTerm"+sid).value;

// check sba max value
    if(parseInt(sba)>parseInt(sbaMx)){
        alert("Maximum SBA value is "+sbaMx+" please put mark below Maximum value.");
        document.getElementById("sba"+sid).value='';
        document.getElementById("sba"+sid).focus();
    }else{
    
    var inTotal=parseInt(sba)+parseInt(ptotal);
    document.getElementById("tot"+sid).value=inTotal;
    document.getElementById("total"+sid).value=inTotal;
}

}

// submit single student data//*/   

// check function
function chk(s){
    // alert(s);
    var teo=document.getElementById("theory"+s).value;
    var obje=document.getElementById("obj"+s).value;
    var prc=document.getElementById("practical"+s).value;
    var ssbb=document.getElementById("sba"+s).value;

    if(teo==''){
        alert("Empty Theory mark");
        document.getElementById("theory"+s).focus();
        return false;
    }else if(obje==''){
        alert("Empty Objective mark");
        document.getElementById("obj"+s).focus();
        return false;
    }else if(prc==''){
        alert("Empty Practical mark");
        document.getElementById("practical"+s).focus();
        return false;
    }else if(ssbb==''){
        alert("Empty SBA mark");
        document.getElementById("sba"+s).focus();
        return false;
    }else{return true;}

}

// ajax function for submit data

function saveData(str){
    var testLg=chk(str);    // call chk function for test empty value
    
    if(testLg==true){
    // take all data for insert
    var st=document.getElementById("stdid"+str).value;
    var ex=document.getElementById("exm"+str).value;
    var cl=document.getElementById("cls"+str).value;
    var sc=document.getElementById("sec"+str).value;
    var sf=document.getElementById("shft"+str).value;
    var rl=document.getElementById("rll"+str).value;
    var sb=document.getElementById("sbid"+str).value;
    var th=document.getElementById("theory"+str).value;
    var ob=document.getElementById("obj"+str).value;
    var pl=document.getElementById("practical"+str).value;
    var sa=document.getElementById("sba"+str).value;
    var tl=document.getElementById("total"+str).value;

    var allDataMark=st+"+"+ex+"+"+cl+"+"+sc+"+"+sf+"+"+rl+"+"+sb+"+"+th+"+"+ob+"+"+pl+"+"+sa+"+"+tl;
    
    // alert(allDataMark);    

    $.ajax({
        url:"teacher/singleStdEntry",
        type:"POST",
        data:{d:allDataMark},
        success:function(received){
            // alert(received);
            if(received==1){
                alert("Successfully Mark insert");
                // document.getElementById("frm"+str).style.display="none";
                document.getElementById("strow"+str).style.display="none";
            }
        }
    });

} // end of yes no test logic
}
// end function

// all submit data
function validity(tt){
    var i = 0;
    for(var j = 1;j <= tt;j++){
        var getErr = chk(j);
        if(getErr == false) {break;}
        else{i++;}
    }
    if(i == tt){return true;}
        else{return false;}
}
// all submit data

</script>
 <aside class="right-side">
	<section class="content-header">
        <h1>
            Exam Mark Entry
            <small>Control panel</small>
        </h1>
            <ol class="breadcrumb">
            	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
    </section> 

<?php
    if(isset($_POST['stdList'])||(isset($_GET['m']))){
        
        $d=date("Y");
        // post value
        if(isset($_POST['stdList'])){
            extract($_POST);
        $data=array(
            "classid"=>$class,
            "section"=>$section,
            "syear"=>$d
            );

        }

        // get value
        if(isset($_GET['m'])){
            $gdata=explode(",", $_GET['m']);
// varriable
            $exam=$gdata[0];
            $class=$gdata[1];
            $section=$gdata[2];
            $sub=$gdata[3];
// data array
            $data=array(
                "classid"=>$gdata[1],
                "section"=>$gdata[2],
                "syear"=>$d
                );  
        }
        
        

        $xm_mark=$this->db->select("*")->from("subject_class")->where("subjid",$sub)->get()->row();

        $st=$this->db->select("*")->from("re_admission")->where($data)->order_by("roll_no","ASC")->get();
        $std=$st->result();
        $num=$st->num_rows();

        $xmNam=$this->db->query("SELECT * FROM exm_namectg WHERE exmnid=(SELECT exmnid FROM exm_catg WHERE exm_ctgid=$exam)")->row();
        $clN=$this->db->select("*")->from("class_catg")->where("classid",$class)->get()->row();

        $sbj=$this->db->select("*")->from("subject_class")->where("subjid",$sub)->get()->row();
    }

?>

	<section>
		<div class="container-fluid">
			<div class="col-md-12">
                <div class="col-md-12" style="float:right;">
                    <?php echo "<h3>".$xmNam->exm_name." > ".$clN->class_name." > ".$section." > ".$sbj->sub_name."</h3>"; ?>
                    <div class="col-md-2" style="float:right;">
                        <ul style="float:left;margin-top:-55px;padding:0px;">
                            <li>Theory : <?php echo $xm_mark->stherory_mk ?></li> 
                            <li>Objective : <?php echo $xm_mark->sobj_mk ?></li>
                            <li>Practical : <?php echo $xm_mark->sprack_mk ?></li>
                            <li>SBA : <?php echo (($xm_mark->exm_mark*30)/100); ?></li>
                        </ul>
                    </div>

                    <div class="col-md-3" style="float:right;">
                        <h3 style="float:right;margin-top:-30px;">Full Mark : <?php echo $xm_mark->exm_mark; ?></h3>
                    </div>
                </div>
                <?php $this->load->view("teacher/success"); ?>
				<div class="panel panel-default" style="margin-top:80px;">
		  	        <div class="panel-body">
                        <form action="index.php/allSubmit/mkAlSb" method="post" onsubmit="return validity(idvl.value)">
                        <table class="table" id="example1">
                            <thead>
                                <tr>
                                    <th>Roll</th>
                                    <th>Name</th>
                                    <th>Theory</th>
                                    <th>Objective</th>
                                    <th>Practical</th>
                                    <th>Pre Total</th>
                                    <th>70%</th>
                                    <th>SBA</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                        <?php
                            
                            $var=0;
                            $ed=date("Y");

                            foreach($std as $s){

                                $stdChkD=array(
                                    "stu_id"=>$s->stu_id,
                                    "exmid"=>$exam,
                                    "subjid"=>$sub,
                                    "exmyear"=>$ed
                                    );

                                $stdEntChk=$this->db->select("count(*) as tstd")->from("mark_add")->where($stdChkD)->get()->row();
                                
                                // check if this students mark has already inserted
                                if($stdEntChk->tstd<=0){

                                $stdN=$this->db->select("*")->from("regis_tbl")->where("stu_id",$s->stu_id)->get()->row();
                                // $shift=$this->db->select("*")->from("shift_catg")->where("shiftid",$stdN->shiftid)->get()->row();

                                $var++;
                        ?>
                        

                            <tr id="strow<?php echo $var; ?>">

                                <!-- <form id="frm<?php echo $var; ?>"> -->

                        <!-- all hidden value are here -->
                            <input type="hidden" name="exam" value="<?php echo $exam; ?>" id="exm<?php echo $var; ?>" >
                            <input type="hidden" name="subid" value="<?php echo $sub; ?>" id="sbid<?php echo $var; ?>" >
                            <input type="hidden" name="clas" value="<?php echo $class; ?>" id="cls<?php echo $var; ?>">
                            <input type="hidden" name="section" value="<?php echo $section; ?>" id="sec<?php echo $var; ?>" >
                            <input type="hidden" name="shift" value="<?php echo $stdN->shiftid; ?>" id="shft<?php echo $var; ?>" >
                            <input type="hidden" name="roll[]" value="<?php echo $s->roll_no; ?>" id="rll<?php echo $var; ?>" >
                            <input type="hidden" name="stdid[]" value="<?php echo $s->stu_id; ?>" id="stdid<?php echo $var; ?>" >
                            <!-- this is for theory,object,practical mark test -->
                                <input type="hidden" name="thMk" id="thMk" value="<?php echo $xm_mark->stherory_mk ?>" />

                                <input type="hidden" name="obMk" id="obMk" value="<?php echo $xm_mark->sobj_mk ?>" />
                                
                                <input type="hidden" name="pcMk" id="pcMk" value="<?php echo $xm_mark->sprack_mk ?>" />
                            <!-- this is for theory,object,practical mark test -->
                        <!-- all hidden value are here -->

                                <td>
                                    <input type="text" name="roll[]" class="form-control" value="<?php echo $s->roll_no; ?>" disabled />
                                </td>
                                <td>
                                    <input type="text" name="stdName[]" class="form-control" value="<?php echo $stdN->name; ?>" disabled />
                                </td>
                                <td>
                                    <input type="hidden" name="idvar" id="idvar<?php echo $var; ?>" value="<?php echo $var ?>" />
                                    <input type="text" name="theory[]" id="theory<?php echo $var; ?>" onchange="sum(this.value,obj<?php echo $var; ?>.value,practical<?php echo $var; ?>.value,idvar<?php echo $var; ?>.value,'t')" class="form-control" placeholder="Theory" onkeypress="return isNumber(event)" />
                                </td>

                                <td><input type="text" name="obj[]" id="obj<?php echo $var; ?>" onchange="sum(theory<?php echo $var; ?>.value,this.value,practical<?php echo $var; ?>.value,idvar<?php echo $var; ?>.value,'o')" class="form-control" placeholder="Objective" onkeypress="return isNumber(event)" /></td>
                                
                                <td><input type="text" name="practical[]" id="practical<?php echo $var; ?>" onchange="sum(theory<?php echo $var; ?>.value,obj<?php echo $var; ?>.value,this.value,idvar<?php echo $var; ?>.value,'p')" class="form-control" placeholder="Practical" onkeypress="return isNumber(event)" /></td>
                                
                                <td>
                                    <input type="hidden" name="sTm" id="sTm" value="<?php echo $xm_mark->exm_mark; ?>" />
                                    <input type="text" name="ptotal[]" id="ptotal<?php echo $var; ?>" class="form-control" placeholder="Pre Total" disabled required />
                                </td>
                                
                                <td><input type="text" name="persent[]" id="persent<?php echo $var; ?>" class="form-control" placeholder="70%" disabled required /></td>
                                
                                <td>
                                    <input type="hidden" id="sbTerm<?php echo $var; ?>" value="<?php echo (($xm_mark->exm_mark*30)/100); ?>" />
                                    <input type="text" name="sba[]" id="sba<?php echo $var; ?>" onchange="sbaSum(this.value,persent<?php echo $var; ?>.value,idvar<?php echo $var; ?>.value)" class="form-control" placeholder="SBA" onkeypress="return isNumber(event)" />
                                </td>
                                
                                <td><input type="text" id="tot<?php echo $var; ?>" class="form-control" placeholder="Total" disabled required />
                                <input type="hidden" name="total[]" id="total<?php echo $var; ?>" class="form-control" placeholder="Total" required />
                                </td>

                                <td>
                                    <button type="button" class="btn btn-primary" name="SglStdEn" onclick="return saveData(<?php echo $var; ?>)" >
                                        Entry
                                    </button>
                                </td>
                                <!-- </form> -->
                            </tr>
                        
                        
                        <?php
                            
                            }
                        }
                        ?>
                        </tbody>
                        </table>

                        

                        <?php
                    
                            if(($num<=0)||($var<=0)){
                        ?>

                        <table class="table">
                            <tr>
                                <td></td>
                                <td>
                                    <button type="button" class="btn btn-primary" onclick="window.history.back();"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> &nbsp;&nbsp;&nbsp;Back</button>
                                </td>
                                <td></td>
                            </tr>
                        </table>

                        <?php
                            }else{
                        ?>

                        <table class="table">
                            <tr>
                                <td style="width:1%;"></td>
                            
                                <td>
                                        <button class="btn btn-success" type="button" onclick="window.history.back();">
                                        <span class="glyphicon glyphicon-arrow-left"></span> Back</button>
                                </td>

                                <td>
                                    <input type="hidden" name="idvl" value="<?php echo $var ?>" >
                                    <button type="submit" name="ok" class="btn btn-primary" >
                                        <span class="glyphicon glyphicon-send" aria-hidden="true"> Submit
                                        </span>
                                    </button>
                                    <button type="reset" name="ok" class="btn btn-warning" onclick="resetAll()">
                                        <span class="glyphicon glyphicon-refresh" aria-hidden="true"> Reset
                                        </span>
                                    </button>
                                </td>
                                <td></td>
                            </tr>
                        </table>
                    </form>

                    <?php
                        }
                    ?>

                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</aside>