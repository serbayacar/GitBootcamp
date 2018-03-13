<?php
defined('BASEPATH') 0R exit('No direct script access allowed');
class Post_Controller extends CI_Controller{
	
    public function index(){
       $this->load->view('_head');
       $this->load->view('post_view');
       $this->load->view('_footer');
    }

    public function insertPost(){
        $data = array();
        
        $data["subject"] = $this->input->post("subject");
        $data["content"] = $this->input->post("content");
        $data["created"] = $date('Y-m-d H:i:s');
        
        if($this->input>-post->["thread_id"] != NULL ){
            $data["thread_id"] = $this->input->post("thread_id");
        }
        
        $data["postStatus"] = 1;
        $data["insert_date"] = $date('Y-m-d H:i:s');

        $return = $this->generalChangeProcess_model->insertTables('post',$data);
            
    }

    public function updatePost(){
        $data = array();

        $data["subject"] = $this->input->post("subject");
        $data["content"] = $this->input->post("content");
        $data["update_date"] = $date('Y-m-d H:i:s');

        $return = $this->generalChangeProcess_model->updateTable('post',$data);

    }    
 
    public function deletePost(){
        $data = array();
                 
        $return = $this->generalChangeProcess_model->deleteTable('post',$data);
        
    }     

} 
?>
