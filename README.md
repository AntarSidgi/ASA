# ASA (Free)
Create Best Bot With ASA Library

Version : 1.2X

What's news ? 💥
<b>
- Added new Class for Blockio
- Added new function for AutoTranslate
- Added new function for delete message (DeleteMessage in ASA.md)
- Added new function to add data (AddData in ASA.md)
- Added new function to add caption (AddCaption in ASA.md)
- Added virable to get message id SendMessage ($AntarX->SendMessageMI in ASA.md)
- Added new function to add from chat (SetFromChatID in ASA.md)
- Added new function to forward message (ForwardMessage in ASA.md)
- Added new class for encode/decode (AES.md)
- Added new function for Sum a value with the previous value of the data (PutSum in Mysql.md)
- Now you can create sticker pack (Check The ASA.md)
<b>now you can empty datas</b>
<pre>

$AntarX->EmptyData();
$AntarX->EmptyCaption();
$AntarX->EmptyParseMode();
$AntarX->EmptyReplyMarkup();
$AntarX->EmptyReplyToMessage();
</pre>
Call this function to get this constant
<pre>

$AntarX->info_bot();
echo USERBOT;
//for user bot
echo IDBOT;
//for id bot
echo NAMEBOT;
//for name bot

</pre>
</b>



Version : 0.0.1X

# Requirements :

PHP Version :  <b>PHP 7.2</b>

allow_url_fopen : <b>On</b>

memory_limit : <b>128MB</b> Recommended <b>256MB</b>

post_max_size : <b> 64MB </b> Recommended <b>128MB</b>

upload_max_filesize : <b>256MB</b> Recommended <b>1G</b>

Library need : <b>json</b> , <b>mysqli</b> , <b>zip</b>

# How To Install :

Just copy the ASA.php file to your web host
and include for use 

<pre>

include "ASA.php";

//Your Source Code
</pre>
