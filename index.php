<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    $accessToken = "AJistDzObF11LWkX1HsH+ucNOf/kdD+yf09Lj5Hdah6r/vGv2sw43h1PpiLni4lsnK8ap5LecmsNUsPhVgNpY3PovtKY7r/5z/Y3OyeJrAaGG61dI7pvh/xFhsJvQSOKgjy9fCubUeW4HIRF3d6amgdB04t89/1O/w1cDnyilFU=";
    
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
    
    
    $message = $arrayJson['events'][0]['message']['text'];

    if($message == "บอท"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "บอทพร้อมทำงานแล้ว";
        replyMsg($arrayHeader,$arrayPostData);
    }
    
    else if($message == "เปิดหลอดไฟ 1"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "โอเค";
        window.open('https://api.blynk.honey.co.th/p_cGy6rqAtqmddQB2RMMq_cKcT5qe9W-/update/v1?value=1');
        replyMsg($arrayHeader,$arrayPostData);
    }

    else if($message == "ปิดหลอดไฟ 1"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "โอเค";
        window.open('https://api.blynk.honey.co.th/p_cGy6rqAtqmddQB2RMMq_cKcT5qe9W-/update/v1?value=0');
        replyMsg($arrayHeader,$arrayPostData);
    }

function replyMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }
   exit;
?>    
</body>
</html>
