<?php
include 'nav_menu_banner.php';
?>

<?php

;
if (!(isset($_SESSION['current_user']))){

	echo "please login first";
}
else{





	echo "hello user!";
}