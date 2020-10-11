<?php 
session_start();
$user_id = $_GET['user_id'];
if(isset($_SESSION['mail']) && isset($_SESSION['pass'])){
    define("SECURITY", TRUE);
    include_once("../config/connect.php");
    $sql = "DELETE from user where user_id = $user_id";
    mysqli_query($conn, $sql);
    header("location: index.php?page_layout=user");
}else{
    header("location: index.php");
}
?>