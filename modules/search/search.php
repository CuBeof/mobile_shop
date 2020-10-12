<?php
    $page = (isset($_GET['page']) and !empty($_GET['page']))?($_GET['page'] === 0?1:$_GET['page']):1;
?>
<?php 
if(isset($_GET['keyword']) and !empty($_GET['keyword'])):
    $keyword = $_GET['keyword'];
    require_once "./admin/modules/search.php";
    $sql = searchFull($keyword, $page * 9 - 9, 9);
    $query = mysqli_query($conn, $sql);
?>
<!--	List Product	-->
<div class="products">
    <div id="search-result">Kết quả tìm kiếm với sản phẩm <span><?php echo $keyword; ?></span></div>
    <div class="product-list row">
        <?php
        while($row = mysqli_fetch_array($query)): 
        ?>
        <div class="col-lg-4 col-md-6 col-sm-12 mx-product">
            <div class="product-item card text-center">
                <a href="index.php?page_layout=products&prd_id=<?php echo $row['prd_id']; ?>"><img src="admin/img/products/<?php echo $row['prd_image']; ?>"></a>
                <h4><a href="index.php?page_layout=products&prd_id=<?php echo $row['prd_id']; ?>"><?php echo $row['prd_name']; ?></a></h4>
                <p>Giá Bán: <span><?php echo number_format($row['prd_price']); ?>đ</span></p> 
            </div>
        </div>
        <?php endwhile ?>
    </div>
</div>
<?php endif ?>
<!--	End List Product	-->

<?php if( mysqli_num_rows($query) > 0): ?>
<?php
    $total_product_number = mysqli_num_rows(mysqli_query($conn, searchFull($keyword)));
    $previous_page = $page - 1;
    $next_page = $page + 1;
    $previous_page_extra = $page - 2;
    $next_page_extra = $page + 2;

    $show_previous_page = ($previous_page < 1)?False:True;
    $show_next_page = ($next_page > ceil($total_product_number/9))?False:True;
    $show_previous_page_extra = ($next_page >= ceil($total_product_number/9) and !$show_next_page)?True:False;
    $show_next_page_extra = (!$show_previous_page and $next_page <= ceil($total_product_number/9))?True:False;

?>
<div id="pagination">
    <ul class="pagination">
        <?php if($show_previous_page): ?>
        <li class="page-item"><a class="page-link" href="index.php?page_layout=search&keyword=<?php echo $_GET['keyword']?>&page=<?php echo $previous_page?>"><<</a></li>
        <?php endif ?>

        <?php if($show_previous_page_extra): ?>
        <li class="page-item"><a class="page-link" href="index.php?page_layout=search&keyword=<?php echo $_GET['keyword']?>&page=<?php echo $previous_page_extra?>"><?php echo $previous_page_extra?></a></li>
        <?php endif ?>

        <?php if($show_previous_page): ?>
        <li class="page-item"><a class="page-link" href="index.php?page_layout=search&keyword=<?php echo $_GET['keyword']?>&page=<?php echo $previous_page?>"><?php echo $previous_page?></a></li>
        <?php endif ?>

        <li class="page-item active"><a class="page-link" href="#"><?php echo $page?></a></li>

        <?php if($show_next_page): ?>
        <li class="page-item"><a class="page-link" href="index.php?page_layout=search&keyword=<?php echo $_GET['keyword']?>&page=<?php echo $next_page?>"><?php echo $next_page?></a></li>
        <?php endif ?>        

        <?php if($show_next_page_extra): ?>
        <li class="page-item"><a class="page-link" href="index.php?page_layout=search&keyword=<?php echo $_GET['keyword']?>&page=<?php echo $next_page_extra?>"><?php echo $next_page_extra?></a></li>
        <?php endif ?>        
        
        <?php if($show_next_page): ?>
        <li class="page-item"><a class="page-link" href="index.php?page_layout=search&keyword=<?php echo $_GET['keyword']?>&page=<?php echo $next_page?>">>></a></li>
        <?php endif ?>
    </ul>
</div>
<?php endif ?>