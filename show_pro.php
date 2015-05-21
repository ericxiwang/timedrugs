<?php
include 'nav_menu_banner.php';
?>
    <!--nav end -->
   
      <div class="col-md-9 col-lg-9 panel panel-danger product_list" >
      <!-- one inventory unit -->
      <!--<div class="col-md-3 col-lg-3 panel panel-danger inventory">
      <img class="img-thumbnail preview-pic" src="image/image.jpg"/>
      <p>海洋单细胞海藻</p>
      <p>买3送1</p>
      <p>$20.00</p>
      <button type="button" class="btn btn-danger">在线订购</button>
      </div>-->
      <!-- one inventory unit -->

     <?php

     

     if (isset($_GET['pro_cate'])){
     $pro_cate = $_GET['pro_cate'];

     $query_all_pro  = "SELECT pro_name,pro_img,pro_o_price,pro_code from product_info where pro_category = $pro_cate";
     $all_products = mysqli_query($db_connect,$query_all_pro);

     foreach ($all_products as $all_cursor){

      echo "<div class='col-md-3 col-lg-3 panel panel-danger inventory'>";
      echo "<img class='img-thumbnail preview-pic' src='$all_cursor[pro_img]'/>";

      echo "<p>".$all_cursor['pro_name']."</p>";
      echo "<p>".$all_cursor['pro_o_price']."</p>";

      echo "<a href='product_introduce.php?id=$all_cursor[pro_code]' role='button' class='btn btn-danger' >在线订购</a>

            </div>";


     }
   }

     ?>
    
      
    </div>
    
 </div>


</div>
<!--inventory row end-->
  
</div>

</body>
</html>