<?php
session_start();
//로그인이 되어있는 경우
if(isset($_SESSION['user_key'])){
    header("Location: http://localhost/mymakebuy.php");
    exit();
}
//회원가입을 시도하는 경우
else if(isset($_POST['email'])){

}
//주소창으로 접근하는경우
else{
    header("Location: http://localhost/503.html");
    exit();
}

require("../config/config.php");
require("../lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

//leave it for checking image size
/*
if ( getimagesize($_FILES['image']['tmp_name']) == FALSE) {
    echo "Please select an image";
} else {
    $image = addslashes($_FILES['image']['tmp_name']);
    // $name = addslashes($_FILES['image']['name']);
    $image = file_get_contents($image);
    $image = base64_encode($image);
}
*/

$image = addslashes($_FILES['image']['tmp_name']);
$image = file_get_contents($image);
$image = base64_encode($image);

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$pwd_confirm = mysqli_real_escape_string($conn, $_POST['pwd-confirm']);
$name = mysqli_real_escape_string($conn, $_POST['name']);

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
if ($result->num_rows > 0) {
    $sql = "INSERT INTO user_tb (user_email, user_pwd, user_name, user_phone, user_im, user_type, user_login, user_token) VALUES ('" . $email . "', '" . $password . "', '" . $name . "', '" . $phone . "', '" . $image . "', '" . $user_type . "', '" . $user_login . "', '" . $token . "')";
    $result= mysqli_query($conn, $sql);

    //가입된 유저의 토큰을 세션에 저장한다
    $sql = "SELECT userKey from user_tb WHERE user_email='".$email."'";
    $result = mysqli_query($conn, $sql);
    session_start();
    $row = mysqli_fetch_row($result);
    $_SESSION['user_key'] = $row[0];

    echo "<script>
            alert('회원가입에 성공하셨습니다');
            location.href='../mymakebuy.php';
            </script>";

} else {
    echo "<script>
                alert('중복된 아이디입니다');
                location.href='../signup.php';
           </script>";

}

mysqli_close($conn);
?>