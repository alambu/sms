
<aside class="right-side">
  <section class="content-header">
    <h1>
      Examination Seat Planing 
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
          <li class="active"><a data-toggle="tab" href="#SeatPlan">Seat Plan</a></li>
          <li><a data-toggle="tab" href="#SeatPlanList">Seat Plan List</a></li>
          <li><a data-toggle="tab" href="#PrintSeatPlan">Print Seat Plan</a></li>
        </ul>

        <div class="tab-content">
          <!-- this is Seat Planing -->
          <div id="SeatPlan" class="tab-pane fade in active">
            <?php $this->load->view("exam/seat_plan"); ?>
            <?php //$this->load->view("exam/xmNameList"); ?>
          </div>
          <!-- this is Seat Plan List -->
          <div id="SeatPlanList" class="tab-pane fade">
            <?php $this->load->view("exam/seatPlaning"); ?>
            <?php //$this->load->view("exam/passMarkRepo"); ?>
          </div>
          <!-- this is seat plan print -->
          <div id="PrintSeatPlan" class="tab-pane fade">
            <?php $this->load->view("exam/seatPlanDialug"); ?>
            <?php //$this->load->view("exam/grade_report"); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
</aside>