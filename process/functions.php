<?php
/**
 * Created by PhpStorm.
 * User: Junho
 * Date: 2016-02-03
 * Time: 오후 6:13
 */



require("config/config.php");
require("lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);


// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}



function displayimage($userKey, $conn)
{

    $query = "select user_im from user_tb where userKey = '". $userKey . "' ";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        echo '<img height="200" width= "150" src="data:image;base64,' . $row['user_im'] . ' ">';
    }


}


?>