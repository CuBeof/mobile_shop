<?php 
    if(isset($_POST['sbm'])){
        $file = $_FILES['uploadfile']['name'] ;
        $file_tmp_name = $_FILES['uploadfile']['tmp_name'] ;
        move_uploaded_file($file_tmp_name, 'img/'.$file);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="uploadfile">
        <input type="submit" name="sbm" value="Gửi">
    </form>
</body>
</html>