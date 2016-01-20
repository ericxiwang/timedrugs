<?php
ob_start();
include '../db_cn.php';
include 'basic_html.php';
require '../uuid_gen.php';

?>

<div class='row'>
<div class='col-lg-12'>
<form method='POST' name = 'user_list' action='user_mgmt.php'>
<?php
function user_mgmt(){
global $db_connect;

	if (!isset($_POST['submit_edit'])){
		$user_list = "SELECT first_name,last_name,email,actived from user_info";

		$user_list = mysqli_query($db_connect,$user_list);
		echo "<table class='table table-condensed'>";
		echo "<tr><thead><th>姓名</th><th>电子邮件</th><th>激活状态</th>";

		foreach ($user_list as $each_user) {
			echo "<tr>";
			echo "<td>".$each_user['last_name']." ".$each_user['first_name']."</td>";
			echo "<td>".$each_user['email']."</td>";
			echo "<td>";
				if ($each_user == '1'){
					echo "<input type='checkbox' name='actived' value='1' checked> ";
				}
				else {
					echo "<input type='checkbox' name='actived' value='1' > ";
					# code...
				}
			echo "</td>";
			//echo "<td><input name ='submit_edit' class='btn btn-info' type=submit value='$each_user[email]'></td>";
			echo "<td>
			<button type='submit' name='submit_edit' f class='btn btn-info' value='$each_user[email]'>编辑用户详情</button>
			</td>";
			echo "</tr>";



			# code...
		}

		echo "</table>";



	}
	elseif (isset($_POST['submit_edit'])){

		$index_email = $_POST['submit_edit'];
		/////////////////////////////////////////// get user info ////////////////
		$user_info = "SELECT first_name,last_name,email,actived from user_info where email = '$index_email'";

		$user_info = mysqli_query($db_connect,$user_info);
		$user_info = mysqli_fetch_assoc($user_info);
		////////////////////////////////////////// get user extra info /////////////////
		$user_extra_info = "SELECT user_country,user_province,user_city,user_postcode,user_mailing_address,user_phone from user_extra_info where user_email='$index_email'";
		$user_extra_info = mysqli_query($db_connect,$user_extra_info);
		$user_extra_info = mysqli_fetch_assoc($user_extra_info);


		echo "<div class='text-center'><h3>用户详细信息</h3></div>";
		echo "<div class='col-lg-12'>";

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

		echo "<tr class='info' align='center'> <td>邮编</td> <td>电话</td> <td>激活状态</td> </tr>";
		echo "<tr align='center'>";
		echo "<td> <input class='form-control' name = 'user_postcode' type = 'text' value='$user_extra_info[user_postcode]'> </td>";
		echo "<td> <input class='form-control' name = 'user_phone' type = 'text' value='$user_extra_info[user_phone]'> </td>";
		echo "<td> <input  name = 'user_status' type = 'checkbox' value='$user_extra_info[user_mailing_address]' checked> </td>";
		echo "</tr>";




		echo "</table>";
		echo "<button type='submit' class='btn btn-success' name='change_status' value='$user_info[email]'>提交修改</button>";
		echo "<button type='submit' class='btn btn-danger' name='deltet_user' value='$user_info[email]'>删除用户</button>";

		echo "</div>";

		
	}


}
user_mgmt();

?>
</form>
</div>

</div>