<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    $arr = array(
        "font end" => array(
            "HTML",
            "CSS",
            "Bootstrap",
            "Javascrip",
            "VueJS"
        ),
        "back end" =>array(
            "PHP",
            "MySQL",
            "Laravel"
        )
        );
    echo $arr["font end"][2];    
    ?>
</body>
</html>