<?php
if(!defined('SECURITY')){
    die('Ban khong co quyen truy cap');
}
?>
<!--	Feature Product	-->
<div class="products">
    <h3>Sản phẩm nổi bật</h3>
    <div class="product-list row">
        <?php
        $sql="SELECT * FROM product ORDER BY prd_id";
        $query= mysqli_query($connect, $sql);
        while($row = mysqli_fetch_assoc($query)){
        ?>
        <div class="col-lg-4 col-md-6 col-sm-12 mx-product">
            <div class="product-item card text-center">
                <a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id']; ?>"><img src="admin/img/products/<?php echo $row['prd_image']; ?>"></a>
                <!-- file feature da duoc goi tu index nen ngang hang admin -->
                <h4><a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id']; ?>"><?php echo $row['prd_name']; ?></a></h4>
                <p>Giá Bán: <span><?php echo $row['prd_price']; ?></span></p>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<!--	End Feature Product	-->