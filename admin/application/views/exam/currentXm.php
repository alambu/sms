<style>

    table tr th{text-align: center;border:none !important;}
    table tr td{text-align: center;}

   
</style>

<script type="text/javascript">
	
// this is for only change input type
	function edit(sid){
		document.getElementById("xmdate"+sid).style.display="none";
        document.getElementById("edate"+sid).type="text";

        document.getElementById("action"+sid).className="btn btn-success";
		document.getElementById("eaction"+sid).className="glyphicon glyphicon-ok";
        document.getElementById("action"+sid).setAttribute("onClick","xmDate(edate"+sid+".value,xmid"+sid+".value,"+sid+")");
	}

// this function is for change exam date onchage
function xmDate(data,xmID,sucID){

	$.ajax({
		url:"index.php/edit/xmDateChange",
		data:{d:data,id:xmID},
		type:"POST",
		success:function(output){
			var val=output.split("+");  // output splite

			var edate=val[0];	// changed data
			//var sucID=val[1];	// data id

			document.getElementById("xmdate"+sucID).style.display="block";
			document.getElementById("xmdate"+sucID).innerHTML=edate;

			document.getElementById("edate"+sucID).value=edate;
			document.getElementById("edate"+sucID).type="hidden";

            document.getElementById("action"+sucID).className="btn btn-info";
            document.getElementById("eaction"+sucID).className="glyphicon glyphicon-edit";
            document.getElementById("action"+sucID).setAttribute("onClick","edit("+sucID+")");

		}
	});
}

// exam closing function

function xmClose(rowid,data){
	var i=confirm("Are you sure to close this exam ?");
    if(i==true){
        $.ajax({
    		url:"index.php/edit/xmClose",
    		data:{xmCatId:data},
    		type:"POST",
    		success:function(out){
    			alert(out);
    		}
    	});
    	document.getElementById("row"+rowid).style.display="none";
    }
}

$(document).ready(function () {                
    $('#fdate').datepicker({format: "yyyy-mm-dd"});            
    $('#edate').datepicker({format: "yyyy-mm-dd"});            
});

</script>

