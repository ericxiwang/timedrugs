<script type="text/javascript">
function data_reflash(){
	var get_cate_text = document.getElementById("cate_menu").options[document.getElementById("cate_menu").selectedIndex].text;
	var get_cate_id = document.getElementById("cate_menu").value;

	//alert(get_cate_id1);
	document.getElementById("cate_edit_text").value = get_cate_text;
	document.getElementById("cate_edit_id").value = get_cate_id;

}

function sub_menu_reflash(){
	var get_cate_text = document.getElementById("sub_menu").options[document.getElementById("sub_menu").selectedIndex].text;
	var get_cate_id = document.getElementById("sub_menu").value;

	//alert(get_cate_id1);
	document.getElementById("sub_menu_text").value = get_cate_text;
	document.getElementById("sub_menu_id").value = get_cate_id;


}







function p_del() { 
var msg = "确定要删除吗？\n\n请确认！"; 
if (confirm(msg)==true){ 
return true; 
}else{ 
return false; 
} 
} 

</script>

<?php
ob_start();
include '../db_cn.php';
include 'basic_html.php';


function brand_edit(){
	global $db_connect;


		if (isset($_POST['new_brand_submit']) and ($_POST['new_brand_submit'] == '添加新品牌')){

			$new_brand_name = $_POST['new_brand'];
			$add_brand = "INSERT INTO pro_brand_list (pro_brand_name) VALUES ('$new_brand_name')";
			$add_brand = mysqli_query($db_connect,$add_brand);
			
	
		}
		elseif (isset($_POST['brand_edit']) and ($_POST['brand_edit'] == '品牌信息编辑')){

			$update_text = $_POST['brand_name_text'];
			$update_id = $_POST['brand_id'];
			$update_des = $_POST['brand_des'];
			$query = "UPDATE pro_brand_list SET pro_brand_name = '$update_text',brand_des = '$update_des' WHERE id='$update_id';";
			$item_update = mysqli_query($db_connect,$query);
	
		}
		elseif (isset($_POST['brand_delete']) and ($_POST['brand_delete'] == '删除品牌')){

			$delete_id = $_POST['brand_id'];
			$query_del = "DELETE FROM pro_brand_list WHERE id = $delete_id";
			$del_brand = mysqli_query($db_connect,$query_del);

		}

}
brand_edit();
function show_brand(){
	global $db_connect;
	if (isset($_POST['brand_list']))
	{
		$current_id = $_POST['brand_list'];
		echo "<div class='col-lg-4'>品牌详细信息</div>";
		$query_one_brand = "SELECT id,pro_brand_name,brand_des from pro_brand_list where id='$current_id'";
		$query_one_brand =mysqli_query($db_connect,$query_one_brand);
		$query_one_brand = mysqli_fetch_assoc($query_one_brand);
		$brand_name = $query_one_brand['pro_brand_name'];
		$brand_id = $query_one_brand['id'];
		$brand_des = $query_one_brand['brand_des'];
		echo "<input type='text' name='brand_name_text' class='form-control' value='$brand_name'>";
		echo "<textarea class='form-control' rows='5' name ='brand_des'>$brand_des</textarea>";

		echo "<input class='btn btn-success' type = 'submit' name = 'brand_edit' value='品牌信息编辑'>";
		echo "<input class='btn btn-danger'  type = 'submit' name = 'brand_delete' value='删除品牌' onclick='javascript:return p_del()''>";
		echo "<input type='hidden' name = 'brand_id' value='$current_id'>";


	}

}

?> 

<div class='col-lg-12' style='text-align:center'><p><h3>产品品牌管理</h3></p></div>
<form action='brand_manage.php' method="POST">
<div class = 'col-lg-5'>
<input type='text' name = 'new_brand' class='form-control'>
<input type = 'submit' name = 'new_brand_submit' class='btn btn-primary' value='添加新品牌'>



<?php
	$brand_query = "SELECT pro_brand_name,id from pro_brand_list";
	$brand_query = mysqli_query($db_connect,$brand_query);
	echo "<select name='brand_list' class='form-control' size='5' onClick='this.form.submit()''>";
	foreach ($brand_query as $one_brand) {
		echo "<option value='$one_brand[id]'>";
		echo $one_brand['pro_brand_name'];
		echo "</option>";

		# code...
	}
	echo "</select>";
show_brand();

?>
























