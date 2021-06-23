<?php
define('SECURITY', true);
include_once('../config/connect.php');

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['mail'])){
    $email = $_POST['mail'];
    $sql = "SELECT * FROM user WHERE user_mail = '$email'";
    $query = mysqli_query($connect,$sql);
    $num = mysqli_num_rows($query);
    $row = mysqli_fetch_assoc($query);
    $pass = $row['user_pass'];
    if($num>0){
    $emailHTML = '';
    $emailHTML .= '
    <p>
    <b style="font-weight: bold;"Tài khoản:</b>'.$email.'<br>
    <b>Mật khẩu của bạn:</b>'.$pass.'<br>
    </p>
    ';
    $mail = new PHPMailer(true);
try {                      
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                    
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'phamduc99yn@gmail.com';                     
    $mail->Password   = 'biyyksuneclgonet';                               
    $mail->SMTPSecure = 'TLS';         
    $mail->Port       = 587;                                   

    $mail->setFrom('phamduc99yn@gmail.com', 'VietproShop');
    $mail->addAddress($email, 'Khách hàng');     
    $mail->addCC($email);
    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);                                  
    $mail->Subject = 'Lấy lại mật khẩu của VietproShop';
    $mail->Body    = $emailHTML;
    //$mail->AltBody = 'Mô tả đơn hàng';
    $mail->send();
    header('location: thanhcong.php');
} catch (Exception $e) {
    $error= 'Không thể gửi email. Mailer Error: {$mail->ErrorInfo}';
}
    }else{
        $error = 'Email chưa được đăng kí';
    }
}
?>
<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Nhập địa chỉ email của bạn</div>
				<div class="panel-body">
					<?php if(isset($error)){echo $error;}?>
					<form role="form" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="mail" type="email" autofocus>
							</div>
							</div>
							<button name="sbm" type="submit" class="btn btn-primary">Lấy lại mật khẩu</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	