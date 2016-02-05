<?php
include 'nav_menu_banner.php';
include 'promotion_function.php';
?>
    <!--nav end -->
   
      <div class="col-md-9 col-lg-9 panel panel-danger product_list" >
      

     <?php




     
     $query_buy_get = "SELECT pro_name,pro_img,pro_o_price,pro_code,promotion_enabled,promotion_id from product_info where promotion_enabled = '1' ";
     //$query_buy_get = "SELECT pro_name,pro_img,pro_o_price,pro_code,promotion_enabled,promotion_id from product_info where whole_sale = '0'";
     $query_buy_get = mysqli_query($db_connect,$query_buy_get);
   
     show_product($query_buy_get);

    





     //$query_all_pro  = "SELECT pro_name,pro_img,pro_o_price,pro_code,promotion_enabled,promotion_id from product_info where pro_onsell='1' and whole_sale='1' and promotion_enabled = '1'";
     //$query_all_pro  = "SELECT pro_name,pro_img,pro_o_price,pro_code,promotion_enabled,promotion_id from product_info where pro_onsell='1' and whole_sale='1'";
     //$all_products = mysqli_query($db_connect,$query_all_pro);

     //show_product($all_products);















     
     ?>
    
      
    </div>
    
 </div>


</div>
<!--inventory row end-->
  
</div>
<?php include 'footer.php';?>
</body>
</html>