<style>
    table tr:nth-child(even){
        background: #f9f9f9;
    }

    table tr:nth-child(odd){
        background: #f1f1f1;
    }
    table tr td{text-align: center !important;}
    table tr th{text-align: center !important;}
</style>

<!-- all scripting are write down here -->
    <script type="text/javascript">


// editing function
    function editothXm(sid){
        document.getElementById("othXmName"+sid).style.display="none";
        document.getElementById("otxmNam"+sid).type="text";
        document.getElementById("otxmNam"+sid).focus();
    }
// editing function

// edit action
    function editActionOth(otxmNm,otxmId,otsid){
        if(otxmNm == ''){
            document.getElementById("otxmNam"+otsid).focus();
            alert("Exam Name empty.Pls write correctly.");
        }
        else{
        $.ajax({
                url:"index.php/edit/oThxmNmEdit",
                data:{xmID:otxmId,xmName:otxmNm,sid:otsid},
                type:"POST",
                success:function(data){
                    var dataSplit=data.split("+");
                    var xmNmID=dataSplit[0];
                    var xmNameTxt=dataSplit[1];
                    var succFail = parseInt(dataSplit[2]);

                    document.getElementById("othXmName"+xmNmID).style.display="block";
                    document.getElementById("othXmName"+xmNmID).innerHTML=xmNameTxt;
                    document.getElementById("otxmNam"+xmNmID).type="hidden";

                    if( succFail == 0 ){
                        alert("Exam name successfully modify.");
                    }else{
                        alert("This exam name already settup.Pls Select another one.");
                    }
                }
            });
    }
    }
// edit action

// set data table
$(document).ready(function(){
    $("#othXmRep").dataTable();
});

    </script>
<!-- all scripting are write down here -->

<!-- <aside class="right-side">
    <section class="content-header">
        <h1>
            Exam Name List
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
            <div class="panel panel-default" style="margin-top:20px;">
                <div class="panel-heading" style="text-align:center !important;"><center id="title">Other Examination List</center></div>
                    <table class="table" id="othXmRep" style="margin-top:10px;">
                        <thead>
                            <tr style="background:#d0d0d0;">
                                <th>SI No</th>
                                <th>Name</th>
                                <th>Enter Date</th>
                                <th>User</th>
                                <th>Action</th>
                            </tr>    
                        </thead>
                        <tbody>

    <?php
        $OthsiNo=0;
        $xmName=$this->db->select("*")->from("exm_othercatg")->get()->result();
        foreach($xmName as $xName){
            $eDate=explode(" ", $xName->e_date);
            $OthsiNo++;

            $userEmp=$this->db->select("*")->from("user_reg")->where("userid",$xName->e_user)->get()->row();

    ?>
    
                    
                        <tr>
                            <td><?php echo $OthsiNo; ?></td>
                            <td>
                                <span id="othXmName<?php echo $OthsiNo; ?>"><?php echo $xName->exm_name." - ".$xName->xm_year; ?></span>
                                <input type="hidden" name="OtxmNm[]" id="otxmNam<?php echo $OthsiNo; ?>" value="<?php echo $xName->exm_name; ?>" onblur="editActionOth(this.value,xmidot<?php echo $OthsiNo; ?>.value,<?php echo $OthsiNo; ?>)" class="form-control" />
                            </td>
                            <td><?php echo $eDate[0]; ?></td>
                            <td><?php echo $userEmp->userN; ?></td>
                            <td>
                                <input type="hidden" id="xmidot<?php echo $OthsiNo; ?>" name="xmid[]" value="<?php echo $xName->othexmid; ?>"  />
                                <input type="hidden" name="Otidval" id="Otidval<?php echo $OthsiNo; ?>" value="<?php echo $OthsiNo; ?>" />
                                <button class="btn btn-info" id="otedit<?php echo $OthsiNo; ?>" onclick="editothXm(<?php echo $OthsiNo; ?>)" ><span class="glyphicon glyphicon-edit"></span></button>

                            </td>
                           
                        </tr>

    <?php
        }
    ?>
                    </tbody>
                    </table>
                </div><!-- 
            </div>
        </div>
    </section>
 -->