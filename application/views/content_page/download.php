<?php
$downloads = "downloads";
  $safeFilename = '/^\w+\.\w+$/';
  $filename = $_GET['filename'];
function download()
{
 
  global $filename, $safeFilename, $downloads;
  // MAKE SURE THE FILENAME IS SAFE!
  if (!preg_match($safeFilename, $filename)) {
    error("Bad filename");
  }
  // Now make sure the file actually exists
  if (!file_exists("$downloads/$filename")) {
    error("File does not exist");
  }

  header("Content-disposition: attachment; filename=$filename");
  header("Content-type: application/octet-stream");
  readfile("$downloads/$filename");

  exit(0);
}
download();
?>