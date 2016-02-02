<?php
include 'nav_menu_banner.php';
require 'uuid_gen.php';
require 'ord_to_db.php';

?>
<div class='col-md-9 col-lg-9 panel panel-danger product_list' style='float:right;padding-top:15px;'>
<?php





?>
<!--<form action='paypal_approval.php'  method='POST' name='paypal_link'>-->
 <form id="f1" name="f1" runat="server"  action="https://www.paypal.com/cgi-bin/webscr"  method="post">

<div>
  订单状态条，下一步请选择付款方式
  </div>
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
<?php
if ((isset($_SESSION['submit_enabled'])) and ($_SESSION['submit_enabled'] == '1')){

//ord_to_db();

$ord_info   =   ord_to_db();
$ord_uuid   =   $ord_info[0];
$ord_amount =   $ord_info[1];
$ord_user   =   $ord_info[2];

  echo "<input type='hidden' name='cmd' value='_xclick'>";
  echo "<input type='hidden' name='business' value='superbc@gmail.com'>";

  echo "<input type='hidden' name='item_name' value= '$ord_uuid' >";
  echo "<input type='hidden' name='item_number' value='1'>";
  echo "<input type='hidden' name='amount' value='$ord_amount'>";
  echo "<input type='hidden' name='custom' value='wang'>";
  echo "<input type='hidden' name='invoice' value='enabled'>";
  echo "<input type='hidden' name='no_shipping' value='1'> "; 
  echo "<input type='hidden' name='currency_code' value='CAD'>";
  echo "<input type='hidden' name='no_note' value='1'>";











$_SESSION['submit_enabled']='0';
}

?>
点击Paypal支付
<button type='submit'><img border='0' src='image/PAYPAL-LOGOS.jpg' width="200" height="40" /></button>
</div>







</form>