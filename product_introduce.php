<?php
include 'nav_menu_banner.php';
?>
    <!--nav end -->

<script>
        $(function(){
            var t = $("#text_box");
            $("#add").click(function(){       
                t.val(parseInt(t.val())+1)
                setTotal();
            })

            $("#min").click(function(){

                if (t.val() > 1)
                {
                t.val(parseInt(t.val())-1)
                setTotal();}
            })
            function setTotal(){
                $("#total").html((parseInt(t.val())*3.95).toFixed(2));
            }
            setTotal();
        })
</script>
   
<?php

  //////////////////////////////
  $code = mt_rand(0,1000000);
  $_SESSION['code'] = $code;



  $pro_code = $_GET['id'];
  $pro_query_main = "SELECT * FROM product_info WHERE pro_code ='$pro_code'";
  $current_product = mysqli_query($db_connect,$pro_query_main);
  $current_product = mysqli_fetch_assoc($current_product);

  echo "<form action='shopping_cart_list.php' method='POST'>";
  //////////hidden element for session
  echo "<input type='hidden' name='originator' value='$code'>";
  echo "<input name ='pro_code' type='hidden' value=$current_product[pro_code]>";    


  echo "<div class='col-md-9 col-lg-9 panel panel-danger product_list' >
        <div class='col-md-5 col-lg-5 panel panel-danger order-page text-danger' style='text-align:center'>";
  echo "<h3>".$current_product['pro_name']."</h3>";

  echo "<img class='img-thumbnail preview-pic' src='$current_product[pro_img]'/></div>";

  echo "<div class='col-md-4 col-lg-4 panel panel-danger order-page'>";
  echo "<ul class='list-group'>
        <li class='list-group-item'>产品名称：$current_product[pro_name]</li>
        <li class='list-group-item'>产品品牌：力达</li>
        <li class='list-group-item'>净重：1公斤</li>
        <li class='list-group-item'>邮寄重量：2公斤</li>
        <li class='list-group-item'>规格：60粒</li>
        <h4><li class='list-group-item'>零售价格：$current_product[pro_o_price]</li>
        <li class='list-group-item'>特价价格：90</li></h4>
        <li class='list-group-item'>净重：1公斤</li>
  
      </ul>

      </div>";
  echo "<div class='col-md-5 col-lg-5 panel panel-danger order-page-m' >
        <ul class='list-group'>
        <li class='list-group-item'>产品名称：海洋单细胞海藻</li>
        </ul>
        </div>";

  echo "<div class='col-md-4 col-lg-4 panel panel-danger order-page-m' >
        <div class='col-md-7 col-lg-7' style=''>
          购买数量<br/>
          <button class='btn btn-danger btn-xs' id='min'  name='' type='button' value='-'' />-</button>
          <input id='text_box' name='text_box' type='text' value='1' size='3' readonly/>
          <button class='btn btn-danger btn-xs' id='add' name='' type='button' value='+'' />+</button>
          <!--<p>总价(不含税和运费)：<label id='total'></label></p>-->
        </div>";
  echo "<div class='col-md-5 col-lg-5'>
          <button type='submit' class='btn btn-danger glyphicon glyphicon-shopping-cart' style='height:50px;margin-right:20px'>&nbsp;加入购物车</button>
        </div>
      </div>";
   // load relevant info from other table   
  echo "<div class='col-md-9 col-lg-9 panel panel-danger product_des'>产品描述
        <div>miaoshu</div>

      </div>  
      <div class='col-md-9 col-lg-9 panel panel-danger product_des'>相关产品</div>  
      <div class='col-md-9 col-lg-9 panel panel-danger product_des'>相关</div> 
      <div class='col-md-9 col-lg-9 panel panel-danger product_des'>用户反馈</div>  
      
     
    
      
    </div></form>";



?>

    
 </div>


</div>
<!--inventory row end-->
  
</div>

</body>
</html>