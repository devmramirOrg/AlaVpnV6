<?php

//-------------------------
// Dev     : @DevMrAmir
// Channel : @AlaCode
//-------------------------

// ------- Sql Code -------
include("config.php");

mysqli_multi_query(
    $conn,
    "CREATE TABLE `users` (
        `id` bigint PRIMARY KEY,
        `step` varchar(20),
        `ref` bigint(20),
        `coin` bigint,
        `phone` bigint,
        `account` text
        ) default charset = utf8mb4;
        CREATE TABLE `Originalproduct` (
        `name` text ,
        `Description` text,
        `ip` text,
        `protocol` text,
        `network` text
        ) default charset = utf8mb4;
        CREATE TABLE `Bought` (
        `id` bigint PRIMARY KEY,
        `code` text,
        `contry` text,
        `Owner` bigint,
        `date` text
        ) default charset = utf8mb4;
        CREATE TABLE `admin` (
        `id` bigint PRIMARY KEY
        ) default charset = utf8mb4;
        CREATE TABLE `moton` (
        `tarfe` text,
        `android` text,
        `windows` text,
        `ios` text,
        `mac` text,
        `linux` text,
        `help` text,
        `shop` text
        ) default charset = utf8mb4;
        CREATE TABLE `Settings` (
        `bot` text,
        `pay` text,
        `sharj` text,
        `support` text,
        `chanel` text,
        `zarinpal` text,
        `idpay` text,
        `nextpay` text,
        `cart` text,
        `tron` text
        ) default charset = utf8mb4;
        CREATE TABLE `panel` (
        `ip` text,
        `port`text,
        `username` text,
        `password` text
        ) default charset = utf8mb4;
        CREATE TABLE `Byproduct` (
        `ip` text,
        `coin`int,
        `name` text,
        `Description` text,
        `hajm` int,
        `time` text,
        `protocol` text,
        `network` text,
        `momName` text,
        `pronCli` text,
        `domains` text,
        `publicCl` text,
        `private` text
        ) default charset = utf8mb4;
        CREATE TABLE `vpn` (
        `ip` text,
        `coin`text,
        `key` text,
        `hajm` text,
        `id` text,
        `time` text
        ) default charset = utf8mb4;
        CREATE TABLE `vip` (
        `id` bigint,
        `darsad` bigint 
        ) default charset = utf8mb4;
        CREATE TABLE `codeH` (
        `code` text,
        `coin` bigint 
        ) default charset = utf8mb4;
        CREATE TABLE `test` (
        `key` text,
        `id` bigint 
        ) default charset = utf8mb4;");
    if(mysqli_connect_errno()){
    echo "به دلیل مشکل زیر، اتصال برقرار نشد : <br />" . mysqli_connect_error();
    die();
}else{
echo "دیتابیس متصل و نصب شد .";

            
            
            
            
            
}

?>