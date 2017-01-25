
<aside class="right-side">
  <section class="content-header">
    <h1>
      Exam Controller 
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

      <div class="panel panel-default" style="margin-top:20px;">

      <!-- <div class="panel-heading"><p id="title">Examination Name Entry</p></div> -->
        <div class="panel-body">

        <ul class="nav nav-tabs" id="myTab">
          <li class="active"><a data-toggle="tab" href="#xmSchedul">Exam Scheduling</a></li>
          <li><a data-toggle="tab" href="#cExam">Current Exam</a></li>
          <li><a data-toggle="tab" href="#xmRoutine">Exam Routine Setting</a></li>
          <li><a data-toggle="tab" href="#xmRoutineP">Exam Routine Print</a></li>
          <li><a data-toggle="tab" href="#xmTeachSch">Exam Teacher Schedule</a></li>
          <li><a data-toggle="tab" href="#xmTeachList">Exam Teacher Schedule List</a></li>
        </ul>

        <div class="tab-content">
          <!-- this is mark add setup -->
          <div id="xmSchedul" class="tab-pane fade in active">
            <?php $this->load->view('exam/exm_cat'); ?>
            <?php //$this->load->view("exam/xmNameList"); ?>
          </div>
      <!-- this is mark add setup -->
          <div id="cExam" class="tab-pane fade">
            <?php $this->load->view('exam/currentXm'); ?>
            <?php //$this->load->view("exam/xmNameList"); ?>
          </div>
          <!-- this is other exam mark setup -->
          <div id="xmRoutine" class="tab-pane fade">
            <?php $this->load->view('exam/exam_routine_sett'); ?>
            <?php //$this->load->view("exam/passMarkRepo"); ?>
          </div>
      <!-- this is all student result report -->
          <div id="xmRoutineP" class="tab-pane fade">
            <?php $this->load->view('exam/xmRoutinePrint'); ?>
            <?php //$this->load->view("exam/passMarkRepo"); ?>
          </div>
<!-- this is for exam teacher guide -->
          <div id="xmTeachSch" class="tab-pane fade">
            <?php $this->load->view('exam/xmTeachSched'); ?>
            <?php //$this->load->view("exam/passMarkRepo"); ?>
          </div>
<!-- this is for exam teacher guide -->
          <div id="xmTeachList" class="tab-pane fade">
            <?php $this->load->view('exam/xmTeachList'); ?>
            <?php //$this->load->view("exam/passMarkRepo"); ?>
          </div>
        Page rendered in <strong>{elapsed_time}</strong> seconds
        </div>
      </div>
    </div>
  </div>
</div>
</section>
</aside>