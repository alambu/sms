
<aside class="right-side">
  <section class="content-header">
    <h1>
      Merit List
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

<section>
  <div class="container-fluid">
    <div class="col-md-12">

<?php $this->load->view("exam/success"); ?>

      <div class="panel panel-default" style="margin-top:10px;">

      <!-- <div class="panel-heading"><p id="title">Examination Name Entry</p></div> -->
        <div class="panel-body">

        <ul class="nav nav-tabs" id="myTab">
          <li class="active"><a data-toggle="tab" href="#tExam">Terminal Exam</a></li>
          <li><a data-toggle="tab" href="#oExam">Other Exam</a></li>
        </ul>

        <div class="tab-content">
          <!-- this is mark add setup -->
          <div id="tExam" class="tab-pane fade in active">
            <?php $this->load->view('exam/meritLst'); ?>
            <?php //$this->load->view("exam/xmNameList"); ?>
          </div>
      <!-- this is mark add setup -->
          <div id="oExam" class="tab-pane fade">
            <?php $this->load->view('exam/otherMerit'); ?>
            <?php //$this->load->view("exam/xmNameList"); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
</aside>