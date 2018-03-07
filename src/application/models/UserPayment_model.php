<?php defined('BASEPATH') OR exit('No direct script access allowed');
class userPayment_model extends CI_Model {
    
//representative için
 function getRepresentativeOurserviceTotals($user_id,$date1,$date2)
    {
         $_SQL = " select * from (
                    select i.invoice_dt,sum(convert((d.amount*k.salesrepresentative_comission) ,decimal(15,2))) com2,count(i.firm_invoice_id) count ,'Our Services'
                    from invoice i inner join invoice_detail d on d.firm_invoice_id=i.firm_invoice_id and d.invoice_group_id in(1,2,4)  and 
                    d.amount<>0 and i.invoice_dt>='".$date1."' and i.invoice_dt<='".$date2."' 
                    inner join firm f on f.firm_id=i.firm_id and f.record_status=1 and f.representive_id=".$user_id." 
                    inner join prt_general k on k.country_kd=f.country_kd and k.city_kd=f.city_kd
                    group by i.invoice_dt
                    union 
                    select i.invoice_dt, sum(convert((d.amount*k.salesrepresentative_comission) ,decimal(15,2))) com2,count(i.firm_invoice_id) count,'Registered Fee'
                    from invoice i inner join invoice_detail d on d.firm_invoice_id=i.firm_invoice_id and 
                    d.invoice_group_id=11 and 
                    d.amount<>0 and i.invoice_dt>='".$date1."' and i.invoice_dt<='".$date2."' 
                    inner join firm f on f.firm_id=i.firm_id and f.record_status=1 and f.representive_id=".$user_id."
                    inner join prt_general k on k.country_kd=f.country_kd and k.city_kd=f.city_kd
                    group by i.invoice_dt
                    union 
                    select i.invoice_dt,sum(convert(((d.amount/up.usage_month)*k.salesrepresentative_comission),decimal(15,2))) com2,count(i.firm_invoice_id) count,'Usage package monthly Payment'
                    from invoice i inner join invoice_detail d on d.firm_invoice_id=i.firm_invoice_id and d.invoice_group_id=5 and 
                    d.amount<>0
                    inner join firm f on f.firm_id=i.firm_id and f.record_status=1 and f.representive_id=".$user_id."
                    inner join firm_portal_usage p on p.firm_id=i.firm_id and p.start_dt<='".$date1."' and p.end_dt >='".$date2."' 
                    inner join prt_usage_package up on up.prt_usage_package_id=p.package_id  
                    inner join prt_general k on k.country_kd=f.country_kd and k.city_kd=f.city_kd
                    group by i.invoice_dt) t order by t.invoice_dt

