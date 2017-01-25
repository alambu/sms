<html>
<head>
	
	<style>
	
		#data_content{
			height:930px;
			width:760px;
			margin-top:10px;
			margin-left:12px;
			float:left;
			border:0px solid;
			border-radius:5px;
			background-color:#f1f1f1;
	      }
		  
		
		  
		   #content2{
			height:890px;
			width:750px;
			float:left;
			border:0px solid;
			background-color:#f9f9f9;
			border-radius:5px;
			margin-top:10px;
	      }
		  
	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link type="text/css" rel="stylesheet" media="all" href="event_calender_css/style.css" />
</head>

 <body>
  <div id="data_content">
   
	  <div id="content2">
	  <table align="center" height="30px" width="566px" cellspacing="0" cellpadding="0">
			<tr>
				<td colspan="3" style="text-align:center; font-weight:bold; font-size:28px; text-decoration:underline; color:blue;">Calender</td>
			</tr>
	  </table>
	<?php

include 'classes/calendar.php';

$month = isset($_GET['m']) ? $_GET['m'] : NULL;
$year  = isset($_GET['y']) ? $_GET['y'] : NULL;

$calendar = Calendar::factory($month, $year);

$event1 = $calendar->event()->condition('timestamp', strtotime(date('F').' 21, '.date('Y')))->title('Hello All')->output('<a href="">Going to Google</a>');
$event2 = $calendar->event()->condition('timestamp', strtotime(date('F').' 21, '.date('Y')))->title('Something Awesome')->output('<a href="">My Portfolio</a><br />It\'s pretty cool in there.');

$calendar->standard('today')
	->standard('prev-next')
	->standard('holidays')
	->attach($event1)
	->attach($event2);
?>

      <div style="width:730px; padding:10px; margin:50px auto">
			<table class="calendar">
				<thead>
					<tr class="navigation">
						<th class="prev-month"><a href="<?php echo htmlspecialchars($calendar->prev_month_url()) ?>"><?php echo $calendar->prev_month() ?></a></th>
						<th colspan="5" class="current-month"><?php echo $calendar->month() ?></th>
						<th class="next-month"><a href="<?php echo htmlspecialchars($calendar->next_month_url()) ?>"><?php echo $calendar->next_month() ?></a></th>
					</tr>
					
					<tr class="weekdays">
						<?php foreach ($calendar->days() as $day): ?>
							<th><?php echo $day ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($calendar->weeks() as $week): ?>
						<tr>
							<?php foreach ($week as $day): ?>
								<?php
								list($number, $current, $data) = $day;
								
								$classes = array();
								$output  = '';
								
								if (is_array($data))
								{
									$classes = $data['classes'];
									$title   = $data['title'];
									$output  = empty($data['output']) ? '' : '<ul class="output"><li>'.implode('</li><li>', $data['output']).'</li></ul>';
								}
								?>
								<td class="day <?php echo implode(' ', $classes) ?>">
									<span class="date" title="<?php echo implode(' / ', $title) ?>"><?php echo $number ?></span>
									<div class="day-content">
										<?php echo $output ?>
									</div>
								</td>
							<?php endforeach ?>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	  
      </div>
	 

  
  
  </div>
 
 </body>

</html>