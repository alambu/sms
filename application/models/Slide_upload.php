<?php 
Class File_data_retrive extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function index(){
    	return false;
    }

    // slide image data insert
    function data_insert( $image_name,$title,$description,$sequence ){
    	// data array
    	$data = array(
    			"id" = '',
    			"image_name" => $image_name,
    			"title"	=> $title,
    			"description" => $description,
    			"sequence" => $sequence
    		);

    	$this->db->insert("slide_setting",$data);

    	// success
    	if( $this->db->affected_rows() ):
    		return true;
    	else:
    		return false;
    	endif;
    }

    // image upload to destination
    function image_upload( $name,$tmp_name ){
    	$path = "all/slide/".$name;
    	move_uploaded_file($tmp_name, $path);
    }

}
?>