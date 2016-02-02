<?php
//$mail_type = 1, new order
//$mail_type = 2, paied and shipping

include('lib/class.phpmailer.php');
  
include('lib/class.smtp.php');



function order_email($mail_type,$order_number,$ord_amount)
{
$user_email = $_SESSION['user_account'][0];

$html_content = "";
// read shopping cart from session and insert them into various
foreach ($_SESSION['cart_list'] as $key => $cart_list) {

$html_content.="<tr>"."<td>".$cart_list['pro_name']."</td>"."<td>".$cart_list["quantity"]."</td></tr>";

}
$total_price = (string)$ord_amount;

//print_r($cart_list);


$mail             = new PHPMailer();
  
$body             = file_get_contents('lib/contents.php');
  
$body             = eregi_replace("[\]",'',$body);

$body 			= str_replace('%order_number%', $order_number, $body);

$body 			= str_replace('%cart_list%', $html_content, $body);

$body 			= str_replace('%ord_amount%', $total_price, $body);

  
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
$mail_user_name = $_SESSION['user_account'][1]." ".$_SESSION['user_account'][2];
$mail->AddAddress($user_email,$mail_user_name);
//$mail->AddAddress('goodbc123@gmail.com','新订单提醒');
  
//使用HTML格式发送邮件
  
$mail->IsHTML(true);
  
//通过Send方法发送邮件
  
//根据发送结果做相应处理
  
if(!$mail->Send()) {
  
  echo "Mailer Error: " . $mail->ErrorInfo;
  
} else {
  
  echo "订单确认邮件已发送，请查收！";
  
}
}

?>