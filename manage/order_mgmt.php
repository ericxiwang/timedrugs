
<?php
ob_start();
include '../db_cn.php';
include 'basic_html.php';
require '../uuid_gen.php';


?>



<?php
function ord_list($order_status,$select_by_status){
	global $db_connect;
	// $order_status = [new, paid, shipping, close]



	if ($select_by_status == '1'){

	$order_list_query = "SELECT ord_uuid,ord_datetime,ord_amount,ord_status,ord_user FROM ord_record WHERE ord_status='$order_status' order by id desc";
	}

	

	elseif ($select_by_status == '0' ) {

	$search_condition = $order_status;
	echo "####".$search_condition;

	$order_list_query = "SELECT ord_uuid,ord_datetime,ord_amount,ord_status,ord_user FROM ord_record where CONCAT(ord_uuid,ord_user) like '%$search_condition%' order by id desc";

	}





	$db_execute = mysqli_query($db_connect,$order_list_query);
	echo "<table class='table  table-bordered table-hover table-condensed'>";

	echo "<thead><tr><th>订单号</th><th>订单日期</th><th>订单金额</th><th>订单状态</th><th>用户名称</th></tr></thead>";
	foreach ($db_execute as $one_order) {
		echo "<tr>";
			echo "<td>";
			echo $one_order['ord_uuid'];
			echo "</td>";

			echo "<td>";
			echo $one_order['ord_datetime'];
			echo "</td>";

			echo "<td>";
			echo $one_order['ord_amount'];
			echo "</td>";

			echo "<td>";
			echo $one_order['ord_status'];
			echo "</td>";

			echo "<td>";
			echo $one_order['ord_user'];
			echo "</td>";
			echo "<td>

			<button type='submit' name='check_order' value='$one_order[ord_uuid]' class='btn btn-danger' style='height:30px;margin-right:20px'>&nbsp;订单详情</button></td>";







		echo "</tr>";


		# code...
	}
	echo "</table>";


}
?>
<form method='POST' action='order_mgmt.php'/>
<div class ='row'>
<div class='col-lg-12'>
<div class="input-group col-lg-5">
      <input type="text" name = 'search_condition' class="form-control" placeholder="输入订单号或用户名称查询">
      <span class="input-group-btn">
        <button class="btn btn-warning" name='search_order' type="submit">确认</button>
      </span>



    
</div><!-- /input-group -->




</div>
</div>
<div class='row'>
<div class = 'col-lg-11'>




<ul class="nav nav-tabs " id="product-table">
  <li class='active'><a data-toggle="tab" href="#new">新提交订单</a></li>
  <li><a data-toggle="tab" href="#paid">已付款订单</a></li>
  <li><a data-toggle="tab" href="#shipping">已发货订单</a></li>
  <li><a data-toggle="tab" href="#close">已关闭订单</a></li>
</ul>

<div class="tab-content active">
  <div id="new" class="tab-pane fade" >
    <h3>新订单</h3>
 	<?php ord_list('new','1'); ?>
  </div>

  <div id="paid" class="tab-pane fade">
    <h3>已付款订单</h3>
   	<?php ord_list('paid','1'); ?>
  </div>

  <div id="shipping" class="tab-pane fade">
    <h3>已发货订单</h3>
   	<?php ord_list('shipping','1'); ?>
  </div>

  <div id="close" class="tab-pane fade">
    <h3>已关闭订单</h3>
   	<?php ord_list('close','1'); ?>
  </div>

</div>
<?php
	if (isset($_POST['search_order'])){
		$ord_status = $_POST['search_condition'];
		ord_list($ord_status,'0');


	}


?>
</form>
<?php
/*function ord_detail(){
	global $db_connect;



	if (isset($_POST['check_order'])){
		$current_ord_id = $_POST['check_order'];
		$selected_order = "SELECT pro_uuid,pro_name,pro_img,pro_o_price,pro_m_price,pro_quantity,ord_uuid,pro_pro_type from ord_product where ord_uuid = '$current_ord_id'";
		$selected_order = mysqli_query($db_connect,$selected_order);


		foreach ($selected_order as $one_product) {
			echo $one_product['pro_uuid']."<br/>";
			echo $one_product['pro_name']."<br/>";
			# code...
		}

	
	}
}

ord_detail();*/
function selected_order(){
global $db_connect;
if (isset($_POST['check_order']))

{  ////////////////check order is exist means button is clicked ////////////



$pro_code = $_POST['check_order'];

//echo "***".$pro_code;



$query_one_order = "SELECT pro_name,pro_img,pro_o_price,pro_m_price,pro_quantity,pro_amount,pro_pro_type FROM ord_product WHERE ord_uuid = '$pro_code'";
$query_one_order = mysqli_query($db_connect,$query_one_order);

$order_basic_info = "SELECT ord_address,ord_amount,ord_postcode,ord_user,ord_shipping_fee FROM ord_record WHERE ord_uuid ='$pro_code' ";
$order_basic_info = mysqli_query($db_connect,$order_basic_info);
$order_basic_info = mysqli_fetch_assoc($order_basic_info);



echo "<div class='danger'><p>订单编号: ".$pro_code."</p></div>";
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
			echo" <img src='../$single_product[pro_img]' height=100 width=100/>";
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
echo "<a href='order_mgmt.php' role='button' class='btn btn-danger'>返回列表</a>";
}
/*
elseif (isset($_POST['search_order'])){
	$search_condition = $_POST['search_condition'];

	$search_order = "SELECT ord_uuid,ord_datetime,ord_amount,ord_status,ord_user FROM ord_record where CONCAT(ord_uuid,ord_user) like '%$search_condition%' order by id desc";
	$search_order = mysqli_query($db_connect,$search_order);
	print_r($search_order);
}
*/
} 
selected_order();
?>

</div>


</div>