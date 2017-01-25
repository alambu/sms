
<aside class="right-side">
  <section class="content-header">
    <h1>
      Exam Result Processing 
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
          <li class="active"><a data-toggle="tab" href="#home">Exam Mark Entry</a></li>
          <li><a data-toggle="tab" href="#otMk">Other Exam Mark Entry</a></li>
          <li><a data-toggle="tab" href="#allStdRst">All Student Result</a></li>
          <li><a data-toggle="tab" href="#indStdRst">Indivisual Student Result</a></li>
          <li><a data-toggle="tab" href="#othXmRst">Other Exam Result</a></li>
        </ul>

        <div class="tab-content">
          <!-- this is mark add setup -->
          <div id="home" class="tab-pane fade in active">
            <?php $this->load->view("exam/mark_add"); ?>
            <?php //$this->load->view("exam/xmNameList"); ?>
          </div>
          <!-- this is other exam mark setup -->
          <div id="otMk" class="tab-pane fade">
            <?php $this->load->view("exam/otherXmEntry"); ?>
            <?php //$this->load->view("exam/passMarkRepo"); ?>
          </div>
      <!-- this is all student result report -->
          <div id="allStdRst" class="tab-pane fade">
            <?php $this->load->view("exam/subWiseStdDia"); ?>
            <?php //$this->load->view("exam/passMarkRepo"); ?>
          </div>
      <!-- this is indivisual student result report -->
          <div id="indStdRst" class="tab-pane fade">
            <?php $this->load->view("exam/indivisualStdResult"); ?>
            <?php //$this->load->view("exam/passMarkRepo"); ?>
          </div>
      <!-- this is indivisual student result report -->
          <div id="othXmRst" class="tab-pane fade">
            <?php $this->load->view('exam/othXmRslt'); ?>
            <?php //$this->load->view("exam/passMarkRepo"); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
</aside>