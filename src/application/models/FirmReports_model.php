<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class firmReports_model extends CI_Model {
    
 public function getFirmInvoices($firmid) {

        $_SQL = "SELECT i.firm_invoice_id,i.invoice_dt,i.amount,i.pre_payment_amount,i.invoice_no FROM invoice i  where i.firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
 public function getFirmInstallment($firmid) {

        $_SQL = "SELECT inv.firm_invoice_id,inv.invoice_no,inv.invoice_dt,d.instalment_no,
            d.instalment_date,d.instalment_amount,
        case when d.payment_status=0 then 'not paid' else 'paid' end payment_status,p.payment,
        p.process_dt
        FROM firm_invoice_installment i inner join firm_invoice_installment_detail d
        on d.invoice_id=i.invoice_id and i.record_status=1 and d.record_status=1
        inner join invoice inv on inv.firm_invoice_id=d.invoice_id 
        left outer join payment p on p.invoice_id=d.invoice_id and 
        p.invoice_installment_detail_id=d.invoice_installment_detail_id and p.record_status=1
        where inv.firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
     public function getFirmPayments($firmid) {

        $_SQL = " select i.firm_invoice_id,i.invoice_dt,p.payment,p.process_dt,p.payment_account,i.pre_payment_amount,d.instalment_amount,
        d.instalment_no ,d.instalment_date from payment p inner join firm_invoice_installment_detail d on d.invoice_installment_detail_id=p.invoice_installment_detail_id 
        inner join invoice i on i.firm_invoice_id=d.invoice_id
        where i.firm_id=" . $firmid;

        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
   
    
    

    
 }
