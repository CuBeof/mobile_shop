<?php
if (!defined("SECURITY")) {
    die("Bạn không có quyền truy cập");
}
$sql = "SELECT * FROM category order by cat_id asc";
$query = mysqli_query($conn, $sql);

if (isset($_POST['sbm'])) {
    $prd_name = $_POST['prd_name'];
    $prd_price = $_POST['prd_price'];
    $prd_warranty = $_POST['prd_warranty'];
    $prd_accessories = $_POST['prd_accessories'];
    $prd_promotion = $_POST['prd_promotion'];
    $prd_new = $_POST['prd_new'];
    $prd_image = $_FILES['prd_image']['name'];
    $prd_image_tmp_name = $_FILES['prd_image']['tmp_name'];
    $cat_id = $_POST['cat_id'];
    $prd_status = $_POST['prd_status'];
    if (isset($_POST['prd_featured'])) {
        $prd_featured = $_POST['prd_featured'];
    } else {
        $prd_featured = 0;
    }
    $prd_details = $_POST['prd_details'];
    $sql = "INSERT INTO product(prd_name, prd_price, prd_warranty, prd_accessories, prd_promotion, prd_new, prd_image,
     cat_id, prd_status, prd_featured, prd_details) VALUE('$prd_name', $prd_price, '$prd_warranty', '$prd_accessories', '$prd_promotion', '$prd_neW',
     '$prd_image', '$cat_id', '$prd_status', '$prd_featured', '$prd_details')";
    $query = mysqli_query($conn, $sql);
    move_uploaded_file($prd_image_tmp_name, 'img/products/' . $prd_image);
    header("location: index.php?page_layout=product");
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
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="index.php"><svg class="glyph stroked home">
                            <use xlink:href="#stroked-home"></use>
                        </svg></a></li>
                <li><a href="index.php?page_layout=product">Quản lý sản phẩm</a></li>
                <li class="active">Thêm sản phẩm</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thêm sản phẩm</h1>
            </div>
        </div>
        <!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-6">
                            <form role="form" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Tên sản phẩm</label>
                                    <input required name="prd_name" class="form-control" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label>Giá sản phẩm</label>
                                    <input required name="prd_price" type="number" min="0" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Bảo hành</label>
                                    <input required name="prd_warranty" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Phụ kiện</label>
                                    <input required name="prd_accessories" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Khuyến mãi</label>
                                    <input required name="prd_promotion" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Tình trạng</label>
                                    <input required name="prd_new" type="text" class="form-control">
                                </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ảnh sản phẩm</label>

                                <input required name="prd_image" type="file">
                                <br>
                                <div>
                                    <img src="img/download.jpeg">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Danh mục</label>
                                <select name="cat_id" class="form-control">
                                    <?php
                                    while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value=<?php echo $row['cat_id'] ?>><?php echo $row['cat_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select name="prd_status" class="form-control">
                                    <option value=1 selected>Còn hàng</option>
                                    <option value=0>Hết hàng</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Sản phẩm nổi bật</label>
                                <div class="checkbox">
                                    <label>
                                        <input name="prd_featured" type="checkbox" value=1>Nổi bật
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Mô tả sản phẩm</label>
                                <textarea id='editor1' required name="prd_details" class="form-control" rows="3"></textarea>
                                <script>
                                    CKEDITOR.replace('editor1');
                                </script>
                            </div>
                            <button name="sbm" type="submit" class="btn btn-success">Thêm mới</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.col-->
        </div><!-- /.row -->

    </div>
    <!--/.main-->
</body>

</html>