<!-- <aside class="right-side">
	<section class="content-header">
        <h1>
            <a href="index.php/xmReport/currentXm">Current Exam List</a>
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
            <div style="position:relative;top:15px;">
                <form action="index.php/exam/xmController" method="post">
                    <table class="table">
                        <tr>
                            <th style="line-height:35px;">Date From :</th>
                            <td style="line-height:35px;">
                                <input type="text" name="fdate" id="fdate" class="form-control" placeholder="2013-01-01" value="<?php if(isset($_POST['showHis'])&&($_POST['fdate']!='')){echo $_POST['fdate'];} ?>" />
                            </td>
                            <th style="line-height:35px;">
                                To :
                            </th>
                            <td style="line-height:35px;">
                                <input type="text" name="edate" id="edate" class="form-control" placeholder="<?php echo date("Y-m-d") ?>" value="<?php if(isset($_POST['showHis'])&&($_POST['edate']!='')){echo $_POST['edate'];} ?>" />
                            </td>
                            <td valign="bottom" style="line-height:35px;">
                                <input type="radio" name="status" value="1" <?php if(isset($_POST['status'])&&($_POST['status'])==1){echo "checked";} ?> class="form-control" /> Active
                                <input type="radio" name="status" value="0"  class="form-control" <?php if(isset($_POST['status'])&&($_POST['status'])==0){echo "checked";} ?> /> Inactive
                            </td>
                            <td>
                                <button type="submit" name="showHis" class="btn btn-success" style="width:150px;">Show Exam History</button>    
                            </td>
                        </tr>

                    </table>
                </form>
            </div>
				<div class="panel panel-default" style="margin-top:30px;">
                    <table class="table table-striped" id="example1">
                    <?php
                        if(isset($_POST['showHis'])){
                            extract($_POST);
                            $si=0;
                            
                            // if only active or inactive
                            if(($fdate=='')&&($edate=='')&&(isset($status))){
                                $rst=$this->db->select("*")->from("exm_catg")->where("status",$status)->get()->result();
                               
                            }

                            // date to date and active inactive search
                            else if(count($_POST)==4){
                                $rst=$this->db->select("*")->from("exm_catg")->where("exmdate BETWEEN '$fdate' AND '$edate'")->where("status",$status)->get()->result();
                                
                            }


                            // only date to date search
                            else{

                                $rst=$this->db->select("*")->from("exm_catg")->where("exmdate BETWEEN '$fdate' AND '$edate'")->get()->result();
                            }

                    ?>
                    <thead>
                            <tr style="background:#e3e3e3;font-size:15px;">
                                <th>SI No</th>
                                <th>Exam Name</th>
                                <th style="width:150px;">Start Date</th>
                                <th>End Date</th>
                                <?php  
                                    if((isset($status)&&($status!=0))||(!isset($status))){
                                        echo "<th>Action</th>";
                                        echo "<th>Status</th>";
                                    }elseif($status==0){
                                        echo "<th></th>";
                                        echo "<th></th>";
                                    }
                                ?>
                            </tr>
                    </thead>
                    <tbody>
                    <?php 
                        foreach($rst as $r){
                            $si++;
?>
<script>
$(document).ready(function () {                
    $('#fdate<?php echo $si ?>').datepicker({format: "yyyy-mm-dd"});            
    $('#edate<?php echo $si ?>').datepicker({format: "yyyy-mm-dd"});            
});

</script>

<?php

                            
                            $xN=$this->db->select("*")->from("exm_namectg")->where("exmnid",$r->exmnid)->get()->row();
                            $end=explode(" ", $r->up_date);
                    ?>
                        <tr id="row<?php echo $si; ?>">
                            <td><?php echo $si; ?></td>
                            <td><?php echo $xN->exm_name; ?></td>
                            <td>
                                <span id="xmdate<?php echo $si; ?>"><?php echo $r->exmdate; ?></span>
                                <input type="hidden" name="xmdate" id="edate<?php echo $si; ?>" value="<?php echo $r->exmdate; ?>" class="form-control" />
                            </td>
                            <td><?php if($r->status==0){echo $end[0];} ?></td>
                            
                            <td>
                                <?php
                                    if($r->status==1){
                                ?>
                                <input type="hidden" name="xmid" id="xmid<?php echo $si; ?>" value="<?php echo $r->exm_ctgid ?>" />
                            
                                <button class="btn btn-info" id="action<?php echo $si ?>" onclick="edit(<?php echo $si; ?>)"><span class="glyphicon glyphicon-edit" id="eaction<?php echo $si ?>"></span></button>
                                <?php 
                                    }
                                ?>
                            </td>
                            <td>
                                <?php if($r->status==1){ ?>
                                <button class="btn btn-danger"  onclick="xmClose(<?php echo $si; ?>,xmid<?php echo $si; ?>.value)"><span class="glyphicon glyphicon-remove-circle"></span> Close</button>
                             <?php
                                }
                             ?>
                             </td>
                            <?php
                               if((isset($status))&&($status!=0)&&($r->status==0)){
                        ?>

                        <?php
                           }
                       ?>
                       </tr>
                    
                    <?php
                            }
                    ?>

                    </tbody>
                    <?php
                        }else{
                    ?>
                        <thead>
                            <tr style="background:#e3e3e3;font-size:15px;">
                                <th>SI No</th>
                                <th>Exam Name</th>
                                <th style="width:150px;">Exam Date</th>
                                <th>Action</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        	 $win="SELECT * FROM exm_catg WHERE status = '1' ORDER BY  exm_ctgid DESC";

                        	 $w=$this->db->query($win)->result();


                        	 $sid=0;
                        		foreach($w as $rows){
                        			$sid++;
                        			$id=$rows->exmnid;

                        			$f=$this->db->query("SELECT * from exm_namectg where exmnid='$id'")->row();
                        			//$f=mysql_fetch_array($xmName);
                        ?>
                        
                    <!--  -->
                    <!--  for date picker -->
<script type="text/javascript">
$(document).ready(function () {                
    $('#edate'+<?php echo $sid; ?>).datepicker({format: "yyyy-mm-dd"});            
});
</script>
<!--  for date picker -->
                    <!--  -->

                        <tr id="row<?php echo $sid; ?>">
                        	<td><?php echo $sid; ?></td>
                        	<td><?php echo $f->exm_name; ?></td>
                        	<td>
                        		<input type="hidden" name="xmid" id="xmid<?php echo $sid; ?>" value="<?php echo $rows->exm_ctgid ?>" />
                        		<span id="xmdate<?php echo $sid; ?>"><?php echo $rows->exmdate; ?></span>
                        		<input type="hidden" name="xmdate" id="edate<?php echo $sid; ?>" value="<?php echo $rows->exmdate; ?>" class="form-control" />
                        	</td>
                        	<td>
                        		<button class="btn btn-info" id="action<?php echo $sid ?>" onclick="edit(<?php echo $sid; ?>)"><span class="glyphicon glyphicon-edit" id="eaction<?php echo $sid ?>"></span></button>
                        	</td>
                        	<td>
                        		<button class="btn btn-danger"  onclick="xmClose(<?php echo $sid; ?>,xmid<?php echo $sid; ?>.value)"><span class="glyphicon glyphicon-remove-circle"></span> Close</button>
                        	</td>
                        </tr>

                        <?php
                        		}
                            }
                         ?>
                         </tbody>
                         <tfoot>
                             <tr>
                                 <th colspan="6"></th>
                             </tr>
                         </tfoot>
                       </table>
                
            </div><!-- 
		</div>
	</section> -->