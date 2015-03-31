<?php
ob_start();
$servername = "localhost";


// Create connection
include 'db_cn.php';/////include basic DB connection , db name is inventory////////


?>
<html>
<title>Category management page</title>
<head>
<meta charset='UTF-8'>

</head>
<body>
<?php 
function menu_cate_management()
{
	global $db_connect;
	
	
	if (!(isset($_POST['submit']))) {
		# code...
		echo "new";

	}
	///////////////////////////add a menu nav item to table menu_category //////////////////////
	elseif ($_POST['submit']=='menu_add'){

		$menu_category_name = $_POST['menu_add_text'];
		
		if (isset($menu_category_name)){
		$query = "INSERT INTO menu_category (menu_cate_name) VALUES ('$menu_category_name')";
		$insert = mysqli_query($db_connect,$query);}
		else
		{
			echo "blank data";
		}
	}
	//////////////////////// delete an item from table ////////////////////
	elseif ($_POST['submit']=='menu_del') {
	
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
		# code...
	}
	//////////////////////////update item name from text box //////////////////////
	elseif ($_POST['submit']=='menu_edit') {

		
		if ((isset($_POST['menu_edit_text'])) and (isset($_POST['menu_cate_list'])))
		{	
			
			$update_text = $_POST['menu_edit_text'];
			$list_number = $_POST['menu_cate_list'];
			
		
			$query = "UPDATE menu_category SET menu_cate_name = '$update_text' WHERE id='$list_number';";
			$item_update = mysqli_query($db_connect,$query);
		}
		echo "edit";
		# code...
	}


	//////////////////////////add category to pro_category table///////////////////////
	///////////////////////////////////////////////////////////////////////////////////
	elseif ($_POST['submit']=='cate_add'){
		if ((isset($_POST['pro_category_text'])) and (isset($_POST['menu_cate_list'])))
			$upper_cate = $_POST['menu_cate_list'];
			$pro_cate_name = $_POST['pro_category_text'];
			
			$query_add_cate = "INSERT INTO pro_category (upper_cate,pro_cate_name) VALUES ('$upper_cate','$pro_cate_name')";
			$category_add = mysqli_query($db_connect,$query_add_cate);
	
			

		}
		else{
			echo "nothing";
		}
	
	
	
}

menu_cate_management()
?>	


	<form action='category_management.php' name='menu_cate_edit' method='post'>

		<table>
			<tr>
				<td>
					<input name='menu_add_text' type='text'>

					<button name='submit' type='submit' value="menu_add">添加菜单</button><br/>

					<button name='submit' type='submit' value="menu_del">删除菜单</button><br/>

					<input name='menu_edit_text' type='text'>

					<button name='submit' type='submit' value="menu_edit">修改菜单</button><br/>
				</td>
				<td>

					<label>导航菜单分类列表</label><br/>
					<select name='menu_cate_list' class='' size='10' style='width:100px;'>
					<?php
					$query = "SELECT id,menu_cate_name FROM menu_category";
					$menu_list = mysqli_query($db_connect,$query);
				
					echo "---".$number_item;

					while ($number_item= $menu_list->fetch_assoc()){

				

					
		    			echo "<option value=$number_item[id]>".$number_item['menu_cate_name']."</option>";
					} 
					?>
					</select>
				</td>
				<td>

				<!--pro_cate input block-->
					<label>药品分类列表</label><br/>
					<select name="pro_cate_list" class = '' size='10' style='width:100px'>
					<?php
					$query_1 = "SELECT pro_cate_name from pro_category";
					$pro_cate_list = mysqli_query($db_connect,$query_1);
					

					while ($pro_cate_item = mysqli_fetch_row($pro_cate_list)){
						echo "<option value='$pro_cate_item[0]'>".$pro_cate_item[0]."</option>";

					}
					

					?>
					</select>
					<?php echo $pro_cate_item ?>









				</td>
				<td>
					<input name='pro_category_text'>

					<button name='submit' type='submit' value="cate_add">添加菜单</button><br/>

					<button name='submit' type='submit' value="cate_del">删除菜单</button><br/>
					<input name='cate_edit_text' type='text'>

					<button name='submit' type='submit' value="cate_edit">修改菜单</button><br/>
				</td>
			</tr>
		</table>





	</form>
		

</body>
<?php 
ob_end_flush();
?>
</html>
