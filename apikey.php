<?php

	

//load RSA library
include 'Crypt/RSA.php';
//initialize RSA
$rsa = new Crypt_RSA();


$plaintext =urldecode($_GET['plaintext']) ;


$publickey = "-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC0Mv32HKodrkyLZ/kP9ZXwybGz
jKhT0FvDIMGB28Q5y99/1BoK0NCnvQHUnNJq1mf+EeEGcBozo9LfzH7rRwTcPBlQ
dBstV7+vHpaFa/GdXIrqnFXohXni00CQsoZb8K7AKl33uZ7UwrB1NRCWF821ophn
5tLCdhnhatwfuvKquwIDAQAB
-----END PUBLIC KEY-----";




if(!empty($plaintext))
{
   
    //load public key for encrypting
    $rsa->loadKey($publickey);
    // unique_order_id|total_amount
    
    
    $encrypt = $rsa->encrypt($plaintext);
    //encode for data passing
    $payment = base64_encode($encrypt);
	
	if(empty($plaintext))
	{
		response(404,"invalid input",NULL);
	}
	else
	{
        response(200,"Sucess",$payment);
	}
	
}
else
{
	response(400,"Invalid Request",NULL);
}




function response($status,$status_message,$data)
{
	header("Content-Type:application/json");
	header("HTTP/1.2 ".$status);

	$response->status=$status;
	$response->status_message=$status_message;
	$response->data=$data;
	
	$json_response = json_encode($response);
	echo $json_response;
}

