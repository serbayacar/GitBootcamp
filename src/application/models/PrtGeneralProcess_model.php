<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class prtGeneralProcess_model extends CI_Model {

    // prt_picture table records are retreived
    public function getPrtTableAll($tablename) {
        $this->db->select("*");
        $sorgu = $this->db->get("$tablename");
        return $sorgu->result_array();
    }

    // prt_picture table only active records are retreived
    public function getPrtTable($tablename) {
        $this->db->select("*");
        $this->db->where("record_status", "1");
        $sorgu = $this->db->get($tablename);
        return $sorgu->result_array();
    }
      public function getAlllanguage() {
        $this->db->select("*");
        //$this->db->where("record_status", "1");
        $sorgu = $this->db->get("prt_language");
        return $sorgu->result_array();
    }
    

    // prt_picture table records are retreived for combobox usage
    // id,text
    public function getPrtTableForCombo($tablename) {

        $id = $this->getTableIdasid($tablename);
        $text = $this->getTableText($tablename);
        $selecttext = $id . ',' . $text;
        $this->db->select($selecttext);
        $sorgu = $this->db->get($tablename);
        $this->db->where("record_status", "1");
        return $sorgu->result_array();
    }

    public function getTableText($tablename) {
        $tabletext = "-";
        switch ($tablename) {
            case 'city':
                $tabletext = "city_kd value";
                break;
            case 'countries':
                $tabletext = "Name value";
                break;
            case 'district':
                $tabletext = "district value";
                break;
            case 'firm':
                $tableid = "name_txt value";
                break;
            case 'firm_explanation':
                $tabletext = "firm_txt value";
                break;
            case 'frm_ticket_explanation':
                $tabletext = "explanation value";
                break;
            case 'iletisim':
                $tabletext = "adress value";
                break;
            case 'iletisim_tel':
                $tabletext = "phone value";
                break;
            case 'menu':
                $tabletext = "menu_name_txt value";
                break;
            case 'menu_user':
                $tabletext = "menu_user'_id value";
                break;
            case 'prt_language':
                $tabletext = "language_name_txt value";
                break;

            // akın ekledi
            case 'prt_currency':
                $tabletext = "prt_currency_id value";
                break;
            case 'prt_currency':
                $tabletext = "name value";
                break;

            case 'prt_invoice_type':
                $tabletext = "prt_invoice_type_id value";
                break;
            case 'prt_invoice_type':
                $tabletext = "invoice_group_id value";
                break;
            case 'prt_invoice_type':
                $tabletext = "language_id value";
                break;
            case 'prt_invoice_type':
                $tabletext = "description value";
                break;


            case 'prt_invoivegroup':
                $tabletext = "prt_invoivegroup_id value";
                break;
            case 'prt_invoivegroup':
                $tabletext = "name value";
                break;


            case 'prt_payment_type':
                $tabletext = "payment_explanation_txt value";
                break;
            case 'prt_picture':
                $tabletext = "phototype_txt value";
                break;
            case 'prt_process_types':
                $tabletext = "processtype_txt value";
                break;
            case 'prt_serviceler':
                $tabletext = "service_name_txt value";
                break;
            case 'prt_service_group':
                $tabletext = "service_grup_txt value";
                break;
            case 'prt_subservices':
                $tabletext = "subservice_name value";
                break;
            case 'prt_subservice_group':
                $tabletext = "subservice_name value";
                break;
            case 'prt_user_grup':
                $tabletext = "group_name_txt value";
                break;
            case 'users':
                $tabletext = "concate(name,' ',surname) value";
                break;
            case 'web_process_history':
                $tabletext = "process_explanation_txt value";
                break;
            
            
            default:
                echo "Hata";
                break;
            
        }
        return $tabletext;
    }

    function getTableIdasid($tablename) {
        $tableid = "-";
        switch ($tablename) {
            case 'city':
                $tableid = "city_kd id";
                break;
            case 'connection':
                $tableid = "connection_id id";
                break;
            case 'countries':
                $tableid = "country_kd id";
                break;
            case 'country_city':
                $tableid = "city_country_id id";
                break;
            case 'district':
                $tableid = "district_id id";
                break;
            case 'firm':
                $tableid = "firm_id id";
                break;
            case 'firm_event':
                $tableid = "firm_event_id id";
                break;
            case 'firm_event_picture':
                $tableid = "firm_event_picture_id id";
                break;
            case 'firm_explanation':
                $tableid = "firmexplanation_id id";
                break;
            case 'firm_payment':
                $tableid = "firm_payment_id id";
                break;
            case 'firm_payment_muaf':
                $tableid = "firm_payment_muaf_id id";
                break;
            case 'firm_service':
                $tableid = "firmservice_id id";
                break;
            case 'firm_service_grup':
                $tableid = "firm_service_grup_id id";
                break;
            case 'firm_ticket_durumu':
                $tableid = "ticket_id id";
                break;
            case 'frm_ticket':
                $tableid = "frm_ticket_id id";
                break;
            case 'frm_ticket_durumu':
                $tableid = "ticket_id";
                break;
            case 'frm_ticket_explanation':
                $tableid = "ticket_id id";
                break;
            case 'iletisim':
                $tableid = "iletisim_id id";
                break;
            case 'iletisim_tel':
                $tableid = "iletisim_id id";
                break;
            case 'menu':
                $tableid = "menu_id id";
                break;
            case 'menu_user':
                $tableid = "menu_user'_id id";
                break;
            case 'menu_user_grup':
                $tableid = "menu_user_group_id id";
                break;
            case 'paids':
                $tableid = "paid_id  id";
                break;
            case 'photos':
                $tableid = "photo_id id";
                break;
            case 'prt_country_lang':
                $tableid = "country_lang_id id";
                break;
            case 'prt_general':
                $tableid = "prt_general_id id";
                break;
            case 'prt_language':
                $tableid = "language_id id";
                break;
            case 'prt_payment_type':
                $tableid = "payment_tip_id id";
                break;
            case 'prt_picture':
                $tableid = "photo_id id";
                break;
            case 'prt_process_types':
                $tableid = "processtype_id id";
                break;
            case 'prt_serviceler':
                $tableid = "service_id id";
                break;
            case 'prt_service_group':
                $tableid = "service_group_id id";
                break;
            case 'prt_subservices':
                $tableid = "prt_subservice_id id";
                break;
            case 'prt_subservice_group':
                $tableid = "subservice_group_id id";
                break;
            case 'prt_user_grup':
                $tableid = "group_id id";
                break;
            case 'ticket_explanation':
                $tableid = "ticket_explanation_id id";
                break;
            case 'unusual':
                $tableid = "unusual_id id";
                break;
            case 'users':
                $tableid = "user_id id";
                break;
            case 'user_grup':
                $tableid = "user_group_id id";
                break;
            case 'web_payment':
                $tableid = "webpayment_id id";
                break;
            case 'web_process_history':
                $tableid = "web_process_history_id id";
                break;
             case 'prt_currency':
                $tableid = "prt_currency_id id";
                break;
            default:
                echo "Hata";
                break;
        }

        return $tableid;
    }

}
