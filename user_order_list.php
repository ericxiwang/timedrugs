<?php
include 'nav_menu_banner.php';


?>
<div class="col-md-9 col-lg-9 panel panel-danger product_list" >
<?php

function show_order_list(){
global $db_connect;
$get_user_account = $_SESSION['user_account'];
$get_user_account = $get_user_account['0'];
////////////////////////////// new status is the highest prority to displayed ///////////////////


$order_list_query = "SELECT ord_uuid,ord_datetime,ord_amount,ord_status FROM ord_record WHERE ord_email='$get_user_account' and ord_status='new'";
$db_execute = mysqli_query($db_connect,$order_list_query);


echo "<form method='POST' action='user_order_list.php'/>";
echo "<table class='table  table-bordered table-hover table-condensed' >";
echo "<thead><tr style='width:30px;'><th>订单号</th><th>订单日期</th><th>订单金额</th><th>订单状态</th>";


foreach ($db_execute as $db_cursor) {
	echo "<tr>";
	echo "<td>".$db_cursor['ord_uuid']."</td>";
	echo "<td>".$db_cursor['ord_datetime']."</td>";
	echo "<td>".$db_cursor['ord_amount']."</td>";
	echo "<td>".$db_cursor['ord_status']."</td>";
	echo "<td><button type='submit' name='check_order' value='$db_cursor[ord_uuid]' class='btn btn-danger' style='height:30px;margin-right:20px'>&nbsp;订单详情</button></td>";

	echo "</tr>";
}



echo "</form>";

} ///////////////function end////////////




function selected_order(){
global $db_connect;
if (isset($_POST['check_order'])){  ////////////////check order is exist means button is clicked ////////////



$pro_code = $_POST['check_order'];

//echo "***".$pro_code;



$query_one_order = "SELECT pro_name,pro_img,pro_o_price,pro_m_price,pro_quantity,pro_amount,pro_pro_type FROM ord_product WHERE ord_uuid = '$pro_code'";
$query_one_order = mysqli_query($db_connect,$query_one_order);

$order_basic_info = "SELECT ord_address,ord_amount,ord_postcode,ord_user,ord_shipping_fee FROM ord_record WHERE ord_uuid ='$pro_code' ";
$order_basic_info = mysqli_query($db_connect,$order_basic_info);
$order_basic_info = mysqli_fetch_assoc($order_basic_info);



//echo "<div class='danger'><p>订单编号: ".$pro_code."</p></div>";
echo "<table class='table  table-bordered table-hover table-condensed' >";

echo "<thead><tr style='width:30px;'><th>产品图片</th>";
echo "<th>产品名称</th>";
echo "<th>产品单价</th>";
echo "<th>产品数量</th>";
echo "<th>产品总价</th>";
echo "</tr></thead>";

foreach ($query_one_order as $single_product) {
	
	echo "<tr>";
		echo "<td>";//产品图片列
			echo" <img src='$single_product[pro_img]' height=100 width=100/>";
		echo "</td>";
		echo "<td>";//产品名称列
			echo $single_product['pro_name'];
		echo "</td>";
		echo "<td>";//产品单价列
		if ($single_product['pro_pro_type'] == '1'){
			
			echo "<del>$".$single_product['pro_o_price']."</del>";
			echo "<br/>";
			echo "$".$single_product['pro_m_price'];

		}
		else{
			echo "$".$single_product['pro_o_price'];

		}
		echo "</td>";
		echo "<td>";//购买数量列
			#echo $single_product['pro_code'];
			echo $single_product['pro_quantity'];
		echo "</td>";
		echo "<td>";//产品总价
			
			echo $single_product['pro_amount'];
		echo "</td>";

		
		

	echo "</tr>";

	# code...
}
////////////product list end //////
echo "<tr><td>邮费:</td><td>$".$order_basic_info['ord_shipping_fee']."</td>";
echo "<td>订单总价:</td><td colspan=2>$".$order_basic_info['ord_amount']."</td></tr>";

echo "<tr><td>邮寄地址:</td><td colspan=4>".$order_basic_info['ord_address']."</td></tr>";

echo "<tr><td>邮编:</td><td>".$order_basic_info['ord_postcode']."</td>";
echo "<td>收件人:</td><td colspan=2>".$order_basic_info['ord_user']."</td>";

echo "</table>";
echo "<a href='user_order_list.php' role='button' class='btn btn-danger'>返回列表</a>";
}

}  //////////functino selected order end //////////////



/////////////////////////////////////////////////

if (!(isset($_POST['check_order']))){

	show_order_list();
}

else{
	selected_order();
}

?>


</body>
</html>