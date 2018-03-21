<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class LoginController extends CI_Controller{
	
	public function index(){
		$this->load->view('login');
	}
	
	public function isLogin($userName){
		$data = $this->loginModel->getUser($userName);
		
		$user_name= $this->input->post("fieldUser");
        $password= $this->input->post("fieldPassword");
		
		if($user_name==$data[0]["username"] && md5($password)==$data[0]["hashed_password"]){			
			$this->load->view('_head');
			$this->load->view('post.html');
			$this->load->view('_footer');
		}
		
		else{
			$this->load->view('_head');
			$this->load->view('login.html');
			$this->load->view('_footer');
		}	
	}

	public function insertUser(){
		$data =array();
		
		$data["username"]=$this->input->post("fieldUser");
		$data["hashed_password"]=$this->input->post("fieldPassword");
		$data["email"]=$this->input->post("fieldEmail");
		$data["first_name"]=$this->input->post("fieldFirstName");
		$data["lasr_name"]=$this->input->post("fieldLastName");
		$data["created"]=$date('Y-m-d H:i:s');
		
		$data["last_activity"]=$date('Y-m-d H:i:s');
		$data["is_moderator"]=0;
		$data["user_status"]=1;
		$data["insert_date"]=$date('Y-m-d H:i:s');
		$data["update_date"]=$date('Y-m-d H:i:s');
		$data["user_account_status"]=1;
		
		 $return = $this->generalChangeProcess_model->insertTables('useraccount',$data);
			
	}
	
	public function deleteUser(){
		$data = $this->loginModel->getUser($userName);
		$data = array();
                 
        $return = $this->generalChangeProcess_model->deleteTable('useraccount',$data[0]['id']);
			
	}		
}

?>