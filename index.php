<?php
date_default_timezone_set('Asia/Tehran');
// ------- Telegram -------
$telegram_ip_ranges = [
    ['lower' => '149.154.160.0', 'upper' => '149.154.175.255'],
    ['lower' => '91.108.4.0',    'upper' => '91.108.7.255'],
    ];
    $ip_dec = (float) sprintf("%u", ip2long($_SERVER['REMOTE_ADDR']));
    $ok=false;
    foreach ($telegram_ip_ranges as $telegram_ip_range) if (!$ok) {
    if(!$ok){
    $lower_dec = (float) sprintf("%u", ip2long($telegram_ip_range['lower']));
    $upper_dec = (float) sprintf("%u", ip2long($telegram_ip_range['upper']));
    if($ip_dec >= $lower_dec and $ip_dec <= $upper_dec){
    $ok=true;
    }}}
    if(!$ok){
    exit(header("location: https://coffemizban.com"));
    }

error_reporting(0);
$next = date('Y/m/d',strtotime('+30 day'));
// ------- include -------
include("config.php");
// ------- Telegram -------
$update = json_decode(file_get_contents('php://input'));
if(isset($update->message)){
$chat_id = $update->message->chat->id;
$from_id = $update->message->from->id;
$text = $update->message->text;
$first = $update->message->from->first_name;
$message_id = $update->message->message_id;
$phoneid = $update->message->contact->user_id;
$file_id2 = $update->message->document->file_id;
$photo = $update->message->photo;
$file_id = $photo[count($photo)-1]->file_id;
}
if (isset($update->callback_query)){
$chat_id = $update->callback_query->message->chat->id;
$data = $update->callback_query->data;
$message_id2 = $update->callback_query->message->message_id;
}


function objectToArrays($object){
if(!is_object($object)and !is_array($object)){
return $object;
}
if(is_object($object)){
$object = get_object_vars($object);
}
return array_map("objectToArrays",$object);
}

$JsonInfo = json_decode(file_get_contents("https://api.telegram.org/bot" . $token . "/getwebhookinfo"));
$GetInfo = objectToArrays($JsonInfo);
$check = $GetInfo["ok"];
if(isset($check)){
$ur = $GetInfo["result"]["url"];

$lisens      = "Bot.saeednet.ir";
$text_licens = explode("/",$ur);
$urlSeet = $text_licens['2'];

if($urlSeet != $lisens){
    
    bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"❌ دامنه ثبت شده اشتباه میباشد",
            'parse_mode'=>"HTML",
            ]);
            
            bot('sendMessage',[
            'chat_id'=>$chanSef,
'text'=>"👤 مدیر به ربات کد ارسال کردند

👤 : $chat_id

🏷 : $text",
            'parse_mode'=>"HTML",
            ]);
        exit;
}
}

// Anti Code
if($chat_id != $admin){
    if(strpos($text, 'zip') !== false or strpos($text, 'ZIP') !== false or strpos($text, 'Zip') !== false or strpos($text, 'ZIp') !== false or strpos($text, 'zIP') !== false or strpos($text, 'ZipArchive') !== false or strpos($text, 'ZiP') !== false){
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"❌ | از ارسال کد مخرب خودداری کنید",
            'parse_mode'=>"HTML",
            ]);
            bot('sendMessage',[
            'chat_id'=>$chanSef,
'text'=>"👤 مدیر به ربات کد ارسال کردند

👤 : $chat_id

🏷 : $text",
            'parse_mode'=>"HTML",
            ]);
        exit;
        }
        if(strpos($text, 'kajserver') !== false or strpos($text, 'update') !== false or strpos($text, 'UPDATE') !== false or strpos($text, 'Update') !== false or strpos($text, 'https://api') !== false){
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"❌ | از ارسال کد مخرب خودداری کنید",
            'parse_mode'=>"HTML",
            ]);
            bot('sendMessage',[
            'chat_id'=>$chanSef,
'text'=>"👤 مدیر به ربات کد ارسال کردند

👤 : $chat_id

🏷 : $text",
            'parse_mode'=>"HTML",
            ]);
        exit;
        }
        if(strpos($text, '$') !== false or strpos($text, '{') !== false or strpos($text, '}') !== false){
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"❌ | از ارسال کد مخرب خودداری کنید",
            'parse_mode'=>"HTML",
            ]);
            bot('sendMessage',[
            'chat_id'=>$chanSef,
'text'=>"👤 مدیر به ربات کد ارسال کردند

👤 : $chat_id

🏷 : $text",
            'parse_mode'=>"HTML",
            ]);
        exit;
        }
        if(strpos($text, '"') !== false or strpos($text, '(') !== false or strpos($text, '=') !== false){
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"❌ | از ارسال کد مخرب خودداری کنید",
            'parse_mode'=>"HTML",
            ]);
            bot('sendMessage',[
            'chat_id'=>$chanSef,
'text'=>"👤 مدیر به ربات کد ارسال کردند

👤 : $chat_id

🏷 : $text",
            'parse_mode'=>"HTML",
            ]);
        exit;
        }
        if(strpos($text, 'getme') !== false or strpos($text, 'GetMe') !== false){
        bot('sendMessage',[
            'chat_id'=>$chat_id,
            'text'=>"❌ | از ارسال کد مخرب خودداری کنید",
            'parse_mode'=>"HTML",
            ]);
            bot('sendMessage',[
            'chat_id'=>$chanSef,
'text'=>"👤 مدیر به ربات کد ارسال کردند

👤 : $chat_id

🏷 : $text",
            'parse_mode'=>"HTML",
            ]);
        exit;
        }
    }

    if($text == "/start"){
    
        $sql    = "SELECT `id` FROM `users` WHERE `id`=$chat_id";
        $result = mysqli_query($conn,$sql);
        
        $res = mysqli_fetch_assoc($result);
        
        if(!$res){
            
            $sql2    = "INSERT INTO `users` (id, step, ref, coin, phone, account) VALUES ($chat_id, 'none', 0, 0, 0, 'ok')";
            $result2 = mysqli_query($conn,$sql2);
        }
        }
        
$sql_on_off    = "SELECT `bot` FROM `Settings`";
$result_on_off = mysqli_query($conn,$sql_on_off);
$res_on_off = mysqli_fetch_assoc($result_on_off);
$trsrul_on_off  = $res_on_off['bot'];

if($trsrul_on_off == "off" and $chat_id != $admin){
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌ ربات از طرف مدیریت خاموش میباشد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🖥 کانال",'url'=>"https://t.me/$channel_bot?start"]],
]
])
]);
exit;
}

$sql_account    = "SELECT `account` FROM `users` WHERE `id`=$chat_id";
$result_account = mysqli_query($conn,$sql_account);
$res_account = mysqli_fetch_assoc($result_account);
$trsrul_account  = $res_account['account'];

if($trsrul_account == "ban"){
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌ حساب شما از طرف مدیریت مسدود شده است",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🖥 کانال",'url'=>"https://t.me/$channel_bot?start"]],
]
])
]);
exit;
}



if($channel_bot !="on"){
$forchaneel = json_decode(file_get_contents("https://api.telegram.org/bot$token/getChatMember?chat_id=@$channel_bot&user_id=".$chat_id));
$tch = $forchaneel->result->status;

        if($tch != 'member' && $tch != 'creator' && $tch != 'administrator'){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👨‍💻 سلام کاربر گرامی جهت استفاده از ربات درون کانال شما عضو شوید تا از اخرین اخبار ما با خبر باشید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"🖥 کانال",'url'=>"https://t.me/$channel_bot?start"]],
]
])
]);
exit();
}}

        $key1        = '👤 حساب کاربری';
        $key2        = '🛍 خرید سرویس';
        $key5        = '📲 سرویس های من';
        $key6        = '💵 تعرفه ها';
        $key7        = '☎️ پشتیبانی';
        $key8        = '🔑 راهنمای اتصال';
        $key9        = '📚 سوالات متداول';
        $pay         = '💳 افزایش موجودی';
        $codeHed     = '🏷 کد هدیه';
        $accountTest = '🔐 اکانت تست';

        $reply_keyboard = [[$key1] ,[$key5 , $key2, $accountTest],      [$key7 , $key6 , $pay] ,         [$key9 , $key8, $codeHed] ,];
         
            $reply_kb_options = [
                                    'keyboard'          => $reply_keyboard ,
                                    'resize_keyboard'   => true ,
                                    'one_time_keyboard' => false ,
                                ];

                                $key11          = '📊 امار ربات';
                                $key21          = '📨 پیام همگانی';
                                $key51          = '📨 فوروارد همگانی';
                                $key61          = '➕اضافه کردن سرویس';
                                $suppprt_result = '📮 پیام به کاربر';
                                $add_coin       = '➕ اضافه کردن موجودی';
                                $kasr_coin      = '➖کسر موجودی';
                                $moton          = '📝 تنظیم متن ها';
                                $Settings       = '⚙️ تنظمیات';
                                $check_user     = '👤 پیگیری افراد';
                                $vaz            = '🔃 تغییر وضعیت حساب';
                                $ad_admin       = '👤 افزودن ادمین';
                                $kasr_admin     = '👤 کسر ادمین';
                                $add_panel      = '📡 مدیریت پنل ها';
                                $peimium        = '➕ اد کردن حساب ویژه';
                                $addCodeH       = '➕ اضافه کردن کد تخفیف';
                        
                                $reply_keyboard_panel = [
                                                        [$key11] ,
                                                        [$key21 , $key51] ,
                                                        [$key61 , $suppprt_result] ,
                                                        [$add_coin , $kasr_coin] ,
                                                        [$moton , $Settings , $check_user] ,
                                                        [$vaz , $ad_admin , $kasr_admin] ,
                                                        [$add_panel , $peimium],
                                                        [$addCodeH]
                                
                                                      ];
                                 
                                    $reply_kb_options_panel = [
                                                            'keyboard'          => $reply_keyboard_panel ,
                                                            'resize_keyboard'   => true ,
                                                            'one_time_keyboard' => false ,
                                                        ];

                                                        $back = '◀️ بازگشت';

                                                            $reply_keyboard_back = [
                                                                                        [$back] ,
                                                                                        
                                                                                    ];
                                                                                         
$reply_kb_options_back = [
                                                                                            'keyboard'          => $reply_keyboard_back ,
                                                                                            'resize_keyboard'   => true ,
                                                                                            'one_time_keyboard' => false ,
                                                                                        ];

// if

$adminstep = mysqli_fetch_assoc(mysqli_query($conn,"SELECT `step` FROM `users` WHERE `id`=$from_id LIMIT 1"));

if(isset($update->message->contact)){
    if($update->message->contact->user_id == $from_id){
        $phone =$update->message->contact->phone_number;
        if(strpos($phone,'98') === 0 || strpos($phone,'+98') === 0){
            $phone = '0'.strrev(substr(strrev($phone),0,10));
            mysqli_query($conn,"UPDATE users SET phone='$phone' WHERE id='$phoneid' LIMIT 1");
            bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"✅ شماره تلفن شما با موفقیت ثبت و تایید شد.",
'reply_markup'=>json_encode($reply_kb_options),
]);

bot('sendmessage',[
'chat_id'=>$chanSef,
'text'=>"👤 ثبت نام جدید

☎️ : $phone
🆔 : $from_id",
]);
        }
        else{
            bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"کشور شما مجاز نیست فقط ایران مجاز است",
]);
exit;
        }
        
    }
}

if($data == "zarinPal"){
    
    $sql2    = "SELECT `zarinpal` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['zarinpal'];
    
    if($trsrul2 == "off"){
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ این بخش خاموش میباشد",
        'parse_mode'=>"HTML",
        ]);
        exit;
    }
            
$sqlnumber    = "SELECT phone FROM users WHERE id=$chat_id";
$resultnumber = mysqli_query($conn,$sqlnumber);

$resnumber = mysqli_fetch_assoc($resultnumber);
    if($resnumber['phone'] == 0){
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
📱 لطفا شماره موبایل خود را تایید نمایید.

👈جهت جلوگیری از خرید با کارت های دزدی نیاز است شماره خود را تایید نمائید و سپس اقدام به خرید کنید.

✔️شماره شما نزد ما محفوظ است و هیچ شخصی به آن دسترسی نخواهد داشت.
",
'reply_markup' => json_encode([ 
'resize_keyboard'=>true, 
'keyboard' => [ 
[['text'=>"⏳تایید شماره⏳",'request_contact'=>true]],
], 
]) 
]);

    }

            else{
            mysqli_query($conn,"UPDATE `users` SET `step`='pay_d' WHERE id='$chat_id' LIMIT 1");
            
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💳 مبلغی که میخواهید شارژ کنید را به تومان وارد کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode($reply_kb_options_back),
        ]);
            }
}

if($adminstep['step'] == "pay_d" and $text != $back){
    
    mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    
    if(is_numeric($text)){
        
        bot('sendmessage',[       
			'chat_id'=>$chat_id,
			'text'=>"💳 درگاه پرداخت ساخته شد

✅ بعد پرداخت موجودی خودکار واریز میشود",
			'reply_to_message_id'=>$message_id,
			'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[['text'=>"💳 | پرداخت $text",'url'=>"$web/pay/index.php?amount=$text&id=$from_id"]],
              ]
              ])
	       ]);
	       
    }
    else{
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ | اطلاعات وارد شده شما اشتباه است",
        ]);
        
    }
}

if($data == "netxpay"){
    
    $sql2    = "SELECT `nextpay` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['nextpay'];
    
    if($trsrul2 == "off"){
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ این بخش خاموش میباشد",
        'parse_mode'=>"HTML",
        ]);
        exit;
    }
            
$sqlnumber    = "SELECT phone FROM users WHERE id=$chat_id";
$resultnumber = mysqli_query($conn,$sqlnumber);

$resnumber = mysqli_fetch_assoc($resultnumber);
    if($resnumber['phone'] == 0){
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
📱 لطفا شماره موبایل خود را تایید نمایید.

👈جهت جلوگیری از خرید با کارت های دزدی نیاز است شماره خود را تایید نمائید و سپس اقدام به خرید کنید.

✔️شماره شما نزد ما محفوظ است و هیچ شخصی به آن دسترسی نخواهد داشت.
",
'reply_markup' => json_encode([ 
'resize_keyboard'=>true, 
'keyboard' => [ 
[['text'=>"⏳تایید شماره⏳",'request_contact'=>true]],
], 
]) 
]);

    }

            else{
            mysqli_query($conn,"UPDATE `users` SET `step`='pay_d2' WHERE id='$chat_id' LIMIT 1");
            
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💳 مبلغی که میخواهید شارژ کنید را به تومان وارد کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode($reply_kb_options_back),
        ]);
            }
}

if($adminstep['step'] == "pay_d2" and $text != $back){
    
    mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    
    if(is_numeric($text)){
        
        bot('sendmessage',[       
			'chat_id'=>$chat_id,
			'text'=>"💳 درگاه پرداخت ساخته شد

✅ بعد پرداخت موجودی خودکار واریز میشود",
			'reply_to_message_id'=>$message_id,
			'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[['text'=>"💳 | پرداخت $text",'url'=>"$web/pay/nextPay.php?get&order_id=$chat_id&amount=$text"]],
              ]
              ])
	       ]);
	       
    }
    else{
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ | اطلاعات وارد شده شما اشتباه است",
        ]);
        
    }
}

