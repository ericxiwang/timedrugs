<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/index.css">
    <link rel="stylesheet" href="bootstrap/css/footer.css">

    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </head>

<body >



<div class='col-md-9 col-lg-9 panel panel-danger product_list' style='float:center;padding-top:15px;'>

<form class='form-horizontal' role='form' action='timedrugs_admin.php' method='post' enctype="multipart/form-data">

<div class='col-md-6 col-lg-6 panel panel-danger'>

<h3 class='form-signin-heading'>用户登录</h3>

<input class="form-control" name='user_name' type='text'><br/>

<input class='form-control' name='user_password' type='password'><br/>

<button class='form-control' name='submit' type='submit' value="menu_edit">登录后台</button><br/>


</form>
</div>
<?php

if (!(isset($_POST['submit']))) 

{
echo "请输入用户和密码";
}
elseif (isset($_POST['submit']))
{



	$user_name = $_POST['user_name'];
	$user_password = $_POST['user_password'];

	if (($user_name == 'timedrugs_admin') and ($user_password == 'timedrugs1996'))
	{


		 header("Location: nav_admin.php");
	}
} 
else
{

	echo "错误的用户信息";
}


?>

</div>
</body>


</html>