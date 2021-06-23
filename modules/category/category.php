<!--	List Product	-->
<?php
$cat_name= $_GET['cat_name'];
$cat_id= $_GET['cat_id'];
if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}
//gán số sp can hien thi tren mot trang
$row_per_page = 6;
$per_row = $page * $row_per_page - $row_per_page; // key
//tinh toan so ban ghi
$total_rows = mysqli_num_rows(mysqli_query($connect , "SELECT * FROM product where cat_id='$cat_id'")); // rút gọn code
$total_pages = ceil($total_rows/$row_per_page); // ceil là hàm làm tròn số trong php,  tính tổng số trang
// nút prev trang
$list_pages= ''; 
$page_prev = $page -1; // về trang trước
if($page_prev<=0){
    $page_prev = 1;
} // đang ở trang 1 mà vẫn bấm lùi trang trước

$list_pages .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&cat_name='.$cat_name.'&cat_id='.$cat_id.'&page='.$page_prev.'">&laquo;</a></li>'; //  giao diện nút lùi trang
// tính toán số trang 
//  for(khởi tạo bt, bt , tăng/giảm bt){
//          thực thi hành động;
//  }
for($i=1; $i<=$total_pages; $i++){
   if($i==$page){
        $active = 'active';// bôi xanh nút trang
   }else{
       $active = '';
   }
   $list_pages .= '<li class="page-item '.$active.'"><a class="page-link" href="index.php?page_layout=category&cat_name='.$cat_name.'&cat_id='.$cat_id.'&page='.$i.'">'.$i.'</a></li>';

}
// next pages giong prev
$page_next = $page +1;
if($page_next > $total_pages){ 
   $page_next = $total_pages;
}
$list_pages .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&cat_name='.$cat_name.'&cat_id='.$cat_id.'&page='.$page_next.'">&raquo;</a></li>';



$sql="SELECT * FROM product where cat_id= $cat_id ORDER BY prd_id DESC LIMIT $per_row, $row_per_page" ;
$query=mysqli_query($connect,$sql);
$num = mysqli_num_rows($query);
?>





<div class="products">
    <h3><?php echo $cat_name;?> (hiện có <?php echo $num;?> sản phẩm)</h3>
    <div class="product-list row">
    <?php while($row=mysqli_fetch_assoc($query)){ ?>
        <div class="col-lg-4 col-md-6 col-sm-12 mx-product">
            <div class="product-item card text-center">
                <a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id'];?>"><img src="admin/img/products/<?php echo $row['prd_image'];?>"></a>
                <h4><a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id'];?>"><?php echo $row['prd_name'];?></a></h4>
                <p>Giá Bán: <span><?php echo $row['prd_price'];?></span></p>
            </div>
        </div>
        <?php }?>
    </div>
</div>
<!--	End List Product	-->

<div id="pagination">
    <ul class="pagination">
        <?php echo $list_pages;?>
    </ul>
</div>