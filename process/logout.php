<?php
/**
 * Created by PhpStorm.
 * User: Junho
 * Date: 2016-02-02
 * Time: 오후 3:30
 */

session_start();

//현재 세션에 저장된 정보가 있는지 확인한다.

if(!session_destroy()){
    header("location:../login.php");
}
?>