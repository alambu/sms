	 <?php
	
		// Define upload path (make sure you create an uploads folder on your server)
		$uploadpath = getcwd() . '/uploads/';
	
		// If the submit button has been pressed
		if(isset($_POST['submit']))
		{
			// Check for a file
			if(empty($_FILES['file']['name']))
			{
				$error['file'] = 'A file is required.';
			} else {
	
				// Check for the file type (jpg only)
				if($_FILES['file']['type'] != 'image/jpeg' && 
				$_FILES['file']['type'] != 'image/jpg' && 
				$_FILES['file']['type'] != 'image/pjpeg')
				{
					$error['file'] = 'Invalid file type.'; 
				}
		
				// Check for general upload errors
				if ($_FILES['file']['error'] > 0)
				{
					$error['file'] = 'A general uploading error has occurred';
				}
			}
	
			// If there are no errors
			if(sizeof($error) == 0)
			{
	
				// Upload file
				move_uploaded_file($_FILES['file']['tmp_name'], $uploadpath . $_FILES['file']['name']); 
	
			} else {
	
				// Display errors
				foreach($error as $value)
				{
					echo $value . "<br />"; 
				}
			}
		}
	?> 