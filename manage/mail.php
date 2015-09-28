<?php


include("class.phpmailer.php");
  
include("class.smtp.php");
  
//获取一个外部文件的内容
  
$mail             = new PHPMailer();
  
$body             = file_get_contents('contents.html');
  
$body             = eregi_replace("[\]",'',$body);
  
//设置smtp参数
  
$mail->IsSMTP();
  
$mail->SMTPAuth   = true;                
  
$mail->SMTPKeepAlive = true;               
  
$mail->SMTPSecure = "ssl";               
  
$mail->Host       = "smtp.gmail.com";   
  
$mail->Port       = 465;                
  
//填写你的gmail账号和密码
  
$mail->Username   = "gowest.wang@gmail.com"; 
  
$mail->Password   = "p@ssw)rd";         
  
//设置发送方，最好不要伪造地址
  
$mail->From       = "gowest.wang@gmail.com";
  
$mail->FromName   = "Webmaster";
  
$mail->Subject    = "This is the subject";
  
$mail->AltBody    = $body;
  
$mail->WordWrap   = 50; // set word wrap
  
$mail->MsgHTML($body);
  
//设置回复地址
  
$mail->AddReplyTo("gowest.wang@gmail.com","Webmaster");
  
//添加附件，此处附件与脚本位于相同目录下
  
//否则填写完整路径
  
$mail->AddAttachment("attachment.jpg");          
  
$mail->AddAttachment("attachment.zip"); 
  
//设置邮件接收方的邮箱和姓名
  
$mail->AddAddress("gowest.wang@gmail.com","FirstName LastName");
  
//使用HTML格式发送邮件
  
$mail->IsHTML(true);
  
//通过Send方法发送邮件
  
//根据发送结果做相应处理
  
if(!$mail->Send()) {
  
  echo "Mailer Error: " . $mail->ErrorInfo;
  
} else {
  
  echo "Message has been sent";
  
}

?>