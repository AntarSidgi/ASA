<?php
function AddUser($user_id) {
    $file = file_get_contents("users.json");
    $decode = json_decode($file, 1);
    if($decode[$user_id] != true){
        $decode[$user_id] = true;
    }
    $encode = json_encode($decode);
    file_put_contents("users.json", $encode);
}
function CountUser() {
    $file = file_get_contents("users.json");
    $decode = json_decode($file, 1);
    return count($decode);
}
function ban($user_id) {
    $file = file_get_contents("ban.json");
    $decode = json_decode($file, 1);
    $decode[$user_id] = true;
    $encode = json_encode($decode);
    file_put_contents("ban.json", $encode);
}
function unban($user_id) {
    $file = file_get_contents("ban.json");
    $decode = json_decode($file, 1);
    unset($decode[$user_id]);
    $encode = json_encode($decode);
    file_put_contents("ban.json", $encode);
}
function CheckBan($user_id) {
    $file = file_get_contents("ban.json");
    $decode = json_decode($file, 1);
    if (isset($decode[$user_id]) && $decode[$user_id] == true) {
        return true;
    } else {
        return false;
    }
}
function AddFowardReply($user_id, $text, $message_id, $time) {
    $file = file_get_contents("list.json");
    $decode = json_decode($file, 1);
    if (!isset($decode[$time][$text]) && !$decode[$time][$text][0] == $user_id) {
        $decode[$time][$text] = [$user_id, $message_id];
        $encode = json_encode($decode);
        file_put_contents("list.json", $encode);
        return true;
    } else {
        return false;
    }
}
function GetDataForward($time, $text) {
    $file = file_get_contents("list.json");
    $decode = json_decode($file, 1);
    if (isset($decode[$time][$text][0])) {
        return $decode[$time][$text];
    } else {
        return false;
    }
}
require_once "ASA.php";
$AntarX = new ASA("TOKEN_HERE", true);
$update = json_decode(file_get_contents("php://input"));
file_put_contents("updates.txt", file_get_contents("php://input"));
if (!empty($update->message)) {
    $message = $update->message;
    $update_time = $message->date;
}
if (!empty($update->callback_query)) {
    $callback_query = $update->callback_query;
}
if (!empty($update->edited_message)) {
    $message_edit = $update->edited_message;
}
if (isset($callback_query)) {
    $lang_user = $callback_query->from->language_code;
    $callback_type = $callback_query->message->chat->type;
    $data = $callback_query->data;
    $chat_inline = $callback_query->message->chat->id;
    $from_inline = $callback_query->from->id;
    $message_id_inline = $callback_query->message->message_id;
    if (!empty($callback_query->id)) {
        $callback_query_id = $callback_query->id;
        $AntarX->SetCallBackID($callback_query_id);
    }
}
if (!empty($message)) {
    if (!empty($message->reply_to_message)) {
        $reply = $message->reply_to_message;
    }
    $message_id = $message->message_id;
    if (!empty($message->chat)) {
        $chat_id = $message->chat->id;
        $chat_type = $message->chat->type;
    }
    if (!empty($message->from)) {
        $lang_user = $message->from->language_code;
        $from_id = $message->from->id;
        if (!empty($message->from->first_name)) {
            $from_first_name = $message->from->first_name;
        }
        if (!empty($message->from->last_name)) {
            $from_last_name = $message->from->last_name;
        }
        if (!empty($message->from->username)) {
            $from_username = $message->from->username;
        }
        $language_code = $message->from->language_code;
    }
    if (!empty($message->reply_to_message)) {
        $reply = $message->reply_to_message;
    }
    if (!empty($message->text)) {
        $text = $message->text;
    }
    if (!empty($message->forward_from)) {
        $forward = $message->forward_from;
    }
    if (!empty($message->sticker)) {
        $sticker = $message->sticker;
        $file_id = $sticker->file_id;
    }
    if (!empty($message->animation)) {
        $animation = $message->animation;
        $file_id = $animation->file_id;
    }
    if (!empty($message->voice)) {
        $voice = $message->voice;
        $file_id = $voice->file_id;
    }
    if (!empty($message->video)) {
        $video = $message->video;
        $file_id = $video->file_id;
    }
    if (!empty($message->document)) {
        $document = $message->document;
        $file_id = $document->file_id;
    }
    if (!empty($message->audio)) {
        $audio = $message->audio;
        $file_id = $audio->file_id;
    }
    if (!empty($message->edit_date)) {
        $edit = $message->edit_date;
    }
    if (!empty($message->contact)) {
        $contact = $message->contact;
    }
    if (!empty($message->game)) {
        $game = $message->game;
    }
    if (!empty($message->photo)) {
        $photo = $message->photo;
        $file_id = end($photo);
        $file_id = $file_id_photo->file_id;
    }
    if (!empty($message->video_note)) {
        $video_note = $message->video_note;
        $file_id = $video_note->file_id;
    }
    if (!empty($message->location)) {
        $location = $message->location;
    }
    if (!empty($message->caption)) {
        $caption = $message->caption;
    }
} elseif (!empty($message_edit)) {
    if (!empty($message_edit->reply_to_message)) {
        $reply = $message_edit->reply_to_message;
    }
    $message_id = $message_edit->message_id;
    if (!empty($message_edit->chat)) {
        $chat_id = $message_edit->chat->id;
        $chat_type = $message_edit->chat->type;
    }
    if (!empty($message_edit->from)) {
        $from_id = $message_edit->from->id;
        if (!empty($message_edit->from->first_name)) {
            $from_first_name = $message_edit->from->first_name;
        }
        if (!empty($message_edit->from->last_name)) {
            $from_last_name = $message_edit->from->last_name;
        }
        if (!empty($message_edit->from->username)) {
            $from_username = $message_edit->from->username;
        }
        $language_code = $message_edit->from->language_code;
    }
    $text = $message_edit->text;
}
if (!empty($text)) {
    $text = str_replace('۰', 0, $text);
    $text = str_replace('۱', 1, $text);
    $text = str_replace('۲', 2, $text);
    $text = str_replace('۳', 3, $text);
    $text = str_replace('۴', 4, $text);
    $text = str_replace('۵', 5, $text);
    $text = str_replace('۶', 6, $text);
    $text = str_replace('۷', 7, $text);
    $text = str_replace('۸', 8, $text);
    $text = str_replace('۹', 9, $text);
}
if (!empty($forward)) {
    $type_message = "forward";
} elseif (!empty($sticker)) {
    $type_message = "sticker";
} elseif (!empty($animation)) {
    $type_message = "animation";
} elseif (!empty($voice)) {
    $type_message = "voice";
} elseif (!empty($video)) {
    $type_message = "video";
} elseif (!empty($document)) {
    $type_message = "document";
} elseif (!empty($audio)) {
    $type_message = "audio";
} elseif (!empty($reply)) {
    $type_message = "reply";
} elseif (!empty($message_edit)) {
    $type_message = "edit";
} elseif (!empty($contact)) {
    $type_message = "contact";
} elseif (!empty($game)) {
    $type_message = "game";
} elseif (!empty($photo)) {
    $type_message = "photo";
} elseif (!empty($video_note)) {
    $type_message = "video_note";
} elseif (!empty($location)) {
    $type_message = "location";
} elseif (!empty($text)) {
    $type_message = "text";
}
if (isset($message->text)) {
    if (preg_match("/^[آ أ ا ب پ ت ث ج چ ح خ د ذ ر ز ژ س ش ص ض ط ظ ع غ ف ق ک گ ل م ن و ه ة ي ی]/", $text)) {
        $language_text = "arabic";
    } elseif (preg_match("/[a-zA-Z]/", $text)) {
        $language_text = "english";
    } else {
        $language_text = "unknown";
    }
}
if (isset($reply)) {
    if (!empty($reply->sticker)) {
        $sticker = $reply->sticker;
        $reply_file_id = $sticker->file_id;
    }
    if (!empty($reply->animation)) {
        $animation = $reply->animation;
        $reply_file_id = $animation->file_id;
    }
    if (!empty($reply->voice)) {
        $voice = $reply->voice;
        $reply_file_id = $voice->file_id;
    }
    if (!empty($reply->video)) {
        $video = $reply->video;
        $reply_file_id = $video->file_id;
    }
    if (!empty($reply->document)) {
        $document = $reply->document;
        $reply_file_id = $document->file_id;
    }
    if (!empty($reply->audio)) {
        $audio = $reply->audio;
        $reply_file_id = $audio->file_id;
    }
    if (!empty($reply->photo)) {
        $photo = $reply->photo;
        $file_id = end($photo);
        $reply_file_id = $file_id_photo->file_id;
    }
    if (!empty($reply->video_note)) {
        $video_note = $reply->video_note;
        $reply_file_id = $video_note->file_id;
    }
}
if (!isset($caption)) {
    $caption = " ";
}
$admin = 323823995;

