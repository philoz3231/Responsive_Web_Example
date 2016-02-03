<?php
/**
 * Created by PhpStorm.
 * User: Junho
 * Date: 2016-02-02
 * Time: 오전 12:48
 */


require("../config/config.php");
require("../lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

$email = mysqli_real_escape_string($conn, $_POST['email']);
$sql = "SELECT user_email FROM user_tb WHERE user_email='" . $email . "'";
$result = mysqli_query($conn, $sql);

//같은 아이디의 유저가 있는 지 확인한다.
if ($result->num_rows == 0) {
    echo
    "<script>
        alert('사용 가능한 아이디입니다.');
        //email field 채워넣기 필요
       location.href='../signup.php';
        </script>";
} else {
    echo
    "<script>
        alert('이미 사용 중인 아이디입니다.');
        location.href='../signup.php';
    </script>";
    exit;
}

