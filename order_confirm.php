<?php
include 'nav_menu_banner.php';
require 'uuid_gen.php'
?>
<div class='col-md-9 col-lg-9 panel panel-danger product_list' style='float:right;padding-top:15px;'>
<?php

$ord_time = time();
echo ""


?>
<form action='paypal_approval.php'  method='POST' name='paypal_link'>
<div class="progress active" style='height:40px'>
  <div class="progress-bar progress-bar-success" style="width:25%;padding:10px">
  	<span class='glyphicon glyphicon-ok'>订单提交</span>

    
  </div>
  <div class="progress-bar  progress-bar-warning progress-bar-striped" role="progressbar" style="width: 25%;padding:10px">
    确认付款
  </div>
  <div class="progress-bar  progress-bar-warning progress-bar-striped" role="progressbar" style="width: 25%;padding:10px">
    货物已发
  </div>
  <div class="progress-bar  progress-bar-warning progress-bar-striped" role="progressbar" style="width: 25%;padding:10px">
    订单关闭
  </div>

</div>


</div>
<?php
if (isset($_POST['total_price'])) {
	echo $_POST['total_price'];
}
elseif (!(isset($_POST['total_price']))) {
	echo "nothing";
}

echo "<button type='submit'>";
echo "<img border='0' src='image/paypal.jpg'/>";
echo "</button>";


?>


</form>