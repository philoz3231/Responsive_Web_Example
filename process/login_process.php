<?php

require("../config/config.php");
require("../lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

//토큰 생성
$salt1 = "mb@";
$salt2 = "gh**";
$token = md5("$salt1$password$salt2");



$sql = "SELECT userKey FROM user_tb WHERE user_email='$email' and user_token= '$token'";
$result = mysqli_query($conn, $sql);

//로그인 정보가 맞는지 확인한다.
if ($result->num_rows > 0) {

    //로그인된 유저의 키를 세션에 저장한다
    session_start();
    $row = mysqli_fetch_row($result);
    $_SESSION['user_key'] = $row[0];

    echo "<script>
            alert('로그인에 성공하셨습니다');
            location.href='../mymakebuy.html';
            </script>";

} else {
    echo "<script>
                alert('아이디나 비밀번호를 잘못 입력했습니다');
                location.href='../login.php';
           </script>";

}

?>