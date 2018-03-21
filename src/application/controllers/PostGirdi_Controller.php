<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PostGirdi_Controller extends CI_Controller{
	
	public function index(){
       $this->load->view('post');
    }
	
	public function insertPost(){
        $data = array();
        
        $data["subject"] = $this->input->post("title");
        $data["content"] = $this->input->post("icerik");
        $data["created"] = $date('Y-m-d H:i:s');
        
        if($this->input>-post->["selectKategori"] != NULL ){
            $data["thread_id"] = $this->input->post("selectKategori");
        }
        
        $data["postStatus"] = 1;
        $data["insert_date"] = $date('Y-m-d H:i:s');

        $return = $this->generalChangeProcess_model->insertTables('post',$data);
            
    }

    public function updatePost(){
        $data = array();

        $data["subject"] = $this->input->post("title");
        $data["content"] = $this->input->post("icerik");
        $data["update_date"] = $date('Y-m-d H:i:s');

        $return = $this->generalChangeProcess_model->updateTable('post',$data);

    }    
 
    public function deletePost(){
        $data = array();
                 
        $return = $this->generalChangeProcess_model->deleteTable('post',$data);
        
    } 
	
}
?>