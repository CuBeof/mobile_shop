<?php
session_start();
$cat_id = $_GET['cat_id'];
if(isset($_SESSION['mail']) && isset($_SESSION['pass'])){
    define("SECURITY", TRUE);
    include_once("../config/connect.php");
    $sql = "DELETE from category where cat_id = $cat_id" ;
    mysqli_query($conn, $sql);
    header("location: index.php?page_layout=category");
}else{
    header("location: index.php");
}
?>