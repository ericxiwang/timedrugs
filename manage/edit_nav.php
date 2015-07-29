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


function menu_cate_edit(){
	global $db_connect;


		if (isset($_POST['new_category_submit']) and ($_POST['new_category_submit'] == '提交新菜单')){

			$menu_category_name = $_POST['new_category_text'];
			$add_cate_menu = "INSERT INTO menu_category (menu_cate_name) VALUES ('$menu_category_name')";
			$add_cate_menu = mysqli_query($db_connect,$add_cate_menu);
			
	
		}
		elseif (isset($_POST['new_category_edit']) and ($_POST['new_category_edit'] == '修改菜单')){

			$update_text = $_POST['cate_edit_text'];
			$update_id = $_POST['cate_edit_id'];
			$query = "UPDATE menu_category SET menu_cate_name = '$update_text' WHERE id='$update_id';";
			$item_update = mysqli_query($db_connect,$query);
	
		}
		elseif (isset($_POST['new_category_delete']) and ($_POST['new_category_delete'] == '删除菜单')){

			$delete_id = $_POST['cate_edit_id'];
			$query_del = "DELETE FROM menu_category WHERE id = $delete_id";
			$del_pro = mysqli_query($db_connect,$query_del);

		}
		




}

function sub_menu_edit(){
	global $db_connect;
	
	if (isset($_POST['sub_menu_add']) and ($_POST['sub_menu_add'] == '新建子分类')){
		$sub_menu_name = $_POST['sub_menu_text'];
		$matched_id = $_POST['main_menu_id']; ////matched id is main menu id
		$add_sub_menu = "INSERT INTO pro_category (pro_cate_name,upper_cate) VALUES ('$sub_menu_name','$matched_id')";

		$add_sub_menu = mysqli_query($db_connect,$add_sub_menu);
	}
	elseif (isset($_POST['sub_menu_edit']) and ($_POST['sub_menu_edit'] == '保存修改')){
		$sub_menu_name = $_POST['sub_menu_text'];
		$matched_id = $_POST['sub_menu_id']; /////matched id is sub menu id

		$modify_sub_menu = "UPDATE pro_category SET pro_cate_name = '$sub_menu_name' WHERE id ='$matched_id'";
		$modify_sub_menu = mysqli_query($db_connect,$modify_sub_menu);

	}
	elseif (isset($_POST['sub_menu_delete']) and ($_POST['sub_menu_delete'] == '删除菜单')){
		$sub_menu_name = $_POST['sub_menu_text'];
		$matched_id = $_POST['sub_menu_id']; // matched id is sub menu id ///////

		
		$modify_sub_menu= "DELETE FROM pro_category WHERE id = $matched_id";
		$modify_sub_menu = mysqli_query($db_connect,$modify_sub_menu);

	}





}
menu_cate_edit();
sub_menu_edit();

function draw_sub_menu(){
	global $db_connect;
	if (isset($_POST['main_menu']))
	{

	$select_id = $_POST['main_menu'];
	$query_sub_menu = "SELECT pro_cate_name,id,upper_cate from pro_category where upper_cate = '$select_id'";
	$pro_cate_list = mysqli_query($db_connect,$query_sub_menu);


	$get_upper_menu = "SELECT menu_cate_name from menu_category where id = '$select_id'"; /////get id from menu_category table
	$get_upper_menu = mysqli_query($db_connect,$get_upper_menu);
	$get_upper_menu = mysqli_fetch_assoc($get_upper_menu);


	

	echo "<div class = 'col-md-5'>";
	echo "<div class='col-md-5'>父级菜单:".$get_upper_menu['menu_cate_name']."</div><br/>";
	echo "<input type='hidden' id = 'main_menu_id' name = 'main_menu_id' value='$select_id'>";
	echo "<div class='col-md-5'><select  id = 'sub_menu' class='form-control' size='12' onClick='sub_menu_reflash();'>";

	

		foreach ($pro_cate_list as $one_sub_menu ){
	
			echo "<option value=$one_sub_menu[id]>";
			echo $one_sub_menu['pro_cate_name'];
			echo "</option>";
			# code...
		}
	echo "</select>";
	echo "</div class='col-md-5'><br/>";

	echo "<div>";
	echo "<input class='form-control' type=text id='sub_menu_text' name = 'sub_menu_text' value=''>";


	echo "<input class='btn btn-primary' type = 'submit' name = 'sub_menu_add' value='新建子分类'>";

	echo "<input class='btn btn-success' type = 'submit' name = 'sub_menu_edit' value='保存修改'>";
	echo "<input class='btn btn-danger'  type = 'submit' name = 'sub_menu_delete' value='删除菜单' onclick='javascript:return p_del()'>";
	
	echo "<input type='hidden' id = 'sub_menu_id' name='sub_menu_id' value=''>";
	echo "</div>";
	echo "</div>";










	
	}			


}
?> 

<div class='row'>
<div class='col-lg-6'>

<div class='col-md-7'>
<form method='POST' action='edit_nav.php'>
<div>新建一个菜单项</div>

<div >
<input type='text' class='form-control' name='new_category_text' placeholder='输入新建菜单名称' >
<input class='btn btn-primary' type = 'submit' name = 'new_category_submit' value='提交新菜单'>
</div>

<div ><select  id = 'cate_menu' class='form-control' size='12' onClick='data_reflash();'>
<?php
$load_basic_menu = "SELECT menu_cate_name,id from menu_category";
$load_basic_menu = mysqli_query($db_connect,$load_basic_menu);
foreach ($load_basic_menu as $one_category) {


		echo "<option value=$one_category[id] >";
		echo $one_category['menu_cate_name'];
		echo "</option>";
	}
?>
</select></div>
<div>修改或删除菜单</div>
<div ><input class='form-control ' type=text id='cate_edit_text' name = 'cate_edit_text' value=''></div>

<input class='btn btn-success' type = 'submit' name = 'new_category_edit' value='修改菜单'>
<input class='btn btn-danger'  type = 'submit' name = 'new_category_delete' value='删除菜单' onclick="javascript:return p_del()">


<input type=hidden id='cate_edit_id' name = 'cate_edit_id' value=''>


</div>
</div>

<!--  right side bar -->

<div>新建一个产品分类项</div>
<div>在列表中选择一个父级菜单</div>
<div class='col-lg-6'>
<div class = 'col-md-4'><select name='main_menu' class='form-control' size='5' onchange="this.form.submit()">
<?php
foreach ($load_basic_menu as $one_category) {


		echo "<option value=$one_category[id] >";
		echo $one_category['menu_cate_name'];
		echo "</option>";
	}
?>
</select></div>






</div>
<?php


draw_sub_menu();

?>
</div>




</div> <!-- end row -->
<?php 



?>
</form>