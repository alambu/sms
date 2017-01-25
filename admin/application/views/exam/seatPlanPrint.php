<style type="text/css" media="print">
    table tr td{
        border: 1px solid green !important;
        height: 100px;
        width: 100px;
        text-align: center;
    }
    h5{font-style: bolder;color: black;}

#pBody{
    margin-top: 0px;
    padding-top: 0px;
    padding-bottom: 0px;
    margin-bottom: 0px;
    width: 21cm;
    height: 29.7cm;
}
  
@pBody{
    size: A4;
    margin: 0;
}

</style>

<style type="text/css">
    table tr td{
        border: 1px solid green !important;
        height: 100px;
        width: 50px;
        text-align: center;
    }
    h5{font-style: bolder;color: black;}

#pBody{
    margin-top:20px;
}
    
</style>

<script>
    function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;
            }
</script>

<aside class="right-side">
	<section class="content-header">
        <h1>
            Exam Seat Plan
            <small>Control panel</small>
        </h1>
            <ol class="breadcrumb">
            	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
    </section>

    <!-- all php data taken here -->
        <?php 
            if(isset($_POST['go'])){
                extract($_POST);

                $sdata=array(
                    "exm_ctgid"=>$xm,
                    "classN"=>$class,
                    "shiftid"=>$shtp,
                    "section"=>$secP,
                    "room"=>$rmPr
                    );

                // get examnid data
                $xmC=$this->db->select("*")->from("exm_catg")->where("exm_ctgid",$xm)->get()->row();
                // get exam name
                $xmName=$this->db->select("*")->from("exm_namectg")->where("exmnid",$xmC->exmnid)->get()->row();
                // get class
                $cls=$this->db->select("*")->from("class_catg")->where("classid",$class)->get()->row();
                $s=$this->db->select("*")->from("exm_seatplain")->where($sdata)->order_by("id","desc")->get();
                 // echo $this->db->last_query();
                // get room name
                $rrNm=$this->db->select("r_name,room_number")->from("room_settup")->where("roomid",$rmPr)->get()->row();
                
            }
        ?>
    <!-- all php data taken here -->

	<section>
		<div class="container-fluid">
			<div class="col-md-12">
				<div class="panel panel-default" id="pBody">
                <?php 
                    if($s->num_rows()>0){
                        $seat=$s->row();
                    
                ?>
                    <div class="panel panel-heading">
                        <p style="text-align:center;font-size:20px;margin-bottom:0px;padding-bottom:0px;">
                            <?php echo ucfirst($xmName->exm_name)." - ".date("Y")."<br/>"; ?>
                        </p>
                <p style="text-align:center;">
                        <?php echo "Class - ".$cls->class_name."<br/>"; 
                                 echo "Room - ".$rrNm->r_name." (".$rrNm->room_number.")"."<br/>"; 
                                 echo "Roll - ( ".$seat->roll_no." )"; 
                            
                            $eRoll=explode("-", $seat->roll_no);
                            $rollDist=$eRoll[1]-$eRoll[0];
                            $lop=ceil($rollDist/6);
                            $stRoll=$eRoll[0];
                            $edRoll=$eRoll[1];

                            ?>
                </p>
                    </div>
                    <div class="panel panel-body">
                        <table class="table">
                            <?php 
                                for($i=0;$i<$lop;$i++){
                            ?>
                            <tr>
                            <?php
                                for($j=0;$j<=5;$j++){
                                    if($stRoll<=$edRoll){
                            ?>
                                <td style="text-align: center;border: 1px solid green;"><?php echo "<h5>".ucfirst($xmName->exm_name)." - ".date("Y")."</h5>";echo "Class - ".$cls->class_name; echo "<br/>Roll - ".$stRoll++ ?></td>
                            <?php
                                }
                                }
                            ?>
                            </tr>
                            <?php
                                }
                            ?>
                        </table>
                    </div>
                    <?php
                        }else{echo "<h3 style='text-align:center;color:red;'>Seat Plan Setting Not found.First set seat plan</h3>";}
                    ?>
                </div>
                <a href="index.php/exam/XmSeat">
                    <button class="btn btn-success"><span class="glyphicon glyphicon-arrow-left"></span> Back</button>    
                </a>
                
                <button class="btn btn-primary" onclick="printDiv('pBody')">Print This Copy</button>
            </div>
        </div>
    </section>