if (isset($text) && $text == "/start") {
    AddUser($from_id);
    if ($from_id == $admin) {
        $AntarX->SetChatID($chat_id);
        $AntarX->SetData("
منور يا راستا 😐👍

");
        $AntarX->ReplyMarkup(['keyboard' => [
         [
         ['text' => 'الاعضاء'],
         ],
         ]]);
    } else {
        $AntarX->SetChatID($chat_id);
        $AntarX->SetData("
مرحبا بك في صندوق بريد عنتر  😍
يرجى ارسال رسالتك والانتظار حتى الرد");
        $AntarX->ReplyMarkup(['keyboard' => [[['text' => 'معلومات عني👤']], ]]);
    }
    $AntarX->SendMessage();
} elseif (isset($text) && $text == "الاعضاء" && $from_id == $admin) {

    $AntarX->SetChatID($chat_id);
    $AntarX->SetData("
تعداد اعضا : ".CountUser()."
    ");
    $AntarX->SendMessage();

} elseif (isset($text) && $text == "/ban" && $from_id == $admin) {
    if (isset($reply->text)) {
        $Data = GetDataForward($reply->forward_date, $reply->text);
    } elseif (isset($reply_file_id)) {
        $Data = GetDataForward($reply->forward_date, $reply_file_id);
    }
    $user_id = $Data[0];
    ban($user_id);
    $AntarX->SetChatID($chat_id);
    $AntarX->SetData("
    تم حظر المستخدم    ");
    $AntarX->SendMessage();
} elseif (isset($text) && $text == "/unban" && $from_id == $admin) {
    if (isset($reply->text)) {
        $Data = GetDataForward($reply->forward_date, $reply->text);
    } elseif (isset($reply_file_id)) {
        $Data = GetDataForward($reply->forward_date, $reply_file_id);
    }
    $user_id = $Data[0];
    unban($user_id);
    $AntarX->SetChatID($chat_id);
    $AntarX->SetData("
تم الغاء حظر المستخدم    ");
    $AntarX->SendMessage();
} elseif (isset($reply) && $from_id == $admin) {
    if (isset($reply->text)) {
        $Data = GetDataForward($reply->forward_date, $reply->text);
    } elseif (isset($reply_file_id)) {
        $Data = GetDataForward($reply->forward_date, $reply_file_id);
    }
    if (!isset($Data)) {
        $AntarX->SetChatID($chat_id);
        $AntarX->SetData("
        معلومات غير معروفة وغير محددة ....");
        $AntarX->SendMessage();
    } elseif (!is_array($Data)) {
        $AntarX->SetChatID($chat_id);
        $AntarX->SetData("
خطاء في التواصل");
        $AntarX->SendMessage();
    } else {
        if (isset($text)) {
            $AntarX->ReplyToMessage($Data[1]);
            $AntarX->SetChatID($Data[0]);
            $AntarX->SetData($text);
            $AntarX->SendMessage();
        } elseif (isset($photo)) {
            @$file_id_photo = end($photo);
            @$file_id_photo = $file_id_photo->file_id;
            $AntarX->ReplyToMessage($Data[1]);
            $AntarX->SetChatID($Data[0]);
            $AntarX->SetData($file_id_photo);
            $AntarX->SetCaption($caption);
            $AntarX->SendPhoto();
        } elseif (isset($voice)) {
            @$file_id = $voice->file_id;
            $AntarX->api('sendVoice', ['reply_to_message' => $Data[1], 'chat_id' => $Data[0], 'voice' => $file_id, 'caption' => $caption]);
        } elseif (isset($document)) {
            @$file_id = $document->file_id;
            $AntarX->api('senddocument', ['reply_to_message' => $Data[1], 'chat_id' => $Data[0], 'document' => $file_id, 'caption' => $caption]);
        } elseif (isset($sticker)) {
            @$file_id = $sticker->file_id;
            $AntarX->api('sendsticker', ['reply_to_message' => $Data[1], 'chat_id' => $Data[0], 'sticker' => $file_id, ]);
        } elseif (isset($video)) {
            @$file_id = $video->file_id;
            $AntarX->api('sendsticker', ['reply_to_message' => $Data[1], 'chat_id' => $Data[0], 'video' => $file_id, ]);
        } elseif (isset($video_note)) {
            @$file_id = $video_note->file_id;
            $AntarX->api('sendVideoNote', ['reply_to_message' => $Data[1], 'chat_id' => $Data[0], 'video_note' => $file_id, ]);
        }
    }
} elseif ($from_id != $admin) {
    if (CheckBan($from_id) == false) {
        if (isset($text) && $text == "معلومات عني👤") {
            $AntarX->SetChatID($from_id);
            $AntarX->SetData("
            - AntarAbdElmageed
            Country: Sudan🇸🇩
            Twitter: twitter.com/AntarSidgi
            Channel: @AntarAbdElmageed
            Group: @Antar_AlGames

");
            $AntarX->SendMessage();
        } else {
            if (isset($text)) {
                $Add = AddFowardReply($from_id, $text, $message_id, $update_time);
            } elseif (isset($file_id)) {
                $Add = AddFowardReply($from_id, $file_id, $message_id, $update_time);
            } else {
                $AntarX->SetChatID($chat_id);
                $AntarX->SetData("
                هذه الوسيلة غير مدعومة حاليًا");
                $AntarX->SendMessage();
            }
            if ($Add == false) {
                $AntarX->SetChatID($chat_id);
                $AntarX->SetData("
                يرجى المحاولة مرة أخرى");
                $AntarX->SendMessage();
            } else {
                $AntarX->SetChatID($chat_id);
                $AntarX->SetData("
                سأجيب قريبا");
                $AntarX->SendMessage();
                $AntarX->SetFromChatID($from_id);
                $AntarX->SetChatID($admin);
                $AntarX->SetMessageID($message_id);
                $AntarX->ForwardMessage();
            }
        }
    } else {
        $AntarX->SetChatID($chat_id);
        $AntarX->SetData("
عذرا أنت محظور🚫
");
        $AntarX->SendMessage();
    }
}
