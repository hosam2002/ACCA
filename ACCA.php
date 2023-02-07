<?php 

ob_start();

$API_KEY = '5977908365:AAEcb_1NoCeh3s6O8n_HX0ORr1kC0EcK5N0';
define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

$update      = json_decode(file_get_contents('php://input'));
$message     = $update->message;
$from_id     = $message->from->id;
$text        = $message->text;
$chat_id     = $message->chat->id;
$chat_id2    = $update->callback_query->message->chat->id;
$message_id  = $update->callback_query->message->message_id;
$message_id2 = $update->callback_query->message->message_id;
$data        = $update->callback_query->data;
$query       = $update->callback_query->id;
$owner       = 982003708;

if ($text == '/start') {

    bot('sendMessage', [

        'chat_id' => $chat_id,
        'parse_mode' => 'markdown',
        'text' => "مرحبــآ بك في مكتبة محاسبــة الالكترونيـــة",
        'reply_markup' => json_encode([

            'inline_keyboard' => [

                [['text' => 'الملخصــات', 'callback_data' => 'sheets']],
                [['text' => 'اخــرى', 'callback_data' => 'others']],
            ]
        ]),
    ]);
}

if ($data == 'sheets') {

    bot('EditMessageText', [

        'chat_id' => $chat_id2,
        'message_id' => $message_id2,
        'parse_mode' => 'markdown',
        'text' => "إليـك الملخصـات المتوفـرة حتى الان، يتـم تحديثهـا بإستمــرار",
        'reply_markup' => json_encode([

            'inline_keyboard' => [

                [['text' => 'مبادئ الحاسـوب', 'callback_data' => 'computer']],
                [['text' => 'مبادئ التسويـق', 'callback_data' => 'marketing']],
                [['text' => 'المتوســطة', 'callback_data' => 'i-accounting']],
                [['text' => 'محاسبـة التكاليــف', 'callback_data' => 'c-accounting']],
                [['text' => 'الاحصــاء', 'callback_data' => 'statistics']],
                [['text' => 'القــانون التجاري', 'callback_data' => 'commerical']],

                [['text' => 'رجــوع', 'callback_data' => 'home']]
            ]
        ]),
    ]);
}

// Files

$computerBasic = 'https://atsushyboy.000webhostapp.com/data/Computer%20Basic%20All.pdf';
$marketing = 'https://atsushyboy.000webhostapp.com/data/Marketing.pdf';
$iaccounting = '';
$caccounting = '';
$statictics = 'https://atsushyboy.000webhostapp.com/data/Statictics.pdf';
$commerical = 'https://atsushyboy.000webhostapp.com/data/Commerical.pdf';

// Computer

if ($data == 'computer') {

    bot('sendDocument', [
        
        'chat_id' => $chat_id2,
        'message_id' => $message_id2,
        'parse_mode' => 'markdown',
        'document' => $computerBasic, 
    ]);
}

// Marketing

if ($data == 'marketing') {

    bot('sendDocument', [
        
        'chat_id' => $chat_id2,
        'message_id' => $message_id2,
        'parse_mode' => 'markdown',
        'document' => $marketing, 
    ]);
}

// Accounting

if ($data == 'i-accounting') {

    bot('sendDocument', [
        
        'chat_id' => $chat_id2,
        'message_id' => $message_id2,
        'parse_mode' => 'markdown',
        'document' => $iaccounting, 
    ]);
}

// Accounting 

if ($data == 'c-accounting') {

    bot('sendDocument', [
        
        'chat_id' => $chat_id2,
        'message_id' => $message_id2,
        'parse_mode' => 'markdown',
        'document' => $caccounting, 
    ]);
}

// Statistics

if ($data == 'statictics') {

    bot('sendDocument', [
        
        'chat_id' => $chat_id2,
        'message_id' => $message_id2,
        'parse_mode' => 'markdown',
        'document' => $statictics, 
    ]);
}

// Commerical

if ($data == 'commerical') {

    bot('sendDocument', [
        
        'chat_id' => $chat_id2,
        'message_id' => $message_id2,
        'parse_mode' => 'markdown',
        'document' => $commerical, 
    ]);
}

// Others

$results = 'https://atsushyboy.000webhostapp.com/data/re-exam.pdf';

if ($data == 'others') {

    bot('EditMessageText', [

        'chat_id' => $chat_id2,
        'message_id' => $message_id2,
        'parse_mode' => 'markdown',
        'text' => "يتــم تحديث هذه البيــانات بإستمـرار",
        'reply_markup' => json_encode([

            'inline_keyboard' => [

                [['text' => 'النتــائج', 'callback_data' => 'unavailable']],
                [['text' => 'نتـائج المـلاحق', 'callback_data' => 'res']],
                [['text' => 'جــدول الدراســة', 'callback_data' => 'unavailable']],
                [['text' => 'جــدول الامتحـانات', 'callback_data' => 'unavailable']],
                [['text' => 'رجــوع', 'callback_data' => 'home']],
            ]
        ]),
    ]);
}

if ($data == 'res') {

    bot('sendDocument', [

        'chat_id' => $chat_id2,
        'message_id' => $message_id2,
        'parse_mode' => 'markdown',
        'document' => $results
    ]);
}

if ($data == 'unavailable') {
    
    bot('EditMessageText', [

        'chat_id' => $chat_id2,
        'message_id' => $message_id2,
        'parse_mode' => 'markdown',
        'text' => 'هـذا الخيــار غير متوفر، سيتم اضافتـه قريبــآ',
        'reply_markup' => json_encode([

            'inline_keyboard' => [

                [['text' => 'رجــوع', 'callback_data' => 'one-step-back']]
            ]
        ]),
    ]);
}

// one-step-back

if ($data == 'one-step-back') {

    bot('EditMessageText', [

        'chat_id' => $chat_id2,
        'message_id' => $message_id2,
        'parse_mode' => 'markdown',
        'text' => "يتــم تحديث هذه البيــانات بإستمـرار",
        'reply_markup' => json_encode([

            'inline_keyboard' => [

                [['text' => 'النتــائج', 'callback_data' => 'unavailable']],
                [['text' => 'نتـائج المـلاحق', 'callback_data' => 'res']],
                [['text' => 'جــدول الدراســة', 'callback_data' => 'unavailable']],
                [['text' => 'جــدول الامتحـانات', 'callback_data' => 'unavailable']],
                [['text' => 'رجــوع', 'callback_data' => 'back']],
            ]
        ]),
    ]);
}

// Home

if ($data == 'home') {

    bot('EditMessageText', [

        'chat_id' => $chat_id2,
        'message_id' => $message_id2,
        'parse_mode' => 'markdown',
        'text' => "مرحبــآ بك في مكتبة محاسبــة الالكترونيـــة",
        'reply_markup' => json_encode([

            'inline_keyboard' => [

                [['text' => 'الملخصــات', 'callback_data' => 'sheets']],
                [['text' => 'اخــرى', 'callback_data' => 'others']]
            ]
        ]),
    ]);
}

// Subscriper

$get = explode("\n", file_get_contents('users.txt'));

if ($text == '/start' and !in_array($chat_id, $get)) {
    file_put_contents('users.txt', "\n" . $chat_id, FILE_APPEND);
}

if ($text == 'users' and $chat_id == $owner) {
    $users = count($get) - 1;
    bot('sendMessage', [

        'chat_id' => $chat_id,
        'parse_mode' => 'markdown',
        'text' => "Your subscriper are: $users"
    ]);
}