
<?php
ob_start();
include '../db_cn.php';
include 'basic_html.php';
require '../uuid_gen.php';



if (isset($_POST['order_operate'])){


		if ($_POST['order_operate'] == '提交修改'){

			$new_status = $_POST['ord_status_select'];
			$get_ord_id = $_POST['ord_id'];

			$ord_status_change = "UPDATE ord_record SET ord_status = '$new_status' WHERE ord_uuid = '$get_ord_id'";
			$ord_status_change = mysqli_query($db_connect,$ord_status_change);

			//echo $_POST['ord_id'];
			//echo $_POST['ord_status_select'];

		}
		elseif ($_POST['order_operate'] == '删除订单'){
			$get_ord_id = $_POST['ord_id'];
			$ord_delete = "DELETE FROM ord_record where ord_uuid = '$get_ord_id'";
			$ord_delete = mysqli_query($db_connect,$ord_delete);


			
		}
	}
else{

	echo "";
}


?>


<form method='POST' action='order_mgmt.php'/>
<?php
function ord_list($order_status,$select_by_status){
	global $db_connect;
	// $order_status = [new, paid, shipping, close]

	



	if ($select_by_status == '1'){   ////////// this query is for overall order category list

	$order_list_query = "SELECT ord_uuid,ord_datetime,ord_amount,ord_status,ord_user FROM ord_record WHERE ord_status='$order_status' order by id desc";
	}

	

	elseif ($select_by_status == '0' ) { //////////this query is for search result /////////////////////

	$search_condition = $order_status;
	

	$order_list_query = "SELECT ord_uuid,ord_datetime,ord_amount,ord_status,ord_user FROM ord_record where CONCAT(ord_uuid,ord_user,ord_datetime) like '%$search_condition%' order by id desc";

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

<div class ='row'>
<div class = 'col-lg-12 text-center' >

	<h4>用户订单浏览和修改</h4>

</div>
</div>
<div class ='row'>
<div class='col-lg-12'>
<div class="input-group col-lg-5" style='margin-left:25%'>

      <input type="text" name = 'search_condition' class="form-control" placeholder="输入订单号或用户名称查询">
      <span class="input-group-btn">
        <button class="btn btn-info" name='search_order' type="submit">确认</button>
      </span>



    
</div><br/><!-- /input-group -->




</div>
</div>
<div class='row'>
<div class = 'col-lg-11'>




<ul class="nav nav-tabs " id="product-table">
  <li><a data-toggle="tab" href="#new">		<h4 class="text-danger glyphicon glyphicon-exclamation-sign">	新提交订单</h4></a>		</li>
  <li><a data-toggle="tab" href="#paid">	<h4 class="text-success glyphicon glyphicon-check">			已付款订单</h4></a>	</li>
  <li><a data-toggle="tab" href="#shipping"><h4 class="text-info glyphicon glyphicon-gift">				已发货订单</h4></a>	</li>
  <li><a data-toggle="tab" href="#close">	<h4 class="text-muted glyphicon glyphicon-off">			已关闭订单</h4></a>	</li>
</ul>

<div class="tab-content">
  <div id="new" class="tab-pane fade text-center" >
    <h3>新订单</h3>
 	<?php ord_list('new','1'); ?>
  </div>

  <div id="paid" class="tab-pane fade text-center">
    <h3>已付款订单</h3>
   	<?php ord_list('paid','1'); ?>
  </div>

  <div id="shipping" class="tab-pane fade text-center">
    <h3>已发货订单</h3>
   	<?php ord_list('shipping','1'); ?>
  </div>

  <div id="close" class="tab-pane fade text-center">
    <h3>已关闭订单</h3>
   	<?php ord_list('close','1'); ?>
  </div>

</div>
<?php
	if (isset($_POST['search_order'])){
		$ord_status = $_POST['search_condition'];
		ord_list($ord_status,'0');


	}



////////////////////////////////////// form end ////////////////////////////////

function selected_order(){
global $db_connect;
if (isset($_POST['check_order']))

	{  ////////////////check order is exist means button is clicked ////////////



	$pro_code = $_POST['check_order'];

	//echo "***".$pro_code;



	$query_one_order = "SELECT pro_name,pro_img,pro_o_price,pro_m_price,pro_quantity,pro_amount,pro_pro_type FROM ord_product WHERE ord_uuid = '$pro_code'";
	$query_one_order = mysqli_query($db_connect,$query_one_order);

	$order_basic_info = "SELECT ord_address,ord_amount,ord_postcode,ord_user,ord_shipping_fee,ord_status,ord_shipping_method,ord_email FROM ord_record WHERE ord_uuid ='$pro_code' ";
	$order_basic_info = mysqli_query($db_connect,$order_basic_info);
	$order_basic_info = mysqli_fetch_assoc($order_basic_info);

	$current_user_email = $order_basic_info['ord_email'];
	$order_user_info = "SELECT user_phone from user_extra_info where user_email = '$current_user_email' ";
	$order_user_info = mysqli_query($db_connect,$order_user_info);
	$order_user_info = mysqli_fetch_assoc($order_user_info);
	



	echo "<input name = 'ord_id' type='hidden' value = '$pro_code'>";

	echo "<div class='text-danger text-center'><h4>订单编号: ".$pro_code."</h4></div>";
	echo "<div class='col-lg-8'>";

	echo "<div class='progress active' style='height:40px'>
  		<div class='progress-bar progress-bar-success' style='width:25%;padding:10px'>
  		<span class='glyphicon glyphicon-info-sign' style='font-size:15px'>订单提交</span> 
  		</div>";


 ///////////////////////////////// here under are the order status volume bar suit /////////////////	
    	if (($order_basic_info['ord_status'] == 'paid') 
    		or ($order_basic_info['ord_status'] == 'shipping') 
    		or ($order_basic_info['ord_status'] == 'close'))
    	{
    		echo "<div class='progress-bar progress-bar-success' style='width:25%;padding:10px'>";
  			echo "<span class='glyphicon glyphicon-ok-sign' style='font-size:15px'>确认付款</span> ";
  			echo "</div>";
    	}
    	else{
    		echo "	<div class='progress-bar  progress-bar-warning progress-bar-striped' role='progressbar' style='width: 25%;padding:10px'>";
    		echo "确认付款";
    		echo "</div>";
    	}


    	if (($order_basic_info['ord_status'] == 'shipping') or ($order_basic_info['ord_status'] == 'close'))
    	{
    		echo "<div class='progress-bar progress-bar-success' style='width:25%;padding:10px'>";
  			echo "<span class='glyphicon glyphicon-gift' style='font-size:15px'>货物已发</span> ";
  			echo "</div>";

    	}
    	else{
    		echo "<div class='progress-bar  progress-bar-warning progress-bar-striped' role='progressbar' style='width: 25%;padding:10px'>";
    		echo "货物已发";
  			echo "</div>";

    	}
    	if ($order_basic_info['ord_status'] == 'close'){
    		echo "<div class='progress-bar progress-bar-success' style='width:25%;padding:10px'>";
  			echo "<span class='glyphicon glyphicon-off' style='font-size:15px'>订单关闭</span> ";
  			echo "</div>";

    	}
    	else{
			echo "<div class='progress-bar  progress-bar-warning progress-bar-striped' role='progressbar' style='width: 25%;padding:10px'>";
    		echo "订单关闭";
  			echo "</div>";

    	}


//////////////////////////////// order volume bar end ///////////////////////////////

    	
  	
  		
  		

	echo "</div>";
	echo "</div>";
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

	echo "<tr><td>邮寄地址:</td><td colspan=3>".$order_basic_info['ord_address']."</td>";
	echo "<td>邮寄方式: ".$order_basic_info['ord_shipping_method']."</td></tr>";

	echo "<tr><td>邮编:</td><td>".$order_basic_info['ord_postcode']."</td>";
	echo "<td>收件人:</td><td colspan=2>".$order_basic_info['ord_user']."</td>";

	echo "<tr><td>电子邮件:</td><td>".$order_basic_info['ord_email']."</td>";

	echo "<td>联系电话:</td><td colspan=2>".$order_user_info['user_phone']."</td></tr>";

	echo "</table>";
	echo "<div class='text-center'>";
	////////////////////////////////////////////   order status modification start /////////////////////
	echo "<div class='col-lg-2'>";
	
	if ($order_basic_info['ord_status'] != 'close'){
		echo "选择要修改的订单状态:";
		echo "<select name = 'ord_status_select' class='form-control'>";
		echo "<option value = '$order_basic_info[ord_status]'>$order_basic_info[ord_status]</option>";
		echo "<option value = 'new'>New</option>";
		echo "<option value = 'paid'>paid</option>";
		echo "<option value = 'shipping'>shipping</option>";
		echo "<option value = 'close'>close</option>";
		echo "</select>";
		echo "<br/><input name = 'order_operate' type='submit' class='btn btn-success' value='提交修改'>&nbsp;&nbsp;";
		echo "<a href='order_mgmt.php' role='button' class='btn btn-primary'>返回列表</a>";

	}
	elseif($order_basic_info['ord_status'] = 'close'){
		echo "<br/><input name = 'order_operate'type='submit' class='btn btn-success' value='删除订单'>&nbsp;&nbsp;";
		echo "<a href='order_mgmt.php' role='button' class='btn btn-primary'>返回列表</a>";
	}
	echo "</div><br/>";




	


	echo "</div>";
	}
else{

	echo "<div class='text-center'><h3>选择要查询订单状态标签或者输入关键字查询</h3></div>";

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
</form> 
</div>


</div>