<?php
function SendSms($number,$message)
{
   
    $apiKey = urlencode('JtK4RdlgMZY-znQ6nxyXV5MHOgBxuz4ASoHsk3cAe8');
	$numbers = urlencode($number);
    $sender = urlencode('TXTLCL');
	$message = rawurlencode($message);
    $data = 'apikey=' . $apiKey . '&numbers=' . $numbers . "&sender=" . $sender . "&message=" . $message;

    $url='https://api.textlocal.in/send/?' . $data;
    $json = json_decode(file_get_contents($url) ,true);
    return;
}
?>