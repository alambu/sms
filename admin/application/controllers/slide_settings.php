<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Slide_settings extends CI_Controller {

	public function slidePreview(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view("slide/slide");
		$this->load->view('footer');
	}

	public function settings(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view("slide/slide_insert");
		$this->load->view('footer');
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

			$path = "../all/slide/";
    	$m = move_uploaded_file($tmp_name, $path.$name);

			if( $this->db->affected_rows() ):
				redirect("slide_settings/settings","location");
			else:
				echo "Fail";
			endif;

		endif;
	}

	public function deleteSlide(){
		$id = $this->uri->segment(3);
		$del = $this->db->where("id",$id)->delete("slide_setting");
		redirect("slide_settings/slidePreview","location");
	}
}
?>