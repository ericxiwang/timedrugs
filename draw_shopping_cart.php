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
if (isset($_SESSION['cart_list'])){
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
echo  "<button type='submit' class='btn btn-danger glyphicon glyphicon glyphicon-ok' style='height:50px;margin-right:20px'>&nbsp;提交订单</button>";




echo  "<a href='index.php' class='btn btn-danger glyphicon glyphicon-shopping-cart' style='height:50px;margin-right:20px;padding-top:12px' role='button'>&nbsp;继续购物</a>";
echo "</td></tr>";





echo "</tbody>";
echo "</table>";
}
else
{
	echo "购物车为空";
	echo  "<a href='index.php' class='btn btn-danger glyphicon glyphicon-shopping-cart' style='height:50px;margin-right:20px;padding-top:12px' role='button'>&nbsp;继续购物</a>";


}
#echo $v_data;
#echo "<a href='index.php'>back to index</a>";
echo "</form></div>";
#session_destroy();
$pro_quantity = 0;
} 
//end of draw_cart_list function

?>

<?php

function simple_list(){
include 'db_cn.php';
echo "<div class='col-md-9 col-lg-9 panel panel-danger product_list' style='float:right;padding-top:15px;'>";
/////////////////// attenation: this form is used to direct to final payment page which name is order_confirm.php ////////////////
echo "<form action = 'order_confirm.php' method='POST'>";

echo "<table class='table  table-bordered table-hover table-condensed' >";
echo "<thead><tr><th >产品图片</th>";
echo "<th>产品名称</th>";
echo "<th>产品单价</th>";
echo "<th>产品数量</th>";
echo "<th>产品总价</th>";

echo "</tr></thead><tbody>";
if (isset($_SESSION['user_account'])){
	$current_user_info = $_SESSION['user_account'];
}

#echo count($_SESSION['cart_list']);
if (isset($_SESSION['cart_list'])){
$total_price = 0;
foreach ($_SESSION['cart_list'] as $single_product) {
	$total_price = $total_price + $single_product['whole_price'];
	echo "<tr>";
		echo "<td style='width:120px;'>";//产品图片列
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

		
		

	echo "</tr>";
	# code...
}

$query_user = "SELECT user_country,user_province,user_postcode,user_mailing_address from user_extra_info where user_email='$current_user_info[0]'";
$query_user = mysqli_query($db_connect,$query_user);
$query_user  = mysqli_fetch_assoc($query_user);

echo "<tr><td colspan=6 style='text-align:right'>订单总额：$".$total_price."</tr>";
echo "<input type=hidden id='total_price' name = 'total_price' value='$total_price'/>";
echo "<tr><td colspan=6 style='text-align:center'>请您确认收件人信息和地址</tr>";


echo "<tr><td>收件人姓名</td>";
echo "<td>".$current_user_info[1].$current_user_info[2]."</td>";
echo "<td>电子邮箱</td>";
echo "<td colspan=2>".$current_user_info[0]."</td><tr>";


echo "<td>国家</td>";
echo "<td>".$query_user['user_country']."</td>";
echo "<td>省市地区</td>";
echo "<td colspan=2>".$query_user['user_province']."</td></tr>";
echo "<tr><td>邮编</td>";
echo "<td>".$query_user['user_postcode']."</td>";
echo "<td>邮寄地址</td>";
echo "<td colspan=2>".$query_user['user_mailing_address']."</td></tr>";

echo "<tr><td colspan=6 style='text-align:center'>";
echo  "<button type='submit' class='btn btn-danger glyphicon glyphicon glyphicon-ok' style='height:50px;margin-right:20px'>&nbsp;提交订单</button>";




echo  "<a href='index.php' class='btn btn-danger glyphicon glyphicon-shopping-cart' style='height:50px;margin-right:20px;padding-top:12px' role='button'>&nbsp;继续购物</a>";
#echo  "<a href='index.php' class='btn btn-danger glyphicon glyphicon-shopping-cart' style='height:50px;margin-right:20px;padding-top:12px' role='button'>&nbsp;修改邮寄信息</a>";
echo "</td></tr>";





echo "</tbody>";
echo "</table>";
}
else
{
	echo "购物车为空";
	echo  "<a href='index.php' class='btn btn-danger glyphicon glyphicon-shopping-cart' style='height:50px;margin-right:20px;padding-top:12px' role='button'>&nbsp;继续购物</a>";


}
#echo $v_data;
#echo "<a href='index.php'>back to index</a>";
echo "</form></div>";
#session_destroy();
$pro_quantity = 0;
} 
//end of draw_cart_list function

?>