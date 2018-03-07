<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class searchProcess_model extends CI_Model {

    //16, 'De', 112, true, true, 1523, 'ha', $id, $id
    public function getFirmsbySearch($countkd, $firmNm, $searchlan, $event, $discnt, $citykd, $servtext, $servlang, $district) {


        $_SQL = "Select DISTINCT *
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
                
                where f.approved_status=1 ";

        $first_ort = 0;
        foreach ($district as $value) {
            if ($first_ort == 0) {
                $_SQL = $_SQL . " and il.ort in(" . $value;
                $first_ort = 1;
            } else {
                $_SQL = $_SQL . " , " . $value;
            }
        }
        if ($first_ort > 0)
            $_SQL = $_SQL . " ) ";


        $_SQL = $_SQL . "inner join countries c on c.country_kd=f.country_kd and c.record_status=1
            inner join city ct on ct.country_kd=f.country_kd and ct.city_kd=f.city_kd and ct.record_status=1
            inner join photos pt on pt.firm_id=f.firm_id and pt.record_status=1
            inner join firm_servicegiven_language sl on sl.firm_id=f.firm_id ";

        $first = 0;
        foreach ($servlang as $value) {
            if ($first == 0) {
                $_SQL = $_SQL . " and sl.language_id in(" . $value;
                $first = 1;
            } else {
                $_SQL = $_SQL . " ," . $value;
            }
        }
        if ($first > 0)
            $_SQL = $_SQL . ") ";

        if (!$event) {
            $_SQL = $_SQL . " left outer join firm_event fe on fe.firm_id=f.firm_id and fe.record_status=1 and
                    fe.firm_event_id=( SELECT max(fe1.firm_event_id) FROM firm_event fe1 where fe1.firm_id=f.firm_id)
                    left outer join firm_event_language  fev on
                    fev.firm_event_id=fe.firm_event_id and fex.language_id=fev.language_id ";
        } else {
            $_SQL = $_SQL . " inner join firm_event fe on fe.firm_id=f.firm_id and fe.record_status=1 and
                    fe.firm_event_id=( SELECT max(fe1.firm_event_id) FROM firm_event fe1 where fe1.firm_id=f.firm_id)
                    inner join firm_event_language  fev on
                    fev.firm_event_id=fe.firm_event_id and fex.language_id=fev.language_id ";
        }
        if ($discnt) {
            $_SQL = $_SQL . "  inner join firm_ticket_durumu ft on ft.firm_id=f.firm_id and ft.record_status
                   and  ft.ticket_id=( SELECT max(ft1.ticket_id) FROM firm_ticket_durumu ft1 where ft1.firm_id=f.firm_id)
                   inner JOIN firm_ticket_explanation fte on fte.ticket_id=ft.ticket_id
                   and  fte.language_id=fev.language_id  ";
        } else {
            $_SQL = $_SQL . " left outer join firm_ticket_durumu ft on ft.firm_id=f.firm_id and ft.record_status and
                   ft.ticket_id=( SELECT max(ft1.ticket_id) FROM firm_ticket_durumu ft1 where ft1.firm_id=f.firm_id)
                   left OUTER JOIN firm_ticket_explanation fte on fte.ticket_id=ft.ticket_id
                   and  fte.language_id=fev.language_id  ";
        }
        if (!empty($citykd)) {
            $_SQL = $_SQL . " and f.city_kd=" . $citykd;
        }
        $_SQL = $_SQL . " where f.country_kd= " . $countkd;
        if (!empty($firmNm)) {
            $_SQL = $_SQL . " and f.name_txt like " . "'%" . $firmNm . "%'";
        }
        $_SQL = $_SQL . " and ps.language_id= " . 112;
        
        if(isset($servtext))
        {
        $_SQL = $_SQL . " and ps.service_name_txt like " . "'%" . $servtext . "%'";
        $_SQL = $_SQL . " or gr.subservice_name like " . "'%" . $servtext . "%'";
        $_SQL = $_SQL . " and ps.service_name_txt like " . "'%" . $servtext . "%'";
        }
        $query = $this->db->query($_SQL);
        return $query->result_array();
        //return $_SQL;
        
        
        //return $_SQL;
    }

}
