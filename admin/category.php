<?php
 if(!defined('SECURITY')){
	 die('Ban khong co quyen truy cap');
 }
 if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}
//gán số sp can hien thi tren mot trang
$row_per_page = 5;
$per_row = $page * $row_per_page - $row_per_page; // key
//tinh toan so ban ghi
$total_rows = mysqli_num_rows(mysqli_query($connect , "SELECT * FROM category")); // rút gọn code
$total_pages = ceil($total_rows/$row_per_page); // ceil là hàm làm tròn số trong php,  tính tổng số trang
// nút prev trang
$list_pages= ''; 
$page_prev = $page -1; // về trang trước
if($page_prev<=0){
	$page_prev = 1;
} // đang ở trang 1 mà vẫn bấm lùi trang trước

$list_pages .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&page='.$page_prev.'">&laquo;</a></li>'; //  giao diện nút lùi trang
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
   $list_pages .= '<li class="page-item '.$active.'"><a class="page-link" href="index.php?page_layout=category&page='.$i.'">'.$i.'</a></li>';

}
// next pages giong prev
$page_next = $page +1;
if($page_next > $total_pages){ 
   $page_next = $total_pages;
}
$list_pages .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&page='.$page_next.'">&raquo;</a></li>';
?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Quản lý danh mục</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Quản lý danh mục</h1>
			</div>
		</div><!--/.row-->
		<div id="toolbar" class="btn-group">
            <a href="index.php?page_layout=add_category" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i> Thêm danh mục
            </a>
        </div>
		<div class="row">
			<div class="col-md-12">
					<div class="panel panel-default">
							<div class="panel-body">
								<table 
									data-toolbar="#toolbar"
									data-toggle="table">
		
									<thead>
									<tr>
										<th data-field="id" data-sortable="true">ID</th>
										<th>Tên danh mục</th>
										<th>Hành động</th>
									</tr>
									</thead>
									<tbody>
									<?php
									$sql="SELECT * FROM category
									ORDER BY cat_id ASC LIMIT $per_row, 5";
									$query=mysqli_query($connect,$sql);
									while($row=mysqli_fetch_assoc($query)){
									?>
										<tr>
											<td style=""><?php echo $row['cat_id']?></td>
											<td style=""><?php echo $row['cat_name']?></td>
											<td class="form-group">
												<a href="/" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
												<a href="/" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
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

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-table.js"></script>	

