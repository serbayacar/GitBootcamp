<?php defined('BASEPATH') OR exit('No direct script access allowed');
class linkPayment_model extends CI_Model {
 
    
    
    function getPaymentPaidInvoiceDetail($referenceNo,$invoiceNo,$installmentDate_start,$installment_end,$paymentStatus)
    
    {
       
        $_SQL = " select  fo.firm_id,fo.name_txt,insd.invoice_installment_detail_id,insd.invoice_id,insd.instalment_amount,insd.ref_number,insd.payment_status,insd.real_invoice_id,insd.instalment_date from firm_other fo
                inner join invoice i on i.record_status=1 and i.firm_type=2 and i.firm_id=fo.firm_id
                inner join invoice_detail idt on idt.record_status=1 and idt.firm_invoice_id=i.firm_invoice_id and idt.invoice_group_id=12
                inner join firm_invoice_installment ins on ins.record_status=1 and ins.invoice_id=i.firm_invoice_id
                inner join firm_invoice_installment_detail insd on insd.record_status=1 and insd.invoice_id=ins.invoice_id
                where fo.record_status=1 ";
        
        if($referenceNo != ""){
            $_SQL .= " and insd.ref_number = '".$referenceNo."' ";
        }
        
          if($invoiceNo != ""){
            $_SQL .= " and insd.real_invoice_id =".$invoiceNo;
        }
        
        if($installmentDate_start !=''){
            $_SQL .= " and insd.instalment_date>='".$installmentDate_start."' "; 
            
             if($installment_end != ''){
                $_SQL .= "and  insd.instalment_date<='".$installment_end."' ";
             }
        
        }
        
       
        if($paymentStatus!="-1"){
            
            $_SQL .= " and insd.payment_status=".$paymentStatus;
        }
        
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    
      public function paymentUpdate($payment_installment_id,$data){

        $this->db->where("invoice_installment_detail_id",$payment_installment_id);
        $id = $this->db->update("payment",$data);
        return $id;
    }
  
}
