<script type="text/javascript">
function final_amount(){
	//var shipping_t = get_shipping_fee;
	var shipping_radio = document.getElementsByName('shipping_fee');
	// alert(eless[i].checked+eless[i].name+eless[i].id); 
	for(var i=0;i<shipping_radio.length;i++) { 
		// alert(eless[i].checked+eless[i].name+eless[i].id); 
		if(shipping_radio[i].checked) 
		{ 
		var shipping_radio = shipping_radio[i].value;
		break; 
		} 
	} 

	var get_tax_rate = (document.getElementById('tax_rate').value)*0.01 + 1; //// tax rate is here

	var get_goods_fee = document.getElementById('total_price').value;	///all product before tax


	var final_return = ((parseInt(get_goods_fee)*get_tax_rate) + parseInt(shipping_radio)*1.12).toFixed(1);

	document.getElementById("final_pay").innerHTML = "$" + final_return;
	document.getElementById("hidden_amount").value = final_return;
	document.getElementById("submit").disabled = false;
	

	


}


</script>

<?php
/////////////////////////////////////// function for tax and shipping fee calculate as follow ////////////////
function tax_rate_shipping_fee($country){


global $db_connect;
$current_country = $country;
$load_tax_rate = "SELECT tax_rate from tax_rate where country='$current_country'";
$load_tax_rate =mysqli_query($db_connect,$load_tax_rate);
$load_tax_rate = mysqli_fetch_assoc($load_tax_rate);


$load_shipping_fee = "SELECT shipping_type,shipping_basefee,shipping_extrafee from shipping_fee where shipping_country='$current_country'";
$load_shipping_fee = mysqli_query($db_connect,$load_shipping_fee);

	foreach ($load_shipping_fee as $shipping_option) {


		#echo $shipping_option['shipping_basefee'];
		# code...
	}

return array($load_tax_rate['tax_rate'],$load_shipping_fee);
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////                            					   /////////////////
////////////////////////////////////////// new draw list function generator without login //////////////////
//////////////////////////////////////////												  //////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////
function draw_chart_list(){

echo "<div class='col-md-9 col-lg-9 panel panel-danger product_list' style='float:right;padding-top:15px;'>";
echo "<form action = 'user_payment.php' method='POST' enctype='multipart/form-data'>";



#echo count($_SESSION['cart_list']);
if (isset($_SESSION['cart_list'])){

	echo "<table class='table  table-bordered table-hover table-condensed'>";
echo "<thead><tr style='width:30px;'><th>产品图片</th>";
echo "<th>产品名称</th>";
echo "<th>产品单价</th>";
echo "<th>产品数量</th>";
echo "<th>产品总价</th>";
echo "<th>修改订单</th>";
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

			if($single_product['pro_type'] == '1'){
				echo "<del>$".$single_product['o_price']."</del><br/>";
				echo "$".$single_product['m_price']."<br/>";

			}

			
			elseif ($single_product['pro_type'] == '2'){

			echo "$".$single_product['pro_o_price'];
			}

			elseif ($single_product['pro_type'] == '4'){
				echo "$".$single_product['pro_o_price'];
			}
			
			else
			{

				echo "$".$single_product['pro_o_price'];			
			}

			
		echo "</td>";
		echo "<td>";//购买数量列
			#echo $single_product['pro_code'];
			echo $single_product['quantity'];
		echo "</td>";
		echo "<td>";//产品总价

			if ($single_product['pro_type'] == '4'){

				echo "$".$single_product['whole_price'];
				echo "<p>免运费！</p>";
			}
			else{

				echo "$".$single_product['whole_price'];
			}
			
			
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
	echo "<div class='glyphicon glyphicon-shopping-cart col-lg-12 text-center'><h3>当前购物车为空</h3></div><br/>";
	echo  "<div class='col-lg-12 text-center'><a href='index.php' class='btn btn-danger glyphicon glyphicon-shopping-cart' style='height:50px;margin-right:20px;padding-top:12px' role='button'>&nbsp;继续购物</a></div><br/><br/><br/><br/><br/>";


}
#echo $v_data;
#echo "<a href='index.php'>back to index</a>";
echo "</form></div>";
#session_destroy();
$pro_quantity = 0;
} 

//end of draw_cart_list function
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////    /////////////////////////////////////////////////////////////////
//////////////////////////////////////////////     end      ////////////////////////////////////////////////////////////
///////////////////////////////////////////////////    /////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>



<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////        /////////////////////////////////////////////
//////////////////////////////////////////////////////// draw list with user info //////////////////////////////////////
///////////////////////////////////////////////////////////////////        /////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function simple_list(){
include 'db_cn.php';
echo "<div class='col-md-9 col-lg-9 panel panel-danger product_list' style='float:right;padding-top:15px'>";
/////////////////// attenation: this form is used to direct to final payment page which name is order_confirm.php ////////////////

echo "<form action='order_confirm.php' method='POST'>";
//echo "<form action='order_confirm.php' method='POST' enctype='multipart/form-data'>";
echo "<table class='table  table-bordered table-hover table-condensed'>";
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
$total_weight = 0;
foreach ($_SESSION['cart_list'] as $single_product) {

	$total_price = $total_price + $single_product['whole_price'];

	
	$total_weight = $total_weight + $single_product['pro_weight_all'];

	echo "<tr>";
		echo "<td style='width:120px;'>";//产品图片列
			echo" <img src='$single_product[pro_img]' height=80 width=80/>";
		echo "</td>";
		echo "<td>";//产品名称列
			echo $single_product['pro_name'];
		echo "</td>";
		echo "<td>";//产品单价列
			if($single_product['pro_type'] == '1'){
				echo "<del>$".$single_product['o_price']."</del><br/>";
				echo "$".$single_product['m_price']."<br/>";

			}


			elseif ($single_product['pro_type'] == '2'){

			echo "$".$single_product['pro_o_price'];
			}
			elseif ($single_product['pro_type'] == '4'){
				echo "$".$single_product['pro_o_price'];
			}
			else{

				echo "$".$single_product['pro_o_price'];
			}



		echo "</td>";
		echo "<td>";//购买数量列
				
			#echo $single_product['pro_code'];
			
			echo $single_product['quantity'];

		echo "</td>";
		echo "<td>";//产品总价
			
			if ($single_product['pro_type'] == '4'){

				echo "$".$single_product['whole_price'];
				echo "<p>免运费！</p>";
			}
			else{

				echo "$".$single_product['whole_price'];
			}
		echo "</td>";
		//echo "<td>";//产品总重
			
			//echo $single_product['pro_weight_all'];
		//echo "</td>";

		
		

	echo "</tr>";
	# code...
}

/////////////////////////////////////////// load user extra info as follow .////////////////////
$query_user = "SELECT user_country,user_province,user_postcode,user_mailing_address from user_extra_info where user_email='$current_user_info[0]'";
$query_user = mysqli_query($db_connect,$query_user);
$query_user  = mysqli_fetch_assoc($query_user);
//////////////////////////////////////// load end //////////////////////////
$tax_shipping_display = tax_rate_shipping_fee($query_user['user_country']);
echo "<input type='hidden' id='tax_rate' value='$tax_shipping_display[0]'/>";










echo "<tr>";
echo "<td colspan=2 style='text-align:right'>商品总重量: ".$total_weight."公斤</td>";
echo "<td colspan=4 style='text-align:right'>商品税前总价: $".$total_price;
echo "<input type='hidden' id = 'total_price' value='$total_price'>";
echo "</tr>";
function draw_radio($user_country_input,$tax_shipping_display_input,$total_weight)

{
	echo "<td colspan=4 style='text-align:right'>商品寄送方式:<br/> ";
	////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////// all pruducts are free shipping ////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////
	if ($total_weight == 0){
		echo "全部产品为包邮，平邮方式寄送";
		echo "<br/><input type='radio' onClick='final_amount()' id ='common' name = 'shipping_fee' value = 0>普通平邮";
	}

	////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////// normal order content///////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////

	elseif ($total_weight > 0)
	{


	

			$user_country = $user_country_input;
			$tax_shipping_display = $tax_shipping_display_input;

			foreach ($tax_shipping_display as $shipping_method) 
			{

				///////////////////// basic shipping ///////////
				
				if ($shipping_method['shipping_type'] == 'common')
				{
				echo "<input type='hidden' value='common' name='shipping_method'/>";
				echo "<div class='radio'>";
					if ($total_weight <=1 ){
						$shipping_fee_option = $shipping_method['shipping_basefee'];
				


					}
					else if ($total_weight > 1){
						$shipping_fee_option = $shipping_method['shipping_basefee'] + ($total_weight-1)*$shipping_method['shipping_extrafee'];//////普通平邮邮费计算
				


					}
					else{

						echo "no one matched";
					}
				
				
				echo "<input type='radio' onClick='final_amount()' id ='common' name = 'shipping_fee' value='$shipping_fee_option'>普通平邮 $ ".$shipping_fee_option;
				echo "</div>";
				}

				//////////////////////////extra shipping ///////////
				elseif ($shipping_method['shipping_type'] == 'extra')
				{
				echo "<input type='hidden' value='extra' name='shipping_method'/>";
				echo "<div class='radio'>";
				
					if ($total_weight <= 1)
					{
						$shipping_fee_option = $shipping_method['shipping_basefee'];

					}
					else if ($total_weight > 1)
					{
						$shipping_fee_option = $shipping_method['shipping_basefee'] + ($total_weight-1)*$shipping_method['shipping_extrafee'];/////特快专递邮费计算

					}
				echo "<input type='radio' onClick='final_amount()' id ='extra' name = 'shipping_fee' value='$shipping_fee_option'>特快专递 $ ".$shipping_fee_option;
				
				echo "</div>";
				}
			}
	}

}
if ($query_user['user_country'] = "Canada") {
	echo "</td><td>";
	draw_radio('Canada',$tax_shipping_display[1],$total_weight);

	echo "</td>";
}


elseif($query_user['user_country'] = "China"){
	//echo "<td colspan=4 style='text-align:right'>商品寄送方式:<br/> ";
	echo "</td><td>";
	draw_radio('China',$tax_shipping_display[1],$total_weight);

	echo "</td>";
}
elseif($query_user['user_country'] = "USA"){
	//echo "<td colspan=4 style='text-align:right'>商品寄送方式:<br/> ";
	echo "</td><td>";
	draw_radio('USA',$tax_shipping_display[1],$total_weight);

		echo "</td>";
	}

	/*elseif($query_user['user_country'] == 'other'){
		echo "<td colspan=4 style='text-align:right'>商品寄送方式:<br/> ";

		foreach ($tax_shipping_display[1] as $shipping_method) {
			
			if ($shipping_method['shipping_type'] == 'common'){
			echo "<div class='radio'>";
			$shipping_fee_option = $shipping_method['shipping_basefee'] + ($total_weight-1)*$shipping_method['shipping_extrafee'];
			
			echo "<input type='radio' name = 'shipping_fee' value=$shipping_fee_option>普通平邮 $ ".$shipping_fee_option;
			echo "</div>";
			}
			elseif ($shipping_method['shipping_type'] == 'extra'){
			echo "<div class='radio'>";
			$shipping_fee_option = $shipping_method['shipping_basefee'] + ($total_weight-1)*$shipping_method['shipping_extrafee'];
			echo "<input type='radio' name = 'shipping_fee' value=$shipping_fee_option>特快专递 $ ".$shipping_fee_option;
			echo "</div>";
			}
			
		}




	echo "</td>";
}
*/
else
{
	echo "error!";
	echo $query_user['user_country'];
}

echo "</tr>";

$total_price = number_format($total_price*(1+floatval($tax_shipping_display[0])/100),1);

//echo "<td colspan=3 style='text-align:right'>税率:".$tax_shipping_display[0]."%";
//echo "<td colspan=3 style='text-align:right'>税后商品总额:$".$total_price;

echo "</tr>";
echo "<tr>";
	echo "<td colspan=6 align=right>";
	echo "订单总额（含税含运费）";
	echo "<p id = 'final_pay' style='font-size:160%''></p>";
	echo "<input name = 'hidden_amount' id = 'hidden_amount' type='hidden' value=''/>";
	echo "</td>";
echo "</tr>";


//echo "<input type=hidden id='total_price' name = 'total_price' value='$total_price'/>";
echo "<tr><td colspan=6 style='text-align:center'>请您确认收件人信息和地址</td></tr>";


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
echo  "<button id='submit' type='submit' class='btn btn-danger glyphicon glyphicon glyphicon-ok' style='height:50px;margin-right:20px' disabled >&nbsp;提交订单</button>";




echo  "<a href='index.php' class='btn btn-danger glyphicon glyphicon-shopping-cart' style='height:50px;margin-right:20px;padding-top:12px' role='button'>&nbsp;继续购物</a>";
#echo  "<a href='index.php' class='btn btn-danger glyphicon glyphicon-shopping-cart' style='height:50px;margin-right:20px;padding-top:12px' role='button'>&nbsp;修改邮寄信息</a>";
echo "</td></tr>";





echo "</tbody>";
echo "</table>";
$full_name = strval($current_user_info[1]) . strval($current_user_info[2]);
echo "<input name='full_name' type = hidden value = $full_name/>";
#echo "<input type = hidden value = $query_user['user_country']>";
//echo $query_user['user_mailing_address'];
$full_address = $query_user['user_country']." ".$query_user['user_province']." ".$query_user['user_mailing_address'];  /////////// generate full address string ///////////

$full_address = urlencode($full_address);


echo "<input name = 'full_address' type = hidden value = $full_address/>";
echo "<input name = 'post_code' type = hidden value = $query_user[user_postcode]>";
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