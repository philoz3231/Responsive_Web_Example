<?php

require("config/config.php");
require("lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$pwd_confirm = mysqli_real_escape_string($conn, $_POST['pwd-confirm']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$image = "testuserImage";
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$user_type = mysqli_real_escape_string($conn, $_POST['user-type']);
$user_login = "normal";

//토큰 생성
$salt1 = "mb@";
$salt2 = "gh**";
$token = md5("$salt1$password$salt2");



$sql = "SELECT user_email FROM user_tb WHERE user_email='" . $email . "'";
$result = mysqli_query($conn, $sql);

//같은 아이디의 유저가 있는 지 확인한다.
if ($result->num_rows == 0) {
    $sql = "INSERT INTO user_tb (user_email, user_pwd, user_name, user_phone, user_im, user_type, user_login, user_token) VALUES ('" . $email . "', '" . $password . "', '" . $name . "', '" . $phone . "', '" . $image . "', '" . $user_type . "', '" . $user_login . "', '" . $token . "')";
    $result= mysqli_query($conn, $sql);

    //가입된 유저의 토큰을 세션에 저장한다
    $sql = "SELECT user_token from user_tb WHERE user_email='".$email."'";
    $result = mysqli_query($conn, $sql);

    session_start();
    $row = mysqli_fetch_row($result);
    $_SESSION['token'] = $row[0];

    echo "$row[0] hi";
    //header('Location: http://localhost');

} else {
    echo "중복된 아이디입니다";
   // header('Location: http://localhost');
}


?>