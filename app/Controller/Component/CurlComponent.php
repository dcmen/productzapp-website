<?php
App::uses('Component', 'Controller');
App::import('Vendor', 'phpmailer', array('file' => 'phpmailer'.DS.'class.phpmailer.php'));
class CurlComponent extends Component {
    function send_mail_smtp_bcc($to, $cc, $bcc, $subject,$content){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->CharSet="utf-8";
        $mail->Username = 'noreply.carzapp@gmail.com';
        $mail->Password = 'Fr33M3N0w';
        $mail->setFrom('noreply.carzapp@gmail.com', "=?UTF-8?B?".base64_encode('CARZAPP').'?=' );
        
        $mail->Subject =  "=?UTF-8?B?".base64_encode($subject).'?='; 
        $mail->msgHTML($content);
        
        // add email to send
        foreach ($to as $email) {
            $mail->addAddress($email, $email);
        }
        
        // add cc to send
        foreach ($cc as $email) {
            $mail->AddCC($email);
        }
        
        // add bcc to send
        foreach ($bcc as $email) {
            $mail->AddBCC($email);
        }
        
        return $mail->send();
    }
    
    function mail_smtp($to,$subject,$content){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->CharSet="utf-8";
        $mail->Username = 'noreply.carzapp@gmail.com';
        $mail->Password = 'Fr33M3N0w';
        $mail->setFrom('noreply.carzapp@gmail.com', "=?UTF-8?B?".base64_encode('CARZAPP').'?=' );
        $mail->addAddress($to, $to);
        $mail->Subject =  "=?UTF-8?B?".base64_encode($subject).'?='; 
        $mail->msgHTML($content);
        return $mail->send();
    }
    function send_mail_smtp($to,$subject,$content){
        $dir =  $_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['PHP_SELF']);
        $pdfexist = $dir."/files/CarZapp_Brochure.pdf";
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->CharSet="utf-8";
        $pdfstring = $pdfexist;
        
        $mail->AddStringAttachment(file_get_contents('http://www.carzapp.com.au/files/CarZapp_Brochure.pdf'), "CarZapp_Brochure.pdf",$encoding = 'base64', $type = 'application/pdf', $disposition = 'attachment');
        $mail->Username = 'noreply.carzapp@gmail.com';
        $mail->Password = 'Fr33M3N0w';
        $mail->setFrom('noreply.carzapp@gmail.com', "=?UTF-8?B?".base64_encode('CARZAPP').'?=' );

        $mail->addAddress($to, $to);
        $mail->Subject =  "=?UTF-8?B?".base64_encode($subject).'?='; 
        $mail->msgHTML($content);
        return $mail->send();
    }
    function array_mail_smtp($to,$subject,$content){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Debugoutput = 'html';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->CharSet="utf-8";
        $mail->Username = 'noreply.carzapp@gmail.com';
        $mail->Password = 'Fr33M3N0w';
        $mail->FromName = "=?UTF-8?B?".base64_encode('CARZAPP').'?=';

        foreach($to as $email)
        {
           $mail->addAddress($email, $email);
        }
        $mail->Subject =  "=?UTF-8?B?".base64_encode($subject).'?='; 
        $mail->msgHTML($content);
        $mail->send();
    }
    function _curl($url, $data = array()){
        $fields_string = "";
        if(is_array($data)){
            foreach($data as $key=>$value) { 
                $fields_string .= $key.'='.$value.'&'; 
            }
            rtrim($fields_string, '&');
        }
        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, count($data));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    function _curl_header($url, $headers){
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        
        $result = curl_exec($ch);
        $result = mb_substr($result, curl_getinfo($ch, CURLINFO_HEADER_SIZE)); 
        curl_close($ch);
        return $result;
    }

    // Curl post header, body
    function _curl_header_body($url, $header, $data = array()){
        $data_string = json_encode($data);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json', 'Content-Length: ' . strlen($data_string)) );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header );
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }    
   
    // Curl port body
    function _curl_body($url, $data = array()){
        $bodyData = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyData);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function curl_delete($url,$header,$data = array())
    {   
        $data_string = json_encode($data);
        $ch = curl_init();       
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-HTTP-Method-Override: DELETE') );
        curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json', 'Content-Length: ' . strlen($data_string)) );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

}
?>
