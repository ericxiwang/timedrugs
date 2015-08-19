
<?php
ob_start();
include '../db_cn.php';
include 'basic_html.php';
require '../uuid_gen.php';

?>
<div class ='row'>
<div class='col-lg-12'>
<div class="input-group col-lg-5">
      <input type="text" class="form-control" placeholder="按订单号查询">
      <span class="input-group-btn">
        <button class="btn btn-success" type="button">确认</button>
      </span>



      <input type="text" class="form-control" placeholder="按用户名查询">
      <span class="input-group-btn">
        <button class="btn btn-primary" type="button">确认</button>
      </span>
    </div><!-- /input-group -->




</div>
</div>
<div class='row'>
<div class = 'col-lg-6'>

</div>

<div class='col-lg-6'>


</div>


</div>