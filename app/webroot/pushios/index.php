<?php
header("Content-type: application/json; charset=utf-8");
	$message = $_POST['msg']; 
	$passphrase = '1234';
    //$message = array("subject"=>$this->request->data['Notification']['subject'],"message" => $this->request->data['Notification']['message']);
    
	
    // Set POST variables
    // Put your device token here (without spaces):
    $deviceToken = $_POST['dt'];
	//"b8d8c89a9e012ee66db874adb0e78a561a74638337c8818c713cb0c719138ccd";
	//echo json_encode($deviceToken);
    $ctx = stream_context_create();
    stream_context_set_option($ctx, 'ssl', 'local_cert', 'MyApplication.pem');
    stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

    // Open a connection to the APNS server
    $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

    if (!$fp)
        exit("Failed to connect: $err $errstr" . PHP_EOL);

    //echo 'Connected to APNS' . PHP_EOL;
    // Create the payload body 
    $body['aps'] = array(
        'alert' => array(
            'body' => $message,
            'action-loc-key' => 'HurtLocker',
        ),
        'badge' => 1,
        'sound' => 'oven.caf',
    );

    // Encode the payload as JSON
    $payload = json_encode($body);

    // Build the binary notification 
   // $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
	foreach($deviceToken as $token){
	$msg = chr(0) . pack('n', 32) . pack('H*', $token) . pack('n', strlen($payload)) . $payload;
   // Send it to the server
	$result = fwrite($fp, $msg, strlen($msg)); 
	}
    return $result;
?>