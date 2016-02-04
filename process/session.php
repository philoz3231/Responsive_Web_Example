<?php
/**
 * Created by PhpStorm.
 * User: ensemble lab
 * Date: 2016-02-02
 * Time: 오후 3:23
 * Because of redirection problem, don't be used now
 */

session_start();


//현재 세션에 저장된 정보가 있는지 확인한다.

if(isset($_SESSION['user_key'])) {
    header("Location: http://localhost/mymakebuy.php");
}
else{
    $_SESSION['session_check'] = 'checked';
    header("Location:http://localhost/index.php");
}
exit();

?>