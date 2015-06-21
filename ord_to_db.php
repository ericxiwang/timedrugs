<?php


function ord_to_db(){
$ord_datetime = time();
global $db_connect;
$current_user = $_SESSION['user_account'];
print_r($current_user);
#global $current_user[1],$current_user[2];


if (isset($_POST['total_price'])) {
	$ord_amount = $_POST['total_price'];
	$ord_code = getguid();
	################### insert into ##################
	$ord_user = $current_user[1]." ".$current_user[2];
	$ord_email = $current_user['0'];
	echo $ord_email;
	$add_to_ord_record = "INSERT INTO ord_record (ord_uuid,ord_datetime,ord_amount,ord_status,ord_user,ord_email) VALUES ('$ord_code',now(),'$ord_amount','new','$ord_user','$ord_email')";

	$db_execute = mysqli_query($db_connect,$add_to_ord_record);
	#echo "hha";
	#echo $ord_datetime;
	#print_r($_SESSION['cart_list']);
	################### inset into pro_record ####################


	foreach ($_SESSION['cart_list'] as $show_each) {


		#echo $show_each['pro_name']." ".$show_each['pro_img']." ".$show_each['pro_o_price']." ".$show_each['quantity']."" .$show_each['pro_code']." ".$show_each['whole_price']."<br/>";



		$add_to_pro_record ="INSERT INTO ord_product (ord_uuid,pro_name,pro_img,pro_price,pro_quantity,pro_amount,pro_uuid) 
		VALUES ('$ord_code','$show_each[pro_name]','$show_each[pro_img]','$show_each[pro_o_price]','$show_each[quantity]','$show_each[whole_price]','$show_each[pro_code]')";
		$db_execute = mysqli_query($db_connect,$add_to_pro_record);

	}
	
	
}
elseif (!(isset($_POST['total_price']))) {
	echo "";
}




}
?>