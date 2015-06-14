<?php


include 'db_cn.php';

$query_all_pro  = "SELECT pro_name,pro_img,pro_o_price,pro_code from product_info";
     $all_products = mysqli_query($db_connect,$query_all_pro);

     foreach ($all_products as $all_cursor){

      echo "<div class='col-md-3 col-lg-3 panel panel-danger inventory'>";
      echo "<img class='img-thumbnail preview-pic' src='$all_cursor[pro_img]'/>";

      echo "<p>".$all_cursor['pro_name']."</p>";
      echo "<p>".$all_cursor['pro_o_price']."</p>";

      echo "<a href='product_introduce.php?id=$all_cursor[pro_code]' role='button' class='btn btn-danger' >在线订购</a>

            </div>";


     }



?>