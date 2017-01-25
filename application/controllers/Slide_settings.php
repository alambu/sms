<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Slide_settings extends CI_Controller {

	public function index(){
		$this->load->view("slide/slide_insert");
	}

	public function image_upload(){
		if( isset($_POST['upload']) ):
			extract($_POST);

			$name = $_FILES['image']['name'];
			$tmp_name = $_FILES['image']['tmp_name'];

			// data array
    	$data = array(
    			"id" => '',
    			"image_name" => $name,
    			"title"	=> $title,
    			"description" => $description,
    			"sequence" => $sequence
    		);

    	$this->db->insert("slide_setting",$data);

			$path = "all/slide/".$name;
    	move_uploaded_file($tmp_name, $path);

			if( $this->db->affected_rows() ):
				redirect("Slide_settings","location");
			else:
				echo "Fail";
			endif;

		endif;
	}
}

?>