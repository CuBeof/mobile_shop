<?php 
if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}
$row_per_page = 5; // 1 trang có 5
$per_row = $page * $row_per_page - $row_per_page; 

//Truy xuất CSDL
$prd_id = $_GET['prd_id'];
$total_row = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product where prd_id = $prd_id")); //đếm bản ghi sản phẩm
$total_page = ceil($total_row / $row_per_page) ; //số trang

//Prev , next , page 123
$list_page = '';

$prev = $page - 1;
if($prev <= 0 ){
    $prev = 1;
}
$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=search&page='.$prev.'">&laquo;</a></li>';
for($i = 1; $i <= $total_page; $i++){
    if($i == $page){
        $active = 'active';
    }else{
        $active = '';
    }
    $list_page .= '<li class="page-item '.$active.'"><a class="page-link" href="index.php?page_layout=search&page='.$i.' ">'.$i.'</a></li>';
}

$next = $page + 1;
if($next>= $total_page){
    $next = $total_page;
}
$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=search&page='.$next.'">&raquo;</a></li>'
?>
<?php 
if(isset($_POST['keyword'])){
    $keyword = $_POST['keyword'];
}else{
    $keyword = $_GET['keyword'];
}
//explode
$arr_keyword = explode(" ", $keyword);
$end_keyword = "%".implode("%", $arr_keyword)."%";

$sql = "SELECT * FROM product where prd_name like '$end_keyword' order by prd_id desc limit $per_row,$row_per_page";
$query = mysqli_query($conn, $sql);
?>
<!--	List Product	-->
<div class="products">
    <div id="search-result">Kết quả tìm kiếm với sản phẩm <span><?php echo $keyword; ?></span></div>
    <div class="product-list row">
        <?php
        while($row = mysqli_fetch_array($query)){ 
        ?>
        <div class="col-lg-4 col-md-6 col-sm-12 mx-product">
            <div class="product-item card text-center">
                <a href="index.php?page_layout=products&prd_id=<?php echo $row['prd_id']; ?>"><img src="admin/img/products/<?php echo $row['prd_image']; ?>"></a>
                <h4><a href="index.php?page_layout=products&prd_id=<?php echo $row['prd_id']; ?>"><?php echo $row['prd_name']; ?></a></h4>
                <p>Giá Bán: <span><?php echo number_format($row['prd_price']); ?>đ</span></p>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<!--	End List Product	-->

<div id="pagination">
    <ul class="pagination">
    <?php echo $list_page; ?>
    </ul>
</div>