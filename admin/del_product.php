<?php 
session_start();
$prd_id = $_GET['prd_id'];
if(isset($_SESSION['mail']) && isset($_SESSION['pass'])){
    define("SECURITY", TRUE);
    include_once("../config/connect.php");

    $sql1 ="SELECT * FROM product WHERE prd_id=$prd_id";
    $query=mysqli_query($conn,$sql1);
    $row=mysqli_fetch_assoc($query);
    unlink('img/products/'.$row['prd_image']);
    
    $sql = "DELETE from product where prd_id = $prd_id";
    mysqli_query($conn, $sql);
    header("location: index.php?page_layout=product");
}else{
    header("location: index.php");
}
?>