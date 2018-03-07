<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class setFirmExplain_model extends CI_Model {

    //16, 'De', 112, true, true, 1523, 'ha', $id, $id
    public function  getLanguageWithName($country,$city){
        $_SQL= "SELECT * FROM `prt_language` INNER JOIN `prt_translate_languages` on `prt_translate_languages`.`record_status`=1 and `prt_language`.`record_status`=1 "
                . "WHERE `prt_language`.`language_id`= `prt_translate_languages`.`language_id` and prt_translate_languages.country_kd=".$country." and prt_translate_languages.city_kd=".$city;
    
        $query = $this->db->query($_SQL);
        return $query->result_array();
        
    }
    
}
