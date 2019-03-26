<?php

//Need Add Column (run) and Profile (chat_id)

function SetRun($chat_id,$run){
global $mysql;
$mysql->SetTable("users");
$mysql->Put("run", $run, "chat_id", $chat_id);
}
function GetRun($chat_id){
global $mysql;
$mysql->SetTable("users");
return $mysql->Get("run",'chat_id',$chat_id);
}

?>
