<?php
include 'nav_menu_banner.php';
?>

<div class='col-md-9 col-lg-9 panel panel-danger product_list' style='float:right;padding-top:15px;'>
<form method='POST' name = 'user_list' action='user_modify.php'>
<?


function draw_user_info($user_info,$user_extra_info){

		echo "<div class='text-center'><h3>用户详细信息</h3></div>";
	

		echo "<table class='table table-condensed table-bordered'>";
		echo "<tr class='info' align='center'> <td>姓</td> <td>名</td> <td colspan='2'>电子邮件</td> </tr>";
		echo "<tr align='center'>";
		echo "<td> <input class='form-control' name = 'last_name' 	type='text' 	value = '$user_info[last_name]'> 	</td>";
		echo "<td> <input class='form-control' name = 'first_name' 	type='text' 	value = '$user_info[first_name]'>	</td>";
		echo "<td colspan='2'> <input class='form-control'  name = 'email' 		type='text' 	value = '$user_info[email]'> 		</td>";

		echo "</tr>";

		echo "<tr class='info' align='center'> <td>国家</td> <td>省</td> <td>市</td> <td>邮寄地址</td> </tr>";

		echo "<tr align='center'>";
		echo "<td><input class='form-control' name = 'user_country' type = 'text' value='$user_extra_info[user_country]'></td>";
		echo "<td><input class='form-control' name = 'user_province' type = 'text' value='$user_extra_info[user_province]'></td>";
		echo "<td><input class='form-control' name = 'user_city' type = 'text' value='$user_extra_info[user_city]'></td>";

		echo "<td><input class='form-control' name = 'user_mailing_address' type = 'text' value='$user_extra_info[user_mailing_address]' size=100></td>";
		echo "</tr>";

		//echo "<tr class='info' align='center'> <td>邮编</td> <td>电话</td> <td>激活状态</td> </tr>";
		echo "<tr align='center'>";
		echo "<td> <input class='form-control' name = 'user_postcode' type = 'text' value='$user_extra_info[user_postcode]'> </td>";
		echo "<td> <input class='form-control' name = 'user_phone' type = 'text' value='$user_extra_info[user_phone]'> </td>";
		//echo "<td> <input  name = 'user_status' type = 'checkbox' value='$user_extra_info[user_mailing_address]' checked> </td>";
		echo "</tr>";




		echo "</table>";
		echo "<button type='submit' class='btn btn-success' name='change_status' value='$user_info[email]'>提交修改</button>";
		//echo "<button type='submit' class='btn btn-danger' name='deltet_user' value='$user_info[email]'>删除用户</button>";

		echo "</div>";



}
function user_modify(){
global $db_connect;

	if (!isset($_POST['submit_edit'])){
		//$user_list = "SELECT first_name,last_name,email,actived from user_info";

		$index_email = $_SESSION['user_account'][0];
		/////////////////////////////////////////// get user info ////////////////
		$user_info = "SELECT first_name,last_name,email from user_info where email = '$index_email'";

		$user_info = mysqli_query($db_connect,$user_info);
		$user_info = mysqli_fetch_assoc($user_info);
		////////////////////////////////////////// get user extra info /////////////////
		$user_extra_info = "SELECT user_country,
								user_province,
								user_city,
								user_postcode,
								user_mailing_address,
								user_phone 
								from user_extra_info 
								where user_email='$index_email'";
		$user_extra_info = mysqli_query($db_connect,$user_extra_info);
		$user_extra_info = mysqli_fetch_assoc($user_extra_info);
		draw_user_info($user_info,$user_extra_info);

	



	}
	elseif (isset($_POST['submit_edit'])){

		/*$index_email = $_SESSION['user_account'][0];
		/////////////////////////////////////////// get user info ////////////////
		$user_info = "SELECT first_name,last_name,email from user_info where email = '$index_email'";

		$user_info = mysqli_query($db_connect,$user_info);
		$user_info = mysqli_fetch_assoc($user_info);
		////////////////////////////////////////// get user extra info /////////////////
		$user_extra_info = "SELECT user_country,
								user_province,
								user_city,
								user_postcode,
								user_mailing_address,
								user_phone 
								from user_extra_info 
								where user_email='$index_email'";
		$user_extra_info = mysqli_query($db_connect,$user_extra_info);
		$user_extra_info = mysqli_fetch_assoc($user_extra_info);
		draw_user_info($user_extra_info);*/


		

		
	}


}
user_modify();

?>
</form>
</div>

</div>