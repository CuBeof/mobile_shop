<?php
    $conn = mysqli_connect('localhost', 'root', '', 'vietpro_mobile_shop');
    if($conn){
        mysqli_query($conn, "SET NAMES 'utf8' ");
        //kết nối thành công
    }else{
        die('kết nối thất bại');
    }
?>

<?php
    if (isset($_GET['type']) and !empty($_GET['type'])){
        switch ($_GET['type']){
            //ajax search
            case "search":
                if (isset($_GET['q']) and !empty($_GET['q'])){
                    include_once "./modules/search.php";
                    $searchSQL = search($_GET['q']);
                    $searchResult = mysqli_query($conn, $searchSQL);
                    $json = array();
                    while($row = mysqli_fetch_assoc($searchResult)) {
                        $json[] = $row;
                    }
                    header('Content-Type: application/json');
                    echo json_encode($json, JSON_FORCE_OBJECT);
                } else {
                    // if no keyword enterd then return empty json
                    echo "{}";
                }
                break;

            //return empty json by default
            default:
                echo "{}";
        }
    }
?>
