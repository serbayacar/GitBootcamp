<?php
class uploadModel extends CI_Model {
   
    public function Upload($files,$directory_name,$files_alias,$type,$db_path,$db_id)
   {
      $deger=false;
        try { 
            
              $config =  array(
                'upload_path'     => $_SERVER["DOCUMENT_ROOT"]."/picfy/assets/images/".$directory_name,
                'allowed_types'   => "jpg|jpeg|doc|docx|xls|ppt",
                'overwrite'       => FALSE,
                'file_name'       => $files_alias."_".uniqid(),
                'max_size'        => "2048000",
                'max_height'      => "1024",
                'max_width'       => "1024"
            );
            $this->load->library('upload', $config);
            #file upload part
            $file_count = count($files['images']['name']);
            for($i=0; $i<$file_count; $i++)
            {
                $_FILES['userfile']['name']= $files['images']['name'][$i];
                $_FILES['userfile']['type']= $files['images']['type'][$i];
                $_FILES['userfile']['tmp_name']= $files['images']['tmp_name'][$i];
                $_FILES['userfile']['error']= $files['images']['error'][$i];
                $_FILES['userfile']['size']= $files['images']['size'][$i];

                $this->upload->initialize($config);
                $ext=$this->upload->data("file_ext");
                $this->upload->do_upload();
                $data["path"]='/assets/images/'.$db_path.'/'.$config['file_name'].$ext;
                if($type=="MailToUser"){
                $category_id=1;
                if($this->UploadProcess($db_id,$data["path"], $category_id,'')){
                    $deger=true;
                }
                }
            }
            
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           return false;
        }
         return $deger;     
   }
   
   
   private function UploadProcess($id=0,$path,$category_id,$tabledata="nodata"){
       
       if($category_id==1){
       $data=array();
       $data["mail_content_path"]=$path;
       $deger=$this->generalChangeProcess_model->updateTable("mail_content",$id,$data);
       return $deger;
       }
       
   }
   
  
}
