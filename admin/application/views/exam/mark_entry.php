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
            }else{
                calc(th,ob,pra,id);
                // $("#sba"+id).attr("readonly", false);
            }
        }else if(identifier=='o'){
            var obtv=document.getElementById("obMk").value;
            if(parseInt(ob)>parseInt(obtv)){
                alert("Given mark exceed maximum mark");
                document.getElementById("obj"+id).value="";
                document.getElementById("obj"+id).focus();
            }else{
                calc(th,ob,pra,id);
                // $("#sba"+id).attr("readonly", false);
            }
            
        }else{
            var pct=document.getElementById("pcMk").value;
            if(parseInt(pra)>parseInt(pct)){
                alert("Given mark exceed maximum mark");
                document.getElementById("practical"+id).value="";
                document.getElementById("practical"+id).focus();
            }else{
                calc(th,ob,pra,id);
                // $("#sba"+id).attr("readonly", false);
            }
            
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
            // document.getElementById("sba"+id).disabled=true;
            
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
            // document.getElementById("sba"+id).disabled=false;

        // var seventyPers=Math.ceil((total*70)/100);    

        document.getElementById("tot"+id).value=total;
        document.getElementById("total"+id).value=total;

        // document.getElementById("persent"+id).value=seventyPers;
    }
}
    // end calc


// submit single student data//*/   

