<?php
 if(!defined('SECURITY')){
	 die('Ban khong co quyen truy cap');
 }
 //phan trang
 // hứng tham số từ url

 if(isset($_GET['page'])){
     $page = $_GET['page'];
 }else{
     $page = 1;
 }
 //gán số sp can hien thi tren mot trang
 $row_per_page = 5;
 $per_row = $page * $row_per_page - $row_per_page; // key
 //tinh toan so ban ghi
 $total_rows = mysqli_num_rows(mysqli_query($connect , "SELECT * FROM product")); // rút gọn code
 $total_pages = ceil($total_rows/$row_per_page); // ceil là hàm làm tròn số trong php,  tính tổng số trang
 // nút prev trang
 $list_pages= ''; 
 $page_prev = $page -1; // về trang trước
 if($page_prev<=0){
     $page_prev = 1;
 } // đang ở trang 1 mà vẫn bấm lùi trang trước

 $list_pages .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page='.$page_prev.'">&laquo;</a></li>'; //  giao diện nút lùi trang
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
    $list_pages .= '<li class="page-item '.$active.'"><a class="page-link" href="index.php?page_layout=product&page='.$i.'">'.$i.'</a></li>';

}
// next pages giong prev
$page_next = $page +1;
if($page_next > $total_pages){ 
    $page_next = $total_pages;
}
$list_pages .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page='.$page_next.'">&raquo;</a></li>';
 ?>
 <script>
 function delItem(name)
 {
     return confirm('ban muon xoa san pham '+name+' ?');
 }
 </script>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Danh sách sản phẩm</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Danh sách sản phẩm</h1>
			</div>
		</div><!--/.row-->
		<div id="toolbar" class="btn-group">
            <a href="index.php?page_layout=add_product" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i> Thêm sản phẩm
            </a>
        </div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
                        <table 
                            data-toolbar="#toolbar"
                            data-toggle="table">

						    <thead>
						    <tr>
						        <th data-field="id" data-sortable="true">ID</th>
						        <th data-field="name"  data-sortable="true">Tên sản phẩm</th>
                                <th data-field="price" data-sortable="true">Giá</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Trạng thái</th>
                                <th>Danh mục</th>
                                <th>Hành động</th>
						    </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql="SELECT * FROM product
                            INNER JOIN category ON product.cat_id=category.cat_id
                            ORDER BY prd_id DESC LIMIT $per_row, $row_per_page"; // them LIMIT VAO DAY
                            $query=mysqli_query($connect,$sql);
                            while($row=mysqli_fetch_assoc($query)){


                            ?>
                                    <tr>
                                        <td style=""><?php echo $row['prd_id'];?></td>
                                        <td style=""><?php echo $row['prd_name'];?></td>
                                        <td style=""><?php echo $row['prd_price'];?></td>
                                        <td style="text-align: center"><img width="130" height="180" src="img/products/<?php echo $row['prd_image'];?>" /></td>
                                        <td><span class="label <?php if($row['prd_status']==1){echo'label-success';}else{echo'label-danger';}?>">
                                        <?php if($row['prd_status']==1){echo'con hang';}else{echo'het hang';}?></span></td>
                                        <td><?php echo $row['cat_name'];?></td>
                                        <td class="form-group">
                                            <a href="index.php?page_layout=edit_product&prd_id=<?php echo $row['prd_id'];?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                            <a onclick="return delItem('<?php echo $row['prd_name'];?>')" href="delete_product.php?prd_id=<?php echo $row['prd_id'];?>"><i class="glyphicon glyphicon-remove"></i></a>
                                        </td>
                                    </tr>
                        <?php }?>
                                 </tbody>
						</table>
                    </div>
                    <div class="panel-footer">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                               <?php echo $list_pages;?>
                            </ul>
                        </nav>
                    </div>
				</div>
			</div>
		</div><!--/.row-->	
	</div>	<!--/.main-->


