<?php defined('BASEPATH') OR exit('No direct script access allowed');
class menuConfig_model extends CI_Model {

    function getMenuPages(){

        $_SQL = " SELECT m.menu_id,m.menu_name_txt,m.ust_menu_id,m.menu_url FROM menu m WHERE m.record_status=1 ";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function getUserGroups(){
        $_SQL = " SELECT g.group_id,g.grup_name_txt FROM prt_user_grup g WHERE g.record_status=1 ";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function getMenusforGroupID($group_id){  // Gruop ID ye göre seçili yada seçimsiz getiricek sql
        $_SQL = " SELECT m.menu_id,case when u.menu_user_id is null then 0 else u.menu_user_id end menu_user_id ,m.menu_name_txt FROM menu m left outer join menu_user u "
                . "on m.menu_id=u.menu_id and m.record_status=1 and u.record_status=1 and u.group_id=".$group_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();

    }

    function getUpMenus(){
        $_SQL = " SELECT m.menu_id,m.menu_name_txt  FROM menu m WHERE m.record_status=1 and m.ust_menu_id=0 ";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

}
