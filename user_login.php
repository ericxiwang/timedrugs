<?php
include 'nav_menu_banner.php';
?>
<?
session_start();?>

<div class='col-md-9 col-lg-9 panel panel-danger product_list' style='float:right;padding-top:15px;'>
<script src="bootstrap/js/validator.min.js"></script>
<?php
function draw_login($login_status){



      echo "<form action='user_login.php' method='POST' class='form-horizontal' role='form' data-toggle='validator'>";
      echo "<div class='col-md-6 col-lg-6 panel panel-danger' style='padding-bottom:15px;'>";
      echo "<h3 class='form-signin-heading'>用户登录</h3>";

      echo "<div class='form-group'>";
      echo "<div class='col-md-8'>";
        echo "<label>用户登录邮箱</label>";
        echo "<input class='form-control' name='user_email' placeholder='输入邮箱地址' type=text required>";
      echo "</div>";
      echo "</div>";


      echo "<div class='form-group'>";
      echo "<div class='col-md-8'>";

        echo "<label>用户密码</label>";  
        echo "<input class='form-control' name='user_password' placeholder='输入密码' type=password required>";
      echo "</div>";
      echo "</div>";
      if ($login_status == 'false'){
        echo "登录信息错误，请重试！";
      }

      echo "<div class='form-group'>";
      echo "<div class='col-md-8'>";

  
        echo "<button class='btn btn-lg btn-danger btn-block' type='submit'>登录</button>";
      echo "</div>";
      echo "</div>";


        

        
      echo "</form>";

}

function user_login(){

if (!(isset($_POST['user_email']))){
  draw_login('new_login');
}
elseif (isset($_POST['user_email'])){
  global $db_connect;
  $current_user = $_POST['user_email'];
  $check_user = "SELECT email from user_info where email='$current_user'";
  $execute_login = mysqli_query($db_connect,$check_user);
  echo "!!".mysqli_fetch_row($execute_login);
  draw_login('false');

}


}
user_login();

?>

</body>
</html>