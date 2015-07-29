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

function check_promotion($current_id,$current_quantity,$current_price){
	global $db_connect;


		/////////////////////////////////////////////////////////////
		/////////////// go to check table pro_discount //////////////
		/////////////////////////////////////////////////////////////

	$check_promotion_table = "SELECT discount_value,pro_buy,pro_get,pro_type,pro_price,dis_enabled from pro_discount where promotion_id ='$current_id' ";
	$check_promotion_table = mysqli_query($db_connect,$check_promotion_table);
	$check_promotion_table = mysqli_fetch_assoc($check_promotion_table);

	if ($check_promotion_table['dis_enabled']=='1'){
		#print_r($check_promotion_table);

		switch ($check_promotion_table['pro_type'])
			{

	      case '1'://discount
	        $show_discount = $check_promotion_table['discount_value'];
	        $discount_rate = ($show_discount/100);
	        $promotion_result = intval($current_price * $discount_rate); // the price after discount
	        $promotion_display = $current_price; //the price before discounto_price


	        return array($check_promotion_table['pro_type'],$promotion_result,$promotion_display);

	        break;

	      case '2'://buy and get
	        $show_buy = $check_promotion_table['pro_buy'];
	        $show_get = $check_promotion_table['pro_get'];
	        $real_get = intval($current_quantity/$show_buy);

	        $promotion_result = intval($current_quantity) + $real_get*$show_get;   //// return the quantity includes get items//////


	        if ($real_get =='0'){	
	        	$promotion_display = $current_quantity;


	        }
	        else{
	        	$promotion_display = $current_quantity." + ".$real_get*$show_get; //display such as n + 1 effect
	        

			}

	        return array($check_promotion_table['pro_type'],$promotion_result,$promotion_display);


	        break;

	      case '3'://speical price

	        $show_price = $check_promotion_table['pro_price'];
	         
	        break;




	      case '4': // free shipping
	      	$promotion_result = $current_price; //assign price to varible
	      	$promotion_display = 0;


	      	return array($check_promotion_table['pro_type'],$promotion_result,$promotion_display);

	      	break;


	    }

		

	}

	


}
///////////////////////////////////////////////////////////////
////////////////////// check promotion end ////////////////////
if (isset($_POST['text_box'])){
$pro_quantity = $_POST['text_box']; // get order quantity without promotion
$pro_code = $_POST['pro_code'];//get product code



$current_product_query = ("SELECT pro_name,pro_img,pro_o_price,pro_code,promotion_id,pro_weight,promotion_enabled FROM product_info WHERE pro_code='$pro_code'");
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

				/////////////////////////// invoke check promotion function //////////////////////
				/*if (isset($_POST['notice_promotion'])){
				
					$current_promotion = $_POST['notice_promotion'];//get matched promotion_id

					$put_into_session = check_promotion($current_promotion,$pro_quantity,$add_to_cart['pro_o_price']);
					}*/

					if (isset($_POST['notice_promotion'])){

					$current_promotion = $_POST['notice_promotion'];//get matched promotion_id

					$put_into_session = check_promotion($current_promotion,$pro_quantity,$add_to_cart['pro_o_price']);





				


						if ($put_into_session[0]=='1'){////////////promotion is discount

						$add_to_cart['pro_type'] = $put_into_session[0];
						$add_to_cart['quantity'] = $pro_quantity;
						$add_to_cart['whole_price'] = $put_into_session[1] * $pro_quantity; //caculate whole price for one product and insert into session
						$add_to_cart['o_price'] = $put_into_session[2];
						$add_to_cart['m_price'] = $put_into_session[1];

						#echo "AAAA".$put_into_session[1]."AAAAA";
						#echo "BBBB".$pro_quantity."BBB";
						$add_to_cart['pro_weight_all'] = $add_to_cart['pro_weight'] * $pro_quantity;
						array_push($total_list,$add_to_cart);	
						}



						elseif($put_into_session[0]=='2'){	/////////////primotion is buy and get

						$add_to_cart['pro_type'] = $put_into_session[0];
						$add_to_cart['quantity'] = $put_into_session[2];
						$add_to_cart['whole_price'] = $add_to_cart['pro_o_price'] * $pro_quantity;
						$add_to_cart['o_price'] = $add_to_cart['pro_o_price'];
						$add_to_cart['m_price'] = $add_to_cart['pro_o_price'];

						
						$add_to_cart['pro_weight_all'] = $put_into_session[1] * $add_to_cart['pro_weight'];
						array_push($total_list,$add_to_cart);

						}
						elseif($put_into_session[0]=='4')	{ ///////////  free shipping ///////


						
						$add_to_cart['pro_type'] = $put_into_session[0];
						$add_to_cart['quantity'] = $pro_quantity;
						$add_to_cart['whole_price'] = $put_into_session[1] * $pro_quantity;
						$add_to_cart['pro_weight_all'] = 0;  ///////////// free shipping so make the weight to zero
						
					


						array_push($total_list,$add_to_cart);
			

						}



						

					}
					


					$_SESSION['cart_list'] = $total_list;
					$_SESSION['code'] = 0;
					#echo "##".$_SESSION['code'];

				
			// if shopping cart is not exist
				}
			else 	
				{
				#	echo "session exist, push one more into array";
				// read previous data from session
				$total_list = $_SESSION['cart_list'];


				if (isset($_POST['notice_promotion'])){


				$current_promotion = $_POST['notice_promotion'];//get matched promotion_id

				$put_into_session = check_promotion($current_promotion,$pro_quantity,$add_to_cart['pro_o_price']);


				

				


				if ($put_into_session[0]=='1'){////////////promotion is discount

				$add_to_cart['pro_type'] = $put_into_session[0];
				$add_to_cart['quantity'] = $pro_quantity;
				$add_to_cart['whole_price'] = $put_into_session[1] * $pro_quantity; //caculate whole price for one product and insert into session
				$add_to_cart['o_price'] = $put_into_session[2];
				$add_to_cart['m_price'] = $put_into_session[1];
				$add_to_cart['pro_weight_all'] = $add_to_cart['pro_weight'] * $pro_quantity;
				array_push($total_list,$add_to_cart);	

				}
				elseif($put_into_session[0]=='2'){	/////////////primotion is bug and get

				$add_to_cart['pro_type'] = $put_into_session[0];
				$add_to_cart['quantity'] = $put_into_session[2];
				$add_to_cart['whole_price'] = $add_to_cart['pro_o_price'] * $pro_quantity;
				$add_to_cart['pro_weight_all'] = $add_to_cart['pro_weight'] * $put_into_session[1];
				array_push($total_list,$add_to_cart);	



				}
				elseif($put_into_session[0]=='4')	{ ///////////  free shipping ///////
					
				$add_to_cart['pro_type'] = $put_into_session[0];
				$add_to_cart['quantity'] = $pro_quantity;
				$add_to_cart['whole_price'] = $put_into_session[1] * $pro_quantity;
				$add_to_cart['pro_weight_all'] = 0;  ///////////// free shipping so make the weight to zero


				array_push($total_list,$add_to_cart);	
					

				}

				}


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