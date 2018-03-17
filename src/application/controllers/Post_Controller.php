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

    public function getAllPosts(){
    	$data = $this->post_model->getAllPosts();
    	$HTML = "";

    	foreach ($data as $row) {
    		$HTML .= "<tr role=\"row\" class=\"odd\">
			    		<td class=\"sorting_1\">" .$row[id]."</td>
			    		<td> ". $row["subject"] ."</td>
			    		<td> ". $row["created"] ."</td>
			    		<td> ". $row["thread_id"] ."</td>
			    		<td> ". $row["user_account_id"] ."</td>
			    		<td> ". $row["postStatus"] ."</td>
                        <td> ". $row["status"] ."</td>
                        <td> ". $row["category_id"] ."</td>

    		    	</tr> ";

    	}
    	echo $HTML;
    } 

    public function getPostbyCategory($categoryID){
    	$data = $this->post_model->getPostbyCategory($categoryID);
    	$HTML = "";
    	
    	foreach ($data as $row) {
    		$HTML .= "<tr role=\"row\" class=\"odd\">
                        <td class=\"sorting_1\">" .$row[id]."</td>
                        <td> ". $row["subject"] ."</td>
                        <td> ". $row["content"] ."</td>
                        <td> ". $row["created"] ."</td>
                        <td> ". $row["thread_id"] ."</td>
                        <td> ". $row["user_account_id"] ."</td>
                        <td> ". $row["postStatus"] ."</td>
                        <td> ". $row["status"] ."</td>
                        <td> ". $row["category_id"] ."</td>
                        <td> ". $row["id"] ."</td>
                        <td> ". $row["name"] ."</td>
                        <td> ". $row["description"] ."</td>
                        <td> ". $row["creator"] ."</td>
                        <td> ". $row["created"] ."</td>
                        <td> ". $row["statusID"] ."</td>
                        <td> ". $row["categoryID"] ."</td>
                        <td> ". $row["category_status"] ."</td>
       		    	</tr> ";

    	}
    	echo $HTML;
    }   

    public function getAllCategoryList(){
    	$data = $this->post_model->getAllCategoryList();
    	$HTML = "";

    	foreach ($data as $row) {
    		$HTML .= "<tr role=\"row\" class=\"odd\">
			    		<td class=\"sorting_1\">" .$row[id]."</td>
			    		<td> ". $row["name"] ."</td>
			    		<td> ". $row["description"] ."</td>
			    		<td> ". $row["creator"] ."</td>
			    		<td> ". $row["created"] ."</td>
			    		<td> ". $row["categoryID"] ."</td>
			    		<td> ". $row["category_status"] ."</td>
    		    	</tr> ";
    	}
    	echo $HTML;
    }

    public function getAllThreads(){
    	$data = $this->post_model->getAllThreads();
    	$HTML = "";

    	foreach ($data as $row) {
    		$HTML .= "<tr role=\"row\" class=\"odd\">
			    		<td class=\"sorting_1\">" .$row[id]."</td>
			    		<td> ". $row["subject"] ."</td>
			    		<td> ". $row["created"] ."</td>
			    		<td> ". $row["userAccountID"] ."</td>
			    		<td> ". $row["threadStatus"] ."</td>
			    		<td> ". $row["status"] ."</td>
                        <td> ". $row["category_id"] ."</td>
    		    	</tr> ";
    	}
    	echo $HTML;
    }

     public function getAllThreadsByCategory($CategoryID){
    	$data = $this->post_model->getAllThreadsByCategory($CategoryID);
    	$HTML = "";

    	foreach ($data as $row) {
    		$HTML .= "<tr role=\"row\" class=\"odd\">
			    		<td class=\"sorting_1\">" .$row[id]."</td>
			    		<td> ". $row["subject"] ."</td>
                        <td> ". $row["content"] ."</td>
			    		<td> ". $row["created"] ."</td>
                        <td> ". $row["thread_id"] ."</td>
			    		<td> ". $row["user_account_id"] ."</td>
			    		<td> ". $row["postStatus"] ."</td> 
                        <td> ". $row["insert_date"] ."</td>
                        <td> ". $row["update_date"] ."</td>
			    		<td> ". $row["status"] ."</td>
                        <td> ". $row["category_id"] ."</td>
                        <td >" .$row[id]."</td>
                        <td> ". $row["subject"] ."</td>
                        <td> ". $row["created"] ."</td>
                        <td> ". $row["UserAccountID"] ."</td>
                        <td> ". $row["threadStatus"] ."</td>
                        <td> ". $row["insert_date"] ."</td>
                        <td> ". $row["update_date"] ."</td>
                        <td> ". $row["status"] ."</td>
                        <td> ". $row["category_id"] ."</td>
                        <td >" .$row[id]."</td>
                        <td> ". $row["name"] ."</td>
                        <td> ". $row["description"] ."</td>
                        <td> ". $row["creator"] ."</td>
                        <td> ". $row["created"] ."</td>
                        <td> ". $row["statusID"] ."</td>
                        <td> ". $row["categoryID"] ."</td>
                        <td> ". $row["insert_date"] ."</td>
                        <td> ". $row["update_date"] ."</td>
                        <td> ". $row["category_status"] ."</td>
                	</tr> ";

    	}
    	echo $HTML;
    }

    public function getAllThreadsByCategoryIrreveland(){
    	$data = $this->post_model->getAllThreadsByCategoryIrreveland();
    	$HTML = "";

    	foreach ($data as $row) {
    		$HTML .= "<tr role=\"row\" class=\"odd\">
			    		<td class=\"sorting_1\">" .$row[id]."</td>
			    		<td> ". $row["subject"] ."</td>
			    		<td> ". $row["created"] ."</td>
			    		<td> ". $row["userAccountID"] ."</td>
			    		<td> ". $row["threadStatus"] ."</td>
                        <td> ". $row["status"] ."</td>
                        <td> ". $row["category_id"] ."</td>
    		    	</tr> ";

    	}
    	echo $HTML;
    }

    public function getAllThreadsAndCategories(){
        $data = $this->post_model->getAllThreadsAndCategories();
        $HTML = "";

        foreach ($data as $row) {
            $HTML .= "<tr role=\"row\" class=\"odd\">
                        <td> ". $row["thread"] ."</td>
                        <td> ". $row["categoryID"] ."</td>
                        <td> ". $row["category_name"] ."</td>
                    </tr> ";

        }
        echo $HTML;

    }    
} 
?>
