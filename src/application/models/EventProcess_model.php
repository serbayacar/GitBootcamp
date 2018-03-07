<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class eventProcess_model extends CI_Model {

    public function getFirmAllContactInfoByEventId($firmID) {


        $_SQL = "SELECT distinct f.firm_id,f.name_txt,i.email,i.ort,i.adress,i.email,i.facebook,i.instagram,i.twitter,it.phone,it.mobile_phone,it.fax
                    FROM firm_event fe 
                    inner join firm f on f.record_status=1 and f.firm_id=fe.firm_id
                    inner join iletisim i on i.record_status=1 and i.firm_id=f.firm_id
                    inner join iletisim_tel it on it.record_status=1 and i.iletisim_id=it.iletisim_id
                    WHERE fe.record_status=1 and  fe.firm_event_id=".$firmID;


        $query = $this->db->query($_SQL);
        return $query->result_array();
        //return $_SQL;
    }

    public function getHoursbyEventId($firmID)
    {

        $_SQL = "SELECT `firm_event_id`, `firm_id`, `start_dt`, `finish_dt`, `city_kd` `start_hour`, `end_hour`,`continues` FROM `firm_event` WHERE `record_status`=1 and `firm_event_id`=".$firmID;


        $query = $this->db->query($_SQL);
        return $query->result_array();
        //return $_SQL;

    }


    public function getPhotosbyEventId($firmID)
    {

        $_SQL = "SELECT e.firm_event_id, e.firm_id,ep.picturetipi_id,ep.path  FROM firm_event e
                inner join firm_event_picture ep on ep.record_status=1 and e.firm_event_id=ep.firm_event_id
                WHERE e.record_status=1 and e.firm_event_id=".$firmID;


        $query = $this->db->query($_SQL);
        return $query->result_array();
        //return $_SQL;

    }

    public function getEventExplanationssbyEventIdandLanguageID($firmID, $langID)
    {

        $_SQL = "SELECT fe.firm_id,fe.firm_event_id,fe.start_dt,fe.finish_dt,fe.start_hour,fe.end_hour,fel.firm_event_txt,fe.event_cat_id,fe.event_subCatID,fe.place,fe.district,fe.is_discount,fe.is_gift,fe.firm_event_gift_id,fe.firm_event_discount_id,f.name_txt,i.email,i.ort,i.email,i.facebook,i.instagram,i.twitter,it.phone,it.mobile_phone,it.fax
                FROM firm_event fe 
                inner join firm f on f.record_status=1 and f.firm_id=fe.firm_id
                inner join iletisim i on i.record_status=1 and i.firm_id=f.firm_id
                inner join iletisim_tel it on it.record_status=1 and i.iletisim_id=it.iletisim_id
                inner join firm_event_language fel on fel.record_status=1 and fel.firm_event_id=fe.firm_event_id and fel.language_id=".$langID." WHERE fe.record_status=1 and  fe.firm_event_id=".$firmID;


        $query = $this->db->query($_SQL);
        return $query->result_array();
        //return $_SQL;

    }

}
