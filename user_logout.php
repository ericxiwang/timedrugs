<?php
include 'nav_menu_banner.php';
?>
<?php
if (isset($_GET['clean_chart'])){
	session_destroy();
	echo "logout";
	header("Location: index.php");
}
else{

draw_chart_list();	
}





function draw_chart_list(){



echo "<div class='col-md-9 col-lg-9 panel panel-danger product_list' style='float:right;padding-top:15px;'>";




if (isset($_SESSION['cart_list'])){





echo "<table class='table  table-bordered table-hover table-condensed' >";
echo "<thead><tr style='width:30px;'>";
echo "<tr><th colspan=5>以下是还未提交订单，登出用户会清空所有未提交订单信息</th></tr>";

echo "<th>产品图片</th>";
echo "<th>产品名称</th>";
echo "<th>产品单价</th>";
echo "<th>产品数量</th>";
echo "<th>产品总价</th>";
#echo "<th>修改订单</th>";
echo "</tr></thead><tbody>";
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

		#echo "<td>";
		
			#echo "<a href='shopping_cart_list.php?product_id=$single_product[pro_code]' role='button' class='btn btn-danger'>删除商品</a>";

            
		#echo "</td>";
		

	echo "</tr>";
	# code...
}
echo "<tr><td colspan=5>";
echo "订单总额：$".$total_price;
echo  "<a href='user_logout.php?clean_chart=1' class='btn btn-danger glyphicon glyphicon-shopping-cart' style='height:50px;margin-right:20px;padding-top:12px' role='button'>&nbsp;确认登出</a>";




echo  "<a href='index.php' class='btn btn-danger glyphicon glyphicon-shopping-cart' style='height:50px;margin-right:20px;padding-top:12px' role='button'>&nbsp;继续购物</a>";
echo "</td></tr>";





echo "</tbody>";
echo "</table>";
}
else{

	session_destroy();
	echo "logout";
	header("Location: index.php");
}


############# if session is not set , redirect to index.php

	

}



?>