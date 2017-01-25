<html>
<head>
<title>Download Menu</title>
</head>
<body>
<form method="GET" action="index.php/home/download.php">

<?php
  $downloads = "downloads";
  $safeFilename = '/^\w+\.\w+$/';
  $dir = opendir($downloads);
  if (!$dir) {
    die("Bad downloads setting");
  }
  while (($file = readdir($dir)) !== false) {
    // List only files with a safe filename
    if (preg_match($safeFilename, $file)) {

echo " description goes here   <INPUT TYPE='SUBMIT' name='filename' VALUE='$file'
STYLE='font-family:sans-serif; font-size:16;
font-style:italic; background:#999955; color:#000; cursor:pointer;width:7em'><br><br> ";

    }
  }

  closedir($dir);

?>

<br>

</form>
</body>
</html>