// check function
function chk(s){
    // alert(s);
    var teo=document.getElementById("theory"+s).value;
    var obje=document.getElementById("obj"+s).value;
    var prc=document.getElementById("practical"+s).value;
    var othMk=document.getElementById("othMk"+s).value;

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
    }else if(othMk==''){
        alert("Empty Dairy mark");
        document.getElementById("othMk"+s).focus();
        return false;
    }
    else{return true;}

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
    var dairy=document.getElementById("othMk"+str).value;
    var tl=document.getElementById("total"+str).value;

    var allDataMark=st+"+"+ex+"+"+cl+"+"+sc+"+"+sf+"+"+rl+"+"+sb+"+"+th+"+"+ob+"+"+pl+"+"+dairy+"+"+tl;
    
    // alert(allDataMark);    

    $.ajax({
        url:"index.php/allSubmit/singleStdEntry",
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
    var i = 0,err = 0;
    for(var j = 1; j <= tt; j++){

        var t = document.getElementById("theory"+j).value;   
        var o = document.getElementById("obj"+j).value;   
        var p = document.getElementById("practical"+j).value;

          if(( t == '' )&&( o == '' )&&( p == '' )){
            // nothing done then
          }else{
           if( t == '' ){
            alert("Theory mark is empty.");
            document.getElementById("theory"+j).focus();
            err++;
            return false;
          }else if( o == '' ){
            alert("Objective mark is empty.");
            document.getElementById("obj"+j).focus();
            err++;
            return false;
          }else if( p == '' ){
            alert("Practical mark is empty.");
            document.getElementById("practical"+j).focus();
            err++;
            return false;
          }else{
            var dairyMk = document.getElementById("othMk"+j).value;
            if(dairyMk == ''){
                alert("Dairy mark is empty.");
                document.getElementById("othMk"+j).focus();
                return false;
            }else{
                return true;
            }
          }
        } 
    }


    if( err > 0 ){
        return false;
    }else{ return true; }

}


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
    if(isset($_POST['stdList']) || ( $this->uri->segment(6) ) ){
        
        $d=date("Y");
        // post value
        if(isset($_POST['stdList'])){
            extract($_POST);
        $data=array(
            "classid"   => $class,
            "section"   => $section,
            "syear"     => $d,
            "shiftid"     => $shift
            );

        }

        // get value
        if( $this->uri->segment(6) ){
// varriable
            $exam    = $this->uri->segment(3);
            $class   = $this->uri->segment(4);
            $section = $this->uri->segment(5);
            $sub     = $this->uri->segment(6);
            $shift   = $this->uri->segment(7);
// data array
            $data=array(
                "classid" => $class,
                "section" => $section,
                "syear"   => $d,
                "shiftid"   => $shift
                );  
        }
        // checking if this is final exam or not
        $check_final_xm = $this->mkst->final_exam( $exam );
        ////////////////////////////////////////////////////

        $xm_mark=$this->db->select("*")->from("subject_class")->where("subjid",$sub)->get()->row();

        $st=$this->db->select("*")->from("re_admission")->where($data)->order_by("roll_no","ASC")->get();
        $std=$st->result();
        // echo $this->db->last_query();
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
                    <?php echo "<h3>".$xmNam->exm_name." > ".$this->mkst->banglaString($clN->class_name)." > ".$section." > ".$sbj->sub_name."</h3>"; ?>
                    <div class="col-md-2" style="float:right;">
                        <ul style="float:left;margin-top:-55px;padding:0px;">
                            <li>Theory : <?php echo $xm_mark->stherory_mk ?></li> 
                            <li>Objective : <?php echo $xm_mark->sobj_mk ?></li>
                            <?php if($xm_mark->sprack_mk): ?>
                            <li>Practical : <?php echo $xm_mark->sprack_mk ?></li>
                        <?php endif; ?>
                        </ul>
                    </div>

                    <div class="col-md-3" style="float:right;">
                        <h3 style="float:right;margin-top:-30px;">Full Mark : <?php echo $xm_mark->exm_mark; ?></h3>
                    </div>
                </div>
                
				<div class="panel panel-default" style="margin-top:80px;">
                <?php $this->load->view("exam/success"); ?>
		  	        <div class="panel-body">
                        <form action="index.php/allSubmit/mkAlSb" method="post" onsubmit="return validity(idvl.value)">
                        <table class="table" id="example1">
                            <thead>
                                <tr>
                                    <th>Roll</th>
                                    <th>Name</th>
                                    <th>Theory</th>
                                    <th>Objective</th>
                                <?php if($xm_mark->sprack_mk): ?>
                                    <th>Practical</th>
                                <?php endif; ?>
                                    <!-- <th>Pre Total</th>
                                    <th>70%</th>
                                    <th>SBA</th> -->
                                <?php if($check_final_xm): ?>
                                    <th>Other Mark</th>
                                <?php endif; ?>
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
                            <input type="hidden" name="shift[]" value="<?php echo $stdN->shiftid; ?>" id="shft<?php echo $var; ?>" >
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
                                
                                <?php if($xm_mark->sprack_mk): ?>
                                <td>
                                    <input type="text" name="practical[]" id="practical<?php echo $var; ?>" onchange="sum(theory<?php echo $var; ?>.value,obj<?php echo $var; ?>.value,this.value,idvar<?php echo $var; ?>.value,'p')" class="form-control" placeholder="Practical" onkeypress="return isNumber(event)" />
                                </td>
                            <?php else: ?>
                                <input type="hidden" name="practical[]" id="practical<?php echo $var; ?>" onchange="sum(theory<?php echo $var; ?>.value,obj<?php echo $var; ?>.value,this.value,idvar<?php echo $var; ?>.value,'p')" class="form-control" placeholder="Practical" onkeypress="return isNumber(event)" value="0" />
                            <?php endif; ?>
                                <!-- <td> -->
                                    <input type="hidden" name="sTm" id="sTm" value="<?php echo $xm_mark->exm_mark; ?>" />
                                    <!-- <input type="text" name="ptotal[]" id="ptotal<?php echo $var; ?>" class="form-control" placeholder="Pre Total" disabled required /> -->
                                <!-- </td> -->
                                
                                <!-- <td><input type="text" name="persent[]" id="persent<?php echo $var; ?>" class="form-control" placeholder="70%" disabled required /></td> -->
                                
                                <!-- <td>
                                    <input type="hidden" id="sbTerm<?php echo $var; ?>" value="<?php echo (($xm_mark->exm_mark*30)/100); ?>" />
                                    <input type="text" name="sba[]" id="sba<?php echo $var; ?>" onchange="sbaSum(this.value,persent<?php echo $var; ?>.value,idvar<?php echo $var; ?>.value)" class="form-control" placeholder="SBA" onkeypress="return isNumber(event)" readonly />
                                </td> -->
                                
                                <!-- others mark -->
                                <?php if($check_final_xm): ?>
                                    <td>
                                        <input type="text" name="otherMk[]" id="othMk<?php echo $var ?>" onkeypress="return isNumber(event)" class="form-control" />
                                    </td>
                                <?php else: ?>
                                    <input type="hidden" name="otherMk[]" id="othMk<?php echo $var ?>" onkeypress="return isNumber(event)" class="form-control" value="0" />
                                <?php endif; ?>
                                <!-- others mark end -->

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
                                <a href="index.php/exam/result">
                                    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> &nbsp;&nbsp;&nbsp;Back</button>
                                </a>
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
                                    <a href="index.php/exam/result">
                                        <button class="btn btn-success" type="button">
                                        <span class="glyphicon glyphicon-arrow-left"></span> Back</button>
                                    </a>
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