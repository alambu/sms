<aside class="right-side">
    <section class="content-header">
        <h1>
            Google MAP Location
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

<script type="text/javascript">
    function changeAction(){
        document.frm.action="index.php/website/mapUpdate";
    }
</script>

<?php
    if(isset($_POST['save'])):
        extract($_POST);
    endif;

    // get previous data
    $gglmp = $this->db->select("*")->from("google_map")->order_by("id","DESC")->limit(1)->get()->row();
?>


    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
			<div class="col-md-12">
                <div class="panel panel-defaul">
                    <div class="panel-body">
                        
                        <div style="float:left;width: 60%;">
                            <h3>Google Map Source Link</h3>
                            <form action="" method="post" name="frm">
                                <textarea name="map" onchange="viewMAP(this.value)" cols="50" rows="3" style="white-space:nowrap;resize:none;" wrap="hard">
                                    <?php if(isset($map)):echo $map;endif; ?>
                                </textarea>
                                <button class="btn btn-primary" type="submit" name="save" style="margin-top: -170px;margin-left: 30px;" >Preview</button>
                                
                                <button type="submit" class="btn btn-success" name="update" style="margin-top: 200px;width:200px;" onclick="changeAction()" >Update</button>
                            
                            </form>
                        </div>

                        <div style="float:left;width: 20%;">
                        <h3>Google Map</h3>
                            
                            <iframe src="<?php if(isset($map)):echo $map;elseif(isset($gglmp->map_link)):echo $gglmp->map_link;endif; ?>" width="300" height="150" frameborder="2" style="border:2px solid #d0d0d0;" allowfullscreen></iframe>

                    </div>
                </div>
            </div>
        </div>
    </section>
</aside>