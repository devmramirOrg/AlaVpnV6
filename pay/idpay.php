<?php

//-------------------------
// Dev : @DevMrAmir
// Channel : @AlaCode
//-------------------------


// ------- Include -------
include '../config.php';

// ------- Get -------

$user = $_GET['order_id'];
$amount = $_GET['amount'];

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
define("APIKEY","ba1721d2-79ee"); // merchand*
define("Domin","netmeli.telegramrobot.xyz/VpnPro/pay"); // Address callback*
if(isset($_GET['get']) and isset($_GET['amount']) and isset($_GET['order_id'])){
    $amount = $_GET['amount'];
    $order_id = $_GET['order_id'];
    $params = array(
        'order_id' => $order_id,
        'amount' => $amount,
        'name' => 'قاسم رادمان', // Name*
        'phone' => '09382198592', // Phone*
        'mail' => 'my@site.com', // Email*
        'desc' => 'توضیحات پرداخت کننده', // Description*
        'callback' => "https://".Domin."/idpay.php?back",
      );
      
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment');
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'X-API-KEY: ' . APIKEY,
      ));
      
      $result = curl_exec($ch);
      $err = curl_error($ch);
      $result = json_decode($result);
      curl_close($ch);
    if ($result->link !== null) {
        redirect($result->link); 
    } else {
        if ($result->error_message || $result->error_code) {
            echo "<h1 style=\"text-align: center;margin-top:30px\">خطایی رخ داده است ...</h1>";
            echo "\n <h1 style=\"text-align: center;margin-top:30px\">error code : $result->error_code</h1>";
            echo "\n <h1 style=\"text-align: center;margin-top:30px\">message error : $result->error_message</h1>";
        } else{
            echo "<h1 style=\"text-align: center;margin-top:30px\">درخواست نامعتبر است</h1>";
        }
    }
} else {
    if (isset($_GET['back'])) {

        $status = $_POST['status']; // وضعیت تراکنش
        $track_id = $_POST['track_id']; // کد رهگیری آیدی پی
        $id = $_POST['id']; // کلید منحصر بفرد تراکنش که در مرحله ایجاد تراکنش دریافت شده است
        $order_id = $_POST['order_id']; // شماره سفارش پذیرنده که در مرحله ایجاد تراکنش ارسال شده است
        $amount = $_POST['amount']; // مبلغ ثبت شده هنگام ایجاد تراکنش

        $params = array(
            'id' => $id,
            'order_id' => $order_id,
          );
          
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment/verify');
          curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'X-API-KEY: ' . APIKEY,
          ));
          
          $result = curl_exec($ch);
          $err = curl_error($ch);
          $result = json_decode($result);
          curl_close($ch);

        if ($status != NULL) {
            if ($status == "100") {
                echo "<h1 style=\"text-align: center;margin-top:30px\">پرداخت شما با موفقیت انجام شد !</h1>";
                
                $sql    = "SELECT `coin` FROM `users` WHERE `id`=$user";
$result2 = mysqli_query($conn,$sql);

$res = implode(mysqli_fetch_assoc($result2));
        
$ok = $res + $amount;

$sql_new = "UPDATE `users` SET coin=$ok WHERE id=$user";
mysqli_query($conn,$sql_new);

bot('sendMessage',[
                        'chat_id'=>$user,
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

    } else {
        
    bot('sendMessage',[
                        'chat_id'=>$user,
                        'text'=>"❌ پرداخت شما انجام نشد",
                        'parse_mode'=>"HTML",
                        ]);
    
            }
            if ($status == "1") {
                echo "<h1 style=\"text-align: center;margin-top:30px\">پرداخت توسط کاربر لغو شد !</h1>";
            }
            if ($status == "2") {
                echo "<h1 style=\"text-align: center;margin-top:30px\">پرداخت ناموفق بوده است</h1>";
            }
            if ($status == "3") {
                echo "<h1 style=\"text-align: center;margin-top:30px\">خطا رخ داده است</h1>";
            }
        } else {
            echo "<h1 style=\"text-align: center;margin-top:30px\">خطا رخ داده است</h1>";
        }
    } else {
        echo "<h1 style=\"text-align: center;margin-top:30px\">خطا رخ داده است</h1>";
    }
}
