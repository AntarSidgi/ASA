<?php
//VERSION : 1.2X
//For Get New Updates Join us Channel
//@Team_SD and contact me ( @Team_Sudan )
//Developer @AntarSidgi

function CreateLogAntar($text) {
    $fopen = fopen("Antar.log", "a");
    fwrite($fopen, "[" . date("h:i:s") . "]:$text " . PHP_EOL . "");
    fclose($fopen);
}

class ASA {
    public $SendMessageMI = "";


    public function __construct($token) {
        $this->token = $token;
        if (!is_dir("config")) {
            mkdir("config");
        }
        if (!is_dir("config/files")) {
            mkdir("config/files");
        }

    }
    
    public function AutoTranslate($api,$key,$fr,$to){
        if($api == "yandex"){
            $this->TRapi = "yandex";
            $this->TRkey = $key;
            $this->TRfrom = $fr;
            $this->TRto = $to;
        }
    }

    public function info_bot(){
        $user_bot = $this->api('getme',[]);
        $user_bot = json_decode($user_bot,1);
        define("USERBOT",$user_bot['result']['username']);
        define("IDBOT",$user_bot['result']['id']);
        define("NAMEBOT",$user_bot['result']['first_name']);
    }
    public function Proxy($url, $port = 80, $username = null, $password = null, $type = 'HTTP') {
        $this->Proxy = $url;
        $this->Proxy_Port = $port;
        if ($username != null) {
            $this->Proxy_Username = $username;
        }
        if ($password != null) {
            $this->Proxy_Password = $password;
        }
        $this->Proxy_Type = $type;
    }
    public function api($method, $datas = []) {
        $url = 'https://api.telegram.org/bot' . $this->token . '/' . $method;
        //$url = 'https://Antar.SD/TelegramAPI/bot' . $this->token . '/' . $method;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        if (!empty($this->Proxy)) {
            curl_setopt($ch, CURLOPT_PROXY, $this->Proxy);
            curl_setopt($ch, CURLOPT_PROXYPORT, $this->Proxy_Port);
            if (!empty($this->Proxy_Username)) {
                curl_setopt($ch, CURLOPT_PROXYUSERPWD, '' . $this->Proxy_Username . ':' . $this->Proxy_Password . '');
            }
            curl_setopt($ch, CURLOPT_PROXYTYPE, $this->Proxy_Type);
        }
        $res = curl_exec($ch);
        if (curl_error($ch)) {
            CreateLogAntar(curl_error($ch));
        } else {
            $decode = json_decode($res, 1);
            if ($decode['ok'] != true) {
                if ($decode['description'] == "Unauthorized") {
                    CreateLogAntar("Error Connect API Telegram : Token is not correct");
                } else {
                    CreateLogAntar("Error API Telegram : " . $decode['description']);
                }
            }
            return $res;
        }
    }
    public function GetLink($url) {
        $user_agent = 'Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
        $options = [CURLOPT_CUSTOMREQUEST => "GET", CURLOPT_POST => false, CURLOPT_USERAGENT => $user_agent, CURLOPT_COOKIEFILE => "config/cookie.txt", CURLOPT_COOKIEJAR => "config/cookie.txt", CURLOPT_RETURNTRANSFER => true, CURLOPT_HEADER => false, CURLOPT_FOLLOWLOCATION => true, CURLOPT_ENCODING => "", CURLOPT_AUTOREFERER => true, CURLOPT_CONNECTTIMEOUT => 5, CURLOPT_TIMEOUT => 120, CURLOPT_MAXREDIRS => 3, ];
        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $content = curl_exec($ch);
        $err = curl_errno($ch);
        $errmsg = curl_error($ch);
        $header = curl_getinfo($ch);
        curl_close($ch);
        $header['errno'] = $err;
        $header['errmsg'] = $errmsg;
        $header['content'] = $content;
        return $content;
    }
    public function SetFromChatID($chat_id){
        $this->SetFromChatID = $chat_id;    
    }
    public function EmptyFromChatID(){
        $this->SetFromChatID = "";    
    }
    public function SetData($data) {
        $this->Data = $data;
    }
    public function EmptyData() {
        $this->Data = "";
    }
    public function AddData($data) {
        $this->Data .= $data;
    }
 
    public function SetCaption($caption = null) {

        if($this->TRapi == "yandex"){
        $s = json_decode(file_get_contents('https://translate.yandex.net/api/v1.5/tr.json/translate?key='.$this->TRkey.'&format=plain&lang='.$this->TRfrom.'-'.$this->TRto.'&text='.urlencode($caption).'&'),1);
        $caption = $s['text'][0];
        }

        $this->Caption = $caption;

    }
    public function EmptyCaption() {
        $this->Caption = "";
    }
    public function AddCaption($caption) {
        $this->Caption .= $caption;
    }
    public function SetChatID($chat_id) {
        $this->ChatID = $chat_id;
    }
    public function SetCallBackID($id){
       $this->CallBackID = $id;
    }
    public function SetMessageID($message_id = null) {
        $this->MessageID = $message_id;
    }
    public function ParseMode($mode = null) {
        if ($mode != null) {
            $this->ParseMode = $mode;
        }
    }
    public function EmptyParseMode() {
            $this->ParseMode = "";
    }
    public function Duration($duration = null) {
        if ($duration != null) {
            $this->Duration = $duration;
        }
    }
    public function ResizeKeyboard($bool = true) {
        $this->ResizeKeyboard = $bool;
    }
    public function ReplyMarkup($keyboard = null) {
        if ($keyboard != null) {
            $keyboard['resize_keyboard'] = true;
             if(isset($keyboard['inline_keyboard']) && isset($this->TRapi)){
                foreach($keyboard['inline_keyboard'] as $key=>$value){
                     foreach($value as $k=>$t){ 
                         $need_tr = $t['text'];
                                 if($this->TRapi == "yandex"){
              $s = json_decode(file_get_contents('https://translate.yandex.net/api/v1.5/tr.json/translate?key='.$this->TRkey.'&format=plain&lang='.$this->TRfrom.'-'.$this->TRto.'&text='.urlencode($need_tr).'&'),1);
  $keyboard['inline_keyboard'][$key][$k]['text'] = $s['text'][0];
                               }
                     }
                 }

             }



            $this->ReplyMarkup = json_encode($keyboard);
        }
    }
    public function EmptyReplyMarkup(){
            $this->ReplyMarkup = "";
    }
    public function ReplyToMessage($mid = null) {
        $this->ReplyToMessage = $mid;
    }
    public function EmptyReplyToMessage() {
        $this->ReplyToMessage = "";
    }
    public function DisableWebPagePreview($bool = true) {
        $this->DisableWebPagePreview = $bool;
    }
    public function DeleteMessage() {
            $data = [];
        @$data['chat_id'] = $this->ChatID;
        @$data['message_id'] = $this->MessageID;
        $Send = $this->api('DeleteMessage', $data);
        $SendMI = json_decode($Send);
        return $Send;
    }
    public function Alert($text=null,$box=false){

if(empty($text)){
$text = $this->Data;
}

return $this->api("answerCallbackQuery",[
'callback_query_id'=>$this->CallBackID,
'text'=>$text,
'show_alert'=>$box
]);

    }
    public function SendMessage() {
        if(isset($this->Data) && isset($this->ChatID)){

        $data = [];
        @$data['message_id'] = $this->MessageID;
        @$data['chat_id'] = $this->ChatID;
        @$text = $this->Data;
        if($this->TRapi == "yandex"){
        $s = json_decode(file_get_contents('https://translate.yandex.net/api/v1.5/tr.json/translate?key='.$this->TRkey.'&format=plain&lang='.$this->TRfrom.'-'.$this->TRto.'&text='.urlencode($text).'&'),1);
        $text = $s['text'][0];
        }
        @$data['text'] = $text;


        @$data['disable_web_page_preview'] = $this->DisableWebPagePreview;
        @$data['disable_notification'] = $this->AutoNotification;
        @$data['parse_mode'] = $this->ParseMode;
        @$data['reply_markup'] = $this->ReplyMarkup;
        @$data['reply_to_message_id'] = $this->ReplyToMessage;
        $Send = $this->api('SendMessage', $data);
        $SendMI = json_decode($Send);
        $this->SendMessageMI = $SendMI->result->message_id;
        $this->Data = null;
        return $Send;
        }
    }
    public function ForwardMessage(){
        $data = [];
        @$data['from_chat_id'] = $this->SetFromChatID;
        @$data['chat_id'] = $this->ChatID;
        @$data['message_id'] = $this->MessageID;
        @$data['disable_notification'] = $this->AutoNotification;
        return $this->api('ForwardMessage', $data);
    }
    public function EditMessage($inline = false) {
        $data = [];
        if ($inline == false) {
            @$data['message_id'] = $this->MessageID;
        } else {
            @$data['inline_message_id'] = $this->MessageID;
        }
        @$data['chat_id'] = $this->ChatID;
        @$data['parse_mode'] = $this->ParseMode;

         $text = $this->Data;
         if($this->TRapi == "yandex"){
              $s = json_decode(file_get_contents('https://translate.yandex.net/api/v1.5/tr.json/translate?key='.$this->TRkey.'&format=plain&lang='.$this->TRfrom.'-'.$this->TRto.'&text='.urlencode($text).'&'),1);
              $text = $s['text'][0];
          }

        @$data['text'] = $text;
        @$data['reply_markup'] = $this->ReplyMarkup;
        return $this->api('editMessageText', $data);
    }
    public function SendDocument() {
        $data = [];
        @$data['chat_id'] = $this->ChatID;
        @$data['document'] = $this->Data;
        @$data['caption'] = $this->Caption;
        @$data['reply_markup'] = $this->ReplyMarkup;
        @$data['reply_to_message_id'] = $this->ReplyToMessage;
        return $this->api('sendDocument', $data);
    }
    public function SendPhoto() {
        $data = [];
        @$data['chat_id'] = $this->ChatID;
        @$data['photo'] = $this->Data;
        @$data['caption'] = $this->Caption;
        @$data['reply_markup'] = $this->ReplyMarkup;
        @$data['reply_to_message_id'] = $this->ReplyToMessage;
        return $this->api('sendPhoto', $data);
    }
    public function SendSticker() {
        $data = [];
        @$data['chat_id'] = $this->ChatID;
        @$data['sticker'] = $this->Data;
        @$data['reply_markup'] = $this->ReplyMarkup;
        @$data['reply_to_message_id'] = $this->ReplyToMessage;
        return $this->api('sendSticker', $data);
    }
    public function SendVideo($width = null, $height = null) {
        @$data['chat_id'] = $this->ChatID;
        @$data['video'] = $this->Data;
        @$data['caption'] = $this->Caption;
        @$data['reply_markup'] = $this->ReplyMarkup;
        @$data['reply_to_message_id'] = $this->ReplyToMessage;
        Antar:
            @$data['Duration'] = $this->Duration;
            @$data['width'] = $width;
            @$data['height'] = $height;
            return $this->api('SendVideo', $data);
        }
        public function SendVoice() {
            @$data['chat_id'] = $this->ChatID;
            @$data['voice'] = $this->Data;
            @$data['caption'] = $this->Caption;
            @$data['reply_markup'] = $this->ReplyMarkup;
            @$data['reply_to_message_id'] = $this->ReplyToMessage;
            @$data['Duration'] = $this->Duration;
            return $this->api('SendVoice', $data);
        }
        public function SendContact($first_name, $last_name = null) {
            @$data['chat_id'] = $this->ChatID;
            @$data['phone_number'] = $this->Data;
            @$data['reply_markup'] = $this->ReplyMarkup;
            @$data['reply_to_message_id'] = $this->ReplyToMessage;
            @$data['first_name'] = $first_name;
            @$data['last_name'] = $last_name;
            return $this->api('sendcontact', $data);
        }
        public function IsJoinUser($channel) {
            @$data['user_id'] = $this->ChatID;
            @$data['chat_id'] = $channel;
            $api = json_decode($this->api('getChatMember', $data), 1);
            if (@$api['description'] == 'Bad Request: chat not found') {
                CreateLogAntar("Channel Not found! Are You Sure $channel exists?");
                return "CNF1XR3";
            } elseif (@$api['description'] == 'Bad Request: CHAT_ADMIN_REQUIRED') {
                CreateLogAntar("The Bot is Not Admin in the channel");
                return "BNA1XR3";
            } else {
                if ($api['result']['status'] == 'left') {
                    return false;
                } else {
                    return true;
                }
            }
        }
        public function StickerPack($sticker=[]){
             $this->StickerPack = $sticker;
        }
        public function StickerPackFolder($folderp,$emoji=[]){
             $data = [];
             $sticker = new Imagick();
             $folder = scandir($folderp);
             unset($folder[0]); unset($folder[1]);
             $count = 0;
             foreach($folder as $file){
             $file = "".$folderp."/".$file."";
             $sticker->readImage($file);
             $sticker->resizeImage(512,512,imagick::FILTER_LANCZOS,0.9);
             $sticker->writeImage($file);
                  $data[$file] = $emoji[$count];
             $count += 1;
             }
             $this->StickerPack = $data;
        }
        public function StickerName($name){
             $getuser = $this->api('getme',[]);
             $getuser = json_decode($getuser,1); 
             $getuser = str_replace("@","",$getuser['result']['username']);
             $name .= "_by_".$getuser;
             $this->StickerName = $name;
             CreateLogAntar($getuser);
        }
        public function StickerTitle($name){
             $this->StickerTitle = $name;
        }
        public function CreateSticker(){
             $pack = $this->StickerPack;
             $count = 0;
             $result_list = [];
             foreach($pack as $sticker=>$emoji){
                 if($count == 0){
                 $result_list[] = json_decode($this->api('createNewStickerSet',["user_id"=>$this->ChatID,
"name"=>$this->StickerName,
"title"=>$this->StickerTitle,
"emojis"=>$emoji,
"png_sticker"=>new CurlFile($sticker)]),1);
                 }else{
                 $result_list[] = json_decode($this->api('addStickerToSet',["user_id"=>$this->ChatID,
"name"=>$this->StickerName,
"emojis"=>$emoji,
"png_sticker"=>new CurlFile($sticker)]),1);
                 }
             $count += 1;
             }
             return $result_list;
        }
        public function FileID2Link($fileid) {
        $file = file_get_contents("https://api.telegram.org/bot" . $this->token . "/getFile?file_id=$fileid");
        $decode = json_decode($file, 1);
        $file_path = $decode['result']['file_path'];
        return "https://api.telegram.org/file/bot" . $this->token . "/$file_path";
    }
    }
    class ASA_Files {
        public function CreateFile($name, $value = null) {
            if (!file_exists($name)) {
                $fp = fopen($name, 'w');
                fclose($fp);
            }
            if ($value != null) {
                return file_put_contents($name, $value);
            }
        }
        public function PutFile($name, $value) {
            return file_put_contents($name, $value);
        }
        public function UnFile($name) {
            return unlink($name);
        }
        public function ReadFile($name) {
            return file_get_contents($name);
        }
        public function CreateFolder($name) {
            return mkdir($name);
        }
        public function FileExists($name) {
            return !file_exists($name);
        }
        public function FolderExists($name) {
            return !is_dir($name);
        }
    }
    class ASA_JsonData {
        public function __construct() {
            if (!is_dir("config/Json")) {
                mkdir("config/Json");
            }
        }
        public function SetChatID($chat_id = null) {
            $this->ChatID = $chat_id;
        }
        public function SetNameFile($data) {
            if ($data == null) {
                CreateLogAntar("Where Is SetNameFile!?");
            } else {
                $this->NameJson = $data;
            }
        }
        public function Create() {
            if (!file_exists('config/Json/' . $this->NameJson . '.json')) {
                $fp = fopen('config/Json/' . $this->NameJson . '.json', 'w');
                fwrite($fp, '[]');
                fclose($fp);
            }
        }
        public function AddUser() {
            $Open = file_get_contents('config/Json/' . $this->NameJson . '.json');
            $Decode = json_decode($Open, 1);
            $Decode[$this->ChatID] = [];
            $Encode = json_encode($Decode);
            return file_put_contents('config/Json/' . $this->NameJson . '.json', $Encode);
        }
        public function ExistsUser() {
            $Open = file_get_contents('config/Json/' . $this->NameJson . '.json');
            $Decode = json_decode($Open, 1);
            if (!$Decode[$this->ChatID]) {
                return false;
            } else {
                return true;
            }
        }
        public function DeleteUser() {
            $Open = file_get_contents('config/Json/' . $this->NameJson . '.json');
            $Decode = json_decode($Open, 1);
            unset($Decode[$this->ChatID]);
            $Encode = json_encode($Decode);
            return file_put_contents('config/Json/' . $this->NameJson . '.json', $Encode);
        }
        public function GetUser() {
            $Open = file_get_contents('config/Json/' . $this->NameJson . '.json');
            $Decode = json_decode($Open, 1);
            return $Decode[$this->ChatID];
        }
        public function GetKey($key) {
            $Open = file_get_contents('config/Json/' . $this->NameJson . '.json');
            $Decode = json_decode($Open, 1);
            return $Decode[$this->ChatID][$key];
        }
        public function AddKey($key) {
            $Open = file_get_contents('config/Json/' . $this->NameJson . '.json');
            $Decode = json_decode($Open, 1);
            $Decode[$this->ChatID][$key] = [];
            $Encode = json_encode($Decode);
            return file_put_contents('config/Json/' . $this->NameJson . '.json', $Encode);
        }
        public function PutKey($key, $value) {
            $Open = file_get_contents('config/Json/' . $this->NameJson . '.json');
            $Decode = json_decode($Open, 1);
            $Decode[$this->ChatID][$key] = $value;
            $Encode = json_encode($Decode);
            return file_put_contents('config/Json/' . $this->NameJson . '.json', $Encode);
        }
        public function DelKey($key) {
            $Open = file_get_contents('config/Json/' . $this->NameJson . '.json');
            $Decode = json_decode($Open, 1);
            unset($Decode[$this->ChatID][$key]);
            $Encode = json_encode($Decode);
            return file_put_contents('config/Json/' . $this->NameJson . '.json', $Encode);
        }
    }
    class ASA_plugins {
        public function __construct($plugins = []) {
            if (!is_dir("config/plugins")) {
                mkdir("config/plugins");
            }
            if (!is_dir("config/plugins/files")) {
                mkdir("config/plugins/files");
            }
            if (!is_dir("config/github")) {
                mkdir("config/github");
            }
            $scandir = scandir("config/plugins");
            foreach ($plugins as $nameplug) {
                if (!is_dir("config/plugins/$nameplug")) {
                    include "config/plugins/$nameplug";
                }
            }
        }
        public function PluginLoad($folder, $file) {
            if (!is_dir("config/plugins/" . $folder)) {
                CreateLogAntar(" 
Function : " . __METHOD__ . "
Error : plugin folder ( $folder ) not exists");
                return false;
            } elseif (!file_exists("config/plugins/" . $folder . "/" . $file)) {
                include ("config/plugins/" . $folder . "/" . $file);
            }
        }
        public function github($username, $repository, $plugin) {
            if (is_dir("config/github/" . $repository . "-master")) {
                include ("config/github/" . $repository . "-master/" . $plugin);
                return "plugin folder exists";
            } else {
                mkdir("config/github/" . $repository . "-master");
                if (copy("https://github.com/" . $username . "/" . $repository . "/archive/master.zip", "config/github/" . $repository . ".zip")) {
                    $zipArchive = new ZipArchive();
                    $result = $zipArchive->open("config/github/" . $repository . ".zip");
                    if ($result === TRUE) {
                        $zipArchive->extractTo("config/github");
                        $zipArchive->close();
                        unlink("config/github/" . $repository . ".zip");
                        include ("config/github/" . $repository . "-master/" . $plugin);
                        return true;
                    } else {
                        rmdir("config/github/" . $repository . "-master");
                        CreateLogAntar(" 
Function : " . __METHOD__ . "
Error : Can't Work Zip File");
                        return false;
                    }
                } else {
                    rmdir("config/github/" . $repository . "-master");
                    CreateLogAntar(" 
Function : " . __METHOD__ . "
Error : Download failed");
                    return false;
                }
            }
        }
    }
    class ASA_Mysql {
        public function __construct($Server, $Username, $Password,$Name=null) {
            if (function_exists('mysqli_connect')) {
                $mysql = mysqli_connect($Server, $Username, $Password,$Name);
                $this->mysql = $mysql;
                if(!isset($Name)){
                $this->mysql_user = $Username;
                }else{
                $this->mysql_user = $Name;
                }
                if (!$mysql) {
                    CreateLogAntar("DataBase Error : " . mysqli_connect_error());
                    return false;
                } else {
                    mysqli_set_charset($mysql, "utf8");
                    return $this->mysql;
                }
            } else {
                CreateLogAntar("
DataBase Error : Mysqli Not Installed
php.net/manual/en/mysqli.installation.php
");
            }
        }
        public function Sql($command) {
            $query = mysqli_query($this->mysql, $command);
            return [$query,$this->mysql->error];
       }
        public function SetTable($name) {
            $this->TableName = $name;
        }
        public function CreateTable($CHARACTER="BINARY") {
            $name = $this->TableName;
            if ($name == null) {
                $name = $this->AutoTableDB;
            }
            if ($name == null) {
                CreateLogAntar("Can t Find Table Name in DBTable");
            }
            $sql = "CREATE TABLE " . $this->mysql_user . "." . $name . " (IDC int NOT NULL AUTO_INCREMENT PRIMARY KEY) CHARACTER SET $CHARACTER";
            $query = mysqli_query($this->mysql, $sql);
            if ($query) {
                return true;
            } else {
                CreateLogAntar(" 
Function : " . __METHOD__ . "
Error : " . $this->mysql->error);
                return false;
            }
        }
        public function TableExists() {
            $table = $this->TableName;
            if ($table == null) {
                CreateLogAntar("Can t Find Table Name in DBTableExists");
            }
            $query = mysqli_query($this->mysql, 'SELECT * FROM `' . $this->mysql_user . '`.`' . $table . '`');
            if (!$query) {
                CreateLogAntar(" 
Function : " . __METHOD__ . "
Error : " . $this->mysql->error);
                return false;
            } else {
                return true;
            }
        }
        public function IDS($find='*') {
            $table = $this->TableName;
            if ($table == null) {
                CreateLogAntar("Can t Find Table Name in IDS");
            }
            $array = [];
            $sql = 'SELECT '.$find.' FROM '.$this->mysql_user.'.'.$table.'';
            $query = mysqli_query($this->mysql, $sql);
            if ($query) {
                while ($value = $query->fetch_object()) {
                    $array[] = $value;
                }
            return $array;
            } else {
                CreateLogAntar(" 
Function : " . __METHOD__ . "
Error : " . $this->mysql->error);
                return 'error';
            }
            return false;
        }
        public function Get($key, $key2, $value2) {
            $table = $this->TableName;
            if ($table == null) {
                CreateLogAntar("Can t Find Table Name in DBTableExists");
            }
            $sql = "SELECT $key FROM " . $this->mysql_user . "." . $table . " WHERE $key2 = '$value2'";
            $query = mysqli_query($this->mysql, $sql);
            if ($query) {
                return $query->fetch_object()->$key;
            } else {
                CreateLogAntar(" 
Function : " . __METHOD__ . "
Error : " . $this->mysql->error);
                return 'error';
            }
        }
        public function Put($key, $value, $key2, $value2) {
            $table = $this->TableName;
            if ($table == null) {
                CreateLogAntar("Can t Find Table Name in DBTableExists");
            }
            $sql = "UPDATE " . $this->mysql_user . "." . $table . " SET $key='$value' WHERE $key2='$value2'";
            if (mysqli_query($this->mysql, $sql) === TRUE) {
                return true;
            } else {
                CreateLogAntar(" 
Function : " . __METHOD__ . "
Error : " . $this->mysql->error);
                return false;
            }
        }
        public function PutSum($key,$value,$key2,$value2){
        if(!is_numeric($value)){
        CreateLogAntar(" 
Function : " . __METHOD__ . "
Error : virable value not integers");
        return false;
        }else{
        $get = (int) $this->Get($key,$key2,$value2);
        $get += (int) $value;
        return (int) $this->Put($key,$get,$key2,$value2);
        }
        }
        public function DelCustomProfile($row, $value) {
            $table = $this->TableName;
            if ($table == null) {
                CreateLogAntar("Can t Find Table Name in DelCustomProfile");
            }
            $sql = "DELETE FROM " . $this->mysql_user . "." . $table . " WHERE $row = '" . $value . "'";
            if (mysqli_query($this->mysql, $sql) === TRUE) {
                return true;
            } else {
                CreateLogAntar(" 
Function : " . __METHOD__ . "
Error : " . $this->mysql->error);
                return false;
            }
        }
        public function AddCustomProfile($row, $value) {
            $table = $this->TableName;
            if ($table == null) {
                CreateLogAntar("Can t Find Table Name in AddCustomProfile");
            }
            $sql = "INSERT INTO " . $this->mysql_user . "." . $table . " ($row) VALUES ('$value')";
            if (mysqli_query($this->mysql, $sql) === TRUE) {
                return true;
            } else {
                CreateLogAntar(" 
Function : " . __METHOD__ . "
Error : " . $this->mysql->error);
                return false;
            }
        }
        public function AddProfile($chat_id) {
            $table = $this->TableName;
            if ($table == null) {
                CreateLogAntar("Can t Find Table Name in DBTableExists");
            }
            if ($chat_id == null) {
                CreateLogAntar("Can t Find Chat ID in DBGet! Are you sure you can use the AutoChatID?");
            }
            $sql = 'INSERT INTO ' . $this->mysql_user . '.' . $table . ' (chat_id) VALUES (' . $chat_id . ')';
            if (mysqli_query($this->mysql, $sql) === TRUE) {
                return true;
            } else {
                CreateLogAntar(" 
Function : " . __METHOD__ . "
Error : " . $this->mysql->error);
                return false;
            }
        }
        public function DelProfile($chat_id) {
            $table = $this->TableName;
            if ($table == null) {
                CreateLogAntar("Can t Find Table Name in DelProfile");
            }
            if ($chat_id == null) {
                CreateLogAntar("Can t Find Chat ID in DelProfile! Are you sure you can use the AutoChatID?");
            }
            $sql = 'DELETE FROM ' . $this->mysql_user . '.' . $table . ' WHERE chat_id = ' . $chat_id . '';
            if (mysqli_query($this->mysql, $sql) === TRUE) {
                return true;
            } else {
                CreateLogAntar(" 
Function : " . __METHOD__ . "
Error : " . $this->mysql->error);
                return false;
            }
        }
        public function AddColumn($name, $definition) {
            $table = $this->TableName;
            if ($table == null) {
                CreateLogAntar("Can t Find Table Name in AddColumn");
            }
            $sql = "ALTER TABLE " . $this->mysql_user . "." . $table . " ADD " . $name . " " . $definition . "";
            $query = mysqli_query($this->mysql, $sql);
            if ($query) {
                return true;
            } else {
                CreateLogAntar(" 
Function : " . __METHOD__ . "
Error : " . $this->mysql->error);
                return false;
            }
        }
        public function ExistColumn($name) {
            $table = $this->TableName;
            if ($table == null) {
                CreateLogAntar("Can t Find Table Name in AddColumn");
            }
            $sql = "SHOW COLUMNS FROM " . $this->mysql_user . "." . $table . " LIKE '" . $name . "'";
            $query = mysqli_query($this->mysql, $sql);
            if ($query) {
                return true;
            } else {
                CreateLogAntar(" 
Function : " . __METHOD__ . "
Error : " . $this->mysql->error);
                return false;
            }
        }
        public function DelColumn($name) {
            $table = $this->TableName;
            if ($table == null) {
                CreateLogAntar("Can t Find Table Name in DelColumn");
            }
            $sql = "ALTER TABLE " . $this->mysql_user . "." . $table . " DROP COLUMN " . $name . "";
            $query = mysqli_query($this->mysql, $sql);
            if ($query) {
                return true;
            } else {
                CreateLogAntar(" 
Function : " . __METHOD__ . "
Error : " . $this->mysql->error);
                return false;
            }
        }
        public function PutNoWhere($key, $value) {
            $table = $this->TableName;
            if ($table == null) {
                CreateLogAntar("Can t Find Table Name in PutNoWhere");
            }
            $sql = "UPDATE " . $this->mysql_user . "." . $table . " SET $key='$value'";
            if (mysqli_query($this->mysql, $sql) === TRUE) {
                return true;
            } else {
                CreateLogAntar(" 
Function : " . __METHOD__ . "
Error : " . $this->mysql->error);
                return false;
            }
        }
        public function GetNoWhere($key, $chat_id) {
            $table = $this->TableName;
            if ($table == null) {
                CreateLogAntar("Can t Find Table Name in GetNoWhere");
            }
            if ($chat_id == null) {
                CreateLogAntar("Can t Find Chat ID in GetNoWhere! Are you sure you can use the $chat_id?");
            }
            $sql = 'SELECT ' . $key . ' FROM ' . $this->mysql_user . '.' . $table . ' WHERE chat_id = ' . $chat_id . '';
            $query = mysqli_query($this->mysql, $sql);
            if ($query) {
                return $query->fetch_object()->$key;
            } else {
                CreateLogAntar(" 
Function : " . __METHOD__ . "
Error : " . $this->mysql->error);
                return 'error';
            }
        }
        public function SUM($column) {
            $table = $this->TableName;
            if ($table == null) {
                CreateLogAntar("Can t Find Table Name in SUM");
            }
            $res = mysqli_query($this->mysql, 'SELECT sum(' . $column . ') FROM ' . $this->mysql_user . '.' . $table);
            if (FALSE === $res) die("Select sum failed: " . $this->mysql->error);
            $row = mysqli_fetch_row($res);
            return preg_replace("/[^0-9.]/", "", $row[0]);
        }
        public function COUNT($column) {
            $table = $this->TableName;
            if ($table == null) {
                CreateLogAntar("Can t Find Table Name in COUNT");
            }
            $res = mysqli_query($this->mysql, 'SELECT count(' . $column . ') FROM ' . $this->mysql_user . '.' . $table);
            if (FALSE === $res) die("Select sum failed: " . $this->mysql->error);
            $row = mysqli_fetch_row($res);
            return preg_replace("/[^0-9.]/", "", $row[0]);
        }
        public function is_column_value($column, $value) {
            $table = $this->TableName;
            if ($table == null) {
                CreateLogAntar("Can t Find Table Name in is_column_value");
            }
            $sql = "select $column from " . $this->mysql_user . "." . $table . " where $column='$value'";
            $query = mysqli_query($this->mysql, $sql);
            if (mysqli_num_rows($query) >= 1) {
                return true;
            } else {
                return false;
            }
        }
        public function __destruct() {
            if ($this->mysql) {
                mysqli_close($this->mysql);
            }
        }
    }

class ASA_AES {

    public function __construct($key) {
        $this->AES_PASS = $key;
    }
    public function Encode($data) {

$encryption_key=base64_decode($this->AES_PASS);
$iv=openssl_cipher_iv_length('aes-256-cbc');
$encrypted=openssl_encrypt($data,'aes-256-cbc',$encryption_key,0,$iv);
return base64_encode(quoted_printable_encode(convert_uuencode($encrypted.'::'.$iv)));
    }
    public function Decode($data) {
$encryption_key=base64_decode($this->AES_PASS);

list($encrypted_data,$iv)=explode('::',convert_uudecode(quoted_printable_decode(base64_decode($data))),2);

return openssl_decrypt($encrypted_data,'aes-256-cbc',$encryption_key,0,$iv);
    }
}

class ASA_Blockio{
     public function __construct($key){
        $this->token = $key;
     }
     public function GetBalance($address=null){
if($address == null){
        $api = file_get_contents("https://block.io/api/v2/get_balance/?api_key=".$this->token."&addresses=".$address);
}else{
        $api = file_get_contents("https://block.io/api/v2/get_balance/?api_key=".$this->token);
}
        $json = json_decode($api,1);
        return $json['data']['available_balance'];
     }

     public function CreateNewAddress($label=null){
if($label == null){
    $api = file_get_contents("https://block.io/api/v2/get_new_address/?api_key=".$this->token);
}else{
    $api = file_get_contents("https://block.io/api/v2/get_new_address/?api_key=".$this->token."&label=".$label);
}
    $json = json_decode($api,1);
    if($json['status'] == "success"){
        return [$json['data']['address'],$json['data'][0]['label']];
    }else{
         return $json['data']['error_message'];
    }
     }
     public function WithDarw($amount,$address,$from=null){

if($from == null){
    $api = file_get_contents("https://block.io/api/v2/withdraw_from_addresses/?api_key=".$this->token."&to_addresses=".$address."&amounts=".$amount);
}else{
    $api = file_get_contents("https://block.io/api/v2/withdraw_from_addresses/?api_key=".$this->token."&to_addresses=".$address."&amounts=".$amount."&from_addresses=".$from);
}
    $json = json_decode($api,1);
    if($json['status'] == "success"){
        return true;
    }else{
         return $json['data']['error_message'];
    }

    }
}
