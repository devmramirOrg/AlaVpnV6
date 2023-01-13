<?php

date_default_timezone_set('Asia/Tehran');
$date = date('Y/m/d');
include("config.php");

$sql    = "SELECT * FROM `vpn` WHERE `time`=$date";
$result = mysqli_query($conn,$sql);
 
 while($row = mysqli_fetch_assoc($result)){
        
    $hajm = $row['jajm'];
    $id       = $row['id'];
    $code     = $row['key'];
    $coin   = $row['coin'];
    $date_off = $row['time'];

    if($date_off == $date){
        
bot('sendMessage',[
'chat_id'=>$admin,
'text'=>"🔁 تمدید یک سرویس امده است

👤 مالک سرویس : $id
🔑 کلید : $code
📲 حجم : $hajm
💴 مبلغ : $coin",
'parse_mode'=>"HTML",
]);

bot('sendMessage',[
'chat_id'=>$id,
'text'=>"❌ تمدید سرویستون رسیده

🔑 کلید : $code
📱 حجم : $hajm
💴 مبلغ : $coin

❤️ برید قسمت شارژ حساب مبلغ را واریز کنید و زیر رسید توضیحات که برای تمدید سرویس هست را ارسال کنید",
'parse_mode'=>"HTML",
]);
        
    }
}

?>