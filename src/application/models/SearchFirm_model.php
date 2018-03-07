<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SearchFirm_model extends CI_Model
{

    ///type 1 firm services ,2 events,3 discounts
    public function getCategorybyLangID($lang_id, $type)
    {

        $_SQL = "SELECT c.prt_categori_id,l.language_id,l.explanation_txt FROM prt_categori c
                inner join prt_categori_language l on c.prt_categori_id=l.category_id
                WHERE  c.record_status=1 and l.record_status=1 and l.language_id=" . $lang_id . " and c.cat_type=" . $type . " order by l.explanation_txt ";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    public function getAllServicesandSubservicesbyLangID($lang_id)
    {

        $_SQL = "Select s.servicegroup_id, ps.subservice_group_id, s.service_name_txt, ps.subservice_name from prt_serviceler s inner JOIN prt_subservices ps on ps.service_group_id=s.servicegroup_id and s.language_id= ps.language_id and s.record_status=1 and ps.record_status=1
                where s.language_id=" . $lang_id . " order BY s.service_name_txt, ps.subservice_name";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    public function getServicesbyCategoryandLangID($lang_id, $categories)
    {

        $_SQL = "
            Select s.servicegroup_id, ps.subservice_group_id, s.service_name_txt, ps.subservice_name, psc.prt_service_group_category 
            from prt_serviceler s 
            inner JOIN prt_subservices ps on ps.service_group_id=s.servicegroup_id and s.language_id=ps.language_id and s.record_status=1 and ps.record_status=1 
            inner join prt_service_group g on g.service_group_id=s.servicegroup_id inner join prt_servicegroup_category psc on psc.record_status=1 
            and psc.prt_service_group_id=g.service_group_id 
            where s.language_id= " . $lang_id . " and psc.prt_service_group_category in (";
        $first = 0;
        foreach ($categories as $category) {
            if ($first == 0) {
                $_SQL .= $category;
                $first = 1;
            } else {
                $_SQL .= "," . $category;
            }
        }
        $_SQL .= ") order BY s.service_name_txt, ps.subservice_name "; //, ps.subservice_name

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    public function getFirmsbySearch($countkd, $citykd, $district, $firmName, $searchlan, $servlang, $search_type, $servtext, $categories, $subservices, $inServices, $inFirm)
    {


        $_SQL = "Select DISTINCT f.firm_id,f.name_txt,f.firm_firstexplanation,f.firm_firstexplanation_lan,i.email,i.webpage,i.adress,t.phone,t.mobile_phone,e.firm_text,i.ort
                FROM firm f 
                inner join iletisim i on i.firm_id=f.firm_id and f.record_status=1  and i.record_status=1
                inner JOIN iletisim_tel t on t.iletisim_id=i.iletisim_id and t.record_status=1
                inner join firm_explanation e on e.firm_id=f.firm_id and e.record_status=1  and e.language_id=" . $searchlan . "

                inner join firm_servicegiven_language gl on gl.firm_id=f.firm_id and gl.record_status=1 
                inner join firm_service serv on serv.firm_id=f.firm_id and serv.record_status=1
                inner join prt_service_group servgr on servgr.service_group_id=serv.servicegroup_id 
                inner join prt_subservis_group sg on sg.subservis_group_id=serv.subservice_id and sg.record_status=1 and serv.servicegroup_id=sg.service_group_id 
                inner join prt_subservices psub on psub.language_id=430 and sg.service_group_id = psub.service_group_id 
                AND sg.subservis_group_id=psub.subservice_group_id
                inner join prt_serviceler pserv on pserv.servicegroup_id=serv.servicegroup_id  and pserv.record_status =1 
                inner join prt_servicegroup_category c on c.record_status=1 and c.prt_service_group_id=serv.servicegroup_id "; //and f.firm_id> ".$id." '

        $first_ort = 0;
        if (isset($district)) {

            foreach ($district as $value) {
                if ($value != 0) {
                    if ($first_ort == 0) {
                        $_SQL = $_SQL . " and i.ort in (" . $value; //ilçe
                        $first_ort = 1;
                    } else {
                        $_SQL = $_SQL . " , " . $value;
                    }
                }
            }
            if ($first_ort > 0)
                $_SQL = $_SQL . " ) ";
        }


        $first = 0;
        if (isset($servlang)) {
            foreach ($servlang as $value) {
                if ($value != 0) {
                    if ($first == 0) {
                        $_SQL = $_SQL . " and gl.language_id in (" . $value; // hangi dillerde hizmet almak istedigi
                        $first = 1;
                    } else {
                        $_SQL = $_SQL . " ," . $value;
                    }
                }
            }
            if ($first > 0)
                $_SQL = $_SQL . ") ";
        }

        if (isset($citykd)) {
            $_SQL = $_SQL . " and f.city_kd=" . $citykd;
        }
        if (isset($countkd)) {
            $_SQL = $_SQL . " and f.country_kd= " . $countkd;
        }
        if ($firmName != "0") {
            if (isset($firmName)) {
                $_SQL = $_SQL . " and f.name_txt like " . "'%" . $firmName . "%'";
            }
        }
        $_SQL = $_SQL . " and e.language_id =  " . $searchlan; //anasayfa dil

        if ($search_type == 1) { //By Text

            if (isset($servtext)) {
                $first = 0;

                if ($inServices == 1) {

                    foreach ($servtext as $text) {

                        if ($first == 0) {
                            $_SQL = $_SQL . " and ( pserv.service_name_txt like " . "'%" . $text . "%' ";
                            $_SQL = $_SQL . " or psub.subservice_name like " . "'%" . $text . "%' ";
                            $_SQL = $_SQL . " or psub.keywords like " . "'%" . $text . "%')";
                            $first == 1;
                        } else {
                            $_SQL = $_SQL . " or ( pserv.service_name_txt like " . "'%" . $text . "%'";
                            $_SQL = $_SQL . " or psub.subservice_name like " . "'%" . $text . "%' ";
                            $_SQL = $_SQL . " or psub.keywords like " . "'%" . $text . "%')";
                        }
                    }


                }

                $first = 0;

                if ($inFirm == 1) {
                    foreach ($servtext as $text) {

                        if ($first == 0) {
                            $_SQL = $_SQL . " and ( f.name_txt like " . "'%" . $text . "%')";

                            $first == 1;
                        } else {
                            $_SQL = $_SQL . " and ( f.name_txt like " . "'%" . $text . "%')";

                        }
                    }
                }


                /*   foreach ($servtext as $text) {

                       if ($first == 0) {
                           $_SQL = $_SQL . " and ( pserv.service_name_txt like " . "'%" . $text . "%'";
                           $_SQL = $_SQL . " or psub.subservice_name like " . "'%" . $text . "%'";
                           $_SQL = $_SQL . " or f.name_txt like " . "'%" . $text . "%')";
                           $first == 1;
                       } else {
                           $_SQL = $_SQL . " or ( pserv.service_name_txt like " . "'%" . $text . "%'";
                           $_SQL = $_SQL . " or psub.subservice_name like " . "'%" . $text . "%'";
                           $_SQL = $_SQL . " or f.name_txt like " . "'%" . $text . "%')";
                       }
                   } */
            }


        } else {  // ByCategory

            if (isset($categories)) {
                $first = 0;
                foreach ($categories as $value) {
                    if ($value != 0) {
                        if ($first == 0) {
                            $_SQL = $_SQL . " and c.prt_service_group_category in (" . $value;
                            $first = 1;
                        } else {
                            $_SQL = $_SQL . " ," . $value;
                        }
                    }
                }
                if ($first > 0)
                    $_SQL = $_SQL . ") ";

            }

            $first = 0;
            if (isset($subservices)) {
                foreach ($subservices as $value) {
                    if ($value != 0) {
                        if ($first == 0) {
                            $_SQL = $_SQL . "  and serv.subservice_id in (" . $value; // subservice id
                            $first = 1;
                        } else {
                            $_SQL = $_SQL . " ," . $value;
                        }
                    }
                }
                if ($first > 0)
                    $_SQL = $_SQL . " ) ";
            }

        }

        $_SQL = $_SQL . "  order by f.name_txt ";


        $query = $this->db->query($_SQL);
        return $query->result_array();
        //return $_SQL;
        //return $_SQL;
    }

    /*
    public function getEventsbySearch($countkd, $citykd, $district, $searchlan, $categories, $start_dt, $end_dt, $start_hour, $end_hour, $limit, $page) {


        $_SQL = "   SELECT e.start_dt,e.finish_dt,e.start_hour,e.end_hour,l.event_header,l.firm_event_txt,e.firm_event_id,
                    e.place,e.district
                    FROM firm_event e
                    inner join firm_event_language l on e.firm_event_id=l.firm_event_id and l.record_status=1
                    and l.language_id=" . $searchlan . "
                    WHERE e.record_status=1 and e.approved_status=1 and e.country_kd=" . $countkd . " and e.city_kd=" . $citykd . "
                     and e.start_dt>='" . $start_dt . "' and e.finish_dt<='" . $end_dt . "'";

        $first_ort = 0;
        if (isset($district)) {
            foreach ($district as $value) {
                if ($first_ort == 0) {
                    $_SQL = $_SQL . " and e.district in(" . $value;
                    $first_ort = 1;
                } else {
                    $_SQL = $_SQL . " , " . $value;
                }
            }
            if ($first_ort > 0)
                $_SQL = $_SQL . " ) ";
        }
        if (isset($start_hour)) {
            if (isset($end_hour)) {
                $_SQL = $_SQL . " and ( e.start_hour>='" . $start_hour . " or e.end_hour<='" . $end_hour . "'";
            } else {
                $_SQL = $_SQL . " and  e.start_hour>='" . $start_hour . "'";
            }
        }
        $first = 0;
        foreach ($categories as $value) {
            if ($first == 0) {
                $_SQL = $_SQL . " and e.event_cat_id in (" . $value;
                $first = 1;
            } else {
                $_SQL = $_SQL . " ," . $value;
            }
        }
        if ($first > 0)
            $_SQL = $_SQL . ") ";

        if ($page == 1) {
            $startid = 0;
        } else {
            $startid = $page * $limit;
            $startid = $startid + 1;
        }

        $_SQL = $_SQL . " limit " . $startid . "," . $limit;
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }


    */


    public function getEventsbySearch($searchLanID, $countkd, $citykd, $district, $catEventID, $subcatEventID, $from, $to)
    {

        $_SQL = " SELECT e.start_dt,e.finish_dt,e.start_hour,e.end_hour,l.event_header,l.firm_event_txt,e.firm_event_id,
                    e.place,e.district,f.name_txt,i.adress,it.phone,it.mobile_phone,e.firm_id,l.language_id,e.is_discount,e.is_gift,e.firm_event_gift_id,e.firm_event_discount_id
                    FROM firm_event e 
                    inner join firm_event_language l on e.firm_event_id=l.firm_event_id and l.record_status=1
                     inner join firm f on f.record_status=1 and f.firm_id=e.firm_id
                     inner join iletisim i on i.record_status=1 and i.firm_id=f.firm_id
                     inner join iletisim_tel it on it.iletisim_id=i.iletisim_id
                     inner join prt_event_type_groups etg on etg.record_status=1 and etg.event_type_group_id=e.event_cat_id
                     inner join prt_event_subtypes_group ets on ets.record_status=1 and ets.prt_event_subtypes_group_id=e.event_subCatID
                    
                    WHERE e.record_status=1 and e.approved_status=1 
                    
                    ";

        if ($countkd != "-1") {
            $_SQL .= " and e.country_kd=" . $countkd;
        }

        if ($citykd != "") {
            $_SQL .= " and e.city_kd=" . $citykd;
        }

        if ($district != "null") {
            $_SQL .= " and e.district=" . $district;
        }

        if ($catEventID != "") {
            $_SQL .= " and etg.event_type_group_id=" . $catEventID;
        }


        if ($subcatEventID != "") {
            $_SQL .= " and ets.prt_event_subtypes_group_id=" . $subcatEventID;
        }

        if ($from != "") {
            $_SQL .= " and e.start_dt>='" . $from . "'  ";
        }

        if ($to != "") {
            $_SQL .= " and e.finish_dt<='" . $to . "' ";
        }

        if ($searchLanID != "-1") {
            $_SQL .= " and l.language_id=" . $searchLanID;
        }

        //  and e.start_hour>='01:50' and e.end_hour<='".."'";
        //print_r($_SQL);
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }


    public function getDiscountsbySearch($countkd, $citykd, $district, $searchlan, $categories, $start_dt, $end_dt, $limit, $page)
    {


        $_SQL = "   SELECT e.ticket_start_dt,e.ticket_end_dt,l.explanation,e.ticket_id,e.firm_id,
                    e.place,e.district 
                    FROM firm_ticket_durumu e 
                    inner join firm_ticket_explanation l on e.ticket_id=l.ticket_id and l.record_status=1
                    and l.language_id=" . $searchlan . "
                    WHERE e.record_status=1 and e.approved_status=1 and e.country_kd=" . $countkd . " and e.city_kd=" . $citykd . "
                     and e.ticket_start_dt>='" . $start_dt . "' and e.ticket_end_dt<='" . $end_dt . "'";

        $first_ort = 0;
        if (isset($district)) {
            foreach ($district as $value) {
                if ($first_ort == 0) {
                    $_SQL = $_SQL . " and e.district in(" . $value;
                    $first_ort = 1;
                } else {
                    $_SQL = $_SQL . " , " . $value;
                }
            }
            if ($first_ort > 0)
                $_SQL = $_SQL . " ) ";
        }

        $first = 0;
        foreach ($categories as $value) {
            if ($first == 0) {
                $_SQL = $_SQL . " and e.ticket_cat_id in (" . $value;
                $first = 1;
            } else {
                $_SQL = $_SQL . " ," . $value;
            }
        }
        if ($first > 0)
            $_SQL = $_SQL . ") ";

        if ($page == 1) {
            $startid = 0;
        } else {
            $startid = $page * $limit;
            $startid = $startid + 1;
        }

        $_SQL = $_SQL . " limit " . $startid . "," . $limit;
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function getOurListServicesByCatID($langID, $categories)
    {
        /*  $_SQL = "select ps.servicegroup_id,ps.service_name_txt,psub.subservice_group_id,psub.subservice_name,sg.categori,cl.explanation_txt from prt_serviceler ps
   inner join prt_subservices psub on psub.service_group_id=ps.servicegroup_id and ps.language_id=430 and psub.language_id=430
   inner join prt_service_group sg on sg.record_status=1 and sg.service_group_id=psub.service_group_id
   inner join prt_categori_language cl on cl.category_id=sg.categori and cl.record_status=1 and cl.language_id=".$langID." and cl.category_id = ".$catID."
   order by ps.servicegroup_id,psub.service_group_id"; */

        $_SQL = "select distinct ps.servicegroup_id,ps.service_name_txt,psub.subservice_group_id,psub.subservice_name,psc.prt_service_group_category from prt_serviceler ps
                inner join prt_subservices psub on psub.service_group_id=ps.servicegroup_id and ps.language_id=psub.language_id and psub.language_id=" . $langID . "
                inner join prt_service_group sg on sg.record_status=1 and sg.service_group_id=psub.service_group_id
                inner join prt_servicegroup_category psc on psc.record_status =1 and sg.service_group_id=psc.prt_service_group_id and psc.prt_service_group_category in (";
        $first = 0;
        foreach ($categories as $value) {
            if ($first == 0) {
                $_SQL = $_SQL . $value;
                $first = 1;
            } else {
                $_SQL = $_SQL . " ," . $value;
            }
        }

        $_SQL .= ") order by ps.servicegroup_id,psub.service_group_id";

        $query = $this->db->query($_SQL);
        return $query->result_array();

    }

    function getOurListServicesSearch($lang_ID, $serviceGroupIDs, $subservicesIDs)
    {
        $_SQL = "Select DISTINCT f.firm_id,f.name_txt,i.adress,i.ort,t.phone,i.webpage,i.email,
                e.firm_text
                FROM firm f 
                inner join iletisim i on i.firm_id=f.firm_id and f.record_status=1  and i.record_status=1
                inner JOIN iletisim_tel t on t.iletisim_id=i.iletisim_id and t.record_status=1
                inner join firm_explanation e on e.firm_id=f.firm_id and e.record_status=1  and e.language_id=" . $lang_ID . "
                inner join firm_service serv on serv.firm_id=f.firm_id and serv.record_status=1 
                where f.approved_status=1 
				";
        //and serv.servicegroup_id in (1)  and serv. in (1,2)
        $serviceGroupIDs_s = array();
        $serviceGroupIDs_s = explode("-", $serviceGroupIDs);


        $subservicesIDs_s = array();
        $subservicesIDs_s = explode("-", $subservicesIDs);
        $first = 0;
        if (!empty($serviceGroupIDs_s)) {

            $_SQL .= " and serv.servicegroup_id in (";

            foreach ($serviceGroupIDs_s as $serviceGroupID) {
                if ($first == 0) {
                    $_SQL .= $serviceGroupID;
                    $first = 1;
                } else {
                    $_SQL .= "," . $serviceGroupID;
                }

            }


            $_SQL .= ")";
        }
        $first = 0;
        if (!empty($subservicesIDs_s)) {


            $_SQL .= " and serv.subservice_id in (";

            foreach ($subservicesIDs_s as $subservicesID) {
                if ($first == 0) {
                    $_SQL .= $subservicesID;
                    $first = 1;
                } else {
                    $_SQL .= "," . $subservicesID;
                }

            }

            $_SQL .= ")";
        }

        $query = $this->db->query($_SQL);

        return $query->result_array();

    }

    function searchForLink($cat, $ser, $app, $lang)
    {


        $_SQL = "  SELECT fl.firm_id,o.name_txt,fl.link,fl.link_categori,fl.link_subcategory,fl.start_dt,fl.expire_dt, fl.`google_store`,fl.`apple_store`,
                    CASE fl.`app` WHEN 1 THEN 'Yes'ELSE 'No' END as app_status ,sl.explanation_text, o.image_path,fl.adress,fl.email,fl.phone
                   FROM firm_link fl 
                   inner join prt_link_subexplanation_language sl on sl.prt_link_subexplanation_id=fl.subexplanation_group_id and sl.language_id=" . $lang . "
                   and fl.subexplanation_group_id=sl.prt_link_subexplanation_id
                   inner join firm_other o on o.firm_id=fl.firm_id and o.record_status=1 ";


        if ($app != "2") {

            $_SQL .= " and fl.`app`=" . $app;
        }

        if (isset($cat)) {
            $_SQL .= " and fl.link_categori in (";
            $first = 0;
            foreach ($cat as $value) {

                if ($first == 0) {
                    $_SQL .= $value;
                    $first = 1;
                } else {
                    $_SQL .= "," . $value;
                }

            }
            $_SQL .= ")";
        }

        if (isset($ser)) {
            $_SQL .= " and fl.link_subcategory in (";
            $first = 0;
            foreach ($ser as $value) {

                if ($first == 0) {
                    $_SQL .= $value;
                    $first = 1;
                } else {
                    $_SQL .= "," . $value;
                }

            }
            $_SQL .= ")";
        }
        $_SQL .= " order by sl.explanation_text";
        //print_r($_SQL);
        $query = $this->db->query($_SQL);
        return $query->result_array();

    }

    function getEmergencyWithLangID($lang)
    {


        $_SQL = "SELECT l.name,g.link_url,g.phone_number,g.image_path FROM emergengy_link_language l 
                inner join emergengy_link_group g on l.link_group_id=g.emergengy_link_group_id and l.language_id=" . $lang . "
                where g.record_status=1 and l.record_status=1
                order by l.name";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function getRandom10Links($lang)
    {

        $_SQL = "  
                    SELECT fl.firm_id,o.name_txt,fl.link,fl.link_categori,fl.link_subcategory,fl.start_dt,fl.expire_dt, fl.`google_store`,fl.`apple_store`,
                     CASE fl.`app` WHEN 1 THEN 'Yes'ELSE 'No' END as app_status ,sl.explanation_text, o.image_path,fl.adress,fl.email,fl.phone
                    FROM firm_link fl 
                    inner join prt_link_subexplanation_language sl on sl.prt_link_subexplanation_id=fl.subexplanation_group_id and sl.language_id=" . $lang . "
                    and fl.subexplanation_group_id=sl.prt_link_subexplanation_id
                    inner join firm_other o on o.firm_id=fl.firm_id and o.record_status=1 ORDER BY RAND() LIMIT 10";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function getFlowMessage($langID)
    {

        $_SQL = "SELECT bm.banner_message_id,bm.start_dt,bm.end_dt,bml.text_message FROM banner_message bm
                    inner join banner_message_language bml on bml.record_status=1 and bml.banner_message_id=bm.banner_message_id and bml.language_id=" . $langID . "
                    WHERE bm.record_status=1 and CURDATE() BETWEEN bm.start_dt AND bm.end_dt";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function getAboutDay_Event($countkd, $citykd, $day, $searchLanID)
    {
        $_SQL = " SELECT e.start_dt,e.finish_dt,e.start_hour,e.end_hour,l.event_header,l.firm_event_txt,e.firm_event_id,
                    e.place,e.district,f.name_txt,i.adress,it.phone,it.mobile_phone,e.firm_id,l.language_id
                    FROM firm_event e 
                    inner join firm_event_language l on e.firm_event_id=l.firm_event_id and l.record_status=1
                     inner join firm f on f.record_status=1 and f.firm_id=e.firm_id
                     inner join iletisim i on i.record_status=1 and i.firm_id=f.firm_id
                     inner join iletisim_tel it on it.iletisim_id=i.iletisim_id
                    WHERE e.record_status=1 and e.approved_status=1 ";

        if ($countkd != "-1") {
            $_SQL .= " and e.country_kd=" . $countkd;
        }

        if ($citykd != "") {
            $_SQL .= " and e.city_kd=" . $citykd;
        }


        if ($day != "") {
            $_SQL .= " and e.start_dt<='" . $day . "'  ";
        }

        if ($day != "") {
            $_SQL .= " and e.finish_dt>='" . $day . "' ";
        }

        if ($searchLanID != "-1") {
            $_SQL .= " and l.language_id=" . $searchLanID;
        }

        //  and e.start_hour>='01:50' and e.end_hour<='".."'";
        //print_r($_SQL);
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }


    function getAppWithLangID($lang)
    {
        $_SQL = "SELECT f.firm_link_id, f.firm_id, f.link, f.google_store, f.apple_store, fr.name_txt, c.link_category, d.subcategory_name, e.explanation_text
FROM firm_link f inner join firm fr on fr.firm_id=f.firm_id and f.record_status=1 and fr.record_status=1
inner join prt_link_categories_language c on f.link_categori=c.prt_link_categories_group_id and c.language_id=" . $lang . "
INNER JOIN prt_link_subcategories_language d on f.link_subcategory=d.link_subcategories_group_id and d.language_id=" . $lang . "
INNER JOIN prt_link_subexplanation_language e ON f.subexplanation_group_id=e.prt_link_subexplanation_id and e.language_id=" . $lang . "
WHERE f.app=1";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }


}
