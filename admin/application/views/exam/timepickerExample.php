<!DOCTYPE html>
<html>
<head>
    <title>Time picker test</title>
    <base href="<?php echo base_url() ?>"></base>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>

<body>
<div class="container">
    <form action="" class="form-horizontal" method="post">
        <fieldset>
            <legend>Test</legend>
			<div class="control-group">
                <label class="control-label">Time Picking</label>
                <div class="controls input-append date form_time" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
                    <input size="16" type="text" name="time" value="" readonly>
                    <span class="add-on"><i class="icon-remove"></i></span>
					<span class="add-on"><i class="icon-th"></i></span>
                </div>
				<input type="hidden" id="dtp_input3" value="" /><br/>
				<button class="btn btn-primary" name="sub" type="submit">Submit</button>
            </div>
        </fieldset>
    </form>
</div>

<script type="text/javascript" src="js/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.en.js" charset="UTF-8"></script>
<script type="text/javascript">
	$('.form_time').datetimepicker({
        language:  'en',
        weekStart: 0,
        todayBtn:  0,
		autoclose: 1,
		todayHighlight: 0,
		startView: 1,
		minView: 0,
		maxView: 4,
		forceParse: 0,
		minuteStep: 5
    });
</script>

<?php
	if(isset($_POST['sub'])){
		print_r($_POST);
	}
?>

</body>
</html>
