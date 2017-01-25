<?php 
Class Websitetools extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function index(){
    	return false;
    }

// all teacher count
    function allTeacherRecordCount(){
    	$empid = $this->db->select("emptypeid")->from("emp_type")->where("type","teacher")->order_by("emptypeid","DESC")->limit(1)->get()->row();
    
    	$this->db->where("emptypeid",$empid->emptypeid)->from("empee");
    	$empCount = $this->db->count_all_results();
    	return $empCount;
    }

    // teacher information
    function teacherInfo($limit,$start){
    	$this->db->limit($limit, $start);
        return $query = $this->db->get("empee")->result();
    }

// employee name by user id
    function userName( $user ){
    	return $this->db->select("*")->from("user_reg")->where("userid",$user)->get()->row();
    }


}