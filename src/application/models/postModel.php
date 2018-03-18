<?php
defined('BASEPATH') 0R exit('No direct script access allowed');

class postModel extends CI_Model{

	public function getAllPosts(){
		$SQL ="select * from post";
		$query = $this->db->query($_SQL);
		return $query->result_array();
	}	

	public function getPostbyCategory($categoryID){
		$SQL ="Select * from post p , category c where p.category_id = c.id and c.name = ".$categoryID;
		$query = $this->db->query($_SQL);
		return $query->result_array();
	}

	public function getAllCategoryList(){
		$SQL ="select * from category";
		$query = $this->db->query($_SQL);
		return $query->result_array();
	}

    public function getAllThreads(){
    	$SQL ="select * from thread";
		$query = $this->db->query($_SQL);
		return $query->result_array();
	}
    
    public function getAllThreadsByCategory($CategoryID){
		$SQL ="Select * from post, thread, category where post.thread_id = thread.id and thread.category_id = category.id and category.name = ".$CategoryID;
		$query = $this->db->query($_SQL);
		return $query->result_array();
	}

	public function getAllThreadsByCategoryIrreveland(){
		$SQL ="select * from thread";
		$query = $this->db->query($_SQL);
		return $query->result_array();
	}	

	public function getAllThreadsAndCategories(){
		$SQL ="select t.subject as thread ,t.category_id as categoryID ,c.name  as category_name from thread t, category c
where t.category_id = c.id";
		$query = $this->db->query($_SQL);
		return $query->result_array();
	}	

}

?>
