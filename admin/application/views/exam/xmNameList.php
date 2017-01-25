<style>
    table tr:nth-child(even){
        background: #f9f9f9;
    }

    table tr:nth-child(odd){
        background: #f1f1f1;
    }
</style>

<!-- all scripting are write down here -->
    <script type="text/javascript">

// deactive function

    function deactive(str,id){
        var con=confirm('Are You Sure to Inactive this exam ?'); 

    if(con==true){
        $.ajax({
                url:"index.php/edit/deactiveXm",
                data:{stdid:str,dd:id},
                type:"POST",
                success:function(data){
                    // alert(data);
                    var btnId=data.split("+");
                    // alert(btnId[1]);

                document.getElementById("btnId"+btnId[1]).className="btn btn-danger";
                document.getElementById("btnId"+btnId[1]).innerHTML="Inactive";
                document.getElementById("btnId"+btnId[1]).setAttribute('onclick','activeXm(xmid'+btnId[1]+'.value,iddval'+btnId[1]+'.value)');
                document.getElementById("edit"+btnId[1]).disabled=true;
                }
            });
    }
    }
// deactive function


// activate function
    function activeXm(stdID,idval){
        var con=confirm('Are You Sure to Active this exam ?'); 

    if(con==true){
        $.ajax({
                url:"index.php/edit/activeXm",
                data:{stdid:stdID,dd:idval},
                type:"POST",
                success:function(data){
                    // alert(data);
                    var btnId=data.split("+");
                    // alert(btnId[1]);

                document.getElementById("btnId"+btnId[1]).className="btn btn-success";
                document.getElementById("btnId"+btnId[1]).innerHTML="Active";
                document.getElementById("btnId"+btnId[1]).setAttribute('onclick','deactive(xmid'+btnId[1]+'.value,iddval'+btnId[1]+'.value)');
                document.getElementById("edit"+btnId[1]).disabled=false;
                }
            });
    }
    }
// activate function


// editing function
    function edit1(sid){
        document.getElementById("xmName"+sid).style.display="none";
        document.getElementById("xmNam"+sid).type="text";
        document.getElementById("xmNam"+sid).focus();
    }
// editing function

// edit action
    function editAction(xmNm,xmId,sid){
        if(xmNm == ''){
            document.getElementById("xmNam"+sid).focus();
            alert("Exam Name empty.Pls write correctly.");
        }
        else{
            $.ajax({
            url:"index.php/edit/xmNmEdit",
            data:{xmID:xmId,xmName:xmNm,sid:sid},
            type:"POST",
            success:function(data){
                var dataSplit=data.split("+");
                var xmNmID=dataSplit[0];
                var xmNameTxt=dataSplit[1];
                var succFail = dataSplit[2];

                document.getElementById("xmName"+xmNmID).style.display="block";
                document.getElementById("xmName"+xmNmID).innerHTML=xmNameTxt;
                document.getElementById("xmNam"+xmNmID).type="hidden";

                if( succFail > 0 ){
                    alert("This exam name already settup.pls select another one.");
                }else{
                    alert("Exam name successfully modify.");
                }
            }
        });
      
        }
    }
// edit action


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
				<div class="panel panel-default" style="margin-top:20px;width:100%;">
                    <div class="panel-heading"><center id="title">Exam Name List</center></div>
                    <div class="panel-body">
                    <table class="table" id="example1">
                        <thead>
                            <tr style="background:#e3e3e3;font-size:15px;">
                                <th>SI No</th>
                                <th>Name</th>
                                <th>Enter Date</th>
                                <th>User</th>
                                <th>Action</th>
                                <th>Status</th>
                            </tr>    
                        </thead>
                        <tbody>

    <?php
        $siNo=0;
        $xmName=$this->db->select("*")->from("exm_namectg")->get()->result();
        foreach($xmName as $xName){
            $eDate=explode(" ", $xName->e_date);
            $siNo++;

            $userEmp=$this->db->select("*")->from("user_reg")->where("userid",$xName->e_user)->get()->row();

    ?>
    
                    
                        <tr>
                            <td><?php echo $siNo; ?></td>
                            <td>
                                <span id="xmName<?php echo $siNo; ?>"><?php echo $xName->exm_name; ?></span>
                                <input type="hidden" name="xmNm[]" id="xmNam<?php echo $siNo; ?>" value="<?php echo $xName->exm_name; ?>" onblur="editAction(this.value,xmid<?php echo $siNo; ?>.value,<?php echo $siNo; ?>)" class="form-control" />
                            </td>
                            <td><?php echo $eDate[0]; ?></td>
                            <td><?php echo $userEmp->userN; ?></td>
                            <td>
                                <input type="hidden" id="xmid<?php echo $siNo; ?>" name="xmid[]" value="<?php echo $xName->exmnid; ?>"  />
                                <input type="hidden" name="idval" id="iddval<?php echo $siNo; ?>" value="<?php echo $siNo; ?>" />
                                <button class="btn btn-info" id="edit<?php echo $siNo; ?>" onclick="edit1(<?php echo $siNo; ?>)" <?php if($xName->status==0){echo "disabled";} ?> ><span class="glyphicon glyphicon-edit"></span></button>

                            </td>
                            <td>
                                <?php 
                                    if($xName->status==1){
                                ?>
                                <button class="btn btn-success" id="btnId<?php echo $siNo; ?>" onclick="deactive(xmid<?php echo $siNo; ?>.value,iddval<?php echo $siNo; ?>.value);">Active</button>
                                <!-- <img src="" id="load" height="40px" width="40px"  /> -->
                                <?php
                                    }else{
                                ?>
                                <button class="btn btn-danger" id="btnId<?php echo $siNo; ?>" onclick="activeXm(xmid<?php echo $siNo; ?>.value,iddval<?php echo $siNo; ?>.value);">Inactive</button>
                                <!-- <img src="" id="load" height="40px" width="40px"  /> -->
                                <?php
                                    }
                                ?>
                            </td>
                        </tr>

    <?php
        }
    ?>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>
            <input type="hidden" name="hidval" id="hidval" value="<?php echo $siNo ?>" />
        </td>
    </tr>
    
                    </tbody>
                    </table>
                    </div>
                 </div>  
           <!-- </div>
        </div>
    </section>
 -->