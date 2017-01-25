<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <base href="<?php echo base_url();?>"></base>
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="js/datepicker.css">
  
  <script type="text/javascript" language="javascript" src="js/update_jquery.min.js"></script>
  <script src="js/datepicker.js"></script>
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
</head>
<body>
 
<p>Date: <input type="text" id="datepicker"></p>
 
 
</body>
</html>