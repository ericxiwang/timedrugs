<?php
//$mail_type = 1, new order
//$mail_type = 2, paied and shipping

include('lib/class.phpmailer.php');
  
include('lib/class.smtp.php');



function sign_up_mail($mail_address,$user_psw,$first_name,$last_name)
{
//$user_email = $_SESSION['user_account'][0];

$html_content = "";
// read shopping cart from session and insert them into various

echo $mail_address,$user_psw,$first_name,$last_name;

//print_r($cart_list);


$mail             = new PHPMailer();
  
$body             = file_get_contents('lib/sign_up_temp.php');
  
$body             = eregi_replace("[\]",'',$body);

$body 			= str_replace('%user_mail%', $mail_address, $body);

$body 			= str_replace('%user_password%', $user_psw, $body);

//$body 			= str_replace('%ord_amount%', $total_price, $body);

  
//设置smtp参数
$mail->CharSet = "UTF-8";
  
$mail->IsSMTP();
  
$mail->SMTPAuth   = true;                
  
$mail->SMTPKeepAlive = true;               
  
$mail->SMTPSecure = "ssl";               
  
$mail->Host       = "ssl://smtp.gmail.com";   
  
$mail->Port       = 465;                
  
//填写你的gmail账号和密码
  
$mail->Username   = "gowest.wang@gmail.com"; 
  
$mail->Password   = "p@ssw)rd";         
  
//设置发送方，最好不要伪造地址
  
$mail->From       = "gowest.wang@gmail.com";
  
$mail->FromName   = "北美好时光保健品公司";
if ($mail_type == '1')  {
$mail->Subject    = "订单确认邮件";
}
elseif ($mail_type == '2') {
$mail->Subject    = "发货通知邮件";	# code...
}
  
$mail->AltBody    = $body;
  
$mail->WordWrap   = 50; // set word wrap
  
$mail->MsgHTML($body);
  
//设置回复地址
  
$mail->AddReplyTo("gowest.wang@gmail.com","Webmaster");
  
//添加附件，此处附件与脚本位于相同目录下
  
//否则填写完整路径
  
//$mail->AddAttachment("attachment.jpg");          
  
//$mail->AddAttachment("attachment.zip"); 
  
//设置邮件接收方的邮箱和姓名
$mail_user_name = $first_name." ".$last_name;
$mail->AddAddress($mail_address,$mail_user_name);
//$mail->AddAddress('goodbc123@gmail.com','新订单提醒');
  
//使用HTML格式发送邮件
  
$mail->IsHTML(true);
  
//通过Send方法发送邮件
  
//根据发送结果做相应处理
  
if(!$mail->Send()) {
  
  echo "Mailer Error: " . $mail->ErrorInfo;
  
} else {
  
  echo "用户注册确认邮件已发送，请查收！";
  
}
}

?>