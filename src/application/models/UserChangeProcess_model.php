<?php
class userChangeProcess_model extends CI_Model {

    public function updateUserIletisim($user_id,$data)
   {
        
        $deger=true;
        try { 
             
             $this->db->where('user_id', $user_id);
             $this->db->where('record_status', 1);
             $this->db->update('iletisim', $data);
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
   public function updateUserBankAccount($user_id,$data)
   {
        
        $deger=true;
        try { 
             
             $this->db->where('user_id', $user_id);
             $this->db->where('record_status', 1);
             $this->db->update('user_bank_account', $data);
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
   public function updateUserPassword($user_id,$data)
   {
        
        $deger=true;
        try { 
             
             $this->db->where('user_id', $user_id);
             $this->db->where('record_status', 1);
             $this->db->update('users', $data);
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
    public function updateAvatarPath($user_id,$data)
    {
        
        $deger=true;
        try { 
             
             $this->db->where('user_id', $user_id);
             $this->db->where('record_status', 1);
             $this->db->update('photos', $data);
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
   public function updateiconPath($lan_id,$data)
    {
        
        $deger=true;
        try { 
             
             $this->db->where('language_id', $lan_id);
             $this->db->where('record_status', 1);
             $this->db->update('prt_language', $data);
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
    public function updateUserIletisimTel($iletisim_id,$data)
   {
        
        $deger=true;
        try { 
             
             $this->db->where('iletisim_id', $iletisim_id);
             $this->db->where('record_status', 1);
             $this->db->update('iletisim_tel', $data);
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
  public function updateUserAll($user_id,$iletisim_id,$datauser,$datailetisim,$datatel)
   {
        
        $deger=true;
        try { 
            
          
            $this->load->model("userChangeProcess_model");
            $this->load->model("userProcess_model");
            $result1= $this->generalChangeProcess_model->updateTable('users',$user_id, $datauser); 
            $result2= $this->updateUserIletisim($user_id, $datailetisim);      
            $result3= $this->updateUserIletisimTel($iletisim_id, $datatel); 
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }

       public function insertUserAll($datafirm,$datailetisim,$datailetisimtel)
   {
            $this->load->model("userChangeProcess_model");
            $this->load->model("userProcess_model");
        
        $_user_id=0;
        try { 
         
            //insert users table
            $_user_id= $this->generalChangeProcess_model->insertTables('users',$datafirm); 
            
            
            $datailetisim["user_id"]=$_user_id;
            $_iletisim_id= $this->generalChangeProcess_model->insertTables('iletisim',$datailetisim);  

            $this->updateUserIletisimId($_user_id,$_iletisim_id);
            
            $datailetisimtel["iletisim_id"]=$_iletisim_id;
            $_iletisimtel= $this->generalChangeProcess_model->insertTables('iletisim_tel',$datailetisimtel); 
            $user_id=$_user_id;
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           
         }
  
         return $_user_id;     
   }
   public function updateUserIletisimId($user_id,$iletisim_id)
   {
        
        $deger=true;
        try { 
            $data = array(
               'iletisim_id' => $iletisim_id               
            );
            $this->db->where('user_id', $user_id);
            $this->db->update('users', $data); 
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
   
    public function updateUserOldIletisim($user_id)
   {
        
        $deger=true;
        try { 
            $data = array(
               'record_status' => 0               
            );
            $this->db->where('user_id', $user_id);
            $this->db->update('iletisim', $data); 
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }
  
     public function updateUserGroup($user_id,$group_id,$record_status)
   {
        $dateTime = date('Y-m-d H:i:s');
        $deger=true;
        try { 
            $data = array(
               'record_status' => $record_status,
               'update_user_id' => $this->session->userdata('user_id'),
               'update_dt' => $dateTime
            );
            $this->db->where('user_id', $user_id);
            $this->db->where('group_id', $group_id);
            $this->db->update('user_grup', $data); 
             
        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }
  
         return $deger;     
   }       
    
    
}

