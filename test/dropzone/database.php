<?php
$hostname = 'localhost'; 
$username = 'user'; 
$password = '';
$db_name  = 'test';

try{
    $db = new PDO("mysql:host=".$hostname.";
                dbname=".$db_name, $username, $password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                //PDO::MYSQL_ATTR_INIT_COMMAND 設定編碼
} 
catch(PDOException $e){
    //error message
    echo $e->getMessage();
    exit;
}
?>