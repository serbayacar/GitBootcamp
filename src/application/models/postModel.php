<?php
defined('BASEPATH') 0R exit('No direct script access allowed');

class postModel extends CI_Model{

	public function getAllPosts(){
		$SQL ="";
		$query = $this->db->query($_SQL);
		return $query->result_array();
	}	

	public function getPostbyCategory($categoryID){
		$SQL ="";
		$query = $this->db->query($_SQL);
		return $query->result_array();
	}

	public function getAllCategoryList(){
		$SQL ="";
		$query = $this->db->query($_SQL);
		return $query->result_array();
	}

    public function getAllThreads(){
    	$SQL ="";
		$query = $this->db->query($_SQL);
		return $query->result_array();
	}
    
    public function getAllThreadsByCategory($CategoryID){
		$SQL ="";
		$query = $this->db->query($_SQL);
		return $query->result_array();
	}

	public function getAllThreadsByCategoryIrreveland(){
		$SQL ="";
		$query = $this->db->query($_SQL);
		return $query->result_array();
	}	
}

?>
