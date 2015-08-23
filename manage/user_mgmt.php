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
			echo "<td><input name ='submit_edit' class='btn btn-info' type=submit value='$each_user[email]'></td>";
			//echo "<td><button type='submit' name='submit_edit' form ='user_list' class='btn btn-info' value='$each_user[email]'>编辑用户详情</button></td>";
			echo "</tr>";



			# code...
		}

		echo "</table>";



	}
	elseif (isset($_POST['submit_edit'])){

		$index_email = $_POST['submit_edit'];

		$user_info = "SELECT first_name,last_name,email,actived from user_info where email = '$index_email'";
		$user_info = mysqli_query($db_connect,$user_info);
		print_r($user_info);
		echo $index_email;
		echo "<br/>";
		$user_extra_info = "SELECT user_country,user_province,user_postcode,user_mailing_address,user_phone from user_extra_info where user_email='$index_email'";
		$user_extra_info = mysqli_query($db_connect,$user_extra_info);
		print_r($user_extra_info);
		echo "ASFSDF";
	}


}
user_mgmt();

?>
</form>
</div>

</div>