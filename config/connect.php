<?php
if(!defined('SECURITY')){
    die('Ban khong co quyen truy cap');
}
$connect= mysqli_connect('localhost','root','','thb7');
if($connect){
    mysqli_query($connect,"SET NAMES 'utf8'");
}else{
    die('ff');
}

?>