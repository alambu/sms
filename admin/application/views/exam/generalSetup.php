
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

<section>
  <div class="container-fluid">
    <div class="col-md-12">

<?php $this->load->view("exam/success"); ?>

      <div class="panel panel-default" style="margin-top:20px;">

      <!-- <div class="panel-heading"><p id="title">Examination Name Entry</p></div> -->
        <div class="panel-body">

        <ul class="nav nav-tabs" id="myTab">
          <li class="active"><a data-toggle="tab" href="#home">Exam Name Setting</a></li>
          <li><a data-toggle="tab" href="#pass">Passing Mark Setup</a></li>
          <li><a data-toggle="tab" href="#grade">Grading System</a></li>
          <li><a data-toggle="tab" href="#room">Room Setup</a></li>
          <li><a data-toggle="tab" href="#othexm">Other Exam name Setup</a></li>
        </ul>

        <div class="tab-content">
          <!-- this is exam name setup -->
          <div id="home" class="tab-pane fade in active">
            <?php $this->load->view("exam/exm_name"); ?>
            <?php $this->load->view("exam/xmNameList"); ?>
          </div>
          <!-- this is passing mark setup -->
          <div id="pass" class="tab-pane fade">
            <?php $this->load->view("exam/passing_mark_set"); ?>
            <?php $this->load->view("exam/passMarkRepo"); ?>
          </div>
          <!-- this is grading system setup -->
          <div id="grade" class="tab-pane fade">
            <?php $this->load->view("exam/grade_settings"); ?>
            <?php $this->load->view("exam/grade_report"); ?>
          </div>
          <!-- this is room setup -->
          <div id="room" class="tab-pane fade">
            <?php $this->load->view("exam/roomSet"); ?>
            <?php $this->load->view("exam/roomRepo"); ?>
          </div>
          <!-- this is other exam mark setup -->
          <div id="othexm" class="tab-pane fade">
            <?php $this->load->view("exam/other_xm"); ?>
            <?php $this->load->view("exam/othXmRepo"); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
</aside>