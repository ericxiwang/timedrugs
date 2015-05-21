<?php
include 'nav_menu_banner.php';
require 'draw_shopping_cart.php';
?>
<?php

//////////////////// this statement for item delete /////////
////////////////////receive the pro_code from current, if it's exist, do as follow
if (isset($_GET['product_id'])){ 

	#echo "$$$".$_GET['product_id'];

	$Load_session = $_SESSION['cart_list'];
	
	foreach ( $Load_session as $one_array => $array ) {
		#echo $array['pro_code'].'++++++++'.$_GET['product_id'];
		#echo "<br/>";


	    if ( $array['pro_code'] == $_GET['product_id'] ) {
	    	#echo $array['pro_code'].'++++++++'.$_GET['product_id'];
			#echo "<br/>";



	        #unset($Load_session[$one_array['pro_code']]);
	        /*echo "@@@".$array['pro_code'];
	        echo "<br/>";
	        echo "delete one array";*/
	        unset($Load_session[$one_array]); //remove current array from the 2d array
	        $_SESSION['cart_list'] = $Load_session;	//put the updated 2d array into session

	        #echo serialize($Load_session);
	       
	    }

}

   draw_chart_list();

}
//////////////////else, used to receive data from previous page(product_introduce.php)
else
{	


if (isset($_POST['text_box'])){
$pro_quantity = $_POST['text_box'];
$pro_code = $_POST['pro_code'];

$current_product_query = ("SELECT pro_name,pro_img,pro_o_price,pro_code FROM product_info WHERE pro_code='$pro_code'");
$add_to_cart = mysqli_query($db_connect,$current_product_query);
$add_to_cart = mysqli_fetch_assoc($add_to_cart);


if(isset($_POST['originator'])) { 
	#echo $_POST['originator'];

		if($_POST['originator'] == $_SESSION['code']){

			// check shopping cart already in session or not
			if (!(isset($_SESSION['cart_list']))){
				$add_to_cart['whole_price'] = 0;//init whole price value
				
				

				#echo "no session so create a new one";
				$total_list = array();
				$add_to_cart['quantity'] = $pro_quantity;//insert quantity into session
				$add_to_cart['whole_price'] = $add_to_cart['pro_o_price'] * $pro_quantity; //caculate whole price for one product and insert into session


				array_push($total_list,$add_to_cart);	
				


				$_SESSION['cart_list'] = $total_list;
				$_SESSION['code'] = 0;
				#echo "##".$_SESSION['code'];

				

				}
			else 	
				{
				#	echo "session exist, push one more into array";
				// read previous data from session
				$total_list = $_SESSION['cart_list'];

			
				$add_to_cart['quantity'] = $pro_quantity;
				$add_to_cart['whole_price'] = $add_to_cart['pro_o_price'] * $pro_quantity; //caculate whole price for one product and insert into session
				array_push($total_list,$add_to_cart);	


				$_SESSION['cart_list'] = $total_list;
				$_SESSION['code'] = 0;
				#echo "##".$_SESSION['code'];


				}
				///////////////check session isset end /////////
			}
		
		

	#echo "@@@@".serialize($_SESSION['cart_list']);
	//put product info into session var

draw_chart_list();
	}

}

else{
	draw_chart_list();



}
}

?>

	
<?php

?>



</body>
</html>