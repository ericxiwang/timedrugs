
<?php
ob_start();
include '../db_cn.php';
include 'basic_html.php';
require '../uuid_gen.php';

?>
<?php
$load_brand_list = "SELECT pro_brand_name from pro_brand_list";
$load_brand_list = mysqli_query($db_connect,$load_brand_list);

$load_category = "SELECT id,pro_cate_name from pro_category";
$load_category = mysqli_query($db_connect,$load_category);

?>

<div class='col-lg-12' style='text-align:center'><p><h3>产品上传</h3></p></div>
<div class='row'>

	<div class = 'col-lg-6' >
	<form action="product_upload.php" method='POST' name = 'pro_upload' enctype="multipart/form-data">
		<div class='col-md-5'>
		产品名称:<input class="form-control" type='text' name = 'pro_name'>
		产品品牌:<select class="form-control" type='text' name = 'pro_brand'>
				<?php
				foreach ($load_brand_list as $one_brand) {
					echo "<option value='$one_brand[pro_brand_name]'>";
					echo $one_brand['pro_brand_name'];
					echo "</option>";
					# code...
				}

				?>
				</select>
		产品分类:<select class="form-control" type='text' name = 'pro_category'>
				<?php
				foreach ($load_category as $one_category) {
					echo "<option value='$one_category[id]'>";
					echo $one_category['pro_cate_name'];
					echo "</option>";
				}




				?>
				</select>

		上传图片:<input class="form-control" type='file' id='pro_img' name = 'pro_img'>
		产品单价:<input class="form-control" type='text' name = 'pro_o_price'>
		产品重量:<input class="form-control" type='text' name = 'pro_weight'>
		产品规格:<input class="form-control" type='text' name = 'pro_spec'>
		产品描述:<textarea class = 'form-control' rows="5" name='pro_des'></textarea>
		<div class="checkbox">
  			<label><input name='pro_onsell'type="checkbox" value=1 checked>在线销售 </label>
		</div>
		<div class="checkbox">
  			<label><input name='pro_wholesell'type="checkbox" value=1>包邮批发 </label>
		</div>



		
		<button class="btn btn-primary" type='submit' name='submit' value='pro_add'>添加产品</button>









		</div>
	</form>
	<?php
function pro_upload()
{
	global $db_connect;
	

	if  (isset($_POST['submit'])){

		

		if (isset($_FILES['pro_img'])){
			$pro_brand = $_POST['pro_brand']; //get brand name
			$pro_category = $_POST['pro_category']; //get category info
			$pro_name = $_POST['pro_name'];	//get product name
			$pro_o_price = $_POST['pro_o_price'];
			$pro_weight = $_POST['pro_weight'];
			$pro_spec = $_POST['pro_spec'];

			if (isset($_POST['pro_onsell']))
				{
					$pro_onsell = $_POST['pro_onsell'];
				}
			else
				{
					$pro_onsell = 0;
				}

			if (isset($_POST['pro_wholesell']))
				{
					$pro_wholesell = $_POST['pro_wholesell'];
				}
			else 
				{
				$pro_wholesell = 0;
				}


			if (isset($_POST['pro_des'])){
				$pro_des = $_POST['pro_des']; 
			}
			else{
				$pro_des = '';
			}
			$UU_ID = getguid()."-".time();

			$b =  $_FILES['pro_img']['name'];
			//echo "@@".$b;
			$img_path = '../image/pro_img/';
			$upload_path = 'image/pro_img/';
			#$target_file = $img_path . basename($_FILES["pro_img"]["name"]);
			$target_file = $img_path . $UU_ID.".jpg";
			$path_to_db = $upload_path . $UU_ID.".jpg";
			//echo "###".$target_file;

			$uploadOk = 1;

			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			    $check = getimagesize($_FILES["pro_img"]["tmp_name"]);
			    if($check !== false) {

			        //echo "File is an image - " . $check["mime"] . ".";
			        //echo "<div class='btn btn-success'>上传图片成功!</div>";
			        $uploadOk = 1;
			    } else {
			        //echo "File is not an image.";
			        echo "<div class='btn btn-danger'>上传图片失败!格式错误</div>";
			        $uploadOk = 0;
			    }
			}
			///////////////copy image file into dedicated folder ///////////
			if (move_uploaded_file($_FILES["pro_img"]["tmp_name"], $target_file)) {

				echo "<div class='btn btn-success'>上传图片成功!</div>";
        		//echo "The file ". basename( $_FILES["pro_img"]["name"]). " has been uploaded.";
        	///////////////////// basic product info into product_info /////////////////////////////

        		echo $pro_brand;


        		$query_add_pro = "INSERT INTO product_info (pro_name,pro_brand,pro_code,pro_img,pro_category,pro_o_price,pro_weight,pro_spec,pro_description,pro_onsell,whole_sale) 
        						VALUES ('$pro_name','$pro_brand','$UU_ID','$path_to_db','$pro_category','$pro_o_price','$pro_weight','$pro_spec','$pro_des','$pro_onsell','$pro_wholesell')";


        		//$query_add_pro = "INSERT INTO product_info (pro_name,pro_brand,pro_code,pro_img) VALUES ('$pro_name','$pro_brand','$UU_ID','$target_file')";
				$db_execute = mysqli_query($db_connect,$query_add_pro) or die(mysqli_error());


				

				


				//$query_add_extra_info = "INSERT INTO pro_extra_info (pro_code,pro_img) VALUES ('$UU_ID','$target_file')" ;
				//$db_execute = mysqli_query($db_connect,$query_add_extra_info);
    		} 
    		else {
        		echo "Sorry, there was an error uploading your file.";
    		}


		}
	}





}


pro_upload();
	?>




	</div>
	<div class = 'col-lg-6' >
	<?php
	$load_all_product = "SELECT pro_img,pro_name,pro_category,pro_o_price from product_info order by id desc";
	$load_all_product = mysqli_query($db_connect,$load_all_product);
	foreach ($load_all_product as $one_product) {
		echo "@@".$one_product['pro_name']."<br/>";
		# code...
	}




	?>


	</div>

<?php 
ob_end_flush();
?>