<?php

class firmLink_model extends CI_Model {

    function searchFirmLink ($firmnr, $firmNm,$district,$countkd,$city_kd){

        $_SQL = "SELECT distinct *
            FROM firm_other f 
            where  f.approved_status=0 ";

        if (!empty($firmnr)) {
            $_SQL = $_SQL . "  and  f.firm_id=" . $firmnr;
        }
        if (!empty($countkd)) {
            $_SQL = $_SQL . " and f.country_kd= " . $countkd;

        }
        if ($city_kd!="-1") {

            $_SQL = $_SQL . " and f.city_kd =" . $city_kd;
        }
        if ($district!="-1") {

            $_SQL = $_SQL . " and f.ort =" . $district;
        }
        if (!empty($firmNm)) {
            $_SQL = $_SQL . " and f.name_txt like " . "'%" . $firmNm . "%'";
        }
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function getFirmInfoByFirmIDForLink ($firmID){

        $_SQL = "  SELECT * FROM `firm_other` WHERE `firm_id`=".$firmID;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    
     function getFirmInfoByFirmIDForOther ($firmID){

        $_SQL = "  SELECT * FROM `firm_other` WHERE `firm_id`=".$firmID;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    
    function getAllLinkforControll (){

        $_SQL = "  SELECT firm_link_id,link FROM firm_link WHERE record_status=1";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function getAllLinkforControllByStatus ($status){

        $_SQL = " SELECT fl.firm_link_id,fl.link,fo.name_txt,fl.link_categori,fl.link_subcategory,fl.subexplanation_group_id,fl.start_dt,fl.expire_dt,fl.record_status
                  FROM firm_link fl 
                  inner join firm_other fo on fo.record_status=1 and fo.firm_id=fl.firm_id WHERE fl.record_status=".$status;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function getSubExplanationWithLangAndCatID($lang, $cat){

        $_SQL = "SELECT sl.prt_link_subexplanation_language_id,s.subcategory_group_id   subcategory_group_id,sl.explanation_text,
sl.prt_link_subexplanation_id FROM prt_link_subexplanation_language sl 
inner join prt_link_subexplanation s on s.prt_link_subexplanation_group_id=sl.prt_link_subexplanation_id "
                . "WHERE sl.record_status=1 and s.subcategory_group_id=".$cat ." and sl.language_id=".$lang ;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function getLinkCategories ($lang_id,$tabID){

        $_SQL = " SELECT lc.tab_group_id prt_link_categories_group_id ,l.link_category FROM prt_link_categories_group lc
                    inner join prt_link_categories_language l on l.record_status=1 and l.prt_link_categories_group_id=lc.tab_group_id and l.language_id=".$lang_id."   
         and  lc.tab_group_id in (select  c.category_id from link_counter c)          
                    WHERE lc.record_status=1 and lc.tab_id=".$tabID." 
                    order by l.link_category ";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
function getLinkCategories_link ($lang_id,$tabID){

        $_SQL = " SELECT lc.tab_group_id prt_link_categories_group_id ,l.link_category FROM prt_link_categories_group lc
                    inner join prt_link_categories_language l on l.record_status=1 and l.prt_link_categories_group_id=lc.tab_group_id and l.language_id=".$lang_id."   
                    WHERE lc.record_status=1 and lc.tab_id=".$tabID." 
                    order by l.link_category ";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    function getLinkServicesByLangAndCategory($lang,$category){
        $_SQL = " SELECT distinct sg.prt_link_categories_group_id,cl.link_category,sg.prt_link_subcategories_group_id,sl.subcategory_name"
                . " FROM prt_link_subcategories_language sl inner join prt_link_subcategories_group sg on sg.record_status=1 and sg.prt_link_subcategories_group_id=sl.link_subcategories_group_id and sl.language_id=".$lang
                . " inner join prt_link_categories_language cl on cl.record_status=1 and cl.prt_link_categories_group_id= sg.prt_link_categories_group_id and cl.language_id = sl.language_id "
                ."   inner join link_counter c on c.category_id=sg.prt_link_categories_group_id
                and c.subcategory_id=sg.prt_link_subcategories_group_id "
                . "WHERE sg.prt_link_categories_group_id in (";
        $first =0;
        foreach ($category as $value){

            if( $first==0){
                $_SQL .= $value;
                $first =1;
            }else{
                $_SQL .= ",".$value;
            }

        }
        $_SQL .= ") ";

        $_SQL .= " order by sl.subcategory_name";

        print_r($_SQL);
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    
    function getLinkServicesByLangAndCategory_linkAnother($lang,$category){
        $_SQL = " SELECT distinct sg.prt_link_categories_group_id,cl.link_category,sg.prt_link_subcategories_group_id,sl.subcategory_name"
                . " FROM prt_link_subcategories_language sl inner join prt_link_subcategories_group sg on sg.record_status=1 and sg.prt_link_subcategories_group_id=sl.link_subcategories_group_id and sl.language_id=".$lang
                . " inner join prt_link_categories_language cl on cl.record_status=1 and cl.prt_link_categories_group_id= sg.prt_link_categories_group_id and cl.language_id = sl.language_id "
                ."  WHERE sg.prt_link_categories_group_id in (";
        $first =0;
        foreach ($category as $value){

            if( $first==0){
                $_SQL .= $value;
                $first =1;
            }else{
                $_SQL .= ",".$value;
            }

        }
        $_SQL .= ") ";

        $_SQL .= " order by sl.subcategory_name";

        print_r($_SQL);
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    
    
function getLinkServicesByLangAndCategory_link($lang,$category){
        $_SQL = " SELECT distinct sg.prt_link_categories_group_id,cl.link_category,sg.prt_link_subcategories_group_id,sl.subcategory_name"
                . " FROM prt_link_subcategories_language sl inner join prt_link_subcategories_group sg on sg.record_status=1 and sg.prt_link_subcategories_group_id=sl.link_subcategories_group_id and sl.language_id=".$lang
                . " inner join prt_link_categories_language cl on cl.record_status=1 and cl.prt_link_categories_group_id= sg.prt_link_categories_group_id and cl.language_id = sl.language_id "
                ."  inner join link_counter c on c.category_id=cl.prt_link_categories_group_id
                    and c.subcategory_id=sg.prt_link_subcategories_group_id ".
                    "WHERE sg.prt_link_categories_group_id in (";
        $first =0;
        foreach ($category as $value){

            if( $first==0){
                $_SQL .= $value;
                $first =1;
            }else{
                $_SQL .= ",".$value;
            }

        }
        $_SQL .= ") ";

        $_SQL .= " order by sl.subcategory_name";

        print_r($_SQL);
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    function  getUrlsFirmID($firm_id){

        $_SQL = " SELECT fl.`firm_link_id`,fl.`firm_id`,fl.`link`,fl.`subexplanation_group_id`,sel.explanation_text,fl.`link_categori`,cl.link_category,cg.tab_id,fl.`link_subcategory`,sl.subcategory_name,
                fl.`start_dt`,
                fl.`expire_dt`,fl.`google_store`,fl.`apple_store`,fl.`lang_id`,fl.`multi_lang`,fl.`adress`,fl.`email`,fl.`phone`
                FROM `firm_link` fl 
                inner join prt_link_categories_group cg on cg.record_status=1 and cg.tab_group_id=fl.link_categori
                inner join prt_link_categories_language cl on cl.record_status=1 and cl.language_id=430 and cl.prt_link_categories_group_id=fl.link_categori
                inner join prt_link_subcategories_language sl on sl.record_status=1 and sl.link_subcategories_group_id=fl.link_subcategory and sl.language_id=430
                inner join prt_link_subexplanation_language sel on sel.record_status=1 and sel.prt_link_subexplanation_id=fl.subexplanation_group_id and sel.language_id=430
                WHERE fl.`record_status`=1 and fl.`firm_id`=".$firm_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();

    }
function  getUrlsBySiteID($siteID){

    $this->db->select('link');
    $this->db->where('firm_link_id',$siteID);
    $query = $this->db->get('firm_link');
    return $query->result_array();

    }

    
 function getCategorysByTabGroupID($tabID){
     
      $_SQL = " SELECT  `link_category_group`, `tab_id`, `tab_group_id`"
              . " FROM `prt_link_categories_group` "
              . "WHERE record_status=1 and tab_id=".$tabID;

        $query = $this->db->query($_SQL);
        return $query->result_array();
     
 } 
 
 
    function searchPrtLinkExplanation($text){

        $_SQL = " SELECT `prt_link_subexplanation_group_id`, `explanation`, `record_status` FROM `prt_link_subexplanation_group` WHERE `explanation` like  '%".$text."%'";

        $query = $this->db->query($_SQL);
        return $query->result_array();
        
    }
    
    function controllCounter($catID,$subCatID,$subExpID){
        
        $_SQL = " SELECT `key_id`, `category_id`, `subcategory_id`, `explanation_id`, `counter` FROM `link_counter`"
                . " WHERE `category_id`=".$catID." and `subcategory_id`=".$subCatID." and `explanation_id`=".$subExpID;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
 
}