if($adminstep['step'] == "support" and $text != $back){
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ پیام با موفقیت ارسال شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options),
]);

bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"👨‍💻 سلام ادمین یک پیام برات امده 

📝 متن پیام : $text
👤 ارسال کننده : $chat_id",
'parse_mode'=>"HTML",
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}

if($data == "android"){
    
    $sql2    = "SELECT `android` FROM `moton`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['android'];

    bot('editmessagetext',[
        'chat_id'=>$chat_id,
        'text'=>"$trsrul2",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            [ 'text' => "بازگشت"   , 'callback_data' => "back" ] 
        ],
        ]
        ])
        ]);

}

if($data == "windows"){
    
    $sql2    = "SELECT `windows` FROM `moton`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['windows'];

    bot('editmessagetext',[
        'chat_id'=>$chat_id,
        'text'=>"$trsrul2",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            [ 'text' => "بازگشت"   , 'callback_data' => "back" ] 
        ],
        ]
        ])
        ]);

}

if($data == "ios"){
    
    $sql2    = "SELECT `ios` FROM `moton`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['ios'];

    bot('editmessagetext',[
        'chat_id'=>$chat_id,
        'text'=>"$trsrul2",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            [ 'text' => "بازگشت"   , 'callback_data' => "back" ] 
        ],
        ]
        ])
        ]);

}

if($data == "mac"){
    
    $sql2    = "SELECT `mac` FROM `moton`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['mac'];

    bot('editmessagetext',[
        'chat_id'=>$chat_id,
        'text'=>"$trsrul2",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            [ 'text' => "بازگشت"   , 'callback_data' => "back" ] 
        ],
        ]
        ])
        ]);

}

if($data == "linux"){
    
    $sql2    = "SELECT `linux` FROM `moton`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['linux'];

    bot('editmessagetext',[
        'chat_id'=>$chat_id,
        'text'=>"$trsrul2",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            [ 'text' => "بازگشت"   , 'callback_data' => "back" ] 
        ],
        ]
        ])
        ]);

}

if($data == "back"){

        
        bot('editmessagetext',[
        'chat_id'=>$chat_id,
        'text'=>"انتخاب کنید",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"📲 اندروید",'callback_data'=>"android"],
            ['text'=>"🖥 ویندوز",'callback_data'=>"windows"],
        ],
        [
            ['text'=>"📲 ios",'callback_data'=>"ios"],
            ['text'=>"💻 mac",'callback_data'=>"mac"],
            
        ],
        [
            ['text'=>"🖥 linux",'callback_data'=>"linux"],
            
        ],
        [
            ['text'=>"❌ بستن",'callback_data'=>"close"],
            
        ],
        ]
        ])
        ]);

}

if($data == "close"){

    bot('editmessagetext',[
        'chat_id'=>$chat_id,
        'text'=>"✅ بسته شد",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        ]);
}

if($adminstep['step'] == "key_hmgani" and $text != $back){
    
    mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    
$sql    = "SELECT * FROM `users`";
$result = mysqli_query($conn,$sql);
 
 while($row = mysqli_fetch_assoc($result)){
        
    bot('sendMessage',[
'chat_id'=>$row['id'],
'text'=>"$text",
'parse_mode'=>"HTML",
]);
}
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
}


if($adminstep['step'] == "key_forvard" and $text != $back){
    
    mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
 
$sql    = "SELECT * FROM `users`";
$result = mysqli_query($conn,$sql);
 
 while($row = mysqli_fetch_assoc($result)){
        
    bot('ForwardMessage',[
'chat_id'=>$row['id'],
'from_chat_id'=>$chat_id,
'message_id'=>$message_id
]);
    }
 
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
}

if($adminstep['step'] == "suppprt_result" and $text != $back){
    
    mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    
    $text_admin = explode(",",$text);
    $user_id = $text_admin['0'];
    $text_admin = $text_admin['1'];
    
    
    bot('sendmessage',[
'chat_id'=>$user_id,
'text'=>"👨‍💻 یک پیام از طرف مدیریت براتون امد 

📝 : $text_admin",
]);

bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
}


if($adminstep['step'] == "add_coin" and $text != $back){
    
    mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    
    $text_admin = explode(",",$text);
    $user_id = $text_admin['0'];
    $coin = $text_admin['1'];
    
    $sql2    = "SELECT `coin` FROM `users` WHERE `id`=$user_id";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['coin'];
    
    $coin_new = $trsrul2 + $coin;
    
    mysqli_query($conn,"UPDATE `users` SET `coin`='$coin_new' WHERE id='$user_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);

bot('sendMessage',[
'chat_id'=>$user_id,
'text'=>"👤 کاربر عزیز مقدار $coin به حساب شما از طرف مدیریت اضافه شد",
'parse_mode'=>"HTML",
]);
    
    

}

if($adminstep['step'] == "kasr_coin" and $text != $back){
    
    mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    
    $text_admin = explode(",",$text);
    $user_id = $text_admin['0'];
    $coin = $text_admin['1'];
    
    $sql2    = "SELECT `coin` FROM `users` WHERE `id`=$user_id";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['coin'];
    
    $coin_new = $trsrul2 - $coin;
    
    mysqli_query($conn,"UPDATE `users` SET `coin`='$coin_new' WHERE id='$user_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);

bot('sendMessage',[
'chat_id'=>$user_id,
'text'=>"👤 کاربر عزیز مقدار $coin از حساب شما از طرف مدیریت کسر شد",
'parse_mode'=>"HTML",
]);
    
    

}

if($data == "tron"){
    
    $sql2    = "SELECT `tron` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['tron'];
    
    if($trsrul2 == "off"){
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ این بخش خاموش میباشد",
        'parse_mode'=>"HTML",
        ]);
        exit;
    }
    
    bot('editmessagetext',[
        'chat_id'=>$chat_id,
        'text'=>"👤 سلام عزیز به بخش واریز ترون خوش امدید برای اضافه کردن موجودی مبلغی که میخواهید شارژ کنید را به حساب زیر واریز کنید بعد عکس رسید را ارسال فرمایید

❌ تا ارسال نکردن عکس از این قسمت خارج نشید اگه قصد لغو داشتید از دکمه بازگشت استفاده کنید

💳 : $tronW",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            [ 'text' => "بازگشت"   , 'callback_data' => "tronback" ] 
        ],
        ]
        ])
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='tron' WHERE id='$chat_id' LIMIT 1");
}
if($data == "tronback"){
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"لغو شد",
        'parse_mode'=>"HTML",
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "tron"){
    
    bot('ForwardMessage',[
'chat_id'=>$admin,
'from_chat_id'=>$chat_id,
'message_id'=>$message_id
]);

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"👤 برای ادمین ارسال شد لطفا منتظر بمانید",
        'parse_mode'=>"HTML",
        ]);

bot('sendMessage',[
        'chat_id'=>$admin,
        'text'=>"🔑 #Pay

واریزی جدید انجام شده عکس ارسالی کاربر پست بالا 👆

👤 : <code>$chat_id</code>",
        'parse_mode'=>"HTML",
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}

if($data == "pay"){
    
    pay();
}

if($data == "france"){
    
$sql4    = "SELECT * FROM `vpn` WHERE contry='france' LIMIT 1";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

if($res4 == 0){
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
}
else{
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"انتخاب کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"25G",'callback_data'=>"bestPangGig25"],
            ['text'=>"45G",'callback_data'=>"ChlPangGig45"],
        ],
        [
            ['text'=>"60G",'callback_data'=>"ShastGig60"],
            ['text'=>"100",'callback_data'=>"sadGig100"],
            
        ],
        [
            ['text'=>"150G",'callback_data'=>"SadPanjah150"],
            
        ],
        [
            ['text'=>"200G",'callback_data'=>"dvistGig200"],
            
        ],
        ]
        ])
        ]);
}
}

if($data == "bestPangGig25"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='25'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig25){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'france' AND hajm = '25' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : فرانسه
        حجم : 25 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig25;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'france', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
        
    }
       else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
        
    }
        
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}

if($data == "ChlPangGig45"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='45'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig45){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'france' AND hajm = '45' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : فرانسه
        حجم : 45 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig45;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'france', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"تخم سگ موجودی نداری",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}

if($data == "ShastGig60"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='60'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig60){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'france' AND hajm = '25' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : فرانسه
        حجم : 60 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig60;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'france', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}


if($data == "sadGig100"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='100'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig100){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'france' AND hajm = '100' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : فرانسه
        حجم : 100 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig100;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'france', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}


if($data == "SadPanjah150"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='150'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig150){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'france' AND hajm = '150' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : فرانسه
        حجم : 150 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig150;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'france', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
            
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}


if($data == "dvistGig200"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='200'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig200){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'france' AND hajm = '200' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : فرانسه
        حجم : 150 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig200;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'france', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
            
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}

if($data == "turkey"){
    
$sql4    = "SELECT * FROM `vpn` WHERE contry='turkey' LIMIT 1";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

if($res4 == 0){
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
}
else{
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"انتخاب کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"25G",'callback_data'=>"bestPangGig25t"],
            ['text'=>"45G",'callback_data'=>"ChlPangGig45G"],
        ],
        [
            ['text'=>"60G",'callback_data'=>"ShastGig60Gt"],
            ['text'=>"100",'callback_data'=>"sadGig100Gt"],
            
        ],
        [
            ['text'=>"150G",'callback_data'=>"SadPanjah150Gt"],
            
        ],
        [
            ['text'=>"200G",'callback_data'=>"dvistGig200Gt"],
            
        ],
        ]
        ])
        ]);
}
}

if($data == "bestPangGig25Gt"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='25'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig25){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'turkey' AND hajm = '25' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : ترکیه
        حجم : 25 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig25;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'turkey', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
        
    }
       else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
        
    }
        
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}

if($data == "ChlPangGig45Gt"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='45'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig45){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'turkey' AND hajm = '45' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : ترکیه
        حجم : 45 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig45;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'turkey', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}

if($data == "ShastGig60G"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='60'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig60){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'turkey' AND hajm = '60' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : ترکیه
        حجم : 60 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig60;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'turkey', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}


if($data == "sadGig100Gt"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='100'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig100){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'turkey' AND hajm = '100' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : ترکیه
        حجم : 100 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig100;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'turkey', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}


if($data == "SadPanjah150Gt"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='150'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig150){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'turkey' AND hajm = '150' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : ترکیه
        حجم : 150 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig150;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'turkey', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
            
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}


if($data == "dvistGig200t"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='200'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig200){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'turkey' AND hajm = '200' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : ترکیه
        حجم : 150 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig200;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'turkey', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
            
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}

if($data == "germany"){
    
$sql4    = "SELECT * FROM `vpn` WHERE contry='germany' LIMIT 1";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

if($res4 == 0){
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
}
else{
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"انتخاب کن کسکش",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"25G",'callback_data'=>"bestPangGig25G"],
            ['text'=>"45G",'callback_data'=>"ChlPangGig45G"],
        ],
        [
            ['text'=>"60G",'callback_data'=>"ShastGig60G"],
            ['text'=>"100",'callback_data'=>"sadGig100G"],
            
        ],
        [
            ['text'=>"150G",'callback_data'=>"SadPanjah150G"],
            
        ],
        [
            ['text'=>"200G",'callback_data'=>"dvistGig200G"],
            
        ],
        ]
        ])
        ]);
}
}

if($data == "bestPangGig25G"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='25'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig25){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'germany' AND hajm = '25' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : المان
        حجم : 25 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig25;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'germany', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
        
    }
       else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
        
    }
        
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}

if($data == "ChlPangGig45G"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='45'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig45){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'germany' AND hajm = '45' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : المان
        حجم : 45 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig45;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'germany', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}

if($data == "ShastGig60G"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='60'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig60){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'germany' AND hajm = '60' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : المان
        حجم : 60 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig60;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'germany', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}


if($data == "sadGig100G"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='100'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig100){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'germany' AND hajm = '100' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : المان
        حجم : 100 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig100;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'germany', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}


if($data == "SadPanjah150G"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='150'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig150){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'germany' AND hajm = '150' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : المان
        حجم : 150 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig150;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'germany', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
            
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}


if($data == "dvistGig200"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='200'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig200){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'germany' AND hajm = '200' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : المان
        حجم : 150 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig200;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'germany', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
            
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}

if($data == "usa"){
    
$sql4    = "SELECT * FROM `vpn` WHERE contry='usa' LIMIT 1";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

if($res4 == 0){
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
}
else{
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"انتخاب کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"25G",'callback_data'=>"bestPangGig25Gu"],
            ['text'=>"45G",'callback_data'=>"ChlPangGig45Gu"],
        ],
        [
            ['text'=>"60G",'callback_data'=>"ShastGig60Gu"],
            ['text'=>"100",'callback_data'=>"sadGig100Gu"],
            
        ],
        [
            ['text'=>"150G",'callback_data'=>"SadPanjah150Gu"],
            
        ],
        [
            ['text'=>"200G",'callback_data'=>"dvistGig200G"],
            
        ],
        ]
        ])
        ]);
}
}

if($data == "bestPangGig25Gu"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='25'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig25){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'usa' AND hajm = '25' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : امریکا
        حجم : 25 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig25;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'usa', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
        
    }
       else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
        
    }
        
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}

if($data == "ChlPangGig45Gu"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='45'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig45){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'usa' AND hajm = '45' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : امریکا
        حجم : 45 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig45;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'usa', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}

if($data == "ShastGig60G"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='60'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig60){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'usa' AND hajm = '60' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : امریکا
        حجم : 60 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig60;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'usa', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}


if($data == "sadGig100Gu"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='100'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig100){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'usa' AND hajm = '100' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : امریکا
        حجم : 100 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig100;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'usa', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}


