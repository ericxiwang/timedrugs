<?php
ob_start();
session_start();


// Create connection
include 'db_cn.php';/////include basic DB connection , db name is inventory////////


?>

<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">


    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    

  </head>

<body >
  <div class='top-banner_1 menu_1'>
        
        <p>好时光网站后台管理系统</p>
      </div>
<div class="container-fluid">
<div class="row">
<div class='col-lg-2'>
 
<div class="panel-group" id="accordion">
    
  <div class="panel panel-primary">
    <div class="panel-heading panel-primary">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
        站点管理</a>
      </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse">
      <div class="panel-body">
          <a href="test_1.php" target="iframe_1">网站关键字</a><br/>
          <a href="test_1.php" target="iframe_1">滑动图片编辑</a><br/>
          <a href="manage/edit_nav.php" target="iframe_1">导航目录编辑</a><br/>
      </div>
    </div>
  </div>

  <div class="panel panel-primary">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
        购物车参数</a>
      </h4>
    </div>
    <div id="collapse2" class="panel-collapse collapse">
      <div class="panel-body">
          <a href="http://www.baidu.com" target="iframe_1">税率调整</a><br/>
          <a href="http://www.baidu.com" target="iframe_1">运费调整</a><br/>
      </div>
    </div>
  </div>

  <div class="panel panel-primary">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
        产品管理</a>
      </h4>
    </div>
    <div id="collapse3" class="panel-collapse collapse">
      <div class="panel-body">
          <a href="manage/brand_manage.php" target="iframe_1">品牌管理</a><br/>

          <a href="manage/product_upload.php" target="iframe_1">上传产品</a><br/>
          <a href="manage/product_edit.php" target="iframe_1">编辑产品</a><br/>

      </div>
    </div>
  </div>

  <div class="panel panel-primary">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
        优惠活动</a>
      </h4>
    </div>
    <div id="collapse4" class="panel-collapse collapse">
      <div class="panel-body">
          <a href="manage/promotion_add.php" target="iframe_1">新建促销</a><br/>
          <a href="manage/promotion_edit.php" target="iframe_1">编辑促销</a><br/>
          <a href="manage/promotion_select.php" target="iframe_1">产品促销编辑</a><br/>

      </div>
    </div>
  </div>

    <div class="panel panel-primary">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
        用户管理</a>
      </h4>
    </div>
    <div id="collapse5" class="panel-collapse collapse">
      <div class="panel-body">
          <a href="manage/user_mgmt.php" target="iframe_1">用户浏览编辑</a><br/>

      </div>
    </div>
  </div>

  <div class="panel panel-primary">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
        订单查询编辑</a>
      </h4>
    </div>
    <div id="collapse6" class="panel-collapse collapse">
      <div class="panel-body">
          <a href="manage/order_mgmt.php" target="iframe_1">浏览订单并编辑</a><br/>


      </div>
    </div>
  </div>

    <div class="panel panel-primary">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">
        用户信息反馈</a>
      </h4>
    </div>
    <div id="collapse7" class="panel-collapse collapse">
      <div class="panel-body">
          <a href="test_1.php" target="iframe_1">新消息</a><br/>
          <a href="test_1.php" target="iframe_1">消息浏览编辑</a><br/>


      </div>
    </div>
  </div>









</div>
 









</div>
<div col-lg-5>
<iframe src="" style="zoom:1.00" width="80%%" height="100%" frameborder="1" name = "iframe_1"></iframe>
</div>
 
</div>

</body>
</html>