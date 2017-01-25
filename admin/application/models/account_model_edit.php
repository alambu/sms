<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class account_model_edit extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }
	public function delete($tables,$data){
		$this->db->where($tables['tcolum'],$data['values']);
        $status=$this->db->delete($tables['tableN']);
		return $status;
	}
	 public function update($tables,$data){
         $this->db->where($tables['tcolum'],$tables['values']);
         $status=$this->db->update($tables['tableN'],$data);
			return $status;
    }
	public function details_bill($id){
		$sql=$this->db->select('*')->from('stu_bill_descrip')->where('invoice_no',$id)->get()->result();
		return $sql;
	}
	public function details_bill_sum($id){
		$sql=$this->db->query("select SUM(balance) AS balance FROM stu_bill_descrip WHERE invoice_no='$id'")->row();
		return $sql;
	}
	public function balance_add_insert($data){
		$query=$this->db->insert("add_balance",$data);
		return $query;
	}
	public function balance_transfer_insert($data){
		$query=$this->db->insert("bank_transfer",$data);
		return $query;
	}
	
}
?>