<?php
	// get file name
		$file=$_GET['n'];
		$path="../school_admin/download/notice/".$file;
?>

<div class="main_con"><!--Content Start-->
	<div class="row">
		<div class="col-md-9 left_con"><!-- left Content Start--><div class="row">
			<div class="col-md-12"><!-- Welcome Massage Start-->
				<div class="panel panel-primary">
					<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;">Notice : <?php echo $file ?> </div>
					<div class="panel-body" style="min-height:770px;">
<?php
		// $myfile = fopen($path, "r") or die("Unable to open file!");
		// echo fread($myfile,filesize($path));
?>
<?php
$file = file_get_contents($path, true);
echo $file;
		// fclose($myfile);
?>
						</div>
					</div>
				</div>
			</div>
		</div>