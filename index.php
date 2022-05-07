<?php

date_default_timezone_set('Asia/Tashkent');
define("API_KEY", "5289850226:AAGo_AuZuwmAMeHoZSD5P9XtiXBrEM5IWSQ");
$admin = "1190898538";
$compane = "@Tekinhost_bot";

function bot($method, $datas = []){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    curl_close($ch);
    if (!curl_error($ch)) return json_decode($res);
}

$update = json_decode(file_get_contents('php://input'));
$callback = $update->callback_query;
$data = $callback->data;
$cid = $callback->chat->id;
$cmid = $callback->message_id;

$message = $update->message;
$message_id = $message->message_id;
$chat_id = $message->chat->id;
$from_id = $message->from->id;
$text = $message->text;

mkdir("olmos");

if(mb_stripos($text,"/start $chat_id")!==false){
bot('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"Botga o‘zingizni taklif qila olmaysiz!",
      'parse_mode'=>'html',
      'reply_markup'=>$main_menu,
      ]);
}else{
      $idref = "olmos/$ex.db";
      $idref2 = file_get_contents($idref);
      $id = "$chat_id\n";
      $handle = fopen($idref, 'a+');
      fwrite($handle, $id);
      fclose($handle);
if(mb_stripos($idref2,$chat_id) !== false){
}else{
$pub=explode(" ",$text);
$ex=$pub[1];
$pul = file_get_contents("olmos/$ex.txt");
$a=$pul+10;
file_put_contents("olmos/$ex.txt","$a");
$odam = file_get_contents("odam/$ex.dat");
$b=$odam+1;
file_put_contents("odam/$ex.dat","$b");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>$reply,
'parse_mode'=>'html',
'reply_markup'=>$kalt,
]);
bot('sendmessage',[
'chat_id'=>$ex,
'text'=>"🛎 Siz <a href = 'tg://user?id=$chat_id'>do‘stingizni</a> taklif qildingiz sizga <b>10 ta</b> olmos berildi!",
'parse_mode'=>'html',
'reply_markup'=>$main_menu,
]);
}
}

$get = bot('getChatMember', [
'chat_id'=>"-1001527428417",
'user_id'=>$from_id
])->result->status;

$get1 = bot('getChatMember', [
'chat_id'=>"-1001320752492",
'user_id'=>$from_id
])->result->status;
if (!(($get == "creator" or $get == "administrator" or $get == "member") and ($get1 == "creator" or $get1 == "administrator" or $get1 == "member"))) {
    bot('sendmessage', [
        'chat_id'=>$chat_id,
        'text'=>"Kechirasiz siz bizning kanallarimizga a'zo bo'lmagan ekansiz. A'zo bo'lmasangiz botimiz ishlamaydi. A'zo bo'lib qayta /start bosing",
        'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>"👥A'zo Bo'lish", 'url'=>"https://t.me/bosh_hacker"]],
                [['text'=>"👥A'zo Bo'lish", 'url'=>"https://t.me/bosh_dasturchi"]]
            ]
        ])
    ]);
    return false;
}

mkdir("log");
mkdir("log/$from_id");
mkdir("odam");
mkdir("odam/$from_id");
mkdir("baza");
mkdir("baza/$from_id");

$sayt = "https://erkak.bigturn.ru/bots/Tekinhost_bot/";

$log = file_get_contents("log/$from_id/log.dat");
$log1 = "log/$from_id/log.dat";
$on = file_get_contents("on.db");

#------------------------------(Start bo'limi)------------------------------#
$main_menu = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
    [['text'=>"🤖Bot yaratish🤖"],['text'=>"💵Pul ishlash💵"]],
    [['text'=>"📊Statistika📊"],['text'=>"❗️ Ma'lumot ❗️"]],
    [['text'=>"👨🏻‍💻Admin Panel👨🏻‍💻"]]
]
]);

if ($text == "/start" and $on == "/on" or $text == "🏠Bosh Menyu") {
    file_put_contents($log1, "/start");
    $azo = file_get_contents("azo.dat");
    $soni = file_get_contents("odam/soni.dat");
    if (mb_stripos($azo, "$from_id")==false) {
        file_put_contents("azo.dat", "$azo\n$from_id");
        $h = $soni +1;
        file_put_contents("odam/soni.dat", $h);
    }
    bot('sendmessage', [
        'chat_id'=>$chat_id,
        'text'=>"O'zingizga kerakli bo'limni tanlang !\n\n👨🏻‍💻Dasturchi: <a href='tg://user?id=1190898538'>Xushnud Nishonov</a>\n📌Kanalimiz: @bosh_dasturchi",
        'parse_mode'=>"html",
        'reply_markup'=>$main_menu
    ]);
}

