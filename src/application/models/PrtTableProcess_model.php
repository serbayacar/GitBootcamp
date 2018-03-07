<?php

//hi
defined('BASEPATH') OR exit('No direct script access allowed');

class prtTableProcess_model extends CI_Model
{

    // in prt_payment_type table, all records by all columns are retreived
    // by countrycode
    public function getPrtPaymentTypeAll($countrycode, $citycode)
    {
        $_countrycode = $countrycode;
        $this->db->select("*");
        $this->db->where("country_kd", $countrycode);
        $this->db->where("city_kd", $citycode);
        $sorgu = $this->db->get("prt_payment_type");
        return $sorgu->result_array();
    }

    // in prt_payment_type table, all records by all columns are retreived
    // by countrycode -only active records
    public function getPrtPaymentType($countrycode, $citycode)
    {
        $_countrycode = $countrycode;
        $this->db->select("*");
        $this->db->where("record_status", '1');
        $this->db->where("country_kd", $_countrycode);
        //$this->db->where("city_kd", $citycode);
        $sorgu = $this->db->get("prt_payment_type");
        return $sorgu->result_array();
    }

    public function getFirmProcessDetail($firm_id)
    {

        $_SQL = "select f.firm_id,r.record_process_txt,
        case when f.completed =0 then 'Not Completed' else 'Completed' end completed,
        case when f.get_status =0 then 'Not Taken' else 'Taken' end status
        from firm_record_process f inner join prt_firm_record_process r on f.record_process_id=r.record_process_id where f.firm_id=" . $firm_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }


    // in prt_process_types table, all records by all columns are retreived
    // by countrycode

    public function getPrtProcessTypeAll($countrycode, $citycode)
    {
        $_countrycode = $countrycode;
        $this->db->select("*");
        $this->db->where("country_kd", $_countrycode);
        $this->db->where("city_kd", $citycode);
        $sorgu = $this->db->get("prt_process_types");
        return $sorgu->result_array();
    }

    public function getregistryFee($countrycode, $citycode)
    {

        $this->db->select("record_amount");
        $this->db->where("country_kd", $countrycode);
        $this->db->where("city_kd", $citycode);
        $sorgu = $this->db->get("prt_general");
        return $sorgu->result_array();
    }

    // in prt_process_types table, all records by all columns are retreived
    // by countrycode only active records

    public function getPrtProcessType($countrycode, $citycode)
    {
        $_countrycode = $countrycode;
        $this->db->select("*");
        $this->db->where("record_status", '1');
        $this->db->where("country_kd", $_countrycode);
        $this->db->where("city_kd", $citycode);
        $sorgu = $this->db->get("prt_process_types");
        return $sorgu->result_array();
    }

    public function getPrtProcessTypebyGroupKd($countrycode, $citycode, $grupkd)
    {
        $_countrycode = $countrycode;
        $this->db->select("*");
        $this->db->where("record_status", '1');
        $this->db->where("gruptipi_id", $grupkd);
        $this->db->where("country_id", $_countrycode);
        $this->db->where("city_id", $citycode);
        $sorgu = $this->db->get("prt_process_types");
        return $sorgu->result_array();
    }

    public function getprtgeneralphotopackage($countrycode, $citycode)
    {
        $_countrycode = $countrycode;
        $this->db->select("*");
        $this->db->where("country_kd", $_countrycode);
        $this->db->where("city_kd", $citycode);
        $sorgu = $this->db->get("prt_generalphoto_package");
        return $sorgu->result_array();
    }

    public function getPrtProcessbyType($countrycode, $citycode, $type)
    {
        $_countrycode = $countrycode;
        $this->db->select("*");
        $this->db->where("gruptipi_id", $type);
        $this->db->where("record_status", '1');
        $this->db->where("country_kd", $_countrycode);
        $this->db->where("city_kd", $citycode);
        $sorgu = $this->db->get("prt_process_types");
        return $sorgu->result_array();
    }

    // in prt_user_grup table, all records by all columns are retreived
    // by country
    public function getPrtUserGroupbyCounty($countrycode)
    {
        $_countrycode = $countrycode;
        $this->db->select("*");
        //$this->db->where("record_status",'1');
        $this->db->where("country_kd", $_countrycode);
        $sorgu = $this->db->get("prt_user_grup");
        return $sorgu->result_array();
    }

    public function getPrtUserGroupbyCountryandCity($countrycode, $city)
    {
        $_countrycode = $countrycode;
        $this->db->select("*");
        //$this->db->where("record_status",'1');
        $this->db->where("country_kd", $_countrycode);
        $this->db->where("city_kd", $city);
        $sorgu = $this->db->get("prt_user_grup");
        return $sorgu->result_array();
    }


    public function getPrtGeneralEventPackagebyCity($countrycode, $citycode)
    {
        $_countrycode = $countrycode;
        $this->db->select("*");
        // $this->db->where("record_status",'1');
        $this->db->where("city_kd", $citycode);
        $this->db->where("country_kd", $_countrycode);
        $sorgu = $this->db->get("prt_generalevet_package");
        return $sorgu->result_array();
    }

    public function getPrtGeneralEventPackagebyPackageId($package_id)
    {

        $this->db->select("*");
        // $this->db->where("record_status",'1');
        $this->db->where("generalevent_package_id", $package_id);
        $sorgu = $this->db->get("prt_generalevet_package");
        return $sorgu->result_array();
    }

    public function getPrtGeneralUsagePackagebyCity($country_kd, $city_kd)
    {
        $_SQL = " SELECT `prt_usage_package_id`, `cost`, `explanation`, `package_name`, `country_kd`, `city_kd`, `usage_month`, `record_status`,
             `package_type`, `insert_user_id`, `insert_dt`, 
            `update_user_id`, `update_dt`, `usage_month`, `order_id` FROM `prt_usage_package` where country_kd=" . $country_kd . " and city_kd= " . $city_kd .
            " order by order_id";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }


    public function getPrtGeneralTicketPackagebyCity($countrycode, $citycode)
    {
        $_countrycode = $countrycode;
        $this->db->select("*");
        // $this->db->where("record_status",'1');
        $this->db->where("city_kd", $citycode);
        $this->db->where("country_kd", $_countrycode);
        $sorgu = $this->db->get("prt_generalticket_package");
        return $sorgu->result_array();
    }

    public function getPrtGeneralTicketPackagebyPackageId($package_id)
    {

        $this->db->select("*");
        // $this->db->where("record_status",'1');
        $this->db->where("ticket_pacage_id", $package_id);
        $sorgu = $this->db->get("prt_generalticket_package");
        return $sorgu->result_array();
    }
    //  insert to PrtLanguage table
    // in prtgeneral table, all records by all columns are retreived
    public function getPrtGeneralbyCity($countrycode, $citycode)
    {
        $_countrycode = $countrycode;
        $this->db->select("*");
        // $this->db->where("record_status",'1');
        $this->db->where("city_kd", $citycode);
        $this->db->where("country_kd", $_countrycode);
        $sorgu = $this->db->get("prt_general");
        return $sorgu->result_array();
    }

    //  insert to PrtLanguage table
    // in prtgeneral table, all records by all columns are retreived
    public function getPrtGeneral($countrycode)
    {
        $_countrycode = $countrycode;
        $this->db->select("*");
        // $this->db->where("record_status",'1');
        $this->db->where("country_kd", $_countrycode);
        $sorgu = $this->db->get("prt_general");
        return $sorgu->result_array();
    }
    //  insert to PrtLanguage table
    // in prt_serviceler table, all records by all columns are retreived
    // by language id ans servicegroup_id and active or passive records

    public function getPrtServicesAll($languageid, $servicegroup_id)
    {

        $this->db->select("*");
        $this->db->where("language_id", $languageid);
        $this->db->where("service_group_id", $servicegroup_id);
        $this->db->where("record_status", 1);
        $sorgu = $this->db->get("prt_subservices");
        return $sorgu->result_array();
    }

    public function getPrtSubServicesAll($languageid)
    {

        $this->db->select("*");
        $this->db->where("language_id", $languageid);
        $this->db->where("record_status", 1);
        $sorgu = $this->db->get("prt_subservices");
        return $sorgu->result_array();
    }

    // city table only active records are retreived
    public function getCitiesbyCountryCode($countrycode)
    {
        $this->db->select("city_kd ,Name ");
        $this->db->where("record_status", '1');
        $this->db->where("country_kd", $countrycode);
        $sorgu = $this->db->get("city");
        return $sorgu->result_array();
    }


    public function getDistrictbyCityCode($citycode)
    {
        $this->db->select("district_id,district");
        $this->db->where("record_status", '1');
        $this->db->where("city_id", $citycode);
        $sorgu = $this->db->get('district');
        return $sorgu->result_array();
    }

    public function getPrtServices($languageid, $servicegroup_id)
    {

        $this->db->select("*");
        $this->db->where("record_status", '1');
        $this->db->where("language_id", $languageid);
        $this->db->where("servicegroup_id", $servicegroup_id);
        $sorgu = $this->db->get("prt_serviceler");
        return $sorgu->result_array();
    }

    public function getAllServicebyGroupID($servicegroup_id)
    {

        $this->db->select("*");
        $this->db->where("servicegroup_id", $servicegroup_id);
        $sorgu = $this->db->get("prt_serviceler");
        return $sorgu->result_array();
    }

    public function getInvoiceCreateLanguagebyCountryandCity($countrycode, $citycode)
    {
        $_countrycode = $countrycode;
        $this->db->select("*");
        // $this->db->where("record_status",'1');
        $this->db->where("city_kd", $citycode);
        $this->db->where("country_kd", $_countrycode);
        $sorgu = $this->db->get("prt_invoice_create_language");
        return $sorgu->result_array();
    }

    public function getPortalLanguagebyCountryandCity($countrycode, $citycode)
    {
        $_countrycode = $countrycode;
        $this->db->select("*");
        // $this->db->where("record_status",'1');
        $this->db->where("city_kd", $citycode);
        $this->db->where("country_kd", $_countrycode);
        $sorgu = $this->db->get("prt_portal_language");
        return $sorgu->result_array();
    }

    public function getAllSubServicebyGroupID($subservicegroup_id)
    {

        $this->db->select("*");
        $this->db->where("subservice_group_id", $subservicegroup_id);
        $sorgu = $this->db->get("prt_subservices");
        return $sorgu->result_array();
    }

    public function getAllEventTypebyGroupID($eventTypegroup_id)
    {

        $this->db->select("*");
        $this->db->where("event_type_group_id", $eventTypegroup_id);
        $sorgu = $this->db->get("prt_event_types");
        return $sorgu->result_array();
    }

    public function getPrtEventCategoryNew()
    {

        $this->db->select("event_type_group_id event_category_id,event_type_group_txt name");
        $this->db->where("record_status", 1);
        $sorgu = $this->db->get("prt_event_type_groups");
        return $sorgu->result_array();
    }

    public function getPrtEventCategoryNew_Languages($dil)
    {


        $SQL = "SELECT et.event_type_group_id,et.language_id,et.prt_event_type_txt FROM `prt_event_types` et 
                inner join `prt_event_type_groups` etg on etg.record_status=1 and etg.event_type_group_id=et.event_type_group_id
                WHERE et.record_status=1 and et.language_id=" . $dil;
        $query = $this->db->query($SQL);
        return $query->result_array();

    }

    public function getPrtEventCategory()
    {

        $this->db->select("event_category_id,name");
        $this->db->where("record_status", 1);
        $sorgu = $this->db->get("event_category");
        return $sorgu->result_array();
    }

    public function getPrtTicketCategory()
    {

        $this->db->select("ticket_category_id,name");
        $this->db->where("record_status", 1);
        $sorgu = $this->db->get("ticket_category");
        return $sorgu->result_array();
    }

    public function getAllServicebyLanguageid($languageid)
    {

        $_SQL = "select psh.servicegroup_id,psh.service_name_txt from prt_serviceler psh where  psh.record_status=1 and psh.language_id=" . $languageid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    public function getAllServicebyLanguageidWithCategoryandSubServices($firmID, $languageid, $catID)
    {

        /*$_SQL = "select  ss.prt_subservice_id,ps.servicegroup_id,ps.service_name_txt,ss.subservice_name,sg.service_grup_txt
                from prt_serviceler ps
                inner join prt_service_group sg on sg.service_group_id=ps.servicegroup_id and sg.record_status=1
                left outer join prt_subservices ss on ss.record_status=1 and ss.service_group_id=ps.servicegroup_id
                where ps.record_status=1 and ps.language_id=".$languageid."
                oRDER BY `ps`.`service_name_txt` ASC";
        $_SQL = "select case when fs.firmservice_id is null then 0 else fs.firmservice_id end firmservice_id ,ss.service_group_id,ss.subservice_group_id,s.service_name_txt,ss.subservice_name
                  from prt_serviceler s
                  inner join prt_subservices ss on ss.service_group_id =s.servicegroup_id and ss.language_id=s.language_id and s.language_id=".$languageid." and s.record_status=1 and ss.record_status=1
                  inner join prt_service_group g on g.service_group_id=s.servicegroup_id and g.record_status=1 "; */

        $_SQL = "select case when fs.firmservice_id is null then 0 else fs.firmservice_id end firmservice_id ,ss.service_group_id,ss.subservice_group_id,s.service_name_txt,ss.subservice_name 
                  from prt_serviceler s 
                  inner join prt_subservices ss on ss.service_group_id =s.servicegroup_id and ss.language_id=s.language_id and s.language_id=" . $languageid . " and s.record_status=1 and ss.record_status=1 
                  inner join prt_service_group g on g.service_group_id=s.servicegroup_id and g.record_status=1 inner join prt_servicegroup_category sc on sc.record_status=1 and sc.prt_service_group_id=g.service_group_id 
                  ";

        if ($catID != "-1") {

            $catIDs = explode("-", $catID);

            $_SQL .= " and sc.prt_service_group_category in (";
            $first = 1;
            foreach ($catIDs as $value) {
                if ($first == 1) {
                    $_SQL .= $value;
                    $first = 0;
                } else {
                    $_SQL .= "," . $value;
                }
            }

            $_SQL .= ")";
        }

        /* $_SQL .=   " left outer join firm_service fs on fs.servicegroup_id=s.servicegroup_id and fs.subservice_id=ss.subservice_group_id and fs.record_status=1 and fs.firm_id=".$firmID."
               order by g.categori,ss.service_group_id,ss.subservice_name "; */
        $_SQL .= "  left outer join firm_service fs on fs.servicegroup_id=s.servicegroup_id and fs.subservice_id=ss.subservice_group_id and fs.record_status=1 and fs.firm_id=" . $firmID . "
                  order by sc.prt_service_group_category,sc.prt_service_group_id,ss.subservice_name ";


        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    public function getAllSubServicebyLanguageid($languageid)
    {

        $_SQL = "select ps.servicegroup_id,ps.service_name_txt,psub.subservice_group_id,psub.subservice_name 
            from prt_serviceler ps inner join prt_subservices psub on psub.service_group_id=ps.servicegroup_id and ps.language_id=" . $languageid . " and psub.language_id=" . $languageid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function getPrtInstallmentByCountryandCity($_countrycode, $citycode)
    {

        $this->db->select("*");
        // $this->db->where("record_status",'1');
        $this->db->where("city_kd", $citycode);
        $this->db->where("country_kd", $_countrycode);
        $sorgu = $this->db->get("prt_installment");
        return $sorgu->result_array();
    }

    function getPrtTranslateLanguageByCountryandCity($_countrycode, $citycode)
    {

        $this->db->select("*");
        // $this->db->where("record_status",'1');
        $this->db->where("city_kd", $citycode);
        $this->db->where("country_kd", $_countrycode);
        $sorgu = $this->db->get("prt_translate_languages");
        return $sorgu->result_array();
    }


    public function getPrtStatus($group_id)
    {

        $this->db->select("*");
        $this->db->where("record_status", '1');
        $this->db->where("prt_status_group", $group_id);
        $sorgu = $this->db->get("prt_status");
        return $sorgu->result_array();
    }

    public function getExplanationLanguages()
    {

        $_SQL = "SELECT l.language_id ,p.language_name_txt FROM  prt_translate_languages l inner join prt_language p on p.language_id=l.language_id
            and l.record_status=1";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    public function getInvoiceLanguages()
    {

        $_SQL = "SELECT l.language_id,p.language_name_txt FROM  prt_invoice_create_language l inner join prt_language p on p.language_id=l.language_id
            and l.record_status=1 and p.record_status=1";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    public function getBanks($country_kd, $city_kd)
    {

        $_SQL = "select * from prt_banks where city_kd= " . $city_kd . " and  country_kd=" . $country_kd;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    public function getTax($country_kd)
    {

        $_SQL = "select tax from prt_general where record_status=1 and country_kd=" . $country_kd;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    public function updateFirmProcess($firm_id, $record_process_id, $get_status, $completed)
    {
        $dateTime = date('Y-m-d H:i:s');

        $datafirm = array();
        $firm_id = $firm_id;
        $record_process_id = $record_process_id;
        $datafirm["completed"] = $completed;
        $datafirm["get_status"] = $get_status;
        $deger = true;
        try {

            $this->db->where('record_process_id', $record_process_id);
            $this->db->where('firm_id', $firm_id);
            $this->db->update('firm_record_process', $datafirm);

        } catch (Exception $e) {
            //alert the user.
            var_dump($e->getMessage());
            $deger = false;
        }

        return $deger;


    }

    function getAllInvoiceTypeByGroupID($invoiceGroup_id)
    {

        $this->db->select("*");
        $this->db->where("record_status", '1');
        $this->db->where("invoice_group_id", $invoiceGroup_id);
        $sorgu = $this->db->get("prt_invoice_type");
        return $sorgu->result_array();

    }


    function insertFirmProcess($_firm_id)
    {
        $user_id = $this->session->userdata('user_id');

        $_SQL = "insert into firm_record_process
        select 0," . $_firm_id . ",p.record_process_id,0,0," . $user_id . "," . $user_id . ",curdate(),curdate() from prt_firm_record_process p";

        $query = $this->db->query($_SQL);

    }

    function getPackagesType($lang_id)
    {

        $this->db->select("*");
        $this->db->where("record_status", '1');
        $this->db->where("lang_id", $lang_id);
        $sorgu = $this->db->get("prt_invoice_type");
        return $sorgu->result_array();

    }

    //  insert to PrtLanguage table
    public function getServiceType()
    {
        $this->db->select("prt_invoivegroup_id,name");
        $this->db->where("record_status", 1);
        $sorgu = $this->db->get("prt_invoivegroup");
        return $sorgu->result_array();
    }

    public function getLinkLanguages()
    {

        $_SQL = "SELECT l.language_id,p.language_name_txt FROM  prt_invoice_create_language l inner join prt_language p on p.language_id=l.language_id
            and l.record_status=1 and p.record_status=1";

        $query = $this->db->query($_SQL);
        return $query->result_array();


    }

    public function getFirmType()
    {
        $this->db->select("prt_firm_type_id,name_txt");
        $this->db->where("record_status", '1');

        $sorgu = $this->db->get("prt_firm_type");
        return $sorgu->result_array();
    }


    public function getLinkCategoryLanguageByGroupID($catGroupID)
    {

        $_SQL = "SELECT * FROM prt_link_categories_language plcl"
            . " WHERE plcl.record_status=1 and plcl.prt_link_categories_group_id=" . $catGroupID;

        $query = $this->db->query($_SQL);
        return $query->result_array();


    }

    public function getSubCategoryByCategoryGroupID($catGroupID)
    {

        $_SQL = "SELECT * FROM `prt_link_subcategories_group` "
            . "WHERE prt_link_categories_group_id=" . $catGroupID;

        $query = $this->db->query($_SQL);
        return $query->result_array();


    }

    public function getSubCategoryGroupsbyCatGroupID($catGroupID)
    {

        $_SQL = "SELECT * FROM `prt_link_subcategories_group` "
            . "WHERE prt_link_categories_group_id=" . $catGroupID;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    public function getSubCategoryGroupLanguageByCatAndSubCatID($subCatID)
    {
        $_SQL = "SELECT * FROM `prt_link_subcategories_language` "
            . "WHERE link_subcategories_group_id=" . $subCatID;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    public function getExplanationGroupsbyCategoryGroupID($subCatID)
    {
        $_SQL = "SELECT * FROM `prt_link_subexplanation` "
            . "where subcategory_group_id=" . $subCatID;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    public function getExplanationCrossBySubCategoryID($subCatID)
    {
        $_SQL = " SELECT se.prt_link_subexplanation_id, se.subcategory_group_id, se.prt_link_subexplanation_group_id,seg.explanation, se.record_status FROM prt_link_subexplanation se "
            . "inner join prt_link_subexplanation_group seg on seg.record_status and seg.prt_link_subexplanation_group_id=se.prt_link_subexplanation_group_id "
            . "WHERE  se.record_status=1 and se.subcategory_group_id=" . $subCatID;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }


    public function getSubExplanationGroupByCategoryID($subCatID)
    {
        $_SQL = "SELECT * FROM `prt_link_subexplanation` "
            . "WHERE `subcategory_group_id`=" . $subCatID;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    public function getExplanationGroupsLanguagebySubExplanationGroupID($id)
    {
        $_SQL = "SELECT * FROM `prt_link_subexplanation_language` "
            . "WHERE prt_link_subexplanation_id=" . $id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    public function getPrtSubExplanaitonGroupByCategoryID($id)
    {

        $this->db->select("prt_link_subcategories_group_id,link_subcategory_name");
        $this->db->where("prt_link_categories_group_id", $id);
        $this->db->where("record_status", 1);
        $sorgu = $this->db->get("prt_link_subcategories_group");
        return $sorgu->result_array();
    }

    public function subServicesWithServices($id)
    {
        $_SQL = "Select * from prt_subservis_group where service_group_id=" . $id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }


    public function getSubEventTypeWithEventCatID($id)
    {
        $_SQL = "SELECT `prt_event_subtypes_group_id`, `prt_event_types_group`, `subTypes_name`, `record_status` 
                  FROM `prt_event_subtypes_group`
                  WHERE prt_event_types_group=" . $id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    public function getSubCatEventLangTypeWithSubCatID($id)
    {

        $_SQL = "SELECT ps.prt_event_subtypes_id,ps.language_id,ps.subTypes_text,ps.record_status FROM prt_event_subtypes ps 
                    inner join prt_event_subtypes_group psg on psg.record_status=1 and psg.prt_event_subtypes_group_id=ps.prt_event_subtypes_group_id
                    WHERE ps.prt_event_types_group=" . $id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    public function getSubCategoryForEventWithCatGroupID($langID, $catGroupID)
    {

        $_SQL = "SELECT `prt_event_subtypes_id`, `prt_event_subtypes_group_id`, `prt_event_types_group`, `language_id`, `subTypes_text`"
            . " FROM `prt_event_subtypes` "
            . " WHERE `prt_event_subtypes_group_id` =" . $catGroupID . " and `language_id`=" . $langID . " and record_status=1";

        $query = $this->db->query($_SQL);
        return $query->result_array();

    }

    public function getGiftListforEvent()
    {

        $this->db->select("firm_event_gift_id,gift_explanation,record_status");
        $this->db->where("record_status", 1);
        $sorgu = $this->db->get("firm_event_gift");
        return $sorgu->result_array();
    }


    public function getGiftListforEventPrt()
    {

        $this->db->select("firm_event_gift_id,gift_explanation,record_status");
        $sorgu = $this->db->get("firm_event_gift");
        return $sorgu->result_array();
    }

    public function getGiftLanguageforEvent($id)
    {

        $_SQL = "SELECT `firm_event_gift_language_id`,`gift_id`,`gift_explanation`,`language_id`,`record_status` FROM `firm_event_gift_language` WHERE `record_status`=1 and `gift_id`=" . $id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    public function getDiscountListforEvent()
    {

        $this->db->select("firm_event_discount_id,discount_explanation,record_status");
        $this->db->where("record_status", 1);
        $sorgu = $this->db->get("firm_event_discount");
        return $sorgu->result_array();
    }

    public function getDiscountListforEventPrt()
    {

        $this->db->select("firm_event_discount_id,discount_explanation,record_status");
        $sorgu = $this->db->get("firm_event_discount");
        return $sorgu->result_array();
    }

    public function getDiscountLanguageforEvent($id)
    {

        $_SQL = "SELECT `firm_event_discount_language_id`, `discount_id`, `discount_explanation`, `language_id`, `record_status`FROM `firm_event_discount_language` WHERE `record_status`=1 and `discount_id`=" . $id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }



}

//serbay burada , ayse deneme



