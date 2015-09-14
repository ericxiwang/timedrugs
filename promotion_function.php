<?php

function show_product($product_query){
	$all_products=$product_query;

foreach ($all_products as $all_cursor){
	global $db_connect;

      echo "<div class='col-md-3 col-lg-3 panel panel-danger inventory'>";
      echo "<img class='img-thumbnail preview-pic' src='$all_cursor[pro_img]'/>";

      echo "<p>".$all_cursor['pro_name']."</p>";


      if ($all_cursor['promotion_enabled']=='1'){         // ensure current product is promotion stuff
          $promotion_id = $all_cursor['promotion_id'];
         
          ////////////////////////////////// get data from pro_discount for matched selection
          $promotion_query = "SELECT promotion_id,discount_value,pro_buy,pro_get,pro_price,pro_type from pro_discount where promotion_id=$promotion_id";
          $promotion_query = mysqli_query($db_connect,$promotion_query);
          $promotion_query = mysqli_fetch_assoc($promotion_query);

         
         
          if ($promotion_query['pro_type'] == '1'){ /////discount

            echo "<p>$".$all_cursor['pro_o_price']."</p>";
            echo "<p><code>";
            echo $promotion_query['discount_value']."%";
            echo "</code></p>";

            
          }
          elseif ($promotion_query['pro_type'] == '2') { //////buy and get

            echo "<p>$".$all_cursor['pro_o_price']."</p>";
            echo "<p><code>";
            echo "买".$promotion_query['pro_buy']."送".$promotion_query['pro_get'];
            echo "</code></p>";
          }
          elseif ($promotion_query['pro_type'] =='3') { /////// special price
            echo "special price";

            echo $promotion_query['pro_price'];
          }
          elseif ($promotion_query['pro_type'] == '4'){ ////////no shipping fee
             echo "<p>$".$all_cursor['pro_o_price']."</p>";
             echo "<p><code>免运费</code></p>";

          }
   



      }
      

      else
      {
      
      echo "<p>$".$all_cursor['pro_o_price']."</p>";
      echo "<p>&nbsp;</p>";
      }

      echo "<a href='product_introduce.php?id=$all_cursor[pro_code]' role='button' class='btn btn-warning'>在线订购</a>

            </div>";


     }





}




?>