#------------------------------(Bot Yaratish)------------------------------#
$bot_menu = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
    [['text'=>"🤑Bepul botlar🤑"],['text'=>"💵Pullik botlar💵"]],
    [['text'=>"🏠Bosh Menyu"]]
]
]);

if ($text == "🤖Bot yaratish🤖" and $on == "/on" and $log == "/start") {
    file_put_contents($log1, $text);
    bot('sendmessage', [
        'chat_id'=>$chat_id,
        'text'=>"Yaratmoqchi bo'lgan botingizni turini tanlang !",
        'parse_mode'=>"html",
        'reply_markup'=>$bot_menu
    ]);
}

#------------------------------(Bepul botlar)------------------------------#
$fbot_menu = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
    [['text'=>"💬Aloqa bot"],['text'=>"👤Nik bot"]],
    [['text'=>"🔙Ortga"],['text'=>"🏠Bosh Menyu"]]
]
]);
if ($text == "🤑Bepul botlar🤑" and $on == "/on" and $log == "🤖Bot yaratish🤖") {
    file_put_contents($log1, $text);
    bot('sendmessage', [
        'chat_id'=>$chat_id,
        'text'=>"Marhamat o'zingiz uchun bepul bot yaratib olishingiz mumkin. \nBuning uchun bo'limni birini tanlang !",
        'parse_mode'=>"html",
        'reply_markup'=>$fbot_menu
    ]);
}
elseif ($text == "🔙Ortga" and $on == "/on" and $log == "🤑Bepul botlar🤑") {
    file_put_contents($log1, "🤖Bot yaratish🤖");
    bot('sendmessage', [
        'chat_id'=>$chat_id,
        'text'=>"Yaratmoqchi bo'lgan botingizni turini tanlang !",
        'parse_mode'=>"html",
        'reply_markup'=>$bot_menu
    ]);
}

#------------------------------(💬Aloqa bot)------------------------------#
$create_menu = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
    [['text'=>"🔙Ortga"],['text'=>"🏠Bosh Menyu"]]
]
]);

if ($text == "💬Aloqa bot" and $on == "/on" and $log == "🤑Bepul botlar🤑") {
    file_put_contents($log1, $text);
    bot('sendmessage', [
        'chat_id'=>$chat_id,
        'text'=>"📝 Dasturlash tili: PHP\n💾 Ma'lumot saqlash turi: OOP\n💵 Narx: Bepul\n\nBot ochishni davom ettirish uchun, botingizni tokenini yuboring:",
        'parse_mode'=>"html",
        'reply_markup'=>$create_menu
    ]);
}