                ";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    //admin icin
  function getOurserviceTotalsAllUsers($date1,$date2)
    {
         $_SQL = " select * from (
                select i.invoice_dt,sum(convert((d.amount*k.salesrepresentative_comission) ,decimal(15,2))) com2,count(i.firm_invoice_id) count ,'Our Services',f.representive_id,concat(u.name,' ',u.surname) user_name
                from invoice i inner join invoice_detail d on d.firm_invoice_id=i.firm_invoice_id and d.invoice_group_id in(1,2,4)  and 
                d.amount<>0 and i.invoice_dt>='".$date1."' and i.invoice_dt<='".$date2."' 
                inner join firm f on f.firm_id=i.firm_id and f.record_status=1 
                inner join prt_general k on k.country_kd=f.country_kd and k.city_kd=f.city_kd
                inner join users u on u.user_id=f.representive_id
                group by i.invoice_dt,f.representive_id,concat(u.name,' ',u.surname)
                union 
                select i.invoice_dt, sum(convert((d.amount*k.salesrepresentative_comission) ,decimal(15,2))) com2,count(i.firm_invoice_id) count,'Registered Fee',f.representive_id,concat(u.name,' ',u.surname) user_name
                from invoice i inner join invoice_detail d on d.firm_invoice_id=i.firm_invoice_id and d.invoice_group_id=11 and 
                d.amount<>0 and i.invoice_dt>='".$date1."' and i.invoice_dt<='".$date2."'  
                inner join firm f on f.firm_id=i.firm_id and f.record_status=1 
                inner join prt_general k on k.country_kd=f.country_kd and k.city_kd=f.city_kd
                    inner join users u on u.user_id=f.representive_id
                group by i.invoice_dt,f.representive_id,concat(u.name,' ',u.surname)
                union 
                select i.invoice_dt,sum(convert(((d.amount/up.usage_month)*k.salesrepresentative_comission),decimal(15,2))) com2,count(i.firm_invoice_id) count,'Usage package monthly Payment',f.representive_id,concat(u.name,' ',u.surname) user_name
                from invoice i inner join invoice_detail d on d.firm_invoice_id=i.firm_invoice_id and d.invoice_group_id=5 and 
                d.amount<>0
                inner join firm f on f.firm_id=i.firm_id and f.record_status=1 
                inner join firm_portal_usage p on p.firm_id=i.firm_id and p.start_dt<='".$date1."' and p.end_dt >='".$date2."' 
                inner join prt_usage_package up on up.prt_usage_package_id=p.package_id  
                inner join prt_general k on k.country_kd=f.country_kd and k.city_kd=f.city_kd
                    inner join users u on u.user_id=f.representive_id
                group by i.invoice_dt,f.representive_id,concat(u.name,' ',u.surname)) t order by t.invoice_dt
        ";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }   
   //leader icin 
     function getOurserviceTotalsLeaderUsers($user_grup_id,$date1,$date2)
    {
         $_SQL = " select * from (
                select i.invoice_dt,sum(convert((d.amount*k.salesrepresentative_comission) ,decimal(15,2))) com2,count(i.firm_invoice_id) count ,'Our Services',f.representive_id,concat(u.name,' ',u.surname) user_name
                from invoice i inner join invoice_detail d on d.firm_invoice_id=i.firm_invoice_id and d.invoice_group_id in(1,2,4)  and 
                d.amount<>0 and i.invoice_dt>='".$date1."' and i.invoice_dt<='".$date2."' 
                inner join firm f on f.firm_id=i.firm_id and f.record_status=1 
                inner join prt_general k on k.country_kd=f.country_kd and k.city_kd=f.city_kd
                inner join users u on u.user_id=f.representive_id
                inner join user_grup g on g.user_id=f.representive_id and g.group_id=".$user_grup_id." 
                group by i.invoice_dt,f.representive_id,concat(u.name,' ',u.surname)
                union 
                select i.invoice_dt, sum(convert((d.amount*k.salesrepresentative_comission) ,decimal(15,2))) com2,count(i.firm_invoice_id) count,'Registered Fee',f.representive_id,concat(u.name,' ',u.surname) user_name
                from invoice i inner join invoice_detail d on d.firm_invoice_id=i.firm_invoice_id and d.invoice_group_id=11 and 
                d.amount<>0 and i.invoice_dt>='".$date1."' and i.invoice_dt<='".$date2."' 
                inner join firm f on f.firm_id=i.firm_id and f.record_status=1 
                inner join prt_general k on k.country_kd=f.country_kd and k.city_kd=f.city_kd
                    inner join users u on u.user_id=f.representive_id
                    inner join user_grup g on g.user_id=f.representive_id and g.group_id=".$user_grup_id."
                group by i.invoice_dt,f.representive_id,concat(u.name,' ',u.surname)
                union 
                select i.invoice_dt,sum(convert(((d.amount/up.usage_month)*k.salesrepresentative_comission),decimal(15,2))) com2,count(i.firm_invoice_id) count,'Usage package monthly Payment',f.representive_id,concat(u.name,' ',u.surname) user_name
                from invoice i inner join invoice_detail d on d.firm_invoice_id=i.firm_invoice_id and d.invoice_group_id=5 and 
                d.amount<>0
                inner join firm f on f.firm_id=i.firm_id and f.record_status=1 
                inner join firm_portal_usage p on p.firm_id=i.firm_id and p.start_dt<='".$date1."' and p.end_dt >='".$date2."'
                inner join prt_usage_package up on up.prt_usage_package_id=p.package_id  
                inner join prt_general k on k.country_kd=f.country_kd and k.city_kd=f.city_kd
                    inner join users u on u.user_id=f.representive_id
                    inner join user_grup g on g.user_id=f.representive_id and g.group_id=".$user_grup_id."
                group by i.invoice_dt,f.representive_id,concat(u.name,' ',u.surname)) t order by t.invoice_dt

