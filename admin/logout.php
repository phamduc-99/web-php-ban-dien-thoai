
<?php
session_start();
if(isset($_COOKIE['mail']) && isset($_COOKIE['pass'])){
    setcookie('mail',"",time() - 604800);
    //if(isset($_SESSION['mail']) && isset($_SESSION['pass'])){
        //session_destroy();
    //}
}else{
if(isset($_SESSION['mail']) && isset($_SESSION['pass'])){
    session_destroy();
}
}
header('location: index.php');
?>