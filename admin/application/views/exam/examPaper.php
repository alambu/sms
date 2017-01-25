
<aside class="right-side">
  <section class="content-header">
    <h1>
      General Setup 
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

<script type="text/javascript">
$(document).ready(function(){
 $('a[data-toggle="tab"]').on('show.bs.tab', function(e){
  localStorage.setItem('activeTab', $(e.target).attr('href'));
 });
 var activeTab = localStorage.getItem('activeTab');
 if(activeTab){
  $('#myTab a[href="' + activeTab + '"]').tab('show');
 }
});
</script>

<style type="text/css">
  @media print{
    #papMnTb{
      border:none !important;
      padding:none !important;
      margin:none !important;
    }
    #myTab{display: none;}  
  }
  
</style>

<section>
  <div class="container-fluid">
    <div class="col-md-12">

<?php $this->load->view("exam/success"); ?>

      <div class="panel panel-default" style="margin-top:20px;" id="papMnTb">

      <!-- <div class="panel-heading"><p id="title">Examination Name Entry</p></div> -->
        <div class="panel-body">

        <ul class="nav nav-tabs" id="myTab">
          <li class="active"><a data-toggle="tab" href="#pdistribute">Paper Distribute</a></li>
          <li><a data-toggle="tab" href="#pReceive">Paper Receive</a></li>
          <li><a data-toggle="tab" href="#DisPaTo">Distribute Paper Token</a></li>
          <li><a data-toggle="tab" href="#DistList">Distributed List</a></li>
          <li><a data-toggle="tab" href="#ReceiveList">Receive Paper List</a></li>
        </ul>

        <div class="tab-content">
          <!-- this is exam name setup -->
          <div id="pdistribute" class="tab-pane fade in active">
            <?php $this->load->view("exam/paper_distribute"); ?>
            <?php //$this->load->view("exam/xmNameList"); ?>
          </div>
          <!-- this is passing mark setup -->
          <div id="pReceive" class="tab-pane fade">
            <?php $this->load->view("exam/paper_receive_search"); ?>
            <?php //$this->load->view("exam/passMarkRepo"); ?>
          </div>
          <!-- this is grading system setup -->
          <div id="DisPaTo" class="tab-pane fade">
            <?php $this->load->view("exam/ptoken"); ?>
            <?php //$this->load->view("exam/grade_report"); ?>
          </div>
          <!-- this is room setup -->
          <div id="DistList" class="tab-pane fade">
            <?php $this->load->view("exam/paperDistDialogu"); ?>
            <?php //$this->load->view("exam/roomRepo"); ?>
          </div>
          <!-- this is other exam mark setup -->
          <div id="ReceiveList" class="tab-pane fade">
            <?php $this->load->view("exam/receivePaRepo"); ?>
            <?php //$this->load->view("exam/othXmRepo"); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
</aside>