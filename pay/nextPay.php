<?php
//-------------------------
// Dev : @DevMrAmir
// Channel : @AlaCode
//-------------------------
//-------
include '../config.php';
//-------
function redirect($url)
{
    if (!headers_sent()){
        header("Location: $url");
    }else{
        echo "<script type='text/javascript'>window.location.href='$url'</script>";
        echo "<noscript><meta http-equiv='refresh' content='0;url=$url'/></noscript>";
    }
    exit;
}

       if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}


define("Domin","amirhosin.gigapanel.xyz/vpnPro/pay"); // domin
define("nextpay", "09b8af11-a552"); // merchant code*


$phone_number = file_get_contents("phone/$from_id.txt");
$desc = 'پرداخت جهت خرید هاست و هرگونه فعالیت غیر مجاز مثل فیشینگ و کلاهبرداری عواقب ان به عهده بنده یعنی خریدار است';
$amount = $_GET["amount"];
if(!preg_match("/^(-){0,1}([0-9]+)(,[0-9][0-9][0-9])*([.][0-9]){0,1}([0-9]*)$/",$amount)){
echo "مبلغ نامعتبر است !";
exit;
}
    
if (isset($_GET["order_id"]) && isset($_GET["amount"]) && isset($_GET["get"])) {
 $order_id = $_GET["order_id"];
 $amount = $_GET["amount"];
 $url = "https://nextpay.org/nx/gateway/token";
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => "api_key=" . nextpay . "&amount=" . $amount . "&payer_desc=" . $desc . "&currency=IRT&order_id=" . $order_id . "&callback_uri=https://" . Domin . "/nextPay.php?back",
    ));
    $result = curl_exec($curl);
    $result = json_decode($result);
    curl_close($curl);

    $trans_id = $result->trans_id;
 if ($result->code !== null){
  if ($result->code == "-1") {
            redirect("https://nextpay.org/nx/gateway/payment/$trans_id"); 
  } else {
   echo "مشکلی به وجود اومده ! \n";
  }
 } else {
  echo "<h1 style=\"text-align: center;margin-top:30px\">درخواست نامعتبر است</h1>";
 }
} else {
 if (isset($_GET["back"])) {
        $order_id = $_GET["order_id"];
        $trans_id = $_GET["trans_id"];
        $amount = $_GET["amount"];
        $status = $_GET["np_status"];

        if ($status == "OK") {
            $url = "https://nextpay.org/nx/gateway/verify";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'api_key=' . nextpay . '&amount=' . $amount . '&trans_id=' . $trans_id,
            ));
            $result = curl_exec($curl);
            $result = json_decode($result);
           $order_id1 = $result->order_id;
            curl_close($curl);
            if ($result->code == '0') {

if($order_id1 != $order_id){
    echo 'no bug';
    exit;
}

$sql    = "SELECT `coin` FROM `users` WHERE `id`=$order_id";
$result2 = mysqli_query($conn,$sql);

$res = implode(mysqli_fetch_assoc($result2));
        
$ok = $res + $amount;

$sql_new = "UPDATE `users` SET coin=$ok WHERE id=$order_id";
mysqli_query($conn,$sql_new);

bot('sendMessage',[
                        'chat_id'=>$order_id,
                        'text'=>"✅ پرداخت شما با موفقیت انجام شد و موجودی شما اضافه شد",
                        'parse_mode'=>"HTML",
                        'reply_markup'=>json_encode([
                        'inline_keyboard'=>[
                        [
                            [ 'text' => "💳 مبلغ پرداختی"   , 'callback_data' => "DevMrAmir" ] ,
                            [ 'text' => "$amount"   , 'callback_data' => "DevMrAmir" ]
                        ],
                        ]
                        ])
                        ]);
                        
bot('sendMessage',[
                        'chat_id'=>$chanSef,
                        'text'=>"✅ پرداخت جدید در ربات انجام شد",
                        'parse_mode'=>"HTML",
                        'reply_markup'=>json_encode([
                        'inline_keyboard'=>[
                        [
                            [ 'text' => "💳 مبلغ پرداختی"   , 'callback_data' => "DevMrAmir" ] ,
                            [ 'text' => "$amount"   , 'callback_data' => "DevMrAmir" ]
                        ],
                        [
                            [ 'text' => "👤 شناسه کاربر"   , 'callback_data' => "DevMrAmir" ] ,
                            [ 'text' => "$user"   , 'callback_data' => "DevMrAmir" ]
                        ],
                        ]
                        ])
                        ]);


                         echo "<h1 style=\"text-align: center\">🔥 پرداخت شما با موفقیت تایید شد به ربات برگردید 🔥</h1>";
                unlink("ListCode/$order_id1.txt");
            }
                else {
                echo "<h1 style=\"text-align: center\">❌ از فیشینگ شما استفاده کردید کارتی که احراز شده با کارت پرداختی یکی نیست ❌</h1>";
            }
        } else {
            echo "<h1 style=\"text-align: center\">❌ تراکنش توسط شما لغو شد ❌ </h1>";
            unlink("ListCode/$order_id.txt");
        }
    } else {
        echo "<h1 style=\"text-align: center\">درخواست نامعتبر است</h1>";
    }
}