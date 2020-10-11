<?php
    if(!Defined('SECURITY')){
        die('Bạn không có quyền truy cập vào file này!');
    }
?>

<?php
    $conn = mysqli_connect('localhost', 'root', '', 'vietpro_mobile_shop');
    if($conn){
        mysqli_query($conn, "SET NAMES 'utf8' ");
        //kết nối thành công
    }else{
        echo 'kết nối thất bại';
    }
?>