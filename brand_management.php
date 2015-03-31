<?php
ob_start();

// Create connection
include 'db_cn.php';/////include basic DB connection , db name is inventory////////

?>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    

  </head>

<body >
<?php
	function brand_management(){

		global $db_connect;



		if (!(isset($_POST['brand_submit']))) {
		# code...
		echo "new";

	}
	///////////////////////////add new brand into table pro_brand_list  //////////////////////
	elseif ($_POST['brand_submit']=='brand_add'){

		$add_brand_name = $_POST['brand_name'];
		
		if (isset($add_brand_name)){
		$query = "INSERT INTO pro_brand_list (pro_brand_name) VALUES ('$add_brand_name')";
		$insert = mysqli_query($db_connect,$query);}
		else
		{
			echo "blank data";
		}
	}
	//////////////////////// delete an item from table ////////////////////
	elseif ($_POST['brand_submit']=='brand_del') {
	
		if (isset($_POST['menu_cate_list']))
		{
			$menu_category_del = $_POST['menu_cate_list'];	
			echo $menu_category_del;	
			$query_del = "DELETE FROM menu_category WHERE id = $menu_category_del";
			$del_pro = mysqli_query($db_connect,$query_del);





		}
		else{
			echo 'please select on item';
		}

	}
}
brand_management()

?>

<form action="brand_management.php" method="post"/>
		<select name='menu_cate_list' class='' size='10' style='width:100px;'>
					<?php
					$query = "SELECT id,pro_brand_name FROM pro_brand_list";
					$brand_list = mysqli_query($db_connect,$query);
				
					echo "---".$number_item;

					while ($number_item= $brand_list->fetch_assoc()){

				

					
		    			echo "<option value=$number_item[id]>".$number_item['pro_brand_name']."</option>";
					} 
					?>
		</select>
<input type='text' name='brand_name'><br/>
<button name='brand_submit' type='submit' value="brand_add">添加品牌</button><br/>
<button name='brand_submit' type='submit' value="brand_del">删除品牌</button><br/>



</form>

</body>

</html>