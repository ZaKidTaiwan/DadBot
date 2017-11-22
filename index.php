<?php
$access_token ='Dn4o1ydKqOiRaVD9vjPBqKhKrEATFbyECUyLiBkT2JtyCyAuzIr1NhhrF1iugNGFMJ+D6vs6uaNeizg3oGO0prSiYxh1y1K8ozA8I9xzCq7Mqa7hwAYcy7THT56yS7aV3c4oI55F6ewwdbPuQtobPwdB04t89/1O/w1cDnyilFU=
';
//define('TOKEN', '你的Channel Access Token');

$json_string = file_get_contents('php://input');
$json_obj = json_decode($json_string);

$event = $json_obj->{"events"}[0];
$type  = $event->{"message"}->{"type"};
$message = $event->{"message"};
$reply_token = $event->{"replyToken"};
        
$post_data = [
  "replyToken" => $reply_token,
  "messages" => [
    [
      "type" => "text",
      "text" => $message->{"text"}
    ]
  ]
]; 

$ch = curl_init("https://api.line.me/v2/bot/message/reply");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer '.$access_token
    //'Authorization: Bearer '. TOKEN
));
$result = curl_exec($ch);
curl_close($ch); 
?>
