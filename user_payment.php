
<?php
include 'nav_menu_banner.php';
require 'draw_shopping_cart.php';
$_SESSION['submit_enabled']='1';
?>

<?php

#unset($_SESSION['cart_list']);
#print_r($_SESSION);
#session_destroy();
if (!(isset($_SESSION['user_account']))){

	echo "please login first";


}
else{

	





	simple_list();





	
}


?>