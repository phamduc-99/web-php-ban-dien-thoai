<?php
 if(!defined('SECURITY')){
	 die('Ban khong co quyen truy cap');
 }
 
 ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Vietpro Mobile Shop - Administrator</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/bootstrap-table.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<?php
	
	if(isset($_POST['sbm'])){
		$mail=$_POST['mail'];
		$pass=$_POST['pass'];
		if(isset($_POST['remember'])){
		 	$check = $_POST['remember'];
		}else{
		 	$check = 0;
		}
		$sql="SELECT * FROM user
		WHERE user_mail='$mail' AND user_pass='$pass'";
		$query=mysqli_query($connect,$sql);
		$num_rows=mysqli_num_rows($query);
		if($num_rows>0){
			//$_SESSION['mail'] = $mail;
			//$_SESSION['pass'] = $pass;
			if($check != 0){
			 setcookie('mail', $mail,time() + 604800);
			 setcookie('pass', $pass,time() + 604800);
			}else{
			 $_SESSION['mail'] = $mail;
			 $_SESSION['pass'] = $pass;
			}
			header('location: index.php ');
		}else{
			    $error = '<div class="alert alert-danger">Tài khoản không hợp lệ !</div>';

		}
	}
	
	?>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Vietpro Mobile Shop - Administrator</div>
				<div class="panel-body">
					<?php if(isset($error)){echo $error;}?>
					<form role="form" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="mail" type="email" autofocus>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Mật khẩu" name="pass" type="password" value="">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="1">Nhớ tài khoản
								</label>
							</div>
							<button name="sbm" type="submit" class="btn btn-primary">Đăng nhập</button>
							<a href="laylaimk.php" title='Quên mật khẩu'>Quên mật khẩu</a>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
</body>

</html>
