<?php defined('BASEPATH') OR exit('No direct script access allowed');
class logProcess_model extends CI_Model {


    //before changing data ,you can send id and table name, it is recored
    //on the your table's log table

    public function writeLog($tablename,$id){

        $deger=true;
        $tableid=getTableId($tablename);
        try {
               $this->db->select("*");
               $this->db->where($tableid,$id);
               $query=$this->db->get($tablename);
               if($query->num_rows()) {
                    $logtable_name=$tablename.'_log';
                    print_r($logtable_name);
                    $new_record = $query->result_array();

                     foreach ($new_record as $row => $record) {
                         $this->db->insert($logtable_name, $record);
                    }
               }

        }catch (Exception $e) {
          //alert the user.
           var_dump($e->getMessage());
           $deger=false;
         }

         return $deger;

    }
    public function getTableId($tablename)
    {
        $tableid="-";
        switch ($tablename) {
            case 'city':
                $tableid="city_kd";
                break;
            case 'connection':
                $tableid="connection_id";
                break;
            case 'countries':
                $tableid="country_kd";
                break;
            case 'country_city':
                $tableid="city_country_id";
                break;
            case 'district':
                $tableid="district_id";
                break;
            case 'firm':
                $tableid="firm_id";
                break;
            case 'firm_event':
                $tableid="firm_event_id";
                break;
            case 'firm_event_picture':
                $tableid="firm_event_picture_id";
                break;
            case 'firm_explanation':
                $tableid="firmexplanation_id";
                break;
            case 'firm_payment':
                $tableid="firm_payment_id";
                break;
            case 'firm_payment_muaf':
                $tableid="firm_payment_muaf_id";
                break;
            case 'firm_service':
                $tableid="firmservice_id";
                break;
            case 'firm_service_grup':
                $tableid="firm_service_grup_id";
                break;
            case 'firm_ticket_durumu':
                $tableid="ticket_id";
                break;
            case 'frm_ticket':
                $tableid="frm_ticket_id";
                break;
            case 'frm_ticket_durumu':
                $tableid="ticket_id";
                break;
            case 'frm_ticket_explanation':
                $tableid="ticket_id";
                break;
            case 'iletisim':
                $tableid="iletisim_id";
                break;
            case 'iletisim_tel':
                $tableid="iletisim_id";
                break;
            case 'menu':
                $tableid="menu_id";
                break;
            case 'menu_user':
                $tableid="menu_user_id";
                break;
            case 'menu_user_grup':
                $tableid="menu_user_group_id";
                break;
            case 'paids':
                $tableid="paid_id";
                break;
            case 'photos':
                $tableid="photo_id";
                break;
            case 'prt_country_lang':
                $tableid="country_lang_id";
                break;
            case 'prt_general':
                $tableid="prt_general_id";
                break;
            case 'prt_language':
                $tableid="language_id";
                break;
            case 'prt_payment_type':
                $tableid="payment_tip_id";
                break;
            case 'prt_picture':
                $tableid="photo_id";
                break;
            case 'prt_process_types':
                $tableid="processtype_id";
                break;
            case 'prt_serviceler':
                $tableid="service_id";
                break;
            case 'prt_service_group':
                $tableid="service_group_id";
                break;
            case 'prt_subservices':
                $tableid="prt_subservice_id";
                break;
            case 'prt_subservice_group':
                $tableid="subservice_group_id";
                break;
            case 'prt_user_grup':
                $tableid="group_id";
                break;
            case 'ticket_explanation':
                $tableid="ticket_explanation_id";
                break;
            case 'unusual':
                $tableid="unusual_id";
                break;
            case 'users':
                $tableid="user_id";
                break;
            case 'user_grup':
                $tableid="user_group_id";
                break;
            case 'web_payment':
                $tableid="webpayment_id";
                break;
            case 'web_process_history':
                $tableid="web_process_history_id";
                break;
            case 'firm_hours':
                $tableid="firm_hours_id";
                break;
            case 'firm_servicegiven_language':
                $tableid="servicegiven_language_id";
                break;
            case 'mail_content':
                $tableid="mail_content_id";
                break;
            case 'firm_event':
                $tableid="firm_event_id";
                break;
            case 'firm_event_language':
                $tableid="firmevent_lang_id";
                break;
            case 'firm_portal_usage':
                $tableid="firmportal_usage_id";
                break;
            case 'firm_ourservices':
                $tableid="firm_ourservices_id";
                break;
            case 'firm_ourservices_photos':
                $tableid="firm_ourservices_photos_id";
                break;
            case 'firm_explanation':
                $tableid="firmexplanation_id";
                break;
            case 'prt_generalevet_package':
                $tableid="generalevent_package_id";
                break;
            case 'prt_generalphoto_package':
                $tableid="photo_pacage_id";
                break;
            case 'prt_ticket_package':
                $tableid="prt_ticket_pacage";
                break;
            case 'firm_event_package':
                $tableid="firm_event_package_id";
                break;
            case 'firm_ticket_package':
                $tableid="firm_ticket_package_id";
                break;
            case 'firm_photo_package':
                $tableid="firm_photo_package_id";
                break;

            case 'frm_web_package':
                $tableid="frm_web_package_id";
                break;
            case 'prt_invoivegroup':
                $tableid="prt_invoivegroup_id";
                break;
            case 'prt_invoice_type':
                $tableid="prt_invoice_type_id";
                break;
            case 'invoice':
                $tableid="firm_invoice_id";
                break;
            case 'invoice_detail':
                $tableid="firm_invoice_detail_id";
                break;
            case 'payment':
                $tableid="firm_payment_id";
                break;
            case 'prt_currency':
                $tableid="prt_currency_id";
                break;
            case 'prt_sendtype':
                $tableid="prt_sendtype_id";
                break;
            case 'user_payment':
                $tableid="user_payment_id";
                break;
            case 'prt_userpayment_type':
                $tableid="prt_userpayment_type_id";
                break;
            case 'user_invoive':
                $tableid="user_invoive_id";
                break;
            case 'user_invoice_detail':
                $tableid="user_invoice_detail_id";
                break;
            case 'firm_ourservices_cost':
                $tableid="firm_ourservices_cost_id";
                break;
            case 'prt_usagetype':
                $tableid="prt_usagetype_id";
                break;
            case 'prt_status':
                $tableid="prt_status_id";
                break;

            case 'prt_status':
                $tableid="prt_status_id";
                break;
            case 'prt_usage_package':
                $tableid="prt_usage_package_id";
                break;
            case 'prt_event_type_groups':
                $tableid="event_type_group_id";
                break;
            case 'prt_event_types':
                $tableid="prt_event_types_id";
                break;

            case 'prt_translate_languages':
                $tableid="translate_languages_id";
                break;
            case 'prt_invoice_language':
                $tableid="language_id";
                break;
            case 'prt_firm_record_process':
                $tableid="record_process_id";
                break;
            case 'firm_record_process':
                $tableid="firm_record_process_id";
                break;
            case 'user_bank_account':
                $tableid="user_account_id";
                break;
            case 'menu_language':
                $tableid="menu_language_id";
                break;
            case 'phographer_delegate':
                $tableid="phographer_delegate_id";
                break;
            case 'all_mesage':
                $tableid="mesage_id";
                break;
            case 'unusal':
                $tableid="unusal_id";
                break;
            case 'pharmacy_dates':
                $tableid="apothe_dates_id";
                break;
            case 'firm_ticket_explanation':
                $tableid="ticket_explanation_id";
                break;
            case 'prt_subservis_group':
                $tableid="subservis_group_id";
                break;
            case 'prt_banks':
                $tableid="prt_banks_id";
                break;
            case 'prt_installment':
                $tableid="installment_id";
                break;
            case 'prt_invoice_create_language':
                $tableid="invoice_create_language_id";
                break;
            case 'prt_portal_language':
                $tableid="prt_portal_language_id";
                break;
            case 'prt_translate_languages':
                $tableid="translate_languages_id";
                break;
            case "firm_invoice_installment_detail";
               $tableid="invoice_installment_detail_id";
                break;
            case "firm_check_answer";
               $tableid="firm_check_answer_id";
                break;
              case "translater_delegate";
               $tableid="translater_delegate_id";
                break;
             case "test_log";
               $tableid="test_log_id";
                break;
            case "user_payment_detail";
               $tableid="user_payment_id";
                break;
            case "photographer_delegate";
                $tableid="phographer_delegate_id";
                break;
            case "firm_list_link";
                $tableid="firm_id";
                break;
            case "firm_link";
                $tableid="firm_link_id";
                break;
            case "firm_other";
                $tableid="firm_id";
                break;
            case "firmnotes";
                $tableid="firmNotes_id";
                break;
           case "invoice_real";
                $tableid="firm_invoice_id";
                break;
            case "prt_link_categories_group";
                $tableid="prt_link_categories_group_id";
                break;
            case "prt_link_categories_language";
                $tableid="prt_link_categories_language_id";
                break;
            case "prt_link_subcategories_group";
                $tableid="prt_link_subcategories_group_id";
                break;
            case "prt_link_subcategories_language";
                $tableid="prt_link_subcategories_lang_id";
                break;
            case "prt_link_subexplanation";
                $tableid="prt_link_subexplanation_id";
                break;
            case "prt_link_subexplanation_language";
                $tableid="prt_link_subexplanation_language_id";
                break;
            case "prt_link_tabtype";
                $tableid="prt_link_tabType_id";
                break;
            case "prt_link_subexplanation_group";
                $tableid="prt_link_subexplanation_group_id";
                break;
            case "link_counter";
                $tableid="key_id";
                break;
            case "prt_event_subtypes_group";
                $tableid="prt_event_subtypes_group_id";
                break;
            case "prt_event_subtypes";
              $tableid="prt_event_subtypes_id";
              break;
            case "firm_event_gift";
                $tableid="firm_event_gift_id";
                break;
            case "firm_event_discount";
                $tableid="firm_event_discount_id";
                break;
            case "firm_event_gift_language";
                $tableid="firm_event_gift_language_id";
                break;
            case "firm_event_discount_language";
                $tableid="firm_event_discount_language_id";
                break;

            default:
                echo "Hata";
                break;
        }
        return $tableid;
    }

}
