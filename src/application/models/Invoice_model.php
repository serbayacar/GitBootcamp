<?php defined('BASEPATH') OR exit('No direct script access allowed');

class invoice_model extends CI_Model
{


    function getfirminvoiceTotal($firm_id)
    {
        $_SQL = " select k.total grandtotal,  CAST(((k.total*k.tax)/100 ) AS DECIMAL(18,2)) tax ,CAST(((k.total- (k.total*k.tax)/100 )) AS DECIMAL(18,2)) total,
            k.total/1.2 netto from (
            SELECT SUM(c.amout) total, (select tax from prt_general where country_kd=f.country_kd and city_kd=f.city_kd) tax
            FROM firm_ourservices_cost c
                inner join firm f on f.firm_id=c.firm_id and f.record_status=1
            where c.firm_id=" . $firm_id . "  and c.create_invoice_status=0) k
                ";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function getfirminvoiceDetail($firm_id, $invoicegroup, $language_id)
    {
        $_SQL = "";
        if ($invoicegroup == 0) {
            $_SQL = "SELECT c.firm_ourservices_cost_id, c.firm_id, c.firm_portal_usage_id,  
               c.invoice_group_id, c.amout , c.pieces, c.muaf_status ,l.description name, 
               ul.description   package,pu.package_id package_id, null start_dt,null end_dt,0 supportstatus 
               FROM firm_ourservices_cost c 
               inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id 
               inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . "
               inner join firm_portal_usage pu on pu.firmportal_usage_id=c.firm_portal_usage_id
               inner join prt_usage_package_language ul on ul.lang_id=l.language_id and  ul.prt_usage_package_id=pu.package_id  and
               c.create_invoice_status=0 where c.invoice_group_id=5 
               and c.firm_id=" . $firm_id . "
                   
               union 
               SELECT c.firm_ourservices_cost_id, c.firm_id, c.firm_portal_usage_id, 
               c.invoice_group_id, c.amout , c.pieces, c.muaf_status ,l.description name, 
               'Standard'  package,0 package_id, null start_dt,null end_dt,0 supportstatus 
               FROM firm_ourservices_cost c 
               inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id   
               inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . " and
               c.create_invoice_status=0 where c.firm_id=" . $firm_id . " and c.invoice_group_id=11 
               union
               SELECT c.firm_ourservices_cost_id, 
               c.firm_id, c.firm_portal_usage_id, c.invoice_group_id, c.amout, c.pieces, c.muaf_status , 
               epl.description name, 
               l.description   package,
               pep.generalevent_package_id   evet_package_id,null ,null,o.support_package_status 
               FROM firm_ourservices_cost c 
               inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id 
               and c.create_invoice_status=0 
               inner join firm_event_package o on o.firm_id=c.firm_id and o.ourservice_cost_id=c.firm_ourservices_cost_id 
               inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . "
               inner join prt_generalevet_package pep on pep.generalevent_package_id=o.evet_package_id
               inner join prt_generalevet_package_language epl on epl.generalevent_package_id=pep.generalevent_package_id and epl.language_id=" . $language_id . "
               where c.firm_id=" . $firm_id . " and c.invoice_group_id=1
               UNION
                SELECT c.firm_ourservices_cost_id, c.firm_id, c.firm_portal_usage_id, c.invoice_group_id, 
               c.amout, c.pieces, c.muaf_status ,  epl.description name, 
               l.description   package,o.ticket_package_id    ticket_pacage_id,null,null,o.support_package_status 
               FROM firm_ourservices_cost c 
               inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id and 
               c.create_invoice_status=0 
               inner join firm_ticket_package o on o.firm_id=c.firm_id and o.ourservice_cost_id=c.firm_ourservices_cost_id 
                 inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . "
               inner join prt_generalticket_package pep on pep.ticket_pacage_id=o.ticket_package_id
               inner join prt_generalticket_package_language epl on epl.generalticket_package_id=pep.ticket_pacage_id and epl.language_id=" . $language_id . "  
               where c.firm_id=" . $firm_id . "
               and c.invoice_group_id=2  
               
               UNION SELECT c.firm_ourservices_cost_id, c.firm_id, c.firm_portal_usage_id,  c.invoice_group_id,
               c.amout, c.pieces, c.muaf_status , 
               epl.description name, 
               l.description   package,
               o.photo_package_id,
               null,null,o.photo_status
               FROM firm_ourservices_cost c 
               inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id and  
               c.create_invoice_status=0 
               inner join firm_photo_package o on o.firm_id=c.firm_id and o.ourservice_cost_id=c.firm_ourservices_cost_id 
               inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . "
               inner join prt_generalphoto_package ep on ep.photo_pacage_id=o.photo_package_id
               inner join prt_generalphoto_package_language epl on epl.generalphoto_package_id=o.photo_package_id and epl.language_id=" . $language_id . " 
               where c.firm_id=" . $firm_id . "
               and c.invoice_group_id=4 
               UNION
                SELECT c.firm_ourservices_cost_id, c.firm_id, c.firm_portal_usage_id, c.invoice_group_id, o.amount amout, 
               c.pieces, c.muaf_status ,l.description name, 
               'Standatd'  package,
               0,null,null,o.muaf_status
               FROM firm_ourservices_cost c 
               inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id 
               and c.muaf_status=0 and c.create_invoice_status=0 and c.record_status=1 
                inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . "
               inner join frm_web_package o on o.firm_id=c.firm_id 
               and o.ourservice_cost_id=c.firm_ourservices_cost_id and o.record_status=1  where c.firm_id=" . $firm_id . " and c.invoice_group_id=3
               
               
               
               ";
        } else {
            $first = 0;
            foreach ($invoicegroup as $id) {

                if (trim($id) == 5) {
                    if ($first == 0) {
                        $_SQL = "SELECT c.firm_ourservices_cost_id, c.firm_id, c.firm_portal_usage_id,  
                    c.invoice_group_id, c.amout , c.pieces, c.muaf_status ,l.description name, 
                    ul.description   package,pu.package_id package_id, null start_dt,null end_dt,0 supportstatus 
                    FROM firm_ourservices_cost c 
                    inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id 
                    inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . "
                    inner join firm_portal_usage pu on pu.firmportal_usage_id=c.firm_portal_usage_id
                    inner join prt_usage_package_language ul on ul.lang_id=l.language_id and  ul.prt_usage_package_id=pu.package_id  and
                    c.create_invoice_status=0 where c.invoice_group_id=5 
                    and c.firm_id=" . $firm_id;
                        $first = 1;
                        $txt = "modelde 5 e girdi";
                        $this->test_log($txt);
                        $this->test_log($_SQL);
                    } else {
                        $_SQL = $_SQL . " union SELECT c.firm_ourservices_cost_id, c.firm_id, c.firm_portal_usage_id,  
                        c.invoice_group_id, c.amout , c.pieces, c.muaf_status ,l.description name, 
                        ul.description   package,pu.package_id package_id, null start_dt,null end_dt,0 supportstatus 
                        FROM firm_ourservices_cost c 
                        inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id 
                        inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . "
                        inner join firm_portal_usage pu on pu.firmportal_usage_id=c.firm_portal_usage_id
                        inner join prt_usage_package_language ul on ul.lang_id=l.language_id and  ul.prt_usage_package_id=pu.package_id  and
                        c.create_invoice_status=0 where c.invoice_group_id=5 
                        and c.firm_id=" . $firm_id;
                    }
                }
                if ($id == 11) {
                    $txt = "modelde 11 e girdi";
                    $this->test_log($txt);
                    if ($first == 1) {
                        $_SQL = $_SQL . " union SELECT c.firm_ourservices_cost_id, c.firm_id, c.firm_portal_usage_id, 
                        c.invoice_group_id, c.amout , c.pieces, c.muaf_status ,l.description name, 
                        'Standard'  package,0 package_id, null start_dt,null end_dt,0 supportstatus 
                        FROM firm_ourservices_cost c 
                        inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id   
                        inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . " and
                        c.create_invoice_status=0 where c.firm_id=" . $firm_id . " and c.invoice_group_id=11 ";
                        $txt = "modelde 11 1 e girdi";
                        $this->test_log($_SQL);
                    } else {
                        $_SQL = " SELECT c.firm_ourservices_cost_id, c.firm_id, c.firm_portal_usage_id, 
                        c.invoice_group_id, c.amout , c.pieces, c.muaf_status ,l.description name, 
                        'Standard'  package,0 package_id, null start_dt,null end_dt,0 supportstatus 
                        FROM firm_ourservices_cost c 
                        inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id   
                        inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . " and
                        c.create_invoice_status=0 where c.firm_id=" . $firm_id . " and c.invoice_group_id=11 ";
                        $first = 1;
                        $txt = "modelde 11 2 e girdi";
                        $this->test_log($_SQL);
                    }

                }
                if ($id == 1) {
                    if ($first == 1) {
                        $_SQL = $_SQL . " union sELECT c.firm_ourservices_cost_id, 
                                c.firm_id, c.firm_portal_usage_id, c.invoice_group_id, c.amout, c.pieces, c.muaf_status , 
                                epl.description name, 
                                l.description   package,
                                pep.generalevent_package_id   package_id,null ,null,o.support_package_status 
                                FROM firm_ourservices_cost c 
                                inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id 
                                and c.create_invoice_status=0 
                                inner join firm_event_package o on o.firm_id=c.firm_id and o.ourservice_cost_id=c.firm_ourservices_cost_id 
                                inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . "
                                inner join prt_generalevet_package pep on pep.generalevent_package_id=o.evet_package_id
                                inner join prt_generalevet_package_language epl on epl.generalevent_package_id=pep.generalevent_package_id and epl.language_id=" . $language_id . "
                                where c.firm_id=" . $firm_id . " and c.invoice_group_id=1
                           ";
                        $txt = "modelde 1 1 e girdi";
                        $this->test_log($txt);
                        $this->test_log($_SQL);
                    } else {
                        $_SQL = "  SELECT c.firm_ourservices_cost_id, 
                             c.firm_id, c.firm_portal_usage_id, c.invoice_group_id, c.amout, c.pieces, c.muaf_status , 
                             epl.description name, 
                             l.description   package,
                             pep.generalevent_package_id   package_id,null ,null,o.support_package_status 
                             FROM firm_ourservices_cost c 
                             inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id 
                             and c.create_invoice_status=0 
                             inner join firm_event_package o on o.firm_id=c.firm_id and o.ourservice_cost_id=c.firm_ourservices_cost_id 
                             inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . "
                             inner join prt_generalevet_package pep on pep.generalevent_package_id=o.evet_package_id
                             inner join prt_generalevet_package_language epl on epl.generalevent_package_id=pep.generalevent_package_id and epl.language_id=" . $language_id . "
                             where c.firm_id=" . $firm_id . " and c.invoice_group_id=1
                              ";
                        $first = 1;
                        $txt = "modelde 1 2 e girdi";
                        $this->test_log($txt);
                        $this->test_log($_SQL);
                    }
                }
                if ($id == 2) {
                    if ($first == 1) {
                        $_SQL = $_SQL . " union SELECT c.firm_ourservices_cost_id, c.firm_id, c.firm_portal_usage_id, c.invoice_group_id, 
                              c.amout, c.pieces, c.muaf_status ,  epl.description name, 
                              l.description   package,o.ticket_package_id    package_id,null,null,o.support_package_status 
                              FROM firm_ourservices_cost c 
                              inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id and 
                              c.create_invoice_status=0 
                              inner join firm_ticket_package o on o.firm_id=c.firm_id and o.ourservice_cost_id=c.firm_ourservices_cost_id 
                                inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . "
                              inner join prt_generalticket_package pep on pep.ticket_pacage_id=o.ticket_package_id
                              inner join prt_generalticket_package_language epl on epl.generalticket_package_id=pep.ticket_pacage_id and epl.language_id=" . $language_id . "  
                              where c.firm_id=" . $firm_id . "
                              and c.invoice_group_id=2 ";
                        $txt = "modelde 2 1 e girdi";
                        $this->test_log($txt);
                        $this->test_log($_SQL);

                    } else {
                        $_SQL = " SELECT c.firm_ourservices_cost_id, c.firm_id, c.firm_portal_usage_id, c.invoice_group_id, 
                              c.amout, c.pieces, c.muaf_status ,  epl.description name, 
                              l.description   package,o.ticket_package_id    package_id,null,null,o.support_package_status 
                              FROM firm_ourservices_cost c 
                              inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id and 
                              c.create_invoice_status=0 
                              inner join firm_ticket_package o on o.firm_id=c.firm_id and o.ourservice_cost_id=c.firm_ourservices_cost_id 
                                inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . "
                              inner join prt_generalticket_package pep on pep.ticket_pacage_id=o.ticket_package_id
                              inner join prt_generalticket_package_language epl on epl.generalticket_package_id=pep.ticket_pacage_id and epl.language_id=" . $language_id . "  
                              where c.firm_id=" . $firm_id . "
                              and c.invoice_group_id=2 ";
                        $first = 1;
                        $txt = "modelde 2 2 e girdi";
                        $this->test_log($txt);
                        $this->test_log($_SQL);
                    }

                }
                if ($id == 4) {
                    if ($first == 1) {
                        $_SQL = $_SQL . " union SELECT c.firm_ourservices_cost_id, c.firm_id, c.firm_portal_usage_id,  c.invoice_group_id,
                        c.amout, c.pieces, c.muaf_status , 
                        epl.description name, 
                        l.description   package,
                        o.photo_package_id package_id,
                        null,null,o.photo_status
                        FROM firm_ourservices_cost c 
                        inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id and  
                        c.create_invoice_status=0 
                        inner join firm_photo_package o on o.firm_id=c.firm_id and o.ourservice_cost_id=c.firm_ourservices_cost_id 
                        inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . "
                        inner join prt_generalphoto_package ep on ep.photo_pacage_id=o.photo_package_id
                        inner join prt_generalphoto_package_language epl on epl.generalphoto_package_id=o.photo_package_id and epl.language_id=" . $language_id . " 
                        where c.firm_id=" . $firm_id . "
                        and c.invoice_group_id=4 ";
                        $txt = "modelde 4 1 e girdi";
                        $this->test_log($txt);
                        $this->test_log($_SQL);
                    } else {
                        $_SQL = "  SELECT c.firm_ourservices_cost_id, c.firm_id, c.firm_portal_usage_id,  c.invoice_group_id,
                            c.amout, c.pieces, c.muaf_status , 
                            epl.description name, 
                            l.description   package,
                            o.photo_package_id package_id,
                            null,null,o.photo_status
                            FROM firm_ourservices_cost c 
                            inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id and  
                            c.create_invoice_status=0 
                            inner join firm_photo_package o on o.firm_id=c.firm_id and o.ourservice_cost_id=c.firm_ourservices_cost_id 
                            inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . "
                            inner join prt_generalphoto_package ep on ep.photo_pacage_id=o.photo_package_id
                            inner join prt_generalphoto_package_language epl on epl.generalphoto_package_id=o.photo_package_id and epl.language_id=" . $language_id . " 
                            where c.firm_id=" . $firm_id . "
                            and c.invoice_group_id=4 ";
                        $first = 1;
                        $txt = "modelde 4 2 e girdi";
                        $this->test_log($txt);
                        $this->test_log($_SQL);
                    }
                }

                if ($id == 3) {
                    if ($first == 1) {
                        $_SQL = $_SQL . "  union SELECT c.firm_ourservices_cost_id, c.firm_id, c.firm_portal_usage_id,  c.invoice_group_id,
                        c.amout, c.pieces, c.muaf_status , 
                        epl.description name, 
                        l.description   package,
                        o.photo_package_id package_id,
                        null,null,o.photo_status
                        FROM firm_ourservices_cost c 
                        inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id and  
                        c.create_invoice_status=0 
                        inner join firm_photo_package o on o.firm_id=c.firm_id and o.ourservice_cost_id=c.firm_ourservices_cost_id 
                        inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . "
                        inner join prt_generalphoto_package ep on ep.photo_pacage_id=o.photo_package_id
                        inner join prt_generalphoto_package_language epl on epl.generalphoto_package_id=o.photo_package_id and epl.language_id=" . $language_id . " 
                        where c.firm_id=" . $firm_id . "
                        and c.invoice_group_id=4 ";
                    } else {
                        $_SQL = " SELECT c.firm_ourservices_cost_id, c.firm_id, c.firm_portal_usage_id, c.invoice_group_id, o.amount amout, 
                           c.pieces, c.muaf_status ,l.description name, 
                           'Standatd'  package,
                           0,null ,o.firm_web_package_id package_id,o.muaf_status
                           FROM firm_ourservices_cost c 
                           inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id 
                           and c.muaf_status=0 and c.create_invoice_status=0 and c.record_status=1 
                            inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . "
                           inner join frm_web_package o on o.firm_id=c.firm_id 
                           and o.ourservice_cost_id=c.firm_ourservices_cost_id and o.record_status=1  where c.firm_id=" . $firm_id . " and c.invoice_group_id=3";
                        $first = 1;
                    }
                }


            }
        }
        //print_r($_SQL);
        //$txt=$_SQL   ;
        //$this->test_log($txt);
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function getfirminvoiceDetailbyNotUsage($firm_id, $invoicegroup, $language_id)
    {
        $_SQL = "";
        if ($invoicegroup == 0) {
            $_SQL =
                " 
               SELECT c.firm_ourservices_cost_id, c.firm_id, c.firm_portal_usage_id, 
               c.invoice_group_id, c.amout , c.pieces, c.muaf_status ,l.description name, 
               'Standard'  package,0 package_id, null start_dt,null end_dt,0 supportstatus 
               FROM firm_ourservices_cost c 
               inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id   
               inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . " and
               c.create_invoice_status=0 where c.firm_id=" . $firm_id . " and c.invoice_group_id=11 
               union
                 SELECT c.firm_ourservices_cost_id, 
               c.firm_id, c.firm_portal_usage_id, c.invoice_group_id, c.amout, c.pieces, c.muaf_status , 
               epl.description name, 
               l.description   package,
               pep.generalevent_package_id   evet_package_id,null ,null,o.support_package_status 
               FROM firm_ourservices_cost c 
               inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id 
               and c.create_invoice_status=0 
               inner join firm_event_package o on o.firm_id=c.firm_id and o.ourservice_cost_id=c.firm_ourservices_cost_id 
               inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . "
               inner join prt_generalevet_package pep on pep.generalevent_package_id=o.evet_package_id
               inner join prt_generalevet_package_language epl on epl.generalevent_package_id=pep.generalevent_package_id and epl.language_id=" . $language_id . "
               where c.firm_id=" . $firm_id . " and c.invoice_group_id=1
               UNION
                SELECT c.firm_ourservices_cost_id, c.firm_id, c.firm_portal_usage_id, c.invoice_group_id, 
               c.amout, c.pieces, c.muaf_status ,  epl.description name, 
               l.description   package,o.ticket_package_id    ticket_pacage_id,null,null,o.support_package_status 
               FROM firm_ourservices_cost c 
               inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id and 
               c.create_invoice_status=0 
               inner join firm_ticket_package o on o.firm_id=c.firm_id and o.ourservice_cost_id=c.firm_ourservices_cost_id 
                 inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . "
               inner join prt_generalticket_package pep on pep.ticket_pacage_id=o.ticket_package_id
               inner join prt_generalticket_package_language epl on epl.generalticket_package_id=pep.ticket_pacage_id and epl.language_id=" . $language_id . "  
               where c.firm_id=" . $firm_id . "
               and c.invoice_group_id=2  
               
               UNION SELECT c.firm_ourservices_cost_id, c.firm_id, c.firm_portal_usage_id,  c.invoice_group_id,
               c.amout, c.pieces, c.muaf_status , 
               epl.description name, 
               l.description   package,
               o.photo_package_id,
               null,null,o.photo_status
               FROM firm_ourservices_cost c 
               inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id and  
               c.create_invoice_status=0 
               inner join firm_photo_package o on o.firm_id=c.firm_id and o.ourservice_cost_id=c.firm_ourservices_cost_id 
               inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . "
               inner join prt_generalphoto_package ep on ep.photo_pacage_id=o.photo_package_id
               inner join prt_generalphoto_package_language epl on epl.generalphoto_package_id=o.photo_package_id and epl.language_id=" . $language_id . " 
               where c.firm_id=" . $firm_id . "
               and c.invoice_group_id=4 
               UNION
                SELECT c.firm_ourservices_cost_id, c.firm_id, c.firm_portal_usage_id, c.invoice_group_id, o.amount, 
               c.pieces, c.muaf_status ,l.description name, 
               'Standatd'  package,
               0,null,null,o.muaf_status
               FROM firm_ourservices_cost c 
               inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id 
               and c.muaf_status=0 and c.create_invoice_status=0 and c.record_status=1 
                inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . "
               inner join frm_web_package o on o.firm_id=c.firm_id 
               and o.ourservice_cost_id=c.firm_ourservices_cost_id and o.record_status=1  where c.firm_id=" . $firm_id . " and c.invoice_group_id=3
               
               
               
               ";
        } else {

            foreach ($invoicegroup as $id) {
                if ($id == 11)
                    $_SQL = $_SQL . " SELECT c.firm_ourservices_cost_id, c.firm_id, c.firm_portal_usage_id, 
               c.invoice_group_id, c.amout , c.pieces, c.muaf_status ,l.description name, 
               'Standard'  package,0 package_id, null start_dt,null end_dt,0 supportstatus 
               FROM firm_ourservices_cost c 
               inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id   
               inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . " and
               c.create_invoice_status=0 where c.firm_id=" . $firm_id . " and c.invoice_group_id=11 ";

                if ($id == 1)
                    $_SQL = $_SQL . "  union 
                SELECT c.firm_ourservices_cost_id, 
               c.firm_id, c.firm_portal_usage_id, c.invoice_group_id, c.amout, c.pieces, c.muaf_status , 
               epl.description name, 
               l.description   package,
               pep.generalevent_package_id   evet_package_id,null ,null,o.support_package_status 
               FROM firm_ourservices_cost c 
               inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id 
               and c.create_invoice_status=0 
               inner join firm_event_package o on o.firm_id=c.firm_id and o.ourservice_cost_id=c.firm_ourservices_cost_id 
               inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . "
               inner join prt_generalevet_package pep on pep.generalevent_package_id=o.evet_package_id
               inner join prt_generalevet_package_language epl on epl.generalevent_package_id=pep.generalevent_package_id and epl.language_id=" . $language_id . "
               where c.firm_id=" . $firm_id . " and c.invoice_group_id=1
               ";


                if ($id == 2)
                    $_SQL = $_SQL . " union 
                 SELECT c.firm_ourservices_cost_id, c.firm_id, c.firm_portal_usage_id, c.invoice_group_id, 
               c.amout, c.pieces, c.muaf_status ,  epl.description name, 
               l.description   package,o.ticket_package_id    ticket_pacage_id,null,null,o.support_package_status 
               FROM firm_ourservices_cost c 
               inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id and 
               c.create_invoice_status=0 
               inner join firm_ticket_package o on o.firm_id=c.firm_id and o.ourservice_cost_id=c.firm_ourservices_cost_id 
                 inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . "
               inner join prt_generalticket_package pep on pep.ticket_pacage_id=o.ticket_package_id
               inner join prt_generalticket_package_language epl on epl.generalticket_package_id=pep.ticket_pacage_id and epl.language_id=" . $language_id . "  
               where c.firm_id=" . $firm_id . "
               and c.invoice_group_id=2    ";

                if ($id == 4)
                    $_SQL = $_SQL . "  union SELECT c.firm_ourservices_cost_id, c.firm_id, c.firm_portal_usage_id,  c.invoice_group_id,
               c.amout, c.pieces, c.muaf_status , 
               epl.description name, 
               l.description   package,
               o.photo_package_id,
               null,null,o.photo_status
               FROM firm_ourservices_cost c 
               inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id and  
               c.create_invoice_status=0 
               inner join firm_photo_package o on o.firm_id=c.firm_id and o.ourservice_cost_id=c.firm_ourservices_cost_id 
               inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . "
               inner join prt_generalphoto_package ep on ep.photo_pacage_id=o.photo_package_id
               inner join prt_generalphoto_package_language epl on epl.generalphoto_package_id=o.photo_package_id and epl.language_id=" . $language_id . " 
               where c.firm_id=" . $firm_id . "
               and c.invoice_group_id=4 ";

                if ($id == 3)
                    $_SQL = $_SQL . "  union 
                SELECT c.firm_ourservices_cost_id, c.firm_id, c.firm_portal_usage_id, c.invoice_group_id, o.amount, 
               c.pieces, c.muaf_status ,l.description name, 
               'Standatd'  package,
               0,null,null,o.muaf_status
               FROM firm_ourservices_cost c 
               inner join prt_invoivegroup g on g.prt_invoivegroup_id=c.invoice_group_id 
               and c.muaf_status=0 and c.create_invoice_status=0 and c.record_status=1 
                inner join prt_invoice_language l on l.invoice_group_id=g.prt_invoivegroup_id and l.language_id=" . $language_id . "
               inner join frm_web_package o on o.firm_id=c.firm_id 
               and o.ourservice_cost_id=c.firm_ourservices_cost_id and o.record_status=1  where c.firm_id=" . $firm_id . " and c.invoice_group_id=3";

            }
        }

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function getCretaeInvoice($invoice_id)
    {
        /*
        SELECT i.firm_invoice_id, i.firm_id, i.invoice_dt, i.user_id, i.language_id, i.invoice_sendtype_id, i.paid_status, i.currency_kd, i.firm_adress, i.name, i.net, i.tax, i.country_kd,
                i.city_kd, i.prepayment_status, i.amount, i.pre_payment_amount, i.record_status,i.invoice_no,i.invoice_path,f.tax_num,f.vat_num FROM invoice i
                inner join firm f on f.firm_id=i.firm_id and f.record_status=1
                WHERE i.record_status=1 and i.firm_invoice_id=9
        */

        /*
        "SELECT `firm_invoice_id`, `firm_id`, `invoice_dt`, `user_id`, `language_id`, `invoice_sendtype_id`, `paid_status`, `currency_kd`, `firm_adress`, `name`, `net`, `tax`, `country_kd`,
                `city_kd`, `prepayment_status`, `amount`, `pre_payment_amount`, `record_status`,invoice_no,invoice_path FROM `invoice` WHERE record_status=1 and firm_invoice_id=
        */
        $_SQL = " SELECT i.firm_invoice_id, i.firm_id, i.invoice_dt, i.user_id, i.language_id, i.invoice_sendtype_id, i.paid_status, i.currency_kd, i.firm_adress, i.name, i.net, i.tax, i.country_kd,
                i.city_kd, i.prepayment_status, i.amount, i.pre_payment_amount, i.record_status,i.invoice_no,i.invoice_path,f.tax_num,f.vat_num FROM invoice i
                inner join firm f on f.firm_id=i.firm_id and f.record_status=1
                WHERE i.record_status=1 and i.firm_invoice_id=" . $invoice_id;
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function getCretaeInvoiceOther($invoice_id)
    {
        /*
        SELECT i.firm_invoice_id, i.firm_id, i.invoice_dt, i.user_id, i.language_id, i.invoice_sendtype_id, i.paid_status, i.currency_kd, i.firm_adress, i.name, i.net, i.tax, i.country_kd,
                i.city_kd, i.prepayment_status, i.amount, i.pre_payment_amount, i.record_status,i.invoice_no,i.invoice_path,f.tax_num,f.vat_num FROM invoice i
                inner join firm f on f.firm_id=i.firm_id and f.record_status=1
                WHERE i.record_status=1 and i.firm_invoice_id=9
        */

        /*
        "SELECT `firm_invoice_id`, `firm_id`, `invoice_dt`, `user_id`, `language_id`, `invoice_sendtype_id`, `paid_status`, `currency_kd`, `firm_adress`, `name`, `net`, `tax`, `country_kd`,
                `city_kd`, `prepayment_status`, `amount`, `pre_payment_amount`, `record_status`,invoice_no,invoice_path FROM `invoice` WHERE record_status=1 and firm_invoice_id=
        */
        $_SQL = "SELECT i.firm_invoice_id, i.firm_id, i.invoice_dt, i.user_id, i.language_id, i.invoice_sendtype_id, i.paid_status, i.currency_kd, i.firm_adress, i.name, i.net, i.tax, i.country_kd,
                i.city_kd, i.prepayment_status, i.amount, i.pre_payment_amount, i.record_status,i.invoice_no,i.invoice_path,f.tax_num,f.vat_num FROM invoice i
                inner join firm_other f on f.firm_id=i.firm_id and f.record_status=1 and f.firm_type=2 
                inner join invoice_real r on r.record_status=1 and r.invoice_copy_id=i.firm_invoice_id
                WHERE i.record_status=1 and r.firm_invoice_id=" . $invoice_id;
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function getInstallmentDetailWithInvoiceID($invoice_id)
    {
        $_SQL = " SELECT fid.invoice_installment_detail_id,fid.instalment_date,fid.instalment_amount,fid.payment_status,fid.ref_number"
            . " FROM firm_invoice_installment_detail fid "
            . " WHERE fid.record_status=1 and fid.invoice_id=" . $invoice_id;
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function getInstallmentDetailWithInvoiceIDOther($invoice_id)
    {
        $_SQL = " SELECT fid.invoice_installment_detail_id,fid.instalment_date,fid.instalment_amount,fid.payment_status,fid.ref_number"
            . " FROM firm_invoice_installment_detail fid "
            . " WHERE fid.record_status=1 and fid.real_invoice_id=" . $invoice_id;
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function getInstallments($invoice_id)
    {
        $_SQL = "SELECT d.invoice_installment_detail_id, d.invoice_installment_id, d.invoice_id, d.instalment_no, d.instalment_date, "
            . " d.instalment_amount, d.payment_status FROM  firm_invoice_installment_detail d "
            . "WHERE d.invoice_id=1=" . $invoice_id;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function getFirmOurServices($id)
    {
        $_SQL = "SELECT `firm_ourservices_id`, `firm_id`, `event_package_id`, `event_package_pieces`, `event_status`, `event_start_dt`, `event_end_dt`, `event_support_status`, `ticket_package_id`, `ticket_packet_pieces`, `ticket_status`, `ticket_start_dt`, `ticket_end_dt`, `ticket_support_status`, `photo_count`, `photographer_status`, `web_status`, `web_meeting_date`, `insert_user_id`, `insert_dt`, `update_user_id`, `update_dt`, `approved_user_id`, `approved_dt`, `approved_status`, `record_status`, `photo_package_id` "
            . "FROM `firm_ourservices` where firm_ourservices_id=" . $id;
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    public function updateInvoiceDetailbyRealId($invoice_id, $realinvoice_id)
    {

        $deger = true;
        try {
            $data = array(
                'real_invoice_id' => $realinvoice_id
            );
            $this->db->where('firm_invoice_id', $invoice_id);
            $this->db->update('invoice_detail', $data);

        } catch (Exception $e) {
            //alert the user.
            var_dump($e->getMessage());
            $deger = false;
        }

        return $deger;
    }

    public function updateInstallmentbyRealId($invoice_id, $realinvoice_id)
    {

        $deger = true;
        try {
            $data = array(
                'real_invoice_id' => $realinvoice_id
            );
            $this->db->where('invoice_id', $invoice_id);
            $this->db->update('firm_invoice_installment', $data);

        } catch (Exception $e) {
            //alert the user.
            var_dump($e->getMessage());
            $deger = false;
        }

        return $deger;
    }

    public function updateInstallmentDetailbyRealId($invoice_id, $realinvoice_id)
    {

        $deger = true;
        try {
            $data = array(
                'real_invoice_id' => $realinvoice_id
            );
            $this->db->where('invoice_id', $invoice_id);
            $this->db->update('firm_invoice_installment_detail', $data);

        } catch (Exception $e) {
            //alert the user.
            var_dump($e->getMessage());
            $deger = false;
        }

        return $deger;
    }

    function getCopyInvoice($id)
    {
        $_SQL = "SELECT `firm_invoice_id`, `firm_id`, `firm_type`, "
            . "`invoice_dt`, `user_id`, `language_id`, "
            . "`invoice_sendtype_id`, `paid_status`, `currency_kd`, "
            . "`firm_adress`, `name`, `net`, `tax`, "
            . "`country_kd`, `city_kd`, `prepayment_status`, "
            . "`invoice_no`, `invoice_path`, `amount`, `pre_payment_amount`, "
            . "`record_status`, `insert_user_id`, `update_user_id`, "
            . "`insert_dt`, `update_dt` FROM `invoice` where firm_invoice_id=" . $id;
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function getCretaeInvoiceDetail($invoice_id)
    {
        $_SQL = "SELECT `firm_invoice_detail_id`, `firm_invoice_id`, `ourservice_cost_id`, "
            . "`invoice_group_id`, `description`, `amount`, `pieces`, `record_status`, `package_id`, `package_name` FROM `invoice_detail` WHERE firm_invoice_id=" . $invoice_id;
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function getCretaeInvoiceDetailOther($invoice_id)
    {
        $_SQL = "SELECT `firm_invoice_detail_id`, `firm_invoice_id`, `ourservice_cost_id`, "
            . "`invoice_group_id`, `description`, `amount`, `pieces`, `record_status`, `package_id`, `package_name` FROM `invoice_detail` WHERE real_invoice_id=" . $invoice_id;
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function ourfirm_account_info($country_kd)
    {
        $_SQL = "SELECT * "
            . "FROM `ourfirm_account_info` where record_status=1 and related_country_kd=" . $country_kd;
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function getCretaeInvoiceTotal($invoice_id)
    {
        $_SQL = "  SELECT sum(d.amount) grandtotal,i.tax,i.net,sum(d.amount)-tax as subtotal from invoice_detail d inner join invoice i on i.firm_invoice_id=d.firm_invoice_id 
                WHERE d.firm_invoice_id=" . $invoice_id;
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function getCretaeInvoiceTotalOther($invoice_id)
    {
        $_SQL = "  SELECT sum(d.amount) grandtotal,i.tax,i.net,sum(d.amount)-tax as subtotal from invoice_detail d inner join invoice i on i.firm_invoice_id=d.firm_invoice_id 
                WHERE d.real_invoice_id=" . $invoice_id;
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function updateOurCost($firm_id, $ourservice_cost_id, $invoice_group)
    {
        $deger = true;
        try {

            $dateTime = date('Y-m-d H:i:s');
            $data = array();
            $data["create_invoice_status"] = 1;
            $data["update_user_id"] = $this->session->userdata('user_id');
            $data["update_dt"] = $dateTime;

            $this->db->where('firm_id', $firm_id);
            $this->db->where('firm_ourservices_cost_id', $ourservice_cost_id);
            $this->db->where('invoice_group_id', $invoice_group);
            $this->db->where('record_status', 1);
            $this->db->update('firm_ourservices_cost', $data);


            /* if($invoice_group==1)//event
             {
                    $dataevent=array();
                    $dataevent["create_invoice_status"]=1;
                    $dataevent["update_user_id"]=$this->session->userdata('user_id');
                    $dataevent["update_dt"]= $dateTime;
                    $dataevent["approve"]=$this->session->userdata('user_id');
                    $dataevent["update_dt"]= $dateTime;

                    $this->db->where('firm_id', $firm_id);
                    $this->db->where('firm_ourservices_cost_id', $ourservice_cost_id);
                    $this->db->where('invoice_group_id', $invoice_group);
                    $this->db->where('record_status', 1);
                    $this->db->update('firm_ourservices_cost', $data);


             }*/

        } catch (Exception $e) {
            //alert the user.
            var_dump($e->getMessage());
            $deger = false;
        }

        return $deger;
    }

    function createInvoicePage($invoice_id, $lang_id)
    {
        if ($lang_id == 112) { // English
            $data["invoicedetails"] = $this->invoice_model->getCretaeInvoiceDetail($invoice_id);

            $data["invoice"] = $this->invoice_model->getCretaeInvoice($invoice_id);

            $related_country_kd = $data["invoice"][0]["country_kd"];
            $data["ourfirm"] = $this->invoice_model->ourfirm_account_info($related_country_kd);
            $data["totalinvoice"] = $this->invoice_model->getCretaeInvoiceTotal($invoice_id);
            $data["installmentdetails"] = $this->invoice_model->getInstallmentDetailWithInvoiceID($invoice_id);


            $invoiceText = "<div class=\"portlet box red\">
                            <div class=\"portlet-title\">
                                <div class=\"caption\"> <i class=\"fa fa-cogs\"></i>Invoice </div>
                                <div class=\"tools\"> <a href=\"javascript:;\" class=\"collapse\"> </a> <a href=\"javascript:;\" class=\"reload\"> </a> </div>
                            </div>
                            <div class=\"portlet-body\">
                               <div class=\"table-responsive\">
                                    <div class=\"invoice\">
                                        <div class=\"row invoice-logo\">
                                            <div class=\"col-xs-4 invoice-logo-space\"> <img src=\"" . base_url() . "/assets/_/logo.jpg " . "\" class=\"img-responsive\" alt=\"\" /> </div>
                                            <div class=\"col-xs-4\">
                                                <h3><p><span class=\"muted\"> Rechnung </span> </p></h3>
                                                <p>Invoice Number:";
            if (isset($data["invoice"][0]["firm_invoice_id"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["invoice_no"];

            }
            $invoiceText = $invoiceText . "</p>
                                                <p> Invoice Date : ";

            if (isset($data["invoice"][0]["invoice_dt"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["invoice_dt"];
            }
            $invoiceText = $invoiceText . " </p>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-4\">
                                                <h3>Client:</h3>
                                                <ul class=\"list-unstyled\">
                                                    <li> ";
            if (isset($data["invoice"][0]["name"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["name"];

            }
            $invoiceText = $invoiceText .
                "</li>
                                                    <li>";
            if (isset($data["invoice"][0]["adress"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["adress"];
            }

            $invoiceText = $invoiceText . " </li>                                                  
                                                </ul>
                                            </div>
                                            <div class=\"col-xs-4\">
                                                
                                                <ul class=\"list-unstyled\">
                                                    <h3><li> Pickyfy Services Invoice </li></h3>
                                                    
                                                </ul>
                                            </div>
                                         
                                            <div class=\"col-xs-4 invoice-payment\">
                                                <h3>Payment Details:</h3>
                                                <ul class=\"list-unstyled\">
                                                    <li> <strong>V.A.T Reg #:</strong>";
            if (isset($data["ourfirm"][0]["taxregisterno"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["taxregisterno"];
            }
            $invoiceText = $invoiceText . " </li>
                                                    <li> <strong>Account Name:</strong> ";
            if (isset($data["ourfirm"][0]["account_name"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["account_name"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>SWIFT code:</strong> ";
            if (isset($data["ourfirm"][0]["swift_kd"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["swift_kd"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>Firm Name:</strong>";
            if (isset($data["ourfirm"][0]["firm_name"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["firm_name"];
            }
            $invoiceText = $invoiceText . " </li>
                                                  
                                                </ul>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-12\">
                                                <table class=\"table table-striped table-hover\">
                                                    <thead>
                                                        <tr>
                                                          
                                                            <th> Service Description </th>
                                                            <th> Package </th>
                                                            <th> Pieces </th>
                                                            <th> Cost </th>                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>";


            if (isset($data["invoicedetails"][0]["package_name"])) {
                foreach ($data["invoicedetails"] as $detail) {
                    $invoiceText = $invoiceText . "<tr><td> " . $detail["description"] . " </td>
                                                                   <td> " . $detail["package_name"] . " </td>
                                                                   <td> " . $detail["pieces"] . " </td>
                                                                   <td> " . $detail["amount"] . " </td></tr>";
                };
            }

            $invoiceText = $invoiceText . "</tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-12\">
                                                <table class=\"table table-striped table-hover\">
                                                    <thead>
                                                        <tr>
                                                          
                                                        
                                                            <th> ID</th>
                                                            <th> Payment Date </th>
                                                            <th> Amount </th> 
                                                            <th> Payment Status </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>";


            if (isset($data["installmentdetails"])) {
                foreach ($data["installmentdetails"] as $detail) {
                    $invoiceText = $invoiceText . "<tr><td> " . $detail["invoice_installment_detail_id"] . " </td>
                                                                   
                                                                   <td> " . $detail["instalment_date"] . " </td>
                                                                   <td> " . $detail["instalment_amount"] . " </td>
                                                                   <td> " . $detail["payment_status"] . " </td></tr>";
                }
            }

            $invoiceText = $invoiceText . "</tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-4\">
                                                <div class=\"well\">Prepayment  :";

            if (isset($data["invoice"][0]["pre_payment_amount"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["pre_payment_amount"];
            }
            $invoiceText = $invoiceText . " </div>
                                            </div>
                                             <div class=\"col-xs-12\">
                                                    <img src=\"http://127.0.0.1/picfy//assets/_/logo.jpg\" class=\"img-responsive\"
                                                         alt=\"\" style=\"width: 100%; height:50px;\">
                                            </div>
                                            <div class=\"col-xs-8 invoice-block\" style=\"padding-left: 35%;\">
                                                <ul class=\"list-unstyled amounts \">
                                                    <li> <strong>Sub - Total amount €:</strong>";

            if (isset($data["totalinvoice"][0]["subtotal"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["subtotal"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>VAT €:</strong> ";
            if (isset($data["totalinvoice"][0]["tax"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["tax"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>Grand Total €:</strong>";
            if (isset($data["totalinvoice"][0]["grandtotal"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["grandtotal"];
            }
            $invoiceText = $invoiceText . "</li>
                                                </ul>
                                                <br/>
                                                <a class=\"btn btn-lg blue hidden-print margin-bottom-5\" onclick=\"javascript:window.print();\"> Print <i class=\"fa fa-print\"></i> </a> <a  href=\"" . base_url() . "/index.php/Invoice/PDFCreate\" class=\"btn btn-lg green hidden-print margin-bottom-5\"> Send this invoive </a> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";


            return $invoiceText;
        } else if ($lang_id == 379) { // Slovak
            $data["invoicedetails"] = $this->invoice_model->getCretaeInvoiceDetail($invoice_id);

            $data["invoice"] = $this->invoice_model->getCretaeInvoice($invoice_id);

            $related_country_kd = $data["invoice"][0]["country_kd"];
            $data["ourfirm"] = $this->invoice_model->ourfirm_account_info($related_country_kd);
            $data["totalinvoice"] = $this->invoice_model->getCretaeInvoiceTotal($invoice_id);
            $data["installmentdetails"] = $this->invoice_model->getInstallmentDetailWithInvoiceID($invoice_id);


            $invoiceText = "<div class=\"portlet box red\">
                            <div class=\"portlet-title\">
                                <div class=\"caption\"> <i class=\"fa fa-cogs\"></i>Invoice </div>
                                <div class=\"tools\"> <a href=\"javascript:;\" class=\"collapse\"> </a> <a href=\"javascript:;\" class=\"reload\"> </a> </div>
                            </div>
                            <div class=\"portlet-body\">
                               <div class=\"table-responsive\">
                                    <div class=\"invoice\">
                                        <div class=\"row invoice-logo\">
                                            <div class=\"col-xs-4 invoice-logo-space\"> <img src=\"" . base_url() . "/assets/_/logo.jpg " . "\" class=\"img-responsive\" alt=\"\" /> </div>
                                            <div class=\"col-xs-4\">
                                                <h3><p><span class=\"muted\"> Rechnung </span> </p></h3>
                                                <p>Invoice Number:";
            if (isset($data["invoice"][0]["firm_invoice_id"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["invoice_no"];

            }
            $invoiceText = $invoiceText . "</p>
                                                <p> Invoice Date : ";

            if (isset($data["invoice"][0]["invoice_dt"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["invoice_dt"];
            }
            $invoiceText = $invoiceText . " </p>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-4\">
                                                <h3>Client:</h3>
                                                <ul class=\"list-unstyled\">
                                                    <li> ";
            if (isset($data["invoice"][0]["name"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["name"];

            }
            $invoiceText = $invoiceText .
                "</li>
                                                    <li>";
            if (isset($data["invoice"][0]["adress"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["adress"];
            }

            $invoiceText = $invoiceText . " </li>                                                  
                                                </ul>
                                            </div>
                                            <div class=\"col-xs-4\">
                                                
                                                <ul class=\"list-unstyled\">
                                                    <h3><li> Pickyfy Services Invoice </li></h3>
                                                    
                                                </ul>
                                            </div>
                                         
                                            <div class=\"col-xs-4 invoice-payment\">
                                                <h3>Payment Details:</h3>
                                                <ul class=\"list-unstyled\">
                                                    <li> <strong>V.A.T Reg #:</strong>";
            if (isset($data["ourfirm"][0]["taxregisterno"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["taxregisterno"];
            }
            $invoiceText = $invoiceText . " </li>
                                                    <li> <strong>Account Name:</strong> ";
            if (isset($data["ourfirm"][0]["account_name"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["account_name"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>SWIFT code:</strong> ";
            if (isset($data["ourfirm"][0]["swift_kd"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["swift_kd"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>Firm Name:</strong>";
            if (isset($data["ourfirm"][0]["firm_name"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["firm_name"];
            }
            $invoiceText = $invoiceText . " </li>
                                                  
                                                </ul>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-12\">
                                                <table class=\"table table-striped table-hover\">
                                                    <thead>
                                                        <tr>
                                                          
                                                            <th> Service Description </th>
                                                            <th> Package </th>
                                                            <th> Pieces </th>
                                                            <th> Cost </th>                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>";


            if (isset($data["invoicedetails"][0]["package_name"])) {
                foreach ($data["invoicedetails"] as $detail) {
                    $invoiceText = $invoiceText . "<tr><td> " . $detail["description"] . " </td>
                                                                   <td> " . $detail["package_name"] . " </td>
                                                                   <td> " . $detail["pieces"] . " </td>
                                                                   <td> " . $detail["amount"] . " </td></tr>";
                };
            }

            $invoiceText = $invoiceText . "</tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-12\">
                                                <table class=\"table table-striped table-hover\">
                                                    <thead>
                                                        <tr>
                                                          
                                                        
                                                            <th> ID</th>
                                                            <th> Payment Date </th>
                                                            <th> Amount </th> 
                                                            <th> Payment Status </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>";


            if (isset($data["installmentdetails"])) {
                foreach ($data["installmentdetails"] as $detail) {
                    $invoiceText = $invoiceText . "<tr><td> " . $detail["invoice_installment_detail_id"] . " </td>
                                                                   
                                                                   <td> " . $detail["instalment_date"] . " </td>
                                                                   <td> " . $detail["instalment_amount"] . " </td>
                                                                   <td> " . $detail["payment_status"] . " </td></tr>";
                }
            }

            $invoiceText = $invoiceText . "</tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-4\">
                                                <div class=\"well\">Prepayment  :";

            if (isset($data["invoice"][0]["pre_payment_amount"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["pre_payment_amount"];
            }
            $invoiceText = $invoiceText . " </div>
                                            </div>
                                             <div class=\"col-xs-12\">
                                                    <img src=\"http://127.0.0.1/picfy//assets/_/logo.jpg\" class=\"img-responsive\"
                                                         alt=\"\" style=\"width: 100%; height:50px;\">
                                            </div>
                                            <div class=\"col-xs-8 invoice-block\" style=\"padding-left: 35%;\">
                                                <ul class=\"list-unstyled amounts \">
                                                    <li> <strong>Sub - Total amount €:</strong>";

            if (isset($data["totalinvoice"][0]["subtotal"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["subtotal"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>VAT €:</strong> ";
            if (isset($data["totalinvoice"][0]["tax"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["tax"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>Grand Total €:</strong>";
            if (isset($data["totalinvoice"][0]["grandtotal"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["grandtotal"];
            }
            $invoiceText = $invoiceText . "</li>
                                                </ul>
                                                <br/>
                                                <a class=\"btn btn-lg blue hidden-print margin-bottom-5\" onclick=\"javascript:window.print();\"> Print <i class=\"fa fa-print\"></i> </a> <a  href=\"" . base_url() . "/index.php/Invoice/PDFCreate\" class=\"btn btn-lg green hidden-print margin-bottom-5\"> Send this invoive </a> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";


            return $invoiceText;
        } else if ($lang_id == 137) { // German
            $data["invoicedetails"] = $this->invoice_model->getCretaeInvoiceDetail($invoice_id);

            $data["invoice"] = $this->invoice_model->getCretaeInvoice($invoice_id);

            $related_country_kd = $data["invoice"][0]["country_kd"];
            $data["ourfirm"] = $this->invoice_model->ourfirm_account_info($related_country_kd);
            $data["totalinvoice"] = $this->invoice_model->getCretaeInvoiceTotal($invoice_id);
            $data["installmentdetails"] = $this->invoice_model->getInstallmentDetailWithInvoiceID($invoice_id);


            $invoiceText = "<div class=\"portlet box red\">
                            <div class=\"portlet-title\">
                                <div class=\"caption\"> <i class=\"fa fa-cogs\"></i>Invoice </div>
                                <div class=\"tools\"> <a href=\"javascript:;\" class=\"collapse\"> </a> <a href=\"javascript:;\" class=\"reload\"> </a> </div>
                            </div>
                            <div class=\"portlet-body\">
                               <div class=\"table-responsive\">
                                    <div class=\"invoice\">
                                        <div class=\"row invoice-logo\">
                                            <div class=\"col-xs-4 invoice-logo-space\"> <img src=\"" . base_url() . "/assets/_/logo.jpg " . "\" class=\"img-responsive\" alt=\"\" /> </div>
                                            <div class=\"col-xs-4\">
                                                <h3><p><span class=\"muted\"> Rechnung (Faktúra-Daňový doklad) </span> </p></h3>
                                                <p><strong>Rechnungsnummer (Číslo faktúry):</strong><br>";
            if (isset($data["invoice"][0]["firm_invoice_id"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["invoice_no"];

            }
            $invoiceText = $invoiceText . "</p>
                                                <p><strong>Datum der Ausstellung (Dátum vystavenia): </strong><br>";

            if (isset($data["invoice"][0]["invoice_dt"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["invoice_dt"];
            }
            $invoiceText = $invoiceText . " </p>
                                            </div>
                                              <div class=\"col-xs-4\">
                                                 
                                                  <div class=\"col - xs - 4 invoice - payment\">
                                                <h3>Lieferant Firma (Dodávateľ):</h3>
                                                <ul class=\"list-unstyled\">
                                                                                                                <li> <strong>Firma (Obchodné meno): </strong> <br>";
            if (isset($data["ourfirm"][0]["firm_name"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["firm_name"];
            }
            $invoiceText = $invoiceText . " </li> 
                                                                                                                 
                                                                                                                <li> <strong>Firmensitz (Sídlo firmy): </strong> <br>";
            if (isset($data["ourfirm"][0]["firm_adress"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["firm_adress"];
            }
            $invoiceText = $invoiceText . "</li>
                                                                                                                 <li> <strong>Firmenbuch No (IČO): </strong><br> ";
            if (isset($data["ourfirm"][0]["vat_number"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["vat_number"];
            }
            $invoiceText = $invoiceText . "</li>  
                                                                                                                 <li> <strong>UID Nummer (DIČ): </strong> <br>";
            if (isset($data["ourfirm"][0]["taxregisterno"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["taxregisterno"];
            }
            $invoiceText = $invoiceText . "</li>
                                                                                                                 <li> <strong>UID Nummer (IČ DPH): </strong><br> ";
            if (isset($data["ourfirm"][0]["ic_dph"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["ic_dph"];
            }
            $invoiceText = $invoiceText . "</li>
                                                                                                                  <li> <strong>Handelsgericht (Okresný súd Bratislava I Oddiel Sro, vložka č.114946/B): </strong> <br>";
            if (isset($data["ourfirm"][0]["tax_office_name"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["tax_office_name"];
            }
            $invoiceText = $invoiceText . "</li>
                                                                                                                  <li> <strong>BIC / SWIFT: </strong> <br>";
            if (isset($data["ourfirm"][0]["bic_kd"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["bic_kd"];
            }
            $invoiceText = $invoiceText . " </li>
                                                                                                              
                                                </ul>
                                            </div>
                                                 
                                                 
                                                 
                                                 
                                              </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-4\">
                                                <h3>Kunde(Odberatel):</h3>
                                                <ul class=\"list-unstyled\">
                                                    <li><strong>Firmen Name (Obchodné meno): </strong> <br>";
            if (isset($data["invoice"][0]["name"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["name"];

            }
            $invoiceText = $invoiceText .
                "</li>
                                                    <li><strong>Kunden Adresse (Sídlo odberateľa): </strong> <br>";
            if (isset($data["invoice"][0]["firm_adress"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["firm_adress"];
            }
            $invoiceText = $invoiceText .
                "</li>
                                                        <li><strong>Firmenbuch No.(IČO)#: </strong> <br>";
            if (isset($data["invoice"][0]["tax_num"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["tax_num"];
            }
            $invoiceText = $invoiceText .
                "</li>
                                                        <li><strong>UID Nummer(DIČ): </strong><br>";
            if (isset($data["invoice"][0]["vat_num"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["vat_num"];
            }
            $invoiceText = $invoiceText . " </li>            
                                                            <li><strong>UID Nummer(IČ DPH): </strong><br>";
            if (isset($data["invoice"][0]["vat_num"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["vat_num"];
            }
            $invoiceText = $invoiceText . " </li>                                                  
                                                </ul>
                                            </div>
                                            <div class=\"col-xs-4\">
                                                <h3><p><span class=\"muted\"> Zahlung Detail</span></p></h3>
                                                    <p>  Lieferungsdatum (Dátum dodania):<br> 07.01.2017</p>
                                                    <p>  Referenz Nummer (Variabilný symbol, Referenčné číslo):<br> 125</p>
                                                    <p>  Fälligkeitsdatum (Dátum splatnosti) :<br>  07.01.2017</p>
                                               
                                            </div>
                                             <div class=\"col-xs-4\">
                                                        <img src=\"http://127.0.0.1/picfy/assets/_/stamp.png\" class=\"img-responsive\"
                                                             alt=\"\" style=\"width: 100%; height:50px;\">
                                             </div>
                                      
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-12\">
                                                <table class=\"table table-striped table-hover\">
                                                    <thead>
                                                        <tr>
                                                          
                                                            <th> Artikelbezeichnung/Leistungen (Produkty a Služby) </th>
                                                            <th> Paket (Balík)</th>
                                                            <th> Anzahl (Počet) </th>
                                                            <th> Einzehlpreis (Cena bez DPH/ks) </th>
                                                            <th> Gesamtpreis (Cena celkom bez DPH)</th>                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>";


            if (isset($data["invoicedetails"][0]["package_name"])) {
                foreach ($data["invoicedetails"] as $detail) {
                    $invoiceText = $invoiceText . "<tr><td> " . $detail["description"] . " </td>
                                                                   <td> " . $detail["package_name"] . " </td>
                                                                   <td> " . $detail["pieces"] . " </td>
                                                                   <td> " . $detail["amount"] . " </td>
                                                                   <td> " . $detail["amount"] . " </td></tr>";
                };
            }

            $invoiceText = $invoiceText . "</tbody>
                                                </table>
                                            </div>
                                        </div>
                                       
                                        <div class=\"row\">
                                            <div class=\"col-xs-4\">
                                                <div class=\"well\">Prepayment  :";

            if (isset($data["invoice"][0]["pre_payment_amount"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["pre_payment_amount"];
            }
            $invoiceText = $invoiceText . " </div>
                                                                                                </div>
                                                                                                
                                                                                                    
                                                                                               
                                                                                                <div class=\"col-xs-8 invoice-block\" style=\"padding-left: 35%;\">
                                                                                                    <ul class=\"list-unstyled amounts \">
                                                                                                        <li> <strong>Nettobetrag (Celkom EUR bez DPH): </strong>";

            if (isset($data["totalinvoice"][0]["subtotal"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["subtotal"];
            }
            $invoiceText = $invoiceText . "</li>
                                                                                                        <li> <strong>+20 MwST. (Celkom DPH): </strong>";
            if (isset($data["totalinvoice"][0]["tax"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["tax"];
            }
            $invoiceText = $invoiceText . "</li>
                                                                                                        <li> <strong>Gesamtbetrag (Faktúra v EUR s DPH) (€): </strong>";
            if (isset($data["totalinvoice"][0]["grandtotal"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["grandtotal"];
            }
            $invoiceText = $invoiceText . "</li>
                                                </ul>
                                                <br/>
                                                <a class=\"btn btn-lg blue hidden-print margin-bottom-5\" onclick=\"javascript:window.print();\"> Print <i class=\"fa fa-print\"></i> </a> <a  href=\"" . base_url() . "/index.php/Invoice/pdfDownload/" . $invoice_id . "/" . $lang_id . "\" class=\"btn btn-lg green hidden-print margin-bottom-5\"> PDF </a> </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col - xs - 8\">
                                                <table class=\"table table - striped table - hover\">
                                                    <thead>
                                                        <tr>
                                                          
                                                        
                                                            <th> ID</th>
                                                            <th> Ratenzahlungsplan (Splatkový kalendár) </th>
                                                            <th> Betrag (Suma) </th> 
                                                            <th> Zahlungsstatus (Splatkový stav) </th>
                                                            <th> Referenz Nummer (Variabilný symbol, Referenčné číslo) </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>";


            if (isset($data["installmentdetails"])) {
                foreach ($data["installmentdetails"] as $detail) {
                    $invoiceText = $invoiceText . "<tr><td> " . $detail["invoice_installment_detail_id"] . " </td>
                                                                   <td> " . $detail["instalment_date"] . " </td>
                                                                   <td> " . $detail["instalment_amount"] . " </td>
                                                                   <td> " . $detail["payment_status"] . " </td>
                                                                   <td> " . $detail["ref_number"] . " </td></tr>";
                }
            }

            $invoiceText = $invoiceText . "</tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";


            return $invoiceText;
        } else if ($lang_id == 57) { // Bulgarian
            $data["invoicedetails"] = $this->invoice_model->getCretaeInvoiceDetail($invoice_id);

            $data["invoice"] = $this->invoice_model->getCretaeInvoice($invoice_id);

            $related_country_kd = $data["invoice"][0]["country_kd"];
            $data["ourfirm"] = $this->invoice_model->ourfirm_account_info($related_country_kd);
            $data["totalinvoice"] = $this->invoice_model->getCretaeInvoiceTotal($invoice_id);
            $data["installmentdetails"] = $this->invoice_model->getInstallmentDetailWithInvoiceID($invoice_id);


            $invoiceText = "<div class=\"portlet box red\">
                            <div class=\"portlet-title\">
                                <div class=\"caption\"> <i class=\"fa fa-cogs\"></i>Invoice </div>
                                <div class=\"tools\"> <a href=\"javascript:;\" class=\"collapse\"> </a> <a href=\"javascript:;\" class=\"reload\"> </a> </div>
                            </div>
                            <div class=\"portlet-body\">
                               <div class=\"table-responsive\">
                                    <div class=\"invoice\">
                                        <div class=\"row invoice-logo\">
                                            <div class=\"col-xs-4 invoice-logo-space\"> <img src=\"" . base_url() . "/assets/_/logo.jpg " . "\" class=\"img-responsive\" alt=\"\" /> </div>
                                            <div class=\"col-xs-4\">
                                                <h3><p><span class=\"muted\"> Rechnung </span> </p></h3>
                                                <p>Invoice Number:";
            if (isset($data["invoice"][0]["firm_invoice_id"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["invoice_no"];

            }
            $invoiceText = $invoiceText . "</p>
                                                <p> Invoice Date : ";

            if (isset($data["invoice"][0]["invoice_dt"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["invoice_dt"];
            }
            $invoiceText = $invoiceText . " </p>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-4\">
                                                <h3>Client:</h3>
                                                <ul class=\"list-unstyled\">
                                                    <li> ";
            if (isset($data["invoice"][0]["name"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["name"];

            }
            $invoiceText = $invoiceText .
                "</li>
                                                    <li>";
            if (isset($data["invoice"][0]["adress"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["adress"];
            }

            $invoiceText = $invoiceText . " </li>                                                  
                                                </ul>
                                            </div>
                                            <div class=\"col-xs-4\">
                                                
                                                <ul class=\"list-unstyled\">
                                                    <h3><li> Pickyfy Services Invoice </li></h3>
                                                    
                                                </ul>
                                            </div>
                                         
                                            <div class=\"col-xs-4 invoice-payment\">
                                                <h3>Payment Details:</h3>
                                                <ul class=\"list-unstyled\">
                                                    <li> <strong>V.A.T Reg #:</strong>";
            if (isset($data["ourfirm"][0]["taxregisterno"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["taxregisterno"];
            }
            $invoiceText = $invoiceText . " </li>
                                                    <li> <strong>Account Name:</strong> ";
            if (isset($data["ourfirm"][0]["account_name"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["account_name"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>SWIFT code:</strong> ";
            if (isset($data["ourfirm"][0]["swift_kd"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["swift_kd"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>Firm Name:</strong>";
            if (isset($data["ourfirm"][0]["firm_name"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["firm_name"];
            }
            $invoiceText = $invoiceText . " </li>
                                                  
                                                </ul>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-12\">
                                                <table class=\"table table-striped table-hover\">
                                                    <thead>
                                                        <tr>
                                                          
                                                            <th> Service Description </th>
                                                            <th> Package </th>
                                                            <th> Pieces </th>
                                                            <th> Cost </th>                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>";


            if (isset($data["invoicedetails"][0]["package_name"])) {
                foreach ($data["invoicedetails"] as $detail) {
                    $invoiceText = $invoiceText . "<tr><td> " . $detail["description"] . " </td>
                                                                   <td> " . $detail["package_name"] . " </td>
                                                                   <td> " . $detail["pieces"] . " </td>
                                                                   <td> " . $detail["amount"] . " </td></tr>";
                };
            }

            $invoiceText = $invoiceText . "</tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-12\">
                                                <table class=\"table table-striped table-hover\">
                                                    <thead>
                                                        <tr>
                                                          
                                                        
                                                            <th> ID</th>
                                                            <th> Payment Date </th>
                                                            <th> Amount </th> 
                                                            <th> Payment Status </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>";


            if (isset($data["installmentdetails"])) {
                foreach ($data["installmentdetails"] as $detail) {
                    $invoiceText = $invoiceText . "<tr><td> " . $detail["invoice_installment_detail_id"] . " </td>
                                                                   
                                                                   <td> " . $detail["instalment_date"] . " </td>
                                                                   <td> " . $detail["instalment_amount"] . " </td>
                                                                   <td> " . $detail["payment_status"] . " </td></tr>";
                }
            }

            $invoiceText = $invoiceText . "</tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-4\">
                                                <div class=\"well\">Prepayment  :";

            if (isset($data["invoice"][0]["pre_payment_amount"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["pre_payment_amount"];
            }
            $invoiceText = $invoiceText . " </div>
                                            </div>
                                             <div class=\"col-xs-12\">
                                                    <img src=\"http://127.0.0.1/picfy//assets/_/logo.jpg\" class=\"img-responsive\"
                                                         alt=\"\" style=\"width: 100%; height:50px;\">
                                            </div>
                                            <div class=\"col-xs-8 invoice-block\" style=\"padding-left: 35%;\">
                                                <ul class=\"list-unstyled amounts \">
                                                    <li> <strong>Sub - Total amount €:</strong>";

            if (isset($data["totalinvoice"][0]["subtotal"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["subtotal"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>VAT €:</strong> ";
            if (isset($data["totalinvoice"][0]["tax"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["tax"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>Grand Total €:</strong>";
            if (isset($data["totalinvoice"][0]["grandtotal"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["grandtotal"];
            }
            $invoiceText = $invoiceText . "</li>
                                                </ul>
                                                <br/>
                                                <a class=\"btn btn-lg blue hidden-print margin-bottom-5\" onclick=\"javascript:window.print();\"> Print <i class=\"fa fa-print\"></i> </a> <a  href=\"" . base_url() . "/index.php/Invoice/PDFCreate\" class=\"btn btn-lg green hidden-print margin-bottom-5\"> Send this invoive </a> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";


            return $invoiceText;
        } else if ($lang_id == 437) { // Farsi
            $data["invoicedetails"] = $this->invoice_model->getCretaeInvoiceDetail($invoice_id);

            $data["invoice"] = $this->invoice_model->getCretaeInvoice($invoice_id);

            $related_country_kd = $data["invoice"][0]["country_kd"];
            $data["ourfirm"] = $this->invoice_model->ourfirm_account_info($related_country_kd);
            $data["totalinvoice"] = $this->invoice_model->getCretaeInvoiceTotal($invoice_id);
            $data["installmentdetails"] = $this->invoice_model->getInstallmentDetailWithInvoiceID($invoice_id);


            $invoiceText = "<div class=\"portlet box red\">
                            <div class=\"portlet-title\">
                                <div class=\"caption\"> <i class=\"fa fa-cogs\"></i>Invoice </div>
                                <div class=\"tools\"> <a href=\"javascript:;\" class=\"collapse\"> </a> <a href=\"javascript:;\" class=\"reload\"> </a> </div>
                            </div>
                            <div class=\"portlet-body\">
                               <div class=\"table-responsive\">
                                    <div class=\"invoice\">
                                        <div class=\"row invoice-logo\">
                                            <div class=\"col-xs-4 invoice-logo-space\"> <img src=\"" . base_url() . "/assets/_/logo.jpg " . "\" class=\"img-responsive\" alt=\"\" /> </div>
                                            <div class=\"col-xs-4\">
                                                <h3><p><span class=\"muted\"> Rechnung </span> </p></h3>
                                                <p>Invoice Number:";
            if (isset($data["invoice"][0]["firm_invoice_id"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["invoice_no"];

            }
            $invoiceText = $invoiceText . "</p>
                                                <p> Invoice Date : ";

            if (isset($data["invoice"][0]["invoice_dt"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["invoice_dt"];
            }
            $invoiceText = $invoiceText . " </p>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-4\">
                                                <h3>Client:</h3>
                                                <ul class=\"list-unstyled\">
                                                    <li> ";
            if (isset($data["invoice"][0]["name"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["name"];

            }
            $invoiceText = $invoiceText .
                "</li>
                                                    <li>";
            if (isset($data["invoice"][0]["adress"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["adress"];
            }

            $invoiceText = $invoiceText . " </li>                                                  
                                                </ul>
                                            </div>
                                            <div class=\"col-xs-4\">
                                                
                                                <ul class=\"list-unstyled\">
                                                    <h3><li> Pickyfy Services Invoice </li></h3>
                                                    
                                                </ul>
                                            </div>
                                         
                                            <div class=\"col-xs-4 invoice-payment\">
                                                <h3>Payment Details:</h3>
                                                <ul class=\"list-unstyled\">
                                                    <li> <strong>V.A.T Reg #:</strong>";
            if (isset($data["ourfirm"][0]["taxregisterno"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["taxregisterno"];
            }
            $invoiceText = $invoiceText . " </li>
                                                    <li> <strong>Account Name:</strong> ";
            if (isset($data["ourfirm"][0]["account_name"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["account_name"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>SWIFT code:</strong> ";
            if (isset($data["ourfirm"][0]["swift_kd"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["swift_kd"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>Firm Name:</strong>";
            if (isset($data["ourfirm"][0]["firm_name"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["firm_name"];
            }
            $invoiceText = $invoiceText . " </li>
                                                  
                                                </ul>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-12\">
                                                <table class=\"table table-striped table-hover\">
                                                    <thead>
                                                        <tr>
                                                          
                                                            <th> Service Description </th>
                                                            <th> Package </th>
                                                            <th> Pieces </th>
                                                            <th> Cost </th>                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>";


            if (isset($data["invoicedetails"][0]["package_name"])) {
                foreach ($data["invoicedetails"] as $detail) {
                    $invoiceText = $invoiceText . "<tr><td> " . $detail["description"] . " </td>
                                                                   <td> " . $detail["package_name"] . " </td>
                                                                   <td> " . $detail["pieces"] . " </td>
                                                                   <td> " . $detail["amount"] . " </td></tr>";
                };
            }

            $invoiceText = $invoiceText . "</tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-12\">
                                                <table class=\"table table-striped table-hover\">
                                                    <thead>
                                                        <tr>
                                                          
                                                        
                                                            <th> ID</th>
                                                            <th> Payment Date </th>
                                                            <th> Amount </th> 
                                                            <th> Payment Status </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>";


            if (isset($data["installmentdetails"])) {
                foreach ($data["installmentdetails"] as $detail) {
                    $invoiceText = $invoiceText . "<tr><td> " . $detail["invoice_installment_detail_id"] . " </td>
                                                                   
                                                                   <td> " . $detail["instalment_date"] . " </td>
                                                                   <td> " . $detail["instalment_amount"] . " </td>
                                                                   <td> " . $detail["payment_status"] . " </td></tr>";
                }
            }

            $invoiceText = $invoiceText . "</tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-4\">
                                                <div class=\"well\">Prepayment  :";

            if (isset($data["invoice"][0]["pre_payment_amount"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["pre_payment_amount"];
            }
            $invoiceText = $invoiceText . " </div>
                                            </div>
                                             <div class=\"col-xs-12\">
                                                    <img src=\"http://127.0.0.1/picfy//assets/_/logo.jpg\" class=\"img-responsive\"
                                                         alt=\"\" style=\"width: 100%; height:50px;\">
                                            </div>
                                            <div class=\"col-xs-8 invoice-block\" style=\"padding-left: 35%;\">
                                                <ul class=\"list-unstyled amounts \">
                                                    <li> <strong>Sub - Total amount €:</strong>";

            if (isset($data["totalinvoice"][0]["subtotal"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["subtotal"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>VAT €:</strong> ";
            if (isset($data["totalinvoice"][0]["tax"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["tax"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>Grand Total €:</strong>";
            if (isset($data["totalinvoice"][0]["grandtotal"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["grandtotal"];
            }
            $invoiceText = $invoiceText . "</li>
                                                </ul>
                                                <br/>
                                                <a class=\"btn btn-lg blue hidden-print margin-bottom-5\" onclick=\"javascript:window.print();\"> Print <i class=\"fa fa-print\"></i> </a> <a  href=\"" . base_url() . "/index.php/Invoice/PDFCreate\" class=\"btn btn-lg green hidden-print margin-bottom-5\"> Send this invoive </a> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";


            return $invoiceText;
        }

    }

    function createOtherInvoicePage($invoice_id, $lang_id)
    {
        if ($lang_id == 112) { // English
            $data["invoicedetails"] = $this->invoice_model->getCretaeInvoiceDetail($invoice_id);

            $data["invoice"] = $this->invoice_model->getCretaeInvoice($invoice_id);

            $related_country_kd = $data["invoice"][0]["country_kd"];
            $data["ourfirm"] = $this->invoice_model->ourfirm_account_info($related_country_kd);
            $data["totalinvoice"] = $this->invoice_model->getCretaeInvoiceTotal($invoice_id);
            $data["installmentdetails"] = $this->invoice_model->getInstallmentDetailWithInvoiceID($invoice_id);


            $invoiceText = "<div class=\"portlet box red\">
                            <div class=\"portlet-title\">
                                <div class=\"caption\"> <i class=\"fa fa-cogs\"></i>Invoice </div>
                                <div class=\"tools\"> <a href=\"javascript:;\" class=\"collapse\"> </a> <a href=\"javascript:;\" class=\"reload\"> </a> </div>
                            </div>
                            <div class=\"portlet-body\">
                               <div class=\"table-responsive\">
                                    <div class=\"invoice\">
                                        <div class=\"row invoice-logo\">
                                            <div class=\"col-xs-4 invoice-logo-space\"> <img src=\"" . base_url() . "/assets/_/logo.jpg " . "\" class=\"img-responsive\" alt=\"\" /> </div>
                                            <div class=\"col-xs-4\">
                                                <h3><p><span class=\"muted\"> Rechnung </span> </p></h3>
                                                <p>Invoice Number:";
            if (isset($data["invoice"][0]["firm_invoice_id"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["invoice_no"];

            }
            $invoiceText = $invoiceText . "</p>
                                                <p> Invoice Date : ";

            if (isset($data["invoice"][0]["invoice_dt"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["invoice_dt"];
            }
            $invoiceText = $invoiceText . " </p>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-4\">
                                                <h3>Client:</h3>
                                                <ul class=\"list-unstyled\">
                                                    <li> ";
            if (isset($data["invoice"][0]["name"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["name"];

            }
            $invoiceText = $invoiceText .
                "</li>
                                                    <li>";
            if (isset($data["invoice"][0]["adress"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["adress"];
            }

            $invoiceText = $invoiceText . " </li>                                                  
                                                </ul>
                                            </div>
                                            <div class=\"col-xs-4\">
                                                
                                                <ul class=\"list-unstyled\">
                                                    <h3><li> Pickyfy Services Invoice </li></h3>
                                                    
                                                </ul>
                                            </div>
                                         
                                            <div class=\"col-xs-4 invoice-payment\">
                                                <h3>Payment Details:</h3>
                                                <ul class=\"list-unstyled\">
                                                    <li> <strong>V.A.T Reg #:</strong>";
            if (isset($data["ourfirm"][0]["taxregisterno"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["taxregisterno"];
            }
            $invoiceText = $invoiceText . " </li>
                                                    <li> <strong>Account Name:</strong> ";
            if (isset($data["ourfirm"][0]["account_name"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["account_name"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>SWIFT code:</strong> ";
            if (isset($data["ourfirm"][0]["swift_kd"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["swift_kd"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>Firm Name:</strong>";
            if (isset($data["ourfirm"][0]["firm_name"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["firm_name"];
            }
            $invoiceText = $invoiceText . " </li>
                                                  
                                                </ul>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-12\">
                                                <table class=\"table table-striped table-hover\">
                                                    <thead>
                                                        <tr>
                                                          
                                                            <th> Service Description </th>
                                                            <th> Package </th>
                                                            <th> Pieces </th>
                                                            <th> Cost </th>                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>";


            if (isset($data["invoicedetails"][0]["package_name"])) {
                foreach ($data["invoicedetails"] as $detail) {
                    $invoiceText = $invoiceText . "<tr><td> " . $detail["description"] . " </td>
                                                                   <td> " . $detail["package_name"] . " </td>
                                                                   <td> " . $detail["pieces"] . " </td>
                                                                   <td> " . $detail["amount"] . " </td></tr>";
                };
            }

            $invoiceText = $invoiceText . "</tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-12\">
                                                <table class=\"table table-striped table-hover\">
                                                    <thead>
                                                        <tr>
                                                          
                                                        
                                                            <th> ID</th>
                                                            <th> Payment Date </th>
                                                            <th> Amount </th> 
                                                            <th> Payment Status </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>";


            if (isset($data["installmentdetails"])) {
                foreach ($data["installmentdetails"] as $detail) {
                    $invoiceText = $invoiceText . "<tr><td> " . $detail["invoice_installment_detail_id"] . " </td>
                                                                   
                                                                   <td> " . $detail["instalment_date"] . " </td>
                                                                   <td> " . $detail["instalment_amount"] . " </td>
                                                                   <td> " . $detail["payment_status"] . " </td></tr>";
                }
            }

            $invoiceText = $invoiceText . "</tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-4\">
                                                <div class=\"well\">Prepayment  :";

            if (isset($data["invoice"][0]["pre_payment_amount"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["pre_payment_amount"];
            }
            $invoiceText = $invoiceText . " </div>
                                            </div>
                                             <div class=\"col-xs-12\">
                                                    <img src=\"http://127.0.0.1/picfy//assets/_/logo.jpg\" class=\"img-responsive\"
                                                         alt=\"\" style=\"width: 100%; height:50px;\">
                                            </div>
                                            <div class=\"col-xs-8 invoice-block\" style=\"padding-left: 35%;\">
                                                <ul class=\"list-unstyled amounts \">
                                                    <li> <strong>Sub - Total amount €:</strong>";

            if (isset($data["totalinvoice"][0]["subtotal"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["subtotal"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>VAT €:</strong> ";
            if (isset($data["totalinvoice"][0]["tax"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["tax"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>Grand Total €:</strong>";
            if (isset($data["totalinvoice"][0]["grandtotal"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["grandtotal"];
            }
            $invoiceText = $invoiceText . "</li>
                                                </ul>
                                                <br/>
                                                <a class=\"btn btn-lg blue hidden-print margin-bottom-5\" onclick=\"javascript:window.print();\"> Print <i class=\"fa fa-print\"></i> </a> <a  href=\"" . base_url() . "/index.php/Invoice/PDFCreate\" class=\"btn btn-lg green hidden-print margin-bottom-5\"> Send this invoive </a> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";


            return $invoiceText;
        } else if ($lang_id == 379) { // Slovak
            $data["invoicedetails"] = $this->invoice_model->getCretaeInvoiceDetail($invoice_id);

            $data["invoice"] = $this->invoice_model->getCretaeInvoice($invoice_id);

            $related_country_kd = $data["invoice"][0]["country_kd"];
            $data["ourfirm"] = $this->invoice_model->ourfirm_account_info($related_country_kd);
            $data["totalinvoice"] = $this->invoice_model->getCretaeInvoiceTotal($invoice_id);
            $data["installmentdetails"] = $this->invoice_model->getInstallmentDetailWithInvoiceID($invoice_id);


            $invoiceText = "<div class=\"portlet box red\">
                            <div class=\"portlet-title\">
                                <div class=\"caption\"> <i class=\"fa fa-cogs\"></i>Invoice </div>
                                <div class=\"tools\"> <a href=\"javascript:;\" class=\"collapse\"> </a> <a href=\"javascript:;\" class=\"reload\"> </a> </div>
                            </div>
                            <div class=\"portlet-body\">
                               <div class=\"table-responsive\">
                                    <div class=\"invoice\">
                                        <div class=\"row invoice-logo\">
                                            <div class=\"col-xs-4 invoice-logo-space\"> <img src=\"" . base_url() . "/assets/_/logo.jpg " . "\" class=\"img-responsive\" alt=\"\" /> </div>
                                            <div class=\"col-xs-4\">
                                                <h3><p><span class=\"muted\"> Rechnung </span> </p></h3>
                                                <p>Invoice Number:";
            if (isset($data["invoice"][0]["firm_invoice_id"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["invoice_no"];

            }
            $invoiceText = $invoiceText . "</p>
                                                <p> Invoice Date : ";

            if (isset($data["invoice"][0]["invoice_dt"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["invoice_dt"];
            }
            $invoiceText = $invoiceText . " </p>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-4\">
                                                <h3>Client:</h3>
                                                <ul class=\"list-unstyled\">
                                                    <li> ";
            if (isset($data["invoice"][0]["name"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["name"];

            }
            $invoiceText = $invoiceText .
                "</li>
                                                    <li>";
            if (isset($data["invoice"][0]["adress"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["adress"];
            }

            $invoiceText = $invoiceText . " </li>                                                  
                                                </ul>
                                            </div>
                                            <div class=\"col-xs-4\">
                                                
                                                <ul class=\"list-unstyled\">
                                                    <h3><li> Pickyfy Services Invoice </li></h3>
                                                    
                                                </ul>
                                            </div>
                                         
                                            <div class=\"col-xs-4 invoice-payment\">
                                                <h3>Payment Details:</h3>
                                                <ul class=\"list-unstyled\">
                                                    <li> <strong>V.A.T Reg #:</strong>";
            if (isset($data["ourfirm"][0]["taxregisterno"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["taxregisterno"];
            }
            $invoiceText = $invoiceText . " </li>
                                                    <li> <strong>Account Name:</strong> ";
            if (isset($data["ourfirm"][0]["account_name"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["account_name"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>SWIFT code:</strong> ";
            if (isset($data["ourfirm"][0]["swift_kd"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["swift_kd"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>Firm Name:</strong>";
            if (isset($data["ourfirm"][0]["firm_name"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["firm_name"];
            }
            $invoiceText = $invoiceText . " </li>
                                                  
                                                </ul>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-12\">
                                                <table class=\"table table-striped table-hover\">
                                                    <thead>
                                                        <tr>
                                                          
                                                            <th> Service Description </th>
                                                            <th> Package </th>
                                                            <th> Pieces </th>
                                                            <th> Cost </th>                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>";


            if (isset($data["invoicedetails"][0]["package_name"])) {
                foreach ($data["invoicedetails"] as $detail) {
                    $invoiceText = $invoiceText . "<tr><td> " . $detail["description"] . " </td>
                                                                   <td> " . $detail["package_name"] . " </td>
                                                                   <td> " . $detail["pieces"] . " </td>
                                                                   <td> " . $detail["amount"] . " </td></tr>";
                };
            }

            $invoiceText = $invoiceText . "</tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-12\">
                                                <table class=\"table table-striped table-hover\">
                                                    <thead>
                                                        <tr>
                                                          
                                                        
                                                            <th> ID</th>
                                                            <th> Payment Date </th>
                                                            <th> Amount </th> 
                                                            <th> Payment Status </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>";


            if (isset($data["installmentdetails"])) {
                foreach ($data["installmentdetails"] as $detail) {
                    $invoiceText = $invoiceText . "<tr><td> " . $detail["invoice_installment_detail_id"] . " </td>
                                                                   
                                                                   <td> " . $detail["instalment_date"] . " </td>
                                                                   <td> " . $detail["instalment_amount"] . " </td>
                                                                   <td> " . $detail["payment_status"] . " </td></tr>";
                }
            }

            $invoiceText = $invoiceText . "</tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-4\">
                                                <div class=\"well\">Prepayment  :";

            if (isset($data["invoice"][0]["pre_payment_amount"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["pre_payment_amount"];
            }
            $invoiceText = $invoiceText . " </div>
                                            </div>
                                             <div class=\"col-xs-12\">
                                                    <img src=\"http://127.0.0.1/picfy//assets/_/logo.jpg\" class=\"img-responsive\"
                                                         alt=\"\" style=\"width: 100%; height:50px;\">
                                            </div>
                                            <div class=\"col-xs-8 invoice-block\" style=\"padding-left: 35%;\">
                                                <ul class=\"list-unstyled amounts \">
                                                    <li> <strong>Sub - Total amount €:</strong>";

            if (isset($data["totalinvoice"][0]["subtotal"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["subtotal"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>VAT €:</strong> ";
            if (isset($data["totalinvoice"][0]["tax"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["tax"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>Grand Total €:</strong>";
            if (isset($data["totalinvoice"][0]["grandtotal"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["grandtotal"];
            }
            $invoiceText = $invoiceText . "</li>
                                                </ul>
                                                <br/>
                                                <a class=\"btn btn-lg blue hidden-print margin-bottom-5\" onclick=\"javascript:window.print();\"> Print <i class=\"fa fa-print\"></i> </a> <a  href=\"" . base_url() . "/index.php/Invoice/PDFCreate\" class=\"btn btn-lg green hidden-print margin-bottom-5\"> Send this invoive </a> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";


            return $invoiceText;
        } else if ($lang_id == 137) { // German
            $data["invoicedetails"] = $this->invoice_model->getCretaeInvoiceDetailOther($invoice_id);

            $data["invoice"] = $this->invoice_model->getCretaeInvoiceOther($invoice_id);

            $related_country_kd = $data["invoice"][0]["country_kd"];
            $data["ourfirm"] = $this->invoice_model->ourfirm_account_info($related_country_kd);
            $data["totalinvoice"] = $this->invoice_model->getCretaeInvoiceTotalOther($invoice_id);
            $data["installmentdetails"] = $this->invoice_model->getInstallmentDetailWithInvoiceIDOther($invoice_id);


            $invoiceText = " <!DOCTYPE html>
                                    <html lang=\"en\">
                                    <head>
                                        <meta charset=\"utf-8\">
                                        <title>Example 2</title>
                                        <link rel=\"stylesheet\" href=\"<?php echo base_url() ?>assets/invoice/style.css\" media=\"all\" />
                                    </head>
                                    <body>
                                    <header class=\"clearfix\">
                                        <div id=\"logo\">
                                            <img src=\"<?php echo base_url() ?>assets/_/login/img2.jpg\">
                                        </div>
                                        <div id=\"company\">
                                            <h2 class=\"name\">";

            if (isset($data["ourfirm"][0]["firm_name"])) {
                echo $data["ourfirm"][0]["firm_name"];
            }

            $invoiceText = $invoiceText . "</h2>
                                            <div>";
            if (isset($data["ourfirm"][0]["firm_adress"])) {
                echo $data["ourfirm"][0]["firm_adress"];
            }
            $invoiceText = $invoiceText . "</div> 
                                            <div>";
            if (isset($data["ourfirm"][0]["email"])) {
                echo " <a href=\"mailto:" . $data["ourfirm"][0]["email"] . "\">" . $data["ourfirm"][0]["email"] . "</a>";
            }

            $invoiceText = $invoiceText . "</div>
                                        </div>
                                        </div>
                                    </header>
                                    <main>
                                        <div id=\"details\" class=\"clearfix\">
                                            <div id=\"client\">
                                                <div class=\"to\">INVOICE TO:</div>
                                                <h2 class=\"name\">";

            if (isset($data["invoice"][0]["name"])) {
                echo $data["invoice"][0]["name"];
            }

            $invoiceText = $invoiceText . "</h2>
                                                <div class=\"address\">";
            if (isset($data["invoice"][0]["firm_adress"])) {
                echo $data["invoice"][0]["firm_adress"];
            }
            $invoiceText = $invoiceText . "</div>
                                               
                                            </div>
                                            <div id=\"invoice\">
                                                <h1>INVOICE ";
            if (isset($data["invoice"][0]["invoice_no"])) {
                echo $data["invoice"][0]["invoice_no"];
            }
            $invoiceText = $invoiceText . "</h1>
                                                <div class=\"date\">Date of Invoice: ";
            if (isset($data["invoice"][0]["invoice_dt"])) {
                echo $data["invoice"][0]["invoice_dt"];
            }
            $invoiceText = $invoiceText . "</div>
                                              
                                            </div>
                                        </div>
                                        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                                            <thead>
                                            <tr>
                                                <th class=\"desc\">DESCRIPTION</th>
                                                <th class=\"unit\">PACKAGE</th>
                                                 <th class=\"unit\">PIECES</th>
                                                <th class=\"qty\">QUANTITY</th>
                                                <th class=\"total\">EACH TOTAL</th>
                                                <th class=\"total\">TOTAL</th>
                                            </tr>
                                            </thead>
                                            <tbody>";
            if (isset($data["invoicedetails"][0]["package_name"])) {
                foreach ($data["invoicedetails"] as $detail) {
                    $invoiceText = $invoiceText . "<tr><td class=\"desc\"> " . $detail["description"] . " </td>
                                                                   <td class=\"unit\"> " . $detail["package_name"] . " </td>
                                                                   <td class=\"qty\"> " . $detail["pieces"] . " </td>
                                                                   <td> class=\"total\" " . $detail["amount"] . " </td></tr>";
                };
            }
            $invoiceText = $invoiceText . "                  </tbody>
                                            <tfoot>
                                            <tr>
                                                <td colspan=\"2\"></td>
                                                <td colspan=\"2\">SUBTOTAL(NETTO)</td>
                                                <td>";
            if (isset($data["totalinvoice"][0]["subtotal"])) {
                echo $data["totalinvoice"][0]["subtotal"];
            }
            $invoiceText = $invoiceText . "</td>
                                            </tr>
                                            <tr>
                                                <td colspan=\"2\"></td>
                                                <td colspan=\"2\">TAX (DPH)</td>
                                                <td>";
            if (isset($data["totalinvoice"][0]["tax"])) {
                echo $data["totalinvoice"][0]["tax"];
            }
            $invoiceText = $invoiceText . "</td>
                                            </tr>
                                            <tr>
                                                <td colspan=\"2\"></td>
                                                <td colspan=\"2\">GRAND TOTAL (EUR s DPH)</td>
                                                <td>";
            if (isset($data["totalinvoice"][0]["grandtotal"])) {
                echo $data["totalinvoice"][0]["grandtotal"];
            }
            $invoiceText = $invoiceText . "</td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                        <div id=\"thanks\">Thank you!</div>
                                        <div id=\"notices\">
                                            <div>NOTICE:</div>
                                            <div class=\"notice\">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                                        </div>
                                    </main>
                                    <footer>
                                        Invoice was created on a computer and is valid without the signature and seal.
                                    </footer>
                                    </body>
                                    </html>
            ";


            return $invoiceText;
        } else if ($lang_id == 57) { // Bulgarian
            $data["invoicedetails"] = $this->invoice_model->getCretaeInvoiceDetail($invoice_id);

            $data["invoice"] = $this->invoice_model->getCretaeInvoice($invoice_id);

            $related_country_kd = $data["invoice"][0]["country_kd"];
            $data["ourfirm"] = $this->invoice_model->ourfirm_account_info($related_country_kd);
            $data["totalinvoice"] = $this->invoice_model->getCretaeInvoiceTotal($invoice_id);
            $data["installmentdetails"] = $this->invoice_model->getInstallmentDetailWithInvoiceID($invoice_id);


            $invoiceText = "<div class=\"portlet box red\">
                            <div class=\"portlet-title\">
                                <div class=\"caption\"> <i class=\"fa fa-cogs\"></i>Invoice </div>
                                <div class=\"tools\"> <a href=\"javascript:;\" class=\"collapse\"> </a> <a href=\"javascript:;\" class=\"reload\"> </a> </div>
                            </div>
                            <div class=\"portlet-body\">
                               <div class=\"table-responsive\">
                                    <div class=\"invoice\">
                                        <div class=\"row invoice-logo\">
                                            <div class=\"col-xs-4 invoice-logo-space\"> <img src=\"" . base_url() . "/assets/_/logo.jpg " . "\" class=\"img-responsive\" alt=\"\" /> </div>
                                            <div class=\"col-xs-4\">
                                                <h3><p><span class=\"muted\"> Rechnung </span> </p></h3>
                                                <p>Invoice Number:";
            if (isset($data["invoice"][0]["firm_invoice_id"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["invoice_no"];

            }
            $invoiceText = $invoiceText . "</p>
                                                <p> Invoice Date : ";

            if (isset($data["invoice"][0]["invoice_dt"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["invoice_dt"];
            }
            $invoiceText = $invoiceText . " </p>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-4\">
                                                <h3>Client:</h3>
                                                <ul class=\"list-unstyled\">
                                                    <li> ";
            if (isset($data["invoice"][0]["name"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["name"];

            }
            $invoiceText = $invoiceText .
                "</li>
                                                    <li>";
            if (isset($data["invoice"][0]["adress"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["adress"];
            }

            $invoiceText = $invoiceText . " </li>                                                  
                                                </ul>
                                            </div>
                                            <div class=\"col-xs-4\">
                                                
                                                <ul class=\"list-unstyled\">
                                                    <h3><li> Pickyfy Services Invoice </li></h3>
                                                    
                                                </ul>
                                            </div>
                                         
                                            <div class=\"col-xs-4 invoice-payment\">
                                                <h3>Payment Details:</h3>
                                                <ul class=\"list-unstyled\">
                                                    <li> <strong>V.A.T Reg #:</strong>";
            if (isset($data["ourfirm"][0]["taxregisterno"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["taxregisterno"];
            }
            $invoiceText = $invoiceText . " </li>
                                                    <li> <strong>Account Name:</strong> ";
            if (isset($data["ourfirm"][0]["account_name"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["account_name"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>SWIFT code:</strong> ";
            if (isset($data["ourfirm"][0]["swift_kd"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["swift_kd"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>Firm Name:</strong>";
            if (isset($data["ourfirm"][0]["firm_name"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["firm_name"];
            }
            $invoiceText = $invoiceText . " </li>
                                                  
                                                </ul>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-12\">
                                                <table class=\"table table-striped table-hover\">
                                                    <thead>
                                                        <tr>
                                                          
                                                            <th> Service Description </th>
                                                            <th> Package </th>
                                                            <th> Pieces </th>
                                                            <th> Cost </th>                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>";


            if (isset($data["invoicedetails"][0]["package_name"])) {
                foreach ($data["invoicedetails"] as $detail) {
                    $invoiceText = $invoiceText . "<tr><td> " . $detail["description"] . " </td>
                                                                   <td> " . $detail["package_name"] . " </td>
                                                                   <td> " . $detail["pieces"] . " </td>
                                                                   <td> " . $detail["amount"] . " </td></tr>";
                };
            }

            $invoiceText = $invoiceText . "</tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-12\">
                                                <table class=\"table table-striped table-hover\">
                                                    <thead>
                                                        <tr>
                                                          
                                                        
                                                            <th> ID</th>
                                                            <th> Payment Date </th>
                                                            <th> Amount </th> 
                                                            <th> Payment Status </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>";


            if (isset($data["installmentdetails"])) {
                foreach ($data["installmentdetails"] as $detail) {
                    $invoiceText = $invoiceText . "<tr><td> " . $detail["invoice_installment_detail_id"] . " </td>
                                                                   
                                                                   <td> " . $detail["instalment_date"] . " </td>
                                                                   <td> " . $detail["instalment_amount"] . " </td>
                                                                   <td> " . $detail["payment_status"] . " </td></tr>";
                }
            }

            $invoiceText = $invoiceText . "</tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-4\">
                                                <div class=\"well\">Prepayment  :";

            if (isset($data["invoice"][0]["pre_payment_amount"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["pre_payment_amount"];
            }
            $invoiceText = $invoiceText . " </div>
                                            </div>
                                             <div class=\"col-xs-12\">
                                                    <img src=\"http://127.0.0.1/picfy//assets/_/logo.jpg\" class=\"img-responsive\"
                                                         alt=\"\" style=\"width: 100%; height:50px;\">
                                            </div>
                                            <div class=\"col-xs-8 invoice-block\" style=\"padding-left: 35%;\">
                                                <ul class=\"list-unstyled amounts \">
                                                    <li> <strong>Sub - Total amount €:</strong>";

            if (isset($data["totalinvoice"][0]["subtotal"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["subtotal"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>VAT €:</strong> ";
            if (isset($data["totalinvoice"][0]["tax"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["tax"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>Grand Total €:</strong>";
            if (isset($data["totalinvoice"][0]["grandtotal"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["grandtotal"];
            }
            $invoiceText = $invoiceText . "</li>
                                                </ul>
                                                <br/>
                                                <a class=\"btn btn-lg blue hidden-print margin-bottom-5\" onclick=\"javascript:window.print();\"> Print <i class=\"fa fa-print\"></i> </a> <a  href=\"" . base_url() . "/index.php/Invoice/PDFCreate\" class=\"btn btn-lg green hidden-print margin-bottom-5\"> Send this invoive </a> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";


            return $invoiceText;
        } else if ($lang_id == 437) { // Farsi
            $data["invoicedetails"] = $this->invoice_model->getCretaeInvoiceDetail($invoice_id);

            $data["invoice"] = $this->invoice_model->getCretaeInvoice($invoice_id);

            $related_country_kd = $data["invoice"][0]["country_kd"];
            $data["ourfirm"] = $this->invoice_model->ourfirm_account_info($related_country_kd);
            $data["totalinvoice"] = $this->invoice_model->getCretaeInvoiceTotal($invoice_id);
            $data["installmentdetails"] = $this->invoice_model->getInstallmentDetailWithInvoiceID($invoice_id);


            $invoiceText = "<div class=\"portlet box red\">
                            <div class=\"portlet-title\">
                                <div class=\"caption\"> <i class=\"fa fa-cogs\"></i>Invoice </div>
                                <div class=\"tools\"> <a href=\"javascript:;\" class=\"collapse\"> </a> <a href=\"javascript:;\" class=\"reload\"> </a> </div>
                            </div>
                            <div class=\"portlet-body\">
                               <div class=\"table-responsive\">
                                    <div class=\"invoice\">
                                        <div class=\"row invoice-logo\">
                                            <div class=\"col-xs-4 invoice-logo-space\"> <img src=\"" . base_url() . "/assets/_/logo.jpg " . "\" class=\"img-responsive\" alt=\"\" /> </div>
                                            <div class=\"col-xs-4\">
                                                <h3><p><span class=\"muted\"> Rechnung </span> </p></h3>
                                                <p>Invoice Number:";
            if (isset($data["invoice"][0]["firm_invoice_id"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["invoice_no"];

            }
            $invoiceText = $invoiceText . "</p>
                                                <p> Invoice Date : ";

            if (isset($data["invoice"][0]["invoice_dt"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["invoice_dt"];
            }
            $invoiceText = $invoiceText . " </p>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-4\">
                                                <h3>Client:</h3>
                                                <ul class=\"list-unstyled\">
                                                    <li> ";
            if (isset($data["invoice"][0]["name"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["name"];

            }
            $invoiceText = $invoiceText .
                "</li>
                                                    <li>";
            if (isset($data["invoice"][0]["adress"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["adress"];
            }

            $invoiceText = $invoiceText . " </li>                                                  
                                                </ul>
                                            </div>
                                            <div class=\"col-xs-4\">
                                                
                                                <ul class=\"list-unstyled\">
                                                    <h3><li> Pickyfy Services Invoice </li></h3>
                                                    
                                                </ul>
                                            </div>
                                         
                                            <div class=\"col-xs-4 invoice-payment\">
                                                <h3>Payment Details:</h3>
                                                <ul class=\"list-unstyled\">
                                                    <li> <strong>V.A.T Reg #:</strong>";
            if (isset($data["ourfirm"][0]["taxregisterno"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["taxregisterno"];
            }
            $invoiceText = $invoiceText . " </li>
                                                    <li> <strong>Account Name:</strong> ";
            if (isset($data["ourfirm"][0]["account_name"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["account_name"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>SWIFT code:</strong> ";
            if (isset($data["ourfirm"][0]["swift_kd"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["swift_kd"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>Firm Name:</strong>";
            if (isset($data["ourfirm"][0]["firm_name"])) {
                $invoiceText = $invoiceText . $data["ourfirm"][0]["firm_name"];
            }
            $invoiceText = $invoiceText . " </li>
                                                  
                                                </ul>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-12\">
                                                <table class=\"table table-striped table-hover\">
                                                    <thead>
                                                        <tr>
                                                          
                                                            <th> Service Description </th>
                                                            <th> Package </th>
                                                            <th> Pieces </th>
                                                            <th> Cost </th>                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>";


            if (isset($data["invoicedetails"][0]["package_name"])) {
                foreach ($data["invoicedetails"] as $detail) {
                    $invoiceText = $invoiceText . "<tr><td> " . $detail["description"] . " </td>
                                                                   <td> " . $detail["package_name"] . " </td>
                                                                   <td> " . $detail["pieces"] . " </td>
                                                                   <td> " . $detail["amount"] . " </td></tr>";
                };
            }

            $invoiceText = $invoiceText . "</tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-12\">
                                                <table class=\"table table-striped table-hover\">
                                                    <thead>
                                                        <tr>
                                                          
                                                        
                                                            <th> ID</th>
                                                            <th> Payment Date </th>
                                                            <th> Amount </th> 
                                                            <th> Payment Status </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>";


            if (isset($data["installmentdetails"])) {
                foreach ($data["installmentdetails"] as $detail) {
                    $invoiceText = $invoiceText . "<tr><td> " . $detail["invoice_installment_detail_id"] . " </td>
                                                                   
                                                                   <td> " . $detail["instalment_date"] . " </td>
                                                                   <td> " . $detail["instalment_amount"] . " </td>
                                                                   <td> " . $detail["payment_status"] . " </td></tr>";
                }
            }

            $invoiceText = $invoiceText . "</tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class=\"row\">
                                            <div class=\"col-xs-4\">
                                                <div class=\"well\">Prepayment  :";

            if (isset($data["invoice"][0]["pre_payment_amount"])) {
                $invoiceText = $invoiceText . $data["invoice"][0]["pre_payment_amount"];
            }
            $invoiceText = $invoiceText . " </div>
                                            </div>
                                             <div class=\"col-xs-12\">
                                                    <img src=\"http://127.0.0.1/picfy//assets/_/logo.jpg\" class=\"img-responsive\"
                                                         alt=\"\" style=\"width: 100%; height:50px;\">
                                            </div>
                                            <div class=\"col-xs-8 invoice-block\" style=\"padding-left: 35%;\">
                                                <ul class=\"list-unstyled amounts \">
                                                    <li> <strong>Sub - Total amount €:</strong>";

            if (isset($data["totalinvoice"][0]["subtotal"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["subtotal"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>VAT €:</strong> ";
            if (isset($data["totalinvoice"][0]["tax"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["tax"];
            }
            $invoiceText = $invoiceText . "</li>
                                                    <li> <strong>Grand Total €:</strong>";
            if (isset($data["totalinvoice"][0]["grandtotal"])) {
                $invoiceText = $invoiceText . $data["totalinvoice"][0]["grandtotal"];
            }
            $invoiceText = $invoiceText . "</li>
                                                </ul>
                                                <br/>
                                                <a class=\"btn btn-lg blue hidden-print margin-bottom-5\" onclick=\"javascript:window.print();\"> Print <i class=\"fa fa-print\"></i> </a> <a  href=\"" . base_url() . "/index.php/Invoice/PDFCreate\" class=\"btn btn-lg green hidden-print margin-bottom-5\"> Send this invoive </a> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";


            return $invoiceText;
        }

    }

    public function getFirmInstallment($invoice_id)
    {
        $_SQL = "SELECT * from firm_invoice_installment_detail where record_status=1 and invoice_id=" . $invoice_id;
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    public function test_log($txt)
    {

        $data = array();
        $data["log_txt"] = $txt;

        $phographer_delegate_id = $this->generalChangeProcess_model->insertTables("test_log", $data);
        return $phographer_delegate_id;

    }

    public function searchFirmforType($type, $firmnr, $firmNm, $district, $countkd, $city_kd)
    {

        $_SQL = "SELECT distinct *
            FROM firm_other f 
            where  f.approved_status=0 ";

        if (!empty($type)) {
            $_SQL = $_SQL . "  and  f.firm_type=" . $type;
        }

        if (!empty($firmnr)) {
            $_SQL = $_SQL . "  and  f.firm_id=" . $firmnr;
        }
        if (!empty($countkd)) {
            $_SQL = $_SQL . " and f.country_kd= " . $countkd;

        }
        if ($city_kd != "-1") {

            $_SQL = $_SQL . " and f.city_kd =" . $city_kd;
        }
        if ($district != "-1") {

            $_SQL = $_SQL . " and f.ort =" . $district;
        }
        if (!empty($firmNm)) {
            $_SQL = $_SQL . " and f.name_txt like " . "'%" . $firmNm . "%'";
        }
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    function updateInvoiceByInvoiceNO($path,$invoice_no){
        $data = array();
        $data["invoice_path"] = $path;

        $this->db->where('invoice_no',$invoice_no);
        $this->db->update('invoice',$data);

    }

}
