<?php

//-------------------------
// Dev : @DevMrAmir
// Channel : @AlaCode
//-------------------------

//------- Sql DataBase -------
$serverName = "localhost"; // ادیت نشود
$db_name    = "0"; // نام دیتابیس
$db_user    = "0"; // یوزر دیتابیس
$db_pass    = ""; // پسورد دیتابیس

$conn = mysqli_connect($serverName, $db_user, $db_pass, $db_name);

if(!$conn){

    die('failed ' . mysqli_connect_error());
}
//------- Data -------
$token        = "0"; // توکن ربات
$admin        = "0"; // عددی ادمین
$vpnname      = "الا وی پی ان"; // اسم شرکت
$bot_id       = "AlaVpnBot"; //ایدی ربات
$tronW        = "تست"; // کیف پول ترون
$cart         = "تست"; // شماره کارت
$chanSef      = "0";
$MerchantID   = "0"; // مرچند زرین پال
$web          = "https://site.xyz/vpnPro"; // ادرس پوشه ربات
$domainss     = "@w0l4i.ir";
$subDpmain    = "@dl.w0l4i.ir";
// --- سرور برای اکانت تست
$ip_test      = "0"; // ایپی پنل
$port_test    = "0"; // پورت سرور
$user_test    = "0"; // یوزر نیم
$pass_test    = "0"; // ادرس فایل کوکی
$port_sazh    = 80; // پورتی که بسازه
$doman_test   = "0"; // دامنه
$public_test  = "0";
$privet_test  = "0";
// Vmess
$ip_vmess     = "0";
$user_vmess   = "0";
$port_vmess   = "0";
$pass_vmess   = "0";
$poerS_vmess  = "0";
$doman_vmess  = "0";
$public_vmess = "0";
$privet_vmess = "0";

// -------
$domainss2     = "0";
$subDpmain2    = "0";
// -------
$domainss3     = "0";
$subDpmain3    = "0";

$sql2    = "SELECT `chanel` FROM `Settings`";
$result2 = mysqli_query($conn,$sql2);
$res2 = mysqli_fetch_assoc($result2);
$channel_bot  = $res2['chanel'];
//------- Function -------
    
    function bot($method, $user = []){
        global $token;
    $url = "https://api.telegram.org/bot$token"."/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $user);
    $res = curl_exec($ch);
    if (curl_error($ch)) {
        var_dump(curl_error($ch));
    } else {
        return json_decode($res);
    }
}

?>