elseif (mb_stripos($text, ":")!==false and $on == "/on" and $log == "💬Aloqa bot") {
    $kod = file_get_contents("bots/free/Aloqa.php");
    $kod = str_replace("ADMIN", $from_id, $kod);
    $kod = str_replace("TOKEN", $text, $kod);
    mkdir("baza/$from_id/Aloqa");
    file_put_contents("baza/$from_id/Aloqa/index.php", $kod);

    $web = file_get_contents("https://api.telegram.org/bot".$text."/setwebhook?url=".$sayt."baza/$from_id/Aloqa/index.php");
    $user = json_decode(file_get_contents("https://api.telegram.org/bot$text/getme"))->result->username;
    $nomi = json_decode(file_get_contents("https://api.telegram.org/bot$text/getme"))->result->first_name;
    bot('sendmessage', [
        'chat_id'=>$chat_id,
        'text'=>"⏳<b>Yuklanmoqda...</b>",
        'parse_mode'=>"html"
    ]);
    sleep(0.7);
    bot('editmessagetext', [
        'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
        'text'=>"□□□□□□□□□□ 0%"
    ]);
    sleep(1.0);
    bot('editmessagetext', [
        'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
        'text'=>"■□□□□□□□□□ 10%"
    ]);
    sleep(1.1);
    bot('editmessagetext', [
        'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
        'text'=>"■■□□□□□□□□ 20%"
    ]);
    sleep(1.5);
    bot('editmessagetext', [
        'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
        'text'=>"■■■□□□□□□□ 30%"
    ]);
    sleep(1.9);
    bot('editmessagetext', [
        'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
        'text'=>"■■■■□□□□□□ 40%"
    ]);
    sleep(2.2);
    bot('editmessagetext', [
        'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
        'text'=>"■■■■■□□□□□ 50%"
    ]);
    sleep(1.6);
    bot('editmessagetext', [
        'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
        'text'=>"■■■■■■□□□□ 60%"
    ]);
    sleep(1.3);
    bot('editmessagetext', [
        'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
        'text'=>"■■■■■■■□□□ 70%"
    ]);
    sleep(1.0);
    bot('editmessagetext', [
        'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
        'text'=>"■■■■■■■■□□ 80%"
    ]);
    sleep(0.9);
    bot('editmessagetext', [
        'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
        'text'=>"■■■■■■■■■□ 90%"
    ]);
    sleep(0.5);
    bot('editmessagetext', [
        'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
        'text'=>"■■■■■■■■■■ 100%"
    ]);
    sleep(1.0);
    bot('deletemessage', [
        'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
    ]);
    bot('sendmessage', [
        'chat_id'=>$chat_id,
        'text'=>"Botingiz tayyor. pastdagi tugma orqali kirib /start bosishingiz mumkin !\nBotingiz nomi: $nomi",
        'parse_mode'=>"html",
        'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>"Botga o'tish", 'url'=>"https://t.me/$user"]]
            ]
        ])
    ]);
}
elseif (mb_stripos($text, ":")!==true and $on == "/on" and $log == "💬Aloqa bot" and $text !="🔙Ortga") {
    bot('sendmessage', [
        'chat_id'=>$chat_id,
        'text'=>"Token yuborishda xato !",
        'reply_markup'=>$create_menu
    ]);
}
elseif ($text == "🔙Ortga" and $on == "/on" and $log == "💬Aloqa bot") {
    file_put_contents($log1, "🤑Bepul botlar🤑");
    bot('sendmessage', [
        'chat_id'=>$chat_id,
        'text'=>"Marhamat o'zingiz uchun bepul bot yaratib olishingiz mumkin. \nBuning uchun bo'limni birini tanlang !",
        'parse_mode'=>"html",
        'reply_markup'=>$fbot_menu
    ]);
}

#------------------------------(👤Nik bot)------------------------------#
if ($text == "👤Nik bot" and $on == "/on" and $log == "🤑Bepul botlar🤑") {
    file_put_contents($log1, $text);
    bot('sendmessage', [
        'chat_id'=>$chat_id,
        'text'=>"📝 Dasturlash tili: PHP\n💾 Ma'lumot saqlash turi: OOP\n💵 Narx: Bepul\n\nBot ochishni davom ettirish uchun, botingizni tokenini yuboring:",
        'parse_mode'=>"html",
        'reply_markup'=>$create_menu
    ]);
}
elseif (mb_stripos($text, ":")!==false and $on == "/on" and $log == "👤Nik bot") {
    $kod = file_get_contents("bots/free/Nik.php");
    $kod = str_replace("TOKEN", $text, $kod);
    $kod = str_replace("ISM", $text, $kod);
    mkdir("baza/$from_id/Nik");
    file_put_contents("baza/$from_id/Nik/index.php", $kod);

    $web = file_get_contents("https://api.telegram.org/bot".$text."/setwebhook?url=".$sayt."baza/$from_id/Nik/index.php");
    $user = json_decode(file_get_contents("https://api.telegram.org/bot$text/getme"))->result->username;
    $nomi = json_decode(file_get_contents("https://api.telegram.org/bot$text/getme"))->result->first_name;
    bot('sendmessage', [
        'chat_id'=>$chat_id,
        'text'=>"⏳<b>Yuklanmoqda...</b>",
        'parse_mode'=>"html"
    ]);
    sleep(0.7);
    bot('editmessagetext', [
        'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
        'text'=>"□□□□□□□□□□ 0%"
    ]);
    sleep(1.0);
    bot('editmessagetext', [
        'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
        'text'=>"■□□□□□□□□□ 10%"
    ]);
    sleep(1.1);
    bot('editmessagetext', [
        'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
        'text'=>"■■□□□□□□□□ 20%"
    ]);
    sleep(1.5);
    bot('editmessagetext', [
        'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
        'text'=>"■■■□□□□□□□ 30%"
    ]);
    sleep(1.9);
    bot('editmessagetext', [
        'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
        'text'=>"■■■■□□□□□□ 40%"
    ]);
    sleep(2.2);
    bot('editmessagetext', [
        'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
        'text'=>"■■■■■□□□□□ 50%"
    ]);
    sleep(1.6);
    bot('editmessagetext', [
        'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
        'text'=>"■■■■■■□□□□ 60%"
    ]);
    sleep(1.3);
    bot('editmessagetext', [
        'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
        'text'=>"■■■■■■■□□□ 70%"
    ]);
    sleep(1.0);
    bot('editmessagetext', [
        'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
        'text'=>"■■■■■■■■□□ 80%"
    ]);
    sleep(0.9);
    bot('editmessagetext', [
        'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
        'text'=>"■■■■■■■■■□ 90%"
    ]);
    sleep(0.5);
    bot('editmessagetext', [
        'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
        'text'=>"■■■■■■■■■■ 100%"
    ]);
    sleep(1.0);
    bot('deletemessage', [
        'chat_id'=>$chat_id,
        'message_id'=>$message_id + 1,
    ]);
    bot('sendmessage', [
        'chat_id'=>$chat_id,
        'text'=>"Botingiz tayyor. pastdagi tugma orqali kirib /start bosishingiz mumkin !\nBotingiz nomi: $nomi",
        'parse_mode'=>"html",
        'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>"Botga o'tish", 'url'=>"https://t.me/$user"]]
            ]
        ])
    ]);
}
elseif (mb_stripos($text, ":")!==true and $on == "/on" and $log == "👤Nik bot" and $text !="🔙Ortga") {
    bot('sendmessage', [
        'chat_id'=>$chat_id,
        'text'=>"Token yuborishda xato !",
        'reply_markup'=>$create_menu
    ]);
}
elseif ($text == "🔙Ortga" and $on == "/on" and $log == "👤Nik bot") {
    file_put_contents($log1, "🤑Bepul botlar🤑");
    bot('sendmessage', [
        'chat_id'=>$chat_id,
        'text'=>"Marhamat o'zingiz uchun bepul bot yaratib olishingiz mumkin. \nBuning uchun bo'limni birini tanlang !",
        'parse_mode'=>"html",
        'reply_markup'=>$fbot_menu
    ]);
}

