<?php


function ord_to_db(){
$ord_datetime = time();
global $db_connect;
$current_user = $_SESSION['user_account'];
//print_r($current_user);
#global $current_user[1],$current_user[2];



if (isset($_POST['hidden_amount'])) {
	#print_r($_POST['hidden_amount']);
	
	$ord_amount = $_POST['hidden_amount'];
	$ord_code = getguid();
	################### insert into ##################
	//print_r($current_user);
	$ord_user = $current_user[1]." ".$current_user[2];
	$ord_email = $current_user[0];
	#echo $ord_email;
	//////////////get user mailing address post code and full name
	
	$mailing_address = $_POST['full_address'];
	$mailing_address = urldecode($mailing_address);
	//echo $mailing_address;


	$post_code = $_POST['post_code'];
	//$full_name = $_POST['full_name'];
	$shipping_fee = $_POST['shipping_fee'];

	$add_to_ord_record = "INSERT INTO ord_record (ord_uuid,ord_datetime,ord_amount,ord_status,ord_user,ord_email,ord_address,ord_postcode,ord_shipping_fee) 
						VALUES ('$ord_code',now(),'$ord_amount','new','$ord_user','$ord_email','$mailing_address','$post_code','$shipping_fee')";

	$db_execute = mysqli_query($db_connect,$add_to_ord_record);
	#echo "hha";
	#echo $ord_datetime;
	#print_r($_SESSION['cart_list']);
	################### inset into pro_record ####################


	foreach ($_SESSION['cart_list'] as $show_each) {

		echo "##".$show_each['pro_type'];
		if (!(isset($show_each['m_price']))){
			$show_each['m_price'] = $show_each['pro_o_price'];
		}


		#echo $show_each['pro_name']." ".$show_each['pro_img']." ".$show_each['pro_o_price']." ".$show_each['quantity']."" .$show_each['pro_code']." ".$show_each['whole_price']."<br/>";



		$add_to_pro_record ="INSERT INTO ord_product 
							(ord_uuid,
								pro_name,
								pro_img,
								pro_quantity,
								pro_uuid,
								pro_o_price,
								pro_m_price,
								pro_amount,
								pro_pro_type) 

							VALUES 
							('$ord_code',
								'$show_each[pro_name]',
								'$show_each[pro_img]',
								'$show_each[quantity]',
								'$show_each[pro_code]',
								'$show_each[pro_o_price]',
								'$show_each[m_price]',
								'$show_each[whole_price]',
								'$show_each[pro_type]')";
		$db_execute = mysqli_query($db_connect,$add_to_pro_record);

	}

	unset($_SESSION['cart_list']);///////clear session 'cart list' after all products has been submitted into database///////
	
	
}
elseif (!(isset($_POST['total_price']))) {
	echo "no data received";
}




}
?>