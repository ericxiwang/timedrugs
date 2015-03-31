<?php
include 'nav_menu_banner.php';
?>
<?php

session_start();


if (isset($_GET['product_id'])){ //receive the pro_code from current, if it's exist, do as follow

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

else{	//else, used to receive data from previous page(product_introduce.php)
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


}draw_chart_list();
}
else{
	draw_chart_list();

	echo "购物车为空";

}
}

?>

	
<?php
function draw_chart_list(){

echo "<div class='col-md-9 col-lg-9 panel panel-danger product_list' style='float:right;padding-top:15px;'>";
echo "<form action = 'user_payment.php' method='POST'>";

echo "<table class='table  table-bordered table-hover table-condensed' >";
echo "<thead><tr style='width:30px;'><th>产品图片</th>";
echo "<th>产品名称</th>";
echo "<th>产品单价</th>";
echo "<th>产品数量</th>";
echo "<th>产品总价</th>";
echo "<th>修改订单</th>";
echo "</tr></thead><tbody>";

#echo count($_SESSION['cart_list']);

$total_price = 0;
foreach ($_SESSION['cart_list'] as $single_product) {
	$total_price = $total_price + $single_product['whole_price'];
	echo "<tr>";
		echo "<td>";//产品图片列
			echo" <img src='$single_product[pro_img]' height=100 width=100/>";
		echo "</td>";
		echo "<td>";//产品名称列
			echo $single_product['pro_name'];
		echo "</td>";
		echo "<td>";//产品单价列
			echo $single_product['pro_o_price'];
		echo "</td>";
		echo "<td>";//购买数量列
			#echo $single_product['pro_code'];
			echo $single_product['quantity'];
		echo "</td>";
		echo "<td>";//产品总价
			
			echo $single_product['whole_price'];
		echo "</td>";

		echo "<td>";
		
			echo "<a href='shopping_cart_list.php?product_id=$single_product[pro_code]' role='button' class='btn btn-danger'>删除商品</a>";

            
		echo "</td>";
		

	echo "</tr>";
	# code...
}
echo "<tr><td colspan=6>";
echo "订单总额：$".$total_price;
echo  "<button type='submit' class='btn btn-danger glyphicon glyphicon-shopping-cart' style='height:50px;margin-right:20px'>&nbsp;提交订单</button>
        </div>";
echo "</td></tr>";





echo "</tbody>";
echo "</table>";
#echo $v_data;
echo "<a href='index.php'>back to index</a>";
echo "</form></div>";
#session_destroy();
$pro_quantity = 0;
} 
//end of draw_cart_list function
?>



</body>
</html>