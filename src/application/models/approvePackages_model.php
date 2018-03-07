<?php
class approvePackages_model extends CI_Model {
        public function getEventPackages($county_kd,$city_kd){
            
         $_SQL = "     SELECT p.firm_ourservices_photos_id, p.ourservice_cost_id, p.firm_id, p.photo_usage, p.processtype_id, p.photo_package_id,
                pp.pieces,pp.cost ,f.name_txt ,il.adress,ilt.mobile_phone,f.representive_id,concat(u.name,' ',u.surname) responsible,
                uit.mobile_phone   responsibletel
                FROM firm_ourservices_photos p
                inner join prt_generalphoto_package pp on pp.photo_pacage_id=p.photo_package_id and p.record_status=1 and p.photo_usage=1 and p.processtype_id=8
                inner join firm f on f.firm_id=p.firm_id and f.country_kd=".$county_kd." and f.city_kd=".$city_kd.
                " inner join iletisim il on il.firm_id=f.firm_id and il.record_status=1
                inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
                inner join users u on u.user_id=f.representive_id
                inner join iletisim uil on uil.user_id=u.user_id and uil.record_status=1
                inner join iletisim_tel uit on uit.iletisim_id=uil.iletisim_id ";

        $query = $this->db->query($_SQL);
        return $query->result_array();
    
    }
}
   