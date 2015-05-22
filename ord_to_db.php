<?php


function ord_to_db(){
$ord_datetime = time();
global $db_connect;
$current_user = $_SESSION['user_account'];
#global $current_user[1],$current_user[2];


if (isset($_POST['total_price'])) {
	$ord_amount = $_POST['total_price'];
	$ord_code = getguid();

	$ord_user = $current_user[1]." ".$current_user[2];
	$add_to_ord_record = "INSERT INTO ord_record (ord_uuid,ord_datetime,ord_amount,ord_status,ord_user) VALUES ('$ord_code',now(),'$ord_amount','new','$ord_user')";
	$db_execute = mysqli_query($db_connect,$add_to_ord_record);
	echo "hha";
	echo $ord_datetime;
}
elseif (!(isset($_POST['total_price']))) {
	echo "";
}




}
?>