<?php
ob_start();
include '../db_cn.php';
include 'basic_html.php';
require '../uuid_gen.php';

?>
<script>

function change_select_color(value){
	current_name = value;
	//alert(current_name);
	current_select = document.getElementsByName(current_name)[0];


	//current_select.style.backgroundColor = '#eeeeee';
	current_select.classList.add('btn-danger');

}

</script>



<div class = 'col-lg-12' >
<form method='POST' action='promotion_select.php' >
<input class='btn btn-success'type='submit' name = 'update_promotion' value='确认提交修改'/>
<?php 
function load_page(){
	global $db_connect;
	//////////////////////// if there is no precondition , that means a new page loaded ////////////////
	if ((!(isset($_POST['pro_edit']))) and (!(isset($_POST['update_confirm']))))
	{
	echo "<div class='col-lg-6' style='text-align:center'><p><h3>产品编辑</h3></p></div>";
	$load_all_product = "SELECT pro_code,pro_img,pro_name,pro_o_price,pro_brand,pro_weight,pro_spec,pro_onsell,pro_code,promotion_id from product_info order by id desc";
	$load_all_product = mysqli_query($db_connect,$load_all_product);




	echo "<div ><table class='table table-condensed' style='margin:0px;'>";
	echo "<tr ><thead ><tr>
			<th style='width:6%'>图片</th> 
			<th style='width:10%'>产品名称</th> 
			<th style='width:10%'>产品单价</th> 

			<th style='width:10%'>产品重量</th> 

			<th style='width:8%'>在售状态</th> 
			<th style='width:8%'>勾选商品</th>
			<th style='width:10%'>促销列表</th>

			</thead></tr>";
	echo "</table></div>";

	echo "<div style='height:800px;overflow-y:scroll;'>";
	echo "<table class='table table-hover'>";
	//echo "<tr><thead><tr><th>图片</th><td>产品名称</th><th>产品单价</th><th>品牌名称</th><th>产品重量</th><th>产品规格</th><th>在售状态</th></thead></tr>";


	foreach ($load_all_product as $one_product) {
		
		echo "<tr >";
		echo "<td style='width:8%'>";
		echo "<img class='img-thumbnail preview-pic' src='../$one_product[pro_img]'  style='height:60px;width:60px'/>";
		echo "</td>";
		echo "<td style='width:15%'>".$one_product['pro_name']."</td>";
		echo "<td style='width:15%'>".$one_product['pro_o_price']."</td>";

		echo "<td style='width:15%'>".$one_product['pro_weight']."</td>";

		if ($one_product['pro_onsell'] == 1){
			echo "<td style='width:10%'><input type='checkbox' checked disabled></td>";
		}
		else {
			echo "<td style='width:10%'><input type='checkbox' disabled></td>";
		}


		echo "<td style='width:10%'><input name = 'select_id[]' type='checkbox' value = '$one_product[promotion_id]'></td>";

		echo "<td style='width:12%'>";
		select_promotion($one_product['promotion_id'],$one_product['pro_code']);
		echo "</td>";

		

		
		echo "</tr>";







		

	}
	echo "</table>";
	echo "</div>";

	}
	////////////////////////////////////////////////////// product list display end //////////////////////////




	////////////////////////////////////////////////////// product update page start ////////////
	
}
load_page();
?>
</div>



<?php

function select_promotion($current_promotion_id,$pro_code){

global $db_connect;
$current_promotion = "SELECT promotion_id,pro_type,pro_buy,pro_get,discount_value from pro_discount where promotion_id = '$current_promotion_id'";
$current_promotion = mysqli_query($db_connect,$current_promotion);
$current_promotion = mysqli_fetch_assoc($current_promotion);

$promotion_list = "SELECT promotion_id,pro_type,pro_buy,pro_get,discount_value from pro_discount";
$promotion_list = mysqli_query($db_connect,$promotion_list);
echo "<select name = 'select_string[$pro_code]' class='form-control' onchange='change_select_color(this.name)''>";
	switch ($current_promotion['pro_type']){
		case 1:
		echo "<option value='$current_promotion[promotion_id]'>原价$one_promotion[discount_value]%</option>";
		break;
		case 2:
		echo "<option value='$current_promotion[promotion_id]'>".买.$current_promotion['pro_buy'].赠.$current_promotion['pro_get'];
		break;
		case 4:
		echo "<option value='$current_promotion[promotion_id]'>免运费</option>";
		break;
	}
foreach ($promotion_list as $one_promotion) {
	switch ($one_promotion['pro_type']){

		case 1:
		echo "<option value='$one_promotion[promotion_id]'>原价$one_promotion[discount_value]%</option>";
		break;
		case 2:
		echo "<option value='$one_promotion[promotion_id]'>买 ".$one_promotion['pro_buy']." 赠 ".$one_promotion['pro_get'];
		break;
		case 4:
		echo "<option value='$one_promotion[promotion_id]'>免运费</option>";
		break;
	}
	}
	# code...
	echo "</select>";
}
function update_promotion(){
	global $db_connect;
	if (isset($_POST['update_promotion'])){
		$current_select = $_POST['select_string'];
		foreach ($current_select as $current_code_key => $one_select) {

			
			//echo $current_code_key."=>".$one_select."<br/>";

			$do_promotion_update = "UPDATE product_info SET promotion_id	=	'$one_select' where pro_code = '$current_code_key'";
			$do_promotion_update = mysqli_query($db_connect,$do_promotion_update);

			# code...
		}
		

	}


}



update_promotion();

?>

</div>

</form>