#------------------------------(Foydalanuvchi uchun cheklov)------------------------------#
if ($text == "👨🏻‍💻Admin Panel👨🏻‍💻" and $chat_id != $admin) {
    bot('sendmessage', [
        'chat_id'=>$chat_id,
        'text'=>"Bu bo'lim faqat bot admini uchun ishlaydi !"
    ]);
}

elseif ($on != "/on") {
    bot('sendmessage', [
        'chat_id'=>$chat_id,
        'text'=>"Bot texnik sabablarga ko'ra to'xtatib qo'yilgan !\nBirozdan so'ng /start bosing."
    ]);
}

#------------------------------(ADMIN PANEL)------------------------------#
if ($chat_id == $admin) {
    $adm_menu = json_encode([
        'resize_keyboard'=>true,
        'keyboard'=>[
            [['text'=>"✅Botni yoqish✅"],['text'=>"☑️Botni o'chirish☑️"]],
            [['text'=>"💵Pul o'tkazish💵"],['text'=>"💵Pul olish💵"]],
            [['text'=>"🏠Bosh Menyu"]]
        ]
    ]);
    if ($text == "👨🏻‍💻Admin Panel👨🏻‍💻") {
        file_put_contents($log1, "👨🏻‍💻Admin Panel👨🏻‍💻");
        bot('sendmessage', [
            'chat_id'=>$chat_id,
            'text'=>"Admin bo'limiga xush kelibsiz !",
            'reply_markup'=>$adm_menu
        ]);
    }
    if ($text == "✅Botni yoqish✅" and $log == "👨🏻‍💻Admin Panel👨🏻‍💻" or $text == "/on") {
        file_put_contents("on.db", "/on");
        bot('sendmessage', [
            'chat_id'=>$chat_id,
            'text'=>"✅Bot ishga tushirildi",
            'reply_markup'=>$adm_menu
        ]);
    }
    elseif ($text == "☑️Botni o'chirish☑️" and $log == "👨🏻‍💻Admin Panel👨🏻‍💻" or $text == "/off") {
        file_put_contents("on.db", "/off");
        bot('sendmessage', [
            'chat_id'=>$chat_id,
            'text'=>"☑️Bot to'xtatildi",
            'reply_markup'=>$adm_menu
        ]);
    }
}