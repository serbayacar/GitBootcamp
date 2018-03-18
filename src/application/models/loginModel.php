<?php
defined('BASEPATH') 0R exit('No direct script access allowed');

class loginModel extends CI_Model{

	public function getUSer($user){
		$SQL ="select username, email,hashed_password from userAccount where  username =".$user;
		$query = $this->db->query($_SQL);
		return $query->result_array();
	}	

}

?>
