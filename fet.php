<?php
$file = fopen('db_chat.json', 'a+');
$content = file_get_contents('db_chat.json');
$message=[
    'text'=>$_GET['message'],
    'date'=>(new DateTimeImmutable())->format('Y-m-d'),
    'from'=>$_COOKIE['loginName']
];
$file = fopen('db_chat.json', 'w+');
$contentArray = json_decode($content);
array_push($contentArray->messages, $message);
$contentArray=json_encode($contentArray);
fwrite($file, $contentArray);
fclose($file);
?>
