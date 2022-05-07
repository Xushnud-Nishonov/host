<?php  

define('API_KEY', 'TOKEN');
$admin = "ADMIN";
$compane = "Ushbu bot @tekinhost_bot orqali yaratilgan !";

function bot($method, $datas = []){
    $url = "https://api.telegram.org/bot" . API_KEY . "/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    curl_close($ch);
    if (!curl_error($ch)) return json_decode($res);
};

function html($text){
    return str_replace(['<','>'],['&#60;','&#62;'],$text);
};

$update = json_decode(file_get_contents('php://input'));

file_put_contents("log.txt",file_get_contents('php://input'));

$message = $update->message;
$text = html($message->text);
$chat_id = $message->chat->id;
$from_id = $message->from->id;
$message_id = $message->message_id;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$full_name = html($first_name . " " . $last_name);

$reply_to_message = $message->reply_to_message;
$reply_chat_id = $message->reply_to_message->forward_from->id;
$reply_text = $message->text;

if ($chat_id != $admin) {
    if ($text == "/start") {
        $reply = "Assalomu alaykum <b>" . $full_name . "</b>,\nSizga qanday yordam bera olishim mumkin?\nMurojaatingizni yozib qoldiring.\n\n".$compane;
        sleep(1.5);
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => $reply,
            'parse_mode' => "HTML",
        ]);
    }
    elseif ($text != "/start") {
        sleep(1.5);
        bot('forwardMessage', [
            'chat_id' => $admin,
            'from_chat_id' => $chat_id,
            'message_id' => $message_id,
        ]);
    }
}
elseif ($chat_id == $admin) {
    if (isset($reply_to_message)) {
        sleep(1.5);
        bot('sendmessage', [
            'chat_id' => $reply_chat_id,
            'text' => $reply_text,
            'parse_mode' => "HTML",
        ]);
    }
    elseif ($text == "/start") {
        sleep(1.5);
        bot('sendmessage', [
            'chat_id' => $admin,
            'text' => "Salom Manager !",
        ]);
    }
    else {
        sleep(1.5);
        bot('sendmessage', [
            'chat_id' => $admin,
            'text' => "Hozircha hech qanday xabar yo'q !"
        ]);
    }
}

//https://api.telegram.org/bot2036741454:AAHQc8P8YE4iItFfDrdv5075F30t3FzRUVA/setwebhook?url=t.me/zaxira_fayllar/31

?>0