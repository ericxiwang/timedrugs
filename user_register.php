<?php
include 'nav_menu_banner.php';
?>

<?php

function user_register(){
if (isset($_POST['email']))	{// if POST already has data , do user authorize process
	global $db_connect;
	$user_email = $_POST['email'];


	$query_exist = "SELECT email from user_info where email = '$user_email'";
	$check_user = mysqli_query($db_connect,$query_exist);
	$check_user = mysqli_fetch_row($check_user);



	if (isset($check_user)){// if data is exist in database ,return notice

		
		echo "<span class='help-block'>邮箱已注册!</span>";
		
		
	}
	else{// if it new user , redirect to other page

		
		#header( 'Location: user_authorized.php' ) ; 
		insert_to_db();
	}
}

else{ // if POST is not set, that means nothing to do, just draw form
	
	
}
}
function insert_to_db(){

global $db_connect;
$last_name		= $_POST['last_name'];
$first_name 	= $_POST['first_name'];
$email 			= $_POST['email'];
//$psw_encrypt 	= md5($_POST['password']);
$psw_encrypt 	= $_POST['password'];



$user_to_db = "INSERT INTO user_info(first_name,last_name,email,user_password) VALUES ('$first_name ','$last_name','$email','$psw_encrypt')";
$insert_user = mysqli_query($db_connect,$user_to_db);
if(mysqli_affected_rows($db_connect) == 1){//if data was inserted successfully


#header( 'Location: user_authorized.php' );
	header('Location:user_login.php');

}
elseif (mysqli_affected_rows($db_connect) == 0) {
	echo "数据写入失败，内部错误！";
	# code...
}
}
?>
<script src="bootstrap/js/validator.min.js"></script>
<div class='col-md-9 col-lg-9 panel panel-danger product_list haha' style='float:right;padding-top:15px;'>
<form action='user_register.php' method='POST' class="form-horizontal" role="form" data-toggle="validator">
	<!--basic user info-->
	<div id='basic_info' class='well'>
	<div class="form-group">
      <label class="control-label col-sm-2" for="email" >姓:</label>
      <div class="col-md-4">
        <input type="text" class="form-control" id="last_name" name='last_name' placeholder="您贵姓？" required>

      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="email" >名:</label>
      <div class="col-md-4">
        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="你的大名？" required>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="email">邮箱:</label>
      <div class="col-md-4">
        <input type="email" class="form-control" id="email"  name="email" placeholder="Enter email" data-error="请确认邮箱格式正确" required>
        <?php
        user_register();

        ?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-2" for="pwd">设置口令:</label>
      	<div class="col-md-4">
      		<input type="password" data-minlength="6" class="form-control" id="inputPassword" name="password" placeholder="设置口令,长度不小于6位" required>
      			
    	
    
      		<input type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="口令不匹配" placeholder="确认口令" required>
      		<div class="help-block with-errors"></div><span class="help-block">长度不小于6位</span>
    	</div>


	</div>
	</div>

	
	<!-- extra user info -->

	<div id='extra_info' class='well'>
		<div class="form-group">
	      	<label class="control-label col-sm-2" for="email">国家:</label>
	      	<div class="col-md-4">
		        <select type="se" class="form-control" id="country" >
		        	<option >aaa</option>
		        	<option >aaa</option>
		        	<option >aaa</option>
		        	<option >aaa</option>
		        </select>
	    	</div>
		</div>

	    <div class="form-group">
	    	<label class="control-label col-sm-2" for="email">省/州:</label>
	
	      	<div class="col-md-4">
	        <select type="se" class="form-control" id="country" >
	        	<option >aaa</option>
	        	<option >aaa</option>
	        	<option >aaa</option>
	        	<option >aaa</option>
	        </select>
	    	</div>
	    </div>
	    <div class="form-group">
      	<label class="control-label col-sm-2" for="email">邮编:</label>
      		<div class="col-md-4">
        	<input type="text" class="form-control" id="first_name" placeholder="你的大名？">
     		 </div>
    	</div>
    	<div class="form-group">
      	<label class="control-label col-sm-2" for="email">联系电话:</label>
      		<div class="col-md-4">
        	<input type="text" class="form-control" id="first_name" placeholder="你的大名？">
     		 </div>
    	</div>
    	<div class="form-group">
      	<label class="control-label col-md-2" for="email">邮寄地址:</label>
      		<div class="col-md-8">
        	<input type="text" class="form-control" id="first_name" placeholder="你的大名？">
     		 </div>
    	</div>


    </div>
  
		





    <div class="form-group">        
      <div class="col-md-4">
        <button type="submit" class="btn btn-danger btn-block">提交注册</button>
      </div>
    </div>
  </form>

</div>


</body>
</html>