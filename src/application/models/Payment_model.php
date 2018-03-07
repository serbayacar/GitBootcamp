<?php
class payment_model extends CI_Model {

function getAllInvoices($firm_id)
     {
     $_SQL = "SELECT `firm_invoice_id`, `firm_id`, `invoice_dt`, `user_id`, `language_id`, `invoice_sendtype_id`, `paid_status`, `currency_kd`, `firm_adress`, `name`, `net`, `tax`, `country_kd`, `city_kd`, `prepayment_status`, `amount`, 
        `pre_payment_amount`, `record_status`, `insert_user_id`, `update_user_id`, `insert_dt`, `update_dt` FROM `invoice` where firm_id=".$firm_id;
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }  
    function getAllPayments($invoice_id)
     {
     $_SQL = "SELECT p.firm_payment_id, i.firm_id, i.firm_invoice_id,i.amount,i.invoice_dt,i.paid_status, p.payment_type, 
         p.payment, p.process_dt, p.expire_dt, p.currency_kd, p.prepayment_status, p.explanation, p.payment_account,
        t.payment_explanation_txt , p.paid_account,p.invoice_installment_detail_id
        FROM  invoice i inner join payment p on i.firm_id=p.firm_id and i.firm_invoice_id=p.invoice_id and i.record_status=1
        inner join prt_payment_type t on p.payment_type=t.payment_tip_id where i.firm_invoice_id=".$invoice_id;
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
     } 
         function getAllPaidForAdmin($country_kd,$date1,$date2)
     {
     $_SQL = "   SELECT d.invoice_installment_detail_id, i.firm_id,f.name_txt, i.firm_invoice_id,i.amount,
        i.invoice_dt,i.invoice_no,i.invoice_dt,
        i.paid_status,i.amount, d.instalment_no,d.instalment_date,d.instalment_amount,
        i.pre_payment_amount,(select sum(di.instalment_amount) from 
        firm_invoice_installment_detail di where di.invoice_id=d.invoice_id and d.payment_status=1) 
        paid_amount,d.payment_status,pp.payment,pp.process_dt,
        inv.installment_count,pp.firm_payment_id
        FROM  invoice i 
        inner join firm f on f.firm_id=i.firm_id 
        inner join firm_invoice_installment_detail d on d.invoice_id=i.firm_invoice_id 
        and d.record_status=1  
        inner join firm_invoice_installment inv on inv.invoice_id=d.invoice_id  
        inner join payment pp on pp.invoice_id=d.invoice_id and pp.invoice_installment_detail_id=d.invoice_installment_detail_id
        where d.instalment_date between '".$date1."' and '".$date2."' order by f.name_txt";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }         
   function getAllPaymentsForAdmin($country_kd,$date1,$date2)
     {
     $_SQL = "          
        SELECT  d.invoice_installment_detail_id,i.firm_id,f.name_txt, i.firm_invoice_id,i.amount,i.invoice_dt,
        i.paid_status,i.amount, d.instalment_no,d.instalment_date,d.instalment_amount,
        i.pre_payment_amount,(select sum(di.instalment_amount) from 
        firm_invoice_installment_detail di where di.invoice_id=d.invoice_id and d.payment_status=1) 
        paid_amount,
        inv.installment_count,d.instalment_amount
        FROM  invoice i 
        inner join firm f on f.firm_id=i.firm_id and f.country_kd=".$country_kd."
        inner join firm_invoice_installment_detail d on d.invoice_id=i.firm_invoice_id and d.record_status=1 and d.payment_status=0
        inner join firm_invoice_installment inv on inv.invoice_id=d.invoice_id   where 
        d.instalment_date between '".$date1."' and '".$date2."' order by d.instalment_date" ;
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }  
      function getPaymentbyInstallmentId($installment_id)
     {
     $_SQL = "          
        SELECT d.invoice_installment_detail_id, i.firm_id,f.name_txt, i.firm_invoice_id,i.amount,
        i.invoice_dt,
        i.paid_status,i.amount, d.instalment_no,d.instalment_date,d.instalment_amount,
        i.pre_payment_amount,(select sum(di.instalment_amount) from 
        firm_invoice_installment_detail di where di.invoice_id=d.invoice_id and d.payment_status=1) 
        paid_amount,d.payment_status,
        inv.installment_count,pp.firm_payment_id
        FROM  invoice i 
        inner join firm f on f.firm_id=i.firm_id 
        inner join firm_invoice_installment_detail d on d.invoice_id=i.firm_invoice_id 
        and d.record_status=1  
        inner join firm_invoice_installment inv on inv.invoice_id=d.invoice_id  
        left outer join payment pp on pp.invoice_id=i.invoice_dt 
        and pp.invoice_installment_detail_id=d.invoice_installment_detail_id 
        where 
        d.invoice_installment_detail_id =". $installment_id ;
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }    
  
    /*
         function getAllPaymentsForAdmin($country_kd)
     {
     $_SQL = "select p.firm_payment_id,p.invoice_id,p.payment_type,p.payment,p.process_dt,
         case when p.expire_dt='0000-00-00 00:00:00' then '' else p.expire_dt end  expire_dt,p.currency_kd,p.prepayment_status,p.payment_account,f.firm_id,
         p.paid_account,f.name_txt, case when p.record_status=2 then 'Canceled' else '-' end Status,i.amount
        from payment p inner join firm f on f.firm_id=p.firm_id and f.country_kd=".$country_kd."
         inner join invoice i on i.firm_invoice_id=p.invoice_id ";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }  */
     
function getPaymentDetail($payment_id)
     {
     $_SQL = "SELECT `firm_payment_id`, `firm_id`, `invoice_id`, `payment_type`, `payment`, `process_dt`, `expire_dt`, `currency_kd`, `prepayment_status`, 
         `explanation`, `approved_status`, `approver_user_id`, 
         `approved_dt`, `record_status`, `insert_user_id`, `insert_dt`, `update_user_id`, 
         `update_dt`, `payment_account` FROM `payment` where firm_payment_id=".$payment_id;
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
     }  
     public function getFirmAllContactInfoFirmId($firmid) {

        $_SQL = "SELECT f.name_txt,f.firm_id,il.email,il.webpage,il.facebook,il.adress,
            ct.Name country,cy.Name city,il.iletisim_id,il.ort distict,il.instagram, il.twitter,
            ilt.phone,ilt.mobile_phone,ilt.fax,il.country_kd,il.city_kd 
           
            FROM `firm` f
            inner join iletisim il on il.firm_id=f.firm_id and f.approved_status=1
            inner join countries ct on ct.country_kd=il.country_kd
            inner join iletisim_tel ilt on ilt.iletisim_id=il.iletisim_id and ilt.record_status=1
            inner join city cy on cy.city_kd=il.city_kd where f.firm_id=".$firmid;
           
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
     public function getFirmHeadInfobyFirmId($firmid) {

        $_SQL = "SELECT * FROM `firm` WHERE firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
     

}