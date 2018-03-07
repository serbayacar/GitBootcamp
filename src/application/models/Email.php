<?php
require("class.phpmailer.php");
class email extends CI_Model
{
//outlook ve yandex icin tls,587,outlook:smtp.live.com,yahoo:smtp.yandex.com
//gmail icin  smtp.gmail.com
    function passwordChange($users_email, $host, $language, $alias, $header, $HTMLcontent, $hostemail, $hostpwd, $smtp_secure, $port)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 1; // hata ayiklama: 1 = hata ve mesaj, 2 = sadece mesaj
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = $smtp_secure; // Güvenli baglanti icin ssl normal baglanti icin tls
        $mail->Host = trim($host); // Mail sunucusunun ismi
        $mail->Port = $port; // Guvenli baglanti icin 465 Normal baglanti icin 587
        $mail->IsHTML(true);
        $mail->SetLanguage(trim($language), "phpmailer/language");
        $mail->CharSet = "utf-8";
        $mail->Username = trim($hostemail); // Mail adresimizin kullanicı adi
        $mail->Password = trim($hostpwd); // Mail adresimizin sifresi
        $mail->SetFrom(trim($hostemail), trim($alias)); // Mail attigimizda gorulecek ismimiz
        for ($i = 0; $i < count($users_email); $i++) {
            $mail->AddAddress($users_email[$i]); // Maili gonderecegimiz kisi yani alici
        }
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->Subject = trim($header); // Konu basligi
        $mail->MsgHTML($HTMLcontent);// Mailin icerigi
        if (!$mail->Send()) {
            //return "Mailer Error: ".$mail->ErrorInfo;
            return false;
        } else {
            return true;
        }
    }

    function contactus_mail($users_email, $host, $language, $alias, $header, $HTMLcontent, $hostemail, $hostpwd, $smtp_secure, $port)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 1; // hata ayiklama: 1 = hata ve mesaj, 2 = sadece mesaj
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = $smtp_secure; // Güvenli baglanti icin ssl normal baglanti icin tls
        $mail->Host = trim($host); // Mail sunucusunun ismi
        $mail->Port = $port; // Guvenli baglanti icin 465 Normal baglanti icin 587
        $mail->IsHTML(true);
        $mail->SetLanguage(trim($language), "phpmailer/language");
        $mail->CharSet = "utf-8";
        $mail->Username = trim($hostemail); // Mail adresimizin kullanicı adi
        $mail->Password = trim($hostpwd); // Mail adresimizin sifresi
        $mail->SetFrom(trim($hostemail), trim($alias)); // Mail attigimizda gorulecek ismimiz
       
        $mail->AddAddress($users_email); // Maili gonderecegimiz kisi yani alici
        
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->Subject = trim($header); // Konu basligi
        $mail->MsgHTML($HTMLcontent);// Mailin icerigi
        if (!$mail->Send()) {
            return "Mailer Error: " . $mail->ErrorInfo;
            //return false;
        } else {
            return true;
        }
    }

    function toRepresentativeMail($users_email, $host, $language, $alias, $header, $HTMLcontent, $hostemail, $hostpwd, $smtp_secure, $port)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 1; // hata ayiklama: 1 = hata ve mesaj, 2 = sadece mesaj
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = $smtp_secure; // Güvenli baglanti icin ssl normal baglanti icin tls
        $mail->Host = trim($host); // Mail sunucusunun ismi
        $mail->Port = $port; // Guvenli baglanti icin 465 Normal baglanti icin 587
        $mail->IsHTML(true);
        $mail->SetLanguage(trim($language), "phpmailer/language");
        $mail->CharSet = "utf-8";
        $mail->Username = trim($hostemail); // Mail adresimizin kullanicı adi
        $mail->Password = trim($hostpwd); // Mail adresimizin sifresi
        $mail->SetFrom(trim($hostemail), trim($alias)); // Mail attigimizda gorulecek ismimiz
        for ($i = 0; $i < count($users_email); $i++) {
            $mail->AddAddress($users_email[$i]); // Maili gonderecegimiz kisi yani alici
        }
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->Subject = trim($header); // Konu basligi
        $mail->MsgHTML($HTMLcontent);// Mailin icerigi
        if (!$mail->Send()) {
            //return "Mailer Error: ".$mail->ErrorInfo;
            return false;
        } else {
            return true;
        }
    }

    /*
    function inMail($users_email,$host,$language,$alias,$header,$HTMLcontent,$hostemail,$hostpwd,$smtp_secure,$port){
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 1; // hata ayiklama: 1 = hata ve mesaj, 2 = sadece mesaj
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = $smtp_secure; // Güvenli baglanti icin ssl normal baglanti icin tls
        $mail->Host = trim($host); // Mail sunucusunun ismi
        $mail->Port = $port; // Guvenli baglanti icin 465 Normal baglanti icin 587
        $mail->IsHTML(true);
        $mail->SetLanguage(trim($language), "phpmailer/language");
        $mail->CharSet  ="utf-8";
        $mail->Username = trim($hostemail); // Mail adresimizin kullanicı adi
        $mail->Password = trim($hostpwd); // Mail adresimizin sifresi
        $mail->SetFrom(trim($hostemail), trim($alias)); // Mail attigimizda gorulecek ismimiz
        for($i=0;$i<count($users_email);$i++){
        $mail->AddAddress($users_email[$i]); // Maili gonderecegimiz kisi yani alici
        }
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->Subject = trim($header); // Konu basligi
        $mail->MsgHTML($HTMLcontent);// Mailin icerigi
        if(!$mail->Send()){
                //return "Mailer Error: ".$mail->ErrorInfo;
            return false;
        } else {
                return true;
        }
    }
    */
    function MailToFirm($firm_email, $host, $language, $alias, $header, $HTMLcontent, $hostemail, $hostpwd, $smtp_secure, $port)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 1; // hata ayiklama: 1 = hata ve mesaj, 2 = sadece mesaj
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = $smtp_secure; // Güvenli baglanti icin ssl normal baglanti icin tls
        $mail->Host = trim($host); // Mail sunucusunun ismi
        $mail->Port = $port; // Guvenli baglanti icin 465 Normal baglanti icin 587
        $mail->IsHTML(true);
        $mail->SetLanguage(trim($language), "phpmailer/language");
        $mail->CharSet = "utf-8";
        $mail->Username = trim($hostemail); // Mail adresimizin kullanicı adi
        $mail->Password = trim($hostpwd); // Mail adresimizin sifresi
        $mail->SetFrom(trim($hostemail), trim($alias)); // Mail attigimizda gorulecek ismimiz

        $mail->AddAddress($firm_email); // Maili gonderecegimiz kisi yani alici

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->Subject = trim($header); // Konu basligi
        $mail->MsgHTML($HTMLcontent);// Mailin icerigi
        if (!$mail->Send()) {
            //return "Mailer Error: ".$mail->ErrorInfo;
            return false;
        } else {
            return true;
        }
    }


    function MailToUser($user_email, $host, $language, $alias, $header, $HTMLcontent, $hostemail, $hostpwd, $smtp_secure, $port)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 1; // hata ayiklama: 1 = hata ve mesaj, 2 = sadece mesaj
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = $smtp_secure; // Güvenli baglanti icin ssl normal baglanti icin tls
        $mail->Host = trim($host); // Mail sunucusunun ismi
        $mail->Port = $port; // Guvenli baglanti icin 465 Normal baglanti icin 587
        $mail->IsHTML(true);
        $mail->SetLanguage(trim($language), "phpmailer/language");
        $mail->CharSet = "utf-8";
        $mail->Username = trim($hostemail); // Mail adresimizin kullanicı adi
        $mail->Password = trim($hostpwd); // Mail adresimizin sifresi
        $mail->SetFrom(trim($hostemail), trim($alias)); // Mail attigimizda gorulecek ismimiz

        $mail->AddAddress($user_email); // Maili gonderecegimiz kisi yani alici

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->Subject = trim($header); // Konu basligi
        $mail->MsgHTML($HTMLcontent);// Mailin icerigi
        if (!$mail->Send()) {
            //return "Mailer Error: ".$mail->ErrorInfo;
            return false;
        } else {
            return true;
        }


    }

    function MailInvoice($user_email, $host, $language, $alias, $header, $HTMLcontent, $hostemail, $hostpwd, $smtp_secure, $port,$my_path)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 1; // hata ayiklama: 1 = hata ve mesaj, 2 = sadece mesaj
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = $smtp_secure; // Güvenli baglanti icin ssl normal baglanti icin tls
        $mail->Host = trim($host); // Mail sunucusunun ismi
        $mail->Port = $port; // Guvenli baglanti icin 465 Normal baglanti icin 587
        $mail->IsHTML(true);
        $mail->SetLanguage(trim($language), "phpmailer/language");
        $mail->CharSet = "utf-8";
        $mail->Username = trim($hostemail); // Mail adresimizin kullanicı adi
        $mail->Password = trim($hostpwd); // Mail adresimizin sifresi
        $mail->SetFrom(trim($hostemail), trim($alias)); // Mail attigimizda gorulecek ismimiz

        $mail->AddAddress($user_email); // Maili gonderecegimiz kisi yani alici
        $mail->AddAttachment($my_path);
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->Subject = trim($header); // Konu basligi
        $mail->MsgHTML($HTMLcontent);// Mailin icerigi
        if (!$mail->Send()) {
            //return "Mailer Error: ".$mail->ErrorInfo;
            $deger = false;
        } else {
            $deger = true;
        }


        json_encode($deger);


    }

}

?>