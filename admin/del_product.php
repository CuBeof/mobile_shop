<?php 
session_start();
$prd_id = $_GET['prd_id'];
if(isset($_SESSION['mail']) && isset($_SESSION['pass'])){
    define("SECURITY", TRUE);
    include_once("../config/connect.php");
    $sql = "DELETE from product where prd_id = $prd_id";
    mysqli_query($conn, $sql);
    header("location: index.php?page_layout=product");
}else{
    header("location: index.php");
}
?>