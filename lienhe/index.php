<?php
if($_POST['message'] && $_POST['email'] && $_POST['name'] && $_POST['subject'])
{
	//error_reporting(E_ALL);
	error_reporting(E_STRICT);
	date_default_timezone_set('Asia/Krasnoyarsk');
	require_once('class.phpmailer.php');
	//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

	$mail             = new PHPMailer();
	$body             = "Email liên hệ từ: {$_POST['name']} ({$_POST['email']})\n<br>".$_POST['message'];
	$body             = eregi_replace("[\]",'',$body);

	$mail->IsSMTP();
	$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
											   // 1 = errors and messages
											   // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
	$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
	$mail->Username   = "toasoan@thoibaonganhang.vn";  // GMAIL username
	$mail->Password   = "abc37163923";            // GMAIL password

	$mail->SetFrom($_POST['email'], $_POST['name']); //Định danh người gửi
	$mail->AddReplyTo($_POST['email'],$_POST['name']); //Định danh người sẽ nhận trả lời
	$mail->Subject    = $_POST['subject']; //Tiêu đề Mail
	$mail->AltBody    = "Để xem tin này, vui lòng bật tương thích chế độ hiển thị mã HTML!"; // optional, comment out and test
	$mail->MsgHTML($body);

	$address = "toasoan@thoibaonganhang.vn"; //Địa chỉ mail cần gửi tới
	$mail->AddAddress($address, "Thời Báo Ngân Hàng"); //Gửi tới ai ?

	//$mail->AddAttachment("dinhkem/02.jpg");      // Đính kèm
	//$mail->AddAttachment("dinhkem/200_100.jpg"); // Đính kèm

	if(!$mail->Send()) {
	  echo "Lỗi gửi mail: " . $mail->ErrorInfo;
	} else {
	  echo "Mail đã được gửi!";
	}
}
else
{
	echo "Vui lòng nhập đủ thông tin";
}
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Hộp thư Thời Báo Ngân Hàng</title>
</head>

<body>

<form method="POST" action="index.php">
	<table border="1" width="520"  style="border-collapse: collapse">
		<tr>
			<td width="17%">Tên bạn:</td>
			<td width="77%"><input type="text" name="name" value="<?=$_POST['name']?>"  size="78"></td>
		</tr>
		<tr>
			<td width="17%">Email của bạn:</td>
			<td width="77%"><input type="text" name="email" value="<?=$_POST['email']?>" size="78"></td>
		</tr>
		<tr>
			<td width="17%">Tiêu đề:</td>
			<td width="77%"><input type="text" name="subject" value="<?=$_POST['subject']?>"  size="78"></td>
		</tr>
		<tr>
			<td width="17%">Nội dung:</td>
			<td width="77%">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2"><textarea rows="10" name="message" cols="61"><?=$_POST['message']?></textarea></td>
		</tr>
		<tr>
			<td><input type="submit" value="Submit"></td>
			<td><input type="reset" value="Reset"></td>
		</tr>
	</table>
</form>

</body>

</html>
