<?php

include "ASA.php";

$AntarX = new ASA('TOKEN_HERE');

$AntarP = new ASA_plugins();

$AntarP->github('sebastianwyder','googl-php','Googl.class.php');

$googl = new Googl('API_KEY_GOOGLE');

//https://developers.google.com/url-shortener/v1/getting_started

$update = json_decode(file_get_contents("php://input"));

@$message = $update->message;

@$message_id = $message->message_id;

@$chat_id = $update->message->chat->id;

@$chat_type = $update->message->chat->type;

@$from_id = $update->message->from->id;

@$text = $message->text;

@$data = $update->callback_query->data;


if($text == "/start"){

$AntarX->SetChatID($chat_id);

$AntarX->SetData("
Hello! Send Link For Short it
مرحبا 😝
أرسل الرابط لاختصاره
");

$AntarX->SendMessage();

}else{

$AntarX->SetChatID($chat_id);

$short = $googl->shorten($text);

if($short){

$AntarX->SetData("
✅ تم اختصار رابطك بنجاح :
$short
");

}else{

$AntarX->SetData("
❌ عفوا حدثت مشكلة أثناء اختصار رابطك
في بداية الرابط http:// أو https:// الرجاء التأكد من وجود
");

}

$AntarX->SendMessage();

}


?>
