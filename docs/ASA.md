# ASA-Free
Create Best Bot With ASA Library

<html>



<b>Connect Bot 🔘</b>
<pre>$AntarX = new ASA("123456:abcdefg1936191719"); </pre>

<b> You Can set proxy for connect to api Telegram👇</b>
<pre>$AntarX->Proxy($url, $port = 80, $username = null, $password = null, $type = 'HTTP');</pre>

<b> You can connect api telegram 👇 </b>
<pre>$Antarx->api($method, $datas = []);</pre>

<b> You can open Link and Extract Data 👇 </b>
<pre>$AntarX->GetLink($url);</pre>

<b>You need Set Data for send to api telegram (for example fileid, text and more)</b>


<pre>$AntarX->SetData("Hello World😍👌");</pre>

<b>You can set From id (chat) for forwardmessage and more...</b>
<pre>$AntarX->SetFromChatID($chat_id);</pre>

<b>You Can Set Caption for Files 👇</b>
<pre>$AntarX->SetCaption("This File Only For You❤");</pre>

<b>You need Set Chat ID for send for users 👇 </b>
<pre>$AntarX->SetChatID(323823995);</pre>

<b> You can set MessageID for editmessage and more...👇 </b>
<pre>$AntarX->SetMessageID(1828181);</pre>

<b> You can set ParseMode for SetData(text) 👇 </b>
<pre>$AntarX->ParseMode("markdown");</pre>

<b> You can set Duration of video/music and more...👇</b>
<pre>$AntarX->Duration(20);</pre>

<b> You can Reply to Message with message id 👇 </b>
<pre>$AntarX->ReplyToMessage(1826);</pre>

<b> You can add new ones to the previous data 👇 </b>
<pre>
$AntarX->SetData("Hello ");

$AntarX->AddData("World!");

$AntarX->SendMessage();
//Hello World!

</pre>

<b> You can add new ones to the previous caption 👇 </b>
<pre>
$AntarX->SetCaption("Hello ");

$AntarX->AddCaption("World!");

$AntarX->SendPhoto();
//file photo and caption Hello World!

</pre>

  


<b> You can add keyboard for send (ReplyMarkup) 👇 </b>
<pre>$AntarX->ReplyMarkup(['keyboard'=>[
                [
                ['text'=>'1'],['text'=>'2']
                ],
                [
                ['text'=>'3'],['text'=>'4']
                ],

              ]]);
</pre>

<b> You can Set Files For create Sticker</b>
<pre>$AntarX->StickerPack($stickers=[]);</pre>

<b> You can use the folder name if you can not find the file list </b>
<pre>$AntarX->StickerPackFolder($folderp,$emoji=[]);</pre>

<b> Set the name sticker for link sticker </b>
<pre>$AntarX->StickerName("NAME");</pre>

<b> you need Set the title sticker! use this </b>
<pre>$AntarX->StickerTitle($title);</pre>

<b> you can change file id to url link (warning: url link have token)</b>
<pre> $AntarX->FileID2Link($fileid); </pre>
  

<b> If you do not like to open the links in your message before send, use this 👇 </b>
<pre>$AntarX->DisableWebPagePreview(true);</pre>

<b> After settings,you can use this for send data to telegram<b>
<pre>
$AntarX->SendMessage();
$AntarX->EditMessage($inline=false);
$AntarX->DeleteMessage();
$AntarX->SendDocument();
$AntarX->SendSticker();
$AntarX->SendVideo($width = null, $height = null);
$AntarX->SendVoice();
$AntarX->SendContact($first_name, $last_name = null); (SetData = phone_number)
$AntarX->IsJoinUser($channel);
$AntarX->ForwardMessage();
$AntarX->CreateSticker();
</pre>

<b>You can use this variable to get the message id from the last message send</b>
<pre>
$AntarX->SetChatID($chat_id);
$AntarX->SetData(1);
$AntarX->SendMessage();
$MID = $AntarX->SendMessageMI;
$AntarX->SetMessageID($MID);
$AntarX->SetData(2);
$AntarX->EditMessage();
$AntarX->SetData(3);
$AntarX->EditMessage();
$AntarX->SetData(4);
$AntarX->EditMessage();
$AntarX->SetData(5);
$AntarX->EditMessage();
}
</pre>

</html>
