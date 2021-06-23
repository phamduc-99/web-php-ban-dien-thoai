<?php
$ss_id = session_id();
 $time = time();
 $time_c = $time - 120;
 $sql = "SELECT * FROM `online` WHERE ss_id='$ss_id'";
 $query=mysqli_query($connect,$sql);
 $num = mysqli_num_rows($query);
 if($num == 0){
     $sql1 = " UPDATE sl SET dem = dem+1 ";
      $query1 = mysqli_query($connect," UPDATE sl SET dem = dem+1 ");
      
     $sql2 = "INSERT INTO `online`(`ss_id`, `ti`) VALUES ('$ss_id','$time')";
     $query2 = mysqli_query($connect,$sql2);
 }else{
     $sql3 = "UPDATE `online` SET ti='$time' WHERE ss_id = '$ss_id'";
     $query3 = mysqli_query($connect,$sql3); 
 }
$sql3 = "DELETE FROM `online` WHERE ti < $time_c " ;
$query3 = mysqli_query($connect,$sql3);

 $sql4 = "SELECT * FROM `online` ";
 $query4 = mysqli_query($connect,$sql4);
 $ol = mysqli_num_rows($query4);
 
 $sql11 = "SELECT * FROM sl";
 $query11 = mysqli_query($connect, $sql11);
 $row1 = mysqli_fetch_assoc($query11);

?>
<div id="ol">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <p>
                    Số lượng truy cập: <?php echo $row1['dem']; ?>
                </p>
                <p>
                    Dang ol: <?php echo $ol;?>
                </p>
            </div>
        </div>
    </div>
</div>