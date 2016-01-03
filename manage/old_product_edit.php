 
<?php
ob_start();
include '../db_cn.php';
include 'basic_html.php';
require '../uuid_gen.php';

?>
<?php
/*
$load_brand_list = "SELECT pro_brand_name from pro_brand_list";
$load_brand_list = mysqli_query($db_connect,$load_brand_list);

$load_category = "SELECT id,pro_cate_name from pro_category";
$load_category = mysqli_query($db_connect,$load_category);
*/
?>



	<div class = 'col-lg-12' >
	<form role='form' action="product_edit.php" method='POST' name = 'pro_upload' enctype="multipart/form-data">
		




	
	
	<?php
///////////////////////////////////////////// update function begin /////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
function pro_update()
{


		global $db_connect;
		$pro_name 		=   $_POST['pro_name'];
		//$pro_img		=	$_POST['pro_img'];
		$pro_o_price	=	$_POST['pro_o_price'];
		$pro_brand 		=	$_POST['pro_brand'];
		$pro_weight 	=	$_POST['pro_weight'];
		$pro_category 	=	$_POST['pro_category'];
		$pro_spec 		=	$_POST['pro_spec'];
		$pro_code		=	$_POST['pro_code'];
		$pro_img		=	$_POST['img_code'];
		$pro_onsell		=	$_POST['pro_onsell'];

		//echo "@".$pro_name."@".$pro_o_price."@".$pro_o_price."@".$pro_brand."@".$pro_weight."@".$pro_category."@".$pro_spec;

		if ((empty($_POST['pro_name'])) 
			or (empty($_POST['pro_o_price'])) 
			or (empty($_POST['pro_o_price'])) 
			or (empty($_POST['pro_brand'])) 
			or (empty($_POST['pro_weight'])) 
			or (empty($_POST['pro_category'])) 
			or (empty($_POST['pro_spec'])))
		{
			echo "failed";
		}
		else  ///////////execute data update process //////////
		{	

			

			$product_update = "UPDATE product_info SET 
							pro_name 		= '$pro_name',
							pro_brand 		= '$pro_brand',
							pro_category 	= '$pro_category',
							pro_o_price		= '$pro_o_price',
							pro_weight 		= '$pro_weight',
							pro_spec 		= '$pro_spec',
							pro_onsell 		= '$pro_onsell'

							WHERE pro_code='$pro_code'";

			$product_update = mysqli_query($db_connect,$product_update);

			

			if (isset($_FILES['pro_img']))  ////////////////update image ///////////
			{

				$uploadOk = 1;
				$target_file = "../".$pro_img;

				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// Check if image file is a actual image or fake image
			
				    $check = getimagesize($_FILES["pro_img"]["tmp_name"]);
				    if($check !== false) {
				        echo "File is an image - " . $check["mime"] . ".";
				        $uploadOk = 1;
				    } else {
				        echo "File is not an image.";
				        $uploadOk = 0;
				    }
				
				
					if (move_uploaded_file($_FILES["pro_img"]["tmp_name"], $target_file)) ///////////////copy image file into dedicated folder ///////////
					{
		        		echo "The file ". basename( $_FILES["pro_img"]["name"]). " has been uploaded.";
					}

					else
					{

						echo "nothing";
					}

			}
			else
			{
				echo "no image uploaded!";
			}
		
			header("Location: product_edit.php");



 







		}
}
	


function load_page(){
	global $db_connect;
	//////////////////////// if there is no precondition , that means a new page loaded ////////////////
	if ((!(isset($_POST['pro_edit']))) and (!(isset($_POST['update_confirm']))))
	{
	echo "<div class='col-lg-12' style='text-align:center'><p><h3>产品编辑</h3></p></div><div class='row'>";
	$load_all_product = "SELECT pro_img,pro_name,pro_o_price,pro_brand,pro_weight,pro_spec,pro_onsell,pro_code from product_info order by id desc";
	$load_all_product = mysqli_query($db_connect,$load_all_product);




	echo "<div ><table class='table table-condensed' style='margin:0px;'>";
	echo "<tr ><thead ><tr>
			<th style='width:8%'>图片</th> 
			<th style='width:15%'>产品名称</th> 
			<th style='width:15%'>产品单价</th> 
			<th style='width:15%'>品牌名称</th> 
			<th style='width:15%'>产品重量</th> 
			<th style='width:15%'>产品规格</th> 
			<th style='width:10%'>在售状态</th> 
			<th style='width:10%'>编辑商品</th> 
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
		echo "<td style='width:15%'>".$one_product['pro_brand']."</td>";
		echo "<td style='width:15%'>".$one_product['pro_weight']."</td>";
		echo "<td style='width:15%'>".$one_product['pro_spec']."</td>";
		if ($one_product['pro_onsell'] == 1){
			echo "<td style='width:10%'><input type='checkbox' checked disabled></td>";
		}
		else {
			echo "<td style='width:10%'><input type='checkbox' disabled></td>";
		}

		

		echo "<td style='width:15%'>";
		echo "<button type='submit' name ='pro_edit' class='btn btn-primary glyphicon glyphicon-edit' style='height:50px;margin-right:20px' value = '$one_product[pro_code]'>编辑</button>";
		echo "</td>";
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
///////////////////////////////////////////// update page end       /////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////


?>

</div>
<div class = 'col-lg-6' >


</div>
</form>


<?php 
ob_end_flush()

?>