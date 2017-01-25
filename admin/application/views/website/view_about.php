<?php 

include("db.php");


$select=mysql_query("select * from about");?>
<table align="center" border="1" cellpadding="0" cellspacing="0" border="0px" style="border-color:1px solid gray;">
<tr align='center'>
                <td><font color='black'>id</font></td>				
			    <td><font color='black'>Title</font> </td>
		        <td><font color='black'>Details</font></td>
                </tr><?php
while($test=mysql_fetch_array($select)){
	
		        $id= $test['id'];	
				
	   
		

?>

	   
	  <tr align='center'>
			<td><font color='black'><?php echo $id; ?></font></td>
			<td><font color='black'><?php echo $test['title']; ?></font></td>
			<td><font color='black'><?php echo  $test['details']; ?></font></td>
      </tr>
	 

<?php }?></table>