                ";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }   
 function getTotalsAllUsers($date1,$date2)
    {
         $_SQL = " select * from (
                select sum(convert((d.amount*k.salesrepresentative_comission) ,decimal(15,2))) com2,count(i.firm_invoice_id) count ,0 type,'Our Services',f.representive_id,concat(u.name,' ',u.surname) user_name
                from invoice i inner join invoice_detail d on d.firm_invoice_id=i.firm_invoice_id and d.invoice_group_id in(1,2,4)  and 
                d.amount<>0 and i.invoice_dt>='".$date1."' and i.invoice_dt<='".$date2."'
                inner join firm f on f.firm_id=i.firm_id and f.record_status=1 
                inner join prt_general k on k.country_kd=f.country_kd and k.city_kd=f.city_kd
                inner join users u on u.user_id=f.representive_id
                group by f.representive_id,concat(u.name,' ',u.surname)
                union 
                select sum(convert((d.amount*k.salesrepresentative_comission) ,decimal(15,2))) com2,count(i.firm_invoice_id) count,11 ,'Registered Fee',f.representive_id,concat(u.name,' ',u.surname) user_name
                from invoice i inner join invoice_detail d on d.firm_invoice_id=i.firm_invoice_id and d.invoice_group_id=11 and 
                d.amount<>0 and i.invoice_dt>='".$date1."' and i.invoice_dt<='".$date2."'  
                inner join firm f on f.firm_id=i.firm_id and f.record_status=1 
                inner join prt_general k on k.country_kd=f.country_kd and k.city_kd=f.city_kd
                    inner join users u on u.user_id=f.representive_id
                group by f.representive_id,concat(u.name,' ',u.surname)
                union 
                select sum(convert(((d.amount/up.usage_month)*k.salesrepresentative_comission),decimal(15,2))) com2,count(i.firm_invoice_id) count,5,'Usage package monthly Payment',f.representive_id,concat(u.name,' ',u.surname) user_name
                from invoice i inner join invoice_detail d on d.firm_invoice_id=i.firm_invoice_id and d.invoice_group_id=5 and 
                d.amount<>0
                inner join firm f on f.firm_id=i.firm_id and f.record_status=1 
                inner join firm_portal_usage p on p.firm_id=i.firm_id and p.start_dt<='".$date1."'
                and p.end_dt >='".$date2."' 
                inner join prt_usage_package up on up.prt_usage_package_id=p.package_id  
                inner join prt_general k on k.country_kd=f.country_kd and k.city_kd=f.city_kd
                    inner join users u on u.user_id=f.representive_id
                group by f.representive_id,concat(u.name,' ',u.surname)) t order by user_name
        ";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }   
     function getTotalDetail($user_id,$type,$date1,$date2)
    {
         if($type==0)
         {
             $_SQL = "
                select i.firm_invoice_id,i.invoice_dt,i.name,i.firm_id,i.invoice_no,d.description,d.amount,
                d.pieces,d.package_name,d.amount,1,convert((d.amount),decimal(15,2)) com1, 
                convert((d.amount*k.salesrepresentative_comission) ,decimal(15,2)) com2 from invoice i 
                inner join invoice_detail d on d.firm_invoice_id=i.firm_invoice_id and 
                d.invoice_group_id in(1,2,4)  and 
                d.amount<>0 and i.invoice_dt>='".$date1."' and i.invoice_dt<='".$date2."' 
                inner join firm f on f.firm_id=i.firm_id and f.record_status=1 and f.representive_id=".$user_id." 
                inner join prt_general k on k.country_kd=f.country_kd and k.city_kd=f.city_kd
                inner join users u on u.user_id=f.representive_id=".$user_id;    
         }
         else if($type==11)
         {
             $_SQL = "select i.firm_invoice_id,i.invoice_dt,i.name,i.firm_id,i.invoice_no,d.description,d.amount,d.pieces,d.package_name,
                   d.amount,1,convert((d.amount),decimal(15,2)) com1, convert((d.amount*k.salesrepresentative_comission) ,decimal(15,2)) com2
                     from invoice i inner join invoice_detail d on d.firm_invoice_id=i.firm_invoice_id and d.invoice_group_id=11 and 
                    d.amount<>0 and i.invoice_dt>='".$date1."' and i.invoice_dt<='".$date2."' 
                    inner join firm f on f.firm_id=i.firm_id and f.record_status=1 and f.representive_id=".$user_id."
                    inner join prt_general k on k.country_kd=f.country_kd and k.city_kd=f.city_kd "; 
             
         }
         else if($type==5)
         {
             $_SQL = " select i.firm_invoice_id,i.invoice_dt,i.name,i.firm_id,i.invoice_no,d.description,d.amount,d.pieces,d.package_name,
                    d.amount,up.usage_month,convert((d.amount/up.usage_month),decimal(15,2)) com1, convert((d.amount/up.usage_month),
                    decimal(15,2))*k.salesrepresentative_comission com2 
                    from invoice i inner join invoice_detail d on d.firm_invoice_id=i.firm_invoice_id and d.invoice_group_id=5 and 
                    d.amount<>0
                    inner join firm f on f.firm_id=i.firm_id and f.record_status=1 and f.representive_id=".$user_id."
                    inner join firm_portal_usage p on p.firm_id=i.firm_id and p.start_dt<='".$date1."' and p.end_dt >='".$date2."' 
                    inner join prt_usage_package up on up.prt_usage_package_id=p.package_id  
                    inner join prt_general k on k.country_kd=f.country_kd and k.city_kd=f.city_kd
                    ";  
         }
         
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }   
    public function createDailyEnd($date1)
    {
        $user_id=$this->session->userdata('user_id');
        $dateTime = date('Y-m-d H:i:s');
       $notusage=$this->getPaymentNotUsagePackage($date1);
       $count =0;
       $ay="01";
       $yil=substr($date1,0,4);      
       
         if(substr($date1,5,2)=="01")
            $ay="02";
         else if(substr($date1,5,2)=="02")
            $ay="03";
         else if(substr($date1,5,2)=="03")
            $ay="04";
         else if(substr($date1,5,2)=="04")
            $ay="05";
         else if(substr($date1,5,2)=="05")
            $ay="06";
         else if(substr($date1,5,2)=="06")
            $ay="07";
         else if(substr($date1,5,2)=="07")
            $ay="08";
         else if(substr($date1,5,2)=="08")
            $ay="09";
         else if(substr($date1,5,2)=="09")
            $ay="10";
         else if(substr($date1,5,2)=="10")
            $ay="11";
         else if(substr($date1,5,2)=="11")
            $ay="12";
         else if(substr($date1,5,2)=="12")
         {
            $ay="01";
            $yil="2017";
         }
         $d=$yil."-".$ay."-01";
            
       
       foreach($notusage as $value)
       {
           $data=array();
           $data["user_id"]=$value["user_id"];
           $data["firm_id"]=$value["firm_id"];
           $data["invoice_id"]=$value["firm_invoice_id"];
           $data["invoice_dt"]=$value["invoice_dt"];
           $data["invoice_no"]=$value["invoice_no"];
           $data["invoice_group_id"]=$value["invoice_group_id"];
           $data["invoice_amount"]=$value["invoice_amount"];
           $data["commission"]=$value["salesrepresentative_comission"];
           $data["user_payment"]=$value["payment"];
           $data["monthly_payment"]=$value["payment"];
           $data["representative_status"]=1;
           $data["photographer_status"]=0;
           $data["leader_status"]=0;
           $data["translater_status"]=0;
           $data["usage_month"]=1;
           $data["payment_dt"]= $d;
           $data["paid_dt"]=null;
           $data["payment_account_id"]=null;
           $data["daily_end_dt"]=$date1;
           $data["payment_status"]=0;
           $data["record_status"]=1;
           $data["insert_dt"]=$dateTime;
           $data["insert_user_id"]=$user_id;
           $data["update_dt"]=$dateTime;
           $data["update_user_id"]=$user_id;
           $data["detail_amount"]=$value["amount"];
            $data["photo_pieces"]=0;
            $data["translater_delegate_id"]=0;
           $this->generalChangeProcess_model->insertTables('user_payment_detail',$data);
           $count=$count+1;
       }
       $photo=$this->getPaymentPhotos($date1);
       
       foreach($photo as $value)
       {
          
           $data=array();
           $data["user_id"]=$value["phographer_id"];
           $data["firm_id"]=$value["firm_id"];
           $data["invoice_id"]=0;
           $data["invoice_dt"]=0;
           $data["invoice_no"]=0;
           $data["invoice_group_id"]=4;
           $data["invoice_amount"]=0;
           $data["commission"]=$value["photo_cost"];
           $data["user_payment"]=$value["total_cost"];
           $data["monthly_payment"]=$value["total_cost"];
           $data["representative_status"]=0;
           $data["photographer_status"]=1;
           $data["leader_status"]=0;
           $data["translater_status"]=0;
           $data["usage_month"]=1;
           $data["payment_dt"]= $d;
           $data["paid_dt"]=null;
           $data["payment_account_id"]=null;
           $data["daily_end_dt"]=$date1;
           $data["payment_status"]=0;
           $data["record_status"]=1;
           $data["insert_dt"]=$dateTime;
           $data["insert_user_id"]=$user_id;
           $data["update_dt"]=$dateTime;
           $data["update_user_id"]=$user_id;
           $data["detail_amount"]=$value["photo_cost"];
           $data["photo_pieces"]=$value["pieces"];
           $data["translater_delegate_id"]=0;
           $this->generalChangeProcess_model->insertTables('user_payment_detail',$data);
           $count=$count+1;
       }
       
       
       $translater=$this->getPaymentTranslater($date1);
      
       foreach($translater as $value)
       {
          
           $data=array();
           $data["user_id"]=$value["user_id"];
           $data["firm_id"]=$value["firm_id"];
           $data["invoice_id"]=0;
           $data["invoice_dt"]=0;
           $data["invoice_no"]=0;
           $data["invoice_group_id"]=0;
           $data["invoice_amount"]=0;
           $data["commission"]=$value["translater_cost"];
           $data["user_payment"]=$value["translater_cost"];
           $data["monthly_payment"]=$value["translater_cost"];
           $data["representative_status"]=0;
           $data["photographer_status"]=0;
           $data["leader_status"]=0;
           $data["translater_status"]=1;
           $data["usage_month"]=1;
           $data["payment_dt"]= $d;
           $data["paid_dt"]=null;
           $data["payment_account_id"]=null;
           $data["daily_end_dt"]=$date1;
           $data["payment_status"]=0;
           $data["record_status"]=1;
           $data["insert_dt"]=$dateTime;
           $data["insert_user_id"]=$user_id;
           $data["update_dt"]=$dateTime;
           $data["update_user_id"]=$user_id;
           $data["detail_amount"]=$value["translater_cost"];
           $data["photo_pieces"]=0;
           $data["translater_delegate_id"]=$value["translater_delegate_id"];
           $this->generalChangeProcess_model->insertTables('user_payment_detail',$data);
           $count=$count+1;
       }
       
       $usage=$this->getPaymentUsagePackage($date1);
      
       foreach($usage as $value)
             {
           $start_dt=$value["user_id"];
           $i=0;
           $i_end=$value["usage_month"];
            $ay=substr($date1,5,2);
            $new_ay=substr($date1,5,2);
            $yil=substr($date1,0,4);     
           while($i<12)
           {
                    if($new_ay=="01")
                   {
                      $new_ay="02";
                   }
                   else if($new_ay=="02")
                   {
                      $new_ay="03";
                   }
                   else if($new_ay=="03")
                   {        
                       $new_ay="04";
                   }
                   else if($new_ay=="04")
                   {
                      $new_ay="05";
                   }
                   else if($new_ay=="05")
                   {
                            $new_ay="06";
                   }
                   else if($new_ay=="06")
                   {
                      $new_ay="07";
                   }
                   else if($new_ay=="07")
                   {
                 
                      $new_ay="08";
                   }
                   else if($new_ay=="08")
                   {
              
                      $new_ay="09";
                   }
                   else if($new_ay=="09")
                   {
                
                      $new_ay="10";
                   }
                   else if($new_ay=="10")
                   {
               
                      $new_ay="11";
                   }
                   else if($new_ay=="11")
                   {
                    
                      $new_ay="12";
                   }
                   else if($new_ay=="12")
                   {
                     
                      $new_ay="01";
                      $yil=substr($date1,0,4)+1;
                   }
                   $d_new=$yil."-".$new_ay."-01";

              $data=array();
              $data["user_id"]=$value["user_id"];
              $data["firm_id"]=$value["firm_id"];
              $data["invoice_id"]=$value["firm_invoice_id"];
              $data["invoice_dt"]=$value["invoice_dt"];
              $data["invoice_no"]=$value["invoice_no"];
              $data["invoice_group_id"]=$value["invoice_group_id"];
              $data["invoice_amount"]=$value["invoice_amount"];
              $data["commission"]=$value["salesrepresentative_comission"];
              $data["user_payment"]=$value["payment"];
              $data["monthly_payment"]=$value["payment"];
              $data["usage_month"]=$value["usage_month"];
              $data["payment_dt"]= $d_new;
              $data["representative_status"]=1;
              $data["photographer_status"]=0;
              $data["leader_status"]=0;
              $data["translater_status"]=0;
              $data["payment_account_id"]=null;
              $data["daily_end_dt"]=$date1;
              $data["payment_status"]=0;
              $data["record_status"]=1;
              $data["paid_dt"]=null;
              $data["insert_dt"]=$dateTime;
              $data["insert_user_id"]=$user_id;
              $data["update_dt"]=$dateTime;
              $data["update_user_id"]=$user_id;
              $data["detail_amount"]=$value["amount"];
                $data["photo_pieces"]=0;
              $data["translater_delegate_id"]=0;
                
              $this->generalChangeProcess_model->insertTables('user_payment_detail',$data);
                  $count=$count+1;
                  $i=$i+1;
           }
       }
       
       return $count." pieces inserted for ".$date1;
         
    }
    function getPaymentNotUsagePackage($date1)
    {
         $_SQL = "SELECT i.user_id,i.firm_id,i.firm_invoice_id,i.invoice_dt,i.invoice_no,d.invoice_group_id,i.amount invoice_amount,
                g.salesrepresentative_comission,(d.amount*g.salesrepresentative_comission) payment,d.amount
                FROM invoice i inner join invoice_detail d on d.firm_invoice_id=i.firm_invoice_id and d.invoice_group_id in (11,1,2,3,4)
                inner join firm f on f.firm_id=i.firm_id 
                inner join prt_general g on g.country_kd=f.country_kd and f.city_kd=g.city_kd
                where i.invoice_dt='".$date1."'

                ";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
      function getPaymentUsagePackage($date1)
    {
         $_SQL = " SELECT i.user_id,i.firm_id,i.firm_invoice_id,i.invoice_dt,i.invoice_no,d.invoice_group_id,i.amount invoice_amount,
        g.salesrepresentative_comission,d.amount,convert(((d.amount/up.usage_month)*g.salesrepresentative_comission),decimal(18,2)) payment,
        up.usage_month,u.start_dt
        FROM invoice i inner join invoice_detail d on d.firm_invoice_id=i.firm_invoice_id and d.invoice_group_id =5
        inner join firm f on f.firm_id=i.firm_id 
        inner join firm_portal_usage u on u.firm_id=f.firm_id
        inner join prt_usage_package up on up.prt_usage_package_id=u.package_id
        inner join prt_general g on g.country_kd=f.country_kd and f.city_kd=g.city_kd
        where i.invoice_dt='".$date1."'";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
          function getPaymentPhotos($date1)
    {
         $_SQL =" SELECT d.phographer_id,g.photo_cost,g.photo_cost total_cost,d.pieces,f.firm_id FROM  photographer_delegate d inner join firm f on f.firm_id=d.firm_id
            inner join prt_general g on g.country_kd=f.country_kd and g.city_kd=f.city_kd
            WHERE d.completed_status=1 and d.myfinish_dt='".$date1."'
            and d.firm_photo_package_id=7
            union 
            SELECT d.phographer_id,g.photo_cost,(g.photo_cost*d.pieces),d.pieces,f.firm_id FROM 
            photographer_delegate d inner join firm f on f.firm_id=d.firm_id and d.firm_photo_package_id<>7
            inner join prt_general g on g.country_kd=f.country_kd and g.city_kd=f.city_kd
            WHERE d.completed_status=1 and d.myfinish_dt='".$date1."'";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    function getPaymentTranslater($date1)
    {
         $_SQL ="  select t.user_id,t.firm_id,t.translater_delegate_id,g.translater_cost FROM translater_delegate t inner join firm f on f.firm_id=t.firm_id
        inner join prt_general g on g.country_kd=f.country_kd and g.city_kd=f.city_kd and t.process_dt='".$date1."'";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
  
     function getSaveAllPayments($date1)
    {
         $_SQL = " SELECT `user_payment_id`, `user_id`, `firm_id`, 
             `invoice_id`, `invoice_dt`, `invoice_no`, `invoice_group_id`, 
             `invoice_amount`, `commission`, `user_payment`, `monthly_payment`, 
             `usage_month`, `payment_dt`, `payment_account_id`, `daily_end_dt`,
             `payment_status`, `record_status`, `insert_dt`, `insert_user_id`, 
             `update_dt`, `update_user_id`, 
            `detail_amount` FROM `user_payment_detail` WHERE daily_end_dt='".$date1."'

                ";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
     function getDailyEnds()
    {
         $_SQL = " SELECT distinct d.daily_end_dt FROM user_payment_detail d 
             order by d.daily_end_dt";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
       function getAllTotalUserPayment($date1)
    {
         $_SQL = " SELECT d.user_id,concat(u.name,' ',u.surname) user_name,sum(d.user_payment) payment,
             uc.acount_iban,uc.bank_id,uc.BIC FROM user_payment_detail d 
             inner join users u on u.user_id=d.user_id and d.payment_status=0
             and d.payment_dt='".$date1."'
            inner join user_bank_account uc on uc.user_id=u.user_id and u.record_status=1
            group by d.user_id,concat(u.name,' ',u.surname)";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    function getAllTotalUserPaidbyUserId($user_id,$date1)
    {
         $_SQL = " SELECT d.user_id,concat(u.name,' ',u.surname) user_name,sum(d.user_payment) payment,
             uc.acount_iban,uc.bank_id,uc.BIC FROM user_payment_detail d 
             inner join users u on u.user_id=d.user_id and d.payment_status=1 and d.user_id=".$user_id."
             and d.payment_dt='".$date1."'
            inner join user_bank_account uc on uc.user_id=u.user_id and u.record_status=1
            group by d.user_id,concat(u.name,' ',u.surname)";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
       function getAllTotalUserPaymentbyUser($user_id,$date1)
    {
         $_SQL = " SELECT d.user_id,concat(u.name,' ',u.surname) user_name,sum(d.user_payment) payment,
             uc.acount_iban,uc.bank_id,uc.BIC FROM user_payment_detail d 
             inner join users u on u.user_id=d.user_id and d.payment_status=0 and d.user_id=".$user_id."
             and d.payment_dt='".$date1."'
            inner join user_bank_account uc on uc.user_id=u.user_id and u.record_status=1
            group by d.user_id,concat(u.name,' ',u.surname)";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    function getAllTotalUserPaid($date1)
    {
         $_SQL = " SELECT d.user_id,concat(u.name,' ',u.surname) user_name,sum(d.user_payment) payment,
             uc.acount_iban,uc.bank_id,uc.BIC FROM user_payment_detail d 
             inner join users u on u.user_id=d.user_id and d.payment_status=1
             and d.payment_dt='".$date1."'
            inner join user_bank_account uc on uc.user_id=u.user_id and u.record_status=1
            group by d.user_id,concat(u.name,' ',u.surname)";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
        function getAllDetailUserPayment($date1,$user_id)
    {
         $_SQL = " SELECT d.user_payment_id,d.user_id,d.firm_id,d.invoice_id,d.invoice_dt,d.invoice_amount,
             d.invoice_no,d.user_payment_id,d.commission,d.monthly_payment,d.detail_amount,
             ig.name invoice_group,d.usage_month,f.name_txt  FROM user_payment_detail d 
             inner join users u on u.user_id=d.user_id and d.user_id=".$user_id." and d.payment_status=0
              and d.payment_dt='".$date1."' 
            inner join user_bank_account uc on uc.user_id=u.user_id and u.record_status=1
            inner join prt_invoivegroup ig on ig.prt_invoivegroup_id=d.invoice_group_id
            inner join firm f on f.firm_id=d.firm_id";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
      function getAllDetailUserPaid($date1,$user_id)
    {
         $_SQL = " SELECT d.user_payment_id,d.user_id,d.firm_id,d.invoice_id,d.invoice_dt,d.invoice_amount,
             d.invoice_no,d.user_payment_id,d.commission,d.monthly_payment,d.detail_amount,
             ig.name invoice_group,d.usage_month,f.name_txt  FROM user_payment_detail d 
             inner join users u on u.user_id=d.user_id and d.user_id=".$user_id." and d.payment_status=1
              and d.payment_dt='".$date1."' 
            inner join user_bank_account uc on uc.user_id=u.user_id and u.record_status=1
            inner join prt_invoivegroup ig on ig.prt_invoivegroup_id=d.invoice_group_id
            inner join firm f on f.firm_id=d.firm_id";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }
    function getUserPayment($userid)
    {
         $_SQL = " SELECT convert(d.payment_dt,date) payment_dt, sum(d.user_payment) FROM 
             user_payment_detail d inner join users u on u.user_id=d.user_id 
            inner join user_bank_account uc on uc.user_id=u.user_id and u.record_status=1 and u.user_id=".$userid."
             group by d.payment_dt";
     
        $query = $this->db->query($_SQL);
        return $query->result_array();
    }

    public function paymentUpdate($payment_user_id,$payment_dt,$bankID,$data){

        $this->db->where("user_id",$payment_user_id);
        $this->db->where("payment_dt",$payment_dt);
        $id = $this->db->update("user_payment_detail",$data);
        return $id;
    }

    
    
  
}
