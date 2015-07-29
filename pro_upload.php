<?php
ob_start();
$servername = "localhost";
// Create connection
include 'db_cn.php';/////include basic DB connection , db name is inventory////////
require 'uuid_gen.php';

?>
<html>
<title>Product management page</title>
<head>
<meta charset='UTF-8'>

</head>
<body>

<?php 



function pro_upload()
{
	global $db_connect;
	if (!(isset($_POST['submit']))){
		echo "new";
	}

	else {

		

		if (isset($_FILES['pro_img'])){
			$pro_brand = $_POST['pro_brand'];
			$pro_category = $_POST['pro_category'];
			$pro_name = $_POST['pro_name'];
			$UU_ID = getguid()."-".time();
			

			
			

			$b =  $_FILES['pro_img']['name'];
			echo "@@".$b;
			$img_path = 'image/pro_img/';
			#$target_file = $img_path . basename($_FILES["pro_img"]["name"]);
			$target_file = $img_path . $UU_ID.".jpg";
			echo "###".$target_file;

			$uploadOk = 1;

			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			    $check = getimagesize($_FILES["pro_img"]["tmp_name"]);
			    if($check !== false) {
			        echo "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        echo "File is not an image.";
			        $uploadOk = 0;
			    }
			}
			
			if (///////////////copy image file into dedicated folder ///////////
				move_uploaded_file($_FILES["pro_img"]["tmp_name"], $target_file)) {


        		echo "The file ". basename( $_FILES["pro_img"]["name"]). " has been uploaded.";
        	///////////////////// basic product info into product_info /////////////////////////////

        		$query_add_pro = "INSERT INTO product_info (pro_name,pro_brand,pro_code,pro_img) VALUES ('$pro_name','$pro_brand','$UU_ID','$target_file')";
				$db_execute = mysqli_query($db_connect,$query_add_pro);
				$query_add_extra_info = "INSERT INTO pro_extra_info (pro_code,pro_img) VALUES ('$UU_ID','$target_file')" ;
				$db_execute = mysqli_query($db_connect,$query_add_extra_info);
    		} 
    		else {
        	echo "Sorry, there was an error uploading your file.";
    }


		}
	}





}
pro_upload()


?>

<form action="pro_upload.php" method='POST' name = 'pro_upload' enctype="multipart/form-data">
	<label>品牌</label>
	<select name='pro_brand'>
		<option value='brand_1'>brand_1</option>
		<option value='brand_2'>brand_2</option>
		<option value='brand_3'>brand_3</option>
	</select><br/>
	<label>分类</label>
	<select name='pro_category'>
		<?php
		$query_1 = "SELECT pro_cate_name from pro_category";
		$pro_cate_list = mysqli_query($db_connect,$query_1);
		while ($pro_cate_item = mysqli_fetch_row($pro_cate_list))
			{
			echo "<option value='$pro_cate_item[0]'>".$pro_cate_item[0]."</option>";

			}
					





		?>
	</select>
	<br/>
	<label>产品名称</label>
	<input name='pro_name' type='text'><br/>
	<label>图片</label>
	<input name='pro_img' type='file' id='pro_img'>
	<button type='submit' name='submit' value='pro_add'>添加产品</button>
</from>


</body>
<?php 
ob_end_flush();
?>
</html>