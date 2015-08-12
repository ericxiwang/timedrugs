<?php
ob_start();
include '../db_cn.php';
include 'basic_html.php';
require '../uuid_gen.php';

?>
<div class = 'col-lg-5' >
<?php 
function load_page(){
	global $db_connect;
	//////////////////////// if there is no precondition , that means a new page loaded ////////////////
	if ((!(isset($_POST['pro_edit']))) and (!(isset($_POST['update_confirm']))))
	{
	echo "<div class='col-lg-12' style='text-align:center'><p><h3>产品编辑</h3></p></div><div class='row'>";
	$load_all_product = "SELECT pro_img,pro_name,pro_o_price,pro_brand,pro_weight,pro_spec,pro_onsell,pro_code,promotion_id from product_info order by id desc";
	$load_all_product = mysqli_query($db_connect,$load_all_product);




	echo "<div ><table class='table table-condensed' style='margin:0px;'>";
	echo "<tr ><thead ><tr>
			<th style='width:8%'>图片</th> 
			<th style='width:15%'>产品名称</th> 
			<th style='width:15%'>产品单价</th> 

			<th style='width:15%'>产品重量</th> 

			<th style='width:10%'>在售状态</th> 

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


		

		
		echo "</tr>";






		

	}
	echo "</table>";
	echo "</div>";

	}
	////////////////////////////////////////////////////// product list display end //////////////////////////




	////////////////////////////////////////////////////// product update page start ////////////
	elseif (isset($_POST['pro_edit'])) {
		echo "<div class='col-lg-12' style='text-align:center'><p><h3>产品编辑</h3></p></div>";

		$pro_code = $_POST['pro_edit'];
		////////////////////////////////////////// get main info from product info table /////////////////////////////////////////////
		$edit_pro = "SELECT pro_img,pro_name,pro_brand,pro_category,pro_o_price,pro_weight,pro_spec,pro_description,pro_onsell from product_info where pro_code = '$pro_code'";
		$edit_pro = mysqli_query($db_connect,$edit_pro);
		$edit_pro = mysqli_fetch_assoc($edit_pro);

		////////////////////////////////////////// get matched category from pro category table /////////////////////////////////////
		$match_cate_name = mysqli_query($db_connect,"SELECT pro_cate_name from pro_category where id = '$edit_pro[pro_category]'");
		$match_cate_name = mysqli_fetch_assoc($match_cate_name); ////get matched cate name from table

		$pro_cate_list = "SELECT pro_cate_name,id from pro_category";
		$pro_cate_list = mysqli_query($db_connect,$pro_cate_list);

		/////////////////////////////////////////// get brand list from pro_brand_list table ////////////////////////////////////////
		$match_cate_brand = mysqli_query($db_connect,"SELECT id,pro_brand_name from pro_brand_list");

		echo "<div class = 'form-group col-lg-5'>";
		echo "<label>产品名称:</label><input class='form-control' type=text name='pro_name' value='$edit_pro[pro_name]'>";


		///////////////////////// draw brand checkbox list ////////////////////
		echo "<label>品牌名称: </label><select name ='pro_brand' class='form-control'>";
			echo "<option value = '$edit_pro[pro_brand]'>".$edit_pro['pro_brand']."</option>";
		foreach ($match_cate_brand as $one_brand)
		{
			echo "<option value = '$one_brand[pro_brand_name]'>".$one_brand['pro_brand_name']."</option>";
		}
		echo "</select>";
		///////////////////////// checkbox list end ///////////////////////////


		//echo "产品名称:<input class='form-control' type=text name='pro_name' value='$edit_pro[pro_name]'>";



		///////////////////////// draw pro category checkbox list ///////////////////
		echo "<label>产品分类: </label><select name = 'pro_category' class='form-control'>";
		echo "<option value = '$edit_pro[pro_category]'>".$match_cate_name['pro_cate_name']."</option>";
		foreach ($pro_cate_list as $one_cate) 
		{
			echo "<option value = '$one_cate[id]'>".$one_cate['pro_cate_name']."</option>";
		}
		echo "</select>";
		///////////////////////// checkbox list end //////////////////////////////////




		echo "<label>零售价格:</label><input class='form-control' type=text name='pro_o_price' value='$edit_pro[pro_o_price]'>";
		echo "<label>产品重量:</label><input class='form-control' type=text name='pro_weight' value='$edit_pro[pro_weight]'>";
		echo "<label>产品规格:</label><input class='form-control' type=text name='pro_spec' value='$edit_pro[pro_spec]'>";

		echo "<label>当前图片:</label><br/>";
		echo "<img src='../$edit_pro[pro_img]' class='img-thumbnail'>";
		echo "<label>上传新图片:</label><input class='form-control' type='file' name = 'pro_img'>";
		if ($edit_pro['pro_onsell'] == '1')
		{
			echo "<div class='checkbox'>";
			echo "<input name='pro_onsell' type='checkbox' value = '1' checked>在线销售 ";
			echo "</div>";
		}
		elseif ($edit_pro['pro_onsell'] == 0)
		{

			echo "<div class='checkbox'>";
		
			echo "<input name='pro_onsell' type='checkbox' value = '1' >在线销售 ";
			echo "</div>";
		
		}
		echo "<input name = 'img_code' type='hidden' value ='$edit_pro[pro_img]'>";
		echo "<input name = 'pro_code' type='hidden' value ='$pro_code'>";
		echo "<button class ='btn btn-danger' type='submit' name = 'update_confirm' value='update_confirm'>提交修改</button>";
	echo "</div>";
	}




	//////////////////////////////////////// execute update process //////////////
	elseif (isset($_POST['update_confirm'])){

		pro_update();
	}
}
load_page();
?>
</div>