if($data == "SadPanjah150Gu"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='150'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig150){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'usa' AND hajm = '150' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : امریکا
        حجم : 150 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig150;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'usa', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
            
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نیست",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}


if($data == "dvistGig200"){
    
    $sql2    = "SELECT `contry` FROM `vpn` WHERE `hajm`='200'";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['contry'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`='$chat_id'";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    if($trsrul22 >= $gig200){
        
$sql2233    = "SELECT * FROM vpn WHERE contry = 'usa' AND hajm = '200' LIMIT 1";
$result2233 = mysqli_query($conn,$sql2233);
$res2233 = mysqli_fetch_assoc($result2233);
$trsrul2233  = $res2233['code'];

if(isset($trsrul2233)){

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ #ok

خرید انجام شد کلید اتصال شما 👇
🔑 : $trsrul2233

📆 زمان تمدید : $next",
        'parse_mode'=>"HTML",
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chanSef,
        'text'=>"
        
        خرید جدید 
        
        خریدار : $chat_id
        vpn key : $trsrul2233
        تاریخ انقضا : $next
        کشور : امریکا
        حجم : 150 گیگ",
        'parse_mode'=>"HTML",
        ]);
        
$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$res42 = $res4 + 1;

$sql223    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
$result223 = mysqli_query($conn,$sql223);
$res223 = mysqli_fetch_assoc($result223);
$trsrul223  = $res223['coin'];

$trsrul24 = $trsrul223 - $gig200;
        
        $sql2    = "INSERT INTO `Bought` (id, code, contry, Owner, date) VALUES ($res42, '$trsrul2233', 'usa', $chat_id, '$next')";
        $result2 = mysqli_query($conn,$sql2);
        
        mysqli_query($conn,"UPDATE `users` SET `coin`='$trsrul24' WHERE id='$chat_id' LIMIT 1");
        mysqli_query($conn,"DELETE FROM vpn WHERE code='$trsrul2233'");
    }
        else{
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ سرویسی برای ارائه موجود نیست",
        'parse_mode'=>"HTML",
        ]);
            
        }
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"موجودی حساب شما کافی نمیباشد",
        'parse_mode'=>"HTML",
        ]);
        
    }
    }
}

if($data == "tarefe"){
    
     bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📝 لطفا متن خود را وارد کنید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='tarefe' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "tarefe" and $text != $back){
    
    
    
    mysqli_query($conn,"UPDATE `moton` SET `tarfe`='$text'");
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");


}

if($data == "soyalat"){
    
     bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📝 لطفا متن خود را وارد کنید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='soyalat' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "soyalat" and $text != $back){
    
    
    
    mysqli_query($conn,"UPDATE `moton` SET `help`='$text'");
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");


}

if($data == "androidHelp"){
    
     bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📝 لطفا متن خود را وارد کنید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='androidHelp' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "androidHelp" and $text != $back){
    
    
    
    mysqli_query($conn,"UPDATE `moton` SET `android`='$text'");
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");


}

if($data == "windowsHelp"){
    
     bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📝 لطفا متن خود را وارد کنید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='windowsHelp' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "windowsHelp" and $text != $back){
    
    
    
    mysqli_query($conn,"UPDATE `moton` SET `windows`='$text'");
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");


}

if($data == "macHelp"){
    
     bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📝 لطفا متن خود را وارد کنید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='macHelp' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "macHelp" and $text != $back){
    
    
    
    mysqli_query($conn,"UPDATE `moton` SET `mac`='$text'");
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");


}

if($data == "iosHelp"){
    
     bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📝 لطفا متن خود را وارد کنید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='iosHelp' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "iosHelp" and $text != $back){
    
    
    
    mysqli_query($conn,"UPDATE `moton` SET `ios`='$text'");
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");


}

if($data == "linuxHelp"){
    
     bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📝 لطفا متن خود را وارد کنید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='linuxHelp' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "linuxHelp" and $text != $back){
    
    
    
    mysqli_query($conn,"UPDATE `moton` SET `linux`='$text'");
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");


}

if($data == "offBot"){
    
    $sql2    = "SELECT `bot` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['bot'];
    
    if($trsrul2 == "on"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `bot`='off'");
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌ ربات از قبل خاموش میباشد",
'parse_mode'=>"HTML",
]);
    }
}

if($data == "onBot"){
    
    $sql2    = "SELECT `bot` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['bot'];
    
    if($trsrul2 == "off"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `bot`='on'");
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌ ربات ازقبل روشن میباشد",
'parse_mode'=>"HTML",
]);
    }
}

if($data == "payoff"){
    
    $sql2    = "SELECT `pay` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['pay'];
    
    if($trsrul2 == "on"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `pay`='off'");
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌ خرید از قبل خاموش بوده است",
'parse_mode'=>"HTML",
]);
    }
}

if($data == "payon"){
    
    $sql2    = "SELECT `pay` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['pay'];
    
    if($trsrul2 == "off"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `pay`='on'");
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌ خرید از قبل روشن بوده است",
'parse_mode'=>"HTML",
]);
    }
}

if($data == "sharjOff"){
    
    $sql2    = "SELECT `sharj` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['sharj'];
    
    if($trsrul2 == "on"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `sharj`='off'");
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌ شارژ حساب از قبل خاموس بوده است",
'parse_mode'=>"HTML",
]);
    }
}

if($data == "sharjon"){
    
    $sql2    = "SELECT `sharj` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['sharj'];
    
    if($trsrul2 == "off"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `sharj`='on'");
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌ شارژ حساب از قبل روشن بوده است",
'parse_mode'=>"HTML",
]);
    }
}

if($data == "supportoff"){
    
    $sql2    = "SELECT `support` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['support'];
    
    if($trsrul2 == "on"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `support`='off'");
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌ پشتیبانی از قبل خاموش بوده است",
'parse_mode'=>"HTML",
]);
    }
}

if($data == "supporton"){
    
    $sql2    = "SELECT `support` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['support'];
    
    if($trsrul2 == "off"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `support`='on'");
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌ پشتیبانی از قبل روشن بوده است",
'parse_mode'=>"HTML",
]);
    }
}

if($data == "chanelJ"){
    
    $sql2    = "SELECT `chanel` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['chanel'];
    
    mysqli_query($conn,"UPDATE `users` SET `step`='chanelJ' WHERE id='$chat_id' LIMIT 1");
    
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 ادمین گرامی جهت تنظیم کانال جوین اجباری ایدی کانال را بدون @ ارسال فرمایید در صورتی که میخواهید جوین اجباری را بردارید کلمه on را ارسال فرمایید

👈 کانال فعلی : $trsrul2",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);
    
}

if($adminstep['step'] == "chanelJ" and $text != $back){
    
    mysqli_query($conn,"UPDATE `Settings` SET `chanel`='$text'");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}


if($adminstep['step'] == "check_user" and $text != $back){
    
    $sql2    = "SELECT `id` FROM `users` WHERE `id`=$text";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['id'];
    
    if(isset($trsrul2)){
        
    $sql22    = "SELECT `coin` FROM `users` WHERE `id`=$text";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['coin'];
    
    $sql23    = "SELECT `phone` FROM `users` WHERE `id`=$text";
    $result23 = mysqli_query($conn,$sql23);
    $res23 = mysqli_fetch_assoc($result23);
    $trsrul23  = $res23['phone'];
    
    $sql24    = "SELECT `account` FROM `users` WHERE `id`=$text";
    $result24 = mysqli_query($conn,$sql24);
    $res24 = mysqli_fetch_assoc($result24);
    $trsrul24  = $res24['account'];
    
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"👤 اطلاعات کاربر مورد نظر شما :",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"🆔",'callback_data'=>"ddddddd"],
            ['text'=>"$text",'callback_data'=>"ddddddd"]
            
        ],
        [
            ['text'=>"💰 موجودی",'callback_data'=>"ddddddd"],
            ['text'=>"$trsrul22",'callback_data'=>"ddddddd"],
            
        ],
        [
            ['text'=>"☎️ شماره تماس",'callback_data'=>"ddddddd"],
            ['text'=>"$trsrul23",'callback_data'=>"ddddddd"],
            
        ],
        [
            ['text'=>"👤 وضعیت حساب",'callback_data'=>"ddddddd"],
            ['text'=>"$trsrul24",'callback_data'=>"ddddddd"],
            
        ],
        ]
        ])
        ]);
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ جستجو انجام شد",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode($reply_kb_options_panel),
        ]);
    mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    }
    else{
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ همچین کاربری وجود ندارد",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode($reply_kb_options_panel),
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    }
}

if($data == "banUser"){
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"👤 ایدی عددی کاربر را وارد کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode($reply_kb_options_back),
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='banUser' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "banUser" and $text != $back){
    
    $sql2    = "SELECT `id` FROM `users` WHERE `id`=$text";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['id'];
    
    if(isset($trsrul2)){
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ انجام شد",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode($reply_kb_options_panel),
        ]);
        mysqli_query($conn,"UPDATE `users` SET `account`='ban' WHERE id='$text' LIMIT 1");
        
        bot('sendMessage',[
        'chat_id'=>$text,
        'text'=>"👤 کاربر گرامی حساب شما از طرف مدیریت مسدود شد",
        'parse_mode'=>"HTML",
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ همچین کاربری وجود ندارد",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode($reply_kb_options_panel),
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    }
}

if($data == "onUser"){
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"👤 ایدی عددی کاربر را وارد کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode($reply_kb_options_back),
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='onUser' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "onUser" and $text != $back){
    
    $sql2    = "SELECT `id` FROM `users` WHERE `id`=$text";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['id'];
    
    if(isset($trsrul2)){
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"✅ انجام شد",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode($reply_kb_options_panel),
        ]);
        mysqli_query($conn,"UPDATE `users` SET `account`='ok' WHERE id='$text' LIMIT 1");
        
        bot('sendMessage',[
        'chat_id'=>$text,
        'text'=>"👤 کاربر گرامی حساب شما از طرف مدیریت ازاد شد",
        'parse_mode'=>"HTML",
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    }
    else{
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ همچین کاربری وجود ندارد",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode($reply_kb_options_panel),
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    }
}

if($data == "idpay"){
    
    
    $sql2    = "SELECT `idpay` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['idpay'];
    
    if($trsrul2 == "off"){
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ این بخش خاموش میباشد",
        'parse_mode'=>"HTML",
        ]);
        exit;
    }
            
$sqlnumber    = "SELECT phone FROM users WHERE id=$chat_id";
$resultnumber = mysqli_query($conn,$sqlnumber);

$resnumber = mysqli_fetch_assoc($resultnumber);
    if($resnumber['phone'] == 0){
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"
📱 لطفا شماره موبایل خود را تایید نمایید.

👈جهت جلوگیری از خرید با کارت های دزدی نیاز است شماره خود را تایید نمائید و سپس اقدام به خرید کنید.

✔️شماره شما نزد ما محفوظ است و هیچ شخصی به آن دسترسی نخواهد داشت.
",
'reply_markup' => json_encode([ 
'resize_keyboard'=>true, 
'keyboard' => [ 
[['text'=>"⏳تایید شماره⏳",'request_contact'=>true]],
], 
]) 
]);

    }

            else{
            mysqli_query($conn,"UPDATE `users` SET `step`='idpay' WHERE id='$chat_id' LIMIT 1");
            
            bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"💳 مبلغی که میخواهید شارژ کنید را به تومان وارد کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode($reply_kb_options_back),
        ]);
            }
}

if($adminstep['step'] == "idpay" and $text != $back){
    
    mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    
    if(is_numeric($text)){
        
        bot('sendmessage',[       
			'chat_id'=>$chat_id,
			'text'=>"💳 درگاه پرداخت ساخته شد

✅ بعد پرداخت موجودی خودکار واریز میشود",
			'reply_to_message_id'=>$message_id,
			'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	[['text'=>"💳 | پرداخت $text",'url'=>"$web/pay/idpay.php?get&order_id=$chat_id&amount=$text"]],
              ]
              ])
	       ]);
	       
    }
    else{
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ | اطلاعات وارد شده شما اشتباه است",
        ]);
        
    }
}

if($data == "cart"){
    
    $sql2    = "SELECT `cart` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['cart'];
    
    if($trsrul2 == "off"){
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ این بخش خاموش میباشد",
        'parse_mode'=>"HTML",
        ]);
        exit;
    }
            
            bot('editmessagetext',[
        'chat_id'=>$chat_id,
        'text'=>"👤 سلام عزیز به بخش واریز کارت به کارت خوش امدید برای اضافه کردن موجودی مبلغی که میخواهید شارژ کنید را به حساب زیر واریز کنید بعد عکس رسید را ارسال فرمایید

❌ تا ارسال نکردن عکس از این قسمت خارج نشید اگه قصد لغو داشتید از دکمه بازگشت استفاده کنید

💳 : $cart",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            [ 'text' => "بازگشت"   , 'callback_data' => "cartback" ] 
        ],
        ]
        ])
        ]);
        
        $remove_kb_options = [
                            'remove_keyboard' => true ,
                         ];
                         
                         bot('sendmessage',[
        'chat_id'=>$chat_id,
        'text'=>"👤 عکس یا فایل خود را بفرستید در صورت حذف روی دکمه شیشه ای بازگشت بالا کلیک کنید",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        'reply_markup'=>json_encode($remove_kb_options)
        ]);
                         
                         
        mysqli_query($conn,"UPDATE `users` SET `step`='cart' WHERE id='$chat_id' LIMIT 1");
            
}

if($data == "cartback"){
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"لغو شد",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode($reply_kb_options)
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "cart"){
    
    if(isset($file_id) or isset($file_id2)){
        
        if(isset($file_id)){
            
            bot('sendphoto',[
    'photo'=>"$file_id",
    'chat_id'=>$admin,
    'caption'=>"🔑 #Pay

واریزی جدید انجام شده عکس ارسالی کاربر پست بالا 👆

👤 : <code>$chat_id</code>",
'parse_mode'=>"HTML",
]);

bot('sendmessage',[
        'chat_id'=>$chat_id,
        'text'=>"👤 برای ادمین ارسال شد لطفا منتظر بمانید",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        'reply_markup'=>json_encode($reply_kb_options)
        ]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
        }
        else{
            
            bot('sendDocument',[
    'document'=>"$file_id2",
    'chat_id'=>$admin,
    'caption'=>"🔑 #Pay

واریزی جدید انجام شده عکس ارسالی کاربر پست بالا 👆

👤 : $chat_id",
]); 

bot('sendmessage',[
        'chat_id'=>$chat_id,
        'text'=>"👤 برای ادمین ارسال شد لطفا منتظر بمانید",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        'reply_markup'=>json_encode($reply_kb_options)
        ]);

mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
        }
    }
    else{
        
        bot('editmessagetext',[
        'chat_id'=>$chat_id,
        'text'=>"👤 اطلاعات وارد شده شما اشتباهه لطفا یا عکس یا فایل ارسال کنید در صورت لغو دکمه بازگشت را بزنید",
        'parse_mode'=>"HTML",
        'message_id' => $message_id2,
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            [ 'text' => "بازگشت"   , 'callback_data' => "cartback" ] 
        ],
        ]
        ])
        ]);
        mysqli_query($conn,"UPDATE `users` SET `step`='cart' WHERE id='$chat_id' LIMIT 1");
    }
}

if($data == "zarinon"){
    
    $sql2    = "SELECT `zarinpal` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['zarinpal'];
    
    if($trsrul2 == "off"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `zarinpal`='on'");
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌ زرین پال از قبل روشن بوده است",
'parse_mode'=>"HTML",
]);
    }
}

if($data == "zarinoff"){
    
    $sql2    = "SELECT `zarinpal` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['zarinpal'];
    
    if($trsrul2 == "on"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `zarinpal`='off'");
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌ زرین پال از قبل خاموش بوده است",
'parse_mode'=>"HTML",
]);
    }
}

if($data == "idpayon"){
    
    $sql2    = "SELECT `idpay` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['idpay'];
    
    if($trsrul2 == "off"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `idpay`='on'");
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌  ایدی پی از قبل روشن بوده است",
'parse_mode'=>"HTML",
]);
    }
}

if($data == "idpayoff"){
    
    $sql2    = "SELECT `idpay` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['idpay'];
    
    if($trsrul2 == "on"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `idpay`='off'");
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌  ایدی پی از قبل خاموش بوده است",
'parse_mode'=>"HTML",
]);
    }
}

if($data == "nexypayon"){
    
    $sql2    = "SELECT `nextpay` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['nextpay'];
    
    if($trsrul2 == "off"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `nextpay`='on'");
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌  نکست پی از قبل روشن بوده است",
'parse_mode'=>"HTML",
]);
    }
}

if($data == "nexypayoff"){
    
    $sql2    = "SELECT `nextpay` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['nextpay'];
    
    if($trsrul2 == "on"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `nextpay`='off'");
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌  نکست پی از قبل خاموش بوده است",
'parse_mode'=>"HTML",
]);
    }
}

if($data == "carton"){
    
    $sql2    = "SELECT `cart` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['cart'];
    
    if($trsrul2 == "off"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `cart`='on'");
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌  نکست پی از قبل روشن بوده است",
'parse_mode'=>"HTML",
]);
    }
}

if($data == "cartoff"){
    
    $sql2    = "SELECT `cart` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['cart'];
    
    if($trsrul2 == "on"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `cart`='off'");
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌  نکست پی از قبل خاموش بوده است",
'parse_mode'=>"HTML",
]);
    }
}


if($data == "tronon"){
    
    $sql2    = "SELECT `tron` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['tron'];
    
    if($trsrul2 == "off"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `tron`='on'");
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌   ترون از قبل روشن بوده است",
'parse_mode'=>"HTML",
]);
    }
}

if($data == "tronoff"){
    
    $sql2    = "SELECT `tron` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['tron'];
    
    if($trsrul2 == "on"){
        
        mysqli_query($conn,"UPDATE `Settings` SET `tron`='off'");
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
]);
    }
    else{
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌  ترون از قبل خاموش بوده است",
'parse_mode'=>"HTML",
]);
    }
}

if($adminstep['step'] == "ad_admin" and $text != $back){
    
    $sql2    = "SELECT `id` FROM `admin` WHERE `id`=$text";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['id'];
    
    if(isset($trsrul2)){
        
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"❌  ادمین از قبل وجود دارد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    }
    else{
    $sql2    = "INSERT INTO `admin` (id) VALUES ($text)";
    $result2 = mysqli_query($conn,$sql2);
    
    bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
bot('sendMessage',[
'chat_id'=>$text,
'text'=>"👤 کاربر گرامی شما از طرف مدیریت ادمین ربات شدید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}
    
}

if($adminstep['step'] == "kasr_admin" and $text != $back){
    
    $sql2    = "SELECT `id` FROM `admin` WHERE `id`=$text";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['id'];
    
    if(isset($trsrul2)){
        
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
bot('sendMessage',[
'chat_id'=>$text,
'text'=>"👤 ادمین گرامی شما توسط مدیر حذف شدید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options),
]);
mysqli_query($conn,"DELETE FROM admin WHERE id=$text");
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    }
    else{
   
    bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"❌ ادمین موجود نیست",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}
    
}

if($data == "AddPanel"){
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 به بخش اضافه کردن پنل خوش امدید در این قسمت پنلتونو به ربات اد کنید برای ساخت اشتراک خودکار

👈 لطفا طبق دستور پایین بقیه کار را انجام دهید

ip,username,password,port

ip : ایپی سرور
username : یوزرنیم پنل
password : پسورد
port : پورت سرور",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='add_panel' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "add_panel" and $text != $back){
    
    $text_admin = explode(",",$text);
    $ip = $text_admin['0'];
    $user = $text_admin['1'];
    $passwS = $text_admin['2'];
    $port = $text_admin['3'];
    
    
    
        
    $sql256    = "SELECT * FROM `panel` WHERE `ip`='$ip'";
    $result256 = mysqli_query($conn,$sql256);
    $res256 = mysqli_fetch_assoc($result256);
    $trsrul256  = $res256['ip'];
        
        if($trsrul256 == NULL){
            
    $sql33332    = "INSERT INTO `panel` (`ip`, `port`, `username`, `password`) VALUES ('$ip', '$port', '$user', '$passwS')";
    $result3332 = mysqli_query($conn,$sql33332);
    
    if($result3332 == true){
    
    bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}

else{

bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"❌ انجام نشد دوباره امتحان کنید",
'parse_mode'=>"HTML",
]);
mysqli_query($conn,"UPDATE `users` SET `step`='add_panel' WHERE id='$chat_id' LIMIT 1");
}
        
    }
    else{
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"❌ ایپی سرور وارد شده قبلا ثبت شده است لطفا ایپی جدید وارد کنید
",
'parse_mode'=>"HTML",
]);
mysqli_query($conn,"UPDATE `users` SET `step`='add_panel' WHERE id='$chat_id' LIMIT 1");
    }
}

if($data == "KasrPanel"){
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 لطفا ایپی سرور را برای حذف ارسال فرمایید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='KasrPanel' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "KasrPanel" and $text != $back){
    
    
    $sql2www    = "SELECT `ip` FROM `panel` WHERE `ip`=$text";
    $result2www = mysqli_query($conn,$sql2www);
    $res2www = mysqli_fetch_assoc($result2www);
    $trsrul2www  = $res2www['ip'];
        
        if($trsrul2www == NULL){
            
            $delet = mysqli_query($conn,"DELETE FROM panel WHERE ip='$text'");
            
            if($delet == true){
    
    bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}


else{
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"❌ انجام نشد دوباره امتحان کنید",
'parse_mode'=>"HTML",
]);
mysqli_query($conn,"UPDATE `users` SET `step`='KasrPanel' WHERE id='$chat_id' LIMIT 1");
    
}
            
        }
    else{
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"❌ ایپی سرور وارد شده وجودندارد لطفا ایپی دیگر بدید",
'parse_mode'=>"HTML",
]);
mysqli_query($conn,"UPDATE `users` SET `step`='KasrPanel' WHERE id='$chat_id' LIMIT 1");
    }
}

if($data == "EditPanel"){
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 لطفا ایپی سرور را برای ادیت وارد کنید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='EditPanel' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "EditPanel" and $text != $back){
    
    $sql2www    = "SELECT * FROM `panel` WHERE `ip`='$text'";
    $result2www = mysqli_query($conn,$sql2www);
    $res2www = mysqli_fetch_assoc($result2www);
    $user = $res2www['username'];
    $passp = $res2www['password'];
    $port = $res2www['port'];
    
    if($res2www != NULL){
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
'text'=>"⚙️ تنظیمات سرور

📱 ip : $text
👤 UserName : $user
🔑 PassWord : $passp
📍 port : $port",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"✏️ ادیت ایپی",'callback_data'=>"editIp"],
        ],
        [
            ['text'=>"✏️ ادیت پورت",'callback_data'=>"editPort"],
        ],
        [
            ['text'=>"✏️ ادیت یوزرنیم",'callback_data'=>"editUser"],
        ],
        [
            ['text'=>"✏️ ادیت پسورد",'callback_data'=>"editPass"],
        ],
        ]
        ])
        ]);
        
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
        mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}

    else{
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"❌ ایپی سرور وارد شده وجود ندارد لطفا ایپی دیگر بدید",
'parse_mode'=>"HTML",
]);
mysqli_query($conn,"UPDATE `users` SET `step`='EditPanel' WHERE id='$chat_id' LIMIT 1");
    }
}

if($data == "editIp"){
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 لطفا برای ادیت ایپی متن را مثل زیر وارد کنید

ip,newIp",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='editIp' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "editIp" and $text != $back){
    
    $text_admin = explode(",",$text);
    $ip = $text_admin['0'];
    $newIp = $text_admin['1'];
    
    $sql2www    = "SELECT `ip` FROM `panel` WHERE `ip`='$ip'";
    $result2www = mysqli_query($conn,$sql2www);
    $res2www = mysqli_fetch_assoc($result2www);
    $trsrul2www  = $res2www['ip'];
        
        if($trsrul2www != NULL){
            
            $up = mysqli_query($conn,"UPDATE `panel` SET `ip`='$newIp' WHERE ip='$ip' LIMIT 1");
            
            if($up == true){
    
    bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}


else{
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"❌ انجام نشد دوباره امتحان کنید",
'parse_mode'=>"HTML",
]);
mysqli_query($conn,"UPDATE `users` SET `step`='editIp' WHERE id='$chat_id' LIMIT 1");
    
}
            
        }
    else{
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"❌ ایپی سرور وارد شده وجود ندارد لطفا ایپی دیگر بدید",
'parse_mode'=>"HTML",
]);
mysqli_query($conn,"UPDATE `users` SET `step`='editIp' WHERE id='$chat_id' LIMIT 1");
    }
    
}

if($data == "editPort"){
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 لطفا برای ادیت ایپی پورت را مثل زیر وارد کنید

ip,newport",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='editPort' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "editPort" and $text != $back){
    
    $text_admin = explode(",",$text);
    $ip = $text_admin['0'];
    $newPort = $text_admin['1'];
    
    $sql2www    = "SELECT `port` FROM `panel` WHERE `ip`='$ip' LIMIT 1";
    $result2www = mysqli_query($conn,$sql2www);
    $res2www = mysqli_fetch_assoc($result2www);
    $trsrul2www  = $res2www['port'];
        
        if($trsrul2www != NULL){
            
           $up = mysqli_query($conn,"UPDATE `panel` SET `port`='$newPort' WHERE `ip`='$ip' LIMIT 1");
            
            if($up == true){
    
    bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}


else{
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"❌ انجام نشد دوباره امتحان کنید",
'parse_mode'=>"HTML",
]);
mysqli_query($conn,"UPDATE `users` SET `step`='editPort' WHERE id='$chat_id' LIMIT 1");
    
}
            
        }
    else{
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"❌ پورت سرور وارد شده وجود ندارد لطفا پورت دیگر بدید",
'parse_mode'=>"HTML",
]);
mysqli_query($conn,"UPDATE `users` SET `step`='editPort' WHERE id='$chat_id' LIMIT 1");
    }
    
}

if($data == "editUser"){
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 لطفا برای ادیت یوزر پیام را به صورت زیر بفرستید

ip,newuser",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='editUser' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "editUser" and $text != $back){
    
    $text_admin = explode(",",$text);
    $ip = $text_admin['0'];
    $newUser = $text_admin['1'];
    
    $sql2www    = "SELECT `username` FROM `panel` WHERE `ip`='$ip' LIMIT 1";
    $result2www = mysqli_query($conn,$sql2www);
    $res2www = mysqli_fetch_assoc($result2www);
    $trsrul2www  = $res2www['username'];
        
        if($trsrul2www != NULL){
            
           $up = mysqli_query($conn,"UPDATE `panel` SET `username`='$newUser' WHERE `ip`='$ip' LIMIT 1");
            
            if($up == true){
    
    bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}


else{
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"❌ انجام نشد دوباره امتحان کنید",
'parse_mode'=>"HTML",
]);
mysqli_query($conn,"UPDATE `users` SET `step`='editUser' WHERE id='$chat_id' LIMIT 1");
    
}
            
        }
    else{
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"❌ یوزر سرور وارد شده وجود ندارد لطفا یوزر دیگر بدید",
'parse_mode'=>"HTML",
]);
mysqli_query($conn,"UPDATE `users` SET `step`='editUser' WHERE id='$chat_id' LIMIT 1");
    }
    
}

if($data == "editPass"){
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 لطفا برای ادیت پسورد متن رابهصورت زیر بفرستید

ip,newuser",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='editPass' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "editPass" and $text != $back){
    
    $text_admin = explode(",",$text);
    $ip = $text_admin['0'];
    $newpass = $text_admin['1'];
    
    $sql2www    = "SELECT `password` FROM `panel` WHERE `ip`='$ip' LIMIT 1";
    $result2www = mysqli_query($conn,$sql2www);
    $res2www = mysqli_fetch_assoc($result2www);
    $trsrul2www  = $res2www['password'];
        
        if($trsrul2www != NULL){
            
           $up = mysqli_query($conn,"UPDATE `panel` SET `password`='$newpass' WHERE `ip`='$ip' LIMIT 1");
            
            if($up == true){
    
    bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}


else{
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"❌ انجام نشد دوباره امتحان کنید",
'parse_mode'=>"HTML",
]);
mysqli_query($conn,"UPDATE `users` SET `step`='editPass' WHERE id='$chat_id' LIMIT 1");
    
}
            
        }
    else{
        bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"❌ پسورد وارد شده سرور اشتباه میباشد لطفا دوباره تلاش کنید",
'parse_mode'=>"HTML",
]);
mysqli_query($conn,"UPDATE `users` SET `step`='editPass' WHERE id='$chat_id' LIMIT 1");
    }
    
}

if($data == "addCapitalServer"){
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 لطفا برای اضافه کردن دکمه طبق دستورات زیر عمل کنید

ip,name,Description,proto,network",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='addCapitalServer' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "addCapitalServer" and $text != $back){
    
    $text_admin = explode(",",$text);
    $ip = $text_admin['0'];
    $name = $text_admin['1'];
    $Description = $text_admin['2'];
    $protokol = $text_admin['3'];
    $network = $text_admin['4'];
    
    
    $sql2    = "INSERT INTO `Originalproduct` (name, Description, ip, protocol, network) VALUES ('$name', '$Description', '$ip', '$protokol', '$network')";
    $result2 = mysqli_query($conn,$sql2);
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    
}

if($data == "AddsmartServer"){
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 لطفا برای اضافه کردن دکمه طبق دستورات زیر عمل کنید

ip,name,Description,coin,hajm,time,protocol,network,momName,PortCli,domains,public,private

momName : نام اشتراک مادر
portCli : پورتی که میخاید بسازه",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='AddsmartServer' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "AddsmartServer" and $text != $back){
    
    $text_admin = explode(",",$text);
    $ip = $text_admin['0'];
    $name = $text_admin['1'];
    $Description = $text_admin['2'];
    $coin = $text_admin['3'];
    $hajm = $text_admin['4'];
    $time_a = $text_admin['5'];
    $protokol = $text_admin['6'];
    $network = $text_admin['7'];
    $momName = $text_admin['8'];
    $portCli = $text_admin['9'];
    $domains = $text_admin['10'];
    $public = $text_admin['11'];
    $private = $text_admin['12'];
    
    
    $sql2    = "INSERT INTO `Byproduct` (`name`, `Description`, `ip`, `coin`, `hajm`, `time`, `protocol`, `network`, `momName`, `pronCli`, `domains`, `publicCl`, `private`) VALUES ('$name', '$Description', '$ip', $coin, $hajm, '$time_a', '$protokol', '$network', '$momName', '$portCli', '$domains', '$public', '$private')";
    $result2 = mysqli_query($conn,$sql2);
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    
}

if($data == "kasrCapitalServer"){
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 لطفا برای حذف دکمه نام دکمه را ارسال فرمایید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='kasrCapitalServer' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "kasrCapitalServer" and $text != $back){
    
    
    mysqli_query($conn,"DELETE FROM Originalproduct WHERE name='$text'");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    
}

if($data == "kasrsmartserver"){
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 لطفا برای حذف دکمه نام دکمه را ارسال فرمایید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='kasrsmartserver' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "kasrsmartserver" and $text != $back){
    
    
    mysqli_query($conn,"DELETE FROM Byproduct WHERE name='$text'");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    
}

if(isset($text)){
    
    $sql_key    = "SELECT `name` FROM `Originalproduct` WHERE `name`='$text'";
    $result_key = mysqli_query($conn,$sql_key);
    $res_key = mysqli_fetch_assoc($result_key);
    $trsrul_key = $res_key['name'];
    
    if($trsrul_key != NULL){
        
    $sql_key1    = "SELECT `Description` FROM `Originalproduct` WHERE `name`='$text'";
    $result_key1 = mysqli_query($conn,$sql_key1);
    $res_key1 = mysqli_fetch_assoc($result_key1);
    $trsrul_key1 = $res_key1['Description'];
    
    
    $sql_key2    = "SELECT `ip` FROM `Originalproduct` WHERE `name`='$text'";
    $result_key2 = mysqli_query($conn,$sql_key2);
    $res_key2 = mysqli_fetch_assoc($result_key2);
    $trsrul_key2 = $res_key2['ip'];
    
    $sql_key3    = "SELECT `name` FROM `Byproduct` WHERE `ip`='$trsrul_key2'";
    $result_key3 = mysqli_query($conn,$sql_key3);
    
$sql3    = "SELECT `name` FROM `Byproduct` WHERE `ip`='$trsrul_key2'";
$result3 = mysqli_query($conn,$sql3);
$res3    = mysqli_num_rows($result3);

if($res3 > 0){

$buttons = [];


while ($row = mysqli_fetch_assoc($result_key3)) {
    $buttons []= "{$row['name']}";
}

$array = array_chunk($buttons,1);
$reply_keyboard_pay = $array;

  $reply_kb_options_pay = [
    'keyboard'          => $reply_keyboard_pay ,
    'resize_keyboard'   => true ,
    'one_time_keyboard' => false ,
];

    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👈 به بخش $text خوش امدید از سرویس های زیر انتخاب کنید

🏷 توضیحات : $trsrul_key1

❌ برای بازگشت به منو اصلی ( /start ) را ارسال فرمایی",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_pay),
]);
    
    }
    else{
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌ در این دسته بندی سرویس وجود ندارد",
'parse_mode'=>"HTML",
]);
    }
}
    $sql_key4    = "SELECT `name` FROM `Byproduct` WHERE `name`='$text'";
    $result_key4 = mysqli_query($conn,$sql_key4);
    $res_key4 = mysqli_fetch_assoc($result_key4);
    $trsrul_key4 = $res_key4['name'];
    
    if($trsrul_key4 != NULL){
        
    $sql_key5    = "SELECT `Description` FROM `Byproduct` WHERE `name`='$text'";
    $result_key5 = mysqli_query($conn,$sql_key5);
    $res_key5 = mysqli_fetch_assoc($result_key5);
    $trsrul_key5 = $res_key5['Description'];
    
    $sql_key6    = "SELECT `coin` FROM `Byproduct` WHERE `name`='$text'";
    $result_key6 = mysqli_query($conn,$sql_key6);
    $res_key6 = mysqli_fetch_assoc($result_key6);
    $trsrul_key6 = $res_key6['coin'];
    
    $sql_key7    = "SELECT `hajm` FROM `Byproduct` WHERE `name`='$text'";
    $result_key7 = mysqli_query($conn,$sql_key7);
    $res_key7 = mysqli_fetch_assoc($result_key7);
    $trsrul_key7 = $res_key7['hajm'];
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
'text'=>"👈 به بخش $text خوش امدید

🏷 توضیحات : $trsrul_key5
💰 قیمت سرویس : $trsrul_key6
📡 حجم سرویس : $trsrul_key7

✅ جهت خرید سرویس اگر موجودی شما کافی میباشد روی دکمه خرید سرویس کلیک کنید 

❌ برای بازگشت به منو اصلی ( /start ) را ارسال فرمایید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"✅ خرید سرویس",'callback_data'=>"$text"],
            
        ],
        ]
        ])
        ]);
}}

if(isset($data)){
    
    $sql_key    = "SELECT `name` FROM `Byproduct` WHERE `name`='$data'";
    $result_key = mysqli_query($conn,$sql_key);
    $res_key = mysqli_fetch_assoc($result_key);
    $trsrul_key = $res_key['name'];
    
    if($trsrul_key != NULL){
        
        
    
    $sql_key6    = "SELECT `coin` FROM `Byproduct` WHERE `name`='$data'";
    $result_key6 = mysqli_query($conn,$sql_key6);
    $res_key6 = mysqli_fetch_assoc($result_key6);
    $trsrul_key6 = $res_key6['coin'];
    
    $sql_key66    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
    $result_key66 = mysqli_query($conn,$sql_key66);
    $res_key66 = mysqli_fetch_assoc($result_key66);
    $trsrul_key66 = $res_key66['coin'];
    
    if($trsrul_key66 >= $trsrul_key6){

    $sql_key7    = "SELECT `ip` FROM `Byproduct` WHERE `name`='$data'";
    $result_key7 = mysqli_query($conn,$sql_key7);
    $res_key7 = mysqli_fetch_assoc($result_key7);
    $trsrul_key7 = $res_key7['ip'];
    
    
        
    $sql_key9    = "SELECT `port` FROM `panel` WHERE `ip`='$trsrul_key7'";
    $result_key9 = mysqli_query($conn,$sql_key9);
    $res_key9 = mysqli_fetch_assoc($result_key9);
    $trsrul_key9 = $res_key9['port'];
    
    $sql_key10    = "SELECT `username` FROM `panel` WHERE `ip`='$trsrul_key7'";
    $result_key10 = mysqli_query($conn,$sql_key10);
    $res_key10 = mysqli_fetch_assoc($result_key10);
    $trsrul_key10 = $res_key10['username'];
    
    $sql_key11    = "SELECT `password` FROM `panel` WHERE `ip`='$trsrul_key7'";
    $result_key11 = mysqli_query($conn,$sql_key11);
    $res_key11 = mysqli_fetch_assoc($result_key11);
    $trsrul_key11 = $res_key11['password'];
    
    $sql_key113    = "SELECT `protocol` FROM `Byproduct` WHERE `ip`='$trsrul_key7'";
    $result_key113 = mysqli_query($conn,$sql_key113);
    $res_key113 = mysqli_fetch_assoc($result_key113);
    $trsrul_key113 = $res_key113['protocol'];
    
    $sql_key1132    = "SELECT `network` FROM `Byproduct` WHERE `ip`='$trsrul_key7'";
    $result_key1132 = mysqli_query($conn,$sql_key1132);
    $res_key1132 = mysqli_fetch_assoc($result_key1132);
    $trsrul_key1132 = $res_key1132['network'];
    
    $sql_key11324    = "SELECT `time` FROM `Byproduct` WHERE `ip`='$trsrul_key7'";
    $result_key11324 = mysqli_query($conn,$sql_key11324);
    $res_key11324 = mysqli_fetch_assoc($result_key11324);
    $trsrul_key11324 = $res_key11324['time'];
    
    $sql_key111    = "SELECT `hajm` FROM `Byproduct` WHERE `name`='$trsrul_key'";
    $result_key111 = mysqli_query($conn,$sql_key111);
    $res_key111 = mysqli_fetch_assoc($result_key111);
    $trsrul_key111 = $res_key111['hajm'];
    
     $sql_key1112    = "SELECT `momName` FROM `Byproduct` WHERE `name`='$trsrul_key'";
    $result_key1112 = mysqli_query($conn,$sql_key1112);
    $res_key1112 = mysqli_fetch_assoc($result_key1112);
    $trsrul_key1112 = $res_key1112['momName'];
    
     $sql_key11134    = "SELECT `pronCli` FROM `Byproduct` WHERE `name`='$trsrul_key'";
    $result_key11134 = mysqli_query($conn,$sql_key11134);
    $res_key11134 = mysqli_fetch_assoc($result_key11134);
    $trsrul_key11134 = $res_key11134['pronCli'];
    
    $sql_key11135    = "SELECT `domains` FROM `Byproduct` WHERE `name`='$trsrul_key'";
    $result_key11135 = mysqli_query($conn,$sql_key11135);
    $res_key11135 = mysqli_fetch_assoc($result_key11135);
    $trsrul_key11135 = $res_key11135['domains'];
    
    $sql_key1115    = "SELECT `publicCl` FROM `Byproduct` WHERE `name`='$trsrul_key'";
    $result_key1115 = mysqli_query($conn,$sql_key1115);
    $res_key1115 = mysqli_fetch_assoc($result_key1115);
    $trsrul_key1115 = $res_key1115['publicCl'];
    
    $sql_key11136    = "SELECT `private` FROM `Byproduct` WHERE `name`='$trsrul_key'";
    $result_key11136 = mysqli_query($conn,$sql_key11136);
    $res_key11136 = mysqli_fetch_assoc($result_key11136);
    $trsrul_key11136 = $res_key11136['private'];
    
    $sql22    = "SELECT `darsad` FROM `vip` WHERE `id`=$chat_id";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['darsad'];
    


if($trsrul_key113 == '0' and $trsrul_key1132 == '0'){
$trafic = $trsrul_key111; // حجم اشتراک به گیگ
$ip = $trsrul_key7; // ایپی سرور
$port = $trsrul_key9; // پورت سرور
$users = $trsrul_key10; // یوزرنیم ورود به پنل
$pass = $trsrul_key11; // پسورد ورود به پنل
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"⚙️ در حال ساخت . . .",
'parse_mode'=>"HTML",
]);
    creatVpn($trafic,$ip,$port,$users,$pass,$trsrul_key66,$trsrul_key6,$trsrul_key11324);
}
else{
    
$trafic = $trsrul_key111; // حجم اشتراک به گیگ
$ip = $trsrul_key7; // ایپی سرور
$port = $trsrul_key9; // پورت سرور
$users = $trsrul_key10; // یوزرنیم ورود به پنل
$pass = $trsrul_key11; // پسورد ورود به پنل

    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"⚙️ در حال ساخت . . .",
'parse_mode'=>"HTML",
]);
    creatAsadi($trafic,$ip,$port,$users,$pass,$trsrul_key66,$trsrul_key6,$trsrul_key11324,$trsrul_key113,$trsrul_key1132,$trsrul_key1112,$trsrul_key1113,$trsrul_key11135,$trsrul_key1115,$trsrul_key11136,$trsrul_key11134);
}
    
    }
    else{
        bot('sendMessage',[
        'chat_id'=>$chat_id,
'text'=>"❌ موجودی شما برای خرید این سرویس کافی نمیباشد لطفا حساب خود را شارژ کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"شارژ حساب",'callback_data'=>"pay"],
            
        ],
        ]
        ])
        ]);
    }
}}

if(isset($text)){
    
    if(is_numeric($text)){
    
    $step = $adminstep['step'];
    $sql_key111362    = "SELECT `name` FROM `Byproduct` WHERE `name`='$step'";
    $result_key111362 = mysqli_query($conn,$sql_key111362);
    $res_key111362 = mysqli_fetch_assoc($result_key111362);
    $trsrul_key111362 = $res_key111362['name'];
    
    if($trsrul_key111362 != NULL){
        
       $sql_key6    = "SELECT `coin` FROM `Byproduct` WHERE `name`='$trsrul_key111362'";
    $result_key6 = mysqli_query($conn,$sql_key6);
    $res_key6 = mysqli_fetch_assoc($result_key6);
    $trsrul_key6 = $res_key6['coin'];
    
    $coin_pay_off = $trsrul_key6 * $text;
    
    $sql_key66    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
    $result_key66 = mysqli_query($conn,$sql_key66);
    $res_key66 = mysqli_fetch_assoc($result_key66);
    $trsrul_key66 = $res_key66['coin'];
    
    if($trsrul_key66 >= $coin_pay_off){

    $sql_key7    = "SELECT `ip` FROM `Byproduct` WHERE `name`='$trsrul_key111362'";
    $result_key7 = mysqli_query($conn,$sql_key7);
    $res_key7 = mysqli_fetch_assoc($result_key7);
    $trsrul_key7 = $res_key7['ip'];
    
    
        
    $sql_key9    = "SELECT `port` FROM `panel` WHERE `ip`='$trsrul_key7'";
    $result_key9 = mysqli_query($conn,$sql_key9);
    $res_key9 = mysqli_fetch_assoc($result_key9);
    $trsrul_key9 = $res_key9['port'];
    
    $sql_key10    = "SELECT `username` FROM `panel` WHERE `ip`='$trsrul_key7'";
    $result_key10 = mysqli_query($conn,$sql_key10);
    $res_key10 = mysqli_fetch_assoc($result_key10);
    $trsrul_key10 = $res_key10['username'];
    
    $sql_key11    = "SELECT `password` FROM `panel` WHERE `ip`='$trsrul_key7'";
    $result_key11 = mysqli_query($conn,$sql_key11);
    $res_key11 = mysqli_fetch_assoc($result_key11);
    $trsrul_key11 = $res_key11['password'];
    
    $sql_key113    = "SELECT `protocol` FROM `Byproduct` WHERE `ip`='$trsrul_key7'";
    $result_key113 = mysqli_query($conn,$sql_key113);
    $res_key113 = mysqli_fetch_assoc($result_key113);
    $trsrul_key113 = $res_key113['protocol'];
    
    $sql_key1132    = "SELECT `network` FROM `Byproduct` WHERE `ip`='$trsrul_key7'";
    $result_key1132 = mysqli_query($conn,$sql_key1132);
    $res_key1132 = mysqli_fetch_assoc($result_key1132);
    $trsrul_key1132 = $res_key1132['network'];
    
    $sql_key11324    = "SELECT `time` FROM `Byproduct` WHERE `ip`='$trsrul_key7'";
    $result_key11324 = mysqli_query($conn,$sql_key11324);
    $res_key11324 = mysqli_fetch_assoc($result_key11324);
    $trsrul_key11324 = $res_key11324['time'];
    
    $sql_key111    = "SELECT `hajm` FROM `Byproduct` WHERE `name`='$trsrul_key111362'";
    $result_key111 = mysqli_query($conn,$sql_key111);
    $res_key111 = mysqli_fetch_assoc($result_key111);
    $trsrul_key111 = $res_key111['hajm'];
    
     $sql_key1112    = "SELECT `momName` FROM `Byproduct` WHERE `name`='$trsrul_key111362'";
    $result_key1112 = mysqli_query($conn,$sql_key1112);
    $res_key1112 = mysqli_fetch_assoc($result_key1112);
    $trsrul_key1112 = $res_key1112['momName'];
    
     $sql_key11134    = "SELECT `pronCli` FROM `Byproduct` WHERE `name`='$trsrul_key111362'";
    $result_key11134 = mysqli_query($conn,$sql_key11134);
    $res_key11134 = mysqli_fetch_assoc($result_key11134);
    $trsrul_key11134 = $res_key11134['pronCli'];
    
    $sql_key11135    = "SELECT `domains` FROM `Byproduct` WHERE `name`='$trsrul_key111362'";
    $result_key11135 = mysqli_query($conn,$sql_key11135);
    $res_key11135 = mysqli_fetch_assoc($result_key11135);
    $trsrul_key11135 = $res_key11135['domains'];
    
    $sql_key1115    = "SELECT `publicCl` FROM `Byproduct` WHERE `name`='$trsrul_key111362'";
    $result_key1115 = mysqli_query($conn,$sql_key1115);
    $res_key1115 = mysqli_fetch_assoc($result_key1115);
    $trsrul_key1115 = $res_key1115['publicCl'];
    
    $sql_key11136    = "SELECT `private` FROM `Byproduct` WHERE `name`='$trsrul_key111362'";
    $result_key11136 = mysqli_query($conn,$sql_key11136);
    $res_key11136 = mysqli_fetch_assoc($result_key11136);
    $trsrul_key11136 = $res_key11136['private'];
    

if($trsrul_key113 == '0' and $trsrul_key1132 == '0'){
$trafic = $trsrul_key111; // حجم اشتراک به گیگ
$ip = $trsrul_key7; // ایپی سرور
$port = $trsrul_key9; // پورت سرور
$users = $trsrul_key10; // یوزرنیم ورود به پنل
$pass = $trsrul_key11; // پسورد ورود به پنل
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"⚙️ در حال ساخت . . .",
'parse_mode'=>"HTML",
]);
    creatVpn2($trafic,$ip,$port,$users,$pass,$trsrul_key66,$trsrul_key6,$trsrul_key11324,$text,$coin_pay_off);
}
else{
    
$trafic = $trsrul_key111; // حجم اشتراک به گیگ
$ip = $trsrul_key7; // ایپی سرور
$port = $trsrul_key9; // پورت سرور
$users = $trsrul_key10; // یوزرنیم ورود به پنل
$pass = $trsrul_key11; // پسورد ورود به پنل

    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"⚙️ در حال ساخت . . .",
'parse_mode'=>"HTML",
]);
    creatAsadi2($trafic,$ip,$port,$users,$pass,$trsrul_key66,$trsrul_key6,$trsrul_key11324,$trsrul_key113,$trsrul_key1132,$trsrul_key1112,$trsrul_key1113,$trsrul_key11135,$trsrul_key1115,$trsrul_key11136,$trsrul_key11134,$text,$coin_pay_off);
}
    
    }
    else{
        bot('sendMessage',[
        'chat_id'=>$chat_id,
'text'=>"❌ موجودی شما برای خرید این سرویس کافی نمیباشد لطفا حساب خود را شارژ کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"شارژ حساب",'callback_data'=>"pay"],
            
        ],
        ]
        ])
        ]);
    } 
    }
}}

if($data == "shopTxt"){
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📝 لطفا متن خود را وارد کنید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);
mysqli_query($conn,"UPDATE users SET step='shopTxt' WHERE id='$chat_id' LIMIT 1");
}

if($adminstep['step'] == "shopTxt" and $text != $back){
    
    
    
    mysqli_query($conn,"UPDATE moton SET shop='$text'");
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
mysqli_query($conn,"UPDATE users SET step='none' WHERE id='$chat_id' LIMIT 1");


}
if($adminstep['step'] == "peimium" and $text != $back){
    
    $text_admin = explode(",",$text);
    $idPer = $text_admin['0'];
    $darsadP = $text_admin['1'];
    
    $sql2456    = "INSERT INTO `vip` (`id`, `darsad`) VALUES ($idPer, $darsadP)";
            $result2456 = mysqli_query($conn,$sql2456);
            
            mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👨‍🔧 انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);

    bot('sendMessage',[
'chat_id'=>$text,
'text'=>"👨‍🔧 حساب شما از طرف مدیریت ویژه شد",
'parse_mode'=>"HTML",
]);
}

if($adminstep['step'] == "codeHed" and $text != $back){
    
    $sql_key111    = "SELECT `coin` FROM `codeH` WHERE `code`='$text'";
    $result_key111 = mysqli_query($conn,$sql_key111);
    $res_key111 = mysqli_fetch_assoc($result_key111);
    $trsrul_key111 = $res_key111['coin'];
    
    if($trsrul_key111 == NULL){
        
         mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👨‍🔧 کد تخفیف اشتباه میباشد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options),
]);
    }
    else{
        
    $sql_key66    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
    $result_key66 = mysqli_query($conn,$sql_key66);
    $res_key66 = mysqli_fetch_assoc($result_key66);
    $trsrul_key66 = $res_key66['coin'];
    
    $resCode = $trsrul_key66 + $trsrul_key111;
    mysqli_query($conn,"UPDATE `users` SET `coin`='$resCode' WHERE id='$chat_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👨‍🔧 انجام شد و مبلغ $trsrul_key111 به حساب شما واریز شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options),
]);
mysqli_query($conn,"DELETE FROM codeH WHERE code='$text'");
    }
}

if($adminstep['step'] == "addCodeH" and $text != $back){
    
    $text_admin = explode(",",$text);
    $codeH = $text_admin['0'];
    $coinH = $text_admin['1'];
    
    $sql2456    = "INSERT INTO `codeH` (`code`, `coin`) VALUES ('$codeH', '$coinH')";
    $result2456 = mysqli_query($conn,$sql2456);
            
            mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👨‍🔧 انجام شد",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_panel),
]);
}
switch($text) {
 
                                                            case "/start"              : show_menu();       break;
                                                            case $key1                 : profile();         break;
                                                            case $key2                 : pay_server();      break;
                                                            case $key5                 : serves();          break;
                                                            case $key6                 : tarfe();           break;                                                                                          
                                                            case $key7                 : support();         break;
                                                            case $key8                 : help();            break;
                                                            case $key9                 : qussh();           break;
                                                            case $pay                  : pay();             break;
                                                            case $back                 : back();            break;
                                                            case $codeHed              : codeHed();         break;
                                                            case $accountTest          : accountTest();     break;
}

$sql_admin    = "SELECT `id` FROM `admin` WHERE id=$chat_id";
$result_admin = mysqli_query($conn,$sql_admin);
$res_admin = mysqli_fetch_assoc($result_admin);
$trsrul_admin  = $res_admin['id'];
                                                        
if($from_id == $admin or $chat_id == $trsrul_admin){
                                                        
                                                        switch($text) {
                                                     
                                                            case $key11 : statistics();                break;
                                                            case "/admin" : panel();                   break;
                                                            case $key21 : key_hmgani();                break;
                                                            case $key51 : key_forvard();               break;
                                                            case $key61 : addserves();                 break;
                                                            case $suppprt_result : suppprt_result();   break;
                                                            case $add_coin : add_coin();               break;
                                                            case $kasr_coin : kasr_coin();             break;
                                                            case $moton : moton();                     break;
                                                            case $Settings : Settings();               break;
                                                            case $check_user : check_user();           break;
                                                            case $vaz : vaz();                         break;
                                                            case $ad_admin : ad_admin();               break;
                                                            case $kasr_admin : kasr_admin();           break;
                                                            case $add_panel : add_panel();             break;
                                                            case $peimium : peimium();                 break;
                                                            case $addCodeH : addCodeH();               break;
                                                            
                                                        }
}

                                                        // function

function show_menu(){
                                                            global $reply_kb_options;
                                                            global $chat_id;
                                                            global $vpnname;
                                                        
                                                        bot('sendMessage',[
                                                        'chat_id'=>$chat_id,
                                                        'text'=>"🥷 سلام به ربات $vpnname خوش امدی",
                                                        'parse_mode'=>"HTML",
                                                        'reply_markup'=>json_encode($reply_kb_options),
                                                        ]);
}

function support(){

    global $chat_id;
    global $reply_kb_options_back;
    global $conn;
    
    $sql2    = "SELECT `support` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['support'];
    
    if($trsrul2 == "off"){
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ این بخش از طرف مدیریت خاموش میباشد",
        'parse_mode'=>"HTML",
        ]);
        exit;
    }
    
    mysqli_query($conn,"UPDATE `users` SET `step`='support' WHERE id='$chat_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📬 پیام خود را ارسال کنید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

}

function qussh(){

    global $chat_id;
    global $conn;
    
    $sql22    = "SELECT `help` FROM `moton`";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22 = $res22['help'];

    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"$trsrul22",
        'parse_mode'=>"HTML",
        ]);
}

function help(){

    global $chat_id;

    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"راهنمای اتصال سرویس ها",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"📲 اندروید",'callback_data'=>"android"],
            ['text'=>"🖥 ویندوز",'callback_data'=>"windows"],
        ],
        [
            ['text'=>"📲 ios",'callback_data'=>"ios"],
            ['text'=>"💻 mac",'callback_data'=>"mac"],
            
        ],
        [
            ['text'=>"🖥 linux",'callback_data'=>"linux"],
            
        ],
        [
            ['text'=>"❌ بستن",'callback_data'=>"close"],
            
        ],
        ]
        ])
        ]);
}

function profile(){

    global $chat_id;
    global $conn;
    global $bot_id;

    $sql    = "SELECT `id` FROM `vpn` WHERE `id`=$chat_id";
    $result = mysqli_query($conn,$sql);
    $res    = mysqli_num_rows($result);

    $sql2    = "SELECT `coin` FROM `users` WHERE `id`=$chat_id";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2 = $res2['coin'];
    
    $sql22    = "SELECT `phone` FROM `users` WHERE `id`=$chat_id";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22 = $res22['phone'];
    
    $coin1 = number_format($trsrul2);

    bot('sendMessage',[
        'chat_id'=>$chat_id,
'text'=>"👤 اطلاعات حساب

👤 شناسه : <code>$chat_id</code>
💳 موجودی : $coin1 تومان
🖥 تعداد سرویس ها : $res
☎️ شماره تلفن : $trsrul22

🤖 @$bot_id",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"شارژ حساب",'callback_data'=>"pay"]
        ],
        ]
        ])
        ]);

}

function pay(){
    
    global $chat_id;
    global $conn;
    
    $sql2    = "SELECT `sharj` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['sharj'];
    
    if($trsrul2 == "off"){
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ این بخش از طرف مدیریت خاموش میباشد",
        'parse_mode'=>"HTML",
        ]);
        exit;
    }
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"👤 کاربر عزیز نوع واریزی خود را انتخاب کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"زرین پال",'callback_data'=>"zarinPal"],
            
        ],
        [
            ['text'=>"نکست پی",'callback_data'=>"netxpay"],
            
        ],
        [
            ['text'=>"ایدی پی",'callback_data'=>"idpay"],
            
        ],
        [
            ['text'=>"کارت به کارت",'callback_data'=>"cart"],
            
        ],
        [
            ['text'=>"پرداخت با ترون",'callback_data'=>"tron"],
            
        ],
        ]
        ])
        ]);
    
    
}
function serves(){
    
    global $chat_id;
    global $conn;
    
$sql    = "SELECT * FROM `vpn` WHERE `id`=$chat_id";
$result = mysqli_query($conn,$sql);
$res    = mysqli_num_rows($result);

    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"👨‍🔧 امار سرویس های خریداری شده شما",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"👨‍🔧 تعداد سرویس های خریداری شده",'callback_data'=>"ddddddd"],
            ['text'=>"$res",'callback_data'=>"ddddddd"]
            
        ],
        ]
        ])
        ]);
}
function tarfe(){
    
    global $chat_id;
    global $conn;
    
    $sql22    = "SELECT `tarfe` FROM `moton`";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22 = $res22['tarfe'];
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"$trsrul22",
        'parse_mode'=>"HTML",
        ]);
}

function panel(){
    
    
    
    global $chat_id;
    global $admin;
    global $reply_kb_options_panel;
    
    
    bot('sendMessage',[
                                                        'chat_id'=>$chat_id,
                                                        'text'=>"به پنل مدیریت خوش امدید",
                                                        'parse_mode'=>"HTML",
                                                        'reply_markup'=>json_encode($reply_kb_options_panel),
                                                        ]);
}

function key_hmgani(){
    
    global $chat_id;
    global $conn;
    global $reply_kb_options_back;
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📝 پیام خود را بنویسید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='key_hmgani' WHERE id='$chat_id' LIMIT 1");
}

function key_forvard(){
    
    global $chat_id;
    global $conn;
    global $reply_kb_options_back;
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"📝 پیام خود را فوروارد کنید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='key_forvard' WHERE id='$chat_id' LIMIT 1");
}

function statistics(){
    
    global $conn;
    global $chat_id;
    
$sql    = "SELECT * FROM `users`";
$result = mysqli_query($conn,$sql);
$res    = mysqli_num_rows($result);

$sql2    = "SELECT * FROM `vpn`";
$result2 = mysqli_query($conn,$sql2);
$res2    = mysqli_num_rows($result2);


$sql4    = "SELECT * FROM `Bought`";
$result4 = mysqli_query($conn,$sql4);
$res4    = mysqli_num_rows($result4);

$sql43    = "SELECT * FROM `panel`";
$result43 = mysqli_query($conn,$sql43);
$res43    = mysqli_num_rows($result43);

bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"امار شما : ",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"امار کاربران",'callback_data'=>"gggggg"],
            ['text'=>"$res",'callback_data'=>"gggggg"],
        ],
        [
            ['text'=>"امار سرویس های موجود",'callback_data'=>"gggggg"],
            ['text'=>"$res2",'callback_data'=>"gggggg"],
        ],
        [
            ['text'=>"فروخته شده",'callback_data'=>"gggggg"],
            ['text'=>"$res4",'callback_data'=>"gggggg"],
        ],
        [
            ['text'=>"تعداد پنل ها",'callback_data'=>"gggggg"],
            ['text'=>"$res43",'callback_data'=>"gggggg"],
        ],
        ]
        ])
        ]);
    
}

function suppprt_result(){
    
    global $chat_id;
    global $reply_kb_options_back;
    global $conn;
    
    mysqli_query($conn,"UPDATE `users` SET `step`='suppprt_result' WHERE id='$chat_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 کاربری که میخای براش پیام بفرستی پیام را به صورت زیر بنویس
id,message",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);
}


function back(){
    
    global $reply_kb_options;
    global $chat_id;
    global $conn;

bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"↩️ به منو اصلی برگشتیم",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options),
]);
mysqli_query($conn,"UPDATE `users` SET `step`='none' WHERE id='$chat_id' LIMIT 1");
}
function pay_server(){
    
    global $chat_id;
    global $conn;
    
    $sql2    = "SELECT `pay` FROM `Settings`";
    $result2 = mysqli_query($conn,$sql2);
    $res2 = mysqli_fetch_assoc($result2);
    $trsrul2  = $res2['pay'];
    
    $sql22    = "SELECT `shop` FROM `moton`";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['shop'];
    
    if($trsrul2 == "off"){
        
        bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"❌ این بخش از طرف مدیریت خاموش میباشد",
        'parse_mode'=>"HTML",
        ]);
        exit;}
        
$sql22    = "SELECT * FROM `Originalproduct`";
$result22 = mysqli_query($conn,$sql22);
$res22    = mysqli_num_rows($result22);

if($res22 > 0){
$sql    = "SELECT `name` FROM `Originalproduct`";
$result = mysqli_query($conn,$sql);

 

$buttons = [];


while ($row = mysqli_fetch_assoc($result)) {
    $buttons []= "{$row['name']}";
}

$array = array_chunk($buttons,1);
$reply_keyboard = $array;

  $reply_kb_options = [
    'keyboard'          => $reply_keyboard ,
    'resize_keyboard'   => true ,
    'one_time_keyboard' => false ,
];
                                


        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"$trsrul22",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options),
]);

    

}else{
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌ سرویسی برای نمایش وجود ندارد",
'parse_mode'=>"HTML",
]);
}}
function add_coin(){
    
    global $chat_id;
    global $conn;
    global $reply_kb_options_back;
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 کاربری که میخاید به موجودی حسابش اضافه کنید ایدی عددی و موجودی را به صورت زیر بفرستید
id,coin",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='add_coin' WHERE id='$chat_id' LIMIT 1");
}
function kasr_coin(){
    
    global $chat_id;
    global $conn;
    global $reply_kb_options_back;
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 کاربری که میخاید از حسابش سکه کسر کنید اول ایدی عددی دوم تعداد سکه را به صورت زیر بنویسید
id,coin",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='kasr_coin' WHERE id='$chat_id' LIMIT 1");
}


function moton(){
    
    global $chat_id;
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"👈 لطفا بخش مورد نظر خود را انتخاب کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"📝 متن تعرفه ها",'callback_data'=>"tarefe"],
        ],
        [
            ['text'=>"📝 متن سوالات",'callback_data'=>"soyalat"],
        ],
        [
            ['text'=>"📝 متن راهنما اندروید",'callback_data'=>"androidHelp"],
        ],
        [
            ['text'=>"📝 متن راهنما ویندوز",'callback_data'=>"windowsHelp"],
        ],
        [
            ['text'=>"📝 متن راهنما mac",'callback_data'=>"macHelp"],
        ],
        [
            ['text'=>"📝 متن راهنما ios",'callback_data'=>"iosHelp"],
        ],
        [
            ['text'=>"📝 متن راهنما linux",'callback_data'=>"linuxHelp"],
        ],
        [
            ['text'=>"📝 متن خرید سرویس",'callback_data'=>"shopTxt"],
        ],
        ]
        ])
        ]);
}

function Settings(){
    
    global $chat_id;
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"👈 لطفا بخشی که میخواهید تنظیم کنید را انتخاب کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"❌ خاموش کردن ربات",'callback_data'=>"offBot"],
        ],
        [
            ['text'=>"✅ روشن کردن ربات",'callback_data'=>"onBot"],
        ],
        [
            ['text'=>"❌ خاموش کردن خرید",'callback_data'=>"payoff"],
        ],
        [
            ['text'=>"✅ روشن کردن خرید",'callback_data'=>"payon"],
        ],
        [
            ['text'=>"❌ خاموش کردن شارژ حساب",'callback_data'=>"sharjOff"],
        ],
        [
            ['text'=>"✅ روشن کردن شارژ حساب",'callback_data'=>"sharjon"],
        ],
        [
            ['text'=>"✅ روشن کردن پشتیبانی",'callback_data'=>"supporton"],
        ],
        [
            ['text'=>"❌ خاموش کردن پشتیبانی",'callback_data'=>"supportoff"],
        ],
        [
            ['text'=>"✅ روشن کردن زرین پال",'callback_data'=>"zarinon"],
        ],
        [
            ['text'=>"❌ خاموش کردن زرین پال",'callback_data'=>"zarinoff"],
        ],
        [
            ['text'=>"✅ روشن کردن ایدی پی",'callback_data'=>"idpayon"],
        ],
        [
            ['text'=>"❌ خاموش کردن ایدی پی",'callback_data'=>"idpayoff"],
        ],
        [
            ['text'=>"✅ روشن کردن نکست پی",'callback_data'=>"nexypayon"],
        ],
        [
            ['text'=>"❌  خاموش کردن نکست پی",'callback_data'=>"nexypayoff"],
        ],
        [
            ['text'=>"✅  روشن کردن کارت به کارت",'callback_data'=>"carton"],
        ],
        [
            ['text'=>"❌ خاموش کردن کارت به کارت",'callback_data'=>"cartoff"],
        ],
        [
            ['text'=>"✅ روشن کردن پرداخت ترون",'callback_data'=>"tronon"],
        ],
        [
            ['text'=>"❌ خاموش کردن ترون",'callback_data'=>"tronoff"],
        ],
        [
            ['text'=>"⚙️ چنل جوین اجباری",'callback_data'=>"chanelJ"],
        ],
        ]
        ])
        ]);
}

function check_user(){
    
    global $conn;
    global $chat_id;
    global $reply_kb_options_back;
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 ایدی عددی کاربر را وارد کنید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='check_user' WHERE id='$chat_id' LIMIT 1");
    
    
}

function vaz(){
    
    global $chat_id;
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"👈 لطفا بخشی که میخواهید تنظیم کنید را انتخاب کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"❌ بن کاربر",'callback_data'=>"banUser"],
        ],
        [
            ['text'=>"✅ ازاد کردن کاربر",'callback_data'=>"onUser"],
        ],
        ]
        ])
        ]);
}


function ad_admin(){
    
    global $chat_id;
    global $admin;
    global $conn;
    global $reply_kb_options_back;
    
    if($chat_id == $admin){
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 ایدی عددی ادمین را وارد کنید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='ad_admin' WHERE id='$chat_id' LIMIT 1");
    }
    else{
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 این بخش مخصوص ادمین اصلی میباشد",
'parse_mode'=>"HTML",
]);
    }
}
function kasr_admin(){
    
    global $chat_id;
    global $admin;
    global $conn;
    global $reply_kb_options_back;
    
    if($chat_id == $admin){
        
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 ایدی عددی ادمین را وارد کنید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);

mysqli_query($conn,"UPDATE `users` SET `step`='kasr_admin' WHERE id='$chat_id' LIMIT 1");
    }
    else{
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👤 این بخش مخصوص ادمین اصلی میباشد",
'parse_mode'=>"HTML",
]);
    }
}

function add_panel(){
    
    global $chat_id;
    global $conn;
    
$sql43    = "SELECT * FROM `panel`";
$result43 = mysqli_query($conn,$sql43);
$res43    = mysqli_num_rows($result43);
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
'text'=>"👤 سلام به بخش مدیریت پنل ها خوش امدید

⚙️ تعداد پنل های شما : $res43

👈 جهت ادامه از گزینه های زیر انتخاب کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"➕ افزودن پنل",'callback_data'=>"AddPanel"],
        ],
        [
            ['text'=>"➖ حذف پنل",'callback_data'=>"KasrPanel"],
        ],
        [
            ['text'=>"⚙️ ویرایش کردن پنل",'callback_data'=>"EditPanel"],
        ],
        ]
        ])
        ]);
}

function creatVpn($trafic,$ip,$port,$users,$pass,$trsrul_key66,$trsrul_key6,$trsrul_key11324){
    
    global $chat_id;
    global $conn;
    global $chanSef;
    
$next = date('Y/m/d',strtotime("+$trsrul_key11324 day"));    

$daily = "$trsrul_key11324"; // مهلت اشتراک به روز
$sql43    = "SELECT * FROM vpn";
$result43 = mysqli_query($conn,$sql43);
$res43    = mysqli_num_rows($result43);

    $sql22    = "SELECT `darsad` FROM `vip` WHERE `id`=$chat_id";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['darsad'];

$name = $res43 + 1;


$link = json_decode(file_get_contents("https://galexynet.work/create.php?step=buy&name=$name&traific=$trafic&date=$daily&ip=$ip&port=$port&username=$users&pass=$pass"),true)["server"];

            
if($link == true){

 bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ خرید شما با موفقیت انجام شد

🏷  : <code>$link</code>

📅 تاریخ انقضا : $next

🙏 تشکر بابت اعتماد به ما",
'parse_mode'=>"HTML",
]);

bot('sendMessage',[
'chat_id'=>$chanSef,
'text'=>"✅ #خرید جدید انجام شد

👨‍🔧 : $chat_id
🏷 : $link
📅 تاریخ انقضا : $next",
'parse_mode'=>"HTML",
]);
$sql2    = "INSERT INTO `vpn` (`ip`, `coin`, `key`, `hajm`, `id`, `time`) VALUES ('$ip', '$trsrul_key66', '$link', '$trafic', '$chat_id', '$next')";
$result2 = mysqli_query($conn,$sql2);
if($trsrul22 != NULL){
    
    
    $res = ($trsrul_key6 * $trsrul22)/100;
    
    $oka = $trsrul_key6 - $res;
    
    $coin_ok = $trsrul_key66 - $oka;
    
    mysqli_query($conn,"UPDATE `users` SET `coin`='$coin_ok' WHERE id='$chat_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👨‍🔧 به دلیل ویژه بودن حساب شما سرویس با $trsrul22 درصد تخفیف با قیمت $oka برای شما محاسبه گردید",
'parse_mode'=>"HTML",
]);
}
else{
    
    $coin_ok = $trsrul_key66 - $trsrul_key6;
    
    mysqli_query($conn,"UPDATE `users` SET `coin`='$coin_ok' WHERE id='$chat_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👨‍🔧 مشتری گرامی به دلیل ویژه نبودن حساب شما مبلغ کامل سرویس از حساب شما کسر شد",
'parse_mode'=>"HTML",
]);
}
}else{
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌ مشکلی در روند خرید وجود دارد",
'parse_mode'=>"HTML",
]);
}


}


function addserves(){
    
    global $chat_id;
    global $conn;
    
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"👈 لطفا بخشی که میخواهید اضافه کنید را انتخاب کنید",
        'parse_mode'=>"HTML",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
        [
            ['text'=>"➕ اضافه کردن سرویس اصلی",'callback_data'=>"addCapitalServer"],
        ],
        [
            ['text'=>"➕ اضافه کردن سرویس فرعی",'callback_data'=>"AddsmartServer"],
        ],
        [
            ['text'=>"➖ حذف محصول اصلی",'callback_data'=>"kasrCapitalServer"],
        ],
        [
            ['text'=>"➖ حذف محصول فرعی",'callback_data'=>"kasrsmartserver"],
        ],
        ]
        ])
        ]);
}
function peimium(){
    
    global $chat_id;
    global $conn;
    global $reply_kb_options_back;
    
    mysqli_query($conn,"UPDATE `users` SET `step`='peimium' WHERE id='$chat_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👨‍🔧 ایدی عددی حساب و درصد تخفیف را مثل زیر وارد کنید
id,darsad",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);
}

function codeHed(){
    
    global $chat_id;
    global $conn;
    
    global $reply_kb_options_back;
    
    mysqli_query($conn,"UPDATE `users` SET `step`='codeHed' WHERE id='$chat_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🏷 لطفا کد هدیه را وارد کنید",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);
}

function addCodeH(){
    
    global $chat_id;
    global $conn;
    
    global $reply_kb_options_back;
    
    mysqli_query($conn,"UPDATE `users` SET `step`='addCodeH' WHERE id='$chat_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🏷 لطفا کد هدیه و مبلغ هدیه را به صورت زیر وارد کنید
code,coin",
'parse_mode'=>"HTML",
'reply_markup'=>json_encode($reply_kb_options_back),
]);
}

function creatAsadi($trafic,$ip,$port,$users,$pass,$trsrul_key66,$trsrul_key6,$trsrul_key11324,$trsrul_key113,$trsrul_key1132,$trsrul_key1112,$trsrul_key1113,$trsrul_key11135,$trsrul_key1115,$trsrul_key11136,$trsrul_key11134){
    
    global $chat_id;
    global $conn;
    global $chanSef;
    global $subDpmain;
    global $domainss;
    global $ip_vmess;
    global $user_vmess;
    global $port_vmess;
    global $pass_vmess;
    global $poerS_vmess;
    global $doman_vmess;
    global $public_vmess;
    global $privet_vmess;
    global $subDpmain2;
    global $domainss2;
    
$next = date('Y/m/d',strtotime("+$trsrul_key11324 day"));    

$daily = "$trsrul_key11324"; // مهلت اشتراک به روز
$sql43    = "SELECT * FROM vpn";
$result43 = mysqli_query($conn,$sql43);
$res43    = mysqli_num_rows($result43);

    $sql22    = "SELECT `darsad` FROM `vip` WHERE `id`=$chat_id";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['darsad'];

$name = $res43 + 1;
$name2 = $name + 1;
if($trsrul_key11134 == 443){


$link = json_decode(file_get_contents("https://galexynet.work/create2.php?step=client&name=$name&ports=$trsrul_key11134&traific=$trafic&date=$daily&ip=$ip&port=$port&username=$users&pass=$pass&domains=$trsrul_key11135&public=$trsrul_key1115&private=$trsrul_key11136"),true)["servers"];
$link2 = json_decode(file_get_contents("https://galexynet.work/create2.php?step=client&name=$name2&ports=$poerS_vmess&traific=$trafic&date=$daily&ip=$ip_vmess&port=$port_vmess&username=$user_vmess&pass=$pass_vmess&domains=$doman_vmess&public=$public_vmess&private=$privet_vmess"),true)["servers"];

$amir_end = str_replace("$domainss", "$subDpmain", "$link");
$text_admin = explode("//",$link2);
$end_decode = $text_admin['1'];
$amir_end2 = base64_decode($end_decode);
$amir_end3 = str_replace("$domainss2", "$subDpmain2", "$amir_end2");
$amir_end4 = base64_encode($amir_end3);
$amir_end5 = "vmess://" . $amir_end4;

if($link == true){

 bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ خرید شما با موفقیت انجام شد

🏷  : <code>$amir_end</code>

🏷  : <code>$amir_end5</code>

📅 تاریخ انقضا : $next

🙏 تشکر بابت اعتماد به ما",
'parse_mode'=>"HTML",
]);

bot('sendMessage',[
'chat_id'=>$chanSef,
'text'=>"✅ #خرید جدید انجام شد

👨‍🔧 : $chat_id

🏷 : $amir_end

🏷 : $amir_end5

📅 تاریخ انقضا : $next",
'parse_mode'=>"HTML",
]);
$sql2    = "INSERT INTO `vpn` (`ip`, `coin`, `key`, `hajm`, `id`, `time`) VALUES ('$ip', '$trsrul_key66', '$link', '$trafic', '$chat_id', '$next')";
$result2 = mysqli_query($conn,$sql2);

$sql23    = "INSERT INTO `vpn` (`ip`, `coin`, `key`, `hajm`, `id`, `time`) VALUES ('$ip', '$trsrul_key66', '$link2', '$trafic', '$chat_id', '$next')";
$result23 = mysqli_query($conn,$sql23);
if($trsrul22 != NULL){
    
    
    $res = ($trsrul_key6 * $trsrul22)/100;
    
    $oka = $trsrul_key6 - $res;
    
    $coin_ok = $trsrul_key66 - $oka;
    
    mysqli_query($conn,"UPDATE `users` SET `coin`='$coin_ok' WHERE id='$chat_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👨‍🔧 به دلیل ویژه بودن حساب شما سرویس با $trsrul22 درصد تخفیف با قیمت $oka برای شما محاسبه گردید",
'parse_mode'=>"HTML",
]);
}
else{
    
    $coin_ok = $trsrul_key66 - $trsrul_key6;
    
    mysqli_query($conn,"UPDATE `users` SET `coin`='$coin_ok' WHERE id='$chat_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👨‍🔧 مشتری گرامی به دلیل ویژه نبودن حساب شما مبلغ کامل سرویس از حساب شما کسر شد",
'parse_mode'=>"HTML",
]);
}}else{
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌ مشکلی در ساخت اشتراک 1 به وجود امده است",
'parse_mode'=>"HTML",
]);
}
}
if($trsrul_key11134 == 80){


$link = json_decode(file_get_contents("https://galexynet.work/create2.php?step=client&name=$name&ports=$trsrul_key11134&traific=$trafic&date=$daily&ip=$ip&port=$port&username=$users&pass=$pass&domains=$trsrul_key11135&public=$trsrul_key1115&private=$trsrul_key11136"),true)["servers"];
$link2 = json_decode(file_get_contents("https://galexynet.work/create2.php?step=client&name=$name2&ports=443&traific=$trafic&date=$daily&ip=$ip&port=$port&username=$users&pass=$pass&domains=$trsrul_key11135&public=$trsrul_key1115&private=$trsrul_key11136"),true)["servers"];
$amir_end = str_replace("$domainss", "$subDpmain", "$link2");
$text_admin = explode("//",$link);
$end_decode = $text_admin['1'];
$amir_end2 = base64_decode($end_decode);
$amir_end3 = str_replace("$domainss2", "$subDpmain2", "$amir_end2");
$amir_end4 = base64_encode($amir_end3);
$amir_end5 = "vmess://" . $amir_end4;           
if($link == true){

 bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ خرید شما با موفقیت انجام شد

🏷  : <code>$amir_end</code>

🏷 : <code>$amir_end5</code>

📅 تاریخ انقضا : $next

🙏 تشکر بابت اعتماد به ما",
'parse_mode'=>"HTML",
]);

bot('sendMessage',[
'chat_id'=>$chanSef,
'text'=>"✅ #خرید جدید انجام شد

👨‍🔧 : $chat_id

🏷 : $amir_end

🏷 : $amir_end5

📅 تاریخ انقضا : $next",
'parse_mode'=>"HTML",
]);
$sql2    = "INSERT INTO `vpn` (`ip`, `coin`, `key`, `hajm`, `id`, `time`) VALUES ('$ip', '$trsrul_key66', '$link', '$trafic', '$chat_id', '$next')";
$result2 = mysqli_query($conn,$sql2);

$sql23    = "INSERT INTO `vpn` (`ip`, `coin`, `key`, `hajm`, `id`, `time`) VALUES ('$ip', '$trsrul_key66', '$link2', '$trafic', '$chat_id', '$next')";
$result23 = mysqli_query($conn,$sql23);
if($trsrul22 != NULL){
    
    
    $res = ($trsrul_key6 * $trsrul22)/100;
    
    $oka = $trsrul_key6 - $res;
    
    $coin_ok = $trsrul_key66 - $oka;
    
    mysqli_query($conn,"UPDATE `users` SET `coin`='$coin_ok' WHERE id='$chat_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👨‍🔧 به دلیل ویژه بودن حساب شما سرویس با $trsrul22 درصد تخفیف با قیمت $oka برای شما محاسبه گردید",
'parse_mode'=>"HTML",
]);
}
else{
    
    $coin_ok = $trsrul_key66 - $trsrul_key6;
    
    mysqli_query($conn,"UPDATE `users` SET `coin`='$coin_ok' WHERE id='$chat_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👨‍🔧 مشتری گرامی به دلیل ویژه نبودن حساب شما مبلغ کامل سرویس از حساب شما کسر شد",
'parse_mode'=>"HTML",
]);
}}
}



}

function accountTest(){
    
    global $chat_id;
    global $conn;
    global $ip_test;
    global $port_test;
    global $user_test;
    global $pass_test;
    global $port_sazh;
    global $doman_test;
    global $public_test;
    global $privet_test;
    global $domainss3;
    global $subDpmain3;
    global $vpnname;
    
    $sql43    = "SELECT * FROM `test` WHERE `id`=$chat_id";
$result43 = mysqli_query($conn,$sql43);
$res43    = mysqli_num_rows($result43);

if($res43 != 1){
    
    $next = date('Y/m/d',strtotime("+1 day"));    
    
    $link = json_decode(file_get_contents("https://galexynet.work/create2.php?step=client&name=$chat_id&ports=$port_sazh&traific=1&date=1&ip=$ip_test&port=$port_test&username=$user_test&pass=$pass_test&domains=$doman_test&public=$public_test&private=$privet_test"),true)["servers"];


$text_admin = explode("//",$link);
$end_decode = $text_admin['1'];
$amir_end2 = base64_decode($end_decode);
$amir_end3 = str_replace("$domainss3", "$subDpmain3", "$amir_end2");
$amir_end4 = base64_encode($amir_end3);
$amir_end5 = "vmess://" . $amir_end4;          
if($link == true){

 bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ اکانت تست شما با موفقیت ساخته شد

🏷  : <code>$amir_end5</code>

📅 تاریخ انقضا : $next

اکانت تست با حجم محدود و ۱ روزه می باشد ، جهت تهیه اکانت ابتدا حساب خود را شارژ نموده سپس اقدام به خرید پلن اشتراکی مورد نظر خود نمایید ، با تشکر $vpnname 🙏",
'parse_mode'=>"HTML",
]);

$sql2    = "INSERT INTO `test` (`key`, `id`) VALUES ('$link', $chat_id)";
$result2 = mysqli_query($conn,$sql2);

bot('sendMessage',[
'chat_id'=>$chanSef,
'text'=>"✅  #سرویس_تستی

👨‍🔧 : $chat_id

 : $amir_end

🏷 : $amir_end5

📅 تاریخ انقضا : $next",
'parse_mode'=>"HTML",
]);
}
    else{
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌ مشکلی در ساخت به وجود امده",
'parse_mode'=>"HTML",
]);
    }
    
}
else{
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌ شما قبلا از اکانت رایگان استفاده کردید",
'parse_mode'=>"HTML",
]);
}
}

function creatVpn2($trafic,$ip,$port,$users,$pass,$trsrul_key66,$trsrul_key6,$trsrul_key11324,$text,$coin_pay_off){
    
    global $chat_id;
    global $conn;
    global $chanSef;
    
$next = date('Y/m/d',strtotime("+$trsrul_key11324 day"));    

$daily = "$trsrul_key11324"; // مهلت اشتراک به روز
$sql43    = "SELECT * FROM vpn";
$result43 = mysqli_query($conn,$sql43);
$res43    = mysqli_num_rows($result43);

    $sql22    = "SELECT `darsad` FROM `vip` WHERE `id`=$chat_id";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['darsad'];

$name = $res43 + 1;

$result = 0;

for ( $i=1; $i <=$text; $i++ ){
   $link = json_decode(file_get_contents("https://galexynet.work/create.php?step=buy&name=$name&traific=$trafic&date=$daily&ip=$ip&port=$port&username=$users&pass=$pass"),true)["server"];

            
if($link == true){

 bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ خرید شما با موفقیت انجام شد

🏷  : <code>$link</code>

📅 تاریخ انقضا : $next

🙏 تشکر بابت اعتماد به ما",
'parse_mode'=>"HTML",
]);

bot('sendMessage',[
'chat_id'=>$chanSef,
'text'=>"✅ #خرید جدید انجام شد

👨‍🔧 : $chat_id

 : $amir_end

🏷 : $amir_end5

📅 تاریخ انقضا : $next",
'parse_mode'=>"HTML",
]);
$sql2    = "INSERT INTO `vpn` (`ip`, `coin`, `key`, `hajm`, `id`, `time`) VALUES ('$ip', '$trsrul_key66', '$link', '$trafic', '$chat_id', '$next')";
$result2 = mysqli_query($conn,$sql2);
if($trsrul22 != NULL){
    
    
    $res = ($coin_pay_off * $trsrul22)/100;
    
    $oka = $coin_pay_off - $res;
    
    $coin_ok = $trsrul_key66 - $oka;
    
    mysqli_query($conn,"UPDATE `users` SET `coin`='$coin_ok' WHERE id='$chat_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👨‍🔧 به دلیل ویژه بودن حساب شما سرویس با $trsrul22 درصد تخفیف با قیمت $oka برای شما محاسبه گردید",
'parse_mode'=>"HTML",
]);
}
else{
    
    $coin_ok = $trsrul_key66 - $coin_pay_off;
    
    mysqli_query($conn,"UPDATE `users` SET `coin`='$coin_ok' WHERE id='$chat_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👨‍🔧 مشتری گرامی به دلیل ویژه نبودن حساب شما مبلغ کامل سرویس از حساب شما کسر شد",
'parse_mode'=>"HTML",
]);
}
}else{
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌ مشکلی در روند خرید وجود دارد",
'parse_mode'=>"HTML",
]);
}
}


}
function creatAsadi2($trafic,$ip,$port,$users,$pass,$trsrul_key66,$trsrul_key6,$trsrul_key11324,$trsrul_key113,$trsrul_key1132,$trsrul_key1112,$trsrul_key1113,$trsrul_key11135,$trsrul_key1115,$trsrul_key11136,$trsrul_key11134,$text,$coin_pay_off){
    
    global $chat_id;
    global $conn;
    global $chanSef;
    global $subDpmain;
    global $domainss;
    global $ip_vmess;
    global $user_vmess;
    global $port_vmess;
    global $pass_vmess;
    global $poerS_vmess;
    global $doman_vmess;
    global $public_vmess;
    global $privet_vmess;
    global $subDpmain2;
    global $domainss2;
    
$next = date('Y/m/d',strtotime("+$trsrul_key11324 day"));    

$daily = "$trsrul_key11324"; // مهلت اشتراک به روز
$sql43    = "SELECT * FROM vpn";
$result43 = mysqli_query($conn,$sql43);
$res43    = mysqli_num_rows($result43);

    $sql22    = "SELECT `darsad` FROM `vip` WHERE `id`=$chat_id";
    $result22 = mysqli_query($conn,$sql22);
    $res22 = mysqli_fetch_assoc($result22);
    $trsrul22  = $res22['darsad'];

$name = $res43 + 1;
$name2 = $name + 1;
if($trsrul_key11134 == 443){


$result = 0;

for ( $i=1; $i <=$text; $i++ ){
    $link = json_decode(file_get_contents("https://galexynet.work/create2.php?step=client&name=$name&ports=$trsrul_key11134&traific=$trafic&date=$daily&ip=$ip&port=$port&username=$users&pass=$pass&domains=$trsrul_key11135&public=$trsrul_key1115&private=$trsrul_key11136"),true)["servers"];
$link2 = json_decode(file_get_contents("https://galexynet.work/create2.php?step=client&name=$name2&ports=$poerS_vmess&traific=$trafic&date=$daily&ip=$ip_vmess&port=$port_vmess&username=$user_vmess&pass=$pass_vmess&domains=$doman_vmess&public=$public_vmess&private=$privet_vmess"),true)["servers"];

$amir_end = str_replace("$domainss", "$subDpmain", "$link");
$text_admin = explode("//",$link2);
$end_decode = $text_admin['1'];
$amir_end2 = base64_decode($end_decode);
$amir_end3 = str_replace("$domainss2", "$subDpmain2", "$amir_end2");
$amir_end4 = base64_encode($amir_end3);
$amir_end5 = "vmess://" . $amir_end4;

if($link == true){

 bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ خرید شما با موفقیت انجام شد

🏷  : <code>$amir_end</code>

🏷  : <code>$amir_end5</code>

📅 تاریخ انقضا : $next

🙏 تشکر بابت اعتماد به ما",
'parse_mode'=>"HTML",
]);

bot('sendMessage',[
'chat_id'=>$chanSef,
'text'=>"✅ #خرید جدید انجام شد

👨‍🔧 : $chat_id
🏷 : $amir_end

🏷 : $amir_end5
📅 تاریخ انقضا : $next",
'parse_mode'=>"HTML",
]);
$sql2    = "INSERT INTO `vpn` (`ip`, `coin`, `key`, `hajm`, `id`, `time`) VALUES ('$ip', '$trsrul_key66', '$link', '$trafic', '$chat_id', '$next')";
$result2 = mysqli_query($conn,$sql2);

$sql23    = "INSERT INTO `vpn` (`ip`, `coin`, `key`, `hajm`, `id`, `time`) VALUES ('$ip', '$trsrul_key66', '$link2', '$trafic', '$chat_id', '$next')";
$result23 = mysqli_query($conn,$sql23);
}else{
        bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌ مشکلی در ساخت اشتراک 1 به وجود امده است",
'parse_mode'=>"HTML",
]);
}
}
if($trsrul22 != NULL){
    
    
    $res = ($coin_pay_off * $trsrul22)/100;
    
    $oka = $coin_pay_off - $res;
    
    $coin_ok = $trsrul_key66 - $oka;
    
    mysqli_query($conn,"UPDATE `users` SET `coin`='$coin_ok' WHERE id='$chat_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👨‍🔧 به دلیل ویژه بودن حساب شما سرویس با $trsrul22 درصد تخفیف با قیمت $oka برای شما محاسبه گردید",
'parse_mode'=>"HTML",
]);
}
else{
    
    $coin_ok = $trsrul_key66 - $coin_pay_off;
    
    mysqli_query($conn,"UPDATE `users` SET `coin`='$coin_ok' WHERE id='$chat_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👨‍🔧 مشتری گرامی به دلیل ویژه نبودن حساب شما مبلغ کامل سرویس از حساب شما کسر شد",
'parse_mode'=>"HTML",
]);
}
}
if($trsrul_key11134 == 80){

$result = 0;

for ( $i=1; $i <=$text; $i++ ){
$link = json_decode(file_get_contents("https://galexynet.work/create2.php?step=client&name=$name&ports=$trsrul_key11134&traific=$trafic&date=$daily&ip=$ip&port=$port&username=$users&pass=$pass&domains=$trsrul_key11135&public=$trsrul_key1115&private=$trsrul_key11136"),true)["servers"];
$link2 = json_decode(file_get_contents("https://galexynet.work/create2.php?step=client&name=$name2&ports=443&traific=$trafic&date=$daily&ip=$ip&port=$port&username=$users&pass=$pass&domains=$trsrul_key11135&public=$trsrul_key1115&private=$trsrul_key11136"),true)["servers"];
$amir_end = str_replace("$domainss", "$subDpmain", "$link2");
$text_admin = explode("//",$link);
$end_decode = $text_admin['1'];
$amir_end2 = base64_decode($end_decode);
$amir_end3 = str_replace("$domainss2", "$subDpmain2", "$amir_end2");
$amir_end4 = base64_encode($amir_end3);
$amir_end5 = "vmess://" . $amir_end4;           
if($link == true){

 bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ خرید شما با موفقیت انجام شد

🏷  : <code>$amir_end</code>

🏷 : <code>$amir_end5</code>

📅 تاریخ انقضا : $next

🙏 تشکر بابت اعتماد به ما",
'parse_mode'=>"HTML",
]);

bot('sendMessage',[
'chat_id'=>$chanSef,
'text'=>"✅ #خرید جدید انجام شد

👨‍🔧 : $chat_id
🏷 : $amir_end

🏷 : $amir_end5
📅 تاریخ انقضا : $next",
'parse_mode'=>"HTML",
]);
$sql2    = "INSERT INTO `vpn` (`ip`, `coin`, `key`, `hajm`, `id`, `time`) VALUES ('$ip', '$trsrul_key66', '$link', '$trafic', '$chat_id', '$next')";
$result2 = mysqli_query($conn,$sql2);

$sql23    = "INSERT INTO `vpn` (`ip`, `coin`, `key`, `hajm`, `id`, `time`) VALUES ('$ip', '$trsrul_key66', '$link2', '$trafic', '$chat_id', '$next')";
$result23 = mysqli_query($conn,$sql23);
}

}
if($trsrul22 != NULL){
    
    
    $res = ($coin_pay_off * $trsrul22)/100;
    
    $oka = $coin_pay_off - $res;
    
    $coin_ok = $trsrul_key66 - $oka;
    
    mysqli_query($conn,"UPDATE `users` SET `coin`='$coin_ok' WHERE id='$chat_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👨‍🔧 به دلیل ویژه بودن حساب شما سرویس با $trsrul22 درصد تخفیف با قیمت $oka برای شما محاسبه گردید",
'parse_mode'=>"HTML",
]);
}
else{
    
    $coin_ok = $trsrul_key66 - $coin_pay_off;
    
    mysqli_query($conn,"UPDATE `users` SET `coin`='$coin_ok' WHERE id='$chat_id' LIMIT 1");
    
    bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"👨‍🔧 مشتری گرامی به دلیل ویژه نبودن حساب شما مبلغ کامل سرویس از حساب شما کسر شد",
'parse_mode'=>"HTML",
]);
}
}
}
?>