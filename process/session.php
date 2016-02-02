<?php
/**
 * Created by PhpStorm.
 * User: ensemble lab
 * Date: 2016-02-02
 * Time: 오후 3:23
 */

require("config/config.php"); //include 되는 곳에서 상대주소 조심
require("lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

session_start();

//현재 세션에 저장된 정보가 있는지 확인한다.

if(!isset($_SESSION['user_key'])){
    header("location:../index.php");
}
else{
    header("location:../mymakebuy.html");
}

exit();

?>