<?php

error_reporting(0);
$id=$_GET['id'];

 $id = $this->db->where('id',$id);
$delete= $this->db->delete('vacancy',$id);


if($delete){
	redirect('welcome/vacancy');
	
}
?>