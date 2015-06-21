<?php
include 'nav_menu_banner.php';
?>


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
/*
      elseif ($login_status == 'new_login') {

        if (isset($_SESSION['cart_list'])){
          #echo $_SESSION['cart_list'];
        }
        elseif (!(isset($_SESSION['cart_list']))) {
          # code...
          header("Location: index.php");
        }

        # code...
      }
*/
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
  $current_password = md5($_POST['user_password']);

  $check_user = "SELECT email,user_password,first_name,last_name from user_info where email='$current_user'";
  $execute_login = mysqli_query($db_connect,$check_user);
  #echo "!!".mysqli_fetch_row($execute_login);
  $query_user = mysqli_fetch_assoc($execute_login);
  #echo $current_password;
  #echo $query_user['email'];

  /////////////// hereunder is the process of login successfully //////////////
  if ($query_user['email'] == $current_user and $query_user['user_password'] == $current_password)
  {
    #echo "ok";

    //////////put email, lastname, firstname into array and push into session ////////
    $user_account = array($query_user['email'],$query_user['last_name'],$query_user['first_name']);
    $_SESSION['user_account'] = $user_account;
    if (isset($_SESSION['cart_list'])){
          $check_session = $_SESSION['cart_list'];
          $total_price = 0;

          ////////////go through the cart_list and then decide to redirect to which on page/////////////
          foreach ($check_session as $single_product){
            $total_price = $single_product['pro_o_price'] + $total_price;


          }
          ////////// if price is 0 , that means session is empty , redirect to index.php //////////
          if ($total_price == 0){
            header("Location: index.php");
          }
          ////////// if cart list has item, redirect to shopping cart list and contiune the purchase process ///////////////
          elseif ($total_price != 0)
          {
            header("Location: shopping_cart_list.php");

          }
          #header("Location: shopping_cart_list.php");
          #echo $_SESSION['cart_list'];
        }
        ///////// if cart list session is not exist, redirect to index.php ///////////////
        elseif (!(isset($_SESSION['cart_list']))) {
          # code...
          header("Location: index.php");
        }

        # code...
      
  }
  else{draw_login('false');}

}


}
user_login();

?>

</body>
</html>