<?php
class FirmNotes_model extends CI_Model {


    public function getFirmsbyFirmName($firmName,$adress,$district) {


        $_SQL = " SELECT * FROM `firmnotes` WHERE record_status=1";

        if(!empty($firmName)){
            $_SQL .= " and `firm_name` like '%".$firmName."%'";
        }
        if(!empty($adress)){
            $_SQL .= " and `adress` like '%".$adress."%'";
        }
        if($district!="-1"){
            $_SQL .= " and `district_kd`=".$district."";
        }


        $query = $this->db->query($_SQL);
        return $query->result_array();
        //return $_SQL;
    }

    public function getNotesWithFirmId($firm_id){
        $_SQL = " SELECT * FROM `firmnotes` WHERE firmNotes_id = ".$firm_id;


        $query = $this->db->query($_SQL);
        return $query->result_array();

